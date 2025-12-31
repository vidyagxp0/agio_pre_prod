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

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Resampling 
        </div>
    </div>
    @php
        $users = DB::table('users')->get();
    @endphp


    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Parent Information</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Head QA/CQA Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Acknowledge</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Verification</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
            </div>

            <form action="{{ route('resampling_create') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-lg-6">
                                    <div class="group-input"> 
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        @if (!empty($parent_division_id))
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/Resampling/{{ date('Y') }}/{{ $record_number }}">
                                        @else
                                           <input type="hidden" name="record" id="record" >
                                           <input disabled type="text" name="record_number" id="record" placeholder="Record Number">
                                     
                                         {{-- <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/Resampling/{{ date('Y') }}/{{ $record}}"> --}}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">  
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        @if (!empty($parent_division_id))
                                            <input disabled type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                            <input type="hidden" name="division_id" value="{{ $parent_division_id }}">
                                        @else
                                            <input disabled type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">  
                                    @if (!empty($cc->id))
                                        <input type="hidden" name="ccId" value="{{ $cc->id }}">
                                    @endif
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Opened">Date of Initiation</label>
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        <input disabled type="text"
                                            value="{{ date('d-M-Y') }}"
                                            name="intiation_date">
                                        <input type="hidden" value="{{ date('d-M-Y') }}" name="intiation_date">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Due Date">Due Date</label>

                                        @if (!empty($cc->due_date))
                                        <div class="static">{{ $cc->due_date }}</div>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_dateq" readonly
                                                placeholder="DD-MM-YYYY" />
                                            <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                                oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" />
                                        </div>

                                    </div>
                                </div>
                                
                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }
                                    
                                    // Call this function initially to ensure the correct format is shown on page load
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
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  

{{--                                  
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true" id="related_records">

                                            @foreach ($relatedRecords as $record)
                                            <option value="{{ $record->id }}"
                                                {{ in_array($record->id, explode(',', $data->related_records ?? '')) ? 'selected' : '' }}>

                                                {{ Helpers::getDivisionName($record->division_id && $record->division) }}/{{ $record->process_name }}/{{ Helpers::year($record->created_at) }}/{{ Helpers::record($record->record) }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>  --}}

                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="related_records">Related Records<span
                                                class="text-danger">*</span></label>
                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true" id="related_records" required>

                                            @foreach ($relatedRecords as $records)
                                                <option
                                                    value="{{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}">
                                                    {{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('related_records')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="related_records">
                                            Related Records <span class="text-danger">*</span>
                                        </label>

                                        <select multiple name="related_records[]" id="related_records" 
                                            placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true"
                                            required>
                                            
                                            @if (!empty($relatedRecords))
                                                @foreach ($relatedRecords as $records)
                                                    @php
                                                        $recordValue = Helpers::getDivisionName(
                                                            $records->division_id ?? $records->division ?? $records->division_code ?? $records->site_location_code
                                                        ) . '/' . $records->process_name . '/' . date('Y') . '/' . Helpers::recordFormat($records->record);
                                                    @endphp

                                                    <option value="{{ $recordValue }}">
                                                        {{ $recordValue }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD Person<span
                                                class="text-danger">*</span></label>
                                        <select  name="hod_preson" placeholder="Select HOD Persons" data-search="false"
                                            data-silent-initial-value-set="true" id="hod" required>
                                            <option value="">select person</option>
                                            @foreach ($users as $value)
                                                
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Description<span
                                                class="text-danger"></span></label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Responsible Department">Responsible Department<span
                                            class="text-danger">*</span></label>
                                        <select name="departments" required>
                                                <option value="">-- Select --</option>
                                                <option value="CQA">Corporate Quality Assurance</option>
                                                <option value="QA" >Quality Assurance</option>
                                                <option value="QC" >Quality Control</option>
                                                <option value="QM" >Quality Control (Microbiology department)</option>
                                                <option value="PG" >Production General</option>
                                                <option value="PL" >Production Liquid Orals</option>
                                                <option value="PT" >Production Tablet and Powder</option>
                                                <option value="PE" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                                <option value="PC" >Production Capsules</option>
                                                <option value="PI" >Production Injectable</option>
                                                <option value="EN" >Engineering</option>
                                                <option value="HR" >Human Resource</option>
                                                <option value="ST" >Store</option>
                                                <option value="IT" >Information Technology</option>
                                                <option value="FD" >Formulation  Development</option>
                                                <option value="AL" >Analytical research and Development Laboratory</option>
                                                <option value="PD">Packaging Development</option>
                                                <option value="PU">Purchase Department</option>
                                                <option value="DC">Document Cell</option>
                                                <option value="RA">Regulatory Affairs</option>
                                                <option value="PV">Pharmacovigilance</option>
                                                 <option value="Safety" >Safety</option>
                                                <option value="Accounts">Accounts</option>
                                                <option value="Finance" >Finance</option>
                                                <option value="Artwork" >Artwork</option>
                                                <option value="Company secretary">Company secretary</option>
                                                <option value="Exports">Exports</option>
                                                <option value="Marketing">Marketing</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="others">If Others</label>
                                        <textarea name="if_others"></textarea>
                                    </div>
                                </div>

                                {{--  <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true" id="related_records">

                                            @foreach ($relatedRecords as $record)
                                                <option value="{{ $record->id }}" 
                                                    {{ in_array($record->id, explode(',', $data->related_records ?? '')) ? 'selected' : '' }}>
                                                    {{ Helpers::getDivisionName($record->division_id) }}/{{ Helpers::year($record->created_at) }}/{{ Helpers::record($record->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">File Attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attach[]"
                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                            </div>
                                        </div>
                                        {{-- <input type="file" name="file_attach[]" multiple> --}}
                                    </div>
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

                    {{-- <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Action Taken">RLS Record Number</label>
                                        <div class="static">Parent Record Number</div>
                                        <input disabled type="text"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/{{ $parent_name }}/2023/{{ Helpers::recordFormat($parent_record) }}">
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                        
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            

                            
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA/CQA Head Remark</label>
                                        <textarea disabled name="qa_remark"></textarea>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">QA/CQA Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_head"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile" name="qa_head[]"
                                                    oninput="addMultipleFiles(this, 'qa_head')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                </button>
                            </div>
                        </div>
                    </div>



                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Acknowledge</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <textarea disabled name="action_taken"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="start_date">Actual Start Date</label>
                                        <div class="calenderauditee">
                                            <input disabled type="text" id="start_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input disabled type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="start_date_checkdate" name="start_date" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-6  new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="end_date">Actual End Date</label>
                                        <div class="calenderauditee">
                                        <input disabled type="text" id="end_date"                             
                                                placeholder="DD-MMM-YYYY" />
                                             <input disabled type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date_checkdate" name="end_date" class="hide-input"
                                                oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                   
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea disabled name="comments"></textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Sampled By</label>
                                        <textarea disabled  name="sampled_by"></textarea>
                                    </div>
                                </div> 

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Completion Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

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
                                <div class="sub-head">QA/CQA Verification</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA/CQA Review Comments</label>
                                        <textarea disabled name="qa_comments"></textarea>
                                    </div>
                                </div>
                                
                                {{-- <div class="col-12 sub-head">
                                    Extension Justification
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due-dateextension">Due Date Extension Justification</label>
                                        <textarea name="due_date_extension"></textarea>
                                    </div>
                                </div> --}}
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">QA/CQA Verification Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile" name="final_attach[]"
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple>
                                            </div>
                                        </div>

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
                            Activity Log
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="group-input"  style="margin-bottom: 1rem">
                                        <label for="submitted by">Submit By</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="Submit on">Submit On</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="Submit on">Submit Comment</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>

                              
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="cancelled by">Approved By</label>
                                        <div class="Date">Not Applicable</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="cancelled on">Approved On</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="submitted on">Approved Comment</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="cancelled by">Acknowledge Complete By</label>
                                        <div class="Date">Not Applicable</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="cancelled on">Acknowledge Complete On</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="submitted on"> Acknowledge Complete Comment</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="More information required By">More information required By</label>
                                        <div class="Date">{{ $data->more_information_required_by }}</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="More information required On">More information required On</label>
                                        <div class="Date">{{ $data->more_information_required_on }}</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="submitted on">Comment</label>
                                        <div class="Date">{{ $data->more_info_requ_comment }}</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="completed by"> Verification Completed By</label>
                                        <div class="Date">Not Applicable</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="completed on">Verification Completed On</label>
                                        <div class="Date">Not Applicable</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="submitted on">Verification Completed Comment</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="cancelled by">Cancel By</label>
                                        <div class="Date">Not Applicable</div> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="cancelled on">Cancel On</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="submitted on">Cancel Comment</label>
                                        <div class="Date">Not Applicable</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
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
            ele: '#related_records'
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#related_records, #designee'
        });
    </script>
@endsection
