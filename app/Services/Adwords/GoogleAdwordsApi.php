<?php
declare(strict_types=1);
namespace App\Services\Adwords;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class GoogleAdwordsApi extends AdwordsApi
{
    protected string $budgetNameColumn = "google_daily_budget";
    protected string $nameAdwordsColumn = "google";
    private string $loginCustomerId;
    private string $developerToken;
    public function __construct()
    {
        $this->loginCustomerId = env('GOOGLE_LOGIN_CUSTOMER_ID');
        $this->developerToken = env('DEVELOPER_TOKEN_GOOGLE');
    }

    private function getBodyQuery(string $startDate, string $lastDate) : string {
        $query = [
            "query" => "SELECT metrics.clicks, metrics.cost_micros, segments.date FROM customer WHERE segments.date >= '{$startDate}' AND segments.date <= '{$lastDate}'"
        ];

        return json_encode($query);
    }

    private function getAccessToken() : string {
        $pathToken = config('api.pathGoogleAdwordsToken');
        $contentToken = file_get_contents($pathToken);

        return json_decode($contentToken)->access_token;
    }

    public function connectApi(string $idCompany, string $startDate, string $lastDate) : array|null {
        $bodyQuery = $this->getBodyQuery($startDate, $lastDate);

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $this->getAccessToken(),
            "Content-Type" => "application/json",
            "developer-token" => $this->developerToken,
            "login-customer-id" => $this->loginCustomerId,
        ])
            ->withBody($bodyQuery)
            ->post("https://googleads.googleapis.com/v17/customers/{$idCompany}/googleAds:searchStream");

        return $response->json()[0]['results'];
    }

    private function calculateCurrentSpendBudget(string|int $cost) : int {
        return intval(intval($cost) / 1000000);
    }

    //Verification correct count row in response and writing 0 click and spend in minimum value row if row is not completed
    private function verificationNumberReturnedRows(array $responseApi, array $structureResponse) : array {
        //Add 1 value because count day is without current date
        if (count($responseApi) !== ($this->countDayWithoutCurrent + 1)) {
            $structureResponse['click']['minWithoutCurrent'] = 0;
            $structureResponse['budget']['minWithoutCurrent'] = 0;
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

    protected function calculateResultApi(Country $country, string $currentDate, string $lastDate) : array {
        $dataResponseApi = $this->connectApi($country[$this->nameAdwordsColumn], $currentDate, $lastDate);
        $structureResponse = $this->getStructureResponse();
        $structureResponse = $this->verificationNumberReturnedRows($dataResponseApi, $structureResponse);

        foreach ($dataResponseApi as $key => $data) {

            if ($this->isCurrentTimeInRange($data['segments']['date'])) {
                $structureResponse['click']['current'] = intval($data['metrics']['clicks']);
                $structureResponse['budget']['current'] = $this->calculateCurrentSpendBudget($data['metrics']['costMicros']);
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += $this->calculateCurrentSpendBudget($data['metrics']['costMicros']);
            } elseif($this->isRangesDate($data['segments']['date'])) {
                $structureResponse['click']['summaryWithoutCurrent'] += intval($data['metrics']['clicks']);
                $structureResponse['budget']['summaryWithoutCurrent'] += $this->calculateCurrentSpendBudget($data['metrics']['costMicros']);
                $structureResponse['budget']['spentBudgetFromBeginningOfMonth'] += $this->addSpendBudgetCurrentMonth($data['segments']['date'], $this->calculateCurrentSpendBudget($data['metrics']['costMicros']));

                $structureResponse['click']['minWithoutCurrent'] = $this->getMinValue($structureResponse, intval($data['metrics']['clicks']), 'click');
                $structureResponse['budget']['minWithoutCurrent'] = $this->getMinValue($structureResponse, $this->calculateCurrentSpendBudget($data['metrics']['costMicros']), 'budget');
                $structureResponse['click']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, intval($data['metrics']['clicks']), 'click');
                $structureResponse['budget']['maxWithoutCurrent'] = $this->getMaxValue($structureResponse, $this->calculateCurrentSpendBudget($data['metrics']['costMicros']), 'budget');
            }
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


        $resultApi = $this->calculateResultApi($country, $currentDate['start'], $rangesOtherDate[count($rangesOtherDate) - 1]['end']);

        return $this->calculateAvgWithComparison($resultApi);
    }
}
