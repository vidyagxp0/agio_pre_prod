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

             <button class="button_theme1"> <a class="text-white" href="{{ route('oos.audit_trial', $data->id) }}"> Audit Trail </a> </button>
             @if ($data->stage == 1 && (($data->initiator_id == Auth::user()->id) || in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Submit</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Request For Cancellation </button>
             @elseif($data->stage == 2 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 4) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal"> HOD Primary Review Complete </button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Request For Cancellation </button>
             @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">Cancel</button>

             @elseif($data->stage == 4 && ( Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">CQA/QA Head Primary Review Complete</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>

             @elseif($data->stage == 5 && ( ($data->initiator_id == Auth::user()->id) ||(Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18))))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Phase IA Investigation</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 6 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 4) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IA HOD Review Complete </button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 7 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 7) || Helpers::check_roles($data->division_id, 'OOS/OOT', 66) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IA QA Review Complete</button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 8 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#Done-modal">Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause">Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>

             @elseif($data->stage == 23 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))

             @elseif($data->stage == 9 && (($data->initiator_id == Auth::user()->id) || ( Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18))))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB Investigation</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 10 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 4) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 11 && ( Helpers::check_roles($data->division_id, 'OOS/OOT', 7) || Helpers::check_roles($data->division_id, 'OOS/OOT', 66) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase IB CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 12 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#Done-modal1">Phase IB Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">P-I B Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>

             @elseif($data->stage == 24 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))

             @elseif($data->stage == 13 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 22) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal-AssignableCause"> Phase II A Investigation </button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 14 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 61) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 15 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 7) || Helpers::check_roles($data->division_id, 'OOS/OOT', 66) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 16 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#Done-modal2">Phase II A Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II A Assignable Cause Not Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>

             @elseif($data->stage == 25 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))

             @elseif($data->stage == 17 && (($data->initiator_id == Auth::user()->id) || (Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18))))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B Investigation</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
             @elseif($data->stage == 18 && ( Helpers::check_roles($data->division_id, 'OOS/OOT', 4) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B HOD Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 19 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 7) || Helpers::check_roles($data->division_id, 'OOS/OOT', 66) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B CQA/QA Review Complete</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 20 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) ))
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">Request More Info</button>
             
             {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B Assignable Cause Found</button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase II B Assignable Cause Not Found</button> --}}
             
             <button type="button"
        class="button_theme1"
        data-bs-toggle="modal"
        data-bs-target="#signature-modal"
        onclick="setActionType('found')">
    Phase II B Assignable Cause Found
</button>

<button type="button"
        class="button_theme1"
        data-bs-toggle="modal"
        data-bs-target="#signature-modal"
        onclick="setActionType('not_found')">
    Phase II B Assignable Cause Not Found
</button>

             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis">Child</button>
             @elseif($data->stage == 21 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 4) ))
             {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#request-more-info-modal">More Information Required</button> --}}
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">Phase III Investigation Applicable/Not Applicable</button>
             {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-rootcause-analysis-Action-item">Child</button> --}}
             @elseif($data->stage == 22 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18) || Helpers::check_roles($data->division_id, 'OOS/OOT', 7)))

             <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/action-items-create') }}"> Action Item
             </a> </button>
             <button class="button_theme1"> <a class="text-white" href="{{ url('root-cause-analysis') }}"> Root Cause Analysis
             </a> </button>
             @endif
             <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit</a> </button>


        </div>
    </div>

    <script>
    function setActionType(type) {
        document.getElementById('action_type').value = type;
    }
</script>
<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">E-Signature</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="sendstage" action="{{ route('oos.send_stage', $data->id) }}" method="POST" class="signatureModalForm">
            @csrf
            <!-- Modal body -->
            <input type="hidden" name="action_type" id="action_type">
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
            <button type="submit" class="signatureModalButton">
                <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Submit
            </button>
            <!-- <button type="submit" class="on-submit-disable-button">Submit</button> -->
            <button type="button" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#sendstage').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
<!-- request-more-info-modal  -->
<div class="modal fade" id="request-more-info-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">E-Signature</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form  class="signatureModalFormloder" action="{{ route('oos.requestmoreinfo_back_stage', $data->id) }}" method="POST">
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
            {{-- <div class="modal-footer">
            <button type="submit" class="on-submit-disable-button">Submit</button>
            <button type="button" data-bs-dismiss="modal">Close</button>
            </div> --}}

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
                // var signatureForm = document.getElementById('signatureModalFormloder');
              var signatureForm = document.querySelector('.signatureModalFormloder'); // <-- class use kiya

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });
</script>
<script>
    $(document).ready(function() {

        $('#requestmoreinfo').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
<!-- Assignable Cause Found -->
<div class="modal fade" id="signature-modal-AssignableCause">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">E-Signature</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="assignable" action="{{ route('oos.assignable_send_stage', $data->id) }}" method="POST" class="signatureModalForm">
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
            <button type="submit" class="signatureModalButton">
                <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Submit
            </button>
            <!-- <button type="submit" class="on-submit-disable-button">Submit</button> -->
            <button type="button" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#assignable').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })


    document.addEventListener('DOMContentLoaded', function() {
        var signatureForms = document.querySelectorAll('.signatureModalForm');

        signatureForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                var submitButton = form.querySelector('.signatureModalButton');
                var spinner = form.querySelector('.signatureModalSpinner');

                if (submitButton) submitButton.disabled = true;
                if (spinner) spinner.style.display = 'inline-block';
            });
        });
    });
</script>
<div class="modal fade" id="cancel-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="cancelstage" action="{{ route('oos.cancel_stage', $data->id) }}" method="POST">
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
                    <button type="submit" class="on-submit-disable-button">Submit</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#cancelstage').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
<div class="modal fade" id="Done-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="Donestage" action="{{ route('oos.Done_stage', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span class="text-danger"> *</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger"> *</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="on-submit-disable-button">Submit</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#Donestage').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
<div class="modal fade" id="Done-modal1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="Donestage1" action="{{ route('oos.Done_One_stage', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span class="text-danger"> *</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger"> *</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="on-submit-disable-button">Submit</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#Donestage1').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
<div class="modal fade" id="Done-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="Donestage2" action="{{ route('oos.Done_Two_stage', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span class="text-danger"> *</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger"> *</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="on-submit-disable-button">Submit</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#Donestage2').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    })
</script>
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
                        {{-- <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">Action Item
                        </label> --}}

                         @if($data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7  || $data->stage == 8 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 14 || $data->stage == 15 || $data->stage == 16 || $data->stage == 18 || $data->stage == 19 || $data->stage == 20)

                                 <label style="display: flex; align-items: baseline;" for="major">
                        <input style="width: 10px;" type="radio" name="child_type" value="Action_Item">Action Item
                        </label>
                            @endif
                        @if($chemical_count >= 3 || $micro_count >= 3 || $oot_count >= 3)
                        @else
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
                        </label>
                        @endif
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
                        @if($chemical_count >= 3 || $micro_count >= 3 || $oot_count >= 3)
                        @else
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
                        </label>
                        @endif
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
                        @if($chemical_count >= 3 || $micro_count >= 3 || $oot_count >= 3)
                        @else
                        <label style="display: flex; align-items: baseline;" for="major">
                            <input style="width: 10px;" type="radio" name="child_type" value="Extension">Extension
                        </label>
                        @endif
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
                    /* Linear Connected Progress Bar */
                    .progress-bars {
                        display: flex;
                        border-radius: 30px;
                        overflow: hidden;
                        border: 1px solid #e0e0e0;
                        background: #f5f5f5;
                    }
                    
                    .progress-bars div {
                        padding: 8px 12px;
                        font-size: 14px;
                        flex-grow: 1;
                        text-align: center;
                        position: relative;
                        transition: all 0.3s ease;
                        border-right: 1px solid #fff;
                    }
                    
                    .progress-bars div:last-child {
                        border-right: none;
                    }
                    
                    /* Completed Stages - Solid Green */
                    .progress-bars div.completed {
                        background-color: #4CAF50;
                        color: black;
                    }
                    
                    /* CURRENT Stage - Animated Blue (Pending Action) */
                    .progress-bars div.current {
                        background-color: #de8d0a;
                        color: black;
                        font-weight: bold;
                        animation: pulse-blue 1.5s infinite;
                    }
                    
                    /* Pending Stages - Light Gray */
                    .progress-bars div.pending {
                        background-color: #f5f5f5;
                        color: black;
                    }
                    
                    /* Closed States */
                    .progress-bars div.closed {
                        background-color: #f44336;
                        color: white;
                    }
                    
                    /* Blue Pulse Animation */
                    @keyframes pulse-blue {
                        0% { background-color: #de8d0a; }
                        50% { background-color: #dfac54; }
                        100% { background-color: #de8d0a; }
                    }
                </style>
                @php
                    $currentStage = $data->stage;
                @endphp
<!-- Current Status -->
<div class="status" id="statusBlock">
                <div class="head p-1">Current Status</div>
            @if ($data->stage == 0)
                <div style="padding: 10px;" class="progress-bars">
                    <div style=" display: flex; justify-content: center; padding: 6px;"  class="bg-danger">Closed-Cancelled</div>
                </div>

                @elseif ($data->stage == 23)
                <div style="padding: 10px;" class="progress-bars">
                    <div style=" display: flex; justify-content: center; padding: 6px;"  class="bg-danger">Closed-Done</div>
                </div>
                @elseif ($data->stage == 24)
                <div style="padding: 10px;" class="progress-bars">
                    <div style=" display: flex; justify-content: center; padding: 6px;" class="bg-danger">Closed-Done</div>
                </div>
                @elseif ($data->stage == 25)
                <div style="padding: 10px;" class="progress-bars">
                    <div style=" display: flex; justify-content: center; padding: 6px;"  class="bg-danger">Closed-Done</div>
                </div>
            @else
                <div class="progress-bars d-flex">

                    <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened</div>

                    {{-- @if ($data->stage >= 2)
                        <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">HOD Primary Review</div>
                    @else
                    <div class="  d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">HOD Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">HOD Primary Review</div>


                    {{-- @if ($data->stage == 3)
                        <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Approval</div>
                    @else
                    @endif --}}

                    <div class="{{ $currentStage > 3 ? 'active' : ($currentStage == 3 ? 'current' : '') }}">CQA/QA Head Approval</div>

                    {{-- @if ($data->stage >= 4)
                    <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Primary Review</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">CQA/QA Head Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 4 ? 'active' : ($currentStage == 4 ? 'current' : '') }}">CQA/QA Head Primary Review</div>

                    {{-- @if ($data->stage >= 5 && (!isset($resampling) || $resampling->status !== 'closed - done'))
                        <div class=" active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase IA Investigation</div>
                    @else
                        <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase IA Investigation</div>
                    @endif --}}
                    @php
                        $allowStage5 = !isset($resampling) || $resampling->status !== 'closed - done';
                    @endphp

                    <div class="{{ ($currentStage > 5 && $allowStage5) 
                                    ? 'active' 
                                    : (($currentStage == 5 && $allowStage5) ? 'current' : '') }}
                                d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">
                        Under Phase IA Investigation
                    </div>
                    {{-- @if ($data->stage >= 6)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA HOD Primary Review</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA HOD Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 6 ? 'active' : ($currentStage == 6 ? 'current' : '') }}">Phase IA HOD Primary Review</div>

                    {{-- @if ($data->stage >= 7)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQA/QA Review</div>
                    @else
                    <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQA/QA Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 7 ? 'active' : ($currentStage == 7 ? 'current' : '') }}">Phase IA CQA/QA Review</div>
                    {{-- @if ($data->stage >= 8)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQAH/QAH Review</div>
                    @else
                    <div class=" d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IA CQAH/QAH Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 8 ? 'active' : ($currentStage == 8 ? 'current' : '') }}">Phase IA CQAH/QAH Review</div>
                    {{-- @if ($data->stage >= 9)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase IB Investigation</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Under Phase IB Investigation</div>
                    @endif --}}
                    <div class="{{ $currentStage > 9 ? 'active' : ($currentStage == 9 ? 'current' : '') }}">Under Phase IB Investigation</div>
                    {{-- @if ($data->stage >= 10)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB HOD Primary Review</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB HOD Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 10 ? 'active' : ($currentStage == 10 ? 'current' : '') }}">Phase IB HOD Primary Review</div>
                    {{-- @if ($data->stage >= 11)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase IB CQA/QA Review </div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB CQA/QA Review </div>
                    @endif --}}
                    <div class="{{ $currentStage > 11 ? 'active' : ($currentStage == 11 ? 'current' : '') }}">Phase IB CQA/QA Review</div>

                    {{-- @if ($data->stage >= 12)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase IB CQAH/QAH Review</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase IB CQAH/QAH Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 12 ? 'active' : ($currentStage == 12 ? 'current' : '') }}">Phase IB CQAH/QAH Review</div>

                    {{-- @if ($data->stage >= 13)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II A Investigation </div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II A Investigation</div>
                    @endif --}}
                    <div class="{{ $currentStage > 13 ? 'active' : ($currentStage == 13 ? 'current' : '') }}">Under Phase II A Investigation</div>

                    {{-- @if ($data->stage >= 14)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A HOD Primary Review</div>
                    @else
                    <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A HOD Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 14 ? 'active' : ($currentStage == 14 ? 'current' : '') }}">Phase II A HOD Primary Review</div>

                    {{-- @if ($data->stage >= 15)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase II A CQA/QA Review</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0"> Phase II A CQA/QA Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 15 ? 'active' : ($currentStage == 15 ? 'current' : '') }}">Phase II A CQA/QA Review</div>

                    {{-- @if ($data->stage >= 16)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A QAH/CQAH Review</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II A QAH/CQAH Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 16 ? 'active' : ($currentStage == 16 ? 'current' : '') }}">Phase II A QAH/CQAH Review</div>
                    {{-- @if ($data->stage >= 17)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II B Investigation</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Under Phase II B Investigation</div>
                    @endif --}}
                    <div class="{{ $currentStage > 17 ? 'active' : ($currentStage == 17 ? 'current' : '') }}">Under Phase II B Investigation</div>
                    {{-- @if ($data->stage >= 18)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B HOD Primary Review</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B HOD Primary Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 18 ? 'active' : ($currentStage == 18 ? 'current' : '') }}">Phase II B HOD Primary Review</div>
                    {{-- @if ($data->stage >= 19)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B CQA/QA Review</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B CQA/QA Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 19 ? 'active' : ($currentStage == 19 ? 'current' : '') }}">Phase II B CQA/QA Review</div>
                    {{-- @if ($data->stage >= 20)
                    <div class="active d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B QAH/CQAH Review</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Phase II B QAH/CQAH Review</div>
                    @endif --}}
                    <div class="{{ $currentStage > 20 ? 'active' : ($currentStage == 20 ? 'current' : '') }}">Phase II B QAH/CQAH Review</div>
                    @if ($data->stage >= 21)
                    <div class="bg-danger d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Closed - Done</div>
                    @else
                        <div class="d-flex justify-items-center align-items-center border border-1 border-dark p-2 border-start-0">Closed - Done</div>
                    @endif
                </div>
            @endif
    </div>
</div>
<script>
            function activateTabBasedOnStage(stage) {
                const tabContents = document.querySelectorAll('.cctabcontent');
                const tabLinks = document.querySelectorAll('.cctablinks');
                
                tabContents.forEach(content => content.style.display = 'none');
                tabLinks.forEach(link => link.classList.remove('active'));
                
                let tabToActivate = '';
                
                if (stage == 1) {
                    tabToActivate = 'CCForm1'; 
                } else if (stage == 2) {
                    tabToActivate = 'CCForm27'; 
                }  else if (stage == 3) {
                    tabToActivate = 'CCForm28'; 
                } else if (stage == 4) {
                    tabToActivate = 'CCForm29'; 
                } else if (stage == 5) {
                    tabToActivate = 'CCForm2'; 
                } else if (stage == 6) {
                    tabToActivate = 'CCForm30'; 
                } else if (stage == 7) {
                    tabToActivate = 'CCForm31'; 
                } else if (stage == 8) {
                    tabToActivate = 'CCForm32'; 
                } else if (stage == 9){
                    tabToActivate = 'CCForm42';
                } else if (stage == 10) {
                    tabToActivate = 'CCForm33';
                } else if (stage == 11){
                    tabToActivate = 'CCForm34';
                } else if (stage == 12){
                    tabToActivate = 'CCForm35';
                } else if (stage == 13){
                    tabToActivate = 'CCForm5';
                } else if (stage == 14){
                    tabToActivate = 'CCForm36';
                } else if (stage == 15){
                    tabToActivate = 'CCForm37';
                } else if (stage == 16){
                    tabToActivate = 'CCForm38';
                } else if (stage == 17){
                    tabToActivate = 'CCForm43';
                } else if (stage == 18){
                    tabToActivate = 'CCForm39';
                } else if (stage == 19){
                    tabToActivate = 'CCForm40';
                } else if (stage == 20){
                    tabToActivate = 'CCForm13';
                } else if (stage == 21){
                    tabToActivate = 'CCForm17';
                }                          
            
                if (tabToActivate) {
                    const tabContent = document.getElementById(tabToActivate);
                    const tabLink = document.querySelector(`.cctablinks[onclick*="${tabToActivate}"]`);
                    
                    if (tabContent) tabContent.style.display = 'block';
                    if (tabLink) tabLink.classList.add('active');
                }
            }

            function openCity(evt, cityName) {
                const tabContents = document.querySelectorAll('.cctabcontent');
                tabContents.forEach(content => content.style.display = 'none');
                
                const tabLinks = document.querySelectorAll('.cctablinks');
                tabLinks.forEach(link => link.classList.remove('active'));
                
                document.getElementById(cityName).style.display = 'block';
                evt.currentTarget.classList.add('active');
                
                currentStep = Array.from(tabLinks).findIndex(button => button === evt.currentTarget);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const currentStage = <?php echo json_encode($data->stage ?? 1); ?>;
                
                activateTabBasedOnStage(currentStage);
            });
        </script>
