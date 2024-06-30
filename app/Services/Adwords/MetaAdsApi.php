<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class MetaAdsApi
{
    ///Dodać ilość kliknieć oraz budżet

    private array $dateRanges;
    private int $countDay;

    private Country $country;
    protected function getBodyApi() : string {
        return json_encode([
            "fields" => "impressions"
        ]);
    }

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

    protected function connectApi(string $startDate, string $endDate, string $idAccount) : array|null {
        $tokenMeta = env('DEVELOPER_TOKEN_FACEBOOK');

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {$tokenMeta}",
        ])
            ->get("https://graph.facebook.com/v20.0/act_{$idAccount}/insights?fields=clicks,spend&action_attribution_windows=['7d_click','1d_view']&time_range[since]={$startDate}&time_range[until]={$endDate}");


        if ($response->ok()) {
            return $response->json('data')[0];
        } else {
            return null;
        }
    }
    private function calculateDateRanges(string $currentDate, string $lastDate) : void {
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

    private function downloadResponseApi(string $idAccount) : array {
        $dataResponse = [];

        foreach ($this->dateRanges as $key => $date) {
            $dataResponse[$key] = $this->connectApi($date, $date, $idAccount);
        }

        return $dataResponse;
    }
    private function calculateResultApi(string $idAccount) : array {
        $dataResponseApi = $this->downloadResponseApi($idAccount);
        $structureResponse = $this->getStructureResponse();

        foreach ($dataResponseApi as $key => $data) {
            if (is_null($data)) {
                if ($key === "current") {
                    $structureResponse['click']['current'] = 0;
                    $structureResponse['budget']['current'] = 0;
                }
                continue;
            }
            if ($key === "current") {
                $structureResponse['click']['current'] = intval($data['clicks']);
                $structureResponse['budget']['current'] = intval($data['spend']);
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += intval($data['spend']);
            } else {
                $structureResponse['click']['summaryWithoutCurrent'] += intval($data['clicks']);
                $structureResponse['budget']['summaryWithoutCurrent'] += intval($data['spend']);
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += $this->addSpendBudgetCurrentMonth($this->dateRanges[$key], $data['spend']);

                $structureResponse['click']['minWithoutCurrent'] = $this->getMinValue($structureResponse, intval($data['clicks']), 'click');
                $structureResponse['budget']['minWithoutCurrent'] = $this->getMinValue($structureResponse, intval($data['spend']), 'budget');
                $structureResponse['click']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, intval($data['clicks']), 'click');
                $structureResponse['budget']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, intval($data['spend']), 'budget');
            }
        }

        if (is_null($structureResponse['click']['minWithoutCurrent'])) $structureResponse['click']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['minWithoutCurrent'])) $structureResponse['budget']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['click']['maxWithoutCurrent'])) $structureResponse['click']['maxWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['maxWithoutCurrent'])) $structureResponse['budget']['maxWithoutCurrent'] = 0;

        $structureResponse['budget']['budgetMonthly'] = $this->getMonthlyBudget();
        $structureResponse['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($structureResponse['budget']);

        return $this->calculateAvgWithComparison($structureResponse);
    }

    private function getMonthlyBudget() : int {
        $currentMonth = intval(date("m", strtotime($this->dateRanges['current'])));
        $currentYear = intval(date("Y", strtotime($this->dateRanges['current'])));

        return $this->country->facebook_daily_budget * cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    }

    private function getPercentSpendMonthlyBudget(array $data) : int {
        return intval($data['spentBudgetFromBeginningOfMonth'] / ($data['budgetMonthly'] / 100));
    }

    private function addSpendBudgetCurrentMonth(string $date, int|string $value) : int {
        $currentMonth = date("m", strtotime($this->dateRanges['current']));
        $dateMonth = date("m", strtotime($date));

        if ($currentMonth === $dateMonth) return intval($value);
        else return 0;
    }
    private function calculateAvgWithComparison(array $data) : array {
        $data['click']['avgWithoutCurrent'] = intval($data['click']['summaryWithoutCurrent'] / $this->countDay);
        $data['budget']['avgWithoutCurrent'] = intval($data['budget']['summaryWithoutCurrent'] / $this->countDay);
        $data['click']['avgComparisonWithoutCurrent'] = intval($data['click']['current'] - $data['click']['avgWithoutCurrent']);
        $data['budget']['avgComparisonWithoutCurrent'] = intval($data['budget']['current'] - $data['budget']['avgWithoutCurrent']);

        return $data;
    }

    private function getMaxValue(array $currentData, int $newValue, string $params) : int {
        if(is_null($currentData[$params]['maxWithoutCurrent']) | $currentData[$params]['maxWithoutCurrent'] < $newValue) {
            return $newValue;
        } else {
            return $currentData[$params]['maxWithoutCurrent'];
        }
    }
    private function getMinValue(array $currentData, int $newValue, string $params) : int {

        if(is_null($currentData[$params]['minWithoutCurrent']) | $currentData[$params]['minWithoutCurrent'] > $newValue) {
            return $newValue;
        }

        return $currentData[$params]['minWithoutCurrent'];
    }
    public function get(string $currentDate, string $lastDate, Country $country) : array {
        $this->calculateDateRanges($currentDate, $lastDate);
        $this->country = $country;

        return $this->calculateResultApi($country->facebook);
    }

}
