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
            / ERRATA
        </div>
    </div>


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
                        {{-- @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                            $cftUsers = DB::table('deviationcfts')
                                ->where(['deviation_id' => $data->id])
                                ->first();




                            // Define the column names
                            $columns = [
                                'Production_person',
                                'Warehouse_notification',
                                'Quality_Control_Person',
                                'QualityAssurance_person',
                                'Engineering_person',
                                'Analytical_Development_person',
                                'Kilo_Lab_person',
                                'Technology_transfer_person',
                                'Environment_Health_Safety_person',
                                'Human_Resource_person',
                                'Information_Technology_person',
                                'Project_management_person',
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
                            $cftCompleteUser = DB::table('deviationcfts_response')
                                ->whereIn('status', ['In-progress', 'Completed'])
                                ->where('deviation_id', $data->id)
                                ->where('cft_user_id', Auth::user()->id)
                                ->whereNull('deleted_at')
                                ->first();
                            // dd($cftCompleteUser);
                        @endphp --}}
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white" href="">
                                {{-- {{ url('DeviationAuditTrial', $data->id) }} --}}

                                {{-- add here url for auditTrail i.e. href="{{ url('CapaAuditTrial', $data->id) }}" --}}
                                Audit Trail </a> </button>

                        {{-- @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button>
                        {{-- @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button> --}}
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            HOD Review Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button>
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


                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- @if ($data->stage == 0) --}}
                    {{-- <div class="progress-bars ">
                        <div class="bg-danger">Closed-Cancelled</div>
                    </div> --}}
                    {{-- @else --}}
                    <div class="progress-bars d-flex" style="font-size: 15px;">
                        {{-- @if ($data->stage >= 1) --}}
                        <div class="active">Opened</div>
                        {{-- @else --}}
                        {{-- <div class="">Opened</div> --}}
                        {{-- @endif --}}

                        {{-- @if ($data->stage >= 2) --}}
                        {{-- <div class="active">HOD Review </div> --}}
                        {{-- @else --}}
                        <div class="">HOD Review</div>
                        {{-- @endif --}}

                        {{-- @if ($data->stage >= 3) --}}
                        {{-- <div class="active">QA Initial Review</div> --}}
                        {{-- @else --}}
                        <div class="">QA Initial Review</div>
                        {{-- @endif --}}

                        {{-- @if ($data->stage >= 4) --}}
                        {{-- <div class="active">CFT Review</div> --}}
                        {{-- @else --}}
                        <div class="">CFT Review</div>
                        {{-- @endif --}}


                        {{-- @if ($data->stage >= 5) --}}
                        {{-- <div class="active">QA Final Review</div> --}}
                        {{-- @else --}}
                        <div class="">QA Final Review</div>
                        {{-- @endif --}}
                        {{-- @if ($data->stage >= 6) --}}
                        {{-- <div class="active">QA Head/Manager Designee Approval</div> --}}
                        {{-- @else --}}
                        <div class="">QA Head/Manager Designee Approval</div>
                        {{-- @endif --}}
                        {{-- @if ($data->stage >= 7) --}}
                        {{-- <div class="active">Pending Initiator Update</div> --}}
                        {{-- @else --}}
                        <div class="">Pending Initiator Update</div>
                        {{-- @endif --}}
                        {{-- @if ($data->stage >= 8) --}}
                        {{-- <div class="active">QA Final Approval</div> --}}
                        {{-- @else --}}
                        <div class="">QA Final Approval</div>
                        {{-- @endif --}}
                        {{-- @if ($data->stage >= 9) --}}
                        {{-- <div class="bg-danger">Closed - Done</div> --}}
                        {{-- @else --}}
                        <div class="">Closed - Done</div>
                        {{-- @endif --}}
                        {{-- @endif --}}


                    </div>
                    {{-- @endif --}}
                    {{-- ---------------------------------------------------------------------------------------- --}}
                </div>
            </div>
            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD Review</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">CFT</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA Head Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Signatures</button>
            </div>

            <form action="{{ route('errata.update', $showdata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- -----------Tab-1------------ -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Parent Record Information</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Originator"><b>Record No</b></label>
                                        <input type="text" name="record_no" value="{{ $showdata->record_no }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Site/Location Code <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="location_code">
                                            <option value="{{ $showdata->location_code }}">{{ $showdata->location_code }}
                                            </option>
                                            <option value="001">001</option>
                                            <option value="002">002</option>
                                            <option value="003">003</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>ERRATA Date </b></label>
                                        <input type="date" name="errata_date" value="{{ $showdata->errata_date }}">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            ERRATA Issued By <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="errata_issued_by">
                                            <option value="{{ $showdata->errata_issued_by }}">
                                                {{ $showdata->errata_issued_by }}</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Initiated By <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="initiated_by">
                                            <option value="{{ $showdata->initiated_by }}">
                                                {{ $showdata->initiated_by }}</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="Department">
                                            <option value="{{ $showdata->Department }}">
                                                {{ $showdata->Department }}</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department Code<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="department_code">
                                            <option value="{{ $showdata->department_code }}">
                                                {{ $showdata->department_code }}</option>
                                            <option value="DC01">DC01</option>
                                            <option value="DC02">DC02</option>
                                            <option value="DC03">DC03</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Document Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="document_type">
                                            <option value="{{ $showdata->document_type }}">
                                                {{ $showdata->document_type }}</option>
                                            <option value="D01">D01</option>
                                            <option value="D02">D02</option>
                                            <option value="D03">D03</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Document Title</label>
                                        <textarea class="summernote" name="document_title" id="summernote-16">{{ $showdata->document_title }}</textarea>
                                    </div>
                                </div>
                                <?php
                                // Assume $data is the object containing reference_document array
                                $showdata->reference_document = is_array($showdata->reference_document) ? $showdata->reference_document : explode(',', $showdata->reference_document);
                                ?>
                                <div class="">
                                    <div class="group-input">
                                        <label for="Reference Records">Reference Documents</label>
                                        <select multiple id="reference_record" name="reference_document[]">
                                            <option value="">--Select--</option>
                                            <option value="RD01"<?php echo in_array('RD01', $showdata->reference_document) ? ' selected' : ''; ?>>RD01</option>
                                            <option value="RD02"<?php echo in_array('RD02', $showdata->reference_document) ? ' selected' : ''; ?>>RD02</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Error Observed on Page
                                            No.</label>
                                        <textarea class="summernote" name="Observation_on_Page_No" id="summernote-16">{{ $showdata->Observation_on_Page_No }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Brief Description</label>
                                        <textarea class="summernote" name="brief_description" id="summernote-16">{{ $showdata->brief_description }}</textarea>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="search">
                                            Type Of Error<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="type_of_error">
                                            <option value="{{ $showdata->type_of_error }}">
                                                {{ $showdata->type_of_error }}</option>
                                            <option value="Typographical Error (TE)">Typographical Error (TE)
                                            </option>
                                            <option value="Calculation Error (CE)">Calculation Error (CE)</option>
                                            <option value="Grammatical Error (GE)">Grammatical Error (GE)</option>
                                            <option value="Missing Word Error (ME)">Missing Word Error (ME)
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Details
                                        <button type="button" name="details" id="Details-add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Launch Deviation
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row#</th>
                                                    <th style="width: 12%">List Of Impacting Document (If Any)</th>
                                                    <th style="width: 16%"> Prepared By</th>
                                                    <th style="width: 15%">Checked By</th>
                                                    <th style="width: 15%">Approved By</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($grid_Data && is_array($grid_Data->data))
                                                    @foreach ($grid_Data->data as $grid_Data)
                                                        <tr>
                                                            <td><input disabled type="text" name="details[0][serial]"
                                                                    value="1">
                                                            </td>
                                                            <td><input type="text"
                                                                    name="details[0][ListOfImpactingDocument]"
                                                                    value="{{ isset($grid_Data['ListOfImpactingDocument']) ? $grid_Data['ListOfImpactingDocument'] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="details[0][PreparedBy]"
                                                                    value="{{ isset($grid_Data['PreparedBy']) ? $grid_Data['PreparedBy'] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="details[0][CheckedBy]"
                                                                    value="{{ isset($grid_Data['CheckedBy']) ? $grid_Data['CheckedBy'] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="details[0][ApprovedBy]"
                                                                    value="{{ isset($grid_Data['ApprovedBy']) ? $grid_Data['ApprovedBy'] : '' }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="dateandtime"><b>Date And Time of Correction </b></label>
                                        <input type="date" name="Date_and_time_of_correction"
                                            value="{{ $showdata->Date_and_time_of_correction }}">

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
                    <!-- -----------Tab-2------------ -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">HOD Remarks</label>
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-16">{{ $showdata->HOD_Remarks }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="HOD Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="HOD_Attachments">
                                                @if ($showdata->HOD_Attachments)
                                                    @foreach (json_decode($showdata->HOD_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgba(255, 255, 255, 0);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="HOD_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments')" multiple>
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
                    </div>
                    <!-- -----------Tab-3------------ -->
                    {{-- <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">Production</div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Production Review Required </label>
                                                <select name="production_review_required">
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Production Person </label>
                                                <select name="">
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                                    Production)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Production Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Production Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Production Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Production Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Warehouse</div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Warehouse Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Warehouse Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                                    Warehouse)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Warehouse Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Warehouse Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Warehouse Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Warehouse Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Quality Control</div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Quality Control Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Quality Control Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Quality
                                                    Control)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Quality Control Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Quality Control Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Quality Control Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Quality Control Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Engineering </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Engineering Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Engineering Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                                    Engineering)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Engineering Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Engineering Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Engineering Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Engineering Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Analytical Development Laboratry </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Analytical Development Laboratry Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Analytical Development Laboratry Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Analytical
                                                    Development Laboratry)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Analytical Development Laboratry
                                                    Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Analytical Development Laboratry Attachments
                                                </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Analytical Development Laboratry Review Completed
                                                    By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Analytical Development Laboratry Review Completed
                                                    On</label>
                                                <input type="date" />
                                            </div>
                                        </div>



                                        <div class="sub-head">Process Development Laboratry </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Process Development Laboratry Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Process Development Laboratry Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Process
                                                    Development Laboratry)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Process Development Laboratry
                                                    Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Process Development Laboratry Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Process Development Laboratory / Kilo Lab Review Completed
                                                    By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Process Development Laboratory / Kilo Lab Review Completed
                                                    On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Technology Transfer Design </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Technology Transfer Design Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Technology Transfer Design Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Technology
                                                    Transfer Design)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Technology Transfer Design
                                                    Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Technology Transfer Design Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Technology Transfer / Design Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Technology Transfer / Design Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>




                                        <div class="sub-head">Environment Health & Safety </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Environment Health & Safety Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Environment Health & Safety Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Environment
                                                    Health & Safety)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Environment Health & Safety
                                                    Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Environment Health & Safety Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Environment, Health & Safety Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Environment, Health & Safety Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head"> Human Resource & Administration </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by"> Human Resource & Administration Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by"> Human Resource & Administration Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Human Resource &
                                                    Administration)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments"> Human Resource & Administration
                                                    Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment"> Human Resource & Administration Attachments
                                                </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Human Resource & Administration Review Completed
                                                    By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Human Resource & Administration Review Completed
                                                    On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Information Technology </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Information Technology Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Information Technology Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Information
                                                    Technology)</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Information Technology Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Information Technology Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Information Technology Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Information Technology Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>


                                        <div class="sub-head">Project Management </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Project Management Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Project Management Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Project
                                                    Management )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Project Management Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Project Management Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Other's 1 Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Other's 1 Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="sub-head">Other's 1 (Additional Person Review From Departments If Required)
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 1 Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 1 Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 1 Department </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Manufacturing</option>
                                                    <option>Production</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 1
                                                    )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Other's 1 Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Other's 1 Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Project Management Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Project Management Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="sub-head">Other's 2 (Additional Person Review From Departments If Required)
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 2 Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 2 Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 2 Department </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Manufacturing</option>
                                                    <option>Production</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 2
                                                    )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Other's 2 Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Other's 2 Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Other's 3 Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Other's 2 Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="sub-head">Other's 3 (Additional Person Review From Departments If Required)
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 3 Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 3 Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 3 Department </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Manufacturing</option>
                                                    <option>Production</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 3
                                                    )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Other's 3 Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Other's 3 Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Other's 3 Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Other's 3 Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="sub-head">Other's 4 (Additional Person Review From Departments If Required)
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 4 Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 4 Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 4 Department </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Manufacturing</option>
                                                    <option>Production</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 4
                                                    )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Other's 4 Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Other's 4 Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Other's 4 Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Other's 4 Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="sub-head">Other's 5 (Additional Person Review From Departments If Required)
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 5 Review Required </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 5 Person </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Pankaj</option>
                                                    <option>Manish</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="submitted by">Other's 5 Department </label>
                                                <select>
                                                    <option>--select--</option>
                                                    <option>Manufacturing</option>
                                                    <option>Production</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 5
                                                    )</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label class="mt-4" for="Audit Comments">Other's 5 Feedback</label>
                                                <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="closure attachment">Other's 5 Attachments </label>
                                                <div><small class="text-primary">
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="File_Attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reviewed by">Other's 5 Review Completed By</label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved on">Other's 5 Review Completed On</label>
                                                <input type="date" />
                                            </div>
                                        </div>

                                        <div class="button-block">
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button"> <a class="text-white"
                                                    href="{{ url('rcms/qms-dashboard') }}">Exit
                                                </a> </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                    <!-- -----------Tab-4------------ -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="QA Feedbacks">QA Feedbacks</label>
                                        <textarea class="summernote" name="QA_Feedbacks" id="summernote-16">{{ $showdata->QA_Feedbacks }}</textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Attachment">QA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="QA_Attachments">
                                                @if ($showdata->QA_Attachments)
                                                    @foreach (json_decode($showdata->QA_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgba(255, 255, 255, 0);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')" multiple>
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
                    </div>
                    <!-- -----------Tab-5------------ -->

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-6">
                                    <div class="group-input">
                                        <label class="" for="Closure Comments">Closure Comments</label>
                                        <input type="text" name="Closure_Comments"
                                            value="{{ $showdata->Closure_Comments }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            All Impacting Documents Corrected <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..."
                                            name="All_Impacting_Documents_Corrected">
                                            <option value="{{ $showdata->All_Impacting_Documents_Corrected }}">
                                                {{ $showdata->All_Impacting_Documents_Corrected }}</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Remarks (If Any)</label>
                                        <textarea class="summernote" name="Remarks" id="summernote-16">{{ $showdata->Remarks }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Closure Attachments">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Closure_Attachments">
                                                @if ($showdata->Closure_Attachments)
                                                    @foreach (json_decode($showdata->Closure_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgba(255, 255, 255, 0);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
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
                    </div>

                    <!-- -----------Tab-6------------ -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted by">Submitted By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted on">Submitted On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">QA Review Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">QA Review Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Correction Completed by">Correction Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Correction Completed on">Correction Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By on">HOD Review Complete By On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed by">QA Head Aproval Completed
                                            By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed on">QA Head Aproval Completed
                                            On</label>
                                        <div class="Date"></div>
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
        $(document).ready(function() {
            $('#Details-add').click(function(e) {
                function generateTableRow(serialNumber) {
                    var data = @json($grid_Data);
                    var html = '';
                    html += '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="details[' + serialNumber +
                        '][ListOfImpactingDocument]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][PreparedBy]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][CheckedBy]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][ApprovedBy]"></td>' +

                        for (var i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }
                    '</tr>';

                    return html;
                }

                var tableBody = $('#Details-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
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
