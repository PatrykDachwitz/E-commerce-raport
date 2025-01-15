<?php
declare(strict_types=1);

use App\Models\HistoryReport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

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

       $expectedResponse = HistoryReport::limit(20)->get()->toArray();

       expect($response->json('data'))
           ->toHaveCount(20)
           ->toMatchArray($expectedResponse);
    });
    it('Test pagination 2 page expected success', function () {
       $response = actingAs(User::factory()->make())
       ->getJson(route('histories_report.index') . "?page=2");

       $expectedResponse = HistoryReport::offset(20)
           ->limit(20)
           ->get()
           ->toArray();

       expect($response->json('data'))
           ->toHaveCount(20)
           ->toMatchArray($expectedResponse);
    });
});
