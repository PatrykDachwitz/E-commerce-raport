<?php
declare(strict_types=1);

use App\Facades\AnalyticsApiResponseFacade;
use App\Facades\GoogleAdsResponseFacade;
use App\Facades\MetaAdsResponseFacade;
use App\Facades\NbpApiResponseFacade;
use App\Facades\ReportDayResultFacade;
use App\Facades\ShopApiResponseFacade;
use App\Models\Country;
use App\Models\HistoryReport;
use App\Repository\Eloquent\HistoryReportRepository;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Connection\Shop;
use App\Services\Currency\CoursePLN;
use App\Services\Report\Support\AdwordsResult;
use App\Services\Report\Support\AnalyticsResult;
use App\Services\Report\Support\ShopResult;
use App\Services\Report\ResultDay;
use App\Services\ShopSales;
use Database\Seeders\DailyReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(DailyReport::class);
    NbpApiResponseFacade::getResponse();
    DB::table('history_reports')->truncate();
});
test('Verification work services Report result Day with good response api', function () {
    $date = "2024-06-20";
    $searchRow = [
        'type' => 'result-day',
        'date' => $date
    ];

    assertDatabaseMissing('history_reports', $searchRow);
    ShopApiResponseFacade::getSuccessDay();
    GoogleAdsResponseFacade::getSuccessDay();
    MetaAdsResponseFacade::getSuccessDay();
    AnalyticsApiResponseFacade::getSuccessDay();

    $reportDay = new ResultDay(
        new Country(),
        new AnalyticsResult(new AnalyticsApi()),
        new MetaAdsApi(new CoursePLN()),
        new AdwordsResult(),
        new ShopResult(
            new ShopSales(
                new Shop(),
                new Country()
            ),
            new CoursePLN()
        ),
        new GoogleAdwordsApi(),
        new HistoryReportRepository(
            new HistoryReport()
        )
    );


    expect(
        $reportDay
            ->get($date)
    )
        ->toMatchArray(ReportDayResultFacade::getSuccess());

    assertDatabaseHas('history_reports', $searchRow);
});
