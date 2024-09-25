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
        .process-groups > div {
            flex: 1;
            text-align: center;
            background-color: white;
        }

        .process-groups .scope-bar {
            display: flex;
            justify-content: flex-start;
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
        }

        .filter-item {
            flex: 1;
            min-width: 150px;
            margin: 5px;
        }

        .form-control {
            width: 100%;
        }

        @media (max-width: 768px) {
            .filter-item {
                flex: 1 1 100%;
                margin: 5px 0;
            }
        }

        .process-groups .scope-bar .print-btn {
            margin-left: 5px;
        }

        .filter-sub {
            display: flex;
            gap: 16px;
            margin-left: 13px
        }
        .active{
            width: 100%;
    text-align: center;
    color: grey;

        }
        <style>
.process-groups {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px; /* Adjust the spacing as needed */
}

.process-groups > div {
    flex: 1;
    text-align: center; 
    background-color: white;/* Center align text in each div */
}

.process-groups .scope-bar {
    display: flex;
    justify-content: flex-start;
}

.process-groups .scope-bar .print-btn {
    margin-left: 5px;
    
}
</style>

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
    <style>
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
}

.filter-item {
    flex: 1;
    min-width: 150px;
    margin: 5px;
}

.form-control {
    width: 100%;
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
            <div class="active" onclick="openTab('internal-audit', this)">Change Control Log</div>
            <div class="third-div">Third Div Content</div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white " style="height: auto; padding: 10px; margin: 5px;">
                            <div class="d-flex align-items-center">
                                <!-- <div class="scope-bar ml-3">
                                    <button style="width: 70px;margin-left:5px"
                                        class="print-btn btn btn-primary">Print</button>
                                </div> -->
                                <!-- <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px"> -->
                                    <div class="filter-bar d-flex justify-content-between" style="flex-wrap: wrap;  display: flex;">
                                        <div class="filter-item">
                                            <label for="process">Department</label>
                                            <select name="Initiator_Group" id="initiator_group" class="form-control">
                                                {{-- <option value="all">All Records</option> --}}
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
                                            <label for="criteria">Division</label>
                                            <select class="custom-select" id="division_id_cc">
                                                <option value="Null">Select Records</option>
                                                <option value="1">Corporate</option>
                                                <option value="2">Plant</option>

                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="date_from">Date From</label>
                                            <input type="date" class="custom-select" id="date_from_cc">
                                        </div>
                                        <div class="filter-item">
                                            <label for="date_to">Date To</label>
                                            <input type="date" class="custom-select" id="date_to_cc">
                                        </div> 
                                        <div class="filter-item">
                                            <label for="originator">Nature Of Change</label>
                                            <select class="custom-select" id="naturechange">
                                                <option value="Null">Select Records</option>
                                                <option value="Temporary">Temporary</option>
                                                <option value="Permanent">Permanent</option>

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
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="table-block">
                            <div class="table-responsive" style="height: 300px">
                                <table class="table table-bordered" style="width: 120%;">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Date of Initiation</th>
                                            <th>Change Control No.</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Initiator</th>
                                            <th>Description of Change Control</th>
                                            <th>Proposed Change </th>
                                            <th>Nature Of Change </th>
                                            <th>Approved / Reject </th>
                                            <th>No. of Extension </th>
                                            <th>Due Date</th>
                                            <th>Status </th>
                                        </tr>
                                    </thead>
                            
                                    <tbody id="tableData"> <!-- Ensure the ID matches -->
                                        @include('frontend.forms.Logs.filterData.changecontrol_data')
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

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
        });
    
        $('#spinner').hide();
    
        const filterData = {
            department_changecontrol: null,
            division_id_changecontrol: null,
            period_changecontrol: null,
            date_from_changecontrol: null,
            date_to_changecontrol: null,
            nchange: null,
        };
    
        $('#initiator_group').change(function() {
            filterData.department_changecontrol = $(this).val();
            console.log('Department:', filterData.department_changecontrol);
            filterRecords();
        });
    
        $('#division_id_cc').change(function() {
            filterData.division_id_changecontrol = $(this).val();
            console.log('Division:', filterData.division_id_changecontrol);
            filterRecords();
        });
    
        $('#date_from_cc, #date_to_cc').change(function() {
            filterData.date_from_changecontrol = $('#date_from_cc').val();
            filterData.date_to_changecontrol = $('#date_to_cc').val();
            console.log('Date From:', filterData.date_from_changecontrol);
            console.log('Date To:', filterData.date_to_changecontrol);
            filterRecords();
        });
    
        $('#datewise').change(function() {
            filterData.period_changecontrol = $(this).val();
            console.log('Period:', filterData.period_changecontrol);
            filterRecords();
        });
    
        $('#naturechange').change(function() {
            filterData.nchange = $(this).val();
            console.log('Nature of Change:', filterData.nchange);
            filterRecords();
        });
    
        async function filterRecords() {
            $('#tableData').html('');
            $('#spinner').show();
            
            try {
                const postUrl = "{{ route('api.cccontrol.filter') }}";
                const res = await axios.post(postUrl, filterData);
    
                if (res.data.status === 'ok') {
                    $('#tableData').html(res.data.body);
                } else {
                    console.error('Error in response:', res.data);
                }
            } catch (err) {
                console.log('Error in filterRecords', err.message);
            }
            
            $('#spinner').hide();
        }
    </script>
    
@endsection
