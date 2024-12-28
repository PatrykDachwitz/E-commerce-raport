<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

use Illuminate\Support\Facades\Http;

class AnalyticsApiResponse
{

    private function getResponse(int $variant) : string {
        switch ($variant) {
            case 1:
                return '{
    "dimensionHeaders": [
        {
            "name": "date"
        }
    ],
    "metricHeaders": [
        {
            "name": "activeUsers",
            "type": "TYPE_INTEGER"
        }
    ],
    "rows":[
        { "dimensionValues": [{ "value": "20240707" } ], "metricValues": [ { "value": "3043" } ]},
        { "dimensionValues": [{ "value": "20240706" } ], "metricValues": [ { "value": "1826" } ]},
        { "dimensionValues": [{ "value": "20240705" } ], "metricValues": [ { "value": "1218" } ]},
        { "dimensionValues": [{ "value": "20240704" } ], "metricValues": [ { "value": "9499" } ]},
        { "dimensionValues": [{ "value": "20240703" } ], "metricValues": [ { "value": "3327" } ]},
        { "dimensionValues": [{ "value": "20240702" } ], "metricValues": [ { "value": "5739" } ]},
        { "dimensionValues": [{ "value": "20240701" } ], "metricValues": [ { "value": "9256" } ]},
        { "dimensionValues": [{ "value": "20240630" } ], "metricValues": [ { "value": "1891" } ]},
        { "dimensionValues": [{ "value": "20240629" } ], "metricValues": [ { "value": "1134" } ]},
        { "dimensionValues": [{ "value": "20240628" } ], "metricValues": [ { "value": "757" } ]},
        { "dimensionValues": [{ "value": "20240627" } ], "metricValues": [ { "value": "6013" } ]},
        { "dimensionValues": [{ "value": "20240626" } ], "metricValues": [ { "value": "2411" } ]},
        { "dimensionValues": [{ "value": "20240625" } ], "metricValues": [ { "value": "7763" } ]},
        { "dimensionValues": [{ "value": "20240624" } ], "metricValues": [ { "value": "1352" } ]},
        { "dimensionValues": [{ "value": "20240623" } ], "metricValues": [ { "value": "2415" } ]},
        { "dimensionValues": [{ "value": "20240622" } ], "metricValues": [ { "value": "1449" } ]},
        { "dimensionValues": [{ "value": "20240621" } ], "metricValues": [ { "value": "967" } ]},
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "1242" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "9692" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "5220" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "7434" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "2853" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "1711" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "1142" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "9930" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "1631" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "6236" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "3993" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "1455" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "873" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "583" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "9012" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "8891" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "8460" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "2855" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "6063" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 2:
                return '{
    "dimensionHeaders": [
        {
            "name": "date"
        }
    ],
    "metricHeaders": [
        {
            "name": "activeUsers",
            "type": "TYPE_INTEGER"
        }
    ],
    "rows":[
        { "dimensionValues": [{ "value": "20240707" } ], "metricValues": [ { "value": "4715" } ]},
        { "dimensionValues": [{ "value": "20240706" } ], "metricValues": [ { "value": "2829" } ]},
        { "dimensionValues": [{ "value": "20240705" } ], "metricValues": [ { "value": "1887" } ]},
        { "dimensionValues": [{ "value": "20240704" } ], "metricValues": [ { "value": "9499" } ]},
        { "dimensionValues": [{ "value": "20240703" } ], "metricValues": [ { "value": "3327" } ]},
        { "dimensionValues": [{ "value": "20240702" } ], "metricValues": [ { "value": "5739" } ]},
        { "dimensionValues": [{ "value": "20240701" } ], "metricValues": [ { "value": "9256" } ]},
        { "dimensionValues": [{ "value": "20240630" } ], "metricValues": [ { "value": "2073" } ]},
        { "dimensionValues": [{ "value": "20240629" } ], "metricValues": [ { "value": "1243" } ]},
        { "dimensionValues": [{ "value": "20240628" } ], "metricValues": [ { "value": "830" } ]},
        { "dimensionValues": [{ "value": "20240627" } ], "metricValues": [ { "value": "6013" } ]},
        { "dimensionValues": [{ "value": "20240626" } ], "metricValues": [ { "value": "2411" } ]},
        { "dimensionValues": [{ "value": "20240625" } ], "metricValues": [ { "value": "7763" } ]},
        { "dimensionValues": [{ "value": "20240624" } ], "metricValues": [ { "value": "1352" } ]},
        { "dimensionValues": [{ "value": "20240623" } ], "metricValues": [ { "value": "4368" } ]},
        { "dimensionValues": [{ "value": "20240622" } ], "metricValues": [ { "value": "2621" } ]},
        { "dimensionValues": [{ "value": "20240621" } ], "metricValues": [ { "value": "1748" } ]},
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "1242" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "9692" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "5220" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "7434" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "4831" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "2898" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "1934" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "9930" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "1631" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "6236" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "3993" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "4285" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "2571" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "1714" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "9012" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "8891" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "8460" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "2855" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "6063" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 3:
                return '{
    "dimensionHeaders": [
        {
            "name": "date"
        }
    ],
    "metricHeaders": [
        {
            "name": "activeUsers",
            "type": "TYPE_INTEGER"
        }
    ],
    "rows":[
        { "dimensionValues": [{ "value": "20240707" } ], "metricValues": [ { "value": "3378" } ]},
        { "dimensionValues": [{ "value": "20240706" } ], "metricValues": [ { "value": "2027" } ]},
        { "dimensionValues": [{ "value": "20240705" } ], "metricValues": [ { "value": "1352" } ]},
        { "dimensionValues": [{ "value": "20240704" } ], "metricValues": [ { "value": "9499" } ]},
        { "dimensionValues": [{ "value": "20240703" } ], "metricValues": [ { "value": "3327" } ]},
        { "dimensionValues": [{ "value": "20240702" } ], "metricValues": [ { "value": "5739" } ]},
        { "dimensionValues": [{ "value": "20240701" } ], "metricValues": [ { "value": "9256" } ]},
        { "dimensionValues": [{ "value": "20240630" } ], "metricValues": [ { "value": "1217" } ]},
        { "dimensionValues": [{ "value": "20240629" } ], "metricValues": [ { "value": "730" } ]},
        { "dimensionValues": [{ "value": "20240628" } ], "metricValues": [ { "value": "487" } ]},
        { "dimensionValues": [{ "value": "20240627" } ], "metricValues": [ { "value": "6013" } ]},
        { "dimensionValues": [{ "value": "20240626" } ], "metricValues": [ { "value": "2411" } ]},
        { "dimensionValues": [{ "value": "20240625" } ], "metricValues": [ { "value": "7763" } ]},
        { "dimensionValues": [{ "value": "20240624" } ], "metricValues": [ { "value": "1352" } ]},
        { "dimensionValues": [{ "value": "20240623" } ], "metricValues": [ { "value": "2984" } ]},
        { "dimensionValues": [{ "value": "20240622" } ], "metricValues": [ { "value": "1790" } ]},
        { "dimensionValues": [{ "value": "20240621" } ], "metricValues": [ { "value": "1194" } ]},
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "1242" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "9692" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "5220" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "7434" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "1496" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "897" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "599" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "9930" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "1631" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "6236" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "3993" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "1583" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "950" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "634" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "9012" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "8891" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "8460" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "2855" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "6063" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 4:
                return '{
    "dimensionHeaders": [
        {
            "name": "date"
        }
    ],
    "metricHeaders": [
        {
            "name": "activeUsers",
            "type": "TYPE_INTEGER"
        }
    ],
    "rows":[
        { "dimensionValues": [{ "value": "20240707" } ], "metricValues": [ { "value": "1589" } ]},
        { "dimensionValues": [{ "value": "20240706" } ], "metricValues": [ { "value": "953" } ]},
        { "dimensionValues": [{ "value": "20240705" } ], "metricValues": [ { "value": "637" } ]},
        { "dimensionValues": [{ "value": "20240704" } ], "metricValues": [ { "value": "9499" } ]},
        { "dimensionValues": [{ "value": "20240703" } ], "metricValues": [ { "value": "3327" } ]},
        { "dimensionValues": [{ "value": "20240702" } ], "metricValues": [ { "value": "5739" } ]},
        { "dimensionValues": [{ "value": "20240701" } ], "metricValues": [ { "value": "9256" } ]},
        { "dimensionValues": [{ "value": "20240630" } ], "metricValues": [ { "value": "3857" } ]},
        { "dimensionValues": [{ "value": "20240629" } ], "metricValues": [ { "value": "2314" } ]},
        { "dimensionValues": [{ "value": "20240628" } ], "metricValues": [ { "value": "1544" } ]},
        { "dimensionValues": [{ "value": "20240627" } ], "metricValues": [ { "value": "6013" } ]},
        { "dimensionValues": [{ "value": "20240626" } ], "metricValues": [ { "value": "2411" } ]},
        { "dimensionValues": [{ "value": "20240625" } ], "metricValues": [ { "value": "7763" } ]},
        { "dimensionValues": [{ "value": "20240624" } ], "metricValues": [ { "value": "1352" } ]},
        { "dimensionValues": [{ "value": "20240623" } ], "metricValues": [ { "value": "2236" } ]},
        { "dimensionValues": [{ "value": "20240622" } ], "metricValues": [ { "value": "1341" } ]},
        { "dimensionValues": [{ "value": "20240621" } ], "metricValues": [ { "value": "896" } ]},
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "1242" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "9692" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "5220" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "7434" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "614" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "368" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "246" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "9930" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "1631" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "6236" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "3993" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "4343" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "2606" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "1738" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "9012" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "8891" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "8460" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "2855" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "6063" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            default:
                return '';
        }
    }

    public function getSuccessWeekly() : void {
        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/123545:runReport" => Http::response($this->getResponse(1)),
            "https://analyticsdata.googleapis.com/v1beta/properties/12354775:runReport" => Http::response($this->getResponse(2)),
            "https://analyticsdata.googleapis.com/v1beta/properties/123547756:runReport" => Http::response($this->getResponse(3)),
            "https://analyticsdata.googleapis.com/v1beta/properties/287213359:runReport" => Http::response($this->getResponse(4)),
        ]);
    }
}
