<?php

namespace App\Domains\Favourite\Services;

use App\Domains\CouponOrder\Models\CouponOrder;
use App\Domains\Favourite\Models\Favourite;
use App\Domains\Product\Models\Product;
use App\Domains\ProductDetail\Models\ProductDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Domains\Cart\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Domains\Order\Models\Order;
use App\Exceptions\GeneralException;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\CouponUser\Models\CouponUser;
use App\Domains\AddressOrder\Models\AddressOrder;
use App\Domains\ProductOrder\Models\ProductOrder;
use function Symfony\Component\String\s;

/**
 * Class CategoryService.
 */
class FavouriteService extends BaseService
{
    protected Favourite $favourite;

    /**
     * OrderService constructor.
     */
    public function __construct(
        Favourite $favourite,
    )
    {
        $this->model = $favourite;
    }

    public function search(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->where('user_id', auth()->user()->id)
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->when(isset($data['colors']), function ($query) use ($data) {
                $query->filterByColors($data['colors']);
            })
            ->when(isset($data['sizes']), function ($query) use ($data) {
                $query->filterBySizes($data['sizes']);
            })
            ->when(isset($data['min_price']) && $data['min_price'] != null || isset($data['max_price']) && $data['max_price'] != null, function ($query) use ($data) {
                $query->filterByRangePrice(
                    isset($data['min_price']) && $data['min_price'] != null ? $data['min_price'] : 0,
                    isset($data['max_price']) && $data['max_price'] != null ? $data['max_price'] : 9999999999);
            })
            ->with('product')
            ->paginate(config('constants.paginate-dashboard'));
    }

    public function saveProductIntoFavourite(int $productId)
    {
        $check = $this->checkExistProductInFavourite($productId);

        if (!$check) {
            $this->model->create([
                'product_id' => $productId,
                'user_id' => auth()->user()->id
            ]);
        } else {
            throw new GeneralException(__('The product already exists in favorites.'));
        }
    }

    public function checkExistProductInFavourite(int $productId)
    {
        return $this->model->where('user_id', auth()->user()->id)
            ->where('product_id', $productId)->exists();
    }

    public function getProductInFavouriteByProductId(int $id)
    {
        return $this->model->where('product_id', $id)->get();
    }

    public function deleteProductIntoFavouriteWithUserId(int $productId)
    {
        $productFavourite = $this->model->where('user_id', auth()->user()->id)
            ->where('product_id', $productId)->first();

        if ($productFavourite != null) {
            $productFavourite->delete();
        } else {
            throw new GeneralException(__('An error occurred while deleting a favorite product.'));
        }
    }

    public function deleteProductIntoFavourite(int $productId)
    {
        $productFavourite = $this->model->where('product_id', $productId)->first();
        if ($productFavourite != null) {
            $productFavourite->delete();
        } else {
            throw new GeneralException(__('An error occurred while deleting a favorite product.'));
        }
    }
}
