<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultDayJuneCountry extends Seeder
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
                "google" => "123321321",
                "google_daily_budget" => 300,
            ],
            [
                'name' => 'Anglia',
                'shop' => 2,
                "analytics" => 987987987987,
                "facebook" => "123123145",
                "facebook_daily_budget" => 600,
                "google_daily_budget" => 142,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 3,
                "google" => "52432432",
                "google_daily_budget" => 775,
            ],
            [
                'name' => 'Irlandia',
                'shop' => 4,
                "active" => false
            ],
            [
                'name' => 'B2B',
                'shop' => 5,
                "result-summary" => false
            ],
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }

    }
}
