<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeeklyController extends Controller
{


    /**
     * Handle the incoming request.
     */

    private function getLastSunday(string $date) : string {
        $dateTime = strtotime($date);
        $currentDay = date("D", $dateTime);

        if ($currentDay === "Sun") {
            return date("Y-m-d", $dateTime);
        } else {
            return date("Y-m-d", strtotime("last sunday", $dateTime));
        }
    }

    public function __invoke(ReportDateFormat $request)
    {
        $day = $request->input('date', date("Y-m-d", strtotime('-1 day')));
        $sunday = $this->getLastSunday($day);

        $fileContent = Storage::disk()
            ->get(config('report.containerReportResultWeekly') . "{$sunday}.json");

        return response([
            'data' => json_decode($fileContent),
            'date' => $sunday
        ]);
    }
}
