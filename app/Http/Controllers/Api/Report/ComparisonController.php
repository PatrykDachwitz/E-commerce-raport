<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    /**
     * Handle the incoming request.
     */

    private int $currentYear;
    private int $previousYear;
    private int $currentMonth;
    private int $previousMonth;
    private int $currentDay;

    public function __construct()
    {
        $this->currentYear = intval(date("Y"));
        $this->previousYear = $this->currentYear - 1;
        $this->currentMonth = intval(date("m"));
        $this->previousMonth = $this->currentMonth - 1;
        $this->currentDay = intval(date("d"));
    }

    private function getHeadersName() : array {

        return [
            'resultsFromBeginnerMonthCurrentYear' => "1-{$this->currentDay} " . __("month.{$this->currentMonth}") . " {$this->currentYear}",
            'resultsFromBeginnerMonthPreviousYear' => "1-{$this->currentDay} " . __("month.{$this->currentMonth}") . " {$this->previousYear}",
            'avgResultMonthCurrentYear' => __('content.avgValue') . __("month.{$this->currentMonth}") . " {$this->currentYear}",
            'avgResultMonthPreviousYear' => __('content.avgValue') . __("month.{$this->currentMonth}") . " {$this->previousYear}",
            'resultsFromBeginnerPreviousMonthCurrentYear' => "1-{$this->currentDay} " . __("month.{$this->previousMonth}") . " {$this->currentYear}",
        ];
    }

    public function __invoke(Request $request)
    {
        $structureWithValueAndArt = [
            'value' => 122,
            'art' => 122,
        ];

        $response = [
            'names' => $this->getHeadersName(),
            'resultsFromBeginnerMonthCurrentYear' => $structureWithValueAndArt,
            'resultsFromBeginnerMonthPreviousYear' => $structureWithValueAndArt,
            'resultsFromBeginnerMonthComparisonYear' => $structureWithValueAndArt,
            'avgResultMonthCurrentYear' => $structureWithValueAndArt,
            'avgResultMonthPreviousYear' => $structureWithValueAndArt,
            'avgResultMonthComparisonYear' => $structureWithValueAndArt,
            'resultsFromBeginnerPreviousMonthCurrentYear' => $structureWithValueAndArt,
            'resultsFromBeginnerComparisonMonth' => $structureWithValueAndArt,
        ];

        return response([
            'data' => $response
        ]);
    }
}
