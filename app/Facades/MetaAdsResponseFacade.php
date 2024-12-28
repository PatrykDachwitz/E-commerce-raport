<?php
declare(strict_types=1);
namespace App\Facades;

use App\Services\Report\Fake\MetaAdsResponse;

class MetaAdsResponseFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return MetaAdsResponse::class;
    }
}
