<?php
declare(strict_types=1);
namespace App\Services\Report\Support;

use App\Services\Adwords\AdwordsApi;
use Illuminate\Database\Eloquent\Collection;

class AdwordsResult
{

    private int $countDates;
    private array $summaryResult = [];
    private function calculateSummaryRow(array $data, string $currentDate) : array {

        $summary = $this->getEmptyStructureResponse($currentDate);

        $finallyData = $data;

        foreach ($data as $key => $item) {

            $summary['click']['countClick']['value'] += $item['click']['countClick']['value'];
            $summary['click']['minValueLast30Day']['value'] += $item['click']['minValueLast30Day']['value'];
            $summary['click']['maxValueLast30Day']['value'] += $item['click']['maxValueLast30Day']['value'];
            $summary['budget']['cost']['value'] += $item['budget']['cost']['value'];
            $summary['budget']['minValueLast30Day']['value'] += $item['budget']['minValueLast30Day']['value'];
            $summary['budget']['maxValueLast30Day']['value'] += $item['budget']['maxValueLast30Day']['value'];
            $summary['budget']['costFromBeginningMonth']['value'] += $item['budget']['costFromBeginningMonth']['value'];
            $summary['budget']['budgetMonth']['value'] += $item['budget']['budgetMonth']['value'];
            $summary['budget']['summaryWithoutCurrent']['value'] += $item['budget']['summaryWithoutCurrent']['value'];
            $summary['click']['summaryWithoutCurrent']['value'] += $item['click']['summaryWithoutCurrent']['value'];
            unset($finallyData[$key]['click']['summaryWithoutCurrent']);
            unset($finallyData[$key]['budget']['summaryWithoutCurrent']);
        }

        $finallyData['summary'] = $this->getAvgWithComparisonFacebook($summary);
        $finallyData['summary']['budget']['percentCostFromBeginningMonth']['value'] = $this->getPercentSendBudgetMonthly($summary);

        return $finallyData;
    }

    private function returnSmallerValue(int|null $currentValue, int|null $newValue) : int {
        if (is_null($currentValue)) return $newValue;
        else {
            if ($currentValue > $newValue) {
                return $newValue;
            } else {
                return  $currentValue;
            }
        }
    }
    private function returnBiggerValue(int|null $currentValue, int|null $newValue) : int {
        if (is_null($currentValue)) return $newValue;
        else {
            if ($newValue > $currentValue) {
                return $newValue;
            } else {
                return  $currentValue;
            }
        }
    }
    private function getMinAndMaxSummarySpendAndClick() : array {
        $minClick = null;
        $maxClick = null;
        $minSpend = null;
        $maxSpend = null;
        foreach ($this->summaryResult as $key => $data) {
            if ($key === "current") continue;

            $minClick = $this->returnSmallerValue($minClick, $data['click']);
            $minSpend = $this->returnSmallerValue($minSpend, $data['spend']);
            $maxClick = $this->returnBiggerValue($maxClick, $data['click']);
            $maxSpend = $this->returnBiggerValue($maxSpend, $data['spend']);

        }
        return [
            'click' => [
                'min' => $minClick,
                "max" => $maxClick
            ],
            "spend" => [
                'min' => $minSpend,
                "max" => $maxSpend
            ]
        ];
    }

    private function returnMonthlyBudgetWithSpendBudgetOnBeginMonthly(array $data) {
        $budget = 0;
        $spendBudget = 0;

        foreach ($data as $item) {
            $budget += $item['budget']['budgetMonth']['value'];
            $spendBudget += $item['budget']['costFromBeginningMonth']['value'];
        }

        return [
            'budget' => $budget,
            'spendBudget' => $spendBudget,
        ];
    }
    private function calculateSummaryRowNewsetOptionWithManyRow(array $data, string $currentDate) : array {

        $minMaxValueSummary = $this->getMinAndMaxSummarySpendAndClick();
        $monthlyBudget = $this->returnMonthlyBudgetWithSpendBudgetOnBeginMonthly($data);

        $data['summary']['click']['minValueLast30Day']['value'] = $minMaxValueSummary['click']['min'];
        $data['summary']['budget']['minValueLast30Day']['value'] = $minMaxValueSummary['spend']['min'];
        $data['summary']['click']['maxValueLast30Day']['value'] = $minMaxValueSummary['click']['max'];
        $data['summary']['budget']['maxValueLast30Day']['value'] = $minMaxValueSummary['spend']['max'];
        $data['summary']['click']['countClick']['value'] = $this->summaryResult['current']['click'];
        $data['summary']['budget']['cost']['value'] = $this->summaryResult['current']['spend'];
        $data['summary']['budget']['budgetMonth']['value'] = $monthlyBudget['budget'];
        $data['summary']['budget']['costFromBeginningMonth']['value'] = $monthlyBudget['spendBudget'];
        $data['summary']['budget']['percentDaysPassedInCurrentMonth']['value'] = $this->getNumberDaysPassedMonth($currentDate);

        $data = $this->getAvgWithComparisonNewset($data);
        $data['summary']['budget']['percentCostFromBeginningMonth']['value'] = $this->getPercentSendBudgetMonthlyNewset($data);

        return $data;
    }

    private function getPercentSendBudgetMonthlyNewset(array $data) : int {
        return intval($data['summary']['budget']['costFromBeginningMonth']['value'] / ($data['summary']['budget']['budgetMonth']['value'] / 100));
    }
    private function getPercentSendBudgetMonthly(array $data) : int {
        return intval($data['budget']['costFromBeginningMonth']['value'] / ($data['budget']['budgetMonth']['value'] / 100));
    }
    private function getAvgWithComparisonFacebook(array $data) : array {
        $data['budget']['avgLast30Day']['value'] = intval($data['budget']['summaryWithoutCurrent']['value'] / 30);
        $data['click']['avgLast30Day']['value'] = intval($data['click']['summaryWithoutCurrent']['value'] / 30);
        $data['click']['avgComparison']['value'] = intval($data['click']['countClick']['value'] - $data['click']['avgLast30Day']['value']);
        $data['budget']['avgComparison']['value'] = intval($data['budget']['cost']['value'] - $data['budget']['avgLast30Day']['value']);

        unset($data['budget']['summaryWithoutCurrent']);
        unset($data['click']['summaryWithoutCurrent']);
        return $data;
    }

    private function getSummaryWithCurrentClickAndSpend() : array {
        $current = [
            'click',
            'spend'
        ];
        $summary = [
            "click" => 0,
            "spend" => 0
        ];

        foreach ($this->summaryResult as $key => $data) {
            if ($key === "current") {
                $current['click'] = intval($data['click']);
                $current['spend'] = intval($data['spend']);
            } else {

                $summary['click'] += intval($data['click']);
                $summary['spend'] += intval($data['spend']);
            }
        }

        return [
            'current' => $current,
            'summary' => $summary
        ];
    }
    private function getAvgWithComparisonNewset(array $data) : array {
        $summaryAndCurrent = $this->getSummaryWithCurrentClickAndSpend();
        $avgClick = intval($summaryAndCurrent['summary']['click'] / $this->countDates);
        $avgSpend = intval($summaryAndCurrent['summary']['spend'] / $this->countDates);
        $data['summary']['budget']['avgLast30Day']['value'] = $avgSpend;
        $data['summary']['click']['avgLast30Day']['value'] = $avgClick;
        $data['summary']['click']['avgComparison']['value'] = $data['summary']['click']['countClick']['value'] - $avgClick;
        $data['summary']['budget']['avgComparison']['value'] = $data['summary']['budget']['cost']['value'] - $avgSpend;


        return $data;
    }

    private function getEmptyStructureResponse(string $currentDate) : array {
        return [

            "budget" => [
                'cost' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
                    'value' => 0
                ],
                'avgComparison' => [
                    'value' => 0
                ],
                'avgLast30Day' => [
                    'value' => 0
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 0
                ],
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
                'percentDaysPassedInCurrentMonth' => [
                    'value' => $this->getNumberDaysPassedMonth($currentDate)
                ],
            ],
            "click" => [
                'countClick' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
                    'value' => 0
                ],
                'avgComparison' => [
                    'value' => 0
                ],
                'avgLast30Day' => [
                    'value' => 0
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 0
                ]
            ]
        ];
    }

    private function getNumberDaysPassedMonth(string $date) : float {
        $currentTimestamp = strtotime($date);
        $currentDay = date("d", $currentTimestamp);
        $currentMonth = intval(date("m", $currentTimestamp));
        $currentYear = intval(date("Y", $currentTimestamp));
        $countDayInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        return intval($currentDay / ($countDayInMonth / 100));
    }

    private function getStructureWithData(array $data, string $currentDate) : array {
        return [

            "budget" => [
                'cost' => [
                    'value' => $data['budget']['current']
                ],
                'avgComparison' => [
                    'value' => $data['budget']['avgComparisonWithoutCurrent']
                ],
                'avgLast30Day' => [
                    'value' => $data['budget']['avgWithoutCurrent']
                ],
                'minValueLast30Day' => [
                    'value' => $data['budget']['minWithoutCurrent']
                ],
                'maxValueLast30Day' => [
                    'value' => $data['budget']['maxWithoutCurrent']
                ],
                'costFromBeginningMonth' => [
                    'value' => $data['budget']['spentBudgetFromBeginningOfMonth']
                ],
                'budgetMonth' => [
                    'value' => $data['budget']['budgetMonthly']
                ],
                'summaryWithoutCurrent' => [
                    'value' => $data['budget']['summaryWithoutCurrent']
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => $data['budget']['percentSpentBudgetMonthlyCurrentDay']
                ],
                'percentDaysPassedInCurrentMonth' => [
                    'value' => $this->getNumberDaysPassedMonth($currentDate)
                ],
            ],
            "click" => [
                'countClick' => [
                    'value' => $data['click']['current']
                ],
                'avgComparison' => [
                    'value' => $data['click']['avgComparisonWithoutCurrent']
                ],
                'summaryWithoutCurrent' => [
                    'value' => $data['click']['summaryWithoutCurrent']
                ],
                'avgLast30Day' => [
                    'value' => $data['click']['avgWithoutCurrent']
                ],
                'minValueLast30Day' => [
                    'value' => $data['click']['minWithoutCurrent']
                ],
                'maxValueLast30Day' => [
                    'value' => $data['click']['maxWithoutCurrent']
                ]
            ]
        ];
    }

    private function clearResponseData(array $data) : array {

        foreach ($data as $key => $item) {
            unset($data[$key]['budget']["summaryWithoutCurrent"]);
            unset($data[$key]['click']["summaryWithoutCurrent"]);
        }

        return $data;
    }
    public function getResult(Collection $countries, AdwordsApi $adwordsApi, string $currentDate, string $lastDate) : array {
        $response = [];
        $this->clearSummaryResult();
        $this->countDates = 30;

        foreach ($countries as $country) {

            if (is_null($country[$adwordsApi->getNameColumnAdwords()])) {
                $response[$country->id] = $this->getEmptyStructureResponse($currentDate);
                continue;
            }

            $adwordsResult = $adwordsApi
                ->get($currentDate, $lastDate, $country);

            $response[$country->id] = $this->getStructureWithData($adwordsResult, $currentDate);
            $this->setSummaryResult($adwordsResult);
        }

        return $this->clearResponseData(
            $this->calculateSummaryRowNewsetOptionWithManyRow($response, $currentDate)
        );
    }
    private function clearSummaryResult() : void {
        $this->summaryResult = [];
    }
    private function setSummaryResult(array $data) : void {
        foreach ($data['dataByRangesWithoutCurrent'] as $key => $item) {
            if (!isset($this->summaryResult[$key])) {
                $this->summaryResult[$key] = [
                    'click' => $item['click'],
                    'spend' => $item['spend'],
                ];
            } else {
                $this->summaryResult[$key]['click'] += $item['click'];
                $this->summaryResult[$key]['spend'] += $item['spend'];
            }
        }
    }

    public function getWithManyRangesDate(Collection $countries, AdwordsApi $adwordsApi, array $currentDate, array $otherDate) : array {
        $response = [];
        $this->clearSummaryResult();
        $this->countDates = count($otherDate);

        foreach ($countries as $country) {

            if (is_null($country[$adwordsApi->getNameColumnAdwords()])) {
                $response[$country->id] = $this->getEmptyStructureResponse($currentDate['end']);
                continue;
            }

            $adwordsResult = $adwordsApi
                ->getWithManyRangesDate($currentDate, $otherDate, $country);

            $response[$country->id] = $this->getStructureWithData($adwordsResult, $currentDate['end']);
            $this->setSummaryResult($adwordsResult);
        }


        return $this->calculateSummaryRowNewsetOptionWithManyRow($response, $currentDate['end']);
    }
}
