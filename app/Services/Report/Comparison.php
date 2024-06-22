<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Services\ShopSales;
use Exception;

class Comparison
{
    private ShopSales $sales;
    private array $response;
    private array $data = [
        'resultForBeginMonthToDateReport' => null,
        'resultForBeginMonthToDateReportPreviousYear' => null,
        'resultBeginPreviousMonthToDayInDateReport' => null,
        'resultSummaryMonthReportPreviousYear' => null,
    ];
    private array $date = [
        'resultForBeginMonthToDateReport' => [
            'start' => null,
            'end' => null,
        ],
        'resultForBeginMonthToDateReportPreviousYear' => [
            'start' => null,
            'end' => null,
        ],
        'resultBeginPreviousMonthToDayInDateReport' => [
            'start' => null,
            'end' => null,
        ],
        'resultSummaryMonthReportPreviousYear' => [
            'start' => null,
            'end' => null,
        ],
    ];
    public function __construct(ShopSales $sales)
    {
        $this->sales = $sales;
    }

    private function summaryResults(array $results) : array {
        $value = 0;
        $item = 0;

        foreach ($results as $result) {
            $value += $result['value'];
            $item += $result['item'];
        }

        return [
            'value' => intval($value),
            'art' => intval($item),
        ];
    }
    private function downloadJsonResult() {
        foreach ($this->date as $key => $date) {
            try {
                $results = $this->sales->getSales($date['start'], $date['end']);
                $this->data[$key] = $this->summaryResults($results);
            } catch (Exception) {
                $this->data[$key] = [
                    'art' => 0,
                    'value' => 0,
                ];
            }
        }
    }

    private function getCountDayInRangesDate(string $startDate, string $endDate) : int {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);
        return (($endTime - $startTime) / (24 * 60 * 60)) + 1;
    }
    private function getAvgValueByRangesDate(array $data, string $startDate, string $endDate) : array {

        $countDay = $this->getCountDayInRangesDate($startDate, $endDate);

        return [
            'value' => intval($data['value'] / $countDay),
            'art' => intval($data['art'] / $countDay),
        ];
    }

    private function getComparisonValue(array $firstDataComparison, array $secondDataComparison) : array {
        return [
            'value' => $firstDataComparison['value'] - $secondDataComparison['value'],
            'art' => $firstDataComparison['art'] - $secondDataComparison['art'],
        ];
    }

    private function buildResponseFile(string $date) : void {

        $this->response['resultsFromBeginnerMonthCurrentYear'] = $this->data['resultForBeginMonthToDateReport'];
        $this->response['resultsFromBeginnerMonthPreviousYear'] = $this->data['resultForBeginMonthToDateReportPreviousYear'];
        $this->response['resultsFromBeginnerMonthComparisonYear'] = $this->getComparisonValue(
            $this->data['resultForBeginMonthToDateReport'],
            $this->data['resultForBeginMonthToDateReportPreviousYear'],
        );
        $this->response['avgResultMonthCurrentYear'] = $this->getAvgValueByRangesDate(
            $this->data['resultForBeginMonthToDateReport'],
            $this->date['resultForBeginMonthToDateReport']['start'],
            $this->date['resultForBeginMonthToDateReport']['end'],
        );
        $this->response['avgResultMonthPreviousYear'] = $this->getAvgValueByRangesDate(
            $this->data['resultSummaryMonthReportPreviousYear'],
            $this->date['resultSummaryMonthReportPreviousYear']['start'],
            $this->date['resultSummaryMonthReportPreviousYear']['end'],
        );
        $this->response['avgResultMonthComparisonYear'] = $this->getComparisonValue(
            $this->response['avgResultMonthCurrentYear'],
            $this->response['avgResultMonthPreviousYear'],
        );
        $this->response['resultsFromBeginnerPreviousMonthCurrentYear'] = $this->data['resultBeginPreviousMonthToDayInDateReport'];
        $this->response['resultsFromBeginnerComparisonMonth'] = $this->getComparisonValue(
            $this->data['resultForBeginMonthToDateReport'],
            $this->data['resultBeginPreviousMonthToDayInDateReport'],
        );

        $parseDate = date_parse($date);
        $this->response['date']['day'] = $parseDate['day'];
        $this->response['date']['month'] = $this->getCorrectFormatMonth($parseDate['month']);
        $this->response['date']['year'] = $parseDate['year'];
    }

    private function getCorrectFormatMonth(int|string $month) : string {
        $monthCheck = intval($month);

        if ($monthCheck > 12) $monthCheck = 1;
        if ($monthCheck <= 0) $monthCheck = 12;

        if (strlen(strval($monthCheck)) === 1) return "0{$monthCheck}";
        else return strval($monthCheck);
    }
    private function getLastDayMonth(int $month, int $year) : int {
        $nextMonth = $this->getCorrectFormatMonth($month + 1);

        $time = strtotime("01-$nextMonth-$year");
        $oneDay = 24 * 60 * 60;

        return intval(date("d", $time - $oneDay));
    }
    private function getCorrectFormatDay(int $day) : string|int {
        if ($day < 10) {
            return "0{$day}";
        }
        else {
            return $day;
        }
    }

    private function updateDateRanges(string $date) : bool {
        $dateParse = date_parse($date);
        $dayCorrectFormat = $this->getCorrectFormatDay($dateParse['day']);
        $previousYear = ($dateParse['year'] - 1);
        $previousMonth = $this->getCorrectFormatMonth($dateParse['month'] - 1);
        $currentMonth = $this->getCorrectFormatMonth($dateParse['month']);

        $lastDayCurrentMonth = $this->getLastDayMonth($dateParse['month'], $previousYear);

        $this->date['resultForBeginMonthToDateReport']['start'] = "{$dateParse['year']}-{$currentMonth}-01";
        $this->date['resultForBeginMonthToDateReport']['end'] = $date;

        $this->date['resultBeginPreviousMonthToDayInDateReport']['start'] = "{$dateParse['year']}-{$previousMonth}-01";
        $this->date['resultBeginPreviousMonthToDayInDateReport']['end'] = "{$dateParse['year']}-{$previousMonth}-{$dayCorrectFormat}";

        $this->date['resultForBeginMonthToDateReportPreviousYear']['start'] = "{$previousYear}-{$currentMonth}-01";
        $this->date['resultForBeginMonthToDateReportPreviousYear']['end'] = "{$previousYear}-{$currentMonth}-{$dayCorrectFormat}";

        $this->date['resultSummaryMonthReportPreviousYear']['start'] = "{$previousYear}-{$currentMonth}-01";
        $this->date['resultSummaryMonthReportPreviousYear']['end'] = "{$previousYear}-{$currentMonth}-{$lastDayCurrentMonth}";

        return true;
    }
    public function get(string $date) : array {

        if (!$this->updateDateRanges($date)) throw new Exception('Error updateDateRanges in Comparison class');

        try {
            $this->downloadJsonResult();
        } catch (Exception $e) {
            throw new Exception('Error download json files in api');
        }

        try {
            $this->buildResponseFile($date);

            return $this->response;
        } catch (Exception) {
            return [];
        }


    }
}
