<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

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
            'summaryWithoutCurrent' => 0,
            'avgWithoutCurrent' => null,
            'maxWithoutCurrent' => null,
            'minWithoutCurrent' => null,
        ];


        if (!isset($data['rows'])) {
            $responseParams['min'] = 0;
            $responseParams['current'] = 0;
            $responseParams['max'] = 0;
            $responseParams['summaryWithoutCurrent'] = 0;
            $responseParams['maxWithoutCurrent'] = 0;
            $responseParams['minWithoutCurrent'] = 0;

            return $responseParams;
        }

        foreach ($data['rows'] as $row) {
            if ($row['dimensionValues'][1]['value'] === $customParams) {
                $valueEvent = intval($row['metricValues'][0]['value']);
                $responseParams['count'] += $valueEvent;

                if ($row['dimensionValues'][0]['value'] === $this->dateCurrent) {
                    $responseParams['current'] = $valueEvent;
                }

                if ($row['dimensionValues'][0]['value'] !== $this->dateCurrent) {
                    $responseParams['summaryWithoutCurrent'] += $valueEvent;
                    if (is_null($responseParams['minWithoutCurrent']) | $responseParams['minWithoutCurrent'] > $valueEvent) {
                        $responseParams['minWithoutCurrent'] = $valueEvent;
                    }

                    if (is_null($responseParams['maxWithoutCurrent']) | $responseParams['maxWithoutCurrent'] < $valueEvent) {
                        $responseParams['maxWithoutCurrent'] = $valueEvent;
                    }
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

    private function getCountDayInDate(string $startDate, string $endDate, int $addDay) : int {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        return intval(($endTime - $startTime) / (60 * 60 * 24) + $addDay);
    }

    private function avg(int|float $count, string $startDate, string $endDate, bool $withCurrentDay = false) : int | float {
        if (!$withCurrentDay) $addDay = 0;
        else $addDay = 1;

        $countDay = $this->getCountDayInDate($startDate, $endDate, $addDay);

        if ($count === 0 | is_null($count)) return 0;
        else return ($count / $countDay);
    }
    public function get(string $customParams, string $startDate, string $endDate) : array {
        $responseApi = $this->connectApi($startDate, $endDate);

        $dataCustomEvent = $this->searchCustomEventParams($responseApi, $customParams);
        $avgEvent = $this->avg($dataCustomEvent['count'], $startDate, $endDate, true);
        $avgWithoutCurrentValue = $this->avg($dataCustomEvent['summaryWithoutCurrent'], $startDate, $endDate);

        return [
            'current' => $dataCustomEvent['current'],
            'min' => $dataCustomEvent['min'],
            'max' => $dataCustomEvent['max'],
            'minWithoutCurrent' => $dataCustomEvent['minWithoutCurrent'],
            'maxWithoutCurrent' => $dataCustomEvent['maxWithoutCurrent'],
            'avg' => $avgEvent,
            'summaryWithoutCurrent' => $dataCustomEvent['summaryWithoutCurrent'],
            'avgWithoutCurrent' => $avgWithoutCurrentValue,
        ];
    }

    public function setDateCurrent(string $dateCurrent) : string {
        $this->dateCurrent = $dateCurrent;

        return $this->dateCurrent;
    }
}
