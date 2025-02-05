<?php
declare(strict_types=1);
namespace App\Services\Pest;

use Illuminate\Support\Facades\DB;

class Countries
{

    public function getExpectedStructureCountry() : array {
        return [
            'id',
            'name',
            'google',
            'shop',
            'facebook',
            'analytics',
            'active',
            'facebook_daily_budget',
            'google_daily_budget',
            'google_budget_currency',
            'facebook_budget_currency',
            'result-summary',
            'google_additional_campaign',
        ];
    }

    private function getOffsetByPage(int $page) : int {
        switch ($page) {
            default:
                return 0;
            case 2:
                return 20;
            case 3:
                return 40;
        }
    }
    public function getExpectedCountriesByPage(int $page = 0) : array {
        return DB::table('countries')
            ->offset($this->getOffsetByPage($page))
            ->limit(20)
            ->get()
            ->map(function ($country) {
                unset($country->created_at);
                unset($country->updated_at);
                $country->shop = intval($country->shop);
                $country->active = boolval($country->active);
                $country->{"result-summary"} = boolval($country->{"result-summary"});
                return (array) $country;
            })
            ->toArray();
    }
}
