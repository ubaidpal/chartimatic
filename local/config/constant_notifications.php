<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 10:52 AM
 * File Name    : constant_notifications.php
 */
return [
    'OBJECT_TYPES'        => [
        'PUSHED' => [
            'NAME'    => 'pushed-items',
            'ACTIONS' => [
                'RECEIVED' => 'received',
            ]
        ],
        'ORDER'  => [
            'NAME'    => 'order',
            'ACTIONS' => [
                'SYNCED' => 'synced',
            ]
        ],
        'DAMAGE'  => [
            'NAME'    => 'damage',
            'ACTIONS' => [
                'DAMAGE' => 'damage',
            ]
        ],
        'RETURN'  => [
            'NAME'    => 'return',
            'ACTIONS' => [
                'RETURN' => 'returned',
            ]
        ]
    ],
    'NOTIFICATION_STRING' => [
        'received' => '$resource received the items you $object',
        'synced'   => '$resource synced new order $object',
        'returned'   => '$resource $object the Products',
        'damage'   => '$resource sent back the $object products',
    ],
    'SHARE_URL' => [
    'SHARE'  => 'http://cartimatic.blueorcastudios.com/product/',
    ]
];
