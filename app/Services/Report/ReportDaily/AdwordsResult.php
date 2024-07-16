<?php
declare(strict_types=1);
namespace App\Services\Report\ReportDaily;

use App\Services\Adwords\AdwordsApi;
use Illuminate\Database\Eloquent\Collection;

class AdwordsResult
{

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

        return round($currentDay / ($countDayInMonth / 100), 2);
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

    public function getResult(Collection $countries, AdwordsApi $adwordsApi, string $currentDate, string $lastDate) : array {
        $response = [];

        foreach ($countries as $country) {

            if (is_null($country[$adwordsApi->getNameColumnAdwords()])) {
                $response[$country->id] = $this->getEmptyStructureResponse($currentDate);
                continue;
            }

            $adwordsResult = $adwordsApi
                ->get($currentDate, $lastDate, $country);

            $response[$country->id] = $this->getStructureWithData($adwordsResult, $currentDate);
        }

        return $this->calculateSummaryRow($response, $currentDate);
    }
}
