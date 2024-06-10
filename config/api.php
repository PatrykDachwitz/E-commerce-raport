<?php
declare(strict_types=1);

return [
  'shop' => env("URL_API_SHOP", null),

    //GOOGLE ADS
    'googleAdsToken' => storage_path('credentials\token-google-ads.json'),
    'googleAdsCredentials' => storage_path('credentials\credentials-google-ads.json'),
];
