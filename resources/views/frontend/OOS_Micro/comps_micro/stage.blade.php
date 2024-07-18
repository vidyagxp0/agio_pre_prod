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
            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $micro_data->division_id])->get();
            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
            @endphp
                 <button class="button_theme1"> <a class="text-white" href="{{ route('oos_micro.audit_trial', $micro_data->id) }}"> Audit Trail </a> </button>
            @if ($micro_data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Submit</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal"> Cancel  </button>
            @elseif($micro_data->stage == 2 && (in_array([4,14], $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal"> Initial Phase I Investigation  </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 3 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Assignable Cause Found</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Assignable Cause Not Found</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>

            @elseif($micro_data->stage == 4 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Correction Completed</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 5 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Proposed Hypothesis Experiment</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 6 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Obvious Error Found</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">No Assignable Cause Found</button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 7 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Repeat Analysis Completed</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 8 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Full Scale Investigation</button>
            @elseif($micro_data->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Assignable Cause Found (Manufacturing Defect)</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">No Assignable Cause Found (No Manufacturing Defect)</button>
            @elseif($micro_data->stage == 10 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Phase II Correction Complete</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A Correction Inconclusive</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 11 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Retesting/resampling</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B Correction Inconclusive</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
            @elseif($micro_data->stage == 12 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause"> Final Approval </button>
            @elseif($micro_data->stage == 13 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Approval Completed</button>
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
            <form action="{{ route('oos_micro.send_stage', $micro_data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span> *</span></label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span> *</span></label>
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
            <form action="{{ route('oos_micro.requestmoreinfo_back_stage', $micro_data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span> *</span></label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span> *</span></label>
                <input type="password" name="password" required>
            </div>
            <div class="group-input">
                <label for="comment">Comment <span> *</span></label>
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
            <form action="{{ route('oos_micro.assignable_send_stage', $micro_data->id) }}" method="POST">
            @csrf
            <!-- Modal body -->
            <div class="modal-body">

            <div class="mb-3 text-justify">
                Please select a meaning and a outcome for this task and enter your username
                and password for this task. You are performing an electronic signature,
                which is legally binding equivalent of a hand written signature.
            </div>
            <div class="group-input">
                <label for="username">Username <span> *</span></label>
                <input type="text" name="username" required>
            </div>
            <div class="group-input">
                <label for="password">Password <span> *</span></label>
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

<div class="modal fade" id="cancel-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('oos_micro.cancel_stage', $micro_data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span> *</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span> *</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment <span> *</span></label>
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
<!-- child-modal-rootcause-analysis -->
<div class="modal fade" id="child-modal-rootcause-analysis">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('oos_micro.child', $micro_data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Rootcause_Analysis">   Rootcause Analysis
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
<div class="modal fade" id="child-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <form action="{{ route('oos_micro.child', $micro_data->id) }}" method="POST">
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
</div>
<!-- Current Status -->
<div class="status" id="statusBlock">
    <div class="head">Current Status</div>
            @if ($micro_data->stage == 0)
                <div class="progress-bars">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div>
            @else
            <div class="progress-bars d-flex">
                @if ($micro_data->stage >= 1)
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2 active">Opened</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2">Opened</div>
                @endif

                @if ($micro_data->stage >= 2)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Initial Assessment & Lab Incident</div>
                @else
                <div class="  d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Initial Assessment & Lab Incident</div>
                @endif

                @if ($micro_data->stage >= 3)
                <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I Investigation</div>
                @endif

                @if ($micro_data->stage >= 4)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase I Correction</div>
                @else
                    <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase I Correction</div>
                @endif

                @if ($micro_data->stage >= 5)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I b Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I b Investigation</div>
                @endif

                @if ($micro_data->stage >= 6)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Hypothesis Experiment</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Hypothesis Experiment</div>
                @endif
                @if ($micro_data->stage >= 7)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Repeat Analysis</div>
                @else
                <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Repeat Analysis</div>
                @endif
                @if ($micro_data->stage >= 8)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II Investigation</div>
                @endif
                @if ($micro_data->stage >= 9)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Full Scale Investigation Phase II</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under  Manufacturing Investigation Phase II a</div>
                @endif
                @if ($micro_data->stage >= 10)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II a correction</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II a correction</div>
                @endif
                @if ($micro_data->stage >= 11)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase II  b Additional Lab Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II  b Additional Lab Investigation</div>
                @endif
                @if ($micro_data->stage >= 12)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Batch Disposition</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Batch Disposition</div>
                @endif

                {{-- @if ($micro_data->stage >= 13)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase III Investigation</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase III Investigation</div>
                @endif --}}

                @if ($micro_data->stage >= 13)
                <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Pending Final Approval</div>
                @else
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Final Approval</div>
                @endif

                @if ($micro_data->stage >= 14)
                <div class="bg-danger d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Close Done</div>
                @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Close Done</div>
                @endif
            </div>
            @endif
    </div>
</div>
