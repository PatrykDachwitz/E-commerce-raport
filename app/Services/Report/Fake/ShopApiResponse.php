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
    private function getApiResponse(array $data) : string {
        $prepareData = "";
        foreach ($data as $country => $item) {
            if ($prepareData === "") $prepareData .= ",";
            $prepareData .= "\"$country\": {\"price_brutto\": {$item['value']}, \"items\": \"{$item['item']}\" }";
        }

        return " {
          \"confirmed\": {
            \"1\": {
              \"price_brutto\": {$data[1]['value']},
              \"items\": \"{$data[1]['item']}\"
            },
            \"5\": {
              \"price_brutto\": {$data[5]['value']},
              \"items\": \"{$data[5]['item']}\"
            },
            \"2\": {
              \"price_brutto\": {$data[2]['value']},
              \"items\": \"{$data[2]['item']}\"
            },
            \"10\": {
              \"price_brutto\": {$data[10]['value']},
              \"items\": \"{$data[10]['item']}\"
            },
            \"101\": {
              \"price_brutto\": {$data[101]['value']},
              \"items\": \"{$data[101]['item']}\"
            }
          },
          \"start\": \"2024-05-06 00:00:00\",
          \"stop\": \"2024-05-29 23:59:59\"
        }
        ";
    }
    public function getSuccessDay() : void
    {
        Http::fake([
            config("api.shop") . "?start=2024-06-20&end=2024-06-20" => Http::response($this->getApiResponse([1 => ["value" => 353, "item" => 41], 5 => ["value" => 608, "item" => 68], 10 => ["value" => 813, "item" => 76], 2 => ["value" => 142, "item" => 96], 101 => ["value" => 794, "item" => 71]])),
            config("api.shop") . "?start=2024-06-19&end=2024-06-19" => Http::response($this->getApiResponse([1 => ["value" => 774, "item" => 84], 5 => ["value" => 787, "item" => 81], 10 => ["value" => 587, "item" => 2], 2 => ["value" => 867, "item" => 37], 101 => ["value" => 881, "item" => 1]])),
            config("api.shop") . "?start=2024-06-18&end=2024-06-18" => Http::response($this->getApiResponse([1 => ["value" => 180, "item" => 22], 5 => ["value" => 431, "item" => 49], 10 => ["value" => 849, "item" => 66], 2 => ["value" => 252, "item" => 73], 101 => ["value" => 115, "item" => 35]])),
            config("api.shop") . "?start=2024-06-17&end=2024-06-17" => Http::response($this->getApiResponse([1 => ["value" => 678, "item" => 14], 5 => ["value" => 240, "item" => 93], 10 => ["value" => 564, "item" => 82], 2 => ["value" => 867, "item" => 64], 101 => ["value" => 804, "item" => 69]])),
            config("api.shop") . "?start=2024-06-16&end=2024-06-16" => Http::response($this->getApiResponse([1 => ["value" => 476, "item" => 82], 5 => ["value" => 839, "item" => 29], 10 => ["value" => 825, "item" => 1], 2 => ["value" => 17, "item" => 73], 101 => ["value" => 412, "item" => 82]])),
            config("api.shop") . "?start=2024-06-15&end=2024-06-15" => Http::response($this->getApiResponse([1 => ["value" => 856, "item" => 80], 5 => ["value" => 724, "item" => 99], 10 => ["value" => 445, "item" => 73], 2 => ["value" => 823, "item" => 86], 101 => ["value" => 434, "item" => 33]])),
            config("api.shop") . "?start=2024-06-14&end=2024-06-14" => Http::response($this->getApiResponse([1 => ["value" => 279, "item" => 51], 5 => ["value" => 617, "item" => 98], 10 => ["value" => 135, "item" => 74], 2 => ["value" => 670, "item" => 21], 101 => ["value" => 700, "item" => 53]])),
            config("api.shop") . "?start=2024-06-13&end=2024-06-13" => Http::response($this->getApiResponse([1 => ["value" => 148, "item" => 70], 5 => ["value" => 775, "item" => 9], 10 => ["value" => 25, "item" => 42], 2 => ["value" => 850, "item" => 15], 101 => ["value" => 552, "item" => 18]])),
            config("api.shop") . "?start=2024-06-12&end=2024-06-12" => Http::response($this->getApiResponse([1 => ["value" => 368, "item" => 93], 5 => ["value" => 399, "item" => 92], 10 => ["value" => 948, "item" => 66], 2 => ["value" => 601, "item" => 24], 101 => ["value" => 708, "item" => 68]])),
            config("api.shop") . "?start=2024-06-11&end=2024-06-11" => Http::response($this->getApiResponse([1 => ["value" => 469, "item" => 23], 5 => ["value" => 319, "item" => 44], 10 => ["value" => 599, "item" => 35], 2 => ["value" => 388, "item" => 75], 101 => ["value" => 98, "item" => 34]])),
            config("api.shop") . "?start=2024-06-10&end=2024-06-10" => Http::response($this->getApiResponse([1 => ["value" => 31, "item" => 64], 5 => ["value" => 949, "item" => 24], 10 => ["value" => 441, "item" => 41], 2 => ["value" => 286, "item" => 92], 101 => ["value" => 960, "item" => 29]])),
            config("api.shop") . "?start=2024-06-09&end=2024-06-09" => Http::response($this->getApiResponse([1 => ["value" => 445, "item" => 60], 5 => ["value" => 862, "item" => 61], 10 => ["value" => 609, "item" => 75], 2 => ["value" => 548, "item" => 97], 101 => ["value" => 519, "item" => 91]])),
            config("api.shop") . "?start=2024-06-08&end=2024-06-08" => Http::response($this->getApiResponse([1 => ["value" => 31, "item" => 94], 5 => ["value" => 81, "item" => 90], 10 => ["value" => 13, "item" => 39], 2 => ["value" => 888, "item" => 57], 101 => ["value" => 300, "item" => 31]])),
            config("api.shop") . "?start=2024-06-07&end=2024-06-07" => Http::response($this->getApiResponse([1 => ["value" => 606, "item" => 59], 5 => ["value" => 529, "item" => 67], 10 => ["value" => 447, "item" => 37], 2 => ["value" => 497, "item" => 95], 101 => ["value" => 662, "item" => 75]])),
            config("api.shop") . "?start=2024-06-06&end=2024-06-06" => Http::response($this->getApiResponse([1 => ["value" => 80, "item" => 79], 5 => ["value" => 667, "item" => 58], 10 => ["value" => 271, "item" => 82], 2 => ["value" => 806, "item" => 49], 101 => ["value" => 62, "item" => 56]])),
            config("api.shop") . "?start=2024-06-05&end=2024-06-05" => Http::response($this->getApiResponse([1 => ["value" => 84, "item" => 50], 5 => ["value" => 728, "item" => 91], 10 => ["value" => 943, "item" => 85], 2 => ["value" => 368, "item" => 50], 101 => ["value" => 651, "item" => 6]])),
            config("api.shop") . "?start=2024-06-04&end=2024-06-04" => Http::response($this->getApiResponse([1 => ["value" => 2, "item" => 49], 5 => ["value" => 81, "item" => 22], 10 => ["value" => 457, "item" => 71], 2 => ["value" => 271, "item" => 52], 101 => ["value" => 976, "item" => 11]])),
            config("api.shop") . "?start=2024-06-03&end=2024-06-03" => Http::response($this->getApiResponse([1 => ["value" => 338, "item" => 7], 5 => ["value" => 259, "item" => 97], 10 => ["value" => 532, "item" => 77], 2 => ["value" => 877, "item" => 95], 101 => ["value" => 31, "item" => 84]])),
            config("api.shop") . "?start=2024-06-02&end=2024-06-02" => Http::response($this->getApiResponse([1 => ["value" => 417, "item" => 1], 5 => ["value" => 828, "item" => 49], 10 => ["value" => 27, "item" => 22], 2 => ["value" => 211, "item" => 19], 101 => ["value" => 554, "item" => 31]])),
            config("api.shop") . "?start=2024-06-01&end=2024-06-01" => Http::response($this->getApiResponse([1 => ["value" => 437, "item" => 93], 5 => ["value" => 481, "item" => 96], 10 => ["value" => 632, "item" => 44], 2 => ["value" => 667, "item" => 52], 101 => ["value" => 820, "item" => 87]])),
            config("api.shop") . "?start=2024-05-31&end=2024-05-31" => Http::response($this->getApiResponse([1 => ["value" => 828, "item" => 50], 5 => ["value" => 134, "item" => 63], 10 => ["value" => 953, "item" => 37], 2 => ["value" => 720, "item" => 30], 101 => ["value" => 13, "item" => 10]])),
            config("api.shop") . "?start=2024-05-30&end=2024-05-30" => Http::response($this->getApiResponse([1 => ["value" => 240, "item" => 80], 5 => ["value" => 420, "item" => 42], 10 => ["value" => 684, "item" => 5], 2 => ["value" => 392, "item" => 76], 101 => ["value" => 303, "item" => 14]])),
            config("api.shop") . "?start=2024-05-29&end=2024-05-29" => Http::response($this->getApiResponse([1 => ["value" => 674, "item" => 63], 5 => ["value" => 251, "item" => 12], 10 => ["value" => 872, "item" => 71], 2 => ["value" => 908, "item" => 48], 101 => ["value" => 41, "item" => 63]])),
            config("api.shop") . "?start=2024-05-28&end=2024-05-28" => Http::response($this->getApiResponse([1 => ["value" => 463, "item" => 47], 5 => ["value" => 546, "item" => 36], 10 => ["value" => 979, "item" => 49], 2 => ["value" => 736, "item" => 18], 101 => ["value" => 936, "item" => 51]])),
            config("api.shop") . "?start=2024-05-27&end=2024-05-27" => Http::response($this->getApiResponse([1 => ["value" => 663, "item" => 75], 5 => ["value" => 565, "item" => 39], 10 => ["value" => 925, "item" => 14], 2 => ["value" => 847, "item" => 92], 101 => ["value" => 680, "item" => 95]])),
            config("api.shop") . "?start=2024-05-26&end=2024-05-26" => Http::response($this->getApiResponse([1 => ["value" => 656, "item" => 66], 5 => ["value" => 689, "item" => 99], 10 => ["value" => 139, "item" => 99], 2 => ["value" => 444, "item" => 12], 101 => ["value" => 21, "item" => 91]])),
            config("api.shop") . "?start=2024-05-25&end=2024-05-25" => Http::response($this->getApiResponse([1 => ["value" => 108, "item" => 39], 5 => ["value" => 558, "item" => 44], 10 => ["value" => 275, "item" => 67], 2 => ["value" => 904, "item" => 80], 101 => ["value" => 934, "item" => 80]])),
            config("api.shop") . "?start=2024-05-24&end=2024-05-24" => Http::response($this->getApiResponse([1 => ["value" => 157, "item" => 36], 5 => ["value" => 403, "item" => 47], 10 => ["value" => 50, "item" => 34], 2 => ["value" => 257, "item" => 10], 101 => ["value" => 83, "item" => 4]])),
            config("api.shop") . "?start=2024-05-23&end=2024-05-23" => Http::response($this->getApiResponse([1 => ["value" => 572, "item" => 58], 5 => ["value" => 120, "item" => 30], 10 => ["value" => 389, "item" => 41], 2 => ["value" => 661, "item" => 52], 101 => ["value" => 195, "item" => 49]])),
            config("api.shop") . "?start=2024-05-22&end=2024-05-22" => Http::response($this->getApiResponse([1 => ["value" => 7, "item" => 55], 5 => ["value" => 103, "item" => 99], 10 => ["value" => 655, "item" => 8], 2 => ["value" => 653, "item" => 7], 101 => ["value" => 622, "item" => 23]])),
            config("api.shop") . "?start=2024-05-21&end=2024-05-21" => Http::response($this->getApiResponse([1 => ["value" => 651, "item" => 92], 5 => ["value" => 738, "item" => 17], 10 => ["value" => 648, "item" => 20], 2 => ["value" => 806, "item" => 49], 101 => ["value" => 145, "item" => 91]]))
        ]);

    }
}
