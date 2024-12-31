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
            case 5:
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
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "29" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "865" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "840" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "224" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "535" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "910" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "49" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "107" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "798" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "807" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "622" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "843" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "920" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "719" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "1" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "492" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "322" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "295" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "993" } ]},
        { "dimensionValues": [{ "value": "20240601" } ], "metricValues": [ { "value": "8" } ]},
        { "dimensionValues": [{ "value": "20240531" } ], "metricValues": [ { "value": "337" } ]},
        { "dimensionValues": [{ "value": "20240530" } ], "metricValues": [ { "value": "306" } ]},
        { "dimensionValues": [{ "value": "20240529" } ], "metricValues": [ { "value": "287" } ]},
        { "dimensionValues": [{ "value": "20240528" } ], "metricValues": [ { "value": "960" } ]},
        { "dimensionValues": [{ "value": "20240527" } ], "metricValues": [ { "value": "539" } ]},
        { "dimensionValues": [{ "value": "20240526" } ], "metricValues": [ { "value": "522" } ]},
        { "dimensionValues": [{ "value": "20240525" } ], "metricValues": [ { "value": "168" } ]},
        { "dimensionValues": [{ "value": "20240524" } ], "metricValues": [ { "value": "115" } ]},
        { "dimensionValues": [{ "value": "20240523" } ], "metricValues": [ { "value": "414" } ]},
        { "dimensionValues": [{ "value": "20240522" } ], "metricValues": [ { "value": "41" } ]},
        { "dimensionValues": [{ "value": "20240521" } ], "metricValues": [ { "value": "557" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 6:
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
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "849" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "890" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "525" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "262" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "207" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "123" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "437" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "653" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "986" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "919" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "180" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "772" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "635" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "125" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "225" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "304" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "892" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "336" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "694" } ]},
        { "dimensionValues": [{ "value": "20240601" } ], "metricValues": [ { "value": "701" } ]},
        { "dimensionValues": [{ "value": "20240531" } ], "metricValues": [ { "value": "23" } ]},
        { "dimensionValues": [{ "value": "20240530" } ], "metricValues": [ { "value": "313" } ]},
        { "dimensionValues": [{ "value": "20240529" } ], "metricValues": [ { "value": "611" } ]},
        { "dimensionValues": [{ "value": "20240528" } ], "metricValues": [ { "value": "193" } ]},
        { "dimensionValues": [{ "value": "20240527" } ], "metricValues": [ { "value": "263" } ]},
        { "dimensionValues": [{ "value": "20240526" } ], "metricValues": [ { "value": "565" } ]},
        { "dimensionValues": [{ "value": "20240525" } ], "metricValues": [ { "value": "992" } ]},
        { "dimensionValues": [{ "value": "20240524" } ], "metricValues": [ { "value": "383" } ]},
        { "dimensionValues": [{ "value": "20240523" } ], "metricValues": [ { "value": "533" } ]},
        { "dimensionValues": [{ "value": "20240522" } ], "metricValues": [ { "value": "672" } ]},
        { "dimensionValues": [{ "value": "20240521" } ], "metricValues": [ { "value": "215" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 7:
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
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "616" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "819" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "19" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "670" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "330" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "639" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "842" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "506" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "161" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "877" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "604" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "413" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "663" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "896" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "12" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "751" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "98" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "238" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "217" } ]},
        { "dimensionValues": [{ "value": "20240601" } ], "metricValues": [ { "value": "47" } ]},
        { "dimensionValues": [{ "value": "20240531" } ], "metricValues": [ { "value": "949" } ]},
        { "dimensionValues": [{ "value": "20240530" } ], "metricValues": [ { "value": "412" } ]},
        { "dimensionValues": [{ "value": "20240529" } ], "metricValues": [ { "value": "17" } ]},
        { "dimensionValues": [{ "value": "20240528" } ], "metricValues": [ { "value": "772" } ]},
        { "dimensionValues": [{ "value": "20240527" } ], "metricValues": [ { "value": "425" } ]},
        { "dimensionValues": [{ "value": "20240526" } ], "metricValues": [ { "value": "243" } ]},
        { "dimensionValues": [{ "value": "20240525" } ], "metricValues": [ { "value": "237" } ]},
        { "dimensionValues": [{ "value": "20240524" } ], "metricValues": [ { "value": "634" } ]},
        { "dimensionValues": [{ "value": "20240523" } ], "metricValues": [ { "value": "506" } ]},
        { "dimensionValues": [{ "value": "20240522" } ], "metricValues": [ { "value": "5" } ]},
        { "dimensionValues": [{ "value": "20240521" } ], "metricValues": [ { "value": "781" } ]}
    ],
    "rowCount": 5,
    "metadata": {
        "currencyCode": "EUR",
        "timeZone": "Europe/Warsaw"
    },
    "kind": "analyticsData#runReport"
}
';
            case 8:
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
        { "dimensionValues": [{ "value": "20240620" } ], "metricValues": [ { "value": "39" } ]},
        { "dimensionValues": [{ "value": "20240619" } ], "metricValues": [ { "value": "762" } ]},
        { "dimensionValues": [{ "value": "20240618" } ], "metricValues": [ { "value": "89" } ]},
        { "dimensionValues": [{ "value": "20240617" } ], "metricValues": [ { "value": "254" } ]},
        { "dimensionValues": [{ "value": "20240616" } ], "metricValues": [ { "value": "264" } ]},
        { "dimensionValues": [{ "value": "20240615" } ], "metricValues": [ { "value": "493" } ]},
        { "dimensionValues": [{ "value": "20240614" } ], "metricValues": [ { "value": "270" } ]},
        { "dimensionValues": [{ "value": "20240613" } ], "metricValues": [ { "value": "466" } ]},
        { "dimensionValues": [{ "value": "20240612" } ], "metricValues": [ { "value": "891" } ]},
        { "dimensionValues": [{ "value": "20240611" } ], "metricValues": [ { "value": "527" } ]},
        { "dimensionValues": [{ "value": "20240610" } ], "metricValues": [ { "value": "753" } ]},
        { "dimensionValues": [{ "value": "20240609" } ], "metricValues": [ { "value": "555" } ]},
        { "dimensionValues": [{ "value": "20240608" } ], "metricValues": [ { "value": "461" } ]},
        { "dimensionValues": [{ "value": "20240607" } ], "metricValues": [ { "value": "349" } ]},
        { "dimensionValues": [{ "value": "20240606" } ], "metricValues": [ { "value": "13" } ]},
        { "dimensionValues": [{ "value": "20240605" } ], "metricValues": [ { "value": "979" } ]},
        { "dimensionValues": [{ "value": "20240604" } ], "metricValues": [ { "value": "919" } ]},
        { "dimensionValues": [{ "value": "20240603" } ], "metricValues": [ { "value": "102" } ]},
        { "dimensionValues": [{ "value": "20240602" } ], "metricValues": [ { "value": "134" } ]},
        { "dimensionValues": [{ "value": "20240601" } ], "metricValues": [ { "value": "107" } ]},
        { "dimensionValues": [{ "value": "20240531" } ], "metricValues": [ { "value": "361" } ]},
        { "dimensionValues": [{ "value": "20240530" } ], "metricValues": [ { "value": "411" } ]},
        { "dimensionValues": [{ "value": "20240529" } ], "metricValues": [ { "value": "797" } ]},
        { "dimensionValues": [{ "value": "20240528" } ], "metricValues": [ { "value": "689" } ]},
        { "dimensionValues": [{ "value": "20240527" } ], "metricValues": [ { "value": "789" } ]},
        { "dimensionValues": [{ "value": "20240526" } ], "metricValues": [ { "value": "905" } ]},
        { "dimensionValues": [{ "value": "20240525" } ], "metricValues": [ { "value": "236" } ]},
        { "dimensionValues": [{ "value": "20240524" } ], "metricValues": [ { "value": "57" } ]},
        { "dimensionValues": [{ "value": "20240523" } ], "metricValues": [ { "value": "68" } ]},
        { "dimensionValues": [{ "value": "20240522" } ], "metricValues": [ { "value": "756" } ]},
        { "dimensionValues": [{ "value": "20240521" } ], "metricValues": [ { "value": "556" } ]}
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
    public function getSuccessDay() : void {
        Http::fake([
            "https://analyticsdata.googleapis.com/v1beta/properties/123545:runReport" => Http::response($this->getResponse(5)),
            "https://analyticsdata.googleapis.com/v1beta/properties/12354775:runReport" => Http::response($this->getResponse(6)),
            "https://analyticsdata.googleapis.com/v1beta/properties/123547756:runReport" => Http::response($this->getResponse(7)),
            "https://analyticsdata.googleapis.com/v1beta/properties/287213359:runReport" => Http::response($this->getResponse(8)),
        ]);
    }
}
