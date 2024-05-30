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
    </style>

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
            {{ Helpers::getDivisionName(session()->get('division')) }} / On the Job
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
                
            </div>

            <form action="{{ route('job_trainingupdate', ['id' => $jobTraining->id]) }}" method="post" enctype="multipart/form-data">
                 @csrf
                @method('put')
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Employee ID</label>
                                        <input  type="text" name="employee_id" 
                                            value="">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> 
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Name </label>
                                        <input  type="text" name="name" id="name_employee"
                                            value="{{ $jobTraining->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Department & Location</label>
                                        <input  type="text" name="department_location" value="{{ $jobTraining->department_location }}">
                                            {{-- value="{{ Helpers::getDivisionName(session()->get('division')) }}"> --}}
                                        {{-- <input type="hidden" name="division_id" value="{{ session()->get('division') }}"> --}}
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                              

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Start Date of Training</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="startdate"  value="{{ Helpers::getdateFormat($jobTraining->startdate) }}" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="startdate" value="{{ Helpers::getdateFormat($jobTraining->startdate) }}"
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'startdate')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">End Date of Training</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="enddate" value="{{ Helpers::getdateFormat($jobTraining->enddate) }}" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="enddate"  value="{{ Helpers::getdateFormat($jobTraining->enddate) }}"
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'enddate')"/>
                                        </div>
                                    </div>
                                </div>
                                
                               

                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Subject</th>
                                                        <th>Type of Training</th>
                                                        <th>Reference Document No.</th>
                                                        <th>Trainee Name</th>
                                                        <th>Trainer </th>
                                                       



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                       
                                                        
                                                        <td>
                                                           <input type="text" name="subject_1" value="{{ $jobTraining->subject_1}}">
                                                        </td>
                                                        <td>
                                                          <input type="text" name="type_of_training_1" value="{{ $jobTraining->type_of_training_1}}">
                                                        </td>
                                                        <td>
                                                           <input type="text" name="reference_document_no_1" value="{{ $jobTraining->reference_document_no_1}}">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_1" id="" >
                                                                <option value="{{ $jobTraining->trainee_name_1}}">person1</option>
                                                                <option value="{{ $jobTraining->trainee_name_1}}">person2</option>

                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_1" id="">
                                                                <option value="{{ $jobTraining->trainer_1}}">person1</option>
                                                                <option value="{{ $jobTraining->trainer_1}}">person2</option>

                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                           <input type="text" name="subject_2" value="{{ $jobTraining->subject_2}}">
                                                        </td>
                                                        <td>
                                                          <input type="text" name="type_of_training_2" value="{{ $jobTraining->type_of_training_2}}">
                                                        </td>
                                                        <td>
                                                           <input type="text" name="reference_document_no_2" value="{{ $jobTraining->reference_document_no_2}}">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_2" id="" >
                                                                <option value="{{ $jobTraining->trainee_name_2}}">Person1</option>
                                                                <option value="{{ $jobTraining->trainee_name_2}}">Person2</option>

                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_2" id="">
                                                                <option value="{{ $jobTraining->trainer_2}}">Person1</option>
                                                                <option value="{{ $jobTraining->trainer_2}}">Person2</option>

                                                            </select>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <input type="text" name="subject_3" value="{{ $jobTraining->subject_3}}">
                                                         </td>
                                                         <td>
                                                           <input type="text" name="type_of_training_3" value="{{ $jobTraining->type_of_training_3}}">
                                                         </td>
                                                         <td>
                                                            <input type="text" name="reference_document_no_3" value="{{ $jobTraining->reference_document_no_3}}">
                                                          </td>
                                                          <td>
                                                             <select name="trainee_name_3" id="" >
                                                                 <option value="{{ $jobTraining->trainee_name_3}}">Person1</option>
                                                                 <option value="{{ $jobTraining->trainee_name_3}}">Person2</option>

                                                             </select>
                                                          </td>
                                                          <td>
                                                             <select name="trainer_3" id="">
                                                                 <option value="{{ $jobTraining->trainer_3}}">Person1</option>
                                                                 <option value="{{ $jobTraining->trainer_3}}">Person2</option>

                                                             </select>
                                                         </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            <input type="text" name="subject_4" value="{{ $jobTraining->subject_4}}">
                                                         </td>
                                                         <td>
                                                           <input type="text" name="type_of_training_4" value="{{ $jobTraining->type_of_training_4}}">
                                                         </td>
                                                         <td>
                                                            <input type="text" name="reference_document_no_4" value="{{ $jobTraining->reference_document_no_4}}">
                                                          </td>
                                                          <td>
                                                             <select name="trainee_name_4" id="">
                                                                 <option  value="{{ $jobTraining->trainee_name_4}}">person1</option>
                                                                 <option  value="{{ $jobTraining->trainee_name_4}}">Person2</option>

                                                             </select>
                                                          </td>
                                                          <td>
                                                             <select name="trainer_4" id="">
                                                                 <option  value="{{ $jobTraining->trainer_4}}">Perosn1</option>
                                                                 <option  value="{{ $jobTraining->trainee_name_4}}">Person2</option>

                                                             </select>
                                                         </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                           <input type="text" name="subject_5" value="{{ $jobTraining->subject_5}}">
                                                        </td>
                                                        <td>
                                                          <input type="text" name="type_of_training_5" value="{{ $jobTraining->type_of_training_5}}">
                                                        </td>
                                                        <td>
                                                           <input type="text" name="reference_document_no_5" value="{{ $jobTraining->reference_document_no_5}}">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_5" id="">
                                                                <option  value="{{ $jobTraining->trainee_name_5}}">Person1</option>
                                                                <option  value="{{ $jobTraining->trainee_name_5}}">Person2</option>
                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_5" id="">
                                                                <option  value="{{ $jobTraining->trainer_5}}">Perosn1</option>
                                                                <option  value="{{ $jobTraining->trainer_5}}">Person2</option>

                                                            </select>
                                                        </td>
                                                    </tr>
                                                   
                                                 
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                             
                                
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
                                <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                        Exit </a> </button>

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
            ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
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

        function setCurrentDate(item) {
            if (item == 'yes') {
                $('#effect_check_date').val('{{ date('d-M-Y') }}');
            } else {
                $('#effect_check_date').val('');
            }
        }
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
