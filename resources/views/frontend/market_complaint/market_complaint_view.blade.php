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

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            / Market Complaint
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#Monitor_Information').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(9) {
            border-radius: 0px 20px 20px 0px;

        }
    </style>
    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">


            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}



                            @php
                            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                            // dd($userRoles);
                            
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            @endphp
                                <button class="button_theme1"> <a class="text-white"
                                    href="{{ route('marketcomplaint.MarketComplaintAuditReport', $data->id) }}"> Audit Trail </a> </button> 
                            @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                          
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>


                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button> --}}
                           

                            @elseif($data->stage == 2 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                           
                          

                            @elseif($data->stage == 3 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Investigation Completed
                            </button>
                            <div class="btn-group">
                                <button type="button" class="button_theme1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Additional Selections
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal1">Selection 1</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal2">Selection 2</a>
                                    </li>
                                    <!-- Add more selections as needed -->
                                </ul>
                            </div>
                           

                            @elseif($data->stage == 4 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Propose Plan
                            </button>
                           

                            <div class="btn-group">
                                <button type="button" class="button_theme1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Additional Selections
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal1">Selection 1</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal2">Selection 2</a>
                                    </li>
                                    <!-- Add more selections as needed -->
                                </ul>
                            </div>
                           
                            @elseif($data->stage == 5 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve Plan
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                            @elseif($data->stage == 6 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All CAPA Closed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#">
                                Regulatory
                                Reporting child
                                
                            </button>
                           
                            @elseif($data->stage == 7 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send Letter
                            </button>

                            <div class="btn-group">
                                <button type="button" class="button_theme1" data-bs-toggle="dropdown" aria-expanded="false">
                                   child
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal1">Regulatory Reporting
                                            </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#selection-modal2">Effectiveness Check</a>
                                    </li>
                                    <!-- Add more selections as needed -->
                                </ul>
                            </div>
                           
                            @endif
                            <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>
                           
                    {{-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                        </a> </button> --}}



                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Verification Complete
                            </button> --}}


                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancellation Request
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button> --}}
                           


                        {{-- <button class="button_theme1"> <a class="text-white" href=""> --}}
                                {{-- {{ url('DeviationAuditTrial', $data->id) }} --}}

                                {{-- add here url for auditTrail i.e. href="{{ url('CapaAuditTrial', $data->id) }}"
                                Audit Trail </a> </button> --}}

                        {{--    @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button> --}}
                        {{-- @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button> --}}


{{-- 
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            HOD Review Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button> --}}



                       
                       
                        {{-- @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA Initial Review Complete
                        </button>

                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                            Child
                        </button> --}}
                        {{-- @elseif(
                            $data->stage == 4 &&
                                (in_array(5, $userRoleIds) || in_array(18, $userRoleIds) || in_array(Auth::user()->id, $valuesArray)))
                            @if (!$cftCompleteUser) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button> --}}

                        {{-- @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                            Send to Initiator
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                            Send to HOD
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                            Send to QA Initial Review
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA Final Review Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                            Child
                        </button> --}}
                        {{-- @elseif($data->stage == 6 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Approved
                        </button> --}}
                        {{-- @elseif($data->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                            Send to Opened
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                            Send to HOD Review
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                            Send to QA Initial Review
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Initiator Updated Complete
                        </button> --}}
                        {{-- @elseif($data->stage == 8 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                            Send to Opened
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                            Send to HOD Review
                        </button> --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                            Send to QA Initial Review
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#pending-initiator-update">
                            Send to Pending Initiator Update
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA Final Review Complete
                        </button> --}}
                        {{-- @endif --}}
                        {{-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button> --}}


                    </div>

                </div>


                <!--------------------------Modal-------------------->



                <div class="modal fade" id="rejection-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">E-Signature</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('marketcomplaint.mar_comp_reject_stateChange', $data->id) }}" method="POST">
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
            
            
               
            
            
                <div class="modal fade" id="signature-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">E-Signature</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('marketcomplaint.mar_comp_stagechange', $data->id) }}" method="POST">
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
            
            
            
            
                <div class="modal fade" id="cancel-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">E-Signature</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
            
                            <form action="{{ route('marketcomplaint.MarketComplaintCancel', $data->id) }}" method="POST">
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
                            {{-- <form action="{{ route('lab_incident_root_child', $data->id) }}" method="POST">
                                @csrf
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="group-input">
                                        <label for="major">
                                            <input type="radio" name="revision" id="major" value="Action-Item">
                                            Root Cause Analysis
                                        </label>
                                    </div>
            
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
             --}}
                        </div>
                    </div>
                </div>




                <div class="modal fade" id="child-modal1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
            
                            <!-- Modal Header -->
                            {{-- <div class="modal-header">
                                <h4 class="modal-title">Child</h4>
                            </div> --}}
                            {{-- <form action="{{ route('lab_incident_capa_child', $data->id) }}" method="POST">
                                @csrf
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="group-input">
                                        <label for="major">
                                            <input type="radio" name="revision" id="major" value="Action-Item">
                                            CAPA
                                        </label>
                                    </div>
            
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
                            </form> --}}
            
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
                    // JavaScript
                    document.getElementById('initiator_group').addEventListener('change', function() {
                        var selectedValue = this.value;
                        document.getElementById('initiator_group_code_gi').value = selectedValue;
                    });
                </script>
                 <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const removeButtons = document.querySelectorAll('.remove-file');
            
                            removeButtons.forEach(button => {
                                button.addEventListener('click', function () {
                                    const fileName = this.getAttribute('data-file-name');
                                    const fileContainer = this.closest('.file-container');
            
                                    // Hide the file container
                                    if (fileContainer) {
                                        fileContainer.style.display = 'none';
                                    }
                                });
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
                    var maxLength = 240;
                    $('#duedoc').keyup(function() {
                        var textlen = maxLength - $(this).val().length;
                        $('#rchar').text(textlen);});
                </script>









                <!-------------------------- end Modal-------------------->

 
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                    <div class="progress-bars ">
                        <div class="bg-danger">Closed-Cancelled</div>
                    </div>
                    @else
                    <div class="progress-bars d-flex" style="font-size: 15px;">
                        @if ($data->stage >= 1)
                        <div class="active">Opened</div>
                        @else
                        <div class="">Opened</div>
                        @endif

                        @if ($data->stage >= 2)
                        <div class="active">Supervisor Review </div>
                        @else
                        <div class="">Supervisor Review</div>
                        @endif

                        @if ($data->stage >= 3)
                        <div class="active">Investigation and Root Cause Analysis</div>
                        @else
                        <div class="">Investigation and Root Cause
                            Analysis</div>
                        @endif

                        @if ($data->stage >= 4)
                        <div class="active">CAPA Plan</div>
                        @else
                        <div class="">CAPA Plan</div>
                        @endif


                        @if ($data->stage >= 5)
                        <div class="active">Pending Approval</div>
                        @else
                        <div class="">Pending Approval</div>
                        @endif
                        @if ($data->stage >= 6)
                        <div class="active">Pending Actions Completion</div>
                        @else
                        <div class="">Pending Actions Completion</div>
                        @endif
                        @if ($data->stage >= 7)
                        <div class="active">Pending Response Letter</div>
                        @else
                        <div class="">Pending Response Letter</div>
                        @endif
                        @if ($data->stage >= 8)
                        <div class="bg-danger">Closed - Done</div>
                        @else
                        <div class="">Closed - Done</div>
                        @endif
                        {{-- @if ($data->stage >= 9)
                        <div class="bg-danger">Closed - Done</div>
                        @else
                        <div class="">Closed - Done</div>
                        @endif --}}
                        @endif


                    </div>
                    {{-- @endif --}}
                    {{-- ---------------------------------------------------------------------------------------- --}}
                </div>
            </div>


            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD/Supervisor Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Complaint Acknowledgement</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>

            </div>

            <form action="{{ route('marketcomplaint.marketcomplaintupdate',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            @method('put')
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

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number" value="{{ $data->record_number }}">

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Division Code </b></label>
                                        <input disabled type="text" name="division_code" value="{{ $data->division_id }}">
                                        <input type="hidden" name="division_id" value="{{ $data->division_id }}">

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <p class="text-primary"> last date this record should be closed by</p>

                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date_gi"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->due_date_gi ?? '' }}"
                                                class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Short Description">Initiator Group <span class="text-danger"></span></label>
                                            <select name="initiator_group">
                                                <option selected disabled>---select---</option>
                                                @foreach (Helpers::getInitiatorGroups() as $code => $initiator_group)
                                                    <option value="{{ $code }}" @if ($data->initiator_group == $code) selected @endif>{{ $initiator_group }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code_gi" id="initiator_group_code_gi"
                                           readonly value="{{ $data->initiator_group_code_gi ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through_gi" id="initiated_through_gi" >
                                            <option value="0">-- select --</option>
                                            <option value="recall" {{ $data->initiated_through_gi == 'recall' ? 'selected' : '' }}>Recall</option>
                                            <option value="return" {{ $data->initiated_through_gi == 'return' ? 'selected' : '' }}>Return</option>
                                            <option value="deviation" {{ $data->initiated_through_gi == 'deviation' ? 'selected' : '' }}>Deviation</option>
                                            <option value="complaint" {{ $data->initiated_through_gi == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                            <option value="regulatory" {{ $data->initiated_through_gi == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                            <option value="lab-incident" {{ $data->initiated_through_gi == 'lab-incident' ? 'selected' : '' }}>Lab Incident</option>
                                            <option value="improvement" {{ $data->initiated_through_gi == 'improvement' ? 'selected' : '' }}>Improvement</option>
                                            <option value="others" {{ $data->initiated_through_gi == 'others' ? 'selected' : '' }}>Others</option>
                                        </select>                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="If Other">If Other</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="if_other_gi" id="summernote-1">{{ $data->if_other_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="is_repeat_gi">Is Repeat</label>
                                        <select name="is_repeat_gi">
                                            <option value="" {{ $data->is_repeat_gi == '0' ? 'selected' : '' }}>-- select --</option>
                                            <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $data->is_repeat_gi == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Repeat Nature">Repeat Nature</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="repeat_nature_gi" id="summernote-1">{{ $data->repeat_nature_gi }}

                                    </textarea>
                                    </div>
                                </div>



                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description">Description</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="description_gi" id="summernote-1">{{ $data->description_gi }}
                                    </textarea>
                                    </div>
                                </div>


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">Initial Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="initial_attachment_gi">


                                                    @if ($data->initial_attachment_gi)
                                                    @foreach (json_decode($data->initial_attachment_gi) as $file)
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
                                                    <input type="file" id="initial_attachment_gi" name="initial_attachment_gi[]" oninput="addMultipleFiles(this,'initial_attachment_gi')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Complainant</label>
                                        <select name="complainant_gi" onchange="">
                                            <option value=""{{ $data->complainant_gi  == 'o' ? 'selected' : '' }}>-- select --</option>
                                            <option value="person"{{ $data->complainant_gi  == 'person' ? 'selected' : '' }}>person</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="OOC Logged On"> Complaint Reported On </label>

                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  readonly placeholder="DD-MM-YYYY" name="complaint_reported_on_gi" value="{{ $data->complaint_reported_on_gi }}" />
                                            {{-- <input type="date" name="complaint_reported_on_gi"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                                                oninput=""  /> --}}
                                        </div>


                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Details Of Nature Market Complaint">Details Of Nature Market
                                            Complaint</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="details_of_nature_market_complaint_gi" id="summernote-1">{{ $data->details_of_nature_market_complaint_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Product Details   
                                            <button type="button" id="product_details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="product_details_details" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Product Name</th>
                                                        <th>Batch No.</th>
                                                        <th>Mfg. Date</th>
                                                        <th>Exp. Date</th>
                                                        <th>Batch Size</th>
                                                        <th>Pack Size</th>
                                                        <th>Dispatch Quantity</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($productsgi))
                                                    @foreach ($productsgi->data as  $detail)
                                                    <tr>
                                                        <td><input disabled type="text" name="serial_number_gi[]" value=""></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_product_name]" value="{{ $detail['info_product_name'] }}"></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_batch_no]" value="{{ $detail['info_batch_no'] }}"></td>
                                                        <td><input type="date" name="serial_number_gi[0][info_mfg_date]" value="{{ $detail['info_mfg_date'] }}"></td>
                                                        <td><input type="date" name="serial_number_gi[0][info_expiry_date]" value="{{ $detail['info_expiry_date'] }}"></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_batch_size]" value="{{ $detail['info_batch_size'] }}"></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_pack_size]" value="{{ $detail['info_pack_size'] }}"></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_dispatch_quantity]" value="{{ $detail['info_dispatch_quantity'] }}"></td>
                                                        <td><input type="text" name="serial_number_gi[0][info_remarks]" value="{{ $detail['info_remarks'] }}"></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="9">No product details found</td></tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                $(document).ready(function() {
                                    $('#product_details').click(function(e) {
                                        e.preventDefault();
                                        var serialNumber = $('#product_details_details tbody tr').length;
                                        var newRow = generateTableRow(serialNumber);
                                        $('#product_details_details tbody').append(newRow);
                                    });
                                
                                    function generateTableRow(serialNumber) {
                                        var html = '<tr>' +
                                            '<td>' + (serialNumber + 1) + '</td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_product_name]" value=""></td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_batch_no]" value=""></td>' +
                                            '<td><input type="date" name="serial_number_gi[' + serialNumber + '][info_mfg_date]" value=""></td>' +
                                            '<td><input type="date" name="serial_number_gi[' + serialNumber + '][info_expiry_date]" value=""></td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_batch_size]" value=""></td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_pack_size]" value=""></td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_dispatch_quantity]" value=""></td>' +
                                            '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_remarks]" value=""></td>' +
                                            '</tr>';
                                        return html;
                                    }
                                });
                                </script>
                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Traceability
                                            <button type="button" onclick="add4Input('traceblity')">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Product Name</th>
                                                        <th>Batch No.</th>
                                                        <th>Manufacturing Location</th>

                                                        <th>Remarks</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($traceability_gi))
                                                    @foreach ($traceability_gi->data as $tracebil )
                                                        
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1">
                                                    </td>
                                                    <td><input type="text" name="trace_ability[0][product_name_tr]" value="{{ $tracebil['product_name_tr'] }}"></td>
                                                    <td><input type="text" name="trace_ability[0][batch_no_tr]" value="{{ $tracebil['batch_no_tr'] }}"></td>
                                                    <td><input type="text" name="trace_ability[0][manufacturing_location_tr]" value="{{ $tracebil['manufacturing_location_tr'] }}"></td>
                                                    <td><input type="text" name="trace_ability[0][remarks_tr]" value="{{ $tracebil['remarks_tr'] }}"></td>



                                                    @endforeach
                                                    @else
                                                    <tr><td colspan="9">No  found</td></tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Categorization of complaint</label>
                                        <select name="categorization_of_complaint_gi" onchange="">
                                            <option value="">-- select --</option>
                                            <option value="Critical"{{ $data->categorization_of_complaint_gi  == 'Critical' ? 'selected' : '' }}>Critical</option>
                                            <option value="Major" {{ $data->categorization_of_complaint_gi  == 'Major' ? 'selected' : '' }} >Major</option>
                                            <option value="Minor"{{ $data->categorization_of_complaint_gi  == 'Major' ? 'selected' : ''  }}>Minor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Complaint Sample">Review of Complaint Sample</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_complaint_sample_gi" id="summernote-1">{{ $data->review_of_complaint_sample_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Control Sample">Review of Control Sample</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_control_sample_gi" id="summernote-1">{{ $data->review_of_control_sample_gi }}
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Investingation Team
                                            <button type="button" onclick="add4Input('Investing_team')">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="Investing_team" style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Name</th>
                                                        <th>Department</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @if (!@empty($investing_team))
                                                       @foreach ($investing_team->data as $inves )
                                                       
                                                       <td><input disabled type="text" name="serial_number_gi[0]"
                                                        value="1">
                                                </td>
                                                <td><input type="text" name="Investing_team[0][name_inv_tem]" value="{{ $inves['name_inv_tem'] }}"></td>
                                                <td><input type="text" name="Investing_team[0][department_inv_tem]" value="{{ $inves['department_inv_tem'] }}"></td>
                                                <td><input type="text" name="Investing_team[0][remarks_inv_tem]" value="{{ $inves['remarks_inv_tem'] }}"></td>


                                                       @endforeach
                                
                                                       
                                                   @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Batch manufacturing record (BMR)">Review
                                            of Batch manufacturing
                                            record (BMR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_batch_manufacturing_record_BMR_gi" id="summernote-1">{{ $data->review_of_batch_manufacturing_record_BMR_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label
                                            for="Review of Raw materials used in batch
                                        manufacturing">Review
                                            of Raw materials used in batch
                                            manufacturing</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_raw_materials_used_in_batch_manufacturing_gi" id="summernote-1">{{ $data->review_of_raw_materials_used_in_batch_manufacturing_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Batch Packing record (BPR)">Review of Batch Packing record
                                            (BPR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_Batch_Packing_record_bpr_gi" id="summernote-1">{{ $data->review_of_Batch_Packing_record_bpr_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of packing materials used in batch packing">Review of packing
                                            materials used in batch
                                            packing</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_packing_materials_used_in_batch_packing_gi" id="summernote-1">{{ $data->review_of_packing_materials_used_in_batch_packing_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Analytical Data">Review of Analytical Data</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_analytical_data_gi" id="summernote-1">{{ $data->review_of_analytical_data_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of training record of Concern Persons">Review of training record
                                            of Concern Persons</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_training_record_of_concern_persons_gi" id="summernote-1">{{ $data->review_of_training_record_of_concern_persons_gi}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Equipment/Instrument qualification/Calibration record">Review
                                            of Equipment/Instrument qualification/Calibration record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="rev_eq_inst_qual_calib_record_gi" id="summernote-1">{{ $data->rev_eq_inst_qual_calib_record_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Equipment Break-down and Maintainance Record">Review of
                                            Equipment Break-down and Maintainance Record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_equipment_break_down_and_maintainance_record_gi" id="summernote-1">{{ $data->review_of_equipment_break_down_and_maintainance_record_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Past history of product">Review of Past history of
                                            product</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_past_history_of_product_gi" id="summernote-1">{{ $data->review_of_past_history_of_product_gi }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Brain stroming Session/Discussion with Concered Person
                                            <button type="button" id="brain-stroming">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="brain-stroming-details"
                                                style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Possiblity</th>
                                                        <th>Facts/Controls</th>
                                                        <th>Probable Cause</th>
                                                        <th>Remarks</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($brain_stroming_session))
                                                    @foreach ($brain_stroming_session->data as  $bra_st_s)
                                                    <tr>
                                                        <td><input disabled type="text" name="serial_number[0]"
                                                            value="1">
                                                    </td>
                                                    <td><input type="text" name="brain_stroming_details[0][possiblity_bssd]" value="{{ $bra_st_s['possiblity_bssd'] }}"></td>
                                                    <td><input type="text" name="brain_stroming_details[0][factscontrols_bssd]" value="{{ $bra_st_s['factscontrols_bssd']}}"></td>
                                                    <td><input type="text" name="brain_stroming_details[0][probable_cause_bssd]" value="{{$bra_st_s['probable_cause_bssd'] }}"></td>
                                                    <td><input type="text" name="brain_stroming_details[0][remarks_bssd]" value="{{ $bra_st_s['remarks_bssd'] }}"></td>


                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="9">No product details found</td></tr>
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                                <script>
                                    $(document).ready(function() {
                                        $('#brain-stroming').click(function(e) {
                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                    '"></td>' +
                                                    '<td><input type="text" name="Possiblity[]"></td>' +
                                                    '<td><input type="text" name="Facts/Controls[]" value="Facts Available"></td>' +
                                                    '<td><input type="text" name="Probable_Cause[]"></td>' +
                                                    '<td><input type="text" name="Remarks[]"></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#brain-stroming-details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>


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
                                        <label for="Conclusion">Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="conclusion_hodsr" id="summernote-1">{{ $data->conclusion_hodsr }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root Cause Analysis">Root Cause Analysis</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="root_cause_analysis_hodsr" id="summernote-1">{{ $data->root_cause_analysis_hodsr}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label
                                            for="The most probable root causes identified of the complaint are as below">The
                                            most probable root causes identified of the complaint are as below</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="probable_root_causes_complaint_hodsr" id="summernote-1">{{ $data->probable_root_causes_complaint_hodsr}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment :</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="impact_assessment_hodsr" id="summernote-1">{{ $data->impact_assessment_hodsr}}
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective Action :</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="corrective_action_hodsr" id="summernote-1">{{ $data->corrective_action_hodsr}}
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action :</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="preventive_action_hodsr" id="summernote-1">{{ $data->preventive_action_hodsr}}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Summary and Conclusion">Summary and Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="summary_and_conclusion_hodsr" id="summernote-1">{{ $data->summary_and_conclusion_hodsr}}
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Team Members
                                            <button type="button" id="team_members">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="team_members_details"
                                                style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Names</th>
                                                        <th>Department</th>
                                                        <th>Sign</th>
                                                        <th>Date</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @if (!empty($team_members))
                                                       @foreach ($team_members->data as $tem_meb  )
                                                       <td><input disabled type="text" name="serial_number[0]" value="1">
                                                </td>
                                                <td><input type="text" name="Team_Members[0][names_tm]" value="{{ $tem_meb['names_tm'] }}"></td>
                                                <td><input type="text" name="Team_Members[0][department_tm]" value="{{$tem_meb['department_tm'] }}"></td>
                                                <td><input type="text" name="Team_Members[0][sign_tm]" value="{{ $tem_meb['sign_tm'] }}"></td>
                                                <td><input type="date" name="Team_Members[0][date_tm]" value="{{ $tem_meb['date_tm'] }}"></td>
                                                       @endforeach
                                                       @else 
                                                       <tr><td colspan="9">No product details found</td></tr>
                                                   @endif


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#team_members').click(function(e) {
                                            function generateTableRow(serialNumber) {

                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                    '"></td>' +
                                                    '<td><input type="text" name="Names[]"></td>' +
                                                    '<td><input type="text" name="Department[]"></td>' +
                                                    '<td><input type="text" name="Sign[]"></td>' +
                                                    '<td><input type="date" name="Date[]"></td>' +
                                                    '</tr>';

                                                return html;
                                            }

                                            var tableBody = $('#team_members_details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Report Approval
                                            <button type="button" id="report_approval">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="report_approval_details"
                                                style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Names</th>
                                                        <th>Department</th>
                                                        <th>Sign</th>
                                                        <th>Date</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @if (!empty($report_approval))
                                                       @foreach ($report_approval->data as $rep_ap )
                                                       <td><input disabled type="text" name="serial_number[0]" value="1"></td>
                                                <td><input type="text" name="Report_Approval[0][names_rrv]" value="{{ $rep_ap['names_rrv'] }}"></td>
                                                <td><input type="text" name="Report_Approval[0][department_rrv]" value="{{ $rep_ap['department_rrv'] }}"></td>
                                                <td><input type="text" name="Report_Approval[0][sign_rrv]" value="{{ $rep_ap['sign_rrv'] }}"></td>
                                                <td><input type="date" name="Report_Approval[0][date_rrv]" value="{{ $rep_ap['date_rrv'] }}"></td>

                                                       @endforeach
                                                   @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#report_approval').click(function(e) {
                                            function generateTableRow(serialNumber) {

                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                    '"></td>' +
                                                    '<td><input type="text" name="Names[]"></td>' +
                                                    '<td><input type="text" name="Department[]"></td>' +
                                                    '<td><input type="text" name="Sign[]"></td>' +
                                                    '<td><input type="date" name="Date[]"></td>' +
                                                    '</tr>';

                                                return html;
                                            }

                                            var tableBody = $('#report_approval_details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Initial Attachment</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_hodsr">

                                                @if ($data->initial_attachment_hodsr)
                                                @foreach (json_decode($data->initial_attachment_hodsr) as $file)
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
                                                <input type="file" id="initial_attachment_hodsr" name="initial_attachment_hodsr[]" oninput="aadMultipuleFiles(this,'initial_attachment_hodsr')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Comments">Comments(if Any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="comments_if_any_hodsr" id="summernote-1">{{ $data->comments_if_any_hodsr}}
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
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">


                            <div class="sub-head">Acknowledgement</div>



                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Manufacturer name & Address">Manufacturer name & Address</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" name="manufacturer_name_address_ca" id="summernote-1">{{ $data->manufacturer_name_address_ca}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Product/Material Details
                                        <button type="button" id="product_material">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-details-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="product_material_details"
                                            style="width: %;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Row #</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No.</th>
                                                    <th>Mfg. Date</th>
                                                    <th>Exp. Date</th>
                                                    <th>Batch Size</th>
                                                    <th>Pack Profile</th>
                                                    <th>Released Quantity</th>
                                                    <th>Remarks</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                               @if(is_array($product_materialDetails) && !empty($product_materialDetails))
                                                   @foreach ($product_materialDetails as $prod_ca)
                                                   <td><input disabled type="text" name="Product_MaterialDetails[0]" value="1">
                                                   </td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][product_name_pmd]" value="{{ $prod_ca['product_name_pmd'] }}"></td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][batch_no_pmd]" value="{{ $prod_ca['batch_no_pmd'] }}"></td>
                                                   <td><input type="date" name="Product_MaterialDetails[0][mfg_date_pmd]" value="{{ $prod_ca['mfg_date_pmd'] }}"></td>
                                                   <td><input type="date" name="Product_MaterialDetails[0][expiry_date_pmd]" value="{{ $prod_ca['expiry_date_pmd'] }}"></td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][batch_size_pmd]" value="{{ $prod_ca['batch_size_pmd'] }}"></td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][pack_profile_pmd]" value="{{ $prod_ca['pack_profile_pmd'] }}"></td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][released_quantity_pmd]" value="{{ $prod_ca['released_quantity_pmd'] }}"></td>
                                                   <td><input type="text" name="Product_MaterialDetails[0][remarks_pmd]" value="{{ $prod_ca['remarks_pmd'] }}"></td>
   
                                                   @endforeach
                                               @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#product_material').click(function(e) {
                                        function generateTableRow(serialNumber) {

                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                '"></td>' +
                                                '<td><input type="text" name="Product_Name[]"></td>' +
                                                '<td><input type="text" name="Batch_No[]"></td>' +
                                                '<td><input type="date" name="Mfg_Date[]"></td>' +
                                                '<td><input type="date" name="Exp_Date[]"></td>' +
                                                '<td><input type="text" name="Batch_Size[]"></td>' +
                                                '<td><input type="text" name="pack_profile[]"></td>' +
                                                '<td><input type="text" name="released_quantity[]"></td>' +
                                                '<td><input type="text" name="remarks[]"></td>' +


                                                '</tr>';

                                            return html;
                                        }

                                        var tableBody = $('#product_material_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateTableRow(rowCount + 1);
                                        tableBody.append(newRow);
                                    });
                                });
                            </script>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Complaint Sample Required">Complaint Sample Required</label>
                                    <select name="complaint_sample_required_ca" onchange="">
                                        <option value="">-- select --</option>
                                        <option value="yes" {{ $data->complaint_sample_required_ca == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $data->complaint_sample_required_ca == 'no' ? 'selected' : '' }}>No</option>
                                        <option value="na" {{ $data->complaint_sample_required_ca == 'na' ? 'selected' : '' }}>NA</option>
        
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Complaint Sample Status">Complaint Sample Status</label>
                                    <input type="text" name="complaint_sample_status_ca" id="date_of_initiation" value="{{ $data->complaint_sample_status_ca}}">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Brief Description of complaint">Brief Description of complaint:</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="brief_description_of_complaint_ca" id="summernote-1">{{ $data->brief_description_of_complaint_ca }}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Batch Record review observation">Batch Record review
                                        observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="batch_record_review_observation_ca" id="summernote-1">{{ $data->batch_record_review_observation_ca }}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Analytical Data review observation">Analytical Data review
                                        observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="analytical_data_review_observation_ca" id="summernote-1">{{ $data->analytical_data_review_observation_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Retention sample review observation">Retention sample review
                                        observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="retention_sample_review_observation_ca" id="summernote-1">{{ $data->retention_sample_review_observation_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Stablity study data review">Stablity study data review</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="stability_study_data_review_ca" id="summernote-1">{{ $data->stability_study_data_review_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="QMS Events(if any) review Observation">QMS Events(if any) review
                                        Observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="qms_events_ifany_review_observation_ca" id="summernote-1">{{ $data->qms_events_ifany_review_observation_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeated complaints/queries for product">Repeated complaints/queries
                                        for product:</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="repeated_complaints_queries_for_product_ca" id="summernote-1">{{ $data->repeated_complaints_queries_for_product_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Interpretation on compalint sample">Interpretation on compalint
                                        sample(if recieved)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="interpretation_on_complaint_sample_ifrecieved_ca" id="summernote-1">{{ $data->interpretation_on_complaint_sample_ifrecieved_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Comments">Comments(if Any)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="comments_ifany_ca" id="summernote-1">{{ $data->comments_ifany_ca}}
                                </textarea>
                                </div>
                            </div>
                            <div class="sub-head">
                                Proposal to accomplish investigation:
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr. No.</th>
                                                    <th style="width: 40%;">Requirements</th>
                                                    <th style="width: 20%;">Expected date of investigation completion</th>
                                                    <th>Remarks</th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="flex text-center">1</td>
                                                    <td>Complaint sample Required</td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr1" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Complaint sample Required']['csr1'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr2" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Complaint sample Required']['csr2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">2</td>
                                                    <td>Additional info. From Complainant</td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="afc1" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Additional info. From Complainant']['afc1'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="afc2" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Additional info. From Complainant']['afc2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">3</td>
                                                    <td>Analysis of complaint Sample</td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="acs1" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Analysis of complaint Sample']['acs1'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="acs2" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Analysis of complaint Sample']['acs2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">4</td>
                                                    <td>QRM Approach</td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="qrm1" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['QRM Approach']['qrm1'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="qrm2" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['QRM Approach']['qrm2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">5</td>
                                                    <td>Others</td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="oth1" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Others']['oth1'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="oth2" style="border-radius: 7px; border: 1.5px solid black;">{{ $proposalData['Others']['oth2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">Initial Attachment</label>
                                <div>
                                    <small class="text-primary">
                                        Please Attach all relevant or supporting documents
                                    </small>
                                </div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="initial_attachment_ca">

                                        @if ($data->initial_attachment_ca)
                                        @foreach (json_decode($data->initial_attachment_ca) as $file)
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
                                        <input type="file" id="initial_attachment_ca" name="initial_attachment_ca[]" oninput="addMultipleFiles(this,'initial_attachment_ca')" multiple>
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





        <div id="CCForm4" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Closure
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Closure Comment">Closure Comment</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                    require completion</small></div>
                            <textarea class="summernote" name="closure_comment_c" id="summernote-1">{{ $data->closure_comment_c}}
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Inv Attachments">Initial Attachment</label>
                            <div>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                            </div>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="initial_attachment_c">

                                    @if ($data->initial_attachment_c)
                                    @foreach (json_decode($data->initial_attachment_c) as $file)
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
                                    <input type="file" id="initial_attachment_c" name="initial_attachment_c[]" oninput="addMultipleFiles(this,'initial_attachment_c')" multiple>
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

        <div id="CCForm5" class="inner-block cctabcontent">
            <div class="inner-block-content">

                <div class="row">



                    <div class="sub-head">
                        Activity Log
                    </div>


                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Submit By : </label>
                            <div class="static">{{ $data->submitted_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Submit On : </label>
                            <div class="Date">{{ $data->submitted_on }}</div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->submitted_comment}}</div>
                        </div>
                    </div>




                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Complete Review By : </label>
                            <div class="static">{{ $data->complete_review_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Complete Review On :</label>
                            <div class="date">{{ $data->complete_review_on }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->complete_review_comment	}}</div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Investigation Completed By :</label>
                            <div class="static">{{ $data->investigation_completed_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Investigation Completed On : </label>

                            <div class="date">{{ $data->investigation_completed_on }}</div>



                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->investigation_completed_comment}}</div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Propose Plan By : </label>
                            <div class="static">{{ $data->propose_plan_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Propose Plan On : </label>

                            <div class="date">{{ $data->propose_plan_on }}</div>



                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->propose_plan_comment}}</div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Approve Plan By : </label>
                            <div class="static">{{ $data->approve_plan_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Approve Plan On : </label>
                            <div class="date">{{ $data->approve_plan_on }}</div>




                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->approve_plan_comment}}</div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">All CAPA Closed By : </label>
                            <div class="static">{{ $data->all_capa_closed_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">All CAPA Closed On : </label>
                            <div class="date">{{ $data->all_capa_closed_on }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->all_capa_closed_comment}}</div>
                        </div>
                    </div>
                    


                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Initiator Group">Closure Done By : </label>
                            <div class="static">{{ $data->closed_done_by }}</div>

                        </div>
                    </div>

                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="OOC Logged On">Closure Done On : </label>
                            <div class="date">{{ $data->closed_done_on }}</div>




                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Comment">Comment</label>
                            <div class="static" >{{$data->closed_done_comment}}</div>
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
