<?php
declare(strict_types=1);

use App\Facades\HistoryReportFacades;
use App\Models\HistoryReport;
use App\Models\User;
use Database\Seeders\HistoryReportTestingSeed;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

beforeEach(function () {

    DB::table('history_reports')->truncate();

    HistoryReport::factory()
        ->count(40)
        ->create();
});

describe('Test for index url', function () {
    it('Url not available for non auth user', function () {
        getJson(
            route('histories_report.index')
        )->assertStatus(401);

    });


    it('Test response expected success', function () {
       $response = actingAs(User::factory()->make())
       ->getJson(route('histories_report.index'));

       $expectedResponse = HistoryReport::limit(20)
           ->orderBy('date', 'asc')
           ->get()
           ->toArray();

       expect($response->json('data'))
           ->toHaveCount(20)
           ->toMatchArray($expectedResponse);
    });
    it('Test pagination 2 page expected success', function () {
       $response = actingAs(User::factory()->make())
       ->getJson(route('histories_report.index') . "?page=2");

       $expectedResponse = HistoryReport::offset(20)
           ->limit(20)
           ->orderBy('date', 'asc')
           ->get()
           ->toArray();

       expect($response->json('data'))
           ->toHaveCount(20)
           ->toMatchArray($expectedResponse);
    });
});


describe('Testing function search correct typ and order for index api url', function () {

    it('Test correct response for first page with type result-day, order desc', function (string $typeReport) {
        seed(HistoryReportTestingSeed::class);

        $params = [
            'order' => 'desc',
            'type' => $typeReport,
        ];

        $response = actingAs(User::factory()->make())
            ->getJson(route('histories_report.index') . "?" . http_build_query($params))
            ->assertOk()
            ->json('data');

        $expectedResult = HistoryReportFacades::getExpectedResponse($typeReport);

        expect($response)
            ->each(function ($item, $key) use ($expectedResult) {
                expect($item->value)
                    ->toMatchArray($expectedResult[$key]);
            });

    })->with('typesreporthistory');
});
