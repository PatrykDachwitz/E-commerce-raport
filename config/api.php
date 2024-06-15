<?php
declare(strict_types=1);

return [
  'shop' => env("URL_API_SHOP", null),

    //GOOGLE auth
    'pathGoogleToken' => storage_path('credentials\token-google.json'),
    'pathGoogleCredentials' => storage_path('credentials\credentials-google.json'),

    //Data auth dedicate Google Adwords
    'pathGoogleAdwordsToken' => storage_path('credentials\token-google-adwords.json'),
    'pathGoogleAdwordsCredentials' => storage_path('credentials\credentials-google-adwords.json'),

    'endPointAnalytics' => "https://analyticsdata.googleapis.com",
];
