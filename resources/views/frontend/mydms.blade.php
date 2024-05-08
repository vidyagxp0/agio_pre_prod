@extends('frontend.layout.main')
@section('container')
    <section id="my-dms">
        <div class="container-fluid">
            <div class="dms-container">

                <div class="inner-block">

                    <div class="top-filter">
                        <div>
                            {{-- <div class="group-input">
                                <label for="filter">Filter</label>
                                <select name="filter">
                                    <option value="al" selected>All</option>
                                    <option value="my-doc">Change Control</option>
                                    <option value="my-doc">Document Management System</option>
                                </select>
                            </div> --}}
                        </div>
                        <div>
                            <a href="#" id="set-division" class="new-doc-btn">New Document</a>
                            {{-- <a href="#" onclick="window.print();return false;" class="new-doc-btn">Print</a> --}}
                        </div>
                    </div>

                </div>

                <div>

                    <div class="main-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="doc-block">
                                    @if (Helpers::checkRoles(3))
                                        @if (count($draft) > 0)
                                            <div class="sub-block inner-block" id="draft">
                                                <div class="pill">
                                                    Document Management System
                                                </div>
                                                <div class="head">
                                                    <div class="title">Draft</div>
                                                    <div class="result">{{ count($draft) }} Results</div>
                                                </div>
                                                <div class="table-list">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <th class="pr-id" data-bs-toggle="modal"
                                                                data-bs-target="#division-modal">
                                                                ID
                                                            </th>   
                                                            {{-- <th class="division">
                                                                SOP Type
                                                            </th> --}}
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
                                                            @foreach ($draft as $temp)
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                                    action="{{ route('documents.destroy', $temp->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit">Delete</button>
                                                                                </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif

                                        @if (count($under_review) > 0)
                                            <div class="sub-block inner-block" id="under-review">
                                                <div class="pill">
                                                    Document Management System
                                                </div>
                                                <div class="head">
                                                    <div class="title">Under Review</div>
                                                    <div class="result">{{ count($under_review) }} Results</div>
                                                </div>
                                                <div class="table-list">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <th class="pr-id" data-bs-toggle="modal"
                                                                data-bs-target="#division-modal">
                                                                ID
                                                            </th>
                                                            {{-- <th class="division">
                                                                SOP Type
                                                            </th> --}}
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
                                                            @foreach ($under_review as $temp)
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                                    action="{{ route('documents.destroy', $temp->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit">Delete</button>
                                                                                </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif

                                        @if (count($reviewed) > 0)
                                            <div class="sub-block inner-block" id="review-com">
                                                <div class="pill">
                                                    Document Management System
                                                </div>
                                                <div class="head">
                                                    <div class="title">Review Completed</div>
                                                    <div class="result">{{ count($reviewed) }} Results</div>
                                                </div>
                                                <div class="table-list">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <th class="pr-id" data-bs-toggle="modal"
                                                                data-bs-target="#division-modal">
                                                                ID
                                                            </th>
                                                            {{-- <th class="division">
                                                                SOP Type
                                                            </th> --}}
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
                                                            @foreach ($reviewed as $temp)
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                                    action="{{ route('documents.destroy', $temp->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit">Delete</button>
                                                                                </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif

                                        @if (count($under_approval) > 0)
                                            <div class="sub-block inner-block" id="pen-approv">
                                                <div class="pill">
                                                    Document Management System
                                                </div>
                                                <div class="head">
                                                    <div class="title">Pending Approval</div>
                                                    <div class="result">{{ count($under_approval) }} Results</div>
                                                </div>
                                                <div class="table-list">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <th class="pr-id" data-bs-toggle="modal"
                                                                data-bs-target="#division-modal">
                                                                ID
                                                            </th>
                                                            {{-- <th class="division">
                                                                SOP Type
                                                            </th> --}}
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
                                                            @foreach ($under_approval as $temp)
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                                    action="{{ route('documents.destroy', $temp->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit">Delete</button>
                                                                                </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif


                                        {{-- <div class="sub-block" id="pen-train">
                                            <div class="head">
                                                <div class="title">Pending Training</div>
                                                <div class="result">2 Results</div>
                                            </div>
                                            <div class="table-list">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <th class="pr-id" data-bs-toggle="modal"
                                                            data-bs-target="#division-modal">
                                                            SOP-ID
                                                        </th>
                                                        <th class="division">
                                                            SOP Type
                                                        </th>
                                                        <th class="short-desc">
                                                            Short Description
                                                        </th>
                                                        <th class="create-date">
                                                            Create Date Time
                                                        </th>
                                                        <th class="assign-name">
                                                            Assigned To
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
                                                    <tbody>
                                                        <tr>
                                                            <td class="pr-id" style="text-decoration:underline">
                                                                <a href="#">
                                                                    SOP-23
                                                                </a>
                                                            </td>
                                                            <td class="division">
                                                                Global
                                                            </td>

                                                            <td class="short-desc">
                                                                Short Description 232
                                                            </td>
                                                            <td class="create-date">
                                                                2023-03-12 15:46:40
                                                            </td>
                                                            <td class="assign-name">
                                                                Piyush Sahu
                                                            </td>
                                                            <td class="modify-date">
                                                                2023-03-12 15:46:40
                                                            </td>
                                                            <td class="status">
                                                                Pending Training
                                                            </td>
                                                            <td class="action">
                                                                <div class="action-dropdown">
                                                                    <div class="action-down-btn">Action <i
                                                                            class="fa-solid fa-angle-down"></i></div>
                                                                    <div class="action-block">
                                                                        <a href="#">View</a>
                                                                        <a href="#">Edit</a>
                                                                        <button type="submit">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pr-id" style="text-decoration:underline">
                                                                <a href="#">
                                                                    SOP-23
                                                                </a>
                                                            </td>
                                                            <td class="division">
                                                                Global
                                                            </td>

                                                            <td class="short-desc">
                                                                Short Description 232
                                                            </td>
                                                            <td class="create-date">
                                                                2023-03-12 15:46:40
                                                            </td>
                                                            <td class="assign-name">
                                                                Piyush Sahu
                                                            </td>
                                                            <td class="modify-date">
                                                                2023-03-12 15:46:40
                                                            </td>
                                                            <td class="status">
                                                                Pending Training
                                                            </td>
                                                            <td class="action">
                                                                <div class="action-dropdown">
                                                                    <div class="action-down-btn">Action <i
                                                                            class="fa-solid fa-angle-down"></i></div>
                                                                    <div class="action-block">
                                                                        <a href="#">View</a>
                                                                        <a href="#">Edit</a>
                                                                        <button type="submit">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> --}}

                                        @if (count($effective) > 0)
                                            <div class="sub-block inner-block" id="effective">
                                                <div class="pill">
                                                    Document Management System
                                                </div>
                                                <div class="head">
                                                    <div class="title">Effective</div>
                                                    <div class="result">{{ count($effective) }} Results</div>
                                                </div>
                                                <div class="table-list">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <th class="pr-id" data-bs-toggle="modal"
                                                                data-bs-target="#division-modal">
                                                                ID
                                                            </th>
                                                            {{-- <th class="division">
                                                                SOP Type
                                                            </th> --}}
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
                                                            @foreach ($effective as $temp)
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                                action="{{ route('documents.destroy', $temp->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit">Delete</button>
                                                                            </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @php
                                            $draft = 0;
                                            $in_review = 0;
                                            $reviewed = 0;
                                            $for_approval = 0;
                                            $approved = 0;
                                            $effective = 0;
                                        @endphp
                                        @foreach ($task as $temp)
                                            @if ($temp->stage == 1)
                                                <div class="sub-block inner-block" id="draft">
                                                    <div class="pill">
                                                        Document Management System
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Draft</div>
                                                        {{-- <div class="result">{{ count($draft) }} Results</div> --}}
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    ID
                                                                </th>
                                                                {{-- <th class="division">
                                                                    SOP Type
                                                                </th> --}}
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

                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i>
                                                                            </div>
                                                                            <div class="action-block">
                                                                                <a
                                                                                    href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                            action="{{ route('documents.destroy', $temp->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">Delete</button>
                                                                        </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @elseif($temp->stage == 2)
                                                <div class="sub-block inner-block" id="under-review">
                                                    <div class="pill">
                                                        Document Management System
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Under Review</div>
                                                        {{-- <div class="result">{{ count($under_review) }} Results</div> --}}
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    ID
                                                                </th>
                                                                {{-- <th class="division">
                                                                    SOP Type
                                                                </th> --}}
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

                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i>
                                                                            </div>
                                                                            <div class="action-block">
                                                                                <a
                                                                                    href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                            action="{{ route('documents.destroy', $temp->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">Delete</button>
                                                                        </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @elseif ($temp->stage == 3)
                                                <div class="sub-block inner-block" id="review-com">
                                                    <div class="pill">
                                                        Document Management System
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Review Completed</div>
                                                        {{-- <div class="result">{{ count($reviewed) }} Results</div> --}}
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    ID
                                                                </th>
                                                                {{-- <th class="division">
                                                                    SOP Type
                                                                </th> --}}
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

                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i>
                                                                            </div>
                                                                            <div class="action-block">
                                                                                <a
                                                                                    href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                            action="{{ route('documents.destroy', $temp->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">Delete</button>
                                                                        </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @elseif ($temp->stage == 4)
                                                <div class="sub-block inner-block" id="pen-approv">
                                                    <div class="pill">
                                                        Document Management System
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Pending Approval</div>
                                                        {{-- <div class="result">{{ count($under_approval) }} Results</div> --}}
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    ID
                                                                </th>
                                                                {{-- <th class="division">
                                                                    SOP Type
                                                                </th> --}}
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

                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i>
                                                                            </div>
                                                                            <div class="action-block">
                                                                                <a
                                                                                    href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                            action="{{ route('documents.destroy', $temp->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">Delete</button>
                                                                        </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="sub-block" id="pen-train">
                                                    <div class="head">
                                                        <div class="title">Pending Training</div>
                                                        <div class="result">2 Results</div>
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    SOP-ID
                                                                </th>
                                                                <th class="division">
                                                                    SOP Type
                                                                </th>
                                                                <th class="short-desc">
                                                                    Short Description
                                                                </th>
                                                                <th class="create-date">
                                                                    Create Date Time
                                                                </th>
                                                                <th class="assign-name">
                                                                    Assigned To
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
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline">
                                                                        <a href="#">
                                                                            SOP-23
                                                                        </a>
                                                                    </td>
                                                                    <td class="division">
                                                                        Global
                                                                    </td>

                                                                    <td class="short-desc">
                                                                        Short Description 232
                                                                    </td>
                                                                    <td class="create-date">
                                                                        2023-03-12 15:46:40
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        Piyush Sahu
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        2023-03-12 15:46:40
                                                                    </td>
                                                                    <td class="status">
                                                                        Pending Training
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="#">View</a>
                                                                                <a href="#">Edit</a>
                                                                                <button type="submit">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline">
                                                                        <a href="#">
                                                                            SOP-23
                                                                        </a>
                                                                    </td>
                                                                    <td class="division">
                                                                        Global
                                                                    </td>

                                                                    <td class="short-desc">
                                                                        Short Description 232
                                                                    </td>
                                                                    <td class="create-date">
                                                                        2023-03-12 15:46:40
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        Piyush Sahu
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        2023-03-12 15:46:40
                                                                    </td>
                                                                    <td class="status">
                                                                        Pending Training
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i></div>
                                                                            <div class="action-block">
                                                                                <a href="#">View</a>
                                                                                <a href="#">Edit</a>
                                                                                <button type="submit">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> --}}
                                            @elseif($temp->stage == 8)
                                                <div class="sub-block inner-block" id="effective">
                                                    <div class="pill">
                                                        Document Management System
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Effective</div>
                                                        {{-- <div class="result">{{ count($effective) }} Results</div> --}}
                                                    </div>
                                                    <div class="table-list">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <th class="pr-id" data-bs-toggle="modal"
                                                                    data-bs-target="#division-modal">
                                                                    ID
                                                                </th>
                                                                {{-- <th class="division">
                                                                    SOP Type
                                                                </th> --}}
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
                                                                {{-- @foreach ($effective as $temp) --}}
                                                                <tr>
                                                                    <td class="pr-id" style="text-decoration:underline"><a
                                                                        href="{{ route('documents.edit', $temp->id) }}">
                                                                        000{{ $temp->id }}
                                                                    </a>
                                                                </td>
                                                                    {{-- <td class="division">
                                                                        {{ $temp->type }}
                                                                    </td> --}}

                                                                    <td class="short-desc">
                                                                        {{ $temp->short_description }}
                                                                    </td>
                                                                    <td class="create-date">
                                                                        {{ $temp->created_at }}
                                                                    </td>
                                                                    <td class="assign-name">
                                                                        {{ $temp->originator->name }}
                                                                    </td>
                                                                    <td class="modify-date">
                                                                        {{ $temp->updated_at }}
                                                                    </td>
                                                                    <td class="status">
                                                                        {{ $temp->status }}
                                                                    </td>
                                                                    <td class="action">
                                                                        <div class="action-dropdown">
                                                                            <div class="action-down-btn">Action <i
                                                                                    class="fa-solid fa-angle-down"></i>
                                                                            </div>
                                                                            <div class="action-block">
                                                                                <a
                                                                                    href="{{ url('doc-details', $temp->id) }}">View
                                                                                </a>

                                                                                <a
                                                                                    href="{{ route('documents.edit', $temp->id) }}">Edit</a>
                                                                                {{-- <form
                                                                            action="{{ route('documents.destroy', $temp->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">Delete</button>
                                                                        </form> --}}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- <div class="sub-block inner-block" id="cc-open">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Open State</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="sub-block inner-block" id="cc-hod-review">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Under HOD Review</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="sub-block inner-block" id="cc-reviewed">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Reviewed by HOD</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="sub-block inner-block" id="cc-cft-review">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Under CFT Review</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="sub-block inner-block" id="cc-approved">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Approved</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="sub-block inner-block" id="cc-effective">
                                        <div class="pill">
                                            Change Control
                                        </div>
                                        <div class="head">
                                            <div class="title">Effective</div>
                                            <div class="result">1 Results</div>
                                        </div>
                                        <div class="table-list">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <th class="pr-id" data-bs-toggle="modal"
                                                        data-bs-target="#division-modal">
                                                        Sr. No.
                                                    </th>
                                                    <th class="division">
                                                        Title
                                                    </th>
                                                    <th class="short-desc">
                                                        Due Date
                                                    </th>
                                                    <th class="create-date">
                                                        HOD
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </thead>
                                                <tbody id="searchTable">
                                                    <tr>
                                                        <td class="pr-id">
                                                            <a href="#">
                                                                1.
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            EQMS - SOP
                                                        </td>
                                                        <td class="short-desc">
                                                            12-03-2023 11:12PM
                                                        </td>
                                                        <td class="create-date">
                                                            Piyush Sahu
                                                        </td>
                                                        <td class="action">
                                                            <a href="#" class="view">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="sub-filter inner-block">
                                    <div class="filter-block">
                                        <div class="head">DMS Summary by Status</div>
                                        <div class="filter-drop">
                                            <div>
                                                <label for="draft">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="draft" checked>
                                                    Draft
                                                </label>
                                            </div>
                                            <div>
                                                <label for="under-review">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="under-review" checked>
                                                    Under Review
                                                </label>
                                            </div>
                                            <div>
                                                <label for="review-com">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="review-com" checked>
                                                    Review Completed
                                                </label>
                                            </div>
                                            <div>
                                                <label for="pen-approv">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="pen-approv" checked>
                                                    Pending Approval
                                                </label>
                                            </div>
                                            <div>
                                                <label for="pen-train">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="pen-train" checked>
                                                    Pending Training
                                                </label>
                                            </div>
                                            <div>
                                                <label for="effective">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="effective" checked>
                                                    Effective
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-filter inner-block">
                                    <div class="filter-block">
                                        <div class="head">Change Control Summary by Status</div>
                                        <div class="filter-drop">
                                            <div>
                                                <label for="cc-open">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-open" checked>
                                                    Open State
                                                </label>
                                            </div>
                                            <div>
                                                <label for="cc-hod-review">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-hod-review" checked>
                                                    Under HOD Review
                                                </label>
                                            </div>
                                            <div>
                                                <label for="cc-reviewed">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-reviewed" checked>
                                                    Reviewed by HOD
                                                </label>
                                            </div>
                                            <div>
                                                <label for="cc-cft-review">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-cft-review" checked>
                                                    Under CFT Review
                                                </label>
                                            </div>
                                            <div>
                                                <label for="cc-approved">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-approved" checked>
                                                    Approved
                                                </label>
                                            </div>
                                            <div>
                                                <label for="cc-effective">
                                                    <input type="checkbox" name="sub-filter" class="filter-checkbox"
                                                        data-target="cc-effective" checked>
                                                    Effective
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_submit') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('q_m_s_divisions')->where('status', 1)->get();
                            @endphp
                            <style>
                                #division-modal .tab a.active {
                                    background-color: #23a723 !important;
                                    color: white !important;
                                }
                            </style>
                            @foreach ($division as $temp)
                            <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                            <a style="display: block;
                            background-color: inherit;
                            color: black;
                            padding: 5px 10px;
                            width: 100%;
                            border: none;
                            outline: none;
                            text-align: left;
                            cursor: pointer;
                            transition: 0.3s;" class="divisionlinks"
                                onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</a>
                                {{-- <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button> --}}
                            @endforeach
                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" class="process_id_reset" for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        <a href="/mydms" style="border: 1px solid grey;
                        letter-spacing: 1px;
                        font-size: 0.9rem;
                        padding: 3px 10px;
                        background: black;
                        color: white;">Cancel</a>
                        {{-- <button id="submit-division">Cancel</button> --}}
                        <button type="submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
