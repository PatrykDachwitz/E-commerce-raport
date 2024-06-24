<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComparisonDayJuneCountry extends Seeder
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
                "analytics" => 123123123123
            ],
            [
                'name' => 'Anglia',
                'shop' => 2,
                "analytics" => 987987987987
            ],
            [
                'name' => 'Niemcy',
                'shop' => 3,
            ],
            [
                'name' => 'Irlandia',
                'shop' => 4,
                "active" => false
            ],
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }

    }
}
