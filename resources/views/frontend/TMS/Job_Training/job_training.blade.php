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
        <strong>On the Job</strong>
        <!-- {{ Helpers::getDivisionName(session()->get('division')) }} / On the Job -->
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
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Job Description</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm3')">QA Review</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm4')">QA/CQA Approval</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm5')">Evaluation</button>
   
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
                            <!-- Employee Name -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-employee-name">Employee Name </label>
                                    <select id="select-employee-name" name="selected_employee_id" required>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selected_employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" placeholder="Select..." name="selected_employee_id" required {{ isset($employee) ? 'disabled' : '' }}>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" data-name="{{ $employee->employee_name }}" {{ isset($employee) && $employee->id == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            
                            <!-- Hidden Employee Name Field for Saving the Name -->
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_name">Employee Name (Auto-filled)</label> --}}
                                    <input id="name" name="name" type="hidden" readonly>
                                    {{-- @error('employee_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                             --}}
                            <!-- Employee Code -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee Code </label>
                                    <input id="employee_id" name="empcode" value="" type="text" readonly>
                                    @error('empcode')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                  {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="type_of_training">SOP Document</label>      
                            <select name="sopdocument">
                                <option value="">---Select SOP Document---</option>
                                @foreach ($data as $dat)
                                <option value="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}">
                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="type_of_training">SOP Document</label>  
                    <select name="sopdocument" id="sopdocument" onchange="fetchShortDescription(this.value)">
                        <option value="">---Select SOP Document---</option>
                        @foreach ($data as $dat)
                        <option value="{{ $dat->id }}">
                            {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                    </div> --}}

                            
                            <!-- Type of Training -->
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="type_of_training">Type of Training</label>
                                    <select name="type_of_training" id="type_of_training" >
                                        <option value="">----Select Training---</option>
                                        <option value="on the job">On The Job</option>
                                        <option value="classroom">Classroom</option>
                                    </select>
                                </div>
                            </div> --}}
                            
                            <!-- Start Date -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date" type="date" name="start_date" >
                                </div>
                            </div>
                            
                            <!-- End Date -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date" type="date" name="end_date" >
                                </div>
                            </div>
                            
                            <!-- Department -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department">Department</label>
                                    <input id="department" type="text" value="" name="department" readonly>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" name="location" >
                                </div>
                            </div> -->
                            

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="hods">HOD</label>
                                    <select class="choices-single-reviewer" name="hod" placeholder="Select HOD">
                                        <option value="">Select HOD</option>
                                        @foreach ($hods as $hod)
                                            <option value="{{ $hod->id }}" {{ old('hod') == $hod->id ? 'selected' : '' }}>
                                                {{ $hod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Revision Purpose</label>
                                    <select name="revision_purpose" id="" >
                                        <option value="">----Select---</option>
                                        <option value="New">New</option>
                                        <option value="Old">Old</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="revision_purpose">Revision Purpose</label>
                                    <select name="revision_purpose" id="revision_purpose" onchange="toggleRemarkInput()">
                                        <option value="">----Select---</option>
                                        <option value="New">New</option>
                                        <option value="Old">Old</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Remark Input Field -->
                            <div class="col-lg-6" id="remark_container" style="display: none;">
                                <div class="group-input">
                                    <label for="remark">Remark</label>
                                    <textarea name="remark" id="remark" rows="4" placeholder="Enter your remark here..."></textarea>
                                </div>
                            </div>

                            <script>
                                function toggleRemarkInput() {
                                    const revisionPurposeSelect = document.getElementById('revision_purpose');
                                    const remarkContainer = document.getElementById('remark_container');

                                    // Show the remark input if "Old" is selected, otherwise hide it
                                    if (revisionPurposeSelect.value === 'Old') {
                                        remarkContainer.style.display = 'block';
                                    } else {
                                        remarkContainer.style.display = 'none';
                                        // Optionally clear the remark input when hiding
                                        document.getElementById('remark').value = '';
                                    }
                                }
                            </script>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Evaluation Required</label>
                                    <select name="evaluation_required" id="" >
                                        <option value="">----Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
        
                            
                            <script>
                                document.getElementById('select-employee-name').addEventListener('change', function () {
                                    var employeeId = this.value;
                            
                                    if (employeeId) {
                                        fetch(`/employees/${employeeId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Populate the fields with data
                                                document.getElementById('name').value = data.employee_name; // Employee Name (for saving)
                                                document.getElementById('employee_id').value = data.full_employee_id; // Employee Code
                                                // document.getElementById('type_of_training').value = data.type_of_training || ''; // Type of Training
                                                document.getElementById('start_date').value = data.start_date || ''; // Start Date
                                                document.getElementById('end_date').value = data.end_date || ''; // End Date
                                                document.getElementById('department').value = data.department || 'N/A'; // Department
                                                //document.getElementById('location').value = data.site_name || 'N/A'; // Location
                                                // document.getElementById('hod').value = data.hod || 'N/A'; // HOD
                                            })
                                            .catch(error => {
                                                console.error('Error fetching employee data:', error);
                                                // Clear fields if error
                                                document.getElementById('name').value = '';
                                                document.getElementById('employee_id').value = '';
                                                // document.getElementById('type_of_training').value = '';
                                                document.getElementById('start_date').value = '';
                                                document.getElementById('end_date').value = '';
                                                document.getElementById('department').value = '';
                                                //document.getElementById('location').value = '';
                                                // document.getElementById('hod').value = '';
                                            });
                                    } else {
                                        // Clear fields if no employee selected
                                        document.getElementById('name').value = '';
                                        document.getElementById('employee_id').value = '';
                                        // document.getElementById('type_of_training').value = '';
                                        document.getElementById('start_date').value = '';
                                        document.getElementById('end_date').value = '';
                                        document.getElementById('department').value = '';
                                        //document.getElementById('location').value = '';
                                        // document.getElementById('hod').value = '';
                                    }
                                });
                            </script>


            <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 5%;">Sr.No.</th>
            <th style="width: 30%;">Document Title</th>
            <th>Type of Training</th>
            <th>SOP No.</th>
            <th>Trainer</th>
            <th>Date of Training</th>
            <th>Date of Completion</th>
            <th>SOP Preview</th>
        </tr>
    </thead>
    <tbody>
        @php
        $trainerIds = DB::table('user_roles')->where('q_m_s_roles_id', 6)->pluck('user_id');
        $usersDetails = DB::table('users')->select('id', 'name')->get();
        @endphp
        
        <tr>
        <td>1</td>
        <td>
            <select name="subject_1" id="sopdocument" onchange="fetchDocumentDetails(this)">
                <option value="">---Select Document Name---</option>
                @foreach ($data as $dat)
                <option value="{{ $dat->document_name }}"
                        data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                        data-sop-link="{{ $dat->id }}">
                    {{ $dat->document_name }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="type_of_training_1"></td>

        <td><input type="text" name="reference_document_no_1" id="document_number" readonly></td>


            <td>
                <select name="trainer_1" id="trainer_1">
                    <option value="">-- Select --</option>
                    @foreach ($usersDetails as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="startdate_1" id="startdate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td><input type="date" name="enddate_1" id="enddate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td>
            <a href="" id="view_sop" target="_blank" style="display:none;">View SOP</a>
        </td>
        </tr>
        <input type="hidden" id="selected_document_id" name="selected_document_id">

        <!-- Row 2 -->
        <tr>
            <td>2</td>
            <td>
            <select name="subject_2" id="sopdocument" onchange="fetchDocumentDetails2(this)">
                <option value="">---Select Document Name---</option>
                @foreach ($data as $dat)
                <option value="{{ $dat->document_name }}"
                        data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                        data-sop-link="{{ $dat->id }}">
                    {{ $dat->document_name }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="type_of_training_2"></td>

        <td><input type="text" name="reference_document_no_2" id="document_number1" readonly></td>
 
            <td>
                <select name="trainer_2" id="trainer_2">
                    <option value="">-- Select --</option>
                    @foreach ($usersDetails as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="startdate_2" id="startdate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td><input type="date" name="enddate_2" id="enddate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td>
            <a href="" id="view_sop1" target="_blank" style="display:none;">View SOP</a>
            </td>
            </tr>
            <input type="hidden" id="selected_document_id1" name="selected_document_id">

        <!-- Row 3 -->
        <tr>
            <td>3</td>
            <td>
            <select name="subject_3" id="sopdocument" onchange="fetchDocumentDetails3(this)">
                <option value="">---Select Document Name---</option>
                @foreach ($data as $dat)
                <option value="{{ $dat->document_name }}"
                        data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                        data-sop-link="{{ $dat->id }}">
                    {{ $dat->document_name }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="type_of_training_3"></td>

        <td><input type="text" name="reference_document_no_3" id="document_number2" readonly></td>

            <td>
                <select name="trainer_3" id="trainer_3">
                    <option value="">-- Select --</option>
                    @foreach ($usersDetails as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="startdate_3" id="startdate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td><input type="date" name="enddate_3" id="enddate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td>
            <a href="" id="view_sop2" target="_blank" style="display:none;">View SOP</a>
            </td>
        </tr>
        <input type="hidden" id="selected_document_id2" name="selected_document_id">

        <!-- Row 4 -->
        <tr>
            <td>4</td>
            <td>
            <select name="subject_4" id="sopdocument" onchange="fetchDocumentDetails4(this)">
                <option value="">---Select Document Name---</option>
                @foreach ($data as $dat)
                <option value="{{ $dat->document_name }}"
                        data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                        data-sop-link="{{ $dat->id }}">
                    {{ $dat->document_name }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="type_of_training_4"></td>

        <td><input type="text" name="reference_document_no_4" id="document_number3" readonly></td>
            <td>
                <select name="trainer_4" id="trainer_4">
                    <option value="">-- Select --</option>
                    @foreach ($usersDetails as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="startdate_4" id="startdate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td><input type="date" name="enddate_4" id="enddate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td>
            <a href="" id="view_sop3" target="_blank" style="display:none;">View SOP</a>
            </td>
        </tr>
        <input type="hidden" id="selected_document_id3" name="selected_document_id">

        <!-- Row 5 -->
        <tr>
            <td>5</td>
            <td>
            <select name="subject_5" id="sopdocument" onchange="fetchDocumentDetails5(this)">
                <option value="">---Select Document Name---</option>
                @foreach ($data as $dat)
                <option value="{{ $dat->document_name }}"
                        data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                        data-sop-link="{{ $dat->id }}">
                    {{ $dat->document_name }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="type_of_training_5"></td>

        <td><input type="text" name="reference_document_no_5" id="document_number4" readonly></td>

            <td>
                <select name="trainer_5" id="trainer_5">
                    <option value="">-- Select --</option>
                    @foreach ($usersDetails as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="startdate_5" id="startdate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td><input type="date" name="enddate_5" id="enddate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
            <td>
            <a href="" id="view_sop4" target="_blank" style="display:none;">View SOP</a>
            </td>
        </tr>
        <input type="hidden" id="selected_document_id4" name="selected_document_id">
    </tbody>
</table>

                    </div>
                </div>
            </div>

    </div>
    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
        <!-- <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                Exit </a> </button> -->

    </div>
</div>
</div>
<script>
    function fetchDocumentDetails(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var documentNumber = selectedOption.getAttribute('data-doc-number');
        var documentId = selectedOption.getAttribute('data-sop-link');
        
        // Update the reference document number field
        document.getElementById('document_number').value = documentNumber;
        
        // Update hidden input field for document ID
        document.getElementById('selected_document_id').value = documentId;

        // Update SOP view link
        var sopAnchor = document.getElementById('view_sop');
        if (documentId) {
            sopAnchor.href = `/documents/viewpdf/${documentId}`;
            sopAnchor.style.display = 'inline';  // Show the link
        } else {
            sopAnchor.style.display = 'none';  // Hide if no document selected
        }}
        document.addEventListener("DOMContentLoaded", function() {
        var selectedDocumentId = document.getElementById('selected_document_id').value;
        var sopAnchor = document.getElementById('view_sop');
        
        if (selectedDocumentId) {
            sopAnchor.href = `/documents/viewpdf/${selectedDocumentId}`;
            sopAnchor.style.display = 'inline';  // Show the link if document ID exists
        }
    });
</script>

<script>
    function fetchDocumentDetails2(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var documentNumber = selectedOption.getAttribute('data-doc-number');
        var documentId = selectedOption.getAttribute('data-sop-link');
        
        // Update the reference document number field
        document.getElementById('document_number1').value = documentNumber;
        
        // Update hidden input field for document ID
        document.getElementById('selected_document_id').value = documentId;

        // Update SOP view link
        var sopAnchor = document.getElementById('view_sop1');
        if (documentId) {
            sopAnchor.href = `/documents/viewpdf/${documentId}`;
            sopAnchor.style.display = 'inline';  // Show the link
        } else {
            sopAnchor.style.display = 'none';  // Hide if no document selected
        }}
        document.addEventListener("DOMContentLoaded", function() {
        var selectedDocumentId = document.getElementById('selected_document_id').value;
        var sopAnchor = document.getElementById('view_sop');
        
        if (selectedDocumentId) {
            sopAnchor.href = `/documents/viewpdf/${selectedDocumentId}`;
            sopAnchor.style.display = 'inline';  // Show the link if document ID exists
        }
    });
</script>
<script>
      function fetchDocumentDetails3(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var documentNumber = selectedOption.getAttribute('data-doc-number');
        var documentId = selectedOption.getAttribute('data-sop-link');
        
        // Update the reference document number field
        document.getElementById('document_number2').value = documentNumber;
        
        // Update hidden input field for document ID
        document.getElementById('selected_document_id').value = documentId;

        // Update SOP view link
        var sopAnchor = document.getElementById('view_sop2');
        if (documentId) {
            sopAnchor.href = `/documents/viewpdf/${documentId}`;
            sopAnchor.style.display = 'inline';  // Show the link
        } else {
            sopAnchor.style.display = 'none';  // Hide if no document selected
        }}
        document.addEventListener("DOMContentLoaded", function() {
        var selectedDocumentId = document.getElementById('selected_document_id').value;
        var sopAnchor = document.getElementById('view_sop');
        
        if (selectedDocumentId) {
            sopAnchor.href = `/documents/viewpdf/${selectedDocumentId}`;
            sopAnchor.style.display = 'inline';  // Show the link if document ID exists
        }
    });
</script>
<script>
        function fetchDocumentDetails4(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var documentNumber = selectedOption.getAttribute('data-doc-number');
        var documentId = selectedOption.getAttribute('data-sop-link');
        
        // Update the reference document number field
        document.getElementById('document_number3').value = documentNumber;
        
        // Update hidden input field for document ID
        document.getElementById('selected_document_id').value = documentId;

        // Update SOP view link
        var sopAnchor = document.getElementById('view_sop3');
        if (documentId) {
            sopAnchor.href = `/documents/viewpdf/${documentId}`;
            sopAnchor.style.display = 'inline';  // Show the link
        } else {
            sopAnchor.style.display = 'none';  // Hide if no document selected
        }}
</script>
<script>
        function fetchDocumentDetails5(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var documentNumber = selectedOption.getAttribute('data-doc-number');
        var documentId = selectedOption.getAttribute('data-sop-link');
        
        // Update the reference document number field
        document.getElementById('document_number4').value = documentNumber;
        
        // Update hidden input field for document ID
        document.getElementById('selected_document_id').value = documentId;

        // Update SOP view link
        var sopAnchor = document.getElementById('view_sop4');
        if (documentId) {
            sopAnchor.href = `/documents/viewpdf/${documentId}`;
            sopAnchor.style.display = 'inline';  // Show the link
        } else {
            sopAnchor.style.display = 'none';  // Hide if no document selected
        }}
</script>


                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <!-- Employee Name -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" placeholder="Select..." name="name_employee" required>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" data-name="{{ $employee->employee_name }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" id=""  >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Effective Date </label>
                                    <input type="date" name="effective_date" id="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee Code </label>
                                    <input type="text" name="employee_id" id="employee_ids" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <input type="text" name="new_department" id="departments" readonly>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Location <span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="city" readonly>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" id="designees"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" id="" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.getElementById('select-state').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    var employeeId = selectedOption.value;
                                    var employeeName = selectedOption.getAttribute('data-name');

                                    if (employeeId) {
                                        fetch(`/employees/${employeeId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById('employee_ids').value = data.full_employee_id;
                                                document.getElementById('departments').value = data.department;
                                                // document.getElementById('city').value = data.site_name;
                                                document.getElementById('designees').value = data.job_title;
                                                document.getElementById('experience').value = data.experience;
                                                document.getElementById('qualifications').value = data.qualification;
                                                document.getElementById('date_joinings').value = data.joining_date;
                                                document.getElementById('date_joining_displays').value = formatDate(data.joining_date);
                                            });
                                        document.getElementById('employee_name').value = employeeName;
                                    } else {
                                        document.getElementById('employee_ids').value = '';
                                        document.getElementById('departments').value = '';
                                        // document.getElementById('city').value = '';
                                        document.getElementById('designees').value = '';
                                        document.getElementById('experience').value = '';
                                        document.getElementById('qualifications').value = '';
                                        document.getElementById('employee_name').value = '';
                                        document.getElementById('date_joinings').value = '';
                                        document.getElementById('date_joining_displays').value = '';
                                    }
                                });

                                function formatDate(dateString) {
                                    const date = new Date(dateString);
                                    const options = {
                                        year: 'numeric',
                                        month: 'short',
                                        day: '2-digit'
                                    };
                                    return date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                }
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Experience With Agio Pharma </label>
                                    <input type="text" name="experience_with_agio" id="" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision" id="repeat_nature">Total Years of Experience </label>
                                    <input type="text" name="experience_if_any" id="experience" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="jd_type">Job Description Type</label>
                                    <select id="jd_type" name="jd_type">
                                        <option value="">Select JD Type...</option>
                                        <option value="new">New</option>
                                        <option value="old">Old</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reason for Revision Field -->
                            <div class="col-lg-6" id="revision_reason_container" style="display: none;">
                                <div class="group-input">
                                    <label for="reason_for_revision">Reason For Revision</label>
                                    <input type="text" name="reason_for_revision" id="reason_for_revision">
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Reason For Revision </label>
                                    <input type="text" name="reason_for_revision" id="" >
                                </div>
                            </div> --}}

                            <script>
                                    document.getElementById('jd_type').addEventListener('change', function() {
                                        var selectedValue = this.value;

                                        // Show the revision reason input if "Old" is selected
                                        if (selectedValue === 'old') {
                                            document.getElementById('revision_reason_container').style.display = 'block';
                                        } else {
                                            document.getElementById('revision_reason_container').style.display = 'none';
                                        }
                                    });

                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Delegate</label>
                                    <select id="select-state" placeholder="Select..." name="delegate" >
                                        <option value="">Select an delegate</option>
                                        @foreach ($delegate as $delegates)
                                        <option value="{{ $delegates->id }}" {{ old('delegates') == $delegates->id ? 'selected' : '' }}>
                                                {{ $delegates->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        <div class="col-12 sub-head">
                            Job Responsibilities
                        </div>

                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Job Responsibilities
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr No.</th>
                                            <th>Job Responsibilities </th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                            <td><input type="text" name="jobResponsibilities[0][job]"></td>
                                            <td><input type="text" name="jobResponsibilities[0][remarks]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                        

    </div>

                

    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                Exit </a> </button>

    </div>



    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remark</label>
                                    <textarea name="qa_cqa_comment" maxlength="255"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Attachment</label>
                                    <input type="file" id="myfile" name="qa_cqa_attachment" value="">
                                    <a href="" target="_blank"></a>
                                </div>
                            </div>
    
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>                                    
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            </div>
                        </div>
                    </div>
    </div>
    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remark</label>
                                    <textarea name="qa_cqa_comment" maxlength="255"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Attachment</label>
                                    <input type="file" id="myfile" name="qa_cqa_attachment" value="">
                                    <a href="" target="_blank"></a>
                                </div>
                            </div>
    
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>                                    
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            </div>
                        </div>
                    </div>
    </div>
    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remark</label>
                                    <textarea name="qa_cqa_comment" maxlength="255"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Attachment</label>
                                    <input type="file" id="myfile" name="qa_cqa_attachment" value="">
                                    <a href="" target="_blank"></a>
                                </div>
                            </div>
    
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>                                    
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
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
    $(document).ready(function() {
        $('#ObservationAdd').click(function(e) {
            function generateTableRow(serialNumber) {

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="jobResponsibilities[' + serialNumber +
                    '][serial]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="jobResponsibilities[' + serialNumber +
                    '][job]"></td>' +
                    '<td><input type="text" class="Document_Remarks" name="jobResponsibilities[' +
                    serialNumber + '][remarks]"></td>' +


                    '</tr>';

                return html;
            }

            var tableBody = $('#job-responsibilty-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
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
            $('#effect_check_date').val('{{ date('
                d - M - Y ') }}');
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