<?php
declare(strict_types=1);
namespace App\Facades\Pest;

use App\Services\Pest\Countries;

class CountriesFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return Countries::class;
    }
}
