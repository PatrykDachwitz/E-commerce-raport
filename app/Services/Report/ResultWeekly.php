<?php
declare(strict_types=1);
namespace App\Services\Report;

use App\Models\Country;
use App\Repository\HistoryReportRepository;
use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use App\Services\Adwords\MetaAdsApi;
use App\Services\Report\Support\AdwordsResult;
use App\Services\Report\Support\AnalyticsResult;
use App\Services\Report\Support\ShopResult;
use App\Services\ShopSales;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use function Laravel\Prompts\select;

class ResultWeekly
{

    private HistoryReportRepository $historyReportRepository;
    private Country $country;
    private MetaAdsApi $metaAdsApi;
    private AdwordsResult $adwordsResult;
    private array $datesReport;
    private AnalyticsResult $analyticsResult;
    private ShopResult $shopResult;
    private GoogleAdwordsApi $googleAdwordsApi;

    const REPORT_NAME = 'result-week';

    public function __construct(Country $country, AnalyticsResult $analyticsResult, MetaAdsApi $metaAdsApi, AdwordsResult $adwordsResult, ShopResult $shopResult, GoogleAdwordsApi $googleAdwordsApi, HistoryReportRepository $historyReportRepository)
    {
        $this->country = $country;
        $this->analyticsResult = $analyticsResult;
        $this->metaAdsApi = $metaAdsApi;
        $this->adwordsResult = $adwordsResult;
        $this->shopResult = $shopResult;
        $this->googleAdwordsApi = $googleAdwordsApi;
        $this->historyReportRepository = $historyReportRepository;
    }

    private function searchOldestDate(string $date, string $comparisonDate) : string {
        $comparisonTime = strtotime($comparisonDate);
        $currentTime = strtotime($date);

        if ($currentTime > $comparisonTime) {
            return $comparisonDate;
        } else {
            return $date;
        }
    }
    private function createRangesDate(array $currentDate, array $otherDate) : array {

        $this->datesReport = [
            'count' => count($otherDate),
            'current' => $currentDate,
            'last' => $currentDate['start'],
            'newest' => $currentDate['end'],
            'rangesWithoutCurrent' => [],
            'ranges' => [
                'current' => $currentDate
            ],
        ];

        foreach ($otherDate as $key => $date) {
            $this->datesReport['rangesWithoutCurrent'][$key] = $date;
            $this->datesReport['ranges'][$key] = $date;
            $this->datesReport['last'] = $this->searchOldestDate($date['start'], $this->datesReport['last']);
        }

        return $this->datesReport;
    }

    private function removeSummaryWithoutCurrent(array $data) : array {
        if (isset($data['summaryWithoutCurrent'])) unset($data['summaryWithoutCurrent']);

        return $data;
    }
    public function get(array $currentDate, array $otherDate) : array {
        $this->createRangesDate($currentDate, $otherDate);

       // dd($this->datesReport);
        $completeReport = [];



        $activesCountry = $this->country
            ->active()
            ->get();



        $analyticsResult = $this->analyticsResult->getWithManyRangesDate($activesCountry, $this->datesReport);

        $facebookResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->metaAdsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);
        $googleResults = $this->adwordsResult->getWithManyRangesDate($activesCountry, $this->googleAdwordsApi, $this->datesReport['current'], $this->datesReport['rangesWithoutCurrent']);

        $resultShopApi = $this->shopResult
            ->getResultNewset($this->datesReport, $analyticsResult, $facebookResults, $googleResults, $activesCountry);

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $this->removeSummaryWithoutCurrent($resultShopApi[$country->id]),
                'global' => $this->removeSummaryWithoutCurrent($analyticsResult[$country->id]),
                'facebook' => $this->removeSummaryWithoutCurrent($facebookResults[$country->id]['click']),
                'costFacebook' => $this->removeSummaryWithoutCurrent($facebookResults[$country->id]['budget']),
                'google' => $this->removeSummaryWithoutCurrent($googleResults[$country->id]['click']),
                'costGoogle' => $this->removeSummaryWithoutCurrent($googleResults[$country->id]['budget']),
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $this->removeSummaryWithoutCurrent($resultShopApi["summary"]),
            'global' => $this->removeSummaryWithoutCurrent($analyticsResult["summary"]),
            'facebook' => $this->removeSummaryWithoutCurrent($facebookResults["summary"]['click']),
            'costFacebook' => $this->removeSummaryWithoutCurrent($facebookResults["summary"]['budget']),
            'google' => $this->removeSummaryWithoutCurrent($googleResults["summary"]['click']),
            'costGoogle' => $this->removeSummaryWithoutCurrent($googleResults["summary"]['budget']),
        ];

        $this->historyReportRepository
            ->create([
               'type' => self::REPORT_NAME,
               'date' => $currentDate['end'],
               'name' => $currentDate['end']
            ]);

        return $completeReport;
    }

}
