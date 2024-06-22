<?php
declare(strict_types=1);

use App\Models\Country;
use App\Services\Connection\Shop;
use App\Services\ShopSales;
use Database\Seeders\ComparisonDayJuneCountry;
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

    $date = "2024-01-01";
    Http::fake([
        config('api.shop') . "?start={$date}&end={$date}" => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $countries = Country::get();
    $resultsSalesShop = $shopSales->getSales($date, $date);
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

})->with('shopTemplateResponse');

it('Verification result for country when api no have this info', function (string $shopResponse) {
    $date = "2024-01-01";

    Http::fake([
        config('api.shop') . "?start={$date}&end={$date}" => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $country = Country::create([
        'name' => 'testCountry',
        'shop' => 199
    ]);

    $resultsSalesShop = $shopSales->getSales($date, $date);

    $resultShopNewCountry = $resultsSalesShop[$country->id];

    expect($resultShopNewCountry['value'])
        ->toBe(0);
    expect($resultShopNewCountry['item'])
        ->toBe(0);



})->with('shopTemplateResponse');

it('Verification whether it downloads only active countries', function (string $shopResponse) {
    $date = "2024-01-01";
    seed(CountriesWithDeactiveSeeder::class);
    Http::fake([
        config('api.shop') . "?start={$date}&end={$date}" => Http::response($shopResponse, 200),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $activeCountry = Country::where('active', true)->get();
    $resultsSalesShop = $shopSales->getSales($date, $date);
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

})->with('shopTemplateResponse');



it('Verification correct working function download response api with date', function (string $shopResponseFirstWrongOption, string $shopResponseSecondWrongOption, string $shopResponseCorrectOption) {

    seed(ComparisonDayJuneCountry::class);
    $date = [
      'start' => "2024-12-12",
      'end' => "2024-12-15",
    ];
    Http::fake([
        config('api.shop') => Http::response($shopResponseFirstWrongOption, 200),
        config('api.shop') . "?start={$date['start']}&end={$date['end']}" => Http::response($shopResponseCorrectOption, 200),
        config('api.shop') . "?start=2023-12-12&end=2023-12-12" => Http::response($shopResponseSecondWrongOption),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $countries = Country::where("active", true)
    ->get();
    $resultsSalesShop = $shopSales->getSales($date['start'], $date['end']);
    $shopFakeDate = json_decode($shopResponseCorrectOption, true);
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

})->with('shopTemplateResponse', 'shopApiResponseMay1_20Year2024', 'shopApiResponseJune1_20Year2023');

it('Verification correct working function download response api with 500 http code', function () {

    seed(ComparisonDayJuneCountry::class);
    $date = [
      'start' => "2024-12-12",
      'end' => "2024-12-15",
    ];

    Http::fake([
        config('api.shop') . "?start={$date['start']}&end={$date['end']}" => Http::response("", 500),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $countries = Country::where("active", true)
    ->get();
    $resultsSalesShop = $shopSales->getSales($date['start'], $date['end']);
    $countCountries = count($countries);

    expect($resultsSalesShop)
        ->toHaveCount($countCountries);

    foreach ($resultsSalesShop as $key => $resultSalesShop) {

        $selectCountry = $countries[intval($key) -1];
        if ($selectCountry->id !== $key) {
            $selectCountry = Country::find($key);
        }

        expect($resultSalesShop['value'])
            ->toBe(0);
        expect($resultSalesShop['item'])
            ->toBe(0);
    }

});
it('Verification correct working function download response api with 404 http code', function () {

    seed(ComparisonDayJuneCountry::class);
    $date = [
      'start' => "2024-12-12",
      'end' => "2024-12-15",
    ];

    Http::fake([
        config('api.shop') . "?start={$date['start']}&end={$date['end']}" => Http::response("", 404),
    ]);
    $shopSales = new ShopSales(new Shop(), new Country());
    $countries = Country::where("active", true)
    ->get();
    $resultsSalesShop = $shopSales->getSales($date['start'], $date['end']);
    $countCountries = count($countries);

    expect($resultsSalesShop)
        ->toHaveCount($countCountries);

    foreach ($resultsSalesShop as $key => $resultSalesShop) {

        $selectCountry = $countries[intval($key) -1];
        if ($selectCountry->id !== $key) {
            $selectCountry = Country::find($key);
        }

        expect($resultSalesShop['value'])
            ->toBe(0);
        expect($resultSalesShop['item'])
            ->toBe(0);
    }

});
