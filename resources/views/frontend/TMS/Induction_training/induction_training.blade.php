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
            {{ Helpers::getDivisionName(session()->get('division')) }} / Induction Training
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

            <form action="{{ route('induction_training.store') }}" method="post" enctype="multipart/form-data">
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Employee ID <span class="text-danger">*</span></label>
                                        <input  type="text" name="employee_id" 
                                            value="">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Name of Employee <span class="text-danger">*</span></label>
                                        <input  type="text" name="name_employee" id="name_employee"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Department & Location <span class="text-danger">*</span></label>
                                        <input  type="text" name="department_location" >
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                              
                                
                               
                                
                               
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Designation <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" id="designation"
                                            value="">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Qualification <span class="text-danger">*</span><span
                                                class="text-danger">
                                        <input id="docname" type="text" name="qualification" >
                                    </div>
                                </div>
                               
                                
                               
                               
                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Experience (if any)<span
                                                class="text-danger d-none">*</span></label>
                                       <input type="text" name="experience_if_any">
                                    </div>
                                </div>
                                
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Team">Date of Joining</label>
                                        <input type="date" name="date_joining" id="date_joining">
                                    </div>
                                </div>
                                
                                
                                
                                
                               

                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Name of Document</th>
                                                        <th>Document Number</th>
                                                        <th>Training Date</th>
                                                        {{-- <th>Trainee Sign/Date </th>
                                                        <th>HR Sign/Date</th> --}}
                                                        <th>Remark</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td style="background: #DCD8D8">Introduction of Agio Plant</td>
                                                        
                                                        <td>
                                                            <textarea name="document_number_1"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_1">
                                                        </td>
                                                        
                                                         <td>
                                                            <textarea name="remark_1"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td style="background: #DCD8D8">Personnel Hygiene</td>
                                                        <td>
                                                            <textarea name="document_number_2"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_2">
                                                        </td>
                                                        
                                                         <td>
                                                            <textarea name="remark_2"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td style="background: #DCD8D8">Entry Exit Procedure in Factory premises</td>
                                                        <td>
                                                            <textarea name="document_number_3"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_3">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_3"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                        <td>
                                                            <textarea name="document_number_4"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_4">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_4"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td style="background: #DCD8D8">Data Integrity</td>
                                                        <td>
                                                            <textarea name="document_number_5"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_5">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_5"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td style="background: #77a5d1">Modules</td>
                                                        
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . a</td>
                                                        <td style="background: #DCD8D8">	GMP</td>
                                                        <td>
                                                            <textarea name="document_number_6"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_6">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_6"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . b</td>
                                                        <td style="background: #DCD8D8">	Documentation</td>
                                                        <td>
                                                            <textarea name="document_number_7"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_7">
                                                        </td>
                                                        
                                                         <td>
                                                            <textarea name="remark_7"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 .c</td>
                                                        <td style="background: #DCD8D8">	Process Control</td>
                                                        <td>
                                                            <textarea name="document_number_8"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_8">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_8"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . d</td>
                                                        <td style="background: #DCD8D8">d.	Cross Contamination</td>
                                                        <td>
                                                            <textarea name="document_number_9"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_9">
                                                        </td>
                                                        
                                                         <td>
                                                            <textarea name="remark_9"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . e</td>
                                                        <td style="background: #DCD8D8">	Sanitization and Hygiene</td>
                                                        <td>
                                                            <textarea name="document_number_10"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_10">
                                                        </td>
                                                        
                                                         <td>
                                                            <textarea name="remark_10"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . f</td>
                                                        <td style="background: #DCD8D8">	Warehousing</td>
                                                        <td>
                                                            <textarea name="document_number_11"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_11">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_11"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6 . g</td>
                                                        <td style="background: #DCD8D8">	Complaint and Recall</td>
                                                        <td>
                                                            <textarea name="document_number_12"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date_12">
                                                        </td>
                                                       
                                                         <td>
                                                            <textarea name="remark_12"></textarea>
                                                        </td>
                                                        <tr>
                                                            <td>6 . h</td>
                                                            <td style="background: #DCD8D8">	Utilities</td>
                                                            <td>
                                                                <textarea name="document_number_13"></textarea>
                                                            </td>
                                                            <td>
                                                               <input type="date" name="training_date_13">
                                                            </td>
                                                           
                                                             <td>
                                                                <textarea name="remark_13"></textarea>
                                                            </td>
            
                                                        </tr>
                                                        <tr>
                                                            <td>6 . i</td>
                                                            <td style="background: #DCD8D8">	Water</td>
                                                            <td>
                                                                <textarea name="document_number_14"></textarea>
                                                            </td>
                                                            <td>
                                                               <input type="date" name="training_date_14">
                                                            </td>
                                                            
                                                             <td>
                                                                <textarea name="remark_14"></textarea>
                                                            </td>
            
                                                        </tr>
                                                        <tr>
                                                            <td> 6 . j</td>
                                                            <td style="background: #DCD8D8">	Safety Module</td>
                                                            <td>
                                                                <textarea name="document_number_15"></textarea>
                                                            </td>
                                                            <td>
                                                               <input type="date" name="training_date_15">
                                                            </td>
                                                           
                                                             <td>
                                                                <textarea name="remark_15"></textarea>
                                                            </td>
            
                                                        </tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="severity-level">HR Name</label>
                                        
                                        <select name="hr_name">
                                            <option value="0">-- Select --</option>
                                            <option value="hr">HR </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="severity-level">Trainee Name</label>
                                        
                                        <select name="trainee_name">
                                            <option value="0">-- Select --</option>
                                            <option value="trainee1">trainee 1</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
