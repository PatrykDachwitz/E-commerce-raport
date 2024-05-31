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
        } elseif(preg_match("/$(0-9){4}+-+(0-9){2}+-+(0-9){2}^/", $date)) {
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
    public function get(string|null $startDate = null, string|null $endData = null) {
        if (!$this->checkCurrentFormatDate($startDate) | !$this->checkCurrentFormatDate($endData)) throw new Exception('Incorrect format date');
        $query = $this->getQuery($startDate, $endData);

        $response = Http::get($this->apiUrl . $query);
        return $response->json();
    }
}
