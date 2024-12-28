<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

use Illuminate\Support\Facades\Http;

class ShopApiResponse
{

    private function getResponseShopWeekly(int $variant) : string {

        switch ($variant) {
            case 1:
                return ' {
          "confirmed": {
            "1": {
              "price_brutto": 421421,
              "items": "12"
            },
            "5": {
              "price_brutto": 43242,
              "items": "1"
            },
            "2": {
              "price_brutto": 275,
              "items": "4"
            },
            "10": {
              "price_brutto": 22475,
              "items": "43"
            },
            "101": {
              "price_brutto": 457,
              "items": "2"
            }
          },
          "start": "2024-05-06 00:00:00",
          "stop": "2024-05-29 23:59:59"
        }
        ';
                break;
                case 2:
                return ' {
          "confirmed": {
            "1": {
              "price_brutto": 4214,
              "items": "42"
            },
            "5": {
              "price_brutto": 64375374,
              "items": "3"
            },
            "2": {
              "price_brutto": 257,
              "items": "3"
            },
            "10": {
              "price_brutto": 7452,
              "items": "12"
            },
            "101": {
              "price_brutto": 2475,
              "items": "5"
            }
          },
          "start": "2024-05-06 00:00:00",
          "stop": "2024-05-29 23:59:59"
        }
        ';
                break;
                case 3:
                return ' {
          "confirmed": {
            "1": {
              "price_brutto": 42142,
              "items": "7"
            },
            "5": {
              "price_brutto": 3457354,
              "items": "5"
            },
            "2": {
              "price_brutto": 25724,
              "items": "3"
            },
            "10": {
              "price_brutto": 2346,
              "items": "6"
            },
            "101": {
              "price_brutto": 2475,
              "items": "1"
            }
          },
          "start": "2024-05-06 00:00:00",
          "stop": "2024-05-29 23:59:59"
        }
        ';
                break;
                case 4:
                return ' {
          "confirmed": {
            "1": {
              "price_brutto": 21213,
              "items": "21"
            },
            "5": {
              "price_brutto": 2634326,
              "items": "10"
            },
            "2": {
              "price_brutto": 24752457,
              "items": "2"
            },
            "10": {
              "price_brutto": 2643,
              "items": "35"
            },
            "101": {
              "price_brutto": 475,
              "items": "2"
            }
          },
          "start": "2024-05-06 00:00:00",
          "stop": "2024-05-29 23:59:59"
        }
        ';
                break;
                case 5:
                return ' {
          "confirmed": {
            "1": {
              "price_brutto": 421421,
              "items": "12"
            },
            "5": {
              "price_brutto": 2634,
              "items": "12"
            },
            "2": {
              "price_brutto": 25724,
              "items": "1"
            },
            "10": {
              "price_brutto": 2364,
              "items": "5"
            },
            "101": {
              "price_brutto": 725,
              "items": "2"
            }
          },
          "start": "2024-05-06 00:00:00",
          "stop": "2024-05-29 23:59:59"
        }
        ';
                break;
            default:
                return "";
                break;
        }
    }
    public function getSuccessWeekly() : void
    {
        Http::fake([
            config('api.shop') . "?start=2024-07-05&end=2024-07-07" => Http::response($this->getResponseShopWeekly(1)),
            config('api.shop') . "?start=2024-06-28&end=2024-06-30" => Http::response($this->getResponseShopWeekly(2)),
            config('api.shop') . "?start=2024-06-21&end=2024-06-23" => Http::response($this->getResponseShopWeekly(3)),
            config('api.shop') . "?start=2024-06-14&end=2024-06-16" => Http::response($this->getResponseShopWeekly(4)),
            config('api.shop') . "?start=2024-06-07&end=2024-06-09" => Http::response($this->getResponseShopWeekly(5)),
        ]);

    }
}
