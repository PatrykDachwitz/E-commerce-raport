<?php
declare(strict_types=1);

return [
  'shop' => env("URL_API_SHOP", null),

    //GOOGLE auth
    'pathGoogleToken' => storage_path('credentials\token-google.json'),
    'pathGoogleCredentials' => storage_path('credentials\credentials-google.json'),

    'endPointAnalytics' => "https://analyticsdata.googleapis.com"
];
