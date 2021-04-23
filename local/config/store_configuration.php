<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 20-Dec-16 2:58 PM
 * File Name    : store_configuration.php
 */

return [
    'CURRENCY' => [
        "NAME"          => 'CURRENCY',
        "DEFAULT_VALUE" => 1,
        "OPTIONS"       => [
            1 => 'US Dollar',
            2 => 'Pak Rupees'
        ]
    ],

    'PRODUCT_VARIABLE_CODE' => [
        "NAME"          => 'PRODUCT_VARIABLE_CODE',
        'DEFAULT_VALUE' => '7'
    ],
    'PRODUCT_VARIABLE_1'    => [
        "NAME"          => 'PRODUCT_VARIABLE_1',
        'DEFAULT_VALUE' => 'Age Group'
    ],
    'PRODUCT_VARIABLE_2'    => [
        "NAME"          => 'PRODUCT_VARIABLE_2',
        'DEFAULT_VALUE' => 'Brands'
    ],
    'PRODUCT_VARIABLE_3'    => [
        "NAME"          => 'PRODUCT_VARIABLE_3',
        'DEFAULT_VALUE' => 'Life Type'
    ],
    'PRODUCT_VARIABLE_4'    => [
        "NAME"          => 'PRODUCT_VARIABLE_4',
        'DEFAULT_VALUE' => 'Product Gender'
    ],
    'PRODUCT_VARIABLE_5'    => [
        "NAME"          => 'PRODUCT_VARIABLE_5',
        'DEFAULT_VALUE' => 'Value Addition'
    ],
    "DECIMAL_POINTS_VALUE"  => [
        "NAME"          => 'DECIMAL_POINTS_VALUE',
        "DEFAULT_VALUE" => 1,
        'OPTIONS'       => [
            1 => 0,
            2 => 1,
            3 => 2,
            4 => 3,
            5 => 4,
        ]
    ],
    "STOCK_OPENING"         => [
        "NAME" => 'STOCK_OPENING',
        //Options value from Suppliers table
    ]
];
