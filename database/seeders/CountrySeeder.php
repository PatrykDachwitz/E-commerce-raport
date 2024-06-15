<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
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
                'analytics' => "446206454"
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
                'name' => 'Australia',
                'shop' => 25,
            ],
            [
                'name' => 'Usa',
                'shop' => 5,
            ],
            [
                'name' => 'Niemcy',
                'shop' => 3,
            ],
            [
                'name' => 'Szwajcaria',
                'shop' => 7,
            ],
            [
                'name' => 'Francja',
                'shop' => 18,
            ],
            [
                'name' => 'Holandia',
                'shop' => 21,
            ],
            [
                'name' => 'Czechy',
                'shop' => 10,
            ],
            [
                'name' => 'Dania',
                'shop' => 15,
            ],
            [
                'name' => 'Litwa',
                'shop' => 12,
            ],
            [
                'name' => 'Słowacja',
                'shop' => 9,
            ],
            [
                'name' => 'Włochy',
                'shop' => 14,
            ],
            [
                'name' => 'Hiszpania',
                'shop' => 16,
            ],
            [
                'name' => 'Finlandia',
                'shop' => 19,
            ],
            [
                'name' => 'Portugalia',
                'shop' => 20,
            ],
            [
                'name' => 'Grecja',
                'shop' => 24,
            ],
            [
                'name' => 'Rumunia',
                'shop' => 13,
            ],
            [
                'name' => 'Chorwacja',
                'shop' => 22,
            ],
            [
                'name' => 'Bułgaria',
                'shop' => 23,
            ],
            [
                'name' => 'Norwegia',
                'shop' => 17,
            ],
            [
                'name' => 'Szwecja',
                'shop' => 8,
            ],
            [
                'name' => 'Węgry',
                'shop' => 11,
            ],
        ];

        DB::table('countries')->truncate();
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
