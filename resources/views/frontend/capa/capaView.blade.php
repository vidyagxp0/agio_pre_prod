@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
        .remove-file  {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }
    </style>


    <script>
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

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }}/ CAPA
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
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                       @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white" href="{{ url('CapaAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Propose Plan
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve Plan
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                              QA More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                            <button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve

                            </button>
                            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> -->
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                Reject
                            </button>
                        @elseif($data->stage == 5)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Actions Completed
                            </button>
                        @elseif($data->stage == 6)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
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
                                <div class="active">Pending CAPA Plan </div>
                            @else
                                <div class="">Pending CAPA Plan</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">CAPA In Progress</div>
                            @else
                                <div class="">CAPA In Progress</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">QA Review</div>
                            @else
                                <div class="">QA Review</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">Pending Actions Completion</div>
                            @else
                                <div class="">Pending Actions Completion</div>
                            @endif
                            @if ($data->stage >= 6)
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

            {{-- ======================================
                    DATA FIELDS
            ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Project/Study</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Additional Information</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Group Comments</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CAPA Closure</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
                    </div>

                    <form action="{{ route('capaUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <!-- General information content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number">Record Number</label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number->record_number, 4, "0", STR_PAD_LEFT ) : '1' }}">
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Site/Location Code</label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator">Initiator</label>
                                                <input disabled type="text" name="initiator_id"
                                                    value="{{ $data->initiator_name }}">
                                                {{-- <div class="static"> </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="group-input ">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                            <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} >
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                @if (!empty($revised_date))
                                                <input readonly type="text"
                                                value="{{ Helpers::getdateFormat($revised_date) }}">
                                                @else
                                                <input disabled type="text"
                                                value="{{ Helpers::getdateFormat($data->due_date) }}">
                                                @endif

                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        {{-- <input type="text" value="{{ $data->due_date }}" name="due_date"> --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}

                                    </div>
                                </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiator Group</label>
                                                <select name="initiator_Group" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                    <option value="CQA"
                                                        @if ($data->initiator_Group== 'CQA') selected @endif>Corporate
                                                        Quality Assurance</option>
                                                    <option value="QAB"
                                                        @if ($data->initiator_Group== 'QAB') selected @endif>Quality
                                                        Assurance Biopharma</option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_Group== 'CQC') selected @endif>Central
                                                        Quality Control</option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_Group== 'CQC') selected @endif>Manufacturing
                                                    </option>
                                                    <option value="PSG"
                                                        @if ($data->initiator_Group== 'PSG') selected @endif>Plasma
                                                        Sourcing Group</option>
                                                    <option value="CS"
                                                        @if ($data->initiator_Group== 'CS') selected @endif>Central
                                                        Stores</option>
                                                    <option value="ITG"
                                                        @if ($data->initiator_Group== 'ITG') selected @endif>Information
                                                        Technology Group</option>
                                                    <option value="MM"
                                                        @if ($data->initiator_Group== 'MM') selected @endif>Molecular
                                                        Medicine</option>
                                                    <option value="CL"
                                                        @if ($data->initiator_Group== 'CL') selected @endif>Central
                                                        Laboratory</option>
                                                    <option value="TT"
                                                        @if ($data->initiator_Group== 'TT') selected @endif>Tech
                                                        Team</option>
                                                    <option value="QA"
                                                        @if ($data->initiator_Group== 'QA') selected @endif>Quality
                                                        Assurance</option>
                                                    <option value="QM"
                                                        @if ($data->initiator_Group== 'QM') selected @endif>Quality
                                                        Management</option>
                                                    <option value="IA"
                                                        @if ($data->initiator_Group== 'IA') selected @endif>IT
                                                        Administration</option>
                                                    <option value="ACC"
                                                        @if ($data->initiator_Group== 'ACC') selected @endif>Accounting
                                                    </option>
                                                    <option value="LOG"
                                                        @if ($data->initiator_Group== 'LOG') selected @endif>Logistics
                                                    </option>
                                                    <option value="SM"
                                                        @if ($data->initiator_Group== 'SM') selected @endif>Senior
                                                        Management</option>
                                                    <option value="BA"
                                                        @if ($data->initiator_Group== 'BA') selected @endif>Business
                                                        Administration</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Group Code</label>
                                                <input readonly type="text" name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->initiator_Group}}" id="initiator_group_code"
                                                    readonly>
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                                <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining

                                                <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="severity_level_form">
                                                    <option  value="0">-- Select --</option>
                                                    <option @if ($data->severity_level_form=='minor') selected @endif value="minor">Minor</option>
                                                    <option @if ($data->severity_level_form=='major') selected @endif value="major">Major</option>
                                                    <option @if ($data->severity_level_form=='critical') selected @endif value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select name="initiated_through"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->initiated_through == 'internal_audit') selected @endif
                                                        value="internal_audit">Internal Audit</option>
                                                        <option @if ($data->initiated_through == 'external_audit') selected @endif
                                                        value="external_audit">External Audit</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">Return</option>
                                                    <option @if ($data->initiated_through == 'deviation') selected @endif
                                                        value="deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'complaint') selected @endif
                                                        value="complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'regulatory') selected @endif
                                                        value="regulatory">Regulatory</option>
                                                    <option @if ($data->initiated_through == 'lab-incident') selected @endif
                                                        value="lab-incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'improvement') selected @endif
                                                        value="improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'others') selected @endif
                                                        value="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="initiated_through">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="initiated_through_req"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> {{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
                                                <select name="repeat"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'Yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->repeat == 'Yes') selected @endif
                                                        value="Yes">Yes</option>
                                                    <option @if ($data->repeat == 'No') selected @endif
                                                        value="No">No</option>
                                                    <option @if ($data->repeat == 'NA') selected @endif
                                                        value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="repeat_nature"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Problem Description">Problem Description</label>
                                                <textarea name="problem_description"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->problem_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Team">CAPA Team</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    multiple id="Audit" placeholder="Select..." name="capa_team[]">
                                                    @foreach ($users as $value)
                                                        <!-- <option {{ $data->capa_team == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option> -->
                                                        <option value="{{ $value->id }}"{{ in_array($value->id, explode(',', $data->capa_team)) ? 'selected' : '' }}>
                                                                   {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Records">Reference Records</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    multiple id="capa_related_record" name="capa_related_record[]"
                                                    id="">
                                                    @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}"{{ in_array($new->id, explode(',', $data->capa_related_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Initial Observation">Initial Observation</label>

                                                <textarea name="initial_observation" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->initial_observation }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Interim Containnment</label>
                                                <select name="interim_containnment"
                                                    onchange="otherController(this.value, 'required', 'containment_comments')"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'required' ? 'selected' : '' }}
                                                        value="required">Required</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'not-required' ? 'selected' : '' }}
                                                        value="not-required">Not Required</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="containment_comments">
                                                <label for="Containment Comments">
                                                    Containment Comments <span class="text-danger d-none">*</span>
                                                </label>
                                                <textarea name="containment_comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->containment_comments }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Attachments">CAPA Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="capa_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="capa_attachment">

                                                        {{-- @if (is_array($data->capa_attachment)) --}}
                                                        @if ($data->capa_attachment)
                                                            @foreach (json_decode($data->capa_attachment) as $file)
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
                                                        {{-- @endif --}}
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="capa_attachment[]"
                                                            oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA QA Comments">CAPA QA Comments</label>
                                                <textarea name="capa_qa_comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->capa_qa_comments }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Information content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        {{-- <div class="col-12 sub-head">
                                            Product Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Product Details">
                                                    Product Details<button type="button" name="ann"
                                                    id="product"
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="product_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Product Name</th>
                                                            <th>Batch No./Lot No./AR No.</th>
                                                            <th>Manufacturing Date</th>
                                                            <th>Date Of Expiry</th>
                                                            <th>Batch Disposition Decision</th>
                                                            <th>Remark</th>
                                                            <th>Batch Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                        @if ($data1->product_name)
                                                        @foreach (unserialize($data1->product_name) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"
                                                                    value="{{ $key + 1 }}"></td>
                                                            <td><input type="text" name="product_name[]"
                                                                    value="{{ unserialize($data1->product_name)[$key] ? unserialize($data1->product_name)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_no[]"
                                                                    value="{{ unserialize($data1->batch_no)[$key] ? unserialize($data1->batch_no)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="mfg_date[]"
                                                                    value="{{ unserialize($data1->mfg_date)[$key] ? unserialize($data1->mfg_date)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="expiry_date[]"
                                                                    value="{{ unserialize($data1->expiry_date)[$key] ? unserialize($data1->expiry_date)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_desposition[]"
                                                                    value="{{ unserialize($data1->batch_desposition)[$key] ? unserialize($data1->batch_desposition)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="remark[]"
                                                                    value="{{ unserialize($data1->remark)[$key] ? unserialize($data1->remark)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_status[]"
                                                                    value="{{ unserialize($data1->batch_status)[$key] ? unserialize($data1->batch_status)[$key] : '' }}">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 sub-head">
                                            Material Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Material Details<button type="button" name="ann" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                    id="material">+</button>
                                                </label>
                                                <table class="table table-bordered" id="material_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Material Name</th>
                                                            <th>Batch No./Lot No./AR No.</th>
                                                            <th>Manufacturing Date</th>
                                                            <th>Date Of Expiry</th>
                                                            <th>Batch Disposition Decision</th>
                                                            <th>Remark</th>
                                                            <th>Batch Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data2->material_name)
                                                        @foreach (unserialize($data2->material_name) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ $key + 1 }}"></td>
                                                            <!-- {{-- <td><input type="text" name="product_name[]"
                                                                    value="{{ unserialize($data2->material_name)[$key] ? unserialize($data2->material_name)[$key] : '' }}">
                                                            </td> --}} -->
                                                            <td><input type="text" name="material_name[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                value="{{ unserialize($data2->material_name)[$key] ? unserialize($data2->material_name)[$key] : '' }}">
                                                        </td>
                                                            <td><input type="text" name="material_batch_no[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_batch_no)[$key] ? unserialize($data2->material_batch_no)[$key] : '' }}">
                                                            </td>
                                                            <!-- {{-- <td><input type="text" name="material_mfg_date[]"
                                                                    value="{{ unserialize($data2->material_mfg_date)[$key] ? unserialize($data2->material_mfg_date)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="material_expiry_date[]"
                                                                    value="{{ unserialize($data2->material_expiry_date)[$key] ? unserialize($data2->material_expiry_date)[$key] : '' }}">
                                                            </td> --}} -->
                                                            <!-- <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date "><div
                                                                 class="calenderauditee">
                                                                <input type="text" id="material_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}  value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}" />
                                                                <input type="date" name="material_mfg_date[]" value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}" class="hide-input"
                                                                oninput="handleDateInput(this, `material_mfg_date' + serialNumber +'`)" /></div></div></div></td> -->

                                                                <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date ">
                                                              <div class="calenderauditee">
                                                                <input type="text"   id="material_mfg_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}"/>
                                                                <input type="date"  id="material_mfg_date{{$key}}_checkdate" value="{{unserialize($data2->material_mfg_date)[$key]}}"  name="material_mfg_date[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}
                                                                "class="hide-input"
                                                                oninput="handleDateInput(this, `material_mfg_date{{$key}}`);checkDate('material_mfg_date{{$key}}_checkdate','material_expiry_date{{$key}}_checkdate')"  /></div></div></div></td>

                                                                <!-- <td><div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date "><div
                                                                     class="calenderauditee">
                                                                    <input type="text" id="material_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}  value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}" />
                                                                    <input type="date" name="material_expiry_date[]" value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}" class="hide-input"
                                                                    oninput="handleDateInput(this, `material_expiry_date' + serialNumber +'`)" /></div></div></div></td> -->
                                                                    <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date ">
                                                                    <div class="calenderauditee">
                                                                <input type="text"   id="material_expiry_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}" />
                                                                <input type="date" id="material_expiry_date{{$key}}_checkdate" value="{{unserialize($data2->material_mfg_date)[$key]}}"  name="material_expiry_date[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}"class="hide-input"
                                                                oninput="handleDateInput(this, `material_expiry_date{{$key}}`);checkDate('material_mfg_date{{$key}}_checkdate','material_expiry_date{{$key}}_checkdate')"  /></div></div></div></td>

                                                            <td><input type="text" name="material_batch_desposition[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_batch_desposition)[$key] ? unserialize($data2->material_batch_desposition)[$key] : '' }}">
                                                            </td>
                                                             <td><input type="text" name="material_remark[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_remark)[$key] ? unserialize($data2->material_remark)[$key] : '' }}">
                                                            </td>
                                                             <!-- <td><input type="text" id="batch_status" name="material_batch_status[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_batch_status)[$key] ? unserialize($data2->material_batch_status)[$key] : '' }}">
                                                            </td>  -->
                                                            <!-- <td>
                                                               <select id="batch_status"
                                                                   name="material_batch_status[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}

                                                               <option value="">-- Select value --</option>
                                                                  <option value="Hold">Hold</option>
                                                                  <option value="Release">Release</option>
                                                                <option value="quarantine">Quarantine</option>
                                                                value="{{ unserialize($data2->material_batch_status)[$key] ? unserialize($data2->material_batch_status)[$key] : '' }}" >
                                                            </select>
                                                        </td> -->
                                                        <td>
                                                            <select id="batch_status" name="material_batch_status[]"{{ $data->stage == 0 || $data->stage == 6 ? ' disabled' : '' }}>
                                                                <option value="">-- Select value --</option>
                                                                <option value="Hold"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'Hold' ? ' selected' : '' }}>Hold</option>
                                                                <option value="Release"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'Release' ? ' selected' : '' }}>Release</option>
                                                                <option value="quarantine"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'quarantine' ? ' selected' : '' }}>Quarantine</option>
                                                            </select>
                                                        </td>

                                                        </tr>
                                                    @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Equipment/Instruments Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Equipment/Instruments Details<button type="button" name="ann"
                                                    id="equipment"
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="equipment_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Equipment/Instruments Name</th>
                                                            <th>Equipment/Instruments ID</th>
                                                            <th>Equipment/Instruments Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data3->equipment)
                                                        @foreach (unserialize($data3->equipment) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ $key + 1 }}"></td>

                                                            <td><input type="text" name="equipment[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment)[$key] ? unserialize($data3->equipment)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="equipment_instruments[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment_instruments)[$key] ? unserialize($data3->equipment_instruments)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="equipment_comments[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment_comments)[$key] ? unserialize($data3->equipment_comments)[$key] : '' }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                        @endif


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Other type CAPA Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Details">Details</label>
                                                <input type="text" name="details_new"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->details_new }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments"> CAPA QA Comments </label>
                                                <textarea name="capa_qa_comments2" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->capa_qa_comments2 }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Study content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Project Datails Application">Project Datails
                                                    Application</label>
                                                <select name="project_details_application"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option
                                                        {{ $data->project_details_application == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option
                                                        {{ $data->project_details_application == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Protocol/Study Number">Initiator Group</label>
                                                <select name="initiator_group"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="CQA"
                                                        @if ($data->initiator_group== 'CQA') selected @endif>Corporate
                                                        Quality
                                                        Assurance
                                                    </option>
                                                    <option value="QAB"
                                                        @if ($data->initiator_group== 'QAB') selected @endif>Quality
                                                        Assurance
                                                        Biopharma
                                                    </option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_group== 'CQC') selected @endif>Central Quality
                                                        Control
                                                    </option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_group== 'CQC') selected @endif>Manufacturing
                                                    </option>
                                                    <option value="PSG"
                                                        @if ($data->initiator_group== 'PSG') selected @endif>Plasma Sourcing
                                                        Group
                                                    </option>
                                                    <option value="CS"
                                                        @if ($data->initiator_group== 'CS') selected @endif>Central Stores
                                                    </option>
                                                    <option value="ITG"
                                                        @if ($data->initiator_group== 'ITG') selected @endif>Information
                                                        Technology Group
                                                    </option>
                                                    <option value="MM"
                                                        @if ($data->initiator_group== 'MM') selected @endif>Molecular
                                                        Medicine
                                                    </option>
                                                    <option value="CL"
                                                        @if ($data->initiator_group== 'CL') selected @endif>Central
                                                        Laboratory
                                                    </option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Site Number">Site Number</label>
                                                <input type="text" name="site_number"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->site_number }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Subject Number">Subject Number</label>
                                                <input type="text" name="subject_number"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->subject_number }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Subject Initials">Subject Initials</label>
                                                <input type="text" name="subject_initials"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->subject_initials }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Sponsor">Sponsor</label>
                                                <input type="text" name="sponsor"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->sponsor }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="General Deviation">General Deviation</label>
                                                <textarea name="general_deviation" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->general_deviation }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                              <div id="CCForm8" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="sub-head">
                                        CFT Information
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Microbiology">CFT Reviewer</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="Microbiology_new">
                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->Microbiology_new=='yes') selected @endif value="yes" selected>Yes</option>
                                                    <option @if ($data->Microbiology_new=='no') selected @endif value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Microbiology-Person">CFT Reviewer Person</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  name="Microbiology_Person[]"
                                                    placeholder="Select CFT Reviewers" data-search="false"
                                                    data-silent-initial-value-set="true" id="cft_reviewer">
                                                    <option value="0">-- Select --</option>
                                                    @foreach ($cft as $data)
                                                        <option value="{{ $data->id }}" selected>
                                                            {{ $data->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>


                                     </div>
                                    <div class="sub-head">
                                        Concerned Information
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="group_review">Is Concerned Group Review Required?</label>
                                                <select name="goup_review"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option {{$data->goup_review == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->goup_review == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production">Production</label>
                                                <select name="Production_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option {{ $data->Production_new== 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->Production_new== 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production-Person">Production Person</label>
                                                <select name="Production_Person"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    @foreach ($users as $datas)
                                                        <option
                                                            {{ $data->Production_Person == $datas->id ? 'selected' : '' }}
                                                            value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quality-Approver">Quality Approver</label>
                                                <select name="Quality_Approver"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option {{ $data->Quality_Approver == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->Quality_Approver == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quality-Approver-Person">Quality Approver Person</label>
                                                <select name="Quality_Approver_Person"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>

                                                    @foreach ($users as $datas)
                                                        <option
                                                            {{ $data->Quality_Approver_Person== $datas->id ? 'selected' : '' }}
                                                            value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="bd_domestic">Others</label>
                                                <select name="bd_domestic"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option {{ $data->bd_domestic == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->bd_domestic == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="bd_domestic-Person">Others Person</label>
                                                <select name="Bd_Person"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>

                                                    @foreach ($users as $datas)
                                                        <option {{ $data->Bd_Person == $datas->id ? 'selected' : '' }}
                                                            value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                          <div class="col-12">
                                            <div class="group-input">
                                                <label for="Additional Attachments">Additional Attachments</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="additional_attachments">
                                                        {{-- @if (is_array($data->additional_attachments)) --}}
                                                        @if ($data->additional_attachments)
                                                           @foreach(json_decode($data->additional_attachments) as $file)
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
                                                        <input type="file" id="myfile"
                                                            name="additional_attachments[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'additional_attachments')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton"
                                            onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>
                               <!-- Group Commentes-->
                             <div id="CCForm7" class="inner-block cctabcontent">
                                <div class="inner-block-content">

                                    <div class="sub-head">
                                        CFT Feedback
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="comments">CFT Comments</label>
                                                <textarea name="cft_comments_form"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->cft_comments_form}}</textarea>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="comments">CFT Attachment</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="cft_attchament_new">
                                                        {{-- @if (is_array($data->cft_attchament_new)) --}}
                                                                 @if ($data->cft_attchament_new)
                                                                     @foreach (json_decode($data->cft_attchament_new) as $file)
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
                                                        <input type="file" id="myfile" name="cft_attchament_new[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'cft_attchament_new')"
                                                            multiple>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="sub-head">
                                            Concerned Group Feedback
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">QA Comments</label>
                                                <textarea name="qa_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->qa_comments_new}}
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">QA Head Designee Comments</label>
                                                <textarea name="designee_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->designee_comments_new}}
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Warehouse Comments</label>
                                                <textarea name="Warehouse_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Warehouse_comments_new}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Engineering Comments</label>
                                                <textarea name="Engineering_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Engineering_comments_new}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Instrumentation Comments</label>
                                                <textarea name="Instrumentation_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Instrumentation_comments_new}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Validation Comments</label>
                                                <textarea name="Validation_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Validation_comments_new}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Others Comments</label>
                                                <textarea name="Others_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Others_comments_new}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="comments">Group Comments</label>
                                                <textarea name="Group_comments_new"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Group_comments_new}}</textarea>
                                            </div>
                                        </div>

                                         <div class="col-12">

                                            <div class="group-input">
                                                <label for="group-attachments">Group Attachments</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="group_attachments_new">

                                                        {{-- @if (is_array($data->group_attachments_new)) --}}
                                                        @if ($data->group_attachments_new)
                                                             @foreach (json_decode($data->group_attachments_new) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file}}</b>
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
                                                        <input type="file" id="myfile"
                                                            name="group_attachments_new[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'group_attachments_new')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton"
                                            onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!-- CAPA Details content -->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="search">
                                            CAPA Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="capa_type"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            <option value="">Select a value</option>
                                            <option {{ $data->capa_type == "Corrective Action" ? 'selected' : '' }} value="Corrective Action">Corrective Action</option>
                                            <option {{ $data->capa_type == "Preventive Action" ? 'selected' : '' }} value="Preventive Action">Preventive Action</option>
                                            <option {{ $data->capa_type == "Corrective & Preventive Action"  ? 'selected' : '' }} value="Corrective & Preventive Action">Corrective & Preventive Action</option>

                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Corrective Action">Corrective Action</label>
                                                <textarea name="corrective_action" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->corrective_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Preventive Action">Preventive Action</label>
                                                <textarea name="preventive_action" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->preventive_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Supervisor Review Comments">Supervisor Review
                                                    Comments</label>
                                                <textarea name="supervisor_review_comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->supervisor_review_comments }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- CAPA Closure content -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="QA Review & Closure">QA Review & Closure</label>
                                                <textarea name="qa_review" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->qa_review }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">Closure Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="closure_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="closure_attachment1">
                                                        @if ($data->closure_attachment)
                                                            @foreach (json_decode($data->closure_attachment) as $file)
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
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="closure_attachment[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'closure_attachment1')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- <div class="col-12 sub-head">
                                    Effectiveness Check Details -->
                                </div>
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Effectiveness Check required">Effectiveness Check
                                                    required</label>
                                                <select name="effect_check"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->effect_check == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->effect_check == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect.Check Creation Date">Effect.Check Creation
                                                    Date</label>
                                                <input type="date" name="effect_check_date"
                                                    value="{{ $data->effect_check_date }}">
                                                    <div class="calenderauditee">
                                                        <input type="text"  value="{{ $data->effect_check_date }}" id="effect_check_date"  readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="effect_check_date" value=""
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'effect_check_date')"/>
                                                    </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect Check Creation Date">Effectiveness Check Creation Date</label>
                                                {{-- <input type="date" name="effect_check_date"> --}}
                                                <div class="calenderauditee">
                                                    <input type="text"  id="effect_check_date" readonly
                                                        placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->effect_check_date) }}"/>
                                                    <input type="date" name="effect_check_date" value=""class="hide-input"
                                                        oninput="handleDateInput(this,'effect_check_date')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                <select name="Effectiveness_checker">{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    <option value="">Enter Your Selection Here</option>
                                                    @foreach ($users as $value)
                                                        <option
                                                            {{ $data->Effectiveness_checker == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                <textarea name="effective_check_plan"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> {{ $data->effective_check_plan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div> -->
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->
                            <div id="CCForm6" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Proposed By">Plan Proposed By</label>
                                                <input type="hidden" name="plan_proposed_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Proposed On">Plan Proposed On</label>
                                                <input type="hidden" name="plan_proposed_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Plan Approved By</label>
                                                <input type="hidden" name="plan_approved_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Approved On">Plan Approved On</label>
                                                <input type="hidden" name="plan_approved_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->Plan_approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="QA More Info Required By">QA More Info Required
                                                    By</label>
                                                <input type="hidden" name="qa_more_info_required_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">QA More Info Required
                                                    On</label>
                                                <input type="hidden" name="qa_more_info_required_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                <input type="hidden" name="cancelled_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                <input type="hidden" name="cancelled_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Completed By">Completed By</label>
                                                <input type="hidden" name="completed_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Completed On">Completed On</label>
                                                <input type="hidden" name="completed_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved By">Approved By</label>
                                                <input type="hidden" name="approved_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>

                                                <div class="static">{{ $data->approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved On">Approved On</label>
                                                <input type="hidden" name="approved_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                <input type="hidden" name="rejected_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->rejected_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                <input type="hidden" name="rejected_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->rejected_on }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button-block">
                                        <button type="submit" class="saveButton"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button> --}}
                                        <button type="submit"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Submit</button>
                                        <button type="button"> <a class="text-white"href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
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
                        <form action="{{ route('capa_effectiveness_check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="Capa">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <input type="radio" name="child_type" value="effectiveness_check">
                                        Effectiveness Check
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
            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_child_changecontrol', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    @if ($data->stage == 3)
                                        <label for="major">

                                        </label>
                                         <label for="major">
                                            <input type="radio" name="child_type" value="Change_control">
                                            Change Control
                                        </label>
                                        <label for="major">
                                            <input type="radio" name="child_type" value="Action_Item">
                                            Action Item
                                        </label>
                                        <!-- <label for="major">
                                            <input type="radio" name="child_type" value="extension">
                                            Extension
                                        </label> -->
                                    @endif

                                    @if ($data->stage == 6)
                                        <label for="major">
                                            <input type="radio" name="child_type" value="effectiveness_check">
                                            Effectiveness Check
                                        </label>
                                    @endif
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
            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_effectiveness_check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="effectiveness_check" id="major"
                                            value="Effectiveness_check">
                                        Effectiveness Check
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

            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('capa_reject', $data->id) }}" method="POST">
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

            <div class="modal fade" id="cancel-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('capaCancel', $data->id) }}" method="POST">
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
            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('capa_send_stage', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password</label>
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
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('capa_qa_more_info', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password</label>
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
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
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

            <script>
                VirtualSelect.init({
                    ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record'
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
                    document.addEventListener('DOMContentLoaded', function () {
                        const removeButtons = document.querySelectorAll('.remove-file');

                        removeButtons.forEach(button => {
                            button.addEventListener('click', function () {
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
                        $('#rchars').text(textlen);});
                </script>

        @endsection
