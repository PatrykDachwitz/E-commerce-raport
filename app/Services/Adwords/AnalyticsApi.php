<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use App\Services\Connection\GoogleRefreshToken;
use Illuminate\Support\Facades\Http;

class AnalyticsApi
{

    use GoogleRefreshToken;

    const NAME_CONFIG_CREDENTIALS = "api.pathGoogleCredentials";
    CONST NAME_CONFIG_TOKEN = "api.pathGoogleToken";
    private string $propertiesCountry, $dateCurrent;
    private array $rangesDate;
    public function setCountry(Country $country) : string {
        $this->propertiesCountry = $country->analytics ?? "";

        return $this->propertiesCountry;
    }

    public function connectApi(string $startDate, string $endDate) {
        $bodyQuery = $this->getDataBodyQuery($startDate, $endDate);

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $this->getAccessToken(self::NAME_CONFIG_CREDENTIALS, self::NAME_CONFIG_TOKEN),
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
                    "name" => "totalUsers"
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

    private function getNewestDate(string $currentDate, string $newDate) : string {
        $currentDateTimestamp = strtotime($currentDate);
        $newDateTimestamp = strtotime($newDate);

        if ($newDateTimestamp  > $currentDateTimestamp) {
            return $newDate;
        } else {
            return $currentDate;
        }
    }
    private function getOldestDate(string $currentDate, string $newDate) : string {
        $currentDateTimestamp = strtotime($currentDate);
        $newDateTimestamp = strtotime($newDate);

        if ($newDateTimestamp < $currentDateTimestamp) {
            return $newDate;
        } else {
            return $currentDate;
        }
    }
    private function getNewestAndOldestDate(array $date, array $secondDate) : array {
        $newest = $date['end'];
        $oldest = $date['start'];

        foreach ($secondDate as $item) {
            $newest = $this->getNewestDate($newest, $item['start']);
            $newest = $this->getNewestDate($newest, $item['end']);

            $oldest = $this->getOldestDate($oldest, $item['start']);
            $oldest = $this->getOldestDate($oldest, $item['end']);
        }

        return [
            "newest" => $newest,
            "oldest" => $oldest,
        ];
    }

    private function getKeyRangesDate(string $date) : string|int|null {
        $responseKey = null;
        $timeCheck = intval(str_replace("-", "", $date));

        foreach ($this->rangesDate as $key => $rangesDate) {

            $timeEnd = intval(str_replace("-", "", $rangesDate['end']));
            $timeStart = intval(str_replace("-", "", $rangesDate['start']));

           if ($timeCheck >= $timeStart && $timeCheck <= $timeEnd) {
                $responseKey = $key;
                break;
            }
        }

        return $responseKey;
    }
    private function setRangesDate(array $currentDate, array $otherRangesDate) : void {

        $this->rangesDate = array_merge([
            "current" => $currentDate
        ], $otherRangesDate);

    }

    private function completeDataRangesWhenNotHaveDataApi(array $data) :array {
        foreach ($this->rangesDate as $key => $date) {
            if (!isset($data[$key])) {
                $data[$key] = 0;
            }
        }

        return $data;
    }
    private function groupResultApiByRangesDate(array $data, array $currentDate, array $otherDate) : array {
        $response = [];
        $this->setRangesDate($currentDate, $otherDate);

        foreach ($data['rows'] as $row) {
            $keyDate = $this->getKeyRangesDate($row['dimensionValues'][0]['value']);

            if(is_null($keyDate)) continue;

            if (!isset($response[$keyDate])) {
                $response[$keyDate] = intval($row['metricValues'][0]['value']);
            } else {
                $response[$keyDate] += intval($row['metricValues'][0]['value']);
            }
        }

        return $this->completeDataRangesWhenNotHaveDataApi($response);
    }

    private function calculateDataGroupResponse(array $data) : array {

        $responseParams = $this->getStructureNeedData();

        foreach ($data as $key => $item) {

            if ($key === "current") {
                $responseParams['current'] = $item;
            } else {
                $responseParams['summaryWithoutCurrent'] += $item;

                if (is_null($responseParams['minWithoutCurrent']) | $responseParams['minWithoutCurrent'] > $item) {
                    $responseParams['minWithoutCurrent'] = $item;
                }

                if (is_null($responseParams['maxWithoutCurrent']) | $responseParams['maxWithoutCurrent'] < $item) {
                    $responseParams['maxWithoutCurrent'] = $item;
                }

            }

            if (is_null($responseParams['min']) | $responseParams['min'] > $item) {
                $responseParams['min'] = $item;
            }

            if (is_null($responseParams['max']) | $responseParams['max'] < $item) {
                $responseParams['max'] = $item;
            }

        }

        return $responseParams;
    }

    public function getWithManyRangesDate(array $currentRangeDate, array $otherRangeDates) : array {
        $date = $this->getNewestAndOldestDate($currentRangeDate, $otherRangeDates);

        $responseApi = $this->connectApi($date['oldest'], $date['newest']);

        if (isset($responseApi['rows'])) {
            $groupResponseApi = $this->groupResultApiByRangesDate($responseApi, $currentRangeDate, $otherRangeDates);
            $calculateData = $this->calculateDataGroupResponse($groupResponseApi);
            $countRows = count($this->rangesDate);
            $calculateData['avg'] = intval(($calculateData['summaryWithoutCurrent'] + $calculateData['current']) / $countRows);
            //-1 Count because is avg without date ranges "current"
            $calculateData['avgWithoutCurrent'] = intval($calculateData['summaryWithoutCurrent'] / ($countRows - 1));
        } else {
            $calculateData = $this->getStructureNeedData(false);
            $calculateData['avg'] = 0;
            $calculateData['avgWithoutCurrent'] = 0;
        }

        return $calculateData;
    }

    public function setDateCurrent(string $dateCurrent) : string {
        $this->dateCurrent = $dateCurrent;

        return $this->dateCurrent;
    }
}
