<?php

return [
    'environment' => env('BTREE_ENV', 'sandbox'),
    'merchantId' => env('BTREE_MERCHANT_ID', false),
    'publicKey' => env('BTREE_PUBLIC_KEY', false),
    'privateKey' => env('BTREE_PRIVATE_KEY', false)
];