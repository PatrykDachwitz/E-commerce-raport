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
            case 4:
                return '[

    {
        "results": [
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "459", "costMicros": "732000000" }, "segments": {"date": "2024-06-20"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1008", "costMicros": "275000000" }, "segments": {"date": "2024-06-19"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6202", "costMicros": "453000000" }, "segments": {"date": "2024-06-18"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "986", "costMicros": "439000000" }, "segments": {"date": "2024-06-17"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4515", "costMicros": "748000000" }, "segments": {"date": "2024-06-16"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "183", "costMicros": "517000000" }, "segments": {"date": "2024-06-15"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7895", "costMicros": "900000000" }, "segments": {"date": "2024-06-14"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4880", "costMicros": "265000000" }, "segments": {"date": "2024-06-13"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9721", "costMicros": "314000000" }, "segments": {"date": "2024-06-12"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3677", "costMicros": "526000000" }, "segments": {"date": "2024-06-11"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4023", "costMicros": "794000000" }, "segments": {"date": "2024-06-10"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7288", "costMicros": "87000000" }, "segments": {"date": "2024-06-09"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4080", "costMicros": "342000000" }, "segments": {"date": "2024-06-08"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8342", "costMicros": "290000000" }, "segments": {"date": "2024-06-07"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1046", "costMicros": "958000000" }, "segments": {"date": "2024-06-06"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8344", "costMicros": "920000000" }, "segments": {"date": "2024-06-05"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7522", "costMicros": "564000000" }, "segments": {"date": "2024-06-04"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5669", "costMicros": "199000000" }, "segments": {"date": "2024-06-03"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8471", "costMicros": "244000000" }, "segments": {"date": "2024-06-02"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9323", "costMicros": "877000000" }, "segments": {"date": "2024-06-01"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7737", "costMicros": "634000000" }, "segments": {"date": "2024-05-31"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4683", "costMicros": "218000000" }, "segments": {"date": "2024-05-30"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1441", "costMicros": "347000000" }, "segments": {"date": "2024-05-29"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5992", "costMicros": "198000000" }, "segments": {"date": "2024-05-28"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4724", "costMicros": "766000000" }, "segments": {"date": "2024-05-27"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5425", "costMicros": "233000000" }, "segments": {"date": "2024-05-26"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9768", "costMicros": "507000000" }, "segments": {"date": "2024-05-25"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4206", "costMicros": "904000000" }, "segments": {"date": "2024-05-24"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6020", "costMicros": "2000000" }, "segments": {"date": "2024-05-23"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9879", "costMicros": "209000000" }, "segments": {"date": "2024-05-22"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7515", "costMicros": "529000000" }, "segments": {"date": "2024-05-21"} }
            ],
        "fieldMask": "metrics.clicks,metrics.costMicros,segments.date",
        "requestId": "V_YzUHhkv35zqntpPk9byg",
        "queryResourceConsumption": "322"
    }]
';
            case 5:
                return '[

    {
        "results": [
            { "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "672", "costMicros": "31000000" }, "segments": {"date": "2024-06-20"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9809", "costMicros": "135000000" }, "segments": {"date": "2024-06-19"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8657", "costMicros": "789000000" }, "segments": {"date": "2024-06-18"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5561", "costMicros": "949000000" }, "segments": {"date": "2024-06-17"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6435", "costMicros": "972000000" }, "segments": {"date": "2024-06-16"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5136", "costMicros": "305000000" }, "segments": {"date": "2024-06-15"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6831", "costMicros": "290000000" }, "segments": {"date": "2024-06-14"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2952", "costMicros": "821000000" }, "segments": {"date": "2024-06-13"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3009", "costMicros": "396000000" }, "segments": {"date": "2024-06-12"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6187", "costMicros": "477000000" }, "segments": {"date": "2024-06-11"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1954", "costMicros": "546000000" }, "segments": {"date": "2024-06-10"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9299", "costMicros": "223000000" }, "segments": {"date": "2024-06-09"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7112", "costMicros": "815000000" }, "segments": {"date": "2024-06-08"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6756", "costMicros": "950000000" }, "segments": {"date": "2024-06-07"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6684", "costMicros": "892000000" }, "segments": {"date": "2024-06-06"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7970", "costMicros": "21000000" }, "segments": {"date": "2024-06-05"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3212", "costMicros": "780000000" }, "segments": {"date": "2024-06-04"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2411", "costMicros": "602000000" }, "segments": {"date": "2024-06-03"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4807", "costMicros": "148000000" }, "segments": {"date": "2024-06-02"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "94", "costMicros": "930000000" }, "segments": {"date": "2024-06-01"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7095", "costMicros": "686000000" }, "segments": {"date": "2024-05-31"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6804", "costMicros": "477000000" }, "segments": {"date": "2024-05-30"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7390", "costMicros": "286000000" }, "segments": {"date": "2024-05-29"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5980", "costMicros": "914000000" }, "segments": {"date": "2024-05-28"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2532", "costMicros": "540000000" }, "segments": {"date": "2024-05-27"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "1740", "costMicros": "469000000" }, "segments": {"date": "2024-05-26"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9241", "costMicros": "400000000" }, "segments": {"date": "2024-05-25"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4194", "costMicros": "43000000" }, "segments": {"date": "2024-05-24"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9766", "costMicros": "442000000" }, "segments": {"date": "2024-05-23"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8540", "costMicros": "299000000" }, "segments": {"date": "2024-05-22"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6510", "costMicros": "341000000" }, "segments": {"date": "2024-05-21"} }
            ],
        "fieldMask": "metrics.clicks,metrics.costMicros,segments.date",
        "requestId": "V_YzUHhkv35zqntpPk9byg",
        "queryResourceConsumption": "322"
    }]
';
            case 6:
                return '[

    {
        "results": [
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3222", "costMicros": "492000000" }, "segments": {"date": "2024-06-20"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7328", "costMicros": "271000000" }, "segments": {"date": "2024-06-19"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9214", "costMicros": "157000000" }, "segments": {"date": "2024-06-18"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6313", "costMicros": "429000000" }, "segments": {"date": "2024-06-17"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6129", "costMicros": "145000000" }, "segments": {"date": "2024-06-16"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2691", "costMicros": "228000000" }, "segments": {"date": "2024-06-15"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9264", "costMicros": "69000000" }, "segments": {"date": "2024-06-14"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2616", "costMicros": "775000000" }, "segments": {"date": "2024-06-13"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3374", "costMicros": "590000000" }, "segments": {"date": "2024-06-12"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "172", "costMicros": "775000000" }, "segments": {"date": "2024-06-11"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5360", "costMicros": "177000000" }, "segments": {"date": "2024-06-10"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7593", "costMicros": "500000000" }, "segments": {"date": "2024-06-09"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3064", "costMicros": "163000000" }, "segments": {"date": "2024-06-08"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2361", "costMicros": "483000000" }, "segments": {"date": "2024-06-07"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2825", "costMicros": "835000000" }, "segments": {"date": "2024-06-06"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4717", "costMicros": "895000000" }, "segments": {"date": "2024-06-05"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6744", "costMicros": "961000000" }, "segments": {"date": "2024-06-04"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8343", "costMicros": "973000000" }, "segments": {"date": "2024-06-03"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5373", "costMicros": "25000000" }, "segments": {"date": "2024-06-02"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3677", "costMicros": "67000000" }, "segments": {"date": "2024-06-01"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7201", "costMicros": "571000000" }, "segments": {"date": "2024-05-31"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "974", "costMicros": "317000000" }, "segments": {"date": "2024-05-30"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "6338", "costMicros": "242000000" }, "segments": {"date": "2024-05-29"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "7735", "costMicros": "415000000" }, "segments": {"date": "2024-05-28"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8779", "costMicros": "387000000" }, "segments": {"date": "2024-05-27"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "8782", "costMicros": "50000000" }, "segments": {"date": "2024-05-26"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "4480", "costMicros": "406000000" }, "segments": {"date": "2024-05-25"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "3737", "costMicros": "480000000" }, "segments": {"date": "2024-05-24"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "2070", "costMicros": "221000000" }, "segments": {"date": "2024-05-23"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "5093", "costMicros": "164000000" }, "segments": {"date": "2024-05-22"} },
{ "campaign": { "resourceName": "customers/12342141/campaigns/2312", "name": "Test" }, "metrics": { "clicks": "9514", "costMicros": "567000000" }, "segments": {"date": "2024-05-21"} }
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

    public function getSuccessDay() : void {
        Http::fake([
            "https://googleads.googleapis.com/v17/customers/123321321/googleAds:searchStream" => Http::response($this->getResponse(4)),
            "https://googleads.googleapis.com/v17/customers/123326321/googleAds:searchStream" => Http::response($this->getResponse(5)),
            "https://googleads.googleapis.com/v17/customers/123327821/googleAds:searchStream" => Http::response($this->getResponse(6)),
        ]);
    }
}
