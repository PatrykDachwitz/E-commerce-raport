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

    public function index(int $paginate = 15, string|null $type = null, string $order = 'asc')
    {

        $query = $this->historyReport
            ->query();

        if(!is_null($type)) {
            $query
                ->where('type', $type);
        }

        return $query
            ->orderBy('date', $order)
            ->paginate($paginate);
    }

    public function create(array $data): HistoryReport
    {
        return $this->historyReport
            ->create($data);
    }
}
