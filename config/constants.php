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
    ],

    'payment_method' => [
        'direct' => 1,
        'vnpay' => 2,
        'momo' => 3
    ],

    'status_order' => [
        'cancel' => 0, // Huỷ
        'ready_to_pick' => 1, // Chờ lấy hàng
        'picking' => 2, // Đang lấy hàng
        'send_to_carrier' => 3, // Đã lấy hàng, đã gửi hàng
        'delivering' => 4, // Đang giao hàng
        'delivered' => 5 // Đã nhận, giao thành công
    ],
];
