<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Connection\Shop;
use App\Services\Currency\CoursePLN;
use App\Services\Report\ReportDaily\AdwordsResult;
use App\Services\Report\ReportDaily\ShopResult;
use App\Services\Report\ResultDay;
use App\Services\ShopSales;
use Database\Seeders\ComparisonDayJuneCountry;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(ComparisonDayJuneCountry::class);
});
// Do ogarniećia jest średnai i mozłiwośc dodanie google i fb PRzetestować co sięstanie jeśl iejst kraj za durzo do któego nei ma api co jeśłi nei ma wartosći shop api w db
// tu nie ma podsuomwnia w analytcs i sprawdzić czy srednai jest z ostatnich 30 dni
test('Verification work services Report result Day with good response api', function (
    string $shopResponseOneVariant,
    string $shopResponseSecondVariant,
    string $shopResponseThreeVariant,
    string $analyticsPolandReportDay,
    string $analyticsEnglandReportDay,
    string $metaCurrentDateResponseApi,
    string $metaOneDayResponseApi,
    string $metaSecondDayResponseApi,
    string $metaAdsTemplateDataForThirdDay,
    string $metaFourthDayResponseApi,
    string $polandResponseApi,
    string $germanyResponseApi,
    string $metaResponsePolandResultDay,
    string $metaResponseUKResultDay,
) {
    $date = "2024-06-20";
    Http::fake([
        "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($polandResponseApi),
        "https://googleads.googleapis.com/v17/customers/52432432/googleAds:searchStream" => Http::response($germanyResponseApi),
        config('api.shop') . "?start=2024-06-20&end=2024-06-20" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-19&end=2024-06-19" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-18&end=2024-06-18" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-17&end=2024-06-17" => Http::response($shopResponseOneVariant),
        config('api.shop') . "?start=2024-06-16&end=2024-06-16" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-15&end=2024-06-15" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-14&end=2024-06-14" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-13&end=2024-06-13" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-12&end=2024-06-12" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-11&end=2024-06-11" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-10&end=2024-06-10" => Http::response($shopResponseSecondVariant),
        config('api.shop') . "?start=2024-06-09&end=2024-06-09" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-08&end=2024-06-08" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-07&end=2024-06-07" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-06&end=2024-06-06" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-05&end=2024-06-05" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-04&end=2024-06-04" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-03&end=2024-06-03" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-02&end=2024-06-02" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-06-01&end=2024-06-01" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-31&end=2024-05-31" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-30&end=2024-05-30" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-29&end=2024-05-29" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-28&end=2024-05-28" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-27&end=2024-05-27" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-26&end=2024-05-26" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-25&end=2024-05-25" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-24&end=2024-05-24" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-23&end=2024-05-23" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-22&end=2024-05-22" => Http::response($shopResponseThreeVariant),
        config('api.shop') . "?start=2024-05-21&end=2024-05-21" => Http::response($shopResponseThreeVariant),
        "https://analyticsdata.googleapis.com/v1beta/properties/123123123123:runReport" => Http::response($analyticsPolandReportDay),
        "https://analyticsdata.googleapis.com/v1beta/properties/987987987987:runReport" => Http::response($analyticsEnglandReportDay),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-21&time_range%5Buntil%5D=2024-05-21" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($metaFourthDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($metaAdsTemplateDataForThirdDay),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-21&time_range%5Buntil%5D=2024-05-21" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($metaSecondDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($metaOneDayResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($metaCurrentDateResponseApi),
        "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-20" => Http::response($metaResponsePolandResultDay),
        "https://graph.facebook.com/v20.0/act_123123145/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-20" => Http::response($metaResponseUKResultDay),
        ]);

    $reportDay = new ResultDay(
        new Country(),
        new AnalyticsApi(),
        new MetaAdsApi(new CoursePLN()),
        new AdwordsResult(),
        new ShopResult(
            new ShopSales(
                new Shop(),
                new Country()
            ),
            new CoursePLN()
        ),
        new GoogleAdwordsApi()
    );

    $expectResult = [
        [
            "country" => "Polska",
            "shop" => [
                "shopSales" => [
                    "value" => 77076,
                    "art" => 242
                ],
                "avgComparison" => [
                    "value" => -19800,
                    "art" => 184
                ],
                "avgLast30Day" => [
                    "value" => 96876,
                    "art" => 58
                ],
                "minValueLast30Day" => [
                    "value" => 77076,
                    "art" => 10
                ],
                "maxValueLast30Day" => [
                    "value" => 99076,
                    "art" => 242
                ],
                "costShare" => [
                    "value" => 0.29
                ],
                "comparisonClickToCost" => [
                    "value" => 2.42
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 100
                ],
                'avgComparison' => [
                    'value' => -3604
                ],
                'avgLast30Day' => [
                    'value' => 3704
                ],
                'minValueLast30Day' => [
                    'value' => 9
                ],
                'maxValueLast30Day' => [
                    'value' => 100000
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 361
                ],
                'avgComparison' => [
                    'value' => 131
                ],
                'avgLast30Day' => [
                    'value' => 230
                ],
                'minValueLast30Day' => [
                    'value' => 180
                ],
                'maxValueLast30Day' => [
                    'value' => 280
                ],
                'costFromBeginningMonth' => [
                    'value' => 4781
                ],
                'budgetMonth' => [
                    'value' => 9000
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 53
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 204
                ],
                'avgComparison' => [
                    'value' => -121
                ],
                'avgLast30Day' => [
                    'value' => 325
                ],
                'minValueLast30Day' => [
                    'value' => 200
                ],
                'maxValueLast30Day' => [
                    'value' => 450
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 586
                ],
                'avgComparison' => [
                    'value' => 250
                ],
                'avgLast30Day' => [
                    'value' => 336
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 1061
                ],
                'costFromBeginningMonth' => [
                    'value' => 10671
                ],
                'budgetMonth' => [
                    'value' => 9000
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 118
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 259
                ],
                'avgComparison' => [
                    'value' => 176
                ],
                'avgLast30Day' => [
                    'value' => 83
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 345
                ]
            ]
        ],
        [
            "country" => "Anglia",
            "shop" => [
                "shopSales" => [
                    "value" => 1535,
                    "art" => 147
                ],
                "avgComparison" => [
                    "value" => -7666655866,
                    "art" => -635
                ],
                "avgLast30Day" => [
                    "value" => 7666657401,
                    "art" => 782
                ],
                "minValueLast30Day" => [
                    "value" => 1535,
                    "art" => 69
                ],
                "maxValueLast30Day" => [
                    "value" => 9999987446,
                    "art" => 990
                ],
                "costShare" => [
                    "value" => 1.11
                ],
                "comparisonClickToCost" => [
                    "value" => 1.2
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 123
                ],
                'avgComparison' => [
                    'value' => 59
                ],
                'avgLast30Day' => [
                    'value' => 64
                ],
                'minValueLast30Day' => [
                    'value' => 12
                ],
                'maxValueLast30Day' => [
                    'value' => 1900
                ]
            ],

            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 76
                ],
                'avgComparison' => [
                    'value' => -144
                ],
                'avgLast30Day' => [
                    'value' => 220
                ],
                'minValueLast30Day' => [
                    'value' => 60
                ],
                'maxValueLast30Day' => [
                    'value' => 361
                ],
                'costFromBeginningMonth' => [
                    'value' => 4421
                ],
                'budgetMonth' => [
                    'value' => 18000
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 24
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 100
                ],
                'avgComparison' => [
                    'value' => -148
                ],
                'avgLast30Day' => [
                    'value' => 248
                ],
                'minValueLast30Day' => [
                    'value' => 120
                ],
                'maxValueLast30Day' => [
                    'value' => 450
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
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
            "google" => [
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
                ]
            ]
        ],
        [
            "country" => "Niemcy",
            "shop" => [
                "shopSales" => [
                    "value" => 2224,
                    "art" => 5
                ],
                "avgComparison" => [
                    "value" => -182918,
                    "art" => -179
                ],
                "avgLast30Day" => [
                    "value" => 185142,
                    "art" => 184
                ],
                "minValueLast30Day" => [
                    "value" => 980,
                    "art" => 5
                ],
                "maxValueLast30Day" => [
                    "value" => 1381262,
                    "art" => 290
                ],
                "costShare" => [
                    "value" => 0
                ],
                "comparisonClickToCost" => [
                    "value" => 5
                ]
            ],
            "global" => [
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
                ]
            ],
            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
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
            "facebook" => [
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
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 0
                ],
                'avgComparison' => [
                    'value' => -1130
                ],
                'avgLast30Day' => [
                    'value' => 1130
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 10610
                ],
                'costFromBeginningMonth' => [
                    'value' => 10085
                ],
                'budgetMonth' => [
                    'value' => 23250
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 43
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 954
                ],
                'avgComparison' => [
                    'value' => 126
                ],
                'avgLast30Day' => [
                    'value' => 828
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 20432
                ]
            ]
        ],
        [
            "country" => "summary",
            "shop" => [
                "shopSales" => [
                    "value" => 80836,
                    "art" => 394
                ],
                "avgComparison" => [
                    "value" => -7666858583,
                    "art" => -632
                ],
                "avgLast30Day" => [
                    "value" => 7666939419,
                    "art" => 1026
                ],
                "minValueLast30Day" => [
                    "value" => 80836,
                    "art" => 394
                ],
                "maxValueLast30Day" => [
                    "value" => 10000087503,
                    "art" => 1190
                ],
                "costShare" => [
                    "value" => 0.29
                ],
                "comparisonClickToCost" => [
                    "value" => 1.77
                ]
            ],
            "global" => [
                'countClick' => [
                    'value' => 223
                ],
                'avgComparison' => [
                    'value' => -3545
                ],
                'avgLast30Day' => [
                    'value' => 3768
                ],
                'minValueLast30Day' => [
                    'value' => 21
                ],
                'maxValueLast30Day' => [
                    'value' => 101900
                ]
            ],

            "costFacebook" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 437
                ],
                'avgComparison' => [
                    'value' => -13
                ],
                'avgLast30Day' => [
                    'value' => 450
                ],
                'minValueLast30Day' => [
                    'value' => 240
                ],
                'maxValueLast30Day' => [
                    'value' => 641
                ],
                'costFromBeginningMonth' => [
                    'value' => 9202
                ],
                'budgetMonth' => [
                    'value' => 27000
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 34
                ],
            ],
            "facebook" => [
                'countClick' => [
                    'value' => 304
                ],
                'avgComparison' => [
                    'value' => -269
                ],
                'avgLast30Day' => [
                    'value' => 573
                ],
                'minValueLast30Day' => [
                    'value' => 320
                ],
                'maxValueLast30Day' => [
                    'value' => 900
                ]
            ],
            "costGoogle" => [
                "percentDaysPassedInCurrentMonth" => [
                    'value' => 66.67
                ],
                'cost' => [
                    'value' => 586
                ],
                'avgComparison' => [
                    'value' => -880
                ],
                'avgLast30Day' => [
                    'value' => 1466
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 11671
                ],
                'costFromBeginningMonth' => [
                    'value' => 20756
                ],
                'budgetMonth' => [
                    'value' => 32250
                ],
                'percentCostFromBeginningMonth' => [
                    'value' => 64
                ],
            ],
            "google" => [
                'countClick' => [
                    'value' => 1213
                ],
                'avgComparison' => [
                    'value' => 301
                ],
                'avgLast30Day' => [
                    'value' => 912
                ],
                'minValueLast30Day' => [
                    'value' => 0
                ],
                'maxValueLast30Day' => [
                    'value' => 20777
                ]
            ]
        ]
    ];


    expect(
        $reportDay
            ->get($date)
    )
        ->toMatchArray($expectResult);

})->with('shopResponseForOneDay', 'shopResponseForSecondDay', 'shopResponseForThreeDay', "analyticsPolandReportDay", "analyticsEnglandReportDay", "metaAdsTemplateDataForCurrentDay", "metaAdsTemplateDataForOneDay", "metaAdsTemplateDataForSecondDay", "metaAdsTemplateDataForThirdDay", "metaAdsTemplateDataForFourthDay", "polandResponseApi", "germanyResponseApi", "metaResponsePolandResultDay", "metaResponseUKResultDay");
