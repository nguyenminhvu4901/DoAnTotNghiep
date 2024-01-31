<?php

return [
    'paginate' => 10,

    'paginate-dashboard' => 12,

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

    'gender' => [
        'Male',
        'Female',
        'Other'
    ],
    'user_gender' => [
        'Male' => 0,
        'Female' => 1,
        'Other' => 2
    ],

    'password-default' => 'nhanvien123',

    'ghn' => [
        'url_address' => 'https://online-gateway.ghn.vn/shiip/public-api/master-data/',
        'url_fee' => 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
        'token' => 'b0b60888-9a86-11ee-b394-8ac29577e80e',
        'shopId' => '4767672',
    ],

    'payment_method' => [
        'direct' => '1',
        'vnpay' => '2',
        // 'momo' => '3'
    ],

    'status_order' => [
        'cancel' => '0', // Huỷ
        'ready_to_pick' => '1', // Chờ lấy hàng
        'picking' => '2', // Đang lấy hàng
        'send_to_carrier' => '3', // Đã lấy hàng, đã gửi hàng
        'delivering' => '4', // Đang giao hàng
        'delivered' => '5' // Đã nhận, giao thành công
    ],

    'status_order_text' => [
        'Cancel order' => '0',
        'Preparing orders' => '1',
        'Sending order to carrier' => '2',
        'Order sent successfully' => '3',
        'Delivering' => '4',
        'Successful delivery' => '5',
    ],

    'status_return_order' => [
        'Cancel return order' => '0',
        'Order sent successfully' => '1',
        'Preparing orders' => '2',
        'Shipped' => '3',
        'Shop has received the goods' => '4',
        'Refund successful' => '5'
    ],

    'vnpay' => [
        'vnp_TmnCode' => 'MO0DDVN3',
        'vnp_HashSecret' => 'AACFVHHKFMBVXJREGUBEEYYSZCGWYTMW',
        'so_the' => '9704198526191432198',
        'ten_chu_the' => 'NGUYEN VAN A',
        'ngay_phat_hanh' => '07/15',
        'otp' => '123456'
    ],

    'top_best_seller_amount' => 10,

    'order_by' => [
        '' => null,
        'Outstanding Products' => 0,
        'Price: Gradual increase' => 1,
        'Price: Descending' => 2,
        'Name: A to Z' => 3,
        'Name: Z to A' => 4,
        'Oldest' => 5,
        'Latest' => 6
    ]

];
