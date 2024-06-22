<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use Illuminate\Support\Facades\Http;

class AdwordsApi
{

    private function getBodyQuery() : string {
        $query = [
            "query" => 'SELECT campaign.id, metrics.clicks FROM campaign WHERE segments.date > "2020-01-01" AND segments.date < "2020-02-01"'
        ];

        return json_encode($query);
    }

    private function getAccessToken() : string {
        $pathToken = config('api.pathGoogleAdwordsToken');
        $contentToken = file_get_contents($pathToken);

        return json_decode($contentToken)->access_token;
    }

    public function connectApi($loginCustomer, $idCompany) {
        $bodyQuery = $this->getBodyQuery();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $this->getAccessToken(),
            "Content-Type" => "application/json",
            "developer-token" => env('DEVELOPER_TOKEN_GOOGLE'),
            "login-customer-id" => $loginCustomer,
        ])
            ->withBody($bodyQuery)
            ->post("https://googleads.googleapis.com/v16/customers/{$$idCompany}/googleAds:searchStream");

        return $response->json();
    }


}
