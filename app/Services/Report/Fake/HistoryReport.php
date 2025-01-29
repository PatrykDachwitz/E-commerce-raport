<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

class HistoryReport
{

    private function getDates() : array {
        $baseTime = strtotime('2025-01-20');
        $dates = [
            date("Y-m-d", $baseTime)
        ];

        for ($i = 1; $i <= 40; $i++) {
            $dates[] = date("Y-m-d", strtotime("-{$i} day", $baseTime));
        }

        return $dates;
    }

    private function resultFirstPage(string $type) : array {
        $baseTime = strtotime('2025-01-20');
        $dates = [];
        $dates[] = [
            'date' => date("Y-m-d", $baseTime),
            'name' => date("Y-m-d", $baseTime),
            'type' => $type,
        ];

        for ($i = 1; $i < 20; $i++) {
            $dates[] = [
                'date' => date("Y-m-d", strtotime("-{$i} day", $baseTime)),
                'name' => date("Y-m-d", strtotime("-{$i} day", $baseTime)),
                'type' => $type,
            ];
        }

        return $dates;
    }

    public function getExpectedResponse(string $typeReport) : array {
        return $this->resultFirstPage($typeReport);
    }

}
