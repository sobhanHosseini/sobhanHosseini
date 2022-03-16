<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],


        'public/92' => [
            'driver' => 'local',
            'root' => storage_path('app/public/آذربايجان شرقي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/93' => [
            'driver' => 'local',
            'root' => storage_path('app/public/آذربايجان غربي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/94' => [
            'driver' => 'local',
            'root' => storage_path('app/public/اردبيل'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/95' => [
            'driver' => 'local',
            'root' => storage_path('app/public/اصفهان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/97' => [
            'driver' => 'local',
            'root' => storage_path('app/public/خراسان جنوبي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/98' => [
            'driver' => 'local',
            'root' => storage_path('app/public/فارس'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/99' => [
            'driver' => 'local',
            'root' => storage_path('app/public/خراسان شمالي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/100' => [
            'driver' => 'local',
            'root' => storage_path('app/public/ايلام'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/101' => [
            'driver' => 'local',
            'root' => storage_path('app/public/بوشهر'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/102' => [
            'driver' => 'local',
            'root' => storage_path('app/public/تهران'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/103' => [
            'driver' => 'local',
            'root' => storage_path('app/public/چهارمحال وبختياري'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/104' => [
            'driver' => 'local',
            'root' => storage_path('app/public/خراسان رضوي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/105' => [
            'driver' => 'local',
            'root' => storage_path('app/public/خوزستان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/106' => [
            'driver' => 'local',
            'root' => storage_path('app/public/زنجان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/107' => [
            'driver' => 'local',
            'root' => storage_path('app/public/سمنان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/108' => [
            'driver' => 'local',
            'root' => storage_path('app/public/سيستان و بلوچستان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/109' => [
            'driver' => 'local',
            'root' => storage_path('app/public/قزوين'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/110' => [
            'driver' => 'local',
            'root' => storage_path('app/public/قم'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/111' => [
            'driver' => 'local',
            'root' => storage_path('app/public/كردستان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/112' => [
            'driver' => 'local',
            'root' => storage_path('app/public/كرمان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/113' => [
            'driver' => 'local',
            'root' => storage_path('app/public/كرمانشاه'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/114' => [
            'driver' => 'local',
            'root' => storage_path('app/public/كهگيلويه وبويراحمد'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/115' => [
            'driver' => 'local',
            'root' => storage_path('app/public/گلستان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/116' => [
            'driver' => 'local',
            'root' => storage_path('app/public/گيلان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/117' => [
            'driver' => 'local',
            'root' => storage_path('app/public/لرستان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/118' => [
            'driver' => 'local',
            'root' => storage_path('app/public/مازندران'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/119' => [
            'driver' => 'local',
            'root' => storage_path('app/public/مركزي'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/120' => [
            'driver' => 'local',
            'root' => storage_path('app/public/هرمزگان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/121' => [
            'driver' => 'local',
            'root' => storage_path('app/public/همدان'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/122' => [
            'driver' => 'local',
            'root' => storage_path('app/public/يزد'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/125' => [
            'driver' => 'local',
            'root' => storage_path('app/public/البرز'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'public/126' => [
            'driver' => 'local',
            'root' => storage_path('app/public/خارج ازكشور'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
