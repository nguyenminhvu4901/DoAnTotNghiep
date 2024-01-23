<?php

namespace Database\Seeders\Data;

use App\Domains\Coupon\Models\Coupon;
use App\Domains\ProductImage\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataCoupon = [
            [
                'id' => 1,
                'name' => 'coupon1',
                'type' => 0, //%
                'value' => 10,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 2,
                'name' => 'coupon2',
                'type' => 0, //%
                'value' => 5,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 3,
                'name' => 'coupon3',
                'type' => 0, //%
                'value' => 15,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 4,
                'name' => 'coupon4',
                'type' => 0, //%
                'value' => 20,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 5,
                'name' => 'coupon5',
                'type' => 1, //VND
                'value' => 8000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 6,
                'name' => 'coupon6',
                'type' => 1, //VND
                'value' => 10000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 7,
                'name' => 'coupon7',
                'type' => 1, //VND
                'value' => 15000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 8,
                'name' => 'coupon8',
                'type' => 1, //VND
                'value' => 20000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 9,
                'name' => 'coupon9',
                'type' => 1, //VND
                'value' => 25000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],

            [
                'id' => 10,
                'name' => 'coupon10',
                'type' => 1, //VND
                'value' => 30000,
                'start_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addDays(7),
                'quantity' => 10,
                'description' => 'Use the code and get 10% off your first order at Bio-First.',
            ],
        ];

        foreach ($dataCoupon as $value) {
            $existingProductImage = Coupon::where('id', $value['id'])->first();

            if (!$existingProductImage) {
                Coupon::create($value);
            }
        }
    }
}
