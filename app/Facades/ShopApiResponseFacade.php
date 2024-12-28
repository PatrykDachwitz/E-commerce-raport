<?php
declare(strict_types=1);
namespace App\Facades;

use App\Services\Report\Fake\ShopApiResponse;

class ShopApiResponseFacade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return ShopApiResponse::class;
    }
}
