<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $params = [
            'valueWithCurrency' => [],
            'art' => [],
            'value' => [],
        ];

        $countries = [];
        for ($i = 0; $i <= 25; $i++) {
            $countries[] = 'Polska';
            $params['valueWithCurrency'][] = rand(100, 1999);
            $params['art'][] = rand(1, 25);
            $params['value'][] = rand(100, 999);
            $params['percent'][] = rand(5, 100);
        }

        $countries = [
            'Polska',
        ];
        for ($i = 0; $i < 25; $i++) {
            $countries[] = 'Polska';
        }

        $testStatistic = [
            'countClick' => [
                'value' => $params['value']
            ],
            'avgComparison' => [
                'value' => $params['percent']
            ],
            'avgLast30Day' => [
                'value' => $params['value']
            ],
            'minValueLast30Day' => [
                'value' => $params['value']
            ],
            'maxValueLast30Day' => [
                'value' => $params['value']
            ]
        ];

        $testStatisticSales = [
            'cost' => [
                'value' => $params['valueWithCurrency']
            ],
            'avgComparison' => [
                'value' => $params['percent']
            ],
            'avgLast30Day' => [
                'value' => $params['valueWithCurrency']
            ],
            'minValueLast30Day' => [
                'value' => $params['valueWithCurrency']
            ],
            'maxValueLast30Day' => [
                'value' => $params['valueWithCurrency']
            ],
            'costFromBeginningMonth' => [
                'value' => $params['valueWithCurrency']
            ],
            'budgetMonth' => [
                'value' => $params['valueWithCurrency']
            ],
            'percentCostFromBeginningMonth' => [
                'value' => $params['valueWithCurrency']
            ],
        ];

        $testResponse =
            [
                'shops' => [
                    'countries' => $countries,
                    'shop_sales' => [
                        'value' => $params['valueWithCurrency'],
                        'art' => $params['art']
                    ],

                    'avgComparison' => [
                        'value' => $params['percent'],
                        'art' => $params['percent']
                    ],
                    'avgLast30Day' => [
                        'value' => $params['valueWithCurrency'],
                        'art' => $params['art']
                    ],
                    'minValueLast30Day' => [
                        'value' => $params['valueWithCurrency'],
                        'art' => $params['art']
                    ],
                    'maxValueLast30Day' => [
                        'value' => $params['valueWithCurrency'],
                        'art' => $params['art']
                    ],
                ],
                'global' => $testStatistic,
                'google' => $testStatistic,
                'facebook' => $testStatistic,
                'cost-google' => $testStatisticSales,
                'cost-facebook' => $testStatisticSales,
            ];

        return response([
            'data' => $testResponse
        ]);
    }
}
