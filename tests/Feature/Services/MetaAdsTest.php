<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Currency\CoursePLN;
use Database\Seeders\MetaAdsCountrySeed;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(MetaAdsCountrySeed::class);
});

describe('Testing response meta ads services with correct data', function () {
    //Tutaj trzeba zweryfkowc kilka dni w popszednim miesiacu sprawdzić założenie eistenijaće g budżetu ale braku statystyk dal tego konta
    //Pamietąc że nie któę kraje mająwiecej niż jedno konto
    //Jakośc weryfikować ilość wydanej kasy naet gdy ostanie 30 dni nie łapią sięw nasyzm zakresie dat


    it("Testing correct calculate data about response api", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
        ]);

        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 361,
                "avgComparisonWithoutCurrent" => 131,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 55,
            ],
            "dates" => $dataPerDates
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi");



    it("Testing correct calculate with cost conversion", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $metaAdsTemplateDataForJuneResponseApi,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($metaAdsTemplateDataForJuneResponseApi),
        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];


        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 1551,
                "avgComparisonWithoutCurrent" => 563,
                "summaryWithoutCurrent" => 29656,
                "avgWithoutCurrent" => 988,
                "minWithoutCurrent" => 773,
                "maxWithoutCurrent" => 1203,
                "spentBudgetFromBeginningOfMonth" => 21322,
                "budgetMonthly" => 57060,
                "percentSpentBudgetMonthlyCurrentDay" => 37,
            ],
            "dates" => $dataPerDates
        ];

        $country = Country::find(3);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', "metaAdsTemplateDataForJuneResponseApi");


    it("Testing correct calculate data with 0 count monthly budget", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
        string $responseNbp,
        string $summarySpendBudgetMeta,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($summarySpendBudgetMeta)
        ]);


        $dataPerDates = [
            "2024-05-22"=> ['click'=>200,'cost'=>180],
            "2024-05-23"=> ['click'=>450,'cost'=>280],
            "2024-05-24"=> ['click'=>200,'cost'=>180],
            "2024-05-25"=> ['click'=>450,'cost'=>280],
            "2024-05-26"=> ['click'=>200,'cost'=>180],
            "2024-05-27"=> ['click'=>450,'cost'=>280],
            "2024-05-28"=> ['click'=>200,'cost'=>180],
            "2024-05-29"=> ['click'=>450,'cost'=>280],
            "2024-05-30"=> ['click'=>200,'cost'=>180],
            "2024-05-31"=> ['click'=>450,'cost'=>280],
            "2024-06-01"=> ['click'=>200,'cost'=>180],
            "2024-06-02"=> ['click'=>450,'cost'=>280],
            "2024-06-03"=> ['click'=>200,'cost'=>180],
            "2024-06-04"=> ['click'=>450,'cost'=>280],
            "2024-06-05"=> ['click'=>200,'cost'=>180],
            "2024-06-06"=> ['click'=>450,'cost'=>280],
            "2024-06-07"=> ['click'=>200,'cost'=>180],
            "2024-06-08"=> ['click'=>450,'cost'=>280],
            "2024-06-09"=> ['click'=>200,'cost'=>180],
            "2024-06-10"=> ['click'=>450,'cost'=>280],
            "2024-06-11"=> ['click'=>200,'cost'=>180],
            "2024-06-12"=> ['click'=>450,'cost'=>280],
            "2024-06-13"=> ['click'=>200,'cost'=>180],
            "2024-06-14"=> ['click'=>450,'cost'=>280],
            "2024-06-15"=> ['click'=>200,'cost'=>180],
            "2024-06-16"=> ['click'=>450,'cost'=>280],
            "2024-06-17"=> ['click'=>200,'cost'=>180],
            "2024-06-18"=> ['click'=>450,'cost'=>280],
            "2024-06-19"=> ['click'=>200,'cost'=>180],
            "2024-06-20"=> ['click'=>450,'cost'=>280],
            "2024-06-21"=> ['click'=>204,'cost'=>361]
        ];

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 204,
                "summaryWithoutCurrent" => 9750,
                "avgWithoutCurrent" => 325,
                "avgComparisonWithoutCurrent" => -121,
                "minWithoutCurrent" => 200,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 361,
                "avgComparisonWithoutCurrent" => 131,
                "summaryWithoutCurrent" => 6900,
                "avgWithoutCurrent" => 230,
                "minWithoutCurrent" => 180,
                "maxWithoutCurrent" => 280,
                "spentBudgetFromBeginningOfMonth" => 4961,
                "budgetMonthly" => 0,
                "percentSpentBudgetMonthlyCurrentDay" => 100,
            ],
            "dates" => $dataPerDates
        ];

        $country = Country::find(2);
        expect($metaAds->get("2024-06-21", "2024-05-22", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay', 'responseNbpApi', 'metaAdsTemplateDataForJuneResponseApi');



});


describe('Testing response meta ads services with wrong data' , function () {
    it("Testing data with all wrong response api", function (
        string $currentDateResponseApi,
        string $oneDayResponseApi,
        string $secondDayResponseApi,
    ) {

        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($oneDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($secondDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($oneDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($secondDayResponseApi, 500),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($oneDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($secondDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($oneDayResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi, 404),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response($currentDateResponseApi, 404)
        ]);


        $dates = [
            '2024-06-21',
            '2024-06-20',
            '2024-06-19',
            '2024-06-18',
            '2024-06-17',
            '2024-06-16',
            '2024-06-15',
            '2024-06-14'
        ];

        $singleDataPerDate = [];
        foreach ($dates as $date) {
            $singleDataPerDate[$date] = [
                'cost' => 0,
                'click' => 0
            ];
        }

        $metaAds = new MetaAdsApi(new CoursePLN());

        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dates" => $singleDataPerDate
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForCurrentDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForSecondDay');

    it("Testing data with all zero content response api", function () {

        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-21" => Http::response("", 200),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-21" => Http::response("", 200),
        ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        $dates = [
            '2024-06-21',
            '2024-06-20',
            '2024-06-19',
            '2024-06-18',
            '2024-06-17',
            '2024-06-16',
            '2024-06-15',
            '2024-06-14'
        ];

        $singleDataPerDate = [];
        foreach ($dates as $date) {
            $singleDataPerDate[$date] = [
                'cost' => 0,
                'click' => 0
            ];
        }


        $metaData = [
            'click' => [
                'current' => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "avgComparisonWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
            ],
            "budget" => [
                'current' => 0,
                "avgComparisonWithoutCurrent" => 0,
                "summaryWithoutCurrent" => 0,
                "avgWithoutCurrent" => 0,
                "minWithoutCurrent" => 0,
                "maxWithoutCurrent" => 0,
                "spentBudgetFromBeginningOfMonth" => 0,
                "budgetMonthly" => 9000,
                "percentSpentBudgetMonthlyCurrentDay" => 0,
            ],
            "dates" => $singleDataPerDate
        ];

        $country = Country::find(1);
        expect($metaAds->get("2024-06-21", "2024-06-14", $country))
            ->toMatchArray($metaData);

    });
});

describe("Testing response api for many date with correct data", function () {

    it("Testing correct calculate data about response api", function (
        string $metaAdsTemplateDataForFourthDay,
        string $metaAdsTemplateDataForThirdDay,
        string $metaAdsTemplateDataForSecondDay,
        string $metaAdsTemplateDataForOneDay,
        string $metaAdsTemplateDataForCurrentDay,
        string $responseNbp,
        string $metaFullMonthResponse,
    ) {

        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response($responseNbp),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($metaAdsTemplateDataForFourthDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($metaAdsTemplateDataForThirdDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($metaAdsTemplateDataForSecondDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($metaAdsTemplateDataForOneDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($metaAdsTemplateDataForCurrentDay),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($metaFullMonthResponse),
            ]);



        $metaAds = new MetaAdsApi(new CoursePLN());

        //Zaras dodać  //"spentBudgetFromBeginningOfMonth" => 4961,
       // "percentSpentBudgetMonthlyCurrentDay" => 55,
        //               // "//budgetMonthly" => 9000,
        $metaData = [
            'click' => [
                'current' => 120,
                "summaryWithoutCurrent" => 954,
                "avgWithoutCurrent" => 238,
                "avgComparisonWithoutCurrent" => -118,
                "minWithoutCurrent" => 100,
                "maxWithoutCurrent" => 450,
            ],
            "budget" => [
                'current' => 60,
                "avgComparisonWithoutCurrent" => -164,
                "summaryWithoutCurrent" => 897,
                "avgWithoutCurrent" => 224,
                "minWithoutCurrent" => 76,
                "maxWithoutCurrent" => 361,
                "spentBudgetFromBeginningOfMonth" => 957,
                "budgetMonthly" => 9300,
                "percentSpentBudgetMonthlyCurrentDay" => 10,
            ],
            "dataByRangesWithoutCurrent" => [
                'current' => [
                    'click' => 120,
                    'spend' => 60,
                ],
                '2024-06-07_2024-06-09' => [
                    'click' => 204,
                    'spend' => 361,
                ],
                '2024-06-14_2024-06-16' => [
                    'click' => 450,
                    'spend' => 280,
                ],
                '2024-06-21_2024-06-23' => [
                    'click' => 200,
                    'spend' => 180,
                ],
                '2024-06-28_2024-06-30' => [
                    'click' => 100,
                    'spend' => 76,
                ]
            ]
        ];

        $rangesDate = [
            "start" => "2024-07-05",
            "end" => "2024-07-07",
        ];
        $rangesOtherDate = [
            [
                "start" => "2024-06-28",
                "end" => "2024-06-30",
            ],
            [
                "start" => "2024-06-21",
                "end" => "2024-06-23",
            ],
            [
                "start" => "2024-06-14",
                "end" => "2024-06-16",
            ],
            [
                "start" => "2024-06-07",
                "end" => "2024-06-09",
            ]
        ];

        $country = Country::find(1);
        expect($metaAds->getWithManyRangesDate($rangesDate, $rangesOtherDate, $country))
            ->toMatchArray($metaData);

    })->with('metaAdsTemplateDataForFourthDay', 'metaAdsTemplateDataForThirdDay', 'metaAdsTemplateDataForSecondDay', 'metaAdsTemplateDataForOneDay', 'metaAdsTemplateDataForCurrentDay', 'responseNbpApi', "metaAdsTemplateDataFor1_7_july_ResponseApi");


});
