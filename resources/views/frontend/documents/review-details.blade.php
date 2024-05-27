@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DOCUMENT TRACKER
    ======================================= --}}
    <div id="document-tracker">
        <div class="container-fluid">
            <div class="tracker-container">
                <div class="row">

                    <div class="col-12">
                        <div class="inner-block doc-info-block">
                            <div class="top-block">
                                <div class="title">
                                    {{ $document->document_name }}
                                </div>
                                <div class="buttons">
                                    <button onclick="location.href='{{ url('audit-trial', $document->id) }}';" style="cursor:pointer;">
                                        Audit Trail
                                    </button>
                                    @php $showEdit = false; @endphp
                                    @if (Helpers::checkRoles(2) AND Helpers::checkRoles_check_reviewers($document))
                                        @if (empty($review_reject))
                                            @if (empty($stagereview_submit))
                                                @php
                                                    $showEdit = true;
                                                @endphp
                                            @endif
                                        @elseif($document->stage == 2)
                                            @php
                                                $showEdit = true;
                                            @endphp
                                        @endif
                                    @endif

                                    @if (Helpers::checkRoles(1) AND Helpers::checkRoles_check_approvers($document))
                                        @if (empty($approval_reject))
                                            @if (empty($stageapprove_submit))
                                                @php
                                                    $showEdit = true;
                                                @endphp
                                            @endif
                                        @elseif($document->stage == 4)
                                            @php
                                                $showEdit = true;
                                            @endphp    
                                        @endif

                                    @endif

                                    @if ($showEdit)
                                    {{-- <a href="{{ route('documents.edit', $document->id) }}" class="button">Edit</a> --}}
                                    <button onclick="location.href='{{ route('documents.edit', $document->id) }}';" style="cursor:pointer;">Edit</button>

                                        {{-- <button ><a href="{{ route('documents.edit', $document->id) }}">Edit</a></button> --}}
                                    @endif

                                    <button onclick="location.href='{{ url('documents/generatePdf', $document->id) }}';">Download
                                    </button>
                                    <button onclick="location.href='{{ url('documents/printPDF', $document->id) }}';"
                                            target="__blank">Print
                                    </button>
                                </div>
                            </div>
                            <div class="bottom-block">
                                <div>
                                    <div class="head">Document Number</div>
                                    <div>000{{ $document->id }}</div>
                                </div>
                                {{-- <div>
                                    <div class="head">Department</div>
                                    <div>{{ $document->department_name->name }}</div>
                                </div> --}}
                                <div>
                                    <div class="head">Document Type</div>
                                    <div>{{ $document->doc_type->name }}</div>
                                </div>
                                <div>
                                    <div class="head">Working Status</div>
                                    <div>{{ $document->status }}</div>
                                </div>
                                <div>
                                    <div class="head">Last Modified By</div>
                                    @if ($document->last_modify)
                                        <div>{{ $document->last_modify->user_name }}</div>
                                    @else
                                        <div>{{ $document->oreginator->name }}</div>
                                    @endif
                                </div>
                                <div>
                                    <div class="head">Last Modified On</div>
                                    @if ($document->last_modify)
                                        <div>{{ $document->last_modify->created_at }}</div>
                                    @else
                                        <div>{{ $document->created_at }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Helpers::checkRoles(4) && $document->stage == 2)
                        <div class="col-8">
                            <div class="inner-block tracker">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="main-title">
                                        Record Workflow
                                    </div>
                                    <div class="buttons"> 
                                        @if (empty($review_reject))
                                            @if ($stagereview && empty($stagereview_submit))
                                                @if($document->stage < 3)
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                @endif
                                            @endif
                                        @elseif($document->stage == 2)
                                            <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                            </button>
                                        @endif

                                        @if (empty($stagehod))
                                            @if (empty($review_reject))
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Review&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            @elseif($document->stage == 2)
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Review&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                                <div class="status">
                                    <div class="head">Current Status</div>
                                    <div class="progress-bars">
                                        @if ($document->stage >= 2)
                                            <div class="active">Draft</div>
                                        @else
                                            <div>Draft</div>
                                        @endif
                                        {{-- @if ($review_reject)
                                            <div class="active">Rejected </div>
                                        @endif --}}
                                        @if ($stagehod)
                                            @if ($stagehod->stage == 'HOD Review Complete' AND $document->stage >= 2)
                                                <div class="active">Reviewed</div>
                                            @else
                                                <div>Reviewed</div>
                                            @endif
                                        @else
                                            <div>Reviewed</div>
                                        @endif

                                        @if ($stagereview_submit)
                                            @if ($stagereview_submit->stage == 'Review-Submit')
                                                {{-- <div class="active">Submitted</div> --}}
                                            @else
                                                {{-- <div>Submitted</div> --}}
                                            @endif
                                        @else
                                            {{-- <div>Submitted</div> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Helpers::checkRoles(2) AND Helpers::checkRoles_check_reviewers($document) && $document->stage == 4)
                        <div class="col-8">
                            <div class="inner-block tracker">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="main-title">
                                        Record Workflow
                                    </div>
                                    <div class="buttons"> 
                                        @if (empty($review_reject))
                                            @if ($stagereview && empty($stagereview_submit))
                                                @if($document->stage < 3)
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                @endif
                                            @endif
                                        @elseif($document->stage == 2)
                                            <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                            </button>
                                        @endif

                                        @if (empty($stagereview))
                                            @if (empty($review_reject))
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Review&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            @elseif($document->stage == 2)
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Review&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            @endif
                                        @endif
                                        @if ($stagereview && empty($stagereview_submit))
                                            {{-- @if ($stagereview->stage == 'Reviewed')
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Submit&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                            @endif --}}
                                        @endif
                                    </div>

                                </div>
                                <div class="status">
                                    <div class="head">Current Status</div>
                                    <div class="progress-bars">
                                        @if ($document->stage >= 4)
                                            <div class="active">Draft</div>
                                        @else
                                            <div>Draft</div>
                                        @endif
                                        {{-- @if ($review_reject)
                                            <div class="active">Rejected </div>
                                        @endif --}}
                                        @if ($stagereview)
                                            @if ($stagereview->stage == 'Reviewed' AND $document->stage >= 2)
                                                <div class="active">Reviewed</div>
                                            @else
                                                <div>Reviewed</div>
                                            @endif
                                        @else
                                            <div>Reviewed</div>
                                        @endif

                                        @if ($stagereview_submit)
                                            @if ($stagereview_submit->stage == 'Review-Submit')
                                                {{-- <div class="active">Submitted</div> --}}
                                            @else
                                                {{-- <div>Submitted</div> --}}
                                            @endif
                                        @else
                                            {{-- <div>Submitted</div> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Helpers::checkRoles(1) AND Helpers::checkRoles_check_approvers($document) && $document->stage == 6)
                        <div class="col-8">
                            <div class="inner-block tracker">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="main-title">
                                        Record Workflow
                                    </div>
                                    <div class="buttons">
                                        @if (empty($review_approve))
                                            @if ($stageapprove && empty($stageapprove_submit))
                                             @if ($stageapprove->stage != 'Approved')
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                                @endif
                                            @endif
                                        @elseif($document->stage == 4)
                                            <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                            </button>
                                        @endif
                                        
                                        @if (empty($stageapprove))
                                            @if (empty($approval_reject))
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Approve&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                                <button data-bs-toggle="modal" data-bs-target="#review-cancel">
                                                    Reject&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                {{-- @elseif($document->stage == 4)
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Approve&nbsp;<i class="fa-regular fa-circle-xmark"></i>
                                                </button>--}}
                                            @endif
                                        @endif
                                        @if ($stageapprove && empty($stageapprove_submit))
                                            @if ($stageapprove->stage != 'Approved')
                                                <button data-bs-toggle="modal" data-bs-target="#review-sign">
                                                    Submit&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="status">
                                    <div class="head">Current Status</div>
                                    <div class="progress-bars">
                                        @if ($document->stage >= 6)
                                            <div class="active">Draft</div>
                                        @else
                                            @if ($stageapprove)
                                                @if ($stageapprove->stage == 'Approved')
                                                <div class="active">Draft</div>
                                                @else
                                                <div>Draft</div>
                                                @endif
                                            @else
                                            <div>Draft</div>
                                            @endif

                                            
                                        @endif
                                        {{-- @if ($approval_reject)
                                            <div class="active">Rejected </div>
                                        @endif --}}
                                        @if ($stageapprove)
                                            @if ($stageapprove->stage == 'Approved')
                                                <div class="active">Approved</div>
                                            @else
                                                <div>Approved</div>
                                            @endif
                                        @else
                                            <div>Approved</div>
                                        @endif


                                        @if ($stageapprove_submit)
                                            @if ($stageapprove_submit->stage == 'Approval-Submit')
                                                {{-- <div class="active">Submitted</div> --}}
                                            @else
                                                {{-- <div>Submitted</div> --}}
                                            @endif
                                        @else
                                            {{-- <div>Submitted</div> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-4">
                        <div>
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Reviewers
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-reviewers">
                                    View
                                </button>
                            </div>
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Approvers
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-approvers">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="inner-block doc-overview">
                            <div class="main-title">Preview</div>
                            <iframe id="theFrame" width="100%" height="800"
                                src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="doc-reviewers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reviewers</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    @if ($document->reviewers)
                        <div class="reviewer-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reviewers</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Audit Trial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rev_data = explode(',', $document->reviewers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $rev_data[$i])
                                                ->first();
                                                $user->department = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                                $user->status = DB::table('stage_manages')
                                                ->where('user_id', $rev_data[$i])
                                                ->where('document_id', $document->id)
                                                ->where('stage', 'Reviewed')
                                                ->where('deleted_at', null)
                                                ->latest()
                                                ->first();
                                            $user->reject = DB::table('stage_manages')
                                                ->where('user_id', $rev_data[$i])
                                                ->where('document_id', $document->id)
                                                ->where('stage', 'Cancel-by-Reviewer')
                                                ->where('deleted_at', null)
                                                ->latest()
                                                ->first();

                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->department }}</td>
                                            @if ($user->status)
                                                <td>Reviewed <i class="fa-solid fa-circle-check text-success"></i></td>
                                            @elseif($user->reject)
                                                <td>Rejected <i class="fa-solid fa-circle-xmark text-danger"></i></td>
                                            @else
                                                <td>Review Pending</td>
                                            @endif
                                            <td><a
                                                href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                    type="button">Audit Trial</button></a></td>
                                        </tr>
                                    @endfor

                                </tbody>

                            </table>
                        </div>
                    @endif
                    @if ($document->reviewers_group)
                        <div class="modal-header">
                            <h4 class="modal-title">Reviewer Group</h4>
                        </div>

                        <div class="reviewer-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Groups</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rev_data = explode(',', $document->reviewers_group);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('group_permissions')
                                                ->where('id', $rev_data[$i])
                                                ->first();
                                            $user->department = DB::table('role_groups')
                                                ->where('id', $user->role_id)
                                                ->value('name');
                                            $users = explode(',', $user->user_ids);

                                            $j = 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div>{{ $user->name }}</div>
                                                @if (count($users) > 1)
                                                    <ul>
                                                        @for ($j = 0; $j < count($users); $j++)
                                                            @php
                                                                $userdata = DB::table('users')
                                                                    ->where('id', $users[$j])
                                                                    ->first();

                                                                $userdata->department = DB::table('departments')
                                                                    ->where('id', $userdata->departmentid)
                                                                    ->value('name');
                                                                $userdata->approval = DB::table('stage_manages')
                                                                    ->where('document_id', $document->id)
                                                                    ->where('user_id', $users[$j])
                                                                    ->latest()
                                                                    ->first();
                                                            @endphp
                                                            <li><small>{{ $userdata->name }}</small></li>
                                                        @endfor

                                                    </ul>
                                                @endif
                                            </td>

                                            <td>{{ $user->department }}
                                                @if (count($users) > 1)
                                                    <ul>
                                                        @for ($j = 0; $j < count($users); $j++)
                                                            @php
                                                                $userdata = DB::table('users')
                                                                    ->where('id', $users[$j])
                                                                    ->first();

                                                                $userdata->department = DB::table('departments')
                                                                    ->where('id', $userdata->departmentid)
                                                                    ->value('name');
                                                                $userdata->approval = DB::table('stage_manages')
                                                                    ->where('document_id', $document->id)
                                                                    ->where('user_id', $users[$j])
                                                                    ->latest()
                                                                    ->first();
                                                            @endphp
                                                            <li><small>{{ $userdata->department }}</small></li>
                                                        @endfor

                                                    </ul>
                                                @endif
                                            </td>
                                            @if ($document->stage >= 3)
                                                <td>Reviewed <i class="fa-solid fa-circle-check text-success"></i>
                                                    @if (count($users) > 1)
                                                        <ul>
                                                            @for ($j = 0; $j < count($users); $j++)
                                                                @php
                                                                    $userdata = DB::table('users')
                                                                        ->where('id', $users[$j])
                                                                        ->first();

                                                                    $userdata->department = DB::table('departments')
                                                                        ->where('id', $userdata->departmentid)
                                                                        ->value('name');
                                                                        $user->status = DB::table('stage_manages')
                                                                        ->where('user_id', $rev_data[$i])
                                                                        ->where('document_id', $document->id)
                                                                        ->where('stage', 'Review-submit')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();
                                                                    $user->reject = DB::table('stage_manages')
                                                                        ->where('user_id', $rev_data[$i])
                                                                        ->where('document_id', $document->id)
                                                                        ->where('stage', 'Cancel-by-Reviewer')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();

                                                                @endphp
                                                                @if ($userdata->approval)
                                                                    <li><small>Reviewed <i
                                                                                class="fa-solid fa-circle-check text-success"></i></small>
                                                                    </li>
                                                                @elseif($userdata->reject)
                                                                    <li><small>Rejected  <i
                                                                                class="fa-solid fa-circle-xmark text-danger"></i></small>
                                                                    </li>
                                                                @else
                                                <td>Review Pending</td>
                                            @endif
                                    @endfor

                                    </ul>
                    @endif
                    </td>
                @else
                    <td>Review Pending</td>
                    @endif
                    </tr>
                    @endfor

                    </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {{-- <button>Update</button> --}}
                <button type="button" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
    </div>

    <div class="modal fade modal-lg" id="doc-approvers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Approvers</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    @if ($document->approvers)
                        <div class="reviewer-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Approvers</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Audit Trial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rev_data = explode(',', $document->approvers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $rev_data[$i])
                                                ->first();
                                            $user->department = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                            $user->status = DB::table('stage_manages')
                                                ->where('user_id', $rev_data[$i])
                                                ->where('stage', 'Approved')
                                                ->where('document_id', $document->id)
                                                ->where('deleted_at', null)
                                                ->latest()
                                                ->first();
                                            $user->reject = DB::table('stage_manages')
                                                ->where('user_id', $rev_data[$i])
                                                ->where('document_id', $document->id)
                                                ->where('stage', 'Cancel-by-Approver')
                                                ->where('deleted_at', null)
                                                ->latest()
                                                ->first();

                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->department }}</td>
                                            @if (@$user->status->stage=='Review-submit' || @$user->status->stage=='Approved' ||  @$user->status->stage=='Approval-Submit')
                                                <td>Approved <i class="fa-solid fa-circle-check text-success"></i></td>
                                            @elseif($user->reject)
                                                <td>Rejected <i class="fa-solid fa-circle-xmark text-danger"></i></td>
                                            @else
                                                <td>Approval Pending</td>
                                            @endif
                                            <td><a
                                                href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                    type="button">Audit Trial</button></a></td>
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if ($document->approver_group)
                        <div class="modal-header">
                            <h4 class="modal-title">Approvers Group</h4>
                        </div>

                        <div class="reviewer-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Groups</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rev_data = explode(',', $document->approver_group);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('group_permissions')
                                                ->where('id', $rev_data[$i])
                                                ->first();
                                            $user->department = DB::table('role_groups')
                                                ->where('id', $user->role_id)
                                                ->value('name');
                                            $users = explode(',', $user->user_ids);

                                            $j = 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div>{{ $user->name }}</div>
                                                @if (count($users) > 1)
                                                    <ul>
                                                        @for ($j = 0; $j < count($users); $j++)
                                                            @php
                                                                $userdata = DB::table('users')
                                                                    ->where('id', $users[$j])
                                                                    ->first();

                                                                $userdata->department = DB::table('departments')
                                                                    ->where('id', $userdata->departmentid)
                                                                    ->value('name');
                                                                $userdata->approval = DB::table('stage_manages')
                                                                    ->where('document_id', $document->id)
                                                                    ->where('user_id', $users[$j])
                                                                    ->latest()
                                                                    ->first();
                                                            @endphp
                                                            <li><small>{{ $userdata->name }}</small></li>
                                                        @endfor

                                                    </ul>
                                                @endif
                                            </td>

                                            <td>{{ $user->department }}
                                                @if (count($users) > 1)
                                                    <ul>
                                                        @for ($j = 0; $j < count($users); $j++)
                                                            @php
                                                                $userdata = DB::table('users')
                                                                    ->where('id', $users[$j])
                                                                    ->first();

                                                                $userdata->department = DB::table('departments')
                                                                    ->where('id', $userdata->departmentid)
                                                                    ->value('name');
                                                                $userdata->approval = DB::table('stage_manages')
                                                                    ->where('document_id', $document->id)
                                                                    ->where('user_id', $users[$j])
                                                                    ->latest()
                                                                    ->first();
                                                            @endphp
                                                            <li><small>{{ $userdata->department }}</small></li>
                                                        @endfor

                                                    </ul>
                                                @endif
                                            </td>
                                            @if ($document->stage >= 3)
                                                <td>Reviewed <i class="fa-solid fa-circle-check text-success"></i>
                                                    @if (count($users) > 1)
                                                        <ul>
                                                            @for ($j = 0; $j < count($users); $j++)
                                                                @php
                                                                    $userdata = DB::table('users')
                                                                        ->where('id', $users[$j])
                                                                        ->first();

                                                                    $userdata->department = DB::table('departments')
                                                                        ->where('id', $userdata->departmentid)
                                                                        ->value('name');
                                                                        $user->status = DB::table('stage_manages')
                                                                        ->where('user_id', $rev_data[$i])
                                                                        ->where('document_id', $document->id)
                                                                        ->where('stage', 'Review-submit')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();
                                                                    $user->reject = DB::table('stage_manages')
                                                                        ->where('user_id', $rev_data[$i])
                                                                        ->where('document_id', $document->id)
                                                                        ->where('stage', 'Cancel-by-Reviewer')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();

                                                                @endphp
                                                                @if ($userdata->approval)
                                                                    <li><small>Approved <i
                                                                                class="fa-solid fa-circle-check text-success"></i></small>
                                                                    </li>
                                                                @elseif($userdata->reject)
                                                                    <li><small>Rejected  <i
                                                                                class="fa-solid fa-circle-xmark text-danger"></i></small>
                                                                    </li>
                                                                @else
                                                <td>Approval Pending</td>
                                            @endif
                                    @endfor

                                    </ul>
                    @endif
                    </td>
                @else
                    <td>Approval Pending</td>
                    @endif
                    </tr>
                    @endfor

                    </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {{-- <button>Update</button> --}}
                <button type="button" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
    </div>

    <div class="modal fade" id="review-sign">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form action="{{ url('sendforstagechanage') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" value="{{ old('username') }}" name="username" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">User name not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" value="{{ old('password') }}" name="password" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">E-signature not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <textarea required name="comment" value="{{ old('comment') }}"></textarea>
                        </div>
                    </div>
                    @if ($document->stage == 2)
                        <input type="hidden" name="stage_id" value="HOD Review Complete" />
                    @endif

                    @if ($document->stage == 4)
                        <input type="hidden" name="stage_id" value="Reviewed" />
                    @endif

                    @if ($stagereview)
                        @if ($stagereview->stage == 'Reviewed')
                            <input type="hidden" name="stage_id" value="Review-Submit" />
                        @endif
                    @endif


                    @if ($document->stage == 6)
                        <input type="hidden" name="stage_id" value="Approved" />
                    @endif

                    @if ($stageapprove)
                        @if ($stageapprove->stage == 'Approved')
                            <input type="hidden" name="stage_id" value="Approval-Submit" />
                        @endif
                    @endif

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="review-cancel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form action="{{ url('sendforstagechanage') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        {{-- <div class="group-input">
                            <label for="electronic-meaning">Electronic Signature Approved Meaning</label>
                            <select name="electronic-meaning">
                                <option selected>- Please Select -</option>
                                <option value="cancelled">Document Cancelled</option>
                            </select>
                        </div> --}}
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" value="{{ old('username') }}" name="username" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">User name not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" value="{{ old('password') }}" name="password" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">E-signature not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <textarea required name="comment" value="{{ old('comment') }}"></textarea>
                        </div> 
                    </div>
                    @if (Helpers::checkRoles(1) AND Helpers::checkRoles_check_approvers($document))
                        <input type="hidden" name="stage_id" value="Cancel-by-Approver" />
                    @endif
                    @if (Helpers::checkRoles(2) AND Helpers::checkRoles_check_reviewers($document))
                        <input type="hidden" name="stage_id" value="Cancel-by-Reviewer" />
                    @endif

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
