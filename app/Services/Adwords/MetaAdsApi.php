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
            ->get("https://graph.facebook.com/v20.0/act_{$idAccount}/insights?fields=clicks,spend&action_attribution_windows=['7d_click','1d_view']&time_range[since]={$startDate}&time_range[until]={$endDate}");


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

    private function conversionCostToDefaultCurrencies(string $currency, array $data ) : array {
        $valueCurrency = $this->coursePLN->getCurrentCourse($currency);
        $data['budget']['current'] = intval($data['budget']['current'] * $valueCurrency);
        $data['budget']['summaryWithoutCurrent'] = intval($data['budget']['summaryWithoutCurrent'] * $valueCurrency);
        $data['budget']['minWithoutCurrent'] = intval($data['budget']['minWithoutCurrent'] * $valueCurrency);
        $data['budget']['maxWithoutCurrent'] = intval($data['budget']['maxWithoutCurrent'] * $valueCurrency);
        $data['budget']['spentBudgetFromBeginningOfMonth'] = intval($data['budget']['spentBudgetFromBeginningOfMonth'] * $valueCurrency);

        return $data;
    }

    public function get(string $currentDate, string $lastDate, Country $country) : array {
        $this->calculateDateRanges($currentDate, $lastDate);
        $this->country = $country;

        $resultApi = $this->calculateResultApi($country);

        if(!is_null($country->facebook_budget_currency) & $country->facebook_budget_currency !== "PLN") {
            $resultApi = $this->conversionCostToDefaultCurrencies($country->facebook_budget_currency, $resultApi);
            $resultApi['budget']['percentSpentBudgetMonthlyCurrentDay'] = $this->getPercentSpendMonthlyBudget($resultApi['budget']);
        }

        return $this->calculateAvgWithComparison($resultApi);;
    }
}
