@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        function openTab(tabName, ele) {
            let buttons = document.querySelector('.process-groups').children;
            let tables = document.querySelector('.process-tables-list').children;
            for (let element of Array.from(buttons)) {
                element.classList.remove('active');
            }
            ele.classList.add('active');
            for (let element of Array.from(tables)) {
                element.classList.remove('active');
                if (element.getAttribute('id') === tabName) {
                    element.classList.add('active');
                }
            }
        }
    </script>

    <style>
        header .header_rcms_bottom {
            display: none;
        }

        .process-groups {
            display: flex;
        }

        .process-groups > div {
            flex: 1;
            text-align: center;
            background-color: white;
        }

        .process-groups .scope-bar {
            display: flex;
            justify-content: flex-start;
        }

        .process-groups .scope-bar .print-btn {
            margin-left: 5px;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .bg-white {
            background-color: white;
        }

        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .align-items-center {
            align-items: center;
        }

        .flex-grow-2 {
            flex: 2;
        }

        .filter-bar {
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
        }

        .filter-item {
            flex: 1 1 150px;
            margin: 5px;
            display: flex;
            align-items: center;
        }

        .filter-item label {
            margin-right: 10px;
        }

        .form-control, .custom-select {
            width: 100%;
        }

        .table-responsive {
            height: 100vh;
            overflow-x: auto;
        }

        table {
            width: 100%;
            table-layout: auto;
        }

        #spinner {
            display: none;
        }

        @media (max-width: 768px) {
            .filter-item {
                flex: 1 1 100%;
                margin: 5px 0;
            }
        }
    </style>

    <div id="rcms-desktop">
        <div class="process-groups">
            <div class="scope-bar">
                <button class="print-btn btn btn-primary">Print</button>
            </div>
            <div class="active" onclick="openTab('internal-audit', this)">Errata Log</div>
            <div class="third-div">Third Div Content</div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white" style="height: auto; padding: 10px; margin: 5px;">
                            <div class="d-flex align-items-center">
                                <div class="filter-bar">
                                    <div class="filter-item">
                                        <label for="initiator_group">Department</label>
                                        <select name="Initiator_Group" id="initiator_group" class="form-control">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="CQA">Corporate Quality Assurance</option>
                                            <option value="QAB">Quality Assurance Biopharma</option>
                                            <option value="CQC">Central Quality Control</option>
                                            <option value="MANU">Manufacturing</option>
                                            <option value="PSG">Plasma Sourcing Group</option>
                                            <option value="CS">Central Stores</option>
                                            <option value="ITG">Information Technology Group</option>
                                            <option value="MM">Molecular Medicine</option>
                                            <option value="CL">Central Laboratory</option>
                                            <option value="TT">Tech team</option>
                                            <option value="QA">Quality Assurance</option>
                                            <option value="QM">Quality Management</option>
                                            <option value="IA">IT Administration</option>
                                            <option value="ACC">Accounting</option>
                                            <option value="LOG">Logistics</option>
                                            <option value="SM">Senior Management</option>
                                            <option value="BA">Business Administration</option>
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label for="division_id">Division</label>
                                        <select class="custom-select" id="division_id">
                                            <option value="Null">Select Records</option>
                                            <option value="1">Corporate</option>
                                            <option value="2">Plant</option>
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label for="date_from">Date From</label>
                                        <input type="date" class="custom-select" id="date_from">
                                    </div>
                                    <div class="filter-item">
                                        <label for="date_to">Date To</label>
                                        <input type="date" class="custom-select" id="date_to">
                                    </div>
                                    <div class="filter-item">
                                        <label for="errorstab">Type of Error</label>
                                        <select class="custom-select" id="errorstab">
                                            <option value="null">Select Records</option>
                                            <option value="Grammatical Error (GE)">Grammatical Error</option>
                                            <option value="Typographical Error (TE)">Typographical Error</option>
                                            <option value="Calculation Error (CE)">Calculation Error</option>
                                            <option value="Missing Word Error (ME)">Missing Word Error</option>
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label for="datewise">Select Period</label>
                                        <select class="custom-select" id="datewise">
                                            <option value="all">Select</option>
                                            <option value="Yearly">Yearly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-block">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th>Date of Initiation</th>
                                            <th>Errata No.</th>
                                            <th>Short Description</th>
                                            <th>Initiator</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Document Type</th>
                                            <th>Type of Error</th>
                                            <th>Date of Correction of Document</th>
                                            <th>Due Date</th>
                                            <th>Closure Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                        @include('frontend.forms.logs.filterData.errata_data')
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                    <div class="spinner-border text-primary" role="status" id="spinner">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const filterData = {
            department_e: null,
            division_id: null,
            period: null,
            date_from: null,
            date_to: null,
            error_er: null
        }

        $('#initiator_group').change(function() {
            filterData.department_e = $(this).val();
            filterRecords();
        });

        $('#division_id').change(function() {
            filterData.division_id = $(this).val();
            filterRecords();
        });

        $('#date_from').change(function() {
            filterData.date_from = $(this).val();
            filterRecords();
        });

        $('#date_to').change(function() {
            filterData.date_to = $(this).val();
            filterRecords();
        });

        $('#datewise').change(function() {
            filterData.period = $(this).val();
            filterRecords();
        });

        $('#errorstab').change(function() {
            filterData.error_er = $(this).val();
            filterRecords();
        });

        async function filterRecords() {
            $('#tableData').html('');
            $('#spinner').show();

            try {
                const postUrl = "{{ route('api.errata.filter') }}";
                const res = await axios.post(postUrl, filterData);

                if (res.data.status === 'ok') {
                    $('#tableData').html(res.data.body);
                }
            } catch (err) {
                console.log('Error in filterRecords', err.message);
            }

            $('#spinner').hide();
        }
    </script>
@endsection
