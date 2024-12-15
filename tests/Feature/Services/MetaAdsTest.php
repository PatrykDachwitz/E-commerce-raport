<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Currency\CoursePLN;
use Database\Seeders\MetaAdsCountrySeed;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(MetaAdsCountrySeed::class);
});

describe('Testing response meta ads services with correct data', function () {

    it("Testing correct calculate data about response api", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
        ]);

        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 361,
                "avgComparisonWithoutCurrent" => 131,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 55,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22" =>
                    [
                        'click' => 200,
                        'spend' => 180

                    ],
                "2024-05-23_2024-05-23" =>
                    [
                        'click' => 450,
                        'spend' => 280

                    ],
                "2024-05-24_2024-05-24" =>
                    [
                        'click' => 200,
                        'spend' => 180

                    ],
                "2024-05-25_2024-05-25" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-26_2024-05-26" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-27_2024-05-27" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-28_2024-05-28" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-29_2024-05-29" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-30_2024-05-30" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-31_2024-05-31" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-01_2024-06-01" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-02_2024-06-02" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-03_2024-06-03" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-04_2024-06-04" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-05_2024-06-05" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-06_2024-06-06" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-07_2024-06-07" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-08_2024-06-08" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-09_2024-06-09" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-10_2024-06-10" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-11_2024-06-11" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-12_2024-06-12" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-13_2024-06-13" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-14_2024-06-14" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-15_2024-06-15" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-16_2024-06-16" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-17_2024-06-17" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-18_2024-06-18" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-19_2024-06-19" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-20_2024-06-20" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "current" =>
                    [
                        'click' => 204,
                        'spend' => 361
                    ]
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi");



    it("Testing correct calculate with cost conversion", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];


        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 1551,
                "avgComparisonWithoutCurrent" => 563,
                "summaryWithoutCurrent" => 29656,
                "avgWithoutCurrent" => 988,
                "minWithoutCurrent" => 773,
                "maxWithoutCurrent" => 1203,
                "spentBudgetFromBeginningOfMonth" => 21322,
                "budgetMonthly" => 57060,
                "percentSpentBudgetMonthlyCurrentDay" => 37,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-05-23_2024-05-23" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-05-24_2024-05-24" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-05-25_2024-05-25" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-05-26_2024-05-26" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-05-27_2024-05-27" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-05-28_2024-05-28" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-05-29_2024-05-29" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-05-30_2024-05-30" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-05-31_2024-05-31" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-01_2024-06-01" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-02_2024-06-02" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-03_2024-06-03" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-04_2024-06-04" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-05_2024-06-05" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-06_2024-06-06" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-07_2024-06-07" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-08_2024-06-08" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-09_2024-06-09" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-10_2024-06-10" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-11_2024-06-11" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-12_2024-06-12" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-13_2024-06-13" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-14_2024-06-14" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-15_2024-06-15" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-16_2024-06-16" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-17_2024-06-17" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-18_2024-06-18" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "2024-06-19_2024-06-19" =>
                    [
                        'click' => 200,
                        'spend' => 773
                    ],
                "2024-06-20_2024-06-20" =>
                    [
                        'click' => 450,
                        'spend' => 1203
                    ],
                "current" =>
                    [
                        'click' => 204,
                        'spend' => 1551
                    ]
            ]
        ];

        $country = Country::find(3);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi");


    it("Testing correct calculate data with 0 count monthly budget", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $summarySpendBudgetMeta,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($summarySpendBudgetMeta)
        ]);


        $dataByRangesWithoutCurrent = [
            "2024-05-22_2024-05-22" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-05-23_2024-05-23" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-05-24_2024-05-24" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-05-25_2024-05-25" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-05-26_2024-05-26" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-05-27_2024-05-27" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-05-28_2024-05-28" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-05-29_2024-05-29" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-05-30_2024-05-30" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-05-31_2024-05-31" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-01_2024-06-01" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-02_2024-06-02" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-03_2024-06-03" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-04_2024-06-04" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-05_2024-06-05" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-06_2024-06-06" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-07_2024-06-07" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-08_2024-06-08" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-09_2024-06-09" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-10_2024-06-10" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-11_2024-06-11" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-12_2024-06-12" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-13_2024-06-13" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-14_2024-06-14" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-15_2024-06-15" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-16_2024-06-16" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-17_2024-06-17" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-18_2024-06-18" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "2024-06-19_2024-06-19" =>
                [
                    'click' => 200,
                    'spend' => 180
                ],
            "2024-06-20_2024-06-20" =>
                [
                    'click' => 450,
                    'spend' => 280
                ],
            "current" =>
                [
                    'click' => 204,
                    'spend' => 361
                ]
        ];

        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 361,
                "avgComparisonWithoutCurrent" => 131,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 100,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => $dataByRangesWithoutCurrent
        ];

        $country = Country::find(2);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', 'metaAdsTemplateDataForJuneResponseApi');



});


describe('Testing response meta ads services with wrong data' , function () {
    it("Testing data with all wrong response api", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
    ) {

        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi, 404)
        ]);


        $dates = [
            '2024-06-21',
            '2024-06-20',
            '2024-06-19',
            '2024-06-18',
            '2024-06-17',
            '2024-06-16',
            '2024-06-15',
            '2024-06-14'
        ];

        $singleDataPerDate = [];
        foreach ($dates as $date) {
            $singleDataPerDate[$date] = [
                'cost' => 0,
                'click' => 0
            ];
        }

        $metaAds = new MetaAdsApi(new CoursePLN());
        $dataByRangesWithoutCurrent = [
            "2024-06-14_2024-06-14" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-15_2024-06-15" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-16_2024-06-16" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-17_2024-06-17" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-18_2024-06-18" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-19_2024-06-19" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-20_2024-06-20" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "current" =>
                [
                    'click' => 0,
                    'spend' => 0
                ]
        ];
        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dates" => $singleDataPerDate,
            "dataByRangesWithoutCurrent" => $dataByRangesWithoutCurrent,
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay');

    it("Testing data without current date", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
        ]);

        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>0,'cost'=>0]
        ];

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -325,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => -230,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 55,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22" =>
                    [
                        'click' => 200,
                        'spend' => 180

                    ],
                "2024-05-23_2024-05-23" =>
                    [
                        'click' => 450,
                        'spend' => 280

                    ],
                "2024-05-24_2024-05-24" =>
                    [
                        'click' => 200,
                        'spend' => 180

                    ],
                "2024-05-25_2024-05-25" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-26_2024-05-26" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-27_2024-05-27" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-28_2024-05-28" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-29_2024-05-29" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-30_2024-05-30" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-31_2024-05-31" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-01_2024-06-01" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-02_2024-06-02" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-03_2024-06-03" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-04_2024-06-04" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-05_2024-06-05" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-06_2024-06-06" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-07_2024-06-07" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-08_2024-06-08" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-09_2024-06-09" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-10_2024-06-10" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-11_2024-06-11" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-12_2024-06-12" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-13_2024-06-13" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-14_2024-06-14" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-15_2024-06-15" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-16_2024-06-16" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-17_2024-06-17" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-18_2024-06-18" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-19_2024-06-19" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-20_2024-06-20" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "current" =>
                    [
                        'click' => 0,
                        'spend' => 0
                    ]
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi");



    it("Testing data with all zero content response api", function () {

        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response("", 200),
        ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        $dates = [
            '2024-06-21',
            '2024-06-20',
            '2024-06-19',
            '2024-06-18',
            '2024-06-17',
            '2024-06-16',
            '2024-06-15',
            '2024-06-14'
        ];

        $singleDataPerDate = [];
        foreach ($dates as $date) {
            $singleDataPerDate[$date] = [
                'cost' => 0,
                'click' => 0
            ];
        }

        $dataByRangesWithoutCurrent = [
            "2024-06-14_2024-06-14" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-15_2024-06-15" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-16_2024-06-16" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-17_2024-06-17" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-18_2024-06-18" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-19_2024-06-19" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "2024-06-20_2024-06-20" =>
                [
                    'click' => 0,
                    'spend' => 0
                ],
            "current" =>
                [
                    'click' => 0,
                    'spend' => 0
                ]
        ];
        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dates" => $singleDataPerDate,
            "dataByRangesWithoutCurrent" => $dataByRangesWithoutCurrent,
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    });
});

describe("Testing response api for many date with correct data", function () {

    it("Testing correct calculate data about response api", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($metaAdsTemplateDataForFourthDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($metaAdsTemplateDataForThirdDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($metaAdsTemplateDataForSecondDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($metaAdsTemplateDataForCurrentDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($metaFullMonthResponse),
            ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
       // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 120,
                "summaryWithoutCurrent" => 954,
                "avgWithoutCurrent" => 238,
                "avgComparisonWithoutCurrent" => -118,
                "minWithoutCurrent" => 100,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 60,
                "avgComparisonWithoutCurrent" => -164,
                "summaryWithoutCurrent" => 897,
                "avgWithoutCurrent" => 224,
                "minWithoutCurrent" => 76,
                "maxWithoutCurrent" => 361,
                "spentBudgetFromBeginningOfMonth" => 957,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 10,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 120,
                    'spend' => 60,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 204,
                    'spend' => 361,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 450,
                    'spend' => 280,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 200,
                    'spend' => 180,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 100,
                    'spend' => 76,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");


    it("Testing correct calculate data with zero response api", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response(""),
            ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
       // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 0,
                    'spend' => 0,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");


    it("Testing correct calculate data with deficit response api", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($metaAdsTemplateDataForFourthDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($metaAdsTemplateDataForSecondDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($metaFullMonthResponse),
            ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
       // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 120,
                "summaryWithoutCurrent" => 650,
                "avgWithoutCurrent" => 162,
                "avgComparisonWithoutCurrent" => -42,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 60,
                "avgComparisonWithoutCurrent" => -55,
                "summaryWithoutCurrent" => 460,
                "avgWithoutCurrent" => 115,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 957,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 10,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 120,
                    'spend' => 60,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 450,
                    'spend' => 280,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 200,
                    'spend' => 180,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 0,
                    'spend' => 0,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");


    it("Testing correct calculate data about response api many range without current", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($metaAdsTemplateDataForThirdDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($metaAdsTemplateDataForSecondDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($metaAdsTemplateDataForCurrentDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($metaFullMonthResponse),
            ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
       // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 954,
                "avgWithoutCurrent" => 238,
                "avgComparisonWithoutCurrent" => -238,
                "minWithoutCurrent" => 100,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => -224,
                "summaryWithoutCurrent" => 897,
                "avgWithoutCurrent" => 224,
                "minWithoutCurrent" => 76,
                "maxWithoutCurrent" => 361,
                "spentBudgetFromBeginningOfMonth" => 957,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 10,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 204,
                    'spend' => 361,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 450,
                    'spend' => 280,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 200,
                    'spend' => 180,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 100,
                    'spend' => 76,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");



    it("Testing correct calculate data with spend in RON", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($metaAdsTemplateDataForFourthDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($metaAdsTemplateDataForThirdDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($metaAdsTemplateDataForSecondDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($metaAdsTemplateDataForCurrentDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($metaFullMonthResponse),
        ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
        // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 120,
                "summaryWithoutCurrent" => 954,
                "avgWithoutCurrent" => 238,
                "avgComparisonWithoutCurrent" => -118,
                "minWithoutCurrent" => 100,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 51,
                "avgComparisonWithoutCurrent" => -142,
                "summaryWithoutCurrent" => 774,
                "avgWithoutCurrent" => 193,
                "minWithoutCurrent" => 65,
                "maxWithoutCurrent" => 311,
                "spentBudgetFromBeginningOfMonth" => 826,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 8,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 120,
                    'spend' => 51,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 204,
                    'spend' => 311,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 450,
                    'spend' => 241,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 200,
                    'spend' => 155,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 100,
                    'spend' => 65,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(4);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");

});


describe('Testing variant country with 2 account', function () {
    it("Testing correct calculate", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
        string $metaAdsTemplateDataForCurrentDayForVariantDoubleAccount,
        string $metaAdsTemplateDataForOneDayForVariantDoubleAccount,
        string $metaAdsTemplateDataForSecondDayForVariantDoubleAccount,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($metaAdsTemplateDataForSecondDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($metaAdsTemplateDataForOneDayForVariantDoubleAccount),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForCurrentDayForVariantDoubleAccount),


        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>323,'cost'=>190],
            "2024-05-23"=> ['click'=>552,'cost'=>360],
            "2024-05-24"=> ['click'=>323,'cost'=>190],
            "2024-05-25"=> ['click'=>552,'cost'=>360],
            "2024-05-26"=> ['click'=>323,'cost'=>190],
            "2024-05-27"=> ['click'=>552,'cost'=>360],
            "2024-05-28"=> ['click'=>323,'cost'=>190],
            "2024-05-29"=> ['click'=>552,'cost'=>360],
            "2024-05-30"=> ['click'=>323,'cost'=>190],
            "2024-05-31"=> ['click'=>552,'cost'=>360],
            "2024-06-01"=> ['click'=>323,'cost'=>190],
            "2024-06-02"=> ['click'=>552,'cost'=>360],
            "2024-06-03"=> ['click'=>323,'cost'=>190],
            "2024-06-04"=> ['click'=>552,'cost'=>360],
            "2024-06-05"=> ['click'=>323,'cost'=>190],
            "2024-06-06"=> ['click'=>552,'cost'=>360],
            "2024-06-07"=> ['click'=>323,'cost'=>190],
            "2024-06-08"=> ['click'=>552,'cost'=>360],
            "2024-06-09"=> ['click'=>323,'cost'=>190],
            "2024-06-10"=> ['click'=>552,'cost'=>360],
            "2024-06-11"=> ['click'=>323,'cost'=>190],
            "2024-06-12"=> ['click'=>552,'cost'=>360],
            "2024-06-13"=> ['click'=>323,'cost'=>190],
            "2024-06-14"=> ['click'=>552,'cost'=>360],
            "2024-06-15"=> ['click'=>323,'cost'=>190],
            "2024-06-16"=> ['click'=>552,'cost'=>360],
            "2024-06-17"=> ['click'=>323,'cost'=>190],
            "2024-06-18"=> ['click'=>552,'cost'=>360],
            "2024-06-19"=> ['click'=>323,'cost'=>190],
            "2024-06-20"=> ['click'=>552,'cost'=>360],
            "2024-06-21"=> ['click'=>354,'cost'=>403]
        ];


        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 354,
                "summaryWithoutCurrent" => 13125,
                "avgWithoutCurrent" => 437,
                "avgComparisonWithoutCurrent" => -83,
                "minWithoutCurrent" => 323,
                "maxWithoutCurrent" => 552,
            ],
            "budget" => [
                'current' => 403,
                "avgComparisonWithoutCurrent" => 128,
                "summaryWithoutCurrent" => 8250,
                "avgWithoutCurrent" => 275,
                "minWithoutCurrent" => 190,
                "maxWithoutCurrent" => 360,
                "spentBudgetFromBeginningOfMonth" => 9922,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 110,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22"=> ['click'=>323,'spend'=>190],
                "2024-05-23_2024-05-23"=> ['click'=>552,'spend'=>360],
                "2024-05-24_2024-05-24"=> ['click'=>323,'spend'=>190],
                "2024-05-25_2024-05-25"=> ['click'=>552,'spend'=>360],
                "2024-05-26_2024-05-26"=> ['click'=>323,'spend'=>190],
                "2024-05-27_2024-05-27"=> ['click'=>552,'spend'=>360],
                "2024-05-28_2024-05-28"=> ['click'=>323,'spend'=>190],
                "2024-05-29_2024-05-29"=> ['click'=>552,'spend'=>360],
                "2024-05-30_2024-05-30"=> ['click'=>323,'spend'=>190],
                "2024-05-31_2024-05-31"=> ['click'=>552,'spend'=>360],
                "2024-06-01_2024-06-01"=> ['click'=>323,'spend'=>190],
                "2024-06-02_2024-06-02"=> ['click'=>552,'spend'=>360],
                "2024-06-03_2024-06-03"=> ['click'=>323,'spend'=>190],
                "2024-06-04_2024-06-04"=> ['click'=>552,'spend'=>360],
                "2024-06-05_2024-06-05"=> ['click'=>323,'spend'=>190],
                "2024-06-06_2024-06-06"=> ['click'=>552,'spend'=>360],
                "2024-06-07_2024-06-07"=> ['click'=>323,'spend'=>190],
                "2024-06-08_2024-06-08"=> ['click'=>552,'spend'=>360],
                "2024-06-09_2024-06-09"=> ['click'=>323,'spend'=>190],
                "2024-06-10_2024-06-10"=> ['click'=>552,'spend'=>360],
                "2024-06-11_2024-06-11"=> ['click'=>323,'spend'=>190],
                "2024-06-12_2024-06-12"=> ['click'=>552,'spend'=>360],
                "2024-06-13_2024-06-13"=> ['click'=>323,'spend'=>190],
                "2024-06-14_2024-06-14"=> ['click'=>552,'spend'=>360],
                "2024-06-15_2024-06-15"=> ['click'=>323,'spend'=>190],
                "2024-06-16_2024-06-16"=> ['click'=>552,'spend'=>360],
                "2024-06-17_2024-06-17"=> ['click'=>323,'spend'=>190],
                "2024-06-18_2024-06-18"=> ['click'=>552,'spend'=>360],
                "2024-06-19_2024-06-19"=> ['click'=>323,'spend'=>190],
                "2024-06-20_2024-06-20"=> ['click'=>552,'spend'=>360],
                "current"=> ['click'=>354,'spend'=>403]
            ]
        ];

        $country = Country::find(5);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi", 'metaAdsTemplateDataForCurrentDayForVariantDoubleAccount', 'metaAdsTemplateDataForOneDayForVariantDoubleAccount', 'metaAdsTemplateDataForSecondDayForVariantDoubleAccount');

    it("Testing calculate for empty response", function () {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>0,'cost'=>0],
            "2024-05-23"=> ['click'=>0,'cost'=>0],
            "2024-05-24"=> ['click'=>0,'cost'=>0],
            "2024-05-25"=> ['click'=>0,'cost'=>0],
            "2024-05-26"=> ['click'=>0,'cost'=>0],
            "2024-05-27"=> ['click'=>0,'cost'=>0],
            "2024-05-28"=> ['click'=>0,'cost'=>0],
            "2024-05-29"=> ['click'=>0,'cost'=>0],
            "2024-05-30"=> ['click'=>0,'cost'=>0],
            "2024-05-31"=> ['click'=>0,'cost'=>0],
            "2024-06-01"=> ['click'=>0,'cost'=>0],
            "2024-06-02"=> ['click'=>0,'cost'=>0],
            "2024-06-03"=> ['click'=>0,'cost'=>0],
            "2024-06-04"=> ['click'=>0,'cost'=>0],
            "2024-06-05"=> ['click'=>0,'cost'=>0],
            "2024-06-06"=> ['click'=>0,'cost'=>0],
            "2024-06-07"=> ['click'=>0,'cost'=>0],
            "2024-06-08"=> ['click'=>0,'cost'=>0],
            "2024-06-09"=> ['click'=>0,'cost'=>0],
            "2024-06-10"=> ['click'=>0,'cost'=>0],
            "2024-06-11"=> ['click'=>0,'cost'=>0],
            "2024-06-12"=> ['click'=>0,'cost'=>0],
            "2024-06-13"=> ['click'=>0,'cost'=>0],
            "2024-06-14"=> ['click'=>0,'cost'=>0],
            "2024-06-15"=> ['click'=>0,'cost'=>0],
            "2024-06-16"=> ['click'=>0,'cost'=>0],
            "2024-06-17"=> ['click'=>0,'cost'=>0],
            "2024-06-18"=> ['click'=>0,'cost'=>0],
            "2024-06-19"=> ['click'=>0,'cost'=>0],
            "2024-06-20"=> ['click'=>0,'cost'=>0],
            "2024-06-21"=> ['click'=>0,'cost'=>0]
        ];


        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22"=> ['click'=>0,'spend'=>0],
                "2024-05-23_2024-05-23"=> ['click'=>0,'spend'=>0],
                "2024-05-24_2024-05-24"=> ['click'=>0,'spend'=>0],
                "2024-05-25_2024-05-25"=> ['click'=>0,'spend'=>0],
                "2024-05-26_2024-05-26"=> ['click'=>0,'spend'=>0],
                "2024-05-27_2024-05-27"=> ['click'=>0,'spend'=>0],
                "2024-05-28_2024-05-28"=> ['click'=>0,'spend'=>0],
                "2024-05-29_2024-05-29"=> ['click'=>0,'spend'=>0],
                "2024-05-30_2024-05-30"=> ['click'=>0,'spend'=>0],
                "2024-05-31_2024-05-31"=> ['click'=>0,'spend'=>0],
                "2024-06-01_2024-06-01"=> ['click'=>0,'spend'=>0],
                "2024-06-02_2024-06-02"=> ['click'=>0,'spend'=>0],
                "2024-06-03_2024-06-03"=> ['click'=>0,'spend'=>0],
                "2024-06-04_2024-06-04"=> ['click'=>0,'spend'=>0],
                "2024-06-05_2024-06-05"=> ['click'=>0,'spend'=>0],
                "2024-06-06_2024-06-06"=> ['click'=>0,'spend'=>0],
                "2024-06-07_2024-06-07"=> ['click'=>0,'spend'=>0],
                "2024-06-08_2024-06-08"=> ['click'=>0,'spend'=>0],
                "2024-06-09_2024-06-09"=> ['click'=>0,'spend'=>0],
                "2024-06-10_2024-06-10"=> ['click'=>0,'spend'=>0],
                "2024-06-11_2024-06-11"=> ['click'=>0,'spend'=>0],
                "2024-06-12_2024-06-12"=> ['click'=>0,'spend'=>0],
                "2024-06-13_2024-06-13"=> ['click'=>0,'spend'=>0],
                "2024-06-14_2024-06-14"=> ['click'=>0,'spend'=>0],
                "2024-06-15_2024-06-15"=> ['click'=>0,'spend'=>0],
                "2024-06-16_2024-06-16"=> ['click'=>0,'spend'=>0],
                "2024-06-17_2024-06-17"=> ['click'=>0,'spend'=>0],
                "2024-06-18_2024-06-18"=> ['click'=>0,'spend'=>0],
                "2024-06-19_2024-06-19"=> ['click'=>0,'spend'=>0],
                "2024-06-20_2024-06-20"=> ['click'=>0,'spend'=>0],
                "current"=> ['click'=>0,'spend'=>0]
            ]
        ];

        $country = Country::find(5);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    });

    it("Testing calculate with empty data for subaccount", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $summarySpendBudgetMeta,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($summarySpendBudgetMeta),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response(""),
            "https://graph.facebook.com/v20.0/act_1231231231/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response(""),
        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];


        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 361,
                "avgComparisonWithoutCurrent" => 131,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 100,
            ],
            "dates" => $dataPerDates,
            "dataByRangesWithoutCurrent" => [
                "2024-05-22_2024-05-22" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-23_2024-05-23" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-24_2024-05-24" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-25_2024-05-25" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-26_2024-05-26" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-27_2024-05-27" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-28_2024-05-28" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-29_2024-05-29" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-05-30_2024-05-30" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-05-31_2024-05-31" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-01_2024-06-01" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-02_2024-06-02" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-03_2024-06-03" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-04_2024-06-04" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-05_2024-06-05" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-06_2024-06-06" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-07_2024-06-07" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-08_2024-06-08" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-09_2024-06-09" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-10_2024-06-10" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-11_2024-06-11" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-12_2024-06-12" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-13_2024-06-13" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-14_2024-06-14" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-15_2024-06-15" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-16_2024-06-16" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-17_2024-06-17" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-18_2024-06-18" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "2024-06-19_2024-06-19" =>
                    [
                        'click' => 200,
                        'spend' => 180
                    ],
                "2024-06-20_2024-06-20" =>
                    [
                        'click' => 450,
                        'spend' => 280
                    ],
                "current" =>
                    [
                        'click' => 204,
                        'spend' => 361
                    ]
            ]
        ];

        $country = Country::find(6);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', 'metaAdsTemplateDataForJuneResponseApi');

});
