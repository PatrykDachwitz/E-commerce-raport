<?php
declare(strict_types=1);
namespace App\Facades;

use App\Services\Report\Fake\ReportDayResult;

class ReportDayResultFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return ReportDayResult::class;
    }
}
