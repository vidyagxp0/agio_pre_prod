@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
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

    </style>
    <style>

        header .header_rcms_bottom {
            display: none;
        }

        .calenderauditee {
            position: relative;
        }

        .new-date-data-field .input-date input.hide-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .new-date-data-field input {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px 15px;
            display: block;
            width: 100%;
            background: white;
        }

        .calenderauditee input::-webkit-calendar-picker-indicator {
            width: 100%;
        }
    </style>

<style>
        
        /*Main Table Styling */
        #isPasted {
            width: 690px !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; 
            width: 1%;
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;

        }

        /* Common Table Cell Styling */
        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Paragraph Styling Inside Table Cells */
        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 700px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important;
            height: 100%;
            display: block; /* Remove extra space below the image */
            margin: 5px auto; /* Add spacing and center align */
        }

        /* If you want larger images */
        #isPasted td img {
            max-width: 400px !important; /* Adjust this to your preferred maximum width */
            height: 300px;
            margin: 5px auto;
        }

        .table-containers {
            width: 690px;
            overflow-x: fixed; /* Enable horsizontal scrolling */
        }

    
        #isPasted table {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
        }


        #isPasted table th,
        #isPasted table td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }


        #isPasted table img {
            max-width: 100% !important;
            height: auto;
            display: block;
            margin: 5px auto;
        }

        .note-editable table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .note-editable th,
        .note-editable td {
            border: 1px solid black !important;
            padding: 8px;
            text-align: left;
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

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName($data->division_code) }}/Observation
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
                                ->where(['user_id' => Auth::user()->id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('ShowObservationAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && (Auth::user()->id == $data->initiator_id || Helpers::check_roles($data->division_id, 'Observation', 12) || Helpers::check_roles($data->division_id, 'Observation', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Report Issued
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-model">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (Auth::user()->id == $data->assign_to || Helpers::check_roles($data->division_id, 'Observation', 11) || Helpers::check_roles($data->division_id, 'Observation', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CAPA Plan Proposed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#capa-rejection-modal">
                                No CAPAs Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 3 && (Helpers::check_roles($data->division_code, 'Observation', 13) || Helpers::check_roles($data->division_code, 'Observation', 7) || Helpers::check_roles($data->division_code, 'Observation', 66) || Helpers::check_roles($data->division_id, 'Observation', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Response Reviewed
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal1">
                                QA Approval Without CAPA
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject CAPA Plan
                            </button> --}}
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                            {{-- @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    All CAPA Closed
                                </button>
                            @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Final Approval
                                </button>--}}
                            @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Pending Response </div>
                            @else
                                <div class="">Pending Response</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Response  Verification</div>
                            @else
                                <div class="">Response  Verification</div>
                            @endif

                            {{-- @if ($data->stage >= 4)
                                <div class="active">CAPA Execution in Progress</div>
                            @else
                                <div class="">CAPA Execution in Progress</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">Pending Final Approval</div>
                            @else
                                <div class="">Pending Final Approval</div>
                            @endif --}}
                            @if ($data->stage >= 4)
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



            <script>
                function calculateRiskAnalysis(selectElement) {
                    // Get the row containing the changed select element
                    let row = selectElement.closest('tr');

                    // Get values from select elements within the row
                    let R = parseFloat(document.getElementById('analysisR').value) || 0;
                    let P = parseFloat(document.getElementById('analysisP').value) || 0;
                    let N = parseFloat(document.getElementById('analysisN').value) || 0;

                    // Perform the calculation
                    let result = R * P * N;

                    // Update the result field within the row
                    document.getElementById('analysisRPN').value = result;
                }
            </script>
            <script>
                $(document).ready(function() {
                    $('#observation_table').click(function(e) {
                        function generateTableRow(serialNumber) {
                            var users = @json($users);
                            console.log(users);
                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                                '"></td>' +
                                '<td><textarea name="action[]"></textarea></td>' +
                                 '<td><select name="responsible[]">' +
                                '<option value="">Select a value</option>';

                            for (var i = 0; i < users.length; i++) {
                                html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                            }

                            html += '</select></td>' +
                                // '<td><input type="date" name="deadline[]"></td>' +
                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' +
                                serialNumber +
                                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' +
                    serialNumber + '`)" /></div></div></div></td>' +

                                '<td><textarea name="item_status[]" row></textarea></td>' +
                                '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                                '</tr>';



                            return html;
                        }

                        var tableBody = $('#observation tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
                });
            </script>

            <script>
                $(document).on('click', '.removeRowBtn', function() {
                    $(this).closest('tr').remove();
                })
            </script>

            @php
                $users = DB::table('users')->get();
            @endphp
            {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Response & CAPA</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Summary</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Response Verification</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
                    </div>

                    <form action="{{ route('observationupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">General Information</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input type="hidden" name="record_number">
                                                <input disabled type="text"
                                                    value="{{  Helpers::getDivisionName($data->division_code) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text" name="division_id"
                                                    value="{{ Helpers::getDivisionName($data->division_code) }}">
                                                <input type="hidden" name="division_id"
                                                    value="{{ Helpers::getDivisionName($data->division_code) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="originator">Initiator</label>
                                                <input disabled type="text" value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="date_opened">Date of Initiation<span
                                                        class="text-danger"></span></label>
                                                <input disabled type="text" value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">
                                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="assign_to">Auditee Department Head<span
                                                class="text-danger">*</span></label>
                                                <select name="assign_to"
                                                {{ in_array($data->stage,[0,2,3,4]) ? "disabled" : "" }}
                                                required>
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if(in_array($data->stage, [0,2,3,4]))
                                                   <input type="hidden" name="assign_to" value="{{old('assign_to', $data->assign_to)}}">
                                                @endif  
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Auditee Department Name</b></label>
                                                <input disabled type="text" name="auditee_department" id="initiator_group"
                                                    value="{{ $data->auditee_department }}">
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="assign_to">Auditee Department Head<span class="text-danger">*</span></label>
                                            <select name="assign_to" id="assign_to"
                                                {{ in_array($data->stage, [0,2,3,4]) ? "disabled" : "" }} required>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $value)
                                                    <option 
                                                        value="{{ $value->id }}" 
                                                        data-department-id="{{ $value->departmentid }}"  
                                                        {{ $data->assign_to == $value->id ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if(in_array($data->stage, [0,2,3,4]))
                                                <input type="hidden" name="assign_to" value="{{ old('assign_to', $data->assign_to) }}">
                                            @endif  
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            let assignToSelect = document.getElementById("assign_to");
                                            let departmentInput = document.getElementById("initiator_group");

                                            function updateDepartmentName() {
                                                let selectedOption = assignToSelect.options[assignToSelect.selectedIndex];
                                                let departmentId = selectedOption.getAttribute("data-department-id");

                                                if (departmentId) {
                                                    // AJAX request to get department name
                                                    fetch(`/get-department-name/${departmentId}`)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            departmentInput.value = data.department_name || "N/A";
                                                        })
                                                        .catch(error => {
                                                            console.error("Error fetching department name:", error);
                                                        });
                                                } else {
                                                    departmentInput.value = "N/A";
                                                }
                                            }

                                            // Run function when the page loads (for edit mode)
                                            updateDepartmentName();

                                            // Run function when user selects a different Auditee Head
                                            assignToSelect.addEventListener("change", updateDepartmentName);
                                        });
                                    </script>


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator"><b>Auditee Department Name</b></label>
                                            <input disabled type="text" name="auditee_department" id="initiator_group"
                                                value="{{ $data->auditee_department }}">
                                        </div>
                                    </div>



                                {{-- <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Due Date">Observation Report Due Date</label>
                                                <div><small class="text-primary">
                                                </small></div>
                                                <div class="calenderauditee">
                                                    <input disabled type="text" id="due_date" readonly placeholder="DD-MMM-YYYY"
                                                        value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') : '' }}" />
                                                    <input type="date" name="due_date"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? "disabled" : "" }}
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                                </div>

                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Due Date"> Observation Report Due Date<span
                                                class="text-danger">*</span></label>
                                                <div><small class="text-primary">
                                                    </small></div>
                                                <div class="calenderauditee">
                                                    <input  type="text" id="due_date" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}" />
                                                    <input type="date" name="due_date"
                                                    {{ in_array($data->stage,[0,2,3,4]) ? "readonly" : "" }}
                                                     {{ $data->stage !=1? 'readonly' : '' }}
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                         value="{{ $data->due_date}}"
                                                        class="hide-input" oninput="handleDateInput(this, 'due_date')" required/>
                                                </div>

                                            </div>
                                        </div>
                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }

                                    Call this function initially to ensure the correct format is shown on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        handleDateInput(dateInput, 'due_date_display');
                                    });
                                    </script>

                                    <style>
                                    .hide-input {
                                        display: none;
                                    }
                                    </style>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span
                                                    id="rchars">255</span>
                                                characters remaining

                                                <input name="short_description" id="docname" type="text" maxlength="255" required value="{{ $data->short_description }}"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                            </div>
                                            {{-- <p id="docnameError" style="color:red">**Short Description is required</p> --}}
                                        </div>

                                        {{-- <div class="col-12">
                                    <div class="sub-head">Observation Details</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="grading">Grading</label>
                                        <select name="grading" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $data->grading == '1' ? 'selected' : '' }}>Recommendation</option>
                                            <option value="2" {{ $data->grading == '2' ? 'selected' : '' }}>Major</option>
                                            <option value="3" {{ $data->grading == '3' ? 'selected' : '' }}>Minor</option>
                                            <option value="4" {{ $data->grading == '4' ? 'selected' : '' }}>Critical</option>
                                        </select>
                                    </div>
                                </div> --}}
                                        {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="category_observation">Category Observation</label>
                                        <select name="category_observation" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option title="Case Report Form (CRF)" value="1" {{ $data->category_observation == '1' ? 'selected' : '' }}>
                                                Case Report Form (CRF)
                                            </option>
                                            <option title="Clinical Database" value="2" {{ $data->category_observation == '2' ? 'selected' : '' }}>
                                                Clinical Database
                                            </option>
                                            <option title="Clinical Trial Protocol" value="3" {{ $data->category_observation == '3' ? 'selected' : '' }}>
                                                Clinical Trial Protocol
                                            </option>
                                            <option title="Clinical Trial Report" value="4" {{ $data->category_observation == '4' ? 'selected' : '' }}>
                                                Clinical Trial Report
                                            </option>
                                            <option title="Compliance" value="5" {{ $data->category_observation == '5' ? 'selected' : '' }}>
                                                Compliance
                                            </option>
                                            <option title="Computerized systems" value="6" {{ $data->category_observation == '6' ? 'selected' : '' }}>
                                                Computerized systems
                                            </option>
                                            <option title="Conduct of Study" value="7" {{ $data->category_observation == '7' ? 'selected' : '' }}>
                                                Conduct of Study
                                            </option>
                                            <option title="Data Accuracy / SDV" value="8" {{ $data->category_observation == '8' ? 'selected' : '' }}>
                                                Data Accuracy / SDV
                                            </option>
                                            <option title="Documentation" value="9" {{ $data->category_observation == '9' ? 'selected' : '' }}>
                                                Documentation
                                            </option>
                                            <option title="Essential Documents (TMF/ISF)" value="10" {{ $data->category_observation == '10' ? 'selected' : '' }}>
                                                Essential Documents (TMF/ISF)
                                            </option>
                                            <option title="Ethics Committee (IEC / IRB)" value="11" {{ $data->category_observation == '11' ? 'selected' : '' }}>
                                                Ethics Committee (IEC / IRB)
                                            </option>
                                            <option title="Facilities / Equipment" value="12" {{ $data->category_observation == '12' ? 'selected' : '' }}>
                                                Facilities / Equipment
                                            </option>
                                            <option title="Miscellaneous" value="13" {{ $data->category_observation == '13' ? 'selected' : '' }}>
                                                Miscellaneous
                                            </option>
                                            <option title="Monitoring" value="14" {{ $data->category_observation == '14' ? 'selected' : '' }}>
                                                Monitoring
                                            </option>
                                            <option title="Organization and Responsibilities" value="16" {{ $data->category_observation == '16' ? 'selected' : '' }}>
                                                Organization and Responsibilities
                                            </option>
                                            <option title="Periodic Safety Reporting" value="17" {{ $data->category_observation == '17' ? 'selected' : '' }}>
                                                Periodic Safety Reporting
                                            </option>
                                            <option title="Protocol Compliance" value="18" {{ $data->category_observation == '18' ? 'selected' : '' }}>
                                                Protocol Compliance
                                            </option>
                                            <option title="Qualification and Training of Staff" value="19" {{ $data->category_observation == '19' ? 'selected' : '' }}>
                                                Qualification and Training of Staff
                                            </option>
                                            <option title="Quality Management System" value="20" {{ $data->category_observation == '20' ? 'selected' : '' }}>
                                                Quality Management System
                                            </option>
                                            <option title="Regulatory Requirements" value="25" {{ $data->category_observation == '25' ? 'selected' : '' }}>
                                                Regulatory Requirements
                                            </option>
                                            <option title="Reliability of Data" value="26" {{ $data->category_observation == '26' ? 'selected' : '' }}>
                                                Reliability of Data
                                            </option>
                                            <option title="Safety Reporting" value="27" {{ $data->category_observation == '27' ? 'selected' : '' }}>
                                                Safety Reporting
                                            </option>
                                            <option title="Source Documents" value="28" {{ $data->category_observation == '28' ? 'selected' : '' }}>
                                                Source Documents
                                            </option>
                                            <option title="Subject Diary(ies)" value="29" {{ $data->category_observation == '29' ? 'selected' : '' }}>
                                                Subject Diary(ies)
                                            </option>
                                            <option title="Informed Consent Form" value="30" {{ $data->category_observation == '30' ? 'selected' : '' }}>
                                                Informed Consent Form
                                            </option>
                                            <option title="Subject Questionnaire(s)" value="31" {{ $data->category_observation == '31' ? 'selected' : '' }}>
                                                Subject Questionnaire(s)
                                            </option>
                                            <option title="Supporting Procedures" value="32" {{ $data->category_observation == '32' ? 'selected' : '' }}>
                                                Supporting Procedures
                                            </option>
                                            <option title="Test Article and Accountability" value="33" {{ $data->category_observation == '33' ? 'selected' : '' }}>
                                                Test Article and Accountability
                                            </option>
                                            <option title="Trial Master File (TMF)" value="34" {{ $data->category_observation == '34' ? 'selected' : '' }}>
                                                Trial Master File (TMF)
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}
                                        {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="reference_guideline">Referenced Guideline</label>
                                        <input type="text" name="reference_guideline" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->reference_guideline }}">
                                    </div>
                                </div> --}}
                                        {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="desc">Description</label>
                                        <textarea name="description" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} >{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Further Information</div>
                                </div> --}}
                                        {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="__files1">Attached Files</label>
                                        <input type="file" name="attach_files1" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{ $data->attach_files1 }}"/>
                                    </div>
                                </div> --}}

                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_observations">Attached files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="attach_files_gi">
                                                @if ($data->attach_files_gi)
                                                    @foreach (json_decode($data->attach_files_gi) as $file)
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
                                                <input  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    value="{{ $data->attach_files_gi }}" type="file"
                                                    id="myfile" name="attach_files_gi[]"
                                                    oninput="addMultipleFiles(this, 'attach_files_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attached files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attach_files_gi">
                                                @if ($data->attach_files_gi)
                                                    @foreach(json_decode($data->attach_files_gi) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_attachments_gi[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attach_files_gi[]" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }} oninput="addMultipleFiles(this, 'attach_files_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                {{-- <script>
                                    function removeFile(element) {
                                        const fileName = element.getAttribute('data-file-name');
                                        let attachFiles = document.getElementById('attach_files_gi');
                                        let currentFiles = JSON.parse(attachFiles.getAttribute('data-current-files'));

                                        currentFiles = currentFiles.filter(file => file !== fileName);
                                        attachFiles.setAttribute('data-current-files', JSON.stringify(currentFiles));

                                        element.parentElement.remove();
                                    }

                                    function addMultipleFiles(input, fieldId) {
                                        const attachFiles = document.getElementById(fieldId);
                                        const currentFiles = input.files;
                                        let filesList = [];

                                        for (let i = 0; i < currentFiles.length; i++) {
                                            filesList.push(currentFiles[i].name);
                                        }

                                        attachFiles.setAttribute('data-current-files', JSON.stringify(filesList));
                                    }
                                </script> --}}



                                      
                                
                                        <div class="col-md-6 new-date-data-field">
                                            <div class="group-input input-date ">
                                                <label for="capa_date_due">Response Due Date<span
                                                class="text-danger">*</span></label>
                                                <div class="calenderauditee">
                                                    <input type="text" name="recomendation_capa_date_due"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        {{ in_array($data->stage,[0,2,3,4]) ? "readonly" : "" }}
                                                        id="recomendation_capa_date_due" 
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->recomendation_capa_date_due) }}" required/>
                                                    <input type="date" class="hide-input"
                                                     {{ in_array($data->stage,[0,2,3,4]) ? "readonly" : "" }}
                                                        value="{{ Helpers::getdateFormat($data->recomendation_capa_date_due) }}"
                                                        oninput="handleDateInput(this, 'recomendation_capa_date_due')" />

                                                        @if(in_array($data->stage, [0,2,3,4]))
                                                          <input type="hidden" name="recomendation_capa_date_due" value="{{old('recomendation_capa_date_due', $data->recomendation_capa_date_due)}}">
                                                        @endif  
                                                </div>
                                            </div>
                                        </div>
                  
                                        

                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                <div class="sub-head">Observation<span
                                                class="text-danger">*</span>
                                                    <button type="button" name="details" id="Details-add" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </div>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Details-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 8%">Sr.No</th>
                                                            <th style="width:40%">Observation</th>
                                                            <th style="width: 40%">Category</th>
                                                            <th style="width: 12%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if ($grid_Data && is_array($grid_Data->data))
                                                    @foreach ($grid_Data->data as $datas)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="observation[{{ $loop->index }}][serial]"
                                                                            value="{{ $loop->index + 1 }}">
                                                                    </td>
                                                                    <td>
                                                                        <textarea name="observation[{{ $loop->index }}][non_compliance]" rows="3" cols="40" required>{{ isset($datas['non_compliance']) ? $datas['non_compliance'] : '' }}</textarea>
                                                                    </td>

                                                                    <td>
                                                                     <select name="observation[{{ $loop->index }}][category]" required >
                                                                      <option value="">Select Category</option>
                                                                      <option value="major" {{ isset($datas['category']) && $datas['category'] == 'major' ? 'selected' : '' }}>major</option>
                                                                     <option value="minor" {{ isset($datas['category']) && $datas['category'] == 'minor' ? 'selected' : '' }}>minor</option>
                                                                     <option value="critical" {{ isset($datas['category']) && $datas['category'] == 'critical' ? 'selected' : '' }}>critical</option>
                                                                    </select>
                                                                    </td>

                                                                    <td><button type="text"
                                                                            class="removeRowBtn">Remove</button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                            </div>


                                            <script>
                                                    $(document).ready(function() {
                                                        $('#Details-add').click(function(e) {
                                                            function generateTableRow(serialNumber) {
                                                                var data = @json($grid_Data);
                                                                var html = '';
                                                                html += '<tr>' +
                                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                                    '"></td>' +
                                                                    '<td><textarea name="observation[' + serialNumber + '][non_compliance]" rows="3" cols="40" required></textarea></td>'
                                                                     +
                                                                    '<td><select name="observation[' + serialNumber + '][category]" required>' +
                                                                        '<option value="">Select Category</option>' +
                                                                         '<option value="major">major</option>' +
                                                                         '<option value="minor">minor</option>' +
                                                                         '<option value="critical">critical</option>' +
                                                                    '</select></td>' +

                                                                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                                                                    '</tr>';

                                                                    for (var i = 0; i < data.length; i++) {
                                                                        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                                                                    }

                                                                html += '</select></td>' +
                                                                    '</tr>';

                                                                return html;
                                                            }

                                                            var tableBody = $('#Details-table tbody');
                                                            var rowCount = tableBody.children('tr').length;
                                                            var newRow = generateTableRow(rowCount + 1);
                                                            tableBody.append(newRow);
                                                        });
                                                    });
                                                </script>

                                                    <script>
                                                        $(document).on('click', '.removeRowBtn', function() {
                                                            $(this).closest('tr').remove();
                                                        })
                                                    </script>


                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="recommend_action">Recommended Action</label>
                                                <textarea name="recommend_action"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->recommend_action }}</textarea>
                                            </div>
                                        </div> -->
                                        {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_observations">Related Obsevations</label>
                                        <input type="file" name="related_observations" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{ $data->related_observations }}"/>
                                    </div>
                                </div> --}}
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="related_observations">Related Obsevations</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="related_observations">
                                                    @if ($data->related_observations)
                                                        @foreach (json_decode($data->related_observations) as $file)
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
                                                    <input  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                        value="{{ $data->related_observations }}" type="file"
                                                        id="myfile" name="related_observations[]"
                                                        oninput="addMultipleFiles(this, 'related_observations')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="button-block">
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Response and CAPA Plan Details</div>
                                        </div>
                                    
                                        <!-- <div class="col-md-12 new-date-data-field">
                                            <div class="group-input input-date ">
                                                <label for="date_Response_due1">Response Details (+)  @if($data->stage == 2)<span class="text-danger">*</span>@endif</label>
                                                <textarea name="response_detail" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} id="">{{ $data->response_detail }}</textarea>
                                            </div>
                                        </div> -->

                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                <div class="sub-head">Response Details @if ($data->stage == 2)
                                                <span class="text-danger">*</span>
                                                @endif
                                                    <button type="button" name="details" id="Details-add8" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </div>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Details-table8">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 8%">Sr.No.</th>
                                                            <th style="width: 80%">Response Details</th>
                                                            <th style="width: 12%">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if ($grid_Data2 && is_array($grid_Data2->data))
                                                    @foreach ($grid_Data2->data as $datas)
                                                                <tr>
                                                                    <td><input disabled type="text" name="response[{{ $loop->index }}][serial]"  value="{{ $loop->index + 1 }}">
                                                                    </td>
                                                                    <td>
                                                                        <textarea  name="response[{{ $loop->index }}][response_detail]" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}> {{ isset($datas['response_detail']) ? $datas['response_detail'] : '' }}</textarea>
                                                                    </td>

                                                                    <td><button type="text"
                                                                            class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }} >Remove</button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                            </div>

                                            <script>
                                                   $(document).ready(function() {
                                                   $('#Details-add8').click(function(e) {
                                                      function generateTableRow(serialNumber) {
                                                       var html = '';

                                                      html += '<tr>' +
                                                     '<td style="width: 8%; text-align: center;">' +
                                                      '<input disabled type="text" name="serial[]" value="' + serialNumber + '" style="width: 100%;">' +
                                                      '</td>' +
                                                      '<td style="width: 70%;">' +
                                                      '<textarea name="response[' + serialNumber + '][response_detail]" style="width: 100%; min-height: 50px;"></textarea>' +
                                                      '</td>' +
                                                   '<td style="width: 12%; text-align: left; padding-left: 10px;">' +
                                                   '<button type="button" class="removeRowBtn" style="width: auto; padding: 3px 8px; font-size: 14px;">Remove</button>' +
                                                     '</td>' +
                                                     '</tr>';

                                                return html;
                                                }

                                                        var tableBody = $('#Details-table8 tbody');
                                                        var rowCount = tableBody.children('tr').length;
                                                        var newRow = generateTableRow(rowCount + 1);
                                                        tableBody.append(newRow);
                                                        });

                                                    // Remove button functionality
                                                    $(document).on('click', '.removeRowBtn', function() {
                                                        $(this).closest('tr').remove();
                                                    });
                                                });
                                        </script>




                                        <!-- <div class="col-lg-12 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="date_due">Corrective Actions (+)</label>
                                                <textarea name="corrective_action" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} id="">{{ $data->corrective_action }}</textarea>
                                            </div>
                                        </div> -->


                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                <div class="sub-head">Corrective Actions @if ($data->stage == 2)
                                                       <span class="text-danger">*</span>
                                                      @endif
                                                    <button type="button" name="details" id="Details-add4" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </div>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Details-table4">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 8%">Sr.No</th>
                                                            <th style="width: 80%">Corrective Actions</th>
                                                            <th style="width: 12%">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if ($grid_Data3 && is_array($grid_Data3->data))
                                                    @foreach ($grid_Data3->data as $datas)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="corrective[{{ $loop->index }}][serial]"
                                                                            value="{{ $loop->index + 1 }}">
                                                                    </td>
                                                                    <td><textarea  name="corrective[{{ $loop->index }}][corrective_action]" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>{{ isset($datas['corrective_action']) ? $datas['corrective_action'] : '' }}</textarea>

                                                                    </td>
                                                                    <td><button type="text"
                                                                            class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>Remove</button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                            </div>


                                            <script>
                                                    $(document).ready(function() {
                                                        $('#Details-add4').click(function(e) {
                                                            function generateTableRow(serialNumber) {
                                                                var data = @json($grid_Data3);
                                                                var html = '';
                                                                html += '<tr>' +
                                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                                    '"></td>' +
                                                                    '<td>'+'<textarea name="corrective[' + serialNumber + '][corrective_action]" style="width: 100%; min-height: 50px;"></textarea>' + '</td>' +
                                                                    '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +
                                                                    '</tr>';

                                                                    for (var i = 0; i < data.length; i++) {
                                                                        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                                                                    }

                                                                html += '</select></td>' +
                                                                    '</tr>';

                                                                return html;
                                                            }

                                                            var tableBody = $('#Details-table4 tbody');
                                                            var rowCount = tableBody.children('tr').length;
                                                            var newRow = generateTableRow(rowCount + 1);
                                                            tableBody.append(newRow);
                                                        });
                                                    });
                                                </script>

                                        <!-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="assign_to2">Preventive Action (+)</label>
                                                    <textarea name="preventive_action" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->preventive_action }}</textarea>
                                            </div>
                                        </div> -->

                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                <div class="sub-head">Preventive Action @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif
                                                    <button type="button" name="details" id="Details-add5" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </div>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Details-table5">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 8%">Sr.No</th>
                                                            <th style="width: 80%">Preventive Action</th>
                                                            <th style="width: 12%">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if ($grid_Data4 && is_array($grid_Data4->data))
                                                    @foreach ($grid_Data4->data as $datas)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="preventive[{{ $loop->index }}][serial]"
                                                                            value="{{ $loop->index + 1 }}">
                                                                    </td>
                                                                    <td><textarea name="preventive[{{ $loop->index }}][preventive_action]" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }} >{{ isset($datas['preventive_action']) ? $datas['preventive_action'] : '' }}</textarea>
                                                                    </td>
                                                                    <td><button type="text"
                                                                            class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>Remove</button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                            </div>


                                            <script>
                                                    $(document).ready(function() {
                                                        $('#Details-add5').click(function(e) {
                                                            function generateTableRow(serialNumber) {
                                                                var data = @json($grid_Data4);
                                                                var html = '';
                                                                html += '<tr>' +
                                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                                                                    '<td>'+'<textarea name="preventive[' + serialNumber + '][preventive_action]" style="width: 100%; min-height: 50px;"></textarea>' + '</td>' +
                                                                    '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +
                                                                    '</tr>';

                                                                    for (var i = 0; i < data.length; i++) {
                                                                        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                                                                    }

                                                                html += '</select></td>' +
                                                                    '</tr>';

                                                                return html;
                                                            }

                                                            var tableBody = $('#Details-table5 tbody');
                                                            var rowCount = tableBody.children('tr').length;
                                                            var newRow = generateTableRow(rowCount + 1);
                                                            tableBody.append(newRow);
                                                        });
                                                    });
                                                </script>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="cro_vendor">CRO/Vendor</label>
                                        <select name="cro_vendor" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option title="Amit Guru" value="1" {{ $data->cro_vendor == '1' ? 'selected' : '' }}>
                                                Amit Guru
                                            </option>
                                            <option title="Shaleen Mishra" value="2" {{ $data->cro_vendor == '2' ? 'selected' : '' }}>
                                                Shaleen Mishra
                                            </option>
                                            <option title="Vikas Prajapati" value="3" {{ $data->cro_vendor == '3' ? 'selected' : '' }}>
                                                Vikas Prajapati
                                            </option>
                                            <option title="Anshul Patel" value="4" {{ $data->cro_vendor == '4' ? 'selected' : '' }}>
                                                Anshul Patel
                                            </option>
                                            <option title="Amit Patel" value="5" {{ $data->cro_vendor == '5' ? 'selected' : '' }}>
                                                Amit Patel
                                            </option>
                                            <option title="Madhulika Mishra" value="6" {{ $data->cro_vendor == '6' ? 'selected' : '' }}>
                                                Madhulika Mishra
                                            </option>
                                            <option title="Jim Kim" value="7" {{ $data->cro_vendor == '7' ? 'selected' : '' }}>
                                                Jim Kim
                                            </option>
                                            <option title="Akash Asthana" value="8" {{ $data->cro_vendor == '8' ? 'selected' : '' }}>
                                                Akash Asthana
                                            </option>
                                            <option title="Not Applicable" value="9" {{ $data->cro_vendor == '9' ? 'selected' : '' }}>
                                                Not Applicable
                                            </option>
                                            {{-- @foreach ($users as $value)
                                            <option {{ $data->cro_vendor == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach --}}
                                        {{-- </select>
                                    </div>
                                </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="action-plan-grid">
                                                <div class="sub-head">Action Plan @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif
                                                    <button type="button" name="action-plan-grid"
                                                        id="observation_table" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </div>
                                                </label>
                                                <table class="table table-bordered" id="observation">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 20px;">Sr.No.</th>
                                                            <th>Action</th>
                                                            <th>Responsible</th>
                                                            <th>Target Completion Date</th>
                                                            <th>Action Status</th>
                                                            <th style="width: 15%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (unserialize($griddata->action) as $key => $temps)
                                                            <tr>
                                                                <!-- <td><input type="text" name="serial_number[]" value="{{ $key + 1 }}"></td> -->
                                                                <td><input disabled type="text" name="serial_number[]"
                                                                        value="{{ $key + 1 }}">
                                                                </td>
                                                                <td>
                                                                    <textarea name="action[]" 
                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ unserialize($griddata->action)[$key] ?? '' }}</textarea>
                                                                </td>

                                                                {{-- <td><input type="text" name="responsible[]" value="{{unserialize($griddata->responsible)[$key] ? unserialize($griddata->responsible)[$key] : "" }}"></td> --}}
                                                                <td> <select id="select-state" placeholder="Select..."
                                                                        name="responsible[]"
                                                                         {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>

                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $value)
                                                                            <option
                                                                                @if ($griddata && unserialize($griddata->responsible)[$key]) {{ unserialize($griddata->responsible)[$key] == $value->id ? 'selected' : '' }} @endif
                                                                                value="{{ $value->id }}">
                                                                                {{ $value->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select></td>
                                                                <td>
                                                                    <div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date ">
                                                                            <div class="calenderauditee">

                                                                                <input type="text"
                                                                                    id="deadline{{ $key }}' + serialNumber +'"
                                                                                    readonly placeholder="DD-MMM-YYYY"
                                                                                    value="{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}"
                                                                                    oninput="handleDateInput(this, `deadline' + serialNumber +'`)" />
                                                                                <input type="date"
                                                                                    value="{{ unserialize($griddata->deadline)[$key] }}"
                                                                                    name="deadline[]"
                                                                                     {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                    value="{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}"
                                                                                    class="hide-input"
                                                                                    oninput="handleDateInput(this, `deadline{{ $key }}' + serialNumber +'`)" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <!-- <td>
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date ">
                                                                        <div class="calenderauditee">
                                                                            {{-- <input type="text" id="deadline' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /> --}}
                                                                            <input type="date" name="deadline[]" class="hide-input"
                                                                            oninput="handleDateInput(this, `deadline' + serialNumber +'`)" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>  -->
                                                                {{-- <td><input type="text" name="deadline[]"{{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{unserialize($griddata->deadline)[$key] ? unserialize($griddata->deadline)[$key] : "" }}"></td> --}}
                                                                {{-- <td><input type="text" name="item_status[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{unserialize($griddata->item_status)[$key] ? unserialize($griddata->item_status)[$key] : "" }}"></td>  --}}
                                                                <td>
                                                                    <textarea name="item_status[]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ unserialize($griddata->item_status)[$key] ?? '' }}</textarea>
                                                                </td>


                                                                {{-- <td>
                                                                @php
                                                                $item_status = unserialize($griddata->item_status);
                                                                $value = isset($item_status[$key]) ? $item_status[$key] : '';
                                                                @endphp
                                                                <input type="text" name="item_status[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $value }}">
                                                            </td> --}}
                                                                <td><button type="text"
                                                                    class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Remove</button></td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="comments">Comments
                                                    @if ($data->stage == 2)
                                                      <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <textarea name="comments"  {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>{{ $data->comments }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Attachments">Response and CAPA Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="response_capa_attach">
                                                        @if ($data->response_capa_attach)
                                                            @foreach(json_decode($data->response_capa_attach) as $file)
                                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    <input type="hidden" name="existing_response_capa_attach[]" value="{{ $file }}">
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="response_capa_attach[]" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }} oninput="addMultipleFiles(this, 'response_capa_attach')" multiple>
                                                    </div>
                                        </div>
                                    </div>
                                </div>



                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>



                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Action Summary</div>
                                        </div>

                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="actual_start_date">Actual Action Start Date @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif

                                                </label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="actual_start_date"
                                                        placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->actual_start_date) }}" />
                                                    <input type="date"
                                                        value="{{ $data->actual_start_date }}"
                                                        id="actual_start_date_checkdate"
                                                        {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                        name="actual_start_date" class="hide-input"
                                                        oninput="handleDateInput(this, 'actual_start_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6  new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="actual_end_date">Actual Action End Date @if ($data->stage == 2)
                                                        <span class="text-danger">*</span>
                                                        @endif
                                                </label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="actual_end_date"
                                                            placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->actual_end_date) }}" />
                                                        <input type="date"
                                                            value="{{ $data->actual_end_date }}"
                                                            id="actual_end_date_checkdate"
                                                            {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                            name="actual_end_date" class="hide-input"
                                                            oninput="handleDateInput(this, 'actual_end_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                                    </div>


                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="action_taken">Action Taken @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif

                                                </label>
                                                <textarea name="action_taken" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }} class="summernote" id="summernote">{{ $data->action_taken }}</textarea>
                                            </div>
                                        </div>

                                        
                                        <div class="col-12">
                                            <div class="sub-head">Response Summary</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="response_summary">Response Summary @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif

                                                </label>
                                                <textarea name="response_summary" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }} class="summernote" id="summernote">{{ $data->response_summary }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="date_response_due1">Date Response Due</label>
                                        <div class="calenderauditee">
                                            <input type="text"  id="date_response_due1"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->date_response_due1) }}"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}/>
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                            oninput="handleDateInput(this, 'date_response_due1')" />

                                        </div>
                                    </div>
                                </div> --}}
                                        {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="response_date">Date of Response</label>
                                        <input type="date" name="response_date" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->response_date }}">
                                    </div>
                                </div> --}}



                                        {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="response_date">Date of Response</label>
                                        <div class="calenderauditee">
                                            <input type="text"  id="response_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->response_date) }}"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}/>
                                        </div>
                                    </div>
                                </div> --}}
                                        {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="attach_files">Attached Files</label>
                                        <input type="file" name="attach_files2" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->attach_files2 }}">
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                            <div class="group-input">
                                                <label for="Attachments">Response and Summary Attachment @if ($data->stage == 2)
                                                    <span class="text-danger">*</span>
                                                    @endif

                                                </label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="impact_analysis">
                                                        @if ($data->impact_analysis)
                                                            @foreach(json_decode($data->impact_analysis) as $file)
                                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    <input type="hidden" name="existing_impact_analysis[]" value="{{ $file }}">
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="impact_analysis[]" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'disabled' : '' }} oninput="addMultipleFiles(this, 'impact_analysis')" multiple>
                                                    </div>
                                        </div>
                                    </div>
                                </div>


                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="related_url">Related URL</label>
                                                <input type="text" name="related_url"
                                                     {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    value="{{ $data->related_url }}">
                                            </div>
                                        </div> --}}

                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">

                                    <div class="col-12">
                                            <div class="sub-head">Report Issued</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Comment">Report Issued By</label>
                                                @if ($data->report_issued_by)
                                                <div class="static">{{ $data->report_issued_by }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Comment">Report Issued On</label>
                                                @if ($data->report_issued_on)
                                                <div class="static">{{ $data->report_issued_on }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Comment">Report Issued Comment</label>
                                                @if ($data->report_issued_comment)
                                                <div class="static">{{ $data->report_issued_comment }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel By">Cancel By</label>
                                                @if ($data->cancel_by)
                                                <div class="static">{{ $data->cancel_by }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel On">Cancel On</label>
                                                @if ($data->cancel_on)
                                                <div class="static">{{ $data->cancel_on }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">Cancel Comment</label>
                                                @if ($data->cancel_comment)
                                                <div class="static">{{ $data->cancel_comment }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        @if ($data->more_info_required_by)
                                        <div class="col-12">
                                            <div class="sub-head">More Info Required</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="More Info Required By">More Info Required By</label>
                                                @if ($data->more_info_required_by)
                                                <div class="static">{{ $data->more_info_required_by }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="More Info Required On">More Info Required On</label>
                                                @if ($data->more_info_required_on)
                                                <div class="static">{{ $data->more_info_required_on }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">More Info Required Comment</label>
                                                @if ($data->more_info_required_comment)
                                                <div class="static">{{ $data->more_info_required_comment }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        

                                        

                                        <div class="col-12">
                                            <div class="sub-head">CAPA Plan Proposed</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Reject CAPA Plan By">CAPA Plan Proposed By</label>
                                                @if ($data->complete_By)
                                                <div class="static">{{ $data->complete_By }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="CAPA Plan Proposed On">CAPA Plan Proposed On</label>
                                                @if ($data->complete_on)
                                                <div class="static">{{ $data->complete_on }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">CAPA Plan Proposed Comment</label>
                                                @if ($data->complete_comment)
                                                <div class="static">{{ $data->complete_comment }}</div>
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">No CAPA's Required</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA Approval Without CAPA By">No CAPA's Required
                                                    By</label>
                                                    @if ($data->qa_approval_without_capa_by)
                                                    <div class="static">{{ $data->qa_approval_without_capa_by }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="No CAPA's Required On">No CAPA's Required
                                                    On</label>
                                                    @if ($data->qa_approval_without_capa_on)
                                                    <div class="static">{{ $data->qa_approval_without_capa_on }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">No CAPA's Required Comment</label>
                                                    @if ($data->qa_approval_without_capa_comment)
                                                    <div class="static">{{ $data->qa_approval_without_capa_comment }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">Response Reviewed</div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA Approval On">Response Reviewed By</label>
                                                    @if ($data->Final_Approval_by)
                                                    <div class="static">{{ $data->Final_Approval_by }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                <!-- <div class="static">{{ $data->Final_Approval_By }}</div> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Response Reviewed By">Response Reviewed On</label>
                                                    @if ($data->Final_Approval_on)
                                                    <div class="static">{{ $data->Final_Approval_on }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">Response Reviewed Comment</label>
                                                    @if ($data->Final_Approval_comment)
                                                    <div class="static">{{ $data->Final_Approval_comment }}</div>
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="button-block">
                                        <!-- <button type="submit" class="saveButton"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button> -->
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <!-- <button type="submit"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Submit</button> -->
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Response Verification</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="impact">Response Verification Comment  @if($data->stage == 3)<span class="text-danger">*</span>@endif</label>
                                                <textarea name="impact" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->impact }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="attach_files2">Response Verification Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="attach_files2">
                                                        @if ($data->attach_files2)
                                                            @foreach (json_decode($data->attach_files2) as $file)
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
                                                         {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 ? 'disabled' : '' }}
                                                            value="{{ $data->attach_files2 }}" type="file"
                                                            id="myfile" name="attach_files2[]"
                                                            oninput="addMultipleFiles(this, 'attach_files2')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                             {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>
            </div>


            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('extension_child', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="Observation">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <input type="radio" name="child_type" value="extension">
                                        extension
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
            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('observation_change_stage', $data->id) }}" method="POST" class="signatureModalFormloder">
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
                                <input type="hidden" name="capaNotReq" id="capaNotReq" value="Yes">
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
            <div class="modal fade" id="capa-rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('observation_change_stage', $data->id) }}" method="POST">
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
                                    <input class="observation_style" type="text" name="username" required>
                                </div>
                                <input type="hidden" name="capaNotReq" id="capaNotReq" value="No">
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input class="observation_style" type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input class="observation_style" type="comment" name="comment">
                                </div>
                                {{-- <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="hidden" name="comment">
                                </div> --}}
                            </div>

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

                        <form action="{{ route('RejectStateChangeObservation', $data->id) }}" method="POST">
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
                                <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancel-model">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('observation_cancel-model', $data->id) }}" method="POST">
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
                                    <input class="observation_style" type="text" name="username" required>
                                </div>
                                <input type="hidden" name="capaNotReq" id="capaNotReq" value="No">
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input class="observation_style" type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input class="observation_style" type="comment" required name="comment">
                                </div>
                                {{-- <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="hidden" name="comment">
                                </div> --}}
                            </div>

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
            {{-- <div class="modal fade" id="rejection-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('updatestageobservation', $data->id) }}" method="POST">
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
                                <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}

            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('observation_child', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="revision" id="capa-child" value="capa-child">
                                        CAPA
                                    </label>
                                </div>
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="revision" value="Action-Item">
                                        Action Item
                                    </label>
                                </div>
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="revision" value="RCA">
                                        RCA
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
                .observation_style{
                    width: 100%;
                    border-radius: 5px;
                    margin-bottom: 10px;
                }
            </style>

            <script>
                VirtualSelect.init({
                    ele: '#Facility, #Group, #Audit, #Auditee'
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
            {{-- <script>

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


            </script> --}}

            <script>
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

//   $('.summernote').summernote({
//     toolbar: [
//         ['style', ['style']],
//         ['font', ['bold', 'underline', 'clear', 'italic']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//         ['table', ['table']],
//         ['insert', ['link', 'picture', 'video']],
//         ['view', ['fullscreen', 'codeview', 'help']]
//     ],
    //     callbacks: {
    //         onPaste: function (e) {
    //             let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');

    //             bufferText = bufferText.replace(/<table/g, '<table border="1"');

    //             setTimeout(function () {
    //                 $('.summernote').summernote('pasteHTML', bufferText);
    //             }, 10);
                
    //             e.preventDefault();
    //         }
    //     }
    // });
     var stage = @json($data->stage); // PHP se JS me stage bhejna

    if (stage != 2) {
        $('.summernote').summernote('disable');  // non-editable
    } else {
        $('.summernote').summernote('enable');   // editable
    }

  </script>

    {{-- <script>
         var editor = new FroalaEditor('.summernote', {
            key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
            imageUploadParam: 'image_param',
            imageUploadMethod: 'POST',
            imageMaxSize: 20 * 1024 * 1024,
            imageUploadURL: "{{ secure_url('api/upload-files') }}",
            fileUploadParam: 'image_param',
            fileUploadURL: "{{ secure_url('api/upload-files')}}",
            videoUploadParam: 'image_param',
            videoUploadURL: "{{ secure_url('api/upload-files') }}",
            videoMaxSize: 500 * 1024 * 1024,
         });
         
        $(".summernote-disabled").FroalaEditor("edit.off");
    </script> --}}

    
    <style>
        #isPasted td:first-child, #isPasted th:first-child{
        
        width: 33%;

        }
        /* code for powered By Flora hidding  */
        #fr-logo{
            display: none;
        }

    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
                // var signatureForm = document.getElementById('signatureModalFormloder');
              var signatureForm = document.querySelector('.signatureModalFormloder'); // <-- class use kiya

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });
    </script>


        @endsection
