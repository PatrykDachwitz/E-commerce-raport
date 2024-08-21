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

        $responseData = $analytics->get("2024-06-11", "2024-06-14");


        $dataByRanges = [
            '2024-06-11_2024-06-11' => [
                'click' => 10,
            ],
            '2024-06-12_2024-06-12' => [
                'click' => 1011,
            ],
            '2024-06-13_2024-06-13' => [
                'click' => 101,
            ],
            'current' => [
                'click' => 2,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);
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

    it("Verification of correct segregation of the number of clicks for One Country with deficited data", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->get("2024-06-10", "2024-06-14");


        $dataByRanges = [
            '2024-06-10_2024-06-10' => [
                'click' => 0,
            ],
            '2024-06-11_2024-06-11' => [
                'click' => 10,
            ],
            '2024-06-12_2024-06-12' => [
                'click' => 1011,
            ],
            '2024-06-13_2024-06-13' => [
                'click' => 101,
            ],
            'current' => [
                'click' => 2,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);
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
            ->toBe(0);
        expect($responseData['max'])
            ->toBe(1011);
        expect($responseData['avg'])
            ->toBe(224);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(1122);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(280);
        expect($responseData['minWithoutCurrent'])
            ->toBe(0);
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

        $responseData = $analytics->get("2024-06-12", "2024-06-14");


        $dataByRanges = [
            '2024-06-12_2024-06-12' => [
                'click' => 0,
            ],
            '2024-06-13_2024-06-13' => [
                'click' => 0,
            ],
            'current' => [
                'click' => 0,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);
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

describe('Testng version for several between ranges date', function () {

    it("Verification result for correct data", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);


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
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->getWithManyRangesDate($rangesDate, $rangesOtherDate);

        $dataByRanges = [
            '2024-06-07_2024-06-09' => [
                'click' => 1265,
            ],
            '2024-06-14_2024-06-16' => [
                'click' => 3697,
            ],
            '2024-06-21_2024-06-23' => [
                'click' => 10926,
            ],
            '2024-06-28_2024-06-30' => [
                'click' => 71151,
            ],
            'current' => [
                'click' => 790,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);
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
            ->toBe(790);
        expect($responseData['min'])
            ->toBe(790);
        expect($responseData['max'])
            ->toBe(71151);
        expect($responseData['avg'])
            ->toBe(17565);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(21759);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(87039);
        expect($responseData['minWithoutCurrent'])
            ->toBe(1265);
        expect($responseData['maxWithoutCurrent'])
            ->toBe(71151);

    })->with('properties-account', 'analyticsResponseForWeek');

    it("Verification result for deficit data", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);


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
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->getWithManyRangesDate($rangesDate, $rangesOtherDate);

        $dataByRanges = [
            '2024-06-07_2024-06-09' => [
                'click' => 0,
            ],
            '2024-06-14_2024-06-16' => [
                'click' => 3697,
            ],
            '2024-06-21_2024-06-23' => [
                'click' => 4692,
            ],
            '2024-06-28_2024-06-30' => [
                'click' => 71151,
            ],
            'current' => [
                'click' => 790,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);

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
            ->toBe(790);
        expect($responseData['min'])
            ->toBe(0);
        expect($responseData['max'])
            ->toBe(71151);
        expect($responseData['avg'])
            ->toBe(16066);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(19885);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(79540);
        expect($responseData['minWithoutCurrent'])
            ->toBe(0);
        expect($responseData['maxWithoutCurrent'])
            ->toBe(71151);

    })->with('properties-account', 'analyticsResponseForWeekWithDeficitData');

    it("Verification result for deficit current ranges date", function (string $propertiesAccount, string $responseApi) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response($responseApi)
        ]);


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
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->getWithManyRangesDate($rangesDate, $rangesOtherDate);
        $dataByRanges = [
            '2024-06-07_2024-06-09' => [
                'click' => 1265,
            ],
            '2024-06-14_2024-06-16' => [
                'click' => 3697,
            ],
            '2024-06-21_2024-06-23' => [
                'click' => 10926,
            ],
            '2024-06-28_2024-06-30' => [
                'click' => 71151,
            ],
            'current' => [
                'click' => 0,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);

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
            ->toBe(71151);
        expect($responseData['avg'])
            ->toBe(17407);
        expect($responseData['avgWithoutCurrent'])
            ->toBe(21759);
        expect($responseData['summaryWithoutCurrent'])
            ->toBe(87039);
        expect($responseData['minWithoutCurrent'])
            ->toBe(1265);
        expect($responseData['maxWithoutCurrent'])
            ->toBe(71151);

    })->with('properties-account', 'analyticsResponseForWeekWithDeficitDataCurrentRange');

    it("Verification result for empty response api", function (string $propertiesAccount) {
        $country = Country::factory()->create([
            'analytics' => $propertiesAccount
        ]);

        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/{$propertiesAccount}:runReport" => Http::response(null, 404)
        ]);


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
        $analytics = new AnalyticsApi();
        $analytics->setCountry($country);
        $analytics->setDateCurrent("20240614");

        $responseData = $analytics->getWithManyRangesDate($rangesDate, $rangesOtherDate);


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

        $dataByRanges = [
            '2024-06-07_2024-06-09' => [
                'click' => 0,
            ],
            '2024-06-14_2024-06-16' => [
                'click' => 0,
            ],
            '2024-06-21_2024-06-23' => [
                'click' => 0,
            ],
            '2024-06-28_2024-06-30' => [
                'click' => 0,
            ],
            'current' => [
                'click' => 0,
            ]
        ];

        expect($responseData['dataByRangesWithoutCurrent'])
            ->toMatchArray($dataByRanges);
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

    })->with('properties-account');


});
