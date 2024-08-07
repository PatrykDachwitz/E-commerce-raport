<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleAdsCountrySeed extends Seeder
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
                "google" => "123321321",
                "google_daily_budget" => 300,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 1,
                "analytics" => 123123123123,
                "google" => "123321321",
                "google_daily_budget" => 0,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 1,
                "analytics" => 123123123123,
                "google" => "52432432",
                "google_daily_budget" => 1902,
                "facebook_budget_currency" => "EUR",
            ],
            [
                'name' => 'Polska',
                'shop' => 1,
                "analytics" => 123123123123,
                "google" => "123321321",
                "google_daily_budget" => 300,
                "google_additional_campaign" => "12342141;1524,2312"
            ]
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
