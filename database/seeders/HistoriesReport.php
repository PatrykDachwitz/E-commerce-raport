<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\HistoryReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoriesReport extends Seeder
{
    /**
     * Run the database seeds.
     */

    private function getDates() : array {
        $dates = [];

        for ($i = 1; $i < 50; $i++) {
            $dates[] = date('Y-m-d', strtotime("-{$i} day"));
        }

        return $dates;
    }

    public function run(): void
    {
        $datesReport = $this->getDates();

        foreach ($datesReport as $date) {
            HistoryReport::factory()->create([
                'date' => $date,
                'name' => $date,
                'type' => 'result-day',
            ]);
        }
        foreach ($datesReport as $date) {
            HistoryReport::factory()->create([
                'date' => $date,
                'name' => $date,
                'type' => 'comparison-day',
            ]);
        }
        foreach ($datesReport as $date) {
            HistoryReport::factory()->create([
                'date' => $date,
                'name' => $date,
                'type' => 'result-week',
            ]);
        }
    }
}
