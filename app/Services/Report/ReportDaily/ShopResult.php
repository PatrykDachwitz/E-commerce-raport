<?php
declare(strict_types=1);
namespace App\Services\Report\ReportDaily;

use App\Services\ShopSales;
use PHPUnit\Exception;

class ShopResult
{

    private array $responseApiShop;
    private ShopSales $shopSales;
    public function __construct(ShopSales $shopSales)
    {
        $this->shopSales = $shopSales;
    }

    private function getClearStructureShopResponse() : array {
        return [
            "summary" => [
                "shopSales" => [
                    "value" => 0,
                    "art" => 0,
                ],
                "minValueLast30Day" => [
                    "value" => 0,
                    "art" => 0,
                ],
                "maxValueLast30Day" => [
                    "value" => 0,
                    "art" => 0,
                ],
                "summary" => [
                    "value" => 0,
                    "art" => 0,
                ],
            ]
        ];

    }

    private function downloadResponseApiShop(array $dates) : void {
        $this->responseApiShop = [];

        foreach ($dates as $dateReport) {
            try {
                $this->responseApiShop[$dateReport] = $this->shopSales->getSales($dateReport, $dateReport);
            } catch (Exception) {
                $this->responseApiShop[$dateReport] = null;
            }
        }
    }

    private function resultShopSales(int $countDay, string $currentDate) : array {
        $finalResultShop = $this->getClearStructureShopResponse();

        foreach ($this->responseApiShop as $date => $response) {
            foreach ($response as $idCountry => $resultShop) {

                if ($currentDate === $date) {
                    $finalResultShop[$idCountry]['shopSales'] = [
                        'value' => intval($resultShop['value']),
                        'art' => intval($resultShop['item']),
                    ];
                    $finalResultShop["summary"]['shopSales']['value'] += $resultShop['value'];
                    $finalResultShop["summary"]['shopSales']['art'] += $resultShop['item'];
                } else {
                    $minValue = $this->verificationMinSales($resultShop, $finalResultShop[$idCountry], "minValueLast30Day");
                    $maxValue = $this->verificationMaxSales($resultShop, $finalResultShop[$idCountry], "maxValueLast30Day");

                    $finalResultShop[$idCountry]['minValueLast30Day'] = $minValue;
                    $finalResultShop[$idCountry]['maxValueLast30Day'] = $maxValue;

                    if (!isset($finalResultShop[$idCountry]['summary'])) {
                        $finalResultShop[$idCountry]['summary']['value'] = $resultShop['value'];
                        $finalResultShop[$idCountry]['summary']['art'] = $resultShop['item'];
                    } else {
                        $finalResultShop[$idCountry]['summary']['value'] += $resultShop['value'];
                        $finalResultShop[$idCountry]['summary']['art'] += $resultShop['item'];
                    }
                    $finalResultShop["summary"]['summary']['value'] += $resultShop['value'];
                    $finalResultShop["summary"]['summary']['art'] += $resultShop['item'];
                }
            }
        }

        $finalResultShop = $this->calculateSummaryResult($finalResultShop);
        return $this->calculateAvgWithComparisonResult($finalResultShop, $countDay);
    }

    private function verificationMaxSales($newSalesValue, array $currentValue, string $nameArray) : array {
        if (!isset($currentValue[$nameArray])) return [
            "art" => $newSalesValue['item'],
            "value" => $newSalesValue['value'],
        ];

        $response = [];

        foreach ($currentValue[$nameArray] as $key => $currentValue) {
            if ($key === "art") {
                $salesKey = "item"  ;
            } else {
                $salesKey = $key;
            }

            if ($currentValue < $newSalesValue[$salesKey]) {
                $response[$key] = intval($newSalesValue[$salesKey]);
            } else {
                $response[$key] = intval($currentValue);
            }
        }

        return $response;
    }
    private function verificationMinSales($newSalesValue, array $currentValue, string $nameArray) : array {
        if (!isset($currentValue[$nameArray])) return [
            "art" => $newSalesValue['item'],
            "value" => $newSalesValue['value'],
        ];
        $response = [];

        foreach ($currentValue[$nameArray] as $key => $currentValue) {
            if ($key === "art") {
                $salesKey = "item"  ;
            } else {
                $salesKey = $key;
            }

            if ($currentValue > $newSalesValue[$salesKey]) {
                $response[$key] = intval($newSalesValue[$salesKey]);
            } else {
                $response[$key] = intval($currentValue);
            }
        }


        return $response;
    }
    private function calculateAvgWithComparisonResult(array $result, int $countDay) : array {
        $responseCalculatedWithResult = $result;

        foreach ($result as $key => $data) {
            $avgArt = $data["summary"]['art'] / $countDay;
            $avgValue = $data["summary"]['value'] / $countDay;
            unset($responseCalculatedWithResult[$key]['summary']);

            $responseCalculatedWithResult[$key]['avgLast30Day'] = [
                'art' => intval($avgArt),
                'value' => intval($avgValue),
            ];

            $responseCalculatedWithResult[$key]['avgComparison'] = [
                'art' => intval($responseCalculatedWithResult[$key]['shopSales']['art'] - $avgArt),
                'value' => intval($responseCalculatedWithResult[$key]['shopSales']['value'] - $avgValue),
            ];

        }

        return $responseCalculatedWithResult;
    }

    private function calculateSummaryResult(array $currentResult) : array {
        $finalCalculate = $currentResult;

        foreach ($currentResult as $key => $result) {
            if ($key === "summary") continue;
            $finalCalculate['summary']['minValueLast30Day']['value'] += $result['minValueLast30Day']['value'];
            $finalCalculate['summary']['maxValueLast30Day']['value'] += $result['maxValueLast30Day']['value'];
            $finalCalculate['summary']['maxValueLast30Day']['art'] += $result['maxValueLast30Day']['art'];
            $finalCalculate['summary']['minValueLast30Day']['art'] += $result['minValueLast30Day']['art'];
        }

        $finalCalculate['summary']['minValueLast30Day']['value'] = intval($finalCalculate['summary']['minValueLast30Day']['value']);
        $finalCalculate['summary']['maxValueLast30Day']['value'] = intval($finalCalculate['summary']['maxValueLast30Day']['value']);
        $finalCalculate['summary']['maxValueLast30Day']['art'] = intval($finalCalculate['summary']['maxValueLast30Day']['art']);
        $finalCalculate['summary']['minValueLast30Day']['art'] = intval($finalCalculate['summary']['minValueLast30Day']['art']);
        $finalCalculate['summary']['shopSales']['art'] = intval($finalCalculate['summary']['shopSales']['art']);
        $finalCalculate['summary']['shopSales']['value'] = intval($finalCalculate['summary']['shopSales']['value']);

        return $finalCalculate;
    }

    public function getResult(array $dates) : array {
        $this->downloadResponseApiShop($dates['ranges']);
        //dodać od razu ilosć dni w adwords api
        return $this->resultShopSales($dates['count'], $dates['current']);
    }
}
