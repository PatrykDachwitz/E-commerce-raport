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


it('Verification correct working command generation comparison day report with correct response api', function (
    string $shopResponseMayCurrentYear,
    string $shopResponseJuneTo20Day,
    string $shopResponseJuneCompleteMonth,
) {

    $startDay = "2024-06-20";
    Storage::fake();

    Http::fake([
        config('api.shop') . "?start=2024-06-01&end=2024-06-20" => Http::response($shopResponseMayCurrentYear),
        config('api.shop') . "?start=2023-06-01&end=2023-06-20" => Http::response($shopResponseJuneTo20Day),
        config('api.shop') . "?start=2023-06-01&end=2023-06-30" => Http::response($shopResponseJuneCompleteMonth),
        config('api.shop') . "?start=2024-05-01&end=2024-05-20" => Http::response($shopResponseMayCurrentYear),
    ]);

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

    artisan('report:comparison-day', [
        "date" => $startDay
    ])
        ->expectsOutput(__("command.saveFileSuccess"))
        ->assertOk();

    Storage::disk()
        ->assertExists(config('report.containerReportComparisonDay') . "{$startDay}.json");

    expect(
        Storage::disk()
            ->get(config('report.containerReportComparisonDay') . "{$startDay}.json")
    )
        ->toBe(json_encode($expectArray));

})->with('shopApiResponseMay1_20Year2024', 'shopApiResponseJune1_20Year2023', 'shopApiResponseJune1_30Year2023');

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
});
