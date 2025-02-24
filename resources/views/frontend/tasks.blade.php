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
            background-color: #ca8a04;
            color: white;
            border: 2px solid #eca035;
            border-radius: 5px;
            width: 20px;
        }
        .custom-button {
            font-size: 1rem;
            font-weight: bold;
            color: #eca035;
            border-color: #eca035;
            background-color: transparent;
        }
        .custom-button:hover {
            background-color: #eca035;
            color: #fff;
            border-color: #eca035;
        }
        .filter-form .form-control,
        .filter-form .custom-select {
            border-radius: 5px;
            border: 1px solid orange;
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
                                        <thead>
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
                                                    <a href="#">
                                                        000{{$temp->id}}
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="document-left-block">
                            <div class="inner-block table-block">
                                <div class="head" style="justify-content: flex-start">
                                    QMS Task
                                </div>
                                <form class="mb-4 p-4 filter-form" method="GET" action="{{ url('mytaskdata') }}">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label style="margin-bottom: 10px; font-size: 16px; font-weight: bold;">Process</label>
                                            <select class="custom-select form-control" name="process" onchange="this.form.submit()">
                                                <option value="">Select Process</option>
                                                @foreach ($processes as $key => $process)
                                                    <option value="{{ $key }}" {{ request('process') == $key ? 'selected' : '' }}>{{ $process['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6" style="margin-top: 2.1rem !important;">
                                            <a href="{{ url('mytaskdata') }}" class="btn btn-secondary custom-button">
                                                <i class="fas fa-sync-alt"></i> Reset Filters
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="{{ url('mytaskdata') }}" class="btn btn-secondary custom-button" id="refreshPage">
                                                <i class="fas fa-sync-alt"></i> Refresh
                                            </a>
                                        </div>
                                    </div>
                                </form>

                                @if(request('process'))
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Activity</th>
                                                <th>Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($taskCounts as $status => $count)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $status }}</td>
                                                    <td>
                                                        <a href="{{ url('mytaskdata') }}?process={{ request('process') }}&status={{ $status }}">
                                                            {{ $count }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Please select a process to view pending activities.</p>
                                @endif
                            </div>
                            <div class="record-list mt-4">
                                @if(request('status'))
                                    @if(count($records) > 0)
                                        <table class="table table-bordered custom-table">
                                            <thead class="table-header">
                                                <tr>
                                                    <th style="width: 10%">Record ID</th>
                                                    <th style="width: 10%">Initiator</th>
                                                    <th style="width: 20%">Site/Division</th>
                                                    <th style="width: 10%">Record No.</th>
                                                    <th style="width: 15%">Status</th>
                                                    <th>Short Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($records as $record)
                                                    <tr style="text-align: center; font-weight: bold;">
                                                        <td>
                                                            @php
                                                                // Define route names for each process
                                                                $routes = [
                                                                    'ActionItem' => 'actionItem.show',
                                                                    'AuditProgram' => 'ShowAuditProgram',
                                                                    'Capa' => 'capashow',
                                                                    'CC' => 'CC.show',
                                                                    'Deviation' => 'devshow',
                                                                    'EffectivenessCheck' => 'effectiveness.show',
                                                                    'Errata' => 'errata.show',
                                                                    'Extension' => 'extension_newshow',
                                                                    'ExternalAudit' => 'showExternalAudit',
                                                                    'Incident' => 'incident-show',
                                                                    'InternalAudit' => 'showInternalAudit',
                                                                    'LabIncident' => 'ShowLabIncident',
                                                                    'ManagementReview' => 'manageshow',
                                                                    'MarketComplaint' => 'marketcomplaint.marketcomplaint_view',
                                                                    'Observation' => 'showobservation',
                                                                    'OOC' => 'ShowOutofCalibration',
                                                                    'OOSOOT' => 'oos.oos_view',
                                                                    'Resampling' => 'resampling_view',
                                                                    'RiskAssessment' => 'showRiskManagement',
                                                                    'RootCauseAnalysis' => 'root_show',
                                                                ];
                                                                $routeName = $routes[request('process')] ?? '';
                                                            @endphp

                                                            @if($routeName)
                                                                <a target="_blank" href="{{ route($routeName, $record->id) }}">
                                                                    {{ Helpers::recordFormat($record->record) }}
                                                                </a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ Helpers::getInitiatorName($record->initiator_id) }}</td>
                                                        <td>{{ Helpers::getDivisionName($record->division_id) }}</td>
                                                        <td>{{ $record->record_number }}</td>
                                                        <td>{{ $record->status }}</td>
                                                        <td>{{ $record->short_description }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No records found for this status.</p>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
