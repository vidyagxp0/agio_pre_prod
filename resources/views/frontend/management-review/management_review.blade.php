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

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Management Review
        </div>
    </div>

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
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('ManagementReviewAuditTrial', $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                        @elseif($data->stage == 2 && (in_array(15, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            All Actions Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
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
                                <div class="active">In Progress </div>
                            @else
                                <div class="">In Progress</div>
                            @endif
                            @if ($data->stage >= 3)
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
    </div>


    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">

        <div class="container-fluid">



            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Operational planning and control</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Meetings and summary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Signatures</button>
            </div>

            <form action="{{ route('manageUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input  disabled type="text" name="record_number"
                                            value=" {{ Helpers::getDivisionName($data->division_id) }}/MR/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_code"
                                            value=" {{ Helpers::getDivisionName($data->division_id) }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        <input type="hidden" name="initiator_id">
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" value="{{ $data->initiator_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text"
                                            value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                            name="intiation_date">
                                        {{-- <input type="hidden" value="{{ $data->intiation_date }}" name="intiation_date"> --}}

                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to"
                                            {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>
                                            <option value="">Select a value</option>
                                            @foreach ($users as $key=> $value)
                                                <option value="{{ $value->id }}"@if ($data->assign_to== $value->id) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <div><small class="text-primary">Please Mention justification if due date iscrossed</small></div>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        {{-- <input type="text" value="{{ $data->due_date }}" name="due_date"> --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b></label>
                                        <select name="initiator_Group"
                                            {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}
                                            id="initiator_group">
                                            <option value="CQA" @if ($data->initiator_Group == 'CQA') selected @endif>
                                                Corporate
                                                Quality Assurance</option>
                                            <option value="QAB" @if ($data->initiator_Group == 'QAB') selected @endif>
                                                Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if ($data->initiator_Group == 'CQC') selected @endif>
                                                Central
                                                Quality Control</option>
                                            <option value="CQC" @if ($data->initiator_Group == 'CQC') selected @endif>
                                                Manufacturing
                                            </option>
                                            <option value="PSG" @if ($data->initiator_Group == 'PSG') selected @endif>
                                                Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if ($data->initiator_Group == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if ($data->initiator_Group == 'ITG') selected @endif>
                                                Information
                                                Technology Group</option>
                                            <option value="MM" @if ($data->initiator_Group == 'MM') selected @endif>
                                                Molecular
                                                Medicine</option>
                                            <option value="CL" @if ($data->initiator_Group == 'CL') selected @endif>
                                                Central
                                                Laboratory</option>
                                            <option value="TT" @if ($data->initiator_Group == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA" @if ($data->initiator_Group == 'QA') selected @endif>
                                                Quality
                                                Assurance</option>
                                            <option value="QM" @if ($data->initiator_Group == 'QM') selected @endif>
                                                Quality
                                                Management</option>
                                            <option value="IA" @if ($data->initiator_Group == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if ($data->initiator_Group == 'ACC') selected @endif>
                                                Accounting
                                            </option>
                                            <option value="LOG" @if ($data->initiator_Group == 'LOG') selected @endif>
                                                Logistics
                                            </option>
                                            <option value="SM" @if ($data->initiator_Group == 'SM') selected @endif>
                                                Senior
                                                Management</option>
                                            <option value="BA" @if ($data->initiator_Group == 'BA') selected @endif>
                                                Business
                                                Administration</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" value="{{ $data->initiator_Group}}" id="initiator_group_code"  value="{{ $data->initiator_Group}}" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description <span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description" id="short_desc" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short_Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining
                                                
                                                <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                           
                                            <p id="docnameError" style="color:red">**Short Description is required</p>
        
                                        </div>
        
                                 </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type">Type</label>
                                        <select {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  name="type">
                                            <option value="0">-- Select type --</option>
                                            <option @if ($data->type=='Other') selected @endif value="Other">Other</option>
                                            <option @if ($data->type=='Training') selected @endif value="Training">Training</option>
                                            <option @if ($data->type=='Finance') selected @endif value="Finance">Finance</option>
                                            <option @if ($data->type=='follow Up') selected @endif value="follow Up">Follow Up</option>
                                            <option @if ($data->type=='Marketing') selected @endif value="Marketing">Marketing</option>
                                            <option @if ($data->type=='Sales') selected @endif value="Sales">Sales</option>
                                            <option @if ($data->type=='Account Service') selected @endif value="Account Service">Account Service</option>
                                            <option @if ($data->type=='Recent Product Launch') selected @endif value="Recent Product Launch">Recent Product Launch</option>
                                            <option @if ($data->type=='IT') selected @endif value="IT">IT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Priority Level">Priority Level</label>
                                        <select  {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="priority_level">
                                            <option @if ($data->priority_level=='High') selected @endif value="High">High</option>
                                            <option @if ($data->priority_level=='Medium') selected @endif value="Medium">Medium</option>
                                            <option @if ($data->priority_level=='Low') selected @endif value="Low">Low</option>
                                        </select>
                                    </div>
                                </div>
                                 {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled Start Date">Scheduled Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->start_date) }}"/>
                                            <input type="date"  id="start_date_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->start_date}} "
                                            name="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                         
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled end date">Scheduled end date</label>
                                        {{-- <input type="text" name="end_date"
                                            {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}> --}}
                                            {{-- <div class="calenderauditee">
                                                <input type="text" id="end_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->end_date) }}"/>
                                                <input type="date"  id="end_date_checkdate" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="end_date" value="{{ $data->end_date }} "
                                                class="hide-input"
                                                    oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                            </div>
                                    </div>
                                </div> --}} 
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Start Date">Scheduled Start Date</label>
                                            <div class="calenderauditee">                                     
                                                <input type="text"  id="start_date" readonly placeholder="DD-MMM-YYYY"  value="{{ Helpers::getdateFormat($data->start_date) }}"
                                                 />
                                                <input type="date" id="start_date_checkdate"  {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="start_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->start_date }}"
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')"/>
                                            </div>    
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit End Date">Scheduled end date</label>
                                            <div class="calenderauditee">                                     
                                            <input type="text"  id="end_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->end_date) }}"
                                             />
                                            <input type="date" id="end_date_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="end_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->end_date }}"
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">   
                                        <label for="Attendees">Attendess</label>
                                        <textarea name="attendees" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>{{ $data->attendees}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="agenda">
                                            Agenda<button type="button" name="agenda"   onclick="addAgendaManRev('agenda')">+</button>
                                        </label>
                                        <table class="table table-bordered" id="agenda">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Date</th>
                                                    <th>Topic</th>
                                                    <th>Responsible</th>
                                                    <th>Time Start</th>
                                                    <th>Time End</th>
                                                    <th>Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (unserialize($agenda->topic) as $key => $temps)
                                                    <tr>
                                                        <td><input type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ $key + 1 }}"></td>
                                                        
                                                                <td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee">
                                                                    <input type="text" id="date{{$key}}" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($agenda->date)[$key] ?? null) }}" />
                                                                    <input type="date" name="date[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  value="{{unserialize($agenda->date)[$key] ?? null }}" class="hide-input" 
                                                                    oninput="handleDateInput(this, `date{{$key }}`)" /></div></div></div></td>
                                                        <td><input type="text" name="topic[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($agenda->topic)[$key] ?? '' }}">
                                                        </td>
                                                        <td><input type="text" name="responsible[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($agenda->responsible)[$key] ? unserialize($agenda->responsible)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="time" name="start_time[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($agenda->start_time)[$key] ? unserialize($agenda->start_time)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="time" name="end_time[]"{{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($agenda->end_time)[$key] ? unserialize($agenda->end_time)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="comment[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($agenda->comment)[$key] ? unserialize($agenda->comment)[$key] : '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Description">Description</label>
                                        <textarea name="description" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>{{ $data->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="group-input">
                                    <label for="management_review_participants">
                                        Management Review Participants
                                        <button type="button"
                                             onclick="addManagementReviewParticipants('management_review_participants')">+</button>
                                    </label>
                                    <div class="instruction">
                                        <small class="text-primary">
                                            Refer Attached Performance Evaluation Grid
                                        </small>
                                    </div>
                                    <table class="table table-bordered" id="management_review_participants">
                                        <thead>
                                            <tr>
                                                <th>Row #</th>
                                                <th>Invited Person</th>
                                                <th>Designee</th>
                                                <th>Department</th>
                                                <th>Meeting Attended</th>
                                                <th>Designee Name</th>
                                                <th>Designee Department/Designation</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach (unserialize($management_review_participants->invited_Person) as $key => $temps)
                                                    <tr>
                                                        <td><input type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ $key + 1 }}"></td>
                                                        <td><input type="text" name="invited_Person[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->invited_Person)[$key] ? unserialize($management_review_participants->invited_Person)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="designee[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->designee)[$key] ? unserialize($management_review_participants->designee)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="department[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->department)[$key] ? unserialize($management_review_participants->department)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="meeting_Attended[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->meeting_Attended)[$key] ? unserialize($management_review_participants->meeting_Attended)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="designee_Name[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->designee_Name)[$key] ? unserialize($management_review_participants->designee_Name)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="designee_Department[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->designee_Department)[$key] ? unserialize($management_review_participants->designee_Department)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="remarks[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($management_review_participants->remarks)[$key] ? unserialize($management_review_participants->remarks)[$key] : '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">File Attachment</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="audit_file_attachment">
                                                @if ($data->inv_attachment)
                                                @foreach(json_decode($data->inv_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="audit_file_attachment" name="inv_attachment[]"
                                                    {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'audit_file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton"
                                    {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="Operations">
                                    Operations
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-operations-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="Operations" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->Operations }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="requirement_products_services">
                                    Requirements for Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-requirement_products_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="requirement_products_services"  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->requirement_products_services }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="design_development_product_services">
                                    Design and Development of Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-design_development_product_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="design_development_product_services" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->design_development_product_services }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="control_externally_provide_services">
                                    Control of Externally Provided Processes, Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-control_externally_provide_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="control_externally_provide_services"  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->control_externally_provide_services }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="production_service_provision">
                                    Production and Service Provision
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-production_service_provision-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="production_service_provision" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->production_service_provision}}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="release_product_services">
                                    Release of Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-release_product_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="release_product_services" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->release_product_services }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="control_nonconforming_outputs">
                                    Control of Non-conforming Outputs
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-control_nonconforming_outputs-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="control_nonconforming_outputs" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->control_nonconforming_outputs }}</textarea>
                            </div>
                            <div class="col-12">
                            <div class="group-input">
                                <label for="performance_evaluation">
                                    Performance Evaluation
                                    <button type="button" name="performance_evaluation"  onclick="addPerformanceEvoluation('performance_evaluation')">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-performance_evaluation-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <table class="table table-bordered" id="performance_evaluation">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Monitoring</th>
                                            <th>Measurement</th>
                                            <th>Analysis</th>
                                            <th>Evalutaion</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>
                                        <tr>
                                            <td><input type="text" name="row_no" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  value="1" disabled></td>
                                            <td><input type="text" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  name="monitoring"></td>
                                            <td><input type="text" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="measurement"></td>
                                            <td><input type="text" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  name="analysis"></td>
                                            <td><input type="text" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  name="evaluation"></td>
                                        </tr>
                                    </tbody> -->
                                    <tbody>
                                                @foreach (unserialize($performance_evaluation->monitoring) as $key => $temps)
                                                    <tr>
                                                        <td><input type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ $key + 1 }}"></td>
                                                        <td><input type="text" name="monitoring[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($performance_evaluation->monitoring)[$key] ? unserialize($performance_evaluation->monitoring)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="measurement[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($performance_evaluation->measurement)[$key] ? unserialize($performance_evaluation->measurement)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="analysis[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($performance_evaluation->analysis)[$key] ? unserialize($performance_evaluation->analysis)[$key] : '' }}">
                                                        </td>
                                                        <td><input type="text" name="evaluation[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($performance_evaluation->evaluation)[$key] ? unserialize($performance_evaluation->evaluation)[$key] : '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="risk_opportunities">Risk & Opportunities</label>
                                <textarea name="risk_opportunities" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->risk_opportunities}}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="external_supplier_performance">External Supplier Performance</label>
                                <textarea name="external_supplier_performance" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->external_supplier_performance }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="customer_satisfaction_level">Customer Satisfaction Level</label>
                                <textarea name="customer_satisfaction_level" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->customer_satisfaction_level }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="budget_estimates">Budget Estimates</label>
                                <textarea name="budget_estimates" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->budget_estimates }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="completion_of_previous_tasks">Completion of Previous Tasks</label>
                                <textarea name="completion_of_previous_tasks" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->completion_of_previous_tasks }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="production">Production</label>
                                <textarea name="production_new" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->production_new }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="plans">Plans</label>
                                <textarea name="plans_new" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->plans_new }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="forecast">Forecast</label>
                                <textarea name="forecast_new" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->forecast_new }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="additional_suport_required">Any Additional Support Required</label>
                                <textarea name="additional_suport_required" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->additional_suport_required }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="file_attchment_if_any">File Attachment, if any</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="file_attchment_if_any">
                                        @if ($data->file_attchment_if_any)
                                        @foreach(json_decode($data->file_attchment_if_any) as $file)
                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                   @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attchment_if_any[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                            oninput="addMultipleFiles(this, 'file_attchment_if_any')" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="action_item_details">
                                    Action Item Details<button type="button" name="action_item_details"  onclick="addActionItemDetails('action_item_details')" id="action_item">+</button>
                                </label>
                                <table class="table table-bordered" id="action_item_details">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Short Description</th>
                                            <th>Due Date</th>
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            <th>Current Status</th>
                                            <th>Date Closed</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                                @foreach (unserialize($action_item_details->date_due) as $key => $temps)
                                                    <tr>
                                                        <td><input disabled type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ $key + 1 }}"></td>
                                                        <td><input type="text" name="short_desc[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($action_item_details->short_desc)[$key] ? unserialize($action_item_details->short_desc)[$key] : '' }}">
                                                        </td>
                                                      
                                                        <td><div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date "><div
                                                                         class="calenderauditee">
                                                                        <input type="text"   id="date_due{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($action_item_details->date_due)[$key]) }}"/>
                                                                        <input type="date"  id="date_due{{$key}}_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} value="{{unserialize($action_item_details->date_due)[$key]}}"  name="date_due[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getdateFormat(unserialize($action_item_details->date_due)[$key]) }}
                                                                        "class="hide-input" 
                                                                        oninput="handleDateInput(this, `date_due{{$key}}`);checkDate('date_due{{$key}}_checkdate','date_closed{{$key}}_checkdate')"  /></div></div></div></td>
                                                                     
                                                        <td><input type="text" name="site[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($action_item_details->site)[$key] ?? null }}">
                                                        </td>
                                                         
                                                        <td> <select id="select-state" placeholder="Select..."
                                                                     name="responsible_person[]"  {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} > 
                                                                      <option value="">Select a value</option>
                                                                        @foreach ($users as $undata)
                                                                            
                                                                        <option {{ (unserialize($action_item_details->responsible_person)[$key] ?? null) ? (unserialize($action_item_details->responsible_person)[$key] == $undata->id ? 'selected' : ' ') : '' }}
                                                                                        value="{{ $undata->id }}">
                                                                                        {{ $undata->name }}
                                                                        </option>
                                                                @endforeach
                                                                </select></td>
                                                        <td><input type="text" name="current_status[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ (unserialize($action_item_details->current_status)[$key] ?? null ) ? unserialize($action_item_details->current_status)[$key] : '' }}">
                                                        </td>
                                                        
                                                        <td><div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date "><div
                                                                         class="calenderauditee">
                                                                        {{-- <input type="text" id="date_closed{{$key}}" readonly placeholder="DD-MMM-YYYY" value= "{{ Helpers::getdateFormat(unserialize($action_item_details->date_closed)[$key] ?? null ) }}"/>
                                                                        <input type="date" name="date_closed[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  value= "{{ Helpers::getdateFormat(unserialize($action_item_details->date_closed)[$key] ?? null ) }}" id="date_closed{{$key}}_checkdate" value="{{ unserialize($action_item_details->date_closed)[$key]}} "class="hide-input" 
                                                                        oninput="handleDateInput(this, `date_closed{{$key}}`);checkDate(`date_due{{$key}}_checkdate`,`date_closed{{$key}}_checkdate`)" /></div></div></div></td>' --}}
                                                                        <input type="text"   id="date_closed{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($action_item_details->date_closed)[$key]) }}" />
                                                                        <input type="date" id="date_closed{{$key}}_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  value="{{unserialize($action_item_details->date_closed)[$key]}}"  name="date_closed[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  value="{{ Helpers::getdateFormat(unserialize($action_item_details->date_closed)[$key]) }}"class="hide-input" 
                                                                        oninput="handleDateInput(this, `date_closed{{$key}}`);checkDate('date_due{{$key}}_checkdate','date_closed{{$key}}_checkdate')"  /></div></div></div></td>
                                                        <td><input type="text" name="remark[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($action_item_details->remark)[$key] ?? '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>               
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="capa-details">
                                    CAPA Details<button  type="button" name="capa-details" id="capa_detail">+</button>
                                </label>
                                <table class="table table-bordered" id="capa_detail_details">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>CAPA Details</th>
                                            <th>CAPA Type</th>
                                            {{-- <th>CAPA Type112 (Corrective Action / Preventive Action)</th>
                                            <th>Date Opened</th> --}}
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            {{-- <th>Date Due</th> --}}
                                            <th>Current Status</th>
                                            {{-- <th>Person Responsible</th> --}}
                                            <th>Date Closed</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                 @if(!empty($capa_detail_details->date_closed2))
                                                 @foreach (unserialize($capa_detail_details->date_closed2) as $key => $temps) 
                                                    <tr>
                                                        <td><input disabled type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ $key + 1 }}"></td>
                                                        <td><input type="text" name="Details[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"   
                                                                value="{{ unserialize($capa_detail_details->Details)[$key] ? unserialize($capa_detail_details->Details)[$key] : '' }}">
                                                        </td>
                                                        {{-- <td> <select id="select-state" placeholder="Select..." 
                                                            {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  name="capa_type[]"  > 
                                                                      <option value="">Select a value</option>
                                                               @foreach ($users as $undata)
                                                                            <!-- <option value="{{ $undata->id }}">{{ $undata->name }}
                                                                                        </option> -->
                                                                    <option {{ unserialize($capa_detail_details->capa_type)[$key] ? (unserialize($capa_detail_details->capa_type)[$key] == $undata->id ? 'selected' : ' ') : '' }}
                                                                        value="{{ $undata->id }}">
                                                                        {{ $undata->name }}
                                                        </option>
                                                                     @endforeach
                                                            </select></td> --}}
                                                            {{-- <td>
                                                                <select id="select-state" placeholder="Select..."
                                                                    name="capa_type[]"value="{{ unserialize($capa_detail_details->capa_type)[$key] ? unserialize($capa_detail_details->capa_type)[$key] : '' }}" >
                                                                    <option value="">Select a value</option>
                                                                    <option value="corrective">Corrective Action</option>
                                                                    <option value="preventive">Preventive Action</option>
                                                                    <option value="corrective_preventive">Corrective & Preventive Action</option>
                                                                    value="{{unserialize($capa_detail_details->capa_type)[$key]}}"
                                                                </select>
                                                            </td> --}}
                                                            <td>
                                                                <select id="select-state" placeholder="Select..." name="capa_type[]" >
                                                                    <option value="">Select a value</option>
                                                                    <option value="corrective" {{ (unserialize($capa_detail_details->capa_type)[$key] == "corrective")?"selected":""}}>Corrective Action</option>
                                                                    <option value="preventive" {{ (unserialize($capa_detail_details->capa_type)[$key] == "preventive")?"selected":""}}>Preventive Action</option>
                                                                    <option value="corrective_preventive" {{ (unserialize($capa_detail_details->capa_type)[$key] == "corrective_preventive")?"selected":""}}>Corrective & Preventive Action</option>
                                                                </select>

                                                            </td>
                                                            <td><input type="text" name="site2[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($capa_detail_details->site2)[$key] ? unserialize($capa_detail_details->site2)[$key] : '' }}">
                                                        </td>
                                                        <td> <select id="select-state" placeholder="Select..."
                                                                     name="responsible_person2[]"  {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} > 
                                                                      <option value="">Select a value</option>
                                                               @foreach ($users as $undata)
                                                                            <!-- <option value="{{ $undata->id }}">{{ $undata->name }}
                                                                                        </option> -->
                                                                    <option {{ unserialize($capa_detail_details->responsible_person2)[$key] ? (unserialize($capa_detail_details->responsible_person2)[$key] == $undata->id ? 'selected' : ' ') : '' }}
                                                                        value="{{ $undata->id }}">
                                                                        {{ $undata->name }}
                                                        </option>
                                                                     @endforeach
                                                            </select></td>
                                                      
                                                        <td><input type="text" name="current_status2[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($capa_detail_details->current_status2)[$key] ? unserialize($capa_detail_details->current_status2)[$key] : '' }}">
                                                        </td>
                                                       
                                                        <td><div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date "><div
                                                                         class="calenderauditee">
                                                              <input type="text"   id="date_closed2{{$key}}" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($capa_detail_details->date_closed2)[$key]) }}" />
                                                                <input type="date" id="date_closed2{{$key}}" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{unserialize($capa_detail_details->date_closed2)[$key]}}"  name="date_closed2[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getdateFormat(unserialize($capa_detail_details->date_closed2)[$key]) }}"class="hide-input" 
                                                                oninput="handleDateInput(this, `date_closed2{{$key}}`)"  /></div></div></div></td>


                                                        <td><input type="text" name="remark2[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                                                value="{{ unserialize($capa_detail_details->remark2)[$key] ? unserialize($capa_detail_details->remark2)[$key] : '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                                
                                            </tbody>  
                                </table>
                            </div>
                             <div class="new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="next_managment_review_date">Next Management Review Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="next_managment_review_date" readonly  {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->next_managment_review_date) }}"/>
                                        <input type="date" name="next_managment_review_date"   {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->next_managment_review_date }} "
                                        class="hide-input" oninput="handleDateInput(this, 'next_managment_review_date')" />
                                    </div>
                                </div>
                            </div>
                            <div class="group-input">
                                <label for="summary_recommendation">Summary & Recommendation</label>
                                <textarea name="summary_recommendation" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->summary_recommendation}}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="conclusion">Conclusion</label>
                                <textarea name="conclusion_new"{{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->conclusion_new}}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="closure_attachments">Closure Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div  class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="closure_attachments">
                                        @if ($data->closure_attachments)
                                        @foreach(json_decode($data->closure_attachments) as $file)
                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                   @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="closure_attachments[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} 
                                            oninput="addMultipleFiles(this, 'closure_attachments')" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-head">
                                Extension Justification
                            </div>
                            <div class="group-input">
                                <label for="due_date_extension">Due Date Extension Justification</label>
                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->due_date_extension}}</textarea>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                {{-- <button type="submit">Submit</button> --}}
                                <button type="button"> <a class="text-white" href="{{ url('dashboard') }}"> Exit </a>
                                </button>
                            </div>
                        </div>
                    </div>

                     <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed By">Completed By</label>
                                         <div class="static">{{ $data->completed_by }}</div> 
                                    </div>
                                </div>
                           
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed On">Completed On</label>
                                         <div class="static">{{ $data->completed_on}}</div> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed By">Submited By</label>
                                         <div class="static">{{ $data->Submited_by }}</div> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed By">Submited On</label>
                                         <div class="static">{{ $data->Submited_on }}</div> 
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('childmanagementReview', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Action Item
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

                <form action="{{ route('manageCancel', $data->id) }}" method="POST">
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
                <form action="{{ route('manage_send_stage', $data->id) }}" method="POST">
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
            ele: '#Facility, #Group, #Audit, #Auditee'
        });
        
        function addActionItemDetails(tableId) {
            var users = @json($users);
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='short_desc[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_due' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_due[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date_due' + currentRowCount +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `date_due' + currentRowCount +'`);checkDate(`date_due' + currentRowCount +'_checkdate`,`date_closed' + currentRowCount +'_checkdate`)" /></div></div></div></td>';

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='site[]'>";

            var cell5 = newRow.insertCell(4);
            var userHtml = '<select name="responsible_person[]"><option value="">-- Select --</option>';
                    for (var i = 0; i < users.length; i++) {
                        userHtml += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    userHtml +='</select>';
            
            cell5.innerHTML = userHtml;

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='text' name='current_status[]'>"; 

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML = '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_closed' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date_closed'+ currentRowCount +'_checkdate" class="hide-input" oninput="handleDateInput(this, `date_closed' + currentRowCount +'`);checkDate(`date_due' + currentRowCount +'_checkdate`,`date_closed' + currentRowCount +'_checkdate`)" /></div></div></div></td>';
              
            var cell8 = newRow.insertCell(7);
            cell8.innerHTML = "<input type='text' name='remark[]'>";
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
        function addPerformanceEvoluation(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='monitoring[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='text' name='measurement[]'>";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='analysis[]'>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='text' name='evaluation[]'>";
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
        
        // ================================ SIX INPUTS
        function addAgendaManRev(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date' + currentRowCount +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `date' + currentRowCount +'`);" /></div></div></div></td>';

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='text' name='topic[]' >";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='responsible[]'>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='time' name='start_time[]'>";

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='time' name='end_time[]'>";

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML = "<input type='text' name='comment[]'>";
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
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
            // JavaScript
            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('initiator_group_code').value = selectedValue;
            });
        </script>
             <script>
                $(document).ready(function() {
                    $('#capa_detail').click(function(e) {
                        function generateTableRow(serialNumber) {
                            var users = @json($users);
                            console.log(users);
                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                                '"></td>' +
                               
                                '<td><input type="text" name="Details[]">' +
                                '<td><select id="select-state" placeholder="Select..." name="capa_type[]">'+
                                '<option value="">Select a value</option>'+
                                '<option value="corrective">Corrective Action</option>'+
                                '<option value="preventive">Preventive Action</option>'+
                                '<option value="corrective_preventive">Corrective & Preventive Action</option>'+
                                '</select></td>'+
        
                                '<td><input type="text" name="site2[]">' +
                                '<td><select name="responsible_person2[]">' +
                                '<option value="">Select a value</option>';
        
                            for (var i = 0; i < users.length; i++) {
                                html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                            }
        
                            html += '</select></td>' +
                                
                                '<td><input type="text" name="current_status2[]">' +
                               
                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="date_closed2' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed2[]" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `date_closed2' + serialNumber +'`)" /></div></div></div></td>' +
        
                                '<td><input type="text" name="remark2[]"></td>' +
        
                                '</tr>';
                            return html;
                        }
        
                        var tableBody = $('#capa_detail_details tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
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