<?php

return [
    'paginate' => 10,

    'image_product_default' => 'default/ProductImageDefault.jpg',

    'save_image' => [
        'product' => 'app/public/images/products/'
    ],

    'coupon' => [
        'percent' => 0,
        'number' => 1,
    ],

    'type_sale' => [
        'percent' => 0,
        'number' => 1,
    ],

    'is_used' => [
        'false' => 0,
        'true' => 1,
    ],

    'is_active' => [
        'false' => 0,
        'true' => 1,
    ],

    'ghn' => [
        'url_address' => 'https://online-gateway.ghn.vn/shiip/public-api/master-data/',
        'url_fee' => 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
        'token' => 'b0b60888-9a86-11ee-b394-8ac29577e80e',
        'shopId' => '4767672',
    ]
];
