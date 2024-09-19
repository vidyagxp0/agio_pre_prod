
@extends('frontend.layout.main')
@section('container')
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
        border-radius: 0px 20px 20px 0px;

    }
</style>

@php
$users = DB::table('users')->get();
@endphp
<div class="form-field-head">
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        {{ Helpers::getDivisionName(session()->get('division')) }}
        / Out Of Calibration
    </div>
</div>

<script>
    $(document).ready(function() {
        let instrumentDetails = 1;
        $('#instrumentdetails').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="date" name="instrumentdetails['+ instrumentDetails +'][instrument_name]"></td>' +
                    ' <td><input type="text" name="instrumentdetails['+ instrumentDetails +'][instrument_id]"></td>' +
                    '<td><input type="text" name="instrumentdetails['+ instrumentDetails +'][remarks]"></td>' +
                    '<td><input type="date" name="instrumentdetails['+ instrumentDetails +'][calibration]"></td>' +
                    '<td><input type="date" name="instrumentdetails['+ instrumentDetails +'][acceptancecriteria]"></td>' +
                    '<td><input type="text" name="instrumentdetails['+ instrumentDetails +'][results]"></td>' +


                    '</tr>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }

                html += '</select></td>' +

                    '</tr>';
                instrumentDetails++;
                return html;
            }

            var tableBody = $('#instrumentdetails_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // let instrumentDetails = 1;
        $('#Monitor_Information').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="date" name="date[]"></td>' +
                    ' <td><input type="text" name="Responsible[]"></td>' +
                    '<td><input type="text" name="ItemDescription[]"></td>' +
                    '<td><input type="date" name="SentDate[]"></td>' +
                    '<td><input type="date" name="ReturnDate[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' +

                //     '</tr>';
                // instrumentDetails++;
                return html;
            }

            var tableBody = $('#Monitor_Information_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Product_Material').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="ProductName[]"></td>' +
                    '<td><input type="number" name="ReBatchNumber[]"></td>' +
                    '<td><input type="date" name="ExpiryDate[]"></td>' +
                    '<td><input type="date" name="ManufacturedDate[]"></td>' +
                    '<td><input type="text" name="Disposition[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' +

                //     '</tr>';

                return html;
            }

            var tableBody = $('#Product_Material_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#Equipment').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="ProductName[]"></td>' +
                    '<td><input type="number" name="BatchNumber[]"></td>' +
                    '<td><input type="date" name="ExpiryDate[]"></td>' +
                    '<td><input type="date" name="ManufacturedDate[]"></td>' +
                    '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                    '<td><input type="text" name="Exist[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' +

                //     '</tr>';

                return html;
            }

            var tableBody = $('#Equipment_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
<script>
    document.getElementById('initiator_group').addEventListener('change', function() {
        var selectedValue = this.value;
        document.getElementById('initiator_group_code').value = selectedValue;
    });
</script>





{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        
{{-- stages ooc--}}
<div id="change-control-view">
<div class="container-fluid">
<div class="inner-block state-block">
    <div class="d-flex justify-content-between align-items-center">
        <div class="main-head">Record Workflow </div>

        <div class="d-flex" style="gap:20px;">
            @php
            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $ooc->division_id])->get();
            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
        @endphp
            <button class="button_theme1"> <a class="text-white"
                    href="{{ route('audittrialooc', $ooc->id) }}"> Audit Trail </a> </button>

            @if ($ooc->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Submit
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    Cancel
                </button>
            @elseif($ooc->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                HOD Primary Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                More Info Required
                </button>
                 <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    Cancel
                </button> 
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                    Child
                </button>
            @elseif($ooc->stage == 3 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                QA Head Primary Review Complete
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                 More Info Required
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                    Child
                </button>
               
                
            @elseif($ooc->stage == 4 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
           
            
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase IA Investigation
            </button>
             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button> 
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                Child
            </button>   
            @elseif($ooc->stage == 5 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                
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
            @elseif($ooc->stage == 6 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Extended Inv. Complete
            </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button> --}}
            @elseif($ooc->stage == 7 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IA QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                    Child
                </button>
                <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    Cause Not Identification
                </button> -->
                
             @elseif($ooc->stage == 8 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Assignable Cause Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    Assignable Cause Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>

                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                    Child
                </button> 
                

                @elseif($ooc->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
               
                @elseif($ooc->stage == 10 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>
               
                @elseif($ooc->stage == 11 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
               
                @elseif($ooc->stage == 12 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase IB QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                    Child
                </button>
               
                @elseif($ooc->stage == 13 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Approved
                </button>
                <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    P-IB Assignable Cause Not Found
                </button> -->
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                    Child
                </button>

                @elseif($ooc->stage == 14 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
                @elseif($ooc->stage == 15 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>

                @elseif($ooc->stage == 16 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A  HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($ooc->stage == 17 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Phase II A QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($ooc->stage == 18 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
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

                @elseif($ooc->stage == 19 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                

                @elseif($ooc->stage == 20 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>

                @elseif($ooc->stage == 21 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B HOD Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($ooc->stage == 22 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Phase II B QA Review Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                     More Information Required
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>

                @elseif($ooc->stage == 23 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
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
    @if ($ooc->stage == 0)
        <div class="progress-bars">
            <div class="bg-danger">Closed-Cancelled</div>
        </div>
    @elseif ($ooc->stage == 9)

    <div class="progress-bars">
            <div class="bg-danger">Closed-Done</div>
        </div>

    @else
        <div class="progress-bars d-flex">
            @if ($ooc->stage >= 1)
                <div class="active">Opened</div>
            @else
                <div class="">Opened</div>
            @endif

            @if ($ooc->stage >= 2)
                <div class="active" style="width: 8%">HOD Primary Review</div>
            @else
                <div class="">HOD Primary Review</div>
            @endif

            @if ($ooc->stage >= 3)
                <div class="active">QA Head Primary Review</div>
            @else
                <div class="">QA Head Primary Review</div>
            @endif

            @if ($ooc->stage >= 4)
                <div class="active">Under Phase-IA Investigation</div>
            @else
                <div class="">Under Phase-IA Investigation</div>
            @endif

            @if ($ooc->stage >= 5)
                <div class="active">Phase IA HOD Primary Review</div>
            @else
                <div class="">Phase IA HOD Primary Review</div>
            @endif

            @if ($ooc->stage >= 7)
                <div class="active">Phase IA QA Review</div>
            @else
                <div class="">Phase IA QA Review</div>
            @endif

            @if ($ooc->stage >= 8)
                <div class="active">P-IA QAH Review</div>
            @else
                <div class="">P-IA QAH Review</div>
            @endif

            @if ($ooc->stage >= 10)
                <div class="active">Under Phase-IB Investigation</div>
            @else
                <div class="">Under Phase-IB Investigation</div>
            @endif

            @if ($ooc->stage >= 11)
                <div class="active">Phase IB HOD Primary Review</div>
            @else
                <div class="">Phase IB HOD Primary Review</div>
            @endif

            @if ($ooc->stage >= 12)
                <div class="active">Phase IB QA Review</div>
            @else
                <div class="">Phase IB QA Review</div>
            @endif
            
            @if ($ooc->stage >= 13)
                <div class="active">P-IB QAH Review</div>
            @else
                <div class="">P-IB QAH Review</div>
            @endif
            

                @if ($ooc->stage >= 14)
                    <div class="bg-danger">Closed Done</div>
                @else
                    <div class="">Closed Done</div>
                @endif
            

            <!-- @if ($ooc->stage >= 15)
                <div class="active">Under Phase-II A Investigation</div>
            @else
                <div class="">Under Phase-II A Investigation</div>
            @endif

            @if ($ooc->stage >= 16)
                <div class="active">Phase II A HOD Primary Review</div>
            @else
                <div class="">Phase II A HOD Primary Review</div>
            @endif

            @if ($ooc->stage >= 17)
                <div class="active">Phase II A QA Review</div>
            @else
                <div class="">Phase II A QA Review</div>
            @endif

            @if ($ooc->stage >= 18)
                <div class="active">P-II A QAH/CQAH Review</div>
            @else
                <div class="">P-II A QAH/CQAH Review</div>
            @endif

            @if ($ooc->stage < 20)
                @if ($ooc->stage >= 19)
                    <div class="bg-danger">Closed Done</div>
                @else
                    <div class="">Closed Done</div>
                @endif
            @endif

            @if ($ooc->stage >= 20)
                <div class="active">Under Phase-II B Investigation</div>
            @else
                <div class="">Under Phase-II B Investigation</div>
            @endif

            @if ($ooc->stage >= 21)
                <div class="active">Phase II B HOD Primary Review</div>
            @else
                <div class="">Phase II B HOD Primary Review</div>
            @endif

            @if ($ooc->stage >= 22)
                <div class="active">Phase II B QA Review</div>
            @else
                <div class="">Phase II B QA Review</div>
            @endif

            @if ($ooc->stage >= 23)
                <div class="active">P-II B QAH/CQAH Review</div>
            @else
                <div class="">P-II B QAH/CQAH Review</div>
            @endif

            @if ($ooc->stage >= 24)
                <div class="bg-danger">Closed - Done</div>
            @else
                <div class="">Closed - Done</div>
            @endif -->
        </div>
    @endif
</div>





      {{-- @endif --}}
      {{-- ---------------------------------------------------------------------------------------- --}}
</div>
</div>
</div>
{{-- stages ooc --}}

{{-- stages ooc signature , child,reject,cancel modla --}}
<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('StageChangeOOC', $ooc->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
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

<div class="modal fade" id="signature-modal1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('StageChangeOOCtwo',$ooc->id)}}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input class="input_full_width" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input class="input_full_width" type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input class="input_full_width" type="comment" name="comment">
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

            <form action="{{ route('OOCCancel', $ooc->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment  <span
                            class="text-danger">*</span></label>
                        <input type="comment" name="comment" required>
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
            <form action="{{ route('o_o_c_root_child', $ooc->id) }}" method="POST">
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
                <form action="{{ route('oo_c_capa_child', $ooc->id) }}" method="POST">
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
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="CAPA">
                            CAPA
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
<div class="modal fade" id="child-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('OOCChildExtension', $ooc->id) }}" method="POST">
                    @csrf
                    
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
<div class="modal fade" id="child-modal3">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('OOCChildAction', $ooc->id) }}" method="POST">
                    @csrf
                    
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="Action-child">
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
<div class="modal fade" id="rejection-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('RejectStateChangeOOC', $ooc->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment <span
                            class="text-danger">*</span></label>
                        <input type="comment" name="comment" required>
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


<div class="modal fade" id="rejection-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('RejectStateChangeTwo', $ooc->id) }}" method="POST">
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



{{-- stages ooc signature , child,reject,cancel modla --}}
        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD Primary Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Head Primary Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Phase IA Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase IA HOD Primary Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase IA QA Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">P-IA QAH Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Phase IB Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Phase IB HOD Primary Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Phase IB QA Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm11')">P-IB QAH Review</button>
            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">HOD Review</button> -->
            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Stage I</button> -->
            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CAPA</button> -->
            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Closure</button> -->
            <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Activity Log</button>

        </div>

        <form action="{{route('OutOfCalibrationUpdate' ,$ooc->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
           

            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">
                            {{-- @foreach ($record_number as $record) --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    <input disabled type="text" name="record_number"
                                        value="{{ Helpers::getDivisionName($ooc->division_id) }}/OOC/{{ Helpers::year($ooc->created_at) }}/{{ $ooc->record }}">
                                    {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                </div>
                            </div>

                                                       {{-- @endforeach --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code"><b>Site/Location Code</b></label>
                                    <input readonly type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                    <input type="hidden" name="division_id" value="{{ session()->get('division') }}">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator"><b>Initiator</b></label>
                                    {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                    <input disabled type="text" name="division_code"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Date Due"><b>Date of Initiation</b></label>
                                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                    <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                   </div>
                            </div>

                            {{-- <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <p class="text-primary"> last date this record should be closed by</p>

                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly
                                            placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($ooc->due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
                                        <input type="date" name="due_date" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')" />
                                    </div>

                                </div>
                            </div> --}}

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <p class="text-primary">Last date this record should be closed by</p>
                            
                                    <div class="calenderauditee">
                                        <input type="text" id="due_date_display" readonly
                                            placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($ooc->due_date) }}"
                                            {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} />
                                        <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" value="{{ $ooc->due_date }}" oninput="handleDateInput(this, 'due_date_display')" />
                                    </div>
                                </div>
                            </div>

                            {{-- javascript for due date --}}
                            <script>
                                                        function handleDateInput(dateInput, displayId) {
                            const displayElement = document.getElementById(displayId);
                            if (displayElement) {
                                const dateValue = new Date(dateInput.value);
                                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                                displayElement.value = dateValue.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                }
                            }

                            </script>




                                                <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="initiator-group">Initiation Department</label>
                                                    <select name="Initiator_Group" id="initiator_group"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA"
                                                            @if ($ooc->Initiator_Group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA"
                                                            @if ($ooc->Initiator_Group == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC"
                                                            @if ($ooc->Initiator_Group == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM"
                                                            @if ($ooc->Initiator_Group == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG"
                                                            @if ($ooc->Initiator_Group == 'PG') selected @endif>Production General</option>
                                                        <option value="PL"
                                                            @if ($ooc->Initiator_Group == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT"
                                                            @if ($ooc->Initiator_Group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE"
                                                            @if ($ooc->Initiator_Group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC"
                                                            @if ($ooc->Initiator_Group == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI"
                                                            @if ($ooc->Initiator_Group == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN"
                                                            @if ($ooc->Initiator_Group == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR"
                                                            @if ($ooc->Initiator_Group == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST"
                                                            @if ($ooc->Initiator_Group == 'ST') selected @endif>Store</option>
                                                        <option value="IT"
                                                            @if ($ooc->Initiator_Group == 'IT') selected @endif>Electronic ooc Processing
                                                        </option>
                                                        <option value="FD"
                                                            @if ($ooc->Initiator_Group == 'FD') selected @endif>Formulation  Development
                                                        </option>
                                                        <option value="AL"
                                                            @if ($ooc->Initiator_Group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                        </option>
                                                        <option value="PD"
                                                            @if ($ooc->Initiator_Group == 'PD') selected @endif>Packaging Development
                                                        </option>

                                                        <option value="PU"
                                                            @if ($ooc->Initiator_Group == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC"
                                                            @if ($ooc->Initiator_Group == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA"
                                                            @if ($ooc->Initiator_Group == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV"
                                                            @if ($ooc->Initiator_Group == 'PV') selected @endif>Pharmacovigilance
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                            
                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiation Group Code">Initiation Department Code</label>
                                                    <input type="text" name="initiator_group_code"
                                                        value="{{ $ooc->Initiator_Group }}" id="initiator_group_code"
                                                        readonly>
                                                    {{-- <div class="default-name"> <span
                                                    id="initiator_group_code">{{ $ooc->Initiator_Group }}</span></div> --}}
                                                </div>
                                            </div>

                            <script>
                                document.getElementById('initiator_group').addEventListener('change', function() {
                                    var selectedValue = this.value;
                                    document.getElementById('initiator_group_code').value = selectedValue;
                                });
                            </script>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="last_calibration_date">Last Calibration Date</label>
                                <div class="calenderauditee">
                                    <!-- This is the display field for the formatted date -->
                                    <input type="text" id="last_calibration_display" readonly
                                        placeholder="DD-MMM-YYYY"  
                                        value="{{ $ooc->last_calibration_date ? \Carbon\Carbon::parse($ooc->last_calibration_date)->format('d-M-Y') : '' }}" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} />
                                    
                                    <!-- This is the actual date picker field -->
                                    <input type="date" name="last_calibration_date" id="last_calibration_date"
                                        class="hide-input" value="{{ $ooc->last_calibration_date ? \Carbon\Carbon::parse($ooc->last_calibration_date)->format('Y-m-d') : '' }}" 
                                        onchange="updateDateDisplay(this)"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} />
                                </div>
                            </div>
                        </div>

                        <script>
                            // Function to handle updating the display field when a date is selected
                            function updateDateDisplay(dateInput) {
                                var selectedDate = new Date(dateInput.value);
                                if (!isNaN(selectedDate.getTime())) {
                                    var options = { day: '2-digit', month: 'short', year: 'numeric' };
                                    var formattedDate = selectedDate.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    document.getElementById('last_calibration_display').value = formattedDate;
                                } else {
                                    document.getElementById('last_calibration_display').value = ''; // Clear if date is invalid
                                }
                            }
                        </script>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Description">Short Description</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <input type="text" name="description_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} value="{{$ooc->description_ooc}}">
                                    
                                </div>
                            </div>



                                    
                            

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="recall" {{ isset($ooc) && $ooc->initiated_through == 'recall' ? 'selected' : '' }}>Recall</option>
                                        <option value="return" {{ isset($ooc) && $ooc->initiated_through == 'return' ? 'selected' : '' }}>Return</option>
                                        <option value="deviation" {{ isset($ooc) && $ooc->initiated_through == 'deviation' ? 'selected' : '' }}>Deviation</option>
                                        <option value="complaint" {{ isset($ooc) && $ooc->initiated_through == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                        <option value="regulatory" {{ isset($ooc) && $ooc->initiated_through == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                        <option value="lab-incident" {{ isset($ooc) && $ooc->initiated_through == 'lab-incident' ? 'selected' : '' }}>Lab Incident</option>
                                        <option value="improvement" {{ isset($ooc) && $ooc->initiated_through == 'improvement' ? 'selected' : '' }}>Improvement</option>
                                        <option value="others" {{ isset($ooc) && $ooc->initiated_through == 'others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="If Other">If Other</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_if_other" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} id="summernote-1">{{$ooc->initiated_if_other}}</textarea>
                                </div>
                            </div>


                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Is Repeat"><b>Is Repeat</b></label>
                                    <select  id="initiator_group" name="is_repeat_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        <option value="0" {{ $ooc->is_repeat_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                        <option value="Yes" {{ $ooc->is_repeat_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ $ooc->is_repeat_ooc == 'No' ? 'selected' : '' }}>No</option>
                                        {{-- <option value="NA" {{ $ooc->is_repeat_ooc == 'NA' ? 'selected' : '' }}>NA</option> --}}
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeat Nature">Repeat Nature</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Repeat_Nature" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        {{$ooc->Repeat_Nature}}
                                    </textarea>
                                </div>
                            </div>



                            


                            
                            
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Initial Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_ooc">
                                            @if ($ooc->initial_attachment_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_ooc" name="initial_attachment_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                            
                        <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        HOD Person <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        <option value="">-- Select a value --</option> 
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($ooc->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                  </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        QA Person <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="qa_assign_person" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        <option value="">-- Select a value --</option> 
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($ooc->qa_assign_person == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('qa_assign_person')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                  </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        OOC Logged by <span class="text-danger"></span>
                                    </label>
                                    <!-- <select id="select-state" placeholder="Select..." name="assign_to" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        <option value="">-- Select a value --</option> 
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($ooc->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror -->

                                    <input type="text" name ="ooc_logged_by" placeholder="Enter Your Text" value = "{{$ooc->ooc_logged_by}}"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}/>
                                </div>
                            </div>





                           

                            {{-- <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> OOC Logged On </label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="ooc_due_date" readonly
                                            placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
                                        <input type="date" name="ooc_due_date" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'ooc_due_date')" />
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> OOC Logged On </label>
                                    <div><small class="text-primary">Please mention expected date of completion</small></div>
                                    <div class="calenderauditee">
                                        <input type="text" id="ooc_due_date" readonly
                                            placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
                                        <input type="date" name="ooc_due_date" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}} class="hide-input"
                                            oninput="handleDateInput(this, 'ooc_due_date')" />
                                    </div>
                                </div>
                            </div> --}}


                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="ooc_due_date">OOC Logged On <span class="text-danger"></span></label>
                                    <p class="text-primary">Last date this record should be closed by</p>
                            
                                    <div class="calenderauditee">
                                        <input type="text" id="ooc_due_date_display" readonly
                                            placeholder="DD-MM-YYYY" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" />
                                        <input type="date" id="ooc_due_date" name="ooc_due_date"
                                            class="hide-input" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}
                                            value="{{ $ooc->ooc_due_date }}" oninput="handleDateInput(this, 'ooc_due_date_display')" />
                                    </div>
                                </div>
                            </div>


                            <script>
                                                            function handleDateInput(dateInput, displayId) {
                                const displayElement = document.getElementById(displayId);
                                if (displayElement) {
                                    const dateValue = new Date(dateInput.value);
                                    const options = { year: 'numeric', month: 'short', day: '2-digit' };
                                    displayElement.value = dateValue.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                }
                            }

                            </script>
                            



                            {{-- grid added new --}}

                        <div class="col-12">
                            <div class="group-input" id="IncidentRow">
                                <label for="root_cause">
                                    Instrument Details
                                    <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                
                                    <table class="table table-bordered" id="onservation-incident-table">
                                        <thead>
                                            <tr>
                                                <th>Row #</th>
                                                <th>Instrument Name</th>
                                                <th>Instrument ID</th>
                                                <th>Remarks</th>
                                                <th>Calibration Parameter</th>
                                                <th>Acceptance Criteria</th>
                                                <th>Results</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serialNumber =1;
                                            @endphp
                                            @foreach ($oocgrid->data as $oogrid )

                                            <tr>
                                            <td disabled >{{ $serialNumber++ }}</td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][instrument_name]" value="{{$oogrid['instrument_name']}}"></td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][instrument_id]" value="{{$oogrid['instrument_id']}}"></td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][remarks]" value="{{$oogrid['remarks']}}"></td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][calibration]" value="{{$oogrid['calibration']}}"></td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][acceptancecriteria]" value="{{$oogrid['acceptancecriteria']}}"></td>
                                            <td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[{{$loop->index}}][results]" value="{{$oogrid['results']}}"></td>
                                            <td><button class="removeRowBtn">Remove</button>

                                            @endforeach   
                                        </tr>
                                        </tbody>
                                    </table>
                                
                            </div>
                        </div>


                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var selectField = document.getElementById('Facility_Equipment');
                                var inputsToToggle = [];

                                // Add elements with class 'facility-name' to inputsToToggle
                                var facilityNameInputs = document.getElementsByClassName('facility-name');
                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                    inputsToToggle.push(facilityNameInputs[i]);
                                }

                                // Add elements with class 'id-number' to inputsToToggle
                                var idNumberInputs = document.getElementsByClassName('id-number');
                                for (var j = 0; j < idNumberInputs.length; j++) {
                                    inputsToToggle.push(idNumberInputs[j]);
                                }

                                // Add elements with class 'remarks' to inputsToToggle
                                var remarksInputs = document.getElementsByClassName('remarks');
                                for (var k = 0; k < remarksInputs.length; k++) {
                                    inputsToToggle.push(remarksInputs[k]);
                                }


                                selectField.addEventListener('change', function() {
                                    var isRequired = this.value === 'yes';
                                    console.log(this.value, isRequired, 'value');

                                    inputsToToggle.forEach(function(input) {
                                        input.required = isRequired;
                                        console.log(input.required, isRequired, 'input req');
                                    });

                                    document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                                    // Show or hide the asterisk icon based on the selected value
                                    var asteriskIcon = document.getElementById('asteriskInvi');
                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                });
                            });
                               </script>


                        <script>
                        $(document).ready(function() {
                            let investdetails = 1;
                            $('#IncidentAdd').click(function(e) {
                                function generateTableRow(serialNumber) {
                                    var html =
                                        '<tr>' +
                                        '<td><input disabled type="text" value="' + serialNumber + '"></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}  name="instrumentdetails[' + investdetails + '][instrument_name]" value=""></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[' + investdetails + '][instrument_id]" value=""></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[' + investdetails + '][remarks]" value=""></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[' + investdetails + '][calibration]" value=""></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[' + investdetails + '][acceptancecriteria]" value=""></td>' +
                                        '<td><input type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="instrumentdetails[' + investdetails + '][results]" value=""></td>' +
                                        '<td><button class="removeRowBtn">Remove</button>'+

                                        '</tr>';
                                    investdetails++; // Increment the row number here
                                    return html;
                                }

                                var tableBody = $('#onservation-incident-table tbody');
                                var rowCount = tableBody.children('tr').length;
                                var newRow = generateTableRow(rowCount + 1);
                                tableBody.append(newRow);
                            });
                            $(document).on('click', '.removeRowBtn', function() {
                                $(this).closest('tr').remove();
                            });
                        });

                            </script>

                        {{-- grid added new --}}



                            <div class="sub-head"> Delay Justification for Reporting</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Delay Justification for Reporting">Delay Justification for Reporting</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Delay_Justification_for_Reporting" id="summernote-1"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                    {{$ooc->Delay_Justification_for_Reporting}}</textarea>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Immediate Action">Immediate Action</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->Immediate_Action_ooc}}
                                    </textarea>
                                </div>
                            </div>


                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">HOD Primary Review</div>
                            <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="HOD Remarks">HOD Primary Remarks  @if($ooc->stage == 2)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                        <div>
                            <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                        </div>
                        <textarea 
                            name="HOD_Remarks" 
                            class="form-control {{$errors->has('HOD_Remarks') ? 'is-invalid' : ''}}" 
                            {{ $ooc->stage == 0 || $ooc->stage == 9 || $ooc->stage == 14 ? 'disabled' : '' }}
                            {{ $ooc->stage == 2 ? 'required' : '' }}>{{$ooc->HOD_Remarks}}</textarea>
                        @if($errors->has('HOD_Remarks'))
                            <div class="invalid-feedback">
                                {{ $errors->first('HOD_Remarks') }}
                            </div>
                        @endif
                    </div>
                 </div>

                            <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">HOD Primary Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachments_hod_ooc">
                                            @if ($ooc->attachments_hod_ooc)
                                            @foreach (json_decode($ooc->attachments_hod_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_hod_ooc" name="attachments_hod_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_hod_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            
                            
                            
                           

                            <!-- <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Immediate Action">Immediate Action</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->Immediate_Action_ooc}}
                                    </textarea>
                                </div>
                            </div> -->

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Preliminary_Investigation_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                        {{$ooc->Preliminary_Investigation_ooc}}
                                    </textarea>
                                </div>
                            </div>






                            {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                        QA Head Primary Review
                        </div>
                        <div class="row">


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="qaheadremarks">QA Head Primary Remarks @if($ooc->stage == 3)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                                <textarea name="qaheadremarks" placeholder="Enter review" class="form-control {{ $errors->has('qaheadremarks') ? 'is-invalid' : '' }}" 
                                    {{ $ooc->stage == 3 ? 'required' : '' }} {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->qaheadremarks}}</textarea>

                                @if($errors->has('qaheadremarks'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('qaheadremarks') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">QA Head Primary Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                        value="{{ $data->Initial_Attachment }}"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_capa_ooc">
                                                @if ($ooc->initial_attachment_capa_ooc)
                                                @foreach (json_decode($ooc->initial_attachment_capa_ooc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_capa_ooc" name="initial_attachment_capa_ooc[]"
                                                    oninput="addMultipleFiles(this, 'initial_attachment_capa_ooc')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" >Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                @php
                            $oocevaluations = array(
                "Status of calibration for other instrument(s) used for performing calibration of the referred instrument",
                "Verification of calibration standards used Primary Standard: Physical appearance, validity, certificate. Secondary standard: Physical appearance, validity",
                "Verification of dilution, calculation, weighing, Titer values and readings",
                "Verification of glassware used",
                "Verification of chromatograms/spectrums/other instrument",
                "Adequacy of system suitability checks",
                "Instrument Malfunction",
                "Check for adherence to the calibration method",
                "Previous History of instrument",
                "Others"
                            )
                        @endphp
             <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">


                        <div class="sub-head">Checklist</div>

                        <div class="col-12">
                            <div class="group-input">
                                <div class="why-why-chart">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Sr.No.</th>
                                                <th style="width: 30%;">Question</th>
                                                <th>Response</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($oocevaluations as $index => $item)
                                           @if(isset($oocEvolution->data[$index]))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td style="background: #DCD8D8">{{ $item }}</td>
                                        <td>
                                            <textarea {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="oocevoluation[{{ $index }}][response]">{{ $oocEvolution->data[$index]['response'] }}</textarea>
                                        </td>
                                        <td>
                                            <textarea {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="oocevoluation[{{ $index }}][remarks]">{{ $oocEvolution->data[$index]['remarks'] }}</textarea>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                    <div class="group-input">
                        <label for="qa_comments">Evaluation Remarks @if($ooc->stage == 4)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                        <textarea 
                            name="qa_comments_ooc" 
                            class="form-control {{ $errors->has('qa_comments_ooc') ? 'is-invalid' : '' }}"
                            {{ $ooc->stage == 4 ? 'required' : '' }}  {{-- Required for stage 4 --}}
                            {{ in_array($ooc->stage, [0, 9, 14]) ? 'disabled' : '' }}  {{-- Disable for stages 0, 9, and 14 --}}
                        >{{$ooc->qa_comments_ooc}}</textarea>

                        @if($errors->has('qa_comments_ooc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('qa_comments_ooc') }}
                            </div>
                        @endif
                    </div>
                </div>

                         <div class="col-12">
                            <div class="group-input">
                                <label for="qa_comments">Description of Cause for OOC Results (If Identified)</label>
                                <textarea name="qa_comments_description_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->qa_comments_description_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Root Cause</label>
                                <select id="assignableSelect" name="is_repeat_assingable_ooc" 
                                        onchange="toggleRootCauseInput()" 
                                        {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} 
                                        {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                    <option value="NA" {{ $ooc->is_repeat_assingable_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_assingable_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_assingable_ooc == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="rootCauseGroup" style="display: none;">
                            <div class="group-input">
                                <label for="RootCause">Comments</label>
                                <textarea name="rootcausenewfield" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here"   {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{ $ooc->rootcausenewfield }}</textarea>
                            </div>
                        </div>

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            toggleRootCauseInput(); // Call this on page load to ensure correct display

                            function toggleRootCauseInput() {
                                var selectValue = document.getElementById("assignableSelect").value;
                                var rootCauseGroup = document.getElementById("rootCauseGroup");
                                var rootCauseTextarea = document.getElementById("rootCauseTextarea");

                                if (selectValue === "Yes") {
                                    rootCauseGroup.style.display = "block";  // Show the textarea if "Yes" is selected
                                    rootCauseTextarea.setAttribute('required', 'required');  // Make textarea required
                                } else {
                                    rootCauseGroup.style.display = "none";   // Hide the textarea if "No" or "NA" is selected
                                    rootCauseTextarea.removeAttribute('required');  // Remove required attribute
                                }
                            }

                            // Attach the event listener
                            document.getElementById("assignableSelect").addEventListener("change", toggleRootCauseInput);
                        });

                        </script>


                        <div class="col-12 sub-head">
                            Hypothesis Study
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="protocol_based_study_hypthesis_study_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                    {{$ooc->protocol_based_study_hypthesis_study_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="justification_for_protocol_study_hypothesis_study_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->justification_for_protocol_study_hypothesis_study_ooc}}
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="plan_of_protocol_study_hypothesis_study" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->plan_of_protocol_study_hypothesis_study}}
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Hypothesis Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachments_hypothesis_ooc">
                                            @if ($ooc->attachments_hypothesis_ooc)
                                            @foreach (json_decode($ooc->attachments_hypothesis_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_hypothesis_ooc" name="attachments_hypothesis_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_hypothesis_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="conclusion_of_protocol_based_study_hypothesis_study_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>
                                  {{$ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc}}  </textarea>
                            </div>
                        </div>
                        <div class="inner-block-content">
                    <div class="row">


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Analyst Remarks">Analyst Interview </label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->analysis_remarks_stage_ooc}}  </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Calibration Results">Calibration Results</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="calibration_results_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->calibration_results_stage_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Results Naturey</label>
                                <select name="is_repeat_result_naturey_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_result_naturey_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_result_naturey_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_result_naturey_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>




                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Review of Calibration Results of Analyst">Review of Calibration Results of Analyst</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" id="summernote-1"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->review_of_calibration_results_of_analyst_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Stage I Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachments_stage_ooc">
                                            @if ($ooc->attachments_stage_ooc)
                                            @foreach (json_decode($ooc->attachments_stage_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_stage_ooc" name="attachments_stage_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_stage_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        
                        



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Results Criteria">Results Criteria</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->results_criteria_stage_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Result</label>
                                <select name="is_repeat_stae_ooc" >
                                    <option value="">-- Select --</option>
                                    <option value="Validated" {{ $ooc->is_repeat_stae_ooc == 'Validated' ? 'selected' : '' }}>Validated</option>
                                    <option value="Invalidated" {{ $ooc->is_repeat_stae_ooc == 'Invalidated' ? 'selected' : '' }}>Invalidated</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="additional_remarks_stage_ooc" id="summernote-1">{{$ooc->additional_remarks_stage_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Cause for failure"> Phase IA Summary</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="phase_ia_investigation_summary" id="summernote-1">{{$ooc->phase_ia_investigation_summary}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective Action">Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capas_ooc" id="summernote-1">{{$ooc->initiated_through_capas_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capa_prevent_ooc" id="summernote-1">{{$ooc->initiated_through_capa_prevent_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capa_corrective_ooc" id="summernote-1">{{$ooc->initiated_through_capa_corrective_ooc}}</textarea>
                            </div>
                        </div>

                    <!-- <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                Exit </a> </button>
                    </div> -->
                </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} >Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                Exit </a> </button>
                    </div>
                </div>
            </div>

            <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">Phase IA HOD Primary Review</div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="HOD Remarks">Phase IA HOD Primary Remarks  @if($ooc->stage == 5)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea  name="phase_IA_HODREMARKS" {{ $ooc->stage == 5 ? 'required' : '' }} {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->phase_IA_HODREMARKS}}</textarea>
                                </div>
                            </div>


                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">Phase IA HOD Primary Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_hodIAHODPRIMARYREVIEW_ooc">
                                                @if ($ooc->attachments_hodIAHODPRIMARYREVIEW_ooc)
                                                @foreach (json_decode($ooc->attachments_hodIAHODPRIMARYREVIEW_ooc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_hodIAHODPRIMARYREVIEW_ooc" name="attachments_hodIAHODPRIMARYREVIEW_ooc[]"
                                                    oninput="addMultipleFiles(this, 'attachments_hodIAHODPRIMARYREVIEW_ooc')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                                    </div>
                        <div class="button-block">
                            <button type="submit" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} class="saveButton">Save</button>
                            <button type="button" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                

                

                

            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                    Phase IA QA Review
                    </div>
                    <div class="row">


                    <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Phase IA QA Remarks  @if($ooc->stage == 7)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                    <textarea name="qaremarksnewfield" placeholder="Enter review" class="form-control {{ $errors->has('qaremarksnewfield') ? 'is-invalid' : '' }}" {{ $ooc->stage == 7 ? 'required' : '' }} {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->qaremarksnewfield}}</textarea>

                    @if($errors->has('qaremarksnewfield'))
                        <div class="invalid-feedback">
                            {{ $errors->first('qaremarksnewfield') }}
                        </div>
                    @endif
                </div>
                  </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Phase IA QA Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_capa_post_ooc">
                                            @if ($ooc->initial_attachment_capa_post_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_capa_post_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_capa_post_ooc" name="initial_attachment_capa_post_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_capa_post_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" >Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                 </div>
            </div>

            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                    P-IA QAH Review
                    </div>
                    <div class="row">


                    <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Initiator Group">P-IA QAH Remarks @if($ooc->stage == 8)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                        <textarea  name="qaHremarksnewfield" placeholder="Enter review" class="form-control {{ $errors->has('qaHremarksnewfield') ? 'is-invalid' : '' }}"{{ $ooc->stage == 8 ? 'required' : '' }} {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->qaHremarksnewfield}}</textarea>

                        @if($errors->has('qaHremarksnewfield'))
                            <div class="invalid-feedback">
                                {{ $errors->first('qaHremarksnewfield') }}
                            </div>
                        @endif
                    </div>
                </div>
                </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment"> P-IA QAH Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_qah_post_ooc">
                                            @if ($ooc->initial_attachment_qah_post_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_qah_post_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_qah_post_ooc" name="initial_attachment_qah_post_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_qah_post_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" >Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                    </div>
            </div>

                
                </div>


                  
            <!-- <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="sub-head">Stage I</div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Analyst Remarks">Analyst Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->analysis_remarks_stage_ooc}}  </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Calibration Results">Calibration Results</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="calibration_results_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->calibration_results_stage_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Results Naturey</label>
                                <select name="is_repeat_result_naturey_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_result_naturey_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_result_naturey_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_result_naturey_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>




                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Review of Calibration Results of Analyst">Review of Calibration Results of Analyst</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" id="summernote-1"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->review_of_calibration_results_of_analyst_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Stage I Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachments_stage_ooc">
                                            @if ($ooc->attachments_stage_ooc)
                                            @foreach (json_decode($ooc->attachments_stage_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_stage_ooc" name="attachments_stage_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_stage_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        
                        



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Results Criteria">Results Criteria</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->results_criteria_stage_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="additional_remarks_stage_ooc" id="summernote-1">{{$ooc->additional_remarks_stage_ooc}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                Exit </a> </button>
                    </div>
                </div>
            </div> -->

            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB Investigation
                    </div>
                    <div class="row">


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Rectification by Service Engineer required</label>
                                <select name="is_repeat_stageii_ooc"  {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="NA" {{ $ooc->is_repeat_stageii_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Instrument is Out of Order</label>
                                <select name="is_repeat_stage_instrument_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="NA" {{ $ooc->is_repeat_stage_instrument_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_stage_instrument_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_stage_instrument_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Proposed By  @if($ooc->stage == 10)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                                <input type="text" name="is_repeat_proposed_stage_ooc" id="is_repeat_proposed_stage_ooc" value="{{$ooc->is_repeat_proposed_stage_ooc}}" class="form-control {{ $errors->has('is_repeat_proposed_stage_ooc') ? 'is-invalid' : '' }}"{{ $ooc->stage == 10 ? 'required' : '' }} {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}/>

                                @if($errors->has('is_repeat_proposed_stage_ooc'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_repeat_proposed_stage_ooc') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Details of Equipment Rectification Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_stageii_ooc">
                                            @if ($ooc->initial_attachment_stageii_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_stageii_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_stageii_ooc" name="initial_attachment_stageii_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_stageii_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Compiled by</label>
                                <!-- <select name="is_repeat_compiled_stageii_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_compiled_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_compiled_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_compiled_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select> -->
                                <input type = "text" name = "is_repeat_compiled_stageii_ooc"  id = "is_repeat_compiled_stageii_ooc" value = "{{$ooc->is_repeat_compiled_stageii_ooc}}" />

                            </div>
                        </div>
                        

                        <!-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Release of Instrument for usage</label>
                                <select name="is_repeat_realease_stageii_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_realease_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_realease_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_realease_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment at Stage II">Impact Assessment</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_throug_stageii_ooc" id="summernote-1">{{$ooc->initiated_throug_stageii_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_stageii_ooc" id="summernote-1">{{$ooc->initiated_through_stageii_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Result of Reanalysis</label>
                                <!-- <select name="is_repeat_reanalysis_stageii_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_reanalysis_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_reanalysis_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_reanalysis_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select> -->

                                <textarea class="summernote" name ="is_repeat_reanalysis_stageii_ooc" >{{$ooc->is_repeat_reanalysis_stageii_ooc}}</textarea>

                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Cause for failure">Cause for failure</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_stageii_cause_failure_ooc" id="summernote-1">{{$ooc->initiated_through_stageii_cause_failure_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Cause for failure">Phase IB Summary</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="phase_ib_investigation_summary" id="summernote-1">{{$ooc->phase_ib_investigation_summary}}</textarea>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_reanalysisi_ooc">
                                            @if ($ooc->initial_attachment_reanalysisi_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_reanalysisi_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_reanalysisi_ooc" name="initial_attachment_reanalysisi_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_reanalysisi_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective Action">Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea  name="initiated_through_capas_ooc_IB" id="summernote-1">{{$ooc->initiated_through_capas_ooc_IB}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea  name="initiated_through_capa_prevent_ooc_IB" id="summernote-1">{{$ooc->initiated_through_capa_prevent_ooc_IB}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea  name="initiated_through_capa_corrective_ooc_IB" id="summernote-1">{{$ooc->initiated_through_capa_corrective_ooc_IB}}</textarea>
                            </div>
                        </div>


                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>

            <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">Phase IB HOD Primary Review</div>
                            <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="HOD Remarks">Phase IB HOD Primary Remarks @if($ooc->stage == 11)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea name="phase_IB_HODREMARKS" class="form-control {{ $errors->has('phase_IB_HODREMARKS') ? 'is-invalid' : '' }}" {{ $ooc->stage == 11 ? 'required' : '' }}{{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->phase_IB_HODREMARKS}}</textarea>

                        @if($errors->has('phase_IB_HODREMARKS'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phase_IB_HODREMARKS') }}
                            </div>
                        @endif
                    </div>
                     </div>



                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">Phase IB HOD Primary Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_hodIBBBHODPRIMARYREVIEW_ooc">
                                                @if ($ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc)
                                                @foreach (json_decode($ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_hodIBBBHODPRIMARYREVIEW_ooc" name="attachments_hodIBBBHODPRIMARYREVIEW_ooc[]"
                                                    oninput="addMultipleFiles(this, 'attachments_hodIBBBHODPRIMARYREVIEW_ooc')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                                    </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                         </div>
            </div>


            <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">Phase IB QA Review</div>
                            <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="HOD Remarks">Phase IB QA Remarks  @if($ooc->stage == 12)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea name="phase_IB_qareviewREMARKS" class="form-control {{ $errors->has('phase_IB_qareviewREMARKS') ? 'is-invalid' : '' }}" {{ $ooc->stage == 12 ? 'required' : '' }}{{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->phase_IB_qareviewREMARKS}}</textarea>

                        @if($errors->has('phase_IB_qareviewREMARKS'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phase_IB_qareviewREMARKS') }}
                            </div>
                        @endif
                    </div>
                    </div>
                    



                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">Phase IB QA Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_QAIBBBREVIEW_ooc">
                                                @if ($ooc->attachments_QAIBBBREVIEW_ooc)
                                                @foreach (json_decode($ooc->attachments_QAIBBBREVIEW_ooc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="attachments_QAIBBBREVIEW_ooc" name="attachments_QAIBBBREVIEW_ooc[]"
                                                    oninput="addMultipleFiles(this, 'attachments_QAIBBBREVIEW_ooc')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                                    </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                     </div>
                </div>

            <!-- <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CAPA Type?</label>
                                <select name="is_repeat_capas_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_capas_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_capas_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_capas_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
                            </div>
                        </div>

                         <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective Action">Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capas_ooc" id="summernote-1">{{$ooc->initiated_through_capas_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capa_prevent_ooc" id="summernote-1">{{$ooc->initiated_through_capa_prevent_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capa_corrective_ooc" id="summernote-1">{{$ooc->initiated_through_capa_corrective_ooc}}</textarea>
                            </div>
                        </div> -->



                        <!-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Details of Equipment Rectification Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_capa_ooc">
                                            @if ($ooc->initial_attachment_capa_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_capa_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_capa_ooc" name="initial_attachment_capa_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_capa_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div> -->
                        
                        
                        
                        
<!-- 
                        <div class="sub-head">
                            Post Implementation of CAPA
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="CAPA Post Implementation Comments">CAPA Post Implementation Comments</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_capa_ooc" id="summernote-1">{{$ooc->initiated_through_capa_ooc}}</textarea>
                            </div>
                        </div>


                        
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">CAPA Post Implementation Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_capa_post_ooc">
                                            @if ($ooc->initial_attachment_capa_post_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_capa_post_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="initial_attachment_capa_post_ooc" name="initial_attachment_capa_post_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_capa_post_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>



                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>  -->


            <div id="CCForm11" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                        P-IB QAH Review
                        </div>
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Release of Instrument for usage</label>
                                <select name="is_repeat_realease_stageii_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onchange="">
                                    <option value="0" {{ $ooc->is_repeat_realease_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_realease_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_realease_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB QAH Remarks @if($ooc->stage == 13)
                                                            <span class="text-danger">*</span>
                                                        @endif</label>
                                <input type="text" name="qPIBaHremarksnewfield" placeholder="Enter review" value="{{$ooc->qaremarksnewfield}}" class="form-control {{ $errors->has('qPIBaHremarksnewfield') ? 'is-invalid' : '' }}"{{ $ooc->stage == 13 ? 'required' : '' }}{{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}/>

                                @if($errors->has('qPIBaHremarksnewfield'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('qPIBaHremarksnewfield') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">P-IB QAH Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                        value="{{ $data->Initial_Attachment }}"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Pib_attachements">
                                                @if ($ooc->Pib_attachements)
                                                @foreach (json_decode($ooc->Pib_attachements) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} type="file" id="Pib_attachements" name="Pib_attachements[]"
                                                    oninput="addMultipleFiles(this, 'Pib_attachements')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>


                            

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" >Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <div id="CCForm12" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        HOD Review
                    </div>
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="HOD Remarks">HOD Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_hodreview_ooc" id="summernote-1">{{$ooc->initiated_through_hodreview_ooc}}</textarea>
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">HOD Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_hodreview_ooc">
                                            @if ($ooc->initial_attachment_hodreview_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_hodreview_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 14 ? "  " : "" }} type="file" id="initial_attachment_hodreview_ooc" name="initial_attachment_hodreview_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_hodreview_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Root Cause Analysis">Root Cause Analysis</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_rootcause_ooc" id="summernote-1">{{$ooc->initiated_through_rootcause_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment">Impact Assessment</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initiated_through_impact_closure_ooc" id="summernote-1">{{$ooc->initiated_through_impact_closure_ooc}}</textarea>
                            </div>
                        </div>




                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>

            <div id="CCForm13" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Closure Comments
                                    <input id="docname" type="text" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="short_description_closure_ooc" value="{{$ooc->short_description_closure_ooc}}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Summary
                                    <input id="docname" type="text" name="Summary_closure" value="{{$ooc->Summary_closure}}">
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Details of Equipment Rectification</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                    value="{{ $data->Initial_Attachment }}"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_closure_ooc">
                                            @if ($ooc->initial_attachment_closure_ooc)
                                            @foreach (json_decode($ooc->initial_attachment_closure_ooc) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file"
                                                        data-file-name="{{ $file }}"><i
                                                            class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="initial_attachment_closure_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} name="initial_attachment_closure_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_closure_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Document Code
                                    <input id="docname" type="text" name="document_code_closure_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} value="{{$ooc->document_code_closure_ooc}}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Remarks
                                    <input id="docname" type="text" name="remarks_closure_ooc" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} value="{{$ooc->remarks_closure_ooc}}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Immediate Corrective Action">Immediate Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_closure_ooc" id="summernote-1" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>{{$ooc->initiated_through_closure_ooc}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}} onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>
            

            
            <div id="CCForm14" class="inner-block cctabcontent">
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
                                <div class="static">{{$ooc->submitted_by}}</div>


                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Submit On: </label>
                                <div class="static">{{$ooc->submitted_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="comment">Comment : </label>
                                <div class="static">{{$ooc->comment}}</div>
                        </div>
                        </div>

                        <div class="sub-head col-lg-12">HOD Primary Review</div>

                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">HOD Primary Review Complete By: </label>
                                <div class="static">{{$ooc->initial_phase_i_investigation_completed_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">

                            <div class="group-input input-date">
                                <label for="OOC Logged On">HOD Primary Review Complete On</label>
                                <div class="static">{{$ooc->initial_phase_i_investigation_completed_on}}</div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="hod_review_occ_comment"> Comment : </label>
                                <div class="static">{{$ooc->initial_phase_i_investigation_comment}}</div>





                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        QA Head Primary Review
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">

                                <label for="Initiator Group">QA Head Primary Review Complete By :</label>
                                <div class="static">{{$ooc->assignable_cause_f_completed_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">QA Head Primary Review Complete On : </label>
                                <div class="static">{{$ooc->assignable_cause_f_completed_on}}</div>




                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qa_intial_review_ooc_comment">Comment</label>
                                <div class="static">{{$ooc->assignable_cause_f_completed_comment}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                       Under Phase-IA Investigation
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA Investigation By : </label>
                                <div class="static">{{$ooc->cause_f_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA Investigation On : </label>
                                <div class="static">{{$ooc->cause_f_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->cause_f_completed_comment}}</div>

                            </div>
                        </div>



                        <div class="sub-head col-lg-12">
                        Phase IA HOD Primary Review 
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Review Complete By : </label>
                                <div class="static">{{$ooc->obvious_r_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA HOD Review Complete On : </label>
                                <div class="static">{{$ooc->obvious_r_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->cause_i_ncompleted_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Phase IA QA Review
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA QA Review Complete By : </label>
                                <div class="static">{{$ooc->cause_i_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IA QA Review Complete On : </label>
                                <div class="static">{{$ooc->cause_i_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->correction_ooc_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Assignable Cause Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable Cause Found By : </label>
                                <div class="static">{{$ooc->approved_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Found On : </label>
                                <div class="static">{{$ooc->approved_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->approved_ooc_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable Cause Not Found By : </label>
                                <div class="static">{{$ooc->correction_r_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Not Found On : </label>
                                <div class="static">{{$ooc->correction_r_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->correction_r_ncompleted_comment}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                          Under Phase IB Investigation</div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB Investigation By : </label>
                                <div class="static">{{$ooc->correction_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB Investigation  On : </label>
                                <div class="static">{{$ooc->correction_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->correction_ooc_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                        Phase IB HOD Primary Review
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Review Complete By : </label>
                                <div class="static">{{$ooc->Phase_IB_HOD_Review_Completed_BY}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB HOD Review Complete On : </label>
                                <div class="static">{{$ooc->Phase_IB_HOD_Review_Completed_ON}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->Phase_IB_HOD_Review_Completed_Comment}}</div>

                            </div>
                        </div>




                        <div class="sub-head col-lg-12">
                            Phase IB QA Review
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB QA Review Complete By : </label>
                                <div class="static">{{$ooc->Phase_IB_QA_Review_Complete_12_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Phase IB QA Review Complete On : </label>
                                <div class="static">{{$ooc->Phase_IB_QA_Review_Complete_12_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->Phase_IB_QA_Review_Complete_12_comment}}</div>

                            </div>
                        </div>

                        <div class="sub-head col-lg-12">
                        Approved
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Approved By : </label>
                                <div class="static">{{$ooc->P_IB_Assignable_Cause_Found_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Approved On : </label>
                                <div class="static">{{$ooc->P_IB_Assignable_Cause_Found_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->P_IB_Assignable_Cause_Found_comment}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                            Cancel
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">Cancelled By : </label>
                                <div class="static">{{$ooc->cancelled_by}}</div>


                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Cancelled On: </label>
                                <div class="static">{{$ooc->cancelled_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="comment">Comment : </label>
                                <div class="static">{{$ooc->cancell_comment}}</div>
                        </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" {{ $ooc->stage == 0 || $ooc->stage == 9 ? 'disabled' : ''}} || {{ $ooc->stage == 0 || $ooc->stage == 14 ? 'disabled' : ''}}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
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
    VirtualSelect.init({
        ele: '#related_records, #hod'
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
        ele: '#reference_record, #notify_to'
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
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(Session::has('swal'))
        Swal.fire({
            title: '{{ Session::get('swal.title') }}',
            text: '{{ Session::get('swal.message') }}',
            icon: '{{ Session::get('swal.type') }}',  // Type can be success, warning, error
            confirmButtonText: 'OK',
            width: '300px',
            height: '200px',
            size: '50px', 
        });
    @endif
</script>
<style>
    .swal2-title {
        font-size: 18px;  /* Customize title font size */
    }
    .swal2-html-container {
        font-size: 14px;  /* Customize content text font size */
    }
    .swal2-confirm {
        font-size: 14px;  /* Customize confirm button font size */
    }
</style>



@endsection
