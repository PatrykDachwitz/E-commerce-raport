<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->truncate();
        DB::table('users')->truncate();

        for ($i = 1; $i < 7; $i++) {
            Country::factory()
                ->create([
                    'shop' => $i,
                    'active' => true,
                    'result-summary' => true,
                    'google_additional_campaign' => "",
                ]);
        }

        Country::factory()
            ->create([
                'name' => 'B2B',
                'active' => true,
                'result-summary' => false,
                'google' => "",
                'shop' => "9",
                'facebook' => "",
                'analytics' => "",
                'facebook_daily_budget' => 0,
                'google_budget_currency' => 0,
                'google_additional_campaign' => "",
            ]);
        User::factory()
            ->count(3)
            ->create();
        User::factory()
            ->create([
                'name' => 'admin@admin.pl',
                'password' => "admin12",
                'super_admin' => true,
            ]);
    }
}
