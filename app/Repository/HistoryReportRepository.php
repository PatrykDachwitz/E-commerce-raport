<?php
declare(strict_types=1);
namespace App\Repository;

use App\Models\HistoryReport;

interface HistoryReportRepository
{

    public function create(array $data) : HistoryReport;
}
