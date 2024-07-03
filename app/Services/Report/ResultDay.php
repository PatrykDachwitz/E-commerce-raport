<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Report\ReportDaily\AdwordsResult;
use App\Services\Report\ReportDaily\ShopResult;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Exception;

///Jęzeli brak danych to zrami zapisać co jeśl pojawi siębład kodu httpt lub brak wartosci albo dzepsuty plk
class ResultDay
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

    private function createDatesByCountPreviousDay(string $date, int $countPreviousDay = 30) : array {
        $this->datesReport = [
            'count' => $countPreviousDay,
            'current' => $date,
            'last' => "",
            'ranges' => [],
        ];
        $currentTime = strtotime($date);
        $this->datesReport['ranges'][] = $date;

        for ($i = 1; $i <= $countPreviousDay; $i++) {
            $daySubtraction = (24 * 60 * 60) * $i;

            $this->datesReport['ranges'][] = date("Y-m-d", ($currentTime - $daySubtraction));
            if ($i === $countPreviousDay) $this->datesReport['last'] = date("Y-m-d", ($currentTime - $daySubtraction));
        }

        return $this->datesReport;
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
            return [
                'countClick' => [
                    'value' => intval($dataAnalytics['current'])
                ],
                'avgComparison' => [
                    'value' => intval($dataAnalytics['current'] - $dataAnalytics['avgWithoutCurrent'])
                ],
                'avgLast30Day' => [
                    'value' => intval($dataAnalytics['avgWithoutCurrent'])
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

    public function get(string $date) : array {
        $this->createDatesByCountPreviousDay($date);

        $completeReport = [];

        $resultShopApi = $this->shopResult
            ->getResult($this->datesReport);

        $activesCountry = $this->country
            ->active()
            ->get();

        $analyticsResult = $this->getAnalyticsResult($activesCountry);
        $facebookResults = $this->adwordsResult->getResult($activesCountry, $this->metaAdsApi, $this->datesReport['current'], $this->datesReport['last']);
        $googleResults = $this->adwordsResult->getResult($activesCountry, $this->googleAdwordsApi, $this->datesReport['current'], $this->datesReport['last']);

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
