<?php

namespace Database\Seeders\Data;

use App\Domains\ProductDetail\Models\ProductDetail;
use App\Domains\ProductImage\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dataVongtay = [];
        $dataDayChuyen = [];
        $dataKhuyenTai = [];
        $dataDongHo = [];

        $dataNhan = [
            //Nhan id1
            [
                'id' => 1,
                'name' => "Nhan 1.1",
                'product_id' => 1,
                'image_path' => 'nhan1.1.jpg',
                'order' => 1,
            ],
            [
                'id' => 2,
                'name' => "Nhan 1.2",
                'product_id' => 1,
                'image_path' => 'nhan1.2.jpg',
                'order' => 2,
            ],
            [
                'id' => 3,
                'name' => "Nhan 1.3",
                'product_id' => 1,
                'image_path' => 'nhan1.3.jpg',
                'order' => 3,
            ],
            [
                'id' => 4,
                'name' => "Nhan 1.4",
                'product_id' => 1,
                'image_path' => 'nhan1.4.jpg',
                'order' => 4,
            ],
            [
                'id' => 5,
                'name' => "Nhan 1.5",
                'product_id' => 1,
                'image_path' => 'nhan1.5.jpg',
                'order' => 5,
            ],

            //Nhan id2
            [
                'id' => 6,
                'name' => "Nhan 1.6",
                'product_id' => 2,
                'image_path' => 'nhan1.6.jpg',
                'order' => 1,
            ],
            [
                'id' => 7,
                'name' => "Nhan 1.7",
                'product_id' => 2,
                'image_path' => 'nhan1.7.jpg',
                'order' => 2,
            ],
            [
                'id' => 8,
                'name' => "Nhan 1.8",
                'product_id' => 2,
                'image_path' => 'nhan1.8.jpg',
                'order' => 3,
            ],
            [
                'id' => 9,
                'name' => "Nhan 1.9",
                'product_id' => 2,
                'image_path' => 'nhan1.9.jpg',
                'order' => 4,
            ],
            [
                'id' => 10,
                'name' => "Nhan 1.10",
                'product_id' => 2,
                'image_path' => 'nhan1.10.jpg',
                'order' => 5,
            ],

            //Nhan id3
            [
                'id' => 11,
                'name' => "Nhan 1.11",
                'product_id' => 3,
                'image_path' => 'nhan1.11.jpg',
                'order' => 1,
            ],
            [
                'id' => 12,
                'name' => "Nhan 1.12",
                'product_id' => 3,
                'image_path' => 'nhan1.12.jpg',
                'order' => 2,
            ],
            [
                'id' => 13,
                'name' => "Nhan 1.13",
                'product_id' => 3,
                'image_path' => 'nhan1.13.jpg',
                'order' => 3,
            ],
            [
                'id' => 14,
                'name' => "Nhan 1.14",
                'product_id' => 3,
                'image_path' => 'nhan1.14.jpg',
                'order' => 4,
            ],
            [
                'id' => 15,
                'name' => "Nhan 1.15",
                'product_id' => 3,
                'image_path' => 'nhan1.15.jpg',
                'order' => 5,
            ],

            //Nhan id4
            [
                'id' => 16,
                'name' => "Nhan 1.16",
                'product_id' => 4,
                'image_path' => 'nhan1.16.jpg',
                'order' => 1,
            ],
            [
                'id' => 17,
                'name' => "Nhan 1.17",
                'product_id' => 4,
                'image_path' => 'nhan1.17.jpg',
                'order' => 2,
            ],
            [
                'id' => 18,
                'name' => "Nhan 1.18",
                'product_id' => 4,
                'image_path' => 'nhan1.18.jpg',
                'order' => 3,
            ],
            [
                'id' => 19,
                'name' => "Nhan 1.19",
                'product_id' => 4,
                'image_path' => 'nhan1.19.jpg',
                'order' => 4,
            ],
            [
                'id' => 20,
                'name' => "Nhan 1.20",
                'product_id' => 4,
                'image_path' => 'nhan1.20.jpg',
                'order' => 5,
            ],

            //Nhan id5
            [
                'id' => 21,
                'name' => "Nhan 1.21",
                'product_id' => 5,
                'image_path' => 'nhan1.21.jpg',
                'order' => 1,
            ],
            [
                'id' => 22,
                'name' => "Nhan 1.22",
                'product_id' => 5,
                'image_path' => 'nhan1.22.jpg',
                'order' => 2,
            ],
            [
                'id' => 23,
                'name' => "Nhan 1.23",
                'product_id' => 5,
                'image_path' => 'nhan1.23.jpg',
                'order' => 3,
            ],
            [
                'id' => 24,
                'name' => "Nhan 1.24",
                'product_id' => 5,
                'image_path' => 'nhan1.24.jpg',
                'order' => 4,
            ],
            [
                'id' => 25,
                'name' => "Nhan 1.25",
                'product_id' => 5,
                'image_path' => 'nhan1.25.jpg',
                'order' => 5,
            ],

            //Nhan id6
            [
                'id' => 26,
                'name' => "Nhan 1.26",
                'product_id' => 6,
                'image_path' => 'nhan1.26.jpg',
                'order' => 1,
            ],
            [
                'id' => 27,
                'name' => "Nhan 1.27",
                'product_id' => 6,
                'image_path' => 'nhan1.27.jpg',
                'order' => 2,
            ],
            [
                'id' => 28,
                'name' => "Nhan 1.28",
                'product_id' => 6,
                'image_path' => 'nhan1.28.jpg',
                'order' => 3,
            ],
            [
                'id' => 29,
                'name' => "Nhan 1.29",
                'product_id' => 6,
                'image_path' => 'nhan1.29.jpg',
                'order' => 4,
            ],
            [
                'id' => 30,
                'name' => "Nhan 1.30",
                'product_id' => 6,
                'image_path' => 'nhan1.30.jpg',
                'order' => 5,
            ],

            //Nhan id7
            [
                'id' => 31,
                'name' => "Nhan 1.31",
                'product_id' => 7,
                'image_path' => 'nhan1.31.jpg',
                'order' => 1,
            ],
            [
                'id' => 32,
                'name' => "Nhan 1.32",
                'product_id' => 7,
                'image_path' => 'nhan1.32.jpg',
                'order' => 2,
            ],
            [
                'id' => 33,
                'name' => "Nhan 1.33",
                'product_id' => 7,
                'image_path' => 'nhan1.33.jpg',
                'order' => 3,
            ],
            [
                'id' => 34,
                'name' => "Nhan 1.34",
                'product_id' => 7,
                'image_path' => 'nhan1.34.jpg',
                'order' => 4,
            ],
            [
                'id' => 35,
                'name' => "Nhan 1.35",
                'product_id' => 7,
                'image_path' => 'nhan1.35.jpg',
                'order' => 5,
            ],

            //Nhan id8
            [
                'id' => 36,
                'name' => "Nhan 1.36",
                'product_id' => 8,
                'image_path' => 'nhan1.36.jpg',
                'order' => 1,
            ],
            [
                'id' => 37,
                'name' => "Nhan 1.37",
                'product_id' => 8,
                'image_path' => 'nhan1.37.jpg',
                'order' => 2,
            ],
            [
                'id' => 38,
                'name' => "Nhan 1.38",
                'product_id' => 8,
                'image_path' => 'nhan1.38.jpg',
                'order' => 3,
            ],
            [
                'id' => 39,
                'name' => "Nhan 1.39",
                'product_id' => 8,
                'image_path' => 'nhan1.39.jpg',
                'order' => 4,
            ],
            [
                'id' => 40,
                'name' => "Nhan 1.40",
                'product_id' => 8,
                'image_path' => 'nhan1.40.jpg',
                'order' => 5,
            ],

            //Nhan id9
            [
                'id' => 41,
                'name' => "Nhan 1.41",
                'product_id' => 9,
                'image_path' => 'nhan1.41.jpg',
                'order' => 1,
            ],
            [
                'id' => 42,
                'name' => "Nhan 1.42",
                'product_id' => 9,
                'image_path' => 'nhan1.42.jpg',
                'order' => 2,
            ],
            [
                'id' => 43,
                'name' => "Nhan 1.43",
                'product_id' => 9,
                'image_path' => 'nhan1.43.jpg',
                'order' => 3,
            ],
            [
                'id' => 44,
                'name' => "Nhan 1.44",
                'product_id' => 9,
                'image_path' => 'nhan1.44.jpg',
                'order' => 4,
            ],
            [
                'id' => 45,
                'name' => "Nhan 1.45",
                'product_id' => 9,
                'image_path' => 'nhan1.45.jpg',
                'order' => 5,
            ],

            //Nhan id10
            [
                'id' => 46,
                'name' => "Nhan 1.46",
                'product_id' => 10,
                'image_path' => 'nhan1.46.jpg',
                'order' => 1,
            ],
            [
                'id' => 47,
                'name' => "Nhan 1.47",
                'product_id' => 10,
                'image_path' => 'nhan1.47.jpg',
                'order' => 2,
            ],
            [
                'id' => 48,
                'name' => "Nhan 1.48",
                'product_id' => 10,
                'image_path' => 'nhan1.48.jpg',
                'order' => 3,
            ],
            [
                'id' => 49,
                'name' => "Nhan 1.49",
                'product_id' => 10,
                'image_path' => 'nhan1.49.jpg',
                'order' => 4,
            ],
            [
                'id' => 50,
                'name' => "Nhan 1.50",
                'product_id' => 10,
                'image_path' => 'nhan1.50.jpg',
                'order' => 5,
            ],

            //Nhan id11
            [
                'id' => 51,
                'name' => "Nhan 1.51",
                'product_id' => 11,
                'image_path' => 'nhan1.51.jpg',
                'order' => 1,
            ],
            [
                'id' => 52,
                'name' => "Nhan 1.52",
                'product_id' => 11,
                'image_path' => 'nhan1.52.jpg',
                'order' => 2,
            ],
            [
                'id' => 53,
                'name' => "Nhan 1.53",
                'product_id' => 11,
                'image_path' => 'nhan1.53.jpg',
                'order' => 3,
            ],
            [
                'id' => 54,
                'name' => "Nhan 1.54",
                'product_id' => 11,
                'image_path' => 'nhan1.54.jpg',
                'order' => 4,
            ],
            [
                'id' => 55,
                'name' => "Nhan 1.55",
                'product_id' => 11,
                'image_path' => 'nhan1.55.jpg',
                'order' => 5,
            ],

            //Nhan id12
            [
                'id' => 56,
                'name' => "Nhan 1.56",
                'product_id' => 12,
                'image_path' => 'nhan1.56.jpg',
                'order' => 1,
            ],
            [
                'id' => 57,
                'name' => "Nhan 1.57",
                'product_id' => 12,
                'image_path' => 'nhan1.57.jpg',
                'order' => 2,
            ],
            [
                'id' => 58,
                'name' => "Nhan 1.58",
                'product_id' => 12,
                'image_path' => 'nhan1.58.jpg',
                'order' => 3,
            ],
            [
                'id' => 59,
                'name' => "Nhan 1.59",
                'product_id' => 12,
                'image_path' => 'nhan1.59.jpg',
                'order' => 4,
            ],
            [
                'id' => 60,
                'name' => "Nhan 1.60",
                'product_id' => 12,
                'image_path' => 'nhan1.60.jpg',
                'order' => 5,
            ],

            //Nhan id13
            [
                'id' => 61,
                'name' => "Nhan 1.61",
                'product_id' => 13,
                'image_path' => 'nhan1.61.jpg',
                'order' => 1,
            ],
            [
                'id' => 62,
                'name' => "Nhan 1.62",
                'product_id' => 13,
                'image_path' => 'nhan1.62.jpg',
                'order' => 2,
            ],
            [
                'id' => 63,
                'name' => "Nhan 1.63",
                'product_id' => 13,
                'image_path' => 'nhan1.63.jpg',
                'order' => 3,
            ],
            [
                'id' => 64,
                'name' => "Nhan 1.64",
                'product_id' => 13,
                'image_path' => 'nhan1.64.jpg',
                'order' => 4,
            ],
            [
                'id' => 65,
                'name' => "Nhan 1.65",
                'product_id' => 13,
                'image_path' => 'nhan1.65.jpg',
                'order' => 5,
            ],

            //Nhan id14
            [
                'id' => 66,
                'name' => "Nhan 1.66",
                'product_id' => 14,
                'image_path' => 'nhan1.66.jpg',
                'order' => 1,
            ],
            [
                'id' => 67,
                'name' => "Nhan 1.67",
                'product_id' => 14,
                'image_path' => 'nhan1.67.jpg',
                'order' => 2,
            ],
            [
                'id' => 68,
                'name' => "Nhan 1.68",
                'product_id' => 14,
                'image_path' => 'nhan1.68.jpg',
                'order' => 3,
            ],
            [
                'id' => 69,
                'name' => "Nhan 1.69",
                'product_id' => 14,
                'image_path' => 'nhan1.69.jpg',
                'order' => 4,
            ],
            [
                'id' => 70,
                'name' => "Nhan 1.70",
                'product_id' => 14,
                'image_path' => 'nhan1.70.jpg',
                'order' => 5,
            ],

            //Nhan id15
            [
                'id' => 71,
                'name' => "Nhan 1.71",
                'product_id' => 15,
                'image_path' => 'nhan1.71.jpg',
                'order' => 1,
            ],
            [
                'id' => 72,
                'name' => "Nhan 1.72",
                'product_id' => 15,
                'image_path' => 'nhan1.72.jpg',
                'order' => 2,
            ],
            [
                'id' => 73,
                'name' => "Nhan 1.73",
                'product_id' => 15,
                'image_path' => 'nhan1.73.jpg',
                'order' => 3,
            ],
            [
                'id' => 74,
                'name' => "Nhan 1.74",
                'product_id' => 15,
                'image_path' => 'nhan1.74.jpg',
                'order' => 4,
            ],
            [
                'id' => 75,
                'name' => "Nhan 1.75",
                'product_id' => 15,
                'image_path' => 'nhan1.75.jpg',
                'order' => 5,
            ],
        ];

        $data = array_merge($dataNhan, $dataDayChuyen, $dataVongtay, $dataKhuyenTai, $dataDongHo);

        foreach ($data as $value) {
            $existingProductImage = ProductImage::where('id', $value['id'])->first();

            if (!$existingProductImage) {
                ProductImage::create($value);
            }
        }
    }
}
