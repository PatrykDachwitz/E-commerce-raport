<?php

dataset('analyticsResponse', function () {
    return ['{
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
  "rows": [
    {
      "dimensionValues": [
        {
          "value": "20240614"
        }
      ],
      "metricValues": [
        {
          "value": "2"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240613"
        }
      ],
      "metricValues": [
        {
          "value": "101"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240612"
        }
      ],
      "metricValues": [
        {
          "value": "1011"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240611"
        }
      ],
      "metricValues": [
        {
          "value": "10"
        }
      ]
    }
  ],
  "rowCount": 5,
  "metadata": {
    "currencyCode": "EUR",
    "timeZone": "Europe/Warsaw"
  },
  "kind": "analyticsData#runReport"
}
'];
});

dataset('analyticsResponseWithoutRows', function () {
    return ['{
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
  "rowCount": 5,
  "metadata": {
    "currencyCode": "EUR",
    "timeZone": "Europe/Warsaw"
  },
  "kind": "analyticsData#runReport"
}
'];
});

dataset('analyticsPolandReportDay', function () {
    return [
        '{
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
  "rows": [
    {
      "dimensionValues": [
        {
          "value": "20240620"
        }
      ],
      "metricValues": [
        {
          "value": "100"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240619"
        }
      ],
      "metricValues": [
        {
          "value": "100000"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240618"
        }
      ],
      "metricValues": [
        {
          "value": "11111"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240617"
        }
      ],
      "metricValues": [
        {
          "value": "9"
        }
      ]
    }
  ],
  "rowCount": 5,
  "metadata": {
    "currencyCode": "EUR",
    "timeZone": "Europe/Warsaw"
  },
  "kind": "analyticsData#runReport"
}
'
    ];
});

dataset('analyticsEnglandReportDay', function () {
    return [
        '{
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
  "rows": [
    {
      "dimensionValues": [
        {
          "value": "20240620"
        }
      ],
      "metricValues": [
        {
          "value": "123"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240619"
        }
      ],
      "metricValues": [
        {
          "value": "12"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240618"
        }
      ],
      "metricValues": [
        {
          "value": "15"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240617"
        }
      ],
      "metricValues": [
        {
          "value": "1900"
        }
      ]
    }
  ],
  "rowCount": 5,
  "metadata": {
    "currencyCode": "EUR",
    "timeZone": "Europe/Warsaw"
  },
  "kind": "analyticsData#runReport"
}
'
    ];
});
