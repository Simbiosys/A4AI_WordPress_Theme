(function() {
  var getPath, getScreenWidth, internetDisparity, isSmall, renderCharts, serie1, serie2, serie3, serie4, serie5, serie6, serie7, serie8, serie9, serie10, serie11;

  getScreenWidth = function() {
    return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
  };

  isSmall = function() {
    return getScreenWidth() < 780;
  };

  /* 2014 Charts */

  serie1 = {
    container: "#affordability-index-chart",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 1), 10, (isSmall() ? 5 : 1)],
    xAxis: {
      title: "2014 Affordability Index scores",
      margin: 10,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of mobile broadband, prepaid hand-set based (500MB)",
      "font-size": "8pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "Sources: A4AI, ITU",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [
      {
        name: "First",
        values: [
          [
            51.4432640075684, 2.7, {
              "iso3": "ARG",
              "ITUS": 2.7,
              "type": "EMERGING",
              "name": "Argentina",
              "affordability": 51.4432640075684
            }
          ], [
            37.1354675292969, 16.8, {
              "iso3": "BGD",
              "ITUS": 16.8,
              "type": "DEVELOPING",
              "name": "Bangladesh",
              "affordability": 37.1354675292969
            }
          ], [
            42.5473709106445, 9, {
              "iso3": "BWA",
              "ITUS": 9,
              "type": "EMERGING",
              "name": "Botswana",
              "affordability": 42.5473709106445
            }
          ], [
            57.1397857666016, 4, {
              "iso3": "BRA",
              "ITUS": 4,
              "type": "EMERGING",
              "name": "Brazil",
              "affordability": 57.1397857666016
            }
          ], [
            42.872932434082, 3.8, {
              "iso3": "CHN",
              "ITUS": 3.8,
              "type": "EMERGING",
              "name": "China",
              "affordability": 42.872932434082
            }
          ], [
            62.576416015625, 5.8, {
              "iso3": "COL",
              "ITUS": 5.8,
              "type": "EMERGING",
              "name": "Colombia",
              "affordability": 62.576416015625
            }
          ], [
            62.815357208252, 2.8, {
              "iso3": "CRI",
              "ITUS": 2.8,
              "type": "EMERGING",
              "name": "Costa Rica",
              "affordability": 62.815357208252
            }
          ], [
            44.1999206542969, 26.1, {
              "iso3": "DOM",
              "ITUS": 26.1,
              "type": "EMERGING",
              "name": "Dominican Republic",
              "affordability": 44.1999206542969
            }
          ], [
            51.9889640808106, 6.3, {
              "iso3": "ECU",
              "ITUS": 6.3,
              "type": "EMERGING",
              "name": "Ecuador",
              "affordability": 51.9889640808106
            }
          ], [
            38.1091079711914, 3.9, {
              "iso3": "EGY",
              "ITUS": 3.9,
              "type": "DEVELOPING",
              "name": "Egypt",
              "affordability": 38.1091079711914
            }
          ], [
            13.9589700698853, 0.811914893617021, {
              "iso3": "ETH",
              "ITUS": 0.811914893617021,
              "type": "DEVELOPING",
              "name": "Ethiopia",
              "affordability": 13.9589700698853
            }
          ], [
            41.4240455627441, 9, {
              "iso3": "GHA",
              "ITUS": 9,
              "type": "DEVELOPING",
              "name": "Ghana",
              "affordability": 41.4240455627441
            }
          ], [
            13.3221940994263, 16.9, {
              "iso3": "HTI",
              "ITUS": 16.9,
              "type": "DEVELOPING",
              "name": "Haiti",
              "affordability": 13.3221940994263
            }
          ], [
            39.0794258117676, 2.9, {
              "iso3": "IND",
              "ITUS": 2.9,
              "type": "DEVELOPING",
              "name": "India",
              "affordability": 39.0794258117676
            }
          ], [
            40.707275390625, 2.3, {
              "iso3": "IDN",
              "ITUS": 2.3,
              "type": "DEVELOPING",
              "name": "Indonesia",
              "affordability": 40.707275390625
            }
          ], [
            47.0530166625977, 4.9, {
              "iso3": "JAM",
              "ITUS": 4.9,
              "type": "EMERGING",
              "name": "Jamaica",
              "affordability": 47.0530166625977
            }
          ], [
            33.6228103637695, 2.3, {
              "iso3": "JOR",
              "ITUS": 2.3,
              "type": "EMERGING",
              "name": "Jordan",
              "affordability": 33.6228103637695
            }
          ], [
            36.3558578491211, 1, {
              "iso3": "KAZ",
              "ITUS": 1,
              "type": "EMERGING",
              "name": "Kazakhstan",
              "affordability": 36.3558578491211
            }
          ], [
            43.8111724853516, 8.2, {
              "iso3": "KEN",
              "ITUS": 8.2,
              "type": "DEVELOPING",
              "name": "Kenya",
              "affordability": 43.8111724853516
            }
          ], [
            19.5261764526367, 45.1, {
              "iso3": "MWI",
              "ITUS": 45.1,
              "type": "DEVELOPING",
              "name": "Malawi",
              "affordability": 19.5261764526367
            }
          ], [
            61.0045318603516, 0.0178846153846154, {
              "iso3": "MYS",
              "ITUS": 0.0178846153846154,
              "type": "EMERGING",
              "name": "Malaysia",
              "affordability": 61.0045318603516
            }
          ], [
            31.4916152954102, 19.6, {
              "iso3": "MLI",
              "ITUS": 19.6,
              "type": "DEVELOPING",
              "name": "Mali",
              "affordability": 31.4916152954102
            }
          ], [
            56.7538871765137, 1.8, {
              "iso3": "MUS",
              "ITUS": 1.8,
              "type": "EMERGING",
              "name": "Mauritius",
              "affordability": 56.7538871765137
            }
          ], [
            48.2403259277344, 2.5, {
              "iso3": "MEX",
              "ITUS": 2.5,
              "type": "EMERGING",
              "name": "Mexico",
              "affordability": 48.2403259277344
            }
          ], [
            50.5414123535156, 20, {
              "iso3": "MAR",
              "ITUS": 20,
              "type": "DEVELOPING",
              "name": "Morocco",
              "affordability": 50.5414123535156
            }
          ], [
            30.5827445983887, 65.9, {
              "iso3": "MOZ",
              "ITUS": 65.9,
              "type": "DEVELOPING",
              "name": "Mozambique",
              "affordability": 30.5827445983887
            }
          ], [
            38.1872711181641, 8.8, {
              "iso3": "NAM",
              "ITUS": 8.8,
              "type": "EMERGING",
              "name": "Namibia",
              "affordability": 38.1872711181641
            }
          ], [
            25.0163173675537, 0.420821917808219, {
              "iso3": "NPL",
              "ITUS": 0.420821917808219,
              "type": "DEVELOPING",
              "name": "Nepal",
              "affordability": 25.0163173675537
            }
          ], [
            50.9437713623047, 13, {
              "iso3": "NGA",
              "ITUS": 13,
              "type": "DEVELOPING",
              "name": "Nigeria",
              "affordability": 50.9437713623047
            }
          ], [
            42.4568786621094, 3.1, {
              "iso3": "PAK",
              "ITUS": 3.1,
              "type": "DEVELOPING",
              "name": "Pakistan",
              "affordability": 42.4568786621094
            }
          ], [
            59.111026763916, 3.2, {
              "iso3": "PER",
              "ITUS": 3.2,
              "type": "EMERGING",
              "name": "Peru",
              "affordability": 59.111026763916
            }
          ], [
            39.6114959716797, 6.3, {
              "iso3": "PHL",
              "ITUS": 6.3,
              "type": "DEVELOPING",
              "name": "Philippines",
              "affordability": 39.6114959716797
            }
          ], [
            51.3382339477539, 17.5, {
              "iso3": "RWA",
              "ITUS": 17.5,
              "type": "DEVELOPING",
              "name": "Rwanda",
              "affordability": 51.3382339477539
            }
          ], [
            32.2092666625977, 35.7, {
              "iso3": "SEN",
              "ITUS": 35.7,
              "type": "DEVELOPING",
              "name": "Senegal",
              "affordability": 32.2092666625977
            }
          ], [
            13.7271194458008, 109.1, {
              "iso3": "SLE",
              "ITUS": 109.1,
              "type": "DEVELOPING",
              "name": "Sierra Leone",
              "affordability": 13.7271194458008
            }
          ], [
            43.3131408691406, 3.8, {
              "iso3": "ZAF",
              "ITUS": 3.8,
              "type": "EMERGING",
              "name": "South Africa",
              "affordability": 43.3131408691406
            }
          ], [
            49.5743942260742, 0.0263687150837989, {
              "iso3": "THA",
              "ITUS": 0.0263687150837989,
              "type": "EMERGING",
              "name": "Thailand",
              "affordability": 49.5743942260742
            }
          ], [
            44.9300498962402, 1, {
              "iso3": "TUN",
              "ITUS": 1,
              "type": "EMERGING",
              "name": "Tunisia",
              "affordability": 44.9300498962402
            }
          ], [
            61.888053894043, 2, {
              "iso3": "TUR",
              "ITUS": 2,
              "type": "EMERGING",
              "name": "Turkey",
              "affordability": 61.888053894043
            }
          ], [
            47.7720489501953, 23.3, {
              "iso3": "UGA",
              "ITUS": 23.3,
              "type": "DEVELOPING",
              "name": "Uganda",
              "affordability": 47.7720489501953
            }
          ], [
            40.6727485656738, 11.3, {
              "iso3": "TZA",
              "ITUS": 11.3,
              "type": "DEVELOPING",
              "name": "United Republic Of Tanzania",
              "affordability": 40.6727485656738
            }
          ], [
            33.8526840209961, 1.4, {
              "iso3": "VEN",
              "ITUS": 1.4,
              "type": "EMERGING",
              "name": "Venezuela (Bolivarian Republic Of)",
              "affordability": 33.8526840209961
            }
          ], [
            43.1876373291016, 2, {
              "iso3": "VNM",
              "ITUS": 2,
              "type": "DEVELOPING",
              "name": "Viet Nam",
              "affordability": 43.1876373291016
            }
          ], [
            0.802389204502106, 26.2, {
              "iso3": "YEM",
              "ITUS": 26.2,
              "type": "DEVELOPING",
              "name": "Yemen",
              "affordability": 0.802389204502106
            }
          ], [
            36.4380416870117, 22.3, {
              "iso3": "ZMB",
              "ITUS": 22.3,
              "type": "DEVELOPING",
              "name": "Zambia",
              "affordability": 36.4380416870117
            }
          ], [
            24.9548187255859, 101.3, {
              "iso3": "ZWE",
              "ITUS": 101.3,
              "type": "DEVELOPING",
              "name": "Zimbabwe",
              "affordability": 24.9548187255859
            }
          ]
        ]
      }
    ],
    events: {
      "onmouseover": function(info) {
        var ITUS, affordability, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        affordability = parseFloat(info["data-affordability"]).toFixed(2);
        ITUS = parseFloat(info["data-ITUS"]).toFixed(2);
        text = "<div class='chart-tooltip'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Score: </span><span class='value'>" + affordability + "</span>";
        text += "<span class='text'>Broadband price: </span><span class='value'>" + ITUS + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie2 = {
    container: "#itus-cluster-chart",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 1), 10, (isSmall() ? 5 : 1)],
    xAxis: {
      title: "Effective Broadband Strategies",
      margin: 10,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of mobile broadband, prepaid hand-set based (500MB)",
      "font-size": "8pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "Sources: A4AI, ITU",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [
      {
        name: "First",
        values: [
          [
            7.33333333333333, 2.7, {
              "cluster2": 7.33333333333333,
              "iso3": "ARG",
              "type": "EMERGING",
              "name": "Argentina",
              "ITUS": 2.7
            }
          ], [
            4.66666666666667, 16.8, {
              "cluster2": 4.66666666666667,
              "iso3": "BGD",
              "type": "DEVELOPING",
              "name": "Bangladesh",
              "ITUS": 16.8
            }
          ], [
            5.5, 9, {
              "cluster2": 5.5,
              "iso3": "BWA",
              "type": "EMERGING",
              "name": "Botswana",
              "ITUS": 9
            }
          ], [
            5.16666666666667, 4, {
              "cluster2": 5.16666666666667,
              "iso3": "BRA",
              "type": "EMERGING",
              "name": "Brazil",
              "ITUS": 4
            }
          ], [
            5.5, 3.8, {
              "cluster2": 5.5,
              "iso3": "CHN",
              "type": "EMERGING",
              "name": "China",
              "ITUS": 3.8
            }
          ], [
            7.66666666666667, 5.8, {
              "cluster2": 7.66666666666667,
              "iso3": "COL",
              "type": "EMERGING",
              "name": "Colombia",
              "ITUS": 5.8
            }
          ], [
            7.16666666666667, 2.8, {
              "cluster2": 7.16666666666667,
              "iso3": "CRI",
              "type": "EMERGING",
              "name": "Costa Rica",
              "ITUS": 2.8
            }
          ], [
            5, 26.1, {
              "cluster2": 5,
              "iso3": "DOM",
              "type": "EMERGING",
              "name": "Dominican Republic",
              "ITUS": 26.1
            }
          ], [
            5.5, 6.3, {
              "cluster2": 5.5,
              "iso3": "ECU",
              "type": "EMERGING",
              "name": "Ecuador",
              "ITUS": 6.3
            }
          ], [
            5.75, 3.9, {
              "cluster2": 5.75,
              "iso3": "EGY",
              "type": "DEVELOPING",
              "name": "Egypt",
              "ITUS": 3.9
            }
          ], [
            3.5, 0.811914893617021, {
              "cluster2": 3.5,
              "iso3": "ETH",
              "type": "DEVELOPING",
              "name": "Ethiopia",
              "ITUS": 0.811914893617021
            }
          ], [
            4.33333333333333, 9, {
              "cluster2": 4.33333333333333,
              "iso3": "GHA",
              "type": "DEVELOPING",
              "name": "Ghana",
              "ITUS": 9
            }
          ], [
            0.5, 16.9, {
              "cluster2": 0.5,
              "iso3": "HTI",
              "type": "DEVELOPING",
              "name": "Haiti",
              "ITUS": 16.9
            }
          ], [
            4.83333333333333, 2.9, {
              "cluster2": 4.83333333333333,
              "iso3": "IND",
              "type": "DEVELOPING",
              "name": "India",
              "ITUS": 2.9
            }
          ], [
            4.5, 2.3, {
              "cluster2": 4.5,
              "iso3": "IDN",
              "type": "DEVELOPING",
              "name": "Indonesia",
              "ITUS": 2.3
            }
          ], [
            4.75, 4.9, {
              "cluster2": 4.75,
              "iso3": "JAM",
              "type": "EMERGING",
              "name": "Jamaica",
              "ITUS": 4.9
            }
          ], [
            4, 2.3, {
              "cluster2": 4,
              "iso3": "JOR",
              "type": "EMERGING",
              "name": "Jordan",
              "ITUS": 2.3
            }
          ], [
            5.5, 1, {
              "cluster2": 5.5,
              "iso3": "KAZ",
              "type": "EMERGING",
              "name": "Kazakhstan",
              "ITUS": 1
            }
          ], [
            5.33333333333333, 8.2, {
              "cluster2": 5.33333333333333,
              "iso3": "KEN",
              "type": "DEVELOPING",
              "name": "Kenya",
              "ITUS": 8.2
            }
          ], [
            0.75, 45.1, {
              "cluster2": 0.75,
              "iso3": "MWI",
              "type": "DEVELOPING",
              "name": "Malawi",
              "ITUS": 45.1
            }
          ], [
            7.5, 0.0178846153846154, {
              "cluster2": 7.5,
              "iso3": "MYS",
              "type": "EMERGING",
              "name": "Malaysia",
              "ITUS": 0.0178846153846154
            }
          ], [
            3.5, 19.6, {
              "cluster2": 3.5,
              "iso3": "MLI",
              "type": "DEVELOPING",
              "name": "Mali",
              "ITUS": 19.6
            }
          ], [
            6, 1.8, {
              "cluster2": 6,
              "iso3": "MUS",
              "type": "EMERGING",
              "name": "Mauritius",
              "ITUS": 1.8
            }
          ], [
            5.5, 2.5, {
              "cluster2": 5.5,
              "iso3": "MEX",
              "type": "EMERGING",
              "name": "Mexico",
              "ITUS": 2.5
            }
          ], [
            4.66666666666667, 20, {
              "cluster2": 4.66666666666667,
              "iso3": "MAR",
              "type": "DEVELOPING",
              "name": "Morocco",
              "ITUS": 20
            }
          ], [
            4.75, 65.9, {
              "cluster2": 4.75,
              "iso3": "MOZ",
              "type": "DEVELOPING",
              "name": "Mozambique",
              "ITUS": 65.9
            }
          ], [
            2.75, 8.8, {
              "cluster2": 2.75,
              "iso3": "NAM",
              "type": "EMERGING",
              "name": "Namibia",
              "ITUS": 8.8
            }
          ], [
            4, 0.420821917808219, {
              "cluster2": 4,
              "iso3": "NPL",
              "type": "DEVELOPING",
              "name": "Nepal",
              "ITUS": 0.420821917808219
            }
          ], [
            6, 13, {
              "cluster2": 6,
              "iso3": "NGA",
              "type": "DEVELOPING",
              "name": "Nigeria",
              "ITUS": 13
            }
          ], [
            3.66666666666667, 3.1, {
              "cluster2": 3.66666666666667,
              "iso3": "PAK",
              "type": "DEVELOPING",
              "name": "Pakistan",
              "ITUS": 3.1
            }
          ], [
            7.5, 3.2, {
              "cluster2": 7.5,
              "iso3": "PER",
              "type": "EMERGING",
              "name": "Peru",
              "ITUS": 3.2
            }
          ], [
            4.5, 6.3, {
              "cluster2": 4.5,
              "iso3": "PHL",
              "type": "DEVELOPING",
              "name": "Philippines",
              "ITUS": 6.3
            }
          ], [
            7.5, 17.5, {
              "cluster2": 7.5,
              "iso3": "RWA",
              "type": "DEVELOPING",
              "name": "Rwanda",
              "ITUS": 17.5
            }
          ], [
            2.33333333333333, 35.7, {
              "cluster2": 2.33333333333333,
              "iso3": "SEN",
              "type": "DEVELOPING",
              "name": "Senegal",
              "ITUS": 35.7
            }
          ], [
            3.83333333333333, 109.1, {
              "cluster2": 3.83333333333333,
              "iso3": "SLE",
              "type": "DEVELOPING",
              "name": "Sierra Leone",
              "ITUS": 109.1
            }
          ], [
            4.75, 3.8, {
              "cluster2": 4.75,
              "iso3": "ZAF",
              "type": "EMERGING",
              "name": "South Africa",
              "ITUS": 3.8
            }
          ], [
            4.83333333333333, 0.0263687150837989, {
              "cluster2": 4.83333333333333,
              "iso3": "THA",
              "type": "EMERGING",
              "name": "Thailand",
              "ITUS": 0.0263687150837989
            }
          ], [
            3.83333333333333, 1, {
              "cluster2": 3.83333333333333,
              "iso3": "TUN",
              "type": "EMERGING",
              "name": "Tunisia",
              "ITUS": 1
            }
          ], [
            6.75, 2, {
              "cluster2": 6.75,
              "iso3": "TUR",
              "type": "EMERGING",
              "name": "Turkey",
              "ITUS": 2
            }
          ], [
            6.33333333333333, 23.3, {
              "cluster2": 6.33333333333333,
              "iso3": "UGA",
              "type": "DEVELOPING",
              "name": "Uganda",
              "ITUS": 23.3
            }
          ], [
            4.5, 11.3, {
              "cluster2": 4.5,
              "iso3": "TZA",
              "type": "DEVELOPING",
              "name": "United Republic Of Tanzania",
              "ITUS": 11.3
            }
          ], [
            4.16666666666667, 1.4, {
              "cluster2": 4.16666666666667,
              "iso3": "VEN",
              "type": "EMERGING",
              "name": "Venezuela (Bolivarian Republic Of)",
              "ITUS": 1.4
            }
          ], [
            4.33333333333333, 2, {
              "cluster2": 4.33333333333333,
              "iso3": "VNM",
              "type": "DEVELOPING",
              "name": "Viet Nam",
              "ITUS": 2
            }
          ], [
            1.5, 26.2, {
              "cluster2": 1.5,
              "iso3": "YEM",
              "type": "DEVELOPING",
              "name": "Yemen",
              "ITUS": 26.2
            }
          ], [
            3.75, 22.3, {
              "cluster2": 3.75,
              "iso3": "ZMB",
              "type": "DEVELOPING",
              "name": "Zambia",
              "ITUS": 22.3
            }
          ], [
            2.25, 101.3, {
              "cluster2": 2.25,
              "iso3": "ZWE",
              "type": "DEVELOPING",
              "name": "Zimbabwe",
              "ITUS": 101.3
            }
          ]
        ]
      }
    ],
    events: {
      "onmouseover": function(info) {
        var ITUS, cluster2, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        cluster2 = parseFloat(info["data-cluster2"]).toFixed(2);
        ITUS = parseFloat(info["data-ITUS"]).toFixed(2);
        text = "<div class='chart-tooltip'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Broadband strategy: </span><span class='value'>" + cluster2 + "</span>";
        text += "<span class='text'>Broadband price: </span><span class='value'>" + ITUS + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie3 = {
    container: "#itus-ieaa-chart",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 1), 10, (isSmall() ? 5 : 1)],
    xAxis: {
      title: "Rate of electrification",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of mobile broadband, prepaid hand-set based (500MB)",
      "font-size": "8pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "Sources: ITU, International Energy Agency",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [
      {
        name: "First",
        values: [
          [
            97.2, 2.7, {
              "IEAA": 97.2,
              "iso3": "ARG",
              "type": "EMERGING",
              "name": "Argentina",
              "ITUS": 2.7
            }
          ], [
            59.6, 16.8, {
              "IEAA": 59.6,
              "iso3": "BGD",
              "type": "DEVELOPING",
              "name": "Bangladesh",
              "ITUS": 16.8
            }
          ], [
            45.7, 9, {
              "IEAA": 45.7,
              "iso3": "BWA",
              "type": "EMERGING",
              "name": "Botswana",
              "ITUS": 9
            }
          ], [
            99.3, 4, {
              "IEAA": 99.3,
              "iso3": "BRA",
              "type": "EMERGING",
              "name": "Brazil",
              "ITUS": 4
            }
          ], [
            99.8, 3.8, {
              "IEAA": 99.8,
              "iso3": "CHN",
              "type": "EMERGING",
              "name": "China",
              "ITUS": 3.8
            }
          ], [
            97.4, 5.8, {
              "IEAA": 97.4,
              "iso3": "COL",
              "type": "EMERGING",
              "name": "Colombia",
              "ITUS": 5.8
            }
          ], [
            99.1, 2.8, {
              "IEAA": 99.1,
              "iso3": "CRI",
              "type": "EMERGING",
              "name": "Costa Rica",
              "ITUS": 2.8
            }
          ], [
            96.1, 26.1, {
              "IEAA": 96.1,
              "iso3": "DOM",
              "type": "EMERGING",
              "name": "Dominican Republic",
              "ITUS": 26.1
            }
          ], [
            95.5, 6.3, {
              "IEAA": 95.5,
              "iso3": "ECU",
              "type": "EMERGING",
              "name": "Ecuador",
              "ITUS": 6.3
            }
          ], [
            99.6, 3.9, {
              "IEAA": 99.6,
              "iso3": "EGY",
              "type": "DEVELOPING",
              "name": "Egypt",
              "ITUS": 3.9
            }
          ], [
            23.3, 0.811914893617021, {
              "IEAA": 23.3,
              "iso3": "ETH",
              "type": "DEVELOPING",
              "name": "Ethiopia",
              "ITUS": 0.811914893617021
            }
          ], [
            72, 9, {
              "IEAA": 72,
              "iso3": "GHA",
              "type": "DEVELOPING",
              "name": "Ghana",
              "ITUS": 9
            }
          ], [
            27.9, 16.9, {
              "IEAA": 27.9,
              "iso3": "HTI",
              "type": "DEVELOPING",
              "name": "Haiti",
              "ITUS": 16.9
            }
          ], [
            75.3, 2.9, {
              "IEAA": 75.3,
              "iso3": "IND",
              "type": "DEVELOPING",
              "name": "India",
              "ITUS": 2.9
            }
          ], [
            72.9, 2.3, {
              "IEAA": 72.9,
              "iso3": "IDN",
              "type": "DEVELOPING",
              "name": "Indonesia",
              "ITUS": 2.3
            }
          ], [
            92.8, 4.9, {
              "IEAA": 92.8,
              "iso3": "JAM",
              "type": "EMERGING",
              "name": "Jamaica",
              "ITUS": 4.9
            }
          ], [
            99.4, 2.3, {
              "IEAA": 99.4,
              "iso3": "JOR",
              "type": "EMERGING",
              "name": "Jordan",
              "ITUS": 2.3
            }
          ], [
            19.2, 8.2, {
              "IEAA": 19.2,
              "iso3": "KEN",
              "type": "DEVELOPING",
              "name": "Kenya",
              "ITUS": 8.2
            }
          ], [
            7, 45.1, {
              "IEAA": 7,
              "iso3": "MWI",
              "type": "DEVELOPING",
              "name": "Malawi",
              "ITUS": 45.1
            }
          ], [
            99.5, 0.0178846153846154, {
              "IEAA": 99.5,
              "iso3": "MYS",
              "type": "EMERGING",
              "name": "Malaysia",
              "ITUS": 0.0178846153846154
            }
          ], [
            99.4, 1.8, {
              "IEAA": 99.4,
              "iso3": "MUS",
              "type": "EMERGING",
              "name": "Mauritius",
              "ITUS": 1.8
            }
          ], [
            98.9, 20, {
              "IEAA": 98.9,
              "iso3": "MAR",
              "type": "DEVELOPING",
              "name": "Morocco",
              "ITUS": 20
            }
          ], [
            20.2, 65.9, {
              "IEAA": 20.2,
              "iso3": "MOZ",
              "type": "DEVELOPING",
              "name": "Mozambique",
              "ITUS": 65.9
            }
          ], [
            60, 8.8, {
              "IEAA": 60,
              "iso3": "NAM",
              "type": "EMERGING",
              "name": "Namibia",
              "ITUS": 8.8
            }
          ], [
            76.3, 0.420821917808219, {
              "IEAA": 76.3,
              "iso3": "NPL",
              "type": "DEVELOPING",
              "name": "Nepal",
              "ITUS": 0.420821917808219
            }
          ], [
            48, 13, {
              "IEAA": 48,
              "iso3": "NGA",
              "type": "DEVELOPING",
              "name": "Nigeria",
              "ITUS": 13
            }
          ], [
            68.6, 3.1, {
              "IEAA": 68.6,
              "iso3": "PAK",
              "type": "DEVELOPING",
              "name": "Pakistan",
              "ITUS": 3.1
            }
          ], [
            89.7, 3.2, {
              "IEAA": 89.7,
              "iso3": "PER",
              "type": "EMERGING",
              "name": "Peru",
              "ITUS": 3.2
            }
          ], [
            70.2, 6.3, {
              "IEAA": 70.2,
              "iso3": "PHL",
              "type": "DEVELOPING",
              "name": "Philippines",
              "ITUS": 6.3
            }
          ], [
            56.5, 35.7, {
              "IEAA": 56.5,
              "iso3": "SEN",
              "type": "DEVELOPING",
              "name": "Senegal",
              "ITUS": 35.7
            }
          ], [
            84.7, 3.8, {
              "IEAA": 84.7,
              "iso3": "ZAF",
              "type": "EMERGING",
              "name": "South Africa",
              "ITUS": 3.8
            }
          ], [
            99, 0.0263687150837989, {
              "IEAA": 99,
              "iso3": "THA",
              "type": "EMERGING",
              "name": "Thailand",
              "ITUS": 0.0263687150837989
            }
          ], [
            99.5, 1, {
              "IEAA": 99.5,
              "iso3": "TUN",
              "type": "EMERGING",
              "name": "Tunisia",
              "ITUS": 1
            }
          ], [
            14.6, 23.3, {
              "IEAA": 14.6,
              "iso3": "UGA",
              "type": "DEVELOPING",
              "name": "Uganda",
              "ITUS": 23.3
            }
          ], [
            15, 11.3, {
              "IEAA": 15,
              "iso3": "TZA",
              "type": "DEVELOPING",
              "name": "United Republic Of Tanzania",
              "ITUS": 11.3
            }
          ], [
            99.6, 1.4, {
              "IEAA": 99.6,
              "iso3": "VEN",
              "type": "EMERGING",
              "name": "Venezuela (Bolivarian Republic Of)",
              "ITUS": 1.4
            }
          ], [
            96.1, 2, {
              "IEAA": 96.1,
              "iso3": "VNM",
              "type": "DEVELOPING",
              "name": "Viet Nam",
              "ITUS": 2
            }
          ], [
            39.9, 26.2, {
              "IEAA": 39.9,
              "iso3": "YEM",
              "type": "DEVELOPING",
              "name": "Yemen",
              "ITUS": 26.2
            }
          ], [
            22, 22.3, {
              "IEAA": 22,
              "iso3": "ZMB",
              "type": "DEVELOPING",
              "name": "Zambia",
              "ITUS": 22.3
            }
          ], [
            37.2, 101.3, {
              "IEAA": 37.2,
              "iso3": "ZWE",
              "type": "DEVELOPING",
              "name": "Zimbabwe",
              "ITUS": 101.3
            }
          ]
        ]
      }
    ],
    events: {
      "onmouseover": function(info) {
        var IEAA, ITUS, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        IEAA = parseFloat(info["data-IEAA"]).toFixed(2);
        ITUS = parseFloat(info["data-ITUS"]).toFixed(2);
        text = "<div class='chart-tooltip'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Electrification: </span><span class='value'>" + IEAA + "</span>";
        text += "<span class='text'>Broadband price: </span><span class='value'>" + ITUS + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  internetDisparity = {
    chartType: "bar",
    container: "#internet-disparity-chart",
    "title": "Internet Users: Urban vs Rural",
    "foot": "Source: Research ICT Africa Household Survey Data, 2012",
    serieColours: ["#DE645C", "#619EDE"],
    groupMargin: 20,
    xAxis: {
      values: ["Uganda", "Tanzania", "South Africa", "Rwanda", "Namibia", "Mozambique", "Ghana", "Ethiopia", "Cameroon", "Botswana"],
      title: "",
      "font-size": "8pt",
      rotation: isSmall() ? -90 : 0,
      margin: isSmall() ? 15 : 10
    },
    margins: [5, 10, 5, isSmall() ? 10 : 3],
    yAxis: {
      title: "% of Internet users",
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    nameUnderItem: {
      show: true
    },
    valueOnItem: {
      show: false
    },
    legend: {
      itemSize: isSmall() ? 2 : 0.5,
      margin: isSmall() ? 4 : 2
    },
    series: [
      {
        name: "Rural",
        values: [6.5, 1.7, 21.8, 14.7, 5.7, 3.2, 9.7, 1.3, 2.5, 19.3]
      }, {
        name: "Urban",
        values: [17.3, 8.5, 41.7, 3.5, 37.6, 26.1, 15.9, 9.2, 22.4, 35.1]
      }
    ],
    info: [
      {
        name: "Uganda",
        code: "UGA"
      }, {
        name: "Tanzania",
        code: "TZA"
      }, {
        name: "South Africa",
        code: "ZAF"
      }, {
        name: "Rwanda",
        code: "RWA"
      }, {
        name: "Namibia",
        code: "NAM"
      }, {
        name: "Mozambique",
        code: "MOZ"
      }, {
        name: "Ghana",
        code: "GHA"
      }, {
        name: "Ethiopia",
        code: "ETH"
      }, {
        name: "Cameroon",
        code: "CMR"
      }, {
        name: "Botswana",
        code: "BWA"
      }
    ],
    events: {
      "onmouseover": function(info) {
        var data, iso, name, pos, text;
        pos = info["serie_pos"];
        data = internetDisparity.info[pos];
        iso = data.code;
        name = data.name;
        text = "<div class='chart-tooltip'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>" + info.serie + "</span><span class='value'>" + info.value + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  /* 2015 Charts */

  serie4 = {
    container: "#adi-score-500mb-prepaid",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 2), 10, (isSmall() ? 5 : 2)],
    xAxis: {
      title: "ADI Score",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of mobile broadband (500MB) as % of GNI p.c. 2014",
      "font-size": "10pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "Source: ADI, Affordability Drivers Index",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [{"name":"First","values":[[39.127243,3.49,{"iso3":"BGD","name":"Bangladesh","type":"DEVELOPING","adi":39.127243,"gni":3.49}],[35.082836,12.3,{"iso3":"BEN","name":"Benin","type":"DEVELOPING","adi":35.082836,"gni":12.3}],[44.513584,5.17,{"iso3":"BWA","name":"Botswana","type":"EMERGING","adi":44.513584,"gni":5.17}],[59.901978,1.13,{"iso3":"BRA","name":"Brazil","type":"EMERGING","adi":59.901978,"gni":1.13}],[21.823935,24.3,{"iso3":"BFA","name":"Burkina Faso","type":"DEVELOPING","adi":21.823935,"gni":24.3}],[65.323624,3.24,{"iso3":"COL","name":"Colombia","type":"EMERGING","adi":65.323624,"gni":3.24}],[64.60334,1.03,{"iso3":"CRI","name":"Costa Rica","type":"EMERGING","adi":64.60334,"gni":1.03}],[47.228485,6.46,{"iso3":"DOM","name":"Dominican Republic","type":"EMERGING","adi":47.228485,"gni":6.46}],[50.600586,4.43,{"iso3":"ECU","name":"Ecuador","type":"EMERGING","adi":50.600586,"gni":4.43}],[39.550911,2.7,{"iso3":"EGY","name":"Egypt","type":"DEVELOPING","adi":39.550911,"gni":2.7}],[14.876361,16.92,{"iso3":"ETH","name":"Ethiopia","type":"DEVELOPING","adi":14.876361,"gni":16.92}],[45.818161,10.07,{"iso3":"GMB","name":"Gambia","type":"DEVELOPING","adi":45.818161,"gni":10.07}],[42.835323,4.48,{"iso3":"GHA","name":"Ghana","type":"DEVELOPING","adi":42.835323,"gni":4.48}],[13.363722,32.8,{"iso3":"HTI","name":"Haiti","type":"DEVELOPING","adi":13.363722,"gni":32.8}],[40.122658,2.48,{"iso3":"IND","name":"India","type":"DEVELOPING","adi":40.122658,"gni":2.48}],[42.186199,1.13,{"iso3":"IDN","name":"Indonesia","type":"DEVELOPING","adi":42.186199,"gni":1.13}],[50.842541,3.63,{"iso3":"JAM","name":"Jamaica","type":"EMERGING","adi":50.842541,"gni":3.63}],[34.355835,2.05,{"iso3":"JOR","name":"Jordan","type":"EMERGING","adi":34.355835,"gni":2.05}],[36.50333,0.57,{"iso3":"KAZ","name":"Kazakhstan","type":"EMERGING","adi":36.50333,"gni":0.57}],[45.484024,5.89,{"iso3":"KEN","name":"Kenya","type":"DEVELOPING","adi":45.484024,"gni":5.89}],[20.064375,24.4,{"iso3":"MWI","name":"Malawi","type":"DEVELOPING","adi":20.064375,"gni":24.4}],[63.275192,0.99,{"iso3":"MYS","name":"Malaysia","type":"EMERGING","adi":63.275192,"gni":0.99}],[36.53059,17.04,{"iso3":"MLI","name":"Mali","type":"DEVELOPING","adi":36.53059,"gni":17.04}],[55.200588,1.43,{"iso3":"MUS","name":"Mauritius","type":"EMERGING","adi":55.200588,"gni":1.43}],[53.849754,2.72,{"iso3":"MEX","name":"Mexico","type":"EMERGING","adi":53.849754,"gni":2.72}],[55.510883,4.73,{"iso3":"MAR","name":"Morocco","type":"DEVELOPING","adi":55.510883,"gni":4.73}],[28.08884,6.28,{"iso3":"MOZ","name":"Mozambique","type":"DEVELOPING","adi":28.08884,"gni":6.28}],[38.895412,2.62,{"iso3":"NAM","name":"Namibia","type":"EMERGING","adi":38.895412,"gni":2.62}],[29.482986,7.45,{"iso3":"NPL","name":"Nepal","type":"DEVELOPING","adi":29.482986,"gni":7.45}],[52.84967,5.4,{"iso3":"NGA","name":"Nigeria","type":"DEVELOPING","adi":52.84967,"gni":5.4}],[44.108837,1.31,{"iso3":"PAK","name":"Pakistan","type":"DEVELOPING","adi":44.108837,"gni":1.31}],[61.820961,2.02,{"iso3":"PER","name":"Peru","type":"EMERGING","adi":61.820961,"gni":2.02}],[42.244965,2.47,{"iso3":"PHL","name":"Philippines","type":"DEVELOPING","adi":42.244965,"gni":2.47}],[53.131405,14.02,{"iso3":"RWA","name":"Rwanda","type":"DEVELOPING","adi":53.131405,"gni":14.02}],[32.496628,11.57,{"iso3":"SEN","name":"Senegal","type":"DEVELOPING","adi":32.496628,"gni":11.57}],[46.442535,1.48,{"iso3":"ZAF","name":"South Africa","type":"EMERGING","adi":46.442535,"gni":1.48}],[41.928509,10.54,{"iso3":"TZA","name":"Tanzania","type":"DEVELOPING","adi":41.928509,"gni":10.54}],[52.386841,1.38,{"iso3":"THA","name":"Thailand","type":"EMERGING","adi":52.386841,"gni":1.38}],[46.825775,1.68,{"iso3":"TUN","name":"Tunisia","type":"EMERGING","adi":46.825775,"gni":1.68}],[62.34993,0.95,{"iso3":"TUR","name":"Turkey","type":"EMERGING","adi":62.34993,"gni":0.95}],[49.396973,15.4,{"iso3":"UGA","name":"Uganda","type":"DEVELOPING","adi":49.396973,"gni":15.4}],[34.423466,2.61,{"iso3":"VEN","name":"Venezuela","type":"EMERGING","adi":34.423466,"gni":2.61}],[44.365871,7.31,{"iso3":"VNM","name":"Vietnam","type":"DEVELOPING","adi":44.365871,"gni":7.31}],[37.76841,11.89,{"iso3":"ZMB","name":"Zambia","type":"DEVELOPING","adi":37.76841,"gni":11.89}],[25.827023,27.93,{"iso3":"ZWE","name":"Zimbabwe","type":"DEVELOPING","adi":25.827023,"gni":27.93}]]}],
    events: {
      "onmouseover": function(info) {
        var ADI, GNI, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        ADI = parseFloat(info["data-adi"]).toFixed(2);
        GNI = parseFloat(info["data-gni"]).toFixed(2);
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>ADI Score: </span><span class='value'>" + ADI + "</span>";
        text += "<span class='text'>Price of mobile broadband (500MB) as % of GNI p.c. 2014: </span><span class='value'>" + GNI + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie5 = {
    container: "#adi-score-1gb-postpaid",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 2), 10, (isSmall() ? 5 : 2)],
    xAxis: {
      title: "ADI Score",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of mobile broadband (1GB) as % of GNI p.c. 2014",
      "font-size": "10pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "Source: ADI, Affordability Drivers Index",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [{"name":"First","values":[[39.127243,5.28,{"iso3":"BGD","name":"Bangladesh","type":"DEVELOPING","adi":39.127243,"gni":5.28}],[35.082836,21.53,{"iso3":"BEN","name":"Benin","type":"DEVELOPING","adi":35.082836,"gni":21.53}],[44.513584,11.57,{"iso3":"BWA","name":"Botswana","type":"EMERGING","adi":44.513584,"gni":11.57}],[59.901978,2.31,{"iso3":"BRA","name":"Brazil","type":"EMERGING","adi":59.901978,"gni":2.31}],[21.823935,16.2,{"iso3":"BFA","name":"Burkina Faso","type":"DEVELOPING","adi":21.823935,"gni":16.2}],[25.969967,11.3,{"iso3":"CMR","name":"Cameroon","type":"DEVELOPING","adi":25.969967,"gni":11.3}],[44.73996,1.49,{"iso3":"CHN","name":"China","type":"EMERGING","adi":44.73996,"gni":1.49}],[65.323624,2.21,{"iso3":"COL","name":"Colombia","type":"EMERGING","adi":65.323624,"gni":2.21}],[64.60334,1.61,{"iso3":"CRI","name":"Costa Rica","type":"EMERGING","adi":64.60334,"gni":1.61}],[47.228485,3.7,{"iso3":"DOM","name":"Dominican Republic","type":"EMERGING","adi":47.228485,"gni":3.7}],[50.600586,4.44,{"iso3":"ECU","name":"Ecuador","type":"EMERGING","adi":50.600586,"gni":4.44}],[39.550911,1.55,{"iso3":"EGY","name":"Egypt","type":"DEVELOPING","adi":39.550911,"gni":1.55}],[14.876361,39.29,{"iso3":"ETH","name":"Ethiopia","type":"DEVELOPING","adi":14.876361,"gni":39.29}],[45.818161,143.92,{"iso3":"GMB","name":"Gambia","type":"DEVELOPING","adi":45.818161,"gni":143.92}],[42.835323,4.48,{"iso3":"GHA","name":"Ghana","type":"DEVELOPING","adi":42.835323,"gni":4.48}],[13.363722,32.8,{"iso3":"HTI","name":"Haiti","type":"DEVELOPING","adi":13.363722,"gni":32.8}],[40.122658,3.13,{"iso3":"IND","name":"India","type":"DEVELOPING","adi":40.122658,"gni":3.13}],[42.186199,1.56,{"iso3":"IDN","name":"Indonesia","type":"DEVELOPING","adi":42.186199,"gni":1.56}],[50.842541,5.19,{"iso3":"JAM","name":"Jamaica","type":"EMERGING","adi":50.842541,"gni":5.19}],[34.355835,3.42,{"iso3":"JOR","name":"Jordan","type":"EMERGING","adi":34.355835,"gni":3.42}],[36.50333,0.57,{"iso3":"KAZ","name":"Kazakhstan","type":"EMERGING","adi":36.50333,"gni":0.57}],[45.484024,11.78,{"iso3":"KEN","name":"Kenya","type":"DEVELOPING","adi":45.484024,"gni":11.78}],[20.064375,41.88,{"iso3":"MWI","name":"Malawi","type":"DEVELOPING","adi":20.064375,"gni":41.88}],[63.275192,1.69,{"iso3":"MYS","name":"Malaysia","type":"EMERGING","adi":63.275192,"gni":1.69}],[36.53059,27.2,{"iso3":"MLI","name":"Mali","type":"DEVELOPING","adi":36.53059,"gni":27.2}],[55.200588,0.82,{"iso3":"MUS","name":"Mauritius","type":"EMERGING","adi":55.200588,"gni":0.82}],[53.849754,2.26,{"iso3":"MEX","name":"Mexico","type":"EMERGING","adi":53.849754,"gni":2.26}],[55.510883,4.68,{"iso3":"MAR","name":"Morocco","type":"DEVELOPING","adi":55.510883,"gni":4.68}],[28.08884,13.13,{"iso3":"MOZ","name":"Mozambique","type":"DEVELOPING","adi":28.08884,"gni":13.13}],[38.895412,2.81,{"iso3":"NAM","name":"Namibia","type":"EMERGING","adi":38.895412,"gni":2.81}],[29.482986,13.05,{"iso3":"NPL","name":"Nepal","type":"DEVELOPING","adi":29.482986,"gni":13.05}],[52.84967,9.46,{"iso3":"NGA","name":"Nigeria","type":"DEVELOPING","adi":52.84967,"gni":9.46}],[44.108837,10.47,{"iso3":"PAK","name":"Pakistan","type":"DEVELOPING","adi":44.108837,"gni":10.47}],[61.820961,3.04,{"iso3":"PER","name":"Peru","type":"EMERGING","adi":61.820961,"gni":3.04}],[42.244965,8.27,{"iso3":"PHL","name":"Philippines","type":"DEVELOPING","adi":42.244965,"gni":8.27}],[53.131405,28.03,{"iso3":"RWA","name":"Rwanda","type":"DEVELOPING","adi":53.131405,"gni":28.03}],[13.698072,41.23,{"iso3":"SLE","name":"Sierra Leone","type":"DEVELOPING","adi":13.698072,"gni":41.23}],[46.442535,1.18,{"iso3":"ZAF","name":"South Africa","type":"EMERGING","adi":46.442535,"gni":1.18}],[41.928509,7.59,{"iso3":"TZA","name":"Tanzania","type":"DEVELOPING","adi":41.928509,"gni":7.59}],[52.386841,2.49,{"iso3":"THA","name":"Thailand","type":"EMERGING","adi":52.386841,"gni":2.49}],[46.825775,2.53,{"iso3":"TUN","name":"Tunisia","type":"EMERGING","adi":46.825775,"gni":2.53}],[62.34993,1,{"iso3":"TUR","name":"Turkey","type":"EMERGING","adi":62.34993,"gni":1}],[49.396973,28.88,{"iso3":"UGA","name":"Uganda","type":"DEVELOPING","adi":49.396973,"gni":28.88}],[34.423466,3.7,{"iso3":"VEN","name":"Venezuela","type":"EMERGING","adi":34.423466,"gni":3.7}],[44.365871,3.92,{"iso3":"VNM","name":"Vietnam","type":"DEVELOPING","adi":44.365871,"gni":3.92}],[37.76841,14.16,{"iso3":"ZMB","name":"Zambia","type":"DEVELOPING","adi":37.76841,"gni":14.16}],[25.827023,62.85,{"iso3":"ZWE","name":"Zimbabwe","type":"DEVELOPING","adi":25.827023,"gni":62.85}]]}],
    events: {
      "onmouseover": function(info) {
        var ADI, GNI, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        ADI = parseFloat(info["data-adi"]).toFixed(2);
        GNI = parseFloat(info["data-gni"]).toFixed(2);
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>ADI Score: </span><span class='value'>" + ADI + "</span>";
        text += "<span class='text'>Price of mobile broadband (1GB) as % of GNI p.c. 2014: </span><span class='value'>" + GNI + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie6 = {
    chartType: "bar",
    container: "#price-500mb-gni",
    "title": "",
    "foot": "",
    serieColours: ["#619EDE", "#DE645C", "#F5A52D"],
    groupMargin: 20,
    xAxis: {
      values: ["Africa", "CIS", "Asia and the Pacific", "Americas", "Arab States", "Europe"],
      title: "Region",
      "font-size": "10pt",
      rotation: isSmall() ? -90 : 0,
      margin: isSmall() ? 15 : 10
    },
    margins: [5, 10, 6, isSmall() ? 10 : 3],
    yAxis: {
      title: "Price of 500MB as a % of GNI per capita",
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    nameUnderItem: {
      show: true,
      "font-size": "7pt"
    },
    valueOnItem: {
      show: false
    },
    legend: {
      itemSize: isSmall() ? 2 : 0.5,
      margin: isSmall() ? 4 : 2
    },
    series: [
      {
        name: "2012",
        values: [38.8, 5.7, 5.9, 5.9, 5.7, 1.2]
      },
      {
        name: "2013",
        values: [15.3, 3.8, 5, 5.4, 4.8, 1.2]
      },
      {
        name: "2014",
        values: [15.2, 3.7, 4.28, 4.39, 5.22, 0.82]
      }
    ],
    events: {
      "onmouseover": function(info) {
        var data, iso, name, pos, text;
        pos = info["serie_pos"];
        text = "<div class='chart-tooltip chart-report'>";
        text += "<span class='area'>" + info.pos + "</span>";
        text += "<span class='text'>" + info.serie + "</span>";
        text += "<span class='text'>Price of 1GB as a % of GNI per capita:</span>";
        text += "<span class='value'>" + info.value + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie7 = {
    chartType: "bar",
    container: "#price-1gb-gni",
    "title": "",
    "foot": "",
    serieColours: ["#619EDE", "#DE645C", "#F5A52D"],
    groupMargin: 20,
    xAxis: {
      values: ["Africa", "CIS", "Asia and the Pacific", "Americas", "Arab States", "Europe"],
      title: "Region",
      "font-size": "10pt",
      rotation: isSmall() ? -90 : 0,
      margin: isSmall() ? 15 : 10
    },
    margins: [5, 10, 6, isSmall() ? 10 : 3],
    yAxis: {
      title: "Price of 1GB as a % of GNI per capita",
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    nameUnderItem: {
      show: true,
      "font-size": "7pt"
    },
    valueOnItem: {
      show: false
    },
    legend: {
      itemSize: isSmall() ? 2 : 0.5,
      margin: isSmall() ? 4 : 2
    },
    series: [
      {
        name: "2012",
        values: [54.6, 7.4, 10.6, 8, 2.5, 1.2]
      },
      {
        name: "2013",
        values: [23.3, 4.4, 9.3, 5.7, 5.9, 1.1]
      },
      {
        name: "2014",
        values: [30.33, 4.83, 7.53, 4.88, 7.93, 0.9]
      }
    ],
    events: {
      "onmouseover": function(info) {
        var data, iso, name, pos, text;
        pos = info["serie_pos"];
        text = "<div class='chart-tooltip chart-report'>";
        text += "<span class='area'>" + info.pos + "</span>";
        text += "<span class='text'>" + info.serie + "</span>";
        text += "<span class='text'>Price of 1GB as a % of GNI per capita:</span>";
        text += "<span class='value'>" + info.value + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie8 = {
    chartType: "line",
    container: "#average-clustered-policy-scores",
    "title": "",
    "foot": "",
    serieColours: ["#619EDE", "#B93734", "#F5A52D", "#99B954", "#DF01D7", "#666666"],
    groupMargin: 20,
    xAxis: {
      values: ["Competition policy", "Broadband policy", "Universal access", "Infrastructure sharing", "Spectrum policy"],
      title: "Region",
      "font-size": "10pt",
      rotation: isSmall() ? -90 : 0,
      margin: isSmall() ? 15 : 10
    },
    margins: [5, 10, 6, isSmall() ? 10 : 3],
    yAxis: {
      title: "Policy Scores",
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    nameUnderItem: {
      show: true,
      "font-size": "7pt"
    },
    valueOnItem: {
      show: false
    },
    legend: {
      itemSize: isSmall() ? 2 : 0.5,
      margin: isSmall() ? 4 : 2
    },
    stroke: {
      width: 3
    },
    series: [
      {
        name: "Colombia",
        values: [5.916666667, 7.666666667, 7.666666667,	6.166666667, 7.833333333]
      },
      {
        name: "Philippines",
        values: [5, 4.5, 2,	2.666666667, 4]
      },
      {
        name: "Benin",
        values: [4.75, 5, 3.833333333, 4.5, 4.5]
      },
      {
        name: "Jamaica",
        values: [4.666666667,	4.75, 5.666666667, 3.333333333,	6.5]
      },
      {
        name: "Thailand",
        values: [3.916666667,	4.833333333, 6.111111111,	4.333333333, 5.666666667]
      },
      {
        name: "Malawi",
        values: [3.75, 0.75, 1.833333333, 2, 1.75]
      }
    ],
    info: {
      "Colombia": "COL",
      "Philippines": "PHL",
      "Benin": "BEN",
      "Jamaica": "JAM",
      "Thailand": "THA",
      "Malawi": "MWI"
    },
    events: {
      "onmouseover": function(info) {
        var data, iso, name, pos, text;
        pos = info["serie_pos"];
        iso = serie8.info[info.serie]
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + info.serie + "</span>";
        text += "<span class='text'>" + info.pos + ":</span></div>";
        text += "<span class='value'>" + info.value + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie9 = {
    container: "#gni-capita-500mb-percentage-afford",
    chartType: "scatter",
    showFitLine: {
      show: false,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 2), 10, (isSmall() ? 5 : 2)],
    xAxis: {
      title: "Total % of population that can afford 500MB at 5% of GNI p.c.",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of 500MB as a % of GNI p.c.",
      "font-size": "10pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      tickNumber: 20,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [{"name":"First","values":[[100,1.03,{"iso3":"CRI","name":"Costa Rica","type":"EMERGING","price":100,"gni":1.03}],[100,1.13,{"iso3":"IDN","name":"Indonesia","type":"DEVELOPING","price":100,"gni":1.13}],[100,2.05,{"iso3":"JOR","name":"Jordan","type":"EMERGING","price":100,"gni":2.05}],[100,0.57,{"iso3":"KAZ","name":"Kazakhstan","type":"EMERGING","price":100,"gni":0.57}],[100,0.99,{"iso3":"MYS","name":"Malaysia","type":"EMERGING","price":100,"gni":0.99}],[100,1.43,{"iso3":"MUS","name":"Mauritius","type":"EMERGING","price":100,"gni":1.43}],[100,1.31,{"iso3":"PAK","name":"Pakistan","type":"DEVELOPING","price":100,"gni":1.31}],[100,1.38,{"iso3":"THA","name":"Thailand","type":"EMERGING","price":100,"gni":1.38}],[100,0.95,{"iso3":"TUR","name":"Turkey","type":"EMERGING","price":100,"gni":0.95}],[80,3.49,{"iso3":"BGD","name":"Bangladesh","type":"DEVELOPING","price":80,"gni":3.49}],[80,1.13,{"iso3":"BRA","name":"Brazil","type":"EMERGING","price":80,"gni":1.13}],[80,2.48,{"iso3":"IND","name":"India","type":"DEVELOPING","price":80,"gni":2.48}],[80,2.02,{"iso3":"PER","name":"Peru","type":"EMERGING","price":80,"gni":2.02}],[80,2.47,{"iso3":"PHL","name":"Philippines","type":"DEVELOPING","price":80,"gni":2.47}],[60,2.72,{"iso3":"MEX","name":"Mexico","type":"EMERGING","price":60,"gni":2.72}],[60,1.48,{"iso3":"ZAF","name":"South Africa","type":"EMERGING","price":60,"gni":1.48}],[40,3.24,{"iso3":"COL","name":"Colombia","type":"EMERGING","price":40,"gni":3.24}],[40,4.43,{"iso3":"ECU","name":"Ecuador","type":"EMERGING","price":40,"gni":4.43}],[40,2.62,{"iso3":"NAM","name":"Namibia","type":"EMERGING","price":40,"gni":2.62}],[40,5.4,{"iso3":"NGA","name":"Nigeria","type":"DEVELOPING","price":40,"gni":5.4}],[20,12.3,{"iso3":"BEN","name":"Benin","type":"DEVELOPING","price":20,"gni":12.3}],[20,5.17,{"iso3":"BWA","name":"Botswana","type":"EMERGING","price":20,"gni":5.17}],[20,6.46,{"iso3":"DOM","name":"Dominican Republic","type":"EMERGING","price":20,"gni":6.46}],[20,7.45,{"iso3":"NPL","name":"Nepal","type":"DEVELOPING","price":20,"gni":7.45}],[20,14.02,{"iso3":"RWA","name":"Rwanda","type":"DEVELOPING","price":20,"gni":14.02}],[20,11.57,{"iso3":"SEN","name":"Senegal","type":"DEVELOPING","price":20,"gni":11.57}],[20,10.54,{"iso3":"TZA","name":"Tanzania","type":"DEVELOPING","price":20,"gni":10.54}],[20,7.31,{"iso3":"VNM","name":"Vietnam","type":"DEVELOPING","price":20,"gni":7.31}],[20,11.89,{"iso3":"ZMB","name":"Zambia","type":"DEVELOPING","price":20,"gni":11.89}],[0,24.3,{"iso3":"BFA","name":"Burkina Faso","type":"DEVELOPING","price":0,"gni":24.3}],[0,16.92,{"iso3":"ETH","name":"Ethiopia","type":"DEVELOPING","price":0,"gni":16.92}],[0,32.8,{"iso3":"HTI","name":"Haiti","type":"DEVELOPING","price":0,"gni":32.8}],[0,24.4,{"iso3":"MWI","name":"Malawi","type":"DEVELOPING","price":0,"gni":24.4}],[0,17.04,{"iso3":"MLI","name":"Mali","type":"DEVELOPING","price":0,"gni":17.04}],[0,15.4,{"iso3":"UGA","name":"Uganda","type":"DEVELOPING","price":0,"gni":15.4}]]}],
    events: {
      "onmouseover": function(info) {
        var ADI, GNI, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        PRICE = parseFloat(info["data-price"]).toFixed(2);
        GNI = parseFloat(info["data-gni"]).toFixed(2);
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Price of 500MBas a % of GNI p.c.: </span><span class='value'>" + GNI + "</span>";
        text += "<span class='text'>Total % of population that can afford 500MB at 5% of GNI p.c.: </span><span class='value'>" + PRICE + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie10 = {
    container: "#gni-capita-1gb-percentage-afford",
    chartType: "scatter",
    showFitLine: {
      show: false,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 2), 10, (isSmall() ? 5 : 2)],
    xAxis: {
      title: "Total % of population that can afford 1GB at 5% of GNI p.c.",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of 500MB as a % of GNI p.c.",
      "font-size": "10pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      tickNumber: 25,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [{"name":"First","values":[[100,1.56,{"iso3":"IDN","name":"Indonesia","type":"DEVELOPING","price":100,"gni":1.56}],[100,0.57,{"iso3":"KAZ","name":"Kazakhstan","type":"EMERGING","price":100,"gni":0.57}],[100,0.82,{"iso3":"MUS","name":"Mauritius","type":"EMERGING","price":100,"gni":0.82}],[100,1,{"iso3":"TUR","name":"Turkey","type":"EMERGING","price":100,"gni":1}],[80,1.49,{"iso3":"CHN","name":"China","type":"EMERGING","price":80,"gni":1.49}],[80,1.61,{"iso3":"CRI","name":"Costa Rica","type":"EMERGING","price":80,"gni":1.61}],[80,3.42,{"iso3":"JOR","name":"Jordan","type":"EMERGING","price":80,"gni":3.42}],[80,1.69,{"iso3":"MYS","name":"Malaysia","type":"EMERGING","price":80,"gni":1.69}],[80,2.49,{"iso3":"THA","name":"Thailand","type":"EMERGING","price":80,"gni":2.49}],[80,2.26,{"iso3":"MEX","name":"Mexico","type":"EMERGING","price":80,"gni":2.26}],[60,2.31,{"iso3":"BRA","name":"Brazil","type":"EMERGING","price":60,"gni":2.31}],[60,3.13,{"iso3":"IND","name":"India","type":"DEVELOPING","price":60,"gni":3.13}],[60,3.04,{"iso3":"PER","name":"Peru","type":"EMERGING","price":60,"gni":3.04}],[60,1.18,{"iso3":"ZAF","name":"South Africa","type":"EMERGING","price":60,"gni":1.18}],[60,2.21,{"iso3":"COL","name":"Colombia","type":"EMERGING","price":60,"gni":2.21}],[60,3.92,{"iso3":"VNM","name":"Vietnam","type":"DEVELOPING","price":60,"gni":3.92}],[40,5.28,{"iso3":"BGD","name":"Bangladesh","type":"DEVELOPING","price":40,"gni":5.28}],[40,4.44,{"iso3":"ECU","name":"Ecuador","type":"EMERGING","price":40,"gni":4.44}],[40,2.81,{"iso3":"NAM","name":"Namibia","type":"EMERGING","price":40,"gni":2.81}],[40,3.7,{"iso3":"DOM","name":"Dominican Republic","type":"EMERGING","price":40,"gni":3.7}],[20,10.47,{"iso3":"PAK","name":"Pakistan","type":"DEVELOPING","price":20,"gni":10.47}],[20,8.27,{"iso3":"PHL","name":"Philippines","type":"DEVELOPING","price":20,"gni":8.27}],[20,9.46,{"iso3":"NGA","name":"Nigeria","type":"DEVELOPING","price":20,"gni":9.46}],[20,11.57,{"iso3":"BWA","name":"Botswana","type":"EMERGING","price":20,"gni":11.57}],[20,7.59,{"iso3":"TZA","name":"Tanzania","type":"DEVELOPING","price":20,"gni":7.59}],[0,21.53,{"iso3":"BEN","name":"Benin","type":"DEVELOPING","price":0,"gni":21.53}],[0,13.05,{"iso3":"NPL","name":"Nepal","type":"DEVELOPING","price":0,"gni":13.05}],[0,28.03,{"iso3":"RWA","name":"Rwanda","type":"DEVELOPING","price":0,"gni":28.03}],[0,14.16,{"iso3":"ZMB","name":"Zambia","type":"DEVELOPING","price":0,"gni":14.16}],[0,16.2,{"iso3":"BFA","name":"Burkina Faso","type":"DEVELOPING","price":0,"gni":16.2}],[0,39.29,{"iso3":"ETH","name":"Ethiopia","type":"DEVELOPING","price":0,"gni":39.29}],[0,32.8,{"iso3":"HTI","name":"Haiti","type":"DEVELOPING","price":0,"gni":32.8}],[0,41.88,{"iso3":"MWI","name":"Malawi","type":"DEVELOPING","price":0,"gni":41.88}],[0,27.2,{"iso3":"MLI","name":"Mali","type":"DEVELOPING","price":0,"gni":27.2}],[0,41.23,{"iso3":"SLE","name":"Sierra Leone","type":"DEVELOPING","price":0,"gni":41.23}],[0,28.88,{"iso3":"UGA","name":"Uganda","type":"DEVELOPING","price":0,"gni":28.88}]]}],
    events: {
      "onmouseover": function(info) {
        var ADI, GNI, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        PRICE = parseFloat(info["data-price"]).toFixed(2);
        GNI = parseFloat(info["data-gni"]).toFixed(2);
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Price of 500MBas a % of GNI p.c.: </span><span class='value'>" + GNI + "</span>";
        text += "<span class='text'>Total % of population that can afford 500MB at 5% of GNI p.c.: </span><span class='value'>" + PRICE + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  serie11 = {
    container: "#mobile-broadband-prices-women",
    chartType: "scatter",
    showFitLine: {
      show: true,
      colour: "#31799F",
      stroke: 3
    },
    legend: {
      show: false
    },
    margins: [5, (isSmall() ? 5 : 2), 10, (isSmall() ? 5 : 2)],
    xAxis: {
      title: "Level of Internet access among women",
      margin: 10,
      tickNumber: 11,
      "font-size": "10pt"
    },
    yAxis: {
      title: "Price of a mobile broadband (500MB) plan as % of GNI per capita",
      "font-size": "10pt",
      pow: 10,
      margin: isSmall() ? 20 : 10,
      "font-colour": "#777"
    },
    sizeByValueMinRadius: isSmall() ? 2 : 1,
    title: "",
    "foot": "",
    getElementColour: function(options, element, index, subindex) {
      var info;
      info = element.values[subindex] ? element.values[subindex][2] : null;
      if (info && info.type === "DEVELOPING") {
        return "#35B4B0";
      } else {
        return "#EC962E";
      }
    },
    series: [
      {
        "name":"First",
        "values":[
          [20, 5.89, {
            "iso3": "KEN",
            "name": "Kenya",
            "type": "DEVELOPING",
            "level": 20,
            "price": 5.89
          }],
          [21, 15.40, {
            "iso3": "UGA",
            "name": "Uganda",
            "type": "DEVELOPING",
            "level": 21,
            "price": 15.40
          }],
          [31, 1.13, {
            "iso3": "IDN",
            "name": "Indonesia",
            "type": "DEVELOPING",
            "level": 31,
            "price": 1.13
          }],
          [33, 6.28, {
            "iso3": "MOZ",
            "name": "Mozambique",
            "type": "DEVELOPING",
            "level": 33,
            "price": 6.28
          }],
          [36, 5.40, {
            "iso3": "NGA",
            "name": "Nigeria",
            "type": "DEVELOPING",
            "level": 36,
            "price": 5.40
          }],
          [46, 2.47, {
            "iso3": "PHL",
            "name": "Philippines",
            "type": "DEVELOPING",
            "level": 46,
            "price": 2.47
          }],
          [47, 2.48, {
            "iso3": "IND",
            "name": "India",
            "type": "DEVELOPING",
            "level": 47,
            "price": 2.48
          }],
          [71, 3.24, {
            "iso3": "COL",
            "name": "Colombia",
            "type": "EMERGING",
            "level": 71,
            "price": 3.24
          }]
        ]
      }],
    events: {
      "onmouseover": function(info) {
        var ADI, GNI, iso, name, text;
        iso = info["data-iso3"];
        name = info["data-name"];
        PRICE = parseFloat(info["data-price"]).toFixed(2);
        LEVEL = parseFloat(info["data-level"]).toFixed(2);
        text = "<div class='chart-tooltip chart-report'><img class='flag' src='" + (getPath()) + "/images/flags/" + iso + ".png' />";
        text += "<span class='country'>" + name + "</span>";
        text += "<span class='text'>Level of Internet access among women: </span><span class='value'>" + LEVEL + "</span>";
        text += "<span class='text'>Total % of population that can afford 500MB at 5% of GNI p.c.: </span><span class='value'>" + PRICE + "</span></div>";
        return wesCountry.charts.showTooltip(text, info.event);
      }
    }
  };

  getPath = function() {
    return document.getElementById("path").value;
  };

  window.onresize = function() {
    return renderCharts();
  };

  renderCharts = function() {
    var container, containers, _i, _len;
    containers = document.querySelectorAll("div.charts");
    for (_i = 0, _len = containers.length; _i < _len; _i++) {
      container = containers[_i];
      container.innerHTML = "";
    }
    renderChart(internetDisparity);
    renderChart(serie1);
    renderChart(serie2);
    renderChart(serie3);
    renderChart(serie4);
    renderChart(serie5);
    renderChart(serie6);
    renderChart(serie7);
    renderChart(serie8);
    renderChart(serie9);
    renderChart(serie10);
    renderChart(serie11);
  };

  function renderChart(serie) {
  	var container = document.querySelector(serie.container);

  	if (!container) {
  		return;
  	}

  	wesCountry.charts.chart(serie);
  }

  renderCharts();

}).call(this);
