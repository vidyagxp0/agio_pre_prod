@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    REVIEWER PANEL
    ======================================= --}}
    <div id="reviewer-panel">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow</div>
                    <div class="d-flex align-items-center" style="gap: 20px;">
                        <button> <a class="text-white" href="{{ url('change-control-audit', $data->id) }}"> Audit Trial </a>
                        </button>

                        @if (Helpers::checkRoles(4))
                            @if ($data->stage < 3)
                                <button data-bs-toggle="modal" data-bs-target="#signature-modal" class="button_theme1">
                                    Review
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    Reject
                                </button>
                            @endif
                        @endif
                        @if (Helpers::checkRoles(5))
                            @if (!$changeStage->approve)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Submit
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    Reject
                                </button>
                            @endif
                        @endif
                        <button onclick="window.print();return false;" class="new-doc-btn button_theme1">
                            Print
                        </button>
                    </div>
                </div>
                @if (Helpers::checkRoles(4))
                    <div class="status">
                        <div class="head">Current Status</div>
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Open State</div>
                            @else
                                <div class="">Open State</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">Reviewed</div>
                            @else
                                <div class="">Reviewed</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">Submitted</div>
                            @else
                                <div class="">Submitted</div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="status">
                        <div class="head">Current Status</div>
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Open State</div>
                            @else
                                <div class="">Open State</div>
                            @endif
                            @if ($changeStage->approve)
                                <div class="active">Reviewed</div>
                            @else
                                <div class="">Reviewed</div>
                            @endif
                            @if ($changeStage->approve)
                                <div class="active">Submitted</div>
                            @else
                                <div class="">Submitted</div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="inner-block change-control">
                <div class="main-head">
                    Change Control Title
                </div>
                {{-- <div class="block-list">
                    <div class="block">
                        <div class="head">
                            General Information
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="owner">Owner</label>
                                    <div class="static">Amit Guru</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="version">Version</label>
                                    <div class="static">2.2</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="assigned">Assigned To</label>
                                    <div class="static">Piyush Sahu</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="due-date">Due Date</label>
                                    <div class="static">27-23-2023</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="type">Type*</label>
                                    <input list="type" name="type">
                                    <datalist id="type">
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">Batch</label>
                                    <input list="batches" name="batches">
                                    <datalist id="batches">
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                        <option value="Lorem Ipsum"></option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="short-desc">Short Description*</label>
                                    <input type="text" name="short-desc">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Applicability
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="owning-facility">Owning Facility</label>
                                    <input type="text" name="owning-facility">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="impacted-facilities">Impacted Facilities</label>
                                    <input type="text" name="impacted-facilities">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="owning-department">Owning Department</label>
                                    <input type="text" name="owning-department">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="impacted-department">Impacted Department</label>
                                    <input type="text" name="impacted-department">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Change Information
                        </div>
                        <div class="row">
                            <div class="col-lg-">
                                <div class="group-input">
                                    <label for="document-change-action">Document Change Action</label>
                                    <input type="text" name="document-change-action">
                                </div>
                            </div>
                            <div class="col-lg-">
                                <div class="group-input">
                                    <label for="document-change-type">Document Change Type</label>
                                    <input type="text" name="document-change-type">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="change-summary">Change Summary</label>
                                    <input type="text" name="change-summary">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="reason">Summary/Reason</label>
                                    <input type="text" name="reason">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="periodic">Part of Periodic Review</label>
                                    <div class="radio-list">
                                        <label for="yes">
                                            <input type="radio" name="periodic" id="yes"> Yes
                                        </label>
                                        <label for="no">
                                            <input type="radio" name="periodic" id="no"> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Details
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="current-state">Current State</label>
                                    <textarea name="current-state"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="proposed-state">Proposed State</label>
                                    <textarea name="proposed-state"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="justification">Justification</label>
                                    <textarea name="justification"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Change Scope - Equipment
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="equip-affect">Equipment Affected?</label>
                                    <select name="equip-affect">
                                        <option value="" selected>--None--</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="equip-id">Equipment ID</label>
                                    <input type="text" name="equip-id">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="equip-comment">Equipment Comment</label>
                                    <textarea name="equip-comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Change Scope - Documents
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="doc-affect">Documents Affected?</label>
                                    <select name="doc-affect">
                                        <option value="" selected>--None--</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="doc-comment">Document Comment</label>
                                    <textarea name="doc-comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            Evaluation
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input check-input">
                                    <input type="checkbox" name="implement">
                                    <label for="implement" class="mb-0">Implemented as Planned</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="change-eval">Change Evaluation</label>
                                    <textarea name="change-eval"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="justify-reject">Justification for Reject</label>
                                    <textarea name="justify-reject"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="foot-buttons">
                        <button>Update</button>
                    </div>
                </div> --}}
                <div class="block-list">
                    <div class="block">
                        <div class="head">General Information</div>
                        <div class="bar">
                            <strong>Title : </strong>
                            {{ $data->title }}
                        </div>
                        <div class="bar">
                            <strong>Version : </strong>
                            {{ $data->version }}
                        </div>
                        <div class="bar">
                            <strong>Short Description : </strong>
                            {{ $data->short_description }}
                        </div>
                        <div class="bar">
                            <strong>Assigned To : </strong>
                            {{ $data->assign_to_name }}
                        </div>
                        <div class="bar">
                            <strong>Type : </strong>
                            {{ $data->type }}
                        </div>
                        <div class="bar">
                            <strong>Due Date : </strong>
                            {{ $data->due_date }}
                        </div>
                        <div class="bar">
                            <strong>Batch : </strong>
                            {{ $data->batch }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Applicability</div>
                        <div class="bar">
                            <strong>Title : </strong>
                            {{ $data->title }}
                        </div>
                        <div class="bar">
                            <strong>Owning Facility : </strong>
                            {{ $data->owning_facility }}
                        </div>
                        <div class="bar">
                            <strong>Impacted Facilities : </strong>
                            {{ $data->impacted_facility }}
                        </div>
                        <div class="bar">
                            <strong>Owning Department : </strong>
                            {{ $data->owning_department }}
                        </div>
                        <div class="bar">
                            <strong>Impacted Department : </strong>
                            {{ $data->impacted_document }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Change Information</div>
                        <div class="bar">
                            <strong>Document Change Action : </strong>
                            {{ $data->doc_change_action }}
                        </div>
                        <div class="bar">
                            <strong>Document Change Type : </strong>
                            {{ $data->doc_change_type }}
                        </div>
                        <div class="bar">
                            <strong>Change Summary : </strong>
                            {{ $data->doc_change_summary }}
                        </div>
                        <div class="bar">
                            <strong>Summary/Reason : </strong>
                            {{ $data->doc_change_summary_reason }}
                        </div>
                        <div class="bar">
                            <strong>Part of Periodic Review : </strong>
                            {{ $data->periodic_review }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Details</div>
                        <div class="bar">
                            <strong>Current State : </strong>
                            {{ $data->current_state }}
                        </div>
                        <div class="bar">
                            <strong>Proposed State : </strong>
                            {{ $data->proposed_state }}
                        </div>
                        <div class="bar">
                            <strong>Justification : </strong>
                            {{ $data->justification }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Change Scope - Equipment</div>
                        <div class="bar">
                            <strong>Equipment Affected? : </strong>
                            {{ $data->equipment_affected }}
                        </div>
                        <div class="bar">
                            <strong>Equipment ID : </strong>
                            {{ $data->equipment_id }}
                        </div>
                        <div class="bar">
                            <strong>Equipment Comment : </strong>
                            {{ $data->equipment_comment }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Change Scope - Documents</div>
                        <div class="bar">
                            <strong>Documents Affected? : </strong>
                            {{ $data->document_affected }}
                        </div>
                        <div class="bar">
                            <strong>Document Comment : </strong>
                            {{ $data->document_comment }}
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">Evaluation</div>
                        <div class="bar">
                            <strong>Implemented as Planned : </strong>
                            @if ($data->implemented_as_planed == 1)
                                Yes
                            @else
                                No
                            @endif
                        </div>
                        <div class="bar">
                            <strong>Change Evaluation : </strong>
                            {{ $data->change_evaluation }}
                        </div>
                        <div class="bar">
                            <strong>Justification for Reject : </strong>
                            {{ $data->justification_for_reject }}
                        </div>
                    </div>
                </div>
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

                <form action="{{ url('send-change-control', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        @if ($data->stage < 3)
                            <input type="hidden" value="3" name="stage">
                        @elseif($data->stage < 5)
                            <input type="hidden" value="5" name="stage">
                        @endif
                        <div class="group-input">
                            <label for="electronic-meaning">Electronic Signature Approved Meaning</label>
                            <select name="electronic-meaning">
                                <option selected>- Please Select -</option>
                                <option value="assure-approved">Document Reviewed</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('send-change-control', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        @if ($data->stage < 3)
                            <input type="hidden" value="1" name="stage">
                        @elseif($data->stage < 5)
                            <input type="hidden" value="1" name="stage">
                        @endif
                        <div class="group-input">
                            <label for="electronic-meaning">Electronic Signature Approved Meaning</label>
                            <select name="electronic-meaning">
                                <option selected>- Please Select -</option>
                                <option value="assure-approved">Document Rejected</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
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
@endsection
