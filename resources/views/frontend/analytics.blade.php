@extends('frontend.rcms.layout.main_rcms')

<script>
    // Function to update the options of the second dropdown based on the selection in the first dropdown
    function updateQueryOptions() {
        var scopeSelect = document.getElementById('scope');
        var querySelect = document.getElementById('query');
        var scopeValue = scopeSelect.value;

        // Clear existing options in the query dropdown
        querySelect.innerHTML = '';

        // Add options based on the selected scope
        if (scopeValue === 'external_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));


        } else if (scopeValue === 'internal_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'capa') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('CAPA In Progress', '3'));
            querySelect.options.add(new Option('Pending Approval', '4'));
            querySelect.options.add(new Option('Pending Actions Completion', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'audit_program') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Closed - Done', '4'));

        } else if (scopeValue === 'lab_incident') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Incident Review ', '2'));
            querySelect.options.add(new Option('Pending Investigation', '3'));
            querySelect.options.add(new Option('Pending Activity Completion', '4'));
            querySelect.options.add(new Option('Pending CAPA', '5'));
            querySelect.options.add(new Option('Pending QA Review', '6'));
            querySelect.options.add(new Option('Pending QA Head Approve', '7'));
            querySelect.options.add(new Option('Close - Done', '8'));

        } else if (scopeValue === 'risk_assement') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
            querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
            querySelect.options.add(new Option('Pending HOD Approval ', '4'));
            querySelect.options.add(new Option('Actions Items in Progress', '5'));
            querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
            querySelect.options.add(new Option('Close - Done', '7'));

        } else if (scopeValue === 'root_cause_analysis') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Investigation in Progress', '2'));
            querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
            querySelect.options.add(new Option('Pending Group Review', '4'));
            querySelect.options.add(new Option('Pending QA Review', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));

        } else if (scopeValue === 'management_review') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('In Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'extension') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'documents') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Close - Cancel', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'observation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('Pending Approval', '3'));
            querySelect.options.add(new Option('Pending Final Approval', '4'));
            querySelect.options.add(new Option('Close - Done', '5'));
        } else if (scopeValue === 'action_item') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Work in Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'effectiveness_check') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Check Effectiveness', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'CC') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        }


        // Add more conditions based on other scope values

    }
</script>
@section('rcms_container')
    <div id="rcms-dashboard">
        <div class="container-fluid">
            <div class="dash-grid">

                <div>
                    <div class="inner-block scope-table" style="height: calc(100vh - 170px); padding: 0;">

                        <div class="grid-block">
                            <div class="group-input">
                                <label for="scope">Process</label>
                                <select id="test" onchange="showChart()">
                                    <option value="">All Records</option>
                                    <option value="Internal-Audit">Internal Audit</option>
                                    <option value="External-Audit">External Audit</option>
                                    <option value="Capa">Capa</option>
                                    <option value="Audit-Program">Audit Program</option>
                                    <option value="Lab Incident">Lab Incident</option>
                                    <option value="Risk Assesment">Risk Assesment</option>
                                    <option value="Root-Cause-Analysis">Root Cause Analysis</option>
                                    <option value="Management Review">Management Review</option>
                                    <option value="Document">Document</option>
                                    <option value="Extension">Extension</option>
                                    <option value="Observation">Observation</option>
                                    <option value="Change Control">Change Control</option>
                                    <option value="Action Item">Action Item</option>
                                    <option value="Effectiveness Check">Effectiveness Check</option>
                                    {{-- <option value="tms">TMS</option>  --}}
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="">All Records</option>
                                    <option value="Closed">Closed Records</option>
                                    <option value="Opened">Opened Records</option>
                                    <option value="Cancelled">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="Assigned">Assigned To Me</option>
                                    <option value="Records">Records Created Today</option> --}}
                                </select>
                            </div>
                            <div class="item-btn" onclick="window.print()">Print</div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



                        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

                        <div class="main-scope-table">
                            <div >
                                <button id="toggleChartButton">Change Chart</button>
                                <canvas id="myChart" width="400" height="115"></canvas>
                                <div id="paichart" style="width: 400px; height: 115px; margin: 0 auto;"></div>
                            </div>

                            <script>
                                var barChartVisible = true; // Track the visibility state of the bar chart

                                function toggleCharts() {
                                    if (barChartVisible) {
                                        document.getElementById('myChart').style.display = 'none'; // Hide the bar chart
                                        document.getElementById('paichart').style.display = 'block'; // Show the pie chart
                                    } else {
                                        document.getElementById('myChart').style.display = 'block'; // Show the bar chart
                                        document.getElementById('paichart').style.display = 'none'; // Hide the pie chart
                                    }
                                    barChartVisible = !barChartVisible; // Toggle the visibility state
                                }

                                document.getElementById('toggleChartButton').addEventListener('click', toggleCharts);
                            </script>

                            <script>
                                axios.get('/api/analyticsData')
                                    .then(function(response) {
                                        var dataCounts = response.data;

                                        var ctx = document.getElementById('myChart').getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident',
                                                    'RiskManagement', 'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem',
                                                    'EffectivenessCheck', 'Auditee', 'Observation'
                                                ],
                                                datasets: [{
                                                    label: '',
                                                    data: dataCounts,
                                                    backgroundColor: [
                                                        'rgba(75, 192, 192, 0.27)',
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)',
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(75, 192, 192, 0.27)',
                                                        'rgba(255, 99, 132, 1)',
                                                        'rgba(54, 162, 235, 1)',
                                                        'rgba(255, 206, 86, 1)',
                                                        'rgba(75, 192, 192, 1)',
                                                        'rgba(153, 102, 255, 1)',
                                                        'rgba(255, 159, 64, 1)',
                                                        'rgba(255, 99, 132, 1)',
                                                        'rgba(54, 162, 235, 1)',
                                                        'rgba(255, 206, 86, 1)',
                                                        'rgba(75, 192, 192, 1)',
                                                        'rgba(153, 102, 255, 1)',
                                                        'rgba(255, 159, 64, 1)'
                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    });
                            </script>

                            <script>
                                axios.get('/api/analyticsData')
                                    .then(function(response) {
                                        var dataCountsdata = response.data;

                                        var options = {
                                            series: dataCountsdata,
                                            chart: {
                                                width: 380,
                                                type: 'pie',
                                            },
                                            labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident', 'RiskManagement',
                                                'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem', 'EffectivenessCheck',
                                                'Auditee',
                                                'Observation'
                                            ],
                                            legend: {
                                                position: 'bottom',
                                                offsetY: 10, // adjust this value if needed
                                                height: 50 // adjust this value if needed
                                            },
                                            responsive: [{
                                                breakpoint: 480,
                                                options: {
                                                    chart: {
                                                        width: 200
                                                    },
                                                    legend: {
                                                        position: 'bottom'
                                                    }
                                                }
                                            }]
                                        };

                                        var chart = new ApexCharts(document.querySelector("#paichart"), options);
                                        chart.render();
                                    })
                            </script>

                            <div id="test">
</br>
                                <hr>
</br>
                            <button onclick="toggleChartType()"><span align="center" id="toggleChartTypeText"></span></button>
                                <h4 align="center" id="selectedValueText"></h4>
                                <div id="chart">
                                                                    </div>
<hr>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <h4 align="center">Due Date</h4>
                                <canvas id="myChartDue" width="400" height="115"></canvas>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                                <script>
                                    axios.get('/api/analyticsData?value=due')
                                        .then(function(response) {
                                            var dataCountsDue = response.data;


                                            var ctx = document.getElementById('myChartDue').getContext('2d');
                                            var myChartDue = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident',
                                                        'RiskManagement', 'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem',
                                                        'EffectivenessCheck', 'Auditee', 'Observation'
                                                    ],
                                                    datasets: [{
                                                        label: '',
                                                        data: dataCountsDue,
                                                        backgroundColor: [
                                                            'rgba(75, 192, 192, 0.27)',
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)',
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgba(75, 192, 192, 0.27)',
                                                            'rgba(255, 99, 132, 1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)',
                                                            'rgba(255, 99, 132, 1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'
                                                        ],
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        })
                                </script>
                                {{-- <div class="scope-pagination">
                            {{ $datag->links() }}
                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-sm" id="record-modal">
                <div class="modal-contain">
                    <div class="modal-dialog m-0">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body " id="auditTableinfo">
                                Please wait...
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showChild() {
                    $(".child-row").toggle();
                }

                $(".view-list").hide();

                function toggleview() {
                    $(".view-list").toggle();
                }

                $("#record-modal .drop-list").hide();

                function showAction() {
                    $("#record-modal .drop-list").toggle();
                }
            </script>
            <script type='text/javascript'>
                $(document).ready(function() {
                    $('#auditTable').on('click', '.viewdetails', function() {
                        var auditid = $(this).attr('data-id');
                        var formType = $(this).attr('data-type');
                        if (auditid > 0) {
                            // AJAX request
                            var url = "{{ route('ccView', ['id' => ':auditid', 'type' => ':formType']) }}";
                            url = url.replace(':auditid', auditid).replace(':formType', formType);

                            // Empty modal data
                            $('#auditTableinfo').empty();
                            $.ajax({
                                url: url,
                                dataType: 'json',
                                success: function(response) {
                                    // Add employee details
                                    $('#auditTableinfo').append(response.html);
                                    // Display Modal
                                    $('#record-modal').modal('show');
                                }
                            });
                        }
                    });
                });
            </script>
            <script>
                function showChart() {
                    var selectElement = document.getElementById("test");
                    var chartDiv = document.getElementById("chart");

                    // Hide the chart if no option is selected
                    if (!selectElement.value) {
                        chartDiv.style.display = "none";
                        return;
                    } else {
                        chartDiv.style.display = "block";
                    }

                    // Clear the existing chart data
                    var chartElement = document.querySelector("#chart");
                    if (chartElement) {
                        chartElement.innerHTML = ""; // Clear the chart container
                    }
                    var selectedValue = selectElement.value;
                    document.getElementById("selectedValueText").textContent = selectedValue + " (Division)";
                    fetchData(selectedValue);
                }
            </script>

            <script>
let chart; // Declare chart variable outside to make it accessible globally
        let currentChartType = 'pie'; // Initially set to pie chart
        
                function fetchData(selectedValue) {
document.getElementById("toggleChartTypeText").textContent = currentChartType === 'pie' ? 'Bar Chart' : 'Pie Chart';
                    fetch(`/chart-data?value=${selectedValue}`)
                        .then(response => response.json())
                        .then(data => {
if (currentChartType === 'pie') {
                        renderPieChart(data);
                    } else {
                        renderBarChart(data);
                    }
                });
        }

        function renderPieChart(data) {
            var options = {
                series: data.map(item => item.value),
                labels: data.map(item => item.division),
                chart: {
                    type: 'pie',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,
                        offsetX: 0,
                        offsetY: 0,
                        dataLabels: {
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                    offsetY: 40
                },
                fill: {
                    opacity: 1
                }
            };

            // Check if chart exists and destroy
            if (chart) {
                chart.destroy();
            }

            // Initialize a new chart
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        function renderBarChart(data) {
                            var options = {
                                series: [{
                                    name: 'Total',
                                    data: data.map(item => item.value),
                                    // Define color for each category
                                    colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
                                }],
                                chart: {
                                    type: 'bar',
                                    height: 350,
                                    stacked: true,
                                    toolbar: {
                                        show: true
                                    },
                                    zoom: {
                                        enabled: true
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        borderRadius: 10,
                                        dataLabels: {
                                            total: {
                                                enabled: true,
                                                style: {
                                                    fontSize: '13px',
                                                    fontWeight: 900
                                                }
                                            }
                                        }
                                    },
                                },
                                xaxis: {
                                    type: 'category',
                                    categories: data.map(item => item.division)
                                },
                                legend: {
                                    position: 'right',
                                    offsetY: 40
                                },
                                fill: {
                                    opacity: 1
                                }
                            };

                            // Check if chart exists and destroy
            if (chart) {
                chart.destroy();
            }

            // Initialize a new chart
            chart = new ApexCharts(document.querySelector("#chart"), options);
                            chart.render();
                        }

        function toggleChartType() {
            var selectElement = document.getElementById("test");
            currentChartType = currentChartType === 'pie' ? 'bar' : 'pie';
            var selectedValue = selectElement ? selectElement.value : 'defaultValue'; // Added a fallback value
            fetchData(selectedValue);
        }

        // Initial data fetch and chart rendering
        fetchData(selectedValue); // You need to define selectedValue variable or provide a default value

            </script>
            <script>
                var options = {
                    series: [{
                        name: 'Opend',
                        data: [44, 55, 22, 43]
                    }, {
                        name: 'Cancelled',
                        data: [13, 8, 13, 27]
                    }, {
                        name: 'Testing C',
                        data: [11, 15, 21, 14]
                    }, {
                        name: 'Complete D',
                        data: [21, 13, 22, 8]
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                        toolbar: {
                            show: true
                        },
                        zoom: {
                            enabled: true
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0
                            }
                        }
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            borderRadius: 10,
                            dataLabels: {
                                total: {
                                    enabled: true,
                                    style: {
                                        fontSize: '13px',
                                        fontWeight: 900
                                    }
                                }
                            }
                        },
                    },
                    xaxis: {
                        type: 'text',
                        categories: ['KSA', 'Egypt', 'Estonia', 'Jordan', ],
                    },
                    legend: {
                        position: 'right',
                        offsetY: 40
                    },
                    fill: {
                        opacity: 1
                    }
                };

                var chart = new ApexCharts(document.querySelector("#new-chart-id"), options);
                chart.render();
            </script>
            <style>
                #chart {
                    display: none;
                    width: 50%;
                    height: 100px;
                    margin-top: 10px;
                    margin-left: auto;
                    margin-right: auto;
                }

                #new-chart-id {

                    width: 50%;
                    height: 100px;
                    margin-top: 10px;
                    /* margin-left: auto; */
                    /* margin-right: auto; */
                }

                #paichart {
                    display: none;
                    /* Hide the pie chart initially */
                }
            </style>
        @endsection