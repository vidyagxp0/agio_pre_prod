<link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    #audit-trial {
    padding: 20px 0px;
    background: #4274da;
    min-height: calc(100vh - 150px);
}

#audit-trial .inner-block {
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 12px 12px 24px #b2b8c9, -12px -12px 24px #f0f8ff;
    background: #ffffff;
}

#audit-trial .inner-block .main-head {
    font-size: 1.2rem;
    font-weight: bold;
    color: black;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

#audit-trial .inner-block .main-head button {
    font-size: 0.9rem;
}

#audit-trial .info-list {
    margin-bottom: 30px;
}

#audit-trial .info-list .list-item {
    display: flex;
    align-items: center;
    gap: 20px;
}

#audit-trial .info-list .head {
    font-weight: bold;
    min-width: 200px;
}

#audit-trial .activity-table thead,
#audit-trial .print-table thead {
    background: #4274da36;
}

#audit-trial .activity-table td,
#audit-trial .activity-table th,
#audit-trial .print-table th,
#audit-trial .print-table td {
    font-size: 0.85rem;
}

#audit-trial .activity-table td:nth-child(1) {
    text-decoration: underline;
    cursor: pointer;
}
</style>
<div id="audit-trial">
    <div class="container-fluid">
        <div class="audit-trial-container">

            <div class="inner-block">
                <div class="main-head">
                    <div>SOP-{{ $document->id }}</div>

                </div>
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
                                    <td>{{ $audits->origin_state }}</td>
                                    <td>{{ $document->status }}</td>
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
