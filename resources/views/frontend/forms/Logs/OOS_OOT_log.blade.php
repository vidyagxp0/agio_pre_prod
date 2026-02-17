@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
            <div class="active" onclick="openTab('internal-audit', this)">OOS OOT Log</div>
            <div class="third-div">Third Div Content</div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white" style="height: auto; padding: 10px; margin: 5px;">
                            <div class="d-flex align-items-center">
                                <div class="scope-bar ml-3">
                                    <!-- <button style="width: 70px;margin-left:5px" class="print-btn btn btn-primary">Print</button> -->
                                </div>
                                <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px">
                                    <div class="filter-bar d-flex justify-content-between">
                                        <div class="filter-item">
                                            <label for="initiator_group" >Type</label>
                                             <select name="Initiator_Group" id="initiator_group" class="form-control w-100">
                                                <option value="">Enter Your Selection Here</option>
                                                 <option value="OOS_Chemical">OOS Chemical</option>
                                                <option value="OOS_Micro">OOS Micro</option>
                                                <option value="OOT">OOT</option>
                                                
                                            </select> 
                                        </div>
                                        <div class="filter-item">
                                            <label for="division_id_oot">Division</label>
                                            <select class="custom-select" id="division_id_oot">
                                                <option value="">All Records</option>
                                                <option value="1">Corporate</option>
                                                <option value="2">Plant</option>
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="datefrom_oot">Date From</label>
                                            <input type="date" class="custom-select" id="datefrom_oot">
                                        </div>
                                        <div class="filter-item">
                                            <label for="dateto_oot">Date To</label>
                                            <input type="date" class="custom-select" id="dateto_oot">
                                        </div>
                                        {{-- <div class="filter-item">
                                            <label for="source_document_type_gi">Type of Document</label>
                                            <select id="source_document_type_gi">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="oot">OOT</option>
                                                <option value="lab-incident">Lab Incident</option>
                                                <option value="deviation">Deviation</option>
                                                <option value="product-non-conformance">Product Non-conformance</option>
                                                <option value="inspectional-observation">Inspectional Observation</option>
                                                <option value="other">Others</option>
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="ootdatewise">Select Period</label>
                                            <select class="custom-select" id="ootdatewise">
                                                <option value="all">Select</option>
                                                <option value="Yearly">Yearly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Monthly">Monthly</option>
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-block">
                            <div class="table-responsive" style="height: 500px">
                                <table class="table table-bordered" style="width: 120%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th>Date of Initiation</th>
                                            <th>Record No.</th>
                                            <th>Short Description</th>
                                            <th>Type of Document</th>
                                            <th>Product / Material</th>
                                            {{-- <th>Batch No. / AR No.</th> --}}
                                            <th>Due Date</th>
                                            <th>Closure Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                        @include('frontend.forms.Logs.filterData.OOS_OOT_log_data')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    
    <script>
    
    VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
        });
    $('#spinner').hide();

        const filterData = {
            department_oot: null,
            division_id_oot: null,
            period_oot: null,
            date_oot_from: null,
            date_OOT_to: null,
            source_document_type_OOT: null
        };

        $('#initiator_group').change(function() {
            filterData.department_oot = $(this).val();
            filterRecords();
        });

        $('#division_id_oot').change(function() {
            filterData.division_id_oot = $(this).val();
            filterRecords();
        });

        $('#datefrom_oot, #dateto_oot').change(function() {
            filterData.date_oot_from = $('#datefrom_oot').val();
            filterData.date_OOT_to = $('#dateto_oot').val();
            filterRecords();
        });

        $('#ootdatewise').change(function() {
            filterData.period_oot = $(this).val();
            filterRecords();
        });

        $('#source_document_type_gi').change(function() {
            filterData.source_document_type_OOT = $(this).val();
            filterRecords();
        });

        async function filterRecords() {
            $('#tableData').html('');
            $('#spinner').show();

            try {
                const postUrl = "{{ route('api.oot.filter') }}";
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
