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
dataset('analyticsResponseForWeek', function () {
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
          "value": "20240607"
        }
      ],
      "metricValues": [
        {
          "value": "421"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240608"
        }
      ],
      "metricValues": [
        {
          "value": "321"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240609"
        }
      ],
      "metricValues": [
        {
          "value": "523"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240614"
        }
      ],
      "metricValues": [
        {
          "value": "623"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240615"
        }
      ],
      "metricValues": [
        {
          "value": "532"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240616"
        }
      ],
      "metricValues": [
        {
          "value": "2542"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240621"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240622"
        }
      ],
      "metricValues": [
        {
          "value": "6234"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240623"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240628"
        }
      ],
      "metricValues": [
        {
          "value": "62364"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240629"
        }
      ],
      "metricValues": [
        {
          "value": "6423"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240630"
        }
      ],
      "metricValues": [
        {
          "value": "2364"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240705"
        }
      ],
      "metricValues": [
        {
          "value": "124"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240706"
        }
      ],
      "metricValues": [
        {
          "value": "432"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240707"
        }
      ],
      "metricValues": [
        {
          "value": "234"
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

dataset('analyticsResponseForWeekWithDeficitData', function () {
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
          "value": "20240606"
        }
      ],
      "metricValues": [
        {
          "value": "421"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240523"
        }
      ],
      "metricValues": [
        {
          "value": "421"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240604"
        }
      ],
      "metricValues": [
        {
          "value": "321"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240603"
        }
      ],
      "metricValues": [
        {
          "value": "523"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240614"
        }
      ],
      "metricValues": [
        {
          "value": "623"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240615"
        }
      ],
      "metricValues": [
        {
          "value": "532"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240616"
        }
      ],
      "metricValues": [
        {
          "value": "2542"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240621"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240624"
        }
      ],
      "metricValues": [
        {
          "value": "6234"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240623"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240628"
        }
      ],
      "metricValues": [
        {
          "value": "62364"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240629"
        }
      ],
      "metricValues": [
        {
          "value": "6423"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240630"
        }
      ],
      "metricValues": [
        {
          "value": "2364"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240705"
        }
      ],
      "metricValues": [
        {
          "value": "124"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240706"
        }
      ],
      "metricValues": [
        {
          "value": "432"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240707"
        }
      ],
      "metricValues": [
        {
          "value": "234"
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

dataset('analyticsResponseForWeekWithDeficitDataCurrentRange', function () {
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
          "value": "20240607"
        }
      ],
      "metricValues": [
        {
          "value": "421"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240608"
        }
      ],
      "metricValues": [
        {
          "value": "321"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240609"
        }
      ],
      "metricValues": [
        {
          "value": "523"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240614"
        }
      ],
      "metricValues": [
        {
          "value": "623"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240615"
        }
      ],
      "metricValues": [
        {
          "value": "532"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240616"
        }
      ],
      "metricValues": [
        {
          "value": "2542"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240621"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240622"
        }
      ],
      "metricValues": [
        {
          "value": "6234"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240623"
        }
      ],
      "metricValues": [
        {
          "value": "2346"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240628"
        }
      ],
      "metricValues": [
        {
          "value": "62364"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240629"
        }
      ],
      "metricValues": [
        {
          "value": "6423"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240630"
        }
      ],
      "metricValues": [
        {
          "value": "2364"
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
