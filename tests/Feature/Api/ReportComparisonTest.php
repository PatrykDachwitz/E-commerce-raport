<?php
declare(strict_types=1);
use function Pest\Laravel\get;

describe('Verification url api', function () {
    it('test front path to current path', function () {
        $currentPathApiFrontend = '/api/report/comparison';
        $pathByRoute = route('report.comparison',[], 0);

        expect($pathByRoute)
            ->toBe($currentPathApiFrontend);
    });

    it('Verification status api', function () {
        get(route('report.comparison'))
            ->assertOk();
    });
});

describe('test format and structure response api', function () {
   it('Verification structure response', function () {
       $structureWithValueAndArt = [
           'value',
           'art'
       ];

       get(route('report.comparison'))
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
});
