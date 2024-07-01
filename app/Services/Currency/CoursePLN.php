<?php
declare(strict_types=1);
namespace App\Services\Currency;

use Illuminate\Support\Facades\Http;
use Exception;

class CoursePLN
{

    private function connectionApi() : array|null {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
        ])->get('http://api.nbp.pl/api/exchangerates/tables/A/');


        if ($response->ok()) {
            try {
                return $response->json(0)['rates'];
            } catch (Exception) {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getCurrentCourse(string $nameCurrencies) : float|int {
        $content = $this->connectionApi();
        if(is_null($content)) return 1;


        foreach ($content as $item) {
            if ($item['code'] === $nameCurrencies) return $item['mid'];
        }

        return 1;
    }


}
