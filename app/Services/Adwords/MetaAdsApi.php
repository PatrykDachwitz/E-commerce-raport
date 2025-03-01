<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use App\Services\Currency\CoursePLN;
use Exception;
use Illuminate\Support\Facades\Http;

class MetaAdsApi extends AdwordsApi
{

    protected string $budgetNameColumn = "facebook_daily_budget";
    protected string $nameAdwordsColumn = "facebook";

    private CoursePLN $coursePLN;

    public function __construct(CoursePLN $coursePLN)
    {
        $this->coursePLN = $coursePLN;
    }

    protected function connectApi(string $startDate, string $endDate, string $idAccount) : array|null {
        $tokenMeta = env('DEVELOPER_TOKEN_FACEBOOK');

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {$tokenMeta}",
        ])
            ->get(config('api.endPointFacebook'). "/v20.0/act_{$idAccount}/insights?fields=clicks,spend&action_attribution_windows=['7d_click','1d_view']&time_range[since]={$startDate}&time_range[until]={$endDate}");


        if ($response->ok()) {
            try {
                return $response->json('data')[0];
            } catch (Exception) {
                return null;
            }
        } else {
            return null;
        }
    }

    protected function getSpendBudgetInCurrentMonth(Country $country, string $dateCurrent) : int {
        $currentYearWithMonth = date("Y-m", strtotime($dateCurrent));
        $startDay = "{$currentYearWithMonth}-01";

        $accountsId = $this->getAccountsId($country[$this->nameAdwordsColumn]);
        $spendMonthly = 0;

        foreach ($accountsId as $id) {
            $responseApi = $this->connectApi($startDay, $dateCurrent, $id);

            if (!is_null($responseApi)) {
                $spendMonthly += intval($responseApi['spend']);
            }
        }

        return $spendMonthly;
    }

    private function getAccountsId(string $idAccount) : array {
        if (strstr($idAccount, ";")) {
            $accountsId = explode(";", $idAccount);
        } else {
            $accountsId = [$idAccount];
        }

        return $accountsId;
    }
    private function conversionCostToDefaultCurrencies(string $currency, array $data ) : array {
        $valueCurrency = $this->coursePLN->getCurrentCourse($currency);
        $data['budget']['current'] = intval($data['budget']['current'] * $valueCurrency);
        $data['budget']['summaryWithoutCurrent'] = intval($data['budget']['summaryWithoutCurrent'] * $valueCurrency);
        $data['budget']['minWithoutCurrent'] = intval($data['budget']['minWithoutCurrent'] * $valueCurrency);
        $data['budget']['maxWithoutCurrent'] = intval($data['budget']['maxWithoutCurrent'] * $valueCurrency);
        $data['budget']['spentBudgetFromBeginningOfMonth'] = intval($data['budget']['spentBudgetFromBeginningOfMonth'] * $valueCurrency);
        foreach ($data['dataByRangesWithoutCurrent'] as $key => $item) {
            $data['dataByRangesWithoutCurrent'][$key]['spend'] = intval($data['dataByRangesWithoutCurrent'][$key]['spend'] * $valueCurrency);
        }

        return $data;
    }

    protected function downloadResponseApi(string $idAccount) : array {
        $dataResponse = [];

        $accountsId = $this->getAccountsId($idAccount);

        foreach ($this->dateRanges as $key => $date) {

            foreach ($accountsId as $id) {
                $responseDataApi = $this->connectApi($date['start'], $date['end'], $id);

                if (!isset($dataResponse[$key])) {
                    $dataResponse[$key] = $responseDataApi;
                } elseif(isset($dataResponse[$key]) & !is_null($responseDataApi)) {

                    $dataResponse[$key]['clicks'] += $responseDataApi['clicks'];
                    $dataResponse[$key]['spend'] += $responseDataApi['spend'];
                }
            }
        }
        return $dataResponse;
    }

    protected function calculateResultApi(Country $country, string $currentDate, string $lastDate) : array {
        $dataResponseApi = $this->downloadResponseApi($country[$this->nameAdwordsColumn]);
        $structureResponse = $this->getStructureResponse();

        foreach ($dataResponseApi as $key => $data) {
            if (is_null($data)) {
                $this->setDataPerDate(0, 0, $this->dateRanges[$key]['start']);
                if ($key === "current") {
                    $structureResponse['click']['current'] = 0;
                    $structureResponse['budget']['current'] = 0;
                } else {
                    $structureResponse['click']['minWithoutCurrent'] = 0;
                    $structureResponse['budget']['minWithoutCurrent'] = 0;

                }
                continue;
            }

            $this->setDataPerDate(intval($data['spend']), intval($data['clicks']), $this->dateRanges[$key]['start']);
            $convertResponse = $this->convertForResponseDataRanges($key, intval($data['spend']), intval($data['clicks']));
            $structureResponse['dataByRangesWithoutCurrent'][$convertResponse['date']] = $convertResponse['data'];
            if ($key === "current") {
                $structureResponse['click']['current'] = intval($data['clicks']);
                $structureResponse['budget']['current'] = intval($data['spend']);
            } else {
               $structureResponse['click']['summaryWithoutCurrent'] += intval($data['clicks']);
                $structureResponse['budget']['summaryWithoutCurrent'] += intval($data['spend']);
                $structureResponse['click']['minWithoutCurrent'] = $this->getMinValue($structureResponse, intval($data['clicks']), 'click');
                $structureResponse['budget']['minWithoutCurrent'] = $this->getMinValue($structureResponse, intval($data['spend']), 'budget');
                $structureResponse['click']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, intval($data['clicks']), 'click');
                $structureResponse['budget']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, intval($data['spend']), 'budget');
            }
        }

        if (is_null($structureResponse['click']['minWithoutCurrent'])) $structureResponse['click']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['minWithoutCurrent'])) $structureResponse['budget']['minWithoutCurrent'] = 0;
        if (is_null($structureResponse['click']['maxWithoutCurrent'])) $structureResponse['click']['maxWithoutCurrent'] = 0;
        if (is_null($structureResponse['budget']['maxWithoutCurrent'])) $structureResponse['budget']['maxWithoutCurrent'] = 0;

        $structureResponse['dataByRangesWithoutCurrent'] = $this->getEmptyDataForNotIssetRangesDate($structureResponse['dataByRangesWithoutCurrent'] ?? []);
        $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] = $this->getSpendBudgetInCurrentMonth($country, $this->dateRanges['current']['end']);
        $structureResponse['budget']['budgetMonthly'] = $this->getMonthlyBudget();
        $structureResponse['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($structureResponse['budget']);

        return $this->calculateAvgWithComparison($structureResponse);
    }


    public function get(string $currentDate, string $lastDate, Country $country) : array {
        $this->calculateDateRanges($currentDate, $lastDate);
        $this->country = $country;

        $resultApi = $this->calculateResultApi($country, $currentDate, $lastDate);

        if(!is_null($country->facebook_budget_currency) & $country->facebook_budget_currency !== "PLN") {
            $resultApi = $this->conversionCostToDefaultCurrencies($country->facebook_budget_currency, $resultApi);
            $resultApi['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($resultApi['budget']);
        }

        return array_merge($this->calculateAvgWithComparison($resultApi), [
            'dates' => $this->dataPerDate
        ]);
    }



    public function getWithManyRangesDate(array $currentDate, array $rangesOtherDate, Country $country) : array {
        $this->addManyRangesDate($currentDate, $rangesOtherDate);
        $this->country = $country;


        $resultApi = $this->calculateResultApi($country, $currentDate['start'], $currentDate['end']);

        if(!is_null($country->facebook_budget_currency) & $country->facebook_budget_currency !== "PLN") {
            $resultApi = $this->conversionCostToDefaultCurrencies($country->facebook_budget_currency, $resultApi);
            $resultApi['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($resultApi['budget']);
        }

        return $this->calculateAvgWithComparison($resultApi);
    }
}
