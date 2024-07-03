<?php
declare(strict_types=1);
namespace App\Services\Connection;

use Exception;
use Illuminate\Support\Facades\Http;

class Shop
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('api.shop');
    }

    private function checkCurrentFormatDate(string|null $date = null) : bool {
        if ($date === null) {
            return true;
        } elseif(strtotime($date)) {
            return true;
        } else {
            return false;
        }
    }

    private function getQuery(string|null $startDate = null, string|null $endData = null) : string {
        if (!is_null($startDate) & !is_null($endData)) {
            return "?start={$startDate}&end={$endData}";
        } elseif (!is_null($startDate) & is_null($endData)) {
            return "?start={$startDate}";
        } elseif (is_null($startDate) & !is_null($endData)) {
            return "?end={$endData}";
        } else {
            return "";
        }
    }

    /**
     * @throws Exception
     */
    public function get(string|null $startDate = null, string|null $endData = null) {
        if (!$this->checkCurrentFormatDate($startDate) | !$this->checkCurrentFormatDate($endData)) throw new Exception('Incorrect format date');
        $query = $this->getQuery($startDate, $endData);

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . env('SHOP_API_TOKEN'),
            'Accept' => "application/json",
            'Content-Type' => "application/json",
        ])->get($this->apiUrl . $query);
        if (!$response->ok()) throw new Exception('Error response code');
        else return $response->json();
    }
}
