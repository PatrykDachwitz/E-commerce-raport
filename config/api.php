<?php
declare(strict_types=1);

return [
  'shop' => env("URL_API_SHOP", ""),

    //GOOGLE auth
    'pathGoogleToken' => storage_path('credentials\token-google.json'),
    'pathGoogleCredentials' => storage_path('credentials\credentials-google.json'),

    //Data auth dedicate Google Adwords
    'pathGoogleAdwordsToken' => storage_path('credentials\token-google-adwords.json'),
    'pathGoogleAdwordsCredentials' => storage_path('credentials\credentials-google-adwords.json'),

    'endPointAnalytics' => env('URL_ANALYTICS_API', "https://analyticsdata.googleapis.com"),
    'endPointGoogle' => env('URL_GOOGLE_API', "https://googleads.googleapis.com"),
    'endPointGoogleRefreshToken' => env('URL_GOOGLE_REFRESH_TOKEN', "https://oauth2.googleapis.com/token"),
    'endPointFacebook' => env('URL_FACEBOOK_API', "https://graph.facebook.com"),
];
