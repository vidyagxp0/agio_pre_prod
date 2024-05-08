@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <script>
        function openTab(tabName, ele) {
            let buttons = document.querySelector('.process-groups').children;
            let tables = document.querySelector('.process-tables-list').children;
            for (let element of Array.from(buttons)) {
                element.classList.remove('active');
            }
            ele.classList.add('active')
            for (let element of Array.from(tables)) {
                element.classList.remove('active');
                if (element.getAttribute('id') === tabName) {
                    element.classList.add('active');
                }
            }
        }
    </script>
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

            } else if (scopeValue === 'lab_incident') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Pending Incident Review ', '2'));
                querySelect.options.add(new Option('Pending Investigation', '3'));
                querySelect.options.add(new Option('Pending Activity Completion', '4'));
                querySelect.options.add(new Option('Pending CAPA', '5'));
                querySelect.options.add(new Option('Pending QA Review', '6'));
                querySelect.options.add(new Option('Pending QA Head Approve', '7'));
                querySelect.options.add(new Option('Close - done', '8'));

            } else if (scopeValue === 'risk_assement') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
                querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
                querySelect.options.add(new Option('Pending HOD Approval ', '4'));
                querySelect.options.add(new Option('Actions Items in Progress', '5'));
                querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
                querySelect.options.add(new Option('Close - done', '7'));

            } else if (scopeValue === 'root_cause_analysis') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Investigation in Progress', '2'));
                querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
                querySelect.options.add(new Option('Pending Group Review', '4'));
                querySelect.options.add(new Option('Pending QA Review', '5'));
                querySelect.options.add(new Option('Close - done', '6'));

            } else if (scopeValue === 'management_review') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('In Progress', '2'));
                querySelect.options.add(new Option('Close - done', '3'));

            }

            else if (scopeValue === 'extension') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Close - Cancel', '2'));
                querySelect.options.add(new Option('Close - done', '3'));

            }

            // Add more conditions based on other scope values

        }
    </script>
    <style>
        header .header_rcms_bottom {
            display: none;
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Internal Audit</div>
            <div onclick="openTab('external-audit', this)">External Audit</div>
            <div onclick="openTab('capa', this)">CAPA</div>
            <div onclick="openTab('audit-program', this)">Audit Program</div>
            <div onclick="openTab('lab-incident', this)">Lab Incident</div>
            <div onclick="openTab('change-control', this)">Change Control</div>
            <div onclick="openTab('risk-assessment', this)">Risk Assessment</div>
            <div onclick="openTab('root-cause-analysis', this)">Root Cause Analysis</div>
            <div onclick="openTab('management-review', this)">Management Review</div>
            {{-- <div onclick="openTab('documents', this)">Documents</div>
            <div onclick="openTab('extension', this)">Extension</div>
            <div onclick="openTab('observation', this)">Observation</div>
            <div onclick="openTab('action_item', this)">Action Item</div>
            <div onclick="openTab('effectiveness_check', this)">Effectiveness Check</div>
            <div onclick="openTab('tms', this)">TMS</div> --}}
        </div>

        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">

                    <div class="process-table active" id="internal-audit">

                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>

                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($internal_audit as $internal_audit1)
                                        <tr>
                                            <td>{{ $internal_audit1->record_number }}</td>
                                            <td>{{ $internal_audit1->division_name }}</td>
                                            <td>{{ $internal_audit1->process }}</td>
                                            <td>{{ $internal_audit1->short_description }}</td>
                                            <td>{{ $internal_audit1->create }}</td>
                                            <td>{{ $internal_audit1->assign_to }}</td>
                                            <td>{{ $internal_audit1->due_date }}</td>
                                            <td>{{ $internal_audit1->status }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- <div id="chart"></div> --}}
                        <script>
                            fetch('/chart-data')
                            .then(response => response.json())
                            .then(data => {
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

                                var chart = new ApexCharts(document.querySelector("#chart"), options);
                                chart.render();
                            });
                            </script>
                    </div>

                    <div class="process-table" id="external-audit">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($external_audit as $external_audit1)
                                        <tr>
                                            <td>{{ $external_audit1->record_number }}</td>
                                            <td>{{ $external_audit1->division_name }}</td>
                                            <td>{{ $external_audit1->process }}</td>
                                            <td>{{ $external_audit1->short_description }}</td>
                                            <td>{{ $external_audit1->create }}</td>
                                            <td>{{ $external_audit1->assign_to }}</td>
                                            <td>{{ $external_audit1->due_date }}</td>
                                            <td>{{ $external_audit1->status }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="capa">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($capa as $capa1)
                                        <tr>
                                            <td>{{ $capa1->record_number }}</td>
                                            <td>{{ $capa1->division_name }}</td>
                                            <td>{{ $capa1->process }}</td>
                                            <td>{{ $capa1->short_description }}</td>
                                            <td>{{ $capa1->create }}</td>
                                            <td>{{ $capa1->assign_to }}</td>
                                            <td>{{ $capa1->due_date }}</td>
                                            <td>{{ $capa1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                    <div class="process-table" id="audit-program">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audit_pragram as $audit_program1)
                                        <tr>
                                            <td>{{ $audit_program1->record_number }}</td>
                                            <td>{{ $audit_program1->division_name }}</td>
                                            <td>{{ $audit_program1->process }}</td>
                                            <td>{{ $audit_program1->short_description }}</td>
                                            <td>{{ $audit_program1->create }}</td>
                                            <td>{{ $audit_program1->assign_to }}</td>
                                            <td>{{ $audit_program1->due_date }}</td>
                                            <td>{{ $audit_program1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="lab-incident">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labincident as $lab_incident1)
                                        <tr>
                                            <td>{{ $lab_incident1->record_number }}</td>
                                            <td>{{ $lab_incident1->division_name }}</td>
                                            <td>{{ $lab_incident1->process }}</td>
                                            <td>{{ $lab_incident1->short_desc }}</td>
                                            <td>{{ $lab_incident1->create }}</td>
                                            <td>{{ $lab_incident1->assign_to }}</td>
                                            <td>{{ $lab_incident1->due_date }}</td>
                                            <td>{{ $lab_incident1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="change-control">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($change_control as $change_control1)
                                        <tr>
                                            <td>{{ $change_control1->record_number }}</td>
                                            <td>{{ $change_control1->division_name }}</td>
                                            <td>{{ $change_control1->process }}</td>
                                            <td>{{ $change_control1->short_description }}</td>
                                            <td>{{ $change_control1->create }}</td>
                                            <td>{{ $change_control1->assign_to }}</td>
                                            <td>{{ $change_control1->due_date }}</td>
                                            <td>{{ $change_control1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="risk-assessment">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($risk_management as $risk_management1)
                                        <tr>
                                            <td>{{ $risk_management1->record_number }}</td>
                                            <td>{{ $risk_management1->division_name }}</td>
                                            <td>{{ $risk_management1->process }}</td>
                                            <td>{{ $risk_management1->short_description }}</td>
                                            <td>{{ $risk_management1->create }}</td>
                                            <td>{{ $risk_management1->assign_to }}</td>
                                            <td>{{ $risk_management1->due_date }}</td>
                                            <td>{{ $risk_management1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="root-cause-analysis">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($root_cause_analysis as $root_cause_analysis1)
                                        <tr>
                                            <td>{{ $root_cause_analysis1->record_number }}</td>
                                            <td>{{ $root_cause_analysis1->division_name }}</td>
                                            <td>{{ $root_cause_analysis1->process }}</td>
                                            <td>{{ $root_cause_analysis1->short_description }}</td>
                                            <td>{{ $root_cause_analysis1->create }}</td>
                                            <td>{{ $root_cause_analysis1->assign_to }}</td>
                                            <td>{{ $root_cause_analysis1->due_date }}</td>
                                            <td>{{ $root_cause_analysis1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="process-table" id="management-review">
                        <div class="scope-bar">
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    {{-- <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option> --}}
                                </select>
                            </div>
                            <button onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Record</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($management_review as $management_review1)
                                        <tr>
                                            <td>{{ $management_review1->record_number }}</td>
                                            <td>{{ $management_review1->division_name }}</td>
                                            <td>{{ $management_review1->process }}</td>
                                            <td>{{ $management_review1->short_description }}</td>
                                            <td>{{ $management_review1->create }}</td>
                                            <td>{{ $management_review1->assign_to }}</td>
                                            <td>{{ $management_review1->due_date }}</td>
                                            <td>{{ $management_review1->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
@endsection
