<?php
declare(strict_types=1);

use App\Facades\AnalyticsApiResponseFacade;
use App\Facades\GoogleAdsResponseFacade;
use App\Facades\MetaAdsResponseFacade;
use App\Facades\NbpApiResponseFacade;
use App\Facades\ReportDayResultFacade;
use App\Facades\ShopApiResponseFacade;
use Database\Seeders\DailyReport;
use Database\Seeders\ResultDayJuneCountry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\artisan;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(DailyReport::class);
    NbpApiResponseFacade::getResponse();
    DB::table('history_reports')->truncate();
});


it('Verification correct working command generation result day report with correct response api', function() {

    ShopApiResponseFacade::getSuccessDay();
    GoogleAdsResponseFacade::getSuccessDay();
    MetaAdsResponseFacade::getSuccessDay();
    AnalyticsApiResponseFacade::getSuccessDay();
    $date = "2024-06-20";

    artisan('report:result-day', [
        "date" => $date
    ])
        ->expectsOutput(__("command.saveFileSuccess"))
        ->assertOk();

    Storage::disk()
        ->assertExists(config('report.containerReportResultDay') . "{$date}.json");

    $valueSavedInFile = json_decode(Storage::disk()
        ->get(config('report.containerReportResultDay') . "{$date}.json"), true);


    expect($valueSavedInFile)
        ->toMatchArray(ReportDayResultFacade::getSuccess());

})->with('shopResponseForOneDay', 'shopResponseForSecondDay', 'shopResponseForThreeDay', "analyticsPolandReportDay", "analyticsEnglandReportDay", "metaAdsTemplateDataForCurrentDay", "metaAdsTemplateDataForOneDay", "metaAdsTemplateDataForSecondDay", "metaAdsTemplateDataForThirdDay", "metaAdsTemplateDataForFourthDay", "polandResponseApi", "germanyResponseApi", "metaResponsePolandResultDay", "metaResponseUKResultDay", 'responseNbpApi');

it('Verification correct valid date format', function () {
    Storage::fake();
    Http::fake([
        config('api.shop') . "?start=2024-06-01&end=2024-06-20" => Http::response(""),
        config('api.shop') . "?start=2023-06-01&end=2023-06-20" => Http::response(""),
        config('api.shop') . "?start=2023-06-01&end=2023-06-30" => Http::response(""),
        config('api.shop') . "?start=2024-05-01&end=2024-05-20" => Http::response(""),
    ]);

    $startDay = "202423";

    artisan('report:comparison-day', [
        "date" => $startDay
    ])
        ->expectsOutput(__("command.wrongFormatDate"))
        ->assertFailed();

    Storage::disk()
        ->assertMissing(config('report.containerReportComparisonDay') . "{$startDay}.json");
});
