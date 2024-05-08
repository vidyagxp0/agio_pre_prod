@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    BASIC SEARCH
    ======================================= --}}
    <div id="basic-search">
        <div class="container-fluid">
            <div class="inner-block">
                <form action="{{ url('search') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="record_no">Record No.</label>
                            <input type="number" name="record">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="doc_num">Document Number</label>
                            <input type="text" name="doc_num">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="doc_title">Document Title</label>
                            <input type="text" name="document_name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="dep_name">Department Name</label>
                            <select name="dep_name">
                                <option value="0">-- Select --</option>
                               @php
                                   $department = DB::table('departments')->get();
                               @endphp
                               @foreach ($department as $temp)
                               <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="doc_type">Document Type</label>
                            <select name="doc_type">
                                <option value="0">-- Select --</option>
                                @php
                                   $department = DB::table('document_types')->get();
                               @endphp
                               @foreach ($department as $temp)
                               <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="originator">Originator</label>
                            <select name="originator">
                                <option value="0">-- Select --</option>
                                @php
                                    $user = DB::table('users')->where('role', 3)->get();
                                @endphp
                                @foreach ($user as $data)
                                <option value="{{ $data->id }}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="created_date">Created Date</label>
                            <!-- <input type="date" name="created_date"> -->
                            <div>
                                <input type="text"  id="created_date"  readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="created_date" value=""
                                class="hide-input"
                                oninput="handleDateInput(this, 'created_date')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="due_date">Due Date</label>
                            <!-- <input type="date" name="due_date"> -->
                            <div class="calenderauditee">                                     
                                <input type="text"  id="due_date"  readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="due_date" value=""
                                class="hide-input"
                                oninput="handleDateInput(this, 'due_date')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="effective_date">Effective Date</label>
                            <!-- <input type="date" name="effective_date"> -->
                            <div class="calenderauditee">                                     
                                <input type="text"  id="effective_date"  readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="effective_date" value=""
                                class="hide-input"
                                oninput="handleDateInput(this, 'effective_date')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="reviewer">Reviewer</label>
                            <select name="reviewer">
                                <option value="0">-- Select --</option>
                                @php
                                    $user = DB::table('users')->where('role', 2)->get();
                                @endphp
                                @foreach ($user as $data)
                                <option value="{{ $data->id }}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="approver">Approver</label>
                            <select name="approver">
                                <option value="0">-- Select --</option>
                                @php
                                $user = DB::table('users')->where('role', 1)->get();
                            @endphp
                            @foreach ($user as $data)
                            <option value="{{ $data->id }}">{{$data->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="status">Document Status</label>
                            <select name="status">
                                <option value="0">-- Select --</option>
                                @php
                                    $status = DB::table('stages')->get();
                                @endphp
                                @foreach ($status as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="purpose">Purpose</label>
                            <textarea name="purpose"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="scope">Scope</label>
                            <textarea name="scope"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="responsibility">Responsibility</label>
                            <textarea name="responsibility"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Abbreviation">Abbreviation</label>
                            <textarea name="abbreviation"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Definition">Definition</label>
                            <textarea name="definition"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Materials-Equipment">Materials and Equipment</label>
                            <textarea name="materials"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="button-block">
                            <button type="submit">Submit</button>
                            <button>Close</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection
