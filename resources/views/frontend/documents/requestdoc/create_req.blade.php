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
    <style>
        #fr-logo {
            display: none;
        }
    </style>
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Document Issuance Request</strong>
        </div>
    </div>
    @php
        $users = DB::table('users')->orderByRaw('LOWER(name) ASC')->get();
    @endphp


    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Acknowledge</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Activity Log</button>
            </div>

            <form action="{{ route('document-request.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="request_id">
                                            <b>Request ID</b>
                                        </label>
                                          <input type="hidden" name="record" id="record">
                                          <input disabled type="text" name="record" id="record" placeholder="Request ID">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator">
                                            Request By
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ Auth::user()->name }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="department">
                                            Request Department
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ Helpers::getUserDepartmentFromDB(Auth::user()->departmentid) }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="document_id">
                                            Document
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="document_id" id="document_id" required>
                                            <option value="">-- Select Document Number --</option>
                                            @foreach ($documents as $document)
                                                <option
                                                    value="{{ $document->id }}"
                                                    {{ old('document_id') == $document->id ? 'selected' : '' }}>
                                                    {{ $document->document_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="request_to">
                                            Request To
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select
                                            name="request_to" id="request_to" required>
                                            <option value="">
                                                -- Select User --
                                            </option>

                                            @foreach ($users as $user)
                                                <option
                                                    value="{{ $user->id }}"
                                                    {{ old('request_to') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="request_to">
                                            Print Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="print_sop_type" id="" required>
                                            <option value="">
                                                -- Select Print Type --
                                            </option>
                                            <option value="single_page_print">Single Page Print</option>
                                            <option value="full_sop_print">Full SOP Print</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="number_of_copies">
                                            Number of Copies
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="number" name="number_of_copies" id="number_of_copies" value="{{ old('number_of_copies') }}" min="1" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="reason">
                                            Reason
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea
                                            name="reason" id="reason" required
                                        >{{ old('reason') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('documents') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">

                            <div class="sub-head">
                                Comment
                            </div>

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comment">
                                            Comment
                                        </label>

                                        <textarea
                                            name="comment"
                                            id="comment"
                                        >{{ old('comment') }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="button-block">

                                <button
                                    type="submit"
                                    class="saveButton"
                                >
                                    Save
                                </button>

                                <button
                                    type="button"
                                    class="backButton"
                                    onclick="previousStep()"
                                >
                                    Back
                                </button>

                                <button
                                    type="button"
                                    class="nextButton"
                                    onclick="nextStep()"
                                >
                                    Next
                                </button>

                                <button type="button">
                                    <a
                                        class="text-white"
                                        href="{{ url('documents') }}"
                                    >
                                        Exit
                                    </a>
                                </button>

                            </div>

                        </div>
                    </div>

                    <style>
                        .static{
                            font-weight: 100 !important;
                        }
                    </style>


                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                        <div class="sub-head">
                            Activity Log
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted by">Submit By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted on">Submit On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Submit Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Cancel By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Cancel On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Cancel Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Acknowledge Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Acknowledge Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Acknowledge Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Acknowledge Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Verification Complete</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Verification Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Verification Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Verification Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                                </div>
                            <div class="button-block">
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <!-- <button type="submit" class="saveButton">Save</button> -->
                                <button type="button"> <a class="text-white"
                                        href="{{ url('documents') }}">Exit
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
