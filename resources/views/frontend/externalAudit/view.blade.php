@extends('frontend.layout.main')
@section('container')
    @php
       
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        /* header {
            display: none;
        } */
            header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
            display: none;
        }

        .remove-file {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif
    <script>
        $(document).ready(function() {
            let multipleCancelButton = new Choices("#choices-multiple-remove-button", {
                removeItemButton: true,
            });
        });

        function addMultipleFiles(input, block_id) {
            let block = document.getElementById(block_id);
            block.innerHTML = "";
            let files = input.files;
            for (let i = 0; i < files.length; i++) {
                let div = document.createElement('div');
                div.innerHTML += files[i].name;
                let viewLink = document.createElement("a");
                viewLink.href = URL.createObjectURL(files[i]);
                viewLink.textContent = "View";
                div.appendChild(viewLink);
                block.appendChild(div);
            }
        }
    </script>

    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="observation_id[]"></td>' +
                        // '<td><input type="date" name="date[]"></td>' +
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="date'+ serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date[]" class="hide-input" oninput="handleDateInput(this, `date' + serialNumber +'`)" /></div></div></div></td>' +

                        // '<td><select name="auditorG[]">' +
                        '<option value="">Select a value</option>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    html += '</select></td>' +
                        // '<td><select name="auditeeG[]">' +
                        // '<option value="">Select a value</option>';

                        // for (var i = 0; i < users.length; i++) {
                        //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                        // }
                        // html += '</select></td>' +
                        '<td><input type="text" name="observation_description[]"></td>' +
                        // '<td><input type="text" name="severity_level[]"></td>' +
                        '<td><input type="text" name="area[]"></td>' +
                        // '<td><input type="text" name="observation_category[]"></td>' +
                        // '<td><select name="capa_required[]"><option value="">Select A Value</option><option value="Yes">Yes</option><option value="No">No</option></select></td>' +
                        '<td><input type="text" name="auditee_response[]"></td>' +
                        // '<td><input type="text" name="auditor_review_on_response[]"></td>' +
                        // '<td><input type="text" name="qa_comment[]"></td>' +
                        // '<td><input type="text" name="capa_details[]"></td>' +
                        // '<td><input type="date" name="capa_due_date[]"></td>' +
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="capa_due_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="capa_due_date[]" class="hide-input" oninput="handleDateInput(this, `capa_due_date' + serialNumber +'`)" /></div></div></div></td>' +

                        // '<td><select name="capa_owner[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        //   '<td><input type="text" name="action_taken[]"></td>' +
                        // '<td><input type="date" name="capa_completion_date[]"></td>' +
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="capa_completion_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="capa_completion_date[]" class="hide-input" oninput="handleDateInput(this, `capa_completion_date' + serialNumber +'`)" /></div></div></div></td>' +

                        // '<td><input type="text" name="status_Observation[]"></td>' +
                        // '<td><input type="text" name="remark_observation[]"></td>' +

                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#onservation-field-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>

    <script>
        function addAuditAgenda(tableId) {
            var users = @json($users);
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='audit[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' +
                currentRowCount + '_checkdate"  class="hide-input" oninput="handleDateInput(this, `scheduled_start_date' +
            currentRowCount + '`);checkDate(`scheduled_start_date' + currentRowCount +
            '_checkdate`,`scheduled_end_date' + currentRowCount + '_checkdate`)" /></div></div></div></td>';

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='time' name='scheduled_start_time[]' >";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
                currentRowCount + '_checkdate" class="hide-input" oninput="handleDateInput(this, `scheduled_end_date' +
            currentRowCount + '`);checkDate(`scheduled_start_date' + currentRowCount +
            '_checkdate`,`scheduled_end_date' + currentRowCount + '_checkdate`)" /></div></div></div></td>';

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='time' name='scheduled_end_time[]' >";

            var cell7 = newRow.insertCell(6);
            var userHtml = '<select name="auditor[]"><option value="">-- Select --</option>';
            for (var i = 0; i < users.length; i++) {
                userHtml += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            }
            userHtml += '</select>';

            cell7.innerHTML = userHtml;

            var cell8 = newRow.insertCell(7);
            var cell8 = newRow.insertCell(7);

            var userHtml = '<select name="auditee[]"><option value="">-- Select --</option>';
            for (var i = 0; i < users.length; i++) {
                userHtml += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            }
            userHtml += '</select>';

            cell8.innerHTML = userHtml;

            var cell9 = newRow.insertCell(8);
            cell9.innerHTML = "<input type='text'name='remark[]'>";


            let cell10 = newRow.insertCell(9);
            cell10.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
    </script>


    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / External Audit
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                            $cftUsers = DB::table('external_audit_c_f_t_s')
                                ->where(['external_audit_id' => $data->id])
                                ->first();

                            // Define the column names
                            $columns = [
                                'Production_Table_Person',
                                'Production_Injection_Person',
                                'ResearchDevelopment_person',
                                'Store_person',
                                'Quality_Control_Person',
                                'QualityAssurance_person',
                                'RegulatoryAffair_person',
                                'ProductionLiquid_person',
                                'Microbiology_person',
                                'Engineering_person',
                                'ContractGiver_person',
                                'Environment_Health_Safety_person',
                                'Human_Resource_person',
                                'CorporateQualityAssurance_person',
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
                            $CompleteUser = DB::table('external_audit_c_f_t_responses')
                                ->whereIn('status', ['In-progress', 'Completed'])
                                ->where('external_audit_id', $data->id)
                                ->where('cft_user_id', Auth::user()->id)
                                ->whereNull('deleted_at')
                                ->first();
                            // dd($cftCompleteUser);
                        @endphp

                        <?php
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        ?>
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('ShowexternalAuditTrial', $data->id) }}"> Audit Trail </a> </button>




                        @if (
                            $data->stage == 1 &&
                                (Helpers::check_roles($data->division_id, 'External Audit', 7) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 66) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Audit Details Summary
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif(
                            $data->stage == 2 &&
                                (Helpers::check_roles($data->division_id, 'External Audit', 7) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 66) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Summary and Response Complete
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>

                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal1">
                                CFT Review Not Required
                            </button>
                        @elseif(
                            ($data->stage == 3 &&
                                (Helpers::check_roles($data->division_id, 'External Audit', 5) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 18))) ||
                                in_array(Auth::user()->id, $valuesArray))
                            @if (!$CompleteUser)
   

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Review Complete
                            </button>

                            
    @endif 
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Issue Report</button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button> --}}
                        @elseif(
                            $data->stage == 4 &&
                                (Helpers::check_roles($data->division_id, 'External Audit', 65) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 43) || Helpers::check_roles($data->division_id, 'External Audit', 42) || Helpers::check_roles($data->division_id, 'External Audit', 39) || Helpers::check_roles($data->division_id, 'External Audit', 9) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approval Complete
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>

                            
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Send to Opened
                            </button>
                        @elseif(
                            $data->stage == 5 &&
                                (Helpers::check_roles($data->division_id, 'External Audit', 65) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 43) || Helpers::check_roles($data->division_id, 'External Audit', 42) || Helpers::check_roles($data->division_id, 'External Audit', 39) ||  Helpers::check_roles($data->division_id, 'External Audit', 9) ||
                                    Helpers::check_roles($data->division_id, 'External Audit', 18)))
                            <button class="button_theme1"> <a class="text-white" href="{{ url('auditee') }}">
                                    Reopen
                                </a> </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <style>
                    /* Linear Connected Progress Bar */
                    .progress-bars {
                        display: flex;
                        border-radius: 30px;
                        overflow: hidden;
                        border: 1px solid #e0e0e0;
                        background: #f5f5f5;
                    }
                    
                    .progress-bars div {
                        padding: 8px 12px;
                        font-size: 14px;
                        flex-grow: 1;
                        text-align: center;
                        position: relative;
                        transition: all 0.3s ease;
                        border-right: 1px solid #fff;
                    }
                    
                    .progress-bars div:last-child {
                        border-right: none;
                    }
                    
                    /* Completed Stages - Solid Green */
                    .progress-bars div.completed {
                        background-color: #4CAF50;
                        color: black;
                    }
                    
                    /* CURRENT Stage - Animated Blue (Pending Action) */
                    .progress-bars div.current {
                        background-color: #de8d0a;
                        color: black;
                        font-weight: bold;
                        animation: pulse-blue 1.5s infinite;
                    }
                    
                    /* Pending Stages - Light Gray */
                    .progress-bars div.pending {
                        background-color: #f5f5f5;
                        color: black;
                    }
                    
                    /* Closed States */
                    .progress-bars div.closed {
                        background-color: #f44336;
                        color: white;
                    }
                    
                    /* Blue Pulse Animation */
                    @keyframes pulse-blue {
                        0% { background-color: #de8d0a; }
                        50% { background-color: #dfac54; }
                        100% { background-color: #de8d0a; }
                    }
                </style>
                        @php
                            $currentStage = $data->stage;
                        @endphp
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">

                            {{-- Stage 1 --}}
                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">
                                Opened
                            </div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">
                                Summary and Response
                            </div>

                            <div class="{{ $currentStage > 3 ? 'active' : ($currentStage == 3 ? 'current' : '') }}">
                                CFT Review
                            </div>

                            <div class="{{ $currentStage > 4 ? 'active' : ($currentStage == 4 ? 'current' : '') }}">
                                QA/CQA Head Approval
                            </div>

                            @if ($data->stage >= 5)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif

                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">
            {{-- ------------------------------- --}}

            {{-- ======================================
                    DATA FIELDS
                ======================================= --}}

            @php
                $users = DB::table('users')->get();
            @endphp

            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Summary Response</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CFT Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA/CQA Head Approval</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
                    </div>

                    <script>
                        function activateTabBasedOnStage(stage) {
                            const tabContents = document.querySelectorAll('.cctabcontent');
                            const tabLinks = document.querySelectorAll('.cctablinks');
                            
                            tabContents.forEach(content => content.style.display = 'none');
                            tabLinks.forEach(link => link.classList.remove('active'));
                            
                            let tabToActivate = '';
                            
                            if (stage == 1) {
                                tabToActivate = 'CCForm1'; 
                            } else if (stage == 2) {
                                tabToActivate = 'CCForm5'; 
                            }  else if (stage == 3) {
                                tabToActivate = 'CCForm7'; 
                            } else if (stage == 4) {
                                tabToActivate = 'CCForm8'; 
                            } else if (stage == 5) {
                                tabToActivate = 'CCForm6'; 
                            }

                            if (tabToActivate) {
                                const tabContent = document.getElementById(tabToActivate);
                                const tabLink = document.querySelector(`.cctablinks[onclick*="${tabToActivate}"]`);
                                
                                if (tabContent) tabContent.style.display = 'block';
                                if (tabLink) tabLink.classList.add('active');
                            }
                        }

                        function openCity(evt, cityName) {
                            const tabContents = document.querySelectorAll('.cctabcontent');
                            tabContents.forEach(content => content.style.display = 'none');
                            
                            const tabLinks = document.querySelectorAll('.cctablinks');
                            tabLinks.forEach(link => link.classList.remove('active'));
                            
                            document.getElementById(cityName).style.display = 'block';
                            evt.currentTarget.classList.add('active');
                            
                            currentStep = Array.from(tabLinks).findIndex(button => button === evt.currentTarget);
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            const currentStage = <?php echo json_encode($data->stage ?? 1); ?>;
                            
                            activateTabBasedOnStage(currentStage);
                        });
                    </script>

                    <form action="{{ route('updateExternalAudit', $data->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <!-- General information content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input type="hidden" name="record_number">
                                                {{-- <div class="static">QMS-EMEA/IA/{{ Helpers::year($data->created_at) }}/{{ $data->record }}</div> --}}
                                                <input disabled type="text"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/EA/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator</b></label>
                                                <input type="hidden" name="initiator_id">
                                                {{-- <div class="static">{{ $data->initiator_name }} </div> --}}
                                                <input disabled type="text" value="{{ $data->initiator_name }} ">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due">Date of Initiation</label>
                                                <input readonly type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>

                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Assigned to">Assigned to</label>
                                                        <select name="assign_to"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $key => $value)
    <option value="{{ $value->id }}"
                                                                    @if ($data->assign_to == $value->id) selected @endif>
                                                                    {{ $value->name }}</option>
    @endforeach
                                                        </select>
                                                    </div>
                                                </div> -->
                                        <!-- <div class="col-md-6">
                                                    <div class="group-input">
                                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                        <input readonly type="text"
                                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                            name="due_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                    </div>
                                                </div> -->





                                        <div class="col-md-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="due-date">Due Date <span
                                                        class="text-danger">*</span></label>
                                                <p class="text-primary">Last date this record should be closed by</p>
                                                <div class="calenderauditee">
                                                    <input type="text" id="due_date_display" readonly
                                                        placeholder="DD-MM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}" />
                                                    <input type="date" id="due_date" name="due_date"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" value="{{ $data->due_date }}"
                                                        oninput="handleDateInput(this, 'due_date_display')"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                        
                                                </div>
                                            </div>
                                        </div>

                                        {{-- javascript for due date --}}
                                        <script>
                                            function handleDateInput(dateInput, displayId) {
                                                const displayElement = document.getElementById(displayId);
                                                if (displayElement) {
                                                    const dateValue = new Date(dateInput.value);
                                                    const options = {
                                                        year: 'numeric',
                                                        month: 'short',
                                                        day: '2-digit'
                                                    };
                                                    displayElement.value = dateValue.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                                }
                                            }
                                        </script>


                                        <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator"><b>Initiator Department</b></label>
                                                    <input readonly type="text" name="Initiator_Group" id="initiator_group" 
                                                        value="{{ $data->Initiator_Group  }}">
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiation Group Code">Initiator Department Code</label>
                                                    <input type="text" name="initiator_group_code"
                                                        value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                                        readonly>
                                                    {{-- <div class="default-name"> <span
                                                    id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                                </div>
                                            </div>
                                    {{--                                        
                                        
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                                <label for="Initiator Group"><b>Initiator Department </b></label>
                                                <select name="Initiator_Group"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                    id="initiator_group">
                                                    <option value="">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate Quality
                                                        Assurance</option>
                                                    <option value="QA"
                                                        @if ($data->Initiator_Group == 'QA') selected @endif>Quality Assurance
                                                    </option>
                                                    <option value="QC"
                                                        @if ($data->Initiator_Group == 'QC') selected @endif>Quality Control
                                                    </option>
                                                    <option value="QM"
                                                        @if ($data->Initiator_Group == 'QM') selected @endif>Quality Control
                                                        (Microbiology department)</option>
                                                    <option value="PG"
                                                        @if ($data->Initiator_Group == 'PG') selected @endif>Production
                                                        General</option>
                                                    <option value="PL"
                                                        @if ($data->Initiator_Group == 'PL') selected @endif>Production Liquid
                                                        Orals</option>
                                                    <option value="PT"
                                                        @if ($data->Initiator_Group == 'PT') selected @endif>Production Tablet
                                                        and Powder</option>
                                                    <option value="PE"
                                                        @if ($data->Initiator_Group == 'PE') selected @endif>Production
                                                        External (Ointment, Gels, Creams and Liquid)</option>
                                                    <option value="PC"
                                                        @if ($data->Initiator_Group == 'PC') selected @endif>Production
                                                        Capsules</option>
                                                    <option value="PI"
                                                        @if ($data->Initiator_Group == 'PI') selected @endif>Production
                                                        Injectable</option>
                                                    <option value="EN"
                                                        @if ($data->Initiator_Group == 'EN') selected @endif>Engineering
                                                    </option>
                                                    <option value="HR"
                                                        @if ($data->Initiator_Group == 'HR') selected @endif>Human Resource
                                                    </option>
                                                    <option value="ST"
                                                        @if ($data->Initiator_Group == 'ST') selected @endif>Store</option>
                                                    <option value="IT"
                                                        @if ($data->Initiator_Group == 'IT') selected @endif>Electronic Data
                                                        Processing</option>
                                                    <option value="FD"
                                                        @if ($data->Initiator_Group == 'FD') selected @endif>Formulation
                                                        Development</option>
                                                    <option value="AL"
                                                        @if ($data->Initiator_Group == 'AL') selected @endif>Analytical
                                                        Research and Development Laboratory</option>
                                                    <option value="PD"
                                                        @if ($data->Initiator_Group == 'PD') selected @endif>Packaging
                                                        Development</option>
                                                    <option value="PU"
                                                        @if ($data->Initiator_Group == 'PU') selected @endif>Purchase
                                                        Department</option>
                                                    <option value="DC"
                                                        @if ($data->Initiator_Group == 'DC') selected @endif>Document Cell
                                                    </option>
                                                    <option value="RA"
                                                        @if ($data->Initiator_Group == 'RA') selected @endif>Regulatory
                                                        Affairs</option>
                                                    <option value="PV"
                                                        @if ($data->Initiator_Group == 'PV') selected @endif>
                                                        Pharmacovigilance</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Department Code </label>
                                                <input type="text"
                                                    name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                    value="{{ $data->Initiator_Group }}" id="initiator_group_code"
                                                    readonly>

                                            </div>
                                        </div>
                                        --}}
    
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                                <textarea name="short_description" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span
                                                    id="rchars">255</span>
                                                characters remaining

                                                <input name="short_description" id="docname" type="text"
                                                    value="{{ $data->short_description }}" maxlength="255" required
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                    type="text">
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through
                                                @if ($data->stage == 1)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <select name="initiated_through" id="initiated_through" 
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} required>
                                                    <option value="">-- select --</option>
                                                    <option value="recall" {{ $data->initiated_through == 'recall' ? 'selected' : '' }}>Recall</option>
                                                    <option value="return" {{ $data->initiated_through == 'return' ? 'selected' : '' }}>Return</option>
                                                    <option value="complaint" {{ $data->initiated_through == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                    <option value="regulatory" {{ $data->initiated_through == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                                    <option value="improvement" {{ $data->initiated_through == 'improvement' ? 'selected' : '' }}>Improvement</option>
                                                    <option value="others" {{ $data->initiated_through == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Others field initially hidden -->
                                        <div class="col-lg-6" id="initiated_through_req" 
                                            style="display: {{ $data->initiated_through == 'others' ? 'block' : 'none' }};">
                                            <div class="group-input">
                                                <label for="If Other">Others <span id="required-asterisk" 
                                                    class="text-danger {{ $data->initiated_through == 'others' ? '' : 'd-none' }}">*</span>
                                                </label>
                                                <textarea name="initiated_if_other" id="initiated_if_other"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->initiated_if_other }}</textarea>
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById('initiated_through').addEventListener('change', function() {
                                                var othersField = document.getElementById('initiated_through_req');
                                                var othersTextarea = document.getElementById('initiated_if_other');
                                                var requiredAsterisk = document.getElementById('required-asterisk');

                                                if (this.value === 'others') {
                                                    othersField.style.display = 'block'; // Show textarea
                                                    requiredAsterisk.classList.remove('d-none'); // Show red asterisk
                                                    othersTextarea.setAttribute('required', 'required'); // Make textarea required
                                                } else {
                                                    othersField.style.display = 'none'; // Hide textarea
                                                    requiredAsterisk.classList.add('d-none'); // Hide red asterisk
                                                    othersTextarea.removeAttribute('required'); // Remove required validation
                                                    othersTextarea.value = ''; // Clear textarea when hiding
                                                }
                                            });
                                        </script>

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <select {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="repeat"
                                                    onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option  @if ($data->repeat == 'Yes') selected @endif value="Yes">Yes</option>
                                                    <option  @if ($data->repeat == 'No') selected @endif value="No">No</option>
                                                    <option  @if ($data->repeat == 'NA') selected @endif value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="repeat_nature">{{$data->repeat_nature}}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="audit_type">Type of Audit
                                                @if ($data->stage == 1)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <select name="audit_type" id="audit_type" 
                                                    onchange="toggleField(this.value, 'if_other_field', 'if_other_textarea', 'if_other_asterisk')"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} required>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="R&D" {{ $data->audit_type == 'R&D' ? 'selected' : '' }}>R&D</option>
                                                    <option value="GLP" {{ $data->audit_type == 'GLP' ? 'selected' : '' }}>GLP</option>
                                                    <option value="GCP" {{ $data->audit_type == 'GCP' ? 'selected' : '' }}>GCP</option>
                                                    <option value="GDP" {{ $data->audit_type == 'GDP' ? 'selected' : '' }}>GDP</option>
                                                    <option value="GEP" {{ $data->audit_type == 'GEP' ? 'selected' : '' }}>GEP</option>
                                                    <option value="ISO 17025" {{ $data->audit_type == 'ISO 17025' ? 'selected' : '' }}>ISO 17025</option>
                                                    <option value="GMP" {{ $data->audit_type == 'GMP' ? 'selected' : '' }}>GMP</option>
                                                    <option value="cGMP" {{ $data->audit_type == 'cGMP' ? 'selected' : '' }}>cGMP</option>
                                                    <option value="others" {{ $data->audit_type == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- If Other field -->
                                        <div class="col-lg-6" id="if_other_field" style="display: {{ $data->audit_type == 'others' ? 'block' : 'none' }};">
                                            <div class="group-input">
                                                <label for="If Other">If Other
                                                    <span id="if_other_asterisk" class="text-danger {{ $data->audit_type == 'others' ? '' : 'd-none' }}">*</span>
                                                </label>
                                                <textarea name="if_other" id="if_other_textarea"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->if_other }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="external_agencies">External Agencies
                                                @if ($data->stage == 1)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <select name="external_agencies" id="external_agencies"
                                                    onchange="toggleField(this.value, 'others_field', 'others_textarea', 'others_asterisk')"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="Jordan FDA" {{ $data->external_agencies == 'Jordan FDA' ? 'selected' : '' }}>Jordan FDA</option>
                                                    <option value="USFDA" {{ $data->external_agencies == 'USFDA' ? 'selected' : '' }}>USFDA</option>
                                                    <option value="MHRA" {{ $data->external_agencies == 'MHRA' ? 'selected' : '' }}>MHRA</option>
                                                    <option value="ANVISA" {{ $data->external_agencies == 'ANVISA' ? 'selected' : '' }}>ANVISA</option>
                                                    <option value="ISO" {{ $data->external_agencies == 'ISO' ? 'selected' : '' }}>ISO</option>
                                                    <option value="WHO" {{ $data->external_agencies == 'WHO' ? 'selected' : '' }}>WHO</option>
                                                    <option value="Local FDA" {{ $data->external_agencies == 'Local FDA' ? 'selected' : '' }}>Local FDA</option>
                                                    <option value="TGA" {{ $data->external_agencies == 'TGA' ? 'selected' : '' }}>TGA</option>
                                                    <option value="EU-GMP" {{ $data->external_agencies == 'EU-GMP' ? 'selected' : '' }}>EU-GMP</option>
                                                    <option value="others" {{ $data->external_agencies == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Others field for External Agencies -->
                                        <div class="col-lg-6" id="others_field" style="display: {{ $data->external_agencies == 'others' ? 'block' : 'none' }};">
                                            <div class="group-input">
                                                <label for="others">Others
                                                    <span id="others_asterisk" class="text-danger {{ $data->external_agencies == 'others' ? '' : 'd-none' }}">*</span>
                                                </label>
                                                <textarea name="others" id="others_textarea"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->others }}</textarea>
                                            </div>
                                        </div>

                                        <script>
                                            function toggleField(selectedValue, fieldId, textareaId, asteriskId) {
                                                var field = document.getElementById(fieldId);
                                                var textarea = document.getElementById(textareaId);
                                                var asterisk = document.getElementById(asteriskId);

                                                if (selectedValue === 'others') {
                                                    field.style.display = 'block';
                                                    asterisk.classList.remove('d-none');  // ✅ Show red *
                                                    textarea.setAttribute('required', 'required');
                                                } else {
                                                    field.style.display = 'none';
                                                    asterisk.classList.add('d-none');  // ✅ Hide red *
                                                    textarea.removeAttribute('required');
                                                    textarea.value = ''; // Clear field when hidden
                                                }
                                            }
                                        </script>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Initial Comments">Description
                                                @if ($data->stage == 1)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <textarea name="initial_comments" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }}  required>{{ $data->initial_comments }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input" id="IncidentRow">
                                                <label for="root_cause">
                                                    Auditors
                                                    @if ($data->stage == 1)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                    <button type="button"
                                                        {{ $data->stage == 0 ||$data->stage == 2 || $data->stage == 3|| $data->stage == 5 ? 'disabled' : '' }}  
                                                        name="audit-incident-grid" id="IncidentAddAuditor">+</button>
                                                   
                                                </label>

                                                <table class="table table-bordered"
                                                    id="onservation-incident-tableAuditors">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Auditor Name</th>
                                                            <th>External Agency Name</th>
                                                            <th>Designation</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @if (isset($auditorview) && isset($auditorview->data))
                                                            @foreach ($auditorview->data as $audditor)
                                                                <tr>
                                                                    <td disabled>{{ $serialNumber++ }}</td>
                                                                    <td><input type="text"
                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}{{ $data->stage == 1 ? '' : 'readonly' }}
                                                                            name="AuditorNew[{{ $loop->index }}][auditornew]"
                                                                            value="{{ $audditor['auditornew'] }}" required></td>
                                                                    <td><input type="text"
                                                                            name="AuditorNew[{{ $loop->index }}][regulatoryagency]"
                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }}
                                                                            value="{{ $audditor['regulatoryagency'] }}" required>
                                                                    </td>
                                                                    <td>
                                                                        <select
                                                                            name="AuditorNew[{{ $loop->index }}][designation]"
                                                                            class="form-select"
                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }} required>
                                                                            <option value="">--Select--</option>
                                                                            <option value="Lead Auditor"
                                                                                {{ $audditor['designation'] == 'Lead Auditor' ? 'selected' : '' }}>
                                                                                Lead Auditor</option>
                                                                            <option value="Auditor"
                                                                                {{ $audditor['designation'] == 'Auditor' ? 'selected' : '' }}>
                                                                                Auditor</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="AuditorNew[{{ $loop->index }}][remarks]"
                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }}
                                                                            value="{{ $audditor['remarks'] }}" required></td>
                                                                    <td><button class="removeRowBtn"
                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Remove</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        @php
                                            $auditorCount =
                                                isset($auditorview) && isset($auditorview->data)
                                                    ? count($auditorview->data)
                                                    : 0;
                                        @endphp

                                        <script>
                                            $(document).ready(function() {
                                                let investdetails = {{ $auditorCount }}; // Start from the current count of rows

                                                $('#IncidentAddAuditor').click(function(e) {
                                                    e.preventDefault();

                                                    function generateTableRow(serialNumber) {
                                                        var isDisabled = '{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}';

                                                        var html =
                                                            '<tr>' +
                                                            '<td><input disabled type="text" style="width:15px" value="' + serialNumber +
                                                            '"></td>' +
                                                            '<td><input type="text" name="AuditorNew[' + investdetails + '][auditornew]" ' +
                                                            isDisabled + ' value=""></td>' +
                                                            '<td><input type="text" name="AuditorNew[' + investdetails +
                                                            '][regulatoryagency]" ' + isDisabled + ' value=""></td>' +
                                                            '<td>' +
                                                            '<select name="AuditorNew[' + investdetails +
                                                            '][designation]" class="form-select" ' + isDisabled + '>' +
                                                            '<option value="">--Select--</option>' +
                                                            '<option value="Lead Auditor">Lead Auditor</option>' +
                                                            '<option value="Auditor">Auditor</option>' +
                                                            '</select>' +
                                                            '</td>' +
                                                            '<td><input type="text" name="AuditorNew[' + investdetails + '][remarks]" ' +
                                                            isDisabled + ' value=""></td>' +
                                                            '<td><button class="removeRowBtn" ' + isDisabled + '>Remove</button></td>' +
                                                            '</tr>';

                                                        investdetails++;
                                                        return html;
                                                    }

                                                    var tableBody = $('#onservation-incident-tableAuditors tbody');
                                                    var newRow = generateTableRow(investdetails + 1);
                                                    tableBody.append(newRow);
                                                });

                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();
                                                    $('#onservation-incident-tableAuditors tbody tr').each(function(index) {
                                                        $(this).find('td:first input').val(index + 1);
                                                    });
                                                });
                                            });
                                        </script>





                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Audit Schedule Start Date">Start Date of Audit     
                                                    @if($data->stage == 1)
                                                      <span style="color: red;">*</span>
                                                    @endif
                                                </label>
                                                {{-- <div class="calenderauditee">
                                    <input type="text"
                                        id="start_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->start_date) }}"  />
                                    <input class="hide-input" type="date"   name="start_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} id="start_date_checkdate" value="{{ $data->start_date }}"
                                        oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                </div> --}}
                                                <div class="calenderauditee">
                                                    <input type="text" id="start_date_gi" name="start_date_gi"
                                                        readonly placeholder="DD-MM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->start_date_gi) }}" />
                                                    <input type="date" id="start_date_gi_name"
                                                        name="start_date_gi_name"
                                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ $data->start_date_gi ? \Carbon\Carbon::parse($data->start_date_gi)->format('Y-m-d') : '' }}"
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'start_date_gi');updateEndDateMin();"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}{{ $data->stage == 1 ? '' : 'readonly' }} />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Audit Schedule End Date">End Date of Audit
                                                    @if($data->stage == 1)
                                                      <span style="color: red;">*</span>
                                                    @endif
                                                </label>
                                                {{-- <input type="date" name="end_date" value="{{ $data->end_date }}" --}}
                                                {{-- <div class="calenderauditee">
                                    <input type="text"
                                        id="end_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->end_date) }}"  />
                                    <input class="hide-input" type="date"   name="end_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} id="end_date_checkdate" value="{{ $data->end_date }}"
                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_gi_checkdate','end_date_checkdate')" />
                                </div> --}}
                                                <div class="calenderauditee">
                                                    <input type="text" id="end_date_gi" name="end_date_gi" readonly
                                                        placeholder="DD-MM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->end_date_gi) }}" />
                                                    <input type="date" id="end_date_gi_name" name="end_date_gi_name"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ $data->end_date_gi ? \Carbon\Carbon::parse($data->end_date_gi)->format('Y-m-d') : '' }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'end_date_gi');"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                </div>
                                            </div>
                                        </div>


                                        <script>
                                            function handleDateInput(inputElement, displayElementId) {
                                                var displayElement = document.getElementById(displayElementId);
                                                var dateValue = new Date(inputElement.value);
                                                displayElement.value = dateValue.toLocaleDateString('en-GB', {
                                                    day: '2-digit',
                                                    month: '2-digit',
                                                    year: 'numeric'
                                                });
                                            }

                                            function updateEndDateMin() {
                                                var startDate = document.getElementById('start_date_gi_name').value;
                                                var endDateInput = document.getElementById('end_date_gi_name');

                                                if (startDate) {
                                                    // Set the minimum date to one day after the start date
                                                    var minEndDate = new Date(startDate);
                                                    minEndDate.setDate(minEndDate.getDate() + 1);

                                                    // Format the date to match the input type date format (yyyy-mm-dd)

                                                    var formattedMinEndDate = minEndDate.toISOString().split('T')[0];
                                                    endDateInput.setAttribute('min', formattedMinEndDate);

                                                    // Ensure the next audit date is after the last audit date
                                                    if (endDateInput.value && endDateInput.value <= startDate) {
                                                        endDateInput.value = '';
                                                        // alert("The next audit date must be after the last audit date.");
                                                    }
                                                }
                                            }

                                            document.addEventListener("DOMContentLoaded", function() {
                                                updateEndDateMin(); // Initialize the end date min on page load

                                                // Reapply the min attribute whenever the start date is changed
                                                document.getElementById('start_date_gi_name').addEventListener('input', function() {
                                                    updateEndDateMin();
                                                });

                                                // Validate the end date when it is changed
                                                document.getElementById('end_date_gi_name').addEventListener('input', function() {
                                                    updateEndDateMin();
                                                });
                                            });
                                        </script>










                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="inv_attachment">GI Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="inv_attachment">
                                                        @if ($data->inv_attachment)
                                                            @foreach (json_decode($data->inv_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i>
                                                                    </a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}">
                                                                        <i class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i>
                                                                    </a>
                                                                    <input type="hidden" name="existing_inv_attachment[]"
                                                                        value="{{ $file }}">
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="inv_attachment[]"
                                                            {{ $data->stage == 0 ||$data->stage == 2 ||$data->stage == 3 || $data->stage == 5 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'inv_attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden field to keep track of files to be deleted -->
                                        <input type="hidden" id="deleted_inv_attachment" name="deleted_inv_attachment"
                                            value="">

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const removeButtons = document.querySelectorAll('.remove-file');

                                                removeButtons.forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        const fileName = this.getAttribute('data-file-name');
                                                        const fileContainer = this.closest('.file-container');

                                                        // Hide the file container
                                                        if (fileContainer) {
                                                            fileContainer.style.display = 'none';
                                                            // Remove hidden input associated with this file
                                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                            if (hiddenInput) {
                                                                hiddenInput.remove();
                                                            }

                                                            // Add the file name to the deleted files list
                                                            const deletedFilesInput = document.getElementById('deleted_inv_attachment');
                                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                                ',') : [];
                                                            deletedFiles.push(fileName);
                                                            deletedFilesInput.value = deletedFiles.join(',');
                                                        }
                                                    });
                                                });
                                            });

                                            function addMultipleFiles(input, id) {
                                                const fileListContainer = document.getElementById(id);
                                                const files = input.files;

                                                for (let i = 0; i < files.length; i++) {
                                                    const file = files[i];
                                                    const fileName = file.name;
                                                    const fileContainer = document.createElement('h6');
                                                    fileContainer.classList.add('file-container', 'text-dark');
                                                    fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                                    const fileText = document.createElement('b');
                                                    fileText.textContent = fileName;

                                                    const viewLink = document.createElement('a');
                                                    viewLink.href = '#'; // You might need to adjust this to handle local previews
                                                    viewLink.target = '_blank';
                                                    viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                                    const removeLink = document.createElement('a');
                                                    removeLink.classList.add('remove-file');
                                                    removeLink.dataset.fileName = fileName;
                                                    removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                                    removeLink.addEventListener('click', function() {
                                                        fileContainer.style.display = 'none';
                                                    });

                                                    fileContainer.appendChild(fileText);
                                                    fileContainer.appendChild(viewLink);
                                                    fileContainer.appendChild(removeLink);

                                                    fileListContainer.appendChild(fileContainer);
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Audit Planning content -->
                            <!-- <div id="CCForm2" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Audit Schedule Start Date">Audit Start Date</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="start_date" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data->start_date) }}"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} />
                                                        <input type="date" id="start_date_checkdate"
                                                            name="start_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                            value="{{ $data->start_date }}" class="hide-input"
                                                            oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input  input-date">
                                                    <label for="Audit Schedule End Date">Audit End Date</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="end_date" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data->end_date) }}"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} />
                                                        <input type="date" id="end_date_checkdate" name="end_date"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                            value="{{ $data->end_date }}" class="hide-input"
                                                            oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="audit-agenda-grid">
                                                        Audit Agenda<button type="button" name="audit-agenda-grid"
                                                            onclick="addAuditAgenda('audit-agenda-grid')"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>+</button>
                                                    </label>
                                                    <table class="table table-bordered" id="audit-agenda-grid">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Area of Audit</th>
                                                                <th>Scheduled Start Date</th>
                                                                <th>Scheduled Start Time</th>
                                                                <th>Scheduled End Date</th>
                                                                <th>Scheduled End Time</th>
                                                                <th>Auditor</th>
                                                                <th>Auditee</th>
                                                                <th>Remarks</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($grid_data->start_date)
    @foreach (unserialize($grid_data->start_date) as $key => $temps)
    <tr>
                                                                        <td><input disabled type="text"
                                                                                name="serial_number[]"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                value="{{ $key + 1 }}"></td>

                                                                        <td><input type="text"
                                                                                name="audit[]"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                value="{{ unserialize($grid_data->area_of_audit)[$key] ? unserialize($grid_data->area_of_audit)[$key] : '' }}">
                                                                        </td>

                                                                        <td>
                                                                            <div class="group-input new-date-data-field mb-0">
                                                                                <div class="input-date ">
                                                                                    <div class="calenderauditee">
                                                                                        <input type="text" class="test"
                                                                                            id="scheduled_start_date{{ $key }}"
                                                                                            readonly placeholder="DD-MMM-YYYY"
                                                                                            value="{{ Helpers::getdateFormat(unserialize($grid_data->start_date)[$key]) }}" />
                                                                                        <input type="date"
                                                                                            id="schedule_start_date{{ $key }}_checkdate"
                                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                            name="scheduled_start_date[]"
                                                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                            value="{{ unserialize($grid_data->start_date)[$key] }}"
                                                                                            class="hide-input"
                                                                                            oninput="handleDateInput(this, `scheduled_start_date{{ $key }}`);checkDate('schedule_start_date{{ $key }}_checkdate','schedule_end_date{{ $key }}_checkdate')" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td><input type="time"
                                                                                name="scheduled_start_time[]"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                value="{{ unserialize($grid_data->start_time)[$key] ? unserialize($grid_data->start_time)[$key] : '' }}">
                                                                        </td>

                                                                        <td>
                                                                            <div class="group-input new-date-data-field mb-0">
                                                                                <div class="input-date ">
                                                                                    <div class="calenderauditee">
                                                                                        <input type="text" class="test"
                                                                                            id="scheduled_end_date{{ $key }}"
                                                                                            readonly placeholder="DD-MMM-YYYY"
                                                                                            value="{{ Helpers::getdateFormat(unserialize($grid_data->end_date)[$key]) }}" />
                                                                                        <input type="date"
                                                                                            id="schedule_end_date{{ $key }}_checkdate"
                                                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                            name="scheduled_end_date[]"
                                                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                            value="{{ unserialize($grid_data->end_date)[$key] }}"
                                                                                            class="hide-input"
                                                                                            oninput="handleDateInput(this, `scheduled_end_date{{ $key }}`);checkDate('schedule_start_date{{ $key }}_checkdate','schedule_end_date{{ $key }}_checkdate')" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>



                                                                        <td><input type="time" name="scheduled_end_time[]"
                                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                value="{{ unserialize($grid_data->end_time)[$key] ? unserialize($grid_data->end_time)[$key] : '' }}">
                                                                        </td>
                                                                        <td> <select id="select-state" placeholder="Select..."
                                                                                name="auditor[]"
                                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                                                <option value="">-Select-</option>
                                                                                @foreach ($users as $value)
    <option
                                                                                        {{ unserialize($grid_data->auditor)[$key] ? (unserialize($grid_data->auditor)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                                        value="{{ $value->id }}">
                                                                                        {{ $value->name }}
                                                                                    </option>
    @endforeach
                                                                            </select></td>
                                                                        <td> <select id="select-state" placeholder="Select..."
                                                                                name="auditee[]"
                                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                                                <option value="">-Select-</option>
                                                                                @foreach ($users as $value)
    <option
                                                                                        {{ unserialize($grid_data->auditee)[$key] ? (unserialize($grid_data->auditee)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                                        value="{{ $value->id }}">
                                                                                        {{ $value->name }}
                                                                                    </option>
    @endforeach
                                                                            </select></td>

                                                                        <td><input type="text"
                                                                                name="remark[]"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                                value="{{ unserialize($grid_data->remark)[$key] ? unserialize($grid_data->remark)[$key] : '' }}">
                                                                        </td>
                                                                        <td><button type="text" class="removeRowBtn"
                                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Remove</button>
                                                                        </td>
                                                                    </tr>
    @endforeach
    @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Product/Material Name">Product/Material Name</label>
                                                    <input type="text" name="material_name"
                                                        value="{{ $data->material_name }}"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Comments(If Any)">Comments(If Any)</label>
                                                    <textarea name="if_comments" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->if_comments }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            @if ($data->stage != 0)
    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
    @endif
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                    class="text-white"> Exit </a> </button>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- Audit Preparation content -->
                            <!-- <div id="CCForm3" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="Lead Auditor">Lead Auditor</label>
                                                    <select name="lead_auditor"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $key => $value)
    <option value="{{ $value->id }}"
                                                                @if ($data->lead_auditor == $value->id) selected @endif>
                                                                {{ $value->name }}</option>
    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="File Attachments">File Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="file_attachment">
                                                            @if ($data->file_attachment)
    @foreach (json_decode($data->file_attachment) as $file)
    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
    @endforeach
    @endif

                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                type="file" id="myfile" name="file_attachment[]"
                                                                oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                    {{-- <input type="file" id="myfile" name="file_attachment"
                                                    value="{{ $data->file_attachment }}" --}}
                                                    {{-- {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}> --}}
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="audit-agenda-grid">
                                                    Observation Details
                                                    <button type="button" name="audit-agenda-grid"
                                                      id="ObservationAdd">+</button>
                                                    <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#observation-field-instruction-modal"
                                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                        (Launch Instruction)
                                                    </span>
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="onservation-field-table"
                                                        style="width: 150%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Row#</th>
                                                                <th>Observation ID</th>
                                                                <th>Date</th>
                                                                <th>Auditor</th>
                                                                <th>Auditee</th>
                                                                <th>Observation Description</th>
                                                                <th>Severity Level</th>
                                                                <th>Area/process</th>
                                                                <th>Observation Category</th>
                                                                <th>CAPA Required</th>
                                                                <th>Auditee Response</th>
                                                                <th>Auditor Review on Response</th>
                                                                <th>QA Comments</th>
                                                                <th>CAPA Details</th>
                                                                <th>CAPA Due Date</th>
                                                                <th>CAPA Owner</th>
                                                                <th>Action Taken</th>
                                                                <th>CAPA Completion Date</th>
                                                                <th>Status</th>
                                                                <th>Remarks</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="observationDetail">
                                                            @if ($grid_data1->observation_id)
                                                            @foreach (unserialize($grid_data1->observation_id) as $key => $tempData)
                                                            <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td><input type="text" name="observation_id[]" value="{{ $tempData ? $tempData : "" }}"></td>
                                                                    <td><input type="date" name="date[]" value="{{unserialize($grid_data1->date)[$key] ? unserialize($grid_data1->date)[$key]: "" }}"></td>
                                                                <td>
                                                                    <select placeholder="Select..." name="auditorG[]">
                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $datas)
                                                                            <option value="{{ $datas->id }}">

                                                                                {{ $datas->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select placeholder="Select..." name="auditeeG[]">
                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $datas)
                                                                            <option value="{{ $datas->id }}">

                                                                                {{ $datas->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>                                                            <td><input type="text" name="observation_description[]" value="{{unserialize($grid_data1->observation_description)[$key] ? unserialize($grid_data1->observation_description)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="severity_level[]" value="{{unserialize($grid_data1->severity_level)[$key] ? unserialize($grid_data1->severity_level)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="area[]" value="{{unserialize($grid_data1->area)[$key] ? unserialize($grid_data1->area)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="observation_category[]" value="{{unserialize($grid_data1->observation_category)[$key] ? unserialize($grid_data1->observation_category)[$key]: "" }}"></td>
                                                                    <td>
                                                                        <select name="capa_required[]">
                                                                            <option value="0">-- Select --</option>
                                                                            <option value="yes">Yes</option>
                                                                            <option value="no">No</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" name="auditee_response[]" value="{{unserialize($grid_data1->auditee_response)[$key] ? unserialize($grid_data1->auditee_response)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="auditor_review_on_response[]" value="{{unserialize($grid_data1->auditor_review_on_response)[$key] ? unserialize($grid_data1->auditor_review_on_response)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="qa_comment[]" value="{{unserialize($grid_data1->qa_comment)[$key] ? unserialize($grid_data1->qa_comment)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="capa_details[]" value="{{unserialize($grid_data1->capa_details)[$key] ? unserialize($grid_data1->capa_details)[$key]: "" }}"></td>
                                                                    <td><input type="date" name="capa_due_date[]" value="{{unserialize($grid_data1->capa_due_date)[$key] ? unserialize($grid_data1->capa_due_date)[$key]: "" }}"></td>
                                                                    <td>
                                                                        <select placeholder="Select..." name="capa_owner[]">
                                                                            <option value="">Select a value</option>
                                                                            @foreach ($users as $datas)
                                                                                <option value="{{ $datas->id }}">
                                                                                    {{ $datas->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" name="action_taken[]" value="{{unserialize($grid_data1->action_taken)[$key] ? unserialize($grid_data1->action_taken)[$key]: "" }}"></td>
                                                                    <td><input type="date" name="capa_completion_date[]" value="{{unserialize($grid_data1->capa_completion_date)[$key] ? unserialize($grid_data1->capa_completion_date)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="status_Observation[]" value="{{unserialize($grid_data1->status)[$key] ? unserialize($grid_data1->status)[$key]: "" }}"></td>
                                                                    <td><input type="text" name="remark_observation[]" value="{{unserialize($grid_data1->remark)[$key] ? unserialize($grid_data1->remark)[$key]: "" }}"></td>
                                                                </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> --}}
                                            <div class="col-6">
                                                <div class="group-input">
                                                    <label for="Audit Team">Audit Team</label>
                                                    <select multiple name="Audit_team[]" placeholder="Select Audit Team"
                                                        data-search="false" data-silent-initial-value-set="true"
                                                        id="Audit"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                        @foreach ($users as $user)
    <option value="{{ $user->id }}"
                                                                {{ in_array($user->id, explode(',', $data->Audit_team)) ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="group-input">
                                                    <label for="Auditee">Auditee</label>
                                                    <select multiple name="Auditee[]" placeholder="Select Auditee"
                                                        data-search="false" data-silent-initial-value-set="true"
                                                        id="Auditee"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                        @foreach ($users as $user)
    <option value="{{ $user->id }}"
                                                                {{ in_array($user->id, explode(',', $data->Auditee)) ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="External Auditor Details">External Auditor Details</label>
                                                    <textarea name="Auditor_Details" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Auditor_Details }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="External Auditing Agency">External Auditing Agency</label>
                                                    <textarea name="External_Auditing_Agency" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->External_Auditing_Agency }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Relevant Guidelines / Industry Standards">Relevant Guidelines /
                                                        Industry Standards</label>
                                                    <textarea name="Relevant_Guidelines" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Relevant_Guidelines }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="QA Comments">QA Comments</label>
                                                    <textarea name="QA_Comments" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->QA_Comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Guideline Attachment">Guideline Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="file_attachment_guideline">
                                                            @if ($data->file_attachment_guideline)
    @foreach (json_decode($data->file_attachment_guideline) as $file)
    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
    @endforeach
    @endif

                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="file_attachment_guideline[]"
                                                                oninput="addMultipleFiles(this, 'file_attachment_guideline')"
                                                                multiple>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Audit Category">Audit Category</label>
                                                    <select name="Audit_Category"
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data->Audit_Category == '1') selected @endif
                                                            value="1">Internal Audit/Self Inspection</option>
                                                        <option @if ($data->Audit_Category == '2') selected @endif
                                                            value="2">Supplier Audit</option>
                                                        <option @if ($data->Audit_Category == '3') selected @endif
                                                            value="3">Regulatory Audit</option>
                                                        <option @if ($data->Audit_Category == '4') selected @endif
                                                            value="4">Consultant Audit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label
                                                        for="Supplier/Vendor/Manufacturer Details">Supplier/Vendor/Manufacturer
                                                        Details</label>
                                                    <textarea type="text" name="Supplier_Details" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Supplier_Details }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Supplier/Vendor/Manufacturer Site">Supplier/Vendor/Manufacturer
                                                        Site</label>
                                                    <textarea type="text" name="Supplier_Site" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Supplier_Site }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Comments">Comments</label>
                                                    <textarea name="Comments" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Comments }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            @if ($data->stage != 0)
    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
    @endif
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                    class="text-white"> Exit </a> </button>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- Audit Execution content -->
                            <!-- <div id="CCForm4" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Audit Start Date">Audit Start Date</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="audit_start_date" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data->audit_start_date) }}"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} />
                                                        <input type="date" id="audit_start_date_checkdate"
                                                            name="audit_start_date"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                            value="{{ $data->audit_start_date }}" class="hide-input"
                                                            oninput="handleDateInput(this, 'audit_start_date');checkDate('audit_start_date_checkdate','audit_end_date_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Audit End Date">Audit End Date</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="audit_end_date" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data->audit_end_date) }}"
                                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} />
                                                        <input type="date" id="audit_end_date_checkdate"
                                                            name="audit_end_date"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                            value="{{ $data->audit_end_date }}" class="hide-input"
                                                            oninput="handleDateInput(this, 'audit_end_date');checkDate('audit_start_date_checkdate','audit_end_date_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="severity-level">Observation Category</label>
                                                    <select {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                        name="severity_level">
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data->severity_level == 'minor') selected @endif
                                                            value="minor">Minor</option>
                                                        <option @if ($data->severity_level == 'major') selected @endif
                                                            value="major">Major</option>
                                                        <option @if ($data->severity_level == 'critical') selected @endif
                                                            value="critical">Critical</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="Audit Attachments">Audit Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    {{-- <input type="file" id="myfile" name="Audit_file"
                                                    value="{{ $data->Audit_file }}"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}> --}}
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="Audit_file">
                                                            @if ($data->Audit_file)
    @foreach (json_decode($data->Audit_file) as $file)
    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
    @endforeach
    @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input type="file" id="myfile"
                                                                name="Audit_file[]"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Audit_file')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Audit Comments">Audit Comments</label>
                                                    <textarea name="Audit_Comments1" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Audit_Comments1 }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            @if ($data->stage != 0)
    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
    @endif
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                    class="text-white"> Exit </a> </button>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- Audit Response & Closure content -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">
                                            Summary Response
                                        </div>



                                        <!-- New Grid Added -->

                                        <div class="col-12">
                                            <div class="group-input" id="IncidentRow">
                                                <label for="root_cause">
                                                    Summary Response  
                                                    @if ($data->stage == 2)
                                                    <span
                                                    class="text-danger">*</span>
                                                    @endif
                                                    <button type="button"
                                                        {{$data->stage == 1||$data->stage == 3||$data->stage == 4 || $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                        name="audit-incident-grid" id="IncidentAdd">+</button>
                                                  
                                                </label>

                                                <table class="table table-bordered" id="onservation-incident-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Observation</th>
                                                            <th>Category</th>
                                                            <th>Response</th>
                                                            <th>CAPA / Child action Reference If Any</th>
                                                            <th>Status</th>
                                                            
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                            
                                                        @endphp
                                                        @foreach ($oocgrid->data as $oogrid)
                                                        <tr>
                                                            <td disabled>{{ $serialNumber++ }}</td>
                                                            <td>
                                                                <textarea 
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}
                                                                    name="SummaryResponse[{{ $loop->index }}][observation]"
                                                                    {{ $data->stage == 2 ? 'required' : '' }}>{{ $oogrid['observation'] ?? '' }}</textarea>
                                                            </td>

                                                            <td style="width: 91px;">
                                                                <select
                                                                    name="SummaryResponse[{{ $loop->index }}][category]"
                                                                    class="form-select"
                                                                    {{ in_array($data->stage, [0,3,4,1, 5]) ? 'disabled' : '' }}>
                                                                    <option value="">--Select--</option>
                                                                    <option value="Major" {{ ($oogrid['category'] ?? '') == 'Major' ? 'selected' : '' }}>Major</option>
                                                                    <option value="Minor" {{ ($oogrid['category'] ?? '') == 'Minor' ? 'selected' : '' }}>Minor</option>
                                                                    <option value="Critical" {{ ($oogrid['category'] ?? '') == 'Critical' ? 'selected' : '' }}>Critical</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea 
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}
                                                                    name="SummaryResponse[{{ $loop->index }}][response]"
                                                                    {{ $data->stage == 2 ? 'required' : '' }}>{{ $oogrid['response'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea 
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}
                                                                    name="SummaryResponse[{{ $loop->index }}][reference_id]"
                                                                    {{ $data->stage == 2 ? 'required' : '' }}>{{ $oogrid['reference_id'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea 
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}
                                                                    name="SummaryResponse[{{ $loop->index }}][status]"
                                                                    {{ $data->stage == 2 ? 'required' : '' }}>{{ $oogrid['status'] ?? '' }}</textarea>
                                                            </td>
                                                           
                                                            <td>
                                                                <textarea 
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}
                                                                    name="SummaryResponse[{{ $loop->index }}][remarks]"
                                                                    {{ $data->stage == 2 ? 'required' : '' }}>{{ $oogrid['remarks'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                <button class="removeRowBtn"
                                                                    {{ in_array($data->stage, [0,3,4, 1, 5]) ? 'disabled' : '' }}>Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

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
                                                let investdetails = {{ count($oocgrid->data) }};
                                                let isDisabled = @json($data->stage == 1 || $data->stage == 0 || $data->stage == 5);

                                                $('#IncidentAdd').click(function(e) {
                                                    e.preventDefault();

                                                    function generateTableRow(serialNumber) {
                                                        return `
                                                            <tr>
                                                                <td><input disabled type="text" style="width:40px" value="${serialNumber}"></td>
                                                                <td><textarea name="SummaryResponse[${investdetails}][observation]" ${isDisabled ? 'disabled' : ''}></textarea></td>
                                                                 <td>
                                                                    <select name="SummaryResponse[${investdetails}][category]" class="form-select" ${isDisabled ? 'disabled' : ''}>
                                                                        <option value="">--Select--</option>
                                                                        <option value="Major">Major</option>
                                                                        <option value="Minor">Minor</option>
                                                                        <option value="Critical">Critical</option>
                                                                    </select>
                                                                </td>
                                                                <td><textarea name="SummaryResponse[${investdetails}][response]" ${isDisabled ? 'disabled' : ''}></textarea></td>
                                                                <td><textarea name="SummaryResponse[${investdetails}][reference_id]" ${isDisabled ? 'disabled' : ''}></textarea></td>
                                                                <td><textarea name="SummaryResponse[${investdetails}][status]" ${isDisabled ? 'disabled' : ''}></textarea></td>
                                                               
                                                                <td><textarea name="SummaryResponse[${investdetails}][remarks]" ${isDisabled ? 'disabled' : ''}></textarea></td>
                                                                <td><button type="button" class="removeRowBtn" ${isDisabled ? 'disabled' : ''}>Remove</button></td>
                                                            </tr>
                                                        `;
                                                    }

                                                    let tableBody = $('#onservation-incident-table tbody');
                                                    let rowCount = tableBody.children('tr').length;
                                                    let newRow = generateTableRow(rowCount + 1);
                                                    tableBody.append(newRow);
                                                    
                                                    investdetails++; // Increment counter for unique indexes
                                                });

                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();
                                                });
                                            });
                                        </script>


                                        <!-- @php

                                            $assignedUsers = explode(',', $data->reviewer_person_value ?? '');

                                        @endphp
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="reviewer_person_value">CFT review selection</label>
                                                <select id="reviewer_person_value" name="reviewer_person_value[]" multiple
                                                    {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}" {{-- Pass the user's name instead of id --}}
                                                            {{ in_array($user->name, explode(',', $data->reviewer_person_value ?? '')) ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('reviewer_person_value')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="myfile">Summary And Response Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <!-- Update the ID of the file attachment list container -->
                                                    <div class="file-attachment-list" id="myfile-list">
                                                        @if ($data->myfile)
                                                            @foreach (json_decode($data->myfile) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i>
                                                                    </a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}">
                                                                        <i class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i>
                                                                    </a>
                                                                    <input type="hidden" name="existing_myfile[]"
                                                                        value="{{ $file }}">
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <!-- Keep the ID of the input file as 'myfile' -->
                                                        <input type="file" id="myfile" name="myfile[]"
                                                        {{ $data->stage == 1||$data->stage == 3||$data->stage == 4 || $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'myfile-list')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden field to keep track of files to be deleted -->
                                        <input type="hidden" id="deleted_myfile" name="deleted_myfile" value="">

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const removeButtons = document.querySelectorAll('.remove-file');

                                                removeButtons.forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        const fileName = this.getAttribute('data-file-name');
                                                        const fileContainer = this.closest('.file-container');

                                                        // Hide the file container
                                                        if (fileContainer) {
                                                            fileContainer.style.display = 'none';
                                                            // Remove hidden input associated with this file
                                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                            if (hiddenInput) {
                                                                hiddenInput.remove();
                                                            }

                                                            // Add the file name to the deleted files list
                                                            const deletedFilesInput = document.getElementById('deleted_myfile');
                                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                                ',') : [];
                                                            deletedFiles.push(fileName);
                                                            deletedFilesInput.value = deletedFiles.join(',');
                                                        }
                                                    });
                                                });
                                            });

                                            function addMultipleFiles(input, id) {
                                                const fileListContainer = document.getElementById(id);
                                                const files = input.files;

                                                for (let i = 0; i < files.length; i++) {
                                                    const file = files[i];
                                                    const fileName = file.name;
                                                    const fileContainer = document.createElement('h6');
                                                    fileContainer.classList.add('file-container', 'text-dark');
                                                    fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                                    const fileText = document.createElement('b');
                                                    fileText.textContent = fileName;

                                                    const viewLink = document.createElement('a');
                                                    viewLink.href = '#'; // You might need to adjust this to handle local previews
                                                    viewLink.target = '_blank';
                                                    viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                                    const removeLink = document.createElement('a');
                                                    removeLink.classList.add('remove-file');
                                                    removeLink.dataset.fileName = fileName;
                                                    removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                                    removeLink.addEventListener('click', function() {
                                                        fileContainer.style.display = 'none';
                                                    });

                                                    fileContainer.appendChild(fileText);
                                                    fileContainer.appendChild(viewLink);
                                                    fileContainer.appendChild(removeLink);

                                                    fileListContainer.appendChild(fileContainer);
                                                }
                                            }
                                        </script>

                                        <!-- <div class="col-12">
                                                    <div class="group-input">
                                                        <label for="Audit Comments">Audit Comments</label>
                                                        <textarea name="Audit_Comments2" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->Audit_Comments2 }}</textarea>
                                                    </div>
                                                </div> -->
                                        <!-- <div class="col-12">
                                                    <div class="group-input">
                                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                                        <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                    <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                                    </div>
                                                </div> -->
                                    </div>

                                    <h3 style="font-size: 15px; color: #333; margin-bottom: 20px">
                                        <br>
                                            <span style="font-weight: bold; color: red;">Note: </span>
                                            <span>Please fill up both Summary Response Tab and CFT Tab value to save the form.</span>
                                        </h3>
                                    <div class="button-block">

                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                        <button type="button"> <a
                                                href="{{ url('rcms/SummaryResponseReport', $data->id) }}"
                                                class="text-white">
                                                Summary Response Report</a> </button>       
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm7" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">
                                            Production (Tablet/Capsule/Powder)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Production_Table_Review !== 'yes')
                                                    $('.productionTable').hide();

                                                    $('[name="Production_Table_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.productionTable').show();
                                                            $('.productionTable span').show();
                                                        } else {
                                                            $('.productionTable').hide();
                                                            $('.productionTable span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Tablet">Production Tablet/Capsule / Powder Review Comment Required ?  <span class="text-danger">*</span></label>
                                                    <select name="Production_Table_Review" id="Production_Table_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                       
                                                        {{-- <option @if ($data1->Production_Table_Review == 'yes' || empty($data1->Production_Table_Review)) selected @endif value='yes'>Yes</option> --}}
                                                        <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Table_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Production_Table_Review == 'NA' || empty($data1->Production_Table_Review)) selected @endif value='NA'>NA</option>  

                                                        {{-- <option @if ($data1->Production_Table_Review == 'NA') selected @endif
                                                            value='NA'>
                                                            NA</option> --}}
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <!-- <p>USER ROLE COUNT {{ $data->division_id }}</p> -->
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet/Capsule / Powder Person 
                                                        <span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Production_Table_Person" class="Production_Table_Person"
                                                        id="Production_Table_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet assessment">Review comment (By Production Tablet/Capsule / Powder)<span id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 3) required @endif class="summernote Production_Table_Assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet feedback">Production  Feedback
                                                            <span id="asteriskPT2"
                                                                style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Production_Table_Feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif
                                                            name="Production_Table_Feedback" id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet attachment">Production Tablet/Capsule / Powder Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Production_Table_Attachment">
                                                            @if ($data1->Production_Table_Attachment)
                                                                @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed By">Production Tablet/Capsule /  Powder Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Production_Table_By }}"
                                                        name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Table_By">


                                                </div>
                                            </div>

                                            {{-- <div class="col-6 productionTable new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Tablet Completed On">Production Tablet/Capsule / Powder Review Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Production_Table_On" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                <input readonly type="date" name="Production_Table_On"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-M-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Production_Table_On')" />
                                            </div>
                                            @error('Production_Table_On')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                            <div class="col-6 mb-3 productionTable new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Tablet Completed On">Production Tablet/Capsule / Powder Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Table_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                        <input readonly type="date" name="Production_Table_On"
                                                            min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Table_On')" />
                                                    </div>
                                                    @error('Production_Table_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>




                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Production_Table_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Production_Table_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Table_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Table_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Tablet">Production Tablet/Capsule / Powder Review Comment Required ? </label>
                                                    <select name="Production_Table_Review" disabled
                                                        id="Production_Table_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Production_Table_Review == 'yes' || empty($data1->Production_Table_Review)) selected @endif value='yes'>Yes</option>
                                                        <option @if ($data1->Production_Table_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Production_Table_Review == 'NA') selected @endif
                                                            value='NA'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet/Capsule / Powder Person 
                                                        <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                

                                                    <select name="Production_Table_Person" class="Production_Table_Person"
                                                        id="Production_Table_Person" disabled>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet assessment">Review comment (By Production Tablet/Capsule / Powder)                                                            <!-- <span
                                                                                                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionTable">
                                                        <div class="group-input">
                                                            <label for="Production Tablet feedback">Production Tablet FeedbackProduction  Feedback

                                                            </label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet assessment">Review comment (By Production Tablet/Capsule / Powder)
                                                            <!-- <span
                                                                                                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionTable">
                                                        <div class="group-input">
                                                            <label for="Production Tablet feedback">Production Tablet Feedback

                                                            </label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet attachment">Production Tablet/Capsule / Powder Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Production_Table_Attachment">
                                                            @if ($data1->Production_Table_Attachment)
                                                                @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Production_Table_Attachment[]"
                                                                oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed By">Production Tablet/Capsule /  Powder Review Completed By
                                                    </label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Production_Table_By }}"
                                                        name="Production_Table_By" id="Production_Table_By">


                                                </div>
                                            </div>
                                            <div class="col-6 mb-3 productionTable new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Tablet Completed On">Production Tablet/Capsule / Powder Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Table_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                        <input readonly type="date" name="Production_Table_On"
                                                            min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Table_On')" />
                                                    </div>
                                                    @error('Production_Table_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="sub-head">
                                            Production Injection
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Production_Injection_Review !== 'yes')
                                                    $('.productionInjection').hide();

                                                    $('[name="Production_Injection_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.productionInjection').show();
                                                            $('.productionInjection span').show();
                                                        } else {
                                                            $('.productionInjection').hide();
                                                            $('.productionInjection span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Injection">Production Injection Review Comment Required ? 
                                                        <span class="text-danger">*</span></label>
                                                    <select name="Production_Injection_Review"
                                                        id="Production_Injection_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                         
                                                        
                                                        
                                                        <option @if ($data1->Production_Injection_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Injection_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>     
                                                        <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option>  
                                                                 
                                                      
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 53,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection notification">Production Injection
                                                        Person
                                                        <span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Production_Injection_Person"
                                                        class="Production_Injection_Person"
                                                        id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection assessment">Review Comment (By
                                                        Production
                                                        Injection) <span id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 3) required @endif class="summernote Production_Injection_Assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection feedback">Production Table Injection Feedback <span id="asteriskPT2"
                                                                style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Production_Injection_Feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif
                                                            name="Production_Injection_Feedback" id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection attachment">Production Injection
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Production_Injection_Attachment">
                                                            @if ($data1->Production_Injection_Attachment)
                                                                @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Production_Injection_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection Completed By">Production Injection Review  Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Production_Injection_By }}"
                                                        name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Injection_By">


                                                </div>
                                            </div>
                                            <div class="col-6 productionInjection new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Injection Completed On">Production Injection Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Injection_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />
                                                        <input readonly type="date" name="Production_Injection_On"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Injection_On')" />
                                                    </div>
                                                    @error('Production_Injection_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>




                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Production_Injection_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Production_Injection_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Injection">Production Injection Review Comment Required
                                                        ?</label>
                                                    <select name="Production_Injection_Review" disabled
                                                        id="Production_Injection_Review">
                                                        <option value="">-- Select --</option>
                                                        
                                                        <option @if ($data1->Production_Injection_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option> 
                                                            <option @if ($data1->Production_Injection_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>     
                                                        <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option>                                                     </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 53,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection notification">Production Injection
                                                        Person
                                                        <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                  

                                                    <select  disabled
                                                        name="Production_Injection_Person"
                                                        class="Production_Injection_Person"
                                                        id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection assessment">Review Comment (By
                                                            Production Injection)
                                                            <!-- <span
                                                                                                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionInjection">
                                                        <div class="group-input">
                                                            <label for="Production Injection feedback">Production Injection
                                                                Feedback

                                                            </label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection assessment">Review Comment (By
                                                        Production Injection)
                                                            <!-- <span
                                                                                                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionInjection">
                                                        <div class="group-input">
                                                            <label for="Production Injection feedback">Production Injection
                                                                Feedback

                                                            </label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection attachment">Production Injection
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Production_Injection_Attachment">
                                                            @if ($data1->Production_Injection_Attachment)
                                                                @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Production_Injection_Attachment[]"
                                                                oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection Completed By">Production Injection Review Completed By
                                                        </label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Production_Injection_By }}"
                                                        name="Production_Injection_By" id="Production_Injection_By">


                                                </div>
                                            </div>
                                            <div class="col-6 productionInjection new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Injection Completed On">Production Injection Review Completed  On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Injection_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />
                                                        <input readonly type="date" name="Production_Injection_On"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Injection_On')" />
                                                    </div>
                                                    @error('Production_Injection_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif


                                        <div class="sub-head">
                                            Research & Development
                                        </div>
                                        <script>
                                            $(document).ready(function() {

                                                @if ($data1->ResearchDevelopment_Review !== 'yes')
                                                    $('.researchDevelopment').hide();

                                                    $('[name="ResearchDevelopment_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.researchDevelopment').show();
                                                            $('.researchDevelopment span').show();
                                                        } else {
                                                            $('.researchDevelopment').hide();
                                                            $('.researchDevelopment span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Research Development">Research & Development Review  Comment  Required ?
                                                        <span class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_Review"
                                                        id="ResearchDevelopment_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                           
                                                        <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>      
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 55,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research & Development Person
                                                        <span id="asteriskPT"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="ResearchDevelopment_person"
                                                        class="ResearchDevelopment_person"
                                                        id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development assessment">Review Comment (By Research & Development)<span id="asteriskPT1"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3) required @endif class="summernote ResearchDevelopment_assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development feedback">Research Development
                                                            Feedback <span id="asteriskPT2"
                                                                style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote ResearchDevelopment_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif
                                                            name="ResearchDevelopment_feedback" id="summernote-18" @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                    </div>
                                                </div> -->

                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research & Development Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="ResearchDevelopment_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research & Development Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ResearchDevelopment_by">


                                                </div>
                                            </div>

                                            <div class="col-6 researchDevelopment new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ResearchDevelopment_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                        <input readonly type="date" name="ResearchDevelopment_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                    </div>
                                                    @error('ResearchDevelopment_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ResearchDevelopment_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ResearchDevelopment_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Research Development">Research & Development Review  Comment  Required ?</label>
                                                    <select name="ResearchDevelopment_Review" disabled
                                                        id="ResearchDevelopment_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>  
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 55,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research & Development Person
                                                        <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_person" disabled
                                                        id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Review Comment (By Research & Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                                        <div class="group-input">
                                                            <label for="Research Development feedback">Research Development
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Review Comment (By Research & Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                                        <div class="group-input">
                                                            <label for="Research Development feedback">Research Development
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research & Development Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="ResearchDevelopment_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research & Development Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by" id="StorResearchDevelopment_by">


                                                </div>
                                            </div>
                                            <div class="col-6 researchDevelopment new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ResearchDevelopment_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                        <input readonly type="date" name="ResearchDevelopment_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                    </div>
                                                    @error('ResearchDevelopment_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Human Resource
                                        </div>
                                        <script>
                                            $(document).ready(function() {

                                                @if ($data1->Human_Resource_review !== 'yes')
                                                    $('.Human_Resource').hide();

                                                    $('[name="Human_Resource_review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.Human_Resource').show();
                                                            $('.Human_Resource span').show();
                                                        } else {
                                                            $('.Human_Resource').hide();
                                                            $('.Human_Resource span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Human Resource">Human Resource Review Comment Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Human_Resource_review" id="Human_Resource_review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                       
                                                        <option @if ($data1->Human_Resource_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>    
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 31,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span
                                                            id="asteriskPT"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Human_Resource_person" class="Human_Resource_person"
                                                        id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource assessment">Review Comment (By Human
                                                        Resource)
                                                        <span id="asteriskPT1"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 3) required @endif class="summernote Human_Resource_assessment"
                                                        @if ($data->stage == 2 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource feedback">Human Resource Feedback <span
                                                                id="asteriskPT2"
                                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Human_Resource_feedback" @if ($data->stage == 2 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif
                                                            name="Human_Resource_feedback" id="summernote-18" @if ($data1->Human_Resource_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Human_Resource_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Human_Resource_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Human_Resource_by">


                                                </div>
                                            </div>

                                            <div class="col-lg-6 Human_Resource new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Human Resource Completed On">Human Resource Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Human_Resource_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                        <input readonly type="date" name="Human_Resource_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                    </div>
                                                    @error('Human_Resource_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Human_Resource_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Human Resource">Human Resource Review Comment Required ?</label>
                                                    <select name="Human_Resource_review" disabled
                                                        id="Human_Resource_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>  
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 31,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Human_Resource_person" disabled
                                                        id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Review Comment (By Human
                                                            Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                        <div class="group-input">
                                                            <label for="Human Resource feedback">Human Resource
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Review Comment (By Human
                                                            Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                        <div class="group-input">
                                                            <label for="Human Resource feedback">Human Resource
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Human_Resource_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by" id="Human_Resource_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Human_Resource new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Human Resource Completed On">Human Resource Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Human_Resource_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                        <input readonly type="date" name="Human_Resource_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                    </div>
                                                    @error('Human_Resource_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif





                                        <div class="sub-head">
                                            Corporate Quality Assurance
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->CorporateQualityAssurance_Review !== 'yes')
                                                    $('.CQA').hide();

                                                    $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.CQA').show();
                                                            $('.CQA span').show();
                                                        } else {
                                                            $('.CQA').hide();
                                                            $('.CQA span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance"> Corporate Quality Assurance  Review Comment Required ? <span class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_Review"
                                                        id="CorporateQualityAssurance_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate
                                                        Quality
                                                        Assurance Person <span id="asteriskPT"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="CorporateQualityAssurance_person"
                                                        class="CorporateQualityAssurance_person"
                                                        id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance assessment">Review Comment
                                                        (By
                                                        Corporate Quality
                                                        Assurance) <span id="asteriskPT1"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3) required @endif
                                                        class="summernote CorporateQualityAssurance_assessment" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->CorporateQualityAssurance_person) &&
                                                                    Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                        name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance feedback">Corporate Quality
                                                            Assurance
                                                            Feedback <span id="asteriskPT2"
                                                                style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote CorporateQualityAssurance_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->CorporateQualityAssurance_person) &&
                                                                    Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                            name="CorporateQualityAssurance_feedback" id="summernote-18"
                                                            @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality
                                                        Assurance
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="CorporateQualityAssurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate
                                                        Quality
                                                        Assurance Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 CQA">
                                        <div class="group-input ">
                                            <label for="Corporate Quality Assurance Completed On">Corporate Quality
                                                Assurance Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="CorporateQualityAssurance_on"
                                                name="CorporateQualityAssurance_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->CorporateQualityAssurance_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 CQA new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Corporate Quality Assurance Completed On">Corporate
                                                        Quality
                                                        Assurance Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="CorporateQualityAssurance_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                                        <input readonly type="date"
                                                            name="CorporateQualityAssurance_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                                    </div>
                                                    @error('CorporateQualityAssurance_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('CorporateQualityAssurance_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('CorporateQualityAssurance_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance">Corporate Quality Assurance  Review Comment Required ?</label>
                                                    <select name="CorporateQualityAssurance_Review" disabled
                                                        id="CorporateQualityAssurance_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate
                                                        Quality
                                                        Assurance Person <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_person" disabled
                                                        id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Impact
                                                            Assessment (By
                                                            Corporate
                                                            Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 CQA">
                                                        <div class="group-input">
                                                            <label for="Corporate Quality Assurance feedback">Corporate
                                                                Quality
                                                                Assurance
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Review Comment (By
                                                            Corporate
                                                            Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 CQA">
                                                        <div class="group-input">
                                                            <label for="Corporate Quality Assurance feedback">Corporate
                                                                Quality
                                                                Assurance
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality
                                                        Assurance
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate
                                                        Quality
                                                        Assurance Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by"
                                                        id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 CQA new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Corporate Quality Assurance Completed On">Corporate
                                                        Quality
                                                        Assurance Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="CorporateQualityAssurance_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                                        <input readonly type="date"
                                                            name="CorporateQualityAssurance_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                                    </div>
                                                    @error('CorporateQualityAssurance_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Stores
                                        </div>
                                        <script>
                                            $(document).ready(function() {

                                                @if ($data1->Store_Review !== 'yes')
                                                    $('.store').hide();

                                                    $('[name="Store_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.store').show();
                                                            $('.store span').show();
                                                        } else {
                                                            $('.store').hide();
                                                            $('.store span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Store">Store Review Comment  Required ?  <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Store_Review" id="Store_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Store_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 54,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Store_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Store_person" class="Store_person" id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store assessment">Review Comment (By Store) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Store_Review == 'yes' && $data->stage == 3) required @endif class="summernote Store_assessment"
                                                        @if ($data->stage == 2 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="store feedback">store Feedback <span id="asteriskPT2"
                                                                style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Store_feedback" @if ($data->stage == 2 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif
                                                            name="Store_feedback" id="summernote-18" @if ($data1->Store_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Store_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Store_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Store_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Store_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 store">
                                        <div class="group-input ">
                                            <label for="Store Completed On">Store Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Store_on"
                                                name="Store_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Store_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 store new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Store Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Store_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                        <input readonly type="date" name="Store_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Store_on')" />
                                                    </div>
                                                    @error('Store_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Store_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Store_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Store">Store Review Comment  Required ? </label>
                                                    <select name="Store_Review" disabled id="Store_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Store_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 54,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Store_person" disabled id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Review Comment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 store">
                                                        <div class="group-input">
                                                            <label for="Store feedback">Store Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Review Comment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 store">
                                                        <div class="group-input">
                                                            <label for="Store feedback">Store Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Store_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by" id="Store_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 store">
                                        <div class="group-input">
                                            <label for="Store Completed On">Store Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date" id="Store_on" name="Store_on"
                                                value="{{ $data1->Store_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 store new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Store Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Store_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                        <input readonly type="date" name="Store_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Store_on')" />
                                                    </div>
                                                    @error('Store_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="sub-head">
                                            Engineering
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Engineering_review !== 'yes')
                                                    $('.Engineering').hide();

                                                    $('[name="Engineering_review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.Engineering').show();
                                                            $('.Engineering span').show();
                                                        } else {
                                                            $('.Engineering').hide();
                                                            $('.Engineering span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Engineering"> Engineering Review Comment Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Engineering_review" id="Engineering_review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Engineering_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 25,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span
                                                            id="asteriskPT"
                                                            style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Engineering_person" class="Engineering_person"
                                                        id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering assessment">Review Comment (By Engineering)
                                                        <span id="asteriskPT1"
                                                            style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 3) required @endif class="summernote Engineering_assessment"
                                                        @if ($data->stage == 2 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering feedback">Engineering Feedback <span
                                                                id="asteriskPT2"
                                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Engineering_feedback" @if ($data->stage == 2 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif
                                                            name="Engineering_feedback" id="summernote-18" @if ($data1->Engineering_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Engineering_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Engineering_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Engineering_by }}"
                                                        name="Engineering_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Engineering_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 Engineering">
                                        <div class="group-input ">
                                            <label for="Engineering Completed On">Engineering Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Engineering_on"
                                                name="Engineering_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Engineering_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 Engineering new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Engineering Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Engineering_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                        <input readonly type="date" name="Engineering_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Engineering_on')" />
                                                    </div>
                                                    @error('Engineering_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Engineering_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Engineering">Engineering Review Comment Required ?</label>
                                                    <select name="Engineering_review" disabled id="Engineering_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Engineering_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 25,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Engineering_person" disabled id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Review Comment (By
                                                            Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Engineering">
                                                        <div class="group-input">
                                                            <label for="Engineering feedback">Engineering Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Review Comment (By
                                                            Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Engineering">
                                                        <div class="group-input">
                                                            <label for="Engineering feedback">Engineering Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Engineering_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Engineering_by }}" name="Engineering_by"
                                                        id="Engineering_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Engineering new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Engineering Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Engineering_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                        <input readonly type="date" name="Engineering_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Engineering_on')" />
                                                    </div>
                                                    @error('Engineering_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="sub-head">
                                            Regulatory Affair
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->RegulatoryAffair_Review !== 'yes')
                                                    $('.RegulatoryAffair').hide();

                                                    $('[name="RegulatoryAffair_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.RegulatoryAffair').show();
                                                            $('.RegulatoryAffair span').show();
                                                        } else {
                                                            $('.RegulatoryAffair').hide();
                                                            $('.RegulatoryAffair span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RegulatoryAffair"> Regulatory Affair Review Comment Required ?<span
                                                            class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 57,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person
                                                        <span id="asteriskPT"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="RegulatoryAffair_person" class="RegulatoryAffair_person"
                                                        id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair assessment">Review Comment (By
                                                        Regulatory
                                                        Affair) <span id="asteriskPT1"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3) required @endif class="summernote RegulatoryAffair_assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback
                                                            <span id="asteriskPT2"
                                                                style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote RegulatoryAffair_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif
                                                            name="RegulatoryAffair_feedback" id="summernote-18" @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="RegulatoryAffair_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Review
                                                        Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 RegulatoryAffair">
                                        <div class="group-input ">
                                            <label for="Regulatory Affair Completed On">Regulatory Affair Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="RegulatoryAffair_on"
                                                name="RegulatoryAffair_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->RegulatoryAffair_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Regulatory Affair Completed On">Regulatory Affair Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="RegulatoryAffair_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                                        <input readonly type="date" name="RegulatoryAffair_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                                    </div>
                                                    @error('RegulatoryAffair_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('RegulatoryAffair_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('RegulatoryAffair_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair">Regulatory Affair Review Comment Required ?</label>
                                                    <select name="RegulatoryAffair_Review" disabled
                                                        id="RegulatoryAffair_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 57,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person
                                                        <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_person" disabled
                                                        id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Review Comment (By
                                                            Regulatory
                                                            Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                        <div class="group-input">
                                                            <label for="Regulatory Affair feedback">Regulatory Affair
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Review Comment (By
                                                            Regulatory
                                                            Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                        <div class="group-input">
                                                            <label for="Regulatory Affair feedback">Regulatory Affair
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="RegulatoryAffair_attachment[]"
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Review
                                                        Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by" id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Regulatory Affair Completed On">Regulatory Affair Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="RegulatoryAffair_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                                        <input readonly type="date" name="RegulatoryAffair_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                                    </div>
                                                    @error('RegulatoryAffair_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif









                                        <div class="sub-head">
                                            Quality Assurance
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Quality_Assurance_Review !== 'yes')

                                                    $('.quality_assurance').hide();

                                                    $('[name="Quality_Assurance_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {
                                                            $('.quality_assurance').show();
                                                            $('.quality_assurance span').show();
                                                        } else {
                                                            $('.quality_assurance').hide();
                                                            $('.quality_assurance span').hide();
                                                        }
                                                    });
                                                @endif

                                            });
                                        </script>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quality Assurance Review Required">Quality Assurance Review Comment Required ?
                                                    <span class="text-danger">*</span></label>
                                                <select @if ($data->stage == 3) required @endif
                                                    name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif
                                                        value="yes">
                                                        Yes</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                            <option @if ($data1->Quality_Assurance_Review == 'NA' || empty($data1->Quality_Assurance_Review)) selected @endif value='NA'>NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 26,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 quality_assurance">
                                            <div class="group-input">
                                                <label for="Quality Assurance Person">Quality Assurance Person <span
                                                        id="asteriskQQA"
                                                        style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <select name="QualityAssurance_person" class="QualityAssurance_person"
                                                    id="QualityAssurance_person"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option
                                                            {{ $data1->QualityAssurance_person == $user->name ? 'selected' : '' }}
                                                            value="{{ $user->name }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 quality_assurance">
                                            <div class="group-input">
                                                <label for="Impact Assessment3">Review Comment (By Quality Assurance)
                                                    <span id="asteriskQQA1"
                                                        style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it does
                                                        not require completion</small></div>
                                                <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 3) required @endif class="summernote QualityAssurance_assessment"
                                                    name="QualityAssurance_assessment" @if ($data->stage == 2 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 mb-3 quality_assurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                            id="asteriskQQA2"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if
                                                            it does
                                                            not require completion</small></div>
                                                    <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 3) required @endif class="summernote QualityAssurance_feedback"
                                                        name="QualityAssurance_feedback" @if ($data->stage == 2 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div> -->

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Quality_Assurance_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskQQA');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                        <div class="col-12 quality_assurance">
                                            <div class="group-input">
                                                <label for="Quality Assurance Attachments">Quality Assurance
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Quality_Assurance_attachment">
                                                        @if ($data1->Quality_Assurance_attachment)
                                                            @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Quality_Assurance_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 quality_assurance">
                                            <div class="group-input">
                                                <label for="Quality Assurance Review Completed By">Quality Assurance
                                                    Review
                                                    Completed By</label>
                                                <input type="text" name="QualityAssurance_by"
                                                    id="QualityAssurance_by" value="{{ $data1->QualityAssurance_by }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Quality Assurance Review Completed On">Quality Assurance
                                                    Review
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="QualityAssurance_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                                    <input type="date" name="QualityAssurance_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-M-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                                </div>
                                                @error('QualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="sub-head">
                                            Production (Liquid/Ointment)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->ProductionLiquid_Review !== 'yes')
                                                    $('.productionLiquid').hide();

                                                    $('[name="ProductionLiquid_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.productionLiquid').show();
                                                            $('.productionLiquid span').show();
                                                        } else {
                                                            $('.productionLiquid').hide();
                                                            $('.productionLiquid span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Liquid">Production Liquid/ointment Review Comment Required ?
                                                        <span class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_Review" id="ProductionLiquid_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                       
                                                        <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 52,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid/ointment
                                                        Person
                                                        <span id="asteriskPT"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="ProductionLiquid_person" class="ProductionLiquid_person"
                                                        id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid assessment">Review Comment (By
                                                        Production Liquid/ointment) <span id="asteriskPT1"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 3) required @endif class="summernote ProductionLiquid_assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid feedback">Production Liquid/ointment Feedback
                                                            <span id="asteriskPT2"
                                                                style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote ProductionLiquid_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif
                                                            name="ProductionLiquid_feedback" id="summernote-18" @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid/ointment
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="ProductionLiquid_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid Completed By">Production Liquid/ointment Review
                                                        Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->ProductionLiquid_by }}"
                                                        name="ProductionLiquid_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ProductionLiquid_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 productionLiquid">
                                        <div class="group-input ">
                                            <label for="Production Liquid Completed On">Production Liquid Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="ProductionLiquid_on"
                                                name="ProductionLiquid_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->ProductionLiquid_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 productionLiquid new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Liquid Completed On">Production Liquid/ointment Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ProductionLiquid_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                        <input readonly type="date" name="ProductionLiquid_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                    </div>
                                                    @error('ProductionLiquid_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ProductionLiquid_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ProductionLiquid_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Liquid">Production Liquid/ointment Review Comment Required ?</label>
                                                    <select name="ProductionLiquid_Review" disabled
                                                        id="ProductionLiquid_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 52,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid/ointment Person 
                                                        <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_person" disabled
                                                        id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Review Comment (By Production Liquid/ointment)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionLiquid">
                                                        <div class="group-input">
                                                            <label for="Production Liquid feedback">Production Liquid
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Review Comment (By Production Liquid/ointment)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionLiquid">
                                                        <div class="group-input">
                                                            <label for="Production Liquid feedback">Production Liquid
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid/ointment Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="ProductionLiquid_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid Completed By">Production Liquid/ointment Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->ProductionLiquid_by }}"
                                                        name="ProductionLiquid_by" id="ProductionLiquid_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionLiquid new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Liquid Completed On">Production Liquid/ointment Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ProductionLiquid_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                        <input readonly type="date" name="ProductionLiquid_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                    </div>
                                                    @error('ProductionLiquid_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif


                                        <div class="sub-head">
                                            Quality Control
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Quality_review !== 'yes')

                                                    $('.qualityControl').hide();

                                                    $('[name="Quality_review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.qualityControl').show();
                                                            $('.qualityControl span').show();
                                                        } else {
                                                            $('.qualityControl').hide();
                                                            $('.qualityControl span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Control"> Quality Control Review Comment Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_review" id="Quality_review_Review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Quality_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 24,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span
                                                            id="asteriskPT"
                                                            style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Quality_Control_Person" class="Quality_Control_Person"
                                                        id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control assessment">Review Comment (By Quality
                                                        Control)
                                                        <span id="asteriskPT1"
                                                            style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 3) required @endif class="summernote Quality_Control_assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control feedback">Quality Control Feedback <span
                                                                id="asteriskPT2"
                                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Quality_Control_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif
                                                            name="Quality_Control_feedback" id="summernote-18" @if ($data1->Quality_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Quality_Control_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Quality_Control_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Quality_Control_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 qualityControl">
                                        <div class="group-input ">
                                            <label for="Quality Control Completed On">Quality Control Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Quality_Control_on"
                                                name="Quality_Control_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Quality_Control_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 qualityControl new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Quality Control Completed On">Quality Control Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Quality_Control_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                                        <input readonly type="date" name="Quality_Control_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Quality_Control_on')" />
                                                    </div>
                                                    @error('Quality_Control_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Quality_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Control">Quality Control Review Comment Required ?</label>
                                                    <select name="Quality_review" disabled id="Quality_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Quality_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 24,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_Control_Person" disabled
                                                        id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Review Comment (By
                                                            Quality
                                                            Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 qualityControl">
                                                        <div class="group-input">
                                                            <label for="Quality Control feedback">Quality Control
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Review Comment (By
                                                            Quality
                                                            Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 qualityControl">
                                                        <div class="group-input">
                                                            <label for="Quality Control feedback">Quality Control
                                                                Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control
                                                        Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Review Completed By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by" id="Quality_Control_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 qualityControl new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Quality Control Completed On">Quality Control Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Quality_Control_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                                        <input readonly type="date" name="Quality_Control_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Quality_Control_on')" />
                                                    </div>
                                                    @error('Quality_Control_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="sub-head">
                                            Microbiology
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Microbiology_Review !== 'yes')
                                                    $('.Microbiology').hide();

                                                    $('[name="Microbiology_Review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.Microbiology').show();
                                                            $('.Microbiology span').show();
                                                        } else {
                                                            $('.Microbiology').hide();
                                                            $('.Microbiology span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology"> Microbiology Review Comment Required ?  <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Microbiology_Review" id="Microbiology_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Microbiology_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 56,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span
                                                            id="asteriskPT"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Microbiology_person" class="Microbiology_person"
                                                        id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology assessment">Review Comment (By
                                                        Microbiology) <span id="asteriskPT1"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Microbiology_Review == 'yes' && $data->stage == 3) required @endif class="summernote Microbiology_assessment"
                                                        @if ($data->stage == 2 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology feedback">Microbiology Feedback <span
                                                                id="asteriskPT2"
                                                                style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Microbiology_feedback" @if ($data->stage == 2 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif
                                                            name="Microbiology_feedback" id="summernote-18" @if ($data1->Microbiology_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Microbiology_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Microbiology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Microbiology_by }}"
                                                        name="Microbiology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Microbiology_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 Microbiology">
                                        <div class="group-input ">
                                            <label for="Microbiology Completed On">Microbiology Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Microbiology_on"
                                                name="Microbiology_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Microbiology_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 Microbiology new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Microbiology Completed On">Microbiology Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Microbiology_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                                        <input readonly type="date" name="Microbiology_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Microbiology_on')" />
                                                    </div>
                                                    @error('Microbiology_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Microbiology_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Microbiology_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology">Microbiology Review Comment  Required ? </label>
                                                    <select name="Microbiology_Review" disabled
                                                        id="Microbiology_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Microbiology_Review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 56,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Microbiology_person" disabled
                                                        id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Review Comment (By
                                                            Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Microbiology">
                                                        <div class="group-input">
                                                            <label for="Microbiology feedback">Microbiology Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Review Comment (By
                                                            Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Microbiology">
                                                        <div class="group-input">
                                                            <label for="Microbiology feedback">Microbiology Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Microbiology_by }}" name="Microbiology_by"
                                                        id="Microbiology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Microbiology new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Microbiology Completed On">Microbiology Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Microbiology_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                                        <input readonly type="date" name="Microbiology_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Microbiology_on')" />
                                                    </div>
                                                    @error('Microbiology_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Safety
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if ($data1->Environment_Health_review !== 'yes')
                                                    $('.safety').hide();

                                                    $('[name="Environment_Health_review"]').change(function() {
                                                        if ($(this).val() === 'yes') {

                                                            $('.safety').show();
                                                            $('.safety span').show();
                                                        } else {
                                                            $('.safety').hide();
                                                            $('.safety span').hide();
                                                        }
                                                    });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('external_audit_c_f_t_s')
                                                ->where('external_audit_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 2 || $data->stage == 3)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Safety"> Safety Review Comment Required ?<span
                                                            class="text-danger">*</span></label>
                                                    <select name="Environment_Health_review"
                                                        id="Environment_Health_review"
                                                        @if ($data->stage == 3) disabled @endif>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 3) disabled @endif
                                                        name="Environment_Health_Safety_person"
                                                        class="Environment_Health_Safety_person"
                                                        id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety assessment">Review Comment (By Safety) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field
                                                            if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 3) required @endif class="summernote Health_Safety_assessment"
                                                        @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Environment_Health_Safety_person) &&
                                                                    Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety feedback">Safety Feedback <span id="asteriskPT2"
                                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote Health_Safety_feedback" @if (
                                                            $data->stage == 2 ||
                                                                (isset($data1->Environment_Health_Safety_person) &&
                                                                    Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif
                                                            name="Health_Safety_feedback" id="summernote-18" @if ($data1->Environment_Health_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Environment_Health_Safety_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 safety">
                                        <div class="group-input ">
                                            <label for="Safety Completed On">Safety Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Environment_Health_Safety_on"
                                                name="Environment_Health_Safety_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Environment_Health_Safety_on }}">
                                        </div>
                                    </div> --}}
                                            <div class="col-lg-6 safety new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Safety Completed On">Safety Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Environment_Health_Safety_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                                        <input readonly type="date"
                                                            name="Environment_Health_Safety_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                                    </div>
                                                    @error('Environment_Health_Safety_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Environment_Health_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Safety">Safety Review Comment Required ?</label>
                                                    <select name="Environment_Health_review" disabled
                                                        id="Environment_Health_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif
                                                            value='yes'>
                                                            Yes</option>
                                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif
                                                            value='no'>
                                                            No</option>
                                                        <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span
                                                            id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="Environment_Health_Safety_person" disabled
                                                        id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}"
                                                                @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 3)
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Review Comment (By
                                                            Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 safety">
                                                        <div class="group-input">
                                                            <label for="Safety feedback">Safety Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Review Comment (By
                                                            Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data
                                                                field if
                                                                it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 safety">
                                                        <div class="group-input">
                                                            <label for="Safety feedback">Safety Feedback</label>
                                                            <div><small class="text-primary">Please insert "NA" in the data
                                                                    field if
                                                                    it
                                                                    does not require completion</small></div>
                                                            <textarea disabled class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                        </div>
                                                    </div> -->
                                            @endif
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list"
                                                            id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file"
                                                                            data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark"
                                                                                style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile"
                                                                name="Environment_Health_Safety_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Review Completed
                                                        By</label>
                                                    <input readonly type="text"
                                                        value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by"
                                                        id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 safety new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Safety Completed On">Safety Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Environment_Health_Safety_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                                        <input readonly type="date"
                                                            name="Environment_Health_Safety_on"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                                    </div>
                                                    @error('Environment_Health_Safety_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif





                                        <!-- HTML Section -->
                                    <!-- <div class="sub-head">
                                                Contract Giver
                                            </div>

                                            @php
                                                $data1 = DB::table('external_audit_c_f_t_s')
                                                    ->where('external_audit_id', $data->id)
                                                    ->first();
                                            @endphp

                                            @if ($data1->ContractGiver_Review !== 'yes')
    <script>
        $(document).ready(function() {

            if ($('[name="ContractGiver_Review"]').val() === 'yes') {
                $('.ContractGiver').show();
                $('.ContractGiver span').show();
            } else {
                $('.ContractGiver').hide();
                $('.ContractGiver span').hide();
            }


            $('[name="ContractGiver_Review"]').change(function() {
                if ($(this).val() === 'yes') {
                    $('.ContractGiver').show();
                    $('.ContractGiver span').show();
                } else {
                    $('.ContractGiver').hide();
                    $('.ContractGiver span').hide();
                }
            });
        });
    </script>
    @endif

                                            @if ($data->stage == 2 || $data->stage == 3)
                                                <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Contract Giver">Contract Required ? <span
                                                                class="text-danger">*</span></label>
                                                        <select name="ContractGiver_Review" id="ContractGiver_Review">
                                                            <option value="">-- Select --</option>
                                                            <option @if ($data1->ContractGiver_Review == 'yes') selected @endif
                                                                value='yes'>Yes</option>
                                                            <option @if ($data1->ContractGiver_Review == 'no') selected @endif
                                                                value='no'>No</option>
                                                            <option @if ($data1->ContractGiver_Review == 'na') selected @endif
                                                                value='na'>NA</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                @php
                                                    $userRoles = DB::table('user_roles')
                                                        ->where([
                                                            'q_m_s_roles_id' => 60,
                                                            'q_m_s_divisions_id' => $data->division_id,
                                                        ])
                                                        ->get();
                                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                                @endphp

                                                <div class="col-lg-6 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver notification">Contract Giver Person <span
                                                                id="asteriskPT" class="text-danger">*</span></label>
                                                        <select @if ($data->stage == 3) disabled @endif
                                                            name="ContractGiver_person" id="ContractGiver_person">
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $user)
    <option value="{{ $user->name }}"
                                                                    @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                                    {{ $user->name }}</option>
    @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract
                                                            Giver)
                                                            <span id="asteriskPT1" class="text-danger"
                                                                style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"></span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 3) required @endif class="summernote ContractGiver_assessment"
                                                            @if ($data->stage == 2 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>



                                                <div class="col-12 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver attachment">Contract Giver
                                                            Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or
                                                                supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div class="file-attachment-list" id="ContractGiver_attachment">
                                                                @if ($data1->ContractGiver_attachment)
    @foreach (json_decode($data1->ContractGiver_attachment) as $file)
    <h6 type="button" class="file-container text-dark"
                                                                            style="background-color: rgb(243, 242, 240);">
                                                                            <b>{{ $file }}</b>
                                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                                target="_blank"><i
                                                                                    class="fa fa-eye text-primary"
                                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a type="button" class="remove-file"
                                                                                data-file-name="{{ $file }}"><i
                                                                                    class="fa-solid fa-circle-xmark"
                                                                                    style="color:red; font-size:20px;"></i></a>
                                                                        </h6>
    @endforeach
    @endif
                                                            </div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                    type="file" id="myfile"
                                                                    name="ContractGiver_attachment[]"
                                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')"
                                                                    multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver Completed By">Contract Giver Completed
                                                            By</label>
                                                        <input readonly type="text"
                                                            value="{{ $data1->ContractGiver_by }}" name="ContractGiver_by"
                                                            id="ContractGiver_by">
                                                    </div>
                                                </div>


                                                <div class="col-6 ContractGiver new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <label for="Contract Giver Completed On">Contract Giver
                                                            Completed On</label>
                                                        <div class="calenderauditee">
                                                            <input type="text" id="ContractGiver_on" readonly
                                                                placeholder="DD-MMM-YYYY"
                                                                value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                                            <input readonly type="date" name="ContractGiver_on"
                                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                value="" class="hide-input"
                                                                oninput="handleDateInput(this, 'ContractGiver_on')" />
                                                        </div>
                                                        @error('ContractGiver_on')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                    </div>
                                                </div>
@else
    <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Contract Giver">Contract Giver Required ?</label>
                                                        <select name="ContractGiver_Review" disabled
                                                            id="ContractGiver_Review">
                                                            <option value="">-- Select --</option>
                                                            <option @if ($data1->ContractGiver_Review == 'yes') selected @endif
                                                                value='yes'>Yes</option>
                                                            <option @if ($data1->ContractGiver_Review == 'no') selected @endif
                                                                value='no'>No</option>
                                                            <option @if ($data1->ContractGiver_Review == 'na') selected @endif
                                                                value='na'>NA</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                @php
                                                    $userRoles = DB::table('user_roles')
                                                        ->where([
                                                            'q_m_s_roles_id' => 60,
                                                            'q_m_s_divisions_id' => $data->division_id,
                                                        ])
                                                        ->get();
                                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                                @endphp

                                                <div class="col-lg-6 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver notification">Contract Giver Person <span
                                                                id="asteriskInvi11" style="display: none"
                                                                class="text-danger">*</span></label>
                                                        <select @if ($data->stage == 3) disabled @endif
                                                            name="ContractGiver_person" id="ContractGiver_person">
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $user)
    <option value="{{ $user->name }}"
                                                                    @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                                    {{ $user->name }}</option>
    @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract
                                                            Giver)
                                                            <span id="asteriskPT1" style="display: none"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote ContractGiver_assessment" @if ($data->stage == 2 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                                            name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver feedback">Contract Giver Feedback <span
                                                                id="asteriskPT2" style="display: none"
                                                                class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field
                                                                if it
                                                                does not require completion</small></div>
                                                        <textarea class="summernote ContractGiver_feedback" @if ($data->stage == 2 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                                            name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver attachment">Contract Giver
                                                            Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or
                                                                supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div class="file-attachment-list" id="ContractGiver_attachment">
                                                                @if ($data1->ContractGiver_attachment)
    @foreach (json_decode($data1->ContractGiver_attachment) as $file)
    <h6 type="button" class="file-container text-dark"
                                                                            style="background-color: rgb(243, 242, 240);">
                                                                            <b>{{ $file }}</b>
                                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                                target="_blank"><i
                                                                                    class="fa fa-eye text-primary"
                                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a type="button" class="remove-file"
                                                                                data-file-name="{{ $file }}"><i
                                                                                    class="fa-solid fa-circle-xmark"
                                                                                    style="color:red; font-size:20px;"></i></a>
                                                                        </h6>
    @endforeach
    @endif                      
                                                            </div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                    type="file" id="myfile"
                                                                    name="ContractGiver_attachment[]"
                                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')"
                                                                    multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver Completed By">Contract Giver Completed
                                                            By</label>
                                                        <input readonly type="text"
                                                            value="{{ $data1->ContractGiver_by }}" name="ContractGiver_by"
                                                            id="ContractGiver_by">
                                                    </div>
                                                </div>

                                                <div class="col-6 ContractGiver new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <label for="Contract Giver Completed On">Contract Giver
                                                            Completed On</label>
                                                        <div class="calenderauditee">
                                                            <input type="text" id="ContractGiver_on" readonly
                                                                placeholder="DD-MMM-YYYY"
                                                                value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                                            <input readonly type="date" name="ContractGiver_on"
                                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                value="" class="hide-input"
                                                                oninput="handleDateInput(this, 'ContractGiver_on')" />
                                                        </div>
                                                        @error('ContractGiver_on')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                    </div>
                                                </div>
                                            @endif -->


                                       





                                <div class="sub-head">
                                    Other's 1 (Additional Person Review From Departments If Required)
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1">Other's 1 Review Comment Required ?</label>
                                        <select name="Other1_review" id="Other1_review"  @if ($data->stage != 2) disabled @endif >
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                           
                                            <option @if ($data1->Other1_review == 'NA' || empty($data1->Other1_review)) selected @endif value='NA'>NA</option>
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 other1_reviews">
                                    <div class="group-input">
                                        <label for="Person1">Other's 1 Person
                                            <span id="asterisko1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>
                                        <select name="Other1_person" id="Other1_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other1_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                    @endif
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Department1">Other's 1 Department
                                            <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>
                                        <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                    @endif
                                    </div>
                                </div> -->

                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Department1">Other's 1 Department
                                            <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="Other1_Department_person" id="Other1_Department_person"
                                            value="{{ old('Other1_Department_person', $data1->Other1_Department_person ?: '') }}"
                                            @if ($data->stage != 2) readonly @endif>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Review comment (By Other's 1)</label>
                                        <textarea class="tiny" name="Other1_assessment" id="summernote-41" @if ($data->stage != 3 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>


                                

                                <!-- <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Feedback1">Other's 1 Feedback</label>
                                        <textarea class="tiny" name="Other1_feedback" id="summernote-42" @if ($data->stage != 4 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div> -->



                                <div class="col-12 other1_reviews ">
                                        <div class="group-input">
                                            <label for="Audit Attachments">Other's 1 Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Other1_attachment">
                                                    @if ($data1->Other1_attachment)
                                                        @foreach (json_decode($data1->Other1_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="Other1_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <div class="col-md-6 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" id="Other1_by" value="{{ $data1->Other1_by }}" disabled>
                                    </div>
                                </div>
                                <div class="col-6 other1_reviews new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Others 1 Completed On">Others 1 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other1_on" readonly placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Other1_on) }}" />
                                            <input readonly type="date" name="Other1_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other1_on')" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Add your script to handle the show/hide functionality -->
                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on the selected value
                                        function toggleFieldsBasedOnSelection(value) {
                                            if (value === 'yes') {
                                                $('.other1_reviews').show(); // Show all fields
                                                $('.other1_reviews span').show(); // Show asterisks
                                                $('input[name="Other1_person"]').prop('required', true);
                                                $('select[name="Other1_Department_person"]').prop('required', true);
                                                $('#asterisko1').show();
                                                $('#asteriskod1').show();
                                            } else {
                                                $('.other1_reviews').hide(); // Hide all fields
                                                $('.other1_reviews span').hide(); // Hide asterisks
                                                $('input[name="Other1_person"]').prop('required', false);
                                                $('select[name="Other1_Department_person"]').prop('required', false);
                                                $('#asterisko1').hide();
                                                $('#asteriskod1').hide();
                                            }
                                        }

                                        // On page load
                                        toggleFieldsBasedOnSelection($('[name="Other1_review"]').val());

                                        // On dropdown value change
                                        $('[name="Other1_review"]').change(function () {
                                            toggleFieldsBasedOnSelection($(this).val());
                                        });
                                    });
                                </script>
{{--
                            @else
                                <div class="sub-head">
                                    Other's 1 (Additional Person Review From Departments If Required)
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1">Other's 1 Review Comment Required ?</label>
                                        <select disabled name="Other1_review" id="Other1_review">
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                          
                                            <option @if ($data1->Other1_review == 'NA' || empty($data1->Other1_review)) selected @endif value='NA'>NA</option>
                                        
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-12 Other1_reviews">
                                    <div class="group-input">
                                        <label for="Department1">Other's 1 Department
                                            <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>
                                        <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Review comment (By Other's 1)</label>
                                        <textarea disabled class="tiny" name="Other1_assessment" id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>


                                
                                <!-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback1">Other's 1 Feedback</label>
                                        <textarea disabled class="tiny" name="Other1_feedback" id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div> -->




                                <div class="col-12 other1_reviews ">
                                        <div class="group-input">
                                            <label for="Audit Attachments">Other's 1 Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Other1_attachment">
                                                    @if ($data1->Other1_attachment)
                                                        @foreach (json_decode($data1->Other1_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="Other1_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}" name="Other1_by" id="Other1_by">
                                    </div>
                                </div>


                            @endif --}}
                            <div class="sub-head">
                                Other's 2 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleFieldsBasedOnSelection(value) {
                                        if (value === 'yes') {
                                            $('.Other2_reviews').show();
                                            $('.Other2_reviews span').show();
                                            $('input[name="Other2_person"]').prop('required', true);
                                            $('select[name="Other2_Department_person"]').prop('required', true);
                                            $('#asterisko2').show();
                                            $('#asteriskod2').show();
                                        } else {
                                            $('.Other2_reviews').hide();
                                            $('.Other2_reviews span').hide();
                                            $('input[name="Other2_person"]').prop('required', false);
                                            $('select[name="Other2_Department_person"]').prop('required', false);
                                            $('#asterisko2').hide();
                                            $('#asteriskod2').hide();
                                        }
                                    }

                                    // On page load
                                    toggleFieldsBasedOnSelection($('[name="Other2_review"]').val());

                                    // On dropdown value change
                                    $('[name="Other2_review"]').change(function () {
                                        toggleFieldsBasedOnSelection($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review2"> Other's 2 Review Comment Required ?</label>
                                    <select name="Other2_review" id="Other2_review"  @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other2_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other2_review == 'no') selected @endif>No</option>
                                        <option @if ($data1->Other2_review == 'NA' || empty($data1->Other2_review)) selected @endif value='NA'>NA</option>
                                      
                                    </select>
                                </div>
                            </div>

                            @php
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_divisions_id' => $data->division_id])
                                    ->select('user_id')
                                    ->distinct()
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp

                            <div class="col-lg-6 Other2_reviews">
                                <div class="group-input">
                                    <label for="Person2">Other's 2 Person <span id="asterisko2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                    <select name="Other2_person" id="Other2_person" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other2_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 2)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other2_person" value="{{ $data1->Other2_person }}">
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Department2">Other's 2 Department <span id="asteriskod2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>

                                    <input type="text" name="Other2_Department_person" id="Other2_Department_person"
                                            value="{{ old('Other2_Department_person', $data1->Other2_Department_person ?: '') }}"
                                            @if ($data->stage != 2) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment13">Review comment (By Other's 2)</label>
                                    <textarea class="tiny" name="Other2_Assessment" id="summernote-43" @if ($data->stage != 3 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Feedback2"> Other's 2 Feedback</label>
                                    <textarea class="tiny" name="Other2_feedback" id="summernote-44" @if ($data->stage != 4 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 2 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other2_attachment">
                                            @if ($data1->Other2_attachment)
                                                @foreach (json_decode($data1->Other2_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other2_attachment[]" oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By2">Other's 2 Review Completed By</label>
                                    <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 Other2_reviews new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Others 2 Completed On">Others 2 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other2_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other2_on) }}" />
                                        <input readonly type="date" name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other2_on')" />
                                    </div>
                                    @error('Other2_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="sub-head">
                                Other's 3 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleFieldsBasedOnSelection(value) {
                                        if (value === 'yes') {
                                            $('.Other3_reviews').show();
                                            $('.Other3_reviews span').show();
                                            $('input[name="Other3_person"]').prop('required', true);
                                            $('select[name="Other3_Department_person"]').prop('required', true);
                                            $('#asterisko3').show();
                                            $('#asteriskod3').show();
                                        } else {
                                            $('.Other3_reviews').hide();
                                            $('.Other3_reviews span').hide();
                                            $('input[name="Other3_person"]').prop('required', false);
                                            $('select[name="Other3_Department_person"]').prop('required', false);
                                            $('#asterisko3').hide();
                                            $('#asteriskod3').hide();
                                        }
                                    }

                                    // On page load
                                    toggleFieldsBasedOnSelection($('[name="Other3_review"]').val());

                                    // On dropdown value change
                                    $('[name="Other3_review"]').change(function () {
                                        toggleFieldsBasedOnSelection($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review3">Other's 3 Review Comment Required ?</label>
                                    <select name="Other3_review" id="Other3_review" @if ($data->stage == 4) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other3_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other3_review == 'no') selected @endif>No</option>
                                        <option @if ($data1->Other3_review == 'NA' || empty($data1->Other3_review)) selected @endif value='NA'>NA</option>
                                      
                                    </select>
                                </div>
                            </div>

                            @php
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_divisions_id' => $data->division_id])
                                    ->select('user_id')
                                    ->distinct()
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp

                            <div class="col-lg-6 Other3_reviews">
                                <div class="group-input">
                                    <label for="Person3">Other's 3 Person <span id="asterisko3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                    <select name="Other3_person" id="Other3_person" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other3_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 2)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other3_person" value="{{ $data1->Other3_person }}">
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-12 Other3_reviews">
                                <div class="group-input">
                                    <label for="Department3">Other's 3 Department <span id="asteriskod3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                      
                                    <input type="text" name="Other3_Department_person" id="Other3_Department_person"
                                            value="{{ old('Other3_Department_person', $data1->Other3_Department_person ?: '') }}"
                                            @if ($data->stage != 2) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment14">Review comment (By Other's 3)</label>
                                    <textarea class="tiny" name="Other3_Assessment" id="summernote-45" @if ($data->stage != 3 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="feedback3">Other's 3 Feedback</label>
                                    <textarea class="tiny" name="Other3_feedback" id="summernote-46" @if ($data->stage != 4 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other3_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 3 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other3_attachment">
                                            @if ($data1->Other3_attachment)
                                                @foreach (json_decode($data1->Other3_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other3_attachment[]" oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Other's 3 Review Completed By</label>
                                    <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other3_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 3 Completed On">Others 3 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other3_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other3_on) }}" />
                                        <input readonly type="date" name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other3_on')" />
                                    </div>
                                    @error('Other3_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Other's 4 Section -->
                            <div class="sub-head">
                                Other's 4 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleOther4Fields(value) {
                                        if (value === 'yes') {
                                            $('.Other4_reviews').show();
                                            $('.Other4_reviews span').show();
                                            $('#Other4_person').prop('required', true);
                                            // $('#hod_Other4_person').prop('required', true);
                                            $('#Other4_Department_person').prop('required', true);
                                            $('#asterisko4').show();
                                        } else {
                                            $('.Other4_reviews').hide();
                                            $('.Other4_reviews span').hide();
                                            $('#Other4_person').prop('required', false);
                                            // $('#hod_Other4_person').prop('required', false);
                                            $('#Other4_Department_person').prop('required', false);
                                            $('#asterisko4').hide();
                                        }
                                    }

                                    // Initial toggle on page load
                                    toggleOther4Fields($('[name="Other4_review"]').val());

                                    // Toggle on value change
                                    $('[name="Other4_review"]').change(function () {
                                        toggleOther4Fields($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review4">Other's 4 Review Comment Required ?</label>
                                    <select name="Other4_review" id="Other4_review" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other4_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other4_review == 'no') selected @endif>No</option>
                                        <option @if ($data1->Other4_review == 'NA' || empty($data1->Other4_review)) selected @endif value='NA'>NA</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 Other4_reviews">
                                <div class="group-input">
                                    <label for="Person4">Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                    <select name="Other4_person" id="Other4_person" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 2)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other4_person" value="{{ $data1->Other4_person }}">
                                @endif
                                </div>
                            </div>

                            {{-- <div class="col-lg-6 Other4_reviews">
                                <div class="group-input">
                                    <label for="hod_Other4_person">HOD Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                    <select name="hod_Other4_person" id="hod_Other4_person" @if ($data->stage == 4) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data5->hod_Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Department4">Other's 4 Department <span id="asteriskod4" class="text-danger">*</span></label>

                                    <input type="text" name="Other4_Department_person" id="Other4_Department_person"
                                            value="{{ old('Other4_Department_person', $data1->Other4_Department_person ?: '') }}"
                                            @if ($data->stage != 2) readonly @endif>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Description of Action Item15">Review comment (By Other's 4)</label>
                                    <textarea class="tiny" name="Other4_Assessment" id="summernote-47"
                                        @if ($data->stage != 3 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="feedback4">Other's 4 Status of Action Item</label>
                                    <textarea class="tiny" name="Other4_feedback" id="summernote-48"
                                        @if ($data->stage != 4 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 4 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other4_attachment">
                                            @if ($data1->Other4_attachment)
                                                @foreach (json_decode($data1->Other4_attachment) as $file)
                                                    <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other4_attachment[]" oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By4">Other's 4 Review Completed By</label>
                                    <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other4_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 4 Completed On">Others 4 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other4_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other4_on) }}" />
                                        <input readonly type="date" name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other4_on')" />
                                    </div>
                                    @error('Other4_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Other's 5 Section -->

                            <div class="sub-head">
                                Other's 5 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleOther5Fields(value) {
                                        if (value === 'yes') {
                                            $('.Other5_reviews').show();
                                            $('.Other5_reviews span').show();
                                            $('#Other5_person').prop('required', true);
                                            // $('#hod_Other5_person').prop('required', true);
                                            $('#Other5_Department_person').prop('required', true);
                                            $('#asterisko5').show();
                                        } else {
                                            $('.Other5_reviews').hide();
                                            $('.Other5_reviews span').hide();
                                            $('#Other5_person').prop('required', false);
                                            // $('#hod_Other5_person').prop('required', false);
                                            $('#Other5_Department_person').prop('required', false);
                                            $('#asterisko5').hide();
                                        }
                                    }

                                    // Initial toggle on page load
                                    toggleOther5Fields($('[name="Other5_review"]').val());

                                    // Toggle on value change
                                    $('[name="Other5_review"]').change(function () {
                                        toggleOther5Fields($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review5">Other's 5 Review Comment Required ?</label>
                                    <select name="Other5_review" id="Other5_review" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other5_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other5_review == 'no') selected @endif>No</option>
                                        <option @if ($data1->Other5_review == 'NA' || empty($data1->Other5_review)) selected @endif value='NA'>NA</option>
                                      
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 Other5_reviews">
                                <div class="group-input">
                                    <label for="Person5">Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                    <select name="Other5_person" id="Other5_person" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 2)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other5_person" value="{{ $data1->Other5_person }}">
                                @endif
                                </div>
                            </div>

                            {{-- <div class="col-lg-6 Other5_reviews">
                                <div class="group-input">
                                    <label for="hod_Other5_person">HOD Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                    <select name="hod_Other5_person" id="hod_Other5_person" @if ($data->stage == 4) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data5->hod_Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 



                            <div class="col-lg-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Department5">Other's 5 Department <span id="asteriskod5" class="text-danger">*</span></label>
                                    <select name="Other5_Department_person" id="Other5_Department_person" @if ($data->stage != 2) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach (Helpers::getDepartments() as $key => $name)
                                            <option value="{{ $key }}" @if ($data1->Other5_Department_person == $key) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other5_Department_person" value="{{ $data1->Other5_Department_person }}">
                                    @endif
                                </div>
                            </div>--}}
                           <div class="col-lg-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Department5">Other's 5 Department <span id="asteriskod5" class="text-danger">*</span></label>

                                    <input type="text" name="Other5_Department_person" id="Other5_Department_person"
                                            value="{{ old('Other5_Department_person', $data1->Other5_Department_person ?: '') }}"
                                            @if ($data->stage != 3) readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="Description of Action Item16">Review comment (By Other's 5)</label>
                                    <textarea class="tiny" name="Other5_Assessment" id="summernote-49"
                                    @if ($data->stage != 3 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Other's 5 Status of Action Item</label>
                                    <textarea class="tiny" name="Other5_feedback" id="summernote-50"
                                    @if ($data->stage != 4 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 5 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other5_attachment">
                                            @if ($data1->Other5_attachment)
                                                @foreach (json_decode($data1->Other5_attachment) as $file)
                                                    <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other5_attachment[]" oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By5">Other's 5 Review Completed By</label>
                                    <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other5_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 5 Completed On">Others 5 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other5_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other5_on) }}" />
                                        <input readonly type="date" name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other5_on')" />
                                    </div>
                                    @error('Other5_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>







                                            
                                    </div>
                                    <div class="button-block">
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                            type="submit"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                            id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                            style="align-items: center;">
                                            <div class="spinner-border spinner-border-sm auditFormSpinner"
                                                style="display: none" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Save
                                        </button>
                                        <button type="button" class="backButton"
                                            onclick="previousStep()">Back</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                            type="button"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                            id="ChangeNextButton" class="nextButton"
                                            onclick="nextStep()">Next</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                            type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white">
                                                Exit </a> </button>
                                        @if (
                                            $data->stage == 2 ||
                                                $data->stage == 3 ||
                                                $data->stage == 4 ||
                                                $data->stage == 5 ||
                                                $data->stage == 6 ||
                                                $data->stage == 7)
                                            {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a> --}}
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                                                                                                                                    data-bs-target="#effectivenss_extension">
                                                                                                                                                                    Launch Effectiveness Check
                                                                                                                                                                </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm8" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head">
                                        QA/CQA Head Approval
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="QA/CQA Head Approval Comment">QA/CQA Head Approval Comment
                                                @if ($data->stage == 4)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <textarea name="qa_cqa_comment" {{ $data->stage == 0 || $data->stage == 1 ||$data->stage == 2 || $data->stage == 3 || $data->stage == 5 ? 'readonly' : '' }}>{{ $data->qa_cqa_comment }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_cqa_attach">QA/CQA Head Approval Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_attach">
                                                    @if ($data->qa_cqa_attach)
                                                        @foreach (json_decode($data->qa_cqa_attach) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank">
                                                                    <i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i>
                                                                </a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}">
                                                                    <i class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i>
                                                                </a>
                                                                <input type="hidden" name="existing_qa_cqa_attach[]"
                                                                    value="{{ $file }}">
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="qa_cqa_attach[]"
                                                        {{ $data->stage == 0 || $data->stage == 1 ||$data->stage == 2 || $data->stage == 3 || $data->stage == 5 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'qa_cqa_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden field to keep track of files to be deleted -->
                                    <input type="hidden" id="deleted_qa_cqa_attach" name="deleted_qa_cqa_attach"
                                        value="">

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const removeButtons = document.querySelectorAll('.remove-file');

                                            removeButtons.forEach(button => {
                                                button.addEventListener('click', function() {
                                                    const fileName = this.getAttribute('data-file-name');
                                                    const fileContainer = this.closest('.file-container');

                                                    // Hide the file container
                                                    if (fileContainer) {
                                                        fileContainer.style.display = 'none';
                                                        // Remove hidden input associated with this file
                                                        const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                        if (hiddenInput) {
                                                            hiddenInput.remove();
                                                        }

                                                        // Add the file name to the deleted files list
                                                        const deletedFilesInput = document.getElementById('deleted_qa_cqa_attach');
                                                        let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                            ',') : [];
                                                        deletedFiles.push(fileName);
                                                        deletedFilesInput.value = deletedFiles.join(',');
                                                    }
                                                });
                                            });
                                        });

                                        function addMultipleFiles(input, id) {
                                            const fileListContainer = document.getElementById(id);
                                            const files = input.files;

                                            for (let i = 0; i < files.length; i++) {
                                                const file = files[i];
                                                const fileName = file.name;
                                                const fileContainer = document.createElement('h6');
                                                fileContainer.classList.add('file-container', 'text-dark');
                                                fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                                const fileText = document.createElement('b');
                                                fileText.textContent = fileName;

                                                const viewLink = document.createElement('a');
                                                viewLink.href = '#'; // You might need to adjust this to handle local previews
                                                viewLink.target = '_blank';
                                                viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                                const removeLink = document.createElement('a');
                                                removeLink.classList.add('remove-file');
                                                removeLink.dataset.fileName = fileName;
                                                removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                                removeLink.addEventListener('click', function() {
                                                    fileContainer.style.display = 'none';
                                                });

                                                fileContainer.appendChild(fileText);
                                                fileContainer.appendChild(viewLink);
                                                fileContainer.appendChild(removeLink);

                                                fileListContainer.appendChild(fileContainer);
                                            }
                                        }
                                    </script>

                                </div>
                                <div class="button-block">
                                    @if ($data->stage != 0)
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                    @endif
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Log content -->
                        <div id="CCForm6" class="inner-block cctabcontent">
                            <div class="inner-block-content">


                                <div class="col-12 sub-head" style="font-size: 16px">
                                    Audit Details Summary
                                </div>


                                <div class="row">


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Details Summary On">Audit Details Summary By</label>
                                            <div class="">{{ $data->audit_details_summary_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Details Summary On">Audit Details Summary On</label>
                                            <div class="">{{ $data->audit_details_summary_on ?? 'Not Applicable' }}</div>
                                        </div> 
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Audit Details Summary Comment</label>
                                            <div class="">{{ $data->audit_details_summary_on_comment  ?? 'Not Applicable'}}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                                Cancel
                                            </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled By">Cancel By</label>
                                            <div class="">{{ $data->cancelled_by  ?? 'Not Applicable'}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled On">Cancel On</label>
                                            <div class="">{{ $data->cancelled_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> Cancel Comment</label>
                                            <div class="">{{ $data->cancelled_on_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>





                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Summary and Response Complete
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Summary and Response Complete On">Summary and Response
                                                Complete
                                                By</label>
                                            <div class="">{{ $data->summary_and_response_com_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Summary and Response Complete By">Summary and Response
                                                Complete
                                                On</label>
                                            <div class="">{{ $data->summary_and_response_com_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Summary and Response Complete Comment</label>
                                            <div class="">{{ $data->summary_and_response_com_on_comment  ?? 'Not Applicable'}}
                                            </div>
                                        </div>
                                    </div>





                                     <div class="col-12 sub-head" style="font-size: 16px">
                                            CFT Review Not Required
                                            </div> 

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Preparation Completed On">CFT Review Not Required
                                                By</label>
                                            <div class="">{{ $data->cft_review_not_req_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Preparation Completed On">CFT Review Not Required
                                                On</label>
                                            <div class="">{{ $data->cft_review_not_req_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">CFT Review Not Required Comment</label>
                                            <div class="">{{ $data->cft_review_not_req_on_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>




                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        CFT Review Complete
                                    </div>




                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Preparation Completed On">CFT Review Complete
                                                By</label>
                                            <div class="">{{ $data->cft_review_complete_by ?? 'Not Applicable'}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Preparation Completed On">CFT Review Complete
                                                On</label>
                                            <div class="">{{ $data->cft_review_complete_on ?? 'Not Applicable'}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">CFT Review Complete Comment</label>
                                            <div class="">{{ $data->cft_review_complete_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>



                                    <div class="col-12 sub-head" style="font-size: 16px">
                                    Send to Opened
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Observation Submitted By">Send to Opened By</label>
                                            <div class="">{{ $data->send_to_opened_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Observation Submitted On">Send to Opened On</label>
                                            <div class="">{{ $data->send_to_opened_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Send to Opened Comment</label>
                                            <div class="">{{ $data->send_to_opened_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Approval Complete
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Observation Submitted By">Approval Complete By</label>
                                            <div class="">{{ $data->approval_complete_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Observation Submitted On">Approval Complete On</label>
                                            <div class="">{{ $data->approval_complete_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Approval Complete Comment</label>
                                            <div class="">{{ $data->approval_complete_on_comment ?? 'Not Applicable'}}</div>
                                        </div>
                                    </div>


                                   



                                </div>




                                <div class="button-block">
                                    @if ($data->stage != 0)
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                    @endif
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit"
                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Submit</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                </div>
                </form>

            </div>
        </div>
    </div>



    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('externalAuditStateChange', $data->id) }}" method="POST" id="signatureModalForm">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                                        <button>Close</button>
                                    </div> -->
                    <div class="modal-footer">
                        <!-- <button type="submit">Submit</button> -->
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('signatureModalForm');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.signatureModalButton');
                var spinner = signatureForm.querySelector('.signatureModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

    </script>
    <div class="modal fade" id="rejection-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('UpdateStateAuditee', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>

                    </div>
                    {{-- <style>
                                .group-input {
                                    margin-bottom: 45px; /* Adjust the margin value as needed */
                                }
                            </style> --}}

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                                        <button>Close</button>
                                    </div> -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('RejectStateAuditee', $data->id) }}" method="POST" id="signatureModalForm2">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                                        <button>Close</button>
                                    </div> -->
                    <div class="modal-footer">
                        <!-- <button type="submit">Submit</button> -->
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('signatureModalForm2');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.signatureModalButton');
                var spinner = signatureForm.querySelector('.signatureModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

    </script>

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('CancelStateExternalAudit', $data->id) }}" method="POST" id="signatureModalForm3">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" name="comment"required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                                        <button>Close</button>
                                    </div> -->
                    <div class="modal-footer">
                        <!-- <button type="submit">Submit</button> -->
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('signatureModalForm3');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.signatureModalButton');
                var spinner = signatureForm.querySelector('.signatureModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

    </script>


    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('childexternalaudit', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        @if($data->stage == 1)
                            <div class="group-input">
                                <label></lable>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Observations">
                                        Observations
                                    </label>
                            </div>
                        @endif
                        @if($data->stage == 1)
                            <div class="group-input">
                                <label></lable>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Action-Item">
                                        Action-Item
                                    </label>
                            </div>
                        @endif

                        @if($data->stage == 2 && Helpers::getChildData($data->id , 'External Audit') < 3)
                            <div class="group-input">
                                <label for="major">
                                    <input type="radio" name="child_type" value="Extension">
                                    Extension
                                </label>
                            </div>
                        @endif

                        @if($data->stage == 4 && Helpers::getChildData($data->id , 'External Audit') < 3)
                            <div class="group-input">
                                <label for="major">
                                    <input type="radio" name="child_type" value="Extension">
                                    Extension
                                </label>
                            </div>
                        @endif

                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="child-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('childexternalaudit', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        {{-- <div class="group-input">
                                    <label></lable>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Observations">
                                        Observations
                                    </label>
                                </div>
                                <div class="group-input">
                                    <label></lable>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Action-Item">
                                         Action-Item
                                    </label>
                                </div> --}}
                        <div class="group-input">
                            <label></lable>
                                <label for="major">
                                    <input type="radio" name="child_type" value="external-audit">
                                    External-Audit
                                </label>
                        </div>
                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div>
                </form>

            </div>
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
    <style>
        #signat-modal.group-input label,
        {
        display: block;
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 5px;
        }
    </style>

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee , #reference_record,#reviewer_person_value'
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
        }



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
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-file');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fileName = this.getAttribute('data-file-name');
                    const fileContainer = this.closest('.file-container');

                    // Hide the file container
                    if (fileContainer) {
                        fileContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        function setupPersonToDepartmentMapping(personSelectId, departmentInputId, usersData) {
            let personSelect = document.getElementById(personSelectId);
            let departmentInput = document.getElementById(departmentInputId);

            if (personSelect && departmentInput) {
                personSelect.addEventListener("change", function () {
                    let selectedPerson = personSelect.value;
                    departmentInput.value = usersData[selectedPerson] || ""; // Assign department or clear field
                });
            }
        }

        // Store user department data
       
          let userDepartments = {
            @foreach ($users as $user)
                "{{ $user->name }}": `{!! Helpers::getUsersDepartmentName($user->departmentid) !!}`,
            @endforeach
        };


        // Apply function to "Other's 1 Person" and "Other's 1 Department"
        setupPersonToDepartmentMapping("Other1_person", "Other1_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other2_person", "Other2_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other3_person", "Other3_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other4_person", "Other4_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other5_person", "Other5_Department_person", userDepartments);
    });
</script>
@endsection
