@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DOCUMENT TRACKER
    ======================================= --}}

      <!-- Example Blade View -->
<head>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>
@if(Session::has('swal'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "{{ Session::get('swal.title') }}",
                text: "{{ Session::get('swal.message') }}",
                icon: "{{ Session::get('swal.type') }}"
            });
        });
    </script>
@endif

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
                                    <button onclick="location.href='{{ url('notification', $document->id) }}';">
                                        Send Notification
                                    </button>
                                    <button onclick="location.href='{{ url('audit-trial', $document->id) }}';">
                                        Audit Trail
                                    </button>

                                    @if ($document->status !== 'Obsolete')
                                        <button onclick="location.href='{{ route('documents.edit', $document->id) }}';">Edit
                                        </button>
                                        {{-- <button>Cancel</button> --}}
                                    @endif
                                    @if (Helpers::checkControlAccess())
                                        <button
                                            onclick="location.href='{{ url('documents/generatePdf', $document->id) }}';">Download
                                        </button>
                                    @endif
                                    @if (Helpers::checkControlAccess())
                                        <button onclick="location.href='{{ url('documents/printPDF', $document->id) }}';"
                                            target="__blank">
                                            Print
                                        </button>
                                    @endif
                                    @if (Helpers::checkControlAccess())
                                        <button onclick="location.href='{{ url('documents/printAnnexurePDF', $document->id) }}';"
                                            target="__blank">
                                            Print Annexure
                                        </button>
                                    @endif

                                    {{-- @if ($document->stage >= 7)
                                        <button data-bs-toggle="modal" data-bs-target="#child-modal">Child</button>
                                    @endif --}}
                                    @if ($document->stage >= 11 && $document->status !== 'Obsolete')
                                        {{-- <button type="button" class="btn btn-danger" id="obsolete-button">Obsolete</button> --}}
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#signature-modal">
                                            Obsolete
                                        </button>
                                        {{-- <button>Obsolete</button> --}}
                                        <button data-bs-toggle="modal" data-bs-target="#child-modal">Revise</button>
                                    @endif

                                </div>
                            </div>
                            <div class="bottom-block">
                                <div>
                                    <div class="head">Document Number</div>
                                    <div>
                                        @if ($document->revised === 'Yes')
                                            000{{ $document->revised_doc }}
                                        @else
                                            000{{ $document->id }}
                                        @endif
                                    </div>
                                </div>
                                {{-- <div>
                                    <div class="head">Department</div>
                                    <div>{{ $document->department_name->name }}
                        </div>
                    </div> --}}
                                <div>
                                    <div class="head">Document Type</div>
                                    <div>{{ Helpers::getDocumentTypes()[$document->document_type_id] }}</div>
                                </div>
                                <div>
                                    <div class="head">Working Status</div>
                                    <div>{{ Helpers::getDocStatusByStage($document->stage, $document->training_required) }}
                                    </div>
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
                                        <div>
                                            {{ \Carbon\Carbon::parse($document->last_modify_date->created_at)->format('d-M-Y h:i A') }}
                                        </div>
                                    @else
                                        <div>{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y h:i A') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="inner-block tracker">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="main-title">
                                    Record Workflow
                                </div>

                                @if($document->document_type_id == 'SOP')
                                        
                                    @if ($document->stage == 1)
                                        <input type="hidden" name="stage_id" value="2" />
                                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                            Send For HOD Review<i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    @endif

                                    @if ($document->stage == 3)
                                        <input type="hidden" name="stage_id" value="4" />
                                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                            Send For Review<i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    @endif

                                    @if ($document->stage == 5)
                                        <input type="hidden" name="stage_id" value="6" />
                                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                            Send For Approval<i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    @endif

                                    @if ($document->training_required == 'yes')
                                        @if ($document->stage == 7)
                                            <input type="hidden" name="stage_id" value="6" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Training<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                        @if ($document->stage == 9)
                                            <input type="hidden" name="stage_id" value="8" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Effective<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                    @elseif($document->training_required == 'no')
                                        @if ($document->stage == 7)
                                            <input type="hidden" name="stage_id" value="8" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Effective<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                    @endif

                                @else

                                    @if ($document->stage == 1)
                                        <input type="hidden" name="stage_id" value="4" />
                                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                            Send For Review<i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    @endif

                                    @if ($document->stage == 5)
                                        <input type="hidden" name="stage_id" value="6" />
                                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                            Send For Approval<i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    @endif


                                    @if ($document->training_required == 'yes')
                                        @if ($document->stage == 7)
                                            <input type="hidden" name="stage_id" value="6" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Training<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                        @if ($document->stage == 9)
                                            <input type="hidden" name="stage_id" value="8" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Effective<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                    @elseif($document->training_required == 'no')
                                        @if ($document->stage == 7)
                                            <input type="hidden" name="stage_id" value="10" />
                                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#approve-sign">
                                                Send For Effective<i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        @endif
                                    @endif
                                
                                @endif

                            </div>
                            <div class="status">
                                <div class="head">Current Status</div>
                                @if ($document->stage < 14)
                                    <div class="progress-bars">
                                        @if($document->document_type_id == 'SOP')
                                            @if ($document->stage >= 1)
                                                <div class="active">Draft</div>
                                            @else
                                                <div class="">Draft</div>
                                            @endif
                                            @if ($document->stage >= 2)
                                               <div class="active">In-HOD Review</div>
                                            @else
                                                <div class="">In-HOD Review</div>
                                            @endif
                                            @if ($document->stage >= 3)
                                                <div class="active">HOD Review Complete</div>
                                            @else
                                                <div class="">HOD Review Complete</div>
                                            @endif
                                        
                                            @if ($document->stage >= 4)
                                                <div class="active">In-Review</div>
                                            @else
                                                <div class="">In-Review</div>
                                            @endif
                                            @if ($document->stage == 9)
                                                <div class="active">Rejected</div>
                                            @endif
                                            @if ($document->stage >= 5)
                                                <div class="active">Reviewed</div>
                                            @else
                                                <div class="">Reviewed</div>
                                            @endif
                                            @if ($document->stage >= 6)
                                                <div class="active">For-Approval</div>
                                            @else
                                                <div class="">For-Approval</div>
                                            @endif
                                            @if ($document->stage >= 7)
                                                <div class="active">Approved</div>
                                            @else
                                                <div class="">Approved</div>
                                            @endif
                                            @if ($document->training_required == 'yes')
                                                @if ($document->stage >= 8)
                                                    <div class="active">Pending-Training</div>
                                                @else
                                                    <div class="">Pending-Training</div>
                                                @endif
                                                @if ($document->stage >= 9)
                                                    <div class="active">Training-Complete</div>
                                                @else
                                                    <div class="">Training-Complete</div>
                                                @endif
                                            @endif

                                            @if ($document->stage >= 10)
                                                <div class="active">In-Effective</div>
                                            @else
                                                <div class="">In-Effective</div>
                                            @endif
                                            @if ($document->stage >= 11)
                                                <div class="active">Effective</div>
                                            @else
                                                <div class="">Effective</div>
                                            @endif
                                            @if ($document->stage == 12)
                                                <div class="bg-danger">Obsolete</div>
                                            @else
                                                <div class="">Obsolete</div>
                                            @endif
                                        
                                        
                                        @else

                                            @if ($document->stage >= 1)
                                                <div class="active">Draft<br><span>(Prepared by)</span></div>
                                            @else
                                                <div class="">Draft<br><span>(Prepared by)</span></div>
                                            @endif
                                        
                                            @if ($document->stage >= 4)
                                                <div class="active">For checking</div>
                                            @else
                                                <div class="">For checking</div>
                                            @endif
                                            @if ($document->stage == 9)
                                                <div class="active">Rejected</div>
                                            @endif
                                            @if ($document->stage >= 5)
                                                <div class="active">Checked By</div>
                                                {{-- && $document->stage < 10 --}}
                                            @else
                                                <div class="">Checked By</div>
                                            @endif
                                            @if ($document->stage >= 6)
                                                <div class="active">For-Approval</div>
                                                {{-- && $document->stage < 10 --}}
                                            @else
                                                <div class="">For-Approval</div>
                                            @endif
                                            {{-- @if ($document->stage == 10)
                                            <div class="active">Rejected</div>
                                            @endif --}}
                                            @if ($document->stage >= 7)
                                                <div class="active">Approved</div>
                                            @else
                                                <div class="">Approved</div>
                                            @endif
                                            @if ($document->training_required == 'yes')
                                                @if ($document->stage >= 8)
                                                    <div class="active">Pending-Training</div>
                                                @else
                                                    <div class="">Pending-Training</div>
                                                @endif
                                                @if ($document->stage >= 9)
                                                    <div class="active">Training-Complete</div>
                                                @else
                                                    <div class="">Training-Complete</div>
                                                @endif
                                            @endif

                                            @if ($document->stage >= 10)
                                                <div class="active">In-Effective</div>
                                            @else
                                                <div class="">In-Effective</div>
                                            @endif
                                            @if ($document->stage >= 11)
                                                <div class="active">Effective</div>
                                            @else
                                                <div class="">Effective</div>
                                            @endif
                                            @if ($document->stage == 12)
                                                <div class="bg-danger">Obsolete</div>
                                            @else
                                                <div class="">Obsolete</div>
                                            @endif
                                        

                                        @endif
                                            


                                        {{-- <div class="{{ $document->stage == 0 ? 'active' : '' }}">Draft
                                        </div>
                                        <div class="{{ $document->stage == 1 ? 'active' : '' }}">Reviewed</div>
                                        <div class="{{ $document->stage == 2 ? 'active' : '' }}">Approved</div>
                                        <div class="{{ $document->stage == 3 ? 'active' : '' }}">Effective</div> --}}
                                    </div>
                                @else
                                    <div class="bg-danger text-white rounded-pill text-center">
                                        {{ Helpers::getDocStatusByStage($document->stage) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div>
                            @if($document->document_type_id == 'SOP')
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    HOD
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-hods">
                                    View
                                </button>
                            </div>
                            @else
                            <div class="inner-block person-table" style="display:none">
                                <div class="main-title mb-0">
                                    HOD
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-hods">
                                    View
                                </button>
                            </div>
                            @endif

                            @if($document->document_type_id == 'SOP')
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Reviewers
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-reviewers">
                                    View
                                </button>
                            </div>
                            @else
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Checked By
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-reviewers">
                                    View
                                </button>
                            </div>
                            @endif
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

                            @if(in_array($document->document_type_id, ['SOP']))
                                <iframe id="theFrame" width="100%" height="800"
                                    src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                                <iframe id="theFrame" width="100%" height="800"
                                    src="{{ url('documents/annexureviewpdf/' . $document->id) }}#toolbar=0"></iframe>
                            
                            @elseif(in_array($document->document_type_id, ['BOM', 'FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','BMR','BPR','SPEC','STP','TDS','GTP']))
                                <iframe id="theFrame" width="100%" height="800"
                                src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                                
                            @else
                                <a href="{{ route('view.attachments', $document->id) }}" target="_blank" class="btn btn-primary mt-3">
                                    View Attachments
                                </a>

                                <table class="border" style="width: 100%; border-collapse: collapse; text-align: left; margin: 20px auto; font-size: 16px;">
                                    <thead>
                                        <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                                            <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 20%;"></th>
                                            <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 25%;">Prepared By</th>
                                            <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 25%;">Checked By</th>
                                            <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 25%;">Approved By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="border-bottom: 1px solid #ddd;">
                                            @php
                                                $inreviews = DB::table('stage_manages')
                                                    ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                                    ->select('stage_manages.*', 'users.name as user_name')
                                                    ->where('document_id', $document->id)
                                                    ->where('stage', 'HOD Review-Submit')
                                                    ->whereNull('deleted_at')
                                                    ->get();
                                            @endphp
                                            <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold;">Sign</th>
                                            <td style="padding: 5px; border: 1px solid #ddd;">{{ Helpers::getInitiatorName($document->originator_id) }}</td>
                                            <td style="padding: 5px; border: 1px solid #ddd;">
                                                @if ($inreviews->isEmpty())
                                                    <div> - </div>
                                                @else
                                                    @foreach ($inreviews as $temp)
                                                        <div>{{ $temp->user_name ?: '-' }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            @php
                                                $inreview = DB::table('stage_manages')
                                                    ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                                    ->select('stage_manages.*', 'users.name as user_name')
                                                    ->where('document_id', $document->id)
                                                    ->where('stage', 'Approval-Submit')
                                                    ->whereNull('deleted_at')
                                                    ->get();
                                            @endphp
                                            <td style="padding: 5px; border: 1px solid #ddd;">
                                                @if ($inreview->isEmpty())
                                                    <div>-</div>
                                                @else
                                                    @foreach ($inreview as $temp)
                                                        <div>{{ $temp->user_name ?: '-' }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #ddd;">
                                            <td style="padding: 5px; border: 1px solid #ddd; font-weight: bold;">Date</td>
                                            <td style="padding: 5px; border: 1px solid #ddd;">
                                                {{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                                            </td>
                                            <td style="padding: 5px; border: 1px solid #ddd;">
                                                @if ($inreviews->isEmpty())
                                                    <div>-</div>
                                                @else
                                                    @foreach ($inreviews as $temp)
                                                        <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : '-' }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td style="padding: 5px; border: 1px solid #ddd;">
                                                @if ($inreview->isEmpty())
                                                    <div>-</div>
                                                @else
                                                    @foreach ($inreview as $temp)
                                                        <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : '-' }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                    {{-- @if(in_array($document->document_type_id, ['SOP','BOM', 'FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','BMR','BPR','SPEC','STP','TDS','GTP'])) --}}

                @if(in_array($document->document_type_id, ['SOP']))
                    <div class="col-12" style="display:none;">
                        <div class="inner-block doc-overview">

                        <form method="POST" action="{{ route('documentReviewComment', $document->id) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Reviewer Comments Section -->
                            <div class="col-12 mt-3">
                                <div class="orig-head">
                                    <label for="reviewer_comments"><b style="color:#4274da;">Reviewer Comments Given By</b></label>
                                </div>
                                
                                @php
                                    $assignedReviewers = explode(",", $document->reviewers);
                                    $reviewerComments = $document->reviewer_comments ? json_decode($document->reviewer_comments, true) : [];
                                    $currentUserId = auth()->id();
                                @endphp
                                
                                @foreach ($assignedReviewers as $reviewerId)
                                    @php
                                        $reviewerUser = DB::table('users')->where('id', $reviewerId)->first();
                                    @endphp
                                    
                                    @if ($reviewerUser)
                                        <div class="comment-box">
                                            <label><b>{{ $reviewerUser->name }}  Comments</b></label>
                                            <textarea class="form-control reviewer-comment" 
                                                name="reviewer_comments[{{ $reviewerUser->id }}]" 
                                                placeholder="Enter your comment..." 
                                                rows="3" 
                                                @if($currentUserId != $reviewerUser->id) disabled @endif>{{ old('reviewer_comments.' . $reviewerUser->id, $reviewerComments[$reviewerUser->id] ?? '') }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <!-- Approver Comments Section -->
                            <div class="col-12 mt-3">
                                <div class="orig-head">
                                    <label for="approver_comments"><b style="color:#4274da;">Approver Comments Given By</b></label>
                                </div>
                                
                                @php
                                    $assignedApprovers = explode(",", $document->approvers);
                                    $approverComments = $document->approver_comments ? json_decode($document->approver_comments, true) : [];
                                @endphp
                                
                                @foreach ($assignedApprovers as $approverId)
                                    @php
                                        $approverUser = DB::table('users')->where('id', $approverId)->first();
                                    @endphp
                                    
                                    @if ($approverUser)
                                        <div class="comment-box">
                                            <label><b>{{ $approverUser->name }}  Comments</b></label>
                                            <textarea class="form-control approver-comment" 
                                                name="approver_comments[{{ $approverUser->id }}]" 
                                                placeholder="Enter your comment..." 
                                                rows="3" 
                                                @if($currentUserId != $approverUser->id) disabled @endif>{{ old('approver_comments.' . $approverUser->id, $approverComments[$approverUser->id] ?? '') }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <div class="inner-block doc-overview">

                        <form method="POST" action="{{ route('documentReviewComment', $document->id) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Reviewer Comments Section -->
                            <div class="col-12 mt-3">
                                <div class="orig-head">
                                    <label for="reviewer_comments"><b style="color:#4274da;">Reviewer Comments Given By</b></label>
                                </div>
                                
                                @php
                                    $assignedReviewers = explode(",", $document->reviewers);
                                    $reviewerComments = $document->reviewer_comments ? json_decode($document->reviewer_comments, true) : [];
                                    $currentUserId = auth()->id();
                                @endphp
                                
                                @foreach ($assignedReviewers as $reviewerId)
                                    @php
                                        $reviewerUser = DB::table('users')->where('id', $reviewerId)->first();
                                    @endphp
                                    
                                    @if ($reviewerUser)
                                        <div class="comment-box">
                                            <label><b>{{ $reviewerUser->name }} Comments</b></label>
                                            <textarea class="form-control reviewer-comment" 
                                                name="reviewer_comments[{{ $reviewerUser->id }}]" 
                                                placeholder="Enter your comment..." 
                                                rows="3" 
                                                @if($currentUserId != $reviewerUser->id) disabled @endif>{{ old('reviewer_comments.' . $reviewerUser->id, $reviewerComments[$reviewerUser->id] ?? '') }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <!-- Approver Comments Section -->
                            <div class="col-12 mt-3">
                                <div class="orig-head">
                                    <label for="approver_comments"><b style="color:#4274da;">Approver Comments Given By</b></label>
                                </div>
                                
                                @php
                                    $assignedApprovers = explode(",", $document->approvers);
                                    $approverComments = $document->approver_comments ? json_decode($document->approver_comments, true) : [];
                                @endphp
                                
                                @foreach ($assignedApprovers as $approverId)
                                    @php
                                        $approverUser = DB::table('users')->where('id', $approverId)->first();
                                    @endphp
                                    
                                    @if ($approverUser)
                                        <div class="comment-box">
                                            <label><b>{{ $approverUser->name }}  Comments</b></label>
                                            <textarea class="form-control approver-comment" 
                                                name="approver_comments[{{ $approverUser->id }}]" 
                                                placeholder="Enter your comment..." 
                                                rows="3" 
                                                @if($currentUserId != $approverUser->id) disabled @endif>{{ old('approver_comments.' . $approverUser->id, $approverComments[$approverUser->id] ?? '') }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-12">
                        <div class="inner-block doc-overview">

                        <form method="POST" action="{{ route('documentReviewComment', $document->id) }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Reviewer Comments Section -->
                                <div class="col-12 mt-3">
                                    <div class="orig-head">
                                        <label for="reviewer_comments"><b style="color:#4274da;">Reviewer Comments Given By</b></label>
                                    </div>
                                    
                                    @php
                                        $assignedReviewers = explode(",", $document->reviewers);
                                        $reviewerComments = $document->reviewer_comments ? json_decode($document->reviewer_comments, true) : [];
                                        $currentUserId = auth()->id();
                                    @endphp
                                    
                                    @foreach ($assignedReviewers as $reviewerId)
                                        @php
                                            $reviewerUser = DB::table('users')->where('id', $reviewerId)->first();
                                        @endphp
                                        
                                        @if ($reviewerUser)
                                            <div class="comment-box">
                                                <label><b>{{ $reviewerUser->name }} Reviewer Comments</b></label>
                                                <input type="text" class="form-control reviewer-comment" 
                                                    name="reviewer_comments[{{ $reviewerUser->id }}]" 
                                                    value="{{ old('reviewer_comments.' . $reviewerUser->id, $reviewerComments[$reviewerUser->id] ?? '') }}"
                                                    placeholder="Enter your comment..."
                                                    @if($currentUserId != $reviewerUser->id) disabled @endif>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
                                <!-- Approver Comments Section -->
                                <div class="col-12 mt-3">
                                    <div class="orig-head">
                                        <label for="approver_comments"><b style="color:#4274da;">Approver Comments Given By</b></label>
                                    </div>
                                    
                                    @php
                                        $assignedApprovers = explode(",", $document->approvers);
                                        $approverComments = $document->approver_comments ? json_decode($document->approver_comments, true) : [];
                                    @endphp
                                    
                                    @foreach ($assignedApprovers as $approverId)
                                        @php
                                            $approverUser = DB::table('users')->where('id', $approverId)->first();
                                        @endphp
                                        
                                        @if ($approverUser)
                                            <div class="comment-box">
                                                <label><b>{{ $approverUser->name }} Approver Comments</b></label>
                                                <input type="text" class="form-control approver-comment" 
                                                    name="approver_comments[{{ $approverUser->id }}]" 
                                                    value="{{ old('approver_comments.' . $approverUser->id, $approverComments[$approverUser->id] ?? '') }}"
                                                    placeholder="Enter your comment..."
                                                    @if($currentUserId != $approverUser->id) disabled @endif>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="doc-hods">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">HOD</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="modal-body">
                    <div class="reviewer-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>HOD</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $hod_data = !empty($document->hods) ? explode(',', $document->hods) : [];
                                    $i = 0;
                                @endphp
                                @for ($i = 0; $i < count($hod_data); $i++)
                                    @php
                                        $user = DB::table('users')
                                            ->where('id', $hod_data[$i])
                                            ->first();
                                        $user->department = DB::table('departments')
                                            ->where('id', $user->departmentid)
                                            ->value('name');
                                        $user->status = DB::table('stage_manages')
                                            ->where('user_id', $hod_data[$i])
                                            ->where('document_id', $document->id)
                                            ->where('stage', 'HOD Review-Submit')
                                            ->where('deleted_at', null)
                                            ->latest()
                                            ->first();
                                        $user->statusReject = DB::table('stage_manages')
                                            ->where('user_id', $hod_data[$i])
                                            ->where('document_id', $document->id)
                                            ->where('stage', 'Cancel-by-HOD')
                                            ->where('deleted_at', null)
                                            ->latest()
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->department }}</td>
                                        @if ($user->status)
                                            <td>HOD Review complete <i class="fa-solid fa-circle-check text-success"></i>
                                            </td>
                                        @elseif($user->statusReject)
                                            <td>Rejected <i class="fa-solid fa-circle-xmark text-danger"></i></td>
                                        @else
                                            <td>HOD Review Pending</td>
                                        @endif
                                        {{-- <td><a
                                                href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button type="button">Audit Trial</button></a></td> --}}
                                    </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title">Reviewer Group</h4>
                    </div>

                    @if ($document->stage <= 2)
                        <div class="add-reviewer">
                            <select id="choices-multiple-remove-button" name="reviewers_group[]"
                                placeholder="Select Reviewers" multiple>
                                @if (!empty($reviewergroup))
                                    @foreach ($reviewergroup as $lan)
                                        <option value="{{ $lan->id }}">
                                            @if ($document->reviewers_group)
                                                @php
                                                    $data = explode(',', $document->reviewers_group);
                                                    $count = count($data);
                                                    $i = 0;
                                                @endphp
                                                @for ($i = 0; $i < $count; $i++)
                                                    @if ($data[$i] == $lan->id)
                                                        selected
                                                    @endif
                                                @endfor
                                            @endif>
                                            {{ $lan->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                    @if ($document->reviewers_group)
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
                                                {{-- @if (count($users) > 0)
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
                                    @endif --}}
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
                                                                    $userdata->approval = DB::table('stage_manages')
                                                                        ->where('document_id', $document->id)
                                                                        ->where('user_id', $users[$j])
                                                                        ->where('stage', 'Review-Submit')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();
                                                                    $userdata->reject = DB::table('stage_manages')
                                                                        ->where('document_id', $document->id)
                                                                        ->where('user_id', $users[$j])
                                                                        ->where('stage', 'Cancel-by-reviewer')
                                                                        ->where('deleted_at', null)
                                                                        ->latest()
                                                                        ->first();

                                                                @endphp
                                                                @if ($userdata->approval)
                                                                    <li><small>Reviewed <i
                                                                                class="fa-solid fa-circle-check text-success"></i></small>
                                                                    </li>
                                                                @elseif($userdata->reject)
                                                                    <li><small>Rejected <i
                                                                                class="fa-solid fa-circle-xmark text-danger"></i></small>
                                                                    </li>
                                                                @else
                                                <td>Review Pending</td>
                                                <td><a
                                                        href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                            type="button">Audit</button></a></td>

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
                <button type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade modal-lg" id="doc-reviewers">
        <form action="{{ route('update-doc', $document->id) }}" method="post">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                     @if($document->document_type_id == 'SOP')
                    <div class="modal-header">
                        <h4 class="modal-title">Reviewers</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    @else
                    <div class="modal-header">
                        <h4 class="modal-title">Checked By</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    @endif


                    <!-- Modal body -->

                    <div class="modal-body">
                        @if ($document->stage <= 2)
                            <div class="add-reviewer">
                                <select id="choices-multiple-remove-button" name="reviewers[]"
                                    placeholder="Select Reviewers" multiple>
                                    @if (!empty($reviewer))
                                        @foreach ($reviewer as $lan)
                                            <option value="{{ $lan->id }}">
                                                @if ($document->reviewers)
                                                    @php
                                                        $data = explode(',', $document->reviewers);
                                                        $count = count($data);
                                                        $i = 0;
                                                    @endphp
                                                    @for ($i = 0; $i < $count; $i++)
                                                        @if ($data[$i] == $lan->id)
                                                            selected
                                                        @endif
                                                    @endfor
                                                @endif>
                                                {{ $lan->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        <div class="reviewer-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    @if($document->document_type_id == 'SOP')
                                    <tr>
                                        <th>Reviewers</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Audit Trial</th>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Checked By</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Audit Trial</th>
                                    </tr>
                                    @endif
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
                                            $user->statusReject = DB::table('stage_manages')
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
                                            @elseif($user->statusReject)
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
                        @if($document->document_type_id == 'SOP')
                        <div class="modal-header">
                            <h4 class="modal-title">Reviewer Group</h4>
                        </div>
                        @else
                        <div class="modal-header">
                            <h4 class="modal-title">Checked Group</h4>
                        </div>
                        @endif

                        @if ($document->stage <= 2)
                            <div class="add-reviewer">
                                <select id="choices-multiple-remove-button" name="reviewers_group[]"
                                    placeholder="Select Reviewers" multiple>
                                    @if (!empty($reviewergroup))
                                        @foreach ($reviewergroup as $lan)
                                            <option value="{{ $lan->id }}">
                                                @if ($document->reviewers_group)
                                                    @php
                                                        $data = explode(',', $document->reviewers_group);
                                                        $count = count($data);
                                                        $i = 0;
                                                    @endphp
                                                    @for ($i = 0; $i < $count; $i++)
                                                        @if ($data[$i] == $lan->id)
                                                            selected
                                                        @endif
                                                    @endfor
                                                @endif>
                                                {{ $lan->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($document->reviewers_group)
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
                                                                        $userdata->approval = DB::table('stage_manages')
                                                                            ->where('document_id', $document->id)
                                                                            ->where('user_id', $users[$j])
                                                                            ->where('stage', 'Review-Submit')
                                                                            ->where('deleted_at', null)
                                                                            ->latest()
                                                                            ->first();
                                                                        $userdata->reject = DB::table('stage_manages')
                                                                            ->where('document_id', $document->id)
                                                                            ->where('user_id', $users[$j])
                                                                            ->where('stage', 'Cancel-by-reviewer')
                                                                            ->where('deleted_at', null)
                                                                            ->latest()
                                                                            ->first();

                                                                    @endphp
                                                                    @if ($userdata->approval)
                                                                        <li><small>Reviewed <i
                                                                                    class="fa-solid fa-circle-check text-success"></i></small>
                                                                        </li>
                                                                    @elseif($userdata->reject)
                                                                        <li><small>Rejected <i
                                                                                    class="fa-solid fa-circle-xmark text-danger"></i></small>
                                                                        </li>
                                                                    @else
                                                    <td>Review Pending</td>
                                                    <td><a
                                                            href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                                type="button">Audit</button></a></td>

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

                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
        </form>

    </div>
    </div>
    </div>

    <div class="modal fade modal-lg" id="doc-approvers">
        <form action="{{ route('update-doc', $document->id) }}" method="post">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Approvers</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        @if ($document->stage <= 4)
                            <div class="add-reviewer">
                                <select id="choices-multiple-remove-button" name="approvers[]"
                                    placeholder="Select Reviewers" multiple>
                                    @if (!empty($approvers))
                                        @foreach ($approvers as $lan)
                                            <option value="{{ $lan->id }}"
                                                @if ($document->reviewers_group) @php
                                $data = explode(",",$document->approvers);
                                $count = count($data);
                                $i=0;
                                @endphp
                                @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $lan->id)
                                    selected @endif
                                                @endfor
                                        @endif>
                                        {{ $lan->name }}
                                        </option>
                                    @endforeach
                        @endif
                        </select>
                    </div>
                    @endif
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
                                            ->where('document_id', $document->id)
                                            ->where('stage', 'Approval-submit')
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
                                        @if ($user->status)
                                            <td>Approved <i class="fa-solid fa-circle-check text-success"></i></td>
                                        @elseif($user->reject)
                                            <td>Rejected <i class="fa-solid fa-circle-xmark text-danger"></i></td>
                                        @else
                                            <td>Approval Pending</td>
                                        @endif
                                        <td><a
                                                href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                    type="button">Audit</button></a></td>


                                    </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title">Approvers Group</h4>
                    </div>
                    @if ($document->stage <= 4)
                        <div class="add-reviewer">
                            <select id="choices-multiple-remove-button" name="approver_group[]"
                                placeholder="Select Reviewers" multiple>
                                @if (!empty($approversgroup))
                                    @foreach ($approversgroup as $lan)
                                        <option value="{{ $lan->id }}"
                                            @if ($document->approver_group) @php
                            $data = explode(",",$document->approver_group);
                            $count = count($data);
                            $i=0;
                            @endphp
                            @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $lan->id)
                                selected @endif
                                            @endfor
                                    @endif>
                                    {{ $lan->name }}
                                    </option>
                                @endforeach
                    @endif

                    </select>
                </div>
                @endif
                @if ($document->approver_group)
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
                                            {{-- @if (count($users) > 0)
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
                                    @endif --}}
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
                                        @if ($document->stage >= 5)
                                            <td>Approved <i class="fa-solid fa-circle-check text-success"></i>
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
                                                                    ->where('stage', 'Approval-Submit')
                                                                    ->where('deleted_at', null)
                                                                    ->latest()
                                                                    ->first();
                                                                $userdata->reject = DB::table('stage_manages')
                                                                    ->where('document_id', $document->id)
                                                                    ->where('user_id', $users[$j])
                                                                    ->where('stage', 'Cancel-by-approver')
                                                                    ->where('deleted_at', null)
                                                                    ->latest()
                                                                    ->first();

                                                            @endphp
                                                            @if ($userdata->approval)
                                                                <li><small>Approved <i
                                                                            class="fa-solid fa-circle-check text-success"></i></small>
                                                                </li>
                                                            @elseif($userdata->reject)
                                                                <li><small>Rejected <i
                                                                            class="fa-solid fa-circle-xmark text-danger"></i></small>
                                                                </li>
                                                            @else
                                            <td>Approval Pending</td>

                                        @endif
                                        <td><a
                                                href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                                                    type="button">Audit</button></a></td>

                                @endfor

                                </ul>
                @endif
                </td>
            @else
                <td>Approval Pending</td>
                @endif
                <td><a href="{{ url('audit-individual/') }}/{{ $document->id }}/{{ $user->id }}"><button
                            type="button">Audit</button></a></td>

                </tr>
                @endfor

                </tbody>
                </table>
            </div>
            @endif
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        {{-- @if ($document->stage != 1)
            <button type="submit">Update</button>
        @endif --}}
        <button type="button" data-bs-dismiss="modal">Close</button>
    </div>
    </form>
    </div>
    </div>
    </div>

    <div class="modal fade" id="approve-sign">
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
                            <label for="username">Username<span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('username') }}" name="username" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">User name not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" value="{{ old('password') }}" name="password" required>
                            @if ($errors->has('username'))
                                <p class="text-danger">E-signature not matched</p>
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input required name="comment" value="{{ old('comment') }}" />
                        </div>
                    </div>


                @if($document->document_type_id == 'SOP')
                    @if ($document->stage == 1)
                        <input type="hidden" name="stage_id" value="2" />
                    @endif

                    @if ($document->stage == 3)
                        <input type="hidden" name="stage_id" value="4" />
                    @endif
                    @if ($document->stage == 5)
                        <input type="hidden" name="stage_id" value="6" />
                    @endif
                    @if ($document->training_required == 'yes')
                        @if ($document->stage == 7)
                            <input type="hidden" name="stage_id" value="8" />
                        @endif
                        @if ($document->stage == 8)
                            <input type="hidden" name="stage_id" value="9" />
                        @endif
                        @if ($document->stage == 9)
                            <input type="hidden" name="stage_id" value="10" />
                        @endif
                        {{-- @if ($document->stage == 10)
                            <input type="hidden" name="stage_id" value="11" />
                        @endif --}}
                        @if ($document->stage == 11)
                            <input type="hidden" name="stage_id" value="14" />
                        @endif
                        
                    @else
                        @if ($document->stage == 7)
                            <input type="hidden" name="stage_id" value="10" />
                        @endif
                        {{-- @if ($document->stage == 10)
                            <input type="hidden" name="stage_id" value="11" />
                        @endif --}}
                        @if ($document->stage == 11)
                            <input type="hidden" name="stage_id" value="14" />
                        @endif
                    @endif
                
                @else
                    @if ($document->stage == 1)
                        <input type="hidden" name="stage_id" value="4" />
                    @endif

                    @if ($document->stage == 5)
                        <input type="hidden" name="stage_id" value="6" />
                    @endif

                    @if ($document->training_required == 'yes')
                        @if ($document->stage == 7)
                            <input type="hidden" name="stage_id" value="8" />
                        @endif
                        @if ($document->stage == 8)
                            <input type="hidden" name="stage_id" value="9" />
                        @endif
                        @if ($document->stage == 9)
                            <input type="hidden" name="stage_id" value="10" />
                        @endif
                        {{-- @if ($document->stage == 10)
                            <input type="hidden" name="stage_id" value="13" />
                        @endif --}}
                        @if ($document->stage == 11)
                            <input type="hidden" name="stage_id" value="14" />
                        @endif
                    @else
                        @if ($document->stage == 7)
                            <input type="hidden" name="stage_id" value="10" />
                        @endif
                        {{-- @if ($document->stage == 10)
                            <input type="hidden" name="stage_id" value="11" />
                        @endif --}}
                        @if ($document->stage == 11)
                            <input type="hidden" name="stage_id" value="14" />
                        @endif
                    @endif
                
                
                @endif
                   
                   

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
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
                <form action="{{ url('sendforstagechanage') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="stage_id" value="12" />
                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and an outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is the legally binding equivalent of a handwritten signature.
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
                            <input type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <h4 class="modal-title" style="font-weight: 900">Document Revision</h4>
                </div>

                @if ($document->revised === 'Yes')

                    <form method="POST" action="{{ url('revision', $document->revised_doc) }}">
                @else
                    <form method="POST" action="{{ url('revision', $document->id) }}">
                @endif

                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="group-input">
                        <label for="revision">Choose Revision Version</label>
                        <label for="major">
                            Major Version<span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-management-system-modal"
                                style="font-size: 0.8rem; font-weight: 400;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <input type="number" name="major" id="major" min="0">

                        <label for="reason">
                            Comment
                        </label>
                        <input type="text" name="reason" required>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit">Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <style>
        .group-input input {
            width: 60%;
        }
    </style>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var pdfObject = document.querySelector('iframe#theFrame"]');
            var pdfDocument = pdfObject.contentDocument;
            var firstPage = pdfDocument.querySelector('.page:first-of-type');
            firstPage.style.display = 'none';
        });
    </script>
    <script>
        // JavaScript to open modal when obsolete button is clicked
        document.getElementById('obsolete-button').addEventListener('click', function() {
            $('#signature-modal').modal('show');
        });
    </script>
@endsection
