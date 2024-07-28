<?php
declare(strict_types=1);
namespace App\Services\Report\Support;

use App\Models\Country;
use App\Services\Currency\CoursePLN;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Exception;

class ShopResult
{


    private CoursePLN $coursePLN;
    private array $notSummaryResultId;

    private array $responseApiShop;
    private ShopSales $shopSales;
    public function __construct(ShopSales $shopSales, CoursePLN $coursePLN)
    {
        $this->shopSales = $shopSales;
        $this->coursePLN = $coursePLN;
    }

    private function getClearStructureShopResponse() : array {
        return [
            "summary" => [
                "shopSales" => [
                    "value" => 0,
                    "art" => 0,
                ],
                "minValueLast30Day" => [
                    "value" => null,
                    "art" => null,
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

    private function getCostAdwordsInEuro(int|string $idAccount, array $metaAdsResult, array $googleAdsResult) : int {
        $course = $this->coursePLN->getCurrentCourse('EUR');

        $cost = intval($metaAdsResult[$idAccount]['budget']['cost']['value'] + $googleAdsResult[$idAccount]['budget']['cost']['value']);

        try {
            if ($cost > 0) {
                return intval($cost / $course);
            } else {
                return 0;
            }
        } catch (Exception) {
            return 0;
        }
    }
    private function getComparisonClickToCost(int|string $idCountry, array $shopSales, array $analyticsResult) : array {

        if ($analyticsResult[$idCountry]['countClick']['value'] > 0) {
            $comparisonClickToCost = round($shopSales['art'] / $analyticsResult[$idCountry]['countClick']['value'], 2);
        } else {
            $comparisonClickToCost = $shopSales['art'];
        }


        return [
            "value" => $comparisonClickToCost
        ];
    }
    private function getCostShare(int|string $idCountry, array $shopSales, array $metaAdsResult, array $googleAdsResult) : array {
        $costAdwords = $this->getCostAdwordsInEuro($idCountry, $metaAdsResult, $googleAdsResult);

        if ($shopSales['value'] > 0) {
            $costShare = round(($costAdwords / $shopSales['value']) * 100, 2);
        } else {
            $costShare = 100;
        }

        return [
            "value" => $costShare
        ];
    }
    private function summaryResultByCountry(array $data): array{
        $art = 0;
        $value = 0;

        foreach ($data as $idShop => $item) {
            if (!in_array($idShop, $this->notSummaryResultId)) {
                $art += $item['item'];
                $value += $item['value'];
            }
        }

        return [
            'art' => intval($art),
            'value' => intval($value),
        ];
    }
    private function resultShopSales(int $countDay, string $currentDate, array $analyticsResult, array $metaAdsResult, array $googleAdsResult) : array {
        $finalResultShop = $this->getClearStructureShopResponse();
        $summaryResultPerDay = [];

        foreach ($this->responseApiShop as $date => $response) {
            $summaryResultPerDay[$date] = $this->summaryResultByCountry($response);

            foreach ($response as $idCountry => $resultShop) {


                if ($currentDate === $date) {
                    $finalResultShop[$idCountry]['shopSales'] = [
                        'value' => intval($resultShop['value']),
                        'art' => intval($resultShop['item']),
                    ];
                    $finalResultShop[$idCountry]['costShare'] = $this->getCostShare($idCountry, $finalResultShop[$idCountry]['shopSales'], $metaAdsResult, $googleAdsResult);
                    $finalResultShop[$idCountry]['comparisonClickToCost'] = $this->getComparisonClickToCost($idCountry, $finalResultShop[$idCountry]['shopSales'], $analyticsResult);

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
                }
            }
        }
        $finalResultShop = $this->calculateSummaryResult($summaryResultPerDay, $currentDate, $finalResultShop, $analyticsResult, $metaAdsResult, $googleAdsResult);
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
            $avgArt = intval($data["summary"]['art'] / $countDay);
            $avgValue = intval($data["summary"]['value'] / $countDay);
            unset($responseCalculatedWithResult[$key]['summary']);

            $responseCalculatedWithResult[$key]['avgLast30Day'] = [
                'art' => $avgArt,
                'value' => $avgValue,
            ];

            $responseCalculatedWithResult[$key]['avgComparison'] = [
                'art' => $responseCalculatedWithResult[$key]['shopSales']['art'] - $avgArt,
                'value' => $responseCalculatedWithResult[$key]['shopSales']['value'] - $avgValue,
            ];

        }

        return $responseCalculatedWithResult;
    }

    private function calculateSummaryResult(array $data, string $currentDate, array $currentResult, array $analyticsResult, array $metaAdsResult, array $googleAdsResult) : array {
        $response = $currentResult;

        foreach ($data as $date => $item) {
            if ($currentDate === $date) {
                $response['summary']['shopSales'] = [
                    'value' => $item['value'],
                    'art' => $item['art'],
                ];
            } else {
                $response['summary']['summary']['art'] += $item['art'];
                $response['summary']['summary']['value'] += $item['value'];

                if ($response['summary']['minValueLast30Day']['value'] > $item['value'] | $response['summary']['minValueLast30Day']['value'] === null) {
                    $response['summary']['minValueLast30Day']['value'] = $item['value'];
                }
                if ($response['summary']['minValueLast30Day']['art'] > $item['art'] | $response['summary']['minValueLast30Day']['art'] === null) {
                    $response['summary']['minValueLast30Day']['art'] = $item['art'];
                }

                if ($response['summary']['maxValueLast30Day']['value'] < $item['value']) {
                    $response['summary']['maxValueLast30Day']['value'] = $item['value'];
                }
                if ($response['summary']['maxValueLast30Day']['art'] < $item['art']) {
                    $response['summary']['maxValueLast30Day']['art'] = $item['art'];
                }
            }
        }


        $response['summary']['costShare'] = $this->getCostShare('summary', $response['summary']['shopSales'], $metaAdsResult, $googleAdsResult);
        $response['summary']['comparisonClickToCost'] = $this->getComparisonClickToCost('summary', $response['summary']['shopSales'], $analyticsResult);

        return $response;
    }

    private function setNotSummaryResultIdByCountry(Collection $countries) : void {

        foreach ($countries as $country) {
            if ($country['result-summary'] === false) {
                $this->notSummaryResultId[] = $country->id;
            }
        }
    }

    public function getResult(array $dates, array $analyticsResult, array $metaAdsResult, array $googleAdsResult, Collection $countries) : array {
        $this->downloadResponseApiShop($dates['ranges']);
        $this->setNotSummaryResultIdByCountry($countries);
        //dodać od razu ilosć dni w adwords api
        return $this->resultShopSales($dates['count'], $dates['current'], $analyticsResult, $metaAdsResult, $googleAdsResult);
    }
}
