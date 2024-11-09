@extends('frontend.layout.main')
@section('container')
    <div id="audit-trial">
        <div class="container-fluid">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>VidyaGxP - Software</title>
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
            </head>

            <style>
                body {
                    font-family: 'Roboto', sans-serif;
                    margin: 0;
                    padding: 0;
                    /* min-width: 100vw; */
                    min-height: 100vh;
                }

                .w-10 {
                    width: 10%;
                }

                .w-20 {
                    width: 20%;
                }

                .w-30 {
                    width: 30%;
                }

                .w-40 {
                    width: 40%;
                }

                .w-50 {
                    width: 50%;
                }

                .w-60 {
                    width: 60%;
                }

                .w-70 {
                    width: 70%;
                }

                .w-80 {
                    width: 80%;
                }

                .w-90 {
                    width: 90%;
                }

                .w-100 {
                    width: 100%;
                }

                .h-100 {
                    height: 100%;
                }

                table,
                th,
                td {
                    border: 1px solid black;
                    border-collapse: collapse;
                    font-size: 0.9rem;
                }

                table {
                    width: 100%;
                }

                th,
                td {
                    padding: 10px;
                    text-align: left;
                }

                header .head {
                    font-weight: bold;
                    text-align: center;
                    font-size: 1.2rem;
                }

                @page {
                    size: A4;
                    margin-top: 160px;
                    margin-bottom: 60px;
                }

                header {
                    /* position: fixed; */
                    top: -140px;
                    left: 0;
                    width: 100%;
                    display: block;
                }

                footer {
                    /* position: fixed; */
                    bottom: -40px;
                    left: 0;
                    width: 100%;
                }

                .inner-block {
                    padding: 10px;
                }

                .inner-block .head {
                    font-weight: bold;
                    font-size: 1.2rem;
                    margin-bottom: 5px;
                }

                .inner-block .division {
                    margin-bottom: 10px;
                }

                .first-table {
                    border-top: 1px solid black;
                    margin-bottom: 20px;
                }

                .first-table table td,
                .first-table table th,
                .first-table table {
                    border: 0;
                }

                .second-table td:nth-child(1)>div {
                    margin-bottom: 10px;
                }

                .second-table td:nth-child(1)>div:nth-last-child(1) {
                    margin-bottom: 0px;
                }

                .table_bg {
                    background: #4274da57;
                }

                .heading {
                    border: 1px solid black;
                    padding: 10px;
                    margin-bottom: 10px;
                    margin-top: 10px;
                    background: ##ffc107;
                    ;
                }

                .heading-new {
                    font-size: 27px;
                    color: #2f2f58;
                }

                .buttons-new {
                    display: flex;
                    justify-content: end;
                    gap: 10px;
                }
            </style>

            <body>

                <header>
                    <table>
                        <tr>
                            <div class="logo">
                                <img src="https://development.vidyagxp.com/public/user/images/logo.png" alt=""
                                    class="w-100">
                            </div>
                        </tr>
                    </table>


                    <table>
                        <div class="buttons-new">
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#auditReviewer">
                                Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#auditViewers">
                                View
                            </button>
                            <a class="text-white" href="{{ url('/manageshow/' . $document->id) }}">
                                <button class="button_theme1">
                                    Back
                                </button>
                            </a>

                            <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> <button class="button_theme1">
                                    Exit
                            </a> </button>
                            {{-- <a href=""><button class="button_theme1" onclick="window.print();">
                                Print
                            </button></a> --}}
                        </div>
                        {{-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button> --}}






                        <div class="heading">
                            <div style="margin-bottom: 5px; font-weight: bold;">
                                Site Division/Project :
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/MR
                            </div>

                            <div class="heading-new">
                                Audit Trail
                            </div>

                            <div> <strong>Record ID. </strong> {{ str_pad($document->record, 4, '0', STR_PAD_LEFT) }}</div>
                            <div style="margin-bottom: 5px;  font-weight: bold;"> Originator
                                : {{ Auth::user()->name }}</div>
                            {{-- <div class="list-item">
                                    <div class="head">Originator</div>
                                    <div>:</div>
                                    <div>{{ $doc->origiator_name->name }}</div>
                                </div> --}}
                            <div style="margin-bottom: 5px; font-weight: bold;">Short Description :
                                {{ $document->short_description }}</div>
                            <div style="margin-bottom: 5px;  font-weight: bold;">Due Date :
                                {{ \Carbon\Carbon::parse($document->due_date)->format('d-M-Y') }}</div>

                        </div>
        </div>
        </table>

        </header>

        <div class="inner-block">

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="typedata">Type</label>
                    <select class="form-control" id="typedata" name="typedata">
                        <option value="">Select Type</option>
                        <option value="cft_review">CFT Review</option>
                        <option value="notification">Notification</option>
                        <option value="business">Business Rules</option>
                        <option value="stage">Stage Change</option>
                        <option value="user_action">User Action</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="user">Perform By</label>
                    <select class="form-control" id="user" name="user">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="from_date">From Date</label>
                    <input type="date" class="form-control" id="from_date" name="from_date">
                </div>
                <div class="col-md-3">
                    <label for="to_date">To Date</label>
                    <input type="date" class="form-control" id="to_date" name="to_date">
                </div>
            </div>


            <div class="division">
            </div>
            <div class="second-table">
                <table>
                    <thead>
                        <tr class="table_bg">
                            <th>S.No</th>
                            <th>Flow Changed From</th>
                            <th>Flow Changed To</th>
                            <th>Data Field</th>
                            <th>Action Type</th>
                            <th>Performer</th>
                        </tr>
                    </thead>
                    <tbody id="audit-data">
                        @include('frontend.management-review.management_filter')
                    </tbody>
                </table>
            </div>
        </div>




        @php
            $auditCollect = DB::table('audit_reviewers_details')
                ->where(['doc_id' => $document->id, 'user_id' => Auth::user()->id])
                ->latest()
                ->first();
        @endphp
        <div class="modal fade" id="auditViewers">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <style>
                        .validationClass {
                            margin-left: 100px
                        }
                    </style>

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Audit Reviewers Details</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    @php
                        $reviewer = DB::table('audit_reviewers_details')
                            ->where(['doc_id' => $document->id, 'type' => 'Change Control'])
                            ->get();
                    @endphp
                    <!-- Customer grid view -->
                    <div class="table-responsive" style="padding: 20px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Review By</th>
                                    <th>Review On</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Check if reviewer array is empty or null -->
                                @if ($reviewer && count($reviewer) > 0)
                                    <!-- Iterate over stored reviewer and display them -->
                                    @foreach ($reviewer as $review)
                                        <tr>
                                            <td>{{ $review->reviewer_comment_by }}</td>
                                            <td>{{ \Carbon\Carbon::parse($review->reviewer_comment_on)->format('d-M-Y') }}
                                            </td>
                                            <td>{{ $review->reviewer_comment }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">No results available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="auditReviewer">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <style>
                        .validationClass {
                            margin-left: 100px
                        }
                    </style>

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Audit Reviewers</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- <form action="" method="POST"> -->
                    <form action="{{ route('store_audit_review', $document->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label for="Reviewer commnet">Reviewer Comment <span id=""
                                        class="text-danger">*</span></label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                        does not require completion</small></div>
                                <textarea {{ $auditCollect ? 'disabled' : '' }} class="summernote w-100" name="reviewer_comment" id="summernote-17">{{ $auditCollect ? $auditCollect->reviewer_comment : '' }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="Reviewer Completed By">Reviewer Completed By</label>
                                <input disabled type="text" class="form-control" name="reviewer_completed_by"
                                    id="reviewer_completed_by"
                                    value="{{ $auditCollect ? $auditCollect->reviewer_comment_by : '' }}">
                            </div>
                            <div class="group-input">
                                <label for="Reviewer Completed on">Reviewer Completed On</label>
                                <input disabled type="text" class="form-control" name="reviewer_completed_on"
                                    id="reviewer_completed_on"
                                    value="{{ $auditCollect && $auditCollect->reviewer_comment_on ? \Carbon\Carbon::parse($auditCollect->reviewer_comment_on)->format('d-M-Y') : '' }}">
                            </div>
                            <input type="hidden" id="type" name="type" value="Change Control">
                        </div>
                        <div class="modal-footer">
                            {!! $auditCollect ? '' : '<button type="submit" >Submit</button>' !!}
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Pagination links -->
        <div style="float: inline-end; margin: 10px;">
            <style>
                .pagination>.active>span {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                    color: #fff !important;
                }

                .pagination>.active>span:hover {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                }

                .pagination>li>a,
                .pagination>li>span {
                    color: #4274da !important;
                }

                .pagination>li>a:hover {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                    color: #fff !important;
                }
            </style>
            {{ $audit->links() }}
        </div>

        </body>

        </html>

    </div>
    </div>

    <div class="modal fade" id="activity-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">SOP-000{{ $document->id }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="info-list">
                        <div class="list-item">
                            <div class="head">Site/Division/Process</div>
                            <div>:</div>
                            <div>{{ $document->division }}/{{ $document->process }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Document Stage</div>
                            <div>:</div>
                            <div>{{ $document->status }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Originator</div>
                            <div>:</div>
                            <div>{{ $document->initiator }}</div>
                        </div>
                    </div>
                    <div id="auditTableinfo"></div>

                </div>

            </div>
        </div>
    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
            function fetchDataAudit() {
                var typedata = $('#typedata').val();
                var user = $('#user').val();
                var fromDate = $('#from_date').val();
                var toDate = $('#to_date').val();






                $.ajax({
                    url: "{{ route('api.management-review.filter', $document->id) }}",
                    method: "GET",
                    data: {
                        typedata: typedata,
                        user: user,
                        from_date: fromDate,
                        to_date: toDate
                    },
                    success: function(response) {
                        $('#audit-data').html(response.html);
                    }
                });
            }

            $('#typedata, #user, #from_date, #to_date').on('change', function() {
                fetchDataAudit();
            });
        });

        $('#auditTable').on('click', '.viewdetails', function() {
            var auditid = $(this).attr('data-id');

            if (auditid > 0) {

                // AJAX request
                var url = "{{ route('audit-details', [':auditid']) }}";
                url = url.replace(':auditid', auditid);

                // Empty modal data
                $('#auditTableinfo').empty();

                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {

                        // Add employee details
                        $('#auditTableinfo').append(response.html);

                        // Display Modal
                        $('#activity-modal').modal('show');
                    }
                });
            }
        });
    </script>

    {{-- <script type='text/javascript'>
        $(document).ready(function() {

            $('#auditTable').on('click', '.viewdetails', function() {
                var auditid = $(this).attr('data-id');

                if (auditid > 0) {

                    // AJAX request
                    var url = "{{ route('audit-details', [':auditid']) }}";
                    url = url.replace(':auditid', auditid);

                    // Empty modal data
                    $('#auditTableinfo').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#auditTableinfo').append(response.html);

                            // Display Modal
                            $('#activity-modal').modal('show');
                        }
                    });
                }
            });

        });
    </script> --}}
@endsection
