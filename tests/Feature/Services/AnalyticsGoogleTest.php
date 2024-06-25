<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);



describe('Test services with query in 200 status', function () {

    it("Verification of correct segregation of the number of clicks for One Country", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->get('click', "2024-06-11", "2024-06-14");


        expect($responseData)
            ->toHaveKeys([
                'current',
                "min",
                "avg",
                "max",
                "summaryWithoutCurrent",
                "avgWithoutCurrent",
                "minWithoutCurrent",
                "maxWithoutCurrent",
            ]);

        expect($responseData['current'])
            ->toBe(2);
        expect($responseData['min'])
            ->toBe(2);
        expect($responseData['max'])
            ->toBe(1011);
        expect($responseData['avg'])
            ->toBe(281);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(1122);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(374);
        expect($responseData['minWithoutCurrent'])
            ->toBe(10);
        expect($responseData['maxWithoutCurrent'])
            ->toBe(1011);

    })->with('properties-account', 'analyticsResponse');

    it("Verification add id analytics based on Country Model", function (string $propertiesAccount) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        $analytics = new AnalyticsApi();

        expect($analytics
        ->setCountry($country))
            ->toBe($propertiesAccount);
    })->with('properties-account');

    it("Verification add date based on Country Model", function (string $propertiesAccount) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        $analytics = new AnalyticsApi();
        $dateTesting = date("YMD");

        expect($analytics
            ->setDateCurrent($dateTesting))
            ->toBe($dateTesting);

    })->with('properties-account');

    it("Verification of data collection for a non-existent date range", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->get('click', "2024-06-12", "2024-06-14");


        expect($responseData)
            ->toHaveKeys([
                'current',
                "min",
                "avg",
                "max",
                "summaryWithoutCurrent",
                "avgWithoutCurrent",
                "minWithoutCurrent",
                "maxWithoutCurrent",
            ]);

        expect($responseData['current'])
            ->toBe(0);
        expect($responseData['min'])
            ->toBe(0);
        expect($responseData['max'])
            ->toBe(0);
        expect($responseData['avg'])
            ->toBe(0);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(0);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(0);
        expect($responseData['minWithoutCurrent'])
            ->toBe(0);
        expect($responseData['maxWithoutCurrent'])
            ->toBe(0);

    })->with('properties-account', 'analyticsResponseWithoutRows');
});
