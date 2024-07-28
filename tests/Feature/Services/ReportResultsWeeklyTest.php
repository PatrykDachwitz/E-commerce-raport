<?php

declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Connection\Shop;
use App\Services\Currency\CoursePLN;
use App\Services\Report\Support\AdwordsResult;
use App\Services\Report\Support\ShopResult;
use App\Services\Report\ResultWeekly;
use App\Services\ShopSales;
use Database\Seeders\WeeklyReport;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(WeeklyReport::class);
});

/*test("Verification response Weekly report with current data", function (
    string $shopReportWeeklyCurrentResponse,
    string $shopReportWeeklyFirstResponse,
    string $shopReportWeeklySecondResponse,
    string $shopReportWeeklyThirdResponse,
    string $shopReportWeeklyFourthResponse,
    string $facebookReportWeeklyCurrentResponse,
    string $facebookReportWeeklyFirstResponse,
    string $facebookReportWeeklySecondResponse,
    string $facebookReportWeeklyThirdResponse,
    string $facebookReportWeeklyFourthResponse,
    string $metaFullMonthResponse,
    string $analyticsReportWeeklyPolandResponse,
    string $analyticsReportWeeklyGermanyResponse,
    string $analyticsReportWeeklyRomaniaResponse,
    string $adwordsGoogleReportWeeklyPolandResponse,
    string $adwordsGoogleReportWeeklyGermanyResponse,
    string $adwordsGoogleReportWeeklyRomaniaResponse,
) {
/*
    Http::fake([
        "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyPolandResponse),
        "https://googleads.googleapis.com/v17/customers/123326321/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyGermanyResponse),
        "https://googleads.googleapis.com/v17/customers/123327821/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyRomaniaResponse),
        config('api.shop') . "?start=2024-07-05&end=2024-07-07" => Http::response($shopReportWeeklyCurrentResponse),
        config('api.shop') . "?start=2024-06-28&end=2024-06-30" => Http::response($shopReportWeeklyFirstResponse),
        config('api.shop') . "?start=2024-06-21&end=2024-06-23" => Http::response($shopReportWeeklySecondResponse),
        config('api.shop') . "?start=2024-06-14&end=2024-06-16" => Http::response($shopReportWeeklyThirdResponse),
        config('api.shop') . "?start=2024-06-07&end=2024-06-09" => Http::response($shopReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyCurrentResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($facebookReportWeeklyFirstResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($facebookReportWeeklyThirdResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($facebookReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyCurrentResponse),

        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyFirstResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($facebookReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklySecondResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/123545:runReport" => Http::response($analyticsReportWeeklyPolandResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/12354775:runReport" => Http::response($analyticsReportWeeklyGermanyResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/123547756:runReport" => Http::response($analyticsReportWeeklyRomaniaResponse),
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
    $expectResult = [
        [
            "country" => "Polska",
            "shop" => [
                "shopSales" => [
                    "value" => 52246,
                    "art" => 432
                ],
                "avgComparison" => [
                    "value" => 14307,
                    "art" => 389
                ],
                "avgLast30Day" => [
                    "value" => 37939,
                    "art" => 43
                ],
                "minValueLast30Day" => [
                    "value" => 21,
                    "art" => 10
                ],
                "maxValueLast30Day" => [
                    "value" => 99076,
                    "art" => 120
                ],
                "costShare" => [
                    "value" => 1.61
                ],
                "comparisonClickToCost" => [
                    "value" => 7.49
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 36506
                ],
                'avgComparison' => [
                    'value' => 10061
                ],
                'avgLast30Day' => [
                    'value' => 26445
                ],
                'minValueLast30Day' => [
                    'value' => 18626
                ],
                'maxValueLast30Day' => [
                    'value' => 36604
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 60
                ],
                'avgComparison' => [
                    'value' => -496
                ],
                'avgLast30Day' => [
                    'value' => 556
                ],
                'minValueLast30Day' => [
                    'value' => 514
                ],
                'maxValueLast30Day' => [
                    'value' => 600
                ],
                'costFromBeginningMonth' => [
                    'value' => 60
                ],
                'budgetMonth' => [
                    'value' => 3100
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 1
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 120
                ],
                'avgComparison' => [
                    'value' => -28
                ],
                'avgLast30Day' => [
                    'value' => 148
                ],
                'minValueLast30Day' => [
                    'value' => 137
                ],
                'maxValueLast30Day' => [
                    'value' => 160
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 784
                ],
                'avgComparison' => [
                    'value' => -301
                ],
                'avgLast30Day' => [
                    'value' => 1085
                ],
                'minValueLast30Day' => [
                    'value' => 796
                ],
                'maxValueLast30Day' => [
                    'value' => 1231
                ],
                'costFromBeginningMonth' => [
                    'value' => 784
                ],
                'budgetMonth' => [
                    'value' => 4650
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 16
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 89
                ],
                'avgComparison' => [
                    'value' => -93
                ],
                'avgLast30Day' => [
                    'value' => 182
                ],
                'minValueLast30Day' => [
                    'value' => 142
                ],
                'maxValueLast30Day' => [
                    'value' => 214
                ]
            ]
        ],
        [
            "country" => "Niemcy",
            "shop" => [
                "shopSales" => [
                    "value" => 34662,
                    "art" => 3455
                ],
                "avgComparison" => [
                    "value" => -2501099240,
                    "art" => 3069
                ],
                "avgLast30Day" => [
                    "value" => 2501133902,
                    "art" => 386
                ],
                "minValueLast30Day" => [
                    "value" => 414,
                    "art" => 2
                ],
                "maxValueLast30Day" => [
                    "value" => 9999987446,
                    "art" => 990
                ],
                "costShare" => [
                    "value" => 5.81
                ],
                "comparisonClickToCost" => [
                    "value" => 7.49
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 46095
                ],
                'avgComparison' => [
                    'value' => 22687
                ],
                'avgLast30Day' => [
                    'value' => 23408
                ],
                'minValueLast30Day' => [
                    'value' => 4755
                ],
                'maxValueLast30Day' => [
                    'value' => 42162
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 600
                ],
                'avgComparison' => [
                    'value' => 187
                ],
                'avgLast30Day' => [
                    'value' => 413
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 570
                ],
                'costFromBeginningMonth' => [
                    'value' => 570
                ],
                'budgetMonth' => [
                    'value' => 2480
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 22
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 160
                ],
                'avgComparison' => [
                    'value' => 50
                ],
                'avgLast30Day' => [
                    'value' => 110
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 152
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 1414
                ],
                'avgComparison' => [
                    'value' => 511
                ],
                'avgLast30Day' => [
                    'value' => 903
                ],
                'minValueLast30Day' => [
                    'value' => 756
                ],
                'maxValueLast30Day' => [
                    'value' => 1220
                ],
                'costFromBeginningMonth' => [
                    'value' => 1414
                ],
                'budgetMonth' => [
                    'value' => 3720
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 38
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 51
                ],
                'avgComparison' => [
                    'value' => -70
                ],
                'avgLast30Day' => [
                    'value' => 121
                ],
                'minValueLast30Day' => [
                    'value' => 71
                ],
                'maxValueLast30Day' => [
                    'value' => 175
                ]
            ]
        ],
        [
            "country" => "Rumunia",
            "shop" => [
                "shopSales" => [
                    "value" => 62346,
                    "art" => 23443
                ],
                "avgComparison" => [
                    "value" => 58374,
                    "art" => 23354
                ],
                "avgLast30Day" => [
                    "value" => 3972,
                    "art" => 89
                ],
                "minValueLast30Day" => [
                    "value" => 189,
                    "art" => 12
                ],
                "maxValueLast30Day" => [
                    "value" => 12532,
                    "art" => 190
                ],
                "costShare" => [
                    "value" => 2.44
                ],
                "comparisonClickToCost" => [
                    "value" => 52.14
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 44955
                ],
                'avgComparison' => [
                    'value' => 17686
                ],
                'avgLast30Day' => [
                    'value' => 27269
                ],
                'minValueLast30Day' => [
                    'value' => 13824
                ],
                'maxValueLast30Day' => [
                    'value' => 45879
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "facebook" => [
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
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 1525
                ],
                'avgComparison' => [
                    'value' => 358
                ],
                'avgLast30Day' => [
                    'value' => 1167
                ],
                'minValueLast30Day' => [
                    'value' => 1014
                ],
                'maxValueLast30Day' => [
                    'value' => 1269
                ],
                'costFromBeginningMonth' => [
                    'value' => 1525
                ],
                'budgetMonth' => [
                    'value' => 2480
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 61
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 137
                ],
                'avgComparison' => [
                    'value' => 10
                ],
                'avgLast30Day' => [
                    'value' => 127
                ],
                'minValueLast30Day' => [
                    'value' => 72
                ],
                'maxValueLast30Day' => [
                    'value' => 161
                ]
            ]
        ],
        [
            "country" => "B2B",
            "shop" => [
                "shopSales" => [
                    "value" => 3463,
                    "art" => 133
                ],
                "avgComparison" => [
                    "value" => -4302,
                    "art" => 76
                ],
                "avgLast30Day" => [
                    "value" => 7765,
                    "art" => 57
                ],
                "minValueLast30Day" => [
                    "value" => 180,
                    "art" => 1
                ],
                "maxValueLast30Day" => [
                    "value" => 23555,
                    "art" => 190
                ],
                "costShare" => [
                    "value" => '-'
                ],
                "comparisonClickToCost" => [
                    "value" => '-'
                ]
            ],
            "global" => [
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
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "facebook" => [
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
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "google" => [
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
            ]
        ],
        [
            "country" => "summary",
            "shop" => [
                "shopSales" => [
                    "value" => 149254,
                    "art" => 27330
                ],
                "avgComparison" => [
                    "value" => -2501034325,
                    "art" => 26754
                ],
                "avgLast30Day" => [
                    "value" => 2501183579,
                    "art" => 576
                ],
                "minValueLast30Day" => [
                    "value" => 624,
                    "art" => 35
                ],
                "maxValueLast30Day" => [
                    "value" => 10000087502,
                    "art" => 1190
                ],
                "costShare" => [
                    "value" => 2.93
                ],
                "comparisonClickToCost" => [
                    "value" => 21.42
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 127556
                ],
                'avgComparison' => [
                    'value' => 50433
                ],
                'avgLast30Day' => [
                    'value' => 77123
                ],
                'minValueLast30Day' => [
                    'value' => 55183
                ],
                'maxValueLast30Day' => [
                    'value' => 97938
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 660
                ],
                'avgComparison' => [
                    'value' => -309
                ],
                'avgLast30Day' => [
                    'value' => 969
                ],
                'minValueLast30Day' => [
                    'value' => 514
                ],
                'maxValueLast30Day' => [
                    'value' => 1140
                ],
                'costFromBeginningMonth' => [
                    'value' => 630
                ],
                'budgetMonth' => [
                    'value' => 5580
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 11
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 280
                ],
                'avgComparison' => [
                    'value' => 22
                ],
                'avgLast30Day' => [
                    'value' => 258
                ],
                'minValueLast30Day' => [
                    'value' => 137
                ],
                'maxValueLast30Day' => [
                    'value' => 304
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 3723
                ],
                'avgComparison' => [
                    'value' => 567
                ],
                'avgLast30Day' => [
                    'value' => 3156
                ],
                'minValueLast30Day' => [
                    'value' => 2747
                ],
                'maxValueLast30Day' => [
                    'value' => 3463
                ],
                'costFromBeginningMonth' => [
                    'value' => 3723
                ],
                'budgetMonth' => [
                    'value' => 10850
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 34
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 277
                ],
                'avgComparison' => [
                    'value' => -154
                ],
                'avgLast30Day' => [
                    'value' => 431
                ],
                'minValueLast30Day' => [
                    'value' => 361
                ],
                'maxValueLast30Day' => [
                    'value' => 505
                ]
            ]
        ]
    ];

   // $reportWeekly = new ResultWeekly();

    expect(
      //  $reportWeekly
      //  ->get($rangesDate, $rangesOtherDate)
    )
        ->toMatchArray($expectResult);


})->with('shopReportWeeklyCurrentResponse', 'shopReportWeeklyFirstResponse', 'shopReportWeeklySecondResponse', 'shopReportWeeklyThirdResponse', 'shopReportWeeklyFourthResponse', 'facebookReportWeeklyCurrentResponse', 'facebookReportWeeklyFirstResponse', 'facebookReportWeeklySecondResponse', 'facebookReportWeeklyThirdResponse', 'facebookReportWeeklyFourthResponse', 'metaFullMonthResponse', 'analyticsReportWeeklyPolandResponse', 'analyticsReportWeeklyGermanyResponse', 'analyticsReportWeeklyRomaniaResponse', 'adwordsGoogleReportWeeklyPolandResponse', 'adwordsGoogleReportWeeklyGermanyResponse', 'adwordsGoogleReportWeeklyRomaniaResponse');*/


it('Verification response Weekly report with current data', function(
    string $shopReportWeeklyCurrentResponse,
    string $shopReportWeeklyFirstResponse,
    string $shopReportWeeklySecondResponse,
    string $shopReportWeeklyThirdResponse,
    string $shopReportWeeklyFourthResponse,
    string $facebookReportWeeklyCurrentResponse,
    string $facebookReportWeeklyFirstResponse,
    string $facebookReportWeeklySecondResponse,
    string $facebookReportWeeklyThirdResponse,
    string $facebookReportWeeklyFourthResponse,
    string $analyticsReportWeeklyPolandResponse,
    string $analyticsReportWeeklyGermanyResponse,
    string $analyticsReportWeeklyRomaniaResponse,
    string $adwordsGoogleReportWeeklyPolandResponse,
    string $adwordsGoogleReportWeeklyGermanyResponse,
    string $adwordsGoogleReportWeeklyRomaniaResponse,
) {
    Http::fake([
        "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyPolandResponse),
        "https://googleads.googleapis.com/v17/customers/123326321/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyGermanyResponse),
        "https://googleads.googleapis.com/v17/customers/123327821/googleAds:searchStream" => Http::response($adwordsGoogleReportWeeklyRomaniaResponse),
        config('api.shop') . "?start=2024-07-05&end=2024-07-07" => Http::response($shopReportWeeklyCurrentResponse),
        config('api.shop') . "?start=2024-06-28&end=2024-06-30" => Http::response($shopReportWeeklyFirstResponse),
        config('api.shop') . "?start=2024-06-21&end=2024-06-23" => Http::response($shopReportWeeklySecondResponse),
        config('api.shop') . "?start=2024-06-14&end=2024-06-16" => Http::response($shopReportWeeklyThirdResponse),
        config('api.shop') . "?start=2024-06-07&end=2024-06-09" => Http::response($shopReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyCurrentResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($facebookReportWeeklyFirstResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($facebookReportWeeklyThirdResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($facebookReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyCurrentResponse),

        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklyFirstResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($facebookReportWeeklyFourthResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($facebookReportWeeklySecondResponse),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response(""),
        "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($facebookReportWeeklySecondResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/123545:runReport" => Http::response($analyticsReportWeeklyPolandResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/12354775:runReport" => Http::response($analyticsReportWeeklyGermanyResponse),
        "https://analyticsdata.googleapis.com/v1beta/properties/123547756:runReport" => Http::response($analyticsReportWeeklyRomaniaResponse),
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
    $expectResult = [
        [
            "country" => "Polska",
            "shop" => [
                "shopSales" => [
                    "value" => 52246,
                    "art" => 432
                ],
                "avgComparison" => [
                    "value" => 14307,
                    "art" => 389
                ],
                "avgLast30Day" => [
                    "value" => 37939,
                    "art" => 43
                ],
                "minValueLast30Day" => [
                    "value" => 21,
                    "art" => 10
                ],
                "maxValueLast30Day" => [
                    "value" => 99076,
                    "art" => 120
                ],
                "costShare" => [
                    "value" => 1.61
                ],
                "comparisonClickToCost" => [
                    "value" => 7.49
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 36506
                ],
                'avgComparison' => [
                    'value' => 10061
                ],
                'avgLast30Day' => [
                    'value' => 26445
                ],
                'minValueLast30Day' => [
                    'value' => 18626
                ],
                'maxValueLast30Day' => [
                    'value' => 36604
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 60
                ],
                'avgComparison' => [
                    'value' => -496
                ],
                'avgLast30Day' => [
                    'value' => 556
                ],
                'minValueLast30Day' => [
                    'value' => 514
                ],
                'maxValueLast30Day' => [
                    'value' => 600
                ],
                'costFromBeginningMonth' => [
                    'value' => 60
                ],
                'budgetMonth' => [
                    'value' => 3100
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 1
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 120
                ],
                'avgComparison' => [
                    'value' => -28
                ],
                'avgLast30Day' => [
                    'value' => 148
                ],
                'minValueLast30Day' => [
                    'value' => 137
                ],
                'maxValueLast30Day' => [
                    'value' => 160
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 784
                ],
                'avgComparison' => [
                    'value' => -301
                ],
                'avgLast30Day' => [
                    'value' => 1085
                ],
                'minValueLast30Day' => [
                    'value' => 796
                ],
                'maxValueLast30Day' => [
                    'value' => 1231
                ],
                'costFromBeginningMonth' => [
                    'value' => 784
                ],
                'budgetMonth' => [
                    'value' => 4650
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 16
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 89
                ],
                'avgComparison' => [
                    'value' => -93
                ],
                'avgLast30Day' => [
                    'value' => 182
                ],
                'minValueLast30Day' => [
                    'value' => 142
                ],
                'maxValueLast30Day' => [
                    'value' => 214
                ]
            ]
        ],
        [
            "country" => "Niemcy",
            "shop" => [
                "shopSales" => [
                    "value" => 34662,
                    "art" => 3455
                ],
                "avgComparison" => [
                    "value" => -2501099240,
                    "art" => 3069
                ],
                "avgLast30Day" => [
                    "value" => 2501133902,
                    "art" => 386
                ],
                "minValueLast30Day" => [
                    "value" => 414,
                    "art" => 2
                ],
                "maxValueLast30Day" => [
                    "value" => 9999987446,
                    "art" => 990
                ],
                "costShare" => [
                    "value" => 5.81
                ],
                "comparisonClickToCost" => [
                    "value" => 7.49
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 46095
                ],
                'avgComparison' => [
                    'value' => 22687
                ],
                'avgLast30Day' => [
                    'value' => 23408
                ],
                'minValueLast30Day' => [
                    'value' => 4755
                ],
                'maxValueLast30Day' => [
                    'value' => 42162
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 600
                ],
                'avgComparison' => [
                    'value' => 187
                ],
                'avgLast30Day' => [
                    'value' => 413
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 570
                ],
                'costFromBeginningMonth' => [
                    'value' => 570
                ],
                'budgetMonth' => [
                    'value' => 2480
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 22
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 160
                ],
                'avgComparison' => [
                    'value' => 50
                ],
                'avgLast30Day' => [
                    'value' => 110
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 152
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 1414
                ],
                'avgComparison' => [
                    'value' => 511
                ],
                'avgLast30Day' => [
                    'value' => 903
                ],
                'minValueLast30Day' => [
                    'value' => 756
                ],
                'maxValueLast30Day' => [
                    'value' => 1220
                ],
                'costFromBeginningMonth' => [
                    'value' => 1414
                ],
                'budgetMonth' => [
                    'value' => 3720
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 38
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 51
                ],
                'avgComparison' => [
                    'value' => -70
                ],
                'avgLast30Day' => [
                    'value' => 121
                ],
                'minValueLast30Day' => [
                    'value' => 71
                ],
                'maxValueLast30Day' => [
                    'value' => 175
                ]
            ]
        ],
        [
            "country" => "Rumunia",
            "shop" => [
                "shopSales" => [
                    "value" => 62346,
                    "art" => 23443
                ],
                "avgComparison" => [
                    "value" => 58374,
                    "art" => 23354
                ],
                "avgLast30Day" => [
                    "value" => 3972,
                    "art" => 89
                ],
                "minValueLast30Day" => [
                    "value" => 189,
                    "art" => 12
                ],
                "maxValueLast30Day" => [
                    "value" => 12532,
                    "art" => 190
                ],
                "costShare" => [
                    "value" => 2.44
                ],
                "comparisonClickToCost" => [
                    "value" => 52.14
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 44955
                ],
                'avgComparison' => [
                    'value' => 17686
                ],
                'avgLast30Day' => [
                    'value' => 27269
                ],
                'minValueLast30Day' => [
                    'value' => 13824
                ],
                'maxValueLast30Day' => [
                    'value' => 45879
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "facebook" => [
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
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 1525
                ],
                'avgComparison' => [
                    'value' => 358
                ],
                'avgLast30Day' => [
                    'value' => 1167
                ],
                'minValueLast30Day' => [
                    'value' => 1014
                ],
                'maxValueLast30Day' => [
                    'value' => 1269
                ],
                'costFromBeginningMonth' => [
                    'value' => 1525
                ],
                'budgetMonth' => [
                    'value' => 2480
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 61
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 137
                ],
                'avgComparison' => [
                    'value' => 10
                ],
                'avgLast30Day' => [
                    'value' => 127
                ],
                'minValueLast30Day' => [
                    'value' => 72
                ],
                'maxValueLast30Day' => [
                    'value' => 161
                ]
            ]
        ],
        [
            "country" => "B2B",
            "shop" => [
                "shopSales" => [
                    "value" => 3463,
                    "art" => 133
                ],
                "avgComparison" => [
                    "value" => -4302,
                    "art" => 76
                ],
                "avgLast30Day" => [
                    "value" => 7765,
                    "art" => 57
                ],
                "minValueLast30Day" => [
                    "value" => 180,
                    "art" => 1
                ],
                "maxValueLast30Day" => [
                    "value" => 23555,
                    "art" => 190
                ],
                "costShare" => [
                    "value" => '-'
                ],
                "comparisonClickToCost" => [
                    "value" => '-'
                ]
            ],
            "global" => [
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
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "facebook" => [
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
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
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
                'costFromBeginningMonth' => [
                    'value' => 0
                ],
                'budgetMonth' => [
                    'value' => 0
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 0
                ],
            ],
            "google" => [
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
            ]
        ],
        [
            "country" => "summary",
            "shop" => [
                "shopSales" => [
                    "value" => 149254,
                    "art" => 27330
                ],
                "avgComparison" => [
                    "value" => -2501034325,
                    "art" => 26754
                ],
                "avgLast30Day" => [
                    "value" => 2501183579,
                    "art" => 576
                ],
                "minValueLast30Day" => [
                    "value" => 624,
                    "art" => 35
                ],
                "maxValueLast30Day" => [
                    "value" => 10000087502,
                    "art" => 1190
                ],
                "costShare" => [
                    "value" => 2.93
                ],
                "comparisonClickToCost" => [
                    "value" => 21.42
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 127556
                ],
                'avgComparison' => [
                    'value' => 50433
                ],
                'avgLast30Day' => [
                    'value' => 77123
                ],
                'minValueLast30Day' => [
                    'value' => 55183
                ],
                'maxValueLast30Day' => [
                    'value' => 97938
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 660
                ],
                'avgComparison' => [
                    'value' => -309
                ],
                'avgLast30Day' => [
                    'value' => 969
                ],
                'minValueLast30Day' => [
                    'value' => 514
                ],
                'maxValueLast30Day' => [
                    'value' => 1140
                ],
                'costFromBeginningMonth' => [
                    'value' => 630
                ],
                'budgetMonth' => [
                    'value' => 5580
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 11
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 280
                ],
                'avgComparison' => [
                    'value' => 22
                ],
                'avgLast30Day' => [
                    'value' => 258
                ],
                'minValueLast30Day' => [
                    'value' => 137
                ],
                'maxValueLast30Day' => [
                    'value' => 304
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 22
                ],
                'cost' => [
                    'value' => 3723
                ],
                'avgComparison' => [
                    'value' => 567
                ],
                'avgLast30Day' => [
                    'value' => 3156
                ],
                'minValueLast30Day' => [
                    'value' => 2747
                ],
                'maxValueLast30Day' => [
                    'value' => 3463
                ],
                'costFromBeginningMonth' => [
                    'value' => 3723
                ],
                'budgetMonth' => [
                    'value' => 10850
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 34
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 277
                ],
                'avgComparison' => [
                    'value' => -154
                ],
                'avgLast30Day' => [
                    'value' => 431
                ],
                'minValueLast30Day' => [
                    'value' => 361
                ],
                'maxValueLast30Day' => [
                    'value' => 505
                ]
            ]
        ]
    ];

     $reportWeekly = new ResultWeekly(
         new Country(),
         new AnalyticsApi(),
         new MetaAdsApi(new CoursePLN()),
         new AdwordsResult(),
         new ShopResult(
             new ShopSales(
                 new Shop(),
                 new Country()
             ),
             new CoursePLN()
         ),
         new GoogleAdwordsApi()
     );

    expect(
      $reportWeekly
        ->get($rangesDate, $rangesOtherDate)
    )
        ->toMatchArray($expectResult);
})->with('shopReportWeeklyCurrentResponse',
    'shopReportWeeklyFirstResponse',
    'shopReportWeeklySecondResponse',
    'shopReportWeeklyThirdResponse',
    'shopReportWeeklyFourthResponse',
    'facebookReportWeeklyCurrentResponse',
    'facebookReportWeeklyFirstResponse',
    'facebookReportWeeklySecondResponse',
    'facebookReportWeeklyThirdResponse',
    'facebookReportWeeklyFourthResponse',
    'analyticsReportWeeklyPolandResponse',
    'analyticsReportWeeklyGermanyResponse',
    'analyticsReportWeeklyRomaniaResponse',
    'adwordsGoogleReportWeeklyPolandResponse',
    'adwordsGoogleReportWeeklyGermanyResponse',
    'adwordsGoogleReportWeeklyRomaniaResponse');
