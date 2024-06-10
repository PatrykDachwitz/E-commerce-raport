<?php

namespace App\Http\Controllers;

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
        $path = storage_path('credentials\google_ads_php.ini');

        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->fromFile($path)
            ->build();

        $googleAdsClient = (new GoogleAdsClientBuilder())
            ->fromFile($path)
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        dd($this->runExample($googleAdsClient, ''));
    }

    public function runExample(GoogleAdsClient $googleAdsClient, int $customerId)
    {
        $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
        // Creates a query that retrieves all campaigns.
        $query = 'SELECT campaign.id, campaign.name FROM campaign ORDER BY campaign.id';
        // Issues a search stream request.
        /** @var GoogleAdsServerStreamDecorator $stream */
        $stream = $googleAdsServiceClient->searchStream(
            SearchGoogleAdsStreamRequest::build($customerId, $query)
        );

        // Iterates over all rows in all messages and prints the requested field values for
        // the campaign in each row.
        foreach ($stream->iterateAllElements() as $googleAdsRow) {
            /** @var GoogleAdsRow $googleAdsRow */
            printf(
                "Campaign with ID %d and name '%s' was found.%s",
                $googleAdsRow->getCampaign()->getId(),
                $googleAdsRow->getCampaign()->getName(),
                PHP_EOL
            );
        }
    }
}

