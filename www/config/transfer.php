<?php

return [
    'auth_endpoint' => env('TRANSACTION_AUTH_ENDPOINT'),
    'auth_retry' => env('TRANSACTION_AUTH_RETRY', 3),
    'auth_retry_wait' => env('TRANSACTION_AUTH_RETRY_WAIT', 1000),
];
