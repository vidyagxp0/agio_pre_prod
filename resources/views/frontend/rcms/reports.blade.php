@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    {{-- <script>
        function openReport(value) {
            console.log(value)
            let reportBlocks = document.querySelectorAll('.report-block')
            if (value === "quality-dashboard") {
                window.open('/Quality-Dashboard-Report', '_blank', )
            } else if (value === "supplier-dashboard") {
                window.open('/Supplier-Dashboard-Report', '_blank', )
            } else if (value === "logs") {
                window.open('/rcms_desktop', '_blank', 'width=1200, height=900, top=0, left=0');
            } else if (value === "risk-management") {
                window.open("/risk-management-report"), '_blank',
                    'width=1200, height=900, top=0, left=0');
        } else if (value === "management-review") {
            window.open(asset('rcms_report/Management Review Report_1.pdf'), '_blank',
                'width=1200, height=900, top=0, left=0');
        } else if (value === "compliance-report") {
            window.open(asset('rcms_report/Compliance Report.pdf'), '_blank', 'width=1200, height=900, top=0, left=0');
        } else if (value === "general-monthly") {
            window.open(asset('rcms_report/General_My Monthly Tasks..pdf'), '_blank',
                'width=1200, height=900, top=0, left=0');
        } else if (value === "general-dashboard") {
            window.open(asset('rcms_report/General_Dashboard Report.pdf'), '_blank',
                'width=1200, height=900, top=0, left=0');
        } else {
            for (let ele of Array.from(reportBlocks)) {
                ele.classList.remove('active');
                if (ele.getAttribute('id') === value) {
                    ele.classList.add('active');
                }
            }
        }
        }
    </script> --}}
    {{-- <script>
        function openReport(value) {
            console.log(value);
            let reportBlocks = document.querySelectorAll('.report-block');

            if (value === "quality-dashboard") {
                window.open('/Quality-Dashboard-Report', '_blank');
            } else if (value === "supplier-dashboard") {
                window.open('/Supplier-Dashboard-Report', '_blank');
            } else if (value === "logs") {
                window.open('/rcms_desktop', '_blank', 'width=1200, height=900, top=0, left=0');
            } else {
                let pdfUrl = '';

                switch (value) {
                    case "risk-management":
                        pdfUrl = 'rcms_report/Risk_Management_Dashboard.pdf';
                        break;
                    case "management-review":
                        pdfUrl = 'rcms_report/Management Review Report_1.pdf';
                        break;
                    case "compliance-report":
                        pdfUrl = 'rcms_report/Compliance Report.pdf';
                        break;
                    case "general-monthly":
                        pdfUrl = 'rcms_report/General_My Monthly Tasks..pdf';
                        break;
                    case "general-dashboard":
                        pdfUrl = 'rcms_report/General_Dashboard Report.pdf';
                        break;
                    default:
                        // Handle unknown value or show an error message
                        return;
                }

                // Open PDF in a new window or tab using an iframe with a blank page
                let blankPage = 'data:text/html,<html></html>';
                let iframe = document.createElement('iframe');
                iframe.src = blankPage;
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                document.body.appendChild(iframe);

                // Once the iframe is added, change its source to the PDF URL
                iframe.onload = function() {
                    iframe.contentWindow.location.replace(pdfUrl);
                };
            }

            // Remove 'active' class from report blocks
            for (let ele of Array.from(reportBlocks)) {
                ele.classList.remove('active');
                if (ele.getAttribute('id') === value) {
                    ele.classList.add('active');
                }
            }
        }
    </script> --}}
    {{-- <script>
        function openReport(value) {
            console.log(value);
            let reportBlocks = document.querySelectorAll('.report-block');

            if (value === "quality-dashboard") {
                window.open('/Quality-Dashboard-Report', '_blank');
            } else if (value === "supplier-dashboard") {
                window.open('/Supplier-Dashboard-Report', '_blank');
            } else if (value === "logs") {
                window.open('/rcms_desktop', '_blank', 'width=1200, height=900, top=0, left=0');
            } else {
                let pdfUrl = '';

                switch (value) {
                    case "risk-management":
                        pdfUrl = 'rcms_report/Risk_Management_Dashboard.pdf';
                        break;
                    case "management-review":
                        pdfUrl = 'rcms_report/Management Review Report_1.pdf';
                        break;
                    case "compliance-report":
                        pdfUrl = 'rcms_report/Compliance Report.pdf';
                        break;
                    case "general-monthly":
                        pdfUrl = 'rcms_report/General_My Monthly Tasks..pdf';
                        break;
                    case "general-dashboard":
                        pdfUrl = 'rcms_report/General_Dashboard Report.pdf';
                        break;
                    default:
                        // Handle unknown value or show an error message
                        return;
                }

                // Create a Blob for the PDF file
                fetch(pdfUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        // Create a data URL for the Blob
                        let pdfDataUrl = URL.createObjectURL(blob);

                        // Open PDF in a new window or tab using an iframe
                        let iframe = document.createElement('iframe');
                        iframe.src = pdfDataUrl;
                        iframe.style.width = '100%';
                        iframe.style.height = '100%';
                        document.body.appendChild(iframe);
                    });
            }

            // Remove 'active' class from report blocks
            for (let ele of Array.from(reportBlocks)) {
                ele.classList.remove('active');
                if (ele.getAttribute('id') === value) {
                    ele.classList.add('active');
                }
            }
        }
    </script> --}}
    <script>
        function openReport(value) {
            console.log(value);

            if (value === "quality-dashboard") {
                window.open('/Quality-Dashboard-Report', '_blank');
            } else if (value === "supplier-dashboard") {
                window.open('/Supplier-Dashboard-Report', '_blank');
            } else if (value === "logs") {
                window.open('/rcms_desktop', '_blank', 'width=1200, height=900, top=0, left=0');
            } 
            else if (value === "tmslog") {
                window.open('/activity_log', '_blank', 'width=1200, height=900, top=0, left=0');
            } else {
                let pdfUrl = '';

                switch (value) {
                    case "risk-management":
                        pdfUrl = 'rcms_report/Risk_Management_Dashboard.pdf';
                        break;
                    case "management-review":
                        pdfUrl = 'rcms_report/Management_Review_Report_1.pdf';
                        break;
                    case "compliance-report":
                        pdfUrl = 'rcms_report/Compliance_Report.pdf';
                        break;
                    case "general-monthly":
                        pdfUrl = 'rcms_report/General_My_Monthly_Tasks..pdf';
                        break;
                    case "general-dashboard":
                        pdfUrl = 'rcms_report/General_Dashboard_Report.pdf';
                        break;
                    default:
                        // Handle unknown value or show an error message
                        return;
                }

                // Open PDF in a new tab using window.open
                let newTab = window.open('', '_blank');

                // Dynamically create an iframe inside the new tab
                let iframe = newTab.document.createElement('iframe');
                iframe.src = pdfUrl;
                iframe.style.width = '100%';
                iframe.style.height = '100%';

                // Append the iframe to the new tab's body
                newTab.document.body.appendChild(iframe);
            }
        }
    </script>






    <div id="rcms-reports">
        <div class="container-fluid">

            <div class="scope-bar">
                <div class="group-input">
                    <label for="scope">Report Type</label>
                    <select name="scope" onchange="openReport(this.value)">
                        <option value="logs">Logs</option>
                        <option value="supplier-dashboard">Supplier Dashbaord</option>
                        <option value="quality-dashboard">Quality Dashbaord</option>
                        <option value="compliance-report">Compliance Report</option>
                        <option value="risk-management">Risk Management Dashbaord</option>
                        <option value="management-review">Management Review Report</option>
                        <option value="general-dashboard" selected>General Dashbaord Report</option>
                        <option value="general-monthly-distribution">General Monthly Distribution</option>
                        <option value="general-monthly">General Monthly Reports</option>
                        <option value="general-risk">General Risk Matrix</option>
                        <option value="general-staff">General Staff Matrix</option>
                        <option value="general-management">General Management View</option>
                        <option value="general-geographical">General Geographical Analysis</option>
                        <option value="minor-protocol-violations">Minor Protocol Violations</option>
                    </select>
                </div>
                <div class="group-input">
                    <label for="scope">Record Type</label>
                    <select name="scope">
                        <option value="">All</option>
                        <option value="">Internal Audit</option>
                        <option value="">External Audit</option>
                        <option value="">CAPA</option>
                        <option value="">Audit Program</option>
                        <option value="">Lab Incident</option>
                        <option value="">Change Control</option>
                        <option value="">Risk Assessment</option>
                        <option value="">ROot Cause Analysis</option>
                        <option value="">Management Review</option>
                    </select>
                </div>
            </div>

            <div class="report-block" id="supplier-dashboard">

            </div>

            <div class="report-block" id="quality-dashboard">

            </div>

            <div class="report-block active" id="general-dashboard">
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-1"></div>
                </div>
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-2"></div>
                </div>
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-3"></div>
                </div>
            </div>

            <div class="report-block" id="general-monthly-distribution">
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-1"></div>
                </div>
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-6"></div>
                </div>
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-2"></div>
                </div>
            </div>

            <div class="report-block" id="general-monthly">
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-3"></div>
                </div>
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-7"></div>
                </div>
            </div>

            <div class="report-block" id="general-risk">
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-9"></div>
                </div>
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-8"></div>
                </div>
            </div>

            <div class="report-block" id="general-staff">
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-7"></div>
                </div>
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-8"></div>
                </div>
            </div>

            <div class="report-block" id="general-management">
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-4"></div>
                </div>
                <div class="grid-block">
                    <div class="bar-chart" id="bar-chart-5"></div>
                </div>
            </div>

            <div class="report-block" id="general-geographical">
                <div class="grid-block">
                    <div class="line-chart" id="map-chart-1"></div>
                </div>
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-5"></div>
                </div>
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-6"></div>
                </div>
            </div>

            <div class="report-block" id="minor-protocol-violations">
                <div class="grid-block">
                    <div class="line-chart" id="line-chart-4"></div>
                </div>
                <div class="grid-block dual-grid">
                    <div class="pie-chart" id="pie-chart-1"></div>
                    <div class="pie-chart" id="pie-chart-2"></div>
                </div>
            </div>

        </div>
    </div>

    {{-- ! BAR CHART --}}
    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-1");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);
            let xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "country",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            let yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });
            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });


            // Set data
            let data = [{
                country: "USA",
                value: 2025
            }, {
                country: "China",
                value: 1882
            }, {
                country: "Japan",
                value: 1809
            }, {
                country: "Germany",
                value: 1322
            }, {
                country: "UK",
                value: 1122
            }, {
                country: "France",
                value: 1114
            }, {
                country: "India",
                value: 984
            }, {
                country: "Spain",
                value: 711
            }, {
                country: "Netherlands",
                value: 665
            }, {
                country: "South Korea",
                value: 443
            }, {
                country: "Canada",
                value: 441
            }];

            xAxis.data.setAll(data);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-2");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                paddingLeft: 0,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.verticalLayout
            }));
            let legend = chart.children.push(
                am5.Legend.new(root, {
                    centerX: am5.p50,
                    x: am5.p50
                })
            );

            let data = [{
                "year": "2021",
                "europe": 2.5,
                "namerica": 2.5,
                "asia": 2.1,
                "lamerica": 1,
                "meast": 0.8,
                "africa": 0.4
            }, {
                "year": "2022",
                "europe": 2.6,
                "namerica": 2.7,
                "asia": 2.2,
                "lamerica": 0.5,
                "meast": 0.4,
                "africa": 0.3
            }, {
                "year": "2023",
                "europe": 2.8,
                "namerica": 2.9,
                "asia": 2.4,
                "lamerica": 0.3,
                "meast": 0.9,
                "africa": 0.5
            }]
            let xRenderer = am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9,
                minorGridEnabled: true
            })

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "year",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            xRenderer.grid.template.setAll({
                location: 1
            })

            xAxis.data.setAll(data);

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            }));

            function makeSeries(name, fieldName) {
                let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: fieldName,
                    categoryXField: "year"
                }));

                series.columns.template.setAll({
                    tooltipText: "{name}, {categoryX}:{valueY}",
                    width: am5.percent(90),
                    tooltipY: 0,
                    strokeOpacity: 0
                });

                series.data.setAll(data);
                series.appear();

                series.bullets.push(function() {
                    return am5.Bullet.new(root, {
                        locationY: 0,
                        sprite: am5.Label.new(root, {
                            text: "{valueY}",
                            fill: root.interfaceColors.get("alternativeText"),
                            centerY: 0,
                            centerX: am5.p50,
                            populateText: true
                        })
                    });
                });

                legend.data.push(series);
            }

            makeSeries("Europe", "europe");
            makeSeries("North America", "namerica");
            makeSeries("Asia", "asia");
            makeSeries("Latin America", "lamerica");
            makeSeries("Middle East", "meast");
            makeSeries("Africa", "africa");
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-3");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0,
                paddingRight: 0,
                layout: root.verticalLayout
            }));

            let colors = chart.get("colors");

            let data = [{
                country: "US",
                visits: 725
            }, {
                country: "UK",
                visits: 625
            }, {
                country: "China",
                visits: 602
            }, {
                country: "Japan",
                visits: 509
            }, {
                country: "Germany",
                visits: 322
            }, {
                country: "France",
                visits: 214
            }, {
                country: "India",
                visits: 204
            }, {
                country: "Spain",
                visits: 198
            }, {
                country: "Netherlands",
                visits: 165
            }, {
                country: "South Korea",
                visits: 93
            }, {
                country: "Canada",
                visits: 41
            }];

            prepareParetoData();

            function prepareParetoData() {
                let total = 0;

                for (let i = 0; i < data.length; i++) {
                    let value = data[i].visits;
                    total += value;
                }

                let sum = 0;
                for (let i = 0; i < data.length; i++) {
                    let value = data[i].visits;
                    sum += value;
                    data[i].pareto = sum / total * 100;
                }
            }
            let xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 85,
                minorGridEnabled: true
            })

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "country",
                renderer: xRenderer
            }));

            xRenderer.grid.template.setAll({
                location: 1
            })

            xRenderer.labels.template.setAll({
                paddingTop: 20
            });

            xAxis.data.setAll(data);

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            }));

            let paretoAxisRenderer = am5xy.AxisRendererY.new(root, {
                opposite: true
            });
            let paretoAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: paretoAxisRenderer,
                min: 0,
                max: 100,
                strictMinMax: true
            }));

            paretoAxisRenderer.grid.template.set("forceHidden", true);
            paretoAxis.set("numberFormat", "#'%");
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "visits",
                categoryXField: "country"
            }));

            series.columns.template.setAll({
                tooltipText: "{categoryX}: {valueY}",
                tooltipY: 0,
                strokeOpacity: 0,
                cornerRadiusTL: 6,
                cornerRadiusTR: 6
            });

            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.dataItems.indexOf(target.dataItem));
            })


            // pareto series
            let paretoSeries = chart.series.push(am5xy.LineSeries.new(root, {
                xAxis: xAxis,
                yAxis: paretoAxis,
                valueYField: "pareto",
                categoryXField: "country",
                stroke: root.interfaceColors.get("alternativeBackground"),
                maskBullets: false
            }));

            paretoSeries.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 1,
                    sprite: am5.Circle.new(root, {
                        radius: 5,
                        fill: series.get("fill"),
                        stroke: root.interfaceColors.get("alternativeBackground")
                    })
                })
            })

            series.data.setAll(data);
            paretoSeries.data.setAll(data);
            series.appear();
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-4");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none",
                layout: root.verticalLayout,
                paddingLeft: 0
            }));


            // Data
            let data = [{
                year: "2015",
                value: 600000
            }, {
                year: "2016",
                value: 900000
            }, {
                year: "2017",
                value: 180000
            }, {
                year: "2018",
                value: 600000
            }, {
                year: "2019",
                value: 350000
            }, {
                year: "2020",
                value: 600000
            }, {
                year: "2021",
                value: 670000
            }];

            // Populate data
            for (let i = 0; i < (data.length - 1); i++) {
                data[i].valueNext = data[i + 1].value;
            }
            let xRenderer = am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9,
                minGridDistance: 30,
                minorGridEnabled: true
            });

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "year",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            xRenderer.grid.template.setAll({
                location: 1
            })

            xAxis.data.setAll(data);

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                min: 0,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                categoryXField: "year"
            }));

            series.columns.template.setAll({
                tooltipText: "{categoryX}: {valueY}",
                width: am5.percent(90),
                tooltipY: 0
            });

            series.data.setAll(data);

            // letiance indicator series
            let series2 = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "valueNext",
                openValueYField: "value",
                categoryXField: "year",
                fill: am5.color(0x555555),
                stroke: am5.color(0x555555)
            }));

            series2.columns.template.setAll({
                width: 1
            });

            series2.data.setAll(data);

            series2.bullets.push(function() {
                let label = am5.Label.new(root, {
                    text: "{valueY}",
                    fontWeight: "500",
                    fill: am5.color(0x00cc00),
                    centerY: am5.p100,
                    centerX: am5.p50,
                    populateText: true
                });

                // Modify text of the bullet with percent
                label.adapters.add("text", function(text, target) {
                    let percent = getletiancePercent(target.dataItem);
                    return percent ? percent + "%" : text;
                });

                // Set dynamic color of the bullet
                label.adapters.add("centerY", function(center, target) {
                    return getletiancePercent(target.dataItem) < 0 ? 0 : center;
                });

                // Set dynamic color of the bullet
                label.adapters.add("fill", function(fill, target) {
                    return getletiancePercent(target.dataItem) < 0 ? am5.color(0xcc0000) : fill;
                });

                return am5.Bullet.new(root, {
                    locationY: 1,
                    sprite: label
                });
            });

            series2.bullets.push(function() {
                let arrow = am5.Graphics.new(root, {
                    rotation: -90,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    dy: 3,
                    fill: am5.color(0x555555),
                    stroke: am5.color(0x555555),
                    draw: function(display) {
                        display.moveTo(0, -3);
                        display.lineTo(8, 0);
                        display.lineTo(0, 3);
                        display.lineTo(0, -3);
                    }
                });

                arrow.adapters.add("rotation", function(rotation, target) {
                    return getletiancePercent(target.dataItem) < 0 ? 90 : rotation;
                });

                arrow.adapters.add("dy", function(dy, target) {
                    return getletiancePercent(target.dataItem) < 0 ? -3 : dy;
                });

                return am5.Bullet.new(root, {
                    locationY: 1,
                    sprite: arrow
                })
            })
            series.appear();
            chart.appear(1000, 100);


            function getletiancePercent(dataItem) {
                if (dataItem) {
                    let value = dataItem.get("valueY");
                    let openValue = dataItem.get("openValueY");
                    let change = value - openValue;
                    return Math.round(change / openValue * 100);
                }
                return 0;
            }

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-5");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none",
                layout: root.horizontalLayout,
                paddingLeft: 0
            }));
            let legendData = [];
            let legend = chart.children.push(
                am5.Legend.new(root, {
                    nameField: "name",
                    fillField: "color",
                    strokeField: "color",
                    //centerY: am5.p50,
                    marginLeft: 20,
                    y: 20,
                    layout: root.verticalLayout,
                    clickTarget: "none"
                })
            );

            let data = [{
                region: "Central",
                state: "North Dakota",
                sales: 920
            }, {
                region: "Central",
                state: "South Dakota",
                sales: 1317
            }, {
                region: "Central",
                state: "Kansas",
                sales: 2916
            }, {
                region: "Central",
                state: "Iowa",
                sales: 4577
            }, {
                region: "Central",
                state: "Nebraska",
                sales: 7464
            }, {
                region: "Central",
                state: "Oklahoma",
                sales: 19686
            }, {
                region: "Central",
                state: "Missouri",
                sales: 22207
            }, {
                region: "Central",
                state: "Minnesota",
                sales: 29865
            }, {
                region: "Central",
                state: "Wisconsin",
                sales: 32125
            }, {
                region: "Central",
                state: "Indiana",
                sales: 53549
            }, {
                region: "Central",
                state: "Michigan",
                sales: 76281
            }, {
                region: "Central",
                state: "Illinois",
                sales: 80162
            }, {
                region: "Central",
                state: "Texas",
                sales: 170187
            }, {
                region: "East",
                state: "West Virginia",
                sales: 1209
            }, {
                region: "East",
                state: "Maine",
                sales: 1270
            }, {
                region: "East",
                state: "District of Columbia",
                sales: 2866
            }, {
                region: "East",
                state: "New Hampshire",
                sales: 7294
            }, {
                region: "East",
                state: "Vermont",
                sales: 8929
            }, {
                region: "East",
                state: "Connecticut",
                sales: 13386
            }, {
                region: "East",
                state: "Rhode Island",
                sales: 22629
            }, {
                region: "East",
                state: "Maryland",
                sales: 23707
            }, {
                region: "East",
                state: "Delaware",
                sales: 27453
            }, {
                region: "East",
                state: "Massachusetts",
                sales: 28639
            }, {
                region: "East",
                state: "New Jersey",
                sales: 35763
            }, {
                region: "East",
                state: "Ohio",
                sales: 78253
            }, {
                region: "East",
                state: "Pennsylvania",
                sales: 116522
            }, {
                region: "East",
                state: "New York",
                sales: 310914
            }, {
                region: "South",
                state: "South Carolina",
                sales: 8483
            }, {
                region: "South",
                state: "Louisiana",
                sales: 9219
            }, {
                region: "South",
                state: "Mississippi",
                sales: 10772
            }, {
                region: "South",
                state: "Arkansas",
                sales: 11678
            }, {
                region: "South",
                state: "Alabama",
                sales: 19511
            }, {
                region: "South",
                state: "Tennessee",
                sales: 30662
            }, {
                region: "South",
                state: "Kentucky",
                sales: 36598
            }, {
                region: "South",
                state: "Georgia",
                sales: 49103
            }, {
                region: "South",
                state: "North Carolina",
                sales: 55604
            }, {
                region: "South",
                state: "Virginia",
                sales: 70641
            }, {
                region: "South",
                state: "Florida",
                sales: 89479
            }, {
                region: "West",
                state: "Wyoming",
                sales: 1603
            }, {
                region: "West",
                state: "Idaho",
                sales: 4380
            }, {
                region: "West",
                state: "New Mexico",
                sales: 4779
            }, {
                region: "West",
                state: "Montana",
                sales: 5589
            }, {
                region: "West",
                state: "Utah",
                sales: 11223
            }, {
                region: "West",
                state: "Nevada",
                sales: 16729
            }, {
                region: "West",
                state: "Oregon",
                sales: 17431
            }, {
                region: "West",
                state: "Colorado",
                sales: 32110
            }, {
                region: "West",
                state: "Arizona",
                sales: 35283
            }, {
                region: "West",
                state: "Washington",
                sales: 138656
            }, {
                region: "West",
                state: "California",
                sales: 457731
            }];
            let yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "state",
                renderer: am5xy.AxisRendererY.new(root, {
                    minGridDistance: 10,
                    minorGridEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            yAxis.get("renderer").labels.template.setAll({
                fontSize: 12,
                location: 0.5
            })

            yAxis.data.setAll(data);

            let xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererX.new(root, {}),
                tooltip: am5.Tooltip.new(root, {})
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueXField: "sales",
                categoryYField: "state",
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal"
                })
            }));

            series.columns.template.setAll({
                tooltipText: "{categoryY}: [bold]{valueX}[/]",
                width: am5.percent(90),
                strokeOpacity: 0
            });

            series.columns.template.adapters.add("fill", function(fill, target) {
                if (target.dataItem) {
                    switch (target.dataItem.dataContext.region) {
                        case "Central":
                            return chart.get("colors").getIndex(0);
                            break;
                        case "East":
                            return chart.get("colors").getIndex(1);
                            break;
                        case "South":
                            return chart.get("colors").getIndex(2);
                            break;
                        case "West":
                            return chart.get("colors").getIndex(3);
                            break;
                    }
                }
                return fill;
            })

            series.data.setAll(data);

            function createRange(label, category, color) {
                let rangeDataItem = yAxis.makeDataItem({
                    category: category
                });

                let range = yAxis.createAxisRange(rangeDataItem);

                rangeDataItem.get("label").setAll({
                    fill: color,
                    text: label,
                    location: 1,
                    fontWeight: "bold",
                    dx: -130
                });

                rangeDataItem.get("grid").setAll({
                    stroke: color,
                    strokeOpacity: 1,
                    location: 1
                });

                rangeDataItem.get("tick").setAll({
                    stroke: color,
                    strokeOpacity: 1,
                    location: 1,
                    visible: true,
                    length: 130
                });

                legendData.push({
                    name: label,
                    color: color
                });

            }

            createRange("Central", "Texas", chart.get("colors").getIndex(0));
            createRange("East", "New York", chart.get("colors").getIndex(1));
            createRange("South", "Florida", chart.get("colors").getIndex(2));
            createRange("West", "California", chart.get("colors").getIndex(3));

            legend.data.setAll(legendData);
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                xAxis: xAxis,
                yAxis: yAxis
            }));
            series.appear();
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-6");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    panX: false,
                    panY: false,
                    wheelX: "none",
                    wheelY: "none",
                    paddingLeft: 0
                })
            );
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);
            let xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                text: "{realName}"
            });

            let xAxis = chart.xAxes.push(
                am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0,
                    categoryField: "category",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{realName}"
                    })
                })
            );

            let yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0.3,
                    renderer: am5xy.AxisRendererY.new(root, {})
                })
            );

            let yAxis2 = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0.3,
                    syncWithAxis: yAxis,
                    renderer: am5xy.AxisRendererY.new(root, {
                        opposite: true
                    })
                })
            );
            let series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    name: "Series 1",
                    xAxis: xAxis,
                    yAxis: yAxis2,
                    valueYField: "value",
                    sequencedInterpolation: true,
                    categoryXField: "category",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{provider} {realName}: {valueY}"
                    })
                })
            );

            series.columns.template.setAll({
                fillOpacity: 0.9,
                strokeOpacity: 0
            });
            series.columns.template.adapters.add("fill", (fill, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", (stroke, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            let lineSeries = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: "Series 2",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "quantity",
                    sequencedInterpolation: true,
                    stroke: chart.get("colors").getIndex(13),
                    fill: chart.get("colors").getIndex(13),
                    categoryXField: "category",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    })
                })
            );

            lineSeries.strokes.template.set("strokeWidth", 2);

            lineSeries.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 1,
                    locationX: undefined,
                    sprite: am5.Circle.new(root, {
                        radius: 5,
                        fill: lineSeries.get("fill")
                    })
                });
            });

            // when data validated, adjust location of data item based on count
            lineSeries.events.on("datavalidated", function() {
                am5.array.each(lineSeries.dataItems, function(dataItem) {
                    // if count divides by two, location is 0 (on the grid)
                    if (
                        dataItem.dataContext.count / 2 ==
                        Math.round(dataItem.dataContext.count / 2)
                    ) {
                        dataItem.set("locationX", 0);
                    }
                    // otherwise location is 0.5 (middle)
                    else {
                        dataItem.set("locationX", 0.5);
                    }
                });
            });

            let chartData = [];

            // Set data
            let data = {
                "Provider 1": {
                    "item 1": 10,
                    "item 2": 35,
                    "item 3": 5,
                    "item 4": 20,
                    quantity: 430
                },
                "Provider 2": {
                    "item 1": 15,
                    "item 3": 21,
                    quantity: 210
                },
                "Provider 3": {
                    "item 2": 25,
                    "item 3": 11,
                    "item 4": 17,
                    quantity: 265
                },
                "Provider 4": {
                    "item 3": 12,
                    "item 4": 15,
                    quantity: 98
                }
            };

            // process data ant prepare it for the chart
            for (let providerName in data) {
                let providerData = data[providerName];

                // add data of one provider to temp array
                let tempArray = [];
                let count = 0;
                // add items
                for (let itemName in providerData) {
                    if (itemName != "quantity") {
                        count++;
                        tempArray.push({
                            category: providerName + "_" + itemName,
                            realName: itemName,
                            value: providerData[itemName],
                            provider: providerName
                        });
                    }
                }
                // sort temp array
                tempArray.sort(function(a, b) {
                    if (a.value > b.value) {
                        return 1;
                    } else if (a.value < b.value) {
                        return -1;
                    } else {
                        return 0;
                    }
                });
                let lineSeriesDataIndex = Math.floor(count / 2);
                tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
                tempArray[lineSeriesDataIndex].count = count;
                // push to the final data
                am5.array.each(tempArray, function(item) {
                    chartData.push(item);
                });

                let range = xAxis.makeDataItem({});
                xAxis.createAxisRange(range);

                range.set("category", tempArray[0].category);
                range.set("endCategory", tempArray[tempArray.length - 1].category);

                let label = range.get("label");

                label.setAll({
                    text: tempArray[0].provider,
                    dy: 30,
                    fontWeight: "bold",
                    tooltipText: tempArray[0].provider
                });

                let tick = range.get("tick");
                tick.setAll({
                    visible: true,
                    strokeOpacity: 1,
                    length: 50,
                    location: 0
                });

                let grid = range.get("grid");
                grid.setAll({
                    strokeOpacity: 1
                });
            }

            // add range for the last grid
            let range = xAxis.makeDataItem({});
            xAxis.createAxisRange(range);
            range.set("category", chartData[chartData.length - 1].category);
            let tick = range.get("tick");
            tick.setAll({
                visible: true,
                strokeOpacity: 1,
                length: 50,
                location: 1
            });

            let grid = range.get("grid");
            grid.setAll({
                strokeOpacity: 1,
                location: 1
            });

            xAxis.data.setAll(chartData);
            series.data.setAll(chartData);
            lineSeries.data.setAll(chartData);
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-7");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.verticalLayout,
                paddingLeft: 0
            }));
            let legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
            }))

            let colors = chart.get("colors");

            // Data
            let data = [{
                name: "John",
                startTime: 8,
                endTime: 11,
                columnSettings: {
                    stroke: colors.getIndex(1),
                    fill: colors.getIndex(1)
                }
            }, {
                name: "Joe",
                startTime: 10,
                endTime: 13,
                columnSettings: {
                    stroke: colors.getIndex(3),
                    fill: colors.getIndex(3)
                }
            }, {
                name: "Susan",
                startTime: 11,
                endTime: 18,
                columnSettings: {
                    stroke: colors.getIndex(5),
                    fill: colors.getIndex(5)
                }
            }, {
                name: "Eaton",
                startTime: 15,
                endTime: 19,
                columnSettings: {
                    stroke: colors.getIndex(7),
                    fill: colors.getIndex(7)
                }
            }];
            let yRenderer = am5xy.AxisRendererY.new(root, {
                minorGridEnabled: true
            });
            let yAxis = chart.yAxes.push(
                am5xy.CategoryAxis.new(root, {
                    categoryField: "name",
                    renderer: yRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            yRenderer.grid.template.setAll({
                location: 1
            })

            yAxis.data.setAll(data);

            let xAxis = chart.xAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererX.new(root, {
                        strokeOpacity: 0.1,
                        minGridDistance: 60
                    })
                })
            );
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Income",
                xAxis: xAxis,
                yAxis: yAxis,
                openValueXField: "startTime",
                valueXField: "endTime",
                categoryYField: "name",
                sequencedInterpolation: true
            }));

            series.columns.template.setAll({
                height: am5.percent(100),
                templateField: "columnSettings",
                tooltipText: "[bold]{name}[/]\n{categoryY}: {valueX}"
            });

            series.data.setAll(data);
            series.appear();
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-8");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                paddingLeft: 0
            }));
            let xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0,
                categoryField: "category",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            xRenderer.grid.template.setAll({
                location: 1
            })

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                xAxis: xAxis,
                yAxis: yAxis
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                openValueYField: "open",
                categoryXField: "category"
            }));

            series.columns.template.setAll({
                templateField: "columnConfig",
                strokeOpacity: 0
            })

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Label.new(root, {
                        text: "${displayValue} K",
                        centerY: am5.p50,
                        centerX: am5.p50,
                        populateText: true
                    })
                });
            });


            let stepSeries = chart.series.push(am5xy.StepLineSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "stepValue",
                categoryXField: "category",
                noRisers: true,
                locationX: 0.65,
                stroke: root.interfaceColors.get("alternativeBackground")
            }));

            stepSeries.strokes.template.setAll({
                strokeDasharray: [3, 3]
            })

            let colorSet = am5.ColorSet.new(root, {});

            // Set data
            let data = [{
                category: "Net revenue",
                value: 8786,
                open: 0,
                stepValue: 8786,
                columnConfig: {
                    fill: colorSet.getIndex(13),
                },
                displayValue: 8786
            }, {
                category: "Cost of sales",
                value: 8786 - 2786,
                open: 8786,
                stepValue: 8786 - 2786,
                columnConfig: {
                    fill: colorSet.getIndex(8),
                },
                displayValue: 2786
            }, {
                category: "Operating expenses",
                value: 8786 - 2786 - 1786,
                open: 8786 - 2786,
                stepValue: 8786 - 2786 - 1786,
                columnConfig: {
                    fill: colorSet.getIndex(9),
                },
                displayValue: 1786
            }, {
                category: "Amortisation",
                value: 8786 - 2786 - 1786 - 453,
                open: 8786 - 2786 - 1786,
                stepValue: 8786 - 2786 - 1786 - 453,
                columnConfig: {
                    fill: colorSet.getIndex(10),
                },
                displayValue: 453
            }, {
                category: "Income from equity",
                value: 8786 - 2786 - 1786 - 453 + 1465,
                open: 8786 - 2786 - 1786 - 453,
                stepValue: 8786 - 2786 - 1786 - 453 + 1465,
                columnConfig: {
                    fill: colorSet.getIndex(16),
                },
                displayValue: 1465
            }, {
                category: "Operating income",
                value: 8786 - 2786 - 1786 - 453 + 1465,
                open: 0,
                columnConfig: {
                    fill: colorSet.getIndex(17),
                },
                displayValue: 8786 - 2786 - 1786 - 453 + 1465
            }];

            xAxis.data.setAll(data);
            series.data.setAll(data);
            stepSeries.data.setAll(data);
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("bar-chart-9");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            root.dateFormatter.setAll({
                dateFormat: "yyyy-MM-dd",
                dateFields: ["valueX"]
            });

            let data = [{
                    date: "2021-01-01",
                    steps: 4561
                },
                {
                    date: "2021-01-02",
                    steps: 5687
                },
                {
                    date: "2021-01-03",
                    steps: 6348
                },
                {
                    date: "2021-01-04",
                    steps: 4878
                },
                {
                    date: "2021-01-05",
                    steps: 9867
                },
                {
                    date: "2021-01-06",
                    steps: 7561
                },
                {
                    date: "2021-01-07",
                    steps: 1287
                },
                {
                    date: "2021-01-08",
                    steps: 3298
                },
                {
                    date: "2021-01-09",
                    steps: 5697
                },
                {
                    date: "2021-01-10",
                    steps: 4878
                },
                {
                    date: "2021-01-11",
                    steps: 8788
                },
                {
                    date: "2021-01-12",
                    steps: 9560
                },
                {
                    date: "2021-01-13",
                    steps: 11687
                },
                {
                    date: "2021-01-14",
                    steps: 5878
                },
                {
                    date: "2021-01-15",
                    steps: 9789
                },
                {
                    date: "2021-01-16",
                    steps: 3987
                },
                {
                    date: "2021-01-17",
                    steps: 5898
                },
                {
                    date: "2021-01-18",
                    steps: 9878
                },
                {
                    date: "2021-01-19",
                    steps: 13687
                },
                {
                    date: "2021-01-20",
                    steps: 6789
                },
                {
                    date: "2021-01-21",
                    steps: 4531
                },
                {
                    date: "2021-01-22",
                    steps: 5856
                },
                {
                    date: "2021-01-23",
                    steps: 5737
                },
                {
                    date: "2021-01-24",
                    steps: 9987
                },
                {
                    date: "2021-01-25",
                    steps: 16457
                },
                {
                    date: "2021-01-26",
                    steps: 7878
                },
                {
                    date: "2021-01-27",
                    steps: 6845
                },
                {
                    date: "2021-01-28",
                    steps: 4659
                },
                {
                    date: "2021-01-29",
                    steps: 7892
                },
                {
                    date: "2021-01-30",
                    steps: 7362
                },
                {
                    date: "2021-01-31",
                    steps: 3268
                }
            ];
            let chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    focusable: true,
                    panX: true,
                    panY: false,
                    wheelX: "panX",
                    wheelY: "none",
                    paddingLeft: 0,
                    paddingRight: 0
                })
            );

            let easing = am5.ease.linear;

            // hide zoomout button
            chart.zoomOutButton.set("forceHidden", true);

            // add label
            chart.plotContainer.children.push(
                am5.Label.new(root, {
                    text: "Pan chart to change date",
                    x: 100,
                    y: 50
                })
            );
            let xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 50,
                strokeOpacity: 0.2,
                minorGridEnabled: true
            });
            xRenderer.grid.template.set("forceHidden", true);

            let xAxis = chart.xAxes.push(
                am5xy.DateAxis.new(root, {
                    maxDeviation: 0.49,
                    snapTooltip: false,
                    baseInterval: {
                        timeUnit: "day",
                        count: 1
                    },
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            let yRenderer = am5xy.AxisRendererY.new(root, {
                inside: true
            });
            yRenderer.grid.template.set("forceHidden", true);

            let yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0,
                    renderer: yRenderer
                })
            );
            let series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "steps",
                    valueXField: "date",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "vertical",
                        labelText: "{valueY}"
                    })
                })
            );

            series.columns.template.setAll({
                cornerRadiusTL: 15,
                cornerRadiusTR: 15,
                maxWidth: 30,
                strokeOpacity: 0
            });

            series.columns.template.adapters.add("fill", function(fill, target) {
                if (target.dataItem.get("valueY") < 6000) {
                    return am5.color(0xdadada);
                }
                return fill;
            });
            series.data.processor = am5.DataProcessor.new(root, {
                dateFormat: "yyyy-MM-dd",
                dateFields: ["date"]
            });

            series.data.setAll(data);

            // do not allow tooltip  to move horizontally
            series.get("tooltip").adapters.add("x", function(x) {
                return chart.plotContainer.toGlobal({
                    x: chart.plotContainer.width() / 2,
                    y: 0
                }).x;
            });

            // add ranges
            let goalRange = yAxis.createAxisRange(yAxis.makeDataItem({
                value: 6000
            }));

            goalRange.get("grid").setAll({
                forceHidden: false,
                strokeOpacity: 0.2
            });

            let goalLabel = goalRange.get("label");

            goalLabel.setAll({
                centerY: am5.p100,
                centerX: am5.p100,
                text: "Goal"
            });

            // put to other side
            goalLabel.adapters.add("x", function(x) {
                return chart.plotContainer.width();
            });

            let goalRange2 = yAxis.createAxisRange(yAxis.makeDataItem({
                value: 12000
            }));

            goalRange2.get("grid").setAll({
                forceHidden: false,
                strokeOpacity: 0.2
            });

            let goalLabel2 = goalRange2.get("label");

            goalLabel2.setAll({
                centerY: am5.p100,
                centerX: am5.p100,
                text: "2 x Goal"
            });

            // put to other side
            goalLabel2.adapters.add("x", function(x) {
                return chart.plotContainer.width();
            });

            // reposition when width changes
            chart.plotContainer.onPrivate("width", function() {
                goalLabel.markDirtyPosition();
                goalLabel2.markDirtyPosition();
            });
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                alwaysShow: true,
                behavior: "none",
                positionX: 0.5 // make it always be at the center
            }));
            cursor.lineY.set("visible", false);

            // zoom to last 11 days
            series.events.on("datavalidated", function() {
                let toTime =
                    series.dataItems[series.dataItems.length - 1].get("valueX") +
                    am5.time.getDuration("day", 1);
                let fromTime = series.dataItems[series.dataItems.length - 11].get("valueX");

                xAxis.zoomToValues(fromTime, toTime);
            });

            // when plot are is released, round zoom to nearest days
            chart.plotContainer.events.on("globalpointerup", function() {
                let dayDuration = am5.time.getDuration("day", 1);

                let firstTime = am5.time
                    .round(new Date(series.dataItems[0].get("valueX")), "day", 1)
                    .getTime();
                let lastTime =
                    series.dataItems[series.dataItems.length - 1].get("valueX") + dayDuration;
                let totalTime = lastTime - firstTime;
                let days = totalTime / dayDuration;

                let roundedStart =
                    firstTime + Math.round(days * xAxis.get("start")) * dayDuration;
                let roundedEnd =
                    firstTime + Math.round(days * xAxis.get("end")) * dayDuration;

                xAxis.zoomToValues(roundedStart, roundedEnd);
            });
            chart.appear(1000, 50);

        }); // end am5.ready()
    </script>

    {{-- ! LINE CHART --}}
    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-1");

            const myTheme = am5.Theme.new(root);

            // Move minor label a bit down
            myTheme.rule("AxisLabel", ["minor"]).setAll({
                dy: 1
            });

            // Tweak minor grid opacity
            myTheme.rule("Grid", ["minor"]).setAll({
                strokeOpacity: 0.08
            });
            root.setThemes([
                am5themes_Animated.new(root),
                myTheme
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0
            }));
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomX"
            }));
            cursor.lineY.set("visible", false);

            let date = new Date();
            date.setHours(0, 0, 0, 0);
            let value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                let data = [];
                for (let i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }
            let xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 200,
                    minorLabelsEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.set("minorDateFormats", {
                day: "dd",
                month: "MM"
            });

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            let series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            // Actual bullet
            series.bullets.push(function() {
                let bulletCircle = am5.Circle.new(root, {
                    radius: 5,
                    fill: series.get("fill")
                });
                return am5.Bullet.new(root, {
                    sprite: bulletCircle
                })
            })
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            let data = generateDatas(30);
            series.data.setAll(data);
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-2");

            const myTheme = am5.Theme.new(root);

            myTheme.rule("AxisLabel", ["minor"]).setAll({
                dy: 1
            });

            myTheme.rule("Grid", ["x"]).setAll({
                strokeOpacity: 0.05
            });

            myTheme.rule("Grid", ["x", "minor"]).setAll({
                strokeOpacity: 0.05
            });
            root.setThemes([
                am5themes_Animated.new(root),
                myTheme
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                maxTooltipDistance: 0,
                pinchZoomX: true
            }));


            let date = new Date();
            date.setHours(0, 0, 0, 0);
            let value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 4.2) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                let data = [];
                for (let i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }
            let xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0.2,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            for (let i = 0; i < 10; i++) {
                let series = chart.series.push(am5xy.LineSeries.new(root, {
                    name: "Series " + i,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value",
                    valueXField: "date",
                    legendValueText: "{valueY}",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "{valueY}"
                    })
                }));

                date = new Date();
                date.setHours(0, 0, 0, 0);
                value = 0;

                let data = generateDatas(100);
                series.data.setAll(data);
                series.appear();
            }
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            chart.set("scrollbarY", am5.Scrollbar.new(root, {
                orientation: "vertical"
            }));
            let legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
                width: 200,
                paddingLeft: 15,
                height: am5.percent(100)
            }));

            // When legend item container is hovered, dim all the series except the hovered one
            legend.itemContainers.template.events.on("pointerover", function(e) {
                let itemContainer = e.target;

                // As series list is data of a legend, dataContext is series
                let series = itemContainer.dataItem.dataContext;

                chart.series.each(function(chartSeries) {
                    if (chartSeries != series) {
                        chartSeries.strokes.template.setAll({
                            strokeOpacity: 0.15,
                            stroke: am5.color(0x000000)
                        });
                    } else {
                        chartSeries.strokes.template.setAll({
                            strokeWidth: 3
                        });
                    }
                })
            })

            // When legend item container is unhovered, make all series as they are
            legend.itemContainers.template.events.on("pointerout", function(e) {
                let itemContainer = e.target;
                let series = itemContainer.dataItem.dataContext;

                chart.series.each(function(chartSeries) {
                    chartSeries.strokes.template.setAll({
                        strokeOpacity: 1,
                        strokeWidth: 1,
                        stroke: chartSeries.get("fill")
                    });
                });
            })

            legend.itemContainers.template.set("width", am5.p100);
            legend.valueLabels.template.setAll({
                width: am5.p100,
                textAlign: "right"
            });
            legend.data.setAll(chart.series.values);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-3");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    pinchZoomX: true
                })
            );

            chart.get("colors").set("step", 5);

            let cursor = chart.set(
                "cursor",
                am5xy.XYCursor.new(root, {
                    behavior: "none"
                })
            );
            cursor.lineY.set("visible", false);
            let xAxis = chart.xAxes.push(
                am5xy.DateAxis.new(root, {
                    baseInterval: {
                        timeUnit: "day",
                        count: 1
                    },
                    renderer: am5xy.AxisRendererX.new(root, {
                        minorGridEnabled: true,
                        minGridDistance: 70
                    }),
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            let yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererY.new(root, {})
                })
            );
            let series1 = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: "Series",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "open",
                    openValueYField: "close",
                    valueXField: "date",
                    stroke: root.interfaceColors.get("positive"),
                    fill: root.interfaceColors.get("positive"),
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    })
                })
            );

            series1.fills.template.setAll({
                fillOpacity: 0.6,
                visible: true
            });

            let series2 = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: "Series",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "close",
                    valueXField: "date",
                    stroke: root.interfaceColors.get("negative"),
                    fill: root.interfaceColors.get("negative"),
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    })
                })
            );
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            let data = [{
                "date": 1635541200000,
                "open": 804,
                "close": 775
            }, {
                "date": 1635627600000,
                "open": 808,
                "close": 772
            }, {
                "date": 1635717600000,
                "open": 804,
                "close": 776
            }, {
                "date": 1635804000000,
                "open": 807,
                "close": 780
            }, {
                "date": 1635890400000,
                "open": 811,
                "close": 783
            }, {
                "date": 1635976800000,
                "open": 813,
                "close": 787
            }, {
                "date": 1636063200000,
                "open": 810,
                "close": 783
            }, {
                "date": 1636149600000,
                "open": 815,
                "close": 783
            }, {
                "date": 1636236000000,
                "open": 813,
                "close": 781
            }, {
                "date": 1636322400000,
                "open": 810,
                "close": 777
            }, {
                "date": 1636408800000,
                "open": 811,
                "close": 780
            }, {
                "date": 1636495200000,
                "open": 808,
                "close": 781
            }, {
                "date": 1636581600000,
                "open": 807,
                "close": 779
            }, {
                "date": 1636668000000,
                "open": 809,
                "close": 782
            }, {
                "date": 1636754400000,
                "open": 804,
                "close": 786
            }, {
                "date": 1636840800000,
                "open": 802,
                "close": 784
            }, {
                "date": 1636927200000,
                "open": 797,
                "close": 788
            }, {
                "date": 1637013600000,
                "open": 798,
                "close": 788
            }, {
                "date": 1637100000000,
                "open": 794,
                "close": 787
            }, {
                "date": 1637186400000,
                "open": 793,
                "close": 786
            }, {
                "date": 1637272800000,
                "open": 794,
                "close": 781
            }, {
                "date": 1637359200000,
                "open": 799,
                "close": 782
            }, {
                "date": 1637445600000,
                "open": 803,
                "close": 781
            }, {
                "date": 1637532000000,
                "open": 802,
                "close": 778
            }, {
                "date": 1637618400000,
                "open": 803,
                "close": 780
            }, {
                "date": 1637704800000,
                "open": 799,
                "close": 775
            }, {
                "date": 1637791200000,
                "open": 794,
                "close": 777
            }, {
                "date": 1637877600000,
                "open": 792,
                "close": 776
            }, {
                "date": 1637964000000,
                "open": 793,
                "close": 774
            }, {
                "date": 1638050400000,
                "open": 792,
                "close": 774
            }, {
                "date": 1638136800000,
                "open": 795,
                "close": 777
            }, {
                "date": 1638223200000,
                "open": 791,
                "close": 777
            }, {
                "date": 1638309600000,
                "open": 787,
                "close": 773
            }, {
                "date": 1638396000000,
                "open": 783,
                "close": 774
            }, {
                "date": 1638482400000,
                "open": 780,
                "close": 779
            }, {
                "date": 1638568800000,
                "open": 784,
                "close": 778
            }, {
                "date": 1638655200000,
                "open": 781,
                "close": 779
            }, {
                "date": 1638741600000,
                "open": 780,
                "close": 784
            }, {
                "date": 1638828000000,
                "open": 781,
                "close": 786
            }, {
                "date": 1638914400000,
                "open": 778,
                "close": 790
            }, {
                "date": 1639000800000,
                "open": 777,
                "close": 789
            }, {
                "date": 1639087200000,
                "open": 776,
                "close": 787
            }, {
                "date": 1639173600000,
                "open": 775,
                "close": 783
            }, {
                "date": 1639260000000,
                "open": 773,
                "close": 779
            }, {
                "date": 1639346400000,
                "open": 772,
                "close": 783
            }, {
                "date": 1639432800000,
                "open": 776,
                "close": 780
            }, {
                "date": 1639519200000,
                "open": 777,
                "close": 776
            }, {
                "date": 1639605600000,
                "open": 780,
                "close": 775
            }, {
                "date": 1639692000000,
                "open": 776,
                "close": 774
            }, {
                "date": 1639778400000,
                "open": 779,
                "close": 778
            }, {
                "date": 1639864800000,
                "open": 779,
                "close": 777
            }, {
                "date": 1639951200000,
                "open": 780,
                "close": 776
            }, {
                "date": 1640037600000,
                "open": 778,
                "close": 781
            }, {
                "date": 1640124000000,
                "open": 775,
                "close": 785
            }, {
                "date": 1640210400000,
                "open": 780,
                "close": 790
            }, {
                "date": 1640296800000,
                "open": 777,
                "close": 789
            }, {
                "date": 1640383200000,
                "open": 776,
                "close": 792
            }, {
                "date": 1640469600000,
                "open": 780,
                "close": 797
            }, {
                "date": 1640556000000,
                "open": 776,
                "close": 801
            }, {
                "date": 1640642400000,
                "open": 772,
                "close": 799
            }, {
                "date": 1640728800000,
                "open": 768,
                "close": 801
            }, {
                "date": 1640815200000,
                "open": 768,
                "close": 804
            }, {
                "date": 1640901600000,
                "open": 767,
                "close": 805
            }, {
                "date": 1640988000000,
                "open": 768,
                "close": 803
            }, {
                "date": 1641074400000,
                "open": 765,
                "close": 805
            }, {
                "date": 1641160800000,
                "open": 763,
                "close": 810
            }, {
                "date": 1641247200000,
                "open": 758,
                "close": 807
            }, {
                "date": 1641333600000,
                "open": 762,
                "close": 809
            }, {
                "date": 1641420000000,
                "open": 761,
                "close": 809
            }, {
                "date": 1641506400000,
                "open": 760,
                "close": 813
            }, {
                "date": 1641592800000,
                "open": 758,
                "close": 817
            }, {
                "date": 1641679200000,
                "open": 756,
                "close": 819
            }, {
                "date": 1641765600000,
                "open": 760,
                "close": 820
            }, {
                "date": 1641852000000,
                "open": 759,
                "close": 817
            }, {
                "date": 1641938400000,
                "open": 756,
                "close": 814
            }, {
                "date": 1642024800000,
                "open": 758,
                "close": 813
            }, {
                "date": 1642111200000,
                "open": 756,
                "close": 809
            }, {
                "date": 1642197600000,
                "open": 761,
                "close": 807
            }, {
                "date": 1642284000000,
                "open": 759,
                "close": 802
            }, {
                "date": 1642370400000,
                "open": 763,
                "close": 801
            }, {
                "date": 1642456800000,
                "open": 763,
                "close": 797
            }, {
                "date": 1642543200000,
                "open": 762,
                "close": 800
            }, {
                "date": 1642629600000,
                "open": 757,
                "close": 799
            }, {
                "date": 1642716000000,
                "open": 761,
                "close": 796
            }, {
                "date": 1642802400000,
                "open": 763,
                "close": 800
            }, {
                "date": 1642888800000,
                "open": 766,
                "close": 795
            }, {
                "date": 1642975200000,
                "open": 766,
                "close": 794
            }, {
                "date": 1643061600000,
                "open": 762,
                "close": 796
            }, {
                "date": 1643148000000,
                "open": 765,
                "close": 798
            }, {
                "date": 1643234400000,
                "open": 760,
                "close": 795
            }, {
                "date": 1643320800000,
                "open": 757,
                "close": 795
            }, {
                "date": 1643407200000,
                "open": 756,
                "close": 794
            }, {
                "date": 1643493600000,
                "open": 751,
                "close": 796
            }, {
                "date": 1643580000000,
                "open": 753,
                "close": 793
            }, {
                "date": 1643666400000,
                "open": 752,
                "close": 794
            }, {
                "date": 1643752800000,
                "open": 755,
                "close": 791
            }, {
                "date": 1643839200000,
                "open": 760,
                "close": 788
            }, {
                "date": 1643925600000,
                "open": 763,
                "close": 790
            }, {
                "date": 1644012000000,
                "open": 762,
                "close": 787
            }, {
                "date": 1644098400000,
                "open": 764,
                "close": 783
            }, {
                "date": 1644184800000,
                "open": 760,
                "close": 787
            }, {
                "date": 1644271200000,
                "open": 762,
                "close": 783
            }, {
                "date": 1644357600000,
                "open": 763,
                "close": 786
            }, {
                "date": 1644444000000,
                "open": 763,
                "close": 787
            }, {
                "date": 1644530400000,
                "open": 759,
                "close": 785
            }, {
                "date": 1644616800000,
                "open": 761,
                "close": 782
            }, {
                "date": 1644703200000,
                "open": 766,
                "close": 779
            }, {
                "date": 1644789600000,
                "open": 770,
                "close": 780
            }, {
                "date": 1644876000000,
                "open": 775,
                "close": 780
            }, {
                "date": 1644962400000,
                "open": 775,
                "close": 785
            }, {
                "date": 1645048800000,
                "open": 777,
                "close": 781
            }, {
                "date": 1645135200000,
                "open": 782,
                "close": 783
            }, {
                "date": 1645221600000,
                "open": 779,
                "close": 779
            }, {
                "date": 1645308000000,
                "open": 777,
                "close": 775
            }, {
                "date": 1645394400000,
                "open": 778,
                "close": 779
            }, {
                "date": 1645480800000,
                "open": 777,
                "close": 775
            }, {
                "date": 1645567200000,
                "open": 775,
                "close": 777
            }, {
                "date": 1645653600000,
                "open": 772,
                "close": 774
            }, {
                "date": 1645740000000,
                "open": 773,
                "close": 774
            }, {
                "date": 1645826400000,
                "open": 769,
                "close": 779
            }, {
                "date": 1645912800000,
                "open": 769,
                "close": 780
            }, {
                "date": 1645999200000,
                "open": 764,
                "close": 782
            }, {
                "date": 1646085600000,
                "open": 763,
                "close": 780
            }, {
                "date": 1646172000000,
                "open": 762,
                "close": 779
            }, {
                "date": 1646258400000,
                "open": 762,
                "close": 779
            }, {
                "date": 1646344800000,
                "open": 758,
                "close": 776
            }, {
                "date": 1646431200000,
                "open": 761,
                "close": 778
            }, {
                "date": 1646517600000,
                "open": 764,
                "close": 775
            }, {
                "date": 1646604000000,
                "open": 760,
                "close": 780
            }, {
                "date": 1646690400000,
                "open": 760,
                "close": 780
            }, {
                "date": 1646776800000,
                "open": 762,
                "close": 778
            }, {
                "date": 1646863200000,
                "open": 759,
                "close": 779
            }, {
                "date": 1646949600000,
                "open": 755,
                "close": 775
            }, {
                "date": 1647036000000,
                "open": 758,
                "close": 773
            }, {
                "date": 1647122400000,
                "open": 755,
                "close": 768
            }, {
                "date": 1647208800000,
                "open": 758,
                "close": 767
            }, {
                "date": 1647295200000,
                "open": 760,
                "close": 770
            }, {
                "date": 1647381600000,
                "open": 758,
                "close": 769
            }, {
                "date": 1647468000000,
                "open": 758,
                "close": 770
            }, {
                "date": 1647554400000,
                "open": 761,
                "close": 772
            }, {
                "date": 1647640800000,
                "open": 765,
                "close": 770
            }, {
                "date": 1647727200000,
                "open": 769,
                "close": 772
            }, {
                "date": 1647813600000,
                "open": 771,
                "close": 768
            }, {
                "date": 1647900000000,
                "open": 770,
                "close": 768
            }, {
                "date": 1647986400000,
                "open": 769,
                "close": 764
            }, {
                "date": 1648072800000,
                "open": 771,
                "close": 768
            }, {
                "date": 1648159200000,
                "open": 775,
                "close": 770
            }, {
                "date": 1648245600000,
                "open": 779,
                "close": 766
            }, {
                "date": 1648332000000,
                "open": 778,
                "close": 766
            }, {
                "date": 1648414800000,
                "open": 776,
                "close": 763
            }, {
                "date": 1648501200000,
                "open": 778,
                "close": 762
            }, {
                "date": 1648587600000,
                "open": 779,
                "close": 765
            }, {
                "date": 1648674000000,
                "open": 782,
                "close": 762
            }, {
                "date": 1648760400000,
                "open": 778,
                "close": 763
            }, {
                "date": 1648846800000,
                "open": 774,
                "close": 761
            }, {
                "date": 1648933200000,
                "open": 772,
                "close": 762
            }, {
                "date": 1649019600000,
                "open": 772,
                "close": 759
            }, {
                "date": 1649106000000,
                "open": 775,
                "close": 757
            }, {
                "date": 1649192400000,
                "open": 774,
                "close": 753
            }, {
                "date": 1649278800000,
                "open": 772,
                "close": 752
            }, {
                "date": 1649365200000,
                "open": 770,
                "close": 756
            }, {
                "date": 1649451600000,
                "open": 772,
                "close": 752
            }, {
                "date": 1649538000000,
                "open": 773,
                "close": 753
            }, {
                "date": 1649624400000,
                "open": 775,
                "close": 758
            }, {
                "date": 1649710800000,
                "open": 778,
                "close": 760
            }, {
                "date": 1649797200000,
                "open": 779,
                "close": 759
            }, {
                "date": 1649883600000,
                "open": 776,
                "close": 759
            }, {
                "date": 1649970000000,
                "open": 778,
                "close": 756
            }, {
                "date": 1650056400000,
                "open": 773,
                "close": 755
            }, {
                "date": 1650142800000,
                "open": 770,
                "close": 752
            }, {
                "date": 1650229200000,
                "open": 768,
                "close": 753
            }, {
                "date": 1650315600000,
                "open": 768,
                "close": 758
            }, {
                "date": 1650402000000,
                "open": 768,
                "close": 760
            }, {
                "date": 1650488400000,
                "open": 770,
                "close": 764
            }, {
                "date": 1650574800000,
                "open": 772,
                "close": 762
            }, {
                "date": 1650661200000,
                "open": 777,
                "close": 758
            }, {
                "date": 1650747600000,
                "open": 776,
                "close": 761
            }, {
                "date": 1650834000000,
                "open": 779,
                "close": 765
            }, {
                "date": 1650920400000,
                "open": 777,
                "close": 768
            }, {
                "date": 1651006800000,
                "open": 775,
                "close": 768
            }, {
                "date": 1651093200000,
                "open": 774,
                "close": 768
            }, {
                "date": 1651179600000,
                "open": 779,
                "close": 765
            }, {
                "date": 1651266000000,
                "open": 783,
                "close": 765
            }, {
                "date": 1651352400000,
                "open": 787,
                "close": 767
            }, {
                "date": 1651438800000,
                "open": 787,
                "close": 770
            }, {
                "date": 1651525200000,
                "open": 785,
                "close": 766
            }, {
                "date": 1651611600000,
                "open": 784,
                "close": 767
            }, {
                "date": 1651698000000,
                "open": 779,
                "close": 765
            }, {
                "date": 1651784400000,
                "open": 782,
                "close": 769
            }, {
                "date": 1651870800000,
                "open": 780,
                "close": 774
            }, {
                "date": 1651957200000,
                "open": 777,
                "close": 772
            }, {
                "date": 1652043600000,
                "open": 782,
                "close": 771
            }, {
                "date": 1652130000000,
                "open": 779,
                "close": 772
            }, {
                "date": 1652216400000,
                "open": 781,
                "close": 772
            }, {
                "date": 1652302800000,
                "open": 785,
                "close": 770
            }, {
                "date": 1652389200000,
                "open": 784,
                "close": 773
            }, {
                "date": 1652475600000,
                "open": 781,
                "close": 771
            }, {
                "date": 1652562000000,
                "open": 784,
                "close": 768
            }, {
                "date": 1652648400000,
                "open": 786,
                "close": 765
            }, {
                "date": 1652734800000,
                "open": 785,
                "close": 766
            }, {
                "date": 1652821200000,
                "open": 785,
                "close": 762
            }, {
                "date": 1652907600000,
                "open": 787,
                "close": 764
            }, {
                "date": 1652994000000,
                "open": 784,
                "close": 764
            }, {
                "date": 1653080400000,
                "open": 781,
                "close": 768
            }, {
                "date": 1653166800000,
                "open": 779,
                "close": 767
            }, {
                "date": 1653253200000,
                "open": 776,
                "close": 771
            }, {
                "date": 1653339600000,
                "open": 777,
                "close": 774
            }, {
                "date": 1653426000000,
                "open": 777,
                "close": 769
            }, {
                "date": 1653512400000,
                "open": 775,
                "close": 774
            }, {
                "date": 1653598800000,
                "open": 775,
                "close": 773
            }, {
                "date": 1653685200000,
                "open": 774,
                "close": 772
            }, {
                "date": 1653771600000,
                "open": 771,
                "close": 775
            }, {
                "date": 1653858000000,
                "open": 767,
                "close": 773
            }, {
                "date": 1653944400000,
                "open": 768,
                "close": 771
            }, {
                "date": 1654030800000,
                "open": 770,
                "close": 770
            }, {
                "date": 1654117200000,
                "open": 769,
                "close": 772
            }, {
                "date": 1654203600000,
                "open": 771,
                "close": 771
            }, {
                "date": 1654290000000,
                "open": 770,
                "close": 770
            }, {
                "date": 1654376400000,
                "open": 772,
                "close": 775
            }, {
                "date": 1654462800000,
                "open": 770,
                "close": 773
            }, {
                "date": 1654549200000,
                "open": 771,
                "close": 771
            }, {
                "date": 1654635600000,
                "open": 770,
                "close": 767
            }, {
                "date": 1654722000000,
                "open": 770,
                "close": 763
            }, {
                "date": 1654808400000,
                "open": 772,
                "close": 766
            }, {
                "date": 1654894800000,
                "open": 776,
                "close": 768
            }, {
                "date": 1654981200000,
                "open": 776,
                "close": 771
            }, {
                "date": 1655067600000,
                "open": 781,
                "close": 767
            }, {
                "date": 1655154000000,
                "open": 782,
                "close": 764
            }, {
                "date": 1655240400000,
                "open": 780,
                "close": 760
            }, {
                "date": 1655326800000,
                "open": 784,
                "close": 757
            }, {
                "date": 1655413200000,
                "open": 780,
                "close": 757
            }, {
                "date": 1655499600000,
                "open": 781,
                "close": 757
            }, {
                "date": 1655586000000,
                "open": 783,
                "close": 756
            }, {
                "date": 1655672400000,
                "open": 784,
                "close": 753
            }, {
                "date": 1655758800000,
                "open": 789,
                "close": 757
            }, {
                "date": 1655845200000,
                "open": 788,
                "close": 760
            }, {
                "date": 1655931600000,
                "open": 785,
                "close": 758
            }, {
                "date": 1656018000000,
                "open": 785,
                "close": 756
            }, {
                "date": 1656104400000,
                "open": 789,
                "close": 760
            }, {
                "date": 1656190800000,
                "open": 789,
                "close": 756
            }, {
                "date": 1656277200000,
                "open": 786,
                "close": 757
            }, {
                "date": 1656363600000,
                "open": 786,
                "close": 760
            }, {
                "date": 1656450000000,
                "open": 790,
                "close": 763
            }, {
                "date": 1656536400000,
                "open": 793,
                "close": 762
            }, {
                "date": 1656622800000,
                "open": 788,
                "close": 759
            }, {
                "date": 1656709200000,
                "open": 784,
                "close": 756
            }, {
                "date": 1656795600000,
                "open": 788,
                "close": 757
            }, {
                "date": 1656882000000,
                "open": 785,
                "close": 753
            }, {
                "date": 1656968400000,
                "open": 788,
                "close": 750
            }, {
                "date": 1657054800000,
                "open": 788,
                "close": 754
            }, {
                "date": 1657141200000,
                "open": 790,
                "close": 754
            }, {
                "date": 1657227600000,
                "open": 794,
                "close": 757
            }, {
                "date": 1657314000000,
                "open": 790,
                "close": 753
            }, {
                "date": 1657400400000,
                "open": 791,
                "close": 749
            }, {
                "date": 1657486800000,
                "open": 794,
                "close": 750
            }, {
                "date": 1657573200000,
                "open": 798,
                "close": 751
            }, {
                "date": 1657659600000,
                "open": 802,
                "close": 754
            }, {
                "date": 1657746000000,
                "open": 799,
                "close": 753
            }, {
                "date": 1657832400000,
                "open": 799,
                "close": 756
            }, {
                "date": 1657918800000,
                "open": 803,
                "close": 751
            }, {
                "date": 1658005200000,
                "open": 798,
                "close": 755
            }, {
                "date": 1658091600000,
                "open": 802,
                "close": 758
            }, {
                "date": 1658178000000,
                "open": 802,
                "close": 757
            }, {
                "date": 1658264400000,
                "open": 806,
                "close": 754
            }, {
                "date": 1658350800000,
                "open": 806,
                "close": 755
            }, {
                "date": 1658437200000,
                "open": 810,
                "close": 750
            }, {
                "date": 1658523600000,
                "open": 815,
                "close": 748
            }, {
                "date": 1658610000000,
                "open": 814,
                "close": 744
            }, {
                "date": 1658696400000,
                "open": 811,
                "close": 747
            }, {
                "date": 1658782800000,
                "open": 806,
                "close": 751
            }, {
                "date": 1658869200000,
                "open": 808,
                "close": 752
            }, {
                "date": 1658955600000,
                "open": 809,
                "close": 756
            }, {
                "date": 1659042000000,
                "open": 808,
                "close": 759
            }, {
                "date": 1659128400000,
                "open": 809,
                "close": 763
            }, {
                "date": 1659214800000,
                "open": 811,
                "close": 766
            }, {
                "date": 1659301200000,
                "open": 811,
                "close": 767
            }, {
                "date": 1659387600000,
                "open": 809,
                "close": 763
            }, {
                "date": 1659474000000,
                "open": 809,
                "close": 762
            }, {
                "date": 1659560400000,
                "open": 813,
                "close": 766
            }, {
                "date": 1659646800000,
                "open": 814,
                "close": 770
            }, {
                "date": 1659733200000,
                "open": 811,
                "close": 766
            }, {
                "date": 1659819600000,
                "open": 810,
                "close": 768
            }, {
                "date": 1659906000000,
                "open": 806,
                "close": 770
            }, {
                "date": 1659992400000,
                "open": 807,
                "close": 769
            }, {
                "date": 1660078800000,
                "open": 811,
                "close": 768
            }, {
                "date": 1660165200000,
                "open": 815,
                "close": 773
            }, {
                "date": 1660251600000,
                "open": 817,
                "close": 776
            }, {
                "date": 1660338000000,
                "open": 813,
                "close": 777
            }, {
                "date": 1660424400000,
                "open": 815,
                "close": 776
            }, {
                "date": 1660510800000,
                "open": 814,
                "close": 775
            }, {
                "date": 1660597200000,
                "open": 815,
                "close": 777
            }, {
                "date": 1660683600000,
                "open": 814,
                "close": 774
            }, {
                "date": 1660770000000,
                "open": 810,
                "close": 770
            }, {
                "date": 1660856400000,
                "open": 809,
                "close": 769
            }, {
                "date": 1660942800000,
                "open": 810,
                "close": 765
            }, {
                "date": 1661029200000,
                "open": 812,
                "close": 767
            }, {
                "date": 1661115600000,
                "open": 817,
                "close": 771
            }, {
                "date": 1661202000000,
                "open": 816,
                "close": 772
            }, {
                "date": 1661288400000,
                "open": 812,
                "close": 774
            }, {
                "date": 1661374800000,
                "open": 811,
                "close": 769
            }, {
                "date": 1661461200000,
                "open": 814,
                "close": 773
            }, {
                "date": 1661547600000,
                "open": 813,
                "close": 774
            }, {
                "date": 1661634000000,
                "open": 815,
                "close": 778
            }, {
                "date": 1661720400000,
                "open": 812,
                "close": 775
            }, {
                "date": 1661806800000,
                "open": 809,
                "close": 771
            }, {
                "date": 1661893200000,
                "open": 810,
                "close": 773
            }, {
                "date": 1661979600000,
                "open": 813,
                "close": 772
            }, {
                "date": 1662066000000,
                "open": 809,
                "close": 771
            }, {
                "date": 1662152400000,
                "open": 808,
                "close": 773
            }, {
                "date": 1662238800000,
                "open": 813,
                "close": 776
            }, {
                "date": 1662325200000,
                "open": 814,
                "close": 776
            }, {
                "date": 1662411600000,
                "open": 813,
                "close": 780
            }, {
                "date": 1662498000000,
                "open": 816,
                "close": 784
            }, {
                "date": 1662584400000,
                "open": 817,
                "close": 782
            }, {
                "date": 1662670800000,
                "open": 816,
                "close": 784
            }, {
                "date": 1662757200000,
                "open": 814,
                "close": 782
            }, {
                "date": 1662843600000,
                "open": 813,
                "close": 778
            }, {
                "date": 1662930000000,
                "open": 810,
                "close": 779
            }, {
                "date": 1663016400000,
                "open": 807,
                "close": 784
            }, {
                "date": 1663102800000,
                "open": 811,
                "close": 786
            }, {
                "date": 1663189200000,
                "open": 809,
                "close": 789
            }, {
                "date": 1663275600000,
                "open": 808,
                "close": 784
            }, {
                "date": 1663362000000,
                "open": 807,
                "close": 785
            }, {
                "date": 1663448400000,
                "open": 811,
                "close": 786
            }, {
                "date": 1663534800000,
                "open": 807,
                "close": 787
            }, {
                "date": 1663621200000,
                "open": 812,
                "close": 788
            }, {
                "date": 1663707600000,
                "open": 815,
                "close": 792
            }, {
                "date": 1663794000000,
                "open": 814,
                "close": 793
            }, {
                "date": 1663880400000,
                "open": 819,
                "close": 788
            }, {
                "date": 1663966800000,
                "open": 815,
                "close": 792
            }, {
                "date": 1664053200000,
                "open": 813,
                "close": 793
            }, {
                "date": 1664139600000,
                "open": 817,
                "close": 790
            }, {
                "date": 1664226000000,
                "open": 819,
                "close": 789
            }, {
                "date": 1664312400000,
                "open": 816,
                "close": 789
            }, {
                "date": 1664398800000,
                "open": 813,
                "close": 786
            }, {
                "date": 1664485200000,
                "open": 816,
                "close": 787
            }, {
                "date": 1664571600000,
                "open": 815,
                "close": 783
            }, {
                "date": 1664658000000,
                "open": 817,
                "close": 788
            }, {
                "date": 1664744400000,
                "open": 819,
                "close": 786
            }, {
                "date": 1664830800000,
                "open": 816,
                "close": 786
            }, {
                "date": 1664917200000,
                "open": 818,
                "close": 789
            }, {
                "date": 1665003600000,
                "open": 820,
                "close": 791
            }, {
                "date": 1665090000000,
                "open": 821,
                "close": 787
            }, {
                "date": 1665176400000,
                "open": 816,
                "close": 785
            }, {
                "date": 1665262800000,
                "open": 820,
                "close": 782
            }, {
                "date": 1665349200000,
                "open": 819,
                "close": 781
            }, {
                "date": 1665435600000,
                "open": 821,
                "close": 781
            }, {
                "date": 1665522000000,
                "open": 818,
                "close": 778
            }, {
                "date": 1665608400000,
                "open": 813,
                "close": 778
            }, {
                "date": 1665694800000,
                "open": 809,
                "close": 781
            }, {
                "date": 1665781200000,
                "open": 804,
                "close": 782
            }, {
                "date": 1665867600000,
                "open": 804,
                "close": 783
            }, {
                "date": 1665954000000,
                "open": 799,
                "close": 787
            }, {
                "date": 1666040400000,
                "open": 795,
                "close": 784
            }, {
                "date": 1666126800000,
                "open": 798,
                "close": 782
            }, {
                "date": 1666213200000,
                "open": 801,
                "close": 779
            }, {
                "date": 1666299600000,
                "open": 803,
                "close": 783
            }, {
                "date": 1666386000000,
                "open": 807,
                "close": 781
            }, {
                "date": 1666472400000,
                "open": 805,
                "close": 785
            }, {
                "date": 1666558800000,
                "open": 803,
                "close": 786
            }, {
                "date": 1666645200000,
                "open": 804,
                "close": 788
            }, {
                "date": 1666731600000,
                "open": 804,
                "close": 791
            }, {
                "date": 1666818000000,
                "open": 808,
                "close": 795
            }, {
                "date": 1666904400000,
                "open": 805,
                "close": 793
            }, {
                "date": 1666990800000,
                "open": 806,
                "close": 794
            }, {
                "date": 1667077200000,
                "open": 809,
                "close": 796
            }, {
                "date": 1667167200000,
                "open": 810,
                "close": 798
            }, {
                "date": 1667253600000,
                "open": 808,
                "close": 795
            }, {
                "date": 1667340000000,
                "open": 811,
                "close": 796
            }, {
                "date": 1667426400000,
                "open": 809,
                "close": 797
            }, {
                "date": 1667512800000,
                "open": 804,
                "close": 798
            }, {
                "date": 1667599200000,
                "open": 807,
                "close": 794
            }, {
                "date": 1667685600000,
                "open": 803,
                "close": 794
            }, {
                "date": 1667772000000,
                "open": 803,
                "close": 791
            }, {
                "date": 1667858400000,
                "open": 804,
                "close": 792
            }, {
                "date": 1667944800000,
                "open": 809,
                "close": 793
            }, {
                "date": 1668031200000,
                "open": 811,
                "close": 791
            }, {
                "date": 1668117600000,
                "open": 808,
                "close": 793
            }, {
                "date": 1668204000000,
                "open": 803,
                "close": 795
            }, {
                "date": 1668290400000,
                "open": 805,
                "close": 797
            }, {
                "date": 1668376800000,
                "open": 809,
                "close": 798
            }, {
                "date": 1668463200000,
                "open": 807,
                "close": 798
            }, {
                "date": 1668549600000,
                "open": 804,
                "close": 795
            }, {
                "date": 1668636000000,
                "open": 801,
                "close": 796
            }, {
                "date": 1668722400000,
                "open": 798,
                "close": 796
            }, {
                "date": 1668808800000,
                "open": 794,
                "close": 796
            }, {
                "date": 1668895200000,
                "open": 791,
                "close": 798
            }, {
                "date": 1668981600000,
                "open": 787,
                "close": 795
            }, {
                "date": 1669068000000,
                "open": 784,
                "close": 791
            }, {
                "date": 1669154400000,
                "open": 785,
                "close": 789
            }, {
                "date": 1669240800000,
                "open": 789,
                "close": 791
            }, {
                "date": 1669327200000,
                "open": 785,
                "close": 788
            }, {
                "date": 1669413600000,
                "open": 788,
                "close": 786
            }, {
                "date": 1669500000000,
                "open": 791,
                "close": 783
            }, {
                "date": 1669586400000,
                "open": 796,
                "close": 779
            }, {
                "date": 1669672800000,
                "open": 792,
                "close": 776
            }, {
                "date": 1669759200000,
                "open": 788,
                "close": 774
            }, {
                "date": 1669845600000,
                "open": 793,
                "close": 779
            }, {
                "date": 1669932000000,
                "open": 795,
                "close": 782
            }, {
                "date": 1670018400000,
                "open": 799,
                "close": 787
            }, {
                "date": 1670104800000,
                "open": 800,
                "close": 787
            }, {
                "date": 1670191200000,
                "open": 798,
                "close": 790
            }, {
                "date": 1670277600000,
                "open": 801,
                "close": 795
            }, {
                "date": 1670364000000,
                "open": 801,
                "close": 793
            }, {
                "date": 1670450400000,
                "open": 799,
                "close": 791
            }, {
                "date": 1670536800000,
                "open": 797,
                "close": 795
            }, {
                "date": 1670623200000,
                "open": 801,
                "close": 795
            }, {
                "date": 1670709600000,
                "open": 800,
                "close": 798
            }, {
                "date": 1670796000000,
                "open": 803,
                "close": 802
            }, {
                "date": 1670882400000,
                "open": 799,
                "close": 802
            }, {
                "date": 1670968800000,
                "open": 800,
                "close": 802
            }, {
                "date": 1671055200000,
                "open": 797,
                "close": 801
            }, {
                "date": 1671141600000,
                "open": 796,
                "close": 805
            }, {
                "date": 1671228000000,
                "open": 797,
                "close": 810
            }, {
                "date": 1671314400000,
                "open": 797,
                "close": 809
            }, {
                "date": 1671400800000,
                "open": 799,
                "close": 813
            }, {
                "date": 1671487200000,
                "open": 803,
                "close": 810
            }, {
                "date": 1671573600000,
                "open": 802,
                "close": 809
            }, {
                "date": 1671660000000,
                "open": 798,
                "close": 813
            }, {
                "date": 1671746400000,
                "open": 795,
                "close": 811
            }, {
                "date": 1671832800000,
                "open": 793,
                "close": 807
            }, {
                "date": 1671919200000,
                "open": 790,
                "close": 805
            }, {
                "date": 1672005600000,
                "open": 791,
                "close": 806
            }, {
                "date": 1672092000000,
                "open": 790,
                "close": 811
            }, {
                "date": 1672178400000,
                "open": 793,
                "close": 814
            }, {
                "date": 1672264800000,
                "open": 789,
                "close": 814
            }, {
                "date": 1672351200000,
                "open": 785,
                "close": 810
            }, {
                "date": 1672437600000,
                "open": 782,
                "close": 805
            }, {
                "date": 1672524000000,
                "open": 778,
                "close": 805
            }, {
                "date": 1672610400000,
                "open": 783,
                "close": 804
            }, {
                "date": 1672696800000,
                "open": 784,
                "close": 808
            }, {
                "date": 1672783200000,
                "open": 787,
                "close": 804
            }, {
                "date": 1672869600000,
                "open": 786,
                "close": 807
            }, {
                "date": 1672956000000,
                "open": 782,
                "close": 803
            }, {
                "date": 1673042400000,
                "open": 786,
                "close": 804
            }, {
                "date": 1673128800000,
                "open": 785,
                "close": 805
            }, {
                "date": 1673215200000,
                "open": 786,
                "close": 810
            }, {
                "date": 1673301600000,
                "open": 782,
                "close": 812
            }, {
                "date": 1673388000000,
                "open": 779,
                "close": 809
            }, {
                "date": 1673474400000,
                "open": 775,
                "close": 807
            }, {
                "date": 1673560800000,
                "open": 772,
                "close": 809
            }, {
                "date": 1673647200000,
                "open": 776,
                "close": 806
            }, {
                "date": 1673733600000,
                "open": 775,
                "close": 806
            }, {
                "date": 1673820000000,
                "open": 771,
                "close": 804
            }, {
                "date": 1673906400000,
                "open": 775,
                "close": 808
            }, {
                "date": 1673992800000,
                "open": 774,
                "close": 810
            }, {
                "date": 1674079200000,
                "open": 775,
                "close": 813
            }, {
                "date": 1674165600000,
                "open": 777,
                "close": 817
            }, {
                "date": 1674252000000,
                "open": 779,
                "close": 815
            }, {
                "date": 1674338400000,
                "open": 781,
                "close": 815
            }, {
                "date": 1674424800000,
                "open": 779,
                "close": 815
            }, {
                "date": 1674511200000,
                "open": 778,
                "close": 811
            }, {
                "date": 1674597600000,
                "open": 773,
                "close": 812
            }, {
                "date": 1674684000000,
                "open": 769,
                "close": 813
            }, {
                "date": 1674770400000,
                "open": 772,
                "close": 811
            }, {
                "date": 1674856800000,
                "open": 767,
                "close": 815
            }, {
                "date": 1674943200000,
                "open": 764,
                "close": 816
            }, {
                "date": 1675029600000,
                "open": 759,
                "close": 811
            }, {
                "date": 1675116000000,
                "open": 759,
                "close": 813
            }, {
                "date": 1675202400000,
                "open": 763,
                "close": 816
            }, {
                "date": 1675288800000,
                "open": 764,
                "close": 815
            }, {
                "date": 1675375200000,
                "open": 761,
                "close": 817
            }, {
                "date": 1675461600000,
                "open": 759,
                "close": 816
            }, {
                "date": 1675548000000,
                "open": 759,
                "close": 814
            }, {
                "date": 1675634400000,
                "open": 761,
                "close": 809
            }, {
                "date": 1675720800000,
                "open": 764,
                "close": 810
            }, {
                "date": 1675807200000,
                "open": 763,
                "close": 813
            }, {
                "date": 1675893600000,
                "open": 759,
                "close": 810
            }, {
                "date": 1675980000000,
                "open": 757,
                "close": 808
            }, {
                "date": 1676066400000,
                "open": 758,
                "close": 804
            }, {
                "date": 1676152800000,
                "open": 757,
                "close": 808
            }, {
                "date": 1676239200000,
                "open": 755,
                "close": 808
            }, {
                "date": 1676325600000,
                "open": 753,
                "close": 812
            }, {
                "date": 1676412000000,
                "open": 751,
                "close": 810
            }, {
                "date": 1676498400000,
                "open": 754,
                "close": 814
            }, {
                "date": 1676584800000,
                "open": 750,
                "close": 818
            }, {
                "date": 1676671200000,
                "open": 746,
                "close": 814
            }, {
                "date": 1676757600000,
                "open": 742,
                "close": 810
            }, {
                "date": 1676844000000,
                "open": 743,
                "close": 806
            }, {
                "date": 1676930400000,
                "open": 740,
                "close": 810
            }, {
                "date": 1677016800000,
                "open": 744,
                "close": 812
            }, {
                "date": 1677103200000,
                "open": 740,
                "close": 812
            }, {
                "date": 1677189600000,
                "open": 742,
                "close": 808
            }, {
                "date": 1677276000000,
                "open": 741,
                "close": 809
            }, {
                "date": 1677362400000,
                "open": 738,
                "close": 807
            }, {
                "date": 1677448800000,
                "open": 738,
                "close": 809
            }, {
                "date": 1677535200000,
                "open": 737,
                "close": 809
            }, {
                "date": 1677621600000,
                "open": 733,
                "close": 808
            }, {
                "date": 1677708000000,
                "open": 730,
                "close": 807
            }, {
                "date": 1677794400000,
                "open": 729,
                "close": 807
            }, {
                "date": 1677880800000,
                "open": 725,
                "close": 812
            }, {
                "date": 1677967200000,
                "open": 720,
                "close": 812
            }, {
                "date": 1678053600000,
                "open": 716,
                "close": 814
            }, {
                "date": 1678140000000,
                "open": 711,
                "close": 814
            }, {
                "date": 1678226400000,
                "open": 710,
                "close": 810
            }, {
                "date": 1678312800000,
                "open": 714,
                "close": 810
            }, {
                "date": 1678399200000,
                "open": 712,
                "close": 815
            }, {
                "date": 1678485600000,
                "open": 715,
                "close": 812
            }, {
                "date": 1678572000000,
                "open": 718,
                "close": 813
            }, {
                "date": 1678658400000,
                "open": 717,
                "close": 809
            }];
            series1.data.setAll(data);
            series2.data.setAll(data);

            // create ranges
            let i = 0;
            let baseInterval = xAxis.get("baseInterval");
            let baseDuration = xAxis.baseDuration();
            let rangeDataItem;

            am5.array.each(series1.dataItems, function(s1DataItem) {
                let s1PreviousDataItem;
                let s2PreviousDataItem;

                let s2DataItem = series2.dataItems[i];

                if (i > 0) {
                    s1PreviousDataItem = series1.dataItems[i - 1];
                    s2PreviousDataItem = series2.dataItems[i - 1];
                }

                let startTime = am5.time
                    .round(
                        new Date(s1DataItem.get("valueX")),
                        baseInterval.timeUnit,
                        baseInterval.count
                    )
                    .getTime();

                // intersections
                if (s1PreviousDataItem && s2PreviousDataItem) {
                    let x0 =
                        am5.time
                        .round(
                            new Date(s1PreviousDataItem.get("valueX")),
                            baseInterval.timeUnit,
                            baseInterval.count
                        )
                        .getTime() +
                        baseDuration / 2;
                    let y01 = s1PreviousDataItem.get("valueY");
                    let y02 = s2PreviousDataItem.get("valueY");

                    let x1 = startTime + baseDuration / 2;
                    let y11 = s1DataItem.get("valueY");
                    let y12 = s2DataItem.get("valueY");

                    let intersection = getLineIntersection({
                        x: x0,
                        y: y01
                    }, {
                        x: x1,
                        y: y11
                    }, {
                        x: x0,
                        y: y02
                    }, {
                        x: x1,
                        y: y12
                    });

                    startTime = Math.round(intersection.x);
                }

                // start range here
                if (s2DataItem.get("valueY") > s1DataItem.get("valueY")) {
                    if (!rangeDataItem) {
                        rangeDataItem = xAxis.makeDataItem({});
                        let range = series1.createAxisRange(rangeDataItem);
                        rangeDataItem.set("value", startTime);
                        range.fills.template.setAll({
                            fill: series2.get("fill"),
                            fillOpacity: 0.6,
                            visible: true
                        });
                        range.strokes.template.setAll({
                            stroke: series1.get("stroke"),
                            strokeWidth: 1
                        });
                    }
                } else {
                    // if negative range started
                    if (rangeDataItem) {
                        rangeDataItem.set("endValue", startTime);
                    }

                    rangeDataItem = undefined;
                }
                // end if last
                if (i == series1.dataItems.length - 1) {
                    if (rangeDataItem) {
                        rangeDataItem.set(
                            "endValue",
                            s1DataItem.get("valueX") + baseDuration / 2
                        );
                        rangeDataItem = undefined;
                    }
                }

                i++;
            });

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series1.appear(1000);
            series2.appear(1000);
            chart.appear(1000, 100);

            function getLineIntersection(pointA1, pointA2, pointB1, pointB2) {
                let x =
                    ((pointA1.x * pointA2.y - pointA2.x * pointA1.y) * (pointB1.x - pointB2.x) -
                        (pointA1.x - pointA2.x) *
                        (pointB1.x * pointB2.y - pointB1.y * pointB2.x)) /
                    ((pointA1.x - pointA2.x) * (pointB1.y - pointB2.y) -
                        (pointA1.y - pointA2.y) * (pointB1.x - pointB2.x));
                let y =
                    ((pointA1.x * pointA2.y - pointA2.x * pointA1.y) * (pointB1.y - pointB2.y) -
                        (pointA1.y - pointA2.y) *
                        (pointB1.x * pointB2.y - pointB1.y * pointB2.x)) /
                    ((pointA1.x - pointA2.x) * (pointB1.y - pointB2.y) -
                        (pointA1.y - pointA2.y) * (pointB1.x - pointB2.x));
                return {
                    x: x,
                    y: y
                };
            }

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-4");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0
            }));
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // The data
            let data = [{
                "year": "1994",
                "cars": 1587,
                "motorcycles": 650,
                "bicycles": 121
            }, {
                "year": "1995",
                "cars": 1567,
                "motorcycles": 683,
                "bicycles": 146
            }, {
                "year": "1996",
                "cars": 1617,
                "motorcycles": 691,
                "bicycles": 138
            }, {
                "year": "1997",
                "cars": 1630,
                "motorcycles": 642,
                "bicycles": 127
            }, {
                "year": "1998",
                "cars": 1660,
                "motorcycles": 699,
                "bicycles": 105
            }, {
                "year": "1999",
                "cars": 1683,
                "motorcycles": 721,
                "bicycles": 109
            }, {
                "year": "2000",
                "cars": 1691,
                "motorcycles": 737,
                "bicycles": 112
            }, {
                "year": "2001",
                "cars": 1298,
                "motorcycles": 680,
                "bicycles": 101
            }, {
                "year": "2002",
                "cars": 1275,
                "motorcycles": 664,
                "bicycles": 97
            }, {
                "year": "2003",
                "cars": 1246,
                "motorcycles": 648,
                "bicycles": 93
            }, {
                "year": "2004",
                "cars": 1318,
                "motorcycles": 697,
                "bicycles": 111
            }, {
                "year": "2005",
                "cars": 1213,
                "motorcycles": 633,
                "bicycles": 87
            }, {
                "year": "2006",
                "cars": 1199,
                "motorcycles": 621,
                "bicycles": 79
            }, {
                "year": "2007",
                "cars": 1110,
                "motorcycles": 210,
                "bicycles": 81
            }, {
                "year": "2008",
                "cars": 1165,
                "motorcycles": 232,
                "bicycles": 75
            }, {
                "year": "2009",
                "cars": 1145,
                "motorcycles": 219,
                "bicycles": 88
            }, {
                "year": "2010",
                "cars": 1163,
                "motorcycles": 201,
                "bicycles": 82
            }, {
                "year": "2011",
                "cars": 1180,
                "motorcycles": 285,
                "bicycles": 87
            }, {
                "year": "2012",
                "cars": 1159,
                "motorcycles": 277,
                "bicycles": 71
            }];
            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "year",
                startLocation: 0.5,
                endLocation: 0.5,
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 70
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.data.setAll(data);

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    pan: "zoom"
                })
            }));

            function createSeries(name, field) {
                let series = chart.series.push(am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    stacked: true,
                    valueYField: field,
                    categoryXField: "year",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "[bold]{name}[/]\n{categoryX}: {valueY}"
                    })
                }));

                series.fills.template.setAll({
                    fillOpacity: 0.5,
                    visible: true
                });

                series.data.setAll(data);
                series.appear(1000);
            }

            createSeries("Cars", "cars");
            createSeries("Motorcycles", "motorcycles");
            createSeries("Bicycles", "bicycles");
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));
            let rangeDataItem = xAxis.makeDataItem({
                category: "2001",
                endCategory: "2003"
            });

            let range = xAxis.createAxisRange(rangeDataItem);

            rangeDataItem.get("grid").setAll({
                stroke: am5.color(0x00ff33),
                strokeOpacity: 0.5,
                strokeDasharray: [3]
            });

            rangeDataItem.get("axisFill").setAll({
                fill: am5.color(0x00ff33),
                fillOpacity: 0.1,
                visible: true
            });

            rangeDataItem.get("label").setAll({
                inside: true,
                text: "Fines for speeding increased",
                rotation: 90,
                centerX: am5.p100,
                centerY: am5.p100,
                location: 0,
                paddingBottom: 10,
                paddingRight: 15
            });


            let rangeDataItem2 = xAxis.makeDataItem({
                category: "2007"
            });

            let range2 = xAxis.createAxisRange(rangeDataItem2);

            rangeDataItem2.get("grid").setAll({
                stroke: am5.color(0x00ff33),
                strokeOpacity: 1,
                strokeDasharray: [3]
            });

            rangeDataItem2.get("axisFill").setAll({
                fill: am5.color(0x00ff33),
                fillOpacity: 0.1,
                visible: true
            });

            rangeDataItem2.get("label").setAll({
                inside: true,
                text: "Motorcycle fee introduced",
                rotation: 90,
                centerX: am5.p100,
                centerY: am5.p100,
                location: 0,
                paddingBottom: 10,
                paddingRight: 15
            });
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-5");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.horizontalLayout
            }));
            let legend = chart.children.push(
                am5.Legend.new(root, {
                    centerY: am5.p50,
                    y: am5.p50,
                    layout: root.verticalLayout,
                    clickTarget: "none"
                })
            );

            legend.valueLabels.template.set("forceHidden", true);


            // Data
            let data = [{
                    year: "1896",
                    uk: 7,
                    ussr: 0,
                    russia: 0,
                    usa: 20,
                    china: 0
                },
                {
                    year: "1900",
                    uk: 78,
                    ussr: 0,
                    russia: 0,
                    usa: 55,
                    china: 0
                },
                {
                    year: "1904",
                    uk: 2,
                    ussr: 0,
                    russia: 0,
                    usa: 394,
                    china: 0
                },
                {
                    year: "1908",
                    uk: 347,
                    ussr: 0,
                    russia: 0,
                    usa: 63,
                    china: 0
                },
                {
                    year: "1912",
                    uk: 160,
                    ussr: 0,
                    russia: 0,
                    usa: 101,
                    china: 0
                },
                {
                    year: "1916",
                    uk: 0,
                    ussr: 0,
                    russia: 0,
                    usa: 0,
                    china: 0
                },
                {
                    year: "1920",
                    uk: 107,
                    ussr: 0,
                    russia: 0,
                    usa: 193,
                    china: 0
                },
                {
                    year: "1924",
                    uk: 66,
                    ussr: 0,
                    russia: 0,
                    usa: 198,
                    china: 0
                },
                {
                    year: "1928",
                    uk: 55,
                    ussr: 0,
                    russia: 0,
                    usa: 84,
                    china: 0
                },
                {
                    year: "1932",
                    uk: 34,
                    ussr: 0,
                    russia: 0,
                    usa: 181,
                    china: 0
                },
                {
                    year: "1936",
                    uk: 36,
                    ussr: 0,
                    russia: 0,
                    usa: 92,
                    china: 0
                },
                {
                    year: "1940",
                    uk: 0,
                    ussr: 0,
                    russia: 0,
                    usa: 0,
                    china: 0
                },
                {
                    year: "1944",
                    uk: 0,
                    ussr: 0,
                    russia: 0,
                    usa: 0,
                    china: 0
                },
                {
                    year: "1948",
                    uk: 56,
                    ussr: 0,
                    russia: 0,
                    usa: 148,
                    china: 0
                },
                {
                    year: "1952",
                    uk: 31,
                    ussr: 117,
                    russia: 0,
                    usa: 130,
                    china: 0
                },
                {
                    year: "1956",
                    uk: 45,
                    ussr: 169,
                    russia: 0,
                    usa: 118,
                    china: 0
                },
                {
                    year: "1960",
                    uk: 28,
                    ussr: 169,
                    russia: 0,
                    usa: 112,
                    china: 0
                },
                {
                    year: "1964",
                    uk: 28,
                    ussr: 174,
                    russia: 0,
                    usa: 150,
                    china: 0
                },
                {
                    year: "1968",
                    uk: 18,
                    ussr: 188,
                    russia: 0,
                    usa: 149,
                    china: 0
                },
                {
                    year: "1972",
                    uk: 29,
                    ussr: 211,
                    russia: 0,
                    usa: 155,
                    china: 0
                },
                {
                    year: "1976",
                    uk: 32,
                    ussr: 285,
                    russia: 0,
                    usa: 155,
                    china: 0
                },
                {
                    year: "1980",
                    uk: 45,
                    ussr: 442,
                    russia: 0,
                    usa: 0,
                    china: 0
                },
                {
                    year: "1984",
                    uk: 72,
                    ussr: 0,
                    russia: 0,
                    usa: 333,
                    china: 76
                },
                {
                    year: "1988",
                    uk: 53,
                    ussr: 294,
                    russia: 0,
                    usa: 193,
                    china: 53
                },
                {
                    year: "1992",
                    uk: 50,
                    ussr: 0,
                    russia: 0,
                    usa: 224,
                    china: 83
                },
                {
                    year: "1996",
                    uk: 26,
                    ussr: 0,
                    russia: 115,
                    usa: 260,
                    china: 110
                },
                {
                    year: "2000",
                    uk: 55,
                    ussr: 0,
                    russia: 188,
                    usa: 248,
                    china: 79
                },
                {
                    year: "2004",
                    uk: 57,
                    ussr: 0,
                    russia: 192,
                    usa: 264,
                    china: 94
                },
                {
                    year: "2008",
                    uk: 77,
                    ussr: 0,
                    russia: 143,
                    usa: 315,
                    china: 184
                }
            ];
            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "year",
                startLocation: 0.5,
                endLocation: 0.5,
                renderer: am5xy.AxisRendererX.new(root, {
                    pan: "zoom",
                    minorGridEnabled: true,
                    minGridDistance: 50
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.data.setAll(data);

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    pan: "zoom"
                })
            }));

            function createSeries(field, name) {
                let series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueField: field,
                    valueYField: field + "_hi",
                    openValueYField: field + "_low",
                    categoryXField: "year",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "[fontSize: 18px]{name}[/]\n{categoryX}: [bold]{" + field +
                            "}[/]"
                    })
                }));

                // Do not show tooltip for zero values
                series.get("tooltip").adapters.add("visible", function(visible, target) {
                    if (target.dataItem && (target.dataItem.get("value") > 0)) {
                        return true;
                    }
                    return false;
                });

                series.strokes.template.setAll({
                    forceHidden: true
                });

                series.fills.template.setAll({
                    visible: true,
                    fillOpacity: 1
                });
                series.appear();

                legend.data.push(series);
            }

            createSeries("uk", "United Kingdom");
            createSeries("ussr", "Soviet Union");
            createSeries("russia", "Russia");
            createSeries("usa", "United States");
            createSeries("china", "China");

            // Prepare data for the river-stacked series
            for (let i = 0; i < data.length; i++) {
                let row = data[i];
                let sum = 0;

                // Calculate open and close values
                chart.series.each(function(series) {
                    let field = series.get("valueField");
                    let val = Number(row[field]);
                    row[field + "_low"] = sum;
                    row[field + "_hi"] = sum + val;
                    sum += val;
                });

                // Adjust values so they are centered
                let offset = sum / 2;
                chart.series.each(function(series) {
                    let field = series.get("valueField");
                    row[field + "_low"] -= offset;
                    row[field + "_hi"] -= offset;
                });

                chart.series.each(function(series) {
                    let field = series.get("valueField");
                    series.data.setAll(data);
                });

            }
            chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomXY",
                xAxis: xAxis
            }));
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-6");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    focusable: true,
                    panX: false,
                    panY: false,
                    wheelX: "none",
                    wheelY: "none"
                })
            );

            // Chart title
            let title = chart.plotContainer.children.push(am5.Label.new(root, {
                text: "Price (BTC/ETH)",
                fontSize: 20,
                fontWeight: "400",
                x: am5.p50,
                centerX: am5.p50
            }))
            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "value",
                renderer: am5xy.AxisRendererX.new(root, {
                    minGridDistance: 70
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.get("renderer").labels.template.adapters.add("text", function(text, target) {
                if (target.dataItem) {
                    return root.numberFormatter.format(Number(target.dataItem.get("category")), "#.####");
                }
                return text;
            });

            let yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0.1,
                    renderer: am5xy.AxisRendererY.new(root, {})
                })
            );
            let bidsTotalVolume = chart.series.push(am5xy.StepLineSeries.new(root, {
                minBulletDistance: 10,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "bidstotalvolume",
                categoryXField: "value",
                stroke: am5.color(0x00ff00),
                fill: am5.color(0x00ff00),
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "[width: 120px]Ask:[/][bold]{categoryX}[/]\n[width: 120px]Total volume:[/][bold]{valueY}[/]\n[width: 120px]Volume:[/][bold]{bidsvolume}[/]"
                })
            }));
            bidsTotalVolume.strokes.template.set("strokeWidth", 2)
            bidsTotalVolume.fills.template.setAll({
                visible: true,
                fillOpacity: 0.2
            });

            let asksTotalVolume = chart.series.push(am5xy.StepLineSeries.new(root, {
                minBulletDistance: 10,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "askstotalvolume",
                categoryXField: "value",
                stroke: am5.color(0xf00f00),
                fill: am5.color(0xff0000),
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "[width: 120px]Ask:[/][bold]{categoryX}[/]\n[width: 120px]Total volume:[/][bold]{valueY}[/]\n[width: 120px]Volume:[/][bold]{asksvolume}[/]"
                })
            }));
            asksTotalVolume.strokes.template.set("strokeWidth", 2)
            asksTotalVolume.fills.template.setAll({
                visible: true,
                fillOpacity: 0.2
            });

            let bidVolume = chart.series.push(am5xy.ColumnSeries.new(root, {
                minBulletDistance: 10,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "bidsvolume",
                categoryXField: "value",
                fill: am5.color(0x000000)
            }));
            bidVolume.columns.template.set("fillOpacity", 0.2);

            let asksVolume = chart.series.push(am5xy.ColumnSeries.new(root, {
                minBulletDistance: 10,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "asksvolume",
                categoryXField: "value",
                fill: am5.color(0x000000)
            }));
            asksVolume.columns.template.set("fillOpacity", 0.2);
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                xAxis: xAxis
            }));
            cursor.lineY.set("visible", false);

            // Data loader
            function loadData() {
                am5.net.load("https://poloniex.com/public?command=returnOrderBook&currencyPair=BTC_ETH&depth=50")
                    .then(function(result) {
                        let data = am5.JSONParser.parse(result.response);
                        parseData(data);
                    }).catch(function() {
                        // Failed to load
                        // Using drop-in data
                        parseData({
                            "asks": [
                                ["0.07070", 1.0],
                                ["0.07071", 1.654],
                                ["0.07076", 0.61],
                                ["0.07077", 1.2],
                                ["0.07093", 0.584],
                                ["0.07095", 0.005],
                                ["0.07098", 0.01],
                                ["0.07100", 0.653],
                                ["0.07105", 6.0],
                                ["0.07107", 0.002],
                                ["0.07110", 0.022],
                                ["0.07113", 0.001],
                                ["0.07115", 0.001],
                                ["0.07117", 0.001],
                                ["0.07119", 0.001],
                                ["0.07123", 0.001],
                                ["0.07124", 0.002],
                                ["0.07125", 0.001],
                                ["0.07127", 0.001],
                                ["0.07129", 0.001],
                                ["0.07130", 0.001],
                                ["0.07131", 0.001],
                                ["0.07133", 0.001],
                                ["0.07135", 0.002],
                                ["0.07137", 0.001],
                                ["0.07139", 0.001],
                                ["0.07141", 0.001],
                                ["0.07143", 0.001],
                                ["0.07145", 0.001],
                                ["0.07147", 0.004],
                                ["0.07148", 6.311],
                                ["0.07149", 0.001],
                                ["0.07150", 10.03],
                                ["0.07151", 0.001],
                                ["0.07153", 0.001],
                                ["0.07155", 0.001],
                                ["0.07157", 0.001],
                                ["0.07159", 0.001],
                                ["0.07161", 0.001],
                                ["0.07162", 0.238],
                                ["0.07163", 0.001],
                                ["0.07164", 0.584],
                                ["0.07165", 0.541],
                                ["0.07167", 0.001],
                                ["0.07169", 0.001],
                                ["0.07171", 0.001],
                                ["0.07173", 0.001],
                                ["0.07175", 0.017],
                                ["0.07177", 0.001],
                                ["0.07179", 0.001]
                            ],
                            "bids": [
                                ["0.07060", 1.001],
                                ["0.07059", 1.544],
                                ["0.07056", 0.61],
                                ["0.07053", 0.002],
                                ["0.07048", 1.2],
                                ["0.07040", 0.05],
                                ["0.07031", 0.663],
                                ["0.07024", 0.005],
                                ["0.07020", 5.99],
                                ["0.07010", 0.022],
                                ["0.07006", 0.001],
                                ["0.07005", 0.003],
                                ["0.07000", 1.0],
                                ["0.06993", 0.002],
                                ["0.06990", 6.15],
                                ["0.06989", 0.519],
                                ["0.06986", 0.001],
                                ["0.06983", 0.024],
                                ["0.06980", 0.031],
                                ["0.06978", 0.01],
                                ["0.06977", 0.81],
                                ["0.06975", 0.053],
                                ["0.06970", 0.022],
                                ["0.06967", 0.531],
                                ["0.06962", 0.017],
                                ["0.06955", 0.004],
                                ["0.06953", 0.002],
                                ["0.06951", 0.031],
                                ["0.06950", 10.0],
                                ["0.06933", 0.301],
                                ["0.06932", 0.606],
                                ["0.06931", 0.022],
                                ["0.06929", 0.015],
                                ["0.06924", 2.48],
                                ["0.06923", 0.5],
                                ["0.06922", 0.2],
                                ["0.06921", 0.5],
                                ["0.06918", 0.03],
                                ["0.06915", 0.001],
                                ["0.06912", 0.069],
                                ["0.06911", 0.002],
                                ["0.06905", 0.003],
                                ["0.06900", 20.39],
                                ["0.06899", 0.002],
                                ["0.06897", 0.242],
                                ["0.06886", 0.808],
                                ["0.06880", 0.026],
                                ["0.06872", 1.0],
                                ["0.06868", 0.005],
                                ["0.06862", 0.584]
                            ],
                            "isFrozen": "0",
                            "postOnly": "0",
                            "seq": 67767369
                        })
                    });
            }

            function parseData(data) {
                let res = [];
                processData(data.bids, "bids", true, res);
                processData(data.asks, "asks", false, res);
                xAxis.data.setAll(res);
                bidsTotalVolume.data.setAll(res);
                asksTotalVolume.data.setAll(res);
                bidVolume.data.setAll(res);
                asksVolume.data.setAll(res);
            }

            loadData();

            setInterval(loadData, 30000);

            function processData(list, type, desc, res) {

                // Convert to data points
                for (let i = 0; i < list.length; i++) {
                    list[i] = {
                        value: Number(list[i][0]),
                        volume: Number(list[i][1]),
                    }
                }

                // Sort list just in case
                list.sort(function(a, b) {
                    if (a.value > b.value) {
                        return 1;
                    } else if (a.value < b.value) {
                        return -1;
                    } else {
                        return 0;
                    }
                });

                // Calculate cummulative volume
                if (desc) {
                    for (let i = list.length - 1; i >= 0; i--) {
                        if (i < (list.length - 1)) {
                            list[i].totalvolume = list[i + 1].totalvolume + list[i].volume;
                        } else {
                            list[i].totalvolume = list[i].volume;
                        }
                        let dp = {};
                        dp["value"] = list[i].value;
                        dp[type + "volume"] = list[i].volume;
                        dp[type + "totalvolume"] = list[i].totalvolume;
                        res.unshift(dp);
                    }
                } else {
                    for (let i = 0; i < list.length; i++) {
                        if (i > 0) {
                            list[i].totalvolume = list[i - 1].totalvolume + list[i].volume;
                        } else {
                            list[i].totalvolume = list[i].volume;
                        }
                        let dp = {};
                        dp["value"] = list[i].value;
                        dp[type + "volume"] = list[i].volume;
                        dp[type + "totalvolume"] = list[i].totalvolume;
                        res.push(dp);
                    }
                }

            }

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-7");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0
            }));

            chart.get("colors").set("step", 5);

            let legend = chart.plotContainer.children.push(am5.Legend.new(root, {
                centerY: am5.p100,
                y: am5.p100
            }));

            legend.valueLabels.template.set("width", 120);
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // Generate random data
            let date = new Date();
            let value = 0;

            function generateData() {
                value = am5.math.round((Math.random() * 2 - 1) + value, 2);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                value = Math.random() * 50;
                date.setFullYear(2023, 0, 1);
                date.setHours(0, 0, 0, 0);
                let data = [];
                for (let i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }
            let xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0.2,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 70
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    pan: "zoom"
                }),
                numberFormat: "#'%'"
            }));


            function createSeries(name) {
                let tooltip = am5.Tooltip.new(root, {
                    getStrokeFromSprite: true,
                    getFillFromSprite: false,
                    labelText: "${valueY} {valueYChangeSelectionPercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%"
                })

                tooltip.get("background").setAll({
                    fill: am5.color(0xffffff)
                })
                let series = chart.series.push(am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    calculateAggregates: true,
                    valueYField: "value",
                    valueXField: "date",
                    valueYShow: "valueYChangeSelectionPercent",
                    legendValueText: "${valueY} {valueYChangeSelectionPercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%",
                    tooltip: tooltip
                }));

                // Set data
                let data = generateDatas(800);
                series.data.setAll(data);
                series.appear(1000);

                legend.data.push(series);
            }

            createSeries("Series one");
            createSeries("Series two");
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));


            // switch button
            let cont = chart.plotContainer.children.push(am5.Container.new(root, {
                layout: root.horizontalLayout,
                x: 20,
                y: 25
            }));

            // Add labels and controls
            cont.children.push(am5.Label.new(root, {
                centerY: am5.p50,
                text: "Since selection"
            }));

            let switchButton = cont.children.push(am5.Button.new(root, {
                themeTags: ["switch"],
                centerY: am5.p50,
                icon: am5.Circle.new(root, {
                    themeTags: ["icon"]
                })
            }));

            switchButton.on("active", function() {
                if (!switchButton.get("active")) {
                    chart.series.each(function(series) {
                        series.set("valueYShow", "valueYChangeSelectionPercent");
                        series.set("legendValueText",
                            "${valueY} {valueYChangeSelectionPercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%"
                        );
                        series.get("tooltip").set("labelText",
                            "${valueY} {valueYChangeSelectionPercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%"
                        );
                    })
                } else {
                    chart.series.each(function(series) {
                        series.set("valueYShow", "valueYChangePercent")
                        series.set("legendValueText",
                            "${valueY} {valueYChangePercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%"
                        );
                        series.get("tooltip").set("labelText",
                            "${valueY} {valueYChangePercent.formatNumber('[#0f0]+0.00|[#f00]0.00|[#000]0.00')}%"
                        );
                    })
                }
            });

            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Since start"
                })
            );

            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("line-chart-8");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0
            }));
            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineX.set("forceHidden", true);
            cursor.lineY.set("forceHidden", true);

            // Generate random data
            let date = new Date();
            date.setHours(0, 0, 0, 0);
            let value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                let data = [];
                for (let i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }
            let xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 80
                })
            }));

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            let series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.fills.template.setAll({
                fillOpacity: 0.2,
                visible: true
            });
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));


            // Set data
            let data = generateDatas(1200);
            series.data.setAll(data);


            let rangeDate = new Date();
            am5.time.add(rangeDate, "day", Math.round(series.dataItems.length / 2));
            let rangeTime = rangeDate.getTime();

            // add series range
            let seriesRangeDataItem = xAxis.makeDataItem({});
            let seriesRange = series.createAxisRange(seriesRangeDataItem);
            seriesRange.fills.template.setAll({
                visible: true,
                opacity: 0.3
            });

            seriesRange.fills.template.set("fillPattern", am5.LinePattern.new(root, {
                color: am5.color(0xff0000),
                rotation: 45,
                strokeWidth: 2,
                width: 2000,
                height: 2000,
                fill: am5.color(0xffffff)
            }));

            seriesRange.strokes.template.set("stroke", am5.color(0xff0000));

            xAxis.onPrivate("max", function(value) {
                seriesRangeDataItem.set("endValue", value);
                seriesRangeDataItem.set("value", rangeTime);
            });

            // add axis range
            let range = xAxis.createAxisRange(xAxis.makeDataItem({}));
            let color = root.interfaceColors.get("primaryButton");

            range.set("value", rangeDate.getTime());
            range.get("grid").setAll({
                strokeOpacity: 1,
                stroke: color
            });

            let resizeButton = am5.Button.new(root, {
                themeTags: ["resize", "horizontal"],
                icon: am5.Graphics.new(root, {
                    themeTags: ["icon"]
                })
            });

            // restrict from being dragged vertically
            resizeButton.adapters.add("y", function() {
                return 0;
            });

            // restrict from being dragged outside of plot
            resizeButton.adapters.add("x", function(x) {
                return Math.max(0, Math.min(chart.plotContainer.width(), x));
            });

            // change range when x changes
            resizeButton.events.on("dragged", function() {
                let x = resizeButton.x();
                let position = xAxis.toAxisPosition(x / chart.plotContainer.width());

                let value = xAxis.positionToValue(position);

                range.set("value", value);

                seriesRangeDataItem.set("value", value);
                seriesRangeDataItem.set("endValue", xAxis.getPrivate("max"));
            });

            // set bullet for the range
            range.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: resizeButton
            }));
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    {{-- ! MAP CHART --}}
    <script>
        am5.ready(function() {
            let root = am5.Root.new("map-chart-1");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    panY: "translateY",
                    projection: am5map.geoMercator(),
                })
            );

            chart.set("zoomControl", am5map.ZoomControl.new(root, {}));

            let polygonSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["AQ"]
                })
            );

            polygonSeries.mapPolygons.template.setAll({
                fill: am5.color(0xdadada)
            });
            let pointSeries = chart.series.push(am5map.ClusteredPointSeries.new(root, {}));
            pointSeries.set("clusteredBullet", function(root) {
                let container = am5.Container.new(root, {
                    cursorOverStyle: "pointer"
                });

                let circle1 = container.children.push(am5.Circle.new(root, {
                    radius: 8,
                    tooltipY: 0,
                    fill: am5.color(0xff8c00)
                }));

                let circle2 = container.children.push(am5.Circle.new(root, {
                    radius: 12,
                    fillOpacity: 0.3,
                    tooltipY: 0,
                    fill: am5.color(0xff8c00)
                }));

                let circle3 = container.children.push(am5.Circle.new(root, {
                    radius: 16,
                    fillOpacity: 0.3,
                    tooltipY: 0,
                    fill: am5.color(0xff8c00)
                }));

                let label = container.children.push(am5.Label.new(root, {
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: am5.color(0xffffff),
                    populateText: true,
                    fontSize: "8",
                    text: "{value}"
                }));

                container.events.on("click", function(e) {
                    pointSeries.zoomToCluster(e.target.dataItem);
                });

                return am5.Bullet.new(root, {
                    sprite: container
                });
            });

            // Create regular bullets
            pointSeries.bullets.push(function() {
                let circle = am5.Circle.new(root, {
                    radius: 6,
                    tooltipY: 0,
                    fill: am5.color(0xff8c00),
                    tooltipText: "{title}"
                });

                return am5.Bullet.new(root, {
                    sprite: circle
                });
            });


            // Set data
            let cities = [{
                    title: "Vienna",
                    latitude: 48.2092,
                    longitude: 16.3728
                },
                {
                    title: "Minsk",
                    latitude: 53.9678,
                    longitude: 27.5766
                },
                {
                    title: "Brussels",
                    latitude: 50.8371,
                    longitude: 4.3676
                },
                {
                    title: "Sarajevo",
                    latitude: 43.8608,
                    longitude: 18.4214
                },
                {
                    title: "Sofia",
                    latitude: 42.7105,
                    longitude: 23.3238
                },
                {
                    title: "Zagreb",
                    latitude: 45.815,
                    longitude: 15.9785
                },
                {
                    title: "Pristina",
                    latitude: 42.666667,
                    longitude: 21.166667
                },
                {
                    title: "Prague",
                    latitude: 50.0878,
                    longitude: 14.4205
                },
                {
                    title: "Copenhagen",
                    latitude: 55.6763,
                    longitude: 12.5681
                },
                {
                    title: "Tallinn",
                    latitude: 59.4389,
                    longitude: 24.7545
                },
                {
                    title: "Helsinki",
                    latitude: 60.1699,
                    longitude: 24.9384
                },
                {
                    title: "Paris",
                    latitude: 48.8567,
                    longitude: 2.351
                },
                {
                    title: "Berlin",
                    latitude: 52.5235,
                    longitude: 13.4115
                },
                {
                    title: "Athens",
                    latitude: 37.9792,
                    longitude: 23.7166
                },
                {
                    title: "Budapest",
                    latitude: 47.4984,
                    longitude: 19.0408
                },
                {
                    title: "Reykjavik",
                    latitude: 64.1353,
                    longitude: -21.8952
                },
                {
                    title: "Dublin",
                    latitude: 53.3441,
                    longitude: -6.2675
                },
                {
                    title: "Rome",
                    latitude: 41.8955,
                    longitude: 12.4823
                },
                {
                    title: "Riga",
                    latitude: 56.9465,
                    longitude: 24.1049
                },
                {
                    title: "Vaduz",
                    latitude: 47.1411,
                    longitude: 9.5215
                },
                {
                    title: "Vilnius",
                    latitude: 54.6896,
                    longitude: 25.2799
                },
                {
                    title: "Luxembourg",
                    latitude: 49.61,
                    longitude: 6.1296
                },
                {
                    title: "Skopje",
                    latitude: 42.0024,
                    longitude: 21.4361
                },
                {
                    title: "Valletta",
                    latitude: 35.9042,
                    longitude: 14.5189
                },
                {
                    title: "Chisinau",
                    latitude: 47.0167,
                    longitude: 28.8497
                },
                {
                    title: "Monaco",
                    latitude: 43.7325,
                    longitude: 7.4189
                },
                {
                    title: "Podgorica",
                    latitude: 42.4602,
                    longitude: 19.2595
                },
                {
                    title: "Amsterdam",
                    latitude: 52.3738,
                    longitude: 4.891
                },
                {
                    title: "Oslo",
                    latitude: 59.9138,
                    longitude: 10.7387
                },
                {
                    title: "Warsaw",
                    latitude: 52.2297,
                    longitude: 21.0122
                },
                {
                    title: "Lisbon",
                    latitude: 38.7072,
                    longitude: -9.1355
                },
                {
                    title: "Bucharest",
                    latitude: 44.4479,
                    longitude: 26.0979
                },
                {
                    title: "Moscow",
                    latitude: 55.7558,
                    longitude: 37.6176
                },
                {
                    title: "San Marino",
                    latitude: 43.9424,
                    longitude: 12.4578
                },
                {
                    title: "Belgrade",
                    latitude: 44.8048,
                    longitude: 20.4781
                },
                {
                    title: "Bratislava",
                    latitude: 48.2116,
                    longitude: 17.1547
                },
                {
                    title: "Ljubljana",
                    latitude: 46.0514,
                    longitude: 14.506
                },
                {
                    title: "Madrid",
                    latitude: 40.4167,
                    longitude: -3.7033
                },
                {
                    title: "Stockholm",
                    latitude: 59.3328,
                    longitude: 18.0645
                },
                {
                    title: "Bern",
                    latitude: 46.948,
                    longitude: 7.4481
                },
                {
                    title: "Kiev",
                    latitude: 50.4422,
                    longitude: 30.5367
                },
                {
                    title: "London",
                    latitude: 51.5002,
                    longitude: -0.1262
                },
                {
                    title: "Gibraltar",
                    latitude: 36.1377,
                    longitude: -5.3453
                },
                {
                    title: "Saint Peter Port",
                    latitude: 49.466,
                    longitude: -2.5522
                },
                {
                    title: "Douglas",
                    latitude: 54.167,
                    longitude: -4.4821
                },
                {
                    title: "Saint Helier",
                    latitude: 49.1919,
                    longitude: -2.1071
                },
                {
                    title: "Longyearbyen",
                    latitude: 78.2186,
                    longitude: 15.6488
                },
                {
                    title: "Kabul",
                    latitude: 34.5155,
                    longitude: 69.1952
                },
                {
                    title: "Yerevan",
                    latitude: 40.1596,
                    longitude: 44.509
                },
                {
                    title: "Baku",
                    latitude: 40.3834,
                    longitude: 49.8932
                },
                {
                    title: "Manama",
                    latitude: 26.1921,
                    longitude: 50.5354
                },
                {
                    title: "Dhaka",
                    latitude: 23.7106,
                    longitude: 90.3978
                },
                {
                    title: "Thimphu",
                    latitude: 27.4405,
                    longitude: 89.673
                },
                {
                    title: "Bandar Seri Begawan",
                    latitude: 4.9431,
                    longitude: 114.9425
                },
                {
                    title: "Phnom Penh",
                    latitude: 11.5434,
                    longitude: 104.8984
                },
                {
                    title: "Peking",
                    latitude: 39.9056,
                    longitude: 116.3958
                },
                {
                    title: "Nicosia",
                    latitude: 35.1676,
                    longitude: 33.3736
                },
                {
                    title: "T'bilisi",
                    latitude: 41.701,
                    longitude: 44.793
                },
                {
                    title: "New Delhi",
                    latitude: 28.6353,
                    longitude: 77.225
                },
                {
                    title: "Jakarta",
                    latitude: -6.1862,
                    longitude: 106.8063
                },
                {
                    title: "Teheran",
                    latitude: 35.7061,
                    longitude: 51.4358
                },
                {
                    title: "Baghdad",
                    latitude: 33.3157,
                    longitude: 44.3922
                },
                {
                    title: "Jerusalem",
                    latitude: 31.76,
                    longitude: 35.17
                },
                {
                    title: "Tokyo",
                    latitude: 35.6785,
                    longitude: 139.6823
                },
                {
                    title: "Amman",
                    latitude: 31.9394,
                    longitude: 35.9349
                },
                {
                    title: "Astana",
                    latitude: 51.1796,
                    longitude: 71.4475
                },
                {
                    title: "Kuwait",
                    latitude: 29.3721,
                    longitude: 47.9824
                },
                {
                    title: "Bishkek",
                    latitude: 42.8679,
                    longitude: 74.5984
                },
                {
                    title: "Vientiane",
                    latitude: 17.9689,
                    longitude: 102.6137
                },
                {
                    title: "Beyrouth / Beirut",
                    latitude: 33.8872,
                    longitude: 35.5134
                },
                {
                    title: "Kuala Lumpur",
                    latitude: 3.1502,
                    longitude: 101.7077
                },
                {
                    title: "Ulan Bator",
                    latitude: 47.9138,
                    longitude: 106.922
                },
                {
                    title: "Pyinmana",
                    latitude: 19.7378,
                    longitude: 96.2083
                },
                {
                    title: "Kathmandu",
                    latitude: 27.7058,
                    longitude: 85.3157
                },
                {
                    title: "Muscat",
                    latitude: 23.6086,
                    longitude: 58.5922
                },
                {
                    title: "Islamabad",
                    latitude: 33.6751,
                    longitude: 73.0946
                },
                {
                    title: "Manila",
                    latitude: 14.579,
                    longitude: 120.9726
                },
                {
                    title: "Doha",
                    latitude: 25.2948,
                    longitude: 51.5082
                },
                {
                    title: "Riyadh",
                    latitude: 24.6748,
                    longitude: 46.6977
                },
                {
                    title: "Singapore",
                    latitude: 1.2894,
                    longitude: 103.85
                },
                {
                    title: "Seoul",
                    latitude: 37.5139,
                    longitude: 126.9828
                },
                {
                    title: "Colombo",
                    latitude: 6.9155,
                    longitude: 79.8572
                },
                {
                    title: "Damascus",
                    latitude: 33.5158,
                    longitude: 36.2939
                },
                {
                    title: "Taipei",
                    latitude: 25.0338,
                    longitude: 121.5645
                },
                {
                    title: "Dushanbe",
                    latitude: 38.5737,
                    longitude: 68.7738
                },
                {
                    title: "Bangkok",
                    latitude: 13.7573,
                    longitude: 100.502
                },
                {
                    title: "Dili",
                    latitude: -8.5662,
                    longitude: 125.588
                },
                {
                    title: "Ankara",
                    latitude: 39.9439,
                    longitude: 32.856
                },
                {
                    title: "Ashgabat",
                    latitude: 37.9509,
                    longitude: 58.3794
                },
                {
                    title: "Abu Dhabi",
                    latitude: 24.4764,
                    longitude: 54.3705
                },
                {
                    title: "Tashkent",
                    latitude: 41.3193,
                    longitude: 69.2481
                },
                {
                    title: "Hanoi",
                    latitude: 21.0341,
                    longitude: 105.8372
                },
                {
                    title: "Sanaa",
                    latitude: 15.3556,
                    longitude: 44.2081
                },
                {
                    title: "Buenos Aires",
                    latitude: -34.6118,
                    longitude: -58.4173
                },
                {
                    title: "Bridgetown",
                    latitude: 13.0935,
                    longitude: -59.6105
                },
                {
                    title: "Belmopan",
                    latitude: 17.2534,
                    longitude: -88.7713
                },
                {
                    title: "Sucre",
                    latitude: -19.0421,
                    longitude: -65.2559
                },
                {
                    title: "Brasilia",
                    latitude: -15.7801,
                    longitude: -47.9292
                },
                {
                    title: "Ottawa",
                    latitude: 45.4235,
                    longitude: -75.6979
                },
                {
                    title: "Santiago",
                    latitude: -33.4691,
                    longitude: -70.642
                },
                {
                    title: "Bogota",
                    latitude: 4.6473,
                    longitude: -74.0962
                },
                {
                    title: "San Jose",
                    latitude: 9.9402,
                    longitude: -84.1002
                },
                {
                    title: "Havana",
                    latitude: 23.1333,
                    longitude: -82.3667
                },
                {
                    title: "Roseau",
                    latitude: 15.2976,
                    longitude: -61.39
                },
                {
                    title: "Santo Domingo",
                    latitude: 18.479,
                    longitude: -69.8908
                },
                {
                    title: "Quito",
                    latitude: -0.2295,
                    longitude: -78.5243
                },
                {
                    title: "San Salvador",
                    latitude: 13.7034,
                    longitude: -89.2073
                },
                {
                    title: "Guatemala",
                    latitude: 14.6248,
                    longitude: -90.5328
                },
                {
                    title: "Ciudad de Mexico",
                    latitude: 19.4271,
                    longitude: -99.1276
                },
                {
                    title: "Managua",
                    latitude: 12.1475,
                    longitude: -86.2734
                },
                {
                    title: "Panama",
                    latitude: 8.9943,
                    longitude: -79.5188
                },
                {
                    title: "Asuncion",
                    latitude: -25.3005,
                    longitude: -57.6362
                },
                {
                    title: "Lima",
                    latitude: -12.0931,
                    longitude: -77.0465
                },
                {
                    title: "Castries",
                    latitude: 13.9972,
                    longitude: -60.0018
                },
                {
                    title: "Paramaribo",
                    latitude: 5.8232,
                    longitude: -55.1679
                },
                {
                    title: "Washington D.C.",
                    latitude: 38.8921,
                    longitude: -77.0241
                },
                {
                    title: "Montevideo",
                    latitude: -34.8941,
                    longitude: -56.0675
                },
                {
                    title: "Caracas",
                    latitude: 10.4961,
                    longitude: -66.8983
                },
                {
                    title: "Oranjestad",
                    latitude: 12.5246,
                    longitude: -70.0265
                },
                {
                    title: "Cayenne",
                    latitude: 4.9346,
                    longitude: -52.3303
                },
                {
                    title: "Plymouth",
                    latitude: 16.6802,
                    longitude: -62.2014
                },
                {
                    title: "San Juan",
                    latitude: 18.45,
                    longitude: -66.0667
                },
                {
                    title: "Algiers",
                    latitude: 36.7755,
                    longitude: 3.0597
                },
                {
                    title: "Luanda",
                    latitude: -8.8159,
                    longitude: 13.2306
                },
                {
                    title: "Porto-Novo",
                    latitude: 6.4779,
                    longitude: 2.6323
                },
                {
                    title: "Gaborone",
                    latitude: -24.657,
                    longitude: 25.9089
                },
                {
                    title: "Ouagadougou",
                    latitude: 12.3569,
                    longitude: -1.5352
                },
                {
                    title: "Bujumbura",
                    latitude: -3.3818,
                    longitude: 29.3622
                },
                {
                    title: "Yaounde",
                    latitude: 3.8612,
                    longitude: 11.5217
                },
                {
                    title: "Bangui",
                    latitude: 4.3621,
                    longitude: 18.5873
                },
                {
                    title: "Brazzaville",
                    latitude: -4.2767,
                    longitude: 15.2662
                },
                {
                    title: "Kinshasa",
                    latitude: -4.3369,
                    longitude: 15.3271
                },
                {
                    title: "Yamoussoukro",
                    latitude: 6.8067,
                    longitude: -5.2728
                },
                {
                    title: "Djibouti",
                    latitude: 11.5806,
                    longitude: 43.1425
                },
                {
                    title: "Cairo",
                    latitude: 30.0571,
                    longitude: 31.2272
                },
                {
                    title: "Asmara",
                    latitude: 15.3315,
                    longitude: 38.9183
                },
                {
                    title: "Addis Abeba",
                    latitude: 9.0084,
                    longitude: 38.7575
                },
                {
                    title: "Libreville",
                    latitude: 0.3858,
                    longitude: 9.4496
                },
                {
                    title: "Banjul",
                    latitude: 13.4399,
                    longitude: -16.6775
                },
                {
                    title: "Accra",
                    latitude: 5.5401,
                    longitude: -0.2074
                },
                {
                    title: "Conakry",
                    latitude: 9.537,
                    longitude: -13.6785
                },
                {
                    title: "Bissau",
                    latitude: 11.8598,
                    longitude: -15.5875
                },
                {
                    title: "Nairobi",
                    latitude: -1.2762,
                    longitude: 36.7965
                },
                {
                    title: "Maseru",
                    latitude: -29.2976,
                    longitude: 27.4854
                },
                {
                    title: "Monrovia",
                    latitude: 6.3106,
                    longitude: -10.8047
                },
                {
                    title: "Tripoli",
                    latitude: 32.883,
                    longitude: 13.1897
                },
                {
                    title: "Antananarivo",
                    latitude: -18.9201,
                    longitude: 47.5237
                },
                {
                    title: "Lilongwe",
                    latitude: -13.9899,
                    longitude: 33.7703
                },
                {
                    title: "Bamako",
                    latitude: 12.653,
                    longitude: -7.9864
                },
                {
                    title: "Nouakchott",
                    latitude: 18.0669,
                    longitude: -15.99
                },
                {
                    title: "Port Louis",
                    latitude: -20.1654,
                    longitude: 57.4896
                },
                {
                    title: "Rabat",
                    latitude: 33.9905,
                    longitude: -6.8704
                },
                {
                    title: "Maputo",
                    latitude: -25.9686,
                    longitude: 32.5804
                },
                {
                    title: "Windhoek",
                    latitude: -22.5749,
                    longitude: 17.0805
                },
                {
                    title: "Niamey",
                    latitude: 13.5164,
                    longitude: 2.1157
                },
                {
                    title: "Abuja",
                    latitude: 9.058,
                    longitude: 7.4891
                },
                {
                    title: "Kigali",
                    latitude: -1.9441,
                    longitude: 30.0619
                },
                {
                    title: "Dakar",
                    latitude: 14.6953,
                    longitude: -17.4439
                },
                {
                    title: "Freetown",
                    latitude: 8.4697,
                    longitude: -13.2659
                },
                {
                    title: "Mogadishu",
                    latitude: 2.0411,
                    longitude: 45.3426
                },
                {
                    title: "Pretoria",
                    latitude: -25.7463,
                    longitude: 28.1876
                },
                {
                    title: "Mbabane",
                    latitude: -26.3186,
                    longitude: 31.141
                },
                {
                    title: "Dodoma",
                    latitude: -6.167,
                    longitude: 35.7497
                },
                {
                    title: "Lome",
                    latitude: 6.1228,
                    longitude: 1.2255
                },
                {
                    title: "Tunis",
                    latitude: 36.8117,
                    longitude: 10.1761
                }
            ];

            for (let i = 0; i < cities.length; i++) {
                let city = cities[i];
                addCity(city.longitude, city.latitude, city.title);
            }

            function addCity(longitude, latitude, title) {
                pointSeries.data.push({
                    geometry: {
                        type: "Point",
                        coordinates: [longitude, latitude]
                    },
                    title: title
                });
            }

            // Make stuff animate on load
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>


    <script>
        am5.ready(function() {
            let root = am5.Root.new("pie-chart-1");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));

            let series = chart.series.push(am5percent.PieSeries.new(root, {
                alignLabels: true,
                calculateAggregates: true,
                valueField: "value",
                categoryField: "category"
            }));

            series.slices.template.setAll({
                strokeWidth: 3,
                stroke: am5.color(0xffffff)
            });

            series.labelsContainer.set("paddingTop", 30)

            series.slices.template.adapters.add("radius", function(radius, target) {
                let dataItem = target.dataItem;
                let high = series.getPrivate("valueHigh");

                if (dataItem) {
                    let value = target.dataItem.get("valueWorking", 0);
                    return radius * value / high
                }
                return radius;
            });

            series.data.setAll([{
                value: 10,
                category: "One"
            }, {
                value: 9,
                category: "Two"
            }, {
                value: 6,
                category: "Three"
            }, {
                value: 5,
                category: "Four"
            }, {
                value: 4,
                category: "Five"
            }, {
                value: 3,
                category: "Six"
            }]);
            let legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                marginTop: 15,
                marginBottom: 15
            }));

            legend.data.setAll(series.dataItems);
            series.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            let root = am5.Root.new("pie-chart-2");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            let chart = root.container.children.push(
                am5radar.RadarChart.new(root, {
                    panX: false,
                    panY: false,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    innerRadius: am5.percent(40),
                    radius: am5.percent(70),
                    arrangeTooltips: false
                })
            );
            let cursor = chart.set("cursor", am5radar.RadarCursor.new(root, {
                behavior: "zoomX"
            }));

            cursor.lineY.set("visible", false);
            let xRenderer = am5radar.AxisRendererCircular.new(root, {
                minGridDistance: 30
            });
            xRenderer.labels.template.setAll({
                textType: "radial",
                radius: 10,
                paddingTop: 0,
                paddingBottom: 0,
                centerY: am5.p50,
                fontSize: "0.8em"
            });

            xRenderer.grid.template.setAll({
                location: 0.5,
                strokeDasharray: [2, 2]
            });

            let xAxis = chart.xAxes.push(
                am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0,
                    categoryField: "name",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            let yRenderer = am5radar.AxisRendererRadial.new(root, {
                minGridDistance: 30
            });

            let yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: yRenderer
                })
            );

            yRenderer.grid.template.setAll({
                strokeDasharray: [2, 2]
            });
            let series1 = chart.series.push(
                am5radar.RadarLineSeries.new(root, {
                    name: "Cash held outside",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value1",
                    categoryXField: "name"
                })
            );

            series1.strokes.template.setAll({
                strokeOpacity: 0
            });

            series1.fills.template.setAll({
                visible: true,
                fillOpacity: 0.5
            });

            let series2 = chart.series.push(
                am5radar.RadarLineSeries.new(root, {
                    name: "Cash held in US",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value2",
                    categoryXField: "name",
                    stacked: true,
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "Outside: {value1}\nInside:{value2}"
                    })
                })
            );

            series2.strokes.template.setAll({
                strokeOpacity: 0
            });

            series2.fills.template.setAll({
                visible: true,
                fillOpacity: 0.5
            });

            let legend = chart.radarContainer.children.push(
                am5.Legend.new(root, {
                    width: 150,
                    centerX: am5.p50,
                    centerY: am5.p50
                })
            );
            legend.data.setAll([series1, series2]);
            let data = [{
                    name: "Openlane",
                    value1: 160.2,
                    value2: 66.9
                },
                {
                    name: "Yearin",
                    value1: 150.1,
                    value2: 50.5
                },
                {
                    name: "Goodsilron",
                    value1: 120.7,
                    value2: 32.3
                },
                {
                    name: "Condax",
                    value1: 89.4,
                    value2: 74.5
                },
                {
                    name: "Opentech",
                    value1: 78.5,
                    value2: 29.7
                },
                {
                    name: "Golddex",
                    value1: 77.6,
                    value2: 102.2
                },
                {
                    name: "Isdom",
                    value1: 69.8,
                    value2: 22.6
                },
                {
                    name: "Plusstrip",
                    value1: 63.6,
                    value2: 45.3
                },
                {
                    name: "Kinnamplus",
                    value1: 59.7,
                    value2: 12.8
                },
                {
                    name: "Zumgoity",
                    value1: 54.3,
                    value2: 19.6
                },
                {
                    name: "Stanredtax",
                    value1: 52.9,
                    value2: 96.3
                },
                {
                    name: "Conecom",
                    value1: 42.9,
                    value2: 11.9
                },
                {
                    name: "Zencorporation",
                    value1: 40.9,
                    value2: 16.8
                },
                {
                    name: "Iselectrics",
                    value1: 39.2,
                    value2: 9.9
                },
                {
                    name: "Treequote",
                    value1: 36.6,
                    value2: 36.9
                },
                {
                    name: "Sumace",
                    value1: 34.8,
                    value2: 14.6
                },
                {
                    name: "Lexiqvolax",
                    value1: 32.1,
                    value2: 35.6
                },
                {
                    name: "Sunnamplex",
                    value1: 31.8,
                    value2: 5.9
                },
                {
                    name: "Faxquote",
                    value1: 29.3,
                    value2: 14.7
                },
                {
                    name: "Donware",
                    value1: 23.0,
                    value2: 2.8
                },
                {
                    name: "Warephase",
                    value1: 21.5,
                    value2: 12.1
                },
                {
                    name: "Donquadtech",
                    value1: 19.7,
                    value2: 10.8
                },
                {
                    name: "Nam-zim",
                    value1: 15.5,
                    value2: 4.1
                },
                {
                    name: "Y-corporation",
                    value1: 14.2,
                    value2: 11.3
                }
            ];

            series1.data.setAll(data);
            series2.data.setAll(data);
            xAxis.data.setAll(data);

            series1.appear(1000);
            series2.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endsection
