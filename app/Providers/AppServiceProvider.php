<?php
declare(strict_types=1);
namespace App\Providers;

use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepository as UserRepositoryInterface;
use App\Repository\Eloquent\HistoryReportRepository;
use App\Repository\HistoryReportRepository as HistoryReportInterface;

use App\Services\Report\Fake\AnalyticsApiResponse;
use App\Services\Report\Fake\GoogleAdsResponse;
use App\Services\Report\Fake\HistoryReport;
use App\Services\Report\Fake\MetaAdsResponse;
use App\Services\Report\Fake\NbpApiResponse;
use App\Services\Report\Fake\ReportDayResult;
use App\Services\Report\Fake\ReportWeeklyResult;
use App\Services\Report\Fake\ShopApiResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AnalyticsApiResponse::class, function ($app) {
            return new AnalyticsApiResponse();
        });
        $this->app->singleton(GoogleAdsResponse::class, function ($app) {
            return new GoogleAdsResponse();
        });
        $this->app->singleton(MetaAdsResponse::class, function ($app) {
            return new MetaAdsResponse();
        });
        $this->app->singleton(NbpApiResponse::class, function ($app) {
            return new NbpApiResponse();
        });
        $this->app->singleton(ReportWeeklyResult::class, function ($app) {
            return new ReportWeeklyResult();
        });

        $this->app->singleton(ShopApiResponse::class, function ($app) {
            return new ShopApiResponse();
        });
        $this->app->singleton(ReportDayResult::class, function ($app) {
            return new ReportDayResult();
        });
        $this->app->singleton(HistoryReport::class, function ($app) {
            return new HistoryReport();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
        $this->app->singleton(
            HistoryReportInterface::class,
            HistoryReportRepository::class,
        );


    }
}
