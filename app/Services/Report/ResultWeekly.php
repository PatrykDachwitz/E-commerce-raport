<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Report\Support\AdwordsResult;
use App\Services\Report\Support\ShopResult;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Exception;

///Jęzeli brak danych to zrami zapisać co jeśl pojawi siębład kodu httpt lub brak wartosci albo dzepsuty plk
class ResultWeekly
{

    private array $summaryAnalytics = [];
    private Country $country;
    private MetaAdsApi $metaAdsApi;
    private AdwordsResult $adwordsResult;
    private array $datesReport;
    private AnalyticsApi $analyticsApi;
    private ShopResult $shopResult;
    private GoogleAdwordsApi $googleAdwordsApi;

    public function __construct(Country $country, AnalyticsApi $analyticsApi, MetaAdsApi $metaAdsApi, AdwordsResult $adwordsResult, ShopResult $shopResult, GoogleAdwordsApi $googleAdwordsApi)
    {
        $this->country = $country;
        $this->analyticsApi = $analyticsApi;
        $this->metaAdsApi = $metaAdsApi;
        $this->adwordsResult = $adwordsResult;
        $this->shopResult = $shopResult;
        $this->googleAdwordsApi = $googleAdwordsApi;
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
                ],
                'summaryWithoutCurrent' => [
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
                ],
                'summaryWithoutCurrent' => [
                    'value' => intval($dataAnalytics['summaryWithoutCurrent'])
                ]
            ];

        }

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
    private function getAvgClickAnalytics() : int {
        $summary = 0;

        foreach ($this->summaryAnalytics as $key => $params) {
            if ($key === "current") continue;
            $summary += intval($params['click']);
        }


        return intval($summary / $this->datesReport['count']);
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
    private function getAnalyticsResult(Collection $activesCountry, array $currentDate, array $otherDate) : array {
        $currentDateConvert = str_replace("-","", $currentDate['end']);
        $response = [];

        foreach ($activesCountry as $country) {

            if (is_null($country->analytics)) {
                $response[$country->id] = $this->returnFormatAnalytics(null);
                continue;
            }
            $this->analyticsApi
                ->setCountry($country);

            $this->analyticsApi
                ->setDateCurrent($currentDateConvert);

            $resultAnalytics = $this->analyticsApi
                ->getWithManyRangesDate($currentDate, $otherDate);

            $this->setSummaryAnalytics($resultAnalytics);
            $response[$country->id] = $this->returnFormatAnalytics($resultAnalytics);
        }

        return $this->calculateSummaryAnalytics($response);
    }

    private function searchOldestDate(string $date, string $comparisonDate) : string {
        $comparisonTime = strtotime($comparisonDate);
        $currentTime = strtotime($date);

        if ($currentTime > $comparisonTime) {
            return $comparisonDate;
        } else {
            return $date;
        }
    }
    private function createRangesDate(array $currentDate, array $otherDate) : array {

        $this->datesReport = [
            'count' => count($otherDate),
            'current' => $currentDate,
            'last' => $currentDate['start'],
            'newest' => $currentDate['end'],
            'rangesWithoutCurrent' => [],
            'ranges' => [
                'current' => $currentDate
            ],
        ];

        foreach ($otherDate as $key => $date) {
            $this->datesReport['rangesWithoutCurrent'][$key] = $date;
            $this->datesReport['ranges'][$key] = $date;
            $this->datesReport['last'] = $this->searchOldestDate($date['start'], $this->datesReport['last']);
        }

        return $this->datesReport;
    }

    private function removeSummaryWithoutCurrent(array $data) : array {
        if (isset($data['summaryWithoutCurrent'])) unset($data['summaryWithoutCurrent']);

        return $data;
    }
    public function get(array $currentDate, array $otherDate) : array {
        $this->createRangesDate($currentDate, $otherDate);

        $completeReport = [];



        $activesCountry = $this->country
            ->active()
            ->get();

        $analyticsResult = $this->getAnalyticsResult($activesCountry, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);

        $facebookResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->metaAdsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);
        $googleResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->googleAdwordsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);

        $resultShopApi = $this->shopResult
            ->getResultNewset($this->datesReport, $analyticsResult, $facebookResults, $googleResults, $activesCountry);
//Na przyszłość do usuniećea removeSummaryWithoutCurrent

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $this->removeSummaryWithoutCurrent($resultShopApi[$country->id]),
                'global' => $this->removeSummaryWithoutCurrent($analyticsResult[$country->id]),
                'facebook' => $this->removeSummaryWithoutCurrent($facebookResults[$country->id]['click']),
                'costFacebook' => $this->removeSummaryWithoutCurrent($facebookResults[$country->id]['budget']),
                'google' => $this->removeSummaryWithoutCurrent($googleResults[$country->id]['click']),
                'costGoogle' => $this->removeSummaryWithoutCurrent($googleResults[$country->id]['budget']),
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $this->removeSummaryWithoutCurrent($resultShopApi["summary"]),
            'global' => $this->removeSummaryWithoutCurrent($analyticsResult["summary"]),
            'facebook' => $this->removeSummaryWithoutCurrent($facebookResults["summary"]['click']),
            'costFacebook' => $this->removeSummaryWithoutCurrent($facebookResults["summary"]['budget']),
            'google' => $this->removeSummaryWithoutCurrent($googleResults["summary"]['click']),
            'costGoogle' => $this->removeSummaryWithoutCurrent($googleResults["summary"]['budget']),
        ];


        return $completeReport;
    }

}
