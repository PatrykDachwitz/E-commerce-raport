<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\GoogleAdwordsApi;
use Database\Seeders\GoogleAdsCountrySeed;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(GoogleAdsCountrySeed::class);
});
//wEryfikacja co jeśli wartości są zerowa albo brakuje do budżetu dziennego
describe('Testing response Google ads services with correct data', function () {
    //Tutaj trzeba zweryfkowc kilka dni w popszednim miesiacu sprawdzić założenie eistenijaće g budżetu ale braku statystyk dal tego konta
    //Pamietąc że nie któę kraje mająwiecej niż jedno konto
    //Jakośc weryfikować ilość wydanej kasy naet gdy ostanie 30 dni nie łapią sięw nasyzm zakresie dat

/*
    it("Testing correct calculate data about response api", function (
        string $currentDateResponseApi,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
            ]);



        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 147,
                "summaryWithoutCurrent" => 1097,
                "avgWithoutCurrent" => 182,
                "avgComparisonWithoutCurrent" => -35,
                "minWithoutCurrent" => 148,
                "maxWithoutCurrent" => 220,
            ],
            "budget" => [
                'current' => 617,
                "avgComparisonWithoutCurrent" => -374,
                "summaryWithoutCurrent" => 5949,
                "avgWithoutCurrent" => 991,
                "minWithoutCurrent" => 735,
                "maxWithoutCurrent" => 1164,
                "spentBudgetFromBeginningOfMonth" => 6566,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 72,
            ]
        ];

        $country = Country::find(1);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })->with('googleAdwordsResponseApi');





    it("Testing correct calculate data with 0 count monthly budget", function (
        string $currentDateResponseApi,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
        ]);


        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 147,
                "summaryWithoutCurrent" => 1097,
                "avgWithoutCurrent" => 182,
                "avgComparisonWithoutCurrent" => -35,
                "minWithoutCurrent" => 148,
                "maxWithoutCurrent" => 220,
            ],
            "budget" => [
                'current' => 617,
                "avgComparisonWithoutCurrent" => -374,
                "summaryWithoutCurrent" => 5949,
                "avgWithoutCurrent" => 991,
                "minWithoutCurrent" => 735,
                "maxWithoutCurrent" => 1164,
                "spentBudgetFromBeginningOfMonth" => 6566,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 100,
            ]
        ];

        $country = Country::find(2);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);
    })->with('googleAdwordsResponseApi');

      */  it("Testing correct calculate data for many ranges Date", function (
            string $currentDateResponseApi,
        ) {

            Http::fake([
                "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
            ]);

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

            $googleAds = new GoogleAdwordsApi();

            $metaData = [
                'click' => [
                    'current' => 300,
                    "summaryWithoutCurrent" => 1244,
                    "avgWithoutCurrent" => 311,
                    "avgComparisonWithoutCurrent" => -11,
                    "minWithoutCurrent" => 0,
                    "maxWithoutCurrent" => 424,
                ],
                "budget" => [
                    'current' => 2234,
                    "avgComparisonWithoutCurrent" => 329,
                    "summaryWithoutCurrent" => 7621,
                    "avgWithoutCurrent" => 1905,
                    "minWithoutCurrent" => 0,
                    "maxWithoutCurrent" => 3328,
                    "spentBudgetFromBeginningOfMonth" => 3233,
                    "budgetMonthly" => 9300,
                    "percentSpentBudgetMonthlyCurrentDay" => 34,
                ]
            ];

            $country = Country::find(1);
            expect($googleAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
                ->toMatchArray($metaData);

        })->with('googleAdwordsResponseApiJune');


});

/*
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
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi, 404)
        ]);



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
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay');

    it("Testing data with all zero content response api", function () {

        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response("", 200)
        ]);



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
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    });
});*/
