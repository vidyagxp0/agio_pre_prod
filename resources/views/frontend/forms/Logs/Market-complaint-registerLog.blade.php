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

        .filter-sub {
            display: flex;
            gap: 16px;
            margin-left: 13px
        }
    </style>
    <style>
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
            overflow: scroll
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Market Complaint Log </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white " style="height: 65px">
                            <div class="d-flex align-items-center">
                                <div class="scope-bar ml-3">
                                    <button style="width: 70px;margin-left:5px"
                                        class="print-btn btn btn-primary">Print</button>
                                </div>
                                <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px">
                                    <div class="filter-bar d-flex justify-content-between">
                                        <div class="filter-item">
                                            <label for="process">Department</label>
                                            <select name="Initiator_Group" id="initiator_group" class="form-control">
                                                {{-- <option value="all">All Records</option> --}}
                                                <option value="">Select Record</option>
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
                                            <label for="criteria">Division</label>
                                            <select class="custom-select" id="division_id">
                                                <option value="Null">Select Records</option>
                                                <option value="1">Corporate</option>
                                                <option value="2">Plant</option>

                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="date_from_lab">Date From</label>
                                            <input type="date" class="custom-select" id="date_from_market">
                                        </div>
                                        <div class="filter-item">
                                            <label for="date_to_lab">Date To</label>
                                            <input type="date" class="custom-select" id="date_to_market">
                                        </div> 
                                        <div class="filter-item">
                                            <label for="originator">Category of complaint</label>
                                            <select class="custom-select" id="categoryofcomplaint">
                                                <option value="null">Select Records</option>
                                                <option value="critical">Critical</option>
                                                <option value="major">Major</option>
                                                <option value="minor">Minor</option>
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="datewise">Select Period</label>
                                            <select class="custom-select" id="datewise">
                                                <option value="all">Select</option>
                                                <option value="all">Yearly</option>
                                                <option value="all">Quarterly</option>
                                                <option value="all">Mothly</option>

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
                                            <th rowspan="2">Sr. No.</th>
                                            <th rowspan="2">Date of Initiation</th>
                                            <th rowspan="2">Complaint No.</th>
                                            <th rowspan="2">Description of Complaint</th>
                                            <th rowspan="2">Originator</th>
                                            <th rowspan="2">Department</th>
                                            <th rowspan="2">Division</th>
                                            <th colspan="4" style="text-align: center">Product Details</th>
                                            <th rowspan="2">Nature of complaint</th>
                                            <th rowspan="2">Category of complaint</th>
                                            <th rowspan="2">Response / Report (Date)</th>
                                            <th rowspan="2">Due Date</th>
                                            <th rowspan="2">Clouser Date</th>
                                            <th rowspan="2">Status</th>
                                        </tr>
                                        <tr>
                                            <th>Product Name & strength</th>
                                            <th>Batch No.</th>
                                            <th>Mfg. Date</th>
                                            <th>Exp. Date</th>
                                        </tr>
                                        
                                    </thead>
                                            

                                    <tbody id="tableData">
                                        

                                      @include('frontend.forms.Logs.filterData.marketcomplaint_data')
                                        
                                    </tbody>
                                </table>
                                <div  style="margin-top: 10px; display: flex;  justify-content: center;">
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

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
        });



        $('#spinner').hide();
        
        const filterData = {
    market_department: null,
    div_idcomplaint: null,
    period_lab: null,
    dateMarketFrom: null,
    dateMarketTo: null,


        }
  $('#initiator_group').change(function() {
    // filterData.division_id = $(this).val();
    filterData.market_department = $(this).val();
    filterRecords();
 });

  $('#division_id').change(function() {
    // filterData.division_id = $(this).val();
    filterData.div_idcomplaint = $(this).val();
    filterRecords();
 });

 $('#categoryofcomplaint').change(function() {
    filterData.categoryofcomplaints = $(this).val();
    filterRecords();
 });

 $('#date_from_market').change(function() {
        filterData.dateMarketFrom = $(this).val();
        // console.log('Date From changed:', filterData.dateFrom);
        filterRecords();
    });

    $('#date_to_market').change(function() {
        filterData.dateMarketTo = $(this).val();
        // console.log('Date To changed:', filterData.dateTo);
        filterRecords();
    });

 
 

 $('#datewise').change(function() {
filterData.period = $(this).val();
filterRecords();
});
async function filterRecords()
{
    $('#tableData').html('');
    $('#spinner').show();
    
    try {


        const postUrl = "{{ route('api.marketcomplaint.filter') }}";

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
