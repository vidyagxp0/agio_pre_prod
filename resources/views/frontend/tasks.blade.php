@extends('frontend.layout.main')

@section('container')

<style>
body {
    background: #f8fafc;
}

/* ===== CARDS ===== */
.dashboard-card {
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

/* ===== TABLE ===== */
.custom-table {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
}

/* Sticky header */
.custom-table thead th {
    position: sticky;
    top: 0;
    background: #1e293b;
    color: #fff;
    z-index: 5;
    text-align: center;
    font-size: 13px;
}

/* REMOVE hover from header */
.custom-table thead tr:hover {
    background: #1e293b !important;
}

/* Hover only body */
.custom-table tbody tr:hover {
    background: #f1f5f9;
}

.custom-table td {
    font-size: 13px;
    vertical-align: middle;
}

/* ===== SCROLL ===== */
.custom-scroll {
    max-height: 500px;
    overflow-y: auto;
}

/* ===== BADGE ===== */
.badge {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

/* ===== BUTTON ===== */
.btn-open {
    background: #2563eb;
    color: white;
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 12px;
}
.btn-open:hover {
    background: #1e40af;
}
</style>

<div class="container-fluid">

    <!-- ===== QMS TABLE ===== -->
    <div class="dashboard-card p-3">

        <h5 class="mb-3">📋 QMS Records</h5>

        <div class="custom-scroll">
            <table class="table table-bordered custom-table">
                <thead>
                    <tr>
                        <th style="width: 8%">ID</th>
                        <th style="width: 8%">Site</th>
                        <th style="width: 8%">Process</th>
                        <th style="width: 8%">Initiator</th>
                        <th style="width: 40%">Short Description</th>
                        <th style="width: 15%">Status</th>
                    </tr>
                </thead>

                <tbody id="qmsTableBody">
                    @php
                        $allTasks = collect($allTasks)->sortByDesc('created_at')->values();
                    @endphp
                    @foreach($allTasks as $key => $task)
                    @php
                        $statusClass = 'bg-secondary';

                        if(str_contains($task['status'],'Approval')) $statusClass='bg-info';
                        elseif(str_contains($task['status'],'Review')) $statusClass='bg-primary';
                        elseif(str_contains($task['status'],'Complete') || str_contains($task['status'],'Closed')) $statusClass='bg-success';
                        elseif(str_contains($task['status'],'Pending')) $statusClass='bg-warning text-dark';
                    @endphp

                    <tr>
                        <td><strong>
                            <a href="{{ route($task['route_name'], $task['record_id']) }}" 
                            target="_blank"
                            class="btn btn-open">
                            {{ str_pad($key + 1, 4, '0', STR_PAD_LEFT) }}
                            </a>    
                        </strong></td>
                        <td>{{ Helpers::getDivisionName($task['division_id']) }}</td>
                        <td>{{ $task['process'] }}</td>
                        <td>{{ Helpers::getInitiatorName($task['initiator_id']) }}</td>
                        <td title="{{ $task['short_description'] }}">{{ Str::limit($task['short_description'],80) }}</td>
                        <td>
                            <span>
                                {{ $task['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- QMS Pagination -->
        <div class="mt-3 text-center">
            <button id="qmsPrev" class="btn btn-sm btn-secondary">Prev</button>
            <span id="qmsPageInfo" class="mx-2"></span>
            <button id="qmsNext" class="btn btn-sm btn-secondary">Next</button>
        </div>

    </div>

    <!-- ===== DMS TABLE ===== -->
    <div class="dashboard-card p-3 mt-4">

        <h5 class="mb-3">📄 Document Records</h5>

        <div class="custom-scroll">
            <table class="table table-bordered custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Document Type</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Originator</th>
                        <th>Modified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $temp)
                    <tr>
                        <td>
                            <a href="{{ route('documents.edit', $temp->id) }}" class="btn btn-open">
                                {{ Helpers::recordFormat($temp->id) }}
                            </a>
                        </td>

                        <td>{{ Helpers::getDocumentTypes()[$temp->document_type_id] ?? '-' }}</td>

                        <td>{{ Str::limit($temp->short_description, 80) }}</td>

                        <td>{{ \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y h:i A') }}</td>

                        <td>{{ $temp->originator_name }}</td>

                        <td>{{ \Carbon\Carbon::parse($temp->updated_at)->format('d-M-Y h:i A') }}</td>

                        <td>
                            @php
                                $docStatus = Helpers::getDocStatusByStage($temp->stage, $temp->training_required);
                                $statusClass = 'bg-secondary';

                                if(str_contains($docStatus,'Review')) $statusClass='bg-primary';
                                elseif(str_contains($docStatus,'Approved')) $statusClass='bg-success';
                                elseif(str_contains($docStatus,'Pending')) $statusClass='bg-warning text-dark';
                            @endphp

                            <span>
                                {{ $docStatus }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ url('rev-details', $temp->id) }}" 
                               class="btn btn-sm btn-outline-secondary">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Laravel Pagination -->
        <div class="mt-3">
            {!! $tasks->links() !!}
        </div>

    </div>

</div>

<!-- ===== JS ===== -->
<script>
// ===== QMS PAGINATION =====
let qmsRows = Array.from(document.querySelectorAll("#qmsTableBody tr"));
let qmsCurrentPage = 1;
let rowsPerPage = 10;
let qmsTotalPages = Math.ceil(qmsRows.length / rowsPerPage);

function renderQmsTable() {
    qmsRows.forEach((row, index) => {
        row.style.display =
            index >= (qmsCurrentPage - 1) * rowsPerPage &&
            index < qmsCurrentPage * rowsPerPage
                ? ""
                : "none";
    });

    document.getElementById("qmsPageInfo").innerText =
        `Page ${qmsCurrentPage} of ${qmsTotalPages}`;
}

document.getElementById("qmsPrev").onclick = () => {
    if (qmsCurrentPage > 1) {
        qmsCurrentPage--;
        renderQmsTable();
    }
};

document.getElementById("qmsNext").onclick = () => {
    if (qmsCurrentPage < qmsTotalPages) {
        qmsCurrentPage++;
        renderQmsTable();
    }
};

renderQmsTable();
</script>

@endsection