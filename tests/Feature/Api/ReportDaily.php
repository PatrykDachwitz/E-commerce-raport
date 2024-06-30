<?php
declare(strict_types=1);

use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(ComparisonDayJuneCountry::class);
});

//Dodać weryfiakcję co jeśli nie ma pliku czy tu nie ma zanych wtecz dat czy cuś i asseracia daty czy coś ddodać summary

describe('verification correct url api', function () {
    it('report daily url work', function () {
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
        Storage::fake();
        Storage::disk()
            ->put(config('report.containerReportResultDay') . "2024-06-20.json", json_encode($expectResult));

        get(route('report.daily') . "?date=2024-06-20")
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
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportResultDay') . "2024-06-20.json", json_encode($expectResult));

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

       get(route('report.daily') . "?date=2024-06-20")
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
                           /*'google' => $structureStatistic,
                           'facebook' => $structureStatistic,
                           'costGoogle' => $structureStatisticCost,
                           'costFacebook' => $structureStatisticCost,*/
                       ]
                   ]
               ]
           );
   });

   it('Verification correct value for data in 20.06.2024 file data for this date isset', function () {

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
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportResultDay') . "2024-06-20.json", json_encode($expectResult));

       $response = get(route('report.daily') . "?date=2024-06-20")
           ->json('data');

       expect($response)
           ->toMatchArray($expectResult);
   });

});
