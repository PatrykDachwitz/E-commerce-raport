<?php
declare(strict_types=1);

use App\Models\User;
use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(ComparisonDayJuneCountry::class);
});

describe('verification correct url api', function () {
    it('report week url work', function () {
        $expectResult = [
            [
                "country" => "Polska",
                "shop" => [
                    "shopSales" => [
                        "value" => 52246,
                        "art" => 432
                    ],
                    "avgComparison" => [
                        "value" => 14307,
                        "art" => 389
                    ],
                    "avgLast30Day" => [
                        "value" => 37939,
                        "art" => 43
                    ],
                    "minValueLast30Day" => [
                        "value" => 21,
                        "art" => 10
                    ],
                    "maxValueLast30Day" => [
                        "value" => 99076,
                        "art" => 120
                    ],
                    "costShare" => [
                        "value" => 0.38
                    ],
                    "comparisonClickToCost" => [
                        "value" => 1.18
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 36506
                    ],
                    'avgComparison' => [
                        'value' => 10061
                    ],
                    'avgLast30Day' => [
                        'value' => 26445
                    ],
                    'minValueLast30Day' => [
                        'value' => 18626
                    ],
                    'maxValueLast30Day' => [
                        'value' => 36604
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 60
                    ],
                    'avgComparison' => [
                        'value' => -496
                    ],
                    'avgLast30Day' => [
                        'value' => 556
                    ],
                    'minValueLast30Day' => [
                        'value' => 514
                    ],
                    'maxValueLast30Day' => [
                        'value' => 600
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 60
                    ],
                    'budgetMonth' => [
                        'value' => 3100
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 1
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 120
                    ],
                    'avgComparison' => [
                        'value' => -28
                    ],
                    'avgLast30Day' => [
                        'value' => 148
                    ],
                    'minValueLast30Day' => [
                        'value' => 137
                    ],
                    'maxValueLast30Day' => [
                        'value' => 160
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 784
                    ],
                    'avgComparison' => [
                        'value' => -301
                    ],
                    'avgLast30Day' => [
                        'value' => 1085
                    ],
                    'minValueLast30Day' => [
                        'value' => 796
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1231
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 784
                    ],
                    'budgetMonth' => [
                        'value' => 4650
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 16
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 89
                    ],
                    'avgComparison' => [
                        'value' => -93
                    ],
                    'avgLast30Day' => [
                        'value' => 182
                    ],
                    'minValueLast30Day' => [
                        'value' => 142
                    ],
                    'maxValueLast30Day' => [
                        'value' => 214
                    ]
                ]
            ],
            [
                "country" => "Niemcy",
                "shop" => [
                    "shopSales" => [
                        "value" => 34662,
                        "art" => 3455
                    ],
                    "avgComparison" => [
                        "value" => -2501099240,
                        "art" => 3069
                    ],
                    "avgLast30Day" => [
                        "value" => 2501133902,
                        "art" => 386
                    ],
                    "minValueLast30Day" => [
                        "value" => 414,
                        "art" => 2
                    ],
                    "maxValueLast30Day" => [
                        "value" => 9999987446,
                        "art" => 990
                    ],
                    "costShare" => [
                        "value" => 1.35
                    ],
                    "comparisonClickToCost" => [
                        "value" => 7.50
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 46095
                    ],
                    'avgComparison' => [
                        'value' => 22687
                    ],
                    'avgLast30Day' => [
                        'value' => 23408
                    ],
                    'minValueLast30Day' => [
                        'value' => 4755
                    ],
                    'maxValueLast30Day' => [
                        'value' => 42162
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 600
                    ],
                    'avgComparison' => [
                        'value' => 187
                    ],
                    'avgLast30Day' => [
                        'value' => 413
                    ],
                    'minValueLast30Day' => [
                        'value' => 0
                    ],
                    'maxValueLast30Day' => [
                        'value' => 570
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 570
                    ],
                    'budgetMonth' => [
                        'value' => 2480
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 22
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 160
                    ],
                    'avgComparison' => [
                        'value' => 50
                    ],
                    'avgLast30Day' => [
                        'value' => 110
                    ],
                    'minValueLast30Day' => [
                        'value' => 0
                    ],
                    'maxValueLast30Day' => [
                        'value' => 152
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 1414
                    ],
                    'avgComparison' => [
                        'value' => 511
                    ],
                    'avgLast30Day' => [
                        'value' => 903
                    ],
                    'minValueLast30Day' => [
                        'value' => 756
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1220
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 1414
                    ],
                    'budgetMonth' => [
                        'value' => 3720
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 38
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 51
                    ],
                    'avgComparison' => [
                        'value' => -70
                    ],
                    'avgLast30Day' => [
                        'value' => 121
                    ],
                    'minValueLast30Day' => [
                        'value' => 71
                    ],
                    'maxValueLast30Day' => [
                        'value' => 175
                    ]
                ]
            ],
            [
                "country" => "Rumunia",
                "shop" => [
                    "shopSales" => [
                        "value" => 62346,
                        "art" => 23443
                    ],
                    "avgComparison" => [
                        "value" => 58374,
                        "art" => 23354
                    ],
                    "avgLast30Day" => [
                        "value" => 3972,
                        "art" => 89
                    ],
                    "minValueLast30Day" => [
                        "value" => 189,
                        "art" => 12
                    ],
                    "maxValueLast30Day" => [
                        "value" => 12532,
                        "art" => 190
                    ],
                    "costShare" => [
                        "value" => 0.57
                    ],
                    "comparisonClickToCost" => [
                        "value" => 52.15
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 44955
                    ],
                    'avgComparison' => [
                        'value' => 17686
                    ],
                    'avgLast30Day' => [
                        'value' => 27269
                    ],
                    'minValueLast30Day' => [
                        'value' => 13824
                    ],
                    'maxValueLast30Day' => [
                        'value' => 45879
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "facebook" => [
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
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 1525
                    ],
                    'avgComparison' => [
                        'value' => 358
                    ],
                    'avgLast30Day' => [
                        'value' => 1167
                    ],
                    'minValueLast30Day' => [
                        'value' => 1014
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1269
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 1525
                    ],
                    'budgetMonth' => [
                        'value' => 2480
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 61
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 137
                    ],
                    'avgComparison' => [
                        'value' => 10
                    ],
                    'avgLast30Day' => [
                        'value' => 127
                    ],
                    'minValueLast30Day' => [
                        'value' => 72
                    ],
                    'maxValueLast30Day' => [
                        'value' => 161
                    ]
                ]
            ],
            [
                "country" => "B2B",
                "shop" => [
                    "shopSales" => [
                        "value" => 3463,
                        "art" => 133
                    ],
                    "avgComparison" => [
                        "value" => -4302,
                        "art" => 76
                    ],
                    "avgLast30Day" => [
                        "value" => 7765,
                        "art" => 57
                    ],
                    "minValueLast30Day" => [
                        "value" => 180,
                        "art" => 1
                    ],
                    "maxValueLast30Day" => [
                        "value" => 23555,
                        "art" => 190
                    ],
                    "costShare" => [
                        "value" => "-"
                    ],
                    "comparisonClickToCost" => [
                        "value" => '-'
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
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "facebook" => [
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
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "google" => [
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
                        "value" => 149254,
                        "art" => 27330
                    ],
                    "avgComparison" => [
                        "value" => -2501026560,
                        "art" => 26811
                    ],
                    "avgLast30Day" => [
                        "value" => 2501175814,
                        "art" => 519
                    ],
                    "minValueLast30Day" => [
                        "value" => 624,
                        "art" => 35
                    ],
                    "maxValueLast30Day" => [
                        "value" => 10000087502,
                        "art" => 1190
                    ],
                    "costShare" => [
                        "value" => 0.68
                    ],
                    "comparisonClickToCost" => [
                        "value" => 21.43
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 127556
                    ],
                    'avgComparison' => [
                        'value' => 50433
                    ],
                    'avgLast30Day' => [
                        'value' => 77123
                    ],
                    'minValueLast30Day' => [
                        'value' => 55183
                    ],
                    'maxValueLast30Day' => [
                        'value' => 97938
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 660
                    ],
                    'avgComparison' => [
                        'value' => -309
                    ],
                    'avgLast30Day' => [
                        'value' => 969
                    ],
                    'minValueLast30Day' => [
                        'value' => 514
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1140
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 630
                    ],
                    'budgetMonth' => [
                        'value' => 5580
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 11
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 280
                    ],
                    'avgComparison' => [
                        'value' => 22
                    ],
                    'avgLast30Day' => [
                        'value' => 258
                    ],
                    'minValueLast30Day' => [
                        'value' => 137
                    ],
                    'maxValueLast30Day' => [
                        'value' => 304
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 3723
                    ],
                    'avgComparison' => [
                        'value' => 567
                    ],
                    'avgLast30Day' => [
                        'value' => 3156
                    ],
                    'minValueLast30Day' => [
                        'value' => 2747
                    ],
                    'maxValueLast30Day' => [
                        'value' => 3463
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 3723
                    ],
                    'budgetMonth' => [
                        'value' => 10850
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 34
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 277
                    ],
                    'avgComparison' => [
                        'value' => -154
                    ],
                    'avgLast30Day' => [
                        'value' => 431
                    ],
                    'minValueLast30Day' => [
                        'value' => 361
                    ],
                    'maxValueLast30Day' => [
                        'value' => 505
                    ]
                ]
            ]
        ];

        $lastDay = date("Y-m-d", strtotime("last sunday", time()));
        Storage::fake();
        Storage::disk()
            ->put(config('report.containerReportResultWeekly') . "{$lastDay}.json", json_encode($expectResult));

        $user = User::factory()->create();
        actingAs($user)
            ->get(route('report.weekly') . "?date={$lastDay}")
            ->assertOk();
    });
    it('report week name isn`t change', function () {
        $uriPathByNameRoute = route('report.weekly', null, false);


        expect($uriPathByNameRoute)
            ->toBe('/api/report/weekly');

    });

});

describe('verification format and count response data', function () {
   it('verification structure and format response', function () {
       $expectResult = [
           [
               "country" => "Polska",
               "shop" => [
                   "shopSales" => [
                       "value" => 52246,
                       "art" => 432
                   ],
                   "avgComparison" => [
                       "value" => 14307,
                       "art" => 389
                   ],
                   "avgLast30Day" => [
                       "value" => 37939,
                       "art" => 43
                   ],
                   "minValueLast30Day" => [
                       "value" => 21,
                       "art" => 10
                   ],
                   "maxValueLast30Day" => [
                       "value" => 99076,
                       "art" => 120
                   ],
                   "costShare" => [
                       "value" => 0.38
                   ],
                   "comparisonClickToCost" => [
                       "value" => 1.18
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 36506
                   ],
                   'avgComparison' => [
                       'value' => 10061
                   ],
                   'avgLast30Day' => [
                       'value' => 26445
                   ],
                   'minValueLast30Day' => [
                       'value' => 18626
                   ],
                   'maxValueLast30Day' => [
                       'value' => 36604
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 60
                   ],
                   'avgComparison' => [
                       'value' => -496
                   ],
                   'avgLast30Day' => [
                       'value' => 556
                   ],
                   'minValueLast30Day' => [
                       'value' => 514
                   ],
                   'maxValueLast30Day' => [
                       'value' => 600
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 60
                   ],
                   'budgetMonth' => [
                       'value' => 3100
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 1
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 120
                   ],
                   'avgComparison' => [
                       'value' => -28
                   ],
                   'avgLast30Day' => [
                       'value' => 148
                   ],
                   'minValueLast30Day' => [
                       'value' => 137
                   ],
                   'maxValueLast30Day' => [
                       'value' => 160
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 784
                   ],
                   'avgComparison' => [
                       'value' => -301
                   ],
                   'avgLast30Day' => [
                       'value' => 1085
                   ],
                   'minValueLast30Day' => [
                       'value' => 796
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1231
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 784
                   ],
                   'budgetMonth' => [
                       'value' => 4650
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 16
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 89
                   ],
                   'avgComparison' => [
                       'value' => -93
                   ],
                   'avgLast30Day' => [
                       'value' => 182
                   ],
                   'minValueLast30Day' => [
                       'value' => 142
                   ],
                   'maxValueLast30Day' => [
                       'value' => 214
                   ]
               ]
           ],
           [
               "country" => "Niemcy",
               "shop" => [
                   "shopSales" => [
                       "value" => 34662,
                       "art" => 3455
                   ],
                   "avgComparison" => [
                       "value" => -2501099240,
                       "art" => 3069
                   ],
                   "avgLast30Day" => [
                       "value" => 2501133902,
                       "art" => 386
                   ],
                   "minValueLast30Day" => [
                       "value" => 414,
                       "art" => 2
                   ],
                   "maxValueLast30Day" => [
                       "value" => 9999987446,
                       "art" => 990
                   ],
                   "costShare" => [
                       "value" => 1.35
                   ],
                   "comparisonClickToCost" => [
                       "value" => 7.50
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 46095
                   ],
                   'avgComparison' => [
                       'value' => 22687
                   ],
                   'avgLast30Day' => [
                       'value' => 23408
                   ],
                   'minValueLast30Day' => [
                       'value' => 4755
                   ],
                   'maxValueLast30Day' => [
                       'value' => 42162
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 600
                   ],
                   'avgComparison' => [
                       'value' => 187
                   ],
                   'avgLast30Day' => [
                       'value' => 413
                   ],
                   'minValueLast30Day' => [
                       'value' => 0
                   ],
                   'maxValueLast30Day' => [
                       'value' => 570
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 570
                   ],
                   'budgetMonth' => [
                       'value' => 2480
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 22
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 160
                   ],
                   'avgComparison' => [
                       'value' => 50
                   ],
                   'avgLast30Day' => [
                       'value' => 110
                   ],
                   'minValueLast30Day' => [
                       'value' => 0
                   ],
                   'maxValueLast30Day' => [
                       'value' => 152
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 1414
                   ],
                   'avgComparison' => [
                       'value' => 511
                   ],
                   'avgLast30Day' => [
                       'value' => 903
                   ],
                   'minValueLast30Day' => [
                       'value' => 756
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1220
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 1414
                   ],
                   'budgetMonth' => [
                       'value' => 3720
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 38
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 51
                   ],
                   'avgComparison' => [
                       'value' => -70
                   ],
                   'avgLast30Day' => [
                       'value' => 121
                   ],
                   'minValueLast30Day' => [
                       'value' => 71
                   ],
                   'maxValueLast30Day' => [
                       'value' => 175
                   ]
               ]
           ],
           [
               "country" => "Rumunia",
               "shop" => [
                   "shopSales" => [
                       "value" => 62346,
                       "art" => 23443
                   ],
                   "avgComparison" => [
                       "value" => 58374,
                       "art" => 23354
                   ],
                   "avgLast30Day" => [
                       "value" => 3972,
                       "art" => 89
                   ],
                   "minValueLast30Day" => [
                       "value" => 189,
                       "art" => 12
                   ],
                   "maxValueLast30Day" => [
                       "value" => 12532,
                       "art" => 190
                   ],
                   "costShare" => [
                       "value" => 0.57
                   ],
                   "comparisonClickToCost" => [
                       "value" => 52.15
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 44955
                   ],
                   'avgComparison' => [
                       'value' => 17686
                   ],
                   'avgLast30Day' => [
                       'value' => 27269
                   ],
                   'minValueLast30Day' => [
                       'value' => 13824
                   ],
                   'maxValueLast30Day' => [
                       'value' => 45879
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "facebook" => [
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
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 1525
                   ],
                   'avgComparison' => [
                       'value' => 358
                   ],
                   'avgLast30Day' => [
                       'value' => 1167
                   ],
                   'minValueLast30Day' => [
                       'value' => 1014
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1269
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 1525
                   ],
                   'budgetMonth' => [
                       'value' => 2480
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 61
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 137
                   ],
                   'avgComparison' => [
                       'value' => 10
                   ],
                   'avgLast30Day' => [
                       'value' => 127
                   ],
                   'minValueLast30Day' => [
                       'value' => 72
                   ],
                   'maxValueLast30Day' => [
                       'value' => 161
                   ]
               ]
           ],
           [
               "country" => "B2B",
               "shop" => [
                   "shopSales" => [
                       "value" => 3463,
                       "art" => 133
                   ],
                   "avgComparison" => [
                       "value" => -4302,
                       "art" => 76
                   ],
                   "avgLast30Day" => [
                       "value" => 7765,
                       "art" => 57
                   ],
                   "minValueLast30Day" => [
                       "value" => 180,
                       "art" => 1
                   ],
                   "maxValueLast30Day" => [
                       "value" => 23555,
                       "art" => 190
                   ],
                   "costShare" => [
                       "value" => "-"
                   ],
                   "comparisonClickToCost" => [
                       "value" => '-'
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
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "facebook" => [
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
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "google" => [
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
                       "value" => 149254,
                       "art" => 27330
                   ],
                   "avgComparison" => [
                       "value" => -2501026560,
                       "art" => 26811
                   ],
                   "avgLast30Day" => [
                       "value" => 2501175814,
                       "art" => 519
                   ],
                   "minValueLast30Day" => [
                       "value" => 624,
                       "art" => 35
                   ],
                   "maxValueLast30Day" => [
                       "value" => 10000087502,
                       "art" => 1190
                   ],
                   "costShare" => [
                       "value" => 0.68
                   ],
                   "comparisonClickToCost" => [
                       "value" => 21.43
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 127556
                   ],
                   'avgComparison' => [
                       'value' => 50433
                   ],
                   'avgLast30Day' => [
                       'value' => 77123
                   ],
                   'minValueLast30Day' => [
                       'value' => 55183
                   ],
                   'maxValueLast30Day' => [
                       'value' => 97938
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 660
                   ],
                   'avgComparison' => [
                       'value' => -309
                   ],
                   'avgLast30Day' => [
                       'value' => 969
                   ],
                   'minValueLast30Day' => [
                       'value' => 514
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1140
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 630
                   ],
                   'budgetMonth' => [
                       'value' => 5580
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 11
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 280
                   ],
                   'avgComparison' => [
                       'value' => 22
                   ],
                   'avgLast30Day' => [
                       'value' => 258
                   ],
                   'minValueLast30Day' => [
                       'value' => 137
                   ],
                   'maxValueLast30Day' => [
                       'value' => 304
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 3723
                   ],
                   'avgComparison' => [
                       'value' => 567
                   ],
                   'avgLast30Day' => [
                       'value' => 3156
                   ],
                   'minValueLast30Day' => [
                       'value' => 2747
                   ],
                   'maxValueLast30Day' => [
                       'value' => 3463
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 3723
                   ],
                   'budgetMonth' => [
                       'value' => 10850
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 34
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 277
                   ],
                   'avgComparison' => [
                       'value' => -154
                   ],
                   'avgLast30Day' => [
                       'value' => 431
                   ],
                   'minValueLast30Day' => [
                       'value' => 361
                   ],
                   'maxValueLast30Day' => [
                       'value' => 505
                   ]
               ]
           ]
       ];

       $lastDay = date("Y-m-d", strtotime("last sunday", time()));
       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportResultWeekly') . "{$lastDay}.json", json_encode($expectResult));

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
           'percentDaysPassedInCurrentMonth' => [
               'value'
           ],
       ];

       $user = User::factory()->create();
       actingAs($user)
           ->get(route('report.weekly') . "?date={$lastDay}")
           ->assertJsonStructure(
               [
                   'data' => [
                       "*" => [
                           'country',
                           'shop' => [
                               'shopSales' => $structureValueAndArt,
                               'costShare' => [
                                   'value'
                               ],
                               'comparisonClickToCost' => [
                                   'value'
                               ],
                               'minValueLast30Day' => $structureValueAndArt,
                               'maxValueLast30Day' => $structureValueAndArt,
                               'avgLast30Day' => $structureValueAndArt,
                               'avgComparison' => $structureValueAndArt,
                           ],
                           'global' => $structureStatistic,
                           'google' => $structureStatistic,
                           'facebook' => $structureStatistic,
                           'costGoogle' => $structureStatisticCost,
                           'costFacebook' => $structureStatisticCost,
                       ]
                   ],
                   'date'
               ]
           );
   });

   it('Verification correct value for data in 20.06.2024 file data for this date isset', function () {

       $expectResult = [
           [
               "country" => "Polska",
               "shop" => [
                   "shopSales" => [
                       "value" => 52246,
                       "art" => 432
                   ],
                   "avgComparison" => [
                       "value" => 14307,
                       "art" => 389
                   ],
                   "avgLast30Day" => [
                       "value" => 37939,
                       "art" => 43
                   ],
                   "minValueLast30Day" => [
                       "value" => 21,
                       "art" => 10
                   ],
                   "maxValueLast30Day" => [
                       "value" => 99076,
                       "art" => 120
                   ],
                   "costShare" => [
                       "value" => 0.38
                   ],
                   "comparisonClickToCost" => [
                       "value" => 1.18
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 36506
                   ],
                   'avgComparison' => [
                       'value' => 10061
                   ],
                   'avgLast30Day' => [
                       'value' => 26445
                   ],
                   'minValueLast30Day' => [
                       'value' => 18626
                   ],
                   'maxValueLast30Day' => [
                       'value' => 36604
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 60
                   ],
                   'avgComparison' => [
                       'value' => -496
                   ],
                   'avgLast30Day' => [
                       'value' => 556
                   ],
                   'minValueLast30Day' => [
                       'value' => 514
                   ],
                   'maxValueLast30Day' => [
                       'value' => 600
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 60
                   ],
                   'budgetMonth' => [
                       'value' => 3100
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 1
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 120
                   ],
                   'avgComparison' => [
                       'value' => -28
                   ],
                   'avgLast30Day' => [
                       'value' => 148
                   ],
                   'minValueLast30Day' => [
                       'value' => 137
                   ],
                   'maxValueLast30Day' => [
                       'value' => 160
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 784
                   ],
                   'avgComparison' => [
                       'value' => -301
                   ],
                   'avgLast30Day' => [
                       'value' => 1085
                   ],
                   'minValueLast30Day' => [
                       'value' => 796
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1231
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 784
                   ],
                   'budgetMonth' => [
                       'value' => 4650
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 16
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 89
                   ],
                   'avgComparison' => [
                       'value' => -93
                   ],
                   'avgLast30Day' => [
                       'value' => 182
                   ],
                   'minValueLast30Day' => [
                       'value' => 142
                   ],
                   'maxValueLast30Day' => [
                       'value' => 214
                   ]
               ]
           ],
           [
               "country" => "Niemcy",
               "shop" => [
                   "shopSales" => [
                       "value" => 34662,
                       "art" => 3455
                   ],
                   "avgComparison" => [
                       "value" => -2501099240,
                       "art" => 3069
                   ],
                   "avgLast30Day" => [
                       "value" => 2501133902,
                       "art" => 386
                   ],
                   "minValueLast30Day" => [
                       "value" => 414,
                       "art" => 2
                   ],
                   "maxValueLast30Day" => [
                       "value" => 9999987446,
                       "art" => 990
                   ],
                   "costShare" => [
                       "value" => 1.35
                   ],
                   "comparisonClickToCost" => [
                       "value" => 7.50
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 46095
                   ],
                   'avgComparison' => [
                       'value' => 22687
                   ],
                   'avgLast30Day' => [
                       'value' => 23408
                   ],
                   'minValueLast30Day' => [
                       'value' => 4755
                   ],
                   'maxValueLast30Day' => [
                       'value' => 42162
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 600
                   ],
                   'avgComparison' => [
                       'value' => 187
                   ],
                   'avgLast30Day' => [
                       'value' => 413
                   ],
                   'minValueLast30Day' => [
                       'value' => 0
                   ],
                   'maxValueLast30Day' => [
                       'value' => 570
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 570
                   ],
                   'budgetMonth' => [
                       'value' => 2480
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 22
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 160
                   ],
                   'avgComparison' => [
                       'value' => 50
                   ],
                   'avgLast30Day' => [
                       'value' => 110
                   ],
                   'minValueLast30Day' => [
                       'value' => 0
                   ],
                   'maxValueLast30Day' => [
                       'value' => 152
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 1414
                   ],
                   'avgComparison' => [
                       'value' => 511
                   ],
                   'avgLast30Day' => [
                       'value' => 903
                   ],
                   'minValueLast30Day' => [
                       'value' => 756
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1220
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 1414
                   ],
                   'budgetMonth' => [
                       'value' => 3720
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 38
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 51
                   ],
                   'avgComparison' => [
                       'value' => -70
                   ],
                   'avgLast30Day' => [
                       'value' => 121
                   ],
                   'minValueLast30Day' => [
                       'value' => 71
                   ],
                   'maxValueLast30Day' => [
                       'value' => 175
                   ]
               ]
           ],
           [
               "country" => "Rumunia",
               "shop" => [
                   "shopSales" => [
                       "value" => 62346,
                       "art" => 23443
                   ],
                   "avgComparison" => [
                       "value" => 58374,
                       "art" => 23354
                   ],
                   "avgLast30Day" => [
                       "value" => 3972,
                       "art" => 89
                   ],
                   "minValueLast30Day" => [
                       "value" => 189,
                       "art" => 12
                   ],
                   "maxValueLast30Day" => [
                       "value" => 12532,
                       "art" => 190
                   ],
                   "costShare" => [
                       "value" => 0.57
                   ],
                   "comparisonClickToCost" => [
                       "value" => 52.15
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 44955
                   ],
                   'avgComparison' => [
                       'value' => 17686
                   ],
                   'avgLast30Day' => [
                       'value' => 27269
                   ],
                   'minValueLast30Day' => [
                       'value' => 13824
                   ],
                   'maxValueLast30Day' => [
                       'value' => 45879
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "facebook" => [
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
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 1525
                   ],
                   'avgComparison' => [
                       'value' => 358
                   ],
                   'avgLast30Day' => [
                       'value' => 1167
                   ],
                   'minValueLast30Day' => [
                       'value' => 1014
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1269
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 1525
                   ],
                   'budgetMonth' => [
                       'value' => 2480
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 61
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 137
                   ],
                   'avgComparison' => [
                       'value' => 10
                   ],
                   'avgLast30Day' => [
                       'value' => 127
                   ],
                   'minValueLast30Day' => [
                       'value' => 72
                   ],
                   'maxValueLast30Day' => [
                       'value' => 161
                   ]
               ]
           ],
           [
               "country" => "B2B",
               "shop" => [
                   "shopSales" => [
                       "value" => 3463,
                       "art" => 133
                   ],
                   "avgComparison" => [
                       "value" => -4302,
                       "art" => 76
                   ],
                   "avgLast30Day" => [
                       "value" => 7765,
                       "art" => 57
                   ],
                   "minValueLast30Day" => [
                       "value" => 180,
                       "art" => 1
                   ],
                   "maxValueLast30Day" => [
                       "value" => 23555,
                       "art" => 190
                   ],
                   "costShare" => [
                       "value" => "-"
                   ],
                   "comparisonClickToCost" => [
                       "value" => '-'
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
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "facebook" => [
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
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
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
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 0
                   ],
                   'budgetMonth' => [
                       'value' => 0
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 0
                   ],
               ],
               "google" => [
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
                       "value" => 149254,
                       "art" => 27330
                   ],
                   "avgComparison" => [
                       "value" => -2501026560,
                       "art" => 26811
                   ],
                   "avgLast30Day" => [
                       "value" => 2501175814,
                       "art" => 519
                   ],
                   "minValueLast30Day" => [
                       "value" => 624,
                       "art" => 35
                   ],
                   "maxValueLast30Day" => [
                       "value" => 10000087502,
                       "art" => 1190
                   ],
                   "costShare" => [
                       "value" => 0.68
                   ],
                   "comparisonClickToCost" => [
                       "value" => 21.43
                   ]
               ],
               "global" => [
                   'countClick' => [
                       'value' => 127556
                   ],
                   'avgComparison' => [
                       'value' => 50433
                   ],
                   'avgLast30Day' => [
                       'value' => 77123
                   ],
                   'minValueLast30Day' => [
                       'value' => 55183
                   ],
                   'maxValueLast30Day' => [
                       'value' => 97938
                   ]
               ],
               "costFacebook" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 660
                   ],
                   'avgComparison' => [
                       'value' => -309
                   ],
                   'avgLast30Day' => [
                       'value' => 969
                   ],
                   'minValueLast30Day' => [
                       'value' => 514
                   ],
                   'maxValueLast30Day' => [
                       'value' => 1140
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 630
                   ],
                   'budgetMonth' => [
                       'value' => 5580
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 11
                   ],
               ],
               "facebook" => [
                   'countClick' => [
                       'value' => 280
                   ],
                   'avgComparison' => [
                       'value' => 22
                   ],
                   'avgLast30Day' => [
                       'value' => 258
                   ],
                   'minValueLast30Day' => [
                       'value' => 137
                   ],
                   'maxValueLast30Day' => [
                       'value' => 304
                   ]
               ],
               "costGoogle" => [
                   "percentDaysPassedInCurrentMonth" => [
                       'value' => 22
                   ],
                   'cost' => [
                       'value' => 3723
                   ],
                   'avgComparison' => [
                       'value' => 567
                   ],
                   'avgLast30Day' => [
                       'value' => 3156
                   ],
                   'minValueLast30Day' => [
                       'value' => 2747
                   ],
                   'maxValueLast30Day' => [
                       'value' => 3463
                   ],
                   'costFromBeginningMonth' => [
                       'value' => 3723
                   ],
                   'budgetMonth' => [
                       'value' => 10850
                   ],
                   'percentCostFromBeginningMonth' => [
                       'value' => 34
                   ],
               ],
               "google" => [
                   'countClick' => [
                       'value' => 277
                   ],
                   'avgComparison' => [
                       'value' => -154
                   ],
                   'avgLast30Day' => [
                       'value' => 431
                   ],
                   'minValueLast30Day' => [
                       'value' => 361
                   ],
                   'maxValueLast30Day' => [
                       'value' => 505
                   ]
               ]
           ]
       ];
       $lastDay = date("Y-m-d", strtotime("last sunday", time()));

       Storage::fake();
       Storage::disk()
           ->put(config('report.containerReportResultWeekly') . "{$lastDay}.json", json_encode($expectResult));

       $user = User::factory()->create();

       $response = actingAs($user)
                        ->get(route('report.weekly') . "?date={$lastDay}")
                        ->json();

       expect($response)
           ->toMatchArray([
               'data' => $expectResult,
               'date' =>$lastDay
           ]);
   });

    it('Verification correct response for empty date input', function () {

        $expectResult = [
            [
                "country" => "Polska",
                "shop" => [
                    "shopSales" => [
                        "value" => 52246,
                        "art" => 432
                    ],
                    "avgComparison" => [
                        "value" => 14307,
                        "art" => 389
                    ],
                    "avgLast30Day" => [
                        "value" => 37939,
                        "art" => 43
                    ],
                    "minValueLast30Day" => [
                        "value" => 21,
                        "art" => 10
                    ],
                    "maxValueLast30Day" => [
                        "value" => 99076,
                        "art" => 120
                    ],
                    "costShare" => [
                        "value" => 0.38
                    ],
                    "comparisonClickToCost" => [
                        "value" => 1.18
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 36506
                    ],
                    'avgComparison' => [
                        'value' => 10061
                    ],
                    'avgLast30Day' => [
                        'value' => 26445
                    ],
                    'minValueLast30Day' => [
                        'value' => 18626
                    ],
                    'maxValueLast30Day' => [
                        'value' => 36604
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 60
                    ],
                    'avgComparison' => [
                        'value' => -496
                    ],
                    'avgLast30Day' => [
                        'value' => 556
                    ],
                    'minValueLast30Day' => [
                        'value' => 514
                    ],
                    'maxValueLast30Day' => [
                        'value' => 600
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 60
                    ],
                    'budgetMonth' => [
                        'value' => 3100
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 1
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 120
                    ],
                    'avgComparison' => [
                        'value' => -28
                    ],
                    'avgLast30Day' => [
                        'value' => 148
                    ],
                    'minValueLast30Day' => [
                        'value' => 137
                    ],
                    'maxValueLast30Day' => [
                        'value' => 160
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 784
                    ],
                    'avgComparison' => [
                        'value' => -301
                    ],
                    'avgLast30Day' => [
                        'value' => 1085
                    ],
                    'minValueLast30Day' => [
                        'value' => 796
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1231
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 784
                    ],
                    'budgetMonth' => [
                        'value' => 4650
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 16
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 89
                    ],
                    'avgComparison' => [
                        'value' => -93
                    ],
                    'avgLast30Day' => [
                        'value' => 182
                    ],
                    'minValueLast30Day' => [
                        'value' => 142
                    ],
                    'maxValueLast30Day' => [
                        'value' => 214
                    ]
                ]
            ],
            [
                "country" => "Niemcy",
                "shop" => [
                    "shopSales" => [
                        "value" => 34662,
                        "art" => 3455
                    ],
                    "avgComparison" => [
                        "value" => -2501099240,
                        "art" => 3069
                    ],
                    "avgLast30Day" => [
                        "value" => 2501133902,
                        "art" => 386
                    ],
                    "minValueLast30Day" => [
                        "value" => 414,
                        "art" => 2
                    ],
                    "maxValueLast30Day" => [
                        "value" => 9999987446,
                        "art" => 990
                    ],
                    "costShare" => [
                        "value" => 1.35
                    ],
                    "comparisonClickToCost" => [
                        "value" => 7.50
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 46095
                    ],
                    'avgComparison' => [
                        'value' => 22687
                    ],
                    'avgLast30Day' => [
                        'value' => 23408
                    ],
                    'minValueLast30Day' => [
                        'value' => 4755
                    ],
                    'maxValueLast30Day' => [
                        'value' => 42162
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 600
                    ],
                    'avgComparison' => [
                        'value' => 187
                    ],
                    'avgLast30Day' => [
                        'value' => 413
                    ],
                    'minValueLast30Day' => [
                        'value' => 0
                    ],
                    'maxValueLast30Day' => [
                        'value' => 570
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 570
                    ],
                    'budgetMonth' => [
                        'value' => 2480
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 22
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 160
                    ],
                    'avgComparison' => [
                        'value' => 50
                    ],
                    'avgLast30Day' => [
                        'value' => 110
                    ],
                    'minValueLast30Day' => [
                        'value' => 0
                    ],
                    'maxValueLast30Day' => [
                        'value' => 152
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 1414
                    ],
                    'avgComparison' => [
                        'value' => 511
                    ],
                    'avgLast30Day' => [
                        'value' => 903
                    ],
                    'minValueLast30Day' => [
                        'value' => 756
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1220
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 1414
                    ],
                    'budgetMonth' => [
                        'value' => 3720
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 38
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 51
                    ],
                    'avgComparison' => [
                        'value' => -70
                    ],
                    'avgLast30Day' => [
                        'value' => 121
                    ],
                    'minValueLast30Day' => [
                        'value' => 71
                    ],
                    'maxValueLast30Day' => [
                        'value' => 175
                    ]
                ]
            ],
            [
                "country" => "Rumunia",
                "shop" => [
                    "shopSales" => [
                        "value" => 62346,
                        "art" => 23443
                    ],
                    "avgComparison" => [
                        "value" => 58374,
                        "art" => 23354
                    ],
                    "avgLast30Day" => [
                        "value" => 3972,
                        "art" => 89
                    ],
                    "minValueLast30Day" => [
                        "value" => 189,
                        "art" => 12
                    ],
                    "maxValueLast30Day" => [
                        "value" => 12532,
                        "art" => 190
                    ],
                    "costShare" => [
                        "value" => 0.57
                    ],
                    "comparisonClickToCost" => [
                        "value" => 52.15
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 44955
                    ],
                    'avgComparison' => [
                        'value' => 17686
                    ],
                    'avgLast30Day' => [
                        'value' => 27269
                    ],
                    'minValueLast30Day' => [
                        'value' => 13824
                    ],
                    'maxValueLast30Day' => [
                        'value' => 45879
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "facebook" => [
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
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 1525
                    ],
                    'avgComparison' => [
                        'value' => 358
                    ],
                    'avgLast30Day' => [
                        'value' => 1167
                    ],
                    'minValueLast30Day' => [
                        'value' => 1014
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1269
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 1525
                    ],
                    'budgetMonth' => [
                        'value' => 2480
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 61
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 137
                    ],
                    'avgComparison' => [
                        'value' => 10
                    ],
                    'avgLast30Day' => [
                        'value' => 127
                    ],
                    'minValueLast30Day' => [
                        'value' => 72
                    ],
                    'maxValueLast30Day' => [
                        'value' => 161
                    ]
                ]
            ],
            [
                "country" => "B2B",
                "shop" => [
                    "shopSales" => [
                        "value" => 3463,
                        "art" => 133
                    ],
                    "avgComparison" => [
                        "value" => -4302,
                        "art" => 76
                    ],
                    "avgLast30Day" => [
                        "value" => 7765,
                        "art" => 57
                    ],
                    "minValueLast30Day" => [
                        "value" => 180,
                        "art" => 1
                    ],
                    "maxValueLast30Day" => [
                        "value" => 23555,
                        "art" => 190
                    ],
                    "costShare" => [
                        "value" => "-"
                    ],
                    "comparisonClickToCost" => [
                        "value" => '-'
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
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "facebook" => [
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
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
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
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 0
                    ],
                    'budgetMonth' => [
                        'value' => 0
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 0
                    ],
                ],
                "google" => [
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
                        "value" => 149254,
                        "art" => 27330
                    ],
                    "avgComparison" => [
                        "value" => -2501026560,
                        "art" => 26811
                    ],
                    "avgLast30Day" => [
                        "value" => 2501175814,
                        "art" => 519
                    ],
                    "minValueLast30Day" => [
                        "value" => 624,
                        "art" => 35
                    ],
                    "maxValueLast30Day" => [
                        "value" => 10000087502,
                        "art" => 1190
                    ],
                    "costShare" => [
                        "value" => 0.68
                    ],
                    "comparisonClickToCost" => [
                        "value" => 21.43
                    ]
                ],
                "global" => [
                    'countClick' => [
                        'value' => 127556
                    ],
                    'avgComparison' => [
                        'value' => 50433
                    ],
                    'avgLast30Day' => [
                        'value' => 77123
                    ],
                    'minValueLast30Day' => [
                        'value' => 55183
                    ],
                    'maxValueLast30Day' => [
                        'value' => 97938
                    ]
                ],
                "costFacebook" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 660
                    ],
                    'avgComparison' => [
                        'value' => -309
                    ],
                    'avgLast30Day' => [
                        'value' => 969
                    ],
                    'minValueLast30Day' => [
                        'value' => 514
                    ],
                    'maxValueLast30Day' => [
                        'value' => 1140
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 630
                    ],
                    'budgetMonth' => [
                        'value' => 5580
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 11
                    ],
                ],
                "facebook" => [
                    'countClick' => [
                        'value' => 280
                    ],
                    'avgComparison' => [
                        'value' => 22
                    ],
                    'avgLast30Day' => [
                        'value' => 258
                    ],
                    'minValueLast30Day' => [
                        'value' => 137
                    ],
                    'maxValueLast30Day' => [
                        'value' => 304
                    ]
                ],
                "costGoogle" => [
                    "percentDaysPassedInCurrentMonth" => [
                        'value' => 22
                    ],
                    'cost' => [
                        'value' => 3723
                    ],
                    'avgComparison' => [
                        'value' => 567
                    ],
                    'avgLast30Day' => [
                        'value' => 3156
                    ],
                    'minValueLast30Day' => [
                        'value' => 2747
                    ],
                    'maxValueLast30Day' => [
                        'value' => 3463
                    ],
                    'costFromBeginningMonth' => [
                        'value' => 3723
                    ],
                    'budgetMonth' => [
                        'value' => 10850
                    ],
                    'percentCostFromBeginningMonth' => [
                        'value' => 34
                    ],
                ],
                "google" => [
                    'countClick' => [
                        'value' => 277
                    ],
                    'avgComparison' => [
                        'value' => -154
                    ],
                    'avgLast30Day' => [
                        'value' => 431
                    ],
                    'minValueLast30Day' => [
                        'value' => 361
                    ],
                    'maxValueLast30Day' => [
                        'value' => 505
                    ]
                ]
            ]
        ];

        $lastDay = date("Y-m-d", strtotime("last sunday", time()));

        Storage::fake();
        Storage::disk()
            ->put(config('report.containerReportResultWeekly') . "{$lastDay}.json", json_encode($expectResult));

        $user = User::factory()->create();
        $responseApi = actingAs($user)
            ->get(route('report.weekly'))
            ->json('data');

        expect($responseApi)
            ->toMatchArray($expectResult);
    });
});

it('Test available response api for not log in user expected error with http code 401', function () {

    Storage::fake();

    getJson(route('report.weekly'))
        ->assertStatus(401);

});
