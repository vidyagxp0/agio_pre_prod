@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <style>
        .filter-form {
            background-color: #f9f9f9;
            border: 2px solid #ececec;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1rem;
            background-color: #ffffff;
        }
        .table-header {
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
            padding: 12px;
            background-color: #5c98e7;
            color: white;
            border: 2px solid #5c98e7;
            border-radius: 5px;
            width: 20px;
        }
        .custom-button {
            font-size: 1rem;
            font-weight: bold;
            color: #0039bd;
            border-color: #0039bd;
            background-color: transparent;
        }
        .custom-button:hover {
            background-color: #0039bd;
            color: #fff;
            border-color: #0039bd;
        }
        .filter-form .form-control,
        .filter-form .custom-select {
            border-radius: 5px;
            border: 1px solid #0039bd;
        }
    </style>

    <div id="document">
        <div class="container-fluid">
            <div class="dashboard-container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="document-left-block">
                            <div class="inner-block table-block">
                                {{-- <div class="head">
                                    Records
                                    <i class="fa-solid fa-angle-right"></i>&nbsp;<i class="fa-solid fa-angle-right"></i>
                                    {{count($task)}} Results
                                </div> --}}
                                <div class="table-list">
                                    <table class="table table-bordered">
                                        <thead style="background: #5c98e7;">
                                            <th class="pr-id">
                                                ID
                                            </th>
                                            <th class="division">
                                                Document Type
                                            </th>
                                            <th class="short-desc">
                                                Short Description
                                            </th>
                                            <th class="create-date">
                                                Create Date Time
                                            </th>
                                            <th class="assign-name">
                                                Originator
                                            </th>
                                            <th class="modify-date">
                                                Modify Date Time
                                            </th>
                                            <th class="status">
                                                Status
                                            </th>
                                            <th class="action">
                                                Action
                                            </th>
                                        </thead>
                                        <tbody id="searchTable">
                                            @foreach($task as $temp)
                                            <tr>
                                                <td class="pr-id" style="text-decoration:underline">
                                                    <a href="{{ route('documents.edit', $temp->id) }}"  style="background-color: #0056b3; 
                                                                            color: #fff !important; 
                                                                            font-weight: 600; 
                                                                            border-radius: 10px; 
                                                                            padding: 6px 14px; 
                                                                            text-decoration: none; 
                                                                            transition: all 0.2s ease-in-out; 
                                                                            display: inline-block;">
                                                        {{Helpers::recordFormat($temp->id)}}
                                                    </a>
                                                </td>
                                                {{-- <td class="division">
                                                    {{ $temp->document_type_name }}
                                                </td> --}}
                                                <td class="division">
                                                    {{ Helpers::getDocumentTypes()[$temp->document_type_id] }}
                                                </td>

                                                <td class="short-desc">
                                                    {{$temp->short_description}}
                                                </td>
                                                <td class="create-date">
                                                    {{\Carbon\Carbon::parse($temp->created_at)->format('d-M-Y h:i A')}}
                                                </td>
                                                <td class="assign-name">
                                                    {{$temp->originator_name}}
                                                </td>
                                                <td class="modify-date">
                                                    {{\Carbon\Carbon::parse($temp->updated_at)->format('d-M-Y h:i A')}}
                                                </td>
                                                <td class="status">
                                                    {{ Helpers::getDocStatusByStage($temp->stage, $temp->training_required) }}
                                                </td>
                                                <td class="action">
                                                    <div class="action-dropdown">
                                                        <div class="action-down-btn">Action <i class="fa-solid fa-angle-down"></i></div>
                                                        <div class="action-block">
                                                            <a href="{{ url('rev-details', $temp->id) }}">View</a>
                                                            @php
                                                                $showEdit = false;
                                                            @endphp
                                                            @if(Helpers::checkRoles(2))
                                                                @if($temp->stage <=2 )
                                                                    @php $showEdit = true; @endphp
                                                                @endif
                                                            @endif
                                                            @if(Helpers::checkRoles(1))
                                                                @if($temp->stage <=4 )
                                                                    @php $showEdit = true; @endphp
                                                                @endif
                                                            @endif

                                                            @if ($showEdit)
                                                                <a href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $task->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 col-lg-3">
                        <div class="document-right-block">
                            <div class="inner-block recent-record">
                                <div class="head">
                                    Recent Records
                                </div>
                                <div class="record-list">
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">DMS/TMS Dashboard</a></div>
                                    </div>
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">Amit Guru</a></div>
                                    </div>
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">Change Control Dashboard</a></div>
                                    </div>
                                    <div class="mb-0">
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">EQMS Home Dashboard</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-block recent-items">
                                <div class="head">
                                    Recent Items (0)
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <style>
                    .custom-scroll-table {
    max-height: 420px; /* adjust height as per need */
    overflow-y: auto;
    border: 1px solid #ddd;
}

.custom-table thead th {
    position: sticky;
    top: 0;
    background-color: #5c98e7;
    color: #000000;
    z-index: 10;
    text-align: center;
}

.custom-table th, 
.custom-table td {
    vertical-align: middle !important;
    font-size: 14px;
    padding: 10px 8px;
}

.custom-table tr:hover {
    background-color: #f4f9ff;
    transition: 0.2s;
}

.badge {
    padding: 6px 10px;
    border-radius: 8px;
}

.custom-button {
    border-radius: 25px;
    font-weight: 500;
}
.record-btn {
    background-color: #0056b3;         /* Blue color */
    color: white !important;
    font-weight: 600;
    border-radius: 10px;
    padding: 6px 14px;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    display: inline-block;
}

.record-btn:hover {
    background-color: #0056b3;
    color: #fff !important;
    transform: scale(1.05);
}

.record-btn.disabled {
    background-color: #a0a0a0;
    cursor: not-allowed;
}


                </style>
                <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="document-left-block">
                <div class="inner-block table-block">
                    <div class="head" style="justify-content: flex-start">
                        <i class="fas fa-tasks"></i> QMS Tasks - All Processes
                    </div>
                    
                    <!-- Task Summary -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        Showing all pending tasks across all QMS processes for your roles.
                        @if(count($allTasks) > 0)
                            Total Tasks: <strong>{{ count($allTasks) }}</strong>
                        @endif
                    </div>
                  {{-- 
                    <div class="record-list mt-4">
                        <div class="inner-block">
                            @if(count($allTasks) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover custom-table">
                                        <thead class="table-header" style="background-color: #5c98e7; color: white;">
                                            <tr>
                                                <th style="width: 10%">Record ID</th>
                                                <th style="width: 10%">Record No.</th>
                                                <th style="width: 12%">Process</th>
                                                <th style="width: 10%">Initiator</th>
                                                <th style="width: 15%">Site/Division</th>
                                                <th style="width: 15%">Status</th>
                                                <th style="width: 28%">Short Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allTasks as $task)
                                                <tr style="text-align: center;">
                                                    <td>
                                                        @if($task['route_name'])
                                                            <a target="_blank" href="{{ route($task['route_name'], $task['record_id']) }}" class="btn btn-link btn-sm" style="color: #0039bd; text-decoration: underline; font-weight: bold;">
                                                                {{ Helpers::recordFormat($task['record_format']) }}
                                                            </a>
                                                        @else
                                                            <span class="text-muted">{{ Helpers::recordFormat($task['record_format']) }}</span>
                                                        @endif
                                                    </td>
                                                     <td>
                                                        <span class="badge badge-secondary">{{ $task['record_number'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $task['process'] }}</span>
                                                    </td>
                                                    <td>{{ Helpers::getInitiatorName($task['initiator_id']) }}</td>
                                                    <td>{{ Helpers::getDivisionName($task['division_id']) }}</td>
                                                   
                                                    <td>
                                                        @php
                                                            $statusClass = 'badge-warning';
                                                            if (strpos($task['status'], 'Approval') !== false) {
                                                                $statusClass = 'badge-info';
                                                            } elseif (strpos($task['status'], 'Review') !== false) {
                                                                $statusClass = 'badge-primary';
                                                            } elseif (strpos($task['status'], 'Complete') !== false || strpos($task['status'], 'Closed') !== false) {
                                                                $statusClass = 'badge-success';
                                                            } elseif (strpos($task['status'], 'Opened') !== false) {
                                                                $statusClass = 'badge-secondary';
                                                            }
                                                        @endphp
                                                        <span >{{ $task['status'] }}</span>
                                                    </td>
                                                    <td style="text-align: left;">
                                                        {{ Str::limit($task['short_description'], 100) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Refresh Button -->
                                <div class="mt-3 text-center">
                                    <a href="{{ url('mytaskdata') }}" class="btn btn-primary custom-button">
                                        <i class="fas fa-sync-alt"></i> Refresh Tasks
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <h4>No Pending Tasks Found</h4>
                                    <p>You don't have any pending tasks across all QMS processes for your current roles.</p>
                                </div>
                                
                                <!-- Refresh Button -->
                                <div class="text-center mt-3">
                                    <a href="{{ url('mytaskdata') }}" class="btn btn-primary custom-button">
                                        <i class="fas fa-sync-alt"></i> Refresh Tasks
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div> --}}


                <div class="record-list mt-4">
                    <div class="inner-block">
                        <div class="table-responsive custom-scroll-table">
                            <table id="tasksTable" class="table table-bordered table-hover custom-table mb-0">
                                <thead class="table-header" style="background-color: #5c98e7; color: white; position: sticky; top: 0; z-index: 10;">
                                    <tr>
                                        <th style="width: 8%">Record ID</th>
                                        <th style="width: 8%">Record No.</th>
                                        <th style="width: 12%">Process</th>
                                        <th style="width: 10%">Initiator</th>
                                        <th style="width: 15%">Site/Division</th>
                                        <th style="width: 15%">Status</th>
                                        <th style="width: 32%">Short Description</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($allTasks as $task)
                                    <tr>
                                        <td>
                                            @if($task['route_name'])
                                            <a target="_blank" href="{{ route($task['route_name'], $task['record_id']) }}" class="btn btn-sm record-btn">
                                                {{ Helpers::recordFormat($task['record_format']) }}
                                            </a>
                                            @else
                                            <span class="btn btn-sm record-btn disabled" style="opacity: 0.6;">
                                                {{ Helpers::recordFormat($task['record_format']) }}
                                            </span>
                                            @endif
                                        </td>
                                        <td>{{ $task['record_number'] }}</td>
                                        <td>{{ $task['process'] }}</td>
                                        <td>{{ Helpers::getInitiatorName($task['initiator_id']) }}</td>
                                        <td>{{ Helpers::getDivisionName($task['division_id']) }}</td>
                                        <td>
                                            @php
                                            $statusClass = 'badge-warning';
                                            if(strpos($task['status'], 'Approval') !== false){ $statusClass='badge-info'; }
                                            elseif(strpos($task['status'], 'Review') !== false){ $statusClass='badge-primary'; }
                                            elseif(strpos($task['status'], 'Complete') !== false || strpos($task['status'], 'Closed') !== false){ $statusClass='badge-success'; }
                                            elseif(strpos($task['status'], 'Opened') !== false){ $statusClass='badge-secondary'; }
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $task['status'] }}</span>
                                        </td>
                                        <td style="text-align:left;">{{ Str::limit($task['short_description'],100) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Buttons -->
                        <div class="mt-3 text-center">
                            <button id="prevBtn" class="btn btn-secondary">Prev</button>
                            <span id="pageInfo"></span>
                            <button id="nextBtn" class="btn btn-secondary">Next</button>
                        </div>
                    </div>
                </div>

                <script>
                let currentPage = 1;
                const rowsPerPage = 10;
                const table = document.getElementById("tasksTable");
                const tbody = document.getElementById("tableBody");
                const rows = Array.from(tbody.querySelectorAll("tr"));
                const totalPages = Math.ceil(rows.length / rowsPerPage);

                function displayPage(page) {
                    rows.forEach((row, index) => {
                        row.style.display = (index >= (page-1)*rowsPerPage && index < page*rowsPerPage) ? '' : 'none';
                    });
                    document.getElementById("pageInfo").innerText = "Page " + page + " of " + totalPages;
                }

                document.getElementById("prevBtn").addEventListener("click", () => {
                    if(currentPage > 1){
                        currentPage--;
                        displayPage(currentPage);
                    }
                });

                document.getElementById("nextBtn").addEventListener("click", () => {
                    if(currentPage < totalPages){
                        currentPage++;
                        displayPage(currentPage);
                    }
                });

                displayPage(currentPage);
                </script>



                </div>
            </div>
        </div>
    </div>
              

            </div>
        </div>
    </div>
@endsection
