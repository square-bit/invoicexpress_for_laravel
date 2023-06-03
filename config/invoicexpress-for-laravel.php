<?php

return [
    'account' => [
        'name' => env('IX_ACCOUNT_NAME'),
        'api_key' => env('IX_API_KEY'),
    ],
    'service_endpoint' => 'app.invoicexpress.com',
    'eloquent' => [
        'persist' => false,
    ],
];
