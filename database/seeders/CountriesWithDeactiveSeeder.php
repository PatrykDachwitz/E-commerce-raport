<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesWithDeactiveSeeder extends Seeder
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
            ],
            [
                'name' => 'Anglia',
                'shop' => 2,
            ],
            [
                'name' => 'Irlandia',
                'shop' => 4,
            ],
            [
                'name' => 'Norwegia',
                'shop' => 17,
                'active' => false
            ],
            [
                'name' => 'Szwecja',
                'shop' => 8,
                'active' => false
            ],
            [
                'name' => 'Węgry',
                'shop' => 11,
                'active' => false
            ],
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }

    }
}
