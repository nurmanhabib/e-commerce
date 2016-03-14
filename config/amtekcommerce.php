<?php

return [
    'name'      => 'AmtekCommerce',
    'slogan'    => 'Online Marketplace',
    'logo'      => 'assets/images/logo_light.png',
    'code'      => 'AMC',
    'social'    => [
        'facebook'  => [
            'link'  => null,
        ],
        'instagram'  => [
            'link'  => null,
        ],
    ],
    
    'email'     => [
        'from'  => [
            'email' => 'no-reply@amtekcommerce.com',
            'name'  => 'AmtekCommerce',
        ],
    ],

    'register'  => [
        'validation'    => [
            'username'  => ['required', 'min:5', 'max:20'],
            'password'  => ['required', 'min:8'],
        ]
    ],

    'transaction'   => [
        'payment'   => ['due' => 3 * 60], // dalam menit
    ],

    'socialauth'    => [
        'facebook'  => [
            'api'       => ['value' => null, 'autoload' => false],
            'token'     => ['value' => null, 'autoload' => false],
            'secret'    => ['value' => null, 'autoload' => false],
        ],

        'twitter'   => [
            'api'       => ['value' => null, 'autoload' => false],
            'token'     => ['value' => null, 'autoload' => false],
            'secret'    => ['value' => null, 'autoload' => false],
        ],

        'google'    => [
            'api'       => ['value' => null, 'autoload' => false],
            'token'     => ['value' => null, 'autoload' => false],
            'secret'    => ['value' => null, 'autoload' => false],
        ],

        'instagram' => [
            'api'       => ['value' => null, 'autoload' => false],
            'token'     => ['value' => null, 'autoload' => false],
            'secret'    => ['value' => null, 'autoload' => false],
        ],

        'line'      => [
            'api'       => ['value' => null, 'autoload' => false],
            'token'     => ['value' => null, 'autoload' => false],
            'secret'    => ['value' => null, 'autoload' => false],
        ],
    ],
];