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

    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(7) {
            border-radius: 0px 20px 20px 0px;

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
            <strong>Job Description</strong>
            {{ Helpers::getDivisionName(session()->get('division')) }}
        </div>
    </div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}

    <div id="change-control-fields">
        <div class="container-fluid">


            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => 4])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp

                        <button class="button_theme1">
                            <a class="text-white" href="{{ route('auditTrail', $jobTraining->id) }}"> Audit Trail
                            </a>
                        </button>

                        @if ($jobTraining->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Submit
                            </button>
                        @elseif($jobTraining->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Accept JD Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                              Reject
                            </button>
                        @elseif($jobTraining->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Accept
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                              Reject
                            </button>
                        @elseif($jobTraining->stage == 4)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Approval Complete
                            </button>
                        @elseif($jobTraining->stage == 5)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Send To QA
                            </button>
                        {{-- @elseif($jobTraining->stage == 6)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Evaluation Complete
                            </button>
                        @elseif($jobTraining->stage == 7)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA/CQA Head Review Complete
                            </button> --}}
                        @elseif($jobTraining->stage == 6)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Closure
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                            </a> </button>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($jobTraining->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($jobTraining->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($jobTraining->stage >= 2)
                                <div class="active">In Accept JD</div>
                            @else
                                <div class="">In Accept JD</div>
                            @endif

                            @if ($jobTraining->stage >= 3)
                                <div class="active">In Responsible Person Accept</div>
                            @else
                                <div class="">In Responsible Person Accept</div>
                            @endif

                            {{-- @if ($jobTraining->stage >= 4)
                                <div class="active">QA/CQA Head Approval</div>
                            @else
                                <div class="">QA/CQA Head Approval</div>
                            @endif --}}
                            @if ($jobTraining->stage >= 4)
                                <div class="active">QA/CQA Head Approval</div>
                            @else
                                <div class="">QA/CQA Approval</div>
                            @endif
                            @if ($jobTraining->stage >= 5)
                                <div class="active">In Respected Department</div>
                            @else
                                <div class="">In Respected Department</div>
                            @endif
                            @if ($jobTraining->stage >= 6)
                                <div class="active">In QA JD Number Allocate</div>
                            @else
                                <div class="">In QA JD Number Allocate</div>
                            @endif
                            {{-- @if ($jobTraining->stage >= 7)
                                <div class="active">QA/CQA Head Final Review</div>
                            @else
                                <div class="">QA/CQA Head Final Review</div>
                            @endif

                            @if ($jobTraining->stage >= 8)
                                <div class="active">Verification and Approval</div>
                            @else
                                <div class="">Verification and Approval</div>
                            @endif --}}
                            @if ($jobTraining->stage >= 9)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- @endif --}}
            </div>
        </div>

        <div class="cctab">
            <!-- <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button> -->
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Job Description</button>

            <button class="cctablinks " onclick="openCity(event, 'CCForm3')">Employee Remarks</button>

            <button class="cctablinks " onclick="openCity(event, 'CCForm4')">QA/CQA Approval</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm6')">Responsible Person Accept Renarks</button>

            {{-- <button class="cctablinks " onclick="openCity(event, 'CCForm5')">Questionaries</button> --}}

            <!-- <button class="cctablinks " onclick="openCity(event, 'CCForm6')">Evaluation</button> -->
            @if ($jobTraining->stage >= 7)
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Certificate</button>
            @endif
            <button class="cctablinks " onclick="openCity(event, 'CCForm8')">Respected Department Remarks</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm9')">QA JD Number Remarks</button>

        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($jobTraining->stage, [9])) : ?>
                $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('job_descriptionupdate', ['id' => $jobTraining->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div id="step-form">

                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif



        <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" name="name_employee_disabled" disabled>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" 
                                                {{ $employee->id == old('name_employee', $jobTraining->name_employee) ? 'selected' : '' }}
                                                data-name="{{ $employee->employee_name }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="name_employee" value="{{ old('name_employee', $jobTraining->name_employee) }}">
                                    @error('employee_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" value="{{ old('job_description_no', $jobTraining->job_description_no) }}">
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" value="{{ old('job_description_no', $jobTraining->job_description_no) }}" @if($jobTraining->stage != 6) disabled @endif>
                                </div>
                            </div>

              
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">Effective Date </label>
                                    <input id="end_date" type="date" value="{{ old('effective_date', $jobTraining->effective_date) }}" name="effective_date" >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee ID </label>
                                    <input disabled type="text" name="employee_id" value="{{ $jobTraining->employee_id }}" id="employee_ids" readonly>


                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <select  name="new_department">
                                            <option value="">-- Select Dept --</option>
                                
                                            @php
                                                $savedDepartmentId = old('new_department', $jobTraining->new_department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" id="designees" value="{{ $jobTraining->designation }}"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" value="{{ $jobTraining->qualification }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" value="{{ old('total_experience', $jobTraining->total_experience) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" value="{{ $jobTraining->date_joining }}" >
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
                                    <input type="text" name="experience_with_agio" value="{{ old('experience_with_agio', $jobTraining->experience_with_agio) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Total Years of Experience </label>
                                    <input type="text" name="experience_if_any" id="" value="{{ $jobTraining->experience_if_any }}" readonly>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Reason For Revision </label>
                                    <input type="text" name="reason_for_revision" value="{{ old('reason_for_revision', $jobTraining->reason_for_revision) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
    <div class="group-input">
        <label for="jd_type">Job Description Status</label>
        <select id="jd_type" name="jd_type" >
            <option value="">Select...</option>
            <option value="new" {{ old('jd_type', $jobTraining->jd_type) === 'new' ? 'selected' : '' }}>New</option>
            <option value="old" {{ old('jd_type', $jobTraining->jd_type) === 'old' ? 'selected' : '' }}>Old</option>
        </select>
    </div>
</div>

<div class="col-lg-6" id="revision_reason_div" style="{{ $jobTraining->jd_type === 'old' ? 'display: block;' : 'display: none;' }}">
    <div class="group-input">
        <label for="reason_for_revision">Reason for Revision</label>
        <input type="text" name="reason_for_revision" id="reason_for_revision" value="{{ old('reason_for_revision', $jobTraining->reason_for_revision) }}">
    </div>
</div>

<script>
    // Initialize visibility of the revision reason field based on the current status
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('jd_type');
        var selectedValue = statusSelect.value;

        // Show or hide the reason for revision field based on selection
        if (selectedValue === 'old') {
            document.getElementById('revision_reason_div').style.display = 'block';
        } else {
            document.getElementById('revision_reason_div').style.display = 'none';
        }
    });

    document.getElementById('jd_type').addEventListener('change', function() {
        var selectedValue = this.value;

        // Show or hide the reason for revision field based on selection
        if (selectedValue === 'old') {
            document.getElementById('revision_reason_div').style.display = 'block';
        } else {
            document.getElementById('revision_reason_div').style.display = 'none';
            document.getElementById('reason_for_revision').value = ''; // Clear input when hiding
        }
    });
</script>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Delegate</label>
                                    <select name="delegate" id="hod">
                                            <option value="">-- Select Delegate --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == old('delegate', $jobTraining->delegate) ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>


                
                    <div class="col-12 sub-head">
                        Job Responsibilities
                    </div>
                    <div class="pt-2 group-input">
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
                                    @if ($employee_grid_data && is_array($employee_grid_data->data))
                                    @foreach ($employee_grid_data->data as $index => $employee_grid)
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}"></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}"></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                        <td><input type="text" name="jobResponsibilities[0][job]" ></td>
                                        <td><input type="text" name="jobResponsibilities[0][remarks]"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 

                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Reporting Authority: </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Responsible Person/s in absence </label>
                            <div class="static"></div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Accepted by (Employee): </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Authorized by (Head QA/CQA):  </label>
                            <div class="static"></div>
                        </div>
                    </div>--}}

            </div>
            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                <!-- <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                        Exit </a> </button> -->

            </div>
        </div>
        </div>

 

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="qa_review" maxlength="255">{{ $jobTraining->qa_review }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="qa_review_attachment" value="{{ $jobTraining->qa_review_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->qa_review_attachment) }}" target="_blank">{{ $jobTraining->qa_review_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="qa_cqa_comment" maxlength="255">{{ $jobTraining->qa_cqa_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="qa_cqa_attachment" value="{{ $jobTraining->qa_cqa_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->qa_cqa_attachment) }}" target="_blank">{{ $jobTraining->qa_cqa_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div id="questionsContainer" class="container">
                                <div>
                                    <!-- Questions will be dynamically injected here -->
                                </div>
                            </div>
                        
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>


                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="responsible_person_comment" maxlength="255">{{ $jobTraining->responsible_person_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="responsible_person_attachment" value="{{ $jobTraining->responsible_person_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->responsible_person_attachment) }}" target="_blank">{{ $jobTraining->responsible_person_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <!-- @if ($jobTraining->stage >= 3)
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="button-block">
                                        <button type="button" class="printButton" onclick="printCertificate()">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </div>
                                    <div class="certificate-container">
                                        <div class="certificate-title">TRAINING CERTIFICATE</div>

                                        <div class="certificate-description"><br><br>
                                            This is to certify that Mr./Ms./Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            has undergone On Job training including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                        </div>

                                        <div class="certificate-description">
                                            Therefore we certify that Mr. Ms. / Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            is capable of performing his/her assigned duties in the <strong>{{$jobTraining->department}}</strong> Department independently.
                                        </div>

                                        <div class="date-container">
                                        <div class="signature-block">
                                            <strong>Sign/Date:</strong>_________
                                            <div>HR Department</div>
                                        </div>

                                        <div>
                                                <strong>Sign/Date:</strong>_________
                                                <div class="signature">Head QA/CQA<div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 40px;" class="button-block">
                                <button type="submit" class=" btn btn saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class=" btn btn nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif -->

    <style>
                .certificate-container {
                width: 685px;
                height: 500px;
                border: 4px solid #3d6186;
                padding: 18px;
                background-color: white;
                position: relative;
                margin: auto;
                box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
            }
            .certificate-title {
                font-size: 30px;
                font-weight: bold;
                color: #677078;
                display: flex;
                justify-content: center;
            }
            .certificate-subtitle {
                font-size: 18px;
                color: #555;
            } 
            .certificate-description {
                margin-top: 30px;
                font-size: 18px;
                color: #333;
            }
            .date-container {
                display: flex;
                justify-content: space-between;
                margin-top: 60px;
                font-size: 18px;
            }
            .signature-container {
                position: absolute;
                bottom: 40px;
                right: 50px;
                text-align: center;
                font-size: 18px;
                color: #333;
            }

            @media print {
                .button-block {
                    display: none !important;
                }

                body * {
                    visibility: hidden;
                }

                #CCForm6, #CCForm6 * {
                    visibility: visible;
                }

                #CCForm6 {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }

            .button-block {
                display: flex;
                justify-content: flex-end;
                margin-top: 50px;
            }

            .printButton {
                background-color: #2c3e50;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                float: right;
            }

            .printButton:hover {
                background-color: #1a252f;
            }

            .printButton i {
                margin-right: 8px;
            }

            @media print {
                .button-block {
                    display: none !important;
                }

                body * {
                    visibility: hidden;
                }

                #CCForm6, #CCForm6 * {
                    visibility: visible;
                }

                #CCForm6 {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }

    </style>
      <script>
        function printCertificate() {
            var buttons = document.querySelectorAll(".button-block");
            buttons.forEach(button => button.style.display = 'none');

            window.print();

            buttons.forEach(button => button.style.display = 'flex');
        }
    </script>


                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="respected_department_comment" maxlength="255">{{ $jobTraining->respected_department_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="respected_department_attachment" value="{{ $jobTraining->respected_department_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->respected_department_attachment) }}" target="_blank">{{ $jobTraining->respected_department_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="final_review_comment" maxlength="255">{{ $jobTraining->final_review_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="final_review_attachment" value="{{ $jobTraining->final_review_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->final_review_attachment) }}" target="_blank">{{ $jobTraining->final_review_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/job_description_send', $jobTraining->id) }}" method="POST"
                    id="signatureModalForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>

                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>

                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('tms/jobTraining/cancelstage', $jobTraining->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" name="comments">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
