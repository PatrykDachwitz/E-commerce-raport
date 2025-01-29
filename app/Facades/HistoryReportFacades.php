<?php
declare(strict_types=1);
namespace App\Facades;



use App\Services\Report\Fake\HistoryReport;

class HistoryReportFacades extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return HistoryReport::class;
    }
}
