<?php

namespace App\Domains\API\VietNamProvince\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

/**
 * Class CartService.
 */
class VietNamProvinceService
{
    public function getProvinces()
    {
        $provinces = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_address') . 'province');

        return $provinces->json('data');
    }

    public function getDistricts()
    {
        $districts = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_address') . 'district');

        return $districts->json('data');
    }

    public function getWard()
    {
        $districts = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_address') . 'ward');

        return $districts->json('data');
    }

    public function getDistrictByProvinceId($provinceId)
    {
        $districts = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_address') . 'district?province_id=' . $provinceId);

        return $districts->json('data');
    }

    public function getWardByDistrictId($districtId)
    {
        $wards = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_address') . 'ward?district_id=' . $districtId);

        return $wards->json('data');
    }

    public function getShippingCost($districtId, $wardCode)
    {
        $params = [
            "service_type_id" => 2,
            "coupon" => null,
            "shop_id" => config('constants.ghn.shopId'),
            "to_district_id" => $districtId,
            "to_ward_code" => $wardCode,
            "height" => mt_rand(10, 15),
            "length" => mt_rand(10, 15),
            "weight" => mt_rand(500, 1000),
            "width" => mt_rand(10, 15)
        ];

        $response = Http::withHeaders([
            'token' => config('constants.ghn.token')
        ])->get(config('constants.ghn.url_fee'), $params);

        return $response->json('data');
    }
}
