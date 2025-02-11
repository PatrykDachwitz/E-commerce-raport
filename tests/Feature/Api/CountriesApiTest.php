<?php
declare(strict_types=1);

use App\Facades\Pest\CountriesFacade;
use App\Models\User;
use Database\Seeders\Pest\CountriesSeed;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
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

describe('Verification correct access to show route countries api', function () {
    it('Verification access with different super admin permission', function (string $superAdmin) {

        $response = actingAs(User::factory()->make([
            'super_admin' => $superAdmin
        ]))
            ->getJson(route('countries.show', [
                'country' => 1
            ]))
            ->assertOk()
            ->assertJsonStructure([
                'data' => CountriesFacade::getExpectedStructureCountry()
            ])
            ->json('data');

        expect($response)
            ->toMatchArray(CountriesFacade::getCountry(1));

    })->with('permissionsuperadmin');

    it('Verification response for not isset row expected 404 status code', function (string $superAdmin) {

        actingAs(User::factory()->make([
            'super_admin' => $superAdmin
        ]))
            ->getJson(route('countries.show', [
                'country' => 10000009
            ]))
            ->assertStatus(404);

    })->with('permissionsuperadmin');
});

describe('Verification remove country route', function () {

   it('Verification remove isset row, user without super admin permission expected 403 status code and no remove search country', function () {
        $countrySearch = CountriesFacade::getCountry(1);

        assertDatabaseHas('countries', $countrySearch);

        actingAs(User::factory()->make([
            'super_admin' => false
        ]))
            ->deleteJson(route('countries.destroy', [
                'country' => $countrySearch['id']
            ]))
            ->assertStatus(403);

        assertDatabaseHas('countries', $countrySearch);
    });

   it('Verification remove not isset, row user without super admin permission expected 403 status code and no remove search country', function () {

       $id = 9993299;

        assertDatabaseMissing('countries', [
            'id' => $id
        ]);

        actingAs(User::factory()->make([
            'super_admin' => false
        ]))
            ->deleteJson(route('countries.destroy', [
                'country' => $id
            ]))
            ->assertStatus(403);

       assertDatabaseMissing('countries', [
           'id' => $id
       ]);
    });

   it('Verification remove isset row, user with super admin permission expected 200 status code and remove search country', function () {
        $countrySearch = CountriesFacade::getCountry(1);

        assertDatabaseHas('countries', $countrySearch);

        actingAs(User::factory()->create([
            'super_admin' => true
        ]))
            ->deleteJson(route('countries.destroy', [
                'country' => $countrySearch['id']
            ]))
            ->assertStatus(200);

        assertDatabaseMissing('countries', $countrySearch);
   });

   it('Verification remove not isset row, user with super admin permission expected 200 status code and remove search country', function () {
        $id = 993299392;

        assertDatabaseMissing('countries', [
            'id' => $id
        ]);

        actingAs(User::factory()->create([
            'super_admin' => true
        ]))
            ->deleteJson(route('countries.destroy', [
                'country' => $id
            ]))
            ->assertStatus(200);

        assertDatabaseMissing('countries', [
            'id' => $id
        ]);
   });

});

describe('Verification create country route', function () {
    it('User without super admin permission expected 403 status http and no create row', function () {
        $country = CountriesFacade::getNotIssetCountry();
        assertDatabaseMissing('countries', $country);

        actingAs(User::factory()->create([
            'super_admin' => false
        ]))
            ->postJson(route('countries.store'), $country)
            ->assertStatus(403);

        assertDatabaseMissing('countries', $country);
    });

    it('User with super admin permission expected 200 status http and create row', function () {
        $country = CountriesFacade::getNotIssetCountry();
        assertDatabaseMissing('countries', $country);

        $response = actingAs(User::factory()->create([
            'super_admin' => true
        ]))
            ->postJson(route('countries.store'), $country)
            ->assertStatus(200)
            ->json('data');

        expect($response)
            ->toMatchArray($country);

        assertDatabaseHas('countries', $country);
    });
    it('Testing create country with only required inputs, user with super admin permission expected 200 status http and create row', function () {
        $country['name'] = CountriesFacade::getNotIssetCountry()['name'];

        $response = actingAs(User::factory()->create([
            'super_admin' => true
        ]))
            ->postJson(route('countries.store'), $country)
            ->assertStatus(200)
            ->json('data');

        expect($response)
            ->toMatchArray($country);

        assertDatabaseHas('countries', $country);
    });

    it('Testing correct work valid inputs expected error status code 422', function ($nameInput) {
        $invalidValues = CountriesFacade::getInvalidValueInput($nameInput);
        $country = CountriesFacade::getNotIssetCountry();

        foreach ($invalidValues as $invalidValue) {
            $country[$nameInput] = $invalidValue;

            $response = actingAs(User::factory()->create([
                'super_admin' => true
            ]))
                ->postJson(route('countries.store'), $country)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        $nameInput
                    ]
                ]);

            assertDatabaseMissing('countries', $country);
        }

    })->with('inputcountrymodel');
});
