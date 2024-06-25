<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyController extends Controller
{


    /**
     * Handle the incoming request.
     */

    public function __invoke(ReportDateFormat $request)
    {
        $fileContent = Storage::disk()
            ->get(config('report.containerReportResultDay') . $request->input('date') . ".json");

        return response([
            'data' => json_decode($fileContent)
        ]);
    }
}
