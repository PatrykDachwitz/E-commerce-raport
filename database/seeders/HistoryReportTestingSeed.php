<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\HistoryReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryReportTestingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */

    const TYPES_REPORT_HISTORY = [
        'comparison-day',
        'result-day',
        'result-week'
    ];
    private function getDates() : array {
        $baseTime = strtotime('2025-01-20');
        $dates = [
            date("Y-m-d", $baseTime)
        ];

        for ($i = 40; $i >= 1; $i--) {
            $dates[] = date("Y-m-d", strtotime("-{$i} day", $baseTime));
        }

        return $dates;
    }
    public function run(): void
    {
        $datesReport = $this->getDates();

        DB::table('history_reports')
            ->truncate();

        foreach (self::TYPES_REPORT_HISTORY as $typeReport) {

            foreach ($datesReport as $date) {
                HistoryReport::factory()->create([
                    'date' => $date,
                    'name' => $date,
                    'type' => $typeReport,
                ]);
            }

        }

    }
}
