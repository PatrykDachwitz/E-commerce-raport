<?php

namespace App\Console\Commands;

use App\Services\Report\ResultDay;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportResultDay extends Command
{
    private string $path;
    private ResultDay $resultDay;
    public function __construct(ResultDay $resultDay)
    {
        parent::__construct();
        $this->resultDay = $resultDay;
        $this->path = config('report.containerReportResultDay');
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:result-day {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command generating file used to show result day report.';

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

        $resultReportDay = $this->resultDay
            ->get($startDay);

        if (Storage::put( "{$this->path}{$startDay}.json", json_encode($resultReportDay))) {
            $this->info(__('command.saveFileSuccess'));
            return 0;
        } else {
            $this->info(__('command.saveFileWrong'));
            return 1;
        }
    }
}
