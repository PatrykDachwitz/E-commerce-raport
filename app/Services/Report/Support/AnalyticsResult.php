<?php
declare(strict_types=1);
namespace App\Services\Report\Support;

use App\Services\Adwords\AnalyticsApi;
use Illuminate\Database\Eloquent\Collection;

class AnalyticsResult
{
    private AnalyticsApi $analyticsApi;
    private array $datesReport;
    public function __construct(AnalyticsApi $analyticsApi)
    {
        $this->analyticsApi = $analyticsApi;

    }

    private function returnFormatAnalytics(array|null $dataAnalytics) : array {
        if (is_null($dataAnalytics)) {
            return [
                'countClick' => [
                    'value' => 0
                ],
                'avgComparison' => [
                    'value' => 0
                ],
                'avgLast30Day' => [
                    'value' => 0
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 0
                ]
            ];

        } else {

            $avg = intval($dataAnalytics['avgWithoutCurrent']);

            return [
                'countClick' => [
                    'value' => intval($dataAnalytics['current'])
                ],
                'avgComparison' => [
                    'value' => intval($dataAnalytics['current']) - $avg
                ],
                'avgLast30Day' => [
                    'value' => $avg
                ],
                'minValueLast30Day' => [
                    'value' => intval($dataAnalytics['minWithoutCurrent'])
                ],
                'maxValueLast30Day' => [
                    'value' => intval($dataAnalytics['maxWithoutCurrent'])
                ]
            ];

        }

    }

    private function getConvertDate() : string {

        if (is_array($this->datesReport['current'])) {
            $date = $this->datesReport['current']['end'];
        } else {
            $date = $this->datesReport['current'];
        }

        return str_replace("-","", $date);
    }
    public function get(Collection $activesCountry, array $dates) : array {
        $this->datesReport = $dates;
        $currentDate = $this->getConvertDate();
        $response = [];

        foreach ($activesCountry as $country) {

            if (is_null($country->analytics)) {
                $response[$country->id] = $this->returnFormatAnalytics(null);
                continue;
            }
            $this->analyticsApi
                ->setCountry($country);

            $this->analyticsApi
                ->setDateCurrent($currentDate);

            $resultAnalytics = $this->analyticsApi
                ->get($this->datesReport['last'], $this->datesReport['current']);

            $this->setSummaryAnalytics($resultAnalytics);
            $response[$country->id] = $this->returnFormatAnalytics($resultAnalytics);
        }

        return $this->calculateSummaryAnalytics($response);
    }
    public function getWithManyRangesDate(Collection $activesCountry, array $dates) : array {
        $this->datesReport = $dates;
        $currentDate = $this->getConvertDate();
        $response = [];

        foreach ($activesCountry as $country) {

            if (is_null($country->analytics)) {
                $response[$country->id] = $this->returnFormatAnalytics(null);
                continue;
            }
            $this->analyticsApi
                ->setCountry($country);

            $this->analyticsApi
                ->setDateCurrent($currentDate);

            $resultAnalytics = $this->analyticsApi
                ->getWithManyRangesDate($this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);

            $this->setSummaryAnalytics($resultAnalytics);
            $response[$country->id] = $this->returnFormatAnalytics($resultAnalytics);
        }

        return $this->calculateSummaryAnalytics($response);
    }
    private function setSummaryAnalytics(array $data) : void {

        foreach ($data['dataByRangesWithoutCurrent'] as $key => $item) {
            if (!isset($this->summaryAnalytics[$key])) {
                $this->summaryAnalytics[$key] = [
                    'click' => $item['click']
                ];
            } else {
                $this->summaryAnalytics[$key]['click'] += $item['click'];
            }
        }
    }

    private function calculateSummaryAnalytics(array $resultsAnalytics) : array {
        $minMaxValuesClick = $this->getMinAndMaxValue();
        $avgClick = $this->getAvgClickAnalytics();
        $currentCountClick = intval($this->summaryAnalytics['current']['click']) ?? 0;

        $summaryResult = [
            'countClick' => [
                'value' => $currentCountClick
            ],
            'avgComparison' => [
                'value' => $currentCountClick - $avgClick
            ],
            'avgLast30Day' => [
                'value' => $avgClick
            ],
            'minValueLast30Day' => [
                'value' => $minMaxValuesClick['min']
            ],
            'maxValueLast30Day' => [
                'value' => $minMaxValuesClick['max']
            ]
        ];

        $resultsAnalytics['summary'] = $summaryResult;

        return $resultsAnalytics;
    }

    private function getAvgClickAnalytics() : int {
        $summary = 0;

        foreach ($this->summaryAnalytics as $key => $params) {
            if ($key === "current") continue;
            $summary += intval($params['click']);
        }


        return intval($summary / $this->datesReport['count']);
    }

    private function getMinAndMaxValue() : array {
        $min = null;
        $max = null;

        foreach ($this->summaryAnalytics as $key => $params) {
            if ($key === "current") continue;

            $click = intval($params['click']);
            if (is_null($min)) {
                $min = $click;
            } elseif ($min > $click) {
                $min = $click;
            }

            if (is_null($max)) {
                $max = $click;
            } elseif ($click > $max) {
                $max = $click;
            }

        }
        return [
            'min' => $min,
            'max' => $max,
        ];
    }

}
