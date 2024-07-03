
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
            {{-- <button class="button_theme1" onclick="window.print();return false;"
                class="new-doc-btn">Print</button> --}}
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
                    Initial Phase I Investigation
                </button>
                {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    Cancellation Request
                </button> --}}
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>
            @elseif($ooc->stage == 3 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Assignable Cause Found
            </button>
            <button class="button_theme1" name="no_assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                Assignable Cause Not Found
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                Request More Info
            </button>
               
                
            @elseif($ooc->stage == 4 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
           
            
            <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                Correction Completed
            </button>
            <button class="button_theme1" name="no_assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                Cause Failed
            </button>
            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                Child
            </button>   
            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    All Activities Completed
                </button> --}}
            @elseif($ooc->stage == 5 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Obvious Results Not Found
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    Obvious Results Found
                </button>
                {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Request More Info
                </button> --}}
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
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
            @elseif($ooc->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Cause Identification
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    Cause Not Identification
                </button>
                
             @elseif($ooc->stage == 8 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Pending Approval
                </button> --}}
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Correction Complete
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                    Result Failed
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button> 
                

                @elseif($ooc->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                
               
                @elseif($ooc->stage == 10 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Correction Complete
                </button>
           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                    Child
                </button>
               
                @elseif($ooc->stage == 11 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal1">
                    QA Review Complete
                </button>
           
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                    Child
                </button>
               
                @elseif($ooc->stage == 12 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Pending Initial Assessment & Lab Investigation
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Send to HOD Review
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Send to QA Initial Review
                </button>
                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Approved
                </button>
                       
               
               

                
                <!-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                        Exit
                    </a> </button> -->
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
        
        @else
            <div class="progress-bars d-flex">
                @if ($ooc->stage >= 1)
                    <div class="active">Opened</div>
                @else
                    <div class="">Opened</div>
                @endif

                @if ($ooc->stage >= 2)
                    <div class="active"  style="width: 8% ">Pending Intial Assesment & Lab Investigation </div>
                @else
                    <div class="">Pending Intial Assesment & Lab Investigation</div>
                @endif

                @if ($ooc->stage >= 3)
                    <div class="active">Under Stage I Investigation</div>
                @else
                    <div class="">Under Stage I Investigation</div>
                @endif

                @if ($ooc->stage >= 4)
                    <div class="active">Under Stage I Corrective</div>
                @else
                    <div class="">Under Stage I Corrective</div>
                @endif
                @if ($ooc->stage >= 5)
                    <div class="active">Under Stage II A Investigation</div>
                @else
                    <div class="">Under Stage II A Investigation</div>
                @endif
                {{-- @if ($ooc->stage >= 6)
                    <div class="active">To Pending Final Approval</div>
                @else
                    <div class="">To Pending Final Approval</div>
                @endif --}}
                @if ($ooc->stage >= 7)
                    <div class="active">Under Stage II B Investigation</div>
                @else
                    <div class="">Under Stage II B Investigation</div>
                @endif
                 @if ($ooc->stage >= 8)
                    <div class="active">Under Stage II A Correction</div>
                @else
                    <div class="">Under Stage II A Correction</div>    
                @endif
                {{-- @if ($ooc->stage >= 9)
                    <div class="active">To Pending Final Approval</div>
                @else
                    <div class="">To Pending Final Approval</div>    
                @endif --}}
                @if ($ooc->stage >= 10)
                    <div class="active">Under Stage II A Correction</div>
                @else
                    <div class="">Under Stage II A Correction</div>    
                @endif
                @if ($ooc->stage >= 11)
                    <div class="active">Discussion Manufacturing QA Correction</div>
                @else
                    <div class="">Discussion Manufacturing QA Correction</div>    
                @endif
                @if ($ooc->stage >= 12)
                    <div class="active">Pending Final Approval</div>
                @else
                    <div class="">Pending Final Approval</div>    
                @endif
                
                @if ($ooc->stage >= 13)
                    <div class="bg-danger" >Closed - Done</div>
                @else
                    <div class="">Closed - Done</div>
                @endif
        @endif



        </div>
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
                    {{-- <div class="group-input">
                        <label for="root-item">
                         <input type="radio" name="revision" id="root-item" value="effectiveness-check">
                            Effectiveness check
                        </label>
                    </div> --}}
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Continue</button>
                </div> -->
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
                            <input type="radio" name="revision" id="capa-child" value="extension-child">
                            Extension
                        </label>
                    </div>
                    <div class="group-input">
                        <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="risk-Item">
                            Risk Assessment
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



{{-- stages ooc signature , child,reject,cancel modla --}}
        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD/Supervisor Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">OOC Evaluation Form</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Stage I</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Stage II</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CAPA</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Closure</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Signature</button>

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
                                        value="{{ Helpers::getDivisionName($ooc->division_id) }}/LI/{{ Helpers::year($ooc->created_at) }}/{{ $ooc->record }}">
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
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($ooc->due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
                                        <input type="date" name="due_date" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
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
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($ooc->due_date) }}"
                                            {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : '' }} />
                                        <input type="date" id="due_date" name="due_date"
                                            {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : '' }}
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            value="{{ $ooc->due_date }}" oninput="handleDateInput(this, 'due_date_display')" />
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

                            {{-- javascript for due date --}}



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="Initiator_Group" {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }}
                                         id="initiator_group">
                                        <option value="Corporate Quality Assurance"
                                            @if ($ooc->Initiator_Group== 'Corporate Quality Assurance') selected @endif>Corporate
                                            Quality Assurance</option>
                                        <option value="QAB"
                                            @if ($ooc->Initiator_Group== 'QAB') selected @endif>Quality
                                            Assurance Biopharma</option>
                                        <option value="CQC"
                                            @if ($ooc->Initiator_Group== 'CQC') selected @endif>Central
                                            Quality Control</option>
                                        <option value="CQC"
                                            @if ($ooc->Initiator_Group== 'MANU') selected @endif>Manufacturing
                                        </option>
                                        <option value="PSG"
                                            @if ($ooc->Initiator_Group== 'PSG') selected @endif>Plasma
                                            Sourcing Group</option>
                                        <option value="CS"
                                            @if ($ooc->Initiator_Group== 'CS') selected @endif>Central
                                            Stores</option>
                                        <option value="ITG"
                                            @if ($ooc->Initiator_Group== 'ITG') selected @endif>Information
                                            Technology Group</option>
                                        <option value="MM"
                                            @if ($ooc->Initiator_Group== 'MM') selected @endif>Molecular
                                            Medicine</option>
                                        <option value="CL"
                                            @if ($ooc->Initiator_Group== 'CL') selected @endif>Central
                                            Laboratory</option>
                                        <option value="TT"
                                            @if ($ooc->Initiator_Group== 'TT') selected @endif>Tech
                                            team</option>
                                        <option value="QA"
                                            @if ($ooc->Initiator_Group== 'QA') selected @endif>Quality
                                            Assurance</option>
                                        <option value="QM"
                                            @if ($ooc->Initiator_Group== 'QM') selected @endif>Quality
                                            Management</option>
                                        <option value="IA"
                                            @if ($ooc->Initiator_Group== 'IA') selected @endif>IT
                                            Administration</option>
                                        <option value="ACC"
                                            @if ($ooc->Initiator_Group== 'ACC') selected @endif>Accounting
                                        </option>
                                        <option value="LOG"
                                            @if ($ooc->Initiator_Group== 'LOG') selected @endif>Logistics
                                        </option>
                                        <option value="SM"
                                            @if ($ooc->Initiator_Group== 'SM') selected @endif>Senior
                                            Management</option>
                                        <option value="BA"
                                            @if ($ooc->Initiator_Group== 'BA') selected @endif>Business
                                            Administration</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Description">Short Description</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <input type="text" name="description_ooc" value="{{$ooc->description_ooc}}">
                                    
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group Code">Initiator Group Code</label>
                                    <input type="text" name="initiator_group_code" id="initiator_group_code" value="{{$ooc->Initiator_Group}}" readonly>
                                </div>
                            </div>

                            <script>
                                document.getElementById('initiator_group').addEventListener('change', function() {
                                    var selectedValue = this.value;
                                    document.getElementById('initiator_group_code').value = selectedValue;
                                });
                            </script>

{{--
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="Initiator_Group" id="initiator_group">
                                        <option value="">-- Select --</option>
                                        <option value="CQA" @if(old('Initiator_Group') =="CQA") selected @endif>Corporate Quality Assurance</option>
                                        <option value="QAB" @if(old('Initiator_Group') =="QAB") selected @endif>Quality Assurance Biopharma</option>
                                        <option value="CQC" @if(old('Initiator_Group') =="CQA") selected @endif>Central Quality Control</option>
                                        <option value="CQC" @if(old('Initiator_Group') =="MANU") selected @endif>Manufacturing</option>
                                        <option value="PSG" @if(old('Initiator_Group') =="PSG") selected @endif>Plasma Sourcing Group</option>
                                        <option value="CS"  @if(old('Initiator_Group') == "CS") selected @endif>Central Stores</option>
                                        <option value="ITG" @if(old('Initiator_Group') =="ITG") selected @endif>Information Technology Group</option>
                                        <option value="MM"  @if(old('Initiator_Group') == "MM") selected @endif>Molecular Medicine</option>
                                        <option value="CL"  @if(old('Initiator_Group') == "CL") selected @endif>Central Laboratory</option>

                                        <option value="TT"  @if(old('Initiator_Group') == "TT") selected @endif>Tech team</option>
                                        <option value="QA"  @if(old('Initiator_Group') == "QA") selected @endif> Quality Assurance</option>
                                        <option value="QM"  @if(old('Initiator_Group') == "QM") selected @endif>Quality Management</option>
                                        <option value="IA"  @if(old('Initiator_Group') == "IA") selected @endif>IT Administration</option>
                                        <option value="ACC"  @if(old('Initiator_Group') == "ACC") selected @endif>Accounting</option>
                                        <option value="LOG"  @if(old('Initiator_Group') == "LOG") selected @endif>Logistics</option>
                                        <option value="SM"  @if(old('Initiator_Group') == "SM") selected @endif>Senior Management</option>
                                        <option value="BA"  @if(old('Initiator_Group') == "BA") selected @endif>Business Administration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="nitiator_group_code" value="" readonly>
                                    </div>
                                </div> --}}
                                    
                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="Recall" {{ $ooc->is_repeat_ooc == 'Recall' ? 'selected' : '' }}>Recall</option>
                                        
                                        
                                        <option value="Return"{{ $ooc->is_repeat_ooc == 'Return' ? 'selected' : '' }}>Return</option>
                                        
                                       
                                        <option  value="Deviation"{{ $ooc->is_repeat_ooc == 'Deviation' ? 'selected' : '' }}>Deviation</option>

                                        <option value="Complaint"{{ $ooc->is_repeat_ooc == 'Complaint' ? 'selected' : '' }}>Complaint</option>
                                        <option value="Regulatory"{{ $ooc->is_repeat_ooc == 'Regulatory' ? 'selected' : '' }}>Regulatory</option>
                                        
                                        <option value="Lab Incident"{{ $ooc->is_repeat_ooc == 'Lab Incident' ? 'selected' : '' }}>Lab Incident</option>

                                        <option value="Improvement"{{ $ooc->is_repeat_ooc == 'Improvement' ? 'selected' : '' }}>Improvement</option>
                                       
                                        <option value="Others"{{ $ooc->is_repeat_ooc == 'Others' ? 'selected' : '' }}>Others</option>

                                        
                                        
                                    </select>
                                </div>
                            </div> --}}


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" onchange="">
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
                                    <textarea class="summernote" name="initiated_if_other" id="summernote-1">{{$ooc->initiated_if_other}}</textarea>
                                </div>
                            </div>

                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Is Repeat"><b>Is Repeat</b></label>
                                    <select  id="initiator_group" name="is_repeat_ooc">
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
                                    <textarea class="summernote" name="Repeat_Nature" id="summernote-1">
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="initial_attachment_ooc" name="initial_attachment_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                            

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        OOC Logged by <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }}>
                                        {{-- <option value="">Select a value</option> --}}
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($ooc->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                           

                            {{-- <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> OOC Logged On </label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="ooc_due_date" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
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
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" {{ $ooc->stage == 0 || $ooc->stage == 8 ? 'disabled' : ''}}/>
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
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($ooc->ooc_due_date) }}" />
                                        <input type="date" id="ooc_due_date" name="ooc_due_date"
                                            class="hide-input"
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
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][instrument_name]" value="{{$oogrid['instrument_name']}}"></td>
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][instrument_id]" value="{{$oogrid['instrument_id']}}"></td>
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][remarks]" value="{{$oogrid['remarks']}}"></td>
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][calibration]" value="{{$oogrid['calibration']}}"></td>
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][acceptancecriteria]" value="{{$oogrid['acceptancecriteria']}}"></td>
                    <td><input type="text" name="instrumentdetails[{{$loop->index}}][results]" value="{{$oogrid['results']}}"></td>
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
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][instrument_name]" value=""></td>' +
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][instrument_id]" value=""></td>' +
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][remarks]" value=""></td>' +
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][calibration]" value=""></td>' +
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][acceptancecriteria]" value=""></td>' +
                '<td><input type="text" name="instrumentdetails[' + investdetails + '][results]" value=""></td>' +
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



                            <div class="sub-head"> Delay Justfication for Reporting</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Delay Justification for Reporting">Delay Justification for Reporting</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Delay_Justification_for_Reporting" id="summernote-1">
                                    {{$ooc->Delay_Justification_for_Reporting}}</textarea>
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
                </div>
                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">HOD/Supervisor Review</div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="HOD Remarks">HOD Remarks</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="HOD_Remarks" id="summernote-1">{{$ooc->HOD_Remarks}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachment">HOD Attachement</label>
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
                                                <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="attachments_hod_ooc" name="attachments_hod_ooc[]"
                                                    oninput="addMultipleFiles(this, 'attachments_hod_ooc')" multiple>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            
                            
                            
                           

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Immediate Action">Immediate Action</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1">{{$ooc->Immediate_Action_ooc}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Preliminary_Investigation_ooc" id="summernote-1">
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
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
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
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">


                        <div class="sub-head">OOC Evaluation Form</div>

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
                    <textarea name="oocevoluation[{{ $index }}][response]">{{ $oocEvolution->data[$index]['response'] }}</textarea>
                </td>
                <td>
                    <textarea name="oocevoluation[{{ $index }}][remarks]">{{ $oocEvolution->data[$index]['remarks'] }}</textarea>
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
                                <label for="qa_comments">Evaluation Remarks</label>
                                <textarea name="qa_comments_ooc">{{$ooc->qa_comments_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="qa_comments">Description of Cause for OOC Results (If Identified)</label>
                                <textarea name="qa_comments_description_ooc">{{$ooc->qa_comments_description_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable root cause found?</label>
                                <select  id="initiator_group" name="is_repeat_assingable_ooc">
                                    <option value="NA"{{ $ooc->is_repeat_assingable_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_assingable_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_assingable_ooc == 'No' ? 'selected' : '' }}>No</option>
                                    {{-- <option value="NA" {{ $ooc->is_repeat_ooc == 'NA' ? 'selected' : '' }}>NA</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-12 sub-head">
                            Hypothesis Study
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="protocol_based_study_hypthesis_study_ooc" id="summernote-1">
                                    {{$ooc->protocol_based_study_hypthesis_study_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="justification_for_protocol_study_hypothesis_study_ooc" id="summernote-1">{{$ooc->justification_for_protocol_study_hypothesis_study_ooc}}
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="plan_of_protocol_study_hypothesis_study" id="summernote-1">{{$ooc->plan_of_protocol_study_hypothesis_study}}
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="conclusion_of_protocol_based_study_hypothesis_study_ooc" id="summernote-1">
                                  {{$ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc}}  </textarea>
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
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="sub-head">Stage I</div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Analyst Remarks">Analyst Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1">{{$ooc->analysis_remarks_stage_ooc}}  </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Calibration Results">Calibration Results</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="calibration_results_stage_ooc" id="summernote-1">{{$ooc->calibration_results_stage_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Results Naturey</label>
                                <select name="is_repeat_result_naturey_ooc" onchange="">
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
                                <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" id="summernote-1">{{$ooc->review_of_calibration_results_of_analyst_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">Stage I Attachement</label>
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="attachments_stage_ooc" name="attachments_stage_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_stage_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        
                        



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Results Criteria">Results Criteria</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1">{{$ooc->results_criteria_stage_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Invalidated & Validated</label>
                                <select name="is_repeat_stae_ooc" onchange="">
                                    <option value="0" {{ $ooc->is_repeat_stae_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_stae_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_stae_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="additional_remarks_stage_ooc" id="summernote-1">{{$ooc->additional_remarks_stage_ooc}}</textarea>
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

            <div id="CCForm5" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Stage II
                    </div>
                    <div class="row">


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Rectification by Service Engineer required</label>
                                <select name="is_repeat_stageii_ooc" onchange="">
                                    <option value="NA" {{ $ooc->is_repeat_stageii_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Instrument is Out of Order</label>
                                <select name="is_repeat_stage_instrument_ooc" onchange="">
                                    <option value="NA" {{ $ooc->is_repeat_stage_instrument_ooc == 'NA' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_stage_instrument_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_stage_instrument_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Proposed By</label>
                                <select name="is_repeat_proposed_stage_ooc" onchange="">
                                    <option value="0" {{ $ooc->is_repeat_proposed_stage_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_proposed_stage_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_proposed_stage_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="initial_attachment_stageii_ooc" name="initial_attachment_stageii_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_stageii_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Compiled by:</label>
                                <select name="is_repeat_compiled_stageii_ooc" onchange="">
                                    <option value="0" {{ $ooc->is_repeat_compiled_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_compiled_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_compiled_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Release of Instrument for usage</label>
                                <select name="is_repeat_realease_stageii_ooc" onchange="">
                                    <option value="0" {{ $ooc->is_repeat_realease_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_realease_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_realease_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment at Stage II">Impact Assessment at Stage II</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_throug_stageii_ooc" id="summernote-1">{{$ooc->initiated_throug_stageii_ooc}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_stageii_ooc" id="summernote-1">{{$ooc->initiated_through_stageii_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Result of Reanalysis:</label>
                                <select name="is_repeat_reanalysis_stageii_ooc" onchange="">
                                    <option value="0" {{ $ooc->is_repeat_reanalysis_stageii_ooc == '0' ? 'selected' : '' }}>-- Select --</option>
                                    <option value="Yes" {{ $ooc->is_repeat_reanalysis_stageii_ooc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $ooc->is_repeat_reanalysis_stageii_ooc == 'No' ? 'selected' : '' }}>No</option>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Cause for failure">Cause for failure</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_stageii_cause_failure_ooc" id="summernote-1">{{$ooc->initiated_through_stageii_cause_failure_ooc}}</textarea>
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
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CAPA Type?</label>
                                <select name="is_repeat_capas_ooc" onchange="">
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
                                <textarea class="summernote" name="initiated_through_capas_ooc" id="summernote-1">{{$ooc->initiated_through_capas_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_capa_prevent_ooc" id="summernote-1">{{$ooc->initiated_through_capa_prevent_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_capa_corrective_ooc" id="summernote-1">{{$ooc->initiated_through_capa_corrective_ooc}}</textarea>
                            </div>
                        </div>



                        <div class="col-lg-12">
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="initial_attachment_capa_ooc" name="initial_attachment_capa_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_capa_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        
                        
                        

                        <div class="sub-head">
                            Post Implementation of CAPA
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="CAPA Post Implementation Comments">CAPA Post Implementation Comments</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_capa_ooc" id="summernote-1">{{$ooc->initiated_through_capa_ooc}}</textarea>
                            </div>
                        </div>


                        
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">CAPA Post Implementation Attachement</label>
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "disabled" : "" }} type="file" id="initial_attachment_capa_post_ooc" name="initial_attachment_capa_post_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_capa_post_ooc')" multiple>
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

            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Closure Comments
                                    <input id="docname" type="text" name="short_description_closure_ooc" value="{{$ooc->short_description_closure_ooc}}">
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
                                            <input type="file" id="initial_attachment_closure_ooc" name="initial_attachment_closure_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_closure_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Document Code
                                    <input id="docname" type="text" name="document_code_closure_ooc" value="{{$ooc->document_code_closure_ooc}}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Remarks
                                    <input id="docname" type="text" name="remarks_closure_ooc" value="{{$ooc->remarks_closure_ooc}}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Immediate Corrective Action">Immediate Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_closure_ooc" id="summernote-1">{{$ooc->initiated_through_closure_ooc}}</textarea>
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
            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        HOD Review
                    </div>
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="HOD Remarks">HOD Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_hodreview_ooc" id="summernote-1">{{$ooc->initiated_through_hodreview_ooc}}</textarea>
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachment">HOD Attachement</label>
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
                                            <input {{ $ooc->stage == 0 || $ooc->stage == 8 ? "  " : "" }} type="file" id="initial_attachment_hodreview_ooc" name="initial_attachment_hodreview_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_hodreview_ooc')" multiple>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Root Cause Analysis">Root Cause Analysis</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_rootcause_ooc" id="summernote-1">{{$ooc->initiated_through_rootcause_ooc}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment">Impact Assessment</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_impact_closure_ooc" id="summernote-1">{{$ooc->initiated_through_impact_closure_ooc}}</textarea>
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
            <div id="CCForm9" class="inner-block cctabcontent">
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

                        <div class="sub-head col-lg-12">Initial Phase I Investigation</div>

                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">initial_phase_i_investigation_completed_by : </label>
                                <div class="static">{{$ooc->initial_phase_i_investigation_completed_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">

                            <div class="group-input input-date">
                                <label for="OOC Logged On">initial_phase_i_investigation_completed_on</label>
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
                            QA Intial Review
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">

                                <label for="Initiator Group">Assignable Cause Found Completed By :</label>
                                <div class="static">{{$ooc->assignable_cause_f_completed_by}}</div>

                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Found Completed On : </label>
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
                            Correction Completed
                        </div>
                        <div class="col-lg-4">

                            <div class="group-input">
                                <label for="Initiator Group">Correction Completed By : </label>
                                <div class="static">{{$ooc->correction_completed_by}}</div>


                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Correction Completed On : </label>
                                <div class="static">{{$ooc->correction_completed_on}}</div>




                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qa_final_review_comment">Comment : </label>
                                <div class="static">{{$ooc->correction_completed_comment}}</div>

                            </div>
                        </div>
                        <div class="sub-head col-lg-12">
                            Obvious Results Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Obvious Results Not Found Done By : </label>
                                <div class="static">{{$ooc->obvious_r_n_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Obvious Results Not Found  On : </label>
                                <div class="static">{{$ooc->obvious_r_n_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->cause_i_ncompleted_comment}}</div>

                            </div>
                        </div>
                        
                        <div class="sub-head col-lg-12">
                            Correction Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Correction Complete By : </label>
                                <div class="static">{{$ooc->correction_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Correction Complete On : </label>
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
                            Cause Identification
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Cause Identification Done By : </label>
                                <div class="static">{{$ooc->cause_i_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Cause Identification Done  On : </label>
                                <div class="static">{{$ooc->cause_i_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->cause_i_ncompleted_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                            Correction Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Correction Completed By : </label>
                                <div class="static">{{$ooc->correction_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Correction Completed  On : </label>
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
                            Assignable Cause Not Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable Cause Not Found Complete By : </label>
                                <div class="static">{{$ooc->assignable_cause_f_n_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Assignable Cause Not Found Complete On : </label>
                                <div class="static">{{$ooc->assignable_cause_f_n_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->assignable_cause_f__ncompleted_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                            Cause Failed
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Cause Failed By : </label>
                                <div class="static">{{$ooc->cause_f_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Cause Failed On : </label>
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
                            Obvious Results Found
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Obvious Results Found By : </label>
                                <div class="static">{{$ooc->obvious_r_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Obvious Results Found  On : </label>
                                <div class="static">{{$ooc->obvious_r_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->obvious_r_ncompleted_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                            Cause Not Identified
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Cause Not Identified By : </label>
                                <div class="static">{{$ooc->cause_n_i_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Cause Not Identified  On : </label>
                                <div class="static">{{$ooc->cause_n_i_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->cause_n_i_completed_comment}}</div>

                            </div>
                        </div>


                        <div class="sub-head col-lg-12">
                            QA Review Complete
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">QA Review Complete By : </label>
                                <div class="static">{{$ooc->qareview_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">QA Review Complete  On : </label>
                                <div class="static">{{$ooc->qareview_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->qareview_ooc_comment}}</div>

                            </div>
                        </div>











                        <div class="sub-head col-lg-12">
                            Approved
                        </div>
                      <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Approved By : </label>
                                <div class="static">{{$ooc->approved_ooc_completed_by}}</div>


                            </div>
                        </div>


                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Approved  On : </label>
                                <div class="static">{{$ooc->approved_ooc_completed_on}}</div>





                            </div>
                        </div>
                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="closure_ooc_comment">Comment : </label>
                                <div class="static">{{$ooc->approved_ooc_comment}}</div>

                            </div>
                        </div>







                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
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
@endsection
