@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <form action="{{ route('effectiveness.store') }}" method="POST">
        @csrf
        <div class="form-field-head">
            <div class="pr-id">
                Effectiveness Check
            </div>
            <div class="division-bar">
                <strong>Site Division/Project</strong> :
                QMS-North America / Effectiveness-Check
            </div>
        </div>
        {{-- ======================================
                    DATA FIELDS
        ======================================= --}}
        <div id="change-control-fields">
            <div class="container-fluid">

                <!-- Tab links -->
                <div class="cctab">
                    <button type="button" class="cctablinks active" onclick="openCity(event, 'CCForm1')">
                        General Information
                    </button>
                    <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm2')">
                        Effectiveness check Results
                    </button>
                    <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm3')">
                        Reference Info/Comments
                    </button>
                    <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm4')">
                        Activity History
                    </button>
                </div>

                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Originator</label>
                                        <div class="static">Amit Guru</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Date Opened</label>
                                        <div class="static">{{ $data->created_at }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description</label>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned to</label>
                                        <div class="static">Amit Guru</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date Due</label>
                                        <div class="static">{{ $data->due_date }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Reviewer">Quality Reviewer</label>
                                        <div class="static">Amit Guru</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Original Date Due">Original Date Due</label>
                                        <div class="static">{{ $data->due_date }}</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="cc_id" value="{{ $data->id }}">
                            <div class="sub-head">
                                Effectiveness Planning Information
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness check Plan">Effectiveness check Plan</label>
                                        <input type="text" name="Effectiveness_check_Plan">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Effectiveness check Results -->
                                <div class="col-12 sub-head">
                                    Effectiveness Summary
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness Summary">Effectiveness Summary</label>
                                        <textarea name="Effectiveness_Summary"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Effectiveness Check Results
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effectiveness Results">Effectiveness Results</label>
                                        <input type="text" name="Effectiveness_Results">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effectiveness check Attachments">Effectiveness check
                                                Attachment</label>
                                        <input type="file" id="myfile" name="Effectiveness_check_Attachment">
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Reopen
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Addendum Comments">Addendum Comments</label>
                                        <input type="text" name="Addendum_Comments">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Addendum Attachments">Addendum Attachment</label>
                                        <input type="file" id="myfile" name="Addendum_Attachment">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Reference Info comments -->
                                <div class="col-12 sub-head">
                                    Reference Info comments
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea name="Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Attachments">Attachment</label>
                                        <input type="file" id="myfile" name="Comments">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reference Records">Reference Records</label>
                                        <div class="static">Ref.Record</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <!-- Activity History -->
                                <div class="col-12 sub-head">
                                    Data History
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Actual Closure Date">Actual Closure Date</label>
                                        <div class="static">{{ $data->due_date }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Original Date Due">Original Date Due</label>
                                        <div class="static">{{ $data->due_date }}</div>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Record Signature
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submit by">Submit by</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submit On">Submit On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Complete By">Complete By</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Complete On">Complete On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Approal On">Quality Approal On</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Approal On">Quality Approal On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Addendum Complete By">Addendum Complete By</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Addendum Complete On">Addendum Complete On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancel By">Cancel By</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancel On">Cancel On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Re Open For Addendum By">Re Open For Addendum By</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Re Open For Addendum On">Re Open For Addendum On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancellation Approve By">Cancellation Approve By</label>
                                        <div class="static">Shaleen Mishra</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancellation Approve On">Cancellation Approve On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Cancellation Details
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancellation Category">Cancellation Category</label>
                                        <select>
                                            <option>Enter Your Selection Here</option>
                                            <option>Duplicate Entry</option>
                                            <option>Entered in Error</option>
                                            <option>No Longer Necessary</option>
                                            <option>Parent Record Closed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="TrackWise Record Type">TrackWise Record Type</label>
                                        <select>
                                            <option>Enter Your Selection Here</option>
                                            <option>Effectiveness Check</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Cancellation Justification">Cancellation Justification</label>
                                        <textarea name="text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                               
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                                             <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </form>


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
@endsection
