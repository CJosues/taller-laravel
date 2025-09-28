<?php
return [
    'map' => [
        'empresa1.tudominio.com' => env('TENANT_EMPRESA1_DB', 'empresa1_db'),
        'empresa2.tudominio.com' => env('TENANT_EMPRESA2_DB', 'empresa2_db'),
    ],
    'default' => env('TENANT_DEFAULT_DB', env('DB_DATABASE')),
];
