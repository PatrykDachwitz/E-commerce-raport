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

    private function calculateSummaryAnalytics(array $resultsAnalytics) : array {

        $result = [
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

        foreach ($resultsAnalytics as $key => $resultAnalytics) {
            $result['countClick']['value'] += $resultAnalytics['countClick']['value'];
            $result['minValueLast30Day']['value'] += $resultAnalytics['minValueLast30Day']['value'];
            $result['maxValueLast30Day']['value'] += $resultAnalytics['maxValueLast30Day']['value'];
            $result['summaryWithoutCurrent']['value'] += $resultAnalytics['summaryWithoutCurrent']['value'];
            unset($resultsAnalytics[$key]['summaryWithoutCurrent']);
        }

        $result['avgLast30Day']['value'] = intval($result['summaryWithoutCurrent']['value'] / 30);
        $result['avgComparison']['value'] = intval($result['countClick']['value'] - $result['avgLast30Day']['value']);
        unset($result["summaryWithoutCurrent"]);

        $resultsAnalytics['summary'] = $result;

        return $resultsAnalytics;
    }
    private function getAnalyticsResult(Collection $activesCountry) : array {
        $currentDate = str_replace("-","", $this->datesReport['current']);
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
        ];

        foreach ($otherDate as $key => $date) {
            $this->datesReport['rangesWithoutCurrent'][$key] = $date;
            $this->datesReport['last'] = $this->searchOldestDate($date['start'], $this->datesReport['last']);
        }

        return $this->datesReport;
    }

    public function get(array $currentDate, array $otherDate) : array {
        $this->createRangesDate($currentDate, $otherDate);

        $completeReport = [];



        $activesCountry = $this->country
            ->active()
            ->get();

        //$analyticsResult = $this->getAnalyticsResult($activesCountry);
        $facebookResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->metaAdsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);
        dd($facebookResults);
        $googleResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->googleAdwordsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);

        $resultShopApi = $this->shopResult
            ->getResult($this->datesReport, $analyticsResult, $facebookResults, $googleResults, $activesCountry);

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $resultShopApi[$country->id],
                'global' => $analyticsResult[$country->id],
                'facebook' => $facebookResults[$country->id]['click'],
                'costFacebook' => $facebookResults[$country->id]['budget'],
                'google' => $googleResults[$country->id]['click'],
                'costGoogle' => $googleResults[$country->id]['budget'],
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $resultShopApi["summary"],
            'global' => $analyticsResult["summary"],
            'facebook' => $facebookResults["summary"]['click'],
            'costFacebook' => $facebookResults["summary"]['budget'],
            'google' => $googleResults["summary"]['click'],
            'costGoogle' => $googleResults["summary"]['budget'],
        ];


        return $completeReport;
    }

}
