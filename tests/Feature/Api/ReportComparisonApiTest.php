<?php
declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

describe('Verification url api', function () {
    it('test front path to current path', function () {

        $currentPathApiFrontend = '/api/report/comparison';
        $pathByRoute = route('report.comparison',[], 0);

        expect($pathByRoute)
            ->toBe($currentPathApiFrontend);
    });

    it('Verification status api', function () {
        $user = User::factory()->create();

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
        Storage::fake();
        Storage::disk()
            ->put(config('report.containerReportComparisonDay') . "2024-06-20.json", json_encode($expectArray));

        actingAs($user)
            ->get(route('report.comparison') . "?date=2024-06-20")
            ->assertOk();
    });
});

describe('test format and structure response api', function () {
   it('Verification structure response', function () {
       $user = User::factory()->create();

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
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportComparisonDay') . "2024-06-20.json", json_encode($expectArray));


       $structureWithValueAndArt = [
           'value',
           'art'
       ];

       actingAs($user)
           ->get(route('report.comparison') . "?date=2024-06-20")
           ->assertJsonStructure([
               'data' => [
                   'names' => [
                       'resultsFromBeginnerMonthCurrentYear',
                       'resultsFromBeginnerMonthPreviousYear',
                       'avgResultMonthCurrentYear',
                       'avgResultMonthPreviousYear',
                       'resultsFromBeginnerPreviousMonthCurrentYear',
                   ],
                   'resultsFromBeginnerMonthCurrentYear' => $structureWithValueAndArt,
                   'resultsFromBeginnerMonthPreviousYear' => $structureWithValueAndArt,
                   'resultsFromBeginnerMonthComparisonYear' => $structureWithValueAndArt,
                   'avgResultMonthCurrentYear' => $structureWithValueAndArt,
                   'avgResultMonthPreviousYear' => $structureWithValueAndArt,
                   'avgResultMonthComparisonYear' => $structureWithValueAndArt,
                   'resultsFromBeginnerPreviousMonthCurrentYear' => $structureWithValueAndArt,
                   'resultsFromBeginnerComparisonMonth' => $structureWithValueAndArt,
               ]
           ]);
   });

   it('Verification data response api for 2024-06-20 date', function () {
       $user = User::factory()->create();

       $expectNames = [
           "names" => [
               'resultsFromBeginnerMonthCurrentYear' => "1-20 " . __("month.6") . " 2024",
               'resultsFromBeginnerMonthPreviousYear' => "1-20 " . __("month.6") . " 2023",
               'avgResultMonthCurrentYear' => __('content.avgValue') . " " . __("month.6") . " 2024",
               'avgResultMonthPreviousYear' => __('content.avgValue') . " " . __("month.6") . " 2023",
               'resultsFromBeginnerPreviousMonthCurrentYear' => "1-20 " . __("month.5") . " 2024",
           ]
       ];
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
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportComparisonDay') . "2024-06-20.json", json_encode($expectArray));

       $response = actingAs($user)
           ->get(route('report.comparison') . "?date=2024-06-20")
           ->json("data");

       expect($response)
           ->toMatchArray(array_merge($expectArray, $expectNames));

   });

   it('Verification data response api for empty input date', function () {
       $user = User::factory()->create();
       $expectNames = [
           "names" => [
               'resultsFromBeginnerMonthCurrentYear' => "1-20 " . __("month.6") . " 2024",
               'resultsFromBeginnerMonthPreviousYear' => "1-20 " . __("month.6") . " 2023",
               'avgResultMonthCurrentYear' => __('content.avgValue') . " " . __("month.6") . " 2024",
               'avgResultMonthPreviousYear' => __('content.avgValue') . " " . __("month.6") . " 2023",
               'resultsFromBeginnerPreviousMonthCurrentYear' => "1-20 " . __("month.5") . " 2024",
           ]
       ];
       $expectArray = [
           "resultsFromBeginnerMonthCurrentYear" => [
               "value" => 5324523,
               "art" => 23523
           ],
           "resultsFromBeginnerMonthPreviousYear" => [
               "value" => 25345,
               "art" => 78523455
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

       $lastDayDate = date("Y-m-d", strtotime("-1 day"));
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportComparisonDay') . "{$lastDayDate}.json", json_encode($expectArray));

       $response = actingAs($user)
           ->get(route('report.comparison'))
           ->json();

       expect($response)
           ->toMatchArray([
               'data' => array_merge($expectArray, $expectNames),
               'date' => $lastDayDate
           ]);

   });
});

it('Test available response api for not log in user expected error with http code 401', function () {

    Storage::fake();

    getJson(route('report.comparison'))
        ->assertStatus(401);

});
