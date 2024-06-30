<?php
declare(strict_types=1);

use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\artisan;
use function Pest\Laravel\seed;

beforeEach(function () {
   seed(ComparisonDayJuneCountry::class);
});


it('Verification correct working command generation result day report with correct response api', function (
    string $shopResponseOneVariant,
    string $shopResponseSecondVariant,
    string $shopResponseThreeVariant,
    string $analyticsPolandReportDay,
    string $analyticsEnglandReportDay,
) {

    $startDay = "2024-06-20";
    Storage::fake();

    Http::fake([
        config('api.shop') . "?start=2024-06-20&end=2024-06-20" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-19&end=2024-06-19" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-18&end=2024-06-18" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-17&end=2024-06-17" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-16&end=2024-06-16" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-15&end=2024-06-15" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-14&end=2024-06-14" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-13&end=2024-06-13" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-12&end=2024-06-12" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-11&end=2024-06-11" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-10&end=2024-06-10" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-09&end=2024-06-09" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-08&end=2024-06-08" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-07&end=2024-06-07" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-06&end=2024-06-06" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-05&end=2024-06-05" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-04&end=2024-06-04" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-03&end=2024-06-03" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-02&end=2024-06-02" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-01&end=2024-06-01" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-31&end=2024-05-31" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-30&end=2024-05-30" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-29&end=2024-05-29" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-28&end=2024-05-28" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-27&end=2024-05-27" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-26&end=2024-05-26" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-25&end=2024-05-25" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-24&end=2024-05-24" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-23&end=2024-05-23" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-22&end=2024-05-22" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-21&end=2024-05-21" => Http::response($shopResponseThreeVariant),
        "https://analyticsdata.googleapis.com/v1beta/properties/123123123123:runReport" => Http::response($analyticsPolandReportDay),
        "https://analyticsdata.googleapis.com/v1beta/properties/987987987987:runReport" => Http::response($analyticsEnglandReportDay),
    ]);

    $expectResult = [
        [
            "country" => "Polska",
            "shop" => [
                "shopSales" => [
                    "value" => 77076,
                    "art" => 242
                ],
                "avgComparison" => [
                    "value" => -19800,
                    "art" => 183
                ],
                "avgLast30Day" => [
                    "value" => 96876,
                    "art" => 58
                ],
                "minValueLast30Day" => [
                    "value" => 77076,
                    "art" => 10
                ],
                "maxValueLast30Day" => [
                    "value" => 99076,
                    "art" => 242
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 100
                ],
                'avgComparison' => [
                    'value' => -3604
                ],
                'avgLast30Day' => [
                    'value' => 3704
                ],
                'minValueLast30Day' => [
                    'value' => 9
                ],
                'maxValueLast30Day' => [
                    'value' => 100000
                ]
            ]
        ],
        [
            "country" => "Anglia",
            "shop" => [
                "shopSales" => [
                    "value" => 1535,
                    "art" => 147
                ],
                "avgComparison" => [
                    "value" => -7666655866,
                    "art" => -635
                ],
                "avgLast30Day" => [
                    "value" => 7666657401,
                    "art" => 782
                ],
                "minValueLast30Day" => [
                    "value" => 1535,
                    "art" => 69
                ],
                "maxValueLast30Day" => [
                    "value" => 9999987446,
                    "art" => 990
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 123
                ],
                'avgComparison' => [
                    'value' => 58
                ],
                'avgLast30Day' => [
                    'value' => 64
                ],
                'minValueLast30Day' => [
                    'value' => 12
                ],
                'maxValueLast30Day' => [
                    'value' => 1900
                ]
            ]
        ],
        [
            "country" => "Niemcy",
            "shop" => [
                "shopSales" => [
                    "value" => 2224,
                    "art" => 5
                ],
                "avgComparison" => [
                    "value" => -182918,
                    "art" => -179
                ],
                "avgLast30Day" => [
                    "value" => 185142,
                    "art" => 184
                ],
                "minValueLast30Day" => [
                    "value" => 980,
                    "art" => 5
                ],
                "maxValueLast30Day" => [
                    "value" => 1381262,
                    "art" => 290
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
            ]
        ],
        [
            "country" => "summary",
            "shop" => [
                "shopSales" => [
                    "value" => 80836,
                    "art" => 394
                ],
                "avgComparison" => [
                    "value" => -7666858583,
                    "art" => -632
                ],
                "avgLast30Day" => [
                    "value" => 7666939419,
                    "art" => 1026
                ],
                "minValueLast30Day" => [
                    "value" => 79591,
                    "art" => 84
                ],
                "maxValueLast30Day" => [
                    "value" => 10001467784,
                    "art" => 1522
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 223
                ],
                'avgComparison' => [
                    'value' => -3545
                ],
                'avgLast30Day' => [
                    'value' => 3768
                ],
                'minValueLast30Day' => [
                    'value' => 21
                ],
                'maxValueLast30Day' => [
                    'value' => 101900
                ]
            ]
        ]
    ];

    artisan('report:result-day', [
        "date" => $startDay
    ])
        ->expectsOutput(__("command.saveFileSuccess"))
        ->assertOk();

    Storage::disk()
        ->assertExists(config('report.containerReportResultDay') . "{$startDay}.json");

    $valueSavedInFile = json_decode(Storage::disk()
        ->get(config('report.containerReportResultDay') . "{$startDay}.json"), true);

    expect($valueSavedInFile)
        ->toMatchArray($expectResult);

})->with('shopResponseForOneDay', 'shopResponseForSecondDay', 'shopResponseForThreeDay', "analyticsPolandReportDay", "analyticsEnglandReportDay");
/*
it('Verification correct valid date format', function () {
    Storage::fake();
    Http::fake([
        config('api.shop') . "?start=2024-06-01&end=2024-06-20" => Http::response(""),
        config('api.shop') . "?start=2023-06-01&end=2023-06-20" => Http::response(""),
        config('api.shop') . "?start=2023-06-01&end=2023-06-30" => Http::response(""),
        config('api.shop') . "?start=2024-05-01&end=2024-05-20" => Http::response(""),
    ]);

    $startDay = "202423";

    artisan('report:comparison-day', [
        "date" => $startDay
    ])
        ->expectsOutput(__("command.wrongFormatDate"))
        ->assertFailed();

    Storage::disk()
        ->assertMissing(config('report.containerReportComparisonDay') . "{$startDay}.json");
});*/
