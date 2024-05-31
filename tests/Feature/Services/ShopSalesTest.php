<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Connection\Shop;
use App\Services\ShopSales;
use Database\Seeders\CountriesWithDeactiveSeeder;
use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);
BeforeEach(function () {
    seed(CountrySeeder::class);
});

it('Verification of the correctness of the content processed by the API', function (string $shopResponse) {
    Http::fake([
        config('api.shop') => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $countries = Country::get();
    $resultsSalesShop = $shopSales->getSales();
    $shopFakeDate = json_decode($shopResponse, true);
    $countCountries = count($countries);

    expect($resultsSalesShop)
        ->toHaveCount($countCountries);

    foreach ($resultsSalesShop as $key => $resultSalesShop) {

        $selectCountry = $countries[intval($key) -1];
        if ($selectCountry->id !== $key) {
            $selectCountry = Country::find($key);
        }

        $currentValue = $shopFakeDate['confirmed'][$selectCountry->shop]['price_brutto'];
        $currentItems = $shopFakeDate['confirmed'][$selectCountry->shop]['items'];

        expect($resultSalesShop['value'])
            ->toBe($currentValue);
        expect($resultSalesShop['item'])
            ->toBe($currentItems);
    }

})->with('shopresponse');

it('Verification result for country when api no have this info', function (string $shopResponse) {
    Http::fake([
        config('api.shop') => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $country = Country::create([
        'name' => 'testCountry',
        'shop' => 199
    ]);

    $resultsSalesShop = $shopSales->getSales();

    $resultShopNewCountry = $resultsSalesShop[$country->id];

    expect($resultShopNewCountry['value'])
        ->toBe(0);
    expect($resultShopNewCountry['item'])
        ->toBe(0);



})->with('shopresponse');

it('Verification whether it downloads only active countries', function (string $shopResponse) {
    seed(CountriesWithDeactiveSeeder::class);
    Http::fake([
        config('api.shop') => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $activeCountry = Country::where('active', true)->get();
    $resultsSalesShop = $shopSales->getSales();
    $shopFakeDate = json_decode($shopResponse, true);
    $countCountries = count($activeCountry);

    expect($resultsSalesShop)
        ->toHaveCount($countCountries);

    foreach ($resultsSalesShop as $key => $resultSalesShop) {
        $selectCountry = Country::find($key);
        expect($selectCountry->active)
            ->toBeTrue();

        $currentValue = $shopFakeDate['confirmed'][$selectCountry->shop]['price_brutto'];
        $currentItems = $shopFakeDate['confirmed'][$selectCountry->shop]['items'];

        expect($resultSalesShop['value'])
            ->toBe($currentValue);
        expect($resultSalesShop['item'])
            ->toBe($currentItems);
    }

})->with('shopresponse');
