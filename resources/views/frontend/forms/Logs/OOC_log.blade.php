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

.process-groups>div {
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

.active {
    width: 100%;
    text-align: center;
    color: grey;

}

<style>.process-groups {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    /* Adjust the spacing as needed */
}

.process-groups>div {
    flex: 1;
    text-align: center;
    background-color: white;
    /* Center align text in each div */
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
    margin-right: 5px;
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
                    <div class="mt-1 mb-2 bg-white " style="height: auto; padding: 10px; margin: 5px;">
                        <div class="d-flex align-items-center">
                            <!-- <div class="scope-bar ml-3">
                                    <button style="width: 70px;margin-left:5px"
                                        class="print-btn btn btn-primary">Print</button>
                                </div> -->
                            <!-- <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px"> -->
                            <div class="filter-bar d-flex justify-content-between"
                                style="flex-wrap: wrap;  display: flex;">
                                <div class="filter-item">
                                    <label for="process">Department</label>
                                    <select name="Initiator_Group" id="initiator_group" style ="width:50%">
                                        <option value="NA">Select Department</option>
                                        <option value="CQA">Corporate Quality Assurance</option>
                                        <option value="QA">Quality Assurance</option>
                                        <option value="QC">Quality Control</option>
                                        <option value="QM">Quality Control (Microbiology department)</option>
                                        <option value="PG">Production General</option>
                                        <option value="PL">Production Liquid Orals</option>
                                        <option value="PT">Production Tablet and Powder</option>
                                        <option value="PE">Production External (Ointment, Gels, Creams and Liquid)
                                        </option>
                                        <option value="PC">Production Capsules</option>
                                        <option value="PI">Production Injectable</option>
                                        <option value="EN">Engineering</option>
                                        <option value="HR">Human Resource</option>
                                        <option value="ST">Store</option>
                                        <option value="IT">Electronic Data Processing</option>
                                        <option value="FD">Formulation Development</option>
                                        <option value="AL">Analytical research and Development Laboratory</option>
                                        <option value="PD">Packaging Development</option>
                                        <option value="PU">Purchase Department</option>
                                        <option value="DC">Document Cell</option>
                                        <option value="RA">Regulatory Affairs</option>
                                        <option value="PV">Pharmacovigilance</option>
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
                                    <label for="date_from">Date From</label>
                                    <input type="date" class="custom-select" id="date_ooc_from_ooc">
                                </div>
                                <div class="filter-item">
                                    <label for="date_to">Date To</label>
                                    <input type="date" class="custom-select" id="date_ooc_to_ooc">

                                    </select>
                                </div>
                                <div class="filter-item">
                                    <label for="originator">Equipment / Instrument</label>
                                    <select class="custom-select" id="instrument_equipment" style ="width:60%">
                                        <option value="Null">Select Records</option>
                                        <option value="instrument_name">Instrument Name</option>
                                        <option value="instrument_id">Instrument Id</option>

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
                        <!-- </div> -->
                    </div>

                    <div class="table-block">
                        <div class="table-responsive" style="height: 300px">
                            <table class="table table-bordered" style="width: 120%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sr.No.</th>
                                        <th>Date of Initiation</th>
                                        <th>Name of Equipment / Instrument</th>
                                        <th>Equipment / Instrument ID</th>
                                        <th>Short Description</th>
                                        <th>Originator</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Calibration Discovered By </th>
                                        <th>Calibration Discovered On</th>
                                        <th>Due Date</th>
                                        <th>Date of Clouser</th>
                                        <th>Status</th>
                                    </tr>


                                </thead>


                                <tbody id="tableData">
                                    @include('frontend.forms.Logs.filterData.outofcalibration_data')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
    integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
VirtualSelect.init({
    ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
});



$('#spinner').hide();

const filterData = {
    department_outofcalibration: null,
    div_id_outofcalibration: null,
    period_outofcalibration: null,
    date_OOC_from: null,
    date_OOC_to: null
    // date_OOC_to: null,


}

$('#initiator_group').change(function() {
    filterData.department_outofcalibration = $(this).val();
    filterRecords()
});

// Division ID change event

$('#division_id').change(function() {
    filterData.div_id_outofcalibration = $(this).val();
    filterRecords();
});
$('#date_ooc_from_ooc, #date_ooc_to_ooc').change(function() {
    filterData.date_OOC_from = $('#date_ooc_from_ooc').val();
    filterData.date_OOC_to = $('#date_ooc_to_ooc').val();

    filterRecords();
});




$('#datewise').change(function() {
    filterData.period_outofcalibration = $(this).val();
    filterRecords();
});

$('#instrument_equipment').change(function() {
    filterData.instrument_equipment = $(this).val();
    filterRecords();
});

$('#instrument_value').change(function() {
    filterData.instrument_value = $(this).val();
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