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
        font-size: 0.9rem;
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

           <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/oos/audit_trial', $data->id) }}"> Audit Trail </a> </button>

                    @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                       
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                            Cancel
                        </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve Plan
                            </button>
                    @endif
                <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                    </a> </button>
                        
           
             
            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                HOD Review Complete
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                More Info-required
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Implemented
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                Child
            </button>
            -->
        </div>

    </div>
    <div class="status" id="statusBlock">
        <div class="head">Current Status</div>
            <div class="d-flex fs-6">
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark rounded-start p-2 active">Opened</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Pending Initial Assessment & Lab Incident</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I Investigation</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase I Correction</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase I b Investigation</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under HypothesisExperiment</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Repeat Analysis</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Repeat Analysis</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Repeat Analysis</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Repeat Analysis</div>
                <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 rounded-end">Closed - Done</div>
            </div>
    </div>
</div>