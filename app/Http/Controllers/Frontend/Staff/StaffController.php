<?php

namespace App\Http\Controllers\Frontend\Staff;

use App\Domains\Staff\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Sale\Services\SaleService;
use App\Domains\Product\Services\ProductService;
use App\Http\Requests\Frontend\Sale\StoreRequest;
use App\Http\Requests\Frontend\Sale\UpdateRequest;

class StaffController extends Controller
{
    protected StaffService $staffService;
    public function __construct(
        StaffService $staffService
    ) {
        $this->staffService = $staffService;
    }

    public function index(Request $request)
    {
        $staff = $this->staffService->search($request->all());

        return view('frontend.pages.sales.index');
    }

    public function create(Request $request, int $productId)
    {
        if ($request->level == 'parent') {
            $product = $this->saleService->getProductById($productId);
        } else if ($request->level == 'child') {
            $product = $this->saleService->getProductDetailById($productId);
        } else {
            abort_if(true, Response::HTTP_NOT_FOUND);
        }

        return view('frontend.pages.sales.create', ['product' => $product, 'level' => $request->level]);
    }

    public function store(StoreRequest $request, int $productId)
    {
        if ($request->level == 'parent') {
            $this->saleService->createProductSaleGlobal($request->all(), $productId);
        } else if ($request->level == 'child') {
            $this->saleService->createProductSaleOption($request->all(), $productId);
        } else {
            abort_if(true, Response::HTTP_NOT_FOUND);
        }

        return redirect()->route('frontend.sales.index')->withFlashSuccess(__('Successfully created.'));
    }

    public function edit(int $id)
    {
        $sale = $this->saleService->getById($id);

        return view('frontend.pages.sales.edit', ['sale' => $sale]);
    }

    public function update(UpdateRequest $request, int $saleId)
    {
        $sale = $this->saleService->getById($saleId);
        $this->saleService->updateSale($request->all(), $sale);

        return redirect()->route('frontend.sales.index')->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(int $saleId)
    {
        $sale = $this->saleService->getById($saleId);
        abort_if(!$sale, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->saleService->delete($sale);

        return redirect()->route('frontend.sales.index')->withFlashSuccess(__('Successfully deleted.'));
    }

    public function updateActive(Request $request, int $saleId)
    {
        $sale = $this->saleService->getById($saleId);
        abort_if(!$sale, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->saleService->updateActive($request->all(), $sale);

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }
}
