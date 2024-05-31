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
                    background: #4274da;
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
                        <div class="heading">

                            <div class="heading-new">
                                Audit Trail
                            </div>

                            <div> <strong>Record ID.</strong> {{ str_pad($document->id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div style="margin-bottom: 5px;  font-weight: bold;"> Originator
                                :{{ $document->originator ? $document->originator : '' }}</div>
                            <div style="margin-bottom: 5px; font-weight: bold;">Short Description :
                                {{ $document->short_description }}</div>
                            <div style="margin-bottom: 5px;  font-weight: bold;">Due Date : {{ $document->due_date }}</div>

                        </div>
        </div>
        </table>

        </header>

        <div class="inner-block">
            <div class="division">
            </div>
            <div class="second-table">
                <table>
                    <tr class="table_bg">
                        <th>S.No</th>
                        <th>Flow Changed From</th>
                        <th>Flow Changed To</th>
                        <th>Data Field</th>
                        <th>Action Type</th>
                        <th>Performer</th>
                    </tr>

                    <tr>
                        @php
                            $previousItem = null;
                        @endphp

                        @foreach ($audit as $audits => $dataDemo)
                            <td>{{ $dataDemo ? ($audit->currentPage() - 1) * $audit->perPage() + $audits + 1 : 'Not Applicable' }}
                            </td>

                            <td>
                                <div><strong>Changed From :</strong>{!! $dataDemo->change_from !!}</div>
                            </td>

                            <td>
                                <div><strong>Changed To :</strong>{!! $dataDemo->change_to !!}</div>
                            </td>
                            <td>
                                <div>
                                    <strong> Data Field Name :</strong><a
                                        href="{{ url('DeviationAuditTrialDetails', $dataDemo->id) }}">{{ $dataDemo->activity_type ? $dataDemo->activity_type : 'Not Applicable' }}</a>
                                </div>
                                <div style="margin-top: 5px;">
                                    @if($dataDemo->activity_type == "Activity Log")
                                        <strong>Change From :</strong>{!! $dataDemo->change_from ? $dataDemo->change_from : 'Not Applicable' !!}
                                    @else
                                        <strong>Change From :</strong>{!! $dataDemo->previous ? $dataDemo->previous : 'Not Applicable' !!}
                                    @endif
                                </div>
                                <br>
                                <div>
                                    @if($dataDemo->activity_type == "Activity Log")
                                        <strong>Change To :</strong>{!! $dataDemo->change_to ? $dataDemo->change_to : 'Not Applicable' !!}
                                    @else
                                        <strong>Change To :</strong>{!! $dataDemo->current ? $dataDemo->current : 'Not Applicable' !!}
                                    @endif
                                </div>
                                <div style="margin-top: 5px;">
                                    <strong>Change Type :</strong>{{ $dataDemo->action_name ? $dataDemo->action_name : 'Not Applicable' }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong> Action Name
                                        :</strong>{{ $dataDemo->action ? $dataDemo->action : 'Not Applicable' }}

                                </div>
                            </td>
                            <td>
                                <div><strong> Peformed By
                                        :</strong>{{ $dataDemo->user_name ? $dataDemo->user_name : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;"> <strong>Performed On
                                        :</strong>{{ $dataDemo->created_at ? $dataDemo->created_at : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;"><strong> Comments
                                        :</strong>{{ $dataDemo->comment ? $dataDemo->comment : 'Not Applicable' }}</div>

                            </td>
                    </tr>
                    @endforeach
                </table>
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
    </script>
@endsection
