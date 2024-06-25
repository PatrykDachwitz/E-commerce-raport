<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\get;

describe('Verification url api', function () {
    it('test front path to current path', function () {

        $currentPathApiFrontend = '/api/report/comparison';
        $pathByRoute = route('report.comparison',[], 0);

        expect($pathByRoute)
            ->toBe($currentPathApiFrontend);
    });

    it('Verification status api', function () {
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

        get(route('report.comparison') . "?date=2024-06-20")
            ->assertOk();
    });
});

describe('test format and structure response api', function () {
   it('Verification structure response', function () {
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

       get(route('report.comparison') . "?date=2024-06-20")
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

       $response = get(route('report.comparison') . "?date=2024-06-20")
           ->json("data");

       expect($response)
           ->toMatchArray(array_merge($expectArray, $expectNames));

   });
});
