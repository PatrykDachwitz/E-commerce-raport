<?php
declare(strict_types=1);
namespace App\Services\Pest;

use App\Models\Country;
use App\Models\User;
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


    private function getCountryById(int $idCountry) : array {
        return (array) DB::table('countries')
            ->find($idCountry);
    }

    private function removeNotExpectedValueInCountry(array $country) : array {
        unset($country['created_at']);
        unset($country['updated_at']);

        return $country;
    }

    private function getInvalidValueForIntegerInput() : array {
        return [
            "testValue",
            null,
            12.12,
        ];
    }
    private function getInvalidValueForStringInput() : array {
        return [
            13231,
            null,
            true,
            false,
            12.12,
        ];
    }
    private function getInvalidValueForBoolInput() : array {
        return [
            13231,
            null,
            12.12,
            "testValue",
        ];
    }
    public function getInvalidValueInput(string $nameValue) : array {
        switch ($nameValue) {
            case "facebook_daily_budget":
            case "google_daily_budget":
            case "shop":
                return $this->getInvalidValueForIntegerInput();
            case "result-summary":
            case "active":
                return $this->getInvalidValueForBoolInput();
            default:
                return $this->getInvalidValueForStringInput();
        }
    }

    public function getNotIssetCountry() : array {
        return Country::factory()
            ->make()
            ->attributesToArray();
    }
    public function getCountry(int $idCountry) : array {
        $country = $this->getCountryById($idCountry);

        return $this->removeNotExpectedValueInCountry($country);
    }
}
