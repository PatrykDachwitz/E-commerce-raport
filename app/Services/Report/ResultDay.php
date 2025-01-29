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

class ResultDay
{

    const REPORT_NAME = 'result-day';
    private Country $country;
    private MetaAdsApi $metaAdsApi;
    private AdwordsResult $adwordsResult;
    private array $datesReport;
    private AnalyticsResult $analyticsResult;
    private ShopResult $shopResult;
    private GoogleAdwordsApi $googleAdwordsApi;

    private HistoryReportRepository $historyReportRepository;
    public function __construct(Country $country, AnalyticsResult $analyticsResult, MetaAdsApi $metaAdsApi, AdwordsResult $adwordsResult, ShopResult $shopResult, GoogleAdwordsApi $googleAdwordsApi, HistoryReportRepository $historyReportRepository)
    {
        $this->historyReportRepository = $historyReportRepository;
        $this->country = $country;
        $this->analyticsResult = $analyticsResult;
        $this->metaAdsApi = $metaAdsApi;
        $this->adwordsResult = $adwordsResult;
        $this->shopResult = $shopResult;
        $this->googleAdwordsApi = $googleAdwordsApi;
    }

    private function createDatesByCountPreviousDay(string $date, int $countPreviousDay = 30) : array {
        $this->datesReport = [
            'count' => $countPreviousDay,
            'current' => $date,
            'last' => "",
            'ranges' => [],
        ];
        $currentTime = strtotime($date);
        $this->datesReport['ranges'][] = $date;

        for ($i = 1; $i <= $countPreviousDay; $i++) {
            $daySubtraction = (24 * 60 * 60) * $i;

            $this->datesReport['ranges'][] = date("Y-m-d", ($currentTime - $daySubtraction));
            if ($i === $countPreviousDay) $this->datesReport['last'] = date("Y-m-d", ($currentTime - $daySubtraction));
        }

        return $this->datesReport;
    }

    public function get(string $date) : array {
        $this->createDatesByCountPreviousDay($date);

        $completeReport = [];



        $activesCountry = $this->country
            ->active()
            ->get();

        $analyticsResult = $this->analyticsResult->get($activesCountry, $this->datesReport);

        $facebookResults = $this->adwordsResult->getResult($activesCountry, $this->metaAdsApi, $this->datesReport['current'], $this->datesReport['last']);
        $googleResults = $this->adwordsResult->getResult($activesCountry, $this->googleAdwordsApi, $this->datesReport['current'], $this->datesReport['last']);

        $resultShopApi = $this->shopResult
            ->getResult($this->datesReport, $analyticsResult, $facebookResults, $googleResults, $activesCountry);

        foreach ($activesCountry as $country) {
            $completeReport[] = [
                'country' => $country->name,
                'shop' => $resultShopApi[$country->id],
                'global' => $analyticsResult[$country->id],
                'facebook' => $facebookResults[$country->id]['click'],
                'costFacebook' => $facebookResults[$country->id]['budget'],
                'google' => $googleResults[$country->id]['click'],
                'costGoogle' => $googleResults[$country->id]['budget'],
            ];
        }

        $completeReport[] = [
            'country' => "summary",
            'shop' => $resultShopApi["summary"],
            'global' => $analyticsResult["summary"],
            'facebook' => $facebookResults["summary"]['click'],
            'costFacebook' => $facebookResults["summary"]['budget'],
            'google' => $googleResults["summary"]['click'],
            'costGoogle' => $googleResults["summary"]['budget'],
        ];

        $this->historyReportRepository
            ->create([
                'date' => $date,
                'name' => $date,
                'type' => self::REPORT_NAME,
            ]);

        return $completeReport;
    }

}
