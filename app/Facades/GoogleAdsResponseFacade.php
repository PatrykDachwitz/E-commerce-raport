<?php
declare(strict_types=1);
namespace App\Facades;

use App\Services\Report\Fake\GoogleAdsResponse;

class GoogleAdsResponseFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return GoogleAdsResponse::class;
    }
}
