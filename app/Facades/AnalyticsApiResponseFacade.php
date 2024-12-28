<?php
declare(strict_types=1);
namespace App\Facades;

use App\Services\Report\Fake\AnalyticsApiResponse;

class AnalyticsApiResponseFacade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return AnalyticsApiResponse::class;
    }
}
