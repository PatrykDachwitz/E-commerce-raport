<?php
declare(strict_types=1);

use function Pest\Laravel\get;

describe('verification correct url api', function () {
    it('report daily url work', function () {
        get('/api/report/daily')
        ->assertOk();
    });
    it('report daily name isn`t change', function () {
        $uriPathByNameRoute = route('report.daily', null, false);


        expect($uriPathByNameRoute)
            ->toBe('/api/report/daily');

    });

});

describe('verification format and count response data', function () {
   it('verification structure and format response', function () {
       $structureValueAndArt = [
           'value',
           'art',
       ];

       $structureStatistic = [
           'countClick' => [
               'value'
           ],
           'avgComparison' => [
               'value'
           ],
           'avgLast30Day' => [
               'value'
           ],
           'minValueLast30Day' => [
               'value'
           ],
           'maxValueLast30Day' => [
               'value'
           ]
       ];
       $structureStatisticCost = [
           'cost' => [
               'value'
           ],
           'avgComparison' => [
               'value'
           ],
           'avgLast30Day' => [
               'value'
           ],
           'minValueLast30Day' => [
               'value'
           ],
           'maxValueLast30Day' => [
               'value'
           ],
           'costFromBeginningMonth' => [
               'value'
           ],
           'budgetMonth' => [
               'value'
           ],
           'percentCostFromBeginningMonth' => [
               'value'
           ],
       ];

       get(route('report.daily'))
           ->assertJsonStructure(
               [
                   'data' => [
                       "*" => [
                           'country',
                           'shop' => [
                               'shopSales' => $structureValueAndArt,
                               'avgComparison' => $structureValueAndArt,
                               'avgLast30Day' => $structureValueAndArt,
                               'minValueLast30Day' => $structureValueAndArt,
                               'maxValueLast30Day' => $structureValueAndArt,
                           ],
                           'global' => $structureStatistic,
                           'google' => $structureStatistic,
                           'facebook' => $structureStatistic,
                           'costGoogle' => $structureStatisticCost,
                           'costFacebook' => $structureStatisticCost,
                       ]
                   ]
               ]
           );
   });
});
