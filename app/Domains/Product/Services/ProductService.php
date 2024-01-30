<?php

namespace App\Domains\Product\Services;

use App\Domains\ProductSale\Models\ProductSale;
use Exception;
use App\Services\BaseService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;

/**
 * Class CategoryService.
 */
class ProductService extends BaseService
{
    protected Category $category;
    protected ProductSale $productSale;

    /**
     * ProductService constructor.
     * @param Product $product
     * @param Category $category
     */
    public function __construct(
        Product     $product,
        Category    $category,
        ProductSale $productSale
    )
    {
        $this->model = $product;
        $this->category = $category;
        $this->productSale = $productSale;
    }

    public function getLatestCategory()
    {
        return $this->model::latest()->first();
    }

    public function search(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->when(isset($data['colors']), function ($query) use ($data) {
                $query->filterByColors($data['colors']);
            })
            ->when(isset($data['sizes']), function ($query) use ($data) {
                $query->filterBySizes($data['sizes']);
            })
            ->with('categories', 'productDetail')
            ->latest('id')
            ->paginate(config('constants.paginate-dashboard'));
    }

    public function searchInDashboard(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search-product'] ?? ''))
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->when(isset($data['colors']), function ($query) use ($data) {
                $query->filterByColors($data['colors']);
            })
            ->when(isset($data['sizes']), function ($query) use ($data) {
                $query->filterBySizes($data['sizes']);
            })
            ->with('categories', 'productDetail', 'productImages')
            ->latest('id')
            ->paginate(config('constants.paginate-dashboard'));
    }

    public function searchWithTrash(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->with('categories', 'productDetail')
            ->onlyTrashed()
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function store(array $data = []): Product
    {
        DB::beginTransaction();
        try {
            $product = $this->createProduct($data);

            $product->syncCategories($data['category'] ?? []);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $product;
    }

    public function update(Product $product, array $data = []): Product
    {
        DB::beginTransaction();
        try {
            $product->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            $product->syncCategories($data['category'] ?? []);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating product. Please try again.'));
        }

        return $product;
    }

    protected function createProduct(array $data = []): Product
    {
        return $this->model->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'creator_id' => auth()->user()->id,
        ]);
    }

    public function delete(Product $product): Product
    {
        DB::beginTransaction();
        try {
            $productGlobalSale = $this->productSale
                ->where('product_id', $product->id)
                ->get();

            if ($productGlobalSale->isNotEmpty()) {
                foreach ($productGlobalSale as $productSale) {
                    $productSale->update([
                        'type_sale' => 1 //Ẩn sản phẩm giảm giá
                    ]);
                }
            }

            $product->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting product. Please try again.'));
        }

        return $product;
    }

    public function restore(Product $product): Product
    {
        DB::beginTransaction();
        try {
            $productGlobalSale = $this->productSale
                ->where('product_id', $product->id)
                ->get();
            if ($productGlobalSale->isNotEmpty()) {
                foreach ($productGlobalSale as $productSale) {
                    $productSale->update([
                        'type_sale' => 0 //Ẩn sản phẩm giảm giá
                    ]);
                }
            }

            $product->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem restoring product. Please try again.'));
        }

        return $product;
    }

    public function forceDelete(Product $product): Product
    {
        DB::beginTransaction();
        try {
            $product->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting product. Please try again.'));
        }

        return $product;
    }

    public function getAllProducts()
    {
        return $this->model->all();
    }

    public function getBestSellers()
    {
        return $this->model
            ->with('orders')
            ->get()
            ->sortByDesc(fn($product) => $product->getSaleCount())
            ->take(config('constants.top_best_seller_amount', 10));
    }

    public function convertBestSellersToBarChartData(Collection $products): Collection
    {
        return $products->map(fn($product) => [
            'name' => $product->name,
            'id' => $product->id,
            'sales' => $product->getSaleCount()
        ]);
    }

    public function isExistByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function getAllProductsByCategory(Product $product)
    {
        $category = $product->categories()->first();

        if ($category) {
            $productsInCategory = $this->model->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category->slug);
            })->where('id', '!=', $product->id)->limit(4)->get();
        } else {
            $productsInCategory = collect();
        }

        return $productsInCategory;
    }
}
