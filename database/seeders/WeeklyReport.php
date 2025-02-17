<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeeklyReport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //countries
        DB::table('countries')
            ->truncate();

        $countries = [
          [
              'name' => "Polska",
              'active' => 1,
              "shop" => 1,
              "analytics" => 123545,
              "facebook" => 123123123,
              "google" => 123321321,
              "google_daily_budget" => 150,
              "facebook_daily_budget" => 100
          ],[
              'name' => "Niemcy",
              "shop" => 5,
                'active' => 1,
                "analytics" => 12354775,
                "facebook" => 123123126,
                "google" => 123326321,
                "google_daily_budget" => 120,
                "facebook_daily_budget" => 80
          ],[
              'name' => "Rumunia",
              "shop" => 10,
                'active' => 1,
                "analytics" => 123547756,
                "google" => 123327821,
                "google_daily_budget" => 80
          ],[
              'name' => "Anglia",
              "shop" => 2,
                'active' => 1,
                "analytics" => 287213359,
                "facebook" => 3055428861222484,
                "facebook_daily_budget" => 123
          ],[
              'name' => "B2B",
                'active' => 1,
              "shop" => 101,
              "result-summary" => false
          ],
        ];
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
