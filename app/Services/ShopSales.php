<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Country;
use App\Services\Connection\Shop;
use \Exception;

class ShopSales
{

    private Shop $shop;
    private Country $country;
    public function __construct(Shop $shop, Country $country)
    {
        $this->shop = $shop;
        $this->country = $country;
    }

    private function getItemAndValueByIdShop(array $resultsShop, int $shopId) : array {
        try {
            $confirmedValueByShop = $resultsShop['confirmed'][$shopId];
        } catch (Exception){
            return [
                'value' => 0,
                'item' => 0,
            ];

        }

        return [
            'value' => $confirmedValueByShop['price_brutto'],
            'item' => $confirmedValueByShop['items'],
        ];
    }
    private function attributionResults(array $resultsShop) : array {
        $attributionResult = [];

        foreach ($this->country->where('active', true)->get() as $country) {
            $attributionResult[$country->id] = $this->getItemAndValueByIdShop($resultsShop, $country->shop);
        }

        return $attributionResult;
    }
    public function getSales() {

        try {
            $responseShop = $this->shop->get();
        } catch (Exception) {}

        return $this->attributionResults($responseShop);
    }

}
