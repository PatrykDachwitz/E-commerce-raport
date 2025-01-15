<?php
declare(strict_types=1);
namespace App\Repository;

use App\Models\HistoryReport;
use Illuminate\Database\Eloquent\Collection;

interface HistoryReportRepository
{

    public function create(array $data) : HistoryReport;

    public function index(int $paginate = 15);
}
