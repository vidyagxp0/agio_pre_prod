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
        font-size: 10px;
        position: relative;
        /* border-right: none; */
        background: white;
    }
    .input_full_width{
            width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
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

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(9) {
        /* border-radius: 0px 20px 20px 0px; */

    }
</style>

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }}
            / OOT
        </div>
    </div>

    <div id="change-control-fields">
        <div class="container-fluid">
            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                    @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp
            <button class="button_theme1"> <a class="text-white"
                    href="{{ url('rcms/oot_audit_history', $data->id) }}"> Audit Trail </a> </button>

            @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Submit
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                Request For Cancellation
                </button>
                
            @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                HOD Primary Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Request For Cancellation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                More Info Required
                </button>
  
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
                @elseif($data->stage == 3 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    Cancel
                </button>
            @elseif($data->stage == 4 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                CQA/QA Head Primary Review Complete
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                 More Info Required
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
               
                
            @elseif($data->stage == 5 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
           
            
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase IA Investigation
            </button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button> 
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                Child
            </button>   
            @elseif($data->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                 Phase IA HOD Review Complete
                </button> 
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button> 
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button> 
                {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button> --}}
            
            @elseif($data->stage == 8 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IA QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
                
             @elseif($data->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Assignable Cause Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    Assignable Cause Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>

                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button> 
                

                @elseif($data->stage == 10 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
               
                @elseif($data->stage == 11 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>
               
                @elseif($data->stage == 12 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
               
                @elseif($data->stage == 13 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
               
                @elseif($data->stage == 14 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    P-IB Assignable Cause Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    P-IB Assignable Cause Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 15 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
                @elseif($data->stage == 16 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>

                @elseif($data->stage == 17 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A  HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 18 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 19 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                P-II A Assignable Cause Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                P-II A Assignable Cause Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 20 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                

                @elseif($data->stage == 21 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>

                @elseif($data->stage == 22 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 23 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($data->stage == 24 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                P-II B Assignable Cause Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal2">
                P-II B Assignable Cause Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @endif
            <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                </a> </button>

        </div>

                </div>
                <div class="status">
    <div class="head">Current Status</div>
    {{-- ------------------------------By Pankaj-------------------------------- --}}
    @if ($data->stage == 0)
        <div class="progress-bars">
            <div class="bg-danger">Closed-Cancelled</div>
        </div>
    @else
        <div class="progress-bars d-flex">
            @if ($data->stage >= 1)
                <div class="active">Opened</div>
            @else
                <div class="">Opened</div>
            @endif

            @if ($data->stage >= 2)
                <div class="active" style="width: 8%">HOD Primary Review</div>
            @else
                <div class="">HOD Primary Review</div>
            @endif
            @if ($data->stage < 4)
                @if ($data->stage >= 3)
                    <div class="active">QA Head Approval</div>
                @else
                    <div class="">QA Head Approval</div>
                @endif
            @endif

            @if ($data->stage >= 4)
                <div class="active">CQA/QA Head Primary Review</div>
            @else
                <div class="">CQA/QA Head Primary Review</div>
            @endif

            @if ($data->stage >= 5)
                <div class="active">Under Phase-IA Investigation</div>
            @else
                <div class="">Under Phase-IA Investigation</div>
            @endif

            @if ($data->stage >= 7)
                <div class="active">Phase IA HOD Primary Review</div>
            @else
                <div class="">Phase IA HOD Primary Review</div>
            @endif

            @if ($data->stage >= 8)
                <div class="active">Phase IA QA Review</div>
            @else
                <div class="">Phase IA QA Review</div>
            @endif

            @if ($data->stage >= 9)
                <div class="active">P-IA CQAH/QAH Review</div>
            @else
                <div class="">P-IA CQAH/QAH Review</div>
            @endif

            @if ($data->stage < 11)
                @if ($data->stage >= 10)
                    <div class="bg-danger">Closed Done</div>
                @else
                    <div class="">Closed Done</div>
                @endif
            @endif

            @if ($data->stage >= 11)
                <div class="active">Under Phase-IB Investigation</div>
            @else
                <div class="">Under Phase-IB Investigation</div>
            @endif

            @if ($data->stage >= 12)
                <div class="active">Phase IB HOD Primary Review</div>
            @else
                <div class="">Phase IB HOD Primary Review</div>
            @endif

            @if ($data->stage >= 13)
                <div class="active">Phase IB QA Review</div>
            @else
                <div class="">Phase IB QA Review</div>
            @endif
            
            @if ($data->stage >= 14)
                <div class="active">P-IB CQAH/QAH Review</div>
            @else
                <div class="">P-IB CQAH/QAH Review</div>
            @endif
            
            @if ($data->stage < 16)
                @if ($data->stage >= 15)
                    <div class="bg-danger">Closed Done</div>
                @else
                    <div class="">Closed Done</div>
                @endif
            @endif

            @if ($data->stage >= 16)
                <div class="active">Under Phase-II A Investigation</div>
            @else
                <div class="">Under Phase-II A Investigation</div>
            @endif

            @if ($data->stage >= 17)
                <div class="active">Phase II A HOD Primary Review</div>
            @else
                <div class="">Phase II A HOD Primary Review</div>
            @endif

            @if ($data->stage >= 18)
                <div class="active">Phase II A QA Review</div>
            @else
                <div class="">Phase II A QA Review</div>
            @endif

            @if ($data->stage >= 19)
                <div class="active">P-II A QAH/CQAH Review</div>
            @else
                <div class="">P-II A QAH/CQAH Review</div>
            @endif

            @if ($data->stage < 21)
                @if ($data->stage >= 20)
                    <div class="bg-danger">Closed Done</div>
                @else
                    <div class="">Closed Done</div>
                @endif
            @endif

            @if ($data->stage >= 21)
                <div class="active">Under Phase-II B Investigation</div>
            @else
                <div class="">Under Phase-II B Investigation</div>
            @endif

            @if ($data->stage >= 22)
                <div class="active">Phase II B HOD Primary Review</div>
            @else
                <div class="">Phase II B HOD Primary Review</div>
            @endif

            @if ($data->stage >= 23)
                <div class="active">Phase II B QA Review</div>
            @else
                <div class="">Phase II B QA Review</div>
            @endif

            @if ($data->stage >= 24)
                <div class="active">P-II B QAH/CQAH Review</div>
            @else
                <div class="">P-II B QAH/CQAH Review</div>
            @endif

            @if ($data->stage >= 25)
                <div class="bg-danger">Closed - Done</div>
            @else
                <div class="">Closed - Done</div>
            @endif
        </div>
    @endif
</div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
              </div>
              </div>
         <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm18')">Other Then Stability Batches </button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm19')">Checklist - Preliminary Laboratory
                Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Checklist - Part B: Applicable if
                Laboratory error identified</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist -Part D: Communication of
                Confirmed of OOT With Technical Committee </button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Justification Of Delay</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure Conclusion</button>
            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Investigation Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QC Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOT Conclusion</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOT Conclusion Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOT CQ Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Re-Open</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>--}}
            <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Extension</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Activity Log</button>
         </div>

         <form action="{{ route('update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="step-form">
                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->

                <!-- ============Tab-1 start============ -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Type </label>
                                    <select id="dynamicSelectType" name="type">
                                        <option value="{{ route('oot.index') }}">OOT</option>
                                        <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                                        <option value="{{ route('oos.index') }}">OOS Chemical</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="record_number"><b>Record Number</b></label>
                                    <input disabled type="text" name="record_number" id="record_number"
                                        value="{{ Helpers::getDivisionName($data->division_id) }}/OOT/{{ date('Y') }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label disabled for="Short Description">Division Code</label>
                                    <input disabled type="text" name="division_code"  value="{{ Helpers::getDivisionName($data->division_id) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initiator <span class="text-danger"></span></label>
                                    <input disabled type="text" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                                    <input readonly type="text"  value="{{ Helpers::getdateFormat($data->intiation_date) }}"  name="intiation_date" id="intiation_date"s>

                                </div>
                            </div>

                            {{-- <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <input type="hidden" value="{{ $formattedDate }}" name="due_date">
                                    <input disabled type="text" value="{{ $formattedDate }}" name="due_date_display">
                                </div>
                            </div> --}}

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    {{-- <p class="text-primary"> last date this record should be closed by</p> --}}

                                    <div class="calenderauditee">
                                        <input type="text" id="due_date"  value="{{ Helpers::getdateFormat($data->due_date) }}" readonly/>
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')" readonly/>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initiator Group <span class="text-danger"></span></label>

                                    <select name="initiator_group" id="initiator_group">
                                        <option value="CQA"
                                            @if ($data->initiator_group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                        <option value="QA"
                                            @if ($data->initiator_group == 'QA') selected @endif>Quality Assurance</option>
                                        <option value="QC"
                                            @if ($data->initiator_group == 'QC') selected @endif>Quality Control</option>
                                        <option value="QM"
                                            @if ($data->initiator_group == 'QM') selected @endif>Quality Control (Microbiology department)
                                        </option>
                                        <option value="PG"
                                            @if ($data->initiator_group == 'PG') selected @endif>Production General</option>
                                        <option value="PL"
                                            @if ($data->initiator_group == 'PL') selected @endif>Production Liquid Orals</option>
                                        <option value="PT"
                                            @if ($data->initiator_group == 'PT') selected @endif>Production Tablet and Powder</option>
                                        <option value="PE"
                                            @if ($data->initiator_group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                        <option value="PC"  @if ($data->initiator_group == 'PC') selected @endif>Production Capsules</option>
                                        <option value="PI"  @if ($data->initiator_group == 'PI') selected @endif>Production Injectable</option>
                                        <option value="EN"  @if ($data->initiator_group == 'EN') selected @endif>Engineering</option>
                                        <option value="HR"  @if ($data->initiator_group == 'HR') selected @endif>Human Resource</option>
                                        <option value="ST"  @if ($data->initiator_group == 'ST') selected @endif>Store</option>
                                        <option value="IT" @if ($data->initiator_group == 'IT') selected @endif>Electronic Data Processing
                                        </option>
                                        <option value="FD" @if ($data->initiator_group == 'FD') selected @endif>Formulation  Development
                                        </option>
                                        <option value="AL"  @if ($data->initiator_group == 'AL') selected @endif>Analytical research and Development Laboratory
                                        </option>
                                        <option value="PD"   @if ($data->initiator_group == 'PD') selected @endif>Packaging Development
                                        </option>

                                        <option value="PU"  @if ($data->initiator_group == 'PU') selected @endif>Purchase Department
                                        </option>
                                        <option value="DC"   @if ($data->initiator_group == 'DC') selected @endif>Document Cell
                                        </option>
                                        <option value="RA"    @if ($data->initiator_group == 'RA') selected @endif>Regulatory Affairs
                                        </option>
                                        <option value="PV"    @if ($data->initiator_group == 'PV') selected @endif>Pharmacovigilance
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiation Group Code">Initiation Department Code</label>
                                    <input type="text" name="initiator_group_code"
                                        value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                        readonly>
                                    {{-- <div class="default-name"> <span
                                    id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                </div>
                            </div>


                            <script>
                                document.getElementById('selectedOptions').addEventListener('change', function() {
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

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description">Initiated Through<span
                                            class="text-danger"></span></label>
                                    <select name="initiated_through" id="initiated_through">
                                        <option value="">Select Option</option>
                                        <option value="oos_micro" @if ($data->initiated_through == 'oos_micro') selected @endif>OOS
                                            Micro</option>
                                        <option value="oos_chemical" @if ($data->initiated_through == 'oos_chemical') selected @endif>
                                            OOS
                                            Chemical </option>
                                        <option value="lab_incident" @if ($data->initiated_through == 'lab_incident') selected @endif>
                                            Lab
                                            Incident</option>
                                        <option value="others" @if ($data->initiated_through == 'others') selected @endif>Others
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Short Description">Short Description<span class="text-danger">
                                            *</span></label><span id="rchars">255</span>characters remaining
                                    <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="docname"
                                        type="text" maxlength="255" required {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                </div>
                                @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">If Others </label>
                                    <textarea class="summernote" name="if_others" id="summernote-16" value="{{ $data->if_others }}">{{ $data->if_others }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description">Is Repeat?<span class="text-danger"></span></label>
                                    <select id="is_repeat" name="is_repeat">
                                        <option>select</option>
                                        <option value="yes" @if ($data->is_repeat == 'yes') selected @endif>Yes </option>
                                        <option value="no" @if ($data->is_repeat == 'no') selected @endif>No </option>
                                    </select>
                                </div>
                            </div>


                           {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description">Nature Of Change<span
                                            class="text-danger"></span></label>
                                    <select multiple id="natureOfChange" name="nature_of_change">

                                        <option value="temporary" @if ($data->nature_of_change == 'temporary') selected @endif> Temporary</option>

                                        <option value="permanent" @if ($data->nature_of_change == 'permanent') selected @endif> Permanent</option>

                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOt Observed On">OOT Occured On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="oot_occured_on" value="{{ Helpers::getdateFormat($data->oot_occured_on) }}" readonly placeholder="DD-MMM-YYYY" />
                                        {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                        <input type="date" name="oot_occured_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'oot_occured_on')" />
                                    </div>
                                </div>
                                @error('oot_occured_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOt Observed On">OOT Observed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="oot_observed_on" value="{{ Helpers::getdateFormat($data->oot_observed_on) }}" readonly placeholder="DD-MMM-YYYY" />
                                        {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                        <input type="date" name="oot_observed_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'oot_observed_on')" />
                                    </div>
                                </div>
                                @error('oot_observed_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 new-time-data-field">
                                <div class="group-input input-time">
                                    <label for="deviation_time">Delay Justification</label>
                                    <textarea id="delay_justification"  name="delay_justification" value="{{$data->delay_justification}}" >{{ $data->delay_justification }}</textarea>
                                </div>
                                {{-- @error('Deviation_date')
                                    <div class="text-danger">{{  $message  }}</div>
                                @enderror --}}
                            </div>
                            <script>
                                flatpickr("#deviation_time", {
                                    enableTime: true,
                                    noCalendar: true,
                                    dateFormat: "H:i", // 24-hour format without AM/PM
                                    minuteIncrement: 1 // Set minute increment to 1

                                });
                            </script>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule End Date">OOt Reported on</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="oot_report_on" value="{{ Helpers::getdateFormat($data->oot_report_on) }}" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="oot_report_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                          class="hide-input" oninput="handleDateInput(this, 'oot_report_on')" />
                                    </div>
                                </div>
                            </div>
                                <script>
                                    $('.delayJustificationBlock').hide();

                                    function calculateDateDifference() {
                                        let deviationDate = $('input[name=Deviation_date]').val();
                                        let reportedDate = $('input[name=Deviation_reported_date]').val();

                                        if (!deviationDate || !reportedDate) {
                                            console.error('Deviation date or reported date is missing.');
                                            return;
                                        }

                                        let deviationDateMoment = moment(deviationDate);
                                        let reportedDateMoment = moment(reportedDate);

                                        let diffInDays = reportedDateMoment.diff(deviationDateMoment, 'days');

                                        // if (diffInDays > 0) {
                                        //     $('.delayJustificationBlock').show();
                                        // } else {
                                        //     $('.delayJustificationBlock').hide();
                                        // }

                                    }

                                    $('input[name=Deviation_date]').on('change', function() {
                                        calculateDateDifference();
                                    })

                                    $('input[name=Deviation_reported_date]').on('change', function() {
                                        calculateDateDifference();
                                    })
                                </script>

                                <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Immediate action</label>
                                    <input type="text" name="immediate_action"  id="immediate_action" value="{{$data->immediate_action}}">
                                </div>
                                 </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">OOT Details</label>
                                    <textarea class="summernote" name="oot_details" id="summernote-16" value="{{ $data->oot_details }}"> {{ $data->oot_details }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Product History</label>
                                    <textarea class="summernote" name="producct_history" id="summernote-16" value="{{ $data->producct_history }}"> {{ $data->producct_history }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Probable Cause</label>
                                    <textarea class="summernote" name="probble_cause" id="summernote-16" value="{{ $data->probble_cause }}">{{ $data->probble_cause }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Investigation Details</label>
                                    <textarea class="summernote" name="investigation_details" id="summernote-16"
                                        value="{{ $data->investigation_details }}">{{ $data->investigation_details }} </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Comments</label>
                                    <textarea class="summernote" name="comments" value="{{ $data->comments }}">{{ $data->comments }} </textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recored">Refrence Record<span
                                            class="text-danger"></span></label>
                                    <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} multiple
                                        id="reference" name="reference[]" id="">
                                        @foreach ($old_record as $new)
                                            <option
                                                value="{{ $new->id }}"{{ in_array($new->id, explode(',', $data->reference)) ? 'selected' : '' }}>
                                                {{ Helpers::getDivisionName($new->division_id) }}/OOT/{{ date('Y') }}/{{ Helpers::recordFormat($new->record_number) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="sub-head">OOT Information</div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Product Material Name</label>
                                    <input type="text" name="productmaterialname"
                                        value="{{ $data->productmaterialname }}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Grade/Type Of Water</label>
                                    <input type="text" name="grade_typeofwater"
                                        value="{{ $data->grade_typeofwater }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Sample Location/Point</label>
                                    <input type="text" name="sampleLocation_Point"
                                        value="{{ $data->sampleLocation_Point }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Market</label>
                                    <input type="text" name="market" value="{{ $data->market }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label>Customer</label>
                                    <input type="text" name="customer" value="{{ $data->customer }}" />
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Product/Material
                                    <button type="button" name="audit-agenda-grid" id="addproduct">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="info_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row No.</th>
                                                <th style="width: 12%">Item/Product Code</th>
                                                <th style="width: 16%"> Lot/Batch No</th>
                                                <th style="width: 15%">A.R.Number</th>
                                                <th style="width: 15%">Mfg Date</th>
                                                <th style="width: 15%">Expiry Date </th>
                                                <th style="width: 15%">Label Claim</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($grid_product_mat && is_array($grid_product_mat->data))
                                                @foreach ($grid_product_mat->data as $gridData)
                                                    <tr>

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="product_materiel[][item_product_code]" value="{{ isset($gridData['item_product_code']) ? $gridData['item_product_code'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="product_materiel[{{ $loop->index }}][lot_batch_no]"
                                                                value="{{ isset($gridData['lot_batch_no']) ? $gridData['lot_batch_no'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="product_materiel[{{ $loop->index }}][a_r_number]"value="{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : '' }}">
                                                        </td>
                                                        {{-- <td>
                                                            <input type="month" class="numberDetail"
                                                                name="product_materiel[{{ $loop->index }}][m_f_g_date]" value="{{ isset($gridData['m_f_g_date']) ?  $gridData['m_f_g_date'] : '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="month" class="numberDetail"  name="product_materiel[{{ $loop->index }}][expiry_date]"   value="{{ isset($gridData['expiry_date']) ? $gridData['expiry_date'] : '' }}"  class="hide-input" oninput="handleMonthInput(this, 'expiry_date')">
                                                        </td> --}}

                                                        <td>
                                                            <div class="col-lg-6 new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input type="text" id="m_f_g_date{{ $loop->index }}" readonly placeholder="MM-YYYY" name="product_materiel[{{ $loop->index }}][m_f_g_date]"   value="{{ Helpers::getmonthFormat($gridData['m_f_g_date'] ?? '') }}"  />
                                                                        <input  type="month" name="product_materiel[{{ $loop->index }}][m_f_g_date]"   value="{{ isset($gridData['m_f_g_date']) ? $gridData['m_f_g_date'] : '' }}" class="hide-input" oninput="handleMonthInput(this, 'm_f_g_date{{ $loop->index }}')">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-lg-6 new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input type="text" id="expiry_date{{ $loop->index }}" value="{{ Helpers::getmonthFormat($gridData['expiry_date'] ?? '') }}" readonly placeholder="MM-YYYY" />
                                                                        <input  type="month" name="product_materiel[{{ $loop->index }}][expiry_date]"
                                                                        value="{{ isset($gridData['expiry_date']) ? $gridData['expiry_date'] : '' }}" class="hide-input" oninput="handleMonthInput(this, 'expiry_date{{ $loop->index }}')">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="product_materiel[{{ $loop->index }}][label_claim]"
                                                                value="{{ isset($gridData['label_claim']) ? $gridData['label_claim'] : '' }}">
                                                        </td>

                                                        <td><button type="button" class="removeRowBtn" name="Action[]">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- <td>{{ $serialNumber }}</td> --}}
                                                <td><input type="text" class="numberDetail"
                                                        name="product_materiel[0][item_product_code]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="product_materiel[0][lot_batch_no]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="product_materiel[0][a_r_number]"></td>
                                                <td><input type="date"
                                                        class="Document_Remarks"name="product_materiel[0][m_f_g_date]">
                                                </td>
                                                <td><input type="date" class="Document_Remarks"
                                                        name="product_materiel[0][expiry_date]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="product_materiel[0][label_claim]"></td>
                                                {{-- <td><button type="text" class="removeRowBtn">Remove</button></td> --}}
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Product Detail
                                    <button type="button" name="audit-agenda-grid" id="productAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="product_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row No.</th>
                                                <th style="width: 12%">Product Name</th>
                                                <th style="width: 15%">AR No.</th>
                                                <th style="width: 16%">Sample On</th>
                                                <th style="width: 15%">Sample By</th>
                                                <th style="width: 15%">Analyzed On </th>
                                                <th style="width: 15%">Observation On</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($productDetail && is_array($productDetail->data))
                                                @foreach ($productDetail->data as $gridData)
                                                    <tr>

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail" name="product_detail[][product_name]" value="{{ isset($gridData['product_name']) ? $gridData['product_name'] : '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="text" class="numberDetail" name="product_detail[{{ $loop->index }}][ar_num]"value="{{ isset($gridData['ar_num']) ? $gridData['ar_num'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="month" class="numberDetail"  name="product_detail[{{ $loop->index }}][sample_on]" value="{{ isset($gridData['sample_on']) ?  $gridData['sample_on'] : '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="text" class="numberDetail" name="product_detail[{{ $loop->index }}][sample_by]"value="{{ isset($gridData['sample_by']) ? $gridData['sample_by'] : '' }}">
                                                        </td>

                                                        {{-- <td>
                                                            <div class="new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input   class="click_date"  id="date_{{ $loop->index }}analyzed_on" type="text" name="product_detail[{{ $loop->index }}][analyzed_on]"  placeholder="DD-MMM-YYYY"  value="{{ !empty($gridData['analyzed_on']) ? \Carbon\Carbon::parse($gridData['analyzed_on'])->format('d-M-Y') : '' }}"/>
                                                                        <input type="date"   name="product_detail[{{ $loop->index }}][analyzed_on]"  value="{{ !empty($gridData['analyzed_on']) ? \Carbon\Carbon::parse($gridData['analyzed_on'])->format('Y-m-d') : '' }}"   id="date{{ $loop->index }}analyzed_on" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, 'date_{{ $loop->index   }}analyzed_on')" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td> --}}

                                                        <td>
                                                            <input type="month" class="numberDetail"  name="product_detail[{{ $loop->index }}][analyzed_on]" value="{{ isset($gridData['analyzed_on']) ?  $gridData['analyzed_on'] : '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="month" class="numberDetail"  name="product_detail[{{ $loop->index }}][observation_on]" value="{{ isset($gridData['observation_on']) ?  $gridData['observation_on'] : '' }}">
                                                        </td>

                                                        {{-- <td>
                                                            <div class="new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input   class="click_date"  id="date_{{ $loop->index }}observation_on" type="text" name="product_detail[{{ $loop->index }}][observation_on]"  placeholder="DD-MMM-YYYY"  value="{{ !empty($gridData['observation_on']) ? \Carbon\Carbon::parse($gridData['observation_on'])->format('d-M-Y') : '' }}"/>
                                                                        <input type="date"   name="product_detail[{{ $loop->index }}][observation_on]"  value="{{ !empty($gridData['observation_on']) ? \Carbon\Carbon::parse($gridData['observation_on'])->format('Y-m-d') : '' }}"   id="date{{ $loop->index }}observation_on" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, 'date_{{ $loop->index   }}observation_on')" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td> --}}

                                                        <td><button type="button" class="removeRowBtn" name="Action[]">Remove</button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- <td>{{ $serialNumber }}</td> --}}
                                                <td><input type="text" class="numberDetail"     name="product_detail[0][product_name]"></td>
                                                <td><input type="text" class="Document_Remarks" name="product_detail[0][ar_num]"></td>
                                                <td><input type="month" class="Document_Remarks" name="product_detail[0][sample_on]"></td>
                                                <td><input type="text" class="Document_Remarks" name="product_detail[0][sample_by]">  </td>
                                                <td><input type="month" class="Document_Remarks" name="product_detail[0][analyzed_on]"></td>
                                                <td><input type="month" class="Document_Remarks" name="product_detail[0][observation_on]"></td>
                                                {{-- <td><button type="text" class="removeRowBtn">Remove</button></td> --}}
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Analyst Name<span class="text-danger"></span></label>
                                    <input type="text" name="analyst_name" id="analyst_name"  value="{{ $data->analyst_name }}">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Sample Type</label>
                                    <select name="reference_record" id="reference_record">
                                        <option>Enter Your Selection Here</option>
                                        <option value="raw_material" @if ($data->reference_record == 'raw_material') selected @endif>  Raw Material</option>
                                        <option value="packing_material" @if ($data->reference_record == 'packing_material') selected @endif> Packing Material</option>
                                        <option value="finished_product" @if ($data->reference_record == 'finished_product') selected @endif> Finished Product</option>
                                        <option value="stability_sample" @if ($data->reference_record == 'stability_sample') selected @endif>Stability Sample</option>
                                        <option value="other"           @if ($data->reference_record == 'other') selected @endif>Others </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Others (Specify)<span class="text-danger"></span></label>
                                    <input type="text" name="others" value="{{ $data->others }}">
                                </div>
                            </div>


                            {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="">Stability For</label>
                                        <select multiple id="stability_for" name="stability_for[]">
                                            <option value="">--Select---</option>
                                            <option  value="pankaj" @if ($data->stability_for == 'pankaj') selected @endif>Pankaj</option>
                                            <option  value="gourav" @if ($data->stability_for == 'gourav') selected @endif>Gourav</option>
                                        </select>
                                    </div>
                                </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Stability For </label>
                                    <select multiple id="stability_for" name="stability_for[]">

                                        <option  value="submission"
                                                    {{ strpos($data->stability_for, 'submission') !== false ? 'selected' : '' }}>
                                                    Submission</option>

                                        <option  value="commercial"
                                                        {{ strpos($data->stability_for, 'commercial') !== false ? 'selected' : '' }}>
                                                        Commercial</option>

                                         <option  value="pack_evalution"
                                                            {{ strpos($data->stability_for, 'pack_evalution') !== false ? 'selected' : '' }}>
                                                            Pack Evalution</option>

                                         <option  value="n_a"
                                                                {{ strpos($data->stability_for, 'n_a') !== false ? 'selected' : '' }}>
                                                                Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details Of Stability Study
                                    <button type="button" name="audit-agenda-grid" id="Details">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Details-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">AR Number</th>
                                                <th style="width: 16%"> Condition:Temprature &RH</th>
                                                <th style="width: 15%">Interval</th>
                                                <th style="width: 15%">Orientation</th>
                                                <th style="width: 15%">Pack Details (if any) </th>
                                                <th style="width: 15%">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($gridStability && is_array($gridStability->data))
                                                @foreach ($gridStability->data as $gridData)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail"  name="details_of_stability[{{ $loop->index }}][a_r_number]"    value="{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"  name="details_of_stability[{{ $loop->index }}][temprature]"    value="{{ isset($gridData['temprature']) ? $gridData['temprature'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"  name="details_of_stability[{{ $loop->index }}][interval]"      value="{{ isset($gridData['interval']) ? $gridData['interval'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"  name="details_of_stability[{{ $loop->index }}][orientation]"   value="{{ isset($gridData['orientation']) ? $gridData['orientation'] : '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="text" class="numberDetail"  name="details_of_stability[{{ $loop->index }}][pack_details]"  value="{{ isset($gridData['pack_details']) ? $gridData['pack_details'] : '' }}">
                                                        </td>

                                                        <td><button type="text" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- <td>{{ $serialNumber++ }}</td> --}}
                                                {{-- <td><input type="text" class="numberDetail"     name="details_of_stability[0][item_product_code]"></td> --}}
                                                <td><input type="text" name="details_of_stability[0][a_r_number]"></td>
                                                <td><input type="text" name="details_of_stability[0][temprature]"></td>
                                                <td><input type="text" name="details_of_stability[0][interval]"></td>
                                                <td><input type="text" name="details_of_stability[0][orientation]"></td>
                                                <td><input type="text" name="details_of_stability[0][pack_details]">  </td>
                                                <td><input type="text" class="removeRowBtn" name=""> Remove
                                                </td>
                                            @endif
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Specification Procedure Number <span class="text-danger"></span></label>
                                    <input type="text" name="specification_procedure_number" id=""
                                        value="{{ $data->specification_procedure_number }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Specification Limit<span class="text-danger"></span></label>
                                    <input type="text" name="specification_limit"
                                        value="{{ $data->specification_limit }}">
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    OOT Results
                                    <button type="button" name="audit-agenda-grid" id="ootadd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="oot_table_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">A.R. Number</th>
                                                <th style="width: 16%">Test Name Of OOT</th>
                                                <th style="width: 15%">Result Obtained</th>
                                                <th style="width: 15%">Initial Interval Details</th>
                                                <th style="width: 15%">Previous Interval Details </th>
                                                <th style="width: 15%">% Difference Of Results</th>
                                                <th style="width: 15%">Trend Limit</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @if ($GridOotRes && is_array($GridOotRes->data))
                                                @foreach ($GridOotRes->data as $gridData)
                                                    <tr>

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail"name="oot_result[{{ $loop->index }}][a_r_number]"
                                                                value="{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][test_name_of_oot]"
                                                                value="{{ isset($gridData['test_name_of_oot']) ? $gridData['test_name_of_oot'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][result_obtained]"value="{{ isset($gridData['result_obtained']) ? $gridData['result_obtained'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][i_i_details]"
                                                                value="{{ isset($gridData['i_i_details']) ? $gridData['i_i_details'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][p_i_details]"
                                                                value="{{ isset($gridData['p_i_details']) ? $gridData['p_i_details'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][difference_of_result]"
                                                                value="{{ isset($gridData['difference_of_result']) ? $gridData['difference_of_result'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"
                                                                name="oot_result[{{ $loop->index }}][trend_limit]"
                                                                value="{{ isset($gridData['trend_limit']) ? $gridData['trend_limit'] : '' }}">
                                                        </td>

                                                        <td><button type="text" class="removeRowBtn">Remove</button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- <td>{{ $serialNumber++ }}</td> --}}
                                                {{-- <td><input type="text" class="numberDetail"     name="details_of_stability[0][item_product_code]"></td> --}}
                                                <td><input type="text" name="oot_result[0][a_r_number]"></td>
                                                <td><input type="text" name="oot_result[0][test_name_of_oot]"></td>
                                                <td><input type="text" name="oot_result[0][result_obtainee]"></td>
                                                <td><input type="text" name="oot_result[0][i_i_details]"></td>
                                                <td><input type="text" name="oot_result[0][p_i_details]"></td>
                                                <td><input type="text" name="oot_result[0][difference_of_result]"></td>
                                                <td><input type="text" name="oot_result[0][trend_limit]"></td>
                                                <td><input type="text" class="Action" name=""></td>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Attachment">
                                            @if ($data->Attachment)
                                                @foreach (json_decode($data->Attachment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]"
                                                value="{{ $data->Attachment }}"
                                                oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>


                <!-- ==============Tab-2 start=============== -->

                <di v id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Validity Check After Preliminary Lab Investigation <span
                                            class="text-danger"></span></label>
                                    <select name="pli_finaly_validity_check">
                                        <option>---select---</option>

                                        <option value="valid" @if ($data->pli_finaly_validity_check == 'valid') selected @endif>Valid
                                        </option>
                                        <option value="invalid" @if ($data->pli_finaly_validity_check == 'invalid') selected @endif>Invalid
                                        </option>
                                        <option value="na" @if ($data->pli_finaly_validity_check == 'na') selected @endif>N/A
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Corrective Action</label>
                                    <textarea class="summernote" name="corrective_action" value="{{ $data->corrective_action }}" id="summernote-16">{{ $data->corrective_action }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Preventive Action</label>
                                    <textarea class="summernote" name="preventive_action" value="{{ $data->preventive_action }}" id="summernote-16">{{ $data->preventive_action }} </textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Comments</label>
                                    <textarea class="summernote" name="inv_comments" id="summernote-16" value="{{ $data->inv_comments }}">{{ $data->inv_comments }} </textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="inv_file_attachment">
                                            @if ($data->inv_file_attachment)
                                                @foreach (json_decode($data->inv_file_attachment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="inv_file_attachment[]"
                                                value="{{ $data->inv_file_attachment }}"
                                                oninput="addMultipleFiles(this, 'inv_file_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="search"> Head QA/Designee <span class="text-danger"></span>  </label>

                                    <select id="select-state" placeholder="Select..." name="inv_head_designee">
                                        {{-- <option value="">Select a value</option> --}}
                                        @foreach ($users as $key => $value)
                                            <option @if ($data->inv_head_designee == $value->id) selected @endif
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </di>
                <div id="CCForm18" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Reason for Stability</label>
                                    <textarea class="summernote" name="reason_for_stability" id="summernote-16"
                                        value="{{ $data->reason_for_stability }}">{{ $data->reason_for_stability }} </textarea>
                                </div>
                            </div>
                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Info On Product/Material
                                    <button type="button" name="audit-agenda-grid" id="infoProAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="productMaterialInfo_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row No.</th>
                                                <th style="width: 12%">Batch No.</th>
                                                <th style="width: 16%"> Mfg. Date</th>
                                                <th style="width: 15%">Exp. Date</th>
                                                <th style="width: 15%">AR No.</th>
                                                <th style="width: 15%">Pack Style </th>
                                                <th style="width: 15%">Frequency</th>
                                                <th style="width: 15%">Condition</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @if ($InfoProductMat && is_array($InfoProductMat->data))
                                                @foreach ($InfoProductMat->data as $gridData)
                                                    <tr>

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail" name="info_product[{{ $loop->index }}][batch_no]" value="{{ isset($gridData['batch_no']) ? $gridData['batch_no'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="month" class="numberDetail" name="info_product[{{ $loop->index }}][mfg_date]"  value="{{ isset($gridData['mfg_date']) ? $gridData['mfg_date'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="month" class="numberDetail" name="info_product[{{ $loop->index }}][exp_date]"  value="{{ isset($gridData['exp_date']) ? $gridData['exp_date'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail" name="info_product[{{ $loop->index }}][ar_number]" value="{{ isset($gridData['ar_number']) ? $gridData['ar_number'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"  name="info_product[{{ $loop->index }}][pack_style]" value="{{ isset($gridData['pack_style']) ? $gridData['pack_style'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"name="info_product[{{ $loop->index }}][frequency]"  value="{{ isset($gridData['frequency']) ? $gridData['frequency'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail"name="info_product[{{ $loop->index }}][condition]" value="{{ isset($gridData['condition']) ? $gridData['condition'] : '' }}">
                                                        </td>

                                                        <td><button type="text" class="removeRowBtn">Remove</button>  </td>

                                                    </tr>
                                                          @endforeach
                                                    @else
                                                        <td><input type="text" name="info_product[0][batch_no]"></td>
                                                        <td><input type="date" name="info_product[0][mfg_date]"></td>
                                                        <td><input type="date" name="info_product[0][exp_date]"></td>
                                                        <td><input type="text" name="info_product[0][ar_number]"></td>
                                                        <td><input type="text" name="info_product[0][pack_style]"></td>
                                                        <td><input type="text" name="info_product[0][frequency]"></td>
                                                        <td><input type="text" name="info_product[0][condition]"></td>
                                                        <td><input type="text" class="Action" name=""></td>
                                                    @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Brief Description of OOT
                                        Details</label>
                                    <textarea class="summernote" name="description_of_oot_details" id="summernote-16"
                                        value="{{ $data->description_of_oot_details }}">{{ $data->description_of_oot_details }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Product History</label>
                                    <textarea class="summernote" name="sta_bat_product_history"
                                        id="summernote-16"value="{{ $data->sta_bat_product_history }}">{{ $data->sta_bat_product_history }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Probable Cause</label>
                                    <textarea class="summernote" name="sta_bat_probable_cause" id="summernote-16"
                                        value="{{ $data->sta_bat_probable_cause }}">{{ $data->sta_bat_probable_cause }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="search">
                                        Analyst Name <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="sta_bat_analyst_name">
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key => $value)
                                            <option @if ($data->sta_bat_analyst_name == $value->id) selected @endif
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="search">
                                        QC/QA Head/Designee <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="qa_head_designee">
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key => $value)
                                            <option @if ($data->qa_head_designee == $value->id) selected @endif
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm19" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description"> Preliminary Laboratory Investigation Required ?<span
                                            class="text-danger"></span></label>
                                    <select name="p_l_irequired">
                                        <option value="0">Enter Your Selection Here</option>
                                        <option value="yes"@if ($checkList->p_l_irequired == 'yes') selected @endif>Yes
                                        </option>
                                        <option value="no"@if ($checkList->p_l_irequired == 'no') selected @endif>No
                                        </option>
                                        <option value="na" @if ($checkList->p_l_irequired == 'na') selected @endif>N/A
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{-- Table --}}
                            <div class="col-12">

                                {{-- <label style="font-weight: bold; for=Audit Attachments">Preliminary Laboratory  Investigation</label> --}}

                                <label for="audit-agenda-grid"> Preliminary Laboratory Investigation <button
                                        type="button" name="audit-agenda-grid" id="pliAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;"> </span>
                                </label>

                                <div class="group-input">
                                    <div class="why-why-chart">
                                        <table class="table table-bordered" id="pliAdddetails">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr.No.</th>
                                                    <th style="width: 40%;">Question</th>
                                                    <th style="width: 20%;">Response</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="flex text-center">1</td>
                                                    <td>Were the equipment instrument used for analysis was in
                                                        calibrated state?</td>
                                                    <td>

                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_one" id="responce_one"
                                                                style="padding:   2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_one == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_one == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_one == 'n/a') selected @endif>
                                                                    N/A</option>

                                                            </select>
                                                        </div>

                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_one" value="{{ $checkList->remark_one }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_one }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">2</td>
                                                    <td>Did all components/parts of equipment instrument function properly
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_two" id="responce_two"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_two == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_two == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_two == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_two" value="{{ $checkList->remark_two }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_two }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">3</td>
                                                    <td>Was there any evidence that the sample is contaminated?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_three" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_three == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_three == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_three == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="when_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_three" value="{{ $checkList->remark_three }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_three }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">4</td>
                                                    <td>Is the SOP adequate and operation performed as per sop</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_four" id="responce_four"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_four == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_four == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_four == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="coverage_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_four" value="{{ $checkList->remark_four }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_four }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">5</td>
                                                    <td>Was the glassware used of Class A? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_five" id="responce_five"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option>Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_five == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_five == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_five == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_five" value="{{ $checkList->remark_five }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_five }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">6</td>
                                                    <td>Was there any evidence that the glassware used .may be
                                                        contaminated?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_six" id="responce_six"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option>Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_six == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_six == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_six == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_six" value="{{ $checkList->remark_six }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_six }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">7</td>
                                                    <td>Were the instrument problems such as noisy baseline, poor peak
                                                        resolution, poor injection reproducibility, unidentified peak or
                                                        contamination that affected peak integration, etc. noticed?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_seven" id="responce_seven"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option>Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_seven == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_seven == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_seven == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_seven" value="{{ $checkList->remark_seven }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_seven }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">8</td>
                                                    <td> Any critical parts of equipment/instrument like detector, lamp etc.
                                                        and needed replacement?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_eight" id="responce_eight"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option>Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_eight == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_eight == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_eight == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_eight" value="{{ $checkList->remark_eight }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_eight }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">9</td>
                                                    <td>Was the correct testing procedure followed? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_nine" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option>Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_nine == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_nine == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_nine == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_nine" value="{{ $checkList->remark_nine }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_nine }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">10</td>
                                                    <td>Was there change in instrument, column, method, integration
                                                        technique or standard? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_ten" id="responce_ten"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_ten == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_ten == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_ten == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_ten" value="{{ $checkList->remark_ten }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_ten }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td class="flex text-center">11</td>
                                                    <td>Were the standards & reagents properly stored? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_eleven" id="responce_eleven"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_eleven == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_eleven == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_eleven == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_eleven" value="{{ $checkList->remark_eleven }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_eleven }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">12</td>
                                                    <td>Were standards, reagents properly labelled? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twele" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twele == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twele == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twele == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twele" value="{{ $checkList->remark_twele }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twele }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">13</td>
                                                    <td>Was there any evidence that the standards, reagents have
                                                        degraded? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thrteen" id="responce_thrteen"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thrteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thrteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thrteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thrteen" value="{{ $checkList->remark_thrteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thrteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">14</td>
                                                    <td>Were the reagents/chemicals used of recommended grade? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_fourteen" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>

                                                                <option
                                                                    value="yes"@if ($checkList->responce_fourteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_fourteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_fourteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                                </section>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_fourteen" value="{{ $checkList->remark_fourteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_fourteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">15</td>
                                                    <td>Was the evidence that the reagents, standards or other materials
                                                        used for test were contaminated. </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_fifteen" id="responce_fifteen"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_fifteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_fifteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_fifteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_fifteen" value="{{ $checkList->remark_fifteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_fifteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">16</td>
                                                    <td>Whether correct working /reference standard were used? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_sixteen" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>

                                                                <option
                                                                    value="yes"@if ($checkList->responce_sixteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_sixteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_sixteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_sixteen" value="{{ $checkList->remark_sixteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_sixteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">17</td>
                                                    <td>Was the testing procedure adequate and followed properly? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_seventeen" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_seventeen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_seventeen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_seventeen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                             <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_seventeen" value="{{ $checkList->remark_seventeen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_seventeen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">18</td>
                                                    <td>Was the glassware used properly washed?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_eighteen" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_eighteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_eighteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_eighteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_eighteen" value="{{ $checkList->remark_eighteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_eighteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">19</td>
                                                    <td>Were standards, reagents used within their expiration dates?
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_ninteen" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_ninteen == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_ninteen == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_ninteen == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_ninteen" value="{{ $checkList->remark_ninteen }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_ninteen }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">20</td>
                                                    <td>Were volumetric solutions standardized as per testing procedure?
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty" id="responce_twenty"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty" value="{{ $checkList->remark_twenty }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">21</td>
                                                    <td>Were Working standards standardized as per testing procedure?
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_one" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_one == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_one == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_one == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_one" value="{{ $checkList->remark_twenty_one }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_one }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">22</td>
                                                    <td>Were the dilutions made in sample /standard preparation as per
                                                        testing procedure?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_two" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_two == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_two == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_two == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_two" value="{{ $checkList->remark_twenty_two }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_two }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">23</td>
                                                    <td>Was the analyst trained / certified? </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_three" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_three == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_three == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_three == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_three" value="{{ $checkList->remark_twenty_three }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_three }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">24</td>
                                                    <td>Analyst understood the testing procedure?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_four" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_four == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_four == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_four == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_four" value="{{ $checkList->remark_twenty_four }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_four }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">25</td>
                                                    <td>Analyst calculated the results correctly as mentioned in testing   procedure</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_five" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_five == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_five == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_five == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_five" value="{{ $checkList->remark_twenty_five }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_five }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">26</td>
                                                    <td>Was there any similar occurrence with the same analyst earlier?
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_six" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_six == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_six == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_six == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_six" value="{{ $checkList->remark_twenty_six }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_six }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">27</td>
                                                    <td>Was there any similar history with the product / material?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_seven" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_seven == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_seven == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_seven == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_seven" value="{{ $checkList->remark_twenty_seven }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_seven }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">28</td>
                                                    <td>Retention time of concerned peak is comparable with respect to
                                                        previous station (ln case of OOT in any individual and total
                                                        impurity)</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_eight" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_eight == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_eight == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_eight == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_eight" value="{{ $checkList->remark_twenty_eight }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_eight }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">29</td>
                                                    <td>Was the sample quantity is sufficient?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_twenty_nine" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_twenty_nine == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_twenty_nine == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_twenty_nine == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_twenty_nine" value="{{ $checkList->remark_twenty_nine }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_twenty_nine }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">30</td>
                                                    <td>Was Error in labelling details on the sample container?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thirty" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thirty == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thirty == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thirty == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thirty" value="{{ $checkList->remark_thirty }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thirty }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">31</td>
                                                    <td>Was the Specified storage condition of product sample maintained?
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thirty_one" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thirty_one == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thirty_one == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thirty_one == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thirty_one" value="{{ $checkList->remark_thirty_one }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thirty_one }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">32</td>
                                                    <td>Transient equipment /Instrument malfunction is suspected</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thirty_two" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thirty_two == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thirty_two == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thirty_two == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                     <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thirty_one" value="{{ $checkList->remark_thirty_one }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thirty_one }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">33</td>
                                                    <td>Where any change in the character of the sample observed?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thirty_three" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thirty_three == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thirty_three == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thirty_three == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thirty_three" value="{{ $checkList->remark_thirty_three }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thirty_three }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">34</td>
                                                    <td>Any other specific reason?</td>
                                                    <td>
                                                        <div
                                                            style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="responce_thirty_four" id="response"
                                                                style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option
                                                                    value="yes"@if ($checkList->responce_thirty_four == 'yes') selected @endif>
                                                                    Yes</option>
                                                                <option
                                                                    value="no"@if ($checkList->responce_thirty_four == 'no') selected @endif>
                                                                    No</option>
                                                                <option
                                                                    value="n/a"@if ($checkList->responce_thirty_four == 'n/a') selected @endif>
                                                                    N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                   <td style="vertical-align: middle;">
                                                        <div
                                                            style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="remark_thirty_four" value="{{ $checkList->remark_thirty_four }}"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ $checkList->remark_thirty_four }}</textarea>
                                                        </div>
                                                    </td>

                                                </tr>


                                                @if ($checkList && is_array($checkList->data))
                                                @foreach ($checkList->data as $gridData)
                                                    <tr>
                                                        <td class="flex text-center">{{ $loop->index + 35 }}</td>
                                                        <td>
                                                            <input type="text" class="numberDetail" name="data[{{ $loop->index }}][questions]"
                                                                   value="{{ isset($gridData['questions']) ? $gridData['questions'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                <select name="data[{{ $loop->index }}][response]" id="response"
                                                                        style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125); background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes" @if (isset($gridData['response']) && $gridData['response'] == 'yes') selected @endif>Yes</option>
                                                                    <option value="no" @if (isset($gridData['response']) && $gridData['response'] == 'no') selected @endif>No</option>
                                                                    <option value="n/a" @if (isset($gridData['response']) && $gridData['response'] == 'n/a') selected @endif>N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="data[{{ $loop->index }}][remarks]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ isset($gridData['remarks']) ? $gridData['remarks'] : '' }}</textarea>
                                                        </td>
                                                        <td><button type="button" class="removeRowBtn" name="">Remove</button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>No data available.</p>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description"> Laboratory error Identified for OOT -
                                        Result(s)<span class="text-danger"></span></label>
                                    <select name="l_e_i_oot">
                                        <option>Enter Your Selection Here</option>
                                        <option value="yes"@if ($checkList->l_e_i_oot == 'yes') selected @endif>Yes   </option>
                                        <option value="no"@if ($checkList->l_e_i_oot == 'no') selected @endif>No    </option>
                                        <option value="n/a"@if ($checkList->l_e_i_oot == 'n/a') selected @endif>N/A    </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Elaborate The Reason(s) If Yes :</label>
                                    <textarea class="" value="{{ $checkList->elaborate_the_reson }}" name="elaborate_the_reson"
                                        id="summernote-16">{{ $checkList->elaborate_the_reson }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="search"> LabIn-Charge <span class="text-danger"></span> </label>
                                    <select id="select-state" placeholder="" name="in_charge">
                                        {{-- <option value="">Select a value</option> --}}
                                        @foreach ($users as $key => $value)
                                            <option @if ($data->in_charge == $value->id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="search"> QC Head/Designee <span class="text-danger"></span>
                                    </label>
                                    {{-- <select name="pli_head_designee" id="">
                                        <option value="test"@if ($checkList->pli_head_designee == 'test') selected @endif>test
                                        </option>
                                        <option value="test"@if ($checkList->pli_head_designee == 'test') selected @endif>test
                                        </option>
                                    </select> --}}
                                    <select id="select-state" placeholder="Select..." name="pli_head_designee">
                                        {{-- <option value="">Select a value</option> --}}
                                        @foreach ($users as $key => $value)
                                            <option @if ($data->pli_head_designee == $value->id) selected @endif
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white"
                                    href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm20" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Action Taken on OOT Result(s) :<span class="text-danger"></span></label>
                                    <select id="action_taken_result" name="action_taken_result">
                                        <option>---select---</option>
                                        <option value="yes" @if ($data->action_taken_result == 'yes') selected @endif>Yes
                                        </option>
                                        <option value="no" @if ($data->action_taken_result == 'no') selected @endif>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Retraining to Analyst Required ? <span class="text-danger"></span></label>
                                    <select name="retraining_to_analyst_required">
                                        <option>---select---</option>
                                        <option value="yes" @if ($data->action_taken_result == 'yes') selected @endif>Yes  </option>
                                        <option value="no" @if ($data->action_taken_result == 'no') selected @endif>No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Remarks (If Yes)</label>
                                    <textarea class="summernote" name="cheklist_part_b_remarks" id="summernote-16">{{ $data->cheklist_part_b_remarks }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Correct the Error and Repeat the analysis on same sample<span
                                            class="text-danger"></span></label>
                                    <select name="analysis_on_same_sample">
                                        <option value="0">---select---</option>
                                        <option value="yes" @if ($data->analysis_on_same_sample == 'yes') selected @endif>Yes
                                        </option>
                                        <option value="no" @if ($data->analysis_on_same_sample == 'no') selected @endif>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Any Other Actions Required</label>
                                    <textarea class="summernote" name="any_other_action" value="{{ $data->any_other_action }}" id="summernote-16">{{ $data->any_other_action }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Re-analysis Result</label>
                                    <textarea class="summernote" name="re_analysis_result" value="{{ $data->re_analysis_result }}"
                                        id="summernote-16">{{ $data->re_analysis_result }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Is the Reanalysis results OOT <span class="text-danger"></span></label>
                                    <select name="reanalysis_result_oot">
                                        <option value="0">---select---</option>
                                        <option value="yes" @if ($data->reanalysis_result_oot == 'yes') selected @endif>Yes
                                        </option>
                                        <option value="no" @if ($data->reanalysis_result_oot == 'no') selected @endif>No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Comments (If Yes)</label>
                                    <textarea class="summernote" name="part_b_comments" value="{{ $data->part_b_comments }}" id="summernote-16">{{ $data->part_b_comments }}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">Supporting Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="supporting_attechment">
                                            @if ($data->supporting_attechment)
                                                @foreach (json_decode($data->supporting_attechment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="supporting_attechment[]"
                                                value="{{ $data->supporting_attechment }}"
                                                oninput="addMultipleFiles(this, 'supporting_attechment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white"
                                    href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <div id="CCForm21" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            {{-- <div style=" background: #4274da; color: #ffffff;" class="sub-head">
                                QA Head___ + R&D___ + ADL___ + Regulatory___ + Manufacturing___ + QA Head
                            </div> --}}
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">R&D (F) Comments</label>
                                    <textarea class="summernote" name="r_d_comments_part_b" value="{{ $data->r_d_comments_part_b }}"
                                        id="summernote-16">{{ $data->r_d_comments_part_b }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">ADL Comments</label>
                                    <textarea class="summernote" name="a_d_l_comments" value="{{ $data->a_d_l_comments }}" id="summernote-16">{{ $data->a_d_l_comments }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">Regulatory Comments</label>
                                    <textarea class="summernote" name="regulatory_comments" value="{{ $data->regulatory_comments }}"
                                        id="summernote-16">{{ $data->regulatory_comments }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">Manufacturing Comments</label>
                                    <textarea class="summernote" name="manufacturing_comments" value="{{ $data->manufacturing_comments }}"
                                        id="summernote-16">{{ $data->manufacturing_comments }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">Comments</label>
                                    <textarea class="summernote" name="technical_commitee_comments" value="{{ $data->technical_commitee_comments }}"
                                        id="summernote-16">{{ $data->technical_commitee_comments }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">Supporting Documents </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="supporting_documents">
                                            @if ($data->supporting_documents)
                                                @foreach (json_decode($data->supporting_documents) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="supporting_documents[]"
                                                oninput="addMultipleFiles(this, 'supporting_documents')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white"
                                    href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-3 start=============== -->
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="Last_due-date">Last Due Date <span class="text-danger"></span></label>
                                <input type="date" id="date" name="last_due_date" value="{{ $data->last_due_date ?? '' }}">

                                    {{-- <input type="date" name="last_due_date" value="{{ $data->last_due_date }}"> --}}
                                    {{-- <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" hidden oninput="handleDateInput(this, 'due_date')" /> --}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Progress/Justification for Delay</label>
                                    <textarea class="summernote" name="progress_justification_delay"
                                        value="{{ $data->progress_justification_delay }}" id="summernote-16">{{ $data->progress_justification_delay }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="tentative-date">Tentative Closure Date<span
                                            class="text-danger"></span></label>
                                    <input type="date" name="tentative_clousure_date"
                                        value="{{ $data->tentative_clousure_date }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Remarks by QA Department</label>
                                    <textarea class="summernote" name="remarks_by_qa_department" value="{{ $data->remarks_by_qa_department }}"
                                        id="summernote-16">{{ $data->remarks_by_qa_department }}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Conclusion Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="conclusion_attechment">
                                            @if ($data->conclusion_attechment)
                                                @foreach (json_decode($data->conclusion_attechment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="conclusion_attechment[]"
                                                oninput="addMultipleFiles(this, 'conclusion_attechment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white"
                                    href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- Activity Log  -->

                <div id="CCForm22" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">



                        <center><div class="sub-head">
                            Activity Log
                        </div></center>

                        <div class="sub-head col-lg-12">
                            Submit
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">Submit By : </label>
                                <div class="static">{{$data->submited_by}}</div>


                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Submit On: </label>
                                <div class="static">{{$data->submited_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="comment">Comment : </label>
                                <div class="static">{{$data->a_l_comments}}</div>
                        </div>
                        </div>

                        <div class="sub-head col-lg-12">HOD Primary Review</div>

                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">HOD Primary Review Completed By: </label>
                                <div class="static">{{$data->pls_submited_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">

                            <div class="group-input input-date">
                                <label for="OOC Logged On">HOD Primary Review Completed On</label>
                                <div class="static">{{$data->pls_submited_on}}</div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="hod_review_occ_comment"> Comment : </label>
                                <div class="static">{{$data->pls_comments}}</div>





                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        CQA/QA Head Primary Review
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">

                                <label for="Initiator Group">CQA/QA Head Primary Review Complete By :</label>
                                <div class="static">{{$data->ppli_submited_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">CQA/QA Head Primary Review Complete On : </label>
                                <div class="static">{{$data->ppli_submited_on}}</div>




                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qa_intial_review_ooc_comment">Comment</label>
                                <div class="static">{{$data->ppli_comments}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                            Phase IA Investigation
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA Investigation Complete By : </label>
                                <div class="static">{{$data->p_capa_submited_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA Investigation Complete On : </label>
                                <div class="static">{{$data->p_capa_submited_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->p_capa_comments}}</div>

                            </div>
                        </div>



                        <div class="sub-head col-lg-12">
                        Phase IA HOD Primary Review 
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Primary Review Complete By : </label>
                                <div class="static">{{$data->Final_Approval_By}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA HOD Primary Review Complete On : </label>
                                <div class="static">{{$data->Final_Approval_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->final_capa_comments}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Phase IA QA Review
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA QA Review Complete By : </label>
                                <div class="static">{{$data->cause_i_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA QA Review Complete On : </label>
                                <div class="static">{{$data->cause_i_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->correction_ooc_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Assignable Cause Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable Cause Found Complete By : </label>
                                <div class="static">{{$data->approved_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Found Complete On : </label>
                                <div class="static">{{$data->approved_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->approved_ooc_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable Cause Not Found Complete By : </label>
                                <div class="static">{{$data->correction_r_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Not Found Complete On : </label>
                                <div class="static">{{$data->correction_r_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->correction_r_ncompleted_comment}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                            Phase IB Investigation</div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB Investigation By : </label>
                                <div class="static">{{$data->correction_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB Investigation  On : </label>
                                <div class="static">{{$data->correction_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->correction_ooc_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase IB HOD Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Review Complete By : </label>
                                <div class="static">{{$data->Phase_IB_HOD_Review_Completed_BY}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB HOD Review Complete On : </label>
                                <div class="static">{{$data->Phase_IB_HOD_Review_Completed_ON}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_IB_HOD_Review_Completed_Comment}}</div>

                            </div>
                        </div>




                        <div class="sub-head col-lg-12">
                            Phase IB QA Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB QA Review Complete By : </label>
                                <div class="static">{{$data->Phase_IB_QA_Review_Complete_12_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB QA Review Complete  On : </label>
                                <div class="static">{{$data->Phase_IB_QA_Review_Complete_12_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_IB_QA_Review_Complete_12_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        P-IB Assignable Cause Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB Assignable Cause Found By : </label>
                                <div class="static">{{$data->P_IB_Assignable_Cause_Found_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-IB Assignable Cause Found On : </label>
                                <div class="static">{{$data->P_IB_Assignable_Cause_Found_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->P_IB_Assignable_Cause_Found_comment}}</div>

                            </div>
                        </div>




                        <div class="sub-head col-lg-12">
                        P-IB Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB Assignable Cause Not Found By : </label>
                                <div class="static">{{$data->Under_Phase_II_A_Investigation_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-IB Assignable Cause Found On : </label>
                                <div class="static">{{$data->Under_Phase_II_A_Investigation_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Under_Phase_II_A_Investigation_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase II A Investigation
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A Investigation By : </label>
                                <div class="static">{{$data->Phase_II_A_Investigation_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II A Investigation On : </label>
                                <div class="static">{{$data->Phase_II_A_Investigation_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_A_Investigation_comment}}</div>

                            </div>
                        </div>



                        <div class="sub-head col-lg-12">
                        Phase II A HOD Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Review Complete By : </label>
                                <div class="static">{{$data->Phase_II_A_HOD_Review_Complete_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II A HOD Review Complete On : </label>
                                <div class="static">{{$data->Phase_II_A_HOD_Review_Complete_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_A_HOD_Review_Complete_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase II A QA Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A QA Review Complete By : </label>
                                <div class="static">{{$data->Phase_II_A_QA_Review_Complete_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II A QA Review Complete On : </label>
                                <div class="static">{{$data->Phase_II_A_QA_Review_Complete_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_A_QA_Review_Complete_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        P-II A Assignable Cause Found
                        </div>
                      <div class="col-lg-4">
                        
                            <div class="group-input">
                                <label for="Initiator Group">P-II A Assignable Cause Found By : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Found_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-II A Assignable Cause Found On : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Found_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Found_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        P-II A Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">P-II A Assignable Cause Not Found By : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Not_Found_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-II A Assignable Cause Not Found On : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Not_Found_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->P_II_A_Assignable_Cause_Not_Found_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase II B Investigation
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B Investigation By : </label>
                                <div class="static">{{$data->Phase_II_B_Investigation_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II B Investigation On : </label>
                                <div class="static">{{$data->Phase_II_B_Investigation_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_B_Investigation_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase II B HOD Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B HOD Review Complete By : </label>
                                <div class="static">{{$data->Phase_II_B_HOD_Review_Complete_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II B HOD Review Complete On : </label>
                                <div class="static">{{$data->Phase_II_B_HOD_Review_Complete_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_B_HOD_Review_Complete_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Phase II B QA Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B QA Review Complete By : </label>
                                <div class="static">{{$data->Phase_II_B_QA_ReviewComplete_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase II B QA Review Complete On : </label>
                                <div class="static">{{$data->Phase_II_B_QA_ReviewComplete_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->Phase_II_B_QA_ReviewComplete_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        P-II B Assignable Cause Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">P-II B Assignable Cause Found By : </label>
                                <div class="static">{{$data->P_II_B_Assignable_Cause_Found_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-II B Assignable Cause Found On : </label>
                                <div class="static">{{$data->P_II_B_Assignable_Cause_Found_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->P_II_B_Assignable_Cause_Found_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        P-II B Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">P-II B Assignable Cause Not Found By : </label>
                                <div class="static">{{$data->new_stage_reject_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">P-II B Assignable Cause Not Found On : </label>
                                <div class="static">{{$data->new_stage_reject_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$data->new_stage_reject_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                            Cancel
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">Cancelled By : </label>
                                <div class="static">{{$data->cancelled_by}}</div>


                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Cancelled On: </label>
                                <div class="static">{{$data->cancelled_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="comment">Comment : </label>
                                <div class="static">{{$data->cancell_comment}}</div>
                        </div>
                        </div>

                    </div>
                    </div>

                    <div class="button-block">
                        <button type="submit"
                            class="saveButton"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                        {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button> --}}
                        <button
                            type="submit"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Submit</button>
                        <button type="button"> <a class="text-white"href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                        </button>
                    </div>
                </div>
            </div>

            <!------------------- Tab -8 Start Closure Conclusion ----------------- -->

            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label>Finaly Validity Check <span class="text-danger"></span></label>
                                <select name="finaly_validity_check">
                                    <option>---select---</option>
                                    <option value="valid" @if ($data->finaly_validity_check == 'valid') selected @endif>Valid
                                    </option>
                                    <option value="invalid" @if ($data->finaly_validity_check == 'invalid') selected @endif>Invalid
                                    </option>
                                    <option value="na" @if ($data->finaly_validity_check == 'na') selected @endif>N/A
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label class="mt-4" for="Audit Comments">Closure Comments</label>
                                <textarea class="summernote" name="closure_comments" value="{{ $data->closure_comments }}" id="summernote-16">{{ $data->closure_comments }}</textarea>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="closure attachment">Closure Attachment </label>
                                <div><small class="text-primary">
                                    </small>
                                </div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="supporting_attechment">
                                        @if ($data->doc_closure)
                                            @foreach (json_decode($data->doc_closure) as $file)
                                                <h6 class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                            class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a class="remove-file" data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile"
                                            name="doc_closure[]"value="{{ $data->doc_closure }}"
                                            oninput="addMultipleFiles(this, 'doc_closure')"
                                            oninput="addMultipleFiles(this, 'doc_closure')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="closure attachment">Closure Attachment </label>

                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="doc_closure">
                                        @if ($data->doc_closure)
                                            @foreach (json_decode($data->doc_closure) as $file)
                                                <h6 class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                            class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a class="remove-file" data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="doc_closure[]"
                                            oninput="addMultipleFiles(this, 'doc_closure')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
                </di>
                {{-- </div>

                <!-- ==============Tab-4 start=============== -->
                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">Review Comment</label>
                                    <textarea class="summernote" name="ReviewComment" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Summary Of Earlier OTT And CAPA
                                    <button type="button" name="audit-agenda-grid" id="summaryadd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="summary_table_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">OOT No.</th>
                                                <th style="width: 16%"> OOT Reported Date</th>
                                                <th style="width: 15%">Description Of OOT</th>
                                                <th style="width: 15%">Previous OOT Root Cause</th>
                                                <th style="width: 15%">CAPA </th>
                                                <th style="width: 15%">Closure Date Of CAPA</th>
                                                <!-- <th style="width: 15%">CAPA Required</th>
                                                <th style="width: 15%">CAPA Reference</th>
                                                <th style="width: 15%">Phase II Inves. Req</th>
                                                <th style="width: 15%">Supporting Attachment</th>
                                                <th style="width: 15%">Pre. Lab Invest. Review By</th>
                                                <th style="width: 15%">Pre. Lab Invest. Review On</th> -->


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>
                                            <td><input type="text" name="OOTNo[]"></td>
                                            <td><input type="text" name="OOTReportedDate[]"></td>
                                            <td><input type="text" name="DescriptionOfOOT[]"></td>
                                            <td><input type="text" name="previousIntervalDetails[]"></td>
                                            <td><input type="text" name="CAPA[]"></td>
                                            <td><input type="text" name="ClosureDateOfCAPA[]"></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Phase II Inves. Req<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">Supporting Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ConclusionAttachment[]" oninput="addMultipleFiles(this, 'ConclusionAttachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-5 start=============== -->
                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> QA Approver Report</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Manufacturing Investigation Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Manufacturing Investigation Type</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Manufacturing Investigation Refrence</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Re-Sampling Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Re-Sampling Refrence No</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Hypo/Exp Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Hypo/Exp Refrence</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment"> Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-6 start=============== -->
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Summary Of Phase II Testing</div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of Exp./Hyp.</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of Manufacturing Investigation</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Root Cause Identified <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Category-Reason Identified <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label>Others (OOT Category) <span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Details Of Root Cause</label>
                                    <textarea class="summernote" name="Details" id="summernote-16"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Impact Assessment</label>
                                    <textarea class="summernote" name="ImpactAssessment" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Recommended Action Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Recommended Action Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIInvestigationProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Investigation Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Investigation Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIInvestigationProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Justify If No Investigation Required</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">QC Review Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-7 start=============== -->
                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Review Comment</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Additional Test Proposal<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Additional Test Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Any Other Actions Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Additional Testing Attachment</label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-8 start=============== -->
                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of OOT Test Results</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details Of Stability Study
                                    <button type="button" name="audit-agenda-grid" id="sumarryOfOotAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="sumarryOfOotAddDetails-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Initial Analysis</th>
                                                <th style="width: 16%"> Result From Phase I Investigation</th>
                                                <th style="width: 15%">Retesting Results After Correction Of Assignable Cause</th>
                                                <th style="width: 15%">Hypothesis/Experimentation Results</th>
                                                <th style="width: 15%">Result Of additional Tessting </th>
                                                <th style="width: 15%">Hypothesis Experiment Refrence/Additional Testing Refrence No</th>
                                                <th style="width: 15%">Results </th>
                                                <th style="width: 15%">Analyst Name </th>
                                                <th style="width: 15%">Remarks </th>





                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="InitialAnalysis[]"></td>
                                            <td><input type="text" name="ResultFromPhaseIInvestigation[]"></td>
                                            <td><input type="text" name="RetestingResultsAfterCorrectionOfAssignableCause[]"></td>
                                            <td><input type="text" name="Hypothesis/ExperimentationResults[]"></td>
                                            <td><input type="text" name="ResultOfadditionalTessting[]"></td>
                                            <td><input type="text" name="HypothesisExperimentRefrence/AdditionalTestingRefrenceNo[]"></td>
                                            <td><input type="text" name="Results[]"></td>
                                            <td><input type="text" name="AnalystName[]"></td>
                                            <td><input type="text" name="Remarks[]"></td>


                                        </tbody>
                                    </table>
                                </div>
                            </div>






                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="">Trend Limit</label>
                                    <input />
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Stands<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Result To Be Reported<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="">Reporting Results</label>
                                    <input />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference No </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Action Plan Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Action Plan Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Justification For Delay</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Attachment If any</label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-9 start=============== -->
                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Conclusion Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Impacted Product/Material
                                    <button type="button" name="audit-agenda-grid" id="impactedAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="impacted-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Material/Product Name</th>
                                                <th style="width: 16%"> Batch No (s)/A.R.No (s)</th>
                                                <th style="width: 15%">Any Other Information </th>
                                                <th style="width: 15%">Action Taken On Affected Batch</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="Material/ProductName[]"></td>
                                            <td><input type="text" name="BatchNO[]"></td>
                                            <td><input type="text" name="AnyOtherInformation[]"></td>
                                            <td><input type="text" name="ActionTakenOnAffectedBatch[]"></td>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Required Action Plan<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Refrence Record Plan </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Action Task Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Risk Assessment Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Risk Assessment Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CQ Approver </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>





                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-10 start=============== -->

                <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> CQ Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Reference Of CAPA </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Action Plan Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Refrence Action Plan </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">CQ Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-11 start=============== -->

                <div id="CCForm11" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Disposition Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Category<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Others</label>
                                    <input />
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label> Material Batch Release<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Conclusion</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Justify For Delay In Activity</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-12 start=============== -->

                <div id="CCForm12" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Reason For Reopen</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Reopen Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-13 start=============== -->

                <div id="CCForm13" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Approval Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Approval Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-14 start=============== -->

                <div id="CCForm14" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Execution Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Action Task Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Add. Testing Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Add. Testing Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Investigation Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Investigation Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Hypothesis Experiment Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Hypothesis Experiment Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Any Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-15 start=============== -->

                <div id="CCForm15" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Addendum Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Required Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-16 start=============== -->

                <div id="CCForm16" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Verification Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Verification Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div> --}}

                <!-- ==============Tab-17 start=============== -->

                <div id="CCForm17" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted by">Submitted By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Submitted On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation done On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation Conclusion By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation Conclusion On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation Review By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Phase II Investigation Proposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Phase II Investigation Proposed On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Phase II QC Review Proposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Phase II QC Review Proposed On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Additional TestProposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Additional TestProposed On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">OOT Conclusion Complete By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">OOT Conclusion Complete On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">OOT Conclusion Review By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">OOT Conclusion Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by"> CQ Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on"> CQ Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Disposition Decision Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Disposition Decision On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Reopen Addendum Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Reopen Addendum On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Approved Done By </label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Approved On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Execution Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Execution On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Verification Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Verification Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>

    </div>
    </div>

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/sendstage', $data->id) }}" method="POST">
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
                            <label for="comment">Comment</label>
                            <input type="text" name="comments">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejection-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('RejectStateChangeNew', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and an outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="comment" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



    <div class="modal fade" id="signature-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/thirdStage', $data->id) }}" method="POST">
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
                            <input class="form-control" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="form-control" type="text" name="a_l_comments">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature reject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/reject', $data->id) }}" method="POST">
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
                            <input type="text" name="a_l_comments" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                    <button type="submit" data-bs-dismiss="modal">Submit</button>
                                    <button>Close</button>
                                </div> -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
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

                <form action="{{ url('rcms/cancel', $data->id) }}" method="POST">
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
                            <input type="text" name="a_l_comments" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                                    <button type="submit" data-bs-dismiss="modal">Submit</button>
                                    <button>Close</button>
                                </div> -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="child-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('o_o_t_root_child', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label for="capa-child">
                            <input type="radio" name="revision" id="capa-child" value="capa-child">
                            CAPA
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="Action-Item">
                            Action Item
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="capa-child">
                            <input type="radio" name="revision" id="capa-child" value="Root-Cause-Analysis">
                            RCA
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="capa-child">
                            <input type="radio" name="revision" id="capa-child" value="Resampling">
                            Resampling
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="Extension">
                            Extension
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                          <button type="submit">Submit</button>
                         <button type="button" data-bs-dismiss="modal">Close</button>                         
               </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="child-modal1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('oo_t_capa_child', $data->id) }}" method="POST">
                    @csrf
                    <div class="group-input">
                        <label for="capa-child">
                            <input type="radio" name="revision" id="capa-child" value="Action-child">
                            Action Item
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="Extension">
                            Extension
                        </label>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
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
        VirtualSelect.init({
            ele: '#related_records, #reference_record , #hod,#natureOfChange,#is_repeat'
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
        VirtualSelect.init({
            ele: '#reference_record, #notify_to, #stability_for,#reference'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('select[name=initiator_group]').change(function() {
            let initiator_code = $(this).val();
            $('input[name=initiator_group_code]').val(initiator_code);
        })

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#summaryadd').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="OOTNo[]"></td>' +
                        '<td><input type="text" name="OOTReportedDate[]"></td>' +
                        '<td><input type="text" name="DescriptionOfOOT[]"></td>' +
                        '<td><input type="text" name="previousIntervalDetails[]"></td>' +
                        '<td><input type="text" name="CAPA[]"></td>' +
                        '<td><input type="text" name="ClosureDateOfCAPA[]"></td>' +
                        '</tr>';
                    '</tr>';

                    return html;
                }

                var tableBody = $('#summary_table_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            let indexDetail = {{ $grid_product_mat && is_array($grid_product_mat->data) ? count($grid_product_mat->data) : 0 }};
            $('#addproduct').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="product_materiel[' + indexDetail + '][item_product_code]"></td>' +
                        '<td><input type="text" name="product_materiel[' + indexDetail + '][lot_batch_no]"></td>' +
                        '<td><input type="text" name="product_materiel[' + indexDetail +'][a_r_number]"></td>' +
                        // '<td><input type="month" name="product_materiel[' + indexDetail + '][m_f_g_date]"></td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="m_f_g_date' + indexDetail + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="product_materiel[' + indexDetail + '][m_f_g_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'m_f_g_date' + indexDetail + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="expiry_date' + indexDetail + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="product_materiel[' + indexDetail + '][expiry_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'expiry_date' + indexDetail + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        // '<td><input type="month" name="product_materiel[' + indexDetail + '][expiry_date]"></td>' +
                        '<td><input type="text" name="product_materiel[' + indexDetail + '][label_claim]"></td>' +
                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';
                    indexDetail++;

                    return html;
                }

                var tableBody = $('#info_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

<script>
    $(document).ready(function() {
        let indexDetail =  {{ $productDetail && is_array($productDetail->data) ? count($productDetail->data) : 0 }};
        $('#productAdd').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="product_detail[' + indexDetail + '][product_name]"></td>' +
                    '<td><input type="text" name="product_detail[' + indexDetail + '][ar_num]"></td>' +
                     ' <td><input type="month" name="product_detail[' + indexDetail +'][sample_on]"></td>' +
                    // '<td> <div class="new-date-data-field"><div class="group-input input-date"> <div class="calenderauditee"><input id="date_'+ indexDetail +'sample_on" type="text" name="product_detail[' + indexDetail + '][sample_on]" placeholder="DD-MMM-YYYY" /> <input type="date" name="product_detail[' + indexDetail + '][sample_on]" min="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" value="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" id="date_'+ indexDetail +'sample_on" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_'+ indexDetail +'sample_on\')" /> </div> </div></div></td>' +
                    '<td><input type="text" name="product_detail['+ indexDetail +'][sample_by]"></td>' +
                    // '<td> <div class="new-date-data-field"><div class="group-input input-date"> <div class="calenderauditee"><input id="date_'+ indexDetail +'analyzed_on" type="text" name="product_detail[' + indexDetail + '][analyzed_on]" placeholder="DD-MMM-YYYY" /> <input type="date" name="product_detail[' + indexDetail + '][analyzed_on]" min="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" value="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" id="date_'+ indexDetail +'analyzed_on" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_'+ indexDetail +'analyzed_on\')" /> </div> </div></div></td>' +
                     '<td><input type="month" name="product_detail[' + indexDetail + '][analyzed_on]"></td>' +
                    // '<td> <div class="new-date-data-field"><div class="group-input input-date"> <div class="calenderauditee"><input id="date_'+ indexDetail +'observation_on" type="text" name="product_detail[' + indexDetail + '][observation_on]" placeholder="DD-MMM-YYYY" /> <input type="date" name="product_detail[' + indexDetail + '][observation_on]" min="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" value="{{ \Carbon\Carbon::now()->format("Y-m-d") }}" id="date_'+ indexDetail +'observation_on" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_'+ indexDetail +'observation_on\')" /> </div> </div></div></td>' +
                     '<td><input type="month" name="product_detail[' + indexDetail + '][observation_on]"></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +  '</tr>';
                '</tr>';
                indexDetail++;
                return html;
            }
            var tableBody = $('#product_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


    <script>
        $(document).ready(function() {
            let detailsIndex =
                {{ $gridStability && is_array($gridStability->data) ? count($gridStability->data) : 0 }};
            $('#Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="details_of_stability[' + detailsIndex + '][a_r_number]"></td>' +
                        '<td><input type="text" name="details_of_stability[' + detailsIndex + '][temprature]"></td>' +
                        '<td><input type="text" name="details_of_stability[' + detailsIndex + '][interval]"></td>' +
                        '<td><input type="text" name="details_of_stability[' + detailsIndex + '][orientation]"></td>' +
                        '<td><input type="text" name="details_of_stability[' + detailsIndex + '][pack_details]"></td>' +
                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    '</tr>';
                    detailsIndex++;
                    return html;
                }

                var tableBody = $('#Details-Table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let ootIndex = {{ $GridOotRes && is_array($GridOotRes->data) ? count($GridOotRes->data) : 0 }};
            $('#ootadd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        ' <td><input type="text" name="oot_result[' + ootIndex + '][a_r_number]"></td>' +
                        ' <td><input type="text" name="oot_result[' + ootIndex +
                        '][test_name_of_oot]"></td>' +
                        '<td><input type="text" name="oot_result[' + ootIndex +
                        '][result_obtained]"></td>' +
                        '<td><input type="text" name="oot_result[' + ootIndex + '][i_i_details]"></td>' +
                        '<td><input type="text" name="oot_result[' + ootIndex + '][p_i_details]"></td>' +
                        '<td><input type="text" name="oot_result[' + ootIndex +
                        '][difference_of_result]"></td>' +
                        '<td><input type="text" name="oot_result[' + ootIndex + '][trend_limit]"></td>' +
                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    '</tr>';
                    ootIndex++;
                    return html;
                }

                var tableBody = $('#oot_table_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let infoProduct =
                {{ $InfoProductMat && is_array($InfoProductMat->data) ? count($InfoProductMat->data) : 0 }};
            $('#infoProAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="info_product[' + infoProduct + '][batch_no]"></td>' +
                        '<td><input type="month" name="info_product[' + infoProduct + '][mfg_date]"></td>' +
                        '<td><input type="month" name="info_product[' + infoProduct + '][exp_date]"></td>' +
                        '<td><input type="text" name="info_product[' + infoProduct + '][ar_number]"></td>' +
                        '<td><input type="text" name="info_product[' + infoProduct + '][pack_style]"></td>' +
                        '<td><input type="text" name="info_product[' + infoProduct + '][frequency]"></td>' +
                        '<td><input type="text" name="info_product[' + infoProduct + '][condition]"></td>' +
                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';
                    infoProduct++;
                    return html;
                }

                var tableBody = $('#productMaterialInfo_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var originalRecordNumber = document.getElementById('record_number').value;
            var initialPlaceholder = '---';

            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                var recordNumberElement = document.getElementById('record_number');
                var initiatorGroupCodeElement = document.getElementById('initiator_group_code');

                // Update the initiator group code
                initiatorGroupCodeElement.value = selectedValue;

                // Update the record number by replacing the initial placeholder with the selected initiator group code
                var newRecordNumber = originalRecordNumber.replace(initialPlaceholder, selectedValue);
                recordNumberElement.value = newRecordNumber;

                // Update the original record number to keep track of changes
                originalRecordNumber = newRecordNumber;
                initialPlaceholder = selectedValue;
            });
        });

        document.getElementById("dynamicSelectType").addEventListener("change", function() {
            var selectedRoute = this.value;
            window.location.href = selectedRoute; // Redirect to the selected route
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#sumarryOfOotAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="InitialAnalysis[]"></td>' +
                        '<td><input type="text" name="ResultFromPhaseIInvestigation[]"></td>' +
                        '<td><input type="text" name="RetestingResultsAfterCorrectionOfAssignableCause[]"></td>' +
                        '<td><input type="text" name="Hypothesis/ExperimentationResults[]"></td>' +
                        '<td><input type="text" name="ResultOfadditionalTessting[]"></td>' +
                        '<td><input type="text" name="HypothesisExperimentRefrence/AdditionalTestingRefrenceNo[]"></td>' +
                        '<td><input type="text" name="Results[]"></td>' +
                        '<td><input type="text" name="AnalystName[]"></td>' +
                        '<td><input type="text" name="Remarks[]"></td>' +
                        '</tr>';
                    '</tr>';

                    return html;
                }

                var tableBody = $('#sumarryOfOotAddDetails-Table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#impactedAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="Material/ProductName[]"></td>' +
                        '<td><input type="text" name="BatchNO[]"></td>' +
                        '<td><input type="text" name="AnyOtherInformation[]"></td>' +
                        '<td><input type="text" name="ActionTakenOnAffectedBatch[]"></td>' +
                        '</tr>';
                    '</tr>';
                    return html;
                }

                var tableBody = $('#impacted-Table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let checkList = {{ $checkList && is_array($checkList->data) ? count($checkList->data) : 0 }};;
            $('#pliAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td style=""><input style="margin-left: 25px;" disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="data[' + checkList + '][questions]"></td>'+
                        '<td><select name="data[' + checkList +'][response]" id="" style="margin-top: 10px;margin-left: 28px; padding: 3px; width: 81%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;"> <option value="">Select an Option</option> <option value="yes">Yes</option> <option value="no">No</option><option value="n/a">N/A</option></select></td>'+
                        '<td> <textarea name="data[' + checkList +'][remarks]" style="border-radius: 7px; border: 1.5px solid black;"></textarea></td>'+
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>'+
                        '</tr>';

                    checkList++;
                    return html;
                }

                var tableBody = $('#pliAdddetails tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
@endsection
