<?php
declare(strict_types=1);
namespace App\Repository\Eloquent;

use App\Models\HistoryReport;
use Illuminate\Database\Eloquent\Collection;

class HistoryReportRepository implements \App\Repository\HistoryReportRepository
{
    private HistoryReport $historyReport;
    public function __construct(HistoryReport $historyReport)
    {
        $this->historyReport = $historyReport;
    }

    public function create(array $data): HistoryReport
    {
        return $this->historyReport
            ->create($data);
    }
}
