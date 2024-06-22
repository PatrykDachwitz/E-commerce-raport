<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Services\Report\Comparison;
use App\Services\ShopSales;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationData;

class ReportComparisonDay extends Command
{
    private string $path;
    private Comparison $comparison;
    public function __construct(Comparison $comparison)
    {
        parent::__construct();
        $this->comparison = $comparison;
        $this->path = config('report.containerReportComparisonDay');
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:comparison-day {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command generating file used to show result comparison day report.';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        try {

            $startDay = $this->argument('date');

            Validator::validate([
                "date" => $startDay
            ], [
                "date" => "date_format:Y-m-d"
            ]);

        } catch (Exception) {

            $this->info(__("command.wrongFormatDate"));
            return 1;

        }

        $resultComparison = $this->comparison
            ->get($startDay);

        if (Storage::put( "{$this->path}{$startDay}.json", json_encode($resultComparison))) {
            $this->info(__('command.saveFileSuccess'));
            return 0;
        } else {
            $this->info(__('command.saveFileWrong'));
            return 1;
        }
    }
}
