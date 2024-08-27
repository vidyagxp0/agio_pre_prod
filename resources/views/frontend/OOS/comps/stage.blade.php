<style>
    #statusBlock > div > .active {
        background: #1aa71a;
        color: white;
    }

    #statusBlock > div > .closed {
        background: #d81515;
        color: white;
    }

    #statusBlock > div > div {
        font-size: 0.7rem; 
    }
</style>
<div class="inner-block state-block">
    <div class="d-flex justify-content-between align-items-center">
    <div class="main-head">Record Workflow </div>
        <div class="d-flex" style="gap:20px;">
            @php
            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
            @endphp
             <button class="button_theme1"> <a class="text-white" href="{{ route('oos_micro.audit_trial', $data->id) }}"> Audit Trail </a> </button>
             @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Submit</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Request For Cancellation </button>
             @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal"> HOD Primary Review Complete </button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Request For Cancellation </button>
             @elseif($data->stage == 3 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">Cancel</button>
 
             @elseif($data->stage == 4 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">CQA/QA Head Primary Review Complete</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
 
             @elseif($data->stage == 5 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Phase IA Investigation</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 6 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IA HOD Review Complete </button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 7 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IA QA Review Complete</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 8 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 9 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB Investigation</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 10 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 11 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 12 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">P-IB Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-I B Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 13 && (in_array(22, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause"> Phase II A Investigation </button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 14 && (in_array(61, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 15 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 16 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-II A Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-II A Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 17 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B Investigation</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 18 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 19 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 20 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-II B Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-II B Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 21 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
             {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button> --}}
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-III Investigation Applicable/Not Applicable</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis-Action-item">Child</button>
             @elseif($data->stage == 22 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
             <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/action-items-create') }}"> Action Item
             </a> </button>
             <button class="button_theme1"> <a class="text-white" href="{{ url('root-cause-analysis') }}"> Root Cause Analysis
             </a> </button>
             @endif
             <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit</a> </button>
 
                
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
            <form action="{{ route('oos.send_stage', $data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span class="text-danger">*</span> </label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span class="text-danger">*</span> </label>
                <input type="password" name="password" required>
            </div>
            <div class="group-input">
                <label for="comment">Comment</label>
                <input type="comment" name="comment">
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
<!-- request-more-info-modal  -->
<div class="modal fade" id="request-more-info-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">E-Signature</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('oos.requestmoreinfo_back_stage', $data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span class="text-danger">*</span> </label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span class="text-danger">*</span> </label>
                <input type="password" name="password" required>
            </div>
            <div class="group-input">
                <label for="comment">Comment <span class="text-danger">*</span> </label>
                <input type="comment" name="comment" required>
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
<!-- Assignable Cause Found -->
<div class="modal fade" id="signature-modal-AssignableCause">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">E-Signature</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('oos.assignable_send_stage', $data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span class="text-danger">*</span> </label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span class="text-danger">*</span> </label>
                <input type="password" name="password" required>
            </div>
            <div class="group-input">
                <label for="comment">Comment </label>
                <input type="comment" name="comment">
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
    
<div class="modal fade" id="cancel-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('oos.cancel_stage', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span> </label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span> </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment <span class="text-danger">*</span> </label>
                        <input type="comment" name="comment" required>
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
<!-- child-modal-rootcause-analysis -->
<div class="modal fade" id="child-modal-rootcause-analysis">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('oos.child', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">Action Item
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
                    </label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- child model -->
{{-- <div class="modal fade" id="child-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('oos.child', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="capa">CAPA
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">
                            Action Item
                        </label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="child-modal-rootcause-analysis-Action-item">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('oos.child', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">Action Item
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Rootcause_Analysis">RCA
                        </label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Continue</button>
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
            <form action="{{ route('oos.child', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="capa">CAPA
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">
                            Action Item
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Rootcause_Analysis">RCA
                        </label>
                        <label style="display: flex; align-items: baseline;" for="major">
                                <input style="width: 10px;" type="radio" name="child_type" value="Resampling">Resampling
                        </label>   
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
                    </label>  
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="child-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('oos.child', $data->id) }}" method="POST">
                    @csrf
                    
                    <div class="group-input">
                        {{-- <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="Extension">
                            Extension
                        </label> --}}
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
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
<!-- Current Status -->
<div class="status" id="statusBlock">
    <div class="head">Current Status</div>
            @if ($data->stage == 0)
                <div class="progress-bars">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div>
            @else
            <div class="progress-bars d-flex">
                @if ($data->stage >= 1)
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2 active">Opened</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2">Opened</div>
                @endif

                @if ($data->stage >= 2)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">HOD Primary Review</div>
                @else
                <div class="  d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">HOD Primary Review</div>
                @endif
                {{-- @if ($data->stage < 4)
                @if ($data->stage >= 3)
                    <div class="active">QA Head Approval</div>
                @else
                    <div class="">QA Head Approval</div>
                @endif
                @endif --}}

                @if ($data->stage < 4)
                @if ($data->stage >= 3)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Approval</div>
                @else
                <div class="  d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Approval</div>
                @endif
                @endif


                @if ($data->stage >= 4)
                <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Primary Review</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Primary Review</div>
                @endif

                @if ($data->stage >= 5)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase-IA Investigation </div>
                @else
                    <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase-IA Investigation</div>
                @endif

                @if ($data->stage >= 6)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA HOD Primary Review</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA HOD Primary Review</div>
                @endif

                @if ($data->stage >= 7)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQA/QA Review</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQA/QA Review</div>
                @endif
                @if ($data->stage >= 8)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-IA CQAH/QAH Review</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-IA CQAH/QAH Review</div>
                @endif
                @if ($data->stage >= 9)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase-IB Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase-IB Investigation</div>
                @endif
                @if ($data->stage >= 10)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB HOD Primary Review</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB HOD Primary Review</div>
                @endif
                @if ($data->stage >= 11)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase IB CQA/QA Review </div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB CQA/QA Review </div>
                @endif
                @if ($data->stage >= 12)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> P-IB CQAH/QAH Review</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-IB CQAH/QAH Review</div>
                @endif
                @if ($data->stage >= 13)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase-II A Investigation </div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase-II A Investigation</div>
                @endif

                {{-- @if ($data->stage >= 13)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase III Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase III Investigation</div>
                @endif --}}

                @if ($data->stage >= 14)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A HOD Primary Review</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A HOD Primary Review</div>
                @endif

                @if ($data->stage >= 15)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase II A CQA/QA Review</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase II A CQA/QA Review</div>
                @endif

                @if ($data->stage >= 16)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-II A QAH/CQAH Review</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-II A QAH/CQAH Review</div>
                @endif
                @if ($data->stage >= 17)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase-II B Investigation</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase-II B Investigation</div>
                @endif
                @if ($data->stage >= 18)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B HOD Primary Review</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B HOD Primary Review</div>
                @endif
                @if ($data->stage >= 19)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B CQA/QA Review</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B CQA/QA Review</div>
                @endif
                @if ($data->stage >= 20)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-II B QAH/CQAH Review</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">P-II B QAH/CQAH Review</div>
                @endif
                @if ($data->stage >= 21)
                <div class="bg-danger d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Closed - Done</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Closed - Done</div>
                @endif
            </div>
            {{-- <div class="progress-bars d-flex">
                @if ($data->stage >= 1)
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2 active">Opened</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2">Opened</div>
                @endif

                @if ($data->stage >= 2)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Initial Assessment & Lab Incident</div>
                @else
                <div class="  d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Initial Assessment & Lab Incident</div>
                @endif

                @if ($data->stage >= 3)
                <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I Investigation</div>
                @endif

                @if ($data->stage >= 4 )
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase I Correction</div>
                @else
                    <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase I Correction</div>
                @endif

                @if ($data->stage >= 5 && $data->stage != 4)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I b Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I b Investigation</div>
                @endif

                @if ($data->stage >= 6)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Hypothesis Experiment</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Hypothesis Experiment</div>
                @endif
                @if ($data->stage >= 7)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Repeat Analysis</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Repeat Analysis</div>
                @endif
                @if ($data->stage >= 8)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II Investigation</div>
                @endif
                @if ($data->stage >= 9)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under  Manufacturing Investigation Phase II a</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under  Manufacturing Investigation Phase II a</div>
                @endif
                @if ($data->stage >= 10)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II a correction</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II a correction</div>
                @endif
                @if ($data->stage >= 11)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II  b Additional Lab Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II  b Additional Lab Investigation</div>
                @endif
                @if ($data->stage >= 12)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Batch Disposition</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Batch Disposition</div>
                @endif

                @if ($data->stage >= 13)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase III Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase III Investigation</div>
                @endif

                @if ($data->stage >= 14)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Pending Final Approval</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Final Approval</div>
                @endif
                
                @if ($data->stage >= 15)
                <div class="bg-danger d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Close Done</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Close Done</div>
                @endif
            </div> --}}
            @endif
    </div>
</div>