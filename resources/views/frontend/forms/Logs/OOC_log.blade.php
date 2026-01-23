@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<!-- Styles -->
<style>
    header .header_rcms_bottom {
        display: none;
    }
    .filter-bar {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }
    .filter-item label {
        margin-right: 10px;
    }
    .table-responsive {
        height: 100vh;
        overflow-x: scroll;
    }
    table {
        overflow: scroll;
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
    .process-groups {
        display: flex;
        /* align-items: center;
        justify-content: space-between;
        gap: 10px; */
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
</style>

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
        <div class="active" onclick="openTab('internal-audit', this)">Out Of Calibration Log</div>
        <div class="third-div">Third Div Content</div>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="process-tables-list">
                <div class="process-table active" id="internal-audit">
                    <div class="mt-1 mb-2 bg-white" style="height: auto; padding: 10px;">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-2">
                            <div class="filter-bar d-flex flex-wrap justify-content-between">
                                    <div class="filter-item">
                                        <label for="initiator_group">Department</label>
                                        <select name="Initiator_Group" id="initiator_group" class="form-control">
                                            <option value="">Select Record</option>
                                              <option value="CQA">Corporate Quality Assurance</option>
                                                <option value="QA">Quality Assurance</option>
                                                <option value="QC">Quality Control</option>
                                                <option value="QM">Quality Control (Microbiology department)</option>
                                                <option value="PG">Production General</option>
                                                <option value="PL">Production Liquid Orals</option>
                                                <option value="PT">Production Tablet and Powder</option>
                                                <option value="PE">Production External (Ointment, Gels, Creams, and Liquid)</option>
                                                <option value="PC">Production Capsules</option>
                                                <option value="PI">Production Injectable</option>
                                                <option value="EN">Engineering</option>
                                                <option value="HR">Human Resource</option>
                                                <option value="ST">Store</option>
                                                <option value="IT">Information Technology</option>
                                                <option value="FD">Formulation Development</option>
                                                <option value="AL">Analytical Research and Development Laboratory</option>
                                                <option value="PD">Packaging Development</option>
                                                <option value="PU">Purchase Department</option>
                                                <option value="DC">Document Cell</option>
                                                <option value="RA">Regulatory Affairs</option>
                                                <option value="PV">Pharmacovigilance</option>
                                                <option value="Safety">Safety</option>
                                                <option value="Accounts">Accounts</option>
                                                <option value="Finance">Finance</option>
                                                <option value="Artwork">Artwork</option>
                                                <option value="Company secretary">Company secretary</option>
                                                <option value="Exports">Exports</option>
                                                <option value="Marketing">Marketing</option>
                                            
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label for="division_id">Site/Location Code</label>
                                        <select class="custom-select form-control" id="division_id">
                                            <option value="Null">Select Records</option>
                                            <option value="1">Corporate</option>
                                            <option value="2">Plant</option>
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label for="date_from_ooc">Date From</label>
                                        <input type="date" class="custom-select form-control" id="date_from_ooc">
                                    </div>
                                    <div class="filter-item">
                                        <label for="date_to_ooc">Date To</label>
                                        <input type="date" class="custom-select form-control" id="date_to_ooc">
                                    </div>
                                    
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
                                        <th>Site/Location Code</th>
                                        <th>Short Description</th>
                                        <th>Originator</th>
                                       
                                        <th>Department</th>
                                        <th>HOD Person</th>
                                        <th>QA Person</th>
                                        <th>Due Date</th>
                                        
                                        <th>Status</th>
                                    </tr>
                                   
                                </thead>
                                <tbody id="tableData">
                                    @include('frontend.forms.Logs.filterData.outofcalibration_data')
                                </tbody>
                            </table>
                            <div style="margin-top: 10px; display: flex; justify-content: center;">
                                <div class="spinner-border text-primary" role="status" id="spinner">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more tabs as needed -->
            </div>
        </div>
    </div>
</div>

<script>
    VirtualSelect.init({
        ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
    });

    $('#spinner').hide();

    const filterData = {
        department_outofcalibration: null,
        div_id_outofcalibration: null,
        period_lab: null,
        date_from_oocdate: null,
        date_to_oocdata: null,
        // categoryofcomplaints: null
    };

    $('#initiator_group').change(function() {
        filterData.department_outofcalibration = $(this).val();
        filterRecords();
    });

    $('#division_id').change(function() {
        filterData.div_id_outofcalibration = $(this).val();
        filterRecords();
    });

    // $('#categoryofcomplaint').change(function() {
    //     filterData.categoryofcomplaints = $(this).val();
    //     filterRecords();
    // });

    $('#date_from_ooc').change(function() {
        filterData.date_from_oocdate = $(this).val();
        filterRecords();
    });

    $('#date_to_ooc').change(function() {
        filterData.date_to_oocdata = $(this).val();
        filterRecords();
    });

    $('#datewise').change(function() {
        filterData.period = $(this).val();
        filterRecords();
    });

    async function filterRecords() {
        $('#tableData').html('');
        $('#spinner').show();

        try {
            const postUrl = "{{ route('api.ooc.filter') }}";
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


