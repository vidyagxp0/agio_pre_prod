@extends('frontend.layout.main')
@section('container')
@if (Helpers::checkRoles(6))
@include('frontend.TMS.head')
@endif

@php
$divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
@endphp

<style>
    .cctab {
        display: flex;
        justify-content: left;
        margin-bottom: 20px;
        padding: 10px;
    }

    .cctablinks {
        background-color: #ffffff;
        border-radius: 5px;
        padding: 6px 12px;
        margin: 0 5px;
        cursor: pointer;
        font-size: 16px;
        color: #333;
        border: none;
    }

    .cctablinks:hover {
        background-color: #ddd;
        color: #000;
    }

    .cctablinks.active {
        background-color: #3a424b;
        /* background-color: #007bff; */
        color: white;
    }

    .cctabcontent {
        padding: 20px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<script>
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

    const saveButtons = document.querySelectorAll('.saveButton1');
    const form = document.getElementById('step-form');
</script>

{{-- ======================================
                    DASHBOARD
    ======================================= --}}
<div id="tms-dashboard">
    <div class="container-fluid">
        <div class="dashboard-container">

            <div class="inner-block main-block">
                <div class="top">
                    <div class="d-flex align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-gauge-high"></i>
                        </div>
                        <div class="name">
                            <div>Dashboard</div>
                            <div>TMS Dashboard</div>
                        </div>
                    </div>
                    <div class="doc-links d-flex">
                        {{-- <button>Print</button> --}}
                        <a href="javascript:window.location.reload(true)">Refresh</a>
                        {{-- <a data-bs-toggle="modal" data-bs-target="#subscribe-modal">Subscribe</a> --}}
                        {{-- <a href="#"><i class="fa-solid fa-caret-down"></i></a> --}}
                    </div>
                </div>
            </div>
            <div class="cctab">

                @if (Helpers::checkRoles(6))
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">My Training</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm5')">On The Job Training</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm6')">Induction Training</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Employee</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm4')">Trainer Qualification</button>
                @endif
                @if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(3) || Helpers::checkRoles(4)|| Helpers::checkRoles(5) || Helpers::checkRoles(7) || Helpers::checkRoles(8))
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Assigned To Me</button>
                @endif
            </div>

            {{-- <div class="tms-dashboard-tabs">
                    <div class="inner-block tab-btn active">
                        <input type="radio" name="dash-tabs" data-target="tms-all-block" checked>
                        <div><i class="fa-solid fa-bars-progress"></i>&nbsp;All</div>
                    </div>
                    <div class="inner-block tab-btn">
                        <input type="radio" name="dash-tabs" data-target="tms-assigned-block">
                        <div><i class="fa-solid fa-clock-rotate-left fa-flip-horizontal"></i>&nbsp;Assigned</div>
                    </div>
                    <div class="inner-block tab-btn">
                        <input type="radio" name="dash-tabs" data-target="tms-pending-block">
                        <div><i class="fa-solid fa-bars-progress"></i>&nbsp;Employee</div>
                    </div>
                    <div class="inner-block tab-btn">
                        <input type="radio" name="dash-tabs" data-target="tms-completed-block">
                        <div><i class="fa-solid fa-bars-progress"></i>&nbsp;Training Qualification</div>
                    </div>
                </div> --}}

            {{-- ================CC Form1================ --}}

            <div id="CCForm1" class="inner-block tms-block cctabcontent" style="margin-top:50px; display:block;">
                @if (Helpers::checkRoles(6))
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Training Plan</th>
                                <th>Number of Documents</th>
                                <th>Effective Criteria</th>
                                <th>Number of Trainees </th>
                                <th>Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $temp)
                            @if(!empty($temp->training) && $temp->training->stage >=6)
                            <tr>
                                @php
                                $trainingPlan = DB::table('trainings')->where('id',$temp->training_plan)->first();
                                if ($trainingPlan) {
                                $traineesCount = count(explode(',', $trainingPlan->trainees));
                                $sopsCount = count(explode(',', $trainingPlan->sops));
                                }
                                @endphp
                                @if($trainingPlan)
                                <td>{{ DB::table('trainings')->where('id', $temp->training_plan)->value('traning_plan_name') }}</td>
                                {{-- <td>{{ $temp->division_name }}/{{ $temp->typecode }}/
                                000{{ $temp->root_document ? $temp->root_document->document_number : '' }}/{{ $temp->year }}/R{{$temp->major}}.{{$temp->minor}}</td> --}}
                                <td>{{ $trainingPlan ? $sopsCount : 0 }}</td>
                                <td>{{ $trainingPlan ? $trainingPlan->effective_criteria : 0 }}</td>
                                <td>{{ $trainingPlan ? $traineesCount : 0 }}</td>
                                <td>{{ $temp->status == "Assigned" ? "Pending" : $temp->status }}</td>

                                {{-- <td>
                                                <a href="#"><i class="fa-solid fa-eye"></i></a>
                                            </td> --}}
                                <td><a href="{{ url('training-overall-status', $temp->training_plan) }}"><i class="fa-solid fa-eye"></i></a></td>
                                @endif
                            </tr>
                            @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            {{-- ================CC Form2================ --}}

            <div id="CCForm2" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                @if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(3) || Helpers::checkRoles(4)|| Helpers::checkRoles(5) || Helpers::checkRoles(7) || Helpers::checkRoles(8))
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                {{-- <th style="width:15%;">Document Number</th> --}}
                                <th>Training Plan</th>
                                <th>Document Title</th>
                                <th>Trainer Name</th>
                                <th>Overall Training Status</th>
                                <th>Due Date</th>
                                <th>My Training Completion date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="searchTable">
                            @foreach ($documents2 as $temp)
                            @php
                            $trainingStatusCheck = DB::table('training_statuses')
                            ->where([
                            'user_id' => Auth::user()->id,
                            'sop_id' => $temp->id,
                            'training_id' => $temp->traningstatus->training_plan,
                            'status' => 'Complete'
                            ])->first();
                            $trainingPlanName = DB::table('trainings')
                            ->where('id', $temp->traningstatus->training_plan)
                            ->first();
                            $traininerName = DB::table('users')
                            ->where('id', $trainingPlanName->trainner_id)
                            ->first();
                            @endphp
                            <tr>
                                <td>{{ $trainingPlanName ? $trainingPlanName->traning_plan_name : ''}}</td>
                                <td>{{ $temp->document_name }}</td>
                                <td>{{ $traininerName ? $traininerName->name : ''}}</td>
                                <td>{{ $temp->traningstatus->status }}</td>
                                <td>{{ \Carbon\Carbon::parse($temp->due_dateDoc)->format('d M Y') }}</td>
                                <td>
                                    {{ $trainingStatusCheck ? \Carbon\Carbon::parse($trainingStatusCheck->created_at)->format('d M Y') : '-' }}
                                </td>
                                @if($trainingStatusCheck)
                                <th>Completed</th>
                                @else
                                @if($temp->traningstatus->status == "Complete")
                                <th>Training Criteria Met</th>
                                @elseif( $temp->due_dateDoc < now()) <th>Training Date Passed</th>

                                    @else
                                    <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
                                    @endif
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            {{-- ================employee Data================ --}}

            <div id="CCForm3" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10%;">Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Job Title</th>
                            <th>Assigned To</th>
                            <th>Joining Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    {{-- @php
                            $employees = DB::table('employees')->get();
                            // dd($employees);
                        @endphp --}}
                    <tbody>
                        @foreach ($employees->sortbyDesc('id') as $employee)
                        <tr>
                            <td><a href="{{ url('employee_view', $employee->id) }}">{{ $employee->employee_id }}</a></td>
                            <td>{{ $employee->employee_name ? $employee->employee_name : 'NA' }}</td>
                            <td>{{Helpers::getFullDepartmentName($employee->department) ? Helpers::getFullDepartmentName($employee->department) : 'NA' }}</td>
                            <td>{{ $employee->job_title ? $employee->job_title : 'NA' }}</td>
                            <td>{{ $employee->user_assigned ? $employee->user_assigned->name : 'NA' }}</td>
                            <td>{{ Helpers::getdateFormat($employee->joining_date) }}</td>
                            <td>{{ $employee->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- ===============training Data================ --}}

            <div id="CCForm4" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Trainer Name</th>
                                <th>Department</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainers->sortbyDesc('id') as $trainer)
                            <tr>
                                <td><a href="{{ url('trainer_qualification_view', $trainer->id) }}">000{{ $trainer->id }}</a></td>
                                <td>{{ $trainer->trainer_name ? $trainer->trainer_name : 'NA' }}</td>
                                <td>{{ Helpers::getFullDepartmentName($trainer->department) ? Helpers::getFullDepartmentName($trainer->department) : 'NA' }}</td>
                                <td>{{ Helpers::getdateFormat($trainer->due_date) }}</td>
                                <td>{{ $trainer->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <!-- second table for qualification trainer -->
                <div>
                    <table class="table table-bordered">
                        <h4>Qualified Trainer</h4>
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Qualified Trainer Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Qualification Status</th>
                                <th>Certificate</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainers->sortbyDesc('id') as $trainer)

                            <!-- @if ($trainer->trainer=='Qualified') -->
                            <tr>
                                <td><a href="{{ url('trainer_qualification_view', $trainer->id) }}">000{{ $trainer->id }}</a></td>
                                <td>{{ $trainer->trainer_name ? $trainer->trainer_name : 'NA' }}</td>
                                <td>{{ $trainer->designation ? $trainer->designation : 'NA' }}</td>
                                <td>{{ Helpers::getFullDepartmentName($trainer->department) ? Helpers::getFullDepartmentName($trainer->department) : 'NA' }}</td>
                                {{-- <td>{{ $trainer->trainer ? $trainer->trainer: 'NA' }}</td> --}}
                                <td>{{ $trainer->status }}</td>

                                <td>
                                    @if($trainer->initial_attachment)
                                    <a href="{{ asset('upload/' . $trainer->initial_attachment) }}" target="_blank" download>
                                        {{ $trainer->initial_attachment }} <i class="fas fa-download"></i>
                                    </a>
                                    @else
                                    NA
                                    @endif
                                </td>
                                <!-- <td>{{ $trainer->status }}</td> -->
                            </tr>
                            <!-- @endif -->
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>


            {{-- ===============On the job================ --}}
            <div id="CCForm5" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Start Date of Training</th>
                                <th>End Date of Training</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobTrainings as $job_training)
                            <tr>
                                <td>{{ DB::table('job_trainings')->where('id', $job_training->id)->value('name') }}</td>
                                {{-- <td>{{ DB::table('departments')->where('id', $job_training->department)->value('name') }}</td> --}}
                                <td>{{$job_training->department}}</td>
                                <td>{{ $job_training->location}}</td>
                                @for ($i = 1; $i <= 1; $i++) <td>{{ \Carbon\Carbon::parse($job_training->{"startdate_$i"})->format('d-M-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($job_training->{"enddate_$i"})->format('d-M-Y') }}</td>
                                    @endfor

                                    <td>
                                        <a href="{{ route('job_training_view', $job_training->id) }}">
                                            <i class="fa-solid fa-pencil"></i>
                                    </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===============Induction training================ --}}

            <div id="CCForm6" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name Of Employee</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Qualification</th>
                                <th>Date Of Joining</th>


                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inductionTraining->sortbyDesc('id') as $induction)
                            <tr>
                                <td>{{ $induction->employee_id }}</td>
                                <td>{{ $induction->name_employee }}</td>
                                <td>{{ $induction->department }}</td>
                                <td>{{ $induction->location }}</td>
                                <td>{{ $induction->qualification }}</td>
                                <td>{{ \Carbon\Carbon::parse($induction->{"date_joining"})->format('d-M-Y')}}</td>

                                <td> <a href="{{ route('induction_training_view', $induction->id) }}">
                                        <i style="margin-left: 25px;" class="fa-solid fa-pencil"></i>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            {{-- ========================================== --}}

            {{-- <div class="inner-block tms-block cctabcontent" id="CCForm2">
                    @if (Helpers::checkRoles(6))
                        <div class="block-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Number</th>
                                        <th>Document Title</th>
                                        <th>Document Type</th>
                                        <th>Division</th>
                                        <th>Training Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($due as $temp)
                                        <tr>
                                            <td>{{ $temp->division_name }}/{{ $temp->typecode }}/SOP-
            000{{ $temp->root_document ? $temp->root_document->document_number : '' }}</td>
            <td>{{ $temp->training ? $temp->training->document_name : '' }}</td>
            <td>{{ $temp->document_type_name }}</td>
            <td>{{ $temp->division_name }}</td>
            <td>{{ $temp->status }} </td>
            <td><a href="#"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
            @endforeach

            </tbody>
            </table>

        </div>
        @else
        <div class="block-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Document Number</th>
                        <th>Name</th>
                        <th>Revision</th>
                        <th>Training Status</th>
                        <th>Content Type</th>
                        <th>Due Dat </th>
                        <th>Completed Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $temp)
                    <tr>
                        <td>Sop-000{{ $temp->id }}</td>
                        <td>{{ $temp->document_name }}</td>
                        <th>1</th>
                        <td>{{ $temp->traningstatus->status }}</td>
                        <td>Document</td>
                        <td>{{ $temp->due_dateDoc  }}</td>
                        <td>{{ $temp->due_dateDoc  }}</td>

                        <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div> --}}

    {{-- <div class="inner-block tms-block" id="tms-pending-block">
                    @if (Helpers::checkRoles(6))
                        <div class="block-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Number</th>
                                        <th>Document Title</th>
                                        <th>Document Type</th>
                                        <th>Division</th>
                                        <th>Training Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pending as $temp)
                                        <tr>
                                            <td>{{ $temp->division_name }}/{{ $temp->typecode }}/SOP-
    000{{ $temp->document_id }}</td>
    <td>{{ $temp->training ? $temp->training->document_name : '' }}</td>
    <td>{{ $temp->document_type_name }}</td>
    <td>{{ $temp->division_name }}</td>
    <td>{{ $temp->status }} </td>
    <td><a href="#"><i class="fa-solid fa-eye"></i></a></td>
    </tr>
    @endforeach

    </tbody>
    </table>
</div>
@else
<div class="block-table">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Number</th>
                <th>Name</th>
                <th>Revision</th>
                <th>Training Status</th>
                <th>Content Type</th>
                <th>Due Date</th>
                <th>Completed Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $temp)
            <tr>
                <td>Sop-000{{ $temp->id }}</td>
                <td>{{ $temp->document_name }}</td>
                <th>1</th>
                <td>{{ $temp->traningstatus->status }}</td>
                <td>Document</td>
                <td>{{ $temp->due_dateDoc }}</td>
                <td>{{ $temp->due_dateDoc  }}</td>
                <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
</div> --}}

{{-- <div class="inner-block tms-block" id="tms-completed-block">
                    @if (Helpers::checkRoles(6))
                        <div class="block-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Number</th>
                                        <th>Document Title</th>
                                        <th>Document Type</th>
                                        <th>Division</th>
                                        <th>Training Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complete as $temp)
                                        <tr>
                                            <td>{{ $temp->division_name }}/{{ $temp->typecode }}/SOP-
000{{ $temp->document_id }}</td>
<td>{{ $temp->training ? $temp->training->document_name : '' }}</td>
<td>{{ $temp->document_type_name }}</td>
<td>{{ $temp->division_name }}</td>
<td>{{ $temp->status }} </td>
<td><a href="#"><i class="fa-solid fa-eye"></i></a></td>
</tr>
@endforeach


</tbody>
</table>
</div>
@else
<div class="block-table">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Number</th>
                <th>Name</th>
                <th>Revision</th>
                <th>Training Status</th>
                <th>Content Type</th>
                <th>Due Date</th>
                <th>Completed Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $temp)
            <tr>
                <td>Sop-000{{ $temp->id }}</td>
                <td>{{ $temp->document_name }}</td>
                <th>1</th>
                <td>{{ $temp->traningstatus->status }}</td>
                <td>Document</td>
                <td>{{ $temp->due_dateDoc  }}</td>
                <td>{{ $temp->due_dateDoc  }}</td>
                <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
</div> --}}
</div>
</div>
</div>

{{-- ======================================
                SUBSCRIBE MODAL
    ======================================= --}}
<div class="modal fade modal-lg" id="subscribe-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Subscription</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="top-slogan">
                    Schedule dashboard refreshes and subscribes to receive results.
                </div>
                <div class="main-head">
                    Settings
                </div>
                <div class="schedule-block">
                    <div class="title">Frequency</div>
                    <div class="schedule-grid">
                        <div>
                            <input type="radio" name="schedule" id="daily">
                            <label for="daily">Daily</label>
                        </div>
                        <div class="active">
                            <input type="radio" name="schedule" id="weekly" checked>
                            <label for="weekly">Weekly</label>
                        </div>
                        <div>
                            <input type="radio" name="schedule" id="monthly">
                            <label for="monthly">Monthly</label>
                        </div>
                    </div>
                </div>
                <div class="subscribe-block daily-block">

                </div>
                <div class="subscribe-block weekly-block">
                    <div class="day-block">
                        <div class="title">
                            Days
                        </div>
                        <div class="day-grid">
                            <div class="active">
                                <input type="radio" name="day" id="sun">
                                <label for="sun">Sun</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="mon" checked>
                                <label for="mon">Mon</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="tue">
                                <label for="tue">Tue</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="wed">
                                <label for="wed">Wed</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="thu">
                                <label for="thu">Thu</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="fri">
                                <label for="fri">Fri</label>
                            </div>
                            <div>
                                <input type="radio" name="day" id="sat">
                                <label for="sat">Sat</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subscribe-block monthly-block">
                    <div class="group-input">
                        <label for="when">When</label>
                        <select name="when" id="when">
                            <option value="relative">Relative</option>
                            <option value="specific">Specific</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="week">Week</label>
                        <select name="week" id="week">
                            <option value="first">First</option>
                            <option value="second">Second</option>
                            <option value="third">Third</option>
                            <option value="fourth">Fourth</option>
                            <option value="last">Last</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="day">Day</label>
                        <select name="day" id="day">
                            <option value="sunday">Sunday</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                        </select>
                    </div>
                </div>
                <div class="group-input">
                    <label for="time">Time</label>
                    <select name="time" id="time">
                        <option value="9pm">1:00 PM</option>
                        <option value="9pm">2:00 PM</option>
                        <option value="9pm">3:00 PM</option>
                        <option value="9pm">4:00 PM</option>
                        <option value="9pm">5:00 PM</option>
                        <option value="9pm">6:00 PM</option>
                        <option value="9pm">7:00 PM</option>
                        <option value="9pm">8:00 PM</option>
                        <option value="9pm">9:00 PM</option>
                        <option value="9pm">10:00 PM</option>
                        <option value="9pm">11:00 PM</option>
                        <option value="9pm">12:00 PM</option>
                        <option value="9pm">1:00 AM</option>
                        <option value="9pm">2:00 AM</option>
                        <option value="9pm">3:00 AM</option>
                        <option value="9pm">4:00 AM</option>
                        <option value="9pm">5:00 AM</option>
                        <option value="9pm">6:00 AM</option>
                        <option value="9pm">7:00 AM</option>
                        <option value="9pm">8:00 AM</option>
                        <option value="9pm">9:00 AM</option>
                        <option value="9pm">10:00 AM</option>
                        <option value="9pm">11:00 AM</option>
                        <option value="9pm">12:00 AM</option>
                    </select>
                </div>
                <div class="main-head">
                    Recipents
                </div>
                <div class="check-input">
                    <label for="receive">
                        <input type="checkbox" name="receive" id="receive">
                        Receive new results by email when dashboard is refreshed.
                    </label>
                </div>
                <div class="notify">
                    <div><small>Send email to</small></div>
                    <div class="persons">
                        <div>Me</div>
                    </div>
                    <button>Edit Recipents</button>
                    <div>
                        @php
                        $user = DB::table('users')->where('id','!=',Auth::user()->id)->get();
                        @endphp
                        <select multiple name="recipents[]" placeholder="Select Recipents" data-search="false" data-silent-initial-value-set="true" id="edit_recipents">
                            @foreach ($user as $users)
                            <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach


                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal">Cancel</button>
                <button>Save</button>
            </div>

        </div>
    </div>
</div>

<script>
    VirtualSelect.init({
        ele: '#edit_recipents'
    });


    const scheduleRadios = document.querySelectorAll('.schedule-grid input[type="radio"]');
    scheduleRadios.forEach(radio => {
        radio.addEventListener('click', () => {
            scheduleRadios.forEach(radio => {
                radio.parentNode.classList.remove('active');
            });
            const selectedRadio = document.querySelector('.schedule-grid input[type="radio"]:checked');
            selectedRadio.parentNode.classList.add('active');
        });
    });
    const dailyBlock = document.querySelector('.daily-block');
    const weeklyBlock = document.querySelector('.weekly-block');
    const monthlyBlock = document.querySelector('.monthly-block');
    scheduleRadios.forEach(radio => {
        radio.addEventListener('click', () => {
            dailyBlock.style.display = 'none';
            weeklyBlock.style.display = 'none';
            monthlyBlock.style.display = 'none';
            if (radio.id === 'daily') {
                dailyBlock.style.display = 'block';
            } else if (radio.id === 'weekly') {
                weeklyBlock.style.display = 'block';
            } else if (radio.id === 'monthly') {
                monthlyBlock.style.display = 'block';
            }
        });
    });
    const initiallySelectedRadio = document.querySelector('.schedule-grid input[type="radio"]:checked');
    if (initiallySelectedRadio) {
        if (initiallySelectedRadio.id === 'daily') {
            dailyBlock.style.display = 'block';
        } else if (initiallySelectedRadio.id === 'weekly') {
            weeklyBlock.style.display = 'block';
        } else if (initiallySelectedRadio.id === 'monthly') {
            monthlyBlock.style.display = 'block';
        }
    }





    var optionstms1 = {
        series: [55],
        chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: '70%',
                    background: '#fff',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                track: {
                    background: '#fff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35
                    }
                },

                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: '#888',
                        fontSize: '17px'
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: '#111',
                        fontSize: '36px',
                        show: true,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#ABE5A1'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['Percent'],
    };
    var charttms1 = new ApexCharts(document.querySelector("#chart-tms1"), optionstms1);
    charttms1.render();


    var optionstms2 = {
        series: [67],
        chart: {
            height: 350,
            type: 'radialBar',
            offsetY: -10
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                dataLabels: {
                    name: {
                        fontSize: '16px',
                        color: undefined,
                        offsetY: 120
                    },
                    value: {
                        offsetY: 76,
                        fontSize: '22px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Median Ratio'],
    };
    var charttms2 = new ApexCharts(document.querySelector("#chart-tms2"), optionstms2);
    charttms2.render();


    var optionstms3 = {
        series: [75],
        chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: '70%',
                    background: '#fff',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                track: {
                    background: '#fff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35
                    }
                },

                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: '#888',
                        fontSize: '17px'
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: '#111',
                        fontSize: '36px',
                        show: true,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#ABE5A1'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['Percent'],
    };
    var charttms3 = new ApexCharts(document.querySelector("#chart-tms3"), optionstms3);
    charttms3.render();


    var optionstms4 = {
        series: [{
                name: 'box',
                type: 'boxPlot',
                data: [{
                        x: new Date('2017-01-01').getTime(),
                        y: [54, 66, 69, 75, 88]
                    },
                    {
                        x: new Date('2018-01-01').getTime(),
                        y: [43, 65, 69, 76, 81]
                    },
                    {
                        x: new Date('2019-01-01').getTime(),
                        y: [31, 39, 45, 51, 59]
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: [39, 46, 55, 65, 71]
                    },
                    {
                        x: new Date('2021-01-01').getTime(),
                        y: [29, 31, 35, 39, 44]
                    }
                ]
            },
            {
                name: 'outliers',
                type: 'scatter',
                data: [{
                        x: new Date('2017-01-01').getTime(),
                        y: 32
                    },
                    {
                        x: new Date('2018-01-01').getTime(),
                        y: 25
                    },
                    {
                        x: new Date('2019-01-01').getTime(),
                        y: 64
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: 27
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: 78
                    },
                    {
                        x: new Date('2021-01-01').getTime(),
                        y: 15
                    }
                ]
            }
        ],
        chart: {
            type: 'boxPlot',
            height: 350
        },
        colors: ['#008FFB', '#FEB019'],
        title: {
            align: 'left'
        },
        xaxis: {
            type: 'datetime',
            tooltip: {
                formatter: function(val) {
                    return new Date(val).getFullYear()
                }
            }
        },
        tooltip: {
            shared: false,
            intersect: true
        }
    };
    var charttms4 = new ApexCharts(document.querySelector("#chart-tms4"), optionstms4);
    charttms4.render()


    var optionstms5 = {
        series: [{
            data: [
                [1327359600000, 30.95],
                [1327446000000, 31.34],
                [1327532400000, 31.18],
                [1327618800000, 31.05],
                [1327878000000, 31.00],
                [1327964400000, 30.95],
                [1328050800000, 31.24],
                [1328137200000, 31.29],
                [1328223600000, 31.85],
                [1328482800000, 31.86],
                [1328569200000, 32.28],
                [1328655600000, 32.10],
                [1328742000000, 32.65],
                [1328828400000, 32.21],
                [1329087600000, 32.35],
                [1329174000000, 32.44],
                [1329260400000, 32.46],
                [1329346800000, 32.86],
                [1329433200000, 32.75],
                [1329778800000, 32.54],
                [1329865200000, 32.33],
                [1329951600000, 32.97],
                [1330038000000, 33.41],
                [1330297200000, 33.27],
                [1330383600000, 33.27],
                [1330470000000, 32.89],
                [1330556400000, 33.10],
                [1330642800000, 33.73],
                [1330902000000, 33.22],
                [1330988400000, 31.99],
                [1331074800000, 32.41],
                [1331161200000, 33.05],
                [1331247600000, 33.64],
                [1331506800000, 33.56],
                [1331593200000, 34.22],
                [1331679600000, 33.77],
                [1331766000000, 34.17],
                [1331852400000, 33.82],
                [1332111600000, 34.51],
                [1332198000000, 33.16],
                [1332284400000, 33.56],
                [1332370800000, 33.71],
                [1332457200000, 33.81],
                [1332712800000, 34.40],
                [1332799200000, 34.63],
                [1332885600000, 34.46],
                [1332972000000, 34.48],
                [1333058400000, 34.31],
                [1333317600000, 34.70],
                [1333404000000, 34.31],
                [1333490400000, 33.46],
                [1333576800000, 33.59],
                [1333922400000, 33.22],
                [1334008800000, 32.61],
                [1334095200000, 33.01],
                [1334181600000, 33.55],
                [1334268000000, 33.18],
                [1334527200000, 32.84],
                [1334613600000, 33.84],
                [1334700000000, 33.39],
                [1334786400000, 32.91],
                [1334872800000, 33.06],
                [1335132000000, 32.62],
                [1335218400000, 32.40],
                [1335304800000, 33.13],
                [1335391200000, 33.26],
                [1335477600000, 33.58],
                [1335736800000, 33.55],
                [1335823200000, 33.77],
                [1335909600000, 33.76],
                [1335996000000, 33.32],
                [1336082400000, 32.61],
                [1336341600000, 32.52],
                [1336428000000, 32.67],
                [1336514400000, 32.52],
                [1336600800000, 31.92],
                [1336687200000, 32.20],
                [1336946400000, 32.23],
                [1337032800000, 32.33],
                [1337119200000, 32.36],
                [1337205600000, 32.01],
                [1337292000000, 31.31],
                [1337551200000, 32.01],
                [1337637600000, 32.01],
                [1337724000000, 32.18],
                [1337810400000, 31.54],
                [1337896800000, 31.60],
                [1338242400000, 32.05],
                [1338328800000, 31.29],
                [1338415200000, 31.05],
                [1338501600000, 29.82],
                [1338760800000, 30.31],
                [1338847200000, 30.70],
                [1338933600000, 31.69],
                [1339020000000, 31.32],
                [1339106400000, 31.65],
                [1339365600000, 31.13],
                [1339452000000, 31.77],
                [1339538400000, 31.79],
                [1339624800000, 31.67],
                [1339711200000, 32.39],
                [1339970400000, 32.63],
                [1340056800000, 32.89],
                [1340143200000, 31.99],
                [1340229600000, 31.23],
                [1340316000000, 31.57],
                [1340575200000, 30.84],
                [1340661600000, 31.07],
                [1340748000000, 31.41],
                [1340834400000, 31.17],
                [1340920800000, 32.37],
                [1341180000000, 32.19],
                [1341266400000, 32.51],
                [1341439200000, 32.53],
                [1341525600000, 31.37],
                [1341784800000, 30.43],
                [1341871200000, 30.44],
                [1341957600000, 30.20],
                [1342044000000, 30.14],
                [1342130400000, 30.65],
                [1342389600000, 30.40],
                [1342476000000, 30.65],
                [1342562400000, 31.43],
                [1342648800000, 31.89],
                [1342735200000, 31.38],
                [1342994400000, 30.64],
                [1343080800000, 30.02],
                [1343167200000, 30.33],
                [1343253600000, 30.95],
                [1343340000000, 31.89],
                [1343599200000, 31.01],
                [1343685600000, 30.88],
                [1343772000000, 30.69],
                [1343858400000, 30.58],
                [1343944800000, 32.02],
                [1344204000000, 32.14],
                [1344290400000, 32.37],
                [1344376800000, 32.51],
                [1344463200000, 32.65],
                [1344549600000, 32.64],
                [1344808800000, 32.27],
                [1344895200000, 32.10],
                [1344981600000, 32.91],
                [1345068000000, 33.65],
                [1345154400000, 33.80],
                [1345413600000, 33.92],
                [1345500000000, 33.75],
                [1345586400000, 33.84],
                [1345672800000, 33.50],
                [1345759200000, 32.26],
                [1346018400000, 32.32],
                [1346104800000, 32.06],
                [1346191200000, 31.96],
                [1346277600000, 31.46],
                [1346364000000, 31.27],
                [1346709600000, 31.43],
                [1346796000000, 32.26],
                [1346882400000, 32.79],
                [1346968800000, 32.46],
                [1347228000000, 32.13],
                [1347314400000, 32.43],
                [1347400800000, 32.42],
                [1347487200000, 32.81],
                [1347573600000, 33.34],
                [1347832800000, 33.41],
                [1347919200000, 32.57],
                [1348005600000, 33.12],
                [1348092000000, 34.53],
                [1348178400000, 33.83],
                [1348437600000, 33.41],
                [1348524000000, 32.90],
                [1348610400000, 32.53],
                [1348696800000, 32.80],
                [1348783200000, 32.44],
                [1349042400000, 32.62],
                [1349128800000, 32.57],
                [1349215200000, 32.60],
                [1349301600000, 32.68],
                [1349388000000, 32.47],
                [1349647200000, 32.23],
                [1349733600000, 31.68],
                [1349820000000, 31.51],
                [1349906400000, 31.78],
                [1349992800000, 31.94],
                [1350252000000, 32.33],
                [1350338400000, 33.24],
                [1350424800000, 33.44],
                [1350511200000, 33.48],
                [1350597600000, 33.24],
                [1350856800000, 33.49],
                [1350943200000, 33.31],
                [1351029600000, 33.36],
                [1351116000000, 33.40],
                [1351202400000, 34.01],
                [1351638000000, 34.02],
                [1351724400000, 34.36],
                [1351810800000, 34.39],
                [1352070000000, 34.24],
                [1352156400000, 34.39],
                [1352242800000, 33.47],
                [1352329200000, 32.98],
                [1352415600000, 32.90],
                [1352674800000, 32.70],
                [1352761200000, 32.54],
                [1352847600000, 32.23],
                [1352934000000, 32.64],
                [1353020400000, 32.65],
                [1353279600000, 32.92],
                [1353366000000, 32.64],
                [1353452400000, 32.84],
                [1353625200000, 33.40],
                [1353884400000, 33.30],
                [1353970800000, 33.18],
                [1354057200000, 33.88],
                [1354143600000, 34.09],
                [1354230000000, 34.61],
                [1354489200000, 34.70],
                [1354575600000, 35.30],
                [1354662000000, 35.40],
                [1354748400000, 35.14],
                [1354834800000, 35.48],
                [1355094000000, 35.75],
                [1355180400000, 35.54],
                [1355266800000, 35.96],
                [1355353200000, 35.53],
                [1355439600000, 37.56],
                [1355698800000, 37.42],
                [1355785200000, 37.49],
                [1355871600000, 38.09],
                [1355958000000, 37.87],
                [1356044400000, 37.71],
                [1356303600000, 37.53],
                [1356476400000, 37.55],
                [1356562800000, 37.30],
                [1356649200000, 36.90],
                [1356908400000, 37.68],
                [1357081200000, 38.34],
                [1357167600000, 37.75],
                [1357254000000, 38.13],
                [1357513200000, 37.94],
                [1357599600000, 38.14],
                [1357686000000, 38.66],
                [1357772400000, 38.62],
                [1357858800000, 38.09],
                [1358118000000, 38.16],
                [1358204400000, 38.15],
                [1358290800000, 37.88],
                [1358377200000, 37.73],
                [1358463600000, 37.98],
                [1358809200000, 37.95],
                [1358895600000, 38.25],
                [1358982000000, 38.10],
                [1359068400000, 38.32],
                [1359327600000, 38.24],
                [1359414000000, 38.52],
                [1359500400000, 37.94],
                [1359586800000, 37.83],
                [1359673200000, 38.34],
                [1359932400000, 38.10],
                [1360018800000, 38.51],
                [1360105200000, 38.40],
                [1360191600000, 38.07],
                [1360278000000, 39.12],
                [1360537200000, 38.64],
                [1360623600000, 38.89],
                [1360710000000, 38.81],
                [1360796400000, 38.61],
                [1360882800000, 38.63],
                [1361228400000, 38.99],
                [1361314800000, 38.77],
                [1361401200000, 38.34],
                [1361487600000, 38.55],
                [1361746800000, 38.11],
                [1361833200000, 38.59],
                [1361919600000, 39.60],
            ]
        }],
        chart: {
            id: 'area-datetime',
            type: 'area',
            height: 350,
            zoom: {
                autoScaleYaxis: true
            }
        },
        annotations: {
            yaxis: [{
                y: 30,
                borderColor: '#999',
                label: {
                    show: true,
                    text: 'Support',
                    style: {
                        color: "#fff",
                        background: '#00E396'
                    }
                }
            }],
            xaxis: [{
                x: new Date('14 Nov 2012').getTime(),
                borderColor: '#999',
                yAxisIndex: 0,
                label: {
                    show: true,
                    text: 'Rally',
                    style: {
                        color: "#fff",
                        background: '#775DD0'
                    }
                }
            }]
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 0,
            style: 'hollow',
        },
        xaxis: {
            type: 'datetime',
            min: new Date('01 Mar 2012').getTime(),
            tickAmount: 6,
        },
        tooltip: {
            x: {
                format: 'dd MMM yyyy'
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 100]
            }
        },
    };
    var charttms5 = new ApexCharts(document.querySelector("#chart-tms5"), optionstms5);
    charttms5.render();


    var optionstms6 = {
        series: [{
                name: "Completed - 2023",
                data: [28, 29, 33, 36, 32, 32, 33]
            },
            {
                name: "Due - 2023",
                data: [12, 11, 14, 18, 17, 13, 13]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#77B6EA', '#545454'],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            align: 'left'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Training'
            },
            min: 5,
            max: 40
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };
    var charttms6 = new ApexCharts(document.querySelector("#chart-tms6"), optionstms6);
    charttms6.render();


    var optionstms7 = {
        series: [{
                name: "Session Duration",
                data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
            },
            {
                name: "Page Views",
                data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
            },
            {
                name: 'Total Visits',
                data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: [5, 7, 5],
            curve: 'straight',
            dashArray: [0, 8, 5]
        },
        title: {
            text: 'Page Statistics',
            align: 'left'
        },
        legend: {
            tooltipHoverFormatter: function(val, opts) {
                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
            }
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                '10 Jan', '11 Jan', '12 Jan'
            ],
        },
        tooltip: {
            y: [{
                    title: {
                        formatter: function(val) {
                            return val + " (mins)"
                        }
                    }
                },
                {
                    title: {
                        formatter: function(val) {
                            return val + " per session"
                        }
                    }
                },
                {
                    title: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                }
            ]
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };
    var charttms7 = new ApexCharts(document.querySelector("#chart-tms7"), optionstms7);
    charttms7.render();


    var optionstms8 = {
        series: [{
            name: 'Documents',
            data: [44, 55, 41, 67, 22, 43]
        }],
        annotations: {
            points: [{
                x: 'Maximum',
                seriesIndex: 0,
                label: {
                    borderColor: '#775DD0',
                    offsetY: 0,
                    style: {
                        color: '#fff',
                        background: '#775DD0',
                    },
                    text: 'Maximum Documents',
                }
            }]
        },
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2
        },

        grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: ['SOP', 'WI', 'Production', 'Quality Analysis', 'Quality Control', 'Engineering'],
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: 'Servings',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };
    var charttms8 = new ApexCharts(document.querySelector("#chart-tms8"), optionstms8);
    charttms8.render();


    var optionstms9 = {
        series: [{
            name: 'series1',
            data: [31, 40, 28, 51, 42, 109, 100]
        }, {
            name: 'series2',
            data: [11, 32, 45, 32, 34, 52, 41]
        }],
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                "2018-09-19T06:30:00.000Z"
            ]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };
    var charttms9 = new ApexCharts(document.querySelector("#chart-tms9"), optionstms9);
    charttms9.render();


    var optionstms10 = {
        series: [{
                name: 'Q1 Budget',
                group: 'budget',
                data: [44000, 55000, 41000, 67000, 22000]
            },
            {
                name: 'Q1 Actual',
                group: 'actual',
                data: [48000, 50000, 40000, 65000, 25000]
            },
            {
                name: 'Q2 Budget',
                group: 'budget',
                data: [13000, 36000, 20000, 8000, 13000]
            },
            {
                name: 'Q2 Actual',
                group: 'actual',
                data: [20000, 40000, 25000, 10000, 12000]
            }
        ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        dataLabels: {
            formatter: (val) => {
                return val / 1000 + 'K'
            }
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        xaxis: {
            categories: [
                'Online advertising',
                'Sales Training',
                'Print advertising',
                'Catalogs',
                'Meetings'
            ],
            labels: {
                formatter: (val) => {
                    return val / 1000 + 'K'
                }
            }
        },
        fill: {
            opacity: 1,
        },
        colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        }
    };
    var charttms10 = new ApexCharts(document.querySelector("#chart-tms10"), optionstms10);
    charttms10.render();



    var optionstms11 = {
        series: [{
            name: 'TEAM A',
            type: 'column',
            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
        }, {
            name: 'TEAM B',
            type: 'area',
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
            name: 'TEAM C',
            type: 'line',
            data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
        }],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },

        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
            '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
        ],
        markers: {
            size: 0
        },
        xaxis: {
            type: 'datetime'
        },
        yaxis: {
            title: {
                text: 'Points',
            },
            min: 0
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;

                }
            }
        }
    };
    var charttms11 = new ApexCharts(document.querySelector("#chart-tms11"), optionstms11);
    charttms11.render();


    var optionstms12 = {
        series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
        chart: {
            type: 'polarArea',
        },
        stroke: {
            colors: ['#fff']
        },
        fill: {
            opacity: 0.8
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var charttms12 = new ApexCharts(document.querySelector("#chart-tms12"), optionstms12);
    charttms12.render();



    var optionstms13 = {
        series: [{
            name: 'Series 1',
            data: [80, 50, 30, 40, 100, 20],
        }, {
            name: 'Series 2',
            data: [20, 30, 40, 80, 20, 80],
        }, {
            name: 'Series 3',
            data: [44, 76, 78, 13, 43, 10],
        }],
        chart: {
            height: 350,
            type: 'radar',
            dropShadow: {
                enabled: true,
                blur: 1,
                left: 1,
                top: 1
            }
        },
        stroke: {
            width: 2
        },
        fill: {
            opacity: 0.1
        },
        markers: {
            size: 0
        },
        xaxis: {
            categories: ['2011', '2012', '2013', '2014', '2015', '2016']
        }
    };
    var charttms13 = new ApexCharts(document.querySelector("#chart-tms13"), optionstms13);
    charttms13.render();



    var optionstms14 = {
        series: [44, 55, 41, 17, 15],
        chart: {
            width: 380,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
        },
        legend: {
            formatter: function(val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var charttms14 = new ApexCharts(document.querySelector("#chart-tms14"), optionstms14);
    charttms14.render();




    $(function() {
        $('.progress').easyPieChart({
            size: 160,
            barColor: "#17d3e6",
            scaleLength: 0,
            lineWidth: 15,
            trackColor: "#373737",
            lineCap: "circle",
            animate: 2000,
        });
    });
</script>



@endsection