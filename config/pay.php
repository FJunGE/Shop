<?php

return [
    'alipay' => [
        'app_id'            => '',
        'ali_public_key'    => '',
        'private_key'       => '',
        'log'               => [
            'file' => storage_path('logs/alipay.log');
        ],
    ],

    'wechat_pay' => [
        'app_id'    =>  '',
        'mch_id'    =>  '',
        'key'       =>  '',
        'cert_client'   =>  '',
        'cert_key'  =>  '',
        'log'       =>  [
            'flie'  =>  storage_path('logs/wechat_pay.log');
        ]
    ]
];