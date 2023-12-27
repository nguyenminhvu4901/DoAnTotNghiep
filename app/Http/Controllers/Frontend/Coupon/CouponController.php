<?php

namespace App\Http\Controllers\Frontend\Coupon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Coupon\Services\CouponService;
use App\Http\Requests\Frontend\Coupon\StoreRequest;
use App\Http\Requests\Frontend\Coupon\UpdateRequest;

class CouponController extends Controller
{
    protected CouponService $couponService;
    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index(Request $request)
    {
        $coupons = $this->couponService->search($request->all());

        return view('frontend.pages.coupons.index', ['coupons' => $coupons]);
    }

    public function create()
    {
        return view('frontend.pages.coupons.create');
    }

    public function store(StoreRequest $request)
    {
        $this->couponService->create($request->all());

        return redirect(route('frontend.coupons.index'))->withFlashSuccess(__('Successfully created.'));
    }

    public function detail(string $slug)
    {
        $coupon = $this->couponService->getBySlug($slug);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.coupons.detail', ['coupon' => $coupon]);
    }

    public function edit(string $slug)
    {
        $coupon = $this->couponService->getBySlug($slug);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.coupons.edit', ['coupon' => $coupon]);
    }

    public function update(UpdateRequest $request, string $slug)
    {
        $coupon = $this->couponService->getBySlug($slug);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->couponService->update($coupon, $request->all());

        return redirect(route('frontend.coupons.index'))->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(string $slug)
    {
        $coupon = $this->couponService->getBySlug($slug);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->couponService->delete($coupon);

        return redirect(route('frontend.coupons.index'))->withFlashSuccess(__('Successfully deleted.'));
    }

    public function updateActive(Request $request, int $couponId)
    {
        $coupon = $this->couponService->getById($couponId);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->couponService->updateActive($request->all(), $coupon);

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }
}
