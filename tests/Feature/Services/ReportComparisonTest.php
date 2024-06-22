<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Connection\Shop;
use App\Services\Report\Comparison;
use App\Services\ShopSales;
use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\artisan;
use function Pest\Laravel\seed;

beforeEach(function () {
   seed(ComparisonDayJuneCountry::class);
});


it('Verification working comparison service class for June 20 day in 2024 with 1 off country correct Format Date', function (
    string $shopResponseMayCurrentYear,
    string $shopResponseJuneTo20Day,
    string $shopResponseJuneCompleteMonth,
    ) {

    $startDay = "2024-06-20";

    Http::fake([
        config('api.shop') . "?start=2024-06-01&end=2024-06-20" => Http::response($shopResponseMayCurrentYear),
        config('api.shop') . "?start=2023-06-01&end=2023-06-20" => Http::response($shopResponseJuneTo20Day),
        config('api.shop') . "?start=2023-06-01&end=2023-06-30" => Http::response($shopResponseJuneCompleteMonth),
        config('api.shop') . "?start=2024-05-01&end=2024-05-20" => Http::response($shopResponseMayCurrentYear),
    ]);

    $salesConnection = new Shop();
    $country = new Country();
    $sales = new ShopSales($salesConnection, $country);

    $comparison = new Comparison($sales);

    $expectArray = [
        "resultsFromBeginnerMonthCurrentYear" => [
            "value" => 2247,
            "art" => 752
        ],
        "resultsFromBeginnerMonthPreviousYear" => [
            "value" => 108,
            "art" => 785
        ],
        "resultsFromBeginnerMonthComparisonYear" => [
            "value" => 2139,
            "art" => -33
        ],
        "avgResultMonthCurrentYear" => [
            "value" => 112,
            "art" => 37
        ],
        "avgResultMonthPreviousYear" => [
            "value" => 49430,
            "art" => 53
        ],
        "avgResultMonthComparisonYear" => [
            "value" => -49318,
            "art" => -16
        ],
        "resultsFromBeginnerPreviousMonthCurrentYear" => [
            "value" => 2247,
            "art" => 752
        ],
        "resultsFromBeginnerComparisonMonth" => [
            "value" => 0,
            "art" => 0
        ],
        "date" => [
            "day" => 20,
            "month" => "06",
            "year" => 2024
        ]
    ];

    expect($comparison->get($startDay))
        ->toBe($expectArray);

})->with('shopApiResponseMay1_20Year2024', 'shopApiResponseJune1_20Year2023', 'shopApiResponseJune1_30Year2023');

it('Verification working comparison service class for June 20 day in 2024 with 1 off country and 500 response http code in primary url and code 404 in may result', function (
    string $shopResponseJuneTo20Day,
    string $shopResponseJuneCompleteMonth,
    ) {

    $startDay = "2024-06-20";
    Http::fake([
        config('api.shop') . "?start=2024-06-01&end=2024-06-20" => Http::response("", 500),
        config('api.shop') . "?start=2023-06-01&end=2023-06-20" => Http::response($shopResponseJuneTo20Day),
        config('api.shop') . "?start=2023-06-01&end=2023-06-30" => Http::response($shopResponseJuneCompleteMonth),
        config('api.shop') . "?start=2024-05-01&end=2024-05-20" => Http::response("", 404),
    ]);

    $salesConnection = new Shop();
    $country = new Country();
    $sales = new ShopSales($salesConnection, $country);

    $comparison = new Comparison($sales);

    $expectArray = [
        "resultsFromBeginnerMonthCurrentYear" => [
            "value" => 0,
            "art" => 0
        ],
        "resultsFromBeginnerMonthPreviousYear" => [
            "value" => 108,
            "art" => 785
        ],
        "resultsFromBeginnerMonthComparisonYear" => [
            "value" => -108,
            "art" => -785
        ],
        "avgResultMonthCurrentYear" => [
            "value" => 0,
            "art" => 0
        ],
        "avgResultMonthPreviousYear" => [
            "value" => 49430,
            "art" => 53
        ],
        "avgResultMonthComparisonYear" => [
            "value" => -49430,
            "art" => -53
        ],
        "resultsFromBeginnerPreviousMonthCurrentYear" => [
            "value" => 0,
            "art" => 0
        ],
        "resultsFromBeginnerComparisonMonth" => [
            "value" => 0,
            "art" => 0
        ],
        "date" => [
            "day" => 20,
            "month" => "06",
            "year" => 2024
        ]
    ];

    expect($comparison->get($startDay))
        ->toBe($expectArray);

})->with( 'shopApiResponseJune1_20Year2023', 'shopApiResponseJune1_30Year2023');

