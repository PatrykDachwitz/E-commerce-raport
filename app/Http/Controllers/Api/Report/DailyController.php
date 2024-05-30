<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyController extends Controller
{

    private array $statisticResult;
    private array $statisticCost;
    private array $statisticShop;
    /**
     * Handle the incoming request.
     */

    public function __construct()
    {
        $params = [
            'valueWithCurrency' => rand(100, 1999),
            'art' => rand(100, 999),
            'value' => rand(100, 999),
            'percent' => rand(5, 100),
        ];

        $this->statisticResult = [
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

        $this->statisticCost = [
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

        $structureValueAndArt = [
            'value' => $params['value'],
            'art' => $params['art'],
        ];
        $this->statisticShop = [
            'shopSales' => $structureValueAndArt,
            'avgComparison' => $structureValueAndArt,
            'avgLast30Day' => $structureValueAndArt,
            'minValueLast30Day' => $structureValueAndArt,
            'maxValueLast30Day' => $structureValueAndArt,
        ];

    }

    public function __invoke(Request $request)
    {
        $responseStructure = [];

        for ($i = 0; $i <= 25; $i++) {
            $responseStructure[] = [
                'country' => 'Polska',
                'shop' => $this->statisticShop,
                'global' => $this->statisticResult,
                'google' => $this->statisticResult,
                'facebook' => $this->statisticResult,
                'costGoogle' => $this->statisticCost,
                'costFacebook' => $this->statisticCost,
            ];
        }

        return response([
            'data' => $responseStructure
        ]);
    }
}
