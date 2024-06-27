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
    public function connectApi(string $startDate, string $endDate) {
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

        return json_encode([
            'dateRanges' => [
                "startDate" => $startDate,
                "endDate" => $endDate
            ],
            'metrics' => [
                [
                    "name" => "activeUsers"
                ]
            ],
            "keepEmptyRows" => true,
            "dimensions" => [
                [
                    "name" => 'date'
                ],
            ]
        ]);

    }

    private function getStructureNeedData(bool $rowExists = true) : array {
        return [
            'min' => $rowExists ? null : 0,
            'current' => $rowExists ? null : 0,
            'max' => $rowExists ? null : 0,
            'count' => 0,
            'summaryWithoutCurrent' => 0,
            'maxWithoutCurrent' => $rowExists ? null : 0,
            'minWithoutCurrent' => $rowExists ? null : 0,
        ];
    }
    private function calculateData(array $data) : array {

        $responseParams = $this->getStructureNeedData();

        foreach ($data['rows'] as $row) {

            $valueEvent = intval($row['metricValues'][0]['value']);
            $responseParams['count'] += $valueEvent;

            if ($row['dimensionValues'][0]['value'] === $this->dateCurrent) {
                $responseParams['current'] = $valueEvent;
            } else {
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
    public function get(string $startDate, string $endDate) : array {
        $responseApi = $this->connectApi($startDate, $endDate);

        if (!isset($responseApi['rows'])) {
            $calculateData = $this->getStructureNeedData(false);
        } else {
            $calculateData = $this->calculateData($responseApi);
        }

        $calculateData['avg'] = $this->avg($calculateData['count'], $startDate, $endDate, true);
        $calculateData['avgWithoutCurrent'] = $this->avg($calculateData['summaryWithoutCurrent'], $startDate, $endDate);

        return $calculateData;
    }

    public function setDateCurrent(string $dateCurrent) : string {
        $this->dateCurrent = $dateCurrent;

        return $this->dateCurrent;
    }
}
