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
     
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            QMS-EMEA / Capa Child / Action Item
        </div>
    </div>



    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Parent General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Post Completion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Action Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
            </div>

            <form action="{{ route('actionItem.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">

                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="ccId" value="">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Opened">Date of Initiation</label>
                                        <div class="static">{{ date('d-M-Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Due Date">Due Date</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="related_records">Action Item Related Records</label>
                                        <select multiple name="related_records" placeholder="Select Reference Records"
                                            data-search="false" data-silent-initial-value-set="true" id="related_records">
                                            <option value="31">QMS-EMEA/PROD/2023/31</option>
                                            <option value="32">QMS-EMEA/PROD/2023/32</option>
                                            <option value="33">QMS-EMEA/PROD/2023/33</option>
                                            <option value="34">QMS-EMEA/PROD/2023/34</option>
                                            <option value="35">QMS-EMEA/PROD/2023/35</option>
                                            <option value="36">QMS-EMEA/PROD/2023/36</option>
                                            <option value="37">QMS-EMEA/PROD/2023/37</option>
                                            <option value="38">QMS-EMEA/PROD/2023/38</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description</label>
                                        <input type="text" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="description">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned to</label>
                                        <div class="static">Amit Guru</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="hod">HOD Persons</label>
                                        <select multiple  placeholder="Select HOD Persons" data-search="false"
                                            data-silent-initial-value-set="true" id="hod" name="hod_preson">
                                            <option value="1">Piyush Sahu</option>
                                            <option value="2">Piyush Sahu</option>
                                            <option value="3">Piyush Sahu</option>
                                            <option value="4">Piyush Sahu</option>
                                            <option value="5">Piyush Sahu</option>
                                            <option value="6">Piyush Sahu</option>
                                            <option value="7">Piyush Sahu</option>
                                            <option value="8">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Responsible Department">Responsible Department</label>
                                        <select name="dept">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Quality Assurance-CQA</option>
                                            <option value="2">Research and development</option>
                                            <option value="3">Regulatory Science</option>
                                            <option value="4">Supply Chain Management</option>
                                            <option value="5">Finance</option>
                                            <option value="6">QA-Digital</option>
                                            <option value="7">Central Engineering</option>
                                            <option value="8">Projects</option>
                                            <option value="9">Marketing</option>
                                            <option value="10">QCAT</option>
                                            <option value="11">Marketing</option>
                                            <option value="12">GMP Pilot Plant</option>
                                            <option value="13">Manufacturing Sciences and Technology</option>
                                            <option value="14">Environment, Health and Safety</option>
                                            <option value="15">Business Relationship Management</option>
                                            <option value="16">National Regulatory Affairs</option>
                                            <option value="17">HR</option>
                                            <option value="18">Admin</option>
                                            <option value="19">Information Technology</option>
                                            <option value="20">Program Management QA Analytical (Q13)</option>
                                            <option value="21">QA Analytical (Q8)</option>
                                            <option value="22">QA Packaging Development</option>
                                            <option value="23">QA Engineering</option>
                                            <option value="24">DS Quality Assurance</option>
                                            <option value="25">Quality Control (Q13)</option>
                                            <option value="26">Quality Control (Q8)</option>
                                            <option value="27">Quality Control (Q15)</option>
                                            <option value="28">QC Microbiology (B1)</option>
                                            <option value="29">QC Microbiology (B2)</option>
                                            <option value="30">Production (B1)</option>
                                            <option value="31">Production (B2)</option>
                                            <option value="32">Production (Packing)</option>
                                            <option value="33">Production (Devices)</option>
                                            <option value="34">Production (DS)</option>
                                            <option value="35">Engineering and Maintenance (B1)</option>
                                            <option value="36">Engineering and Maintenance (B2)</option>
                                            <option value="37">Engineering and Maintenance (W20)</option>
                                            <option value="38">Device Technology Principle Management</option>
                                            <option value="39">Production (82)</option>
                                            <option value="40">Production (Packing)</option>
                                            <option value="41">Production (Devices)</option>
                                            <option value="42">Production (DS)</option>
                                            <option value="43">Engineering and Maintenance (B1)</option>
                                            <option value="44">Engineering and Maintenance (B2) Engineering and
                                                Maintenance (W20)
                                            </option>
                                            <option value="45">Device Technology Principle Management</option>
                                            <option value="46">Warehouse(DP)</option>
                                            <option value="47">Drug safety</option>
                                            <option value="48">Others</option>
                                            <option value="49">Visual Inspection</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="file_attach">File Attachments</label>
                                        <input type="file" name="file_attach">
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

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Action Taken">RLS Record Number</label>
                                        <div class="static">Parent Record Number</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Inititator Group</label>
                                        <select name="initiatorGroup" id="initiator-group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA">Corporate Quality Assurance</option>
                                            <option value="QAB">Quality Assurance Biopharma</option>
                                            <option value="CQC">Central Quality Control</option>
                                            <option value="CQC">Manufacturing</option>
                                            <option value="PSG">Plasma Sourcing Group</option>
                                            <option value="CS">Central Stores</option>
                                            <option value="ITG">Information Technology Group</option>
                                            <option value="MM">Molecular Medicine</option>
                                            <option value="CL">Central Laboratory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-code">Initiator Group Code</label>
                                        <div class="default-name"> <span id="initiator-code">Not selected</span></div>
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

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Post Completion</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <textarea name="action_taken"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="start_date">Actual Start Date</label>
                                        <!-- <input type="date" name="start_date"> -->
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="start_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="start_date" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'start_date')"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="end_date">Actual End Date</label>
                                        <!-- <input type="date" name="end_date"> -->
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="end_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="end_date" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'end_date')"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <input type="file" id="myfile" name="Support_doc">
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
                                <div class="sub-head">Action Approval</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA Review Comments</label>
                                        <textarea name="qa_comments"></textarea>
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
                                Electronic Signatures
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Completed By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Completed On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Interim Approval Requested By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Interim Approval Requested On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Interim Approval Approved By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Interim Approval Approved On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Rejected By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Rejected On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
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
@endsection
