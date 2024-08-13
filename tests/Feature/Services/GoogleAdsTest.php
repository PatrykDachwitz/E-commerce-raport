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

describe('Testing response Google ads services with correct data', function () {

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
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 204,
                    'spend'=>1061
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 220,
                    'spend'=>1109
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 206,
                    'spend'=>1164
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 167,
                    'spend'=>999
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 152,
                    'spend'=>881
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 148,
                    'spend'=>735
                ],

                'current' =>[
                    'click' => 147,
                    'spend'=>617
                ],

            ]
        ];

        $country = Country::find(1);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })
        ->with('googleAdwordsResponseApi');


        it("Testing correct calculate data for many ranges Date", function (
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
                    'current' => 651,
                    "summaryWithoutCurrent" => 1207,
                    "avgWithoutCurrent" => 301,
                    "avgComparisonWithoutCurrent" => 350,
                    "minWithoutCurrent" => 0,
                    "maxWithoutCurrent" => 579,
                ],
                "budget" => [
                    'current' => 3294,
                    "avgComparisonWithoutCurrent" => 1655,
                    "summaryWithoutCurrent" => 6558,
                    "avgWithoutCurrent" => 1639,
                    "minWithoutCurrent" => 0,
                    "maxWithoutCurrent" => 3327,
                    "spentBudgetFromBeginningOfMonth" => 4293,
                    "budgetMonthly" => 9300,
                    "percentSpentBudgetMonthlyCurrentDay" => 46,
                ],
                "dataByRangesWithoutCurrent" => [
                    '2024-06-07_2024-06-09' => [
                        'click' => 579,
                        'spend' => 3327,
                    ],
                    '2024-06-14_2024-06-16' => [
                        'click' => 0,
                        'spend' => 0,
                    ],
                    '2024-06-21_2024-06-23' => [
                        'click' => 408,
                        'spend' => 2122,
                    ],
                    '2024-06-28_2024-06-30' => [
                        'click' => 220,
                        'spend' => 1109,
                    ],
                    'current' => [
                        'click' => 651,
                        'spend' => 3294,
                    ]
                ]
            ];

            $country = Country::find(1);
            expect($googleAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
                ->toMatchArray($metaData);

        })
            ->with('googleAdwordsResponseApiJune');

});


describe('Testing google adwords api when data is deficit', function () {

    it("Testing calculate data for empty response", function () {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response("", 404),
        ]);


        $googleAds = new GoogleAdwordsApi();

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
            'dataByRangesWithoutCurrent' => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                'current' =>[
                    'click' => 0,
                    'spend'=>0
                ],

            ]
        ];

        $country = Country::find(1);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    });

    it("Testing calculate data for empty data current date", function (
        string $currentDateResponseApi,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
        ]);



        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 1097,
                "avgWithoutCurrent" => 182,
                "avgComparisonWithoutCurrent" => -182,
                "minWithoutCurrent" => 148,
                "maxWithoutCurrent" => 220,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => -991,
                "summaryWithoutCurrent" => 5949,
                "avgWithoutCurrent" => 991,
                "minWithoutCurrent" => 735,
                "maxWithoutCurrent" => 1164,
                "spentBudgetFromBeginningOfMonth" => 5949,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 66,
            ],
            'dataByRangesWithoutCurrent' => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 204,
                    'spend'=>1061
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 220,
                    'spend'=>1109
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 206,
                    'spend'=>1164
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 167,
                    'spend'=>999
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 152,
                    'spend'=>881
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 148,
                    'spend'=>735
                ],

                'current' =>[
                    'click' => 0,
                    'spend'=>0
                ],

            ]
        ];

        $country = Country::find(1);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })->with('googleAdwordsResponseApiDeficitCurrentDate');

    it("Testing calculate data for deficit data", function (
        string $currentDateResponseApi,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
        ]);



        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 147,
                "summaryWithoutCurrent" => 558,
                "avgWithoutCurrent" => 93,
                "avgComparisonWithoutCurrent" => 54,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 206,
            ],
            "budget" => [
                'current' => 617,
                "avgComparisonWithoutCurrent" => 124,
                "summaryWithoutCurrent" => 2960,
                "avgWithoutCurrent" => 493,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 1164,
                "spentBudgetFromBeginningOfMonth" => 3577,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 39,
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 204,
                    'spend'=>1061
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 206,
                    'spend'=>1164
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 148,
                    'spend'=>735
                ],

                'current' =>[
                    'click' => 147,
                    'spend'=>617
                ],
            ]
        ];

        $country = Country::find(1);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })->with('googleAdwordsResponseApiDeficitData');

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
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 204,
                    'spend'=>1061
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 220,
                    'spend'=>1109
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 206,
                    'spend'=>1164
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 167,
                    'spend'=>999
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 152,
                    'spend'=>881
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 148,
                    'spend'=>735
                ],

                'current' =>[
                    'click' => 147,
                    'spend'=>617
                ],
            ]
        ];

        $country = Country::find(2);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);
    })->with('googleAdwordsResponseApi');


    it("Testing calculate for empty response for many ranges date", function () {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response("", 404),
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
                ],
                'current' => [
                    'click' => 0,
                    'spend' => 0,
                ]
        ]

        ];

        $country = Country::find(1);
        expect($googleAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    });

    it("Testing correct calculate data for many ranges Date with 0 monthly budget", function (
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
                'current' => 651,
                "summaryWithoutCurrent" => 1207,
                "avgWithoutCurrent" => 301,
                "avgComparisonWithoutCurrent" => 350,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 579,
            ],
            "budget" => [
                'current' => 3294,
                "avgComparisonWithoutCurrent" => 1655,
                "summaryWithoutCurrent" => 6558,
                "avgWithoutCurrent" => 1639,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 3327,
                "spentBudgetFromBeginningOfMonth" => 4293,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 100,
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-07_2024-06-09' => [
                    'click' => 579,
                    'spend' => 3327,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 408,
                    'spend' => 2122,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 220,
                    'spend' => 1109,
                ],
                'current' => [
                    'click' => 651,
                    'spend' => 3294,
                ]
            ]
        ];

        $country = Country::find(2);
        expect($googleAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })
        ->with('googleAdwordsResponseApiJune');

    it("Testing correct calculate data for many ranges Date with deficit data for current Date", function (
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
                'current' => 0,
                "summaryWithoutCurrent" => 1207,
                "avgWithoutCurrent" => 301,
                "avgComparisonWithoutCurrent" => -301,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 579,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => -1639,
                "summaryWithoutCurrent" => 6558,
                "avgWithoutCurrent" => 1639,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 3327,
                "spentBudgetFromBeginningOfMonth" => 999,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 10,
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-07_2024-06-09' => [
                    'click' => 579,
                    'spend' => 3327,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 0,
                    'spend' => 0,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 408,
                    'spend' => 2122,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 220,
                    'spend' => 1109,
                ],
                'current' => [
                    'click' => 0,
                    'spend' => 0,
                ]
            ]
        ];

        $country = Country::find(1);
        expect($googleAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })
        ->with('googleAdwordsResponseApiJuneDeficitCurrentDate');

});



describe("Testing various with 2 google ads account in 1 country", function () {

    it("Testing correct calculate data about response api", function (
        string $currentDateResponseApi,
        string $googleAdwordsResponseApiPerCampaign,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($currentDateResponseApi),
            "https://googleads.googleapis.com/v17/customers/12342141/googleAds:searchStream" => Http::response($googleAdwordsResponseApiPerCampaign),
        ]);



        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 272,
                "summaryWithoutCurrent" => 2918,
                "avgWithoutCurrent" => 486,
                "avgComparisonWithoutCurrent" => -214,
                "minWithoutCurrent" => 179,
                "maxWithoutCurrent" => 1397,
            ],
            "budget" => [
                'current' => 640,
                "avgComparisonWithoutCurrent" => -44864,
                "summaryWithoutCurrent" => 273029,
                "avgWithoutCurrent" => 45504,
                "minWithoutCurrent" => 736,
                "maxWithoutCurrent" => 236324,
                "spentBudgetFromBeginningOfMonth" => 273669,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 3040,
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 327,
                    'spend'=>1613
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 234,
                    'spend'=>3461
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 420,
                    'spend'=>24689
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 179,
                    'spend'=>236324
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 1397,
                    'spend'=>6206
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 361,
                    'spend'=>736
                ],

                'current' =>[
                    'click' => 272,
                    'spend'=>640
                ],

            ]
        ];

        $country = Country::find(4);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })
        ->with('googleAdwordsResponseApi', 'googleAdwordsResponseApiPerCampaign');

    it("Testing correct calculate data for empty response", function () {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response(""),
            "https://googleads.googleapis.com/v17/customers/12342141/googleAds:searchStream" => Http::response(""),
        ]);



        $googleAds = new GoogleAdwordsApi();

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
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 0,
                    'spend'=>0
                ],

                'current' =>[
                    'click' => 0,
                    'spend'=>0
                ],

            ]
        ];

        $country = Country::find(4);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    });


    it("Testing correct calculate data for first account response api", function (
        string $googleAdwordsResponseApiPerCampaign,
    ) {

        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response(""),
            "https://googleads.googleapis.com/v17/customers/12342141/googleAds:searchStream" => Http::response($googleAdwordsResponseApiPerCampaign),
        ]);



        $googleAds = new GoogleAdwordsApi();

        $metaData = [
            'click' => [
                'current' => 125,
                "summaryWithoutCurrent" => 1821,
                "avgWithoutCurrent" => 303,
                "avgComparisonWithoutCurrent" => -178,
                "minWithoutCurrent" => 12,
                "maxWithoutCurrent" => 1245,
            ],
            "budget" => [
                'current' => 23,
                "avgComparisonWithoutCurrent" => -44490,
                "summaryWithoutCurrent" => 267080,
                "avgWithoutCurrent" => 44513,
                "minWithoutCurrent" => 1,
                "maxWithoutCurrent" => 235325,
                "spentBudgetFromBeginningOfMonth" => 267103,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 2967,
            ],
            "dataByRangesWithoutCurrent" => [
                '2024-06-01_2024-06-01' =>[
                    'click' => 123,
                    'spend'=> 552
                ],

                '2024-06-02_2024-06-02' =>[
                    'click' => 14,
                    'spend'=> 2352
                ],

                '2024-06-03_2024-06-03' =>[
                    'click' => 214,
                    'spend'=> 23525
                ],

                '2024-06-04_2024-06-04' =>[
                    'click' => 12,
                    'spend'=> 235325
                ],

                '2024-06-05_2024-06-05' =>[
                    'click' => 1245,
                    'spend'=> 5325
                ],

                '2024-06-06_2024-06-06' =>[
                    'click' => 213,
                    'spend'=> 1
                ],

                'current' =>[
                    'click' => 125,
                    'spend'=> 23
                ],

            ]
        ];

        $country = Country::find(4);
        expect($googleAds->get("2024-06-07", "2024-06-01", $country))
            ->toMatchArray($metaData);

    })
        ->with('googleAdwordsResponseApiPerCampaign');


});
