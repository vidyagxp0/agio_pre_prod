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

        .filter-sub {
            display: flex;
            gap: 16px;
            margin-left: 13px
        }

        .filter-bar {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .filter-item {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .table-responsive {
            height: 100vh;
            overflow-x: scroll;
        }

        .filter-item label {
            margin-right: 10px;
        }

        table {
            overflow: scroll;
        }
    </style>

    <div id="rcms-desktop">
        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">OOS / OOT Log </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white" style="height: 65px">
                            <div class="d-flex align-items-center">
                                <div class="scope-bar ml-3">
                                    <button style="width: 70px; margin-left:5px" class="print-btn btn btn-primary">Print</button>
                                </div>
                                <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px">
                                    <div class="filter-bar d-flex justify-content-between">
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
                                            <label for="division_oot">Division</label>
                                            <select class="custom-select" id="division_oot">
                                                <option value="">Select Records</option>
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
                                        <div class="filter-item">
                                            <label for="source_document_type_gi">Type of Document</label>
                                            <select id="source_document_type_gi" class="custom-select">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-block">
                            <div class="table-responsive" style="height: 300px">
                                <table class="table table-bordered" style="width: 120%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th>Date of Initiation</th>
                                            <th>Record No.</th>
                                            <th>Short Description</th>
                                            <th>Type of Document</th>
                                            <th>Product / Material</th>
                                            <th>Batch No. / AR No.</th>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            date_oot_to: null,
            source_document_type: null
        };

        $('#initiator_group').change(function() {
            filterData.department_oot = $(this).val();
            filterRecords();
        });

        $('#division_oot').change(function() {
            filterData.division_id_oot = $(this).val();
            filterRecords();
        });

        $('#datefrom_oot, #dateto_oot').change(function() {
            filterData.date_oot_from = $('#datefrom_oot').val();
            filterData.date_oot_to = $('#dateto_oot').val();
            filterRecords();
        });

        $('#ootdatewise').change(function() {
            filterData.period_oot = $(this).val();
            filterRecords();
        });

        $('#source_document_type_gi').change(function() {
            filterData.source_document_type = $(this).val();
            filterRecords();
        });

        async function filterRecords() {
            $('#tableData').html('');
            $('#spinner').show();

            try {
                const postUrl = "{{ route('api.oot.filter') }}";

                const res = await axios.post(postUrl, filterData);

                if (res.data.status == 'ok') {
                    $('#tableData').html(res.data.body);
                }
            } catch (err) {
                console.log('Error in filterRecords', err.message);
            }

            $('#spinner').hide();
        }
    </script>
@endsection
