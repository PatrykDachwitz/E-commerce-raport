<?php

namespace App\Console\Commands;

use App\Services\Report\ResultWeekly;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportResultWeekly extends Command
{
    private string $path;
    private ResultWeekly $resultWeekly;
    public function __construct(ResultWeekly $resultWeekly)
    {
        parent::__construct();
        $this->resultWeekly = $resultWeekly;
        $this->path = config('report.containerReportResultWeekly');
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:result-week {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command generating file used to show result weekly report.';

    /**
     * Execute the console command.
     */

    private function getPreviousWeekend(string $date) : array {
        $timeDate = strtotime($date);

        $friday = date("Y-m-d", strtotime("last friday", $timeDate));
        $currentDay = date("D", $timeDate);

        if ($currentDay === "Sun") {
            $sunday = date("Y-m-d", $timeDate);
        } else {
            $sunday = date("Y-m-d", strtotime("last sunday", $timeDate));
        }

        return [
          "start" => $friday,
          "end" => $sunday,
        ];
    }


    private function getRangesWeekend(string $currentDate) : array {
        $currentDate = $this->getPreviousWeekend($currentDate);
        $otherDate = [];

        for ($i = 0; $i < 4; $i++) {
            if ($i === 0) {
                $otherDate[] = $this->getPreviousWeekend($currentDate['start']);
            } else {
                $position = $i - 1;
                $otherDate[] = $this->getPreviousWeekend($otherDate[$position]['start']);
            }
        }

        return [
            "current" => $currentDate,
            "other" => $otherDate,
        ];
    }

    public function handle()
    {
        try {

            $startDay = $this->argument('date');

            Validator::validate([
                "date" => $startDay
            ], [
                "date" => "date_format:Y-m-d"
            ]);

            $rangesDate = $this->getRangesWeekend($startDay);

        } catch (Exception) {

            $this->info(__("command.wrongFormatDate"));
            return 1;

        }

        $resultReportWeekly = $this->resultWeekly
            ->get($rangesDate['current'], $rangesDate['other']);

        if (Storage::put( "{$this->path}{$rangesDate['current']['end']}.json", json_encode($resultReportWeekly))) {
            $this->info(__('command.saveFileSuccess'));
            return 0;
        } else {
            $this->info(__('command.saveFileWrong'));
            return 1;
        }
    }
}
