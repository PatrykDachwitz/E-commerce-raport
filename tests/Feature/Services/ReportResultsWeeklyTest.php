<?php

declare(strict_types=1);

use App\Facades\AnalyticsApiResponseFacade;
use App\Facades\GoogleAdsResponseFacade;
use App\Facades\MetaAdsResponseFacade;
use App\Facades\NbpApiResponseFacade;
use App\Facades\ReportWeeklyResultFacade;
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
use App\Services\Report\ResultWeekly;
use App\Services\ShopSales;
use Database\Seeders\WeeklyReport;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(WeeklyReport::class);
    NbpApiResponseFacade::getResponse();
});

it('Verification response Weekly report with current data', function() {
    ShopApiResponseFacade::getSuccessWeekly();
    GoogleAdsResponseFacade::getSuccessWeekly();
    MetaAdsResponseFacade::getSuccessWeekly();
    AnalyticsApiResponseFacade::getSuccessWeekly();

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

    $searchRow = [
        'date' => $rangesDate["end"],
        'type' => 'result-week'
    ];

    assertDatabaseMissing('history_reports', $searchRow);

    $reportWeekly = new ResultWeekly(
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
      $reportWeekly
        ->get($rangesDate, $rangesOtherDate)
    )
        ->toMatchArray(ReportWeeklyResultFacade::getSuccess());

    assertDatabaseHas('history_reports', $searchRow);
});
