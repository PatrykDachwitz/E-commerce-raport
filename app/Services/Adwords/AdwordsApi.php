<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;

abstract class AdwordsApi
{


    protected array $dataPerDate;
    protected int $countDayWithoutCurrent;
    protected array $dateRanges;

    protected string $budgetNameColumn;
    protected string $nameAdwordsColumn;

    protected Country $country;
    protected function getStructureResponse(bool $rowsExists = true) : array {
        return [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => $rowsExists ? null : 0,
                "maxWithoutCurrent" => $rowsExists ? null : 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => $rowsExists ? null : 0,
                "maxWithoutCurrent" => $rowsExists ? null : 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ]
        ];
    }
    protected function getPercentSpendMonthlyBudget(array $data) : int {
        if ($data['budgetMonthly'] <= 0) return 100;
        else return intval($data['spentBudgetFromBeginningOfMonth'] / ($data['budgetMonthly'] / 100));
    }
    protected function calculateAvgWithComparison(array $data) : array {
        $data['click']['avgWithoutCurrent'] = intval($data['click']['summaryWithoutCurrent'] / $this->countDayWithoutCurrent);
        $data['budget']['avgWithoutCurrent'] = intval($data['budget']['summaryWithoutCurrent'] / $this->countDayWithoutCurrent);
        $data['click']['avgComparisonWithoutCurrent'] = intval($data['click']['current'] - $data['click']['avgWithoutCurrent']);
        $data['budget']['avgComparisonWithoutCurrent'] = intval($data['budget']['current'] - $data['budget']['avgWithoutCurrent']);

        return $data;
    }

    protected function getMaxValue(array $currentData, int $newValue, string $params) : int {
        if(is_null($currentData[$params]['maxWithoutCurrent']) | $currentData[$params]['maxWithoutCurrent'] < $newValue) {
            return $newValue;
        } else {
            return $currentData[$params]['maxWithoutCurrent'];
        }
    }
    protected function getMinValue(array $currentData, int $newValue, string $params) : int {

        if(is_null($currentData[$params]['minWithoutCurrent']) | $currentData[$params]['minWithoutCurrent'] > $newValue) {
            return $newValue;
        }

        return $currentData[$params]['minWithoutCurrent'];
    }

    protected function addSpendBudgetCurrentMonth(string $date, int|string $value) : int {
        $currentMonth = date("m", strtotime($this->dateRanges['current']['start']));
        $dateMonth = date("m", intval(strtotime($date)));

        if ($currentMonth === $dateMonth) return intval($value);
        else return 0;
    }

    abstract public function get(string $currentDate, string $lastDate, Country $country);

    protected function getMonthlyBudget() : int {
        $date = strtotime($this->dateRanges['current']['start']);
        $currentMonth = intval(date("m", $date));
        $currentYear = intval(date("Y", $date));

        return $this->country[$this->budgetNameColumn] * cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    }

    protected function calculateDateRanges(string $currentDate, string $lastDate) : void {
        $dateRanges = [];

        $timestampCurrentDay = strtotime($currentDate);
        $timestampLastDay = strtotime($lastDate);
        $this->countDayWithoutCurrent = ($timestampCurrentDay - $timestampLastDay) / (60 * 60 * 24);

        for ($i = 0 ;  $i < $this->countDayWithoutCurrent; $i++) {
            $dateGenerated = date("Y-m-d", $timestampLastDay + (60 * 60 * 24 * $i));
            $dateRanges[] = [
                "start" => $dateGenerated,
                "end" => $dateGenerated
            ];
        }

        $dateRanges["current"] = [
            "start" => $currentDate,
            "end" => $currentDate
        ];
        $this->dateRanges = $dateRanges;
    }

    protected function getEmptyDataByRangesDate() : array {
        $response = [];

        foreach ($this->dateRanges as $key => $date) {
            $convertResponse = $this->convertForResponseDataRanges($key, 0, 0);

            $response[$convertResponse['date']] = $convertResponse['data'];

        }

        return $response;
    }

    protected function convertForResponseDataRanges(string|int $keyDateRanges, int $spend, int $click) : array {
        if ($keyDateRanges === "current") {
            $dateRanges = "current";
        } else {
            $dateRanges = "{$this->dateRanges[$keyDateRanges]['start']}_{$this->dateRanges[$keyDateRanges]['end']}";
        }

        return [
            "date" => $dateRanges,
            "data" => [
                'click' => $click,
                'spend' => $spend,
            ]
        ];
    }
    protected function downloadResponseApi(string $idAccount) : array {
        $dataResponse = [];

        foreach ($this->dateRanges as $key => $date) {
            $dataResponse[$key] = $this->connectApi($date['start'], $date['end'], $idAccount);
        }

        return $dataResponse;
    }

    abstract protected function calculateResultApi(Country $country, string $currentDate, string $lastDate) : array;
    public function getNameColumnAdwords() : string {
        return $this->nameAdwordsColumn;
    }

    protected function addManyRangesDate(array $currentDate, array $rangesOtherDate) : void {
        $dateRanges = [];
        $this->countDayWithoutCurrent = count($rangesOtherDate);

        foreach ($rangesOtherDate as $otherDate) {
            $dateRanges[] = [
                "start" => $otherDate['start'],
                "end" => $otherDate['end']
            ];
        }

        $dateRanges["current"] = [
            "start" => $currentDate['start'],
            "end" => $currentDate['end']
        ];

        $this->dateRanges = $dateRanges;
    }


    protected function setDataPerDate(string|int $cost, string|int $click, string $date) : void {
        $this->dataPerDate[$date] = [
            'cost' => intval($cost),
            'click' => intval($click)
        ];
    }

    protected function getSpendBudgetInCurrentMonth(Country $country, string $dateCurrent) : int {
        $currentYearWithMonth = date("Y-m", strtotime($dateCurrent));
        $startDay = "{$currentYearWithMonth}-01";

        $result = $this->connectApi($startDay, $dateCurrent, $country[$this->nameAdwordsColumn]);

        if (is_null($result)) return 0;
        return intval($result['spend']);
    }

    abstract public function getWithManyRangesDate(array $currentDate, array $rangesOtherDate, Country $country) : array;
}
