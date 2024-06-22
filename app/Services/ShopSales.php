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
    private function attributionResults(array|null $resultsShop) : array {
        $attributionResult = [];

        foreach ($this->country->where('active', true)->get() as $country) {
            if (!is_null($resultsShop)) {
                $attributionResult[$country->id] = $this->getItemAndValueByIdShop($resultsShop, $country->shop);
            } else {
                $attributionResult[$country->id] = [
                    'value' => 0,
                    'item' => 0,
                ];
            }
        }

        return $attributionResult;
    }
    public function getSales(string|null $starDate, string|null $endDate) {

        try {
            $responseShop = $this->shop->get($starDate, $endDate);
        } catch (Exception $e) {
            $responseShop = null;
        }

        return $this->attributionResults($responseShop);
    }

}
