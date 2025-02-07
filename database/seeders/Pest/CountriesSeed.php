<?php
declare(strict_types=1);
namespace Database\Seeders\Pest;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->truncate();

        Country::factory()
            ->count(60)
            ->create();
    }
}
