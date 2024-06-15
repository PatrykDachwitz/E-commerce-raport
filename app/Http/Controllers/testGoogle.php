<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use Database\Seeders\CountrySeeder;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsServerStreamDecorator;
use Google\Ads\GoogleAds\V16\Services\GoogleAdsRow;
use Google\Ads\GoogleAds\V16\Services\SearchGoogleAdsStreamRequest;
use Illuminate\Http\Request;

class testGoogle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {



    }
}

