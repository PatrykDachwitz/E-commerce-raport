<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class AnalyticsApi
{

    private string $propertiesCountry, $dateCurrent;
    public function setCountry(Country $country) : string {
        $this->propertiesCountry = $country->analytics ?? "";

        return $this->propertiesCountry;
    }
    private function getAccessToken() : string {
        $accessTokenPath = config('api.pathGoogleToken');
        $contentToken = json_decode(file_get_contents($accessTokenPath));

        return $contentToken->access_token;
    }
    private function connectApi(string $startDate, string $endDate) {
        $bodyQuery = $this->getDataBodyQuery($startDate, $endDate);
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Accept' => "application/json",
            'Content-Type' => "application/json",
        ])
            ->withBody($bodyQuery)
            ->post("https://analyticsdata.googleapis.com/v1beta/properties/{$this->propertiesCountry}:runReport");

        return $response->json();
    }

    private function getDataBodyQuery(string $startDate, string $endDate) : string {

        $bodyQuery = [
            'dateRanges' => [
                "startDate" => $startDate,
                "endDate" => $endDate
            ],
            'metrics' => [
                [
                    "name" => "eventCount"
                ]
            ],
            "keepEmptyRows" => true,
            "dimensions" => [
                [
                    "name" => 'date'
                ],
                [
                    "name" => 'eventName'
                ],
            ]
        ];

        return json_encode($bodyQuery);
    }

    private function searchCustomEventParams(array $data, string $customParams) {
        $responseParams = [
            'min' => null,
            'current' => null,
            'max' => null,
            'count' => 0,
        ];


        if (!isset($data['rows'])) {
            $responseParams['min'] = 0;
            $responseParams['current'] = 0;
            $responseParams['max'] = 0;

            return $responseParams;
        }

        foreach ($data['rows'] as $row) {
            if ($row['dimensionValues'][1]['value'] === $customParams) {
                $valueEvent = intval($row['metricValues'][0]['value']);
                $responseParams['count'] += $valueEvent;

                if ($row['dimensionValues'][0]['value'] === $this->dateCurrent) {
                    $responseParams['current'] = $valueEvent;
                }

                if (is_null($responseParams['min']) | $responseParams['min'] > $valueEvent) {
                    $responseParams['min'] = $valueEvent;
                }

                if (is_null($responseParams['max']) | $responseParams['max'] < $valueEvent) {
                    $responseParams['max'] = $valueEvent;
                }
            }
        }

        return $responseParams;
    }

    private function getCountDayInDate(string $startDate, string $endDate) : int {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        return intval(($endTime - $startTime) / (60 * 60 * 24) + 1);
    }

    private function avg(int|float $count, string $startDate, string $endDate) : int | float {
        $countDay = $this->getCountDayInDate($startDate, $endDate);

        if ($count === 0 | is_null($count)) return 0;
        else return ($count / $countDay);
    }
    public function get(string $customParams, string $startDate, string $endDate) : array {
        $responseApi = $this->connectApi($startDate, $endDate);

        $dataCustomEvent = $this->searchCustomEventParams($responseApi, $customParams);
        $avgEvent = $this->avg($dataCustomEvent['count'], $startDate, $endDate);


        $response = [
            'current' => $dataCustomEvent['current'],
            'min' => $dataCustomEvent['min'],
            'max' => $dataCustomEvent['max'],
            'avg' => $avgEvent,
        ];

        return $response;
    }

    public function setDateCurrent(string $dateCurrent) : string {
        $this->dateCurrent = $dateCurrent;

        return $this->dateCurrent;
    }
}
