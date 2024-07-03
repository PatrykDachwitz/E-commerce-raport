<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;

abstract class AdwordsApi
{
    protected int $countDay;
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
        $data['click']['avgWithoutCurrent'] = intval($data['click']['summaryWithoutCurrent'] / $this->countDay);
        $data['budget']['avgWithoutCurrent'] = intval($data['budget']['summaryWithoutCurrent'] / $this->countDay);
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
        $currentMonth = date("m", strtotime($this->dateRanges['current']));
        $dateMonth = date("m", strtotime($date));

        if ($currentMonth === $dateMonth) return intval($value);
        else return 0;
    }

    abstract public function get(string $currentDate, string $lastDate, Country $country);

    protected function getMonthlyBudget() : int {
        $currentMonth = intval(date("m", strtotime($this->dateRanges['current'])));
        $currentYear = intval(date("Y", strtotime($this->dateRanges['current'])));

        return $this->country[$this->budgetNameColumn] * cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    }

    protected function calculateDateRanges(string $currentDate, string $lastDate) : void {
        $dateRanges = [];

        $timestampCurrentDay = strtotime($currentDate);
        $timestampLastDay = strtotime($lastDate);
        $this->countDay = ($timestampCurrentDay - $timestampLastDay) / (60 * 60 * 24);

        for ($i = 0 ;  $i < $this->countDay; $i++) {
            $dateRanges[] = date("Y-m-d", $timestampLastDay + (60 * 60 * 24 * $i));
        }

        $dateRanges["current"] = $currentDate;
        $this->dateRanges = $dateRanges;
    }

    protected function downloadResponseApi(string $idAccount) : array {
        $dataResponse = [];

        foreach ($this->dateRanges as $key => $date) {
            $dataResponse[$key] = $this->connectApi($date, $date, $idAccount);
        }

        return $dataResponse;
    }

    abstract protected function calculateResultApi(Country $country, string $currentDate, string $lastDate) : array;
    public function getNameColumnAdwords() : string {
        return $this->nameAdwordsColumn;
    }
}
