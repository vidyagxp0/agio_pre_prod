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
        <strong>Induction Training</strong>
        <!-- {{ Helpers::getDivisionName(session()->get('division')) }} / Induction Training -->
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
                    $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $inductionTraining->division_id])->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    // dd($jobTraining->division_id);
                    @endphp

                    <button class="button_theme1">
                        <a class="text-white" href="{{ route('induction_audittrail', $inductionTraining->id) }}"> Audit Trail
                        </a>
                    </button>

                    @if ($inductionTraining->stage == 1)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Send to Question-Answer
                    </button>
                    @elseif($inductionTraining->stage == 2)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Submit 
                    </button>
                    @elseif($inductionTraining->stage == 3)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Submitted 
                    </button>
                    @elseif($inductionTraining->stage == 4)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Certificate 
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                        Cancel
                    </button>
                    @elseif($inductionTraining->stage == 5)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Send On Job Training
                    </button>
                    @elseif($inductionTraining->stage == 6)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Closed-Done
                    </button>
                    @endif
                    <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                        </a> </button>


                </div>

            </div>
            <div class="status">
                <div class="head">Current Status</div>
                @if ($inductionTraining->stage == 0)
                <div class="progress-bars ">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div>
                @else
                <div class="progress-bars d-flex">
                    @if ($inductionTraining->stage >= 1)
                    <div class="active">Opened</div>
                    @else
                    <div class="">Opened</div>
                    @endif

                    @if ($inductionTraining->stage >= 2)
                    <div class="active">Question-Answer</div>
                    @else
                    <div class="">Question-Answer</div>
                    @endif
                    @if ($inductionTraining->stage >= 3)
                    <div class="active">Answer-Submit</div>
                    @else
                    <div class="">Answer-Submit</div>
                    @endif
                    @if ($inductionTraining->stage >= 4)
                    <div class="active">Final-Result</div>
                    @else
                    <div class="">Final-Result</div>
                    @endif

                    @if ($inductionTraining->stage >= 5)
                    <div class="active">Certification</div>
                    @endif

                    @if ($inductionTraining->stage >= 6)
                    <div class="active">On-The-Job-Training</div>
                    @else
                    <div class="">On-The-Job-Training</div>
                    @endif
                    @if ($inductionTraining->stage >= 7)
                    <div class="bg-danger">Closed - Done</div>
                    @else
                    <div class="">Closed - Done</div>
                    @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <!-- Tab links -->
        <!-- <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm3')">Questionaries</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm4')">Final Remarks</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm5')">Certificate</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">On The Job Training</button>

        </div> -->

        <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Questionaries</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Final Remarks</button>

                @if ($inductionTraining->stage >= 5)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Certificate</button>
                @endif

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">On The Job Training</button>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($inductionTraining->stage, [7])) : ?>
                    $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('induction_training.update', $inductionTraining->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="step-form">

                {{-- @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif --}}
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
         
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Name of Employee</label>
                                    <input disabled type="text" name="name_employee_display" id="name_employee_display" maxlength="255" value="{{ $inductionTraining->name_employee }}">
                                    <input type="hidden" name="name_employee" value="{{ $inductionTraining->name_employee }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Employee ID </label>
                                    <input disabled type="text" name="employee_id_display" value="{{ $inductionTraining->employee_id }}">
                                    <input type="hidden" name="employee_id" value="{{ $inductionTraining->employee_id }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code">Department</label>
                                    <select disabled name="department">
                                            <option value="">-- Select Dept --</option>
                                            @php
                                                $savedDepartmentId = old('department', $inductionTraining->department);
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
                                    <label for="Division Code">Location </label>
                                    <input disabled type="text" name="location_display" maxlength="255" value="{{ $inductionTraining->location }}">
                                    <input type="hidden" name="location" value="{{ $inductionTraining->location }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group Code">Designation </label>
                                    <input disabled type="text" name="designee_display" id="designee" maxlength="255" value="{{ $inductionTraining->designation }}">
                                    <input type="hidden" name="designation" value="{{ $inductionTraining->designation }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualification_display" disabled type="text" name="qualification_display" maxlength="255" value="{{ $inductionTraining->qualification }}">
                                    <input type="hidden" name="qualification" value="{{ $inductionTraining->qualification }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">Experience (if any)</label>
                                    <input disabled type="text" name="experience_if_any_display" maxlength="255" value="{{ $inductionTraining->experience_if_any }}">
                                    <input type="hidden" name="experience_if_any" value="{{ $inductionTraining->experience_if_any }}">
                                </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Date of Joining</label>
                                    <div class="calenderauditee">
                                        <input disabled type="text" id="date_joining_display" value="{{ Helpers::getdateFormat($inductionTraining->date_joining) }}" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="hidden" name="date_joining" value="{{ $inductionTraining->date_joining }}">
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
                                                        <textarea name="document_number_1" value="">{{ $inductionTraining->{"document_number_1"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_1" value="{{  Helpers::getdateFormat($inductionTraining->training_date_1) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_1')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                
                                                    <td>
                  
                                                    <label for="Attached CV"></label>
                                                    <input type="file" id="myfile" name="attachment_1" value="{{ $inductionTraining->attachment_1 }}">
                                                    <a href="{{ asset('upload/' . $inductionTraining->attachment_1) }}" target="_blank">{{ $inductionTraining->attachment_1 }}</a>
                
                                                    <!-- <input type="file" name="attachment_1" id="file-input" /> -->

                                                    </td>
                                                    <td>
                                                        <textarea name="remark_1">{{ $inductionTraining->{"remark_1"} }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td style="background: #DCD8D8">Personnel Hygiene</td>
                                                    <td>
                                                        <textarea name="document_number_2" value="">{{ $inductionTraining->{"document_number_2"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_2" value="{{  Helpers::getdateFormat($inductionTraining->training_date_2) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_2')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_2" value="{{ $inductionTraining->attachment_2 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_2) }}" target="_blank">{{ $inductionTraining->attachment_2 }}</a>
                                                        <!-- <input type="file" name="attachment_2" id="file-input" /> -->
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_2">{{ $inductionTraining->{"remark_2"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td style="background: #DCD8D8">Entry Exit Procedure in Factory premises</td>
                                                    <td>
                                                        <textarea name="document_number_3" value="">{{ $inductionTraining->{"document_number_3"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_3" value="{{  Helpers::getdateFormat($inductionTraining->training_date_3) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_3')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_3" value="{{ $inductionTraining->attachment_3 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_3) }}" target="_blank">{{ $inductionTraining->attachment_3 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_3">{{ $inductionTraining->{"remark_3"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                    <td>
                                                        <textarea name="document_number_4" value="">{{ $inductionTraining->{"document_number_4"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_4" value="{{  Helpers::getdateFormat($inductionTraining->training_date_4) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_4')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_4" value="{{ $inductionTraining->attachment_4 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_4) }}" target="_blank">{{ $inductionTraining->attachment_4 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_4">{{ $inductionTraining->{"remark_4"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td style="background: #DCD8D8">Data Integrity</td>
                                                    <td>
                                                        <textarea name="document_number_5" value="">{{ $inductionTraining->{"document_number_5"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_5" value="{{  Helpers::getdateFormat($inductionTraining->training_date_5) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_5')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_5" value="{{ $inductionTraining->attachment_5 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_5) }}" target="_blank">{{ $inductionTraining->attachment_5 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_5">{{ $inductionTraining->{"remark_5"} }}</textarea>
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
                                                        <textarea name="document_number_6" value="">{{ $inductionTraining->{"document_number_6"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_6" value="{{  Helpers::getdateFormat($inductionTraining->training_date_6) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_6" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_6')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_6" value="{{ $inductionTraining->attachment_6 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_6) }}" target="_blank">{{ $inductionTraining->attachment_6 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_6">{{ $inductionTraining->{"remark_6"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . b</td>
                                                    <td style="background: #DCD8D8"> Documentation</td>
                                                    <td>
                                                        <textarea name="document_number_7" value="">{{ $inductionTraining->{"document_number_7"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_7" value="{{  Helpers::getdateFormat($inductionTraining->training_date_7) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_7" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_7')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_7" value="{{ $inductionTraining->attachment_7 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_7) }}" target="_blank">{{ $inductionTraining->attachment_7 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_7">{{ $inductionTraining->{"remark_7"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . c</td>
                                                    <td style="background: #DCD8D8"> Process Control</td>
                                                    <td>
                                                        <textarea name="document_number_8" value="">{{ $inductionTraining->{"document_number_8"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_8" value="{{  Helpers::getdateFormat($inductionTraining->training_date_8) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_8" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_8')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_8" value="{{ $inductionTraining->attachment_8 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_8) }}" target="_blank">{{ $inductionTraining->attachment_8 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_8">{{ $inductionTraining->{"remark_8"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . d</td>
                                                    <td style="background: #DCD8D8"> Cross Contamination</td>
                                                    <td>
                                                        <textarea name="document_number_9" value="">{{ $inductionTraining->{"document_number_9"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_9" value="{{  Helpers::getdateFormat($inductionTraining->training_date_9) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_9" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_9')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_9" value="{{ $inductionTraining->attachment_9 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_9) }}" target="_blank">{{ $inductionTraining->attachment_9 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_9">{{ $inductionTraining->{"remark_9"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . e</td>
                                                    <td style="background: #DCD8D8"> Sanitization and Hygiene</td>
                                                    <td>
                                                        <textarea name="document_number_10" value="">{{ $inductionTraining->{"document_number_10"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_10" value="{{  Helpers::getdateFormat($inductionTraining->training_date_10) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_10" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_10')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_10" value="{{ $inductionTraining->attachment_10 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_10) }}" target="_blank">{{ $inductionTraining->attachment_10 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_10">{{ $inductionTraining->{"remark_10"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . f</td>
                                                    <td style="background: #DCD8D8"> Warehousing</td>
                                                    <td>
                                                        <textarea name="document_number_11" value="">{{ $inductionTraining->{"document_number_11"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_11" value="{{  Helpers::getdateFormat($inductionTraining->training_date_11) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_11" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_11')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_11" value="{{ $inductionTraining->attachment_11 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_11) }}" target="_blank">{{ $inductionTraining->attachment_11 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_11">{{ $inductionTraining->{"remark_11"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . g</td>
                                                    <td style="background: #DCD8D8"> Complaint and Recall</td>
                                                    <td>
                                                        <textarea name="document_number_12" value="">{{ $inductionTraining->{"document_number_12"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_12" value="{{  Helpers::getdateFormat($inductionTraining->training_date_12) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_12" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_12')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_12" value="{{ $inductionTraining->attachment_12 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_12) }}" target="_blank">{{ $inductionTraining->attachment_12 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_12">{{ $inductionTraining->{"remark_12"} }}</textarea>
                                                    </td>
                                                <tr>
                                                    <td>6 . h</td>
                                                    <td style="background: #DCD8D8"> Utilities</td>
                                                    <td>
                                                        <textarea name="document_number_13" value="">{{ $inductionTraining->{"document_number_13"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_13" value="{{  Helpers::getdateFormat($inductionTraining->training_date_13) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_13" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_13')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_13" value="{{ $inductionTraining->attachment_13 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_13) }}" target="_blank">{{ $inductionTraining->attachment_13 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_13">{{ $inductionTraining->{"remark_13"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . i</td>
                                                    <td style="background: #DCD8D8"> Water</td>
                                                    <td>
                                                        <textarea name="document_number_14" value="">{{ $inductionTraining->{"document_number_14"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_14" value="{{  Helpers::getdateFormat($inductionTraining->training_date_14) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_14" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_14')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_14" value="{{ $inductionTraining->attachment_14 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_14) }}" target="_blank">{{ $inductionTraining->attachment_14 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_14">{{ $inductionTraining->{"remark_14"} }}</textarea>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6 . j</td>
                                                    <td style="background: #DCD8D8"> Safety Module</td>
                                                    <td>
                                                        <textarea name="document_number_15" value="">{{ $inductionTraining->{"document_number_15"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_15" value="{{  Helpers::getdateFormat($inductionTraining->training_date_15) }}" readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_15" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'training_date_15')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_15" value="{{ $inductionTraining->attachment_15 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_15) }}" target="_blank">{{ $inductionTraining->attachment_15 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_15">{{ $inductionTraining->{"remark_15"} }}</textarea>
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

                                    <select name="hr_name" value="{{ $inductionTraining->hr_name }}">
                                        <option value="0">-- Select --</option>
                                        <option value="hr" {{ $inductionTraining->hr_name == "hr" ? 'selected' : '' }}>HR </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="severity-level">Trainee Name</label>

                                    <select name="trainee_name" value="{{ $inductionTraining->trainee_name }}">
                                        <option value="0">-- Select --</option>
                                        <option value="trainee1" {{ $inductionTraining->trainee_name == "trainee1" ? 'selected' : '' }}>trainee 1</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>
                

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="col-12 sub-head">
                            Questionaries
                        </div>
                        <div class="pt-2 group-input">
                            <label for="audit-agenda-grid">
                                Questionaries
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd" @if($inductionTraining->stage != 2) disabled @endif>+</button>
                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr No.</th>
                                            <th>Questions</th>
                                            <th>Answer Fillup by Employee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($employee_grid_data && is_array($employee_grid_data->data))
                                        @foreach ($employee_grid_data->data as $index => $employee_grid)
                                        <tr>
                                            <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                            <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}" class="question-input" @if($inductionTraining->stage != 2 && $inductionTraining->stage != 3) disabled @endif></td>
                                            <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}" class="answer-input" @if($inductionTraining->stage != 3) disabled @endif></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                            <td><input type="text" name="jobResponsibilities[0][job]" class="question-input" @if($inductionTraining->stage != 2 && $inductionTraining->stage != 3) disabled @endif></td>
                                            <td><input type="text" name="jobResponsibilities[0][remarks]" class="answer-input" @if($inductionTraining->stage != 3) disabled @endif></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="" @if($inductionTraining->stage != 2 && $inductionTraining->stage != 3) disabled @endif>Save</button>
                         <a href="TMS">
                                <button type="button" class="backButton">Back</button>
                            </a>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                        <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="final_r_comment" maxlength="255">{{ $inductionTraining->final_r_comment }}</textarea>
                                </div>
                            </div>
                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Attachment">Final Attachment</label>
                                        <input type="file" id="myfile" name="final_r_attachment" value="{{ $inductionTraining->final_r_attachment }}">
                                        <a href="{{ asset('upload/' . $inductionTraining->final_r_attachment) }}" target="_blank">{{ $inductionTraining->final_r_attachment }}</a>
                                    </div>
                                </div>

                        </div>
                        <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <a href="/rcms/qms-dashboard">
                                            <button type="button" class="backButton">Back</button>
                                        </a>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                                        <!-- <button type="submit">Submit</button> -->
                                 
                    </div>
                </div>
                </div>

                @if ($inductionTraining->stage == 5)
                <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="certificate-container">
                                        <div class="certificate-title">TRAINING CERTIFICATE</div>

                                        <div class="certificate-description"><br><br>
                                            This is to certify that Mr./Ms./Mrs. <strong>{{$inductionTraining->name_employee}}</strong>.
                                            has undergone Induction training including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                        </div>

                                        <div class="certificate-description">
                                            Therefore we certify that Mr. Ms. / Mrs. <strong>{{$inductionTraining->name_employee}}</strong>.
                                            is capable of performing his/her assigned duties in the <strong>{{$inductionTraining->department}}</strong> Department independently.
                                        </div>

                                        <div class="date-container">
                                            <div>Sign/Date</div>
                                            <div class="signature">Head Department</div>
                                        </div>

                                        <div class="signature-container">
                                            <div>Sign/Date</div>
                                            <div class="signature">Head QAICQA</div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 40px;" class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <script>
                    document.getElementById("saveForm").addEventListener("click", function(event) {
                        let questionInputs = document.querySelectorAll(".question-input");
                        let answerInputs = document.querySelectorAll(".answer-input");
                        let allFilled = true;

                        questionInputs.forEach(function(input) {
                            if (input.value.trim() === "") {
                                allFilled = false;
                            }
                        });

                        answerInputs.forEach(function(input) {
                            if (input.value.trim() === "") {
                                allFilled = false;
                            }
                        });

                        if (!allFilled) {
                            event.preventDefault();
                            alert("Please fill required field before submitting.");
                        }
                    });
                </script>


                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remark</label>
                                    <textarea name="on_the_job_comment" maxlength="255">{{ $inductionTraining->on_the_job_comment }}</textarea>
                                </div>
                            </div>
                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Attachment">Induction Training Attachment</label>
                                        <input type="file" id="myfile" name="on_the_job_attachment" value="{{ $inductionTraining->on_the_job_attachment }}">
                                        <a href="{{ asset('upload/' . $inductionTraining->on_the_job_attachment) }}" target="_blank">{{ $inductionTraining->on_the_job_attachment }}</a>
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

<style>
 
        .certificate-container {
            width: 1000px;
            height: 500px;
            border: 4px solid #00000061;
            padding: 18px;
            background-color: white;
            position: relative;
            margin: auto;
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
            position: absolute;
            bottom: 40px;
            left: 50px;
            font-size: 18px;
            color: #333;
        }
        .signature-container {
            position: absolute;
            bottom: 40px;
            right: 50px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
        .signature {
            margin-top: 10px;
            border-top: 1px solid #333;
            width: 200px;
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



<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ url('tms/induction/sendstage', $inductionTraining->id) }}" method="POST" id="signatureModalForm">
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
                        <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none" role="status">
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

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('tms/induction/cancelstage', $inductionTraining->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
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