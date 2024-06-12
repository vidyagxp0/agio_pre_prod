@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
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
                                                <td class="division">
                                                    {{ $temp->document_type_name }}
                                                </td>

                                                <td class="short-desc">
                                                    {{$temp->short_description}}
                                                </td>
                                                <td class="create-date">
                                                    {{$temp->created_at}}
                                                </td>
                                                <td class="assign-name">
                                                    {{$temp->originator_name}}
                                                </td>
                                                <td class="modify-date">
                                                    {{$temp->updated_at}}
                                                </td>
                                                <td class="status">
                                                    {{$temp->status}}
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
            </div>
        </div>
    </div>
@endsection
