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

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(3) {
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
        <strong>Site Division/Project</strong> :
        {{ Helpers::getDivisionName(session()->get('division')) }} / Induction Training
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
                        Retire
                    </button>
                    @elseif($inductionTraining->stage == 2)
                    <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Retire
                    </button> -->
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

                    <!-- @if ($inductionTraining->stage >= 3)
                    <div class="active">Active </div>
                    @else
                    <div class="">Active</div>
                    @endif -->

                    @if ($inductionTraining->stage >= 2)
                    <div class="bg-danger">Closed - Done</div>
                    @else
                    <div class="">Closed - Retired</div>
                    @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>

        </div>

        <form action="{{ route('induction_training.update', $inductionTraining->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="step-form">

                {{-- @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif --}}
                <!-- General information content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" name="employee_id" value="{{ $inductionTraining->employee_id }}">
                                    {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="RLS Record Number">Name of Employee <span class="text-danger">*</span></label>
                                <input type="text" name="name_employee" id="name_employee" maxlength="255" value="{{ $inductionTraining->name_employee }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Division Code">Department & Location <span class="text-danger">*</span></label>
                                <input type="text" name="department_location" maxlength="255" value="{{ $inductionTraining->department_location }}">
                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Initiator Group Code">Designation <span class="text-danger">*</span></label>
                            <input type="text" name="designation" id="designation" maxlength="255" value="{{ $inductionTraining->designation }}">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="group-input">
                            <label for="Short Description">Qualification <span class="text-danger">*</span><span class="text-danger">
                                    <input id="docname" type="text" name="qualification" maxlength="255" value="{{ $inductionTraining->qualification }}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input" id="repeat_nature">
                            <label for="repeat_nature">Experience (if any)<span class="text-danger d-none">*</span></label>
                            <input type="text" name="experience_if_any" maxlength="255" value="{{ $inductionTraining->experience_if_any }}">
                        </div>
                    </div>


                    <div class="col-md-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="due-date">Date of Joining</label>
                            <div class="calenderauditee">
                                <input type="text" id="date_joining" value="{{  Helpers::getdateFormat($inductionTraining->date_joining) }}" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="date_joining" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'date_joining')" />
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