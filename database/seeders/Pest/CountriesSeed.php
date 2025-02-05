<?php
declare(strict_types=1);
namespace Database\Seeders\Pest;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::factory()
            ->count(60)
            ->create();
    }
}
