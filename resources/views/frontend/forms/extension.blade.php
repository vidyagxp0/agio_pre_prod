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
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
 <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} /Extension
        </div>
    </div>

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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Extension</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')"> QA Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')"> Activity Log</button>
            </div>
            <form action="{{ route('extension.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    <!--  Extension Details Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Extension Details</div>
                                </div>
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                <input type="hidden" name="parent_type" value="{{ $parent_name }}">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Record Number</label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/Extension/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Division Code</label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                    </div>
                                </div>


                                 {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="due-date">Current Parent Due Date<span class="text-danger"></span></label> --}}
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Current Parent Due Date<span class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Current Parent Due Date<span class="text-danger"></span></label>
                                        {{--  <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <input  type="text"
                                            value="{{ Helpers::getdateFormat($due_date) }}">  --}}
                                        <!-- {{-- <div class="static"> {{ $due_date }}</div> --}} -->
                                        {{-- <input  type="date"
                                            value="{{ Helpers::getdateFormat($parent_due_date) }}" name="due_date">
                                        <input type="hidden" value="{{ $parent_due_date }}" name="due_date">

                                    </div> --}} 
                                   
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Revised Due Date <span class="text-danger"></span></label>
                                        {{--  <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <input  type="text"
                                            value="{{ Helpers::getdateFormat($due_date) }}">  --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}
                                        {{-- <input  type="date" min="{{ $parent_due_date }}"
                                            value="" name="revised_date">
                                    </div> --}}
                            
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Desccription">Short Description <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="short_description">
                                    </div>
                                </div> --}}

                                   


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Current Parent Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Revised Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="revised_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="revised_date" class="hide-input"
                                                oninput="handleDateInput(this, 'revised_date')" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div> 
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Justification of Extention">Justification of Extension</label>
                                        <textarea name="justification"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Extention Attachments">Extention Attachments </label>
                                        <input type="file" id="myfile" name="extention_attachment[]" multiple>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Reference Recores">Reference Record</label>
                                        <select multiple id="reference_record" name="refrence_record[]" >
                                            <option value="">--Select---</option>
                                            @foreach ($old_record as $new)
                                                <option value="{{ $new->id }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/Extension/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                    
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through">
                                            <option value="">-- select --</option>
                                            <option value="Internal ">Internal Audit</option>
                                            <option value="External">External Audit</option>
                                            <option value="CAPA<">CAPA</option>
                                            <option value="Audit ">Audit Program</option>
                                            <option value="Lab ">Lab Incident</option>
                                            <option value="Risk">Risk Assessment</option>
                                            <option value="Root Cause">Root Cause Analysis</option>
                                            <option value="Change ">Change Control</option>
                                            <option value="Management">Management Review</option>
                                            <option value="New Documen">New Document</option>
                                            <option value="Action ">Action Item</option>
                                            <option value="Effectivness">Effectivness Check</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                            </div>
                             <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="If Other">Reference Record</label>
                                        <div><small class="text-primary">Kindly specify the record from which the extension is being raised.</small></div>
                                        <textarea name="initiated_if_other"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Extention Attachments</label>
                                        {{-- <input type="file" id="myfile" name="inv_attachment[]" multiple> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="extention_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="extention_attachment[]"
                                                    oninput="addMultipleFiles(this, 'extention_attachment')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approver">Approver</label>
                                        <select id="select-state" placeholder="Select..." name="approver1">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <textarea name="approver_comments"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="closure-attachments">Closure Attachments</label>
                                        <input type="file" name="closure_attachments[]" multiple>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Closure Attachments</label>

                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closure_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="closure_attachments[]"
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
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted On">Submitted On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancelled By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancelled On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Ext Approved By">Ext Approved By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Ext Approved On">Ext Approved On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="More Information Required By">More Information Required By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="More Information Required On">More Information Required On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Rejected By">Rejected By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Rejected On">Rejected On</label>
                                        <div class="static"></div>
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
                </div>

        </div>
        </form>
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
@endsection
