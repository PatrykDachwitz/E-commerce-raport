<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

use Illuminate\Support\Facades\Http;

class NbpApiResponse
{

    const RESPONSE_API =         '
        [
{
"table": "A",
"no": "126/A/NBP/2024",
"effectiveDate": "2024-07-01",
"rates": [
{
"currency": "bat (Tajlandia)",
"code": "THB",
"mid": 0.1087
},
{
"currency": "dolar amerykański",
"code": "USD",
"mid": 3.9915
},
{
"currency": "dolar australijski",
"code": "AUD",
"mid": 2.6682
},
{
"currency": "dolar Hongkongu",
"code": "HKD",
"mid": 0.5109
},
{
"currency": "dolar kanadyjski",
"code": "CAD",
"mid": 2.9194
},
{
"currency": "dolar nowozelandzki",
"code": "NZD",
"mid": 2.4365
},
{
"currency": "dolar singapurski",
"code": "SGD",
"mid": 2.9465
},
{
"currency": "euro",
"code": "EUR",
"mid": 4.2981
},
{
"currency": "forint (Węgry)",
"code": "HUF",
"mid": 0.010927
},
{
"currency": "frank szwajcarski",
"code": "CHF",
"mid": 4.4335
},
{
"currency": "funt szterling",
"code": "GBP",
"mid": 5.0587
},
{
"currency": "hrywna (Ukraina)",
"code": "UAH",
"mid": 0.0982
},
{
"currency": "jen (Japonia)",
"code": "JPY",
"mid": 0.02479
},
{
"currency": "korona czeska",
"code": "CZK",
"mid": 0.1718
},
{
"currency": "korona duńska",
"code": "DKK",
"mid": 0.5763
},
{
"currency": "korona islandzka",
"code": "ISK",
"mid": 0.028905
},
{
"currency": "korona norweska",
"code": "NOK",
"mid": 0.3758
},
{
"currency": "korona szwedzka",
"code": "SEK",
"mid": 0.3781
},
{
"currency": "lej rumuński",
"code": "RON",
"mid": 0.8636
},
{
"currency": "lew (Bułgaria)",
"code": "BGN",
"mid": 2.1976
},
{
"currency": "lira turecka",
"code": "TRY",
"mid": 0.1223
},
{
"currency": "nowy izraelski szekel",
"code": "ILS",
"mid": 1.0644
},
{
"currency": "peso chilijskie",
"code": "CLP",
"mid": 0.004243
},
{
"currency": "peso filipińskie",
"code": "PHP",
"mid": 0.0681
},
{
"currency": "peso meksykańskie",
"code": "MXN",
"mid": 0.2171
},
{
"currency": "rand (Republika Południowej Afryki)",
"code": "ZAR",
"mid": 0.2217
},
{
"currency": "real (Brazylia)",
"code": "BRL",
"mid": 0.7138
},
{
"currency": "ringgit (Malezja)",
"code": "MYR",
"mid": 0.8469
},
{
"currency": "rupia indonezyjska",
"code": "IDR",
"mid": 0.00024455
},
{
"currency": "rupia indyjska",
"code": "INR",
"mid": 0.04783
},
{
"currency": "won południowokoreański",
"code": "KRW",
"mid": 0.002889
},
{
"currency": "yuan renminbi (Chiny)",
"code": "CNY",
"mid": 0.5491
},
{
"currency": "SDR (MFW)",
"code": "XDR",
"mid": 5.2812
}
]
}
]
        ';

    public function getResponse() : void {
        Http::fake([
            "http://api.nbp.pl/api/exchangerates/tables/A/" => Http::response(self::RESPONSE_API)
        ]);
    }
}
