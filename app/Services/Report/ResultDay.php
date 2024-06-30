<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Exception;
use function Laravel\Prompts\error;

///Jęzeli brak danych to zrami zapisać co jeśl pojawi siębład kodu httpt lub brak wartosci albo dzepsuty plk
class ResultDay
{

    private ShopSales $shopSales;
    private Country $country;
    private MetaAdsApi $metaAdsApi;
    private array $datesReport;
    private array $responseApiShop;

    private AnalyticsApi $analyticsApi;

    public function __construct(ShopSales $shopSales, Country $country, AnalyticsApi $analyticsApi, MetaAdsApi $metaAdsApi)
    {
        $this->shopSales = $shopSales;
        $this->country = $country;
        $this->analyticsApi = $analyticsApi;
        $this->metaAdsApi = $metaAdsApi;
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

    private function getEmptyFormatFacebook() : array {
        return [

            "budget" => [
                'cost' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
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
            "click" => [
                'countClick' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
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
        ];
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

    private function getResponseFacebookWithData(array $data) : array {
        return [

            "budget" => [
                'cost' => [
                    'value' => $data['budget']['current']
                ],
                'avgComparison' => [
                    'value' => $data['budget']['avgComparisonWithoutCurrent']
                ],
                'avgLast30Day' => [
                    'value' => $data['budget']['avgWithoutCurrent']
                ],
                'minValueLast30Day' => [
                    'value' => $data['budget']['minWithoutCurrent']
                ],
                'maxValueLast30Day' => [
                    'value' => $data['budget']['maxWithoutCurrent']
                ],
                'costFromBeginningMonth' => [
                    'value' => $data['budget']['spentBudgetFromBeginningOfMonth']
                ],
                'budgetMonth' => [
                    'value' => $data['budget']['budgetMonthly']
                ],
                'summaryWithoutCurrent' => [
                    'value' => $data['budget']['summaryWithoutCurrent']
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => $data['budget']['percentSpentBudgetMonthlyCurrentDay']
                ],
            ],
            "click" => [
                'countClick' => [
                    'value' => $data['click']['current']
                ],
                'avgComparison' => [
                    'value' => $data['click']['avgComparisonWithoutCurrent']
                ],
                'summaryWithoutCurrent' => [
                    'value' => $data['click']['summaryWithoutCurrent']
                ],
                'avgLast30Day' => [
                    'value' => $data['click']['avgWithoutCurrent']
                ],
                'minValueLast30Day' => [
                    'value' => $data['click']['minWithoutCurrent']
                ],
                'maxValueLast30Day' => [
                    'value' => $data['click']['maxWithoutCurrent']
                ]
            ]
        ];
    }
    private function calculateSummaryFacebook(array $dataMeta) : array {

        $summaryResult = [

            "budget" => [
                'cost' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
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
            "click" => [
                'countClick' => [
                    'value' => 0
                ],
                'avgComparison' => [
                    'value' => 0
                ],
                'summaryWithoutCurrent' => [
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
        ];


        foreach ($dataMeta as $key => $item) {

            $summaryResult['click']['countClick']['value'] += $item['click']['countClick']['value'];
            $summaryResult['click']['minValueLast30Day']['value'] += $item['click']['minValueLast30Day']['value'];
            $summaryResult['click']['maxValueLast30Day']['value'] += $item['click']['maxValueLast30Day']['value'];
            $summaryResult['budget']['cost']['value'] += $item['budget']['cost']['value'];
            $summaryResult['budget']['minValueLast30Day']['value'] += $item['budget']['minValueLast30Day']['value'];
            $summaryResult['budget']['maxValueLast30Day']['value'] += $item['budget']['maxValueLast30Day']['value'];
            $summaryResult['budget']['costFromBeginningMonth']['value'] += $item['budget']['costFromBeginningMonth']['value'];
            $summaryResult['budget']['budgetMonth']['value'] += $item['budget']['budgetMonth']['value'];
            $summaryResult['budget']['summaryWithoutCurrent']['value'] += $item['budget']['summaryWithoutCurrent']['value'];
            $summaryResult['click']['summaryWithoutCurrent']['value'] += $item['click']['summaryWithoutCurrent']['value'];
            unset($item['click']['summaryWithoutCurrent']);
            unset($item['budget']['summaryWithoutCurrent']);
        }

        $returnData = $dataMeta;

        $returnData['summary'] = $this->getAvgWithComparisonFacebook($summaryResult);

        return $returnData;
    }

    private function getAvgWithComparisonFacebook(array $data) : array {
        $data['budget']['avgLast30Day']['value'] = $data['budget']['summaryWithoutCurrent']['value'] / 30;
        $data['click']['avgLast30Day']['value'] = $data['click']['summaryWithoutCurrent']['value'] / 30;
        $data['click']['avgComparison']['value'] = intval($data['click']['countClick']['value'] - $data['click']['avgLast30Day']['value']);
        $data['budget']['avgComparison']['value'] = intval($data['budget']['cost']['value'] - $data['budget']['avgLast30Day']['value']);

        unset($data['budget']['summaryWithoutCurrent']);
        unset($data['click']['summaryWithoutCurrent']);
        return $data;
    }
    private function getFacebookResult(Collection $countries) : array {
        $currentDate = $this->datesReport[0];
        $lastDate = $this->datesReport[count($this->datesReport) - 1];

        $response = [];

        foreach ($countries as $country) {

            if (is_null($country->analytics)) {
                $responseMeta = $this->getEmptyFormatFacebook();
                $response[$country->id]['budget'] = $responseMeta['budget'];
                $response[$country->id]['click'] = $responseMeta['click'];
                continue;
            }

            $responseMetaDetail = $this->metaAdsApi
                ->get($currentDate, $lastDate, $country);


            $responseMeta = $this->getResponseFacebookWithData($responseMetaDetail);
            $response[$country->id]['budget'] = $responseMeta['budget'];
            $response[$country->id]['click'] = $responseMeta['click'];
        }

        return $this->calculateSummaryFacebook($response);
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
        $facebookResults = $this->getFacebookResult($activesCountry);

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $resultShopApi[$country->id],
                'global' => $analyticsResult[$country->id],
                'facebook' => $facebookResults[$country->id]['click'],
                'costFacebook' => $facebookResults[$country->id]['budget'],
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $resultShopApi["summary"],
            'global' => $analyticsResult["summary"],
            'facebook' => $facebookResults["summary"]['click'],
            'costFacebook' => $facebookResults["summary"]['budget'],
        ];


        return $completeReport;
    }

}
