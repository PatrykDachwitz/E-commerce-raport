<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\Adwords\AdwordsApi;
use App\Services\Adwords\AnalyticsApi;
use Database\Seeders\CountrySeeder;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsServerStreamDecorator;
use Google\Ads\GoogleAds\V16\Services\GoogleAdsRow;
use Google\Ads\GoogleAds\V16\Services\SearchGoogleAdsStreamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\withCookies;

class testGoogle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $expectArray12 = [
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
        Storage::disk()
            ->put(config('report.containerReportComparisonDay') . "2024-06-25.json", json_encode($expectArray12));

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
        Storage::disk()
            ->put(config('report.containerReportResultDay') . "2024-06-25.json", json_encode($expectResult));


    }
}

