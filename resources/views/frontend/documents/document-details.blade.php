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
    @php
        $users = DB::table('users')->orderByRaw('LOWER(name) ASC')->get();
    @endphp

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

                                    @if ($document->status !== 'Effective' && $document->status !== 'Obsolete')
                                        <button onclick="location.href='{{ route('documents.edit', $document->id) }}';">Edit
                                        </button>
                                        {{-- <button>Cancel</button> --}}
                                    @endif
                                    {{-- @if (Helpers::checkControlAccess())
                                        <button
                                            onclick="location.href='{{ url('documents/generatePdf', $document->id) }}';">Download
                                        </button>
                                    @endif --}}

                                    @php
                                        $effectiveTypes = [
                                            'SOP','FPS','INPS','CVS','RAWMS','PAMS','PIAS',
                                            'MFPS','MFPSTP','FPSTP','INPSTP','CVSTP',
                                            'RMSTP','SPEC','STP','TDS','GTP'
                                        ];
                                    @endphp

                                 
                                     @if (
                                        (in_array($document->document_type_id, $effectiveTypes) && $document->status == 'Effective')
                                        ||
                                        !in_array($document->document_type_id, $effectiveTypes)
                                    )
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#print-modal1">
                                        Download
                                    </button>
                                    
                                    @endif
                                    {{-- @if (Helpers::checkControlAccess())
                                        @if(in_array($document->document_type_id, ['BMR', 'BOM', 'BPR','SOP', 'FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','SPEC','STP','TDS','GTP']))
                                        <button onclick="location.href='{{ url('documents/printPDF', $document->id) }}';"
                                            target="__blank">
                                            Print
                                        </button>
                                        @endif
                                    @endif --}}
                                    

                                    @if (
                                        (in_array($document->document_type_id, $effectiveTypes) && $document->status == 'Effective')
                                        ||
                                        !in_array($document->document_type_id, $effectiveTypes)
                                    )
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#print-modal">
                                            Print
                                        </button>
                                    @endif
                                    {{-- @if (Helpers::checkControlAccess()) --}}
                                        @if(in_array($document->document_type_id, ['SOP']))
                                        <button onclick="location.href='{{ url('documents/printAnnexurePDF', $document->id) }}';"
                                            target="__blank">
                                            Print Annexure
                                        </button>
                                        @endif
                                    {{-- @endif --}}

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
                                        {{ $document->document_number }}
                                    </div>
                                </div>                                
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
                                        <div>{{ $document->oreginator?->name }}</div>
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
                    @if(in_array($document->document_type_id, ['SOP','FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','SPEC','STP','TDS','GTP']))
                    <div class="col-8">
                        <div class="inner-block tracker">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="main-title">
                                    Record Workflow
                                </div>

                                @if($document->document_type_id == 'EOP')
                                        
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
                                            Send For Checking<i class="fa-regular fa-paper-plane"></i>
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
                                        @if($document->document_type_id == 'EOP')
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
                                        
                                            {{--  Not required for SOP document --}}
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
                                                    <div class="active">Under-Training</div>
                                                @else
                                                    <div class="">Under-Training</div>
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
                                                <div class="active">For Checking</div>
                                            @else
                                                <div class="">For Checking</div>
                                            @endif
                                            {{-- @if ($document->stage == 9)
                                                <div class="active">Rejected</div>
                                            @endif --}}
                                            @if ($document->stage >= 5)
                                                <div class="active">Checked</div>
                                            @else
                                                <div class="">Checked</div>
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
                                                    <div class="active">Under-Training</div>
                                                @else
                                                    <div class="">Under-Training</div>
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
                            @if($document->document_type_id == 'EOP')
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

                            @if($document->document_type_id == 'EOP')
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
                    @endif

                    <div class="col-12">
                        <div class="inner-block doc-overview">
                            <div class="main-title">Preview</div>

                            @if(in_array($document->document_type_id, ['SOP']))
                                <iframe id="theFrame" width="100%" height="800"
                                    src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                                <iframe id="theFrame" width="100%" height="800"
                                    src="{{ url('documents/annexureviewpdf/' . $document->id) }}#toolbar=0"></iframe>
                            
                            @elseif(in_array($document->document_type_id, ['FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','SPEC','STP','TDS','GTP']))
                                <iframe id="theFrame" width="100%" height="800"
                                src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                                
                            @else

                                    <iframe
                                        src="{{ route('view.attachments', $document->id) }}"
                                        width="100%"
                                        height="700"
                                        frameborder="0">
                                    </iframe>
                               
                                @if(in_array($document->document_type_id, ['SOP','FPS', 'INPS','CVS','RAWMS','PAMS','PIAS','MFPS','MFPSTP','FPSTP','INPSTP','CVSTP','RMSTP','SPEC','STP','TDS','GTP']))
                

                                    <table class="border" style="width: 100%; border-collapse: collapse; text-align: left; margin: 20px auto; font-size: 16px;">
                                        <thead>
                                            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                                                <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 20%;"></th>
                                                <th style="padding: 5px; border: 1px solid #ddd; font-weight: bold; width: 25%;">Prepared Byhhhh</th>
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
                                                        ->where('stage', 'Review-Submit')
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
                            @if ($document->stage == 1 || $document->stage == 4 || $document->stage == 5)
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

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            @endif
                            
                            <!-- Approver Comments Section -->
                            @if ($document->stage == 6 || $document->stage == 7)
                                <div class="col-12 mt-3">
                                    <div class="orig-head">
                                        <label for="approver_comments"><b style="color:#4274da;">Approver Comments Given By</b></label>
                                    </div>
                                    
                                    @php
                                        $assignedApprovers = explode(",", $document->approvers);
                                        $approverComments = $document->approver_comments ? json_decode($document->approver_comments, true) : [];
                                        $currentUserId = auth()->id();
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
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            @endif
                            
                            <!-- Submit Button -->
                            <!-- <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> -->
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
                                        if (!$user) {
                                            continue;
                                        }
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
                                        <td>{{ $user->name ?? 'N/A' }}</td>
                                        <td>{{ $user->department ?? 'N/A' }}</td>
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
                                                <div>{{ $user->name ?? 'N/A' }}</div>
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

                                            <td>{{ $user->department ?? 'N/A' }}
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
                     @if($document->document_type_id == 'EOP')
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
                                    @if($document->document_type_id == 'EOP')
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
                                            if (!$user) {
                                                continue;
                                            }
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
                        @if($document->document_type_id == 'EOP')
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
                                        if (!$user) {
                                            continue;
                                        }
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


                @if($document->document_type_id == 'EOP')
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
                        <button type="submit" class="btn btn-secondary">Submit</button>
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
                        {{-- <label for="revision">Choose Revision Version</label>
                        <label for="major">
                            Major Version<span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-management-system-modal"
                                style="font-size: 0.8rem; font-weight: 400;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <input type="number" name="major" id="major" min="0"> --}}

                        <label for="reason">
                            Reason For Revision
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

    <!-- updated print-model -->
    @php
        /*
        |--------------------------------------------------------------------------
        | Current document ke opened requests
        |--------------------------------------------------------------------------
        */

        $printDocumentRequests = collect();

        if (!empty($document->id)) {

            /*
            |--------------------------------------------------------------------------
            | Already used Request IDs in Download
            |--------------------------------------------------------------------------
            */

            $downloadRequestIds = \App\Models\DownloadHistory::where(
                    'document_id',
                    $document->id
                )
                ->whereNotNull('request_id')
                ->pluck('request_id')
                ->toArray();

            /*
            |--------------------------------------------------------------------------
            | Already used Request IDs in Print
            |--------------------------------------------------------------------------
            */

            $printRequestIds = \App\Models\PrintHistory::where(
                    'document_id',
                    $document->id
                )
                ->whereNotNull('request_id')
                ->pluck('request_id')
                ->toArray();

            /*
            |--------------------------------------------------------------------------
            | Merge both
            |--------------------------------------------------------------------------
            */

            $usedRequestIds = array_unique(
                array_merge(
                    $downloadRequestIds,
                    $printRequestIds
                )
            );

            /*
            |--------------------------------------------------------------------------
            | Only unused opened Request IDs
            |--------------------------------------------------------------------------
            */

            $printDocumentRequests = \App\Models\DocumentRequest::where(
                        'document_id',
                        $document->id
                    )
                    ->where('status', 'Closed - Done')
                    ->whereNotIn(
                        'request_id',
                        $usedRequestIds)
                    ->orderBy('record', 'asc')->get();
        }
    @endphp

    {{--Print Documents--}}
    <div class="modal fade" id="print-modal" tabindex="-1" aria-labelledby="printDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="printDocumentModalLabel">
                        Print Document
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <form id="document-print-form" action="{{ route('document.print.pdf', $document->id) }}" method="GET" target="_blank" >

                    @csrf
                    <input type="hidden" name="current_document_record" value="{{ $document->id }}" >
                    <div class="modal-body">

                        {{-- ================================================= --}}
                        {{-- Request ID --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_document_request_id">
                                Request ID
                                <span class="text-danger">*</span>
                            </label>

                            <select id="print_document_request_id" name="document_request_id" class="form-control w-100" required onchange="fillPrintRequestDetails(this)">
                                <option value="">
                                    -- Select Request ID --
                                </option>

                                @forelse($printDocumentRequests as $printRequest)

                                    @php
                                        $printRequestToUser = \App\Models\User::find($printRequest->request_to
                                            );

                                        $printRequestToName = $printRequestToUser ? $printRequestToUser->name : '';

                                        $printDepartmentName = '';

                                        if ($printRequestToUser) {
                                            $printDepartmentName = \App\Models\Department::where(
                                                    'id',
                                                    $printRequestToUser
                                                        ->departmentid
                                                )->value('name');
                                        }

                                        $printRequestId = $printRequest->request_id ?? ('Request-' . str_pad($printRequest->record, 3, '0', STR_PAD_LEFT));
                                    @endphp

                                    <option value="{{ $printRequest->id }}"

                                        data-request-id="{{ $printRequestId }}"

                                        data-request-record="{{ $printRequest->record }}"

                                        data-request-to="{{ $printRequest->request_to ?? '' }}"

                                        data-request-to-name="{{ $printRequestToName}}"

                                        data-department="{{ $printDepartmentName }}"

                                        data-number-of-copies="{{ $printRequest->number_of_copies ?? '' }}"

                                        data-reason="{{$printRequest->reason ?? '' }}">
                                        {{ $printRequestId }}
                                    </option>

                                @empty

                                    <option value="" disabled>
                                        Not request found
                                    </option>

                                @endforelse

                            </select>

                            @if($printDocumentRequests->isEmpty())

                                <small class="text-danger">
                                    Not found request for this document.
                                </small>

                            @endif

                        </div>


                        {{-- Backend hidden request record --}}

                        <input type="hidden" id="print_request_record" name="request_record" >

                        {{-- ================================================= --}}
                        {{-- Issued By --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_issued_by">
                                Issued By
                            </label>

                            <input type="text" id="print_issued_by" class="form-control w-100 print-readonly-field" value="{{ Auth::user()->name }}" readonly>

                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued Date --}}
                        {{-- ================================================= --}}

                        <div class="group-input new-date-data-field mb-3">

                            <label for="print_issued_date">
                                Issued Date
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-date">

                                <div class="calenderauditee">

                                    <input type="text" id="print_issued_date_display" placeholder="DD-MMM-YYYY" class="form-control w-100" readonly required onclick="openPrintIssuedDatePicker()">

                                    <input type="date" id="print_issued_date" name="issued_date" class="hide-input" required oninput="handlePrintDateInput(this, 'print_issued_date_display')">

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- Copies --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_issued_copies">
                                Number of Issued Copies
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number" id="print_issued_copies" name="issued_copies" min="1" class="form-control w-100 print-readonly-field" readonly required >

                        </div>


                        {{-- ================================================= --}}
                        {{-- Print Reason --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_reason_print">
                                Print Reason
                                <span class="text-danger">*</span>
                            </label>

                            <textarea id="print_reason_print" name="print_reason" class="form-control w-100 print-readonly-field" maxlength="255" rows="3" readonly required></textarea>

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued To --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_issuance_to_name">
                                Issued To
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="print_issuance_to_name" class="form-control w-100 print-readonly-field" readonly required >

                            <input type="hidden" id="print_issuance_to" name="issuance_to" >

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued To Department --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_department_name">
                                Issued To Department
                            </label>

                            <input type="text" id="print_department_name" class="form-control w-100 print-readonly-field" readonly >

                            <input type="hidden" id="print_department" name="department" >

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary rounded"
                            {{ $printDocumentRequests->isEmpty() ? 'disabled' : '' }} >
                            Submit
                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        function fillPrintRequestDetails(selectElement) {

            const selectedOption =
                selectElement.options[
                    selectElement.selectedIndex
                ];

            const requestRecord =
                selectedOption.dataset.requestRecord || '';

            const requestTo =
                selectedOption.dataset.requestTo || '';

            const requestToName =
                selectedOption.dataset.requestToName || '';

            const department =
                selectedOption.dataset.department || '';

            const numberOfCopies =
                selectedOption.dataset.numberOfCopies || '';

            const reason =
                selectedOption.dataset.reason || '';


            document
                .getElementById('print_request_record')
                .value = requestRecord;

            document
                .getElementById('print_issued_copies')
                .value = numberOfCopies;

            document
                .getElementById('print_reason_print')
                .value = reason;

            document
                .getElementById('print_issuance_to')
                .value = requestTo;

            document
                .getElementById('print_issuance_to_name')
                .value = requestToName;

            document
                .getElementById('print_department')
                .value = department;

            document
                .getElementById('print_department_name')
                .value = department;
        }


        function openPrintIssuedDatePicker() {

            const dateInput =
                document.getElementById(
                    'print_issued_date'
                );

            if (!dateInput) {
                return;
            }

            if (
                typeof dateInput.showPicker ===
                'function'
            ) {
                dateInput.showPicker();
            } else {
                dateInput.click();
            }
        }


        function handlePrintDateInput(
            dateInput,
            displayId
        ) {

            const displayInput =
                document.getElementById(displayId);

            if (!displayInput) {
                return;
            }

            if (!dateInput.value) {
                displayInput.value = '';
                return;
            }

            const parts =
                dateInput.value.split('-');

            const selectedDate =
                new Date(
                    Number(parts[0]),
                    Number(parts[1]) - 1,
                    Number(parts[2])
                );

            displayInput.value =
                selectedDate
                    .toLocaleDateString(
                        'en-GB',
                        {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        }
                    )
                    .replace(/ /g, '-');
        }


        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const printForm =
                    document.getElementById(
                        'document-print-form'
                    );

                if (!printForm) {
                    return;
                }

                printForm.addEventListener(
                    'submit',
                    function (event) {

                        const documentRequestId =
                            document
                                .getElementById(
                                    'print_document_request_id'
                                )
                                .value;

                        const issuedDate =
                            document
                                .getElementById(
                                    'print_issued_date'
                                )
                                .value;

                        const issuedCopies =
                            document
                                .getElementById(
                                    'print_issued_copies'
                                )
                                .value;

                        const issuanceTo =
                            document
                                .getElementById(
                                    'print_issuance_to'
                                )
                                .value;

                        if (!documentRequestId) {

                            event.preventDefault();

                            alert(
                                'Please select Request ID.'
                            );

                            return;
                        }

                        if (!issuedDate) {

                            event.preventDefault();

                            alert(
                                'Please select Issued Date.'
                            );

                            return;
                        }

                        if (
                            !issuedCopies ||
                            parseInt(
                                issuedCopies,
                                10
                            ) < 1
                        ) {

                            event.preventDefault();

                            alert(
                                'Invalid number of issued copies.'
                            );

                            return;
                        }

                        if (!issuanceTo) {

                            event.preventDefault();

                            alert(
                                'Issued To user is not available.'
                            );
                        }
                    }
                );
            }
        );
    </script>

    <style>
        .hide-input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
        }

        #print-modal .print-readonly-field {
            background-color: #f3f3f3 !important;
            color: #333 !important;
            cursor: not-allowed;
        }

        #print-modal .modal-body {
            max-height: 75vh;
            overflow-y: auto;
        }

        #print-modal textarea {
            resize: vertical;
        }
    </style>

    {{-- Download documents --}}
    @php

        $currentDocumentRecord = $document->id ?? null;

        $documentRequests = collect();

        if (!empty($currentDocumentRecord)) {

            /*
            |--------------------------------------------------------------------------
            | Already used Request IDs
            |--------------------------------------------------------------------------
            */

            $downloadRequestIds = \App\Models\DownloadHistory::where('document_id', $currentDocumentRecord)
            ->whereNotNull('request_id')
            ->pluck('request_id')
            ->toArray();

            $printRequestIds = \App\Models\PrintHistory::where('document_id', $currentDocumentRecord)
            ->whereNotNull('request_id')
            ->pluck('request_id')
            ->toArray();

            /*
            |--------------------------------------------------------------------------
            | Merge both arrays
            |--------------------------------------------------------------------------
            */

            $usedRequestIds = array_unique(
                array_merge(
                    $downloadRequestIds,
                    $printRequestIds
                )
            );

            /*
            |--------------------------------------------------------------------------
            | Only unused request ids
            |--------------------------------------------------------------------------
            */

            $documentRequests = \App\Models\DocumentRequest::where('document_id', $currentDocumentRecord)
                ->where('status', 'Closed - Done')
                ->whereNotIn('request_id', $usedRequestIds)
                ->orderBy('request_id', 'asc')
                ->get();
        }

    @endphp

    <div class="modal fade" id="print-modal1" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                {{-- Modal Header --}}
                <div class="modal-header">

                    <h4 class="modal-title" id="printModalLabel" >
                        Download Document
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>

                </div>


                <form id="document-download-form" action="{{ route('document.print.downloadpdf', $document->id ) }}" method="GET" target="_blank" >
                    @csrf
                    <input type="hidden" name="current_document_record" value="{{ $currentDocumentRecord }}" >
                    <div class="modal-body">

                        {{-- ================================================= --}}
                        {{-- Request ID Dropdown --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="document_request_id">
                                Request ID
                                <span class="text-danger">*</span>
                            </label>

                            <select id="document_request_id" name="document_request_id" class="form-control w-100" required onchange="fillDocumentRequestDetails(this)">

                                <option value="">
                                    -- Select Request ID --
                                </option>

                                @forelse (
                                    $documentRequests as $documentRequest)

                                    @php
                                        $requestToUser =\App\Models\User::find($documentRequest->request_to);

                                        $requestToName = $requestToUser ? $requestToUser->name : '';
                                    @endphp

                                    <option
                                        value="{{ $documentRequest->id }}"

                                        data-request-record="{{$documentRequest->request_id}}"

                                        data-department="{{ $documentRequest->department ?? '' }}"

                                        data-request-to="{{ $documentRequest->request_to ?? '' }}"

                                        data-request-to-name="{{ $requestToName }}"

                                        data-number-of-copies="{{ $documentRequest->number_of_copies ?? '' }}"

                                        data-reason="{{ $documentRequest->reason ?? '' }}">
                                        {{
                                            str_pad( $documentRequest->request_id, 3, '0', STR_PAD_LEFT)
                                        }}
                                    </option>

                                @empty

                                    <option value="" disabled >
                                        Not request found
                                    </option>

                                @endforelse

                            </select>

                            @if ($documentRequests->isEmpty())

                                <small class="text-danger">
                                    Not found request for this document.
                                </small>

                            @else

                                <small class="text-muted">
                                    Total matching requests:
                                    {{ $documentRequests->count() }}
                                </small>

                            @endif

                        </div>


                        {{-- Request record backend ke liye hidden --}}
                        <input
                            type="hidden"
                            id="request_record"
                            name="request_record"
                        >


                        {{-- ================================================= --}}
                        {{-- Issued By --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="Document_Printed_By">
                                Issued By
                            </label>

                            <input
                                type="text"
                                id="Document_Printed_By"
                                class="form-control w-100 modal-readonly-field"
                                value="{{ Auth::user()->name }}"
                                readonly
                            >

                            <input
                                type="hidden"
                                name="user_id"
                                value="{{ Auth::id() }}"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued Date --}}
                        {{-- ================================================= --}}

                        <div class="group-input new-date-data-field mb-3">

                            <label for="issued_date">
                                Issued Date
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-date">

                                <div class="calenderauditee">

                                    {{-- Display date field --}}
                                    <input
                                        type="text"
                                        id="issued_date_display"
                                        placeholder="DD-MMM-YYYY"
                                        class="form-control w-100"
                                        readonly
                                        required
                                        onclick="openIssuedDatePicker()"
                                    >

                                    {{-- Actual date field --}}
                                    <input
                                        type="date"
                                        id="issued_date"
                                        name="issued_date"
                                        class="hide-input"
                                        required
                                        oninput="handleDateInput(
                                            this,
                                            'issued_date_display'
                                        )"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- Number of Copies --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="issued_copies">
                                Number of Issued Copies
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                id="issued_copies"
                                name="issued_copies"
                                min="1"
                                class="form-control w-100 modal-readonly-field"
                                readonly
                                required
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- Download Reason --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="print_reason">
                                Download Reason
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                id="print_reason"
                                name="print_reason"
                                class="form-control w-100 modal-readonly-field"
                                maxlength="255"
                                rows="3"
                                readonly
                                required
                            ></textarea>

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued To --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="issuance_to_name">
                                Issued To
                                <span class="text-danger">*</span>
                            </label>

                            {{-- Display user name --}}
                            <input
                                type="text"
                                id="issuance_to_name"
                                class="form-control w-100 modal-readonly-field"
                                readonly
                                required
                            >

                            {{-- Actual user ID --}}
                            <input
                                type="hidden"
                                id="issuance_to"
                                name="issuance_to"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- Issued To Department --}}
                        {{-- ================================================= --}}

                        <div class="group-input mb-3">

                            <label for="department_name">
                                Issued To Department
                            </label>

                            <input
                                type="text"
                                id="department_name"
                                class="form-control w-100 modal-readonly-field"
                                readonly
                            >

                            <input
                                type="hidden"
                                id="department"
                                name="department"
                            >

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="modal-footer">

                        <button
                            type="submit"
                            class="btn btn-primary rounded"
                            {{ $documentRequests->isEmpty()
                                ? 'disabled'
                                : ''
                            }}
                        >
                            Submit
                        </button>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        /**
         * Selected request ka data fields me auto-fill karega.
         */
        function fillDocumentRequestDetails(select) {

            const option =
                select.options[select.selectedIndex];

            const requestRecord =
                option.dataset.requestRecord || '';

            const department =
                option.dataset.department || '';

            const requestTo =
                option.dataset.requestTo || '';

            const requestToName =
                option.dataset.requestToName || '';

            const numberOfCopies =
                option.dataset.numberOfCopies || '';

            const reason =
                option.dataset.reason || '';


            /*
            |--------------------------------------------------------------------------
            | Request record hidden field
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('request_record')
                .value = requestRecord;


            /*
            |--------------------------------------------------------------------------
            | Number of copies
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('issued_copies')
                .value = numberOfCopies;


            /*
            |--------------------------------------------------------------------------
            | Download reason
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('print_reason')
                .value = reason;


            /*
            |--------------------------------------------------------------------------
            | Issued To
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('issuance_to')
                .value = requestTo;

            document
                .getElementById('issuance_to_name')
                .value = requestToName;


            /*
            |--------------------------------------------------------------------------
            | Department
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('department_name')
                .value = department;

            document
                .getElementById('department')
                .value = department;
        }


        /**
         * Hidden date input open karega.
         */
        function openIssuedDatePicker() {

            const dateInput =
                document.getElementById('issued_date');

            if (!dateInput) {
                return;
            }

            if (
                typeof dateInput.showPicker ===
                'function'
            ) {
                dateInput.showPicker();
            } else {
                dateInput.click();
            }
        }


        /**
         * YYYY-MM-DD date ko DD-MMM-YYYY me show karega.
         */
        function handleDateInput(
            dateInput,
            displayId
        ) {

            const displayInput =
                document.getElementById(displayId);

            if (!displayInput) {
                return;
            }

            if (!dateInput.value) {

                displayInput.value = '';

                return;
            }

            const [year, month, day] =
                dateInput.value.split('-');

            const selectedDate =
                new Date(
                    Number(year),
                    Number(month) - 1,
                    Number(day)
                );

            displayInput.value =
                selectedDate
                    .toLocaleDateString(
                        'en-GB',
                        {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        }
                    )
                    .replace(/ /g, '-');
        }


        /**
         * Form validation.
         */
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const form =
                    document.getElementById(
                        'document-download-form'
                    );

                if (!form) {
                    return;
                }

                form.addEventListener(
                    'submit',
                    function (event) {

                        const requestId =
                            document
                                .getElementById(
                                    'document_request_id'
                                )
                                .value;

                        const issuedDate =
                            document
                                .getElementById(
                                    'issued_date'
                                )
                                .value;

                        const issuedCopies =
                            document
                                .getElementById(
                                    'issued_copies'
                                )
                                .value;

                        const issuanceTo =
                            document
                                .getElementById(
                                    'issuance_to'
                                )
                                .value;


                        if (!requestId) {

                            event.preventDefault();

                            alert(
                                'Please select Request ID.'
                            );

                            return;
                        }


                        if (!issuedDate) {

                            event.preventDefault();

                            alert(
                                'Please select Issued Date.'
                            );

                            return;
                        }


                        if (
                            !issuedCopies ||
                            parseInt(
                                issuedCopies,
                                10
                            ) < 1
                        ) {

                            event.preventDefault();

                            alert(
                                'Invalid number of copies.'
                            );

                            return;
                        }


                        if (!issuanceTo) {

                            event.preventDefault();

                            alert(
                                'Issued To user is not available.'
                            );

                            return;
                        }
                    }
                );
            }
        );
    </script>

    <style>
        .hide-input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
        }

        #print-modal1 .modal-readonly-field {
            background-color: #f3f3f3 !important;
            color: #333 !important;
            cursor: not-allowed;
        }

        #print-modal1 .modal-body {
            max-height: 75vh;
            overflow-y: auto;
        }

        #print-modal1 textarea {
            resize: vertical;
        }
    </style>

    <style>
        .group-input input {
            width: 60%;
        }
    </style>
    {{-- <script>
        window.addEventListener('DOMContentLoaded', function() {
            var pdfObject = document.querySelector('iframe#theFrame"]');
            var pdfDocument = pdfObject.contentDocument;
            var firstPage = pdfDocument.querySelector('.page:first-of-type');
            firstPage.style.display = 'none';
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const obsoleteButton =
                document.getElementById('obsolete-button');

            if (obsoleteButton) {
                obsoleteButton.addEventListener(
                    'click',
                    function () {
                        $('#signature-modal').modal('show');
                    }
                );
            }

        });
    </script>
@endsection
