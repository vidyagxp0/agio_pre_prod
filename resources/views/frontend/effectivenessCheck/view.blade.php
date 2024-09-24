@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
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
        #change-control-view > div > div > div.status > div.progress-bars > div.active.bg-danger{
            border-radius: 0px 20px 20px 0px;
        }
        /* #change-control-view > div > div > div.status > div.progress-bars > div:nth-child(5){
            border-radius: 0px 20px 20px 0px;

        } */

        .input_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 11px;
        }
       
    </style>
    {{-- ======================================
                CHANGE CONTROL VIEW
    ======================================= --}}
 
    <div class="form-field-head">
        <div class="division-bar">
            <!-- <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Effectiveness-Check -->
            <strong>Site Division/Project :</strong>
            {{ Helpers::getDivisionName(session()->get('division')) }} / Effectiveness-Check
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
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/effective-audit-trial-show', $data->id) }}"> Audit Trail </a> </button>
                                @if ($data->stage == 1  && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Submit
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#closed-modal">
                                    Cancel
                                </button>
                               @elseif($data->stage == 2 && (in_array(14, $userRoleIds) || in_array(18, $userRoleIds)))
                                 <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Effective
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    Not Effective
                                </button>  -->
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Acknowledge Complete
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    More Info Required
                                </button>
                                @elseif($data->stage == 3 && (in_array(14, $userRoleIds) || in_array(18, $userRoleIds)))
                                <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                   Effective
                               </button>
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                   Not Effective
                               </button>  -->
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                   Complete
                               </button>
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                   More Info Required
                               </button>
                                @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                  HOD Review Complete
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    More Information Required
                                </button>
                            @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Effective Approval Completed
                                </button> 
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    More Information Required
                                </button>  -->
                                  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Effective
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#not-effective-modal">
                                    Not Effective
                                </button> 
                            @elseif($data->stage == 6 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Effective Approval Completed
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    More Information Required
                                </button>
                            @elseif($data->stage == 8 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#not-effective-modal">
                                    Not Effective Approval Completed
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    More Information Required
                                </button>
                                @elseif($data->stage == 9 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#not-effective-child-model">
                                 Child
                                </button>
                                
                            @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                    </div>


                </div>
                <div class="status">
                    <div class="head">Current Status</div>
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
                            <div class="active">Acknowledge</div>
                        @else
                            <div class="">Acknowledge</div>
                        @endif
                        @if ($data->stage >= 3)
                            <div class="active">Work Completion </div>
                        @else
                            <div class="">Work Completion </div>
                        @endif
                        
                        @if ($data->stage >= 4)
                            <div class="active">HOD Review</div>
                        @else
                            <div class="">HOD Review</div>
                        @endif
                        @if ($data->stage >= 5)
                            <div class="active">QA/CQA Review</div>
                        @else
                            <div class="">QA/CQA Review</div>
                        @endif

                        @if ($data->stage >= 6)
                            <div class="active">QA/CQA Approval Effective</div>
                            <div style="display: none">QA/CQA Approval Not-Effective</div>
                            <div style="display: none">Closed Not-Effective</div>
                        @else
                            <div class="" style="display: none">QA/CQA Approval Effective</div>
                        @endif

                        @if ($data->stage == 7)
                            <div class="active bg-danger">Closed - Effective</div>
                            <div style="display: none">QA/CQA Approval Not-Effective</div>
                            <div style="display: none">Closed Not-Effective</div>
                        @else
                            <div class="" style="display: none">Closed - Effective</div>
                        @endif

                        @if ($data->stage >= 8)
                            <div class="active">QA/CQA Approval Not-Effective</div>
                            <div style="display: none">QA/CQA Approval Effective</div>
                            <div style="display: none">Closed -Effective</div>
                        @else
                            <div class="" style="display: none">QA/CQA Approval Not-Effective</div>
                        @endif

                        @if ($data->stage == 9)
                            <div class="active bg-danger">Closed Not-Effective</div>
                            <div style="display: none">QA/CQA Approval Effective</div>
                            <div style="display: none">Closed -Effective</div>
                        @endif

                    </div>
                    @endif

                </div>
            </div>


        </div>
        <form   action="{{ route('effectiveness.update', $data->id) }}" method="POST" enctype="multipart/form-data">
           
            
            @csrf
            @method('PUT')
          
            {{-- ======================================
                            DATA FIELDS
            ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                <button type="button"  class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button type="button" class="cctablinks " onclick="openCity(event, 'CCForm2')">Acknowledge</button>
                          
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm3')">Effectiveness check Results</button>
                <button type="button" class="cctablinks " onclick="openCity(event, 'CCForm4')">HOD Review</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm5')">QA/CQA  Review</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm6')">QA/CQA  Approval </button>
                           
                         <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button> 
                    </div>

                    <!-- General Information -->
                    <div id="CCForm1" class="inner-block cctabcontent" >
                        {{-- @if($data->stage == 1) style="display: block;" @else style="display: none;" @endif --}}
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div>
                            <div class="row">
                            <div class="col-lg-6">
                               <div class="group-input">
                                         <label for="RLS Record Number">Record Number</label>
                                         <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/EC/{{ Helpers::year($data->created_at) }}/{{  Helpers::recordFormat($data->record) }}">
                               </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location code</b></label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                      
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text" name="initiator_id" 
                                        value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                        {{--  <div class="static">{{ $data->created_at }}</div>  --}}
                                    </div>
                                </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To 
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8||  $data->stage == 9  || $data->stage == 10   ? 'disabled' : ''}} >
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->name ? 'selected' : '' }}
                                                            value="{{ $value->name }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                      

                                        <div class="col-md-6 new-unique-date-data-field">
    <div class="group-input input-unique-date">
        <label for="unique_due_date">Due Date <span class="text-danger"></span></label>
        <p class="text-primary">Last date this record should be closed by</p>

        <div class="unique-calenderauditee" style="position: relative;">
            <!-- Display Field (Formatted Date) -->
            <input type="text" id="unique_due_date_display" readonly
                placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"
                {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} 
                
                onclick="document.getElementById('unique_due_date').click();" />

            <!-- Hidden Actual Date Picker -->
            <input type="date" id="unique_due_date" name="due_date"
                {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : ''}} 
                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-unique-input"
                value="{{ $data->due_date }}"
                oninput="handleUniqueDateInput(this, 'unique_due_date_display')"
                onclick="this.click();" />
        </div>
    </div>
</div>

<!-- Updated JavaScript for Due Date -->
<script>
    function handleUniqueDateInput(dateInput, displayId) {
        const displayElement = document.getElementById(displayId);
        if (displayElement) {
            const dateValue = new Date(dateInput.value);
            const options = { year: 'numeric', month: 'short', day: '2-digit' };
            displayElement.value = dateValue.toLocaleDateString('en-GB', options).replace(/ /g, '-');
        }
    }
</script>

<!-- Updated CSS (if needed) -->
<style>
    .unique-calenderauditee {
        position: relative;
    }

    #unique_due_date_display {
        width: 100%;
        background-color: white;
        cursor: pointer;
    }

    #unique_due_date {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>



                        
                            
                           
        
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining              
                                        {{-- <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 6  ||  $data->stage == 4 ? "disabled" : "" }}>{{ $data->short_description }}</textarea> --}}
                                        <input type="text" name="short_description" id="docname" required    {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  value="{{ $data->short_description }}" >
                                    </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>

                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description</label>
                                        <textarea  name="short_description" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                    </div>
                                </div> -->
                               
                               

                            </div>
                            <div class="sub-head">
                                Effectiveness Planning Information
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness check Plan"><b>Effectiveness check Plan</b></label>
                                        <input type="text" name="Effectiveness_check_Plan"  {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} 
                                            value="{{ $data->Effectiveness_check_Plan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                            <div class="group-input">
                                                <label for="Attachment">Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Attachments">
                                                        @if ($data->Attachments)
                                                        @foreach(json_decode($data->Attachments) as $file)
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
                                                        <input  {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  type="file" id="myfile" name="Attachments[]"
                                                            oninput="addMultipleFiles(this, 'Attachments')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                             
                            <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }}>Save</button>
                                        @endif
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                    </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Effectiveness check Results -->
                                
                               <div class="sub-head">
                                Acknowledge
                               </div>
                               @if ($data->stage == 2)
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Effectiveness Results">Acknowledge Comment <span style="color: red;">*</span>
                                            </label>
                                            <textarea type="text" name="acknowledge_comment" id="acknowledge_comment" {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} required>{{ $data->acknowledge_comment }}   </textarea>
                                            {{-- <textarea type="text" id="acknowledge_comment" name="acknowledge_comment">{{ $data->acknowledge_comment }}</textarea> --}}
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Effectiveness Results">Acknowledge Comment</label>
                                            <textarea type="text" name="acknowledge_comment" id="acknowledge_comment"> {{ $data->acknowledge_comment }} </textarea>
                                            {{-- <textarea type="text" id="acknowledge_comment" name="acknowledge_comment">{{ $data->acknowledge_comment }}</textarea> --}}
                                        </div>
                                    </div>
                                @endif
                              
                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Acknowledge Attachment">Acknowledge Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="acknowledge_Attachment">
                                                @if ($data->acknowledge_Attachment)
                                                @foreach(json_decode($data->acknowledge_Attachment) as $file)
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
                                                <input  {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  value="{{ $data->acknowledge_Attachment }}" type="file" id="myfile" name="acknowledge_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'acknowledge_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
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
                    <div id="CCForm3" class="inner-block cctabcontent" >
                        {{-- @if($data->stage == 2) style="display: block;" @else style="display: none;" @endif --}}
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Effectiveness check Results -->
                               
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description</label>
                                        <textarea  name="short_description" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                    </div>
                                </div> -->
                                <div class="col-12 sub-head">
                                    Effectiveness Check Results
                                </div>
                                <div class="col-lg-12">
                                    @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Effectiveness Results">Effectiveness Results <span style="color: red;">*</span>
                                            
                                        </label>
                                            <textarea type="text" name="Effectiveness_Results" id="Effectiveness_Results" required>{{ $data->Effectiveness_Results }}   {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} </textarea>
                                    </div>
                                </div>
                                @else
 
                                <div class="group-input">
                                    <label for="Effectiveness Results">Effectiveness Results</label>
                                        <textarea type="text" name="Effectiveness_Results" id="Effectiveness_Results" >{{ $data->Effectiveness_Results }} </textarea>
                                </div>
                            </div>
                            @endif

                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effectiveness check Attachments"><b>Effectiveness check
                                                Attachment</b></label>
                                        <input type="file" id="myfile" name="Effectiveness_check_Attachment"
                                            value="{{ $data->Effectiveness_check_Attachment }}">
                                    </div>
                                </div> -->
                                <div class="col-12">
                                            <div class="group-input">
                                                <label for="Effectiveness check Attachments">Effectiveness check Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Effectiveness_check_Attachment">
                                                        @if ($data->Effectiveness_check_Attachment)
                                                        @foreach(json_decode($data->Effectiveness_check_Attachment) as $file)
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
                                                        <input  {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  value="{{ $data->Effectiveness_check_Attachment }}" type="file" id="myfile" name="Effectiveness_check_Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Effectiveness_check_Attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                  </div>
                                  <div class="col-12 sub-head">
                                    Effectiveness Summary
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness Summary">Effectiveness Summary</label>
                                        <textarea type="text" name="effect_summary"  {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 2 || $data->stage == 4  || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} > {{ $data->effect_summary }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12 sub-head">
                                    Reopen
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Addendum Comments"><b>Addendum Comments</b>
                                                        </label>
                                        <textarea type="text" name="Addendum_Comments" {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }}
                                            >{{ $data->Addendum_Comments }}</textarea>
                                    </div>
                                </div> --}}
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Addendum Attachments"><b>Addendum Attachment</b></label>
                                        <input type="file" id="myfile" name="Addendum_Attachment"
                                            value="{{ $data->Addendum_Attachment }}">
                                    </div>
                                </div> -->
                                {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Addendum Attachments">Addendum Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Addendum_Attachment">
                                                        @if ($data->Addendum_Attachment)
                                                        @foreach(json_decode($data->Addendum_Attachment) as $file)
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
                                                        <input {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }} type="file" id="myfile" name="Addendum_Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Addendum_Attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                            </div>
                            <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }}>Save</button>
                                        @endif
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                    </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Reference Info comments -->
                                <div class="col-12 sub-head">
                                  HOD Review
                                </div>
                                <div class="col-12">
                                    @if ($data->stage == 5)
                                    <div class="group-input">
                                        <label for="Comments"><b>HOD Review Comments</b> <span style="color: red;">*</span>
                                        </label>
                                        {{-- <textarea name="Comments" {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }} >{{ $data->Comments }}</textarea> --}}
                                        <textarea type="text" name="Comments" id="acknowledge_comment" required>{{ $data->Comments }}   {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3  || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} </textarea>
                                    </div>
                                </div>
                                @else

                                <div class="group-input">
                                    <label for="Comments"><b>HOD Review Comments</b></label>
                                    {{-- <textarea name="Comments" {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }} >{{ $data->Comments }}</textarea> --}}
                                    <textarea type="text" name="Comments" id="acknowledge_comment" >{{ $data->Comments }} </textarea>
                                </div>
                            </div>
                            @endif
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Attachments"><b>Attachment</b></label>
                                        <input type="file" id="myfile" name="Attachment">
                                    </div>
                                </div> -->
                                <div class="col-12">
                                            <div class="group-input">
                                                <label for="Attachments"> HOD Review Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Attachment">
                                                        @if ($data->Attachment)
                                                        @foreach(json_decode($data->Attachment) as $file)
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
                                                        <input  {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3  || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  value="{{ $data->Attachment }}" type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reference Records"><b>Reference Records</b></label>
                                        <input type="file" id="myfile" name="refer_record">
                                         <div class="static">Ref.Record</div>
                                    </div>
                                </div> -->
                                {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Reference Records">Reference Records</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="refer_record">
                                                        @if ($data->refer_record)
                                                        @foreach(json_decode($data->refer_record) as $file)
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
                                                        <input {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }} value="{{ $data->refer_record }}" type="file" id="myfile" name="refer_record[]"
                                                            oninput="addMultipleFiles(this, 'refer_record')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                  </div> --}}
                            </div>
                            <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 7 || $data->stage == 8  ||  $data->stage == 9 ? "disabled" : "" }}>Save</button>
                                        @endif

                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                       
                                    </div>
                    </div>
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Effectiveness check Results -->
                                <div class="sub-head">
                                    QA/CQA Review
                                </div>
                            
                                <div class="col-lg-12">
                                    @if ($data->stage == 6)
                                    <div class="group-input">
                                        <label for="Effectiveness Results">QA/CQA Review Comment <span style="color: red;">*</span></label>
                                        <textarea type="text" name="qa_cqa_review_comment" required>{{ $data->qa_cqa_review_comment }}  {{ $data->stage == 0 || $data->stage == 2  || $data->stage == 3 || $data->stage == 4  || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} </textarea>
                                    </div>
                                </div>
                            @else

                            <div class="group-input">
                                <label for="Effectiveness Results">QA/CQA Review Comment</label>
                                <textarea type="text" name="qa_cqa_review_comment">{{ $data->qa_cqa_review_comment }}</textarea>
                            </div>
                        </div>
                               @endif 
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Acknowledge Attachment">QA/CQA Review Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="qa_cqa_review_Attachment">
                                                @if ($data->qa_cqa_review_Attachment)
                                                @foreach(json_decode($data->qa_cqa_review_Attachment) as $file)
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
                                                <input  {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 3  || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}   value="{{ $data->qa_cqa_review_Attachment }}" type="file" id="myfile" name="qa_cqa_review_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'qa_cqa_review_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
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
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Effectiveness check Results -->
                                
                            <div class="sub-head">
                                QA/CQA Approval
                            </div>
                                <div class="col-lg-12">
                                    @if ($data->stage == 8)
                                    <div class="group-input">
                                        <label for="Effectiveness Results">QA/CQA Approval Comment</label>
                                        <textarea type="text" name="qa_cqa_approval_comment" {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ||  $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}} required >{{ $data->qa_cqa_approval_comment }} </textarea>
                                    </div>
                                </div>
                                @else

                                <div class="group-input">
                                    <label for="Effectiveness Results">QA/CQA Approval Comment</label>
                                    <textarea type="text" name="qa_cqa_approval_comment">{{ $data->qa_cqa_approval_comment }}  </textarea>
                                </div>
                            </div>
                            @endif
                            
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Acknowledge Attachment">QA/CQA Approval  Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="qa_cqa_approval_Attachment">
                                                @if ($data->qa_cqa_approval_Attachment)
                                                @foreach(json_decode($data->qa_cqa_approval_Attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 1  || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ||  $data->stage == 8 || $data->stage == 9 || $data->stage == 10 ? 'disabled' : ''}}  value="{{ $data->qa_cqa_approval_Attachment }}" type="file" id="myfile" name="qa_cqa_approval_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'qa_cqa_approval_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
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

                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- Activity History --}}
                               <div class="col-12 sub-head">
                                    Record Signature
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit by"><b>Submit by</b></label>
                                        <div class="static">{{ $data->submit_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit On"><b>Submit On</b></label>
                                        <div class="static">{{ $data->submit_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submit On"><b>Submit Comment</b></label>
                                        <div class="static">{{ $data->submit_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Acknowledge Complete by"><b>Acknowledge Complete by</b></label>
                                        <div class="static">{{ $data->work_complition_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Acknowledge Complete by"><b>Acknowledge Complete On</b></label>
                                        <div class="static">{{ $data->work_complition_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Acknowledge Complete by"><b>Acknowledge Complete Comment</b></label>
                                        <div class="static">{{ $data->work_complition_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete by"><b> Complete By</b></label>
                                        <div class="static">{{ $data->effectiveness_check_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On"><b> Complete On</b></label>
                                        <div class="static">{{ $data->effectiveness_check_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On"><b> Complete Comment</b></label>
                                        <div class="static">{{ $data->effectiveness_check_complete_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete by"><b>HOD Review Complete By</b></label>
                                        <div class="static">{{ $data->hod_review_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On"><b>HOD Review Complete On</b></label>
                                        <div class="static">{{ $data->hod_review_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On"><b>HOD Review Complete Comment</b></label>
                                        <div class="static">{{ $data->hod_review_complete_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Not Effective By"><b>Not Effective By</b></label>
                                        <div class="static">{{ $data->qa_review_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Not Effective On"><b>Not Effective On</b></label>
                                        <div class="static">{{ $data->qa_review_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Not Effective On"><b>Not Effective Comment</b></label>
                                        <div class="static">{{ $data->qa_review_complete_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Not Effective Approval Complete By"><b>Not Effective Approval Complete By</b></label>
                                        <div class="static">{{ $data->not_effective_approval_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Not Effective Approval Complete On"><b>Not Effective Approval Complete On</b></label>
                                        <div class="static">{{ $data->not_effective_approval_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Not Effective Approval Complete On"><b>Not Effective Approval Complete Comment</b></label>
                                        <div class="static">{{ $data->not_effective_approval_complete_comment }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective by"><b>Effective by</b></label>
                                        <div class="static">{{ $data->effective_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective On"><b>Effective On</b></label>
                                        <div class="static">{{ $data->effective_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Effective On"><b>Effective Comment</b></label>
                                        <div class="static">{{ $data->effective_comment }}</div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete By"><b>Effective Approval Complete By</b></label>
                                        <div class="static">{{ $data->effective_approval_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete On"><b>Effective Approval Complete On</b></label>
                                        <div class="static">{{ $data->effective_approval_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete On"><b>Effective Approval Complete Comment</b></label>
                                        <div class="static">{{ $data->effective_approval_complete_comment }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete By"><b>Cancel By</b></label>
                                        <div class="static">{{ $data->closed_cancelled_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete On"><b>Cancel On</b></label>
                                        <div class="static">{{ $data->closed_cancelled_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Effective Approval Complete On"><b>Cancel Comment</b></label>
                                        <div class="static">{{ $data->closed_cancelled_comment }}</div>
                                    </div>
                                </div>
                                </div>

                     <div class="button-block">
                                      @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 6  ||  $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                    
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit">Submit</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                    </div>
                    </div> 

            </div>
        </form>
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

                <form action="{{ route('moreinfo_effectiveness', $data->id) }}" method="POST">
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
    <div class="modal fade" id="closed-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('closed-cancelled', $data->id) }}" method="POST">
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
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input class="input_width" type="comment" name="comment" required>
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/send-effectiveness', $data->id) }}" method="POST">
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

    <div class="modal fade" id="not-effective-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/send-not-effective', $data->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
                        </div>
                    </div>
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

                <form action="{{ url('rcms/effectiveness-reject', $data->id) }}" method="POST">
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
                            <label for="comment">Comment </label>
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
    <div class="modal fade" id="not-effective-child-model">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('effectiveness_child', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            {{-- @if ($data->stage == 3) --}}
                                <label for="major">
                                    <input type="radio" name="child_type" id="major" value="capa-child">
                                    CAPA
                                </label>
                               
                            {{-- @endif --}}

                           
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
    </script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    @if (session()->has('errorMessages'))
        <script>
            // Create an array to hold all the error messages
            var errorMessages = @json(session()->get('errorMessages'));

            // Show the sweetAlert with the error messages

            Swal.fire({
                icon: '',
                title: 'Validation Error',
                html: errorMessages,

                showCloseButton: true, // Display a close button
                customClass: {
                    title: 'my-title-class', // Add a custom CSS class to the title
                    htmlContainer: 'my-html-class text-danger', // Add a custom CSS class to the popup content
                },
                confirmButtonColor: '#3085d6', // Customize the confirm button color
            });
        </script>
        
        @php session()->forget('errorMessages'); @endphp
    @endif
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
                $('#rchars').text(textlen);
            });
        </script>
@endsection
