@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
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
<div class="form-field-head">

    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        {{ Helpers::getDivisionName(session()->get('division')) }} /Extension
    </div>
</div>
    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ====================================== CHANGE CONTROL VIEW ======================================= --}}
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
                        <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button>
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/extension-audit-trial', $data->id) }}"> Audit Trail </a> </button>
                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(1, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Ext Approve
                            </button>
                        @endif
                        <a class="text-white button_theme1" href="{{ url('rcms/qms-dashboard') }}">
                            Exit
                        </a>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="active bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Open State</div>
                            @else
                                <div class="">Open State</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Pending Approval
                                </div>
                            @else
                                <div class="">Pending Approval
                                </div>
                            @endif
                            @if ($data->stage <= 3)
                                @if ($data->stage >= 3)
                                    <div class="bg-danger">Closed-Done</div>
                                @else
                                    <div class="">Closed-Done</div>
                                @endif
                            @else
                                @if ($data->stage >= 4)
                                    <div class="active bg-danger">Closed-Rejected</div>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Extension</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')"> QA Approval</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')"> Activity Log</button>
                    </div>
                    <form action="{{ route('extension.update', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="step-form">
                            <!--  Extension Details Tab content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Extension Details</div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number">Record Number</label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}/Extension/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Division Code</label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator">Initiator</label>
                                                {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due">Date of Initiation</label>

                                                <input disabled type="text" name="intiation_date"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Date Due">Current Parent Due Date</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="due_date" readonly 
                                                        placeholder="DD-MMM-YYYY"  value="{{ Helpers::getdateFormat($data->due_date) }}" />
                                                    <input type="date" name="due_date" value="{{ $data->due_date }}"  class="hide-input"
                                                        oninput="handleDateInput(this, 'due_date')" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }} />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Date Due">Revised Due Date</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="revised_date" readonly
                                                        placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->revised_date) }}" />
                                                    <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="revised_date" value="{{ $data->revised_date }}"  class="hide-input"
                                                        oninput="handleDateInput(this, 'revised_date')" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }} />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Desccription">Short Description <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="short_description"
                                                    value="{{ $data->short_description }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining
                                                <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>
        
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Justification of Extention">Justification of Extention</label>
                                                <textarea name="justification"  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->justification }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Extention Attachments">Extention Attachments </label>
                                                <input type="file" id="myfile" name="extention_attachment[]"
                                                    multiple>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Recores">Reference Record</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} multiple  id="reference_record" name="refrence_record[]" id="">
                                                    <option value="">--Select---</option>
                                                    @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}"  {{ in_array($new->id, explode(',', $data->refrence_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/Extension/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary" >Please select related information</small></div>
                                                <select name="initiated_through" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }} {{$data->initiated_through}}
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option  selected value="">-- select --</option>
                                                    <option @if ($data->initiated_through == 'Internal Audit') selected @endif value="Internal ">Internal Audit</option>
                                                    <option @if ($data->initiated_through == 'External Audit') selected @endif value="External">External Audit</option>
                                                    <option @if ($data->initiated_through == 'CAPA') selected @endif value="CAPA">CAPA</option>
                                                    <option  @if ($data->initiated_through == 'Audit Program') selected @endif value="Audit ">Audit Program</option>
                                                    <option @if ($data->initiated_through == 'Lab Incident') selected @endif value="Lab ">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'Risk Assessment') selected @endif value="Risk">Risk Assessment</option>
                                                    <option @if ($data->initiated_through == 'Root Cause Analysis') selected @endif value="Root Cause">Root Cause Analysis</option>
                                                    <option @if ($data->initiated_through == 'Change Control') selected @endif value="Change">Change Control</option>
                                                    <option @if ($data->initiated_through == 'Management Review') selected @endif value="Management">Management Review</option>
                                                    <option @if ($data->initiated_through == 'New Document') selected @endif value="New Document">New Document</option>
                                                    <option @if ($data->initiated_through == 'Action Item') selected @endif value="Action ">Action Item</option>
                                                    <option @if ($data->initiated_through == 'Effectiveness Check') selected @endif value="Effectiveness">Effectivness Check</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="If Other">Reference Record</label>
                                            <div><small class="text-primary">Kindly specify the record from which the extension is being raised.</small></div>
                                            <textarea name="initiated_if_other" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->initiated_if_other }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Approver">Approver</label>
                                            <select id="select-state" placeholder="Select..." name="approver">
                                                <option value="">Select a value</option>
                                                @foreach ($users as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                
                                {{-- <div class="col-lg-6"> --}}
                                    {{-- <div class="group-input">
                                        <label for="Assigned to">Approver</label>
                                        <select name="approver"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    @if ($data->approver == $value->id) selected @endif>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Extention Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="extention_attachment" >
                                                            @if ($data->extention_attachment)
                                                            @foreach(json_decode($data->extention_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);" >
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                       @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            
                                                            <input {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }} type="file" id="myfile" name="extention_attachment[]"
                                                                oninput="addMultipleFiles(this, 'extention_attachment')" multiple>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                                                        
                                     <div class="group-input">
                                        <label for="Assigned to">Approver</label>
                                        <select name="approver1"
                                        {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    @if ($data->approver1 == $value->id) selected @endif>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- QA Approval content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Approver Comments">Approver Comments</label>
                                                <textarea name="approver_comments" {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->approver_comments }}  </textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="closure-attachments">Closure Attachments</label>
                                                <textarea name="closure-attachments">{{ $data->closure-attachments }} {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} </textarea>
                                                <input type="file" name="closure_attachments[]" multiple>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Closure Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="closure_attachments">
                                                            @if ($data->closure_attachments)
                                                            @foreach(json_decode($data->closure_attachments) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }} type="file" id="myfile" name="closure_attachments[]"
                                                                oninput="addMultipleFiles(this, 'closure_attachments')" multiple>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">Electronic Signatures</div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted By">Submitted By</label>
                                                <div class="static">{{ $data->submitted_by}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted On">Submitted On</label>
                                                <div class="static">{{ $data->submitted_on}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                <div class="static">{{ $data->cancelled_by}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                <div class="static">{{ $data->cancelled_on}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved By">Ext Approved By</label>
                                                <div class="static">{{ $data->ext_approved_by}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved On">Ext Approved On</label>
                                                <div class="static">{{ $data->ext_approved_on}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required By">More Information Required
                                                    By</label>
                                                <div class="static">{{ $data->more_information_required_by}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required On">More Information Required
                                                    On</label>
                                                <div class="static">{{ $data->more_information_required_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                <div class="static">{{ $data->rejected_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                <div class="static">{{ $data->rejected_on }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->

                            {{-- <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">Electronic Signatures</div>
                                        <div class="col-lg-6">
                                            <div class="group-input">

                                                <label for="Original Due Date">Submitted By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 2)
                                                        ->get();
                                                @endphp
                                                @foreach ($submit as $temp)
                                                    <div class="static">{{ $temp->user_name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted On">Submitted On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 2)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 0)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 0)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved By">Ext Approved By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 3)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved On">Ext Approved On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 3)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required By">More Information Required
                                                    By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 1)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required On">More Information Required
                                                    On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 1)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 4)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 4)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </form>

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
                        <form action="{{ url('rcms/send-extension', $data->id) }}" method="POST">
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
            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ url('rcms/send-reject-extention', $data->id) }}" method="POST">
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
                                    <label for="comment">Comment<span class="text-danger">*</span></label>
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

                        <form action="{{ url('rcms/send-cancel-extention', $data->id) }}" method="POST">
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
                                    <label for="comment">Comment<span class="text-danger">*</span></label>
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




            <style>
                #step-form>div {
                    display: none
                }

                #step-form>div:nth-child(1) {
                    display: block;
                }
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

            <script>
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
        </div>

    </div>







    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_change', $data->id) }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('q_m_s_divisions')->where('status', 1)->get();
                            @endphp
                            @foreach ($division as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button>
                            @endforeach

                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        <button id="submit-division">Cancel</button>
                        <button id="submit-division" type="submit">Continue</button>
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

                <form action="{{ url('rcms/send-reject-extention', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username  <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment  <span class="text-danger">*</span></label>
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

                <form action="{{ url('rcms/send-cancel-extention', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username  <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment  <span class="text-danger">*</span></label>
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
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Document Revision</h4>
                </div>
                <form method="{{ url('rcms/child-AT', $data->id) }}" action="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="revision">Choose Change Implementation</label>
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Action Item

                            </label>
                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                Extention
                            </label>

                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                New Document
                            </label>


                        </div>

                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Submit</button>
                    </div> -->
                    <div class="modal-footer">
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#add-input').click(function() {
                var lastInput = $('.bar input:last');
                var newInput = $('<input type="text" name="review_comment">');
                lastInput.after(newInput);
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
                VirtualSelect.init({
                ele: '#reference_record'
           });
          </script>
           <script>
            var maxLength = 255;
            $('#docname').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#rchars').text(textlen);});
        </script>
@endsection
