<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Connection\Shop;
use App\Services\Report\ResultDay;
use App\Services\ShopSales;
use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(ComparisonDayJuneCountry::class);
});
// Do ogarniećia jest średnai i mozłiwośc dodanie google i fb PRzetestować co sięstanie jeśl iejst kraj za durzo do któego nei ma api co jeśłi nei ma wartosći shop api w db
// tu nie ma podsuomwnia w analytcs i sprawdzić czy srednai jest z ostatnich 30 dni
test('Verification work services Report result Day with good response api', function (
    string $shopResponseOneVariant,
    string $shopResponseSecondVariant,
    string $shopResponseThreeVariant,
    string $analyticsPolandReportDay,
    string $analyticsEnglandReportDay,
) {
    $date = "2024-06-20";
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
        "https://analyticsdata.googleapis.com/v1beta/properties/{123123123123}:runReport" => Http::response($analyticsPolandReportDay),
        "https://analyticsdata.googleapis.com/v1beta/properties/{987987987987}:runReport" => Http::response($analyticsEnglandReportDay),
    ]);

    $reportDay = new ResultDay(
        new ShopSales(
            new Shop(),
            new Country()
        ),
        new Country(),
        new AnalyticsApi()
    );

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
                    'value' => 8
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
                    'value' => 59
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
        ]
    ];




    expect(
        $reportDay
            ->get($date)
    )
        ->toMatchArray($expectResult);

})->with('shopResponseForOneDay', 'shopResponseForSecondDay', 'shopResponseForThreeDay', "analyticsPolandReportDay", "analyticsEnglandReportDay");
