
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

<style>
    .progress-bars div {
        flex: 1 1 auto;
        border: 1px solid grey;
        padding: 5px;
        text-align: center;
        position: relative;
        /* border-right: none; */
        background: white;
    }

    .state-block {
        padding: 20px;
        margin-bottom: 20px;
    }

    .progress-bars div.active {
        background: green;
        font-weight: bold;
    }

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
        border-radius: 20px 0px 0px 20px;
    }

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(9) {
        border-radius: 0px 20px 20px 0px;

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
        / OOC_Out Of Calibration
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

        <div class="inner-block state-block">
            <div class="d-flex justify-content-between align-items-center">
                <div class="main-head">Record Workflow </div>

                <div class="d-flex" style="gap:20px;">
                    {{-- @php
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                        $cftUsers = DB::table('deviationcfts')
                            ->where(['deviation_id' => $data->id])
                            ->first();




                        // Define the column names
                        $columns = [
                            'Production_person',
                            'Warehouse_notification',
                            'Quality_Control_Person',
                            'QualityAssurance_person',
                            'Engineering_person',
                            'Analytical_Development_person',
                            'Kilo_Lab_person',
                            'Technology_transfer_person',
                            'Environment_Health_Safety_person',
                            'Human_Resource_person',
                            'Information_Technology_person',
                            'Project_management_person',
                        ];

                        // Initialize an array to store the values
                        $valuesArray = [];

                        // Iterate over the columns and retrieve the values
                        foreach ($columns as $column) {
                            $value = $cftUsers->$column;
                            // Check if the value is not null and not equal to 0
                            if ($value !== null && $value != 0) {
                                $valuesArray[] = $value;
                            }
                        }
                        $cftCompleteUser = DB::table('deviationcfts_response')
                            ->whereIn('status', ['In-progress', 'Completed'])
                            ->where('deviation_id', $data->id)
                            ->where('cft_user_id', Auth::user()->id)
                            ->whereNull('deleted_at')
                            ->first();
                        // dd($cftCompleteUser);
                    @endphp --}}
                    {{-- <button class="button_theme1" onclick="window.print();return false;"
                        class="new-doc-btn">Print</button> --}}
                    <button class="button_theme1"> <a class="text-white" href="">
                            {{-- {{ url('DeviationAuditTrial', $data->id) }} --}}

                            {{-- add here url for auditTrail i.e. href="{{ url('CapaAuditTrial', $data->id) }}" --}}
                            Audit Trail </a> </button>

                    {{-- @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Submit
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                        Cancel
                    </button>
                    {{-- @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                        More Info Required
                    </button> --}}
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        HOD Review Complete
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                        Cancel
                    </button>
                    {{-- @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                        More Info Required
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        QA Initial Review Complete
                    </button>

                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                        Child
                    </button> --}}
                    {{-- @elseif(
                        $data->stage == 4 &&
                            (in_array(5, $userRoleIds) || in_array(18, $userRoleIds) || in_array(Auth::user()->id, $valuesArray)))
                        @if (!$cftCompleteUser) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                        More Info Required
                    </button> --}}

                    {{-- @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                        Send to Initiator
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                        Send to HOD
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                        Send to QA Initial Review
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        QA Final Review Complete
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                        Child
                    </button> --}}
                    {{-- @elseif($data->stage == 6 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                        More Info Required
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Approved
                    </button> --}}
                    {{-- @elseif($data->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                        Send to Opened
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                        Send to HOD Review
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                        Send to QA Initial Review
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Initiator Updated Complete
                    </button> --}}
                    {{-- @elseif($data->stage == 8 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                        Send to Opened
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                        Send to HOD Review
                    </button> --}}
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                        Send to QA Initial Review
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#pending-initiator-update">
                        Send to Pending Initiator Update
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        QA Final Review Complete
                    </button> --}}
                    {{-- @endif --}}
                    {{-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                        </a> </button> --}}


                </div>

            </div>


            <div class="status">
                <div class="head">Current Status</div>
                {{-- @if ($data->stage == 0) --}}
                {{-- <div class="progress-bars ">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div> --}}
                {{-- @else --}}
                <div class="progress-bars d-flex" style="font-size: 15px;">
                    {{-- @if ($data->stage >= 1) --}}
                    <div class="active">Opened</div>
                    {{-- @else --}}
                    {{-- <div class="">Opened</div> --}}
                    {{-- @endif --}}

                    {{-- @if ($data->stage >= 2) --}}
                    {{-- <div class="active">HOD Review </div> --}}
                    {{-- @else --}}
                    <div class="">HOD Review</div>
                    {{-- @endif --}}

                    {{-- @if ($data->stage >= 3) --}}
                    {{-- <div class="active">QA Initial Review</div> --}}
                    {{-- @else --}}
                    <div class="">QA Initial Review</div>
                    {{-- @endif --}}

                    {{-- @if ($data->stage >= 4) --}}
                    {{-- <div class="active">CFT Review</div> --}}
                    {{-- @else --}}
                    <div class="">CFT Review</div>
                    {{-- @endif --}}


                    {{-- @if ($data->stage >= 5) --}}
                    {{-- <div class="active">QA Final Review</div> --}}
                    {{-- @else --}}
                    <div class="">QA Final Review</div>
                    {{-- @endif --}}
                    {{-- @if ($data->stage >= 6) --}}
                    {{-- <div class="active">QA Head/Manager Designee Approval</div> --}}
                    {{-- @else --}}
                    <div class="">QA Head/Manager Designee Approval</div>
                    {{-- @endif --}}
                    {{-- @if ($data->stage >= 7) --}}
                    {{-- <div class="active">Pending Initiator Update</div> --}}
                    {{-- @else --}}
                    <div class="">Pending Initiator Update</div>
                    {{-- @endif --}}
                    {{-- @if ($data->stage >= 8) --}}
                    {{-- <div class="active">QA Final Approval</div> --}}
                    {{-- @else --}}
                    <div class="">QA Final Approval</div>
                    {{-- @endif --}}
                    {{-- @if ($data->stage >= 9) --}}
                    {{-- <div class="bg-danger">Closed - Done</div> --}}
                    {{-- @else --}}
                    <div class="">Closed - Done</div>
                    {{-- @endif --}}
                    {{-- @endif --}}


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

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



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    <input disabled type="text" name="record_number" >
                                    {{-- <input disabled type="text" name="record_number" value="{{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('Y') }}/{{ $record_number }}"> --}}

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
                                    {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                    <input disabled type="text" name="division_code"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Date Due"><b>Date of Initiation</b></label>
                                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                    <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                   </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <p class="text-primary"> last date this record should be closed by</p>

                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly
                                            placeholder="DD-MMM-YYYY"/>
                                        <input type="date" name="due_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'due_date')"  />
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="Initiator_Group" id="initiator_group">
                                        <option value="">-- Select --</option>
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
                            <div class="col-lg-6">
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
                            </div>
                            <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="nitiator_group_code" value="" readonly>
                                    </div>
                                </div> --}}

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" onchange="">
                                        <option value="">-- select --</option>
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
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="If Other">If Other</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_if_other" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Is Repeat</label>
                                    <select name="is_repeat_ooc" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeat Nature">Repeat Nature</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Repeat_Nature" id="summernote-1">

                                    </textarea>
                                </div>
                            </div>



                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Description">Description</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="description_ooc" id="summernote-1">
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
                                        OOC Logged by <span class="text-danger"></span>
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
                                    <label for="due-date">OOC Logged On <span class="text-danger"></span></label>
                                    <p class="text-primary"> last date this record should be closed by</p>

                                    <div class="calenderauditee">
                                        <input type="text" id="ooc_due_date" readonly
                                            placeholder="DD-MMM-YYYY"/>
                                        <input type="date" name="ooc_due_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'ooc_due_date')"  />
                                    </div>

                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Instrument Details
                                        <button type="button" onclick="add4Input('root-cause-first-table')">+</button>
                                        <span class="text-primary" data-bs-toggle="modal" data-bs-target="#document-details-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="root-cause-first-table">
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
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="Instrument_Name[]"></td>
                                                <td><input type="text" name="Instrument_ID[]"></td>
                                                <td><input type="text" name="Remarks[]"></td>
                                                <td><input type="text" name="Calibration_Parameter[]"></td>
                                                <td><input type="text" name="Acceptance_Criteria[]"></td>
                                                <td><input type="text" name="Results[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-head"> Delay Justfication for Reporting</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Delay Justification for Reporting">Delay Justification for Reporting</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                    <label for="HOD Remarks">HOD Remarks</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="HOD_Remarks" id="summernote-1">
                                    </textarea>
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
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Status of calibration for other instrument(s) used for performing calibration of the referred instrument</td>
                                                <td>
                                                    <textarea name="what_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="what_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of calibration standards used Primary Standard: Physical apperance, validity, certificate. Secondary standard: Physical appearance, validity</td>
                                                <td>
                                                    <textarea name="where_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="where_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of dilution, calculation, weighing, Titer values and readings</td>
                                                <td>
                                                    <textarea name="when_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="when_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of glassware used</td>
                                                <td>
                                                    <textarea name="coverage_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="coverage_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of chromatograms/spectrums/other instrument</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Adequacy of system suitability checks</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Instrument Malfunction</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Check for adherence to the calibration method</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Previous History of instrument</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Others</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
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
                                <label for="Initiator Group">Assignable root cause found?</label>
                                <select name="is_repeat_assingable_ooc" onchange="">
                                    <option value="YES">-- select --</option>
                                    <option value="NO"></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 sub-head">
                            Hypothesis Study
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="protocol_based_study_hypthesis_study_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="justification_for_protocol_study_hypothesis_study_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="plan_of_protocol_study_hypothesis_study" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="conclusion_of_protocol_based_study_hypothesis_study_ooc" id="summernote-1">
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Calibration Results">Calibration Results</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                <label for="Review of Calibration Results of Analyst">Review of Calibration Results of Analyst</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initial OOC is Invalidated/Validated</label>
                                <select name="is_repeat_stae_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="group-input">
                                <label for="qa_comments">Additinal Remarks (if any)</label>
                                <textarea name="qa_comments_stage_ooc"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="additional_remarks_stage_ooc" id="summernote-1">
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
                                    <option value="">-- select --</option>
                                    <option value="YES">Yes</option>
                                    <option value="No">No</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Instrument is Out of Order</label>
                                <select name="is_repeat_stage_instrument_ooc" onchange="">
                                    <option value="">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Proposed By</label>
                                <select name="is_repeat_proposed_stage_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>


                                </select>
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
                                        <input type="file" id="initial_attachment_stageii_ooc" name="initial_attachment_stageii_ooc[]"
                                            oninput="addMultipleFiles(this, 'initial_attachment_stageii_ooc')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Compiled by:</label>
                                <select name="is_repeat_compiled_stageii_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                            </div>
                        </div>

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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_throug_stageii_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_stageii_cause_failure_ooc" id="summernote-1">
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
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CAPA Type?</label>
                                <select name="is_repeat_capas_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes"></option>
                                    <option value="No"></option>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective Action">Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_capas_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_capa_prevent_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                        <input type="file" id="initial_attachment_capa_post_ooc" name="initial_attachment_capa_post_ooc[]"
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

                        <div class="col-6">
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
                                    <div class="file-attachment-list" id="initial_attachment_closure_ooc"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="initial_attachment_closure_ooc" name="initial_attachment_closure_ooc[]"
                                            oninput="addMultipleFiles(this, 'initial_attachment_closure_ooc')" multiple>
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
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
                                        <input type="file" id="initial_attachment_hodreview_ooc" name="initial_attachment_hodreview_ooc[]"
                                            oninput="addMultipleFiles(this, 'initial_attachment_hodreview_ooc')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Root Cause Analysis">Root Cause Analysis</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_rootcause_ooc" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment">Impact Assessment</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_impact_closure_ooc" id="summernote-1">
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
            <div id="CCForm9" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="row">



                        <center><div class="sub-head">
                            Activity Log
                        </div></center>

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
