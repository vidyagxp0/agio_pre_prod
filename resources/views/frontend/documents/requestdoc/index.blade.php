@extends('frontend.layout.main')
@section('container')

<div id="document">
    <div class="container-fluid">
        <div class="dashboard-container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="document-left-block">

                        {{-- ================= CREATE BUTTONS ================= --}}
                        <div class="inner-block create-block">
                            <div class="head text-right mb-0">

                                <a href="{{ route('document-request.create') }}">
                                    <i class="fa-solid fa-plus"></i> Document Issuance Request
                                </a>
                            </div>
                        </div>

                        {{-- ================= DOCUMENT REQUEST TABLE ================= --}}
                        <div class="inner-block table-block">

                            <style>
                                .request-document-table { width: 100%; table-layout: fixed; }
                                .request-document-table th,
                                .request-document-table td { vertical-align: middle; word-wrap: break-word; }
                                .request-document-table .sr-no { width: 55px; text-align: center; }
                                .request-document-table .request-id { width: 80px; }
                                .request-document-table .document-number { width: 110px; }
                                .request-document-table .request-by { width: 80px; }
                                .request-document-table .department { width: 120px; }
                                .request-document-table .request-to { width: 100px; }
                                .request-document-table .copies { width: 70px; text-align: center; }
                                .request-document-table .reason { width: 240px; }
                                .request-document-table .create-date { width: 120px; }
                                .request-document-table .status { width: 80px; }
                                .request-document-table .action { width: 65px; }
                                .request-reason-text { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
                            </style>

                            @php
                                $requestIds = $requestDocuments->pluck('request_id')->filter()->unique()->values();
                                $docNumbers = $requestDocuments->pluck('document_number')->filter()->unique()->values();
                                $requestByList = $requestDocuments->pluck('request_by_name')->filter()->unique()->values();
                                $statusList = $requestDocuments->map(function ($r) {
                                    return $r->status ?? 'Opened';
                                })->unique()->values();
                            @endphp

                            {{-- ================= FILTERS ================= --}}
                            <div style="display:flex; justify-content:space-around;" class="main-filter">

                                {{-- REQUEST ID --}}
                                <div class="filter-block">
                                    <div class="drop-filter-block">
                                        <div class="icon"><i class="fa-solid fa-hashtag"></i></div>
                                        <div class="right">
                                            <label for="request_id">Request ID</label>
                                            <select name="request_id" class="filterSelect">
                                                <option value="">All</option>
                                                @foreach ($requestIds as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- DOCUMENT NUMBER --}}
                                <div class="filter-block">
                                    <div class="drop-filter-block">
                                        <div class="icon"><i class="fa-solid fa-file"></i></div>
                                        <div class="right">
                                            <label for="document_number">Document Number</label>
                                            <select name="document_number" class="filterSelect">
                                                <option value="">All</option>
                                                @foreach ($docNumbers as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- REQUEST BY --}}
                                <div class="filter-block">
                                    <div class="drop-filter-block">
                                        <div class="icon"><i class="fa-solid fa-user"></i></div>
                                        <div class="right">
                                            <label for="request_by">Request By</label>
                                            <select name="request_by" class="filterSelect">
                                                <option value="">All</option>
                                                @foreach ($requestByList as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- STATUS --}}
                                <div class="filter-block">
                                    <div class="drop-filter-block">
                                        <div class="icon"><i class="fa-solid fa-gauge-high"></i></div>
                                        <div class="right">
                                            <label for="status">Status</label>
                                            <select name="status" class="filterSelect">
                                                <option value="">All</option>
                                                @foreach ($statusList as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- ================= RECORDS ================= --}}
                            <div class="main-head">
                                <div>Records</div>
                                <div><span id="resultCount">{{ $requestDocuments->count() }}</span> Results found</div>
                            </div>

                            <div class="table-list">
                                <table class="table table-bordered request-document-table">
                                    <thead>
                                        <tr>
                                            <th class="sr-no">Sr. No.</th>
                                            <th class="request-id">Request ID</th>
                                            <th class="document-number">Document Number</th>
                                            <th class="request-by">Request By</th>
                                            <th class="department">Department</th>
                                            <th class="request-to">Request To</th>
                                            <th class="copies">No. of Copies</th>
                                            <th class="reason">Reason</th>
                                            <th class="create-date">Request Date</th>
                                            <th class="status">Status</th>
                                            <th class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="requestTable">
                                        @foreach ($requestDocuments as $requestDocument)
                                            <tr class="request-row"
                                                data-request-id="{{ $requestDocument->request_id }}"
                                                data-document-number="{{ $requestDocument->document_number }}"
                                                data-request-by="{{ $requestDocument->request_by_name }}"
                                                data-status="{{ $requestDocument->status ?? 'Opened' }}">
                                                <td class="sr-no">{{ $loop->remaining + 1 }}</td>
                                                <td class="request-id">
                                                    <a href="{{ route('document-request.show', $requestDocument->id) }}">
                                                        {{ $requestDocument->request_id }}
                                                    </a>
                                                </td>
                                                <td class="document-number">{{ $requestDocument->document_number ?? 'NA' }}</td>
                                                <td class="request-by">{{ $requestDocument->request_by_name ?? 'NA' }}</td>
                                                <td class="department">{{ $requestDocument->department ?? 'NA' }}</td>
                                                <td class="request-to">{{ $requestDocument->request_to_name ?? 'NA' }}</td>
                                                <td class="copies">{{ $requestDocument->number_of_copies ?? '0' }}</td>
                                                <td class="reason request-reason-text" title="{{ $requestDocument->reason }}">{{ $requestDocument->reason ?? 'NA' }}</td>
                                                <td class="create-date">
                                                    {{ $requestDocument->created_at ? \Carbon\Carbon::parse($requestDocument->created_at)->format('d-M-Y h:i A') : 'NA' }}
                                                </td>
                                                <td class="status">{{ $requestDocument->status ?? 'Opened' }}</td>
                                                <td class="action">
                                                    <div class="action-dropdown">
                                                        <div class="action-down-btn">
                                                            Action <i class="fa-solid fa-angle-down"></i>
                                                        </div>
                                                        <div class="action-block">
                                                            <a href="{{ route('document-request.show', $requestDocument->id) }}">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr id="noDataRow" class="{{ $requestDocuments->count() > 0 ? 'd-none' : '' }}">
                                            <td colspan="11" class="text-center">
                                                <h5>Request Document Data Not Found</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        function applyFilters() {
            let requestId      = $('select[name="request_id"]').val();
            let documentNumber = $('select[name="document_number"]').val();
            let requestBy      = $('select[name="request_by"]').val();
            let status         = $('select[name="status"]').val();

            let rows = $('#requestTable tr.request-row');
            let visible = [];

            rows.each(function () {
                let row = $(this);

                let show =
                    (!requestId      || String(row.attr('data-request-id'))      === requestId) &&
                    (!documentNumber || String(row.attr('data-document-number')) === documentNumber) &&
                    (!requestBy      || String(row.attr('data-request-by'))      === requestBy) &&
                    (!status         || String(row.attr('data-status'))          === status);

                row.toggle(show);

                if (show) {
                    visible.push(row);
                }
            });

            // Sr. No. dobara (descending) set karo
            let total = visible.length;
            $.each(visible, function (index, row) {
                row.find('td.sr-no').text(total - index);
            });

            $('#resultCount').text(total);
            $('#noDataRow').toggleClass('d-none', total > 0);
        }

        $(document).on('change', '.filterSelect', applyFilters);
    });
</script>

{{-- ================= DIVISION MODAL (Create Document ke liye) ================= --}}
<div id="division-modal" class="d-none">
    <div class="division-container">
        <div class="content-container">
            <form action="{{ route('division_submit') }}" method="post">
                @csrf
                <div class="division-tabs">
                    <div class="tab">
                        @php
                            $userRoles = DB::table('user_roles')->where('user_id', Auth::user()->id)->get();
                            $divisionIds = [];
                            foreach ($userRoles as $role) {
                                $divisionIds[] = $role->q_m_s_divisions_id;
                            }
                            $divisions = DB::table('q_m_s_divisions')->where('status', 1)->whereIn('id', $divisionIds)->get();
                        @endphp
                        <style>
                            #division-modal .tab a.active {
                                background-color: #23a723 !important;
                                color: white !important;
                            }
                        </style>
                        @foreach ($divisions as $temp)
                            <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                            <a style="display: block; background-color: inherit; color: black; padding: 5px 10px; width: 100%; border: none; outline: none; text-align: left; cursor: pointer; transition: 0.3s;"
                               class="divisionlinks" onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</a>
                        @endforeach
                    </div>
                    @php
                        $process = DB::table('processes')->get();
                    @endphp
                    @foreach ($process as $temp)
                        <div id="{{ $temp->division_id }}" class="divisioncontent">
                            @php
                                $pro = DB::table('processes')->where('division_id', $temp->division_id)->get();
                            @endphp
                            @foreach ($pro as $test)
                                <label for="process">
                                    <input type="radio" class="process_id_reset" for="process" value="{{ $test->id }}" name="process_id" required> {{ $test->process_name }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="button-container">
                    <a href="/documents" style="border: 1px solid grey; letter-spacing: 1px; font-size: 0.9rem; padding: 3px 10px; background: black; color: white;">Cancel</a>
                    <button id="submit-division" type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection