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
            'name' => 'Polska',
            'shop' => 1,
            "analytics" => 123123123123,
            "facebook" => "123123123",
            "facebook_daily_budget" => 300,
        ];

        DB::table('countries')->truncate();
        Country::create($countries);
    }
}
