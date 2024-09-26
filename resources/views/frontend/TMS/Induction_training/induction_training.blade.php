@extends('frontend.layout.main')
@section('container')
@php
$users = DB::table('users')->get();
@endphp

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
        <strong>Induction Training</strong>
        <!-- {{ Helpers::getDivisionName(session()->get('division')) }} / Induction Training -->
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
                {{-- General information content --}}

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">


                            {{-- <div class="col-lg-6">
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
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" placeholder="Select..." name="name_employee">
                                        @if(isset($employee))
                                            <option value="{{ $employee->id }}" selected>{{ $employee->employee_name }}</option>
                                        @else 
                                            <option value="">Select an employee</option>
                                            @foreach ($employees as $emp)
                                                <option value="{{ $emp->id }}" data-name="{{ $emp->employee_name }}">
                                                    {{ $emp->employee_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee ID </label>
                                    <input type="text" name="employee_id" value ="{{ isset($employee) ? $employee->full_employee_id : '' }}" id="employee_id" required readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <input type="text" name="department" value ="{{ isset($employee) ? $employee->department ?? 'NA' : '' }}" id="department" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Location </label>
                                    <input type="text" name="location" value ="{{ isset($employee) ? $employee->site_name : '' }}" id="city" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" value ="{{ isset($employee) ? $employee->job_title : '' }}"  id="designee" required readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualification" type="text" value ="{{ isset($employee) ? $employee->qualification : '' }}"  name="qualification" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">Experience (if any)</label>
                                    <input type="text" name="experience_if_any" value ="{{ isset($employee) ? $employee->experience : '' }}"  id="experience" required readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_display" value ="{{ isset($employee) ? \Carbon\Carbon::parse($employee->joining_date)->format('d-M-Y') : '' }}" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joining" value ="{{ isset($employee) ? $employee->joining_date : '' }}"  class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" readonly/>
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
                                                document.getElementById('employee_id').value = data.full_employee_id;
                                                document.getElementById('department').value = data.department;
                                                // document.getElementById('department').value = data.department; 
                                                document.getElementById('city').value = data.site_name;
                                                document.getElementById('designee').value = data.job_title;
                                                document.getElementById('experience').value = data.experience;
                                                document.getElementById('qualification').value = data.qualification;
                                                document.getElementById('date_joining').value = data.joining_date;
                                                document.getElementById('date_joining_display').value = formatDate(data.joining_date);
                                            });
                                        document.getElementById('employee_name').value = employeeName;
                                    } else {
                                        document.getElementById('employee_id').value = '';
                                        document.getElementById('department').value = '';
                                        document.getElementById('city').value = '';
                                        document.getElementById('designee').value = '';
                                        document.getElementById('experience').value = '';
                                        document.getElementById('qualification').value = '';
                                        document.getElementById('employee_name').value = '';
                                        document.getElementById('date_joining').value = '';
                                        document.getElementById('date_joining_display').value = '';
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
                                    <label for="hod">Evaluation Required</label>
                                    <select name="evaluation_required" id="" >
                                        <option value="">----Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
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
                                                    {{-- <th>Trainee Sign/Date </th>--}}
                                                        <th>Attachment</th>
                                                    <th>Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td style="background: #DCD8D8">Introduction of Agio Plant</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_1"></textarea> -->
                                                    <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_1" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_1" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_1')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_1">
                                                    </td>

                                                    <td>
                                                        <textarea name="remark_1"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td style="background: #DCD8D8">Personnel Hygiene</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_2"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_2" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_2" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_2')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <label for="Attached "></label>
                                                    <input type="file" id="myfile" name="attachment_2">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_2"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td style="background: #DCD8D8">Entry Exit Procedure in Factory premises</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_3"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_3" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_3" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_3')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <label for="Attached "></label>
                                                    <input type="file" id="myfile" name="attachment_3">
                                                    </td>

                                                    <td>
                                                        <textarea name="remark_3"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_4"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_4" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_4" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_4')" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_4">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_4"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td style="background: #DCD8D8">Data Integrity</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_5"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_5" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_5" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_5')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_5">
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
                                                    <td style="background: #DCD8D8"> GMP</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_6"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_6" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_6" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_6')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_6">
                                                    </td>

                                                    <td>
                                                        <textarea name="remark_6"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . b</td>
                                                    <td style="background: #DCD8D8"> Documentation</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_7"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_7" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_7" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_7')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_7">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_7"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 .c</td>
                                                    <td style="background: #DCD8D8"> Process Control</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_8"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_8" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_8" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_8')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_8">
                                                    </td>

                                                    <td>
                                                        <textarea name="remark_8"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . d</td>
                                                    <td style="background: #DCD8D8">d. Cross Contamination</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_9"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_9" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_9" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_9')" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_9">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_9"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . e</td>
                                                    <td style="background: #DCD8D8"> Sanitization and Hygiene</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_10"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_10" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_10" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_10')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_10">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_10"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . f</td>
                                                    <td style="background: #DCD8D8"> Warehousing</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_11"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_11" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_11" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_11')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_11">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_11"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . g</td>
                                                    <td style="background: #DCD8D8"> Complaint and Recall</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_12"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_12" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_12" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_12')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_12">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_12"></textarea>
                                                    </td>
                                                <tr>
                                                    <td>6 . h</td>
                                                    <td style="background: #DCD8D8"> Utilities</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_13"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_13" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_13" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_13')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <label for="Attached "></label>
                                                    <input type="file" id="myfile" name="attachment_13">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_13"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . i</td>
                                                    <td style="background: #DCD8D8"> Water</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_14"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_14" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_14" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_14')" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_14">
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_14"></textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td> 6 . j</td>
                                                    <td style="background: #DCD8D8"> Safety Module</td>
                                                    <td>
                                                        <!-- <textarea name="document_number_15"></textarea> -->
                                                        <select name="document_number_1">
                                                        @foreach ($data as $item)
                                                        <option value="">----Select---</option>
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_15" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_15" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_15')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached "></label>
                                                        <input type="file" id="myfile" name="attachment_15">
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
                                    <label for="severity-level">HR Department</label>
                                    <select name="hr_name">
                                        <option value="hr" selected>HR</option>
                                    </select>
                                </div>
                            </div>

                         
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="training_type">Type of Training</label>
                                    <select name="training_type" id="training_type" onchange="handleTrainingTypeChange()">
                                        <option value="">-- Select --</option>
                                        <option value="self-reading">Self-Reading</option>
                                        {{-- <option value="classroom">Classroom</option>
                                        <option value="hands-on">Hands-On</option>
                                        <option value="virtual">Virtual</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="trainer_name">Trainer Name</label>
                                    <select id="trainer_name" name="trainee_name">
                                        <option value="">-- Select Trainer --</option>
                                        <option value="trainer_1">Trainer 1</option>
                                        <option value="trainer_2">Trainer 2</option>
                                        <option value="trainer_3">Trainer 3</option>
                                        <option value="trainer_4">Trainer 4</option>
                                        <option value="trainer_5">Trainer 5</option>
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

<script>
function handleTrainingTypeChange() {
    var trainingType = document.getElementById("training_type").value;
    var trainerSelect = document.getElementById("trainer_name");

    if (trainingType === "self-reading") {
        // If self-reading is selected, set trainer name to "N/A" and disable the dropdown
        trainerSelect.innerHTML = '<option value="N/A">N/A</option>';
        trainerSelect.disabled = true;
    } else {
        // Enable the dropdown and reset to show 5 trainers
        trainerSelect.innerHTML = `
            <option value="">-- Select Trainer --</option>
            <option value="trainer_1">Trainer 1</option>
            <option value="trainer_2">Trainer 2</option>
            <option value="trainer_3">Trainer 3</option>
            <option value="trainer_4">Trainer 4</option>
            <option value="trainer_5">Trainer 5</option>`;
        trainerSelect.disabled = false;
    }
}
</script>

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