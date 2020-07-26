<?php

use App\Models\Product;

return [

    'host'  => env('SEARCH_HOST', 'localhost'),
    'port'  => env('SEARCH_PORT', 9200),
    'index' => env('SEARCH_INDEX', 'eshop'),
    'fuzziness' => env('SEARCH_FUZZINESS', true),
    'repository' => env('SEARCH_REPOSITORY', false),

    'types' => [
        'product' => Product::class,
    ],

];
