<?php

namespace Database\Seeders\Data;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Services\ProductService;
use App\Domains\ProductDetail\Models\ProductDetail;
use App\Domains\ProductDetail\Services\ProductDetailService;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    protected ProductService $productService;
    protected ProductDetailService $productDetailService;

    public function __construct(ProductService $productService, ProductDetailService $productDetailService)
    {
        $this->productService = $productService;
        $this->productDetailService = $productDetailService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataNhan = [
            //Nhẫn Id 1
            [
                'id' => 1,
                'product_id' => 1,
                'size' => '50 - 52 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 50000
            ],

            [
                'id' => 2,
                'product_id' => 1,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 60000
            ],

            [
                'id' => 3,
                'product_id' => 1,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 70000
            ],

            [
                'id' => 4,
                'product_id' => 1,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 80000
            ],

            [
                'id' => 5,
                'product_id' => 1,
                'size' => '50 - 52 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 90000
            ],

            //Nhẫn Id 2
            [
                'id' => 6,
                'product_id' => 2,
                'size' => '50 - 52 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 50000
            ],

            [
                'id' => 7,
                'product_id' => 2,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 60000
            ],

            [
                'id' => 8,
                'product_id' => 2,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 70000
            ],

            [
                'id' => 9,
                'product_id' => 2,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 80000
            ],

            [
                'id' => 10,
                'product_id' => 2,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 90000
            ],

            //Nhẫn Id 3
            [
                'id' => 11,
                'product_id' => 3,
                'size' => '50 - 52 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 12,
                'product_id' => 3,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 13,
                'product_id' => 3,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 14,
                'product_id' => 3,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 15,
                'product_id' => 3,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 4
            [
                'id' => 16,
                'product_id' => 4,
                'size' => '50 - 52 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 17,
                'product_id' => 4,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 18,
                'product_id' => 4,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 19,
                'product_id' => 4,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 20,
                'product_id' => 4,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 5
            [
                'id' => 21,
                'product_id' => 5,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 22,
                'product_id' => 5,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 23,
                'product_id' => 5,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 24,
                'product_id' => 5,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 25,
                'product_id' => 5,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 6
            [
                'id' => 26,
                'product_id' => 6,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 27,
                'product_id' => 6,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 28,
                'product_id' => 6,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 29,
                'product_id' => 6,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 30,
                'product_id' => 6,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 7
            [
                'id' => 31,
                'product_id' => 7,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 32,
                'product_id' => 7,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 33,
                'product_id' => 7,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 34,
                'product_id' => 7,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 35,
                'product_id' => 7,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 8
            [
                'id' => 36,
                'product_id' => 8,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 37,
                'product_id' => 8,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 38,
                'product_id' => 8,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 39,
                'product_id' => 8,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 40,
                'product_id' => 8,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 9
            [
                'id' => 41,
                'product_id' => 9,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 42,
                'product_id' => 9,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 43,
                'product_id' => 9,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 44,
                'product_id' => 9,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 45,
                'product_id' => 9,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 10
            [
                'id' => 46,
                'product_id' => 10,
                'size' => '50 - 52 mm',
                'color' => 'Đồng',
                'quantity' => 100,
                'price' => 100000
            ],

            [
                'id' => 47,
                'product_id' => 10,
                'size' => '53 - 55 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 120000
            ],

            [
                'id' => 48,
                'product_id' => 10,
                'size' => '56 - 58 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 135000
            ],

            [
                'id' => 49,
                'product_id' => 10,
                'size' => '59 - 60 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 150000
            ],

            [
                'id' => 50,
                'product_id' => 10,
                'size' => '50 - 52 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 200000
            ],

            //Nhẫn Id 11
            [
                'id' => 51,
                'product_id' => 11,
                'size' => '60 - 62 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 52,
                'product_id' => 11,
                'size' => '63 - 65 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 53,
                'product_id' => 11,
                'size' => '66 - 68 mm',
                'color' => 'Xanh',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 54,
                'product_id' => 11,
                'size' => '69 - 70 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 55,
                'product_id' => 11,
                'size' => '71 - 72 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 400000
            ],

            //Nhẫn Id 12
            [
                'id' => 56,
                'product_id' => 12,
                'size' => '60 - 62 mm',
                'color' => 'Bạc',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 57,
                'product_id' => 12,
                'size' => '63 - 65 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 58,
                'product_id' => 12,
                'size' => '66 - 68 mm',
                'color' => 'Xanh',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 59,
                'product_id' => 12,
                'size' => '69 - 70 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 60,
                'product_id' => 12,
                'size' => '71 - 72 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 400000
            ],

            //Nhẫn Id 13
            [
                'id' => 61,
                'product_id' => 13,
                'size' => '60 - 62 mm',
                'color' => 'Bạc',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 62,
                'product_id' => 13,
                'size' => '63 - 65 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 63,
                'product_id' => 13,
                'size' => '66 - 68 mm',
                'color' => 'Xanh',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 64,
                'product_id' => 13,
                'size' => '69 - 70 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 65,
                'product_id' => 13,
                'size' => '71 - 72 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 400000
            ],

            //Nhẫn Id 14
            [
                'id' => 66,
                'product_id' => 14,
                'size' => '60 - 62 mm',
                'color' => 'Bạc',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 67,
                'product_id' => 14,
                'size' => '63 - 65 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 68,
                'product_id' => 14,
                'size' => '66 - 68 mm',
                'color' => 'Xanh',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 69,
                'product_id' => 14,
                'size' => '69 - 70 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 70,
                'product_id' => 14,
                'size' => '71 - 72 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 400000
            ],

            //Nhẫn Id 15
            [
                'id' => 71,
                'product_id' => 15,
                'size' => '60 - 62 mm',
                'color' => 'Bạc',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 72,
                'product_id' => 15,
                'size' => '63 - 65 mm',
                'color' => 'Bạc',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 73,
                'product_id' => 15,
                'size' => '66 - 68 mm',
                'color' => 'Bạc',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 74,
                'product_id' => 15,
                'size' => '69 - 70 mm',
                'color' => 'Bạc',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 75,
                'product_id' => 15,
                'size' => '71 - 72 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 400000
            ],
            [
                'id' => 76,
                'product_id' => 15,
                'size' => '60 - 62 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 300000
            ],

            [
                'id' => 77,
                'product_id' => 15,
                'size' => '63 - 65 mm',
                'color' => 'Xanh',
                'quantity' => 300,
                'price' => 320000
            ],

            [
                'id' => 78,
                'product_id' => 15,
                'size' => '66 - 68 mm',
                'color' => 'Xanh',
                'quantity' => 150,
                'price' => 340000
            ],

            [
                'id' => 79,
                'product_id' => 15,
                'size' => '69 - 70 mm',
                'color' => 'Xanh',
                'quantity' => 100,
                'price' => 350000
            ],

            [
                'id' => 80,
                'product_id' => 15,
                'size' => '73 - 74 mm',
                'color' => 'Vàng',
                'quantity' => 100,
                'price' => 500000
            ],
        ];

        $dataDayChuyen = [
            //Day chuyen id 16
            [
                'id' => 81,
                'product_id' => 16,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 82,
                'product_id' => 16,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 17
            [
                'id' => 83,
                'product_id' => 17,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 84,
                'product_id' => 17,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 18
            [
                'id' => 85,
                'product_id' => 18,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 86,
                'product_id' => 18,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 19
            [
                'id' => 87,
                'product_id' => 19,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 88,
                'product_id' => 19,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 20
            [
                'id' => 89,
                'product_id' => 20,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 90,
                'product_id' => 20,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 21
            [
                'id' => 91,
                'product_id' => 21,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 92,
                'product_id' => 21,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 22
            [
                'id' => 93,
                'product_id' => 22,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 94,
                'product_id' => 22,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 23
            [
                'id' => 95,
                'product_id' => 23,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 96,
                'product_id' => 23,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id
            [
                'id' => 97,
                'product_id' => 24,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 98,
                'product_id' => 24,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

            //Day chuyen id 25
            [
                'id' => 99,
                'product_id' => 25,
                'size' => '50 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 100,
                'product_id' => 25,
                'size' => '55 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 600000
            ],

        ];

        $dataVongtay = [
            //Vong tay id 26
            [
                'id' => 101,
                'product_id' => 26,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 102,
                'product_id' => 26,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 27
            [
                'id' => 103,
                'product_id' => 27,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 104,
                'product_id' => 27,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 28
            [
                'id' => 105,
                'product_id' => 28,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 106,
                'product_id' => 28,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 29
            [
                'id' => 107,
                'product_id' => 29,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 108,
                'product_id' => 29,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 30
            [
                'id' => 109,
                'product_id' => 30,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 110,
                'product_id' => 30,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 31
            [
                'id' => 111,
                'product_id' => 31,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 112,
                'product_id' => 31,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 32
            [
                'id' => 113,
                'product_id' => 32,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 114,
                'product_id' => 32,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 33
            [
                'id' => 115,
                'product_id' => 33,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 116,
                'product_id' => 33,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 34
            [
                'id' => 117,
                'product_id' => 34,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 118,
                'product_id' => 34,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 35
            [
                'id' => 119,
                'product_id' => 35,
                'size' => '18 cm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 4000000
            ],
            [
                'id' => 120,
                'product_id' => 35,
                'size' => '20 cm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 500000
            ],

            //Vong tay id 36
            [
                'id' => 121,
                'product_id' => 36,
                'size' => '18 cm',
                'color' => 'Bạch Kim',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 122,
                'product_id' => 36,
                'size' => '20 cm',
                'color' => 'Bạch Kim',
                'quantity' => 55,
                'price' => 600000
            ],

            //Vong tay id 37
            [
                'id' => 123,
                'product_id' => 37,
                'size' => '18 cm',
                'color' => 'Bạch Kim',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 124,
                'product_id' => 37,
                'size' => '20 cm',
                'color' => 'Bạch Kim',
                'quantity' => 55,
                'price' => 600000
            ],

            //Vong tay id 38
            [
                'id' => 125,
                'product_id' => 38,
                'size' => '18 cm',
                'color' => 'Bạch Kim',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 126,
                'product_id' => 38,
                'size' => '20 cm',
                'color' => 'Bạch Kim',
                'quantity' => 55,
                'price' => 600000
            ],

            //Vong tay id 39
            [
                'id' => 127,
                'product_id' => 39,
                'size' => '18 cm',
                'color' => 'Bạch Kim',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 128,
                'product_id' => 39,
                'size' => '20 cm',
                'color' => 'Bạch Kim',
                'quantity' => 55,
                'price' => 600000
            ],

            //Vong tay id 40
            [
                'id' => 129,
                'product_id' => 40,
                'size' => '18 cm',
                'color' => 'Bạch Kim',
                'quantity' => 50,
                'price' => 500000
            ],
            [
                'id' => 130,
                'product_id' => 40,
                'size' => '20 cm',
                'color' => 'Bạch Kim',
                'quantity' => 55,
                'price' => 600000
            ],
        ];

        $dataKhuyenTai = [
            //Khuyen tai id 41
            [
                'id' => 131,
                'product_id' => 41,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 132,
                'product_id' => 41,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 42
            [
                'id' => 133,
                'product_id' => 42,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 134,
                'product_id' => 42,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 43
            [
                'id' => 135,
                'product_id' => 43,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 136,
                'product_id' => 43,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 44
            [
                'id' => 137,
                'product_id' => 44,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 138,
                'product_id' => 44,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 45
            [
                'id' => 139,
                'product_id' => 45,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 140,
                'product_id' => 45,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 46
            [
                'id' => 141,
                'product_id' => 46,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 142,
                'product_id' => 46,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 47
            [
                'id' => 143,
                'product_id' => 47,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 144,
                'product_id' => 47,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],

            //Khuyen tai id 48
            [
                'id' => 145,
                'product_id' => 48,
                'size' => '12 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 100000
            ],
            [
                'id' => 146,
                'product_id' => 48,
                'size' => '16 mm',
                'color' => 'Bạc',
                'quantity' => 55,
                'price' => 140000
            ],
        ];

        $dataDongHo = [
            //Dong Ho id 49
            [
                'id' => 147,
                'product_id' => 49,
                'size' => '22 mm',
                'color' => 'Xanh Dương',
                'quantity' => 20,
                'price' => 1000000
            ],
            [
                'id' => 148,
                'product_id' => 49,
                'size' => '22 mm',
                'color' => 'Bạc',
                'quantity' => 20,
                'price' => 1200000
            ],

            //Dong Ho id 50
            [
                'id' => 149,
                'product_id' => 50,
                'size' => '22 mm',
                'color' => 'Đen',
                'quantity' => 50,
                'price' => 150000
            ],
            [
                'id' => 150,
                'product_id' => 50,
                'size' => '22 mm',
                'color' => 'Bạc',
                'quantity' => 50,
                'price' => 200000
            ],
        ];

        $data = array_merge($dataNhan, $dataDayChuyen, $dataVongtay, $dataKhuyenTai, $dataDongHo);


        foreach ($data as $value) {
            $existingProductDetail = ProductDetail::where('id', $value['id'])->first();

            if (!$existingProductDetail) {
                ProductDetail::create($value);
            }
        }
    }
}
