@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="audit-trial">
        <div class="container-fluid">
            <div class="audit-trial-container">

                <div class="inner-block">
                    <div class="main-head">
                        <div class="default-name">
                            {{ Helpers::getDivisionName($document->division_id) }}
                                        /@if($document->document_type_name){{ $document->document_type_name }} /@endif{{ $document->year }}
                                        /000{{ $document->id }}/R{{$document->major}}.{{$document->minor}}
                            
                            {{-- {{ $document->division }}
                            /{{ $document->doctype }} /{{ date('Y') }}
                            /SOP-000{{ $document->id }} --}}
                        </div>

                        <div class="btn-group">
                            <button class="button_theme1" onclick="window.print();return false;" type="button">Print</button>
                        </div>
                    </div>
                    <div class="info-list">
                        <div class="list-item">
                            <div class="head">Site/Division/Process</div>
                            <div>:</div>
                            <div> {{ Helpers::getDivisionName($document->division_id) }}
                                /@if($document->document_type_name){{ $document->document_type_name }} /@endif{{ $document->year }}
                                /000{{ $document->id }}/R{{$document->major}}.{{$document->minor}}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Document Stage</div>
                            <div>:</div>
                            <div>{{ $document->status }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Originator</div>
                            <div>:</div>
                            <div>{{ $document->originator }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="print-table col-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Person</th>
                                        <th>Role</th>
                                        <th>Today Print Count</th>
                                        <th>Total Count</th>
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

                                            $print = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $print_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->count();

                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>Reviewer</td>
                                            <td>{{ $print_today }}</td>
                                            <td>{{ $print }}</td>
                                        </tr>
                                    @endfor
                                    @php
                                        $rev_data = explode(',', $document->approvers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $rev_data[$i])
                                                ->first();

                                            $print = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $print_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->count();

                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>Approver</td>
                                            <td>{{ $print_today }}</td>
                                            <td>{{ $print }}</td>
                                        </tr>
                                    @endfor


                                </tbody>
                            </table>
                        </div>
                        <div class="print-table col-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Person</th>
                                        <th>Role</th>
                                        <th>Today Download Count</th>
                                        <th>Total Count</th>
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

                                            $print = DB::table('download_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $print_today = DB::table('download_histories')
                                                ->where('date', $today)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download = DB::table('download_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download_today = DB::table('download_histories')
                                                ->where('date', $today)
                                                ->count();

                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>Reviewer</td>
                                            <td>{{ $print_today }}</td>
                                            <td>{{ $print }}</td>
                                        </tr>
                                    @endfor
                                    @php
                                        $rev_data = explode(',', $document->approvers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($rev_data); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $rev_data[$i])
                                                ->first();
                                            $print = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $print_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download = DB::table('print_histories')
                                                ->where('document_id', $document->id)
                                                ->where('user_id', $rev_data[$i])
                                                ->count();
                                            $download_today = DB::table('print_histories')
                                                ->where('date', $today)
                                                ->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>Approver</td>
                                            <td>{{ $print_today }}</td>
                                            <td>{{ $print }}</td>
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="activity-table">
                        <table class="table table-bordered" id='auditTable'>
                            <thead>
                                <tr>
                                    <th>Activity Type</th>
                                    <th>Performed on</th>
                                    <th>Performed by</th>
                                    {{-- <th>Performer Role</th> --}}
                                    <th>Origin State</th>
                                    <th>Resulting State</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audit as $audits)
                                    <tr>
                                        <td class="viewdetails"><a
                                                href="{{ route('audit-detail', $audits->id) }}">{{ $audits->activity_type }}</a>
                                        </td>
                                        <td>{{ $audits->created_at }}</td>
                                        <td>{{ $audits->user_name }}</td>
                                        {{-- <td>{{ $audits->user_role }}</td> --}}
                                        <td>{{ $audits->change_from ? $audits->change_from : $audits->origin_state }}</td>
                                        <td>{{ $audits->change_to ? $audits->change_to : $document->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="activity-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">SOP-{{ $document->id }}</h4>
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
                            <div>{{ $document->originator }}</div>
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
