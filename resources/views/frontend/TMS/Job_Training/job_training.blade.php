@extends('frontend.layout.main')
@section('container')
@php
        $users = DB::table('users')->select('id', 'name')->get();
        $divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
        $departments = DB::table('departments')->select('id', 'name')->get();
        $employees = DB::table('employees')->select('id', 'employee_name')->get();

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

            <form action="{{ route('job_trainingcreate') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                        <label for="select-state">Emp Name <span class="text-danger">*</span></label>
                                        <select id="select-state" placeholder="Select..." name="name" required>
                                            <option value="">Select an employee</option>
                                            @foreach ($employees as $data)
                                                <option value="{{ $data->id }}">{{ $data->employee_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Department">Department</label>
                                        <select name="department">
                                            <option value="">-- Select Dept --</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Location</label>
                                        {{--    value="{{ Helpers::getDivisionName(session()->get('division')) }}" --}}
                                        <input type="text" name="location">
                                        {{-- <input type="hidden" name="division_id" value="{{ session()->get('division') }}"> --}}
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD </label>
                                        
                                        <select   name="hod" placeholder="Select HOD" data-search="false"
                                            data-silent-initial-value-set="true" id="hod" >
                                            <option value="">-- Select Hod --</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              
                                
                                <!-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Start Date of Training</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="startdate"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="startdate" id="start_date_checkdate" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'startdate');checkDate('start_date_checkdate','enddate')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">End Date of Training</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="enddate"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="enddate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date_checkdate" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'enddate');checkDate('start_date_checkdate','end_date_checkdate')"/>
                                        </div>
                                    </div>
                                </div> -->
                                
                                
                               

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
                                                        <th>Start Date of Training</th>
                                                        <th>End Date of Training</th>
                                                       



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        // Fetch the trainers' IDs
                                                        $trainerIds = DB::table('user_roles')->where('q_m_s_roles_id', 6)->pluck('user_id');
                                                        $usersDetails = DB::table('users')->select('id', 'name')->get();
                                                        $trainers = DB::table('users')->whereIn('id', $trainerIds)->select('id', 'name')->get();
                                                    @endphp
                                                    <tr>
                                                        <td>1</td>
                                                       
                                                        
                                                        <td>
                                                           <input type="text" name="subject_1">
                                                        </td>
    
                                                        <td>
                                                          <input type="text" name="type_of_training_1">
                                                        </td>
                                                        
                                                        <td>
                                                           <input type="text" name="reference_document_no_1">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_1" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($trainers as $trainer)
                                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_1" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($usersDetails as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="date" name="startdate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="enddate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                           <input type="text" name="subject_2">
                                                        </td>
                                                        <td>
                                                          <input type="text" name="type_of_training_2">
                                                        </td>
                                                        <td>
                                                           <input type="text" name="reference_document_no_2">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_2" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($trainers as $trainer)
                                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_2" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($usersDetails as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="date" name="startdate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="enddate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <input type="text" name="subject_3">
                                                         </td>
                                                         <td>
                                                           <input type="text" name="type_of_training_3">
                                                         </td>
                                                         <td>
                                                            <input type="text" name="reference_document_no_3">
                                                          </td>
                                                          <td>
                                                             <select name="trainee_name_3" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($trainers as $trainer)
                                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                                @endforeach
                                                             </select>
                                                          </td>
                                                          <td>
                                                             <select name="trainer_3" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($usersDetails as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                             </select>
                                                         </td>
        
                                                         <td>
                                                            <input type="date" name="startdate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="enddate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            <input type="text" name="subject_4">
                                                         </td>
                                                         <td>
                                                           <input type="text" name="type_of_training_4">
                                                         </td>
                                                         <td>
                                                            <input type="text" name="reference_document_no_4">
                                                          </td>
                                                          <td>
                                                             <select name="trainee_name_4" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($trainers as $trainer)
                                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                                @endforeach
                                                             </select>
                                                          </td>
                                                          <td>
                                                             <select name="trainer_4" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($usersDetails as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                             </select>
                                                         </td>
        
                                                         <td>
                                                            <input type="date" name="startdate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="enddate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                           <input type="text" name="subject_5">
                                                        </td>
                                                        <td>
                                                          <input type="text" name="type_of_training_5">
                                                        </td>
                                                        <td>
                                                           <input type="text" name="reference_document_no_5">
                                                         </td>
                                                         <td>
                                                            <select name="trainee_name_5" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($trainers as $trainer)
                                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                         </td>
                                                         <td>
                                                            <select name="trainer_5" id="">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($usersDetails as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="startdate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate}','enddate')">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="enddate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
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
