@extends('frontend.layout.main')


@section('container')
    <style>
        #create-record-button {
            display: block;
        }
    </style>
    <style>
        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(1)>button {
            text-transform: capitalize;
        }

        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(3)>div>button.fc-timeGridDay-button.fc-button.fc-button-primary {
            text-transform: capitalize;
        }

        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(3)>div>button.fc-timeGridWeek-button.fc-button.fc-button-primary {
            text-transform: capitalize;
        }

        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(3)>div>button.fc-timeGridWeek-button.fc-button.fc-button-primary {
            text-transform: capitalize;
        }

        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(3)>div>button.fc-dayGridMonth-button.fc-button.fc-button-primary.fc-button-active {
            text-transform: capitalize;
        }

        #calendar>div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr>div:nth-child(3)>div {
            display: flex;
            gap: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Show monthly view
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'year,halfQuarterView,quarterView,dayGridMonth,timeGridWeek,timeGridDay'
                },
                views: {
                    year: {
                        type: 'multiMonth', // Use the multiMonth view from the plugin
                        duration: {
                            years: 1
                        }, // Show 6 months (adjust as needed)
                        buttonText: 'Year',
                        contentHeight: 400, // Set fixed height for scrollable area
                        scrollTime: '00:00', // Ensure scroll starts at the top
                        stickyHeaderDates: false
                    },
                    quarterView: {
                        type: 'dayGrid', // Use dayGrid view for quarter view
                        duration: {
                            months: 3
                        }, // 3 months for a quarter
                        buttonText: 'Quarter '
                    },
                    halfQuarterView: {
                        type: 'dayGrid', // Use dayGrid view for half-quarter view
                        duration: {
                            months: 6
                        }, // 2 months for half-quarter view
                        buttonText: 'Half Year'
                    }
                },
                events: @json($due_dates), // Pass your events as JSON
            });

            calendar.render();
        })
    </script>

    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="dashboard">
        <div class="container-fluid">
            <div class="dashboard-container">
                <div class="row">
                    <div class="col-lg-9">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-left-block">
                            <div class="inner-block main-block">
                                <div class="top">
                                    <div class="d-flex align-items-center">
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div class="name">
                                            <div>Dashboard</div>
                                        </div>
                                    </div>
                                    <div class="doc-links d-flex">
                                    </div>
                                </div>
                            </div>

                            <div id="document">
                                <div class="">
                                    <div class="dashboard-container">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="document-left-block">
                                                    <div class="inner-block table-block">

                                                        <div id="calendar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inner-block">

                                {{-- -----------------------------------------  --}}
                                <h2>📊 Yearly Analytics - {{ $year }}</h2>

                                <!-- Year Filter -->
                                <form method="GET">
                                    <select name="year" onchange="this.form.submit()">
                                        @for ($i = 2022; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}"
                                                {{ request('year', date('Y')) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                                <button onclick="downloadYearlyChart()">⬇ Download Status Chart</button>
                                <script>
                                    function downloadYearlyChart() {
                                        const canvas = document.querySelector('#analyticsChart');

                                        if (!canvas) return;

                                        const image = canvas.toDataURL('image/png');

                                        const link = document.createElement('a');
                                        link.href = image;
                                        link.download = 'yearly-analytics.png';
                                        link.click();
                                    }
                                </script>
                                <canvas id="analyticsChart" height="100"></canvas>

                                <script>
                                    const labels = @json(array_keys($analytics));
                                    const data = @json(array_values($analytics));

                                    const ctx = document.getElementById('analyticsChart').getContext('2d');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Records ({{ $year }})',
                                                data: data,
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>


                                {{-- ---------------------------------  --}}
                                <h2>📊 Division vs Process Analytics</h2>

                                <div style="width:100%; height:400px;">
                                    <canvas id="divisionProcessChart"></canvas>
                                </div>
                                <script>
                                    const chartData = @json($finalChartData);

                                    const datasets = Object.keys(chartData.datasets).map((process, index) => {

                                        const colors = [
                                            '#4e73df', '#1cc88a', '#e74a3b', '#f6c23e',
                                            '#36b9cc', '#6f42c1', '#fd7e14', '#20c997',
                                            '#6610f2', '#d63384', '#198754', '#0dcaf0'
                                        ];

                                        return {
                                            label: process,
                                            data: chartData.datasets[process],
                                            backgroundColor: colors[index % colors.length]
                                        };
                                    });

                                    new Chart(document.getElementById('divisionProcessChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: chartData.labels,
                                            datasets: datasets
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    position: 'top'
                                                }
                                            },
                                            scales: {
                                                x: {
                                                    stacked: true
                                                },
                                                y: {
                                                    stacked: true,
                                                    beginAtZero: true,
                                                    ticks: {
                                                        precision: 0
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>

                                {{-- --------------------------------------------------------------------------------------- --}}
                                <h2>📊 Status Wise Analytics</h2>
                                <button onclick="downloadStatusChart()">⬇ Download Status Chart</button>
                                <script>
                                    function downloadStatusChart() {
                                        const canvas = document.querySelector('#statusChart');

                                        if (!canvas) return;

                                        const image = canvas.toDataURL('image/png');

                                        const link = document.createElement('a');
                                        link.href = image;
                                        link.download = 'status-analytics.png';
                                        link.click();
                                    }
                                </script>

                                <select id="moduleSelect">
                                    @foreach ($statusAnalytics as $module => $data)
                                        <option value="{{ $module }}">{{ $module }}</option>
                                    @endforeach
                                </select>

                                <div style="width: 100%; height: 400px; margin: auto;">
                                    <canvas id="statusChart"></canvas>
                                </div>
                                <script>
                                    const analyticsData = @json($statusAnalytics);

                                    let chart;

                                    function loadChart(module) {

                                        const rawLabels = Object.keys(analyticsData[module]);

                                        const labels = rawLabels.map(label =>
                                            label.replace(/\b\w/g, char => char.toUpperCase())
                                        );

                                        const data = Object.values(analyticsData[module]);
                                        const ctx = document.getElementById('statusChart').getContext('2d');

                                        if (chart) {
                                            chart.destroy();
                                        }

                                        chart = new Chart(ctx, {
                                            type: 'bar', // 🔥 BAR CHART
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: module + ' Status Count',
                                                    data: data,
                                                    backgroundColor: '#9ad0f5', // ✅ ALWAYS BLUE
                                                    borderColor: '#9ad0f5',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    legend: {
                                                        display: false // bar me legend optional
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        ticks: {
                                                            precision: 0 // no decimal
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    }

                                    // Default load
                                    const firstModule = Object.keys(analyticsData)[0];
                                    loadChart(firstModule);

                                    // On dropdown change
                                    document.getElementById('moduleSelect').addEventListener('change', function() {
                                        loadChart(this.value);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
