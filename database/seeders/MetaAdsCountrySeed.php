<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaAdsCountrySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Polska',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123",
                "facebook_daily_budget" => 300,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123",
                "facebook_daily_budget" => 0,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123",
                "facebook_daily_budget" => 1902,
                "facebook_budget_currency" => "EUR",
            ],
            [
                'name' => 'Polska',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123",
                "facebook_daily_budget" => 300,
                "facebook_budget_currency" => "RON",
            ],
            [
                'name' => 'Polska',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123;1231231231",
                "facebook_daily_budget" => 300,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 1,
                "analytics" => 123123123123,
                "facebook" => "123123123;1231231231",
                "facebook_daily_budget" => 0,
            ]
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
