<?php

return [

    // ✅ Fixed typo: "clint_id" → "client_id"
    'client_id' => 'Ace4Drv46cuSrCr2NVhDN2fTTmot8x9mfrqY4xg9KpR3keUjJg8wUS4NjsiV5vUzthDVx_x8AgBClRdZ',

    'secret' => 'EPeVHfg7LumzCvVEJj0xedPsRw8vy9Mf79HngQYzsyQMu7Obl-lSvXwrWjIX8gzZy00yegV3Lh7e2B40',

    // ✅ Fixed typo: "settimgs" → "settings"
    'settings' => [
        'mode' => 'sandbox', // or 'live'
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'FINE', // You can also use 'DEBUG', 'ERROR', etc.
    ],

];
