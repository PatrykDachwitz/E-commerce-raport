<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use App\Services\Connection\GoogleRefreshToken;
use Illuminate\Support\Facades\Http;

class AnalyticsApi
{

    use GoogleRefreshToken;

    private array $clickToRangesDate = [];
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
            ->post(config('api.endPointAnalytics') . "/v1beta/properties/{$this->propertiesCountry}:runReport");

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


    public function get(string $startDate, string $currentDay) : array {

        $responseApi = $this->connectApi($startDate, $currentDay);
        $this->setRangesDateBetween($currentDay, $startDate);

        if (isset($responseApi['rows'])) {
            $groupResponseApi = $this->groupResultApiByRangesDate($responseApi);
            $calculateData = $this->calculateDataGroupResponse($groupResponseApi);
            $countRows = count($this->rangesDate);
            $calculateData['avg'] = intval(($calculateData['summaryWithoutCurrent'] + $calculateData['current']) / $countRows);
            //-1 Count because is avg without date ranges "current"
            $calculateData['avgWithoutCurrent'] = intval($calculateData['summaryWithoutCurrent'] / ($countRows - 1));
        } else {

            $calculateData = $this->getStructureNeedData(false);
            $calculateData['avg'] = 0;
            $calculateData['avgWithoutCurrent'] = 0;
            $this->setClickToRangesEmptyResponse();
        }


        $calculateData['dataByRangesWithoutCurrent'] = $this->clickToRangesDate;
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
    private function setRangesDateByRanges(array $currentDate, array $otherRangesDate) : void {

        $this->rangesDate = array_merge([
            "current" => $currentDate
        ], $otherRangesDate);
    }

    private function setRangesDateBetween(string $currentDate, string $firstDay) : void {
        $this->rangesDate = [];
        $oneDayInSecond = 24 * 60 * 60;
        $currentReportTime = strtotime($currentDate);

        for ($time = strtotime($firstDay); $time < $currentReportTime; $time += $oneDayInSecond) {
            $date = date("Y-m-d", $time);

            $this->rangesDate[] = [
                'start' => $date,
                'end' => $date
            ];
        }

        $this->rangesDate['current'] = [
            'start' => $currentDate,
            'end' => $currentDate
        ];
    }

    private function completeDataRangesWhenNotHaveDataApi(array $data) :array {
        foreach ($this->rangesDate as $key => $date) {
            if (!isset($data[$key])) {
                $data[$key] = 0;
            }
        }

        return $data;
    }
    private function groupResultApiByRangesDate(array $data) : array {
        $response = [];

        foreach ($data['rows'] as $row) {

            $date = $row['dimensionValues'][0]['value'];
            $click = intval($row['metricValues'][0]['value']);
            $keyDate = $this->getKeyRangesDate($date);

            if(is_null($keyDate)) continue;

            if (!isset($response[$keyDate])) {
                $response[$keyDate] = $click;
            } else {
                $response[$keyDate] += $click;
            }
        }

        return $this->completeDataRangesWhenNotHaveDataApi($response);
    }


    private function getDateByKeyDateRanges(int $key) : string {
        return "{$this->rangesDate[$key]['start']}_{$this->rangesDate[$key]['end']}";
    }
    private function setClickToRangesDate(string|int $key, int|string|null $click) {

        if ($key !== "current") {
            $keyRanges = $this->getDateByKeyDateRanges($key);
            $this->clickToRangesDate[$keyRanges]['click'] = $click;
        } else {
            $this->clickToRangesDate['current']['click'] = $click;
        }
    }
    private function calculateDataGroupResponse(array $data) : array {

        $responseParams = $this->getStructureNeedData();

        foreach ($data as $key => $item) {
            $this->setClickToRangesDate($key, $item);
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

    private function setClickToRangesEmptyResponse() : void {
        $this->clickToRangesDate["current"]['click'] = 0;

        foreach ($this->rangesDate as $key => $date) {
            if ($key === "current") continue;
            $keyName = "{$date['start']}_{$date['end']}";
            $this->clickToRangesDate[$keyName]['click'] = 0;
        }
    }

    public function getWithManyRangesDate(array $currentRangeDate, array $otherRangeDates) : array {
        $date = $this->getNewestAndOldestDate($currentRangeDate, $otherRangeDates);
        $responseApi = $this->connectApi($date['oldest'], $date['newest']);
        $this->setRangesDateByRanges($currentRangeDate, $otherRangeDates);

        if (isset($responseApi['rows'])) {
            $groupResponseApi = $this->groupResultApiByRangesDate($responseApi);
            $calculateData = $this->calculateDataGroupResponse($groupResponseApi);
            $countRows = count($this->rangesDate);
            $calculateData['avg'] = intval(($calculateData['summaryWithoutCurrent'] + $calculateData['current']) / $countRows);
            //-1 Count because is avg without date ranges "current"
            $calculateData['avgWithoutCurrent'] = intval($calculateData['summaryWithoutCurrent'] / ($countRows - 1));
        } else {
            $calculateData = $this->getStructureNeedData(false);
            $calculateData['avg'] = 0;
            $calculateData['avgWithoutCurrent'] = 0;
            $this->setClickToRangesEmptyResponse();
        }

        $calculateData['dataByRangesWithoutCurrent'] = $this->clickToRangesDate;
        return $calculateData;
    }

    public function setDateCurrent(string $dateCurrent) : string {
        $this->dateCurrent = $dateCurrent;

        return $this->dateCurrent;
    }
}
