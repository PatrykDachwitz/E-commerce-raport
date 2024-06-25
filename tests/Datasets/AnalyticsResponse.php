<?php

dataset('analyticsResponse', function () {
    return ['{
  "dimensionHeaders": [
    {
      "name": "date"
    },
    {
      "name": "eventName"
    }
  ],
  "metricHeaders": [
    {
      "name": "eventCount",
      "type": "TYPE_INTEGER"
    }
  ],
  "rows": [
    {
      "dimensionValues": [
        {
          "value": "20240614"
        },
        {
          "value": "page_view"
        }
      ],
      "metricValues": [
        {
          "value": "266"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240612"
        },
        {
          "value": "page_view"
        }
      ],
      "metricValues": [
        {
          "value": "78"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240613"
        },
        {
          "value": "page_view"
        }
      ],
      "metricValues": [
        {
          "value": "78"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240614"
        },
        {
          "value": "add_to_cart"
        }
      ],
      "metricValues": [
        {
          "value": "8"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240614"
        },
        {
          "value": "click"
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
          "value": "20240614"
        },
        {
          "value": "purchase"
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
        },
        {
          "value": "add_to_cart"
        }
      ],
      "metricValues": [
        {
          "value": "1"
        }
      ]
    },
    {
      "dimensionValues": [
        {
          "value": "20240613"
        },
        {
          "value": "click"
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
        },
        {
          "value": "click"
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
        },
        {
          "value": "click"
        }
      ],
      "metricValues": [
        {
          "value": "10"
        }
      ]
    }
  ],
  "rowCount": 23,
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
    },
    {
      "name": "eventName"
    }
  ],
  "metricHeaders": [
    {
      "name": "eventCount",
      "type": "TYPE_INTEGER"
    }
  ],
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
            },
            {
              "name": "eventName"
            }
          ],
          "metricHeaders": [
            {
              "name": "eventCount",
              "type": "TYPE_INTEGER"
            }
          ],
          "rows": [
            {
              "dimensionValues": [
                {
                  "value": "20240620"
                },
                {
                  "value": "click"
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
                },
                {
                  "value": "click"
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
                },
                {
                  "value": "click"
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
                },
                {
                  "value": "click"
                }
              ],
              "metricValues": [
                {
                  "value": "9"
                }
              ]
            }
          ],
          "rowCount": 23,
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
    },
    {
      "name": "eventName"
    }
  ],
  "metricHeaders": [
    {
      "name": "eventCount",
      "type": "TYPE_INTEGER"
    }
  ],
  "rows": [
    {
      "dimensionValues": [
        {
          "value": "20240620"
        },
        {
          "value": "click"
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
        },
        {
          "value": "click"
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
        },
        {
          "value": "click"
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
        },
        {
          "value": "click"
        }
      ],
      "metricValues": [
        {
          "value": "1900"
        }
      ]
    }
  ],
  "rowCount": 23,
  "metadata": {
    "currencyCode": "EUR",
    "timeZone": "Europe/Warsaw"
  },
  "kind": "analyticsData#runReport"
}
'
    ];
});
