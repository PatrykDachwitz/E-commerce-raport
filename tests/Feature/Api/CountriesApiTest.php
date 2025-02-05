<?php
declare(strict_types=1);

use App\Facades\Pest\CountriesFacade;
use App\Models\User;
use Database\Seeders\Pest\CountriesSeed;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(CountriesSeed::class);
});

describe('Verification status code http for not auth users expected 401 status http', function () {
    it('Verification index route', function () {
        getJson(route('countries.index'))
            ->assertStatus(401);
    });
    it('Verification show route', function () {
        getJson(route('countries.show', [
            'country' => 1
        ]))
            ->assertStatus(401);
    });
    it('Verification delete route', function () {
        deleteJson(route('countries.destroy',[
            'country' => 1
        ]))
            ->assertStatus(401);
    });
    it('Verification put route', function () {
        putJson(route('countries.update', [
            'country' => 1
        ]))
            ->assertStatus(401);
    });
    it('Verification post route', function () {
        postJson(route('countries.store'))
            ->assertStatus(401);
    });
});

describe('Testing index Route', function () {

    it('Testing different permission user expected success', function (string $superAdminPermission) {

        $response = actingAs(User::factory()->make([
            'super_admin' => $superAdminPermission
        ]))
            ->getJson(route('countries.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => CountriesFacade::getExpectedStructureCountry()
                ]
            ])
            ->assertJsonCount(20, 'data')
            ->json('data');

        $expectedResponse = CountriesFacade::getExpectedCountriesByPage(0);

        expect($response)
            ->each(function ($item, $key) use ($expectedResponse)  {
                expect($item->value)
                    ->toMatchArray($expectedResponse[$key]);
            });

    })->with('permissionsuperadmin');

    it('Testing correct response for 2 page and different permission user expected success', function (string $superAdminPermission) {

        $response = actingAs(User::factory()->make([
            'super_admin' => $superAdminPermission
        ]))
            ->getJson(route('countries.index') . "?page=2")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => CountriesFacade::getExpectedStructureCountry()
                ]
            ])
            ->assertJsonCount(20, 'data')
            ->json('data');

        $expectedResponse = CountriesFacade::getExpectedCountriesByPage(2);

        expect($response)
            ->each(function ($item, $key) use ($expectedResponse)  {
                expect($item->value)
                    ->toMatchArray($expectedResponse[$key]);
            });

    })->with('permissionsuperadmin');

});
