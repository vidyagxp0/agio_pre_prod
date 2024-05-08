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
            QMS-North America / Child / Root Cause Analysis
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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Chemical Analysis</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Water Analysis</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Environmental Monitoring</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Lab Investigation Remark</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QC Head/Designee Eval Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
            </div>

            <form action="" method="" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>

                                        <div class="static">QMS-EMEA/RCA/2023</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Division Code</b></label>
                                        <input type="hidden" name="division_code">
                                        <div class="static">QMS-North America</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input type="hidden" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_id">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}"></option>
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
                                        <input type="hidden" value="" name="due_date">
                                        <div class="static"></div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Desc.">Short Description</label>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Inititator Group</label>
                                        <select name="initiator_Group">
                                            <option value="0">-- Select --</option>
                                            <option value="QA ">Quality Assurance</option>
                                            <option value="QC">Quality Control</option>
                                            <option value="Mfg">Manufacturing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-code">Initiator Group Code</label>
                                        <div class="status">QA</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Sample_Type">Sample Type</label>
                                        <select name="Sample_Types">
                                            <option value="">-- Select --</option>
                                            <option value="Demo">Demo 1</option>
                                            <option value="Demo">Demo 2</option>
                                            <option value="Demo">Demo 3</option>
                                            <option value="Demo">Demo 4</option>
                                            <option value="Demo">Demo 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="test_lab">Test Lab</label>
                                        <input type="text" name="test_lab" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="ten_trend">Trend of Previous Ten Results</label>
                                        <textarea name="ten_trend"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="investigators">Investigators</label>
                                        <select multiple name="investigators[]" placeholder="Select Investigators"
                                            data-search="false" data-silent-initial-value-set="true" id="investigators">
                                            <option value="1">Amit Guru</option>
                                            <option value="2">Amit Patel</option>
                                            <option value="3">Shaleen Mishra</option>
                                            <option value="4">Anshul Patel</option>
                                            <option value="5">Vikas Prajapati</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="attachments">Attachments</label>
                                        <input type="file" name="attachments" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Chemical Analysis I
                            </div>
                            <div class="group-input">
                                <label for="review_analyst_knowledge">
                                    Review of analyst knowledge and training<button type="button" name="ann"
                                        onclick="add2Input('review_analyst_knowledge')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_analyst_knowledge">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Chemical Analysis II
                            </div>
                            <div class="group-input">
                                <label for="review_raw_data">
                                    Review of Raw Data<button type="button" name="ann"
                                        onclick="add2Input('review_raw_data')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_raw_data">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Chemical Analysis III
                            </div>
                            <div class="group-input">
                                <label for="review_sampling_storage">
                                    Review of Sampling and Storage<button type="button" name="ann"
                                        onclick="add2Input('review_sampling_storage')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_sampling_storage">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Chemical Analysis IV
                            </div>
                            <div class="group-input">
                                <label for="instrument_performance">
                                    Instrument Performance<button type="button" name="ann"
                                        onclick="add2Input('instrument_performance')">+</button>
                                </label>
                                <table class="table table-bordered" id="instrument_performance">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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
                            <div class="sub-head">
                                Water Analysis I
                            </div>
                            <div class="group-input">
                                <label for="water_review_analyst_knowledge">
                                    Review of analyst knowledge and training<button type="button" name="ann"
                                        onclick="add2Input('water_review_analyst_knowledge')">+</button>
                                </label>
                                <table class="table table-bordered" id="water_review_analyst_knowledge">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Water Analysis II
                            </div>
                            <div class="group-input">
                                <label for="review_instruments">
                                    Review of Instuments<button type="button" name="ann"
                                        onclick="add2Input('review_instruments')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_instruments">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Water Analysis III
                            </div>
                            <div class="group-input">
                                <label for="water_plant_checklist">
                                    Water Plant Checklist<button type="button" name="ann"
                                        onclick="add2Input('water_plant_checklist')">+</button>
                                </label>
                                <table class="table table-bordered" id="water_plant_checklist">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Water Analysis IV
                            </div>
                            <div class="group-input">
                                <label for="sample_testing_checklist">
                                    Sample Testing Checklist<button type="button" name="ann"
                                        onclick="add2Input('sample_testing_checklist')">+</button>
                                </label>
                                <table class="table table-bordered" id="sample_testing_checklist">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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
                            <div class="sub-head">
                                Environmental Monitoring I
                            </div>
                            <div class="group-input">
                                <label for="environment_monitoring_results">
                                    Environment Monitoring Results<button type="button" name="ann"
                                        onclick="add2Input('environment_monitoring_results')">+</button>
                                </label>
                                <table class="table table-bordered" id="environment_monitoring_results">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Environmental Monitoring II
                            </div>
                            <div class="group-input">
                                <label for="instrument_calibration_result">
                                    Intrument Calibration Results<button type="button" name="ann"
                                        onclick="add2Input('instrument_calibration_result')">+</button>
                                </label>
                                <table class="table table-bordered" id="instrument_calibration_result">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Environmental Monitoring III
                            </div>
                            <div class="group-input">
                                <label for="review_storage_plate">
                                    Review of Storage condition of Plate<button type="button" name="ann"
                                        onclick="add2Input('review_storage_plate')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_storage_plate">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Environmental Monitoring IV
                            </div>
                            <div class="group-input">
                                <label for="review_media_lot">
                                    Review of Media Lot<button type="button" name="ann"
                                        onclick="add2Input('review_media_lot')">+</button>
                                </label>
                                <table class="table table-bordered" id="review_media_lot">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Environmental Monitoring V
                            </div>
                            <div class="group-input">
                                <label for="environment_sampling">
                                    Sampling<button type="button" name="ann"
                                        onclick="add2Input('environment_sampling')">+</button>
                                </label>
                                <table class="table table-bordered" id="environment_sampling">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="sub-head">
                                Environmental Monitoring VI
                            </div>
                            <div class="group-input">
                                <label for="airborne_contamination">
                                    Airborne Contamination<button type="button" name="ann"
                                        onclick="add2Input('airborne_contamination')">+</button>
                                </label>
                                <table class="table table-bordered" id="airborne_contamination">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="lab_inv_concl">Lab Investigator Conclusion</label>
                                        <textarea name="lab_inv_concl"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="lab_inv_attach">Lab Investigator Attachments</label>
                                        <input type="file" name="lab_inv_attach" />
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
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qc_head_comments">QC Head Evaluation Comments</label>
                                        <textarea name="qc_head_comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="inv_attach">Investigation Attachments</label>
                                        <input type="file" name="inv_attach" />
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted_By..">Submitted By..</label>
                                        <div class="static">person data field</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted_On">Submitted On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Report_Result_By">Report Result By</label>
                                        <div class="static">person data field</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Report_Result_On">Report Result On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Evaluation_Complete_By">Evaluation Complete By</label>
                                        <div class="static">person data field</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Evaluation_Complete_On">Evaluation Complete On</label>
                                        <div class="static">17-04-2023 11:12PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
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
            ele: '#investigators'
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
        VirtualSelect.init({
            ele: '#departments, #team_members, #training-require, #impacted_objects'
        });
    </script>
@endsection
