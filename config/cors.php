<?php



    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
  
    */
    return [
        'paths' => [
            'api/*', 
             'oauth/*',
             '/login',
             '/logout',
             '/sanctum/csrf-cookie'
              ],

        'allowed_methods' => ['*'],
        'allowed_origins' => ['http://localhost:5173'],
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['*'],
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => true,
    ];
    
    