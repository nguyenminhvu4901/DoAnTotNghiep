<?php

namespace Database\Seeders\Data;

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

        $dataVongtay = [
            //Vongtay id26
            [
                'id' => 76,
                'name' => "Vong tay 1",
                'product_id' => 26,
                'image_path' => 'vongtay1.jpg',
                'order' => 1,
            ],
            [
                'id' => 77,
                'name' => "Vong tay 2",
                'product_id' => 26,
                'image_path' => 'vongtay2.jpg',
                'order' => 2,
            ],
            [
                'id' => 78,
                'name' => "Vong tay 3",
                'product_id' => 26,
                'image_path' => 'vongtay3.jpg',
                'order' => 3,
            ],
            [
                'id' => 79,
                'name' => "Vong tay 4",
                'product_id' => 26,
                'image_path' => 'vongtay4.jpg',
                'order' => 4,
            ],
            [
                'id' => 80,
                'name' => "Vong tay 5",
                'product_id' => 26,
                'image_path' => 'vongtay5.jpg',
                'order' => 5,
            ],

            //Vongtay id27
            [
                'id' => 81,
                'name' => "Vong tay 6",
                'product_id' => 27,
                'image_path' => 'vongtay6.jpg',
                'order' => 1,
            ],
            [
                'id' => 82,
                'name' => "Vong tay 7",
                'product_id' => 27,
                'image_path' => 'vongtay7.jpg',
                'order' => 2,
            ],
            [
                'id' => 83,
                'name' => "Vong tay 8",
                'product_id' => 27,
                'image_path' => 'vongtay8.jpg',
                'order' => 3,
            ],
            [
                'id' => 84,
                'name' => "Vong tay 9",
                'product_id' => 27,
                'image_path' => 'vongtay9.jpg',
                'order' => 4,
            ],
            [
                'id' => 85,
                'name' => "Vong tay 10",
                'product_id' => 27,
                'image_path' => 'vongtay10.jpg',
                'order' => 5,
            ],

            //Vongtay id28
            [
                'id' => 86,
                'name' => "Vong tay 11",
                'product_id' => 28,
                'image_path' => 'vongtay11.jpg',
                'order' => 1,
            ],
            [
                'id' => 87,
                'name' => "Vong tay 12",
                'product_id' => 28,
                'image_path' => 'vongtay12.jpg',
                'order' => 2,
            ],
            [
                'id' => 88,
                'name' => "Vong tay 13",
                'product_id' => 28,
                'image_path' => 'vongtay13.jpg',
                'order' => 3,
            ],
            [
                'id' => 89,
                'name' => "Vong tay 14",
                'product_id' => 28,
                'image_path' => 'vongtay14.jpg',
                'order' => 4,
            ],
            [
                'id' => 90,
                'name' => "Vong tay 15",
                'product_id' => 28,
                'image_path' => 'vongtay15.jpg',
                'order' => 5,
            ],

            //Vongtay id29
            [
                'id' => 91,
                'name' => "Vong tay 16",
                'product_id' => 29,
                'image_path' => 'vongtay16.jpg',
                'order' => 1,
            ],
            [
                'id' => 92,
                'name' => "Vong tay 17",
                'product_id' => 29,
                'image_path' => 'vongtay17.jpg',
                'order' => 2,
            ],
            [
                'id' => 93,
                'name' => "Vong tay 18",
                'product_id' => 29,
                'image_path' => 'vongtay18.jpg',
                'order' => 3,
            ],
            [
                'id' => 94,
                'name' => "Vong tay 19",
                'product_id' => 29,
                'image_path' => 'vongtay19.jpg',
                'order' => 4,
            ],
            [
                'id' => 95,
                'name' => "Vong tay 20",
                'product_id' => 29,
                'image_path' => 'vongtay20.jpg',
                'order' => 5,
            ],

            //Vongtay id30
            [
                'id' => 96,
                'name' => "Vong tay 21",
                'product_id' => 30,
                'image_path' => 'vongtay21.jpg',
                'order' => 1,
            ],
            [
                'id' => 97,
                'name' => "Vong tay 22",
                'product_id' => 30,
                'image_path' => 'vongtay22.jpg',
                'order' => 2,
            ],
            [
                'id' => 98,
                'name' => "Vong tay 23",
                'product_id' => 30,
                'image_path' => 'vongtay23.jpg',
                'order' => 3,
            ],
            [
                'id' => 99,
                'name' => "Vong tay 24",
                'product_id' => 30,
                'image_path' => 'vongtay24.jpg',
                'order' => 4,
            ],
            [
                'id' => 100,
                'name' => "Vong tay 25",
                'product_id' => 30,
                'image_path' => 'vongtay25.jpg',
                'order' => 5,
            ],

            //Vongtay id31
            [
                'id' => 101,
                'name' => "Vong tay 26",
                'product_id' => 31,
                'image_path' => 'vongtay26.jpg',
                'order' => 1,
            ],
            [
                'id' => 102,
                'name' => "Vong tay 27",
                'product_id' => 31,
                'image_path' => 'vongtay27.jpg',
                'order' => 2,
            ],
            [
                'id' => 103,
                'name' => "Vong tay 28",
                'product_id' => 31,
                'image_path' => 'vongtay28.jpg',
                'order' => 3,
            ],
            [
                'id' => 104,
                'name' => "Vong tay 29",
                'product_id' => 31,
                'image_path' => 'vongtay29.jpg',
                'order' => 4,
            ],
            [
                'id' => 105,
                'name' => "Vong tay 30",
                'product_id' => 31,
                'image_path' => 'vongtay30.jpg',
                'order' => 5,
            ],

            //Vongtay id32
            [
                'id' => 106,
                'name' => "Vong tay 31",
                'product_id' => 32,
                'image_path' => 'vongtay31.jpg',
                'order' => 1,
            ],
            [
                'id' => 107,
                'name' => "Vong tay 32",
                'product_id' => 32,
                'image_path' => 'vongtay32.jpg',
                'order' => 2,
            ],
            [
                'id' => 108,
                'name' => "Vong tay 33",
                'product_id' => 32,
                'image_path' => 'vongtay33.jpg',
                'order' => 3,
            ],
            [
                'id' => 109,
                'name' => "Vong tay 34",
                'product_id' => 32,
                'image_path' => 'vongtay34.jpg',
                'order' => 4,
            ],
            [
                'id' => 110,
                'name' => "Vong tay 35",
                'product_id' => 32,
                'image_path' => 'vongtay35.jpg',
                'order' => 5,
            ],

            //Vongtay id33
            [
                'id' => 111,
                'name' => "Vong tay 36",
                'product_id' => 33,
                'image_path' => 'vongtay36.jpg',
                'order' => 1,
            ],
            [
                'id' => 112,
                'name' => "Vong tay 37",
                'product_id' => 33,
                'image_path' => 'vongtay37.jpg',
                'order' => 2,
            ],
            [
                'id' => 113,
                'name' => "Vong tay 38",
                'product_id' => 33,
                'image_path' => 'vongtay38.jpg',
                'order' => 3,
            ],
            [
                'id' => 114,
                'name' => "Vong tay 39",
                'product_id' => 33,
                'image_path' => 'vongtay39.jpg',
                'order' => 4,
            ],
            [
                'id' => 115,
                'name' => "Vong tay 40",
                'product_id' => 33,
                'image_path' => 'vongtay40.jpg',
                'order' => 5,
            ],

            //Vongtay id34
            [
                'id' => 116,
                'name' => "Vong tay 41",
                'product_id' => 34,
                'image_path' => 'vongtay41.jpg',
                'order' => 1,
            ],
            [
                'id' => 117,
                'name' => "Vong tay 42",
                'product_id' => 34,
                'image_path' => 'vongtay42.jpg',
                'order' => 2,
            ],
            [
                'id' => 118,
                'name' => "Vong tay 43",
                'product_id' => 34,
                'image_path' => 'vongtay43.jpg',
                'order' => 3,
            ],
            [
                'id' => 119,
                'name' => "Vong tay 44",
                'product_id' => 34,
                'image_path' => 'vongtay44.jpg',
                'order' => 4,
            ],
            [
                'id' => 120,
                'name' => "Vong tay 45",
                'product_id' => 34,
                'image_path' => 'vongtay45.jpg',
                'order' => 5,
            ],

            //Vongtay id35
            [
                'id' => 121,
                'name' => "Vong tay 46",
                'product_id' => 35,
                'image_path' => 'vongtay46.jpg',
                'order' => 1,
            ],
            [
                'id' => 122,
                'name' => "Vong tay 47",
                'product_id' => 35,
                'image_path' => 'vongtay47.jpg',
                'order' => 2,
            ],
            [
                'id' => 123,
                'name' => "Vong tay 48",
                'product_id' => 35,
                'image_path' => 'vongtay48.jpg',
                'order' => 3,
            ],
            [
                'id' => 124,
                'name' => "Vong tay 49",
                'product_id' => 35,
                'image_path' => 'vongtay49.jpg',
                'order' => 4,
            ],
            [
                'id' => 125,
                'name' => "Vong tay 50",
                'product_id' => 35,
                'image_path' => 'vongtay50.jpg',
                'order' => 5,
            ],

            //Vongtay id36
            [
                'id' => 126,
                'name' => "Vong tay 51",
                'product_id' => 36,
                'image_path' => 'vongtay51.jpg',
                'order' => 1,
            ],
            [
                'id' => 127,
                'name' => "Vong tay 52",
                'product_id' => 36,
                'image_path' => 'vongtay52.jpg',
                'order' => 2,
            ],
            [
                'id' => 128,
                'name' => "Vong tay 53",
                'product_id' => 36,
                'image_path' => 'vongtay53.jpg',
                'order' => 3,
            ],
            [
                'id' => 129,
                'name' => "Vong tay 54",
                'product_id' => 36,
                'image_path' => 'vongtay54.jpg',
                'order' => 4,
            ],
            [
                'id' => 130,
                'name' => "Vong tay 55",
                'product_id' => 36,
                'image_path' => 'vongtay55.jpg',
                'order' => 5,
            ],

            //Vongtay id37
            [
                'id' => 131,
                'name' => "Vong tay 56",
                'product_id' => 37,
                'image_path' => 'vongtay56.jpg',
                'order' => 1,
            ],
            [
                'id' => 132,
                'name' => "Vong tay 57",
                'product_id' => 37,
                'image_path' => 'vongtay57.jpg',
                'order' => 2,
            ],
            [
                'id' => 133,
                'name' => "Vong tay 58",
                'product_id' => 37,
                'image_path' => 'vongtay58.jpg',
                'order' => 3,
            ],
            [
                'id' => 134,
                'name' => "Vong tay 59",
                'product_id' => 37,
                'image_path' => 'vongtay59.jpg',
                'order' => 4,
            ],
            [
                'id' => 135,
                'name' => "Vong tay 60",
                'product_id' => 37,
                'image_path' => 'vongtay60.jpg',
                'order' => 5,
            ],

            //Vongtay id38
            [
                'id' => 136,
                'name' => "Vong tay 61",
                'product_id' => 38,
                'image_path' => 'vongtay61.jpg',
                'order' => 1,
            ],
            [
                'id' => 137,
                'name' => "Vong tay 62",
                'product_id' => 38,
                'image_path' => 'vongtay62.jpg',
                'order' => 2,
            ],
            [
                'id' => 138,
                'name' => "Vong tay 63",
                'product_id' => 38,
                'image_path' => 'vongtay63.jpg',
                'order' => 3,
            ],
            [
                'id' => 139,
                'name' => "Vong tay 64",
                'product_id' => 38,
                'image_path' => 'vongtay64.jpg',
                'order' => 4,
            ],
            [
                'id' => 140,
                'name' => "Vong tay 65",
                'product_id' => 38,
                'image_path' => 'vongtay65.jpg',
                'order' => 5,
            ],

            //Vongtay id39
            [
                'id' => 141,
                'name' => "Vong tay 66",
                'product_id' => 39,
                'image_path' => 'vongtay66.jpg',
                'order' => 1,
            ],
            [
                'id' => 142,
                'name' => "Vong tay 67",
                'product_id' => 39,
                'image_path' => 'vongtay67.jpg',
                'order' => 2,
            ],
            [
                'id' => 143,
                'name' => "Vong tay 68",
                'product_id' => 39,
                'image_path' => 'vongtay68.jpg',
                'order' => 3,
            ],
            [
                'id' => 144,
                'name' => "Vong tay 69",
                'product_id' => 39,
                'image_path' => 'vongtay69.jpg',
                'order' => 4,
            ],
            [
                'id' => 145,
                'name' => "Vong tay 70",
                'product_id' => 39,
                'image_path' => 'vongtay70.jpg',
                'order' => 5,
            ],

            //Vongtay id40
            [
                'id' => 146,
                'name' => "Vong tay 71",
                'product_id' => 40,
                'image_path' => 'vongtay72.jpg',
                'order' => 1,
            ],
            [
                'id' => 147,
                'name' => "Vong tay 72",
                'product_id' => 40,
                'image_path' => 'vongtay72.jpg',
                'order' => 2,
            ],
            [
                'id' => 148,
                'name' => "Vong tay 73",
                'product_id' => 40,
                'image_path' => 'vongtay73.jpg',
                'order' => 3,
            ],
            [
                'id' => 149,
                'name' => "Vong tay 74",
                'product_id' => 40,
                'image_path' => 'vongtay74.jpg',
                'order' => 4,
            ],
            [
                'id' => 150,
                'name' => "Vong tay 75",
                'product_id' => 40,
                'image_path' => 'vongtay75.jpg',
                'order' => 5,
            ],
        ];


        $dataDayChuyen = [
            //Day chuyen 16
            [
                'id' => 151,
                'name' => "Day chuyen 1",
                'product_id' => 16,
                'image_path' => 'daychuyen1.jpg',
                'order' => 1,
            ],
            [
                'id' => 152,
                'name' => "Day chuyen 2",
                'product_id' => 16,
                'image_path' => 'daychuyen2.jpg',
                'order' => 2,
            ],
            [
                'id' => 153,
                'name' => "Day chuyen 3",
                'product_id' => 16,
                'image_path' => 'daychuyen3.jpg',
                'order' => 3,
            ],
            [
                'id' => 154,
                'name' => "Day chuyen 4",
                'product_id' => 16,
                'image_path' => 'daychuyen4.jpg',
                'order' => 4,
            ],
            [
                'id' => 155,
                'name' => "Day chuyen 5",
                'product_id' => 16,
                'image_path' => 'daychuyen5.jpg',
                'order' => 5,
            ],

            //Day chuyen 17
            [
                'id' => 156,
                'name' => "Day chuyen 6",
                'product_id' => 17,
                'image_path' => 'daychuyen6.jpg',
                'order' => 1,
            ],
            [
                'id' => 157,
                'name' => "Day chuyen 7",
                'product_id' => 17,
                'image_path' => 'daychuyen7.jpg',
                'order' => 2,
            ],
            [
                'id' => 158,
                'name' => "Day chuyen 8",
                'product_id' => 17,
                'image_path' => 'daychuyen8.jpg',
                'order' => 3,
            ],
            [
                'id' => 159,
                'name' => "Day chuyen 9",
                'product_id' => 17,
                'image_path' => 'daychuyen9.jpg',
                'order' => 4,
            ],
            [
                'id' => 160,
                'name' => "Day chuyen 10",
                'product_id' => 17,
                'image_path' => 'daychuyen10.jpg',
                'order' => 5,
            ],

            //Day chuyen 18
            [
                'id' => 161,
                'name' => "Day chuyen 11",
                'product_id' => 18,
                'image_path' => 'daychuyen11.jpg',
                'order' => 1,
            ],
            [
                'id' => 162,
                'name' => "Day chuyen 12",
                'product_id' => 18,
                'image_path' => 'daychuyen12.jpg',
                'order' => 2,
            ],
            [
                'id' => 163,
                'name' => "Day chuyen 13",
                'product_id' => 18,
                'image_path' => 'daychuyen13.jpg',
                'order' => 3,
            ],
            [
                'id' => 164,
                'name' => "Day chuyen 14",
                'product_id' => 18,
                'image_path' => 'daychuyen14.jpg',
                'order' => 4,
            ],
            [
                'id' => 165,
                'name' => "Day chuyen 15",
                'product_id' => 18,
                'image_path' => 'daychuyen15.jpg',
                'order' => 5,
            ],

            //Day chuyen 19
            [
                'id' => 166,
                'name' => "Day chuyen 16",
                'product_id' => 19,
                'image_path' => 'daychuyen16.jpg',
                'order' => 1,
            ],
            [
                'id' => 167,
                'name' => "Day chuyen 17",
                'product_id' => 19,
                'image_path' => 'daychuyen17.jpg',
                'order' => 2,
            ],
            [
                'id' => 168,
                'name' => "Day chuyen 18",
                'product_id' => 19,
                'image_path' => 'daychuyen18.jpg',
                'order' => 3,
            ],
            [
                'id' => 169,
                'name' => "Day chuyen 19",
                'product_id' => 19,
                'image_path' => 'daychuyen19.jpg',
                'order' => 4,
            ],
            [
                'id' => 170,
                'name' => "Day chuyen 20",
                'product_id' => 19,
                'image_path' => 'daychuyen20.jpg',
                'order' => 5,
            ],

            //Day chuyen 20
            [
                'id' => 171,
                'name' => "Day chuyen 21",
                'product_id' => 20,
                'image_path' => 'daychuyen21.jpg',
                'order' => 1,
            ],
            [
                'id' => 172,
                'name' => "Day chuyen 22",
                'product_id' => 20,
                'image_path' => 'daychuyen22.jpg',
                'order' => 2,
            ],
            [
                'id' => 173,
                'name' => "Day chuyen 23",
                'product_id' => 20,
                'image_path' => 'daychuyen23.jpg',
                'order' => 3,
            ],
            [
                'id' => 174,
                'name' => "Day chuyen 24",
                'product_id' => 20,
                'image_path' => 'daychuyen24.jpg',
                'order' => 4,
            ],
            [
                'id' => 175,
                'name' => "Day chuyen 25",
                'product_id' => 20,
                'image_path' => 'daychuyen25.jpg',
                'order' => 5,
            ],

            //Day chuyen 21
            [
                'id' => 176,
                'name' => "Day chuyen 26",
                'product_id' => 21,
                'image_path' => 'daychuyen26.jpg',
                'order' => 1,
            ],
            [
                'id' => 177,
                'name' => "Day chuyen 27",
                'product_id' => 21,
                'image_path' => 'daychuyen27.jpg',
                'order' => 2,
            ],
            [
                'id' => 178,
                'name' => "Day chuyen 28",
                'product_id' => 21,
                'image_path' => 'daychuyen28.jpg',
                'order' => 3,
            ],
            [
                'id' => 179,
                'name' => "Day chuyen 29",
                'product_id' => 21,
                'image_path' => 'daychuyen29.jpg',
                'order' => 4,
            ],
            [
                'id' => 180,
                'name' => "Day chuyen 30",
                'product_id' => 21,
                'image_path' => 'daychuyen30.jpg',
                'order' => 5,
            ],

            //Day chuyen 22
            [
                'id' => 181,
                'name' => "Day chuyen 31",
                'product_id' => 22,
                'image_path' => 'daychuyen31.jpg',
                'order' => 1,
            ],
            [
                'id' => 182,
                'name' => "Day chuyen 32",
                'product_id' => 22,
                'image_path' => 'daychuyen32.jpg',
                'order' => 2,
            ],
            [
                'id' => 183,
                'name' => "Day chuyen 33",
                'product_id' => 22,
                'image_path' => 'daychuyen33.jpg',
                'order' => 3,
            ],
            [
                'id' => 184,
                'name' => "Day chuyen 34",
                'product_id' => 22,
                'image_path' => 'daychuyen34.jpg',
                'order' => 4,
            ],
            [
                'id' => 185,
                'name' => "Day chuyen 35",
                'product_id' => 22,
                'image_path' => 'daychuyen35.jpg',
                'order' => 5,
            ],

            //Day chuyen 23
            [
                'id' => 186,
                'name' => "Day chuyen 36",
                'product_id' => 23,
                'image_path' => 'daychuyen36.jpg',
                'order' => 1,
            ],
            [
                'id' => 187,
                'name' => "Day chuyen 37",
                'product_id' => 23,
                'image_path' => 'daychuyen37.jpg',
                'order' => 2,
            ],
            [
                'id' => 188,
                'name' => "Day chuyen 38",
                'product_id' => 23,
                'image_path' => 'daychuyen38.jpg',
                'order' => 3,
            ],
            [
                'id' => 189,
                'name' => "Day chuyen 39",
                'product_id' => 23,
                'image_path' => 'daychuyen39.jpg',
                'order' => 4,
            ],
            [
                'id' => 190,
                'name' => "Day chuyen 40",
                'product_id' => 23,
                'image_path' => 'daychuyen40.jpg',
                'order' => 5,
            ],

            //Day chuyen 24
            [
                'id' => 191,
                'name' => "Day chuyen 41",
                'product_id' => 24,
                'image_path' => 'daychuyen41.jpg',
                'order' => 1,
            ],
            [
                'id' => 192,
                'name' => "Day chuyen 42",
                'product_id' => 24,
                'image_path' => 'daychuyen42.jpg',
                'order' => 2,
            ],
            [
                'id' => 193,
                'name' => "Day chuyen 43",
                'product_id' => 24,
                'image_path' => 'daychuyen43.jpg',
                'order' => 3,
            ],
            [
                'id' => 194,
                'name' => "Day chuyen 44",
                'product_id' => 24,
                'image_path' => 'daychuyen44.jpg',
                'order' => 4,
            ],
            [
                'id' => 195,
                'name' => "Day chuyen 45",
                'product_id' => 24,
                'image_path' => 'daychuyen45.jpg',
                'order' => 5,
            ],

            //Day chuyen 25
            [
                'id' => 196,
                'name' => "Day chuyen 46",
                'product_id' => 25,
                'image_path' => 'daychuyen46.jpg',
                'order' => 1,
            ],
            [
                'id' => 197,
                'name' => "Day chuyen 47",
                'product_id' => 25,
                'image_path' => 'daychuyen47.jpg',
                'order' => 2,
            ],
            [
                'id' => 198,
                'name' => "Day chuyen 48",
                'product_id' => 25,
                'image_path' => 'daychuyen48.jpg',
                'order' => 3,
            ],
            [
                'id' => 199,
                'name' => "Day chuyen 49",
                'product_id' => 25,
                'image_path' => 'daychuyen49.jpg',
                'order' => 4,
            ],
            [
                'id' => 200,
                'name' => "Day chuyen 50",
                'product_id' => 25,
                'image_path' => 'daychuyen50.jpg',
                'order' => 5,
            ],
        ];

        $dataKhuyenTai = [
            //Khuyen tai 41
            [
                'id' => 201,
                'name' => "Khuyen tai 1",
                'product_id' => 41,
                'image_path' => 'khuyentai1.jpg',
                'order' => 1,
            ],
            [
                'id' => 202,
                'name' => "Khuyen tai 2",
                'product_id' => 41,
                'image_path' => 'khuyentai2.jpg',
                'order' => 2,
            ],
            [
                'id' => 203,
                'name' => "Khuyen tai 3",
                'product_id' => 41,
                'image_path' => 'khuyentai3.jpg',
                'order' => 3,
            ],
            [
                'id' => 204,
                'name' => "Khuyen tai 4",
                'product_id' => 41,
                'image_path' => 'khuyentai4.jpg',
                'order' => 4,
            ],
            [
                'id' => 205,
                'name' => "Khuyen tai 5",
                'product_id' => 41,
                'image_path' => 'khuyentai5.jpg',
                'order' => 5,
            ],

            //Khuyen tai 42
            [
                'id' => 206,
                'name' => "Khuyen tai 6",
                'product_id' => 42,
                'image_path' => 'khuyentai6.jpg',
                'order' => 1,
            ],
            [
                'id' => 207,
                'name' => "Khuyen tai 7",
                'product_id' => 42,
                'image_path' => 'khuyentai7.jpg',
                'order' => 2,
            ],
            [
                'id' => 208,
                'name' => "Khuyen tai 8",
                'product_id' => 42,
                'image_path' => 'khuyentai8.jpg',
                'order' => 3,
            ],
            [
                'id' => 209,
                'name' => "Khuyen tai 9",
                'product_id' => 42,
                'image_path' => 'khuyentai9.jpg',
                'order' => 4,
            ],
            [
                'id' => 210,
                'name' => "Khuyen tai 10",
                'product_id' => 42,
                'image_path' => 'khuyentai10.jpg',
                'order' => 5,
            ],

            //Khuyen tai 43
            [
                'id' => 211,
                'name' => "Khuyen tai 11",
                'product_id' => 43,
                'image_path' => 'khuyentai11.jpg',
                'order' => 1,
            ],
            [
                'id' => 212,
                'name' => "Khuyen tai 12",
                'product_id' => 43,
                'image_path' => 'khuyentai12.jpg',
                'order' => 2,
            ],
            [
                'id' => 213,
                'name' => "Khuyen tai 13",
                'product_id' => 43,
                'image_path' => 'khuyentai13.jpg',
                'order' => 3,
            ],
            [
                'id' => 214,
                'name' => "Khuyen tai 14",
                'product_id' => 43,
                'image_path' => 'khuyentai14.jpg',
                'order' => 4,
            ],
            [
                'id' => 215,
                'name' => "Khuyen tai 15",
                'product_id' => 43,
                'image_path' => 'khuyentai15.jpg',
                'order' => 5,
            ],

            //Khuyen tai 44
            [
                'id' => 216,
                'name' => "Khuyen tai 16",
                'product_id' => 44,
                'image_path' => 'khuyentai16.jpg',
                'order' => 1,
            ],
            [
                'id' => 217,
                'name' => "Khuyen tai 17",
                'product_id' => 44,
                'image_path' => 'khuyentai17.jpg',
                'order' => 2,
            ],
            [
                'id' => 218,
                'name' => "Khuyen tai 18",
                'product_id' => 44,
                'image_path' => 'khuyentai18.jpg',
                'order' => 3,
            ],
            [
                'id' => 219,
                'name' => "Khuyen tai 19",
                'product_id' => 44,
                'image_path' => 'khuyentai19.jpg',
                'order' => 4,
            ],
            [
                'id' => 220,
                'name' => "Khuyen tai 20",
                'product_id' => 43,
                'image_path' => 'khuyentai20.jpg',
                'order' => 5,
            ],

            //Khuyen tai 45
            [
                'id' => 221,
                'name' => "Khuyen tai 21",
                'product_id' => 45,
                'image_path' => 'khuyentai21.jpg',
                'order' => 1,
            ],
            [
                'id' => 222,
                'name' => "Khuyen tai 22",
                'product_id' => 45,
                'image_path' => 'khuyentai22.jpg',
                'order' => 2,
            ],
            [
                'id' => 223,
                'name' => "Khuyen tai 23",
                'product_id' => 45,
                'image_path' => 'khuyentai23.jpg',
                'order' => 3,
            ],
            [
                'id' => 224,
                'name' => "Khuyen tai 24",
                'product_id' => 45,
                'image_path' => 'khuyentai24.jpg',
                'order' => 4,
            ],
            [
                'id' => 225,
                'name' => "Khuyen tai 25",
                'product_id' => 45,
                'image_path' => 'khuyentai25.jpg',
                'order' => 5,
            ],

            //Khuyen tai 46
            [
                'id' => 226,
                'name' => "Khuyen tai 26",
                'product_id' => 46,
                'image_path' => 'khuyentai26.jpg',
                'order' => 1,
            ],
            [
                'id' => 227,
                'name' => "Khuyen tai 27",
                'product_id' => 46,
                'image_path' => 'khuyentai27.jpg',
                'order' => 2,
            ],
            [
                'id' => 228,
                'name' => "Khuyen tai 28",
                'product_id' => 46,
                'image_path' => 'khuyentai28.jpg',
                'order' => 3,
            ],
            [
                'id' => 229,
                'name' => "Khuyen tai 29",
                'product_id' => 46,
                'image_path' => 'khuyentai29.jpg',
                'order' => 4,
            ],
            [
                'id' => 230,
                'name' => "Khuyen tai 30",
                'product_id' => 46,
                'image_path' => 'khuyentai30.jpg',
                'order' => 5,
            ],

            //Khuyen tai 47
            [
                'id' => 231,
                'name' => "Khuyen tai 31",
                'product_id' => 47,
                'image_path' => 'khuyentai31.jpg',
                'order' => 1,
            ],
            [
                'id' => 232,
                'name' => "Khuyen tai 32",
                'product_id' => 47,
                'image_path' => 'khuyentai32.jpg',
                'order' => 2,
            ],
            [
                'id' => 233,
                'name' => "Khuyen tai 33",
                'product_id' => 47,
                'image_path' => 'khuyentai33.jpg',
                'order' => 3,
            ],
            [
                'id' => 234,
                'name' => "Khuyen tai 34",
                'product_id' => 47,
                'image_path' => 'khuyentai34.jpg',
                'order' => 4,
            ],
            [
                'id' => 235,
                'name' => "Khuyen tai 35",
                'product_id' => 47,
                'image_path' => 'khuyentai35.jpg',
                'order' => 5,
            ],

            //Khuyen tai 48
            [
                'id' => 236,
                'name' => "Khuyen tai 36",
                'product_id' => 48,
                'image_path' => 'khuyentai36.jpg',
                'order' => 1,
            ],
            [
                'id' => 237,
                'name' => "Khuyen tai 37",
                'product_id' => 48,
                'image_path' => 'khuyentai37.jpg',
                'order' => 2,
            ],
            [
                'id' => 238,
                'name' => "Khuyen tai 38",
                'product_id' => 48,
                'image_path' => 'khuyentai38.jpg',
                'order' => 3,
            ],
            [
                'id' => 239,
                'name' => "Khuyen tai 39",
                'product_id' => 48,
                'image_path' => 'khuyentai39.jpg',
                'order' => 4,
            ],
            [
                'id' => 240,
                'name' => "Khuyen tai 40",
                'product_id' => 48,
                'image_path' => 'khuyentai40.jpg',
                'order' => 5,
            ],
        ];

        $dataDongHo = [
            //Dong Ho 49
            [
                'id' => 241,
                'name' => "Dong ho 1",
                'product_id' => 49,
                'image_path' => 'dongho1.jpg',
                'order' => 1,
            ],
            [
                'id' => 242,
                'name' => "Dong ho 2",
                'product_id' => 49,
                'image_path' => 'dongho2.jpg',
                'order' => 2,
            ],
            [
                'id' => 243,
                'name' => "Dong ho 3",
                'product_id' => 49,
                'image_path' => 'dongho3.jpg',
                'order' => 3,
            ],
            [
                'id' => 244,
                'name' => "Dong ho 4",
                'product_id' => 49,
                'image_path' => 'dongho4.jpg',
                'order' => 4,
            ],
            [
                'id' => 245,
                'name' => "Dong ho 5",
                'product_id' => 50,
                'image_path' => 'dongho5.jpg',
                'order' => 5,
            ],

            //Dong Ho 50
            [
                'id' => 246,
                'name' => "Dong ho 6",
                'product_id' => 50,
                'image_path' => 'dongho6.jpg',
                'order' => 1,
            ],
            [
                'id' => 247,
                'name' => "Dong ho 7",
                'product_id' => 50,
                'image_path' => 'dongho7.jpg',
                'order' => 2,
            ],
            [
                'id' => 248,
                'name' => "Dong ho 8",
                'product_id' => 50,
                'image_path' => 'dongho8.jpg',
                'order' => 3,
            ],
            [
                'id' => 249,
                'name' => "Dong ho 9",
                'product_id' => 50,
                'image_path' => 'dongho9.jpg',
                'order' => 4,
            ],
            [
                'id' => 250,
                'name' => "Dong ho 10",
                'product_id' => 50,
                'image_path' => 'dongho10.jpg',
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
