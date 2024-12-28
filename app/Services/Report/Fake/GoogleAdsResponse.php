<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

use Illuminate\Support\Facades\Http;

class GoogleAdsResponse
{

    private function getResponse(int $variant) : string {
        switch ($variant) {
            case 1:
                return '[

    {
        "results": [
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "39904", "costMicros": "1401000000" }, "segments": {"date": "2024-07-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "23942", "costMicros": "840000000" }, "segments": {"date": "2024-07-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "15962", "costMicros": "561000000" }, "segments": {"date": "2024-07-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4259", "costMicros": "143000000" }, "segments": {"date": "2024-07-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6273", "costMicros": "57000000" }, "segments": {"date": "2024-07-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9451", "costMicros": "752000000" }, "segments": {"date": "2024-07-02"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4867", "costMicros": "711000000" }, "segments": {"date": "2024-07-01"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "37572", "costMicros": "3234000000" }, "segments": {"date": "2024-06-30"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "22543", "costMicros": "1940000000" }, "segments": {"date": "2024-06-29"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "15030", "costMicros": "1295000000" }, "segments": {"date": "2024-06-28"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3013", "costMicros": "155000000" }, "segments": {"date": "2024-06-27"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8206", "costMicros": "956000000" }, "segments": {"date": "2024-06-26"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8674", "costMicros": "607000000" }, "segments": {"date": "2024-06-25"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2780", "costMicros": "651000000" }, "segments": {"date": "2024-06-24"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "40199", "costMicros": "3310000000" }, "segments": {"date": "2024-06-23"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "24119", "costMicros": "1986000000" }, "segments": {"date": "2024-06-22"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "16080", "costMicros": "1324000000" }, "segments": {"date": "2024-06-21"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2954", "costMicros": "387000000" }, "segments": {"date": "2024-06-20"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1855", "costMicros": "222000000" }, "segments": {"date": "2024-06-19"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1458", "costMicros": "496000000" }, "segments": {"date": "2024-06-18"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5061", "costMicros": "58000000" }, "segments": {"date": "2024-06-17"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "39329", "costMicros": "4909000000" }, "segments": {"date": "2024-06-16"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "23597", "costMicros": "2945000000" }, "segments": {"date": "2024-06-15"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "15733", "costMicros": "1964000000" }, "segments": {"date": "2024-06-14"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2785", "costMicros": "102000000" }, "segments": {"date": "2024-06-13"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6440", "costMicros": "23000000" }, "segments": {"date": "2024-06-12"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3267", "costMicros": "608000000" }, "segments": {"date": "2024-06-11"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4812", "costMicros": "180000000" }, "segments": {"date": "2024-06-10"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "31165", "costMicros": "3919000000" }, "segments": {"date": "2024-06-09"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "18699", "costMicros": "2351000000" }, "segments": {"date": "2024-06-08"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "12467", "costMicros": "1569000000" }, "segments": {"date": "2024-06-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7793", "costMicros": "126000000" }, "segments": {"date": "2024-06-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4536", "costMicros": "329000000" }, "segments": {"date": "2024-06-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8163", "costMicros": "772000000" }, "segments": {"date": "2024-06-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "230", "costMicros": "273000000" }, "segments": {"date": "2024-06-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "382", "costMicros": "454000000" }, "segments": {"date": "2024-06-02"} }
        ],
        "fieldMask": "metrics.clicks,metrics.costMicros,segments.date",
        "requestId": "V_YzUHhkv35zqntpPk9byg",
        "queryResourceConsumption": "322"
    }]
';
            case 2:
                return '[

    {
        "results": [
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "39942", "costMicros": "18000000" }, "segments": {"date": "2024-07-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "23965", "costMicros": "10000000" }, "segments": {"date": "2024-07-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "15978", "costMicros": "8000000" }, "segments": {"date": "2024-07-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4259", "costMicros": "143000000" }, "segments": {"date": "2024-07-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6273", "costMicros": "57000000" }, "segments": {"date": "2024-07-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9451", "costMicros": "752000000" }, "segments": {"date": "2024-07-02"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4867", "costMicros": "711000000" }, "segments": {"date": "2024-07-01"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "14475", "costMicros": "4958000000" }, "segments": {"date": "2024-06-30"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8685", "costMicros": "2974000000" }, "segments": {"date": "2024-06-29"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5790", "costMicros": "1984000000" }, "segments": {"date": "2024-06-28"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3013", "costMicros": "155000000" }, "segments": {"date": "2024-06-27"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8206", "costMicros": "956000000" }, "segments": {"date": "2024-06-26"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8674", "costMicros": "607000000" }, "segments": {"date": "2024-06-25"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2780", "costMicros": "651000000" }, "segments": {"date": "2024-06-24"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "37405", "costMicros": "4559000000" }, "segments": {"date": "2024-06-23"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "22443", "costMicros": "2735000000" }, "segments": {"date": "2024-06-22"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "14962", "costMicros": "1825000000" }, "segments": {"date": "2024-06-21"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2954", "costMicros": "387000000" }, "segments": {"date": "2024-06-20"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1855", "costMicros": "222000000" }, "segments": {"date": "2024-06-19"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1458", "costMicros": "496000000" }, "segments": {"date": "2024-06-18"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5061", "costMicros": "58000000" }, "segments": {"date": "2024-06-17"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "164", "costMicros": "470000000" }, "segments": {"date": "2024-06-16"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "98", "costMicros": "282000000" }, "segments": {"date": "2024-06-15"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "67", "costMicros": "188000000" }, "segments": {"date": "2024-06-14"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2785", "costMicros": "102000000" }, "segments": {"date": "2024-06-13"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6440", "costMicros": "23000000" }, "segments": {"date": "2024-06-12"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3267", "costMicros": "608000000" }, "segments": {"date": "2024-06-11"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4812", "costMicros": "180000000" }, "segments": {"date": "2024-06-10"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "162", "costMicros": "4635000000" }, "segments": {"date": "2024-06-09"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "97", "costMicros": "2781000000" }, "segments": {"date": "2024-06-08"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "66", "costMicros": "1855000000" }, "segments": {"date": "2024-06-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7793", "costMicros": "126000000" }, "segments": {"date": "2024-06-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4536", "costMicros": "329000000" }, "segments": {"date": "2024-06-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8163", "costMicros": "772000000" }, "segments": {"date": "2024-06-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "230", "costMicros": "273000000" }, "segments": {"date": "2024-06-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "382", "costMicros": "454000000" }, "segments": {"date": "2024-06-02"} }
            ],
        "fieldMask": "metrics.clicks,metrics.costMicros,segments.date",
        "requestId": "V_YzUHhkv35zqntpPk9byg",
        "queryResourceConsumption": "322"
    }]
';
            case 3:
                return '[

    {
        "results": [
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "13690", "costMicros": "118000000" }, "segments": {"date": "2024-07-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8214", "costMicros": "71000000" }, "segments": {"date": "2024-07-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5477", "costMicros": "48000000" }, "segments": {"date": "2024-07-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4259", "costMicros": "143000000" }, "segments": {"date": "2024-07-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6273", "costMicros": "57000000" }, "segments": {"date": "2024-07-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9451", "costMicros": "752000000" }, "segments": {"date": "2024-07-02"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4867", "costMicros": "711000000" }, "segments": {"date": "2024-07-01"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5107", "costMicros": "1126000000" }, "segments": {"date": "2024-06-30"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3064", "costMicros": "675000000" }, "segments": {"date": "2024-06-29"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2043", "costMicros": "452000000" }, "segments": {"date": "2024-06-28"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3013", "costMicros": "155000000" }, "segments": {"date": "2024-06-27"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8206", "costMicros": "956000000" }, "segments": {"date": "2024-06-26"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8674", "costMicros": "607000000" }, "segments": {"date": "2024-06-25"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2780", "costMicros": "651000000" }, "segments": {"date": "2024-06-24"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "24883", "costMicros": "2914000000" }, "segments": {"date": "2024-06-23"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "14930", "costMicros": "1748000000" }, "segments": {"date": "2024-06-22"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9954", "costMicros": "1166000000" }, "segments": {"date": "2024-06-21"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2954", "costMicros": "387000000" }, "segments": {"date": "2024-06-20"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1855", "costMicros": "222000000" }, "segments": {"date": "2024-06-19"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1458", "costMicros": "496000000" }, "segments": {"date": "2024-06-18"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5061", "costMicros": "58000000" }, "segments": {"date": "2024-06-17"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "16651", "costMicros": "1949000000" }, "segments": {"date": "2024-06-16"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9990", "costMicros": "1169000000" }, "segments": {"date": "2024-06-15"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6661", "costMicros": "781000000" }, "segments": {"date": "2024-06-14"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2785", "costMicros": "102000000" }, "segments": {"date": "2024-06-13"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6440", "costMicros": "23000000" }, "segments": {"date": "2024-06-12"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3267", "costMicros": "608000000" }, "segments": {"date": "2024-06-11"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4812", "costMicros": "180000000" }, "segments": {"date": "2024-06-10"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3105", "costMicros": "4853000000" }, "segments": {"date": "2024-06-09"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1863", "costMicros": "2911000000" }, "segments": {"date": "2024-06-08"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1242", "costMicros": "1942000000" }, "segments": {"date": "2024-06-07"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7793", "costMicros": "126000000" }, "segments": {"date": "2024-06-06"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4536", "costMicros": "329000000" }, "segments": {"date": "2024-06-05"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8163", "costMicros": "772000000" }, "segments": {"date": "2024-06-04"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "230", "costMicros": "273000000" }, "segments": {"date": "2024-06-03"} },
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "382", "costMicros": "454000000" }, "segments": {"date": "2024-06-02"} }
            ],
        "fieldMask": "metrics.clicks,metrics.costMicros,segments.date",
        "requestId": "V_YzUHhkv35zqntpPk9byg",
        "queryResourceConsumption": "322"
    }]
';
            default:
                return '';
        }
    }

    public function getSuccessWeekly() : void {
        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($this->getResponse(1)),
            "https://googleads.googleapis.com/v17/customers/123326321/googleAds:searchStream" => Http::response($this->getResponse(2)),
            "https://googleads.googleapis.com/v17/customers/123327821/googleAds:searchStream" => Http::response($this->getResponse(3)),
        ]);
    }
}
