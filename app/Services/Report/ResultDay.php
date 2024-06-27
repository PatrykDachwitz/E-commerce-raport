<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Exception;
use function Laravel\Prompts\error;

///Jęzeli brak danych to zrami zapisać co jeśl pojawi siębład kodu httpt lub brak wartosci albo dzepsuty plk
class ResultDay
{

    private ShopSales $shopSales;
    private Country $country;
    private array $datesReport;
    private array $responseApiShop;

    private AnalyticsApi $analyticsApi;

    public function __construct(ShopSales $shopSales, Country $country, AnalyticsApi $analyticsApi)
    {
        $this->shopSales = $shopSales;
        $this->country = $country;
        $this->analyticsApi = $analyticsApi;
    }

    private function createDatesByCountPreviousDay(string $date, int $countPreviousDay = 30) : array {
        $this->datesReport = [$date];
        $currentTime = strtotime($date);

        for ($i = 1; $i <= $countPreviousDay; $i++) {
            $daySubtraction = (24 * 60 * 60) * $i;

            $this->datesReport[] = date("Y-m-d", ($currentTime - $daySubtraction));
        }

        return $this->datesReport;
    }



    private function downloadResponseApiShop() : void {
        $this->responseApiShop = [];

        foreach ($this->datesReport as $dateReport) {
            try {
                $this->responseApiShop[$dateReport] = $this->shopSales->getSales($dateReport, $dateReport);
            } catch (Exception) {
                $this->responseApiShop[$dateReport] = null;
            }
        }
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

    private function resultShopSales() {
        $finalResultShop = $this->getClearStructureShopResponse();
        $countDay = count($this->datesReport) - 1;

        foreach ($this->responseApiShop as $date => $response) {

            foreach ($response as $idCountry => $resultShop) {
                if ($this->datesReport[0] === $date) {
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
        $finalResultShop = $this->calculateAvgWithComparisonResult($finalResultShop, $countDay);

        return $finalResultShop;
    }

    private function returnFormatAnalytics(array|null $dataAnalytics) : array {
        if (is_null($dataAnalytics)) {
            return [
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
                ],
                'summaryWithoutCurrent' => [
                    'value' => 0
                ]
            ];

        } else {
            return [
                'countClick' => [
                    'value' => intval($dataAnalytics['current'])
                ],
                'avgComparison' => [
                    'value' => intval($dataAnalytics['current'] - $dataAnalytics['avgWithoutCurrent'])
                ],
                'avgLast30Day' => [
                    'value' => intval($dataAnalytics['avgWithoutCurrent'])
                ],
                'minValueLast30Day' => [
                    'value' => intval($dataAnalytics['minWithoutCurrent'])
                ],
                'maxValueLast30Day' => [
                    'value' => intval($dataAnalytics['maxWithoutCurrent'])
                ],
                'summaryWithoutCurrent' => [
                    'value' => intval($dataAnalytics['summaryWithoutCurrent'])
                ]
            ];

        }

    }

    private function calculateSummaryAnalytics(array $resultsAnalytics) : array {

        $result = [
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
            ],
            'summaryWithoutCurrent' => [
                'value' => 0
            ]
        ];

        foreach ($resultsAnalytics as $key => $resultAnalytics) {
            $result['countClick']['value'] += $resultAnalytics['countClick']['value'];
            $result['minValueLast30Day']['value'] += $resultAnalytics['minValueLast30Day']['value'];
            $result['maxValueLast30Day']['value'] += $resultAnalytics['maxValueLast30Day']['value'];
            $result['summaryWithoutCurrent']['value'] += $resultAnalytics['summaryWithoutCurrent']['value'];
            unset($resultsAnalytics[$key]['summaryWithoutCurrent']);
        }

        $result['avgLast30Day']['value'] = intval($result['summaryWithoutCurrent']['value'] / 30);
        $result['avgComparison']['value'] = intval($result['countClick']['value'] - $result['avgLast30Day']['value']);
        unset($result["summaryWithoutCurrent"]);

        $resultsAnalytics['summary'] = $result;

        return $resultsAnalytics;
    }

    private function getAnalyticsResult(Collection $activesCountry) : array {
        $lastDate = $this->datesReport[0];
        $startDate = $this->datesReport[count($this->datesReport) - 1];
        $currentDate = str_replace("-","", $lastDate);

        $response = [];

        foreach ($activesCountry as $country) {

            if (is_null($country->analytics)) {
                $response[$country->id] = $this->returnFormatAnalytics(null);
                continue;
            }
            $this->analyticsApi
                ->setCountry($country);

            $this->analyticsApi
                ->setDateCurrent($currentDate);

            $resultAnalytics = $this->analyticsApi
                ->get($startDate, $lastDate);

            $response[$country->id] = $this->returnFormatAnalytics($resultAnalytics);
        }

        return $this->calculateSummaryAnalytics($response);
    }
    public function get(string $date) : array {
        $this->createDatesByCountPreviousDay($date);
        $this->downloadResponseApiShop();
        $completeReport = [];

        $resultShopApi = $this->resultShopSales();
        $activesCountry = $this->country
            ->active()
            ->get();

        $analyticsResult = $this->getAnalyticsResult($activesCountry);

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $resultShopApi[$country->id],
                'global' => $analyticsResult[$country->id],
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $resultShopApi["summary"],
            'global' => $analyticsResult["summary"],
        ];


        return $completeReport;
    }

}
