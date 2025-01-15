<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\HistoryReportRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HistoriesReportController extends Controller
{
    private HistoryReportRepository $historyReport;

    public function __construct(HistoryReportRepository $historyReportRepository)
    {
        $this->historyReport = $historyReportRepository;
    }

    public function index(Request $request) {
        return $this->historyReport
            ->index(20);
    }
}
