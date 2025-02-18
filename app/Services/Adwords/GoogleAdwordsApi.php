<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use App\Services\Connection\GoogleRefreshToken;
use Exception;
use Illuminate\Support\Facades\Http;
use function Laravel\Prompts\select;

class GoogleAdwordsApi extends AdwordsApi
{
    use GoogleRefreshToken;

    const NAME_CONFIG_CREDENTIALS = "api.pathGoogleAdwordsCredentials";
    CONST NAME_CONFIG_TOKEN = "api.pathGoogleAdwordsToken";
    protected string $budgetNameColumn = "google_daily_budget";
    protected string $nameAdwordsColumn = "google";
    private string $loginCustomerId;
    private string $developerToken;
    public function __construct()
    {
        $this->loginCustomerId = env('GOOGLE_LOGIN_CUSTOMER_ID');
        $this->developerToken = env('DEVELOPER_TOKEN_GOOGLE');
    }

    private function getBodyQueryAccountVariant(string $startDate, string $lastDate) : string {
        $query = [
            "query" => "SELECT metrics.clicks, metrics.cost_micros, segments.date  FROM customer WHERE segments.date >= '{$lastDate}' AND segments.date <= '{$startDate}'"
        ];

        return json_encode($query);
    }
    private function getBodyQueryCampaignVariant(string $startDate, string $lastDate) : string {
        $query = [
            "query" => "SELECT campaign.name, metrics.clicks, metrics.cost_micros, segments.date FROM campaign WHERE segments.date >= '{$lastDate}' AND segments.date <= '{$startDate}'"
        ];

        return json_encode($query);
    }

    public function connectApi(string $idCompany, string $startDate, string $lastDate, bool $perCampaign = true) : array|null {

        if ($perCampaign === true) {
            $bodyQuery = $this->getBodyQueryAccountVariant($startDate, $lastDate);
        } else {
            $bodyQuery = $this->getBodyQueryCampaignVariant($startDate, $lastDate);
        }



        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $this->getAccessToken(self::NAME_CONFIG_CREDENTIALS, self::NAME_CONFIG_TOKEN),
            "Content-Type" => "application/json",
            "developer-token" => $this->developerToken,
            "login-customer-id" => $this->loginCustomerId,
        ])
            ->withBody($bodyQuery)
            ->post(config('api.endPointGoogle') . "/v17/customers/{$idCompany}/googleAds:searchStream");


        try {
            return $response->json()[0]['results'];
        } catch (Exception) {
            return null;
        }
    }

    private function calculateCurrentSpendBudget(string|int $cost) : int {
        return intval(intval($cost) / 1000000);
    }

    private function issetRowForCurrentDate(array $data, string $date) : bool {
        $issetRowCurrentDate = false;

        foreach ($data as $item) {
            if ($item['segments']['date'] === $date) {
                $issetRowCurrentDate = true;
                break;
            }
        }

        return $issetRowCurrentDate;
    }
    //Verification correct count row in response and writing 0 click and spend in minimum value row if row is not completed
    private function verificationNumberReturnedRows(array|null $responseApi, array $structureResponse, string $date) : array {
        //Add 1 value because count day is without current date
        if (is_null($responseApi)) {
            $structureResponse['click']['minWithoutCurrent'] = 0;
            $structureResponse['budget']['minWithoutCurrent'] = 0;

        } else  {
            $countResponse = count($responseApi);
            if ($countResponse !== ($this->countDayWithoutCurrent + 1) & $this->issetRowForCurrentDate($responseApi, $date)) {
                $structureResponse['click']['minWithoutCurrent'] = 0;
                $structureResponse['budget']['minWithoutCurrent'] = 0;
            } elseif ($countResponse <= $this->countDayWithoutCurrent - 1) {
                $structureResponse['click']['minWithoutCurrent'] = 0;
                $structureResponse['budget']['minWithoutCurrent'] = 0;
            }
        }

        return $structureResponse;
    }

    protected function isCurrentTimeInRange(string $date) : bool{

        $startTime = strtotime($this->dateRanges['current']['start']);
        $endTime = strtotime($this->dateRanges['current']['end']);
        $currentTime = strtotime($date);

        return boolval($currentTime >= $startTime & $currentTime <= $endTime);
    }

    protected function isRangesDate(string $date) : bool {
        $currentTime = strtotime($date);
        $isRanges = false;

        foreach ($this->dateRanges as $key => $date) {

            if ($key === "current") continue;

            $startTime = strtotime($date['start']);
            $endTime = strtotime($date['end']);

            if ($currentTime >= $startTime & $currentTime <= $endTime) {
                $isRanges = true;
                break;
            }
        }

        return $isRanges;
    }
    protected function getKeyDateRanges(string $date) : int|string|null {
        $currentTime = strtotime($date);
        $isRanges = null;

        foreach ($this->dateRanges as $key => $date) {

            $startTime = strtotime($date['start']);
            $endTime = strtotime($date['end']);

            if ($currentTime >= $startTime & $currentTime <= $endTime) {
                $isRanges = $key;
                break;
            }
        }

        return $isRanges;
    }

    private function addNoBuildRangesByDate(array $data) : array {

        foreach ($this->dateRanges as $key => $date) {
            if (!isset($data[$key])) {
                $data[$key] = [
                    "clicks" => 0,
                    "cost" => 0,
                ];
            }
        }

        return $data;
    }
    private function groupResultApiByRangesDate(array $data) : array {
        $response = [];
        $spendMonthlyBudget = 0;

        foreach ($data as $item) {
            $keyDateRanges = $this->getKeyDateRanges($item['segments']['date']);

            $spendMonthlyBudget += $this->addSpendBudgetCurrentMonth($item['segments']['date'], $this->calculateCurrentSpendBudget($item['metrics']['costMicros']));

            if ($keyDateRanges === null) continue;

            if (isset($response[$keyDateRanges])) {

                $response[$keyDateRanges]['clicks'] += intval($item['metrics']['clicks']);
                $response[$keyDateRanges]['cost'] += $this->calculateCurrentSpendBudget($item['metrics']['costMicros']);

            } else {

                $response[$keyDateRanges] = [
                    'clicks' => intval($item['metrics']['clicks']),
                    'cost' => $this->calculateCurrentSpendBudget($item['metrics']['costMicros'])
                ];

            }
        }

        return [
            "spendMonthlyBudget" => $spendMonthlyBudget,
            "data" => $this->addNoBuildRangesByDate($response)
        ];
    }

    private function getAccountWithIdCampaign(string $googleAdditionalCampaign) : array {
        $account = explode(";", $googleAdditionalCampaign);
        $idCampaigns = explode(",", $account[1]);

        return [
            "account" => $account[0],
            "campaigns" => $idCampaigns
        ];
    }

    private function getIdCampaign(string $name) : string {
        $nameConvert = explode("/campaigns/", $name);

        return $nameConvert[1];
    }
    private function mergeResultApiWithAdditional(array|null $mainResponse, array $additional, array $availableIdCampaigns) : array {


        if (is_null($mainResponse)) {
            foreach ($additional as $data) {
                $id = $this->getIdCampaign($data['campaign']['resourceName']);
                $dateSearch = $data['segments']['date'];

                if (in_array($id, $availableIdCampaigns)) {
                    $isset = false;
                    if (is_null($mainResponse)) {
                        $mainResponse[] = $data;
                        $isset = true;
                    }
                    else {
                        foreach ($mainResponse as $key => $item) {
                            if ($item['segments']['date'] === $dateSearch) {
                                $isset = true;
                                $mainResponse[$key]['metrics']['clicks'] = intval($mainResponse[$key]['metrics']['clicks']) + intval($data['metrics']['clicks']);
                                $mainResponse[$key]['metrics']['costMicros'] = intval($mainResponse[$key]['metrics']['costMicros']) + intval($data['metrics']['costMicros']);
                            }
                        }
                    }

                    if ($isset === false) $mainResponse[] = $data;
                }


            }
          //  dd($mainResponse);
        } else {

            foreach ($additional as $data) {
                $id = $this->getIdCampaign($data['campaign']['resourceName']);

                if (in_array($id, $availableIdCampaigns)) {
                    $dateSearch = $data['segments']['date'];

                    if (is_null($mainResponse)) {
                       } else {
                        foreach ($mainResponse as $key => $mainData) {
                            if ($mainData['segments']['date'] === $dateSearch) {
                                $mainResponse[$key]['metrics']['clicks'] = intval($mainResponse[$key]['metrics']['clicks']) + intval($data['metrics']['clicks']);
                                $mainResponse[$key]['metrics']['costMicros'] = intval($mainResponse[$key]['metrics']['costMicros']) + intval($data['metrics']['costMicros']);
                            }
                        }//$this->isCurrentTimeInRange($data['segments']['date'])

                    }
                }
            }
        }

        return $mainResponse;
    }
    private function downloadResultApi(Country $country, string $currentDate, string $lastDate) : array|null {
        $resultApi = $this->connectApi($country[$this->nameAdwordsColumn], $currentDate, $lastDate);
       // dd($resultApi);
        if (!is_null($country->google_additional_campaign)) {
            $accountInfo = $this->getAccountWithIdCampaign($country->google_additional_campaign);
            $additionalResultApi = $this->connectApi($accountInfo['account'], $currentDate, $lastDate, false);
          //  dump("additional");
           // dump($additionalResultApi);
            if (!is_null($additionalResultApi)) {
                $resultApi = $this->mergeResultApiWithAdditional($resultApi, $additionalResultApi, $accountInfo['campaigns']);
            }
        }

        return $resultApi;
    }
    protected function calculateResultApi(Country $country, string $currentDate, string $lastDate) : array {
        $dataResponseApi = $this->downloadResultApi($country, $currentDate, $lastDate);
        $structureResponse = $this->getStructureResponse();
        $structureResponse = $this->verificationNumberReturnedRows($dataResponseApi, $structureResponse, $currentDate);

        if (!is_null($dataResponseApi)){


        foreach ($dataResponseApi as $key => $data) {
            $cost = $this->calculateCurrentSpendBudget($data['metrics']['costMicros']);
            $click = intval($data['metrics']['clicks']);
            $formatData = [
                'click' => $click,
                'spend' => $cost,
            ];

            if ($this->isCurrentTimeInRange($data['segments']['date'])) {
                $structureResponse['dataByRangesWithoutCurrent']["current"] = $formatData;
                $structureResponse['click']['current'] += $click;
                $structureResponse['budget']['current'] += $cost;
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += $cost;
            } elseif($this->isRangesDate($data['segments']['date'])) {
                $structureResponse['dataByRangesWithoutCurrent']["{$data['segments']['date']}_{$data['segments']['date']}"] = $formatData;
                $structureResponse['click']['summaryWithoutCurrent'] += $click;
                $structureResponse['budget']['summaryWithoutCurrent'] += $cost;
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += $this->addSpendBudgetCurrentMonth($data['segments']['date'], $cost);

                $structureResponse['click']['minWithoutCurrent'] = $this->getMinValue($structureResponse, $click, 'click');
                $structureResponse['budget']['minWithoutCurrent'] = $this->getMinValue($structureResponse, $cost, 'budget');
                $structureResponse['click']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, $click, 'click');
                $structureResponse['budget']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, $cost, 'budget');
            }
        }}

        if (is_null($structureResponse['click']['minWithoutCurrent'])) $structureResponse['click']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['minWithoutCurrent'])) $structureResponse['budget']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['click']['maxWithoutCurrent'])) $structureResponse['click']['maxWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['maxWithoutCurrent'])) $structureResponse['budget']['maxWithoutCurrent'] = 0;

        $structureResponse['dataByRangesWithoutCurrent'] = $this->getEmptyDataForNotIssetRangesDate($structureResponse['dataByRangesWithoutCurrent'] ?? []);
        $structureResponse['budget']['budgetMonthly'] = $this->getMonthlyBudget();
        $structureResponse['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($structureResponse['budget']);

        return $this->calculateAvgWithComparison($structureResponse);
    }


    protected function calculateResultApiManyDatesRanges(Country $country, string $currentDate, string $lastDate) : array {
        $dataResponseApi = $this->downloadResultApi($country, $currentDate, $lastDate);
        $structureResponse = $this->getStructureResponse();

        if (!is_null($dataResponseApi)) {
            $dataApiGroupByDate = $this->groupResultApiByRangesDate($dataResponseApi);

            $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] = $dataApiGroupByDate['spendMonthlyBudget'];
            foreach ($dataApiGroupByDate['data'] as $key => $data) {
                $convertResponse = $this->convertForResponseDataRanges($key, $data['cost'], $data['clicks']);
                $structureResponse['dataByRangesWithoutCurrent'][$convertResponse['date']] = $convertResponse['data'];

                if ($key === "current") {
                    $structureResponse['click']['current'] = $data['clicks'];
                    $structureResponse['budget']['current'] = $data['cost'];
                } else {
                    $structureResponse['click']['summaryWithoutCurrent'] += $data['clicks'];
                    $structureResponse['budget']['summaryWithoutCurrent'] += $data['cost'];

                    $structureResponse['click']['minWithoutCurrent'] = $this->getMinValue($structureResponse, $data['clicks'], 'click');
                    $structureResponse['budget']['minWithoutCurrent'] = $this->getMinValue($structureResponse, $data['cost'], 'budget');
                    $structureResponse['click']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, $data['clicks'], 'click');
                    $structureResponse['budget']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, $data['cost'], 'budget');
                }
            }
        } else {
            $structureResponse['dataByRangesWithoutCurrent'] = $this->getEmptyDataForNotIssetRangesDate();
        }
        if (is_null($structureResponse['click']['minWithoutCurrent'])) $structureResponse['click']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['minWithoutCurrent'])) $structureResponse['budget']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['click']['maxWithoutCurrent'])) $structureResponse['click']['maxWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['maxWithoutCurrent'])) $structureResponse['budget']['maxWithoutCurrent'] = 0;



        $structureResponse['budget']['budgetMonthly'] = $this->getMonthlyBudget();
        $structureResponse['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($structureResponse['budget']);

        return $this->calculateAvgWithComparison($structureResponse);
    }


    public function get(string $currentDate, string $lastDate, Country $country) : array {
        $this->calculateDateRanges($currentDate, $lastDate);
        $this->country = $country;

        $resultApi = $this->calculateResultApi($country, $currentDate, $lastDate);

        return $this->calculateAvgWithComparison($resultApi);
    }


    public function getWithManyRangesDate(array $currentDate, array $rangesOtherDate, Country $country) : array {
        $this->addManyRangesDate($currentDate, $rangesOtherDate);
        $this->country = $country;


        $resultApi = $this->calculateResultApiManyDatesRanges($country, $currentDate['end'], $rangesOtherDate[count($rangesOtherDate) - 1]['start']);

        return $this->calculateAvgWithComparison($resultApi);
    }
}
