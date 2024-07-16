<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    private function getHeadersName() : array {

        return [
            'resultsFromBeginnerMonthCurrentYear' => "1-{$this->currentDay} " . __("month.{$this->currentMonth}") . " {$this->currentYear}",
            'resultsFromBeginnerMonthPreviousYear' => "1-{$this->currentDay} " . __("month.{$this->currentMonth}") . " {$this->previousYear}",
            'avgResultMonthCurrentYear' => __('content.avgValue') . " " . __("month.{$this->currentMonth}") . " {$this->currentYear}",
            'avgResultMonthPreviousYear' => __('content.avgValue') . " " . __("month.{$this->currentMonth}") . " {$this->previousYear}",
            'resultsFromBeginnerPreviousMonthCurrentYear' => "1-{$this->currentDay} " . __("month.{$this->previousMonth}") . " {$this->currentYear}",
        ];
    }

    private function updateDates(array $date) : void {

        $this->currentYear = intval($date['year']);
        $this->previousYear = $this->currentYear - 1;
        $this->currentMonth = intval($date['month']);
        $this->previousMonth = $this->currentMonth - 1;
        $this->currentDay = intval($date['day']);
    }

    public function __invoke(ReportDateFormat $request)
    {
        $fileContent = json_decode(Storage::disk()
            ->get(config('report.containerReportComparisonDay') . $request->input('date', date("Y-m-d", strtotime('-1 day'))) . '.json'), true);

        $this->updateDates($fileContent["date"]);

        $response = array_merge([
            'names' => $this->getHeadersName()
        ], $fileContent);

        return response([
            'data' => $response
        ]);
    }
}
