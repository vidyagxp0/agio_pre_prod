@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp

    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }

        .hide-input {
            display: none !important;
        }

        .remove-file{
            cursor: pointer;
        }
    </style>
    <style>
        header .header_rcms_bottom {
            display: none;
        }

        .calenderauditee {
            position: relative;
        }

        .new-date-data-field .input-date input.hide-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .new-date-data-field input {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px 15px;
            display: block;
            width: 100%;
            background: white;
        }

        .calenderauditee input::-webkit-calendar-picker-indicator {
            width: 100%;
        }
        .form-control{
            margin-bottom: 20px;
        }
    </style>
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif

    <script>
        function otherController(value, targetValue, targetFieldId) {
            var targetField = document.getElementById(targetFieldId);
            if (value === targetValue) {
                targetField.style.display = "block";
            } else {
                targetField.style.display = "none";
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            let affectedDocumentDetailIndex = {{ $affetctedDocumnetGrid && is_array($affetctedDocumnetGrid) ? count($affetctedDocumnetGrid) : 1 }};

            // Function to generate table row
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][serial]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][afftectedDoc]"></td>' +
                    '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][documentName]"></td>' +
                    '<td><input type="number" name="affectedDocuments[' + affectedDocumentDetailIndex + '][documentNumber]"></td>' +
                    '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][versionNumber]"></td>' +
                    '<td><input type="date" name="affectedDocuments[' + affectedDocumentDetailIndex + '][implimentationDate]"></td>' +
                    '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][newDocumentNumber]"></td>' +
                    '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][newVersionNumber]"></td>' +
                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';
                affectedDocumentDetailIndex++;
                return html;
            }

            // Add row on button click
            $('#addAffectedDoc').click(function(e) {
                var tableBody = $('#afftectedDocTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });

            // Remove row on button click
            $(document).on('click', '.removeRowBtn', function() {
                $(this).closest('tr').remove();
                updateTableIndexing();
            });

            // Update the indexing of the table rows after adding/removing a row
            function updateTableIndexing() {
                $('#afftectedDocTable tbody tr').each(function(index, element) {
                    $(element).find('input[name^="affectedDocuments["]').each(function() {
                        var name = $(this).attr('name');
                        var updatedName = name.replace(/\[\d+\]/, '[' + index + ']');
                        $(this).attr('name', updatedName);
                    });
                    $(element).find('input[name$="[serial]"]').val(index + 1);
                });
            }
        });
    </script>
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">


                <div class="slogan">
                    @php
                        $name = DB::table('q_m_s_divisions')->where('id', $data->id)->value('name');
                    @endphp
                    <strong>Site Division / Project </strong>:
                    {{$division->name}} / Change Control
                </div>
            </div>
        </div>
    </div>

    <!-- /* Change Control View Data Fields */ -->

    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">

                        @php
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                        $cftUsers = DB::table('cc_cfts')
                            ->where(['cc_id' => $data->id])
                            ->first();

                        // Define the column names
                        $columns = [
                            'Production_Table_Person',
                            'Production_Injection_Person',
                            'ResearchDevelopment_person',
                            'Store_person',
                            'Quality_Control_Person',
                            'QualityAssurance_person',
                            'RegulatoryAffair_person',
                            'ProductionLiquid_person',
                            'Microbiology_person',
                            'Engineering_person',
                            'ContractGiver_person',
                            'Environment_Health_Safety_person',
                            'Human_Resource_person',
                            'CorporateQualityAssurance_person',
                        ];

                        // Initialize an array to store the values
                        $valuesArray = [];

                        // Iterate over the columns and retrieve the values
                        foreach ($columns as $column) {
                            $value = $cftUsers->$column;
                            // Check if the value is not null and not equal to 0
                            if ($value !== null && $value != 0) {
                                $valuesArray[] = $value;
                            }
                        }
                        $cftCompleteUser = DB::table('change_control_cft_responses')
                            ->whereIn('status', ['In-progress', 'Completed'])
                            ->where('cc_id', $data->id)
                            ->where('cft_user_id', Auth::user()->id)
                            ->whereNull('deleted_at')
                            ->first();
                        // dd($cftCompleteUser);
                    @endphp




                        <!-- <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button>
                        <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button> -->

                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/audit-trial', $data->id) }}"> Audit Trail </a> </button>


                        @if ($data->stage == 1 && (($data->initiator_id == Auth::user()->id) || (Helpers::check_roles($data->division_id, 'Change Control', 3) || Helpers::check_roles($data->division_id, 'Change Control', 18))))


                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            {{--  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>  --}}
                          
                        @elseif($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Change Control', 4)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))


                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Assessment Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Change Control', 7)|| Helpers::check_roles($data->division_id, 'Change Control', 66)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))


                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Initial Assessment Complete
                            </button>
                            
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            
                        {{--  @elseif($data->stage == 4 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Assessment Complete

                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>  --}}

                            @elseif(
                                ($data->stage == 4 && Helpers::check_roles($data->division_id, 'Change Control', 5)) ||
                                in_array(Auth::user()->id, $valuesArray))
                                 <!-- @if (!$cftCompleteUser)
    -->
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        CFT Assessment Complete

                                    </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                    Child
                                </button>
                                    
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                        More Information Required
                                    </button>
                                  <!--
    @endif  -->
                             @elseif($data->stage == 5 && (Helpers::check_roles($data->division_id, 'Change Control', 7)|| Helpers::check_roles($data->division_id, 'Change Control', 66)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))
                            
                            
                      

                                                    
                            <button id="approval-button" class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal" style="display: none;">
                                RA Approval Required
                            </button>
                          
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#opened-state-modal">
                                Send to Initiator
                            </button>
                           
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                          
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hod-modal">
                                Send to HOD
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#initalQA-review-modal">
                                Send to QA/CQA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qa-head-approval">
                                QA/CQA Final Review Complete
                            </button>
                     @elseif($data->stage == 6 && (Helpers::check_roles($data->division_id, 'Change Control', 50)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))
                         <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Approval Complete
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                     @elseif($data->stage == 7 && (Helpers::check_roles($data->division_id, 'Change Control', 39) || Helpers::check_roles($data->division_id, 'Change Control', 43) || Helpers::check_roles($data->division_id, 'Change Control', 42) || Helpers::check_roles($data->division_id, 'Change Control', 9) || Helpers::check_roles($data->division_id, 'Change Control', 65)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))

                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-reject">
                                Rejected
                            </button>

                            @elseif($data->stage == 9 && (Helpers::check_roles($data->division_id, 'Change Control', 3)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Initiator Updated Completed
                            </button>
                            {{--  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>  --}}
                          
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-stage_8">
                                Child
                            </button>
                          
                     @elseif($data->stage == 10 && (Helpers::check_roles($data->division_id, 'Change Control', 4)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))


                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                HOD Final Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>


                @elseif($data->stage == 11 && (Helpers::check_roles($data->division_id, 'Change Control', 7)|| Helpers::check_roles($data->division_id, 'Change Control', 66)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Send For Final QA/CQA Head Approval
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>


                @elseif($data->stage == 12 && (Helpers::check_roles($data->division_id, 'Change Control', 39)|| Helpers::check_roles($data->division_id, 'Change Control', 42) || Helpers::check_roles($data->division_id, 'Change Control', 9) || Helpers::check_roles($data->division_id, 'Change Control', 43) || Helpers::check_roles($data->division_id, 'Change Control', 65)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Closure Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>

               @elseif($data->stage == 13 && (Helpers::check_roles($data->division_id, 'Change Control', 39)|| Helpers::check_roles($data->division_id, 'Change Control', 42)|| Helpers::check_roles($data->division_id, 'Change Control', 66)|| Helpers::check_roles($data->division_id, 'Change Control', 18)))



                            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child_effective_ness">
                                Child
                            </button> -->

                            <button class="button_theme1" id="childButton" data-bs-toggle="modal" data-bs-target="#child_effective_ness" style="display: none;">
                                Child
                            </button>

                        @else

                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @elseif($data->stage == 8)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed - Rejected</div>
                        </div>
                    @else

                        <div class="progress-bars" >
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">HOD Assessment</div>
                            @else
                                <div class="">HOD Assessment</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">QA/CQA Initial
                                    Assessment</div>
                            @else
                                <div class="">QA/CQA Initial
                                    Assessment</div>
                            @endif
                            @if ($data->stage >= 4)
                                <div class="active">CFT Assessment</div>
                            @else
                                <div class="">CFT Assessment</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">QA/CQA Final Review</div>
                            @else
                                <div class="">QA/CQA Final Review</div>-
                            @endif
                            @if (($data->stage > 6 || $data->status == 'QA/CQA Final Review') )
    <div id="pending-ra-stage" class="active">Pending RA Approval</div>
@else
    <div id="pending-ra-stage" class="">Pending RA Approval</div>
@endif

                            @if ($data->stage >= 7)
                                <div class="active">QA/CQA Head/Manager Designee Approval</div>
                            @else
                                <div class="">QA/CQA Head/Manager Designee Approval</div>
                            @endif

                            @if ($data->stage >= 9)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Pending Initiator Update</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Pending Initiator Update</div>
                            @endif

                            @if ($data->stage >= 10)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>HOD Final Review</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>HOD Final Review</div>
                            @endif

                            @if ($data->stage >= 11)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Implementation Verification by QA/CQA</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Implementation Verification by QA/CQA</div>
                            @endif

                            @if ($data->stage >= 12)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>QA/CQA Closure Approval</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>QA/CQA Closure Approval</div>
                            @endif



                            @if ($data->stage >= 13)
                                <div class="active bg-danger" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @endif



                            <!-- @if ($data->stage >= 9)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Post Implementation</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Post Implementation</div>
                            @endif

                            @if ($data->stage >= 10)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @endif

                            @if ($data->stage >= 11)
                                <div class="active bg-danger" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @endif -->
                        </div>
                    @endif
                </div>
            </div>


            <div class="control-list">
                @php
                    $users = DB::table('users')->get();
                @endphp
                <div id="change-control-fields">
                    <div class="container-fluid">
                        <!-- Tab links -->
                        <div class="cctab">
                            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm7')" style="display: none" id="riskAssessmentButton">Risk Assessment</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Initial HOD Review</button>


                            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm13')" style="display: {{ $data->hod_person == Auth::user()->id ? 'inline' : 'none' }}">HOD Review</button> --}}
                            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm11')">CFT</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA/CQA Final Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm15')"  style="display: none" id="actionButton">RA</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm17')">QA/CQA Head / Designee Approval</button>

                            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Evaluation</button> -->
                            <button class="cctablinks" onclick="openCity(event, 'CCForm5')"> Initiator Update</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">HOD Final Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Implementation Verification by QA/CQA</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Change Closure</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
                        </div>

                        <form id="CCFormInput" action="{{ route('CC.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                        <input type="hidden" name="stage" id="stage" value="{{ $data->stage }}" >

                            @csrf
                            @method('PUT')

                            <!-- Tab content -->
                            <div id="step-form">

                                <div id="CCForm1" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="rls">Record Number</label>
                                                    <!-- <div class="static">
                                                        @if($data->stage == 3)
                                                            <input type="hidden" name="record_number"  value="{{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                                        @endif
                                                        @if($data->record_number != null)
                                                            <input type="text" placeholder="{{ $data->record_number }}" readonly >
                                                        @else
                                                            <input type="text" placeholder="Record Number" readonly >
                                                        @endif
                                                    </div> -->



                                                    <input type="hidden" name="record_number">
                                             
                                                <input disabled type="text"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                            
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Division Code"><b>Site/Location Code</b></label>
                                                    <input disabled type="text" name="division_code"
                                                        value=" {{ Helpers::getDivisionName($data->division_id) }}">
                                                </div>
                                            </div>
                                            {{-- <div class="static">QMS-North America</div> --}}
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator">Initiator</label>
                                                    <div class="static"><input disabled type="text"
                                                            value="{{ Helpers::getInitiatorName($data->initiator_id) }}"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="date_initiation">Date of Initiation</label>
                                                    <div class="static"><input disabled type="text" value="{{ Helpers::getdateFormat($data->intiation_date) }}"></div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <div class="group-input">
                                                    <label for="search">
                                                        Assigned To
                                                    </label>
                                                    <select placeholder="Select..." name="assign_to" required>
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $datas)
                                                            @if (Helpers::checkUserRolesassign_to($datas))
                                                                <option value="{{ $datas->id }}"
                                                                    {{ $data->assign_to == $datas->id ? 'selected' : '' }}
                                                                    {{-- @if ($data->assign_to == $datas->id) selected @endif --}}>
                                                                    {{ $datas->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology">CFT Reviewer</label>
                                                    <select name="Microbiology">
                                                        <option value="">-- Select --</option>
                                                        <option value="yes" selected>Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div> -->





                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Due Date"> Due Date
                                                        <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <div>
                                                        <small class="text-primary"></small>
                                                    </div>
                                                    <div class="calenderauditee">
                                                        @php
                                                            // Set formattedDate to an empty string if due_date is not set
                                                            $formattedDate = str_contains('NaN-undefined-NaN', $data->due_date) ? '' : $data->due_date;
                                                        @endphp
                                                        <input type="text" id="due_date" name="due_date" placeholder="Select Due Date" value="{{ Helpers::getdateFormat($formattedDate) }}" {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }} />
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#due_date").datepicker({
                                                                dateFormat: "dd-M-yy",
                                                                // Do not set a default date, let the user select it
                                                                onClose: function(dateText, inst) {
                                                                    if (!dateText) {
                                                                        $(this).val('');  // Ensure input stays empty if no date is selected
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator"><b>Initiation Department</b></label>
                                                    <input readonly type="text" name="Initiator_Group" id="initiator_group" 
                                                        value="{{ $data->Initiator_Group }}">
                                                </div>
                                            </div>



                                            {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="initiator-group">Initiation Department</label>
                                                    <select name="Initiator_Group" id="initiator_group" {{ $data->stage == 0 || $data->stage == 13 ? '' : '' }}>
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA"
                                                            @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA"
                                                            @if ($data->Initiator_Group == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC"
                                                            @if ($data->Initiator_Group == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM"
                                                            @if ($data->Initiator_Group == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG"
                                                            @if ($data->Initiator_Group == 'PG') selected @endif>Production General</option>
                                                        <option value="PL"
                                                            @if ($data->Initiator_Group == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT"
                                                            @if ($data->Initiator_Group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE"
                                                            @if ($data->Initiator_Group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC"
                                                            @if ($data->Initiator_Group == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI"
                                                            @if ($data->Initiator_Group == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN"
                                                            @if ($data->Initiator_Group == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR"
                                                            @if ($data->Initiator_Group == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST"
                                                            @if ($data->Initiator_Group == 'ST') selected @endif>Store</option>
                                                        <option value="IT"
                                                            @if ($data->Initiator_Group == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD"
                                                            @if ($data->Initiator_Group == 'FD') selected @endif>Formulation  Development
                                                        </option>
                                                        <option value="AL"
                                                            @if ($data->Initiator_Group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                        </option>
                                                        <option value="PD"
                                                            @if ($data->Initiator_Group == 'PD') selected @endif>Packaging Development
                                                        </option>

                                                        <option value="PU"
                                                            @if ($data->Initiator_Group == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC"
                                                            @if ($data->Initiator_Group == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA"
                                                            @if ($data->Initiator_Group == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV"
                                                            @if ($data->Initiator_Group == 'PV') selected @endif>Pharmacovigilance
                                                        </option>
                                                    </select>
                                                </div>
                                            </div> --}}

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

                                            {{--  <script>
                                                $(document).ready(function() {
                                                    function toggleRiskAssessmentButton() {
                                                        var riskAssessmentRequired = $('#risk_assessment_required').val();
                                                        if (riskAssessmentRequired === 'yes') {
                                                            $('#riskAssessmentButton').show();
                                                        } else {
                                                            $('#riskAssessmentButton').hide();
                                                        }
                                                    }
                                                    toggleRiskAssessmentButton();

                                                    // Call the function on dropdown change
                                                    $('#risk_assessment_required').change(function() {
                                                        toggleRiskAssessmentButton();
                                                    });
                                                });
                                            </script>  --}}

                                                <script>
                                                    $(document).ready(function() {
                                                        function toggleRiskAssessmentAndJustification() {
                                                            var riskAssessmentRequired = $('#risk_assessment_required').val();

                                                            if (riskAssessmentRequired === 'yes') {
                                                                $('#riskAssessmentButton').show();
                                                                $('#justification_div').hide();
                                                                $('#justification').val('').removeAttr('required'); // Clear value and remove required
                                                                $('#justification_error').hide();
                                                                $('#risk_assessment_related_record').attr('required', 'required');
                                                                $('#migration_action').attr('required', 'required');
                                                            } else if (riskAssessmentRequired === 'no') {
                                                                $('#riskAssessmentButton').hide();
                                                                $('#justification_div').show();
                                                                $('#justification').attr('required', 'required'); // Make justification required
                                                            } else {
                                                                $('#riskAssessmentButton').hide();
                                                                $('#justification_div').hide();
                                                                $('#justification').removeAttr('required');
                                                                $('#justification_error').hide();
                                                            }
                                                        }

                                                        toggleRiskAssessmentAndJustification(); // Initial call

                                                        $('#risk_assessment_required').change(function() {
                                                            toggleRiskAssessmentAndJustification();
                                                        });

                                                        $('form').submit(function(event) {
                                                            if ($('#risk_assessment_required').val() === 'no' && !$('#justification').val().trim()) {
                                                                $('#justification_error').show();
                                                                event.preventDefault(); // Prevent form submission
                                                            }
                                                        });
                                                    });
                                                </script>

                                                <script>
                                                    $(document).ready(function() {
                                                        function toggleButtons() {
                                                            var selectedValue = $('#RA_head_required').val();

                                                            console.log("Selected value:", selectedValue); // Debugging output

                                                            if (selectedValue === 'Yes') {
                                                                $('#actionButton').show();
                                                                $('#pendingRAApproval').show();
                                                                console.log("show"); // Debugging output
                                                            } else {
                                                                $('#actionButton').hide();
                                                                $('#pendingRAApproval').hide();
                                                                console.log("hide"); // Debugging output
                                                            }
                                                        }

                                                        // Handle change event
                                                        $('#RA_head_required').on('change', function() {
                                                            toggleButtons();
                                                        });

                                                        // Handle initial state
                                                        toggleButtons();
                                                    });
                                                </script>

                                                <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="risk_assessment_required">Risk Assessment Required?
                                                            <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                        </label>

                                                        @if($data->stage == 1)
                                                            <select name="risk_assessment_required" id="risk_assessment_required" required>
                                                                <option value="">-- Select --</option>
                                                                <option value="yes" {{ $data->risk_assessment_required == 'yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="no" {{ $data->risk_assessment_required == 'no' ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        @else
                                                            <select name="risk_assessment_required_display" id="risk_assessment_required" disabled>
                                                                <option value="">-- Select --</option>
                                                                <option value="yes" {{ $data->risk_assessment_required == 'yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="no" {{ $data->risk_assessment_required == 'no' ? 'selected' : '' }}>No</option>
                                                            </select>
                                                            <input type="hidden" name="risk_assessment_required" value="{{ $data->risk_assessment_required }}">
                                                        @endif
                                                    </div>
                                                </div>

                                            <!-- <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="Risk Assessment Required">Justification </label>
                                                    <textarea name="train_comments" id="">{{ $data->train_comments }}</textarea>
                                                </div>
                                            </div> -->

                                            <div class="col-lg-6" id="justification_div" style="display:none;">
                                                <div class="group-input">
                                                    <label for="Justification">Justification <span class="text-danger">*</span></label>
                                                    <textarea name="risk_identification" id="justification" rows="4" placeholder="Provide justification if risk assessment is not required." 
                                                        {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }} {{$data->stage == 1 ? '' : 'readonly'}}>{{ $data->risk_identification ?? '' }}</textarea>
                                                    <span id="justification_error" class="text-danger" style="display: none;">This field is required.</span>
                                                </div>
                                            </div>

                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 4,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                            @endphp

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="hod_person">HOD Person
                                                        <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>

                                                    @if($data->stage == 1)
                                                        <select name="hod_person" id="hod_person" required>
                                                            <option value="">Select HOD Person</option>
                                                            @if($users)
                                                                @foreach($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $user->id == $data->hod_person ? 'selected' : '' }}>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    @else
                                                        <select name="hod_person_display" id="hod_person" disabled>
                                                            <option value="">Select HOD Person</option>
                                                            @if($users)
                                                                @foreach($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $user->id == $data->hod_person ? 'selected' : '' }}>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <input type="hidden" name="hod_person" value="{{ $data->hod_person }}">
                                                    @endif
                                                </div>
                                            </div>



                                            {{-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="short-desc">Short Description</label>
                                                    <textarea name="short_description">{{ $data->short_description }}</textarea>
                                                </div>
                                            </div>  --}}
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Short Description">Short Description<span
                                                            class="text-danger">*</span></label><span id="rchars"
                                                        class="text-primary">255 </span><span class="text-primary">
                                                        characters remaining</span>


                                                    <input name="short_description" id="docname" type="text" maxlength="255" required type="text"
                                                        {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }} value="{{ $data->short_description }}">
                                                </div>
                                                <p id="docnameError" style="color:red">**Short Description is required</p>

                                            </div>



                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="change_related_to">Change Related To
                                                        @if($data->stage == 1)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>

                                                    @if($data->stage == 1)
                                                        <select name="severity" id="change_related_to" required>
                                                            <option value="">-- Select --</option>
                                                            <option value="process" {{ old('severity', $data->severity ?? '') == 'process' ? 'selected' : '' }}>Process</option>
                                                            <option value="facility" {{ old('severity', $data->severity ?? '') == 'facility' ? 'selected' : '' }}>Facility</option>
                                                            <option value="utility" {{ old('severity', $data->severity ?? '') == 'utility' ? 'selected' : '' }}>Utility</option>
                                                            <option value="equipment" {{ old('severity', $data->severity ?? '') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                                            <option value="document" {{ old('severity', $data->severity ?? '') == 'document' ? 'selected' : '' }}>Document</option>
                                                            <option value="other" {{ old('severity', $data->severity ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                    @else
                                                        <select name="severity_display" id="change_related_to" disabled>
                                                            <option value="">-- Select --</option>
                                                            <option value="process" {{ old('severity', $data->severity ?? '') == 'process' ? 'selected' : '' }}>Process</option>
                                                            <option value="facility" {{ old('severity', $data->severity ?? '') == 'facility' ? 'selected' : '' }}>Facility</option>
                                                            <option value="utility" {{ old('severity', $data->severity ?? '') == 'utility' ? 'selected' : '' }}>Utility</option>
                                                            <option value="equipment" {{ old('severity', $data->severity ?? '') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                                            <option value="document" {{ old('severity', $data->severity ?? '') == 'document' ? 'selected' : '' }}>Document</option>
                                                            <option value="other" {{ old('severity', $data->severity ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        <input type="hidden" name="severity" value="{{ $data->severity }}">
                                                    @endif

                                                    
                                                </div>
                                            </div>

                                            <!-- Textbox for 'Other' option -->
                                            <div class="col-lg-6" id="other_specify_div" style="display:none;">
                                                <div class="group-input">
                                                    <label for="other_specify">Please specify<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span></label>
                                                    <input type="text" name="Occurance" id="other_specify" value="{{ $data->Occurance ?? '' }}" placeholder="Specify if Other is selected" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                    <!-- @error('other_specify')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror -->
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function () {
                                                    function toggleOtherSpecifyField() {
                                                        var changeRelatedTo = $('#change_related_to').val();
                                                        if (changeRelatedTo === 'other') {
                                                            $('#other_specify_div').show();
                                                            $('#other_specify').attr('required', 'required'); // Make field required
                                                        } else {
                                                            $('#other_specify_div').hide();
                                                            $('#other_specify').removeAttr('required'); // Remove required if not Other
                                                        }
                                                    }

                                                    toggleOtherSpecifyField(); // Initial check

                                                    // Update field visibility on dropdown change
                                                    $('#change_related_to').change(function () {
                                                        toggleOtherSpecifyField();
                                                    });

                                                    // Form validation
                                                    $('form').submit(function (event) {
                                                        var changeRelatedTo = $('#change_related_to').val();
                                                        var otherSpecify = $('#other_specify').val().trim();

                                                        if (changeRelatedTo === 'other' && !otherSpecify) {
                                                            alert('Please specify a value for "Other".'); // Show error message
                                                            event.preventDefault(); // Prevent form submission
                                                        }
                                                    });
                                                });
                                            </script>



                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="initiated_through">Initiated Through
                                                    <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                </label>
                                                <div><small class="text-primary">Please select related information</small></div>

                                                @if($data->stage == 1)
                                                    <select name="initiated_through" id="initiated_through" required>
                                                        <option value="">Enter Your Selection Here</option>
                                                        <option value="recall" {{ $data->initiated_through == 'recall' ? 'selected' : '' }}>Recall</option>
                                                        <option value="return" {{ $data->initiated_through == 'return' ? 'selected' : '' }}>Return</option>
                                                        <option value="deviation" {{ $data->initiated_through == 'deviation' ? 'selected' : '' }}>Deviation</option>
                                                        <option value="complaint" {{ $data->initiated_through == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                        <option value="regulatory" {{ $data->initiated_through == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                                        <option value="lab-incident" {{ $data->initiated_through == 'lab-incident' ? 'selected' : '' }}>Lab Incident</option>
                                                        <option value="Continuous_improvement" {{ $data->initiated_through == 'Continuous_improvement' ? 'selected' : '' }}>Continuous Improvement</option>
                                                        <option value="others" {{ $data->initiated_through == 'others' ? 'selected' : '' }}>Others</option>
                                                    </select>
                                                @else
                                                    <select name="initiated_through_display" id="initiated_through" disabled>
                                                        <option value="">Enter Your Selection Here</option>
                                                        <option value="recall" {{ $data->initiated_through == 'recall' ? 'selected' : '' }}>Recall</option>
                                                        <option value="return" {{ $data->initiated_through == 'return' ? 'selected' : '' }}>Return</option>
                                                        <option value="deviation" {{ $data->initiated_through == 'deviation' ? 'selected' : '' }}>Deviation</option>
                                                        <option value="complaint" {{ $data->initiated_through == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                        <option value="regulatory" {{ $data->initiated_through == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                                        <option value="lab-incident" {{ $data->initiated_through == 'lab-incident' ? 'selected' : '' }}>Lab Incident</option>
                                                        <option value="Continuous_improvement" {{ $data->initiated_through == 'Continuous_improvement' ? 'selected' : '' }}>Continuous Improvement</option>
                                                        <option value="others" {{ $data->initiated_through == 'others' ? 'selected' : '' }}>Others</option>
                                                    </select>
                                                    <input type="hidden" name="initiated_through" value="{{ $data->initiated_through }}">
                                                @endif
                                            </div>
                                        </div>


                                            <div class="col-lg-6">
                                                <div class="group-input" id="initiated_through_div" style="display: none;">
                                                    <label for="initiated_through">Others<span
                                                            class="text-danger">*</span></label>
                                                    <textarea name="initiated_through_req" {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->initiated_through_req }}</textarea>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function () {
                                                    function toggleInitiatedThroughField() {
                                                        var initiatedThrough = $('#initiated_through').val();
                                                        if (initiatedThrough === 'others') {
                                                            $('#initiated_through_div').show();
                                                            $('textarea[name="initiated_through_req"]').attr('required', 'required'); // Make field required
                                                        } else {
                                                            $('#initiated_through_div').hide();
                                                            $('textarea[name="initiated_through_req"]').removeAttr('required'); // Remove required if not "Others"
                                                        }
                                                    }

                                                    toggleInitiatedThroughField(); // Initial check

                                                    // Update field visibility on dropdown change
                                                    $('#initiated_through').change(function () {
                                                        toggleInitiatedThroughField();
                                                    });

                                                    // Form validation
                                                    $('form').submit(function (event) {
                                                        var initiatedThrough = $('#initiated_through').val();
                                                        var initiatedThroughReq = $('textarea[name="initiated_through_req"]').val().trim();

                                                        if (initiatedThrough === 'others' && !initiatedThroughReq) {
                                                            alert('Please specify a value for "Others".'); // Show error message
                                                            event.preventDefault(); // Prevent form submission
                                                        }
                                                    });
                                                });
                                            </script>


                                            {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="repeat">Repeat</label>
                                                    <div><small class="text-primary">Please select yes if it is has
                                                            recurred in past six months</small></div>
                                                    <select name="repeat"
                                                        onchange="otherController(this.value, 'yes', 'repeat_nature')"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                        <option value="">Enter Your Selection Here</option>
                                                        <option @if ($data->repeat == 'yes') selected @endif
                                                            value="yes">Yes</option>
                                                        <option @if ($data->repeat == 'no') selected @endif
                                                            value="no">No</option>
                                                        <option @if ($data->repeat == 'na') selected @endif
                                                            value="na">NA</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-lg-6">
                                                <div class="group-input" id="repeat_nature">
                                                    <label for="repeat_nature">Repeat Nature<span
                                                            class="text-danger d-none">*</span></label>
                                                    <textarea name="repeat_nature"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>{{ $data->repeat_nature }}</textarea>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="nature-change">Nature Of Change</label>
                                                    @if($data->stage == 1)
                                                        <select name="doc_change" required>
                                                            <option value="">-- Select --</option>
                                                            <option {{ $data->doc_change == 'Temporary' ? 'selected' : '' }} value="Temporary">Temporary</option>
                                                            <option {{ $data->doc_change == 'Permanent' ? 'selected' : '' }} value="Permanent">Permanent</option>
                                                        </select>
                                                    @else
                                                        <select name="doc_change_show" disabled>
                                                            <option value="">-- Select --</option>
                                                            <option {{ $data->doc_change == 'Temporary' ? 'selected' : '' }} value="Temporary">Temporary</option>
                                                            <option {{ $data->doc_change == 'Permanent' ? 'selected' : '' }} value="Permanent">Permanent</option>
                                                        </select>
                                                        <input type="hidden" name="doc_change" value="{{ $data->doc_change }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="others">If Others<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="others" {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $data->If_Others }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="others">Description of Change
                                                        <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="bd_domestic" {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $data->bd_domestic }}</textarea>
                                                </div>
                                            </div>


                                            <!-- <div class="col-md-6">
                                                <div class="group-input">
                                                    <label for="div_code">Division Code</label>
                                                    <select name="div_code" {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                        <option value="">-- Select --</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Instrumental Lab' ? 'selected' : '' }}
                                                            value="Instrumental Lab">Instrumental Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Microbiology Lab' ? 'selected' : '' }}
                                                            value="Microbiology Lab"> Microbiology Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Molecular lab' ? 'selected' : '' }}
                                                            value="Molecular lab"> Molecular lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Physical Lab' ? 'selected' : '' }}
                                                            value="Physical Lab"> Physical Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Stability Lab' ? 'selected' : '' }}
                                                            value="Stability Lab"> Stability Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Wet Chemistry' ? 'selected' : '' }}
                                                            value="Wet Chemistry"> Wet Chemistry</option>
                                                        {{-- <option {{ $data->Division_Code == 'IPQA Lab' ? 'selected' : '' }}
                                                            value="IPQA Lab"> IPQA Lab</option> --}}
                                                        <option
                                                            {{ $data->Division_Code == 'Quality Department' ? 'selected' : '' }}
                                                            value="Quality Department">Quality Department</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Administration Department' ? 'selected' : '' }}
                                                            value="Administration Department">Administration Department
                                                        </option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            @if ($data->in_attachment)
                                                @foreach (json_decode($data->in_attachment) as $file)
                                                    <input id="initialFile-{{ $loop->index }}" type="hidden"
                                                        name="existing_initial_files[{{ $loop->index }}]"
                                                        value="{{ $file }}">
                                                @endforeach
                                            @endif

                                            <div class="col-12">
                                    <div class="group-input">
                                        <label for="in_attachment">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="in_attachment">
                                                @if ($data->in_attachment)
                                                    @foreach(json_decode($data->in_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_in_attachment[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="in_attachment[]"
                                                    {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'in_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_in_attachment" name="deleted_in_attachment" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_in_attachment');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>
                                </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div id="CCForm7" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Risk Assessment
                                        </div>

                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="risk_assessment_related_record">Related Records</label>
                                                <select  multiple id="risk_assessment_related_record" name="risk_assessment_related_record[]" placeholder="Select Reference Records"
                                                        data-search="false" data-silent-initial-value-set="true"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                    @foreach ($preRiskAssessment as $prix)
                                                        <option value="{{ $prix->id }}"
                                                            {{ in_array($prix->id, explode(',', $data->risk_assessment_related_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($prix->division_id) }}/Risk-Assessment/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> -->


                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="risk_assessment_related_record">Related Records
                                                    <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                </label>

                                                @php
                                                    $selectedRecords = explode(',', $data->risk_assessment_related_record);
                                                @endphp

                                                @if ($data->stage == 1)
                                                    <select multiple id="risk_assessment_related_record" name="risk_assessment_related_record[]">
                                                        @if (!empty($preRiskAssessment))
                                                            @foreach ($preRiskAssessment as $new)
                                                                @php
                                                                    $recordValue = Helpers::getDivisionName($new->division_id) . '/Risk-Assessment/' . date('Y') . '/' . Helpers::recordFormat($new->record);
                                                                @endphp
                                                                <option value="{{ $recordValue }}" {{ in_array($recordValue, $selectedRecords) ? 'selected' : '' }}>
                                                                    {{ $recordValue }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @else
                                                    <select multiple id="risk_assessment_related_record" name="risk_assessment_related_record_display[]" disabled>
                                                        @if (!empty($preRiskAssessment))
                                                            @foreach ($preRiskAssessment as $new)
                                                                @php
                                                                    $recordValue = Helpers::getDivisionName($new->division_id) . '/Risk-Assessment/' . date('Y') . '/' . Helpers::recordFormat($new->record);
                                                                @endphp
                                                                <option value="{{ $recordValue }}" {{ in_array($recordValue, $selectedRecords) ? 'selected' : '' }}>
                                                                    {{ $recordValue }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                    {{-- Hidden inputs to submit the selected values --}}
                                                    @foreach ($selectedRecords as $record)
                                                        <input type="hidden" name="risk_assessment_related_record[]" value="{{ $record }}">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>




                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="migration-action">Comments
                                                    <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="migration_action" id="migration_action"
                                                     {{ $data->stage == 1  ? '' : 'readonly' }}
                                                      
                                                     >{{ $data->migration_action }}</textarea>
                                                </div>
                                            </div>

                                            @if ($data->risk_assessment_atch)
                                                @foreach (json_decode($data->risk_assessment_atch) as $file)
                                                    <input id="riskAssessmentFile-{{ $loop->index }}" type="hidden"
                                                        name="existinRiskAssessmentFile[{{ $loop->index }}]"
                                                        value="{{ $file }}">
                                                @endforeach
                                            @endif
                                            <div class="group-input">
                                                <label for="tran-attach">Risk Assessment Attachment</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="risk_assessment_atch">
                                                        @if ($data->risk_assessment_atch)
                                                            @foreach (json_decode($data->risk_assessment_atch) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                            data-remove-id="riskAssessmentFile-{{ $loop->index }}"
                                                                            data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="risk_assessment_atch[]"
                                                            oninput="addMultipleFiles(this, 'risk_assessment_atch')"  {{ $data->stage == 1  ? '' : 'disabled' }} multiple>
                                                    </div>
                                                 

                                            </div>

                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm2" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Change Details
                                        </div>
                                        <div class="row">



                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="current-practice">Current Practice
                                                       <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="current_practice" {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $docdetail->current_practice }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="proposed_change">Proposed Change
                                                         <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="proposed_change"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }} {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $docdetail->proposed_change }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="reason_change">Reason for Change
                                                        <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="reason_change" {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $docdetail->reason_change }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="other_comment">Any Other Comments
                                                         <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="other_comment"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }} {{ $data->stage == 1 ? 'required' : 'readonly' }}>{{ $docdetail->other_comment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="supervisor_comment">
                                                        Supervisor Comments
                                                    </label>
                                                    <textarea name="supervisor_comment"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>{{ $docdetail->supervisor_comment }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="change_details_attachments">Change Details Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="change_details_attachments">
                                                            @if ($cc_cfts->change_details_attachments)
                                                                @foreach(json_decode($cc_cfts->change_details_attachments) as $file)
                                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                            <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                                        </a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                            <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                                        </a>
                                                                        <input type="hidden" name="existing_change_details_attachments[]" value="{{ $file }}">
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input type="file" id="myfile" name="change_details_attachments[]"
                                                                {{ $data->stage == 2 || $data->stage == 3 ||$data->stage == 4 ||$data->stage == 5 || $data->stage == 6 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'change_details_attachments')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden field to keep track of files to be deleted -->
                                            <input type="hidden" id="deleted_change_details_attachments" name="deleted_change_details_attachments" value="">

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const removeButtons = document.querySelectorAll('.remove-file');

                                                    removeButtons.forEach(button => {
                                                        button.addEventListener('click', function() {
                                                            const fileName = this.getAttribute('data-file-name');
                                                            const fileContainer = this.closest('.file-container');

                                                            // Hide the file container
                                                            if (fileContainer) {
                                                                fileContainer.style.display = 'none';
                                                                // Remove hidden input associated with this file
                                                                const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                                if (hiddenInput) {
                                                                    hiddenInput.remove();
                                                                }

                                                                // Add the file name to the deleted files list
                                                                const deletedFilesInput = document.getElementById('deleted_change_details_attachments');
                                                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                                deletedFiles.push(fileName);
                                                                deletedFilesInput.value = deletedFiles.join(',');
                                                            }
                                                        });
                                                    });
                                                });

                                                function addMultipleFiles(input, id) {
                                                    const fileListContainer = document.getElementById(id);
                                                    const files = input.files;

                                                    for (let i = 0; i < files.length; i++) {
                                                        const file = files[i];
                                                        const fileName = file.name;
                                                        const fileContainer = document.createElement('h6');
                                                        fileContainer.classList.add('file-container', 'text-dark');
                                                        fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                                        const fileText = document.createElement('b');
                                                        fileText.textContent = fileName;

                                                        const viewLink = document.createElement('a');
                                                        viewLink.href = '#'; // You might need to adjust this to handle local previews
                                                        viewLink.target = '_blank';
                                                        viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                                        const removeLink = document.createElement('a');
                                                        removeLink.classList.add('remove-file');
                                                        removeLink.dataset.fileName = fileName;
                                                        removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                                        removeLink.addEventListener('click', function() {
                                                            fileContainer.style.display = 'none';
                                                        });

                                                        fileContainer.appendChild(fileText);
                                                        fileContainer.appendChild(viewLink);
                                                        fileContainer.appendChild(removeLink);

                                                        fileListContainer.appendChild(fileContainer);
                                                    }
                                                }
                                            </script>
                                        
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>



                                <div id="CCForm12" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                        HOD Assessment
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments">HOD Assessment Comments  @if($data->stage == 2) <span class="text-danger">*</span>@endif
                                        </label>
                                    
                                            <textarea name="hod_assessment_comments"  {{ $data->stage == 2 ? 'required' : 'readonly' }}>{{$cc_cfts->hod_assessment_comments}}</textarea>
                                        </div>


                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="hod_assessment_attachment">HOD Assessment Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="hod_assessment_attachment">
                                                @if ($cc_cfts->hod_assessment_attachment)
                                                    @foreach(json_decode($cc_cfts->hod_assessment_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_hod_assessment_attachment[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="hod_assessment_attachment[]"
                                                    {{ $data->stage == 1 || $data->stage == 3 ||$data->stage == 4 ||$data->stage == 5 || $data->stage == 6 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'hod_assessment_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_hod_assessment_attachment" name="deleted_hod_assessment_attachment" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_hod_assessment_attachment');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>


                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>



                                {{-- <div id="CCForm13" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if ($data->stage == 2)
                                                    <div class="group-input">
                                                        <label for="HOD Remarks">HOD Remarks</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="HOD_Remarks" id="summernote-4" required  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>{{ $data->HOD_Remarks }}</textarea>
                                                    </div>
                                                @else
                                                    <div class="group-input">
                                                        <label for="HOD Remarks">HOD Remarks</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea readonly class="tiny" name="HOD_Remarks" id="summernote-4"  {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>{{ $data->HOD_Remarks }}</textarea>
                                                    </div>
                                                @endif
                                                @error('HOD_Remarks')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                @if ($data->stage == 2)
                                                    @if ($data->HOD_attachment)
                                                        @foreach (json_decode($data->HOD_attachment) as $file)
                                                            <input id="hodAttachmentFile-{{ $loop->index }}" type="hidden"
                                                                name="existinHodFile[{{ $loop->index }}]"
                                                                value="{{ $file }}">
                                                        @endforeach
                                                    @endif
                                                    <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="HOD_attachment">
                                                                @if ($data->HOD_attachment)
                                                                    @foreach (json_decode($data->HOD_attachment) as $file)
                                                                        <h6 class="file-container text-dark"
                                                                            style="background-color: rgb(243, 242, 240);">
                                                                            <b>{{ $file }}</b>
                                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a class="remove-file"
                                                                                data-remove-id="hodAttachmentFile-{{ $loop->index }}"
                                                                                data-file-name="{{ $file }}"><i
                                                                                    class="fa-solid fa-circle-xmark"
                                                                                    style="color:red; font-size:20px;"></i></a>
                                                                        </h6>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input
                                                                    {{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                                    type="file" id="HOD_attachment"
                                                                    name="HOD_attachment[]"{{ $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'HOD_attachment')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if ($data->HOD_attachment)
                                                        @foreach (json_decode($data->HOD_attachment) as $file)
                                                            <input id="hodAttachmentFile-{{ $loop->index }}" type="hidden"
                                                                name="existinHodFile[{{ $loop->index }}]"
                                                                value="{{ $file }}">
                                                        @endforeach
                                                    @endif
                                                    <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="HOD_attachment">
                                                                @if ($data->HOD_attachment)
                                                                    @foreach (json_decode($data->HOD_attachment) as $file)
                                                                        <h6 class="file-container text-dark"
                                                                            style="background-color: rgb(243, 242, 240);">
                                                                            <b>{{ $file }}</b>
                                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a class="remove-file"
                                                                                    data-remove-id="hodAttachmentFile-{{ $loop->index }}"
                                                                                    data-file-name="{{ $file }}"><i
                                                                                    class="fa-solid fa-circle-xmark"
                                                                                    style="color:red; font-size:20px;"></i></a>
                                                                        </h6>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input disabled
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                    type="file" id="HOD_attachment"
                                                                    name="HOD_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'HOD_attachment')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    // Event listener for the remove file button
                                                    $(document).on('click', '.remove-file', function() {
                                                        $(this).closest('.file-container').remove();
                                                    });
                                                });
                                            </script>


                                        </div>
                                        <div class="button-block">

                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                                class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                                                id="ChangesaveButton02">
                                                <div class="spinner-border spinner-border-sm auditFormSpinner"
                                                    style="display: none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save
                                            </button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                class="nextButton" onclick="nextStep()">Next</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                    Exit
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        // Event listener for the remove file button
                                        $(document).on('click', '.remove-file', function() {
                                            $(this).closest('.file-container').remove();
                                        });
                                    });
                                </script>

                                <div id="CCForm3" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">


                                            <!-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology-Person">CFT Reviewer Person </label>
                                                    <select multiple name="reviewer_person_value[]"
                                                        placeholder="Select CFT Reviewers" data-search="false"
                                                        data-silent-initial-value-set="true" id="reviewer_person_value"  {{   $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                        
                                                        @foreach ($cft as $data1)
                                                            @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                                @if (in_array($data1->id, $cftReviewerIds))
                                                                    <option value="{{ $data1->id }}" {{ in_array($data1->id, $cftReviewerIds) ? 'selected' : '' }}>
                                                                        {{ $data1->name }}</option>
                                                                @else
                                                                    <option value="{{ $data1->id }}">
                                                                        {{ $data1->name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> -->

                                            {{--  <div class="col-12">
                                                <div class="group-input">
                                                    <label for="cft_reviewer">Related Records</label>
                                                    <select{{ $data->stage == 0  $data->stage == 13 ? 'disabled' : '' }}
                                                        multiple id="cft_reviewer" name="cft_reviewer[]"
                                                        placeholder="Select Reference Records" data-search="false"
                                                        data-silent-initial-value-set="true">
                                                        @foreach ($pre as $prix)
                                                            <option value="{{ $prix->id }}" {{ in_array($prix->id, $previousRelated) ? 'selected' : '' }}>
                                                                {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>  --}}

                                            <!-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="due_days"> Due Days </label>
                                                    <input type="number" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }} name="due_days" id="due_days" value="{{ $data->due_days }}" >
                                                </div>
                                            </div> -->

                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="severity-level">Classification of Change
                                                        @if($data->stage == 3) <span class="text-danger">*</span>@endif
                                                    </label>

                                                    @if($data->stage == 3)
                                                        <select name="severity_level1" required>
                                                            <option value="">-- Select --</option>
                                                            <option value="minor" {{ $data->severity_level1 == 'minor' ? 'selected' : '' }}>Minor</option>
                                                            <option value="major" {{ $data->severity_level1 == 'major' ? 'selected' : '' }}>Major</option>
                                                            <option value="critical" {{ $data->severity_level1 == 'critical' ? 'selected' : '' }}>Critical</option>
                                                        </select>
                                                    @else
                                                        <select name="severity_level1_display" disabled>
                                                            <option value="">-- Select --</option>
                                                            <option value="minor" {{ $data->severity_level1 == 'minor' ? 'selected' : '' }}>Minor</option>
                                                            <option value="major" {{ $data->severity_level1 == 'major' ? 'selected' : '' }}>Major</option>
                                                            <option value="critical" {{ $data->severity_level1 == 'critical' ? 'selected' : '' }}>Critical</option>
                                                        </select>
                                                        <input type="hidden" name="severity_level1" value="{{ $data->severity_level1 }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="qa_comments">QA/CQA Initial Review Comments @if($data->stage == 3) <span class="text-danger">*</span>@endif</label>
                                                    <textarea name="qa_review_comments" {{ $data->stage == 3  ? 'required' : 'readonly' }} {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>{{ $review->qa_comments }}</textarea>
                                                </div>
                                            </div>

                                            <!-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="related_records">Related Records</label>
                                                    <select{{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}
                                                        multiple id="related_records" name="related_records[]"
                                                        placeholder="Select Reference Records" data-search="false"
                                                        data-silent-initial-value-set="true">
                                                        @foreach ($pre as $prix)
                                                            <option value="{{ $prix->id }}" {{ in_array($prix->id, explode(',', $data->related_records)) ? 'selected' : '' }}>
                                                                {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                            </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="col-12">
                                        <div class="group-input">
                                            <label for="related_records">Related Records</label>

                                            <select multiple name="related_records[]" placeholder="Select Reference Records"
                                                data-silent-initial-value-set="true" id="related_records"  {{ $data->stage == 0 || $data->stage == 13  ? 'disabled' : '' }}>

                                                 @if (!empty($relatedRecords))
                                                        @foreach ($relatedRecords as $records)
                                                            @php
                                                                $recordValue =
                                                                    Helpers::getDivisionName(
                                                                        $records->division_id ||
                                                                            $records->division ||
                                                                            $records->division_code ||
                                                                            $records->site_location_code,
                                                                    ) .
                                                                    '/' .
                                                                    $records->process_name .
                                                                    '/' .
                                                                    date('Y') .
                                                                    '/' .
                                                                    Helpers::recordFormat($records->record);

                                                                $selected = in_array(
                                                                    $recordValue,

                                                                    explode(',', $data->related_records),
                                                                )
                                                                    ? 'selected'
                                                                    : '';
                                                            @endphp
                                                            <option value="{{ $recordValue }}" {{ $selected }}>
                                                                {{ $recordValue }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_head">QA/CQA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_head">
                                                @if ($data->qa_head)
                                                    @foreach(json_decode($data->qa_head) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_qa_head[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 5 || $data->stage == 6 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'qa_head')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_qa_head" name="deleted_qa_head" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_qa_head');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>
                                        </div>

                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 20px">
                                            <span style="font-weight: bold; color: red;">Note: </span>
                                            <span>Please fill up both QA/CQA Review Tab and CFT Tab value to save the form.</span>
                                        </h3>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>



                                <div id="CCForm11" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">


                                            @php
                                                $data1 = DB::table('cc_cfts')
                                                    ->where('cc_id', $data->id)
                                                    ->first();
                                            @endphp

                                                <script>
                                                $(document).ready(function() {


                                                   @if($data1->RA_Review!=='yes')
                                                        $('.ra_review').hide();

                                                        $('[name="RA_Review"]').change(function() {
                                                            if ($(this).val() === 'yes') {

                                                                $('.ra_review').show();
                                                                $('.ra_review span').show();
                                                            } else {
                                                                $('.ra_review').hide();
                                                                $('.ra_review span').hide();
                                                            }
                                                        });
                                                     @endif
                                                    });
                                                </script>




                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 50,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('RA_Review');
                                                    var inputsToToggle = [];


                                                    var facilityNameInputs = document.getElementsByClassName('RA_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }


                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        var asteriskIcon = document.getElementById('asteriskRA');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>

                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 50,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp

                                        <div class="sub-head">
                                            Quality Assurance
                                        </div>

                                        <script>
                                            $(document).ready(function() {

                                                @if($data1->Quality_Assurance_Review!=='yes')
                                                $('.QualityAssurance').hide();

                                                $('[name="Quality_Assurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.QualityAssurance').show();
                                                        $('.QualityAssurance span').show();
                                                    } else {
                                                        $('.QualityAssurance').hide();
                                                        $('.QualityAssurance span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Assurance"> Quality Assurance  Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_Assurance_Review" id="Quality_Assurance_Review">
                                                        <option value="">-- Select --</option>
                                                       
                                                    <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value='yes'>Yes</option>
                                                      
                                                        <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'NA' || empty($data1->Quality_Assurance_Review)) selected @endif value='NA'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 26,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance notification">Quality Assurance Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="QualityAssurance_person"
                                                        class="QualityAssurance_person" id="QualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->QualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->QualityAssurance_person) && Auth::user()->name != $data1->QualityAssurance_person)) readonly @endif
                                                        name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance feedback">Quality Assurance Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote QualityAssurance_feedback" @if ($data->stage == 3 || (isset($data1->QualityAssurance_person) && Auth::user()->name != $data1->QualityAssurance_person)) readonly @endif
                                                        name="QualityAssurance_feedback" id="summernote-18" @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->QualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance attachment">Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Assurance_attachment">
                                                            @if ($data1->Quality_Assurance_attachment)
                                                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Quality_Assurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Completed By">Quality Assurance  Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->QualityAssurance_by }}"
                                                        name="QualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="QualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 QualityAssurance">
    <div class="group-input input-date">
        <label for="Quality Assurance Completed On">Quality Assurance  Review Completed On</label>
        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date -->
            <input type="text" id="QualityAssurance_on" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />

            <!-- Hidden date input for date selection -->
            <input readonly type="date" name="QualityAssurance_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                   class="hide-input"
                   oninput="handleDateInput(this, 'QualityAssurance_on')" />
        </div>
        @error('QualityAssurance_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Quality_Assurance_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Assurance">Quality Assurance  Review Required ?</label>
                                                    <select name="Quality_Assurance_Review" id="Quality_Assurance_Review"  disabled>
                                                        <option value="">-- Select --</option>

                                                        <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value='yes'>Yes</option>
                                                  
                                                      
                                                        <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'NA' || empty($data1->Quality_Assurance_Review)) selected @endif value='NA'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 26,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance notification">Quality Assurance Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="QualityAssurance_person" disabled id="QualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->QualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance feedback">Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="QualityAssurance_feedback" id="summernote-18">{{ $data1->QualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance feedback">Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="QualityAssurance_feedback" id="summernote-18">{{ $data1->QualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance attachment">Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Assurance_attachment">
                                                            @if ($data1->Quality_Assurance_attachment)
                                                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Quality_Assurance_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Completed By">Quality Assurance  Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->QualityAssurance_by }}"
                                                        name="QualityAssurance_by" id="QualityAssurance_by">


                                                </div>
                                            </div>



                                            <div class="col-lg-6 QualityAssurance">
    <div class="group-input input-date">
        <label for="Quality Assurance Completed On">Quality Assurance  Review Completed On</label>
        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date -->
            <input type="text" id="QualityAssurance_on" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />

            <!-- Hidden date input for date selection -->
            <input readonly type="date" name="QualityAssurance_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                   class="hide-input"
                   oninput="handleDateInput(this, 'QualityAssurance_on')" />
        </div>
        @error('QualityAssurance_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


                                        @endif


                                        <div class="sub-head">
                                            Production (Tablet/Capsule/Powder)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Production_Table_Review!=='yes')
                                                $('.productionTable').hide();

                                                $('[name="Production_Table_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.productionTable').show();
                                                        $('.productionTable span').show();
                                                    } else {
                                                        $('.productionTable').hide();
                                                        $('.productionTable span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Tablet"> Production Tablet/Capsule/Powder Review Required <span class="text-danger">*</span></label>
                                                    <select name="Production_Table_Review" id="Production_Table_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                     
                                                        <option @if ($data1->Production_Table_Review == 'NA' || empty($data1->Production_Table_Review)) selected @endif value='NA'>NA</option>  
                                                              
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person<span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Production_Table_Person"
                                                        class="Production_Table_Person" id="Production_Table_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet assessment">Impact Assessment(By Production (Tablet/Capsule/Powder))<span id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Table_Assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet feedback">Production Tablet/Capsule/Powder Feedback<span id="asteriskPT2"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Production_Table_Feedback" @if ($data->stage == 3 || (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif
                                                        name="Production_Table_Feedback" id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet attachment">Production Tablet/Capsule/Powder Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                            @if ($data1->Production_Table_Attachment)
                                                                @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Production_Table_Attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder Review Completed By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Table_By }}"
                                                        name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Table_By">


                                                </div>
                                            </div>

                                            <div class="col-6 mb-3 productionTable new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder Review Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Production_Table_On" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                <input readonly type="date" name="Production_Table_On"
                                                    min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Production_Table_On')" />
                                            </div>
                                            @error('Production_Table_On')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Production_Table_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Production_Table_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Table_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Table_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Tablet">Production Tablet/Capsule/Powder Review Required</label>
                                                    <select name="Production_Table_Review" disabled id="Production_Table_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Production_Table_Review == 'NA' || empty($data1->Production_Table_Review)) selected @endif value='NA'>NA</option>  
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Production_Table_Person" disabled id="Production_Table_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet assessment">Impact Assessment(By Production (Tablet/Capsule/Powder))
                                                            <!-- <span
                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet feedback">Production Tablet/Capsule/Powder Feedback
                                                                   </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet assessment">Impact Assessment(By Production (Tablet/Capsule/Powder))
                                                            <!-- <span
                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet feedback">Production Tablet/Capsule/Powder Feedback
                                                                               </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet attachment">Production Tablet/Capsule/Powder Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                            @if ($data1->Production_Table_Attachment)
                                                                @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Production_Table_Attachment[]" oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder Review Completed By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Table_By }}" name="Production_Table_By"
                                                        id="Production_Table_By">


                                                </div>
                                            </div>
                                            <div class="col-6 mb-3 productionTable new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder Review Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Production_Table_On" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                <input readonly type="date" name="Production_Table_On"
                                                    min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Production_Table_On')" />
                                            </div>
                                            @error('Production_Table_On')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        @endif


                                        <div class="sub-head">
                                            Production (Liquid/Ointment)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ProductionLiquid_Review!=='yes')
                                                $('.productionLiquid').hide();

                                                $('[name="ProductionLiquid_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.productionLiquid').show();
                                                        $('.productionLiquid span').show();
                                                    } else {
                                                        $('.productionLiquid').hide();
                                                        $('.productionLiquid span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Liquid">Production Liquid/Ointment Review Required? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_Review" id="ProductionLiquid_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                         <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option>  
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 52,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid/Ointment Person <span id="asteriskPT"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="ProductionLiquid_person"
                                                        class="ProductionLiquid_person" id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif class="summernote ProductionLiquid_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid feedback">Production Liquid/Ointment Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote ProductionLiquid_feedback"  @if ($data->stage == 3 || (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif
                                                        name="ProductionLiquid_feedback" id="summernote-18" @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid/Ointment Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ProductionLiquid_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid Completed By">Production Liquid/Ointment Review Completed By</label>
                                            <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                                name="ProductionLiquid_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                id="ProductionLiquid_by">


                                        </div>
                                    </div>

                                    <div class="col-lg-6 productionLiquid new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Liquid Completed On">Production Liquid/Ointment Review Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="ProductionLiquid_on" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                <input readonly type="date" name="ProductionLiquid_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                            </div>
                                            @error('ProductionLiquid_on')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('ProductionLiquid_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('ProductionLiquid_person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskPT');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Liquid">Production Liquid/Ointment Review Required?</label>
                                                    <select name="ProductionLiquid_Review" disabled id="ProductionLiquid_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option> 
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 52,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid/Ointment Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_person" disabled id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment) </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid feedback">Impact Assessment(By Production Liquid/Ointment)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid feedback">Production Liquid/Ointment Feedback </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid/Ointment Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="ProductionLiquid_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                 <div class="col-md-6 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid Completed By">Production Liquid/Ointment Review Completed By</label>
                                            <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                                name="ProductionLiquid_by" id="ProductionLiquid_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionLiquid new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Liquid Completed On">
                                            Production Liquid/Ointment Review Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="ProductionLiquid_on" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                <input readonly type="date" name="ProductionLiquid_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                            </div>
                                            @error('ProductionLiquid_on')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                        @endif




                                        <div class="sub-head">
                                            Production Injection
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Production_Injection_Review!=='yes')
                                                $('.productionInjection').hide();

                                                $('[name="Production_Injection_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.productionInjection').show();
                                                        $('.productionInjection span').show();
                                                    } else {
                                                        $('.productionInjection').hide();
                                                        $('.productionInjection span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Injection"> Production Injection Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Production_Injection_Review" id="Production_Injection_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option> 
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 53,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection notification">Production Injection Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Production_Injection_Person"
                                                        class="Production_Injection_Person" id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection assessment">Impact Assessment (By Production Injection) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Injection_Assessment"
                                                        @if ($data->stage == 3 || (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection feedback">Production Injection Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Production_Injection_Feedback" @if ($data->stage == 3 || (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif
                                                        name="Production_Injection_Feedback" id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection attachment">Production Injection Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Production_Injection_Attachment">
                                                            @if ($data1->Production_Injection_Attachment)
                                                                @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Production_Injection_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Production_Injection_Attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection Completed By">Production Injection Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Injection_By }}"
                                                        name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Injection_By">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionInjection">
    <div class="group-input">
        <label for="Production_Injection_On">Production Injection Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Production_Injection_On_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Production_Injection_On" name="Production_Injection_On"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Production_Injection_On)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Production_Injection_On_display')" />
        </div>

        @error('Production_Injection_On')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Production_Injection_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Production_Injection_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production Injection">Production Injection Review Required ?</label>
                                                    <select name="Production_Injection_Review" disabled id="Production_Injection_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 53,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection notification">Production Injection Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Production_Injection_Person" disabled id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection assessment">Impact Assessment (By Production Injection)
                                                            <!-- <span
                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection feedback">Production Injection Feedback
                                                                            </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection assessment">Impact Assessment (By Production Injection)
                                                            <!-- <span
                                                                                                                                            id="asteriskInvi12" style="display: none"
                                                                                                                                            class="text-danger">*</span> -->
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 productionInjection">
                                                    <div class="group-input">
                                                        <label for="Production Injection feedback">Production Injection Feedback
                                                          
                                                        </label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection attachment">Production Injection Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Production_Injection_Attachment">
                                                            @if ($data1->Production_Injection_Attachment)
                                                                @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Production_Injection_Attachment[]"
                                                                oninput="addMultipleFiles(this, 'Production_Injection_Attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection Completed By">Production Injection Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Injection_By }}"
                                                        name="Production_Injection_By" id="Production_Injection_By">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionInjection">
    <div class="group-input">
        <label for="Production_Injection_On">Production Injection Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Production_Injection_On_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Production_Injection_On" name="Production_Injection_On"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Production_Injection_On)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Production_Injection_On_display')" />
        </div>

        @error('Production_Injection_On')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif


                                        <div class="sub-head">
                                            Stores
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Store_Review!=='yes')
                                                $('.store').hide();

                                                $('[name="Store_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.store').show();
                                                        $('.store span').show();
                                                    } else {
                                                        $('.store').hide();
                                                        $('.store span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Store"> Stores Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Store_Review" id="Store_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 54,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Store_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Store_person"
                                                        class="Store_person" id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store assessment">Impact Assessment (By Store) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif class="summernote Store_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="store feedback">store Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Store_feedback" @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif
                                                        name="Store_feedback" id="summernote-18" @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Store_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Store_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Store_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 store">
    <div class="group-input">
        <label for="Store_on">Store Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Store_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Store_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Store_on" name="Store_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Store_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Store_on_display')" />
        </div>

        @error('Store_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Store_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Store_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Store">Stores Review Required ?</label>
                                                    <select name="Store_Review" disabled id="Store_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 54,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Store_person" disabled id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store feedback">Store Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store feedback">Store Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by" id="Store_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 store">
    <div class="group-input">
        <label for="Store_on">Store Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Store_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Store_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Store_on" name="Store_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Store_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Store_on_display')" />
        </div>

        @error('Store_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif




                                        <div class="sub-head">
                                            Quality Control
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Quality_review!=='yes')
                                                $('.qualityControl').hide();

                                                $('[name="Quality_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.qualityControl').show();
                                                        $('.qualityControl span').show();
                                                    } else {
                                                        $('.qualityControl').hide();
                                                        $('.qualityControl span').hide();
                                                    }
                                                });
                                                @endif

                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Control"> Quality Control Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_review" id="Quality_review_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 24,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Quality_Control_Person"
                                                        class="Quality_Control_Person" id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control assessment">Impact Assessment (By Quality Control) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control feedback">Quality Control Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Quality_Control_feedback" @if ($data->stage == 3 || (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif
                                                        name="Quality_Control_feedback" id="summernote-18" @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Quality_Control_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Quality_Control_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Quality_Control_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 qualityControl">
    <div class="group-input">
        <label for="Quality_Control_on">Quality Control Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Quality_Control_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Quality_Control_on" name="Quality_Control_on"
                   
                   value="{{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Quality_Control_on_display')" />
        </div>

        @error('Quality_Control_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Quality_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality Control">Quality Control Review Required ?</label>
                                                    <select name="Quality_review" disabled id="Quality_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 24,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Quality_Control_Person" disabled id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Impact Assessment (By Quality Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control feedback">Quality Control Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Impact Assessment (By Quality Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control feedback">Quality Control Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by" id="Quality_Control_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 qualityControl">
    <div class="group-input">
        <label for="Quality_Control_on">Quality Control Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Quality_Control_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Quality_Control_on" name="Quality_Control_on"
                   
                   value="{{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Quality_Control_on_display')" />
        </div>

        @error('Quality_Control_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif

                                        <div class="sub-head">
                                            Research & Development
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ResearchDevelopment_Review!=='yes')
                                                $('.researchDevelopment').hide();

                                                $('[name="ResearchDevelopment_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.researchDevelopment').show();
                                                        $('.researchDevelopment span').show();
                                                    } else {
                                                        $('.researchDevelopment').hide();
                                                        $('.researchDevelopment span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Research Development"> Research & Development Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 55,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research & Development Person <span id="asteriskPT"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="ResearchDevelopment_person"
                                                        class="ResearchDevelopment_person" id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development assessment">Impact Assessment (By Research &
                                                Development) <span id="asteriskPT1"
                                                    style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif class="summernote ResearchDevelopment_assessment"
                                                @if (
                                                    $data->stage == 3 ||
                                                        (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development feedback">Research & Development Feedback <span
                                                    id="asteriskPT2"
                                                    style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote ResearchDevelopment_feedback" @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif
                                                name="ResearchDevelopment_feedback" id="summernote-18" @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                        </div>
                                    </div> -->

                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research & Development Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ResearchDevelopment_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research & Development Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ResearchDevelopment_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 researchDevelopment">
    <div class="group-input">
        <label for="ResearchDevelopment_on">Research & Development Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="ResearchDevelopment_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->ResearchDevelopment_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'ResearchDevelopment_on_display')" />
        </div>

        @error('ResearchDevelopment_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ResearchDevelopment_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ResearchDevelopment_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Research Development">Research & Development Review Required ?</label>
                                                    <select name="ResearchDevelopment_Review" disabled id="ResearchDevelopment_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 55,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research & Development Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_person" disabled id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Impact Assessment (By Research & Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development feedback">Research & Development Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Impact Assessment (By Research & Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development feedback">Research & Development Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research & Development Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="ResearchDevelopment_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research & Development Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by" id="StorResearchDevelopment_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 researchDevelopment">
    <div class="group-input">
        <label for="ResearchDevelopment_on">Research & Development Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="ResearchDevelopment_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->ResearchDevelopment_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'ResearchDevelopment_on_display')" />
        </div>

        @error('ResearchDevelopment_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif



                                        <div class="sub-head">
                                            Engineering
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Engineering_review!=='yes')
                                                $('.Engineering').hide();

                                                $('[name="Engineering_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Engineering').show();
                                                        $('.Engineering span').show();
                                                    } else {
                                                        $('.Engineering').hide();
                                                        $('.Engineering span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Engineering"> Engineering Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Engineering_review" id="Engineering_review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 25,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Engineering_person"
                                                        class="Engineering_person" id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering assessment">Impact Assessment (By Engineering) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_assessment"
                                                        @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering feedback">Engineering Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Engineering_feedback" @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif
                                                        name="Engineering_feedback" id="summernote-18" @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Engineering_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Engineering_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                                        name="Engineering_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Engineering_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Engineering">
    <div class="group-input">
        <label for="Engineering_on">Engineering Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Engineering_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Engineering_on" name="Engineering_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Engineering_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Engineering_on_display')" />
        </div>

        @error('Engineering_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Engineering_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Engineering">Engineering Review Required ?</label>
                                                    <select name="Engineering_review" disabled id="Engineering_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 25,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Engineering_person" disabled id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Impact Assessment (By Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering feedback">Engineering Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Impact Assessment (By Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering feedback">Engineering Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Engineering_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                                        name="Engineering_by" id="Engineering_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Engineering">
    <div class="group-input">
        <label for="Engineering_on">Engineering Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Engineering_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Engineering_on" name="Engineering_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Engineering_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Engineering_on_display')" />
        </div>

        @error('Engineering_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif




                                        <div class="sub-head">
                                            Human Resource
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Human_Resource_review!=='yes')
                                                $('.Human_Resource').hide();

                                                $('[name="Human_Resource_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Human_Resource').show();
                                                        $('.Human_Resource span').show();
                                                    } else {
                                                        $('.Human_Resource').hide();
                                                        $('.Human_Resource span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Human Resource"> Human Resource Review  Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Human_Resource_review" id="Human_Resource_review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 31,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Human_Resource_person"
                                                        class="Human_Resource_person" id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource assessment">Impact Assessment (By Human Resource) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource feedback">Human Resource Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Human_Resource_feedback" @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif
                                                        name="Human_Resource_feedback" id="summernote-18" @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Human_Resource_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Human_Resource_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Human_Resource_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Human_Resource">
    <div class="group-input">
        <label for="Human_Resource_on">Human Resource Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Human_Resource_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Human_Resource_on" name="Human_Resource_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Human_Resource_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Human_Resource_on_display')" />
        </div>

        @error('Human_Resource_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Human_Resource_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Human Resource">Human Resource Review Required ?</label>
                                                    <select name="Human_Resource_review" disabled id="Human_Resource_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 31,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Human_Resource_person" disabled id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Impact Assessment (By Human Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource feedback">Human Resource Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Impact Assessment (By Human Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource feedback">Human Resource Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Human_Resource_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by" id="Human_Resource_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Human_Resource">
    <div class="group-input">
        <label for="Human_Resource_on">Human Resource Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Human_Resource_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Human_Resource_on" name="Human_Resource_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Human_Resource_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Human_Resource_on_display')" />
        </div>

        @error('Human_Resource_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif


                                        <div class="sub-head">
                                            Microbiology
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Microbiology_Review!=='yes')
                                                $('.Microbiology').hide();

                                                $('[name="Microbiology_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Microbiology').show();
                                                        $('.Microbiology span').show();
                                                    } else {
                                                        $('.Microbiology').hide();
                                                        $('.Microbiology span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology"> Microbiology Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Microbiology_Review" id="Microbiology_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 56,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Microbiology_person"
                                                        class="Microbiology_person" id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology assessment">Impact Assessment (By Microbiology) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif class="summernote Microbiology_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology feedback">Microbiology Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Microbiology_feedback" @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif
                                                        name="Microbiology_feedback" id="summernote-18" @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Microbiology_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Microbiology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Review Completed 
                                                         By</label>
                                                    <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                                        name="Microbiology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Microbiology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Microbiology">
    <div class="group-input">
        <label for="Microbiology_on">Microbiology Review Completed  On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Microbiology_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Microbiology_on" name="Microbiology_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Microbiology_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Microbiology_on_display')" />
        </div>

        @error('Microbiology_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Microbiology_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Microbiology_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology">Microbiology Review Required ?</label>
                                                    <select name="Microbiology_Review" disabled id="Microbiology_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 56,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Microbiology_person" disabled id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                                        name="Microbiology_by" id="Microbiology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Microbiology">
    <div class="group-input">
        <label for="Microbiology_on">Microbiology Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Microbiology_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Microbiology_on" name="Microbiology_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Microbiology_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Microbiology_on_display')" />
        </div>

        @error('Microbiology_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif



                                        <div class="sub-head">
                                            Regulatory Affair
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->RegulatoryAffair_Review!=='yes')
                                                $('.RegulatoryAffair').hide();

                                                $('[name="RegulatoryAffair_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.RegulatoryAffair').show();
                                                        $('.RegulatoryAffair span').show();
                                                    } else {
                                                        $('.RegulatoryAffair').hide();
                                                        $('.RegulatoryAffair span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RegulatoryAffair"> Regulatory Affair Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 57,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person <span id="asteriskPT"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="RegulatoryAffair_person"
                                                        class="RegulatoryAffair_person" id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif class="summernote RegulatoryAffair_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair feedback">Regulatory Affair Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote RegulatoryAffair_feedback" @if ($data->stage == 3 || (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif
                                                        name="RegulatoryAffair_feedback" id="summernote-18" @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="RegulatoryAffair_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 RegulatoryAffair">
    <div class="group-input">
        <label for="RegulatoryAffair_on">Regulatory Affair Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="RegulatoryAffair_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="RegulatoryAffair_on" name="RegulatoryAffair_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->RegulatoryAffair_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'RegulatoryAffair_on_display')" />
        </div>

        @error('RegulatoryAffair_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('RegulatoryAffair_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('RegulatoryAffair_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair">Regulatory Affair Review Required ?</label>
                                                    <select name="RegulatoryAffair_Review" disabled id="RegulatoryAffair_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 57,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_person" disabled id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="RegulatoryAffair_attachment[]"
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by" id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 RegulatoryAffair">
    <div class="group-input">
        <label for="RegulatoryAffair_on">Regulatory Affair Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="RegulatoryAffair_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="RegulatoryAffair_on" name="RegulatoryAffair_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->RegulatoryAffair_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'RegulatoryAffair_on_display')" />
        </div>

        @error('RegulatoryAffair_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif



                                        <div class="sub-head">
                                            Corporate Quality Assurance
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->CorporateQualityAssurance_Review!=='yes')
                                                $('.CQA').hide();

                                                $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.CQA').show();
                                                        $('.CQA span').show();
                                                    } else {
                                                        $('.CQA').hide();
                                                        $('.CQA span').hide();
                                                    }
                                                });

                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance"> Corporate Quality Assurance Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_Review" id="CorporateQualityAssurance_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate Quality Assurance Person <span id="asteriskPT"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="CorporateQualityAssurance_person"
                                                        class="CorporateQualityAssurance_person" id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote CorporateQualityAssurance_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->CorporateQualityAssurance_person) && Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote CorporateQualityAssurance_feedback" @if ($data->stage == 3 || (isset($data1->CorporateQualityAssurance_person) && Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                        name="CorporateQualityAssurance_feedback" id="summernote-18" @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="CorporateQualityAssurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 CQA">
                                            <div class="group-input">
                                                <label for="CorporateQualityAssurance_on">Corporate Quality Assurance Review Completed On</label>

                                                <div class="calenderauditee">
                                                    <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
                                                    <input type="text" id="CorporateQualityAssurance_on_display" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />

                                                    <!-- Hidden date input for date selection -->
                                                    <input type="date" id="CorporateQualityAssurance_on" name="CorporateQualityAssurance_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ \Carbon\Carbon::parse($data1->CorporateQualityAssurance_on)->format('Y-m-d') }}"
                                                        class="hide-input"
                                                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="handleDateInput(this, 'CorporateQualityAssurance_on_display')" />
                                                </div>

                                                @error('CorporateQualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('CorporateQualityAssurance_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('CorporateQualityAssurance_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance">Corporate Quality Assurance Review Required ?</label>
                                                    <select name="CorporateQualityAssurance_Review" disabled id="CorporateQualityAssurance_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate Quality Assurance Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_person" disabled id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by" id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 CQA">
                                            <div class="group-input">
                                                <label for="CorporateQualityAssurance_on">Corporate Quality Assurance Review Completed On</label>

                                                <div class="calenderauditee">
                                                    <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
                                                    <input type="text" id="CorporateQualityAssurance_on_display" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />

                                                    <!-- Hidden date input for date selection -->
                                                    <input type="date" id="CorporateQualityAssurance_on" name="CorporateQualityAssurance_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ \Carbon\Carbon::parse($data1->CorporateQualityAssurance_on)->format('Y-m-d') }}"
                                                        class="hide-input"
                                                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="handleDateInput(this, 'CorporateQualityAssurance_on_display')" />
                                                </div>

                                                @error('CorporateQualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @endif



                                        <div class="sub-head">
                                            Safety
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Environment_Health_review!=='yes')
                                                $('.safety').hide();

                                                $('[name="Environment_Health_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.safety').show();
                                                        $('.safety span').show();
                                                    } else {
                                                        $('.safety').hide();
                                                        $('.safety span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Safety"> Safety Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Environment_Health_review" id="Environment_Health_review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Environment_Health_Safety_person"
                                                        class="Environment_Health_Safety_person" id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety assessment">Impact Assessment (By Safety) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="summernote Health_Safety_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Environment_Health_Safety_person) && Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety feedback">Safety Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Health_Safety_feedback" @if ($data->stage == 3 || (isset($data1->Environment_Health_Safety_person) && Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif
                                                        name="Health_Safety_feedback" id="summernote-18" @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Environment_Health_Safety_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 safety">
    <div class="group-input">
        <label for="Environment_Health_Safety_on">Safety Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Environment_Health_Safety_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Environment_Health_Safety_on" name="Environment_Health_Safety_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Environment_Health_Safety_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Environment_Health_Safety_on_display')" />
        </div>

        @error('Environment_Health_Safety_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Environment_Health_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Safety">Safety Review Required ?</label>
                                                    <select name="Environment_Health_review" disabled id="Environment_Health_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Environment_Health_Safety_person" disabled id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety feedback">Safety Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety feedback">Safety Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Environment_Health_Safety_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 safety">
    <div class="group-input">
        <label for="Environment_Health_Safety_on">Safety Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Environment_Health_Safety_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Environment_Health_Safety_on" name="Environment_Health_Safety_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Environment_Health_Safety_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Environment_Health_Safety_on_display')" />
        </div>

        @error('Environment_Health_Safety_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif




                                        <div class="sub-head">
                                            Information Technology
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Information_Technology_review!=='yes')
                                                $('.Information_Technology').hide();

                                                $('[name="Information_Technology_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Information_Technology').show();
                                                        $('.Information_Technology span').show();
                                                    } else {
                                                        $('.Information_Technology').hide();
                                                        $('.Information_Technology span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Information_Technology"> Information Technology Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Information_Technology_review" id="Information_Technology_review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Information_Technology_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Information_Technology_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Information_Technology_review == 'NA' || empty($data1->Information_Technology_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 32,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology notification">Information Technology Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Information_Technology_person"
                                                        class="Information_Technology_person" id="Information_Technology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Information_Technology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology assessment">Impact Assessment (By Information Technology) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Information_Technology_person) && Auth::user()->name != $data1->Information_Technology_person)) readonly @endif name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology feedback">Information Technology Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Information_Technology_feedback" @if ($data->stage == 3 || (isset($data1->Information_Technology_person) && Auth::user()->name != $data1->Information_Technology_person)) readonly @endif
                                                        name="Information_Technology_feedback" id="summernote-18" @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Information_Technology_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology attachment">Information Technology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Information_Technology_attachment">
                                                            @if ($data1->Information_Technology_attachment)
                                                                @foreach (json_decode($data1->Information_Technology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Information_Technology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Information_Technology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology Completed By">Information Technology Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Information_Technology_by }}"
                                                        name="Information_Technology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Information_Technology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Information_Technology">
    <div class="group-input">
        <label for="Information_Technology_on">Information Technology Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Information_Technology_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Information_Technology_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Information_Technology_on" name="Information_Technology_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Information_Technology_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Information_Technology_on_display')" />
        </div>

        @error('Information_Technology_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Information_Technology_review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Information_Technology_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Information Technology">Information Technology Review Required ?</label>
                                                    <select name="Information_Technology_review" disabled id="Information_Technology_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Information_Technology_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Information_Technology_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Information_Technology_review == 'NA' || empty($data1->Information_Technology_review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 32,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology notification">Information Technology Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Information_Technology_person" disabled id="Information_Technology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Information_Technology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology assessment">Impact Assessment (By Information Technology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology feedback">Information Technology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Information_Technology_feedback" id="summernote-18">{{ $data1->Information_Technology_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology assessment">Impact Assessment (By Information Technology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology feedback">Information Technology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Information_Technology_feedback" id="summernote-18">{{ $data1->Information_Technology_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology attachment">Information Technology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Information_Technology_attachment">
                                                            @if ($data1->Information_Technology_attachment)
                                                                @foreach (json_decode($data1->Information_Technology_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Information_Technology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Information_Technology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology Completed By">Information Technology Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Information_Technology_by }}"
                                                        name="Information_Technology_by" id="Information_Technology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Information_Technology">
    <div class="group-input">
        <label for="Information_Technology_on">Information Technology Review Completed On</label>

        <div class="calenderauditee">
            <!-- Read-only text input to display formatted date (e.g., DD-MMM-YYYY) -->
            <input type="text" id="Information_Technology_on_display" readonly
                   placeholder="DD-MMM-YYYY"
                   value="{{ Helpers::getdateFormat($data1->Information_Technology_on) }}" />

            <!-- Hidden date input for date selection -->
            <input type="date" id="Information_Technology_on" name="Information_Technology_on"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   value="{{ \Carbon\Carbon::parse($data1->Information_Technology_on)->format('Y-m-d') }}"
                   class="hide-input"
                   {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                   oninput="handleDateInput(this, 'Information_Technology_on_display')" />
        </div>

        @error('Information_Technology_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                        @endif



                                        <div class="sub-head">
                                            Contract Giver
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ContractGiver_Review!=='yes')
                                                $('.ContractGiver').hide();

                                                $('[name="ContractGiver_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.ContractGiver').show();
                                                        $('.ContractGiver span').show();
                                                    } else {
                                                        $('.ContractGiver').hide();
                                                        $('.ContractGiver span').hide();
                                                    }
                                                });
                                                @endif
                                            });
                                        </script>
                                        @php
                                            $data1 = DB::table('cc_cfts')
                                                ->where('cc_id', $data->id)
                                                ->first();
                                        @endphp

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Contract Giver"> Contract Giver Review Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ContractGiver_Review" id="ContractGiver_Review" required>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ContractGiver_Review == 'NA' || empty($data1->ContractGiver_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 60,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 ContractGiver">
                                        <div class="group-input">
                                            <label for="Contract Giver notification">Contract Giver comment update by<span
                                                    id="asteriskPT" class="text-danger">*</span></label>
                                            <select @if ($data->stage == 4) disabled @endif
                                                name="ContractGiver_person" id="ContractGiver_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}"
                                                        @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                            <div class="col-md-12 mb-3 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver assessment">Impact Assessment (By Contract Giver) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif class="summernote ContractGiver_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver feedback">Contract Giver Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote ContractGiver_feedback" @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                                        name="ContractGiver_feedback" id="summernote-18" @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ContractGiver_feedback }}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ContractGiver_attachment">
                                                            @if ($data1->ContractGiver_attachment)
                                                                @foreach (json_decode($data1->ContractGiver_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ContractGiver_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 ContractGiver">
                                        <div class="group-input">
                                            <label for="Contract Giver Completed By">Contract Giver Review Completed By</label>
                                            <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                                name="ContractGiver_by" id="ContractGiver_by">
                                        </div>
                                    </div>


                                    <div class="col-6 ContractGiver new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Contract Giver Completed On">Contract Giver Review
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="ContractGiver_on" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                                <input readonly type="date" name="ContractGiver_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'ContractGiver_on')" />
                                            </div>
                                            @error('ContractGiver_on')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ContractGiver_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ContractGiver_person');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }
                                                    // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                    // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    //     inputsToToggle.push(facilityNameInputs[i]);
                                                    // }

                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';
                                                        console.log(this.value, isRequired, 'value');

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskPT');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                        @else
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Contract Giver">Contract Giver Review Required ?</label>
                                                    <select name="ContractGiver_Review" disabled id="ContractGiver_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                            <option @if ($data1->ContractGiver_Review == 'NA' || empty($data1->ContractGiver_Review)) selected @endif value='NA'>NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 60,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 ContractGiver">
                                        <div class="group-input">
                                            <label for="Contract Giver notification">Contract Giver Person <span
                                                    id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select @if ($data->stage == 4) disabled @endif
                                                name="ContractGiver_person" id="ContractGiver_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}"
                                                        @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                                    </div>
                                                </div> -->
                                            @endif
                                            <div class="col-12 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ContractGiver_attachment">
                                                            @if ($data1->ContractGiver_attachment)
                                                                @foreach (json_decode($data1->ContractGiver_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                                class="fa fa-eye text-primary"
                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="ContractGiver_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 ContractGiver">
                                        <div class="group-input">
                                            <label for="Contract Giver Completed By">Contract Giver Review Completed By</label>
                                            <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                                name="ContractGiver_by" id="ContractGiver_by">
                                        </div>
                                    </div>


                                    <div class="col-6 ContractGiver new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Contract Giver Completed On">Contract Giver Review
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="ContractGiver_on" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                                <input readonly type="date" name="ContractGiver_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'ContractGiver_on')" />
                                            </div>
                                            @error('ContractGiver_on')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    @endif



                                    



                                <div class="sub-head">
                                    Other's 1 (Additional Person Review From Departments If Required)
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1">Other's 1 Review Required?</label>
                                        <select name="Other1_review" id="Other1_review"  @if ($data->stage != 3) disabled @endif >
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                            <option value="NA" @if ($data1->Other1_review == 'NA' || empty($data1->Other1_review)) selected @endif>NA</option>

                                            
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 other1_reviews">
                                    <div class="group-input">
                                        <label for="Person1">Other's 1 Person
                                            <span id="asterisko1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>
                                        <select name="Other1_person" id="Other1_person" @if ($data->stage != 3) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other1_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 3)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other1_person" value="{{ $data1->Other1_person }}">
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Department1">Other's 1 Department
                                            <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="Other1_Department_person" id="Other1_Department_person"
                                            value="{{ old('Other1_Department_person', $data1->Other1_Department_person) }}"
                                            @if ($data->stage != 3) readonly @endif>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                        <textarea class="tiny" name="Other1_assessment" id="summernote-41" @if ($data->stage != 4 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Feedback1">Other's 1 Feedback</label>
                                        <textarea class="tiny" name="Other1_feedback" id="summernote-42" @if ($data->stage != 4 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div> -->



                                <div class="col-12 other1_reviews ">
                                        <div class="group-input">
                                            <label for="Audit Attachments">Other's 1 Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Other1_attachment">
                                                    @if ($data1->Other1_attachment)
                                                        @foreach (json_decode($data1->Other1_attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="Other1_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-6 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" id="Other1_by" value="{{ $data1->Other1_by }}" disabled>
                                    </div>
                                </div>
                                <div class="col-6 other1_reviews new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Others 1 Completed On">Others 1 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other1_on" readonly placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Other1_on) }}" />
                                            <input readonly type="date" name="Other1_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other1_on')" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Add your script to handle the show/hide functionality -->
                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on the selected value
                                        function toggleFieldsBasedOnSelection(value) {
                                            if (value === 'yes') {
                                                $('.other1_reviews').show(); // Show all fields
                                                $('.other1_reviews span').show(); // Show asterisks
                                                $('input[name="Other1_person"]').prop('required', true);
                                                $('select[name="Other1_Department_person"]').prop('required', true);
                                                $('#asterisko1').show();
                                                $('#asteriskod1').show();
                                            } else {
                                                $('.other1_reviews').hide(); // Hide all fields
                                                $('.other1_reviews span').hide(); // Hide asterisks
                                                $('input[name="Other1_person"]').prop('required', false);
                                                $('select[name="Other1_Department_person"]').prop('required', false);
                                                $('#asterisko1').hide();
                                                $('#asteriskod1').hide();
                                            }
                                        }

                                        // On page load
                                        toggleFieldsBasedOnSelection($('[name="Other1_review"]').val());

                                        // On dropdown value change
                                        $('[name="Other1_review"]').change(function () {
                                            toggleFieldsBasedOnSelection($(this).val());
                                        });
                                    });
                                </script>
{{--
                            @else
                                <div class="sub-head">
                                    Other's 1 (Additional Person Review From Departments If Required)
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1">Other's 1 Review Required?</label>
                                        <select disabled name="Other1_review" id="Other1_review">
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                            <option value="NA" @if ($data1->Other1_review == 'NA' || empty($data1->Other1_review)) selected @endif>NA</option>

                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-12 Other1_reviews">
                                    <div class="group-input">
                                        <label for="Department1">Other's 1 Department
                                            <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                        </label>
                                        <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                        <textarea disabled class="tiny" name="Other1_assessment" id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback1">Other's 1 Feedback</label>
                                        <textarea disabled class="tiny" name="Other1_feedback" id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}" name="Other1_by" id="Other1_by">
                                    </div>
                                </div>


                            @endif --}}
                            <div class="sub-head">
                                Other's 2 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleFieldsBasedOnSelection(value) {
                                        if (value === 'yes') {
                                            $('.Other2_reviews').show();
                                            $('.Other2_reviews span').show();
                                            $('input[name="Other2_person"]').prop('required', true);
                                            $('select[name="Other2_Department_person"]').prop('required', true);
                                            $('#asterisko2').show();
                                            $('#asteriskod2').show();
                                        } else {
                                            $('.Other2_reviews').hide();
                                            $('.Other2_reviews span').hide();
                                            $('input[name="Other2_person"]').prop('required', false);
                                            $('select[name="Other2_Department_person"]').prop('required', false);
                                            $('#asterisko2').hide();
                                            $('#asteriskod2').hide();
                                        }
                                    }

                                    // On page load
                                    toggleFieldsBasedOnSelection($('[name="Other2_review"]').val());

                                    // On dropdown value change
                                    $('[name="Other2_review"]').change(function () {
                                        toggleFieldsBasedOnSelection($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review2"> Other's 2 Review Required?</label>
                                    <select name="Other2_review" id="Other2_review"  @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other2_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other2_review == 'no') selected @endif>No</option>
                                        <option value="NA" @if ($data1->Other2_review == 'NA' || empty($data1->Other2_review)) selected @endif>NA</option>

                                    </select>
                                </div>
                            </div>

                            @php
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_divisions_id' => $data->division_id])
                                    ->select('user_id')
                                    ->distinct()
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp

                            <div class="col-lg-6 Other2_reviews">
                                <div class="group-input">
                                    <label for="Person2">Other's 2 Person <span id="asterisko2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                    <select name="Other2_person" id="Other2_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other2_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other2_person" value="{{ $data1->Other2_person }}">
                                @endif
                                </div>
                            </div>



                            <div class="col-lg-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Department2">Other's 2 Department <span id="asteriskod2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>

                                    <input type="text" name="Other2_Department_person" id="Other2_Department_person"
                                            value="{{ old('Other2_Department_person', $data1->Other2_Department_person) }}"
                                            @if ($data->stage != 3) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                    <textarea class="tiny" name="Other2_Assessment" id="summernote-43" @if ($data->stage != 4 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Feedback2"> Other's 2 Feedback</label>
                                    <textarea class="tiny" name="Other2_feedback" id="summernote-44" @if ($data->stage != 4 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 2 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other2_attachment">
                                            @if ($data1->Other2_attachment)
                                                @foreach (json_decode($data1->Other2_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other2_attachment[]" oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By2">Other's 2 Review Completed By</label>
                                    <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 Other2_reviews new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Others 2 Completed On">Others 2 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other2_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other2_on) }}" />
                                        <input readonly type="date" name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other2_on')" />
                                    </div>
                                    @error('Other2_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="sub-head">
                                Other's 3 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleFieldsBasedOnSelection(value) {
                                        if (value === 'yes') {
                                            $('.Other3_reviews').show();
                                            $('.Other3_reviews span').show();
                                            $('input[name="Other3_person"]').prop('required', true);
                                            $('select[name="Other3_Department_person"]').prop('required', true);
                                            $('#asterisko3').show();
                                            $('#asteriskod3').show();
                                        } else {
                                            $('.Other3_reviews').hide();
                                            $('.Other3_reviews span').hide();
                                            $('input[name="Other3_person"]').prop('required', false);
                                            $('select[name="Other3_Department_person"]').prop('required', false);
                                            $('#asterisko3').hide();
                                            $('#asteriskod3').hide();
                                        }
                                    }

                                    // On page load
                                    toggleFieldsBasedOnSelection($('[name="Other3_review"]').val());

                                    // On dropdown value change
                                    $('[name="Other3_review"]').change(function () {
                                        toggleFieldsBasedOnSelection($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review3">Other's 3 Review Required?</label>
                                    <select name="Other3_review" id="Other3_review"  @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other3_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other3_review == 'no') selected @endif>No</option>
                                        <option value="NA" @if ($data1->Other3_review == 'NA' || empty($data1->Other3_review)) selected @endif>NA</option>

                                    </select>
                                </div>
                            </div>

                            @php
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_divisions_id' => $data->division_id])
                                    ->select('user_id')
                                    ->distinct()
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp

                            <div class="col-lg-6 Other3_reviews">
                                <div class="group-input">
                                    <label for="Person3">Other's 3 Person <span id="asterisko3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                    <select name="Other3_person" id="Other3_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other3_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other3_person" value="{{ $data1->Other3_person }}">
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-12 Other3_reviews">
                                <div class="group-input">
                                    <label for="Department3">Other's 3 Department <span id="asteriskod3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                      
                                    <input type="text" name="Other3_Department_person" id="Other3_Department_person"
                                            value="{{ old('Other3_Department_person', $data1->Other3_Department_person) }}"
                                            @if ($data->stage != 3) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment14">Impact Assessment (By Other's 3)</label>
                                    <textarea class="tiny" name="Other3_Assessment" id="summernote-45" @if ($data->stage != 4 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="feedback3">Other's 3 Feedback</label>
                                    <textarea class="tiny" name="Other3_feedback" id="summernote-46" @if ($data->stage != 4 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other3_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 3 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other3_attachment">
                                            @if ($data1->Other3_attachment)
                                                @foreach (json_decode($data1->Other3_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other3_attachment[]" oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Other's 3 Review Completed By</label>
                                    <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other3_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 3 Completed On">Others 3 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other3_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other3_on) }}" />
                                        <input readonly type="date" name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other3_on')" />
                                    </div>
                                    @error('Other3_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Other's 4 Section -->
                            <div class="sub-head">
                                Other's 4 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleOther4Fields(value) {
                                        if (value === 'yes') {
                                            $('.Other4_reviews').show();
                                            $('.Other4_reviews span').show();
                                            $('#Other4_person').prop('required', true);
                                            // $('#hod_Other4_person').prop('required', true);
                                            $('#Other4_Department_person').prop('required', true);
                                            $('#asterisko4').show();
                                        } else {
                                            $('.Other4_reviews').hide();
                                            $('.Other4_reviews span').hide();
                                            $('#Other4_person').prop('required', false);
                                            // $('#hod_Other4_person').prop('required', false);
                                            $('#Other4_Department_person').prop('required', false);
                                            $('#asterisko4').hide();
                                        }
                                    }

                                    // Initial toggle on page load
                                    toggleOther4Fields($('[name="Other4_review"]').val());

                                    // Toggle on value change
                                    $('[name="Other4_review"]').change(function () {
                                        toggleOther4Fields($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review4">Other's 4 Review Required?</label>
                                    <select name="Other4_review" id="Other4_review" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other4_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other4_review == 'no') selected @endif>No</option>
                                        <option value="NA" @if ($data1->Other4_review == 'NA' || empty($data1->Other4_review)) selected @endif>NA</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 Other4_reviews">
                                <div class="group-input">
                                    <label for="Person4">Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                    <select name="Other4_person" id="Other4_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other4_person" value="{{ $data1->Other4_person }}">
                                @endif
                                </div>
                            </div>

                            {{-- <div class="col-lg-6 Other4_reviews">
                                <div class="group-input">
                                    <label for="hod_Other4_person">HOD Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                    <select name="hod_Other4_person" id="hod_Other4_person" @if ($data->stage == 4) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data5->hod_Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Department4">Other's 4 Department <span id="asteriskod4" class="text-danger">*</span></label>

                                    <input type="text" name="Other4_Department_person" id="Other4_Department_person"
                                            value="{{ old('Other4_Department_person', $data1->Other4_Department_person) }}"
                                            @if ($data->stage != 3) readonly @endif>

                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Description of Action Item15">Impact Assessment (By Other's 4)</label>
                                    <textarea class="tiny" name="Other4_Assessment" id="summernote-47"
                                        @if ($data->stage != 4 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="feedback4">Other's 4 Status of Action Item</label>
                                    <textarea class="tiny" name="Other4_feedback" id="summernote-48"
                                        @if ($data->stage != 4 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 4 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other4_attachment">
                                            @if ($data1->Other4_attachment)
                                                @foreach (json_decode($data1->Other4_attachment) as $file)
                                                    <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other4_attachment[]" oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By4">Other's 4 Review Completed By</label>
                                    <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other4_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 4 Completed On">Others 4 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other4_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other4_on) }}" />
                                        <input readonly type="date" name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other4_on')" />
                                    </div>
                                    @error('Other4_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Other's 5 Section -->

                            <div class="sub-head">
                                Other's 5 (Additional Person Review From Departments If Required)
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on "yes" value
                                    function toggleOther5Fields(value) {
                                        if (value === 'yes') {
                                            $('.Other5_reviews').show();
                                            $('.Other5_reviews span').show();
                                            $('#Other5_person').prop('required', true);
                                            // $('#hod_Other5_person').prop('required', true);
                                            $('#Other5_Department_person').prop('required', true);
                                            $('#asterisko5').show();
                                        } else {
                                            $('.Other5_reviews').hide();
                                            $('.Other5_reviews span').hide();
                                            $('#Other5_person').prop('required', false);
                                            // $('#hod_Other5_person').prop('required', false);
                                            $('#Other5_Department_person').prop('required', false);
                                            $('#asterisko5').hide();
                                        }
                                    }

                                    // Initial toggle on page load
                                    toggleOther5Fields($('[name="Other5_review"]').val());

                                    // Toggle on value change
                                    $('[name="Other5_review"]').change(function () {
                                        toggleOther5Fields($(this).val());
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review5">Other's 5 Review Required?</label>
                                    <select name="Other5_review" id="Other5_review" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other5_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other5_review == 'no') selected @endif>No</option>
                                        <option value="NA" @if ($data1->Other5_review == 'NA' || empty($data1->Other5_review)) selected @endif>NA</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 Other5_reviews">
                                <div class="group-input">
                                    <label for="Person5">Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                    <select name="Other5_person" id="Other5_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other5_person" value="{{ $data1->Other5_person }}">
                                @endif
                                </div>
                            </div>

                            {{-- <div class="col-lg-6 Other5_reviews">
                                <div class="group-input">
                                    <label for="hod_Other5_person">HOD Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                    <select name="hod_Other5_person" id="hod_Other5_person" @if ($data->stage == 4) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data5->hod_Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Department5">Other's 5 Department <span id="asteriskod5" class="text-danger">*</span></label>

                                    <input type="text" name="Other5_Department_person" id="Other5_Department_person"
                                            value="{{ old('Other5_Department_person', $data1->Other5_Department_person) }}"
                                            @if ($data->stage != 3) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="Description of Action Item16">Impact Assessment (By Other's 5)</label>
                                    <textarea class="tiny" name="Other5_Assessment" id="summernote-49"
                                    @if ($data->stage != 4 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_Assessment }}</textarea>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Other's 5 Status of Action Item</label>
                                    <textarea class="tiny" name="Other5_feedback" id="summernote-50"
                                    @if ($data->stage != 4 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_feedback }}</textarea>
                                </div>
                            </div> -->

                            <div class="col-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments">Other's 5 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Other5_attachment">
                                            @if ($data1->Other5_attachment)
                                                @foreach (json_decode($data1->Other5_attachment) as $file)
                                                    <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other5_attachment[]" oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By5">Other's 5 Review Completed By</label>
                                    <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>
                                </div>
                            </div>

                            <div class="col-6 new-date-data-field Other5_reviews">
                                <div class="group-input input-date">
                                    <label for="Others 5 Completed On">Others 5 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other5_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other5_on) }}" />
                                        <input readonly type="date" name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other5_on')" />
                                    </div>
                                    @error('Other5_on')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            
                              
                                    </div>
                                    <div class="button-block">
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                            id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                            style="align-items: center;">
                                            <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Save
                                        </button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="ChangeNextButton" class="nextButton">Next</button>

                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                Exit </a> </button>
                                    </div>
                                </div>
                                </div>

                                <div id="CCForm14" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="sub-head">
                                                QA/CQA Final Review
                                            </div>
                                         {{--
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA notification">RA Approval required
                                                        @if($data->stage==5) <span class="text-danger">*</span>@endif
                                                    </label>
                                                    <select name="RA_data_person" class="RA_data_person" id="RA_head_required"
                                                            {{ $data->stage == 8 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                        <option value="">--Select--</option>
                                                        <option @if ($cc_cfts->RA_data_person == 'Yes') selected @endif value="Yes">Yes</option>
                                                        <option @if ($cc_cfts->RA_data_person == 'No') selected @endif value="No">No</option>
                                                    </select>
                                                 </div>
                                            </div>
                                           --}}


                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA_head_required">RA Approval required
                                                        @if($data->stage == 5)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>

                                                    @if($data->stage == 5)
                                                        <select name="RA_data_person" class="RA_data_person" id="RA_head_required" {{ $data->stage == 5 ? 'required' : '' }}>
                                                            <option value="">--Select--</option>
                                                            <option value="Yes" {{ $cc_cfts->RA_data_person == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $cc_cfts->RA_data_person == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                       
                                                    @else

                                                    <select name="RA_data_person_display" class="RA_data_person" id="RA_head_required" disabled>
                                                            <option value="">--Select--</option>
                                                            <option value="Yes" {{ $cc_cfts->RA_data_person == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $cc_cfts->RA_data_person == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                        <input type="hidden" name="RA_data_person" value="{{ $cc_cfts->RA_data_person }}">
                                                        
                                                    @endif
                                                </div>
                                            </div>
                                        <script>
                                        $(document).ready(function () {
                                            // Initially check dropdown and textarea
                                            toggleElements($('#RA_head_required').val(), $('#ra_tab_comments').val());

                                            // On dropdown value change
                                            $('#RA_head_required').change(function () {
                                                toggleElements($(this).val(), $('#ra_tab_comments').val());
                                            });

                                            // On textarea input
                                            $('#ra_tab_comments').on('input', function () {
                                                toggleElements($('#RA_head_required').val(), $(this).val());
                                            });

                                            // Function to toggle button visibility and stage
                                            function toggleElements(selectValue, textareaValue) {
                                                if (selectValue === 'Yes') {
                                                    // Show the button if textarea is empty
                                                    if (textareaValue.trim() === '') {
                                                        $('#approval-button').show();
                                                    } else {
                                                        $('#approval-button').hide();
                                                    }

                                                    // Show the stage
                                                    $('#pending-ra-stage').show();
                                                } else {
                                                    // Hide the button and stage when "No" is selected
                                                    $('#approval-button').hide();
                                                    $('#pending-ra-stage').hide();
                                                }
                                            }
                                        });
                                        </script>
                                        {{--   
                                             <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA notification">QA/CQA Head Approval Person
                                                    @if($data->stage==5) <span class="text-danger">*</span>@endif
                                                    <select name="QA_CQA_person" class="QA_CQA_person"
                                                        id="QA_CQA_person"  {{ $data->stage == 8 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $cc_cfts->QA_CQA_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                         --}}



                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="QA_CQA_person">QA/CQA Head Approval Person
                                                        @if($data->stage == 5)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>

                                                    @if($data->stage == 5)
                                                        <select name="QA_CQA_person" class="QA_CQA_person" id="QA_CQA_person" {{ $data->stage == 5 ? 'required' : '' }}>
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->name }}" {{ $user->name == $cc_cfts->QA_CQA_person ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    
                                                    @else

                                                    <select name="QA_CQA_person_display" class="QA_CQA_person" id="QA_CQA_person" disabled>
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->name }}" {{ $user->name == $cc_cfts->QA_CQA_person ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                    </select>
                                                    <input type="hidden" name="QA_CQA_person" value="{{ $cc_cfts->QA_CQA_person }}">
                                                    
                                                       
                                                    @endif
                                                </div>
                                            </div>




                                            

                                        <div class="group-input">
                                            <label for="qa-eval-comments">QA/CQA Final Review Comments
                                                @if($data->stage==5) <span class="text-danger">*</span>@endif
                                            </label>
                                            <textarea name="qa_final_comments"{{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 6 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }} >{{ $cc_cfts->qa_final_comments }}</textarea>
                                        </div>


                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_final_attach">QA/CQA Final Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_final_attach">
                                                @if ($cc_cfts->qa_final_attach)
                                                    @foreach(json_decode($cc_cfts->qa_final_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_qa_final_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_final_attach[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 6 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}
                                                    oninput="addMultipleFiles(this, 'qa_final_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_qa_final_attach" name="deleted_qa_final_attach" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_qa_final_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>
                                    </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->


                                <div id="CCForm15" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            RA
                                        </div>
                                        <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="RA feedback">RA Approval Comment<span class="text-danger">*</span></label>
                                            @if($data->stage==6) @endif
                                            <div>
                                                <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                            </div>
                                            <textarea class="tiny" name="ra_tab_comments" id="ra_tab_comments"
                                                {{ $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }} >{{ isset($data1->ra_tab_comments) ? $data1->ra_tab_comments : '' }}</textarea>
                                        </div>
                                    </div>

                                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="RA_attachment_second">RA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="RA_attachment_second">
                                                @if ($cc_cfts->RA_attachment_second)
                                                    @foreach(json_decode($cc_cfts->RA_attachment_second) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_RA_attachment_second[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="RA_attachment_second[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 7 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'RA_attachment_second')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_RA_attachment_second" name="deleted_RA_attachment_second" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_RA_attachment_second');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>

                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                <!-- </div>     -->

                                <div id="CCForm17" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                        QA/CQA Head / Designee Approval
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments">QA/CQA Head / Designee Approval Comments
                                            @if($data->stage == 7) <span class="text-danger">*</span>@endif</label>
                                            <textarea name="qa_cqa_comments"  {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}>{{$cc_cfts->qa_cqa_comments}}</textarea>
                                        </div>


                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_cqa_attach">QA/CQA Head / Designee Approval Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_cqa_attach">
                                                @if ($cc_cfts->qa_cqa_attach)
                                                    @foreach(json_decode($cc_cfts->qa_cqa_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_qa_cqa_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_cqa_attach[]"
                                                    {{  $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'qa_cqa_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_qa_cqa_attach" name="deleted_qa_cqa_attach" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_qa_cqa_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>

                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div id="CCForm4" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Evaluation Detail
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments">QA Evaluation Comments</label>
                                            <textarea name="qa_eval_comments" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>{{ $evaluation->qa_eval_comments }}</textarea>
                                        </div>

                                        @if ($data1->qa_final_attach)
                                            @foreach (json_decode($data1->qa_final_attach) as $file)
                                                <input id="productionInjectionAttachmentFile-{{ $loop->index }}" type="hidden"
                                                    name="existinProductionInjectionFile[{{ $loop->index }}]"
                                                    value="{{ $file }}">
                                            @endforeach
                                        @endif
                                        <div class="group-input">
                                            <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_eval_attach">
                                                    @if ($evaluation->qa_eval_attach)
                                                        @foreach (json_decode($evaluation->qa_eval_attach) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-remove-id="existinProductionLiquidFile-{{ $loop->index }}"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="qa_eval_attach[]"
                                                        oninput="addMultipleFiles(this, 'qa_eval_attach')" multiple {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                </div>                                 -->



                                <div id="CCForm5" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Initiator Update
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments"> Initiator Update Comments @if($data->stage == 9) <span class="text-danger">*</span>@endif</label>
                                            <textarea name="intial_update_comments" {{  $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}>{{$cc_cfts->intial_update_comments}}</textarea>
                                        </div>


                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="intial_update_attach">Initiator Update Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="intial_update_attach">
                                                @if ($cc_cfts->intial_update_attach)
                                                    @foreach(json_decode($cc_cfts->intial_update_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_intial_update_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="intial_update_attach[]"
                                                    {{  $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 10 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'intial_update_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_intial_update_attach" name="deleted_intial_update_attach" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_intial_update_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>


                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm6" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                        HOD Final Review
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments">HOD Final Review Comments @if($data->stage == 10) <span class="text-danger">*</span>@endif</label>
                                            <textarea name="hod_final_review_comment" {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }} >{{$cc_cfts->hod_final_review_comment}}</textarea>
                                        </div>


                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="hod_final_review_attach">HOD Final Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="hod_final_review_attach">
                                                @if ($cc_cfts->hod_final_review_attach)
                                                    @foreach(json_decode($cc_cfts->hod_final_review_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_hod_final_review_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="hod_final_review_attach[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 11 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'hod_final_review_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_hod_final_review_attach" name="deleted_hod_final_review_attach" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_hod_final_review_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>


                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm16" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="group-input">
                                            <label for="qa-appro-comments">Implementation Verification by QA/CQA Comments @if($data->stage == 11) <span class="text-danger">*</span>@endif</label>
                                            <textarea name="implementation_verification_comments" {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}>{{ $cc_cfts->implementation_verification_comments }}</textarea>
                                        </div>
                                        <div class="group-input">
                                            <label for="feedback">Training Feedback</label>
                                            <textarea name="feedback" {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}>{{ $approcomments->feedback }}</textarea>
                                        </div>

                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="tran_attach">Implementation Verification Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="tran_attach">
                                                @if ($approcomments->tran_attach)
                                                    @foreach(json_decode($approcomments->tran_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_tran_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="tran_attach[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 12 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'tran_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_tran_attach" name="deleted_tran_attach" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_tran_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>



                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm9" class="inner-block cctabcontent">
                                    <div class="inner-block-content">


                                        {{-- <div class="group-input">
                                            <label for="risk-assessment">
                                                Affected Documents<button type="button" name="ann" id="addAffectedDoc" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <table class="table table-bordered" id="afftectedDocTable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Affected Documents</th>
                                                        <th>Document Name</th>
                                                        <th>Document No.</th>
                                                        <th>Version No.</th>
                                                        <th>Implementation Date</th>
                                                        <th>New Document No.</th>
                                                        <th>New Version No.</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($affetctedDocumnetGrid && is_array($affetctedDocumnetGrid))
                                                        @foreach ($affetctedDocumnetGrid as $gridData)
                                                        <tr>
                                                            <td>
                                                                <input disabled type="text" name="affectedDocuments[{{ $loop->index }}][serial]"
                                                                    value="{{ $loop->index + 1 }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="afftectedDoc" type="text" name="affectedDocuments[{{ $loop->index }}][afftectedDoc]"
                                                                    value="{{ isset($gridData['afftectedDoc']) ? $gridData['afftectedDoc'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="documentName" type="text" name="affectedDocuments[{{ $loop->index }}][documentName]"
                                                                    value="{{ isset($gridData['documentName']) ? $gridData['documentName'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="documentNumber" type="number" name="affectedDocuments[{{ $loop->index }}][documentNumber]"
                                                                    value="{{ isset($gridData['documentNumber']) ? $gridData['documentNumber'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="versionNumber" type="text" name="affectedDocuments[{{ $loop->index }}][versionNumber]"
                                                                    value="{{ isset($gridData['versionNumber']) ? $gridData['versionNumber'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="implimentationDate" type="date"
                                                                    name="affectedDocuments[{{ $loop->index }}][implimentationDate]"
                                                                    value="{{ isset($gridData['implimentationDate']) ? $gridData['implimentationDate'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="newDocumentNumber" type="text"
                                                                    name="affectedDocuments[{{ $loop->index }}][newDocumentNumber]"
                                                                    value="{{ isset($gridData['newDocumentNumber']) ? $gridData['newDocumentNumber'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input class="newVersionNumber" type="text" name="affectedDocuments[{{ $loop->index }}][newVersionNumber]"
                                                                    value="{{ isset($gridData['newVersionNumber']) ? $gridData['newVersionNumber'] : '' }}" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td><button type="button" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>Remove</button></td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td><input type="text" name="affectedDocuments[0][serial]" value="1" readonly></td>
                                                            <td><input type="text" name="affectedDocuments[0][afftectedDoc]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][documentName]"></td>
                                                            <td><input type="number" name="affectedDocuments[0][documentNumber]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][versionNumber]"></td>
                                                            <td><input type="date" name="affectedDocuments[0][implimentationDate]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][newDocumentNumber]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][newVersionNumber]"></td>
                                                            <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div> --}}


                                <div class="group-input">
                                    <label for="qa-closure-comments">QA/CQA Closure Comments @if($data->stage == 12) <span class="text-danger">*</span>@endif</label>
                                    <textarea name="qa_closure_comments" {{$data->stage == 1 || $data->stage == 2 ||$data->stage == 3 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 0 || $data->stage == 13 ? 'readonly' : '' }}>{{ $closure->qa_closure_comments }}</textarea>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="effect_check">
                                            Effectiveness check required
                                            @if($data->stage == 12)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>

                                        @if($data->stage == 12)
                                            <select name="effect_check" class="effect_check" id="effect_check" required>
                                                <option value="">--Select--</option>
                                                <option value="Yes" {{ $cc_cfts->effect_check == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ $cc_cfts->effect_check == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        @else
                                            <select name="effect_check_display" class="effect_check" id="effect_check" disabled>
                                                <option value="">--Select--</option>
                                                <option value="Yes" {{ $cc_cfts->effect_check == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ $cc_cfts->effect_check == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            <input type="hidden" name="effect_check" value="{{ $cc_cfts->effect_check }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_list">List Of Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attach_list">
                                                @if ($closure->attach_list)
                                                    @foreach(json_decode($closure->attach_list) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_attach_list[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attach_list[]"
                                                    {{ $data->stage == 1 || $data->stage == 2 ||$data->stage == 4 ||$data->stage == 4 || $data->stage == 5 ||$data->stage == 6 || $data->stage == 8  || $data->stage == 9 || $data->stage == 10 || $data->stage == 11 || $data->stage == 0 || $data->stage == 13 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'attach_list')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_attach_list" name="deleted_attach_list" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_attach_list');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>
                            <!-- <div class="sub-head">
                                                    Effectiveness Check Information
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="group-input">
                                                            <label for="effective-check">Effectivess Check Required?</label>
                                                            <select name="effective_check" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                                <option value="">-- Select --</option>
                                                                <option {{ $closure->effective_check == 'yes' ? 'selected' : '' }}
                                                                    value="yes">Yes</option>
                                                                <option {{ $closure->effective_check == 'no' ? 'selected' : '' }}
                                                                    value="no">No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 new-date-data-field">
                                                        <div class="group-input input-date">
                                                            <label for="effective-check-date">Effectiveness Check Creation Date</label>
                                                           <div class="calenderauditee">
                                                                  <input type="text"  id="effective_check_date"  readonly value="{{ Helpers::getdateFormat($data->effective_check_date) }}"
                                                                   name="effective_check_date"  placeholder="DD-MMM-YYYY" />
                                                                  <input type="date" name="effective_check_date" value="{{ $data->effective_check_date }}"  class="hide-input"
                                                                   oninput="handleDateInput(this, 'effective_check_date')"/ {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                     </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="group-input">
                                                            <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                            <select name="Effectiveness_checker" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>
                                                                <option value="">Enter Your Selection Here</option>
                                                                @foreach ($users as $datas)
    <option {{ $info->Effectiveness_checker == $datas->id ? 'selected' : '' }}
                                                                         value="{{ $datas->id }}">{{ $datas->name }}
                                                                    </option>
    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="group-input">
                                                            <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                            <textarea name="effective_check_plan" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}>{{ $data->effective_check_plan }}</textarea>
                                                        </div>
                                                    </div> -->
                            <!-- <div class="col-12 sub-head">
                                Extension Justification
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <!-- <label for="due_date_extension">Due Date Extension
                                        Justification</label>
                                    <textarea name="due_date_extension" {{ $data->stage == 0 || $data->stage == 8 || $data->stage == 13 ? 'disabled' : '' }}> {{ $due_date_extension }}</textarea> -->
                                </div>
                                 
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                        </button>
                    </div>
                </div>
            </div>
                                        </div>
            @php
                $product = DB::table('products')->get();
                $material = DB::table('materials')->get();
            @endphp

            <div id="CCForm10" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="row">
                        <div class="sub-head">Submit</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="submit by">Submit By :-</label>
                                <div class="">{{ $data->submit_by ?? 'Not Applicable'  }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="submit on">Submit On :-</label>
                                <div class="">{{ $data->submit_on ?? 'Not Applicable'  }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                <label for="submit comment">Submit Comment :-</label>
                                <div class="">{{ $data->submit_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>

                        <div class="sub-head">HOD Assessment Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">HOD Assessment Complete By :-</label>
                                <div class="">{{ $data->hod_review_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">HOD Assessment Complete On :-</label>
                                <div class="">{{ $data->hod_review_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">HOD Assessment Complete Comment :-</label>
                                <div class="">{{ $data->hod_review_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>






                        <div class="sub-head">Cancel</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">Cancel By :-</label>
                                <div class="">{{ $data->cancelled_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">Cancel On :-</label>
                                <div class="">{{ $data->cancelled_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">Cancel Comment :-</label>
                                <div class="">{{ $data->cancelled_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>



                        {{--  <div class="sub-head">Sent to Initiator (From HOD)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">Initiator Complete By :-</label>
                                <div class="static">{{ $data->hod_to_initiator_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">Initiator Complete On :-</label>
                                <div class="static">{{ $data->hod_to_initiator_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">Initiator Comment :-</label>
                                <div class="">{{ $data->hod_to_initiator_comment }}</div>
                            </div>
                        </div>  --}}


                        <div class="sub-head">QA/CQA Initial Assessment Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Initial Review Complete By">QA/CQA Initial Assessment Complete By :-</label>
                                <div class="">{{ $data->QA_initial_review_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Initial Review Complete On">QA/CQA Initial Assessment Complete On :-</label>
                                <div class="">{{ $data->QA_initial_review_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                <label for="QA Initial Review Comments">QA/CQA Initial Review Comment:-</label>
                                <div class="">{{ $data->QA_initial_review_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>

                        {{--  <div class="sub-head">Sent to HOD (From QA Initial)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">HOD Complete By :-</label>
                                <div class="static">{{ $data->QA_initialTo_HOD_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">HOD Complete On :-</label>
                                <div class="static">{{ $data->QA_initialTo_HOD_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">HOD Comments :-</label>
                                <div class="">{{ $data->QA_initialTo_HOD_comment }}</div>
                            </div>
                        </div>  --}}

                        <div class="sub-head">CFT Assessment Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete By">CFT Assessment Complete By :-</label>
                                <div class="">{{ $data->pending_RA_review_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete On">CFT Assessment Complete On :-</label>
                                <div class="">{{ $data->pending_RA_review_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="CFT Review Comments">CFT Assessment Complete Comment :-</label>
                                <div class="">{{ $data->pending_RA_review_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>


                        {{--  <div class="sub-head">Sent to QA Initial (From CFT)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">QA Initial Complete By :-</label>
                                <div class="static">{{ $data->cft_to_qaInitial_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">QA Initial Complete On :-</label>
                                <div class="static">{{ $data->cft_to_qaInitial_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">QA Initial Comments :-</label>
                                <div class="">{{ $data->cft_to_qaInitial_comment }}</div>
                            </div>
                        </div>  --}}

                        <div class="sub-head">RA Approval Required</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete By">RA Approval Required By :-</label>
                                <div class="">{{ $data->RA_review_required_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete On">RA Approval Required On :-</label>
                                <div class="">{{ $data->RA_review_required_on  ?? 'Not Applicable'}}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="CFT Review Comments">RA Approval Required Comment :-</label>
                                <div class="">{{ $data->RA_review_required_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>




                        <div class="sub-head">RA Approval Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete By">RA Approval Complete By :-</label>
                                <div class="">{{ $data->RA_review_completed_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete On">RA Approval Complete On :-</label>
                                <div class="">{{ $data->RA_review_completed_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="CFT Review Comments"> RA Approval Comment :-</label>
                                <div class="">{{ $data->RA_review_completed_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>



                        <div class="sub-head"> QA/CQA Final Review Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By"> QA/CQA Final Review Complete By :-</label>
                                <div class="">{{ $data->QA_final_review_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On"> QA/CQAFinal Review Complete On :-</label>
                                <div class="">{{ $data->QA_final_review_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments"> QA/CQA Final Review Comment :-</label>
                                <div class="">{{ $data->QA_final_review_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>



                        <div class="sub-head"> Approved </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By">  Approved  By :-</label>
                                <div class="">{{ $data->approved_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On">  Approved  On :-</label>
                                <div class="">{{ $data->approved_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments"> Approved Comment :-</label>
                                <div class="">{{ $data->approved_comment  ?? 'Not Applicable'}}</div>
                            </div>
                        </div>


                        <div class="sub-head"> Rejected </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">Rejected By :-</label>
                                <div class="">{{ $data->Training_complete_by ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">Rejected On :-</label>
                                <div class="">{{ $data->Training_complete_on ?? 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">Rejected Comment :-</label>
                                <div class="">{{ $data->Training_complete_comment ?? 'Not Applicable' }}</div>
                            </div>
                        </div>



                        @php
                        $commnetData = DB::table('change_control_comments')->where('cc_id', $data->id)->first();
                    @endphp

                    <div class="sub-head">Initiator Updated Completed</div>

                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete By">Initiator Updated Completed By :-</label>
                            <div class="">
                                {{ isset($commnetData->initiator_update_complete_by) ? $commnetData->initiator_update_complete_by : 'Not Applicable' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete On">Initiator Updated Completed On :-</label>
                            <div class="">
                                {{ isset($commnetData->initiator_update_complete_on) ? $commnetData->initiator_update_complete_on : 'Not Applicable' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; padding:5px;">
                            <label for="QA Final Review Comments">Initiator Updated Completed Comment :-</label>
                            <div class="">
                                {{ isset($commnetData->initiator_update_complete_comment) ? $commnetData->initiator_update_complete_comment : 'Not Applicable' }}
                            </div>
                        </div>
                    </div>



                        <div class="sub-head">HOD Final Review Complete
                        </div>
                   <div class="col-lg-3">
                       <div class="group-input">
                           <label for="QA Final Review Complete By">  HOD Final Review Complete  By :-</label>
                           <div class="">{{ $data->closure_approved_by ?? 'Not Applicable'}}</div>
                       </div>
                   </div>
                   <div class="col-lg-3">
                       <div class="group-input">
                           <label for="QA Final Review Complete On">  HOD Final Review Complete  On :-</label>
                           <div class="">{{ $data->closure_approved_on ?? 'Not Applicable' }}</div>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                           <label for="QA Final Review Comments"> HOD Final Review Complete Comment :-</label>
                           <div class="">{{ $data->closure_approved_comment ?? 'Not Applicable' }}</div>
                       </div>
                   </div>


                        <div class="sub-head">Send For Final QA/CQA Head Approval
                            </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By">Send For Final QA/CQA Head Approval By :-</label>
                                <div class="">{{ isset($commnetData->send_for_final_qa_head_approval) ? $commnetData->send_for_final_qa_head_approval: 'Not Applicable' }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On">Send For Final QA/CQA Head Approval On :-</label>
                                <div class="">{{isset($commnetData->send_for_final_qa_head_approval_on) ?$commnetData->send_for_final_qa_head_approval_on :'Not Applicable'}}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments">Send For Final QA/CQA Head Approval Comment :-</label>
                                <div class="">{{ isset($commnetData->send_for_final_qa_head_approval_comment) ? $commnetData->send_for_final_qa_head_approval_comment :'Not Applicable' }}</div>
                            </div>
                        </div>


                        <div class="sub-head">Closure Approved

                        </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete By">Closure Approved By :-</label>
                            <div class="">
                                {{ isset($commnetData->closure_approved_by) ? $commnetData->closure_approved_by : 'Not Applicable' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete On">Closure Approved On :-</label>
                            <div class="">{{  isset($commnetData->closure_approved_on) ? $commnetData->closure_approved_on : 'Not Applicable'}}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                            <label for="QA Final Review Comments">Closure Approved Comment :-</label>
                            <div class="">{{ isset($commnetData->closure_approved_comment) ?$commnetData->closure_approved_comment :'Not Applicable' }}</div>
                        </div>
                    </div>


                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                        </button>
                    </div>
                </div>
            </div>



        </div>
        </form>
    </div>
    </div>

    </div>
    </div>
    </div>


    <div class="modal fade" id="child-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('extension_child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">

                            <!-- <label for="major">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                        <input type="hidden" name="parent_name" value="Change_control">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                    </label> -->
                            <label for="major">
                                <input type="radio" name="child_type" value="documents">
                                New Document
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/send-cc', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comments">
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

    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_submit') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('divisions')->get();
                            @endphp
                            @foreach ($division as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button>
                            @endforeach

                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        <button id="submit-division">Cancel</button>
                        <button id="submit-division" type="submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


            <div class="modal fade" id="effectiveness-check-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('CC-effectiveness-check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="CC">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <input type="radio" name="child_type" value="effectiveness_check">
                                        Effectiveness Check
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
                <form action="{{ url('rcms/child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            @if($data->stage == 3)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="RCA">
                                    RCA
                                </label>
                            @endif    
                            
                                @if(Helpers::getChildData($data->id, 'CC') < 3)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label>
                                @endif
                         
                            @if($data->stage == 5)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Capa">
                                    CAPA
                                </label>
                                <!-- @if(Helpers::getChildData($data->id, 'CC') < 3)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label>
                                @endif -->
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Action-Item">
                                    Action Item
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


    <!-- modal for stage 9 child-modal-stage_8 start-->

    <div class="modal fade" id="child-modal-stage_8">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ url('rcms/child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            @if($data->stage == 9)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="RCA">
                                    RCA
                                </label>
                            </div>


                            <div>
                                @if(Helpers::getChildData($data->id, 'CC') < 3)
                                    <label for="minor">
                                        <input type="radio" name="revision" id="minor" value="Extension">
                                        Extension
                                    </label>
                                @endif    
                            </div>


                            @endif
                            @if($data->stage == 9)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Capa">
                                    CAPA
                                </label>

                            </div>
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





    <!-- modal for stage 9 child-modal-stage_8 End-->




    <div class="modal fade" id="child_effective_ness" tabindex="-1" aria-labelledby="child_effective_nessLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="child_effective_nessLabel">Child</h4>
                </div>
                <form action="{{ url('rcms/child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            @if($data->stage == 13)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Effective-Check">
                                    Effectiveness Check
                                </label>
                            </div>


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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const effectCheck = document.getElementById('effect_check');
        const childButton = document.getElementById('childButton');
        const childModal = new bootstrap.Modal(document.getElementById('child_effective_ness'));

        // Function to handle showing the modal and button
        function handleEffectCheck() {
            if (effectCheck.value === 'Yes') {
                // Show the child button if "Yes" is selected
                childButton.style.display = 'inline-block';
                childModal.show(); // Automatically show the modal if Yes is selected
            } else {
                // Hide the child button if "No" is selected
                childButton.style.display = 'none';
                childModal.hide(); // Ensure the modal is hidden if No is selected
            }
        }

        // Listen for changes in the dropdown
        effectCheck.addEventListener('change', handleEffectCheck);

        // Run the function once on page load to handle any pre-selected values
        handleEffectCheck();
    });
</script>


    <!-- /************ Open State Modal ***********/ -->
    <div class="modal fade" id="opened-state-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-initiator', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Open State Modal ***********/ -->

    <!-- /************ Initial QA Modal ***********/ -->
    <div class="modal fade" id="initalQA-review-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-initialQA', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Initial QA Modal ***********/ -->

    <!-- /************ Sent to QA Head Approval Modal ***********/ -->
    <div class="modal fade" id="qa-head-approval">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-qa-approval', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" class="form-control" name="comments">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Sent to QA Head Approval Modal ***********/ -->
    <div class="modal fade" id="send-reject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-reject', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Sent to Post Implementation Modal ***********/ -->
    <div class="modal fade" id="send-post-implementation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-post-implementation', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" class="form-control" name="comments">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Sent to Post Implementation Modal ***********/ -->


    <!-- /************ HOD Modal ***********/ -->
    <div class="modal fade" id="hod-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-hod', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ HOD Modal ***********/ -->


    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-rejection-field', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comments" required>
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

    <div class="modal fade" id="cft-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-cft-field', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comments">
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
    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-cancel', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comments">
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


    <style>
        #productTable,
        #materialTable {
            display: none;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentStage = document.getElementById('stage').value;

            if (currentStage > 2)
            {
                const RA_Review = document.getElementById('RA_Review').value;
                const qualityAssurnce = document.getElementById('Quality_Assurance_Review').value;
                const Production_Table_Review = document.getElementById('Production_Table_Review').value;
            const ProductionLiquid_Review = document.getElementById('ProductionLiquid_Review').value;
            const Production_Injection_Review = document.getElementById('Production_Injection_Review').value;
            const Store_Review = document.getElementById('Store_Review').value;
            const Quality_review = document.getElementById('Quality_review').value;
            const ResearchDevelopment_Review = document.getElementById('ResearchDevelopment_Review').value;
            const Engineering_review = document.getElementById('Engineering_review').value;
            const Human_Resource_review = document.getElementById('Human_Resource_review').value;
            const Microbiology_Review = document.getElementById('Microbiology_Review').value;
            const RegulatoryAffair_Review = document.getElementById('RegulatoryAffair_Review').value;
            const CorporateQualityAssurance_Review = document.getElementById('CorporateQualityAssurance_Review').value;
            const Environment_Health_review = document.getElementById('Environment_Health_review').value;
            const Information_Technology_review = document.getElementById('Information_Technology_review').value;
            const ContractGiver_Review = document.getElementById('ContractGiver_Review').value;


            function updateFieldAttributes() {
                if (currentStage == 3) {
                    RA_Review.required = true;
                    qualityAssurnce.required = true;
                    Production_Table_Review.required = true;
                    ProductionLiquid_Review.required = true;
                    Production_Injection_Review.required = true;
                    Store_Review.required = true;
                    Quality_review.required = true;
                    ResearchDevelopment_Review.required = true;
                    Engineering_review.required = true;
                    Human_Resource_review.required = true;
                    Microbiology_Review.required = true;
                    RegulatoryAffair_Review.required = true;
                    CorporateQualityAssurance_Review.required = true;
                    Environment_Health_review.required = true;
                    Information_Technology_review.required = true;
                    ContractGiver_Review.required = true;

                    RA_Review.disabled = false;
                    qualityAssurnce.disabled = false;
                    Production_Table_Review.disabled = false;
                    ProductionLiquid_Review.disabled = false;
                    Production_Injection_Review.disabled = false;
                    Store_Review.disabled = false;
                    Quality_review.disabled = false;
                    ResearchDevelopment_Review.disabled = false;
                    Engineering_review.disabled = false;
                    Human_Resource_review.disabled = false;
                    Microbiology_Review.disabled = false;
                    RegulatoryAffair_Review.disabled = false;
                    CorporateQualityAssurance_Review.disabled = false;
                    Environment_Health_review.disabled = false;
                    Information_Technology_review.disabled = false;
                    ContractGiver_Review.disabled = false;
                } else if (currentStage == 4) {
                    RA_Review.required = false;
                    qualityAssurnce.required = false;
                    Production_Table_Review.required = false;
                    ProductionLiquid_Review.required = false;
                    Production_Injection_Review.required = false;
                    Store_Review.required = false;
                    Quality_review.required = false;
                    ResearchDevelopment_Review.required = false;
                    Engineering_review.required = false;
                    Human_Resource_review.required = false;
                    Microbiology_Review.required = false;
                    RegulatoryAffair_Review.required = false;
                    CorporateQualityAssurance_Review.required = false;
                    Environment_Health_review.required = false;
                    Information_Technology_review.required = false;
                    ContractGiver_Review.required = false;

                    RA_Review.disabled = true;
                    qualityAssurnce.disabled = true;
                    Production_Table_Review.disabled = true;
                    ProductionLiquid_Review.disabled = true;
                    Production_Injection_Review.disabled = true;
                    Store_Review.disabled = true;
                    Quality_review.disabled = true;
                    ResearchDevelopment_Review.disabled = true;
                    Engineering_review.disabled = true;
                    Human_Resource_review.disabled = true;
                    Microbiology_Review.disabled = true;
                    RegulatoryAffair_Review.disabled = true;
                    CorporateQualityAssurance_Review.disabled = true;
                    Environment_Health_review.disabled = true;
                    Information_Technology_review.disabled = true;
                    ContractGiver_Review.disabled = true;
                }
            }
            updateFieldAttributes();
            document.getElementById('CCFormInput').addEventListener('submit', function () {
                if (currentStage == 4) {
                    RA_Review.disabled = false;
                    qualityAssurnce.disabled = false;
                    Production_Table_Review.disabled = false;
                    ProductionLiquid_Review.disabled = false;
                    Production_Injection_Review.disabled = false;
                    Store_Review.disabled = false;
                    Quality_review.disabled = false;
                    ResearchDevelopment_Review.disabled = false;
                    Engineering_review.disabled = false;
                    Human_Resource_review.disabled = false;
                    Microbiology_Review.disabled = false;
                    RegulatoryAffair_Review.disabled = false;
                    CorporateQualityAssurance_Review.disabled = false;
                    Environment_Health_review.disabled = false;
                    Information_Technology_review.disabled = false;
                    ContractGiver_Review.disabled = false;
                }
            });
            }
        });
    </script>

    <script>
        VirtualSelect.init({
            ele: '#related_records, #reviewer_person_value, #risk_assessment_related_record, #concerned_department_review'
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
        $(document).ready(function() {
            $('#add-input').click(function() {
                var lastInput = $('.bar input:last');
                var newInput = $('<input type="text" name="review_comment">');
                lastInput.after(newInput);
            });
        });
    </script>

    <!-- Example Blade View -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    @if (session()->has('errorMessages'))
        <script>
            // Create an array to hold all the error messages
            var errorMessages = @json(session()->get('errorMessages'));

            if (!Array.isArray(errorMessages)) {
                errorMessages = [errorMessages];
            }

            errorMessages = errorMessages.map(function(message) {
                return '<div class="seperator">==================================================</div>' +
                    '<div class="slogan"><div>This form was not submitted because of the following errors.</div><div>Please correct the errors and re-submit.</div></div>' +
                    '<div class="data">This Activity cannot be performed, as there are some blank required fields.</div>' +
                    '<div class="message">' + message + '</div>';
            });

            Swal.fire({
                icon: '',
                title: 'Connexo DMS Says',
                html: errorMessages.join(''),

                showCloseButton: true, // Display a close button
                customClass: {
                    title: 'my-title-class', // Add a custom CSS class to the title
                    htmlContainer: 'my-html-class text-danger', // Add a custom CSS class to the popup content
                },
                confirmButtonColor: '#3085d6', // Customize the confirm button color
            });
        </script>
        @php session()->forget('errorMessages'); @endphp
    @endif

    <script>
        $(document).ready(function() {
            var disableInputs = {{ $data->stage }}; // Replace with your condition

            if (disableInputs == 0 || disableInputs > 13) {
                // Disable all input fields within the form
                $('#CCFormInput :input:not(select)').prop('disabled', true);
                $('#CCFormInput select').prop('disabled', true);
            } else {
                // $('#CCFormInput :input').prop('disabled', false);
            }
        });
    </script>


    <script>
        const productSelect = document.getElementById('productSelect');
        const productTable = document.getElementById('productTable');
        const materialSelect = document.getElementById('materialSelect');
        const materialTable = document.getElementById('materialTable');

        materialSelect.addEventListener('change', function() {
            if (materialSelect.value === 'yes') {
                materialTable.style.display = 'block';
            } else {
                materialTable.style.display = 'none';
            }
        });

        productSelect.addEventListener('change', function() {
            if (productSelect.value === 'yes') {
                productTable.style.display = 'block';
            } else {
                productTable.style.display = 'none';
            }
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            // Event listener for the remove file button
                                            $(document).on('click', '.remove-file', function() {
                                                $(this).closest('.file-container').remove();
                                            });
                                        });
                                    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-file');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileName = this.getAttribute('data-file-name');
                const fileContainer = this.parentElement;

                // Hide the file container
                if (fileContainer) {
                    fileContainer.style.display = 'none';
                }
            });
        });
    });
    </script>

    <script>
        function calculateRiskAnalysis(selectElement) {
            // Get the row containing the changed select element
            let row = selectElement.closest('tr');

            // Get values from select elements within the row
            let R = parseFloat(document.getElementById('analysisR').value) || 0;
            let P = parseFloat(document.getElementById('analysisP').value) || 0;
            let N = parseFloat(document.getElementById('analysisN').value) || 0;

            // Perform the calculation
            let result = R * P * N;

            // Update the result field within the row
            document.getElementById('analysisRPN').value = result;
        }
    </script>
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        // JavaScript
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
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
        $(document).ready(function() {
            $('.remove-file').click(function() {
                const removeId = $(this).data('remove-id')
                console.log('removeId', removeId);
                $('#' + removeId).remove();
            })
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() { //DISABLED PAST DATES IN APPOINTMENT DATE
            var dateToday = new Date();
            var month = dateToday.getMonth() + 1;
            var day = dateToday.getDate();
            var year = dateToday.getFullYear();

            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;

            $('#dueDate').attr('min', maxDate);
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function setupPersonToDepartmentMapping(personSelectId, departmentInputId, usersData) {
            let personSelect = document.getElementById(personSelectId);
            let departmentInput = document.getElementById(departmentInputId);

            if (personSelect && departmentInput) {
                personSelect.addEventListener("change", function () {
                    let selectedPerson = personSelect.value;
                    departmentInput.value = usersData[selectedPerson] || ""; // Assign department or clear field
                });
            }
        }

        // Store user department data
        let userDepartments = {
            @foreach ($users as $user)
                "{{ $user->name }}": "{{ Helpers::getUsersDepartmentName($user->departmentid) }}",
            @endforeach
        };

        // Apply function to "Other's 1 Person" and "Other's 1 Department"
        setupPersonToDepartmentMapping("Other1_person", "Other1_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other2_person", "Other2_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other3_person", "Other3_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other4_person", "Other4_Department_person", userDepartments);
        setupPersonToDepartmentMapping("Other5_person", "Other5_Department_person", userDepartments);
    });
</script>



@endsection
