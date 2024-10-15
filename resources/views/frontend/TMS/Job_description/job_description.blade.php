@extends('frontend.layout.main')
@section('container')
@php
$users = DB::table('users')->select('id', 'name')->get();
$divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
$departments = DB::table('departments')->select('id', 'name')->get();

@endphp

<style>
    label.error {
        color: red;
    }
</style>

<script>
    $(document).ready(function() {
        let auditForm = $('form#auditform')

        $('#ChangesaveButton').on('click', function(e) {
            console.log('submit test')
            let isValid = auditForm.validate();

            if (!isValid) {
                e.preventDefault();
            }
        })

    });
</script>
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
<script>
    $(function() {
        $("#datepicker").datepicker();
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
    function addAuditAgenda(tableId) {
        var table = document.getElementById(tableId);
        var currentRowCount = table.rows.length;
        var newRow = table.insertRow(currentRowCount);
        newRow.setAttribute("id", "row" + currentRowCount);
        var cell1 = newRow.insertCell(0);
        cell1.innerHTML = currentRowCount;

        var cell2 = newRow.insertCell(1);
        cell2.innerHTML = "<input type='text'>";

        var cell3 = newRow.insertCell(2);
        cell3.innerHTML = "<input type='date'>";

        var cell4 = newRow.insertCell(3);
        cell4.innerHTML = "<input type='time'>";

        var cell5 = newRow.insertCell(4);
        cell5.innerHTML = "<input type='date'>";

        var cell6 = newRow.insertCell(5);
        cell6.innerHTML = "<input type='time'>";

        var cell7 = newRow.insertCell(6);
        cell7.innerHTML =
            // '<select name="auditor"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell8 = newRow.insertCell(7);
        cell8.innerHTML =
            // '<select name="auditee"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell9 = newRow.insertCell(8);
        cell9.innerHTML = "<input type='text'>";
        for (var i = 1; i < currentRowCount; i++) {
            var row = table.rows[i];
            row.cells[0].innerHTML = i;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#internalaudit-table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="audit[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' +
                    serialNumber +
                    '_checkdate" min="{{ \Carbon\Carbon::now()->format('
                Y - m - d ') }}"  class="hide-input" oninput="handleDateInput(this, scheduled_start_date' +
                    serialNumber + ');checkDate(scheduled_start_date' + serialNumber +
                    '_checkdate,scheduled_end_date' + serialNumber +
                    '_checkdate)" /></div></div></div></td>' +
                    '<td><input type="time" name="scheduled_start_time[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
                    serialNumber +
                    '_checkdate"  min="{{ \Carbon\Carbon::now()->format('
                Y - m - d ') }}"class="hide-input" oninput="handleDateInput(this, scheduled_end_date' +
                    serialNumber + ');checkDate(scheduled_start_date' + serialNumber +
                    '_checkdate,scheduled_end_date' + serialNumber +
                    '_checkdate)" /></div></div></div></td>' +
                    '<td><input type="time" name="scheduled_end_time[]"></td>' +
                    '<td><select name="auditor[]">' +
                    '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }

                html += '</select></td>' +
                    '<td><select name="auditee[]">' +
                    '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }
                html += '</select></td>' +
                    '<td><input type="text" name="remarks[]"></td>' +
                    '</tr>';

                return html;
            }

            var tableBody = $('#internalaudit tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#attachmentgrid-table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][serial_number]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][title_of document]"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][supporting_document]"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][remarks]"></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }


                '</tr>';

                return html;
            }

            var tableBody = $('#attachmentgrid tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Trainer_Skill_table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="trainer_skill[' + serialNumber +
                    '][serial_number]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="trainer_skill[' + serialNumber +
                    '][Trainer_skill_set]"></td>' +

                    '<td><input type="text" name="trainer_skill[' + serialNumber +
                    '][remarks]"></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }


                '</tr>';

                return html;
            }

            var tableBody = $('#Trainer_Skill_table_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>



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

<style>
    .calenderauditee {
        position: relative;
    }

    .new-date-data-field input.hide-input {
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
<div class="form-field-head">

    <div class="division-bar">
        <strong>Job Description</strong>
        {{-- <strong>Site Division/Project</strong> : --}}
    </div>
</div>



{{-- ======================================
                    DATA FIELDS
    ======================================= --}}




<div id="change-control-fields">
    <div class="container-fluid">


        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Job Description</button>

            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
        </div>

        <form id="auditform" action="{{ route('job_descriptioncreate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="step-form">

                <!-- General information content -->
                <!-- <div id="CCForm1" class="inner-block cctabcontent"> -->


            <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                 

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="location">Name of Employee</label>
                                    <input id="selected_employee_id" type="text" value ="{{ $mainvalue->employee_name}}" name="name_employee" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" id="" disabled >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Effective Date </label>
                                    <input type="date" name="effective_date" id="">
                                </div>
                            </div>

                            <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee Code </label>
                                    <input type="text" name="employee_id" id="employee_ids" readonly>
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee Code </label>
                                    <input type="text" name="employee_id" value ="{{$mainvalue->full_employee_id}}" id="employee_id"  readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <input type="text" name="new_department" value="{{ Helpers::getDepartments()[$mainvalue->department]}}" id="departments" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" value="{{$mainvalue->job_title}}" id="designees"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" value="{{$mainvalue->qualification}}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" id="" >
                                </div>
                            </div>

                            {{-- <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays"  placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" />
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Date of Joining </label>
                                    <input type="date" name="date_joining" id="">
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
            

<!-- Activity Log content -->
<div id="CCForm6" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Submitted On">Submitted By</label>
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
                    <label for="Qualified By">Qualified By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Qualified On">Qualified On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for=" Rejected By">Rejected By</label>
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
            <a href="/rcms/qms-dashboard">
                <button type="button" class="backButton">Back</button>
            </a>
            <button type="submit">Submit</button>
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
    document.getElementById('myfile').addEventListener('change', function() {
        var fileListDiv = document.querySelector('.file-list');
        fileListDiv.innerHTML = ''; // Clear previous entries

        for (var i = 0; i < this.files.length; i++) {
            var file = this.files[i];
            var listItem = document.createElement('div');
            listItem.textContent = file.name;
            fileListDiv.appendChild(listItem);
        }
    });
</script>


<script>
    VirtualSelect.init({
        ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #trainerSkillSet'
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
</script>
<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection


@section('footer_cdn')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js" integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection