@extends('frontend.layout.main')
@section('container')
<style>
textarea.note-codable {
    display: none !important;
}

header {
    display: none;
}
</style>

@php
$users = DB::table('users')->get();
@endphp
<div class="form-field-head">
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        {{ Helpers::getDivisionName(session()->get('division')) }}
        / Out Of Calibration
    </div>
</div>

<script>
$(document).ready(function() {
    $('#Monitor_Information').click(function(e) {
        function generateTableRow(serialNumber) {


            var html =
                '<tr>' +
                '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                '<td><input type="date" name="date[]"></td>' +
                ' <td><input type="text" name="Responsible[]"></td>' +
                '<td><input type="text" name="ItemDescription[]"></td>' +
                '<td><input type="date" name="SentDate[]"></td>' +
                '<td><input type="date" name="ReturnDate[]"></td>' +
                '<td><input type="text" name="Comment[]"></td>' +


                '</tr>';

            // for (var i = 0; i < users.length; i++) {
            //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            // }

            // html += '</select></td>' + 

            //     '</tr>';

            return html;
        }

        var tableBody = $('#Monitor_Information_details tbody');
        var rowCount = tableBody.children('tr').length;
        var newRow = generateTableRow(rowCount + 1);
        tableBody.append(newRow);
    });
});
</script>

<script>
$(document).ready(function() {
    $('#Product_Material').click(function(e) {
        function generateTableRow(serialNumber) {


            var html =
                '<tr>' +
                '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                '<td><input type="text" name="ProductName[]"></td>' +
                '<td><input type="number" name="ReBatchNumber[]"></td>' +
                '<td><input type="date" name="ExpiryDate[]"></td>' +
                '<td><input type="date" name="ManufacturedDate[]"></td>' +
                '<td><input type="text" name="Disposition[]"></td>' +
                '<td><input type="text" name="Comment[]"></td>' +


                '</tr>';

            // for (var i = 0; i < users.length; i++) {
            //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            // }

            // html += '</select></td>' + 

            //     '</tr>';

            return html;
        }

        var tableBody = $('#Product_Material_details tbody');
        var rowCount = tableBody.children('tr').length;
        var newRow = generateTableRow(rowCount + 1);
        tableBody.append(newRow);
    });
});
</script>


<script>
$(document).ready(function() {
    $('#Equipment').click(function(e) {
        function generateTableRow(serialNumber) {


            var html =
                '<tr>' +
                '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                '<td><input type="text" name="ProductName[]"></td>' +
                '<td><input type="number" name="BatchNumber[]"></td>' +
                '<td><input type="date" name="ExpiryDate[]"></td>' +
                '<td><input type="date" name="ManufacturedDate[]"></td>' +
                '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                '<td><input type="text" name="Exist[]"></td>' +
                '<td><input type="text" name="Comment[]"></td>' +


                '</tr>';

            // for (var i = 0; i < users.length; i++) {
            //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            // }

            // html += '</select></td>' + 

            //     '</tr>';

            return html;
        }

        var tableBody = $('#Equipment_details tbody');
        var rowCount = tableBody.children('tr').length;
        var newRow = generateTableRow(rowCount + 1);
        tableBody.append(newRow);
    });
});
</script>
<script>
document.getElementById('initiator_group').addEventListener('change', function() {
    var selectedValue = this.value;
    document.getElementById('initiator_group_code').value = selectedValue;
});
</script>




{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD/Supervisor Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">OOC Evaluation Form</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Stage I</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Stage II</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CAPA</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Closure</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Signature</button>

        </div>

        <form action="{{ route('oocCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">
                            {{-- @foreach ($record_number as $record) --}}


                            {{-- @php
                                $division =  Helpers::getDivisionName(session()->get('division')) 
                            @endphp --}}
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    {{-- <input disabled type="number" name="record_number" value="" > --}}
                                    <input disabled type="text" name="record_number"
                                        value="{{Helpers::getDivisionName(session()->get('division'))}}/{{ date('y') }}/OOC/{{$record_number}}">

                                </div>
                            </div>
                            {{-- @endforeach --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code"><b>Site/Location Code</b></label>
                                    <input readonly type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                    <input type="hidden" name="division_id" value="{{ session()->get('division') }}">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator"><b>Initiator</b></label>
                                    {{-- <div class="static">{{ Auth::user()->name }}
                                </div> --}}
                                <input disabled type="text" name="division_code" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Due"><b>Date of Initiation</b></label>
                                <input disabled type="text" value="{{ date('d-M-Y') }}" id="intiation_date_display"
                                    name="intiation_date_display">
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date"
                                    id="intiation_date_hidden" oninput="calculateDueDate(this.value)">
                            </div>
                        </div>

                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="due-date">Due Date <span class="text-danger"></span></label>
                                <p class="text-primary">last date this record should be closed by</p>

                                <div class="calenderauditee">
                                    <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="due_date" id="due_date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'due_date')" />
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="initiator-group">Initiation Department<span
                                        class="text-danger">*</span></label>
                                <select name="Initiator_Group" id="initiator_group">
                                    <option value="NA">Select Department</option>
                                    <option value="CQA">Corporate Quality Assurance</option>
                                    <option value="QA">Quality Assurance</option>
                                    <option value="QC">Quality Control</option>
                                    <option value="QM">Quality Control (Microbiology department)</option>
                                    <option value="PG">Production General</option>
                                    <option value="PL">Production Liquid Orals</option>
                                    <option value="PT">Production Tablet and Powder</option>
                                    <option value="PE">Production External (Ointment, Gels, Creams and Liquid)</option>
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
                        </div>

                        <!-- new added lines  -->

                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="date_of_out_of_calibration">Date of Out of Calibration </label>
                                <div class="calenderauditee">
                                    <input type="text" id="date_of_out_of_calibration_display" readonly
                                        placeholder="DD-MMM-YYYY"
                                        value="{{ old('date_of_out_of_calibration') ? \Carbon\Carbon::parse(old('date_of_out_of_calibration'))->format('d-M-Y') : '' }}">
                                    <input type="date" name="date_of_out_of_calibration" class="hide-input"
                                        id="date_of_out_of_calibration"
                                        oninput="handleDateInput(this, 'date_of_out_of_calibration_display')"
                                        value="{{ old('date_of_out_of_calibration') }}">
                                    @if ($errors->has('date_of_out_of_calibration'))
                                    <span class="text-danger">{{ $errors->first('date_of_out_of_calibration') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="date_of_discovery">Date of Discovery</label>
                                <div class="calenderauditee">
                                    <input type="text" id="date_of_discovery_display" readonly placeholder="DD-MMM-YYYY"
                                        value="{{ old('date_of_discovery') ? \Carbon\Carbon::parse(old('date_of_discovery'))->format('d-M-Y') : '' }}">
                                    <input type="date" name="date_of_discovery" class="hide-input"
                                        id="date_of_discovery"
                                        oninput="handleDateInput(this, 'date_of_discovery_display')"
                                        value="{{ old('date_of_discovery') }}">
                                    @if ($errors->has('date_of_discovery'))
                                    <span class="text-danger">{{ $errors->first('date_of_discovery') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="last_calibration_date">Last Calibration Date</label>
                                <div class="calenderauditee">
                                    <input type="text" id="last_calibration_date_display" readonly
                                        placeholder="DD-MMM-YYYY"
                                        value="{{ old('last_calibration_date') ? \Carbon\Carbon::parse(old('last_calibration_date'))->format('d-M-Y') : '' }}">
                                    <input type="date" name="last_calibration_date" class="hide-input"
                                        id="last_calibration_date"
                                        oninput="handleDateInput(this, 'last_calibration_date_display')"
                                        value="{{ old('last_calibration_date') }}">
                                    @if ($errors->has('last_calibration_date'))
                                    <span class="text-danger">{{ $errors->first('last_calibration_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="group-input">
                                <label for="calibration_frequency">Calibration Frequency</label>
                                <select name="calibration_frequency" class="calibrationfrequency"
                                    id="calibration_frequency">
                                   <option value="">Select Option</option>
                                    <option value="monthly"
                                        {{ old('calibration_frequency') == 'monthly' ? 'selected' : '' }}>Monthly
                                    </option>
                                    <option value="quarterly"
                                        {{ old('calibration_frequency') == 'quarterly' ? 'selected' : '' }}>Quarterly
                                    </option>
                                    <option value="yearly"
                                        {{ old('calibration_frequency') == 'yearly' ? 'selected' : '' }}>
                                        Yearly</option>
                                </select>
                                @if ($errors->has('calibration_frequency'))
                                <span class="text-danger">{{ $errors->first('calibration_frequency') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    function formatDate(date) {
                        let day = date.getDate();
                        let month = date.toLocaleString('default', {
                            month: 'short'
                        });
                        let year = date.getFullYear();
                        return `${day < 10 ? '0' + day : day}-${month}-${year}`;
                    }

                    function calculateDueDate(initiationDateValue) {
                        if (initiationDateValue) {
                            let initiationDate = new Date(initiationDateValue);
                            let dueDate = new Date(initiationDate);
                            dueDate.setDate(dueDate.getDate() + 30);

                            let formattedDueDate = formatDate(dueDate);

                            document.getElementById('due_date_display').value = formattedDueDate;
                            document.getElementById('due_date').value = dueDate.toISOString().split('T')[0];
                        } else {
                            document.getElementById('due_date_display').value = '';
                            document.getElementById('due_date').value = '';
                        }
                    }

                    $(document).ready(function() {
                        let initiationDateHidden = $('#intiation_date_hidden').val();
                        calculateDueDate(initiationDateHidden);

                        $('.hide-input').on('focus', function() {
                            $(this).attr('type', 'date');
                        });

                        $('.hide-input').on('blur', function() {
                            if (!$(this).val()) {
                                $(this).attr('type', 'text');
                            }
                        });
                    });
                    </script>
                    <!-- new added lines  -->

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Description">Short Description <span class="text-danger">*</span></label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <input type="text" name="description_ooc">

                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Initiator Group Code">Initiator Group Code</label>
                            <input type="text" name="initiator_group_code" id="initiator_group_code" value="" readonly>
                        </div>
                    </div>

                    <script>
                    document.getElementById('initiator_group').addEventListener('change', function() {
                        var selectedValue = this.value;
                        document.getElementById('initiator_group_code').value = selectedValue;
                    });
                    </script>

                    {{-- 
                            <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="Initiator_Group" id="initiator_group">
                                        <option value="">-- Select --</option>
                                        <option value="CQA" @if(old('Initiator_Group') =="CQA") selected @endif>Corporate Quality Assurance</option>
                                        <option value="QAB" @if(old('Initiator_Group') =="QAB") selected @endif>Quality Assurance Biopharma</option>
                                        <option value="CQC" @if(old('Initiator_Group') =="CQA") selected @endif>Central Quality Control</option>
                                        <option value="CQC" @if(old('Initiator_Group') =="MANU") selected @endif>Manufacturing</option>
                                        <option value="PSG" @if(old('Initiator_Group') =="PSG") selected @endif>Plasma Sourcing Group</option>
                                        <option value="CS"  @if(old('Initiator_Group') == "CS") selected @endif>Central Stores</option>
                                        <option value="ITG" @if(old('Initiator_Group') =="ITG") selected @endif>Information Technology Group</option>
                                        <option value="MM"  @if(old('Initiator_Group') == "MM") selected @endif>Molecular Medicine</option>
                                        <option value="CL"  @if(old('Initiator_Group') == "CL") selected @endif>Central Laboratory</option>

                                        <option value="TT"  @if(old('Initiator_Group') == "TT") selected @endif>Tech team</option>
                                        <option value="QA"  @if(old('Initiator_Group') == "QA") selected @endif> Quality Assurance</option>
                                        <option value="QM"  @if(old('Initiator_Group') == "QM") selected @endif>Quality Management</option>
                                        <option value="IA"  @if(old('Initiator_Group') == "IA") selected @endif>IT Administration</option>
                                        <option value="ACC"  @if(old('Initiator_Group') == "ACC") selected @endif>Accounting</option>
                                        <option value="LOG"  @if(old('Initiator_Group') == "LOG") selected @endif>Logistics</option>
                                        <option value="SM"  @if(old('Initiator_Group') == "SM") selected @endif>Senior Management</option>
                                        <option value="BA"  @if(old('Initiator_Group') == "BA") selected @endif>Business Administration</option>
                                    </select>
                                </div>
                            </div> -->


                            <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Name of the Department</b><span
                                                class="text-danger">*</span></label>
                                        <select name="Initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('department_capa') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('department_capa') == 'QAB') selected @endif>
                                                Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('department_capa') == 'CQC') selected @endif>
                                                Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('department_capa') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('department_capa') == 'PSG') selected @endif>
                                                Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('department_capa') == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if (old('department_capa') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('department_capa') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('department_capa') == 'CL') selected @endif>
                                                Central
                                                Laboratory</option>

                                            <option value="TT" @if (old('department_capa') == 'TT') selected @endif>
                                                Tech
                                                team</option>
                                            <option value="QA" @if (old('department_capa') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('department_capa') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('department_capa') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('department_capa') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('department_capa') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('department_capa') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('department_capa') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                        @error('department_capa')
                                            <div class="text-danger">{{ $message }}
                </div>
                @enderror
            </div>
    </div>
    <div class="col-lg-12">
        <div class="group-input">
            <label for="Initiator Group Code">Initiator Group Code</label>
            <input type="text" name="initiator_group_code" id="nitiator_group_code" value="" readonly>
        </div>
    </div> --}}

    <!-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="recall">Recall</option>
                                        <option value="return">Return</option>
                                        <option value="deviation">Deviation</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="regulatory">Regulatory</option>
                                        <option value="lab-incident">Lab Incident</option>
                                        <option value="improvement">Improvement</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div> -->



    <div class="col-md-12 mb-3">
        <div class="group-input">
            <label for="If Other">If Other</label>
            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                    completion</small></div>
            <textarea class="summernote" name="initiated_if_other" id="summernote-1">
                                    </textarea>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="group-input">
            <label for="affected documents closed"><b>Affected Documents Closed</b></label>
            <select name="affected_document_closure" id="affected_document_closure">
                <option value="0">-- Select --</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>

            </select>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="group-input">
            <label for="Is Repeat"><b>Is Repeat</b></label>
            <select name="is_repeat_ooc" id="is_repeat_ooc">
                <option value="">-- Select --</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                {{-- <option value="NA">NA</option> --}}

            </select>
        </div>
    </div>
    {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group"></label>
                                    <select name="is_repeat_ooc" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>

                                    </select>
                                </div>
                            </div> --}}


    <div class="col-md-12 mb-3">
        <div class="group-input">
            <label for="Repeat Nature">Repeat Nature</label>
            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                    completion</small></div>
            <textarea class="summernote" name="Repeat_Nature" id="summernote-1">

                                    </textarea>
        </div>
    </div>






    <div class="col-lg-12">
        <div class="group-input">
            <label for="Initial Attachments">Initial Attachment</label>
            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
            {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
            <div class="file-attachment-field">
                <div class="file-attachment-list" id="initial_attachment_ooc"></div>
                <div class="add-btn">
                    <div>Add</div>
                    <input type="file" id="initial_attachment_ooc" name="initial_attachment_ooc[]"
                        oninput="addMultipleFiles(this, 'initial_attachment_ooc')" multiple>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="group-input">
            <label for="search">
                OOC Discovered by <span class="text-danger"></span>
            </label>
            <select id="select-state" placeholder="Select..." name="assign_to">
                <option value="">Select a value</option>
                @foreach ($users as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </select>
            @error('assign_to')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-md-6 new-date-data-field">
        <div class="group-input input-date">
            <label for="due-date">OOC Discovered On <span class="text-danger"></span></label>
            <!-- <p class="text-primary"> last date this record should be closed by</p> -->

            <div class="calenderauditee">
                <input type="text" id="ooc_due_date" readonly placeholder="DD-MMM-YYYY" />
                <input type="date" name="ooc_due_date" class="hide-input"
                    oninput="handleDateInput(this, 'ooc_due_date')" />
            </div>

        </div>
    </div>
    {{-- grid added new --}}

    <div class="col-12">
        <div class="group-input" id="IncidentRow">
            <label for="root_cause">
                Instrument Details
                <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal"
                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                    (Launch Instruction)
                </span>
            </label>

            <table class="table table-bordered" id="onservation-incident-table">
                <thead>
                    <tr>
                        <th>Row #</th>
                        <th>Instrument Name</th>
                        <th>Instrument ID</th>
                        <th>Remarks</th>
                        <th>Calibration Parameter</th>
                        <th>Acceptance Criteria</th>
                        <th>Results</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $serialNumber =1;
                    @endphp
                    <tr>
                        <td disabled>{{ $serialNumber++ }}</td>
                        <td><input type="text" name="instrumentdetails[0][instrument_name]"></td>
                        <td><input type="text" name="instrumentdetails[0][instrument_id]"></td>
                        <td><input type="text" name="instrumentdetails[0][remarks]"></td>
                        <td><input type="text" name="instrumentdetails[0][calibration]"></td>
                        <td><input type="text" name="instrumentdetails[0][acceptancecriteria]"></td>
                        <td><input type="text" name="instrumentdetails[0][results]"></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectField = document.getElementById('Facility_Equipment');
        var inputsToToggle = [];

        // Add elements with class 'facility-name' to inputsToToggle
        var facilityNameInputs = document.getElementsByClassName('facility-name');
        for (var i = 0; i < facilityNameInputs.length; i++) {
            inputsToToggle.push(facilityNameInputs[i]);
        }

        // Add elements with class 'id-number' to inputsToToggle
        var idNumberInputs = document.getElementsByClassName('id-number');
        for (var j = 0; j < idNumberInputs.length; j++) {
            inputsToToggle.push(idNumberInputs[j]);
        }

        // Add elements with class 'remarks' to inputsToToggle
        var remarksInputs = document.getElementsByClassName('remarks');
        for (var k = 0; k < remarksInputs.length; k++) {
            inputsToToggle.push(remarksInputs[k]);
        }


        selectField.addEventListener('change', function() {
            var isRequired = this.value === 'yes';
            console.log(this.value, isRequired, 'value');

            inputsToToggle.forEach(function(input) {
                input.required = isRequired;
                console.log(input.required, isRequired, 'input req');
            });

            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
            // Show or hide the asterisk icon based on the selected value
            var asteriskIcon = document.getElementById('asteriskInvi');
            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
        });
    });
    </script>


    <script>
    $(document).ready(function() {
        let investdetails = 1;
        $('#IncidentAdd').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][instrument_name]" value=""></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][instrument_id]" value=""></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][remarks]" value=""></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][calibration]" value=""></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][acceptancecriteria]" value=""></td>' +
                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                    '][results]" value=""></td>' +
                    '</tr>';
                investdetails++; // Increment the row number here
                return html;
            }

            var tableBody = $('#onservation-incident-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
    </script>

    {{-- grid added new --}}




    <div class="sub-head"> Delay Justfication for Reporting</div>

    <div class="col-md-12 mb-3">
        <div class="group-input">
            <label for="Delay Justification for Reporting">Delay Justification for Reporting</label>
            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                    completion</small></div>
            <textarea class="summernote" name="Delay_Justification_for_Reporting" id="summernote-1">
                                    </textarea>
        </div>
    </div>


    <div class="button-block">
        <button type="submit" class="saveButton">Save</button>
        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                Exit </a> </button>

    </div>
</div>
</div>
</div>
<div id="CCForm2" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="sub-head col-12">HOD/Supervisor Review</div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Supervisor Review">Supervisor</label>
                    <textarea class="summernote" name="supervisor_review" id="summernote-1"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="section incharge Review">Section Incharge</label>
                    <textarea class="summernote" name="section_incharge_review" id="summernote-1"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="HOD Remarks">HOD Remarks</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="HOD_Remarks" id="summernote-1"></textarea>
                </div>
            </div>



            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">HOD Attachement</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="attachments_hod_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="attachments_hod_ooc" name="attachments_hod_ooc[]"
                                oninput="addMultipleFiles(this, 'attachments_hod_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Immediate Action">Immediate Action</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="Preliminary_Investigation_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>






            {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                    Exit </a> </button>
        </div>
    </div>
</div>
</div>




@php
$oocevaluations = array(
"Status of calibration for other instrument(s) used for performing calibration of the referred instrument",
"Verification of calibration standards used Primary Standard: Physical appearance, validity, certificate. Secondary
standard: Physical appearance, validity",
"Verification of dilution, calculation, weighing, Titer values and readings",
"Verification of glassware used",
"Verification of chromatograms/spectrums/other instrument",
"Adequacy of system suitability checks",
"Instrument Malfunction",
"Check for adherence to the calibration method",
"Previous History of instrument",
"Others"
)
@endphp
<div id="CCForm3" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">


            <div class="sub-head">OOC Evaluation Form</div>

            <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 30%;">Question</th>
                                    <th>Response</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($oocevaluations as $item)

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    {{-- <td >Status of calibration for other instrument(s) used for performing calibration of the referred instrument</td>
                                                 --}}
                                    <td style="background: #DCD8D8">{{$item}}</td>
                                    <td>
                                        <textarea name="oocevoluation[{{$loop->index}}][response]"></textarea>
                                    </td>
                                    <td>
                                        <textarea name="oocevoluation[{{$loop->index}}][remarks]"></textarea>
                                    </td>

                                </tr>
                                @endforeach
                                {{-- @foreach ($oocevaluations as $item) --}}

                                {{-- <tr>
                                                <td></td>
                                                    <td style="background: #DCD8D8"></td>
                                                    <td>
                                                    <textarea name="where_will_be_qII"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="where_will_not_be_qII"></textarea>
                                                </td>

                                            </tr> --}}
                                {{-- @endforeach --}}

                                {{-- <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of dilution, calculation, weighing, Titer values and readings</td>
                                                <td>
                                                    <textarea name="when_will_be_qIII"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="when_will_not_be_qIII"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of glassware used</td>
                                                <td>
                                                    <textarea name="coverage_will_be_qIv"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="coverage_will_not_be_qIv"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of chromatograms/spectrums/other instrument</td>
                                                <td>
                                                    <textarea name="who_will_be_qv"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_qv"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Adequacy of system suitability checks</td>
                                                <td>
                                                    <textarea name="who_will_be_vi"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_vi"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Instrument Malfunction</td>
                                                <td>
                                                    <textarea name="who_will_be_vii"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_vii"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Check for adherence to the calibration method</td>
                                                <td>
                                                    <textarea name="who_will_be_viii"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_viii"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Previous History of instrument</td>
                                                <td>
                                                    <textarea name="who_will_be_ix"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_ix"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Others</td>
                                                <td>
                                                    <textarea name="who_will_be_x"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_x"></textarea>
                                                </td>

                                            </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="qa_comments">Evaluation Remarks</label>
                    <textarea name="qa_comments_ooc"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="qa_comments">Description of Cause for OOC Results (If Identified)</label>
                    <textarea name="qa_comments_description_ooc"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Assignable root cause found</label>
                    <textarea name="is_repeat_assingablerc_ooc"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Non Assignable root cause found</label>
                    <textarea name="is_repeat_assingable_ooc"></textarea>
                </div>
            </div>

            <div class="col-12 sub-head">
                Hypothesis Study
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="protocol_based_study_hypthesis_study_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>



            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/
                        Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="justification_for_protocol_study_hypothesis_study_ooc"
                        id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis
                        Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="plan_of_protocol_study_hypothesis_study" id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based
                        Study/Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="conclusion_of_protocol_based_study_hypothesis_study_ooc"
                        id="summernote-1">
                                    </textarea>
                </div>
            </div>
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                    Exit </a> </button>
        </div>
    </div>
</div>
<div id="CCForm4" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="sub-head">Stage I</div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Analyst Remarks">Analyst Remarks</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Calibration Results">Calibration Results</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="calibration_results_stage_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Results Naturey</label>
                    <select name="is_repeat_result_naturey_ooc" onchange="">
                        <option value="0">-- select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>

                    </select>
                </div>
            </div>




            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Review of Calibration Results of Analyst">Review of Calibration Results of
                        Analyst</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">Stage I Attachement</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="attachments_stage_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="attachments_stage_ooc" name="attachments_stage_ooc[]"
                                oninput="addMultipleFiles(this, 'attachments_stage_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Results Criteria">Results Criteria</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="ooc_category">OOC Category</label>
                    <select name="ooc_category" id="ooc_category">
                        <option value="" {{ old('ooc_category') == '' ? 'selected' : '' }}>-- Select --</option>
                        <option value="Validated" {{ old('ooc_category') == 'Validated' ? 'selected' : '' }}>Validated
                        </option>
                        <option value="Invalidated" {{ old('ooc_category') == 'Invalidated' ? 'selected' : '' }}>
                            Invalidated</option>
                    </select>
                </div>
            </div>


            {{-- <div class="col-6">
                            <div class="group-input">
                                <label for="qa_comments">Additinal Remarks (if any)</label>
                                <textarea name="qa_comments_stage_ooc"></textarea>
                            </div>
                        </div> --}}

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="additional_remarks_stage_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>
            <div class="col-12 sub-head">
                Stage I ( Hypothesis )
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="stagei_hypthesis_study_ooc" id="summernote-1"></textarea>
                </div>
            </div>



            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/
                        Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="justification_for_protocol_study_stageI_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis
                        Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="plan_of_protocol_stageI_study_hypothesis_study"
                        id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based
                        Study/Hypothesis Study</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="conclusion_of_protocol_stageI_based_study_hypothesis_study_ooc"
                        id="summernote-1"></textarea>
                </div>
            </div>

        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                    Exit </a> </button>
        </div>
    </div>
</div>

<div id="CCForm5" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Stage II
        </div>
        <div class="row">


            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Rectification by Service Engineer required</label>
                    <select name="is_repeat_stageii_ooc" onchange="">
                        <option value="NA">-- select --</option>
                        <option value="YES">Yes</option>
                        <option value="No">No</option>


                    </select>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Instrument is Out of Order</label>
                    <select name="is_repeat_stage_instrument_ooc" onchange="">
                        <option value="NA">-- select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div> -->
            
            <div class="col-md-6">
                <div class="group-input">
                    <label for="search">
                        Instrument is Out of Order<span class="text-danger"></span>
                    </label>
                    <select id="select-state" placeholder="Select..." name="InstrumentOutofOrder">
                        <option value="">-- Select a value --</option>
                        <option value="Other">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div id="InstrumentOutofOrder" class="group-input col-6" style="display: none;">
                <label for="otherFieldsUser">Action Taken</label>
                <input type="text" name="actiontaken_action" class="form-control"/>
            </div>
            <div id="AttachmentField" class="col-lg-6" style="display: none;">
            <div class="group-input">
                    <label for="Initial Attachments">Attachment Service Engineer Report</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment_otherfield"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="Initial_Attachment_otherfield"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="Initial_Attachment_otherfield"
                                name="Initial_Attachment_otherfield[]"
                                oninput="addMultipleFiles(this, 'Initial_Attachment_otherfield')" multiple>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
            $(document).ready(function() {
                $('select[name=InstrumentOutofOrder]').change(function() {
                    const selectedVal = $(this).val();
                    if (selectedVal == 'Other') {
                        $('#InstrumentOutofOrder').show();
                        $('#AttachmentField').show();
                    } else {
                        $('#InstrumentOutofOrder').hide();
                        $('#AttachmentField').hide();
                    }
                });
            });
            </script>

            <!-- <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Proposed By</label>
                    <select name="is_repeat_proposed_stage_ooc" onchange="">
                        <option value="0">-- select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>


                    </select>
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Proposed By</label>
                    <input type="text" name="is_repeat_proposed_stage_ooc" placeholder="Enter Proposed Name">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">Details of Equipment Rectification Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_stageii_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="initial_attachment_stageii_ooc"
                                name="initial_attachment_stageii_ooc[]"
                                oninput="addMultipleFiles(this, 'initial_attachment_stageii_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
    <div class="group-input">
        <label for="search">
            Compiled By<span class="text-danger"></span>
        </label>
        <select id="select-state" placeholder="Select..." name="is_repeat_compiled_stageii_ooc">
            <option value="">-- Select a value --</option>
            <option value="Other">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
</div>
<div id="CompiledBlock" class="group-input col-6" style="display: none;">
    <label for="otherFieldsUser">Compiled By</label>
    <input type="text" name="User_compiled" class="form-control"/>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name=is_repeat_compiled_stageii_ooc]').change(function() {
            const selectedVal = $(this).val();
            if (selectedVal == 'Other') {
                $('#CompiledBlock').show();
            } else {
                $('#CompiledBlock').hide();
            }
        })
    })
</script>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Release of Instrument for usage</label>
                    <select name="is_repeat_realease_stageii_ooc" onchange="">
                        <option value="0">-- select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>


                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Impact Assessment at Stage II">Impact Assessment at Stage II</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_throug_stageii_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_stageii_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>



            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Result of Reanalysis:</label>
                    <select name="is_repeat_reanalysis_stageii_ooc" onchange="">
                        <option value="0">-- select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>


                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Cause for failure">Cause for failure</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_stageii_cause_failure_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>
            <div class="sub-head">
                Equipment Status
            </div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="re_qualification_status">Re-Qualification (in case of rectification)</label>
                    <textarea name="re_qualification_status"
                        id="re_qualification_status">{{ old('re_qualification_status') }}</textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="calibration_status">Calibration Status (in case of rectification):</label>
                    <textarea name="calibration_status"
                        id="calibration_status">{{ old('calibration_status') }}</textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
        <div class="group-input">
            <label for="found_satisfactory">Found Satisfactory or Not:</label>
            <select name="found_satisfactory" id="found_satisfactory">
                <option value="1" {{ old('found_satisfactory') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('found_satisfactory') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>
<div class="col-md-6">
    <div class="group-input">
        <label for="search">
            Reviewed By<span class="text-danger"></span>
        </label>
        <select id="select-state" placeholder="Select..." name="type_of_error">
            <option value="">-- Select a value --</option>
            <option value="Other">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
</div>
<div id="typeOfErrorBlock" class="group-input col-6" style="display: none;">
    <label for="otherFieldsUser">Reviewed By</label>
    <input type="text" name="OthewrReviewed_ooc" class="form-control"/>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name=type_of_error]').change(function() {
            const selectedVal = $(this).val();
            if (selectedVal == 'Other') {
                $('#typeOfErrorBlock').show();
            } else {
                $('#typeOfErrorBlock').hide();
            }
        })
    })
</script>
    <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">Service Engineer Report Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="service_engineer_report_attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="service_engineer_report_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="service_engineer_report_attachment" name="service_engineer_report_attachment[]"
                                oninput="addMultipleFiles(this, 'service_engineer_report_attachment')" multiple>
                        </div>
                    </div>
                </div>
            </div>





        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                </a> </button>
        </div>
    </div>
</div>
<div id="CCForm6" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            CAPA
        </div>
        <div class="row">


            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">CAPA Type?</label>
                    <select name="capa_type" id="capa_type">
                        <option value="">Select Option</option>
                        <option value="Corrective Action">Corrective Action</option>
                        <option value="Preventive Action">Preventive Action</option>
                        <option value="Correction">Correction</option>
                        <option value="Preventive Measure">Preventive Measure</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Corrective Action">Corrective Action</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_capas_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Preventive Action">Preventive Action</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_capa_prevent_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_capa_corrective_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>



            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">Details of Equipment Rectification Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_capa_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="initial_attachment_capa_ooc" name="initial_attachment_capa_ooc[]"
                                oninput="addMultipleFiles(this, 'initial_attachment_capa_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>


            <div class="sub-head">
                Post Implementation of CAPA
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="CAPA Post Implementation Comments">CAPA Post Implementation Comments</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_capa_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">CAPA Post Implementation Attachement</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_capa_post_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="initial_attachment_capa_post_ooc"
                                name="initial_attachment_capa_post_ooc[]"
                                oninput="addMultipleFiles(this, 'initial_attachment_capa_post_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                </a> </button>
        </div>
    </div>
</div>

<div id="CCForm7" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            CAPA
        </div>
        <div class="row">

            <div class="col-12">
                <div class="group-input">
                    <label for="Short Description">Closure Comments
                        <input id="docname" type="text" name="short_description_closure_ooc">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">Details of Equipment Rectification</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_closuress_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="initial_attachment_closuress_ooc"
                                name="initial_attachment_closuress_ooc[]"
                                oninput="addMultipleFiles(this, 'initial_attachment_closuress_ooc')" multiple>
                        </div>
                    </div>

                </div>
            </div>



            <div class="col-6">
                <div class="group-input">
                    <label for="Short Description">Document Code
                        <input id="docname" type="text" name="document_code_closure_ooc">
                </div>
            </div>

            <div class="col-6">
                <div class="group-input">
                    <label for="Short Description">Remarks
                        <input id="docname" type="text" name="remarks_closure_ooc">
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Immediate Corrective Action">Immediate Corrective Action</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_closure_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                </a> </button>
        </div>
    </div>
</div>
<div id="CCForm8" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            HOD Review
        </div>
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="HOD Remarks">HOD Remarks</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_hodreview_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>



            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initial Attachments">HOD Attachement</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_hodreview_ooc"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="initial_attachment_hodreview_ooc"
                                name="initial_attachment_hodreview_ooc[]"
                                oninput="addMultipleFiles(this, 'initial_attachment_hodreview_ooc')" multiple>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Root Cause Analysis">Root Cause Analysis</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_rootcause_ooc" id="summernote-1">
                                    </textarea>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Impact Assessment">Impact Assessment</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                            completion</small></div>
                    <textarea class="summernote" name="initiated_through_impact_closure_ooc"
                        id="summernote-1"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="group-input">
                    <label for="Reanalysis Result">Reanalysis Result</label>
                    <select name="sample_status" id="sample_status">
                        <option value="">Select Option</option>
                        <option value="Passed" {{ old('sample_status') == 'Passed' ? 'selected' : '' }}>Samples Passed
                        </option>
                        <option value="Failed" {{ old('sample_status') == 'Failed' ? 'selected' : '' }}>Samples Failed
                        </option>
                    </select><br>
                </div>
            </div>




        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                </a> </button>
        </div>
    </div>
</div>
<div id="CCForm9" class="inner-block cctabcontent">
    <div class="inner-block-content">

        <div class="row">



            <center>
                <div class="sub-head">
                    Activity Log
                </div>
            </center>

            <div class="sub-head col-lg-12">
                Submit
            </div>
            <div class="col-lg-4">

                <div class="group-input">
                    <label for="Initiator Group">Submit By : </label>
                    <div class="static"></div>


                </div>
            </div>

            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="OOC Logged On">Submit On : </label>
                    <div class="static"></div>





                </div>
            </div>
            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="comment">Comment : </label>
                    <div class="static"></div>
                </div>
            </div>

            <div class="sub-head col-lg-12">
                HOD Review
            </div>

            <div class="col-lg-4">

                <div class="group-input">
                    <label for="Initiator Group">HOD Review Completed By : </label>
                    <div class="static"></div>

                </div>
            </div>

            <div class="col-lg-4 new-date-data-field">

                <div class="group-input input-date">
                    <label for="OOC Logged On">HOD Review Completed On :</label>
                </div>
            </div>
            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="hod_review_occ_comment">Comment : </label>
                    <div class="static"></div>





                </div>
            </div>

            <div class="sub-head col-lg-12">
                QA Intial Review
            </div>
            <div class="col-lg-4">

                <div class="group-input">

                    <label for="Initiator Group">QA Initial Review Completed By :</label>

                </div>
            </div>

            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="OOC Logged On">QA Initial Review Completed On : </label>




                </div>
            </div>
            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="qa_intial_review_ooc_comment">Comment : </label>
                    <div class="static"></div>

                </div>
            </div>


            <div class="sub-head col-lg-12">
                QA Final Review
            </div>
            <div class="col-lg-4">

                <div class="group-input">
                    <label for="Initiator Group">QA Final Review Completed By : </label>
                    <div class="static"></div>


                </div>
            </div>

            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="OOC Logged On">QA Final Review Completed On : </label>
                    <div class="static"></div>




                </div>
            </div>
            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="qa_final_review_comment">Comment : </label>
                    <div class="static"></div>

                </div>
            </div>
            <div class="sub-head col-lg-12">
                Closure
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Initiator Group">Closure Done By : </label>
                    <div class="static"></div>


                </div>
            </div>


            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="OOC Logged On">Closure Done On : </label>
                    <div class="static"></div>





                </div>
            </div>
            <div class="col-lg-4 new-date-data-field">
                <div class="group-input input-date">
                    <label for="closure_ooc_comment">Comment : </label>
                    <div class="static"></div>

                </div>
            </div>







        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>

            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                </a> </button>
        </div>
    </div>
</div>
</div>
</form>

</div>
</div>

<style>
#step-form>div {
    display: none
}

#step-form>div:nth-child(1) {
    display: block;
}
</style>

<script>
VirtualSelect.init({
    ele: '#related_records, #hod'
});

function openCity(evt, cityName) {
    var i, cctabcontent, cctablinks;
    cctabcontent = document.getElementsByClassName("cctabcontent");
    for (i = 0; i < cctabcontent.length; i++) {
        cctabcontent[i].style.display = "none";
    }
    cctablinks = document.getElementsByClassName("cctablinks");
    for (i = 0; i < cctablinks.length; i++) {
        cctablinks[i].className = cctablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

    // Find the index of the clicked tab button
    const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

    // Update the currentStep to the index of the clicked tab
    currentStep = index;
}

const saveButtons = document.querySelectorAll(".saveButton");
const nextButtons = document.querySelectorAll(".nextButton");
const form = document.getElementById("step-form");
const stepButtons = document.querySelectorAll(".cctablinks");
const steps = document.querySelectorAll(".cctabcontent");
let currentStep = 0;

function nextStep() {
    // Check if there is a next step
    if (currentStep < steps.length - 1) {
        // Hide current step
        steps[currentStep].style.display = "none";

        // Show next step
        steps[currentStep + 1].style.display = "block";

        // Add active class to next button
        stepButtons[currentStep + 1].classList.add("active");

        // Remove active class from current button
        stepButtons[currentStep].classList.remove("active");

        // Update current step
        currentStep++;
    }
}

function previousStep() {
    // Check if there is a previous step
    if (currentStep > 0) {
        // Hide current step
        steps[currentStep].style.display = "none";

        // Show previous step
        steps[currentStep - 1].style.display = "block";

        // Add active class to previous button
        stepButtons[currentStep - 1].classList.add("active");

        // Remove active class from current button
        stepButtons[currentStep].classList.remove("active");

        // Update current step
        currentStep--;
    }
}
</script>
<script>
VirtualSelect.init({
    ele: '#reference_record, #notify_to'
});

$('#summernote').summernote({
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear', 'italic']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
});

$('.summernote').summernote({
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear', 'italic']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
});

let referenceCount = 1;

function addReference() {
    referenceCount++;
    let newReference = document.createElement('div');
    newReference.classList.add('row', 'reference-data-' + referenceCount);
    newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
    let referenceContainer = document.querySelector('.reference-data');
    referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
}
</script>
<script>
var maxLength = 255;
$('#docname').keyup(function() {
    var textlen = maxLength - $(this).val().length;
    $('#rchars').text(textlen);
});
</script>
@endsection