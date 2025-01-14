@extends('frontend.layout.main')
@section('container')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
    <style>
        #fr-logo {
            display: none;
        }

        .fr-logo {
            display: none;
        }

        textarea.note-codable {
            display: none !important;
        }

        .sop-type-header {
            display: grid;
            grid-template-columns: 135px 1fr;
            border: 2px solid #000000;
            margin-bottom: 20px;
        }

        .main-head {
            display: grid;
            place-items: center;
            align-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            border-left: 2px solid #000000;
        }

        .sub-head-2 {
            text-align: center;
            background: #4274da;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 1.5rem;
            color: #fff;
            border: 2px solid #000000;
            border-radius: 40px;
        }

        #displayField {
            border: 1px solid #f0f0f0;
            background: white;
            padding: 20px;
            position: relative;
            display: flex;
            align-items: center;
            list-style-type: none;
        }

        #displayField li {
            margin-left: 1rem;
            background-color: #f0f0f0;
            padding: 5px;
        }

        .close-icon {
            color: red;
            margin-left: auto;
            /* Pushes the icon to the right */
            cursor: pointer;
        }

        div.note-modal-footer>input {
            background: black;
        }
    </style>

    <div id="data-fields">
        <div class="container-fluid">
            <div class="tab">
                <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document
                    information</button>
                {{-- <button class="tablinks" onclick="openData(event, 'doc-chem')">Chemistry SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-instru')">Instrument SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-instrumental')">Instrumental Chemistry SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-micro')">Microbiology SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-lab')">Good Laboratory Practices</button>
                <button class="tablinks" onclick="openData(event, 'doc-wet')">Wet Chemistry</button>
                <button class="tablinks" onclick="openData(event, 'doc-others')">Others</button> --}}
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks" onclick="openData(event, 'doc-content')">Document Content</button>
                <button class="tablinks" onclick="openData(event, 'annexures')">Annexures</button>
                {{-- <button class="tablinks" onclick="openData(event, 'hod-remarks-tab')">HOD Remarks</button> --}}
                <button class="tablinks" onclick="openData(event, 'distribution-retrieval')">Distribution &
                    Retrieval</button>
                {{-- <button class="tablinks" onclick="openData(event, 'print-download')">Print and Download Control </button> --}}
                <button class="tablinks" onclick="openData(event, 'sign')">Signature</button>
                <button class="tablinks printdoc" style="float: right;"
                    onclick="window.print();return false;">Print</button>

            </div>
            <form method="POST" action="{{ route('documents.update', $document->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- <textarea id="editor"><h1>Test</h1></textarea>
                <script>
                    const editor = Jodit.make('#editor');
                </script> --}}

                <!-- Tab content -->
                {{-- @foreach ($history as $tempHistory) --}}
                <div id="doc-info" class="tabcontent">
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="originator">Originator</label>
                                    <div class="default-name">{{ $document->originator_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="open-date">Date Opened</label>
                                    <div class="default-name"> {{ $document->date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Division Code"><b>Site/Location Code</b></label>
                                    <input disabled type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName($document->division_id) }}">
                                    {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}
                            </div> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="document_name-desc">Document Name<span
                                            class="text-danger">*</span></label><span id="rchars">255</span>
                                    characters remaining
                                    <input type="text" name="document_name" id="docname" maxlength="255"
                                        {{ Helpers::isRevised($document->stage) }} value="{{ $document->document_name }}"
                                        required>


                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Document Name' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach



                                </div>
                                <p id="docnameError" style="color:red">**Document Name is required</p>

                            </div>

                            <script>
                                var maxLength = 255;
                                $('#docname').keyup(function() {
                                    var textlen = maxLength - $(this).val().length;
                                    $('#rchars').text(textlen);
                                });
                            </script>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>
                                        <input class="input-field" type="text" name="document_name_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>

                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="short-desc">Short Description* </label>
                                    <span id="editrchars">255</span>
                                    characters remaining
                                    <input type="text" name="short_desc" id="short_desc" maxlength="255"
                                        {{ Helpers::isRevised($document->stage) }}
                                        value="{{ $document->short_description }}">
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Short Description' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="short_descError" style="color:red">**Short description is required</p>

                            </div>

                            <script>
                                var maxLength = 255;
                                $('#short_desc').keyup(function() {
                                    var textlen = maxLength - $(this).val().length;
                                    $('#editrchars').text(textlen);
                                });
                            </script>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="short_desc_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>

                            @endif

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="sop_type">SOP Type</label>

                                    <select name="sop_type" id="sop_type" required onchange="updateSopTypeShort()"
                                        @if ($document->stage == 11 || $document->status == 'Obsolete') disabled @endif>
                                        <option value="" disabled {{ $document->sop_type == '' ? 'selected' : '' }}>
                                            Enter your selection</option>
                                        <option value="SOP (Standard Operating procedure)"
                                            {{ $document->sop_type == 'SOP (Standard Operating procedure)' ? 'selected' : '' }}>
                                            SOP (Standard Operating procedure)</option>
                                        <option value="EOP (Equipment Operating procedure)"
                                            {{ $document->sop_type == 'EOP (Equipment Operating procedure)' ? 'selected' : '' }}>
                                            EOP (Equipment Operating procedure)</option>
                                        <option value="IOP (Instrument Operating Procedure)"
                                            {{ $document->sop_type == 'IOP (Instrument Operating Procedure)' ? 'selected' : '' }}>
                                            IOP (Instrument Operating Procedure)</option>
                                    </select>

                                    <!-- <input type="hidden" name="sop_type_short" id="sop_type_short" value="{{ $document->sop_type_short }}"> -->

                                    {{-- @foreach ($history as $tempHistory)
                                    @if ($tempHistory->activity_type == 'SOP Type' && !empty($tempHistory->comment) && $tempHistory->user_id == Auth::user()->id)
                                        @php
                                            $users_name = DB::table('users')
                                                ->where('id', $tempHistory->user_id)
                                                ->value('name');
                                        @endphp
                                        <p style="color: blue">Modify by {{ $users_name }} at
                    {{ $tempHistory->created_at }}
                    </p>
                    <input class="input-field" style="background: #ffff0061;
                                        color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
                    @endif
                    @endforeach --}}

                                </div>
                                @if (Auth::user()->role != 3 && $document->stage < 8) Add Comment <div
                                        class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="sop_type_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                    <input type="hidden" name="sop_type_short" id="sop_type_short"
                                        value="{{ $document->sop_type_short }}">

                                @endif
                                <script>
                                    function updateSopTypeShort() {
                                        const sopType = document.getElementById('sop_type').value;
                                        let shortName = '';
                                        if (sopType === 'SOP (Standard Operating procedure)') {
                                            shortName = 'SOP';
                                        } else if (sopType === 'EOP (Equipment Operating procedure)') {
                                            shortName = 'EOP';
                                        } else if (sopType === 'IOP (Instrument Operating Procedure)') {
                                            shortName = 'IOP';
                                        }
                                        document.getElementById('sop_type_short').value = shortName;
                                    }
                                    window.onload = function() {
                                        updateSopTypeShort();
                                    }
                                </script>




                            </div>
                            <div class="col-md-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date</label>
                                    <div><small class="text-primary">Kindly Fill Target Date of Completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="due_dateDoc" value="{{ $document->due_dateDoc }}"
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_dateDoc"
                                            value="{{ $document->due_dateDoc ? Carbon\Carbon::parse($document->due_dateDoc)->format('Y-m-d') : '' }}"
                                            readonly {{ Helpers::isRevised($document->stage) }} class="hide-input"
                                            style="position: absolute; top: 0; left: 0; opacity: 0;"
                                            min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                            oninput="handleDateInput(this, 'due_dateDoc')" />
                                    </div>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Due Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="due_dateDocError" style="color:red">**Due Date is required</p>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}
                                            </p>

                                            <input class="input-field" type="text" name="due_date_comment">
                                        </div>

                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-8">
                                <div class="group-input">
                                    <label for="notify_to">Notify To</label>
                                    <select multiple name="notify_to[]" placeholder="Select Persons" data-search="false"
                                        data-silent-initial-value-set="true" id="notify_to"
                                        {{ Helpers::isRevised($document->stage) }}>
                                        @php
                                            $notify_user_id = explode(',', $document->notify_to);
                                        @endphp
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}"
                                                {{ in_array($data->id, $notify_user_id) ? 'selected' : '' }}>
                                                {{ $data->name }}
                                                {{-- ({{ $data->role }}) --}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Notify To' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="notify_to_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <!-- <div class="col-md-12">
                                                                <div class="group-input">
                                                                    <label for="description">Description</label>
                                                                    <textarea name="description" {{ Helpers::isRevised($document->stage) }}>{{ $document->description }}</textarea>
                                                                    @foreach ($history as $tempHistory)
    @if (
        $tempHistory->activity_type == 'Description' &&
            !empty($tempHistory->comment) &&
            $tempHistory->user_id == Auth::user()->id)
    @php
        $users_name = DB::table('users')
            ->where('id', $tempHistory->user_id)
            ->value('name');
    @endphp
                                                                    <p style="color: blue">Modify by {{ $users_name }} at
                                                                        {{ $tempHistory->created_at }}
                                                                    </p>
                                                                    <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
    @endif
    @endforeach
                                                                </div>
                                                            </div> -->
                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="description_comment">
                                    </div>
                                    <!-- <div class="button">Add Comment</div> -->
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="orig-head">
                        Document Information
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-num">Document Number</label>
                                    <input type="text" id="doc-num" name="document_number" class="default-name" readonly
                                        value="@php
                                            $temp = DB::table('document_types')
                                                ->where('name', $document->document_type_name)
                                                ->value('typecode');
                                        @endphp
                                        @if ($document->revised === 'Yes')
                                            {{ $document->sop_type_short }}
                                            /@if ($document->document_type_name)
                                                {{ $temp }} /@endif{{ $year }}
                                            /000{{ $document->id }}/R{{ $document->major }}
                                        @else
                                            {{ $document->sop_type_short }}/{{ $document->department_id }}/000{{ $document->id }}/R{{ $document->major }}
                                        @endif">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="legacy_number">Legacy Document Number</label>
                                    <input type="text" id="legacy_number" name="legacy_number"
                                        value="{{ $document->legacy_number }}" maxlength="255"
                                        {{ Helpers::isRevised($document->stage) }}>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="link-doc">Reference Record</label>
                                    {{-- <select multiple name="reference_record[]" placeholder="Select Reference Records" data-search="false" data-silent-initial-value-set="true" id="reference_record" {{Helpers::isRevised($document->stage)}}>
                        @if (!empty($document_data))
                        @foreach ($document_data as $temp)
                        <option value="{{ $temp->id }}" {{ str_contains($document->reference_record, $temp->id) ? 'selected' : '' }}>
                            <!-- {{ Helpers::getDivisionName($temp->division_id) }}/{{ $temp->typecode }}/{{ $temp->year }}/000{{ $temp->id }}/R{{$temp->major}}.{{$temp->minor}}/{{$temp->document_name}} -->
                            {{$temp->sop_type_short}}/000{{ $temp->id }}/R{{$temp->major}}.{{$temp->minor}}/{{$temp->document_name}}
                        </option>
                        @endforeach
                        @endif
                    </select> --}}

                                    <select multiple name="reference_record[]" placeholder="Select Reference Records"
                                        data-search="false" data-silent-initial-value-set="true" id="reference_record"
                                        {{ Helpers::isRevised($document->stage) }}>
                                        @if (!empty($document_data))
                                            @foreach ($document_data as $temp)
                                                @if ($temp->id != $document->id)
                                                    <option value="{{ $temp->id }}"
                                                        {{ str_contains($document->reference_record, $temp->id) ? 'selected' : '' }}>
                                                        {{ $temp->sop_type_short }}/000{{ $temp->id }}/R{{ $temp->major }}.{{ $temp->minor }}/{{ $temp->document_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Reference Record' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="reference_record_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            </div>

                            {{-- @php
                use Illuminate\Support\Facades\DB;
                $actionItems = DB::table('action_items')->get();
            @endphp
        @php
        $parentChildRecords = DB::table('action_items')->get();
        @endphp
        <div class="col-md-6">
            <div class="group-input">
                <label for="link-doc">Parent Child Record</label>
                <select multiple name="parent_child[]" placeholder="Select Parent Child Records" id="parent_child">
                    @if (!empty($parentChildRecords))
                        @foreach ($parentChildRecords as $item)
                            <option value="{{ $item->id }}" {{( json_decode($document->parent_child ?? '[]')) ? 'selected' : '' }}>
                                {{ Helpers::getDivisionName(session()->get('division')) }}/AI/{{ date('Y') }}/{{ $item->record }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div> --}}

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="depart-name">Department Name</label>
                                    <select name="department_id" id="depart-name"
                                        {{ Helpers::isRevised($document->stage) }}>
                                        <option value="" disabled selected>Enter your Selection</option>

                                        @foreach (Helpers::getDmsDepartments() as $code => $department)
                                            <option value="{{ $code }}"
                                                @if ($document->department_id == $code) selected @endif>{{ $department }}
                                            </option>
                                        @endforeach

                                        {{-- @foreach ($departments as $department)
                                            <option data-id="{{ $department->dc }}" value="{{ $department->id }}"
                    {{ $department->id == $document->department_id ? 'selected' : '' }}>
                    {{ $department->name }}</option>
                    @endforeach --}}
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Department' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="depart-nameError" style="color:red">**Department Name is required</p>


                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="department_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="depart-code">Department Code</label>
                                    <div class="default-name"> <span id="department-code">
                                            @if (!empty($departments))
                                                @foreach ($departments as $department)
                                            {{ $document->department_id == $department->id ? $department->dc : '' }}
    @endforeach
    @else
    Not Selected
    @endif

    </span></div>
    </div>
    </div> --}}

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="major">Document Version <small>(Major)</small><span
                                            class="text-danger">*</span>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-management-system-modal"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction) </span>
                                    </label>
                                    <input type="number" name="major" id="major" min="0"
                                        value="{{ $document->major }}" required
                                        {{ Helpers::isRevised($document->stage) }}>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Major' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="major_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="minor">Document Version <small>(Minor)</small><span
                                            class="text-danger">*</span>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-management-system-modal"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction) </span>
                                    </label>
                                    <input type="number" name="major" id="major" min="0"
                                        value="{{ $document->major }}" required
                                        {{ Helpers::isRevised($document->stage) }}>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Major' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="major_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            </div>




                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-type">Document Type</label>
                                    <select name="document_type_id" id="doc-type"
                                        {{ Helpers::isRevised($document->stage) }}>
                                        <option value="">Enter your Selection</option>
                                        @foreach (Helpers::getDocumentTypes() as $code => $type)
                                            <option data-id="{{ $code }}" value="{{ $code }}"
                                                {{ $code == $document->document_type_id ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modified by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}</p>
                                            <input class="input-field" style="background: #ffff0061; color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3 && $document->stage < 8)
                                    {{-- Add Comment --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modified by
                                                {{ Auth::user()->name }} at {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="document_type_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-code">Document Type Code</label>
                                    <div class="default-name">
                                        <span id="document_type_code">
                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
                                                {{ $code == $document->document_type_id ? $code : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p id="doc-typeError" style="color:red">**Document Type is required</p>

                            <!-- <div class="col-md-6">
                                                                        <div class="group-input">
                                                                            <label for="doc-type">Document Type</label>
                                                                        <select name="document_type_id" id="doc-type" {{ Helpers::isRevised($document->stage) }}>
                                                                            <option value="">Enter your Selection</option>
                                                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
    <option data-id="{{ $code }}" value="{{ $code }}" {{ $code = $document->document_type_id ? 'selected' : '' }}>
                                                                                {{ $type }}
                                                                            </option>
    @endforeach
                                                                        </select>
                                                                        @foreach ($history as $tempHistory)
    @if (
        $tempHistory->activity_type == 'Document' &&
            !empty($tempHistory->comment) &&
            $tempHistory->user_id == Auth::user()->id)
    @php
        $users_name = DB::table('users')
            ->where('id', $tempHistory->user_id)
            ->value('name');
    @endphp
                                                                        <p style="color: blue">Modify by {{ $users_name }} at
                                                                            {{ $tempHistory->created_at }}
                                                                        </p>
                                                                        <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
    @endif
    @endforeach
                                                                    </div>

                                                                    @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div class="comment">
                                                                        <div>
                                                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                                                at {{ date('d-M-Y h:i:s') }}</p>

                                                                            <input class="input-field" type="text" name="document_type_id_comment">
                                                                        </div>
                                                                        <div class="button">Add Comment</div>
                                                                </div>
                                                                @endif

                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                        <label for="doc-code">Document Type Code</label>
                                                                        <div class="default-name"> <span id="document_type_code">
                                                                                @foreach (Helpers::getDocumentTypes() as $code => $type)
    {{ $code == $document->document_type_id ? $code : '' }}
    @endforeach

                                                                            </span> </div>

                                                                    </div>
                                                                </div>
                                                                <p id="doc-typeError" style="color:red">**Document Type is required</p> -->

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-type">Document Sub Type</label>
                                    <select name="document_subtype_id" id="doc-subtype">
                                        <option value="">Enter your Selection</option>
                                        @foreach ($documentsubTypes as $type)
                                            <option data-id="{{ $type->code }}" value="{{ $type->id }}"
    {{ $type->id == $document->document_subtype_id ? 'selected' : '' }}>
    {{ $type->docSubtype }}</option>
    @endforeach
    </select>
    @foreach ($history as $tempHistory)
    @if ($tempHistory->activity_type == 'Document Sub Type' && !empty($tempHistory->comment) && $tempHistory->user_id == Auth::user()->id)
    @php
    $users_name = DB::table('users')
    ->where('id', $tempHistory->user_id)
    ->value('name');
    @endphp
    <p style="color: blue">Modify by {{ $users_name }} at
        {{ $tempHistory->created_at }}
    </p>
    <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
    @endif
    @endforeach
    </div>



    @if (Auth::user()->role != 3 && $document->stage < 8) Add Comment <div class="comment">
        <div>
            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                at {{ date('d-M-Y h:i:s') }}</p>

            <input class="input-field" type="text" name="document_type_id_comment">
        </div>
        <div class="button">Add Comment</div>
        </div>
        @endif

        </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-code">Document Type Code</label>
                                    <div class="default-name"> <span id="document_type_code">
                                            @if (!empty($documentTypes))
                                                @foreach ($documentTypes as $type)
                                                    {{ $document->document_type_id == $type->id ? $type->typecode : '' }}
        @endforeach
        @else
        Not Selected
        @endif

        </span> </div>
        </div>
        </div> --}}

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-lang">Document Language</label>
                                    <select name="document_language_id" id="doc-lang"
                                        {{ Helpers::isRevised($document->stage) }}>
                                        <option value="">Enter your Selection</option>
                                        @foreach ($documentLanguages as $lan)
                                            <option data-id="{{ $lan->lcode }}" value="{{ $lan->id }}"
                                                {{ $lan->id == $document->document_language_id ? 'selected' : '' }}>
                                                {{ $lan->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Document Language' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="document_language_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-lang">Document Language Code</label>
                                    <div class="default-name"><span id="document_language">
                                            @if (!empty($documentLanguages))
                                                @foreach ($documentLanguages as $lan)
                                                    {{ $document->document_language_id == $lan->id ? $lan->lcode : '' }}
                                                @endforeach
                                            @else
                                                Not Selected
                                            @endif

                                        </span></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="keyword">Keywords</label>
                                    <div class="add-keyword">
                                        <input type="text" id="sourceField" class="mb-0" maxlength="15"
                                            {{ Helpers::isRevised($document->stage) }}>
                                        <button id="addButton" type="button">ADD</button>
                                    </div>
                                    <ul id="displayField" class="d-flex justify-content-between align-items-center">
                                        @if (!empty($keywords))
                                            @foreach ($keywords as $lan)
                                                <li>
                                                    {{ $lan->keyword }}
                                                    <span class="close-icon ms-2">x</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <select name="keywords[]" class="targetField" multiple id="keywords"
                                        style="display: none">
                                        @if (!empty($keywords))
                                            @foreach ($keywords as $lan)
                                                <option value="{{ $lan->keyword }}" selected>
                                                    {{ $lan->keyword }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Keywords' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-5 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="effective-date">Effective Date</label>
                                    <div><small class="text-primary">The effective date will be automatically populated
                                            once the record becomes effective</small></div>
                                    <div class="calenderauditee">
                                        <input @if ($document->stage != 1) disabled @endif type="text"
                                            id="effective_date"
                                            value="{{ $document->effective_date ? Carbon\Carbon::parse($document->effective_date)->format('d-M-Y') : '' }}"
                                            readonly placeholder="DD-MMM-YYYY"
                                            {{ Helpers::isRevised($document->stage) }} />
                                        <input @if ($document->stage != 1) disabled @endif type="date"
                                            name="effective_date" value="" class="hide-input"
                                            min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                            oninput="handleDateInput(this, 'effective_date')" />
                                    </div>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Effective Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>

                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="effective_date_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-2">
                                <div class="group-input">
                                    <label for="review-period">Review Period (in years)</label>
                                    <input style="margin-top: 25px;" @if ($document->stage != 1) readonly @endif
                                        type="number" name="review_period" id="review_period" min="0"
                                        {{ Helpers::isRevised($document->stage) }} value={{ $document->review_period }}>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Review Period' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <script>
                                    function validateInput(input) {
                                        if (input.value < 0) {
                                            input.value = 0;
                                        }
                                    }
                                </script>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="review_period_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-5 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="review-date">Next Review Date</label>

                                    <div class="calenderauditee">
                                        <input style="margin-top: 25px;" @if ($document->stage != 1) disabled @endif
                                            type="text" id="next_review_date" class="new_review_date_show"
                                            value="{{ $document->next_review_date ? Carbon\Carbon::parse($document->next_review_date)->format('d-M-Y') : '' }}"
                                            {{ Helpers::isRevised($document->stage) }} readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input @if ($document->stage != 1) disabled @endif type="date"
                                            name="next_review_date" value=""
                                            class="hide-input new_review_date_hide"
                                            min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                            oninput="handleDateInput(this, 'next_review_date')" />
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Next-Review Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="next_review_date_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="draft-doc">Attach Draft document</label>
                                    <input type="file" name="attach_draft_doocument"
                                        style="height: 100% !important; margin-bottom: 0px !important;"
                                        {{ Helpers::isRevised($document->stage) }}
                                        value="{{ $document->attach_draft_doocument }}">
                                    @if ($document->attach_draft_doocument)
                                        <input type="hidden" name="attach_draft_doocument"
                                            value="{{ $document->attach_draft_doocument }}">
                                        <p>Current file: {{ basename($document->attach_draft_doocument) }}</p>
                                    @endif

                                    {{-- @if ($document->attach_draft_doocument)
                                            <input type="hidden" name="attach_draft_doocument" value="{{ $document->attach_draft_doocument }}">
                @php
                $draftDocumentUrl = asset('upload/document/' . basename($document->attach_draft_doocument));
                @endphp
                @if (pathinfo($document->attach_draft_doocument, PATHINFO_EXTENSION) == 'pdf')
                <iframe src="{{ $draftDocumentUrl }}" width="100%" height="600"></iframe>
                @elseif(in_array(pathinfo($document->attach_draft_doocument, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{ $draftDocumentUrl }}" alt="Draft document" style="max-width: 100%;">
                @else
                <p>Preview not available for this file type.</p>
                @endif
                @endif --}}

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Draft Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="attach_draft_doocument_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="effective-doc">Attach Effective document</label>
                                    <input type="file" name="attach_effective_docuement"
                                        style="height: 100% !important; margin-bottom: 0px !important;"
                                        {{ Helpers::isRevised($document->stage) }}
                                        value="{{ $document->attach_effective_docuement }}">
                                    @if ($document->attach_effective_docuement)
                                        <input type="hidden" name="attach_effective_docuement"
                                            value="{{ $document->attach_effective_docuement }}">
                                        <p>Current file: {{ basename($document->attach_effective_docuement) }}</p>
                                    @endif
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Effective Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="attach_effective_docuement_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="orig-head">
                        Other Information
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="reviewers">Reviewers</label>

                                    <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                        name="reviewers[]" placeholder="Select Reviewers" multiple
                                        @if ($document->stage != 1) disabled @endif>
                                        @if (!empty($reviewer))
                                            @foreach ($reviewer as $lan)
                                                @if (Helpers::checkUserRolesreviewer($lan))
                                                    <option value="{{ $lan->id }}"
                                                        @if ($document->reviewers) @php
                                $data = explode(",", $document->reviewers);
                                $count = count($data);
                            @endphp
                            @for ($i = 0; $i < $count; $i++)
                                @if ($data[$i] == $lan->id)
                                    selected @endif
                                                        @endfor
                                                @endif>
                                                {{ $lan->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @endif
                                    </select>



                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Reviewers' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="reviewerError" style="color:red">**Reviewers are required</p>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="reviewers_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="approvers">Approvers</label>
                                    <select id="choices-multiple-remove-button" class="choices-multiple-approver"
                                        {{ !Helpers::userIsQA() ? Helpers::isRevised($document->stage) : '' }}
                                        name="approvers[]" placeholder="Select Approvers" multiple
                                        @if ($document->stage != 1) disabled @endif>
                                        @if (!empty($approvers))
                                            @foreach ($approvers as $lan)
                                                @if (Helpers::checkUserRolesApprovers($lan))
                                                    <option value="{{ $lan->id }}"
                                                        @if ($document->approvers) @php
                            $data = explode(",",$document->approvers);
                            $count = count($data);
                            $i=0;
                            @endphp
                            @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $lan->id)
                                selected @endif
                                                        @endfor
                                                @endif>
                                                {{ $lan->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Approvers' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="approverError" style="color:red">**Approvers are required</p>

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="approvers_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="hods">HOD's</label>
                                    <select id="choices-multiple-remove-button" class="choices-multiple-approver"
                                        {{ !Helpers::userIsQA() ? Helpers::isRevised($document->stage) : '' }}
                                        name="hods[]" placeholder="Select HOD's" multiple
                                        @if ($document->stage != 1) disabled @endif>
                                        @foreach ($hods as $hod)
                                            <option value="{{ $hod->id }}"
                                                @if ($document->hods) @php
                        $data = explode(",",$document->hods);
                        $count = count($data);
                        $i=0;
                        @endphp
                        @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $hod->id)
                            selected @endif
                                                @endfor>
                                                {{ $hod->name }}
                                            </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Approvers' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- <p id="approverError" style="color:red">**Approvers are required</p> --}}

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="approvers_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="reviewers-group">Reviewers Group</label>
                                    <select id="choices-multiple-remove-button" name="reviewers_group[]" {{Helpers::isRevised($document->stage)}}
        placeholder="Select Reviewers" multiple>
        @if (!empty($reviewergroup))
        @foreach ($reviewergroup as $lan)
        <option value="{{ $lan->id }}" @if ($document->reviewers_group) @php
            $data = explode(",",$document->reviewers_group);
            $count = count($data);
            $i=0;
            @endphp
            @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $lan->id)
                selected @endif
                @endfor
                @endif>
                {{ $lan->name }}
        </option>
        @endforeach
        @endif
        </select>
        @foreach ($history as $tempHistory)
        @if ($tempHistory->activity_type == 'Reviewers Group' && !empty($tempHistory->comment) && $tempHistory->user_id == Auth::user()->id)
        @php
        $users_name = DB::table('users')
        ->where('id', $tempHistory->user_id)
        ->value('name');
        @endphp
        <p style="color: blue">Modify by {{ $users_name }} at
            {{ $tempHistory->created_at }}
        </p>
        <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
        @endif
        @endforeach
        </div>

        @if (Auth::user()->role != 3 && $document->stage < 8) <!-- Add Comment -->
            <div class="comment">
                <div>
                    <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                        at {{ date('d-M-Y h:i:s') }}</p>

                    <input class="input-field" type="text" name="reviewers_group_comment">
                </div>
                <div class="button">Add Comment</div>
            </div>
            @endif

            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="approvers-group">Approvers Group</label>
                                    <select id="choices-multiple-remove-button" name="approver_group[]" {{Helpers::isRevised($document->stage)}}
            placeholder="Select Approvers" multiple>
            @if (!empty($approversgroup))
            @foreach ($approversgroup as $lan)
            <option value="{{ $lan->id }}" @if ($document->approver_group) @php
                $data = explode(",",$document->approver_group);
                $count = count($data);
                $i=0;
                @endphp
                @for ($i = 0; $i < $count; $i++) @if ($data[$i] == $lan->id)
                    selected @endif
                    @endfor
                    @endif>
                    {{ $lan->name }}
            </option>
            @endforeach
            @endif
            </select>
            @foreach ($history as $tempHistory)
            @if ($tempHistory->activity_type == 'Approvers Group' && !empty($tempHistory->comment) && $tempHistory->user_id == Auth::user()->id)
            @php
            $users_name = DB::table('users')
            ->where('id', $tempHistory->user_id)
            ->value('name');
            @endphp
            <p style="color: blue">Modify by {{ $users_name }} at
                {{ $tempHistory->created_at }}
            </p>
            <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
            @endif
            @endforeach
            </div>


            @if (Auth::user()->role != 3 && $document->stage < 8) <!-- Add Comment -->
                <div class="comment">
                    <div>
                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                            at {{ date('d-M-Y h:i:s') }}</p>

                        <input class="input-field" type="text" name="approver_group_comment">
                    </div>
                    <div class="button">Add Comment</div>
                </div>
                @endif

                </div> --}}

                            <div class="col-12">
                                <!-- <div class="group-input">
                                                                                    <label for="revision-type">Revision Type</label>
                                                                                    <select name="revision_type" {{ Helpers::isRevised($document->stage) }}>
                                                                                        <option value="0">-- Select --</option>
                                                                                        <option @if ($document->revision_type == 'minor') selected @endif
                                                                                            value="minor">Minor</option>
                                                                                        <option @if ($document->revision_type == 'major') selected @endif
                                                                                            value="major">Major</option>
                                                                                        <option @if ($document->revision_type == 'NA') selected @endif
                                                                                            value="NA">NA</option>
                                                                                    </select>
                                                                                    @foreach ($history as $tempHistory)
    @if ($tempHistory->activity_type == 'Revision Type' && !empty($tempHistory->comment))
    @php
        $users_name = DB::table('users')
            ->where('id', $tempHistory->user_id)
            ->value('name');
    @endphp
                                                                                    <p style="color: blue">Modify by {{ $users_name }} at
                                                                                        {{ $tempHistory->created_at }}
                                                                                    </p>
                                                                                    <input class="input-field" style="background: #ffff0061;
                                color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
    @endif
    @endforeach
                                                                                </div> -->
                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="revision_type_comment">
                                        </div>
                                        <!-- <div class="button">Add Comment</div> -->
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <!-- <div class="group-input">
                                                                                    <label for="summary">Revision Summary</label>

                                                                                    <textarea name="revision_summary" {{ Helpers::isRevised($document->stage) }}>{{ $document->revision_summary }}</textarea>
                                                                                    @foreach ($history as $tempHistory)
    @if ($tempHistory->activity_type == 'Revision Summary' && !empty($tempHistory->comment))
    @php
        $users_name = DB::table('users')
            ->where('id', $tempHistory->user_id)
            ->value('name');
    @endphp
                                                                                    <p style="color: blue">Modify by {{ $users_name }} at
                                                                                        {{ $tempHistory->created_at }}
                                                                                    </p>
                                                                                    <input class="input-field" style="background: #ffff0061;
                                    color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
    @endif
    @endforeach
                                                                                </div> -->

                                @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="revision_summary_comment">
                                        </div>
                                        <!-- <div class="button">Add Comment</div> -->
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="nextButton" id="DocnextButton">Next</button>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------------------------------------- -->

                <!-- ------------------------------------------------------------------------------------------------------------- -->
                <div id="add-doc" class="tabcontent">
                    <div class="orig-head">
                        Training Information
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="train-require">Training Required?</label>
                                    <select name="training_required" {{ Helpers::isRevised($document->stage) }} required>
                                        <option value="">Enter your Selection</option>
                                        @if ($document->training_required == 'yes')
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                        @else
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>

                                        @endif

                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Training Required' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="link-doc">Trainer</label>
                                    <select name="trainer" {{ Helpers::isRevised($document->stage) }}>
                                        <option value="" selected>Enter your Selection</option>
                                        @foreach ($trainer as $temp)
                                            @if (Helpers::checkUserRolestrainer($temp))
                                                <option value="{{ $temp->id }}"
                                                    @if (!empty($trainingDoc)) @if ($trainingDoc->trainer == $temp->id) selected @endif
                                                    @endif>{{ $temp->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Trainer' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="launch-cbt">Launch CBT</label>
                                    <select name="cbt">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="training-type">Type</label>
                                    <select name="training-type">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <div class="group-input">
                                    <label for="test">
                                        Test(0)<button type="button" name="test"
                                            onclick="addTrainRow('test')" {{Helpers::isRevised($document->stage)}}>+</button>
                            </label>
                            <table class="table-bordered table" id="test">
                                <thead>
                                    <tr>
                                        <th class="row-num">Row No.</th>
                                        <th class="question">Question</th>
                                        <th class="answer">Answer</th>
                                        <th class="result">Result</th>
                                        <th class="comment">Comment</th>
                                        <th class="comment">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="group-input">
                            <label for="test">
                                Survey(0)<button type="button" name="reporting1" onclick="addTrainRow('survey')" {{Helpers::isRevised($document->stage)}}>+</button>
                            </label>
                            <table class="table-bordered table" id="survey">
                                <thead>
                                    <tr>
                                        <th class="row-num">Row No.</th>
                                        <th class="question">Subject</th>
                                        <th class="answer">Topic</th>
                                        <th class="result">Rating</th>
                                        <th class="comment">Comment</th>
                                        <th class="comment">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" {{ Helpers::isRevised($document->stage) }}>{{ $document->comments }}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                <div id="doc-content" class="tabcontent">
                    <div class="orig-head">
                        Document Information
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="purpose">Objective</label>
                                    <textarea name="purpose" {{ Helpers::isRevised($document->stage) }}>{{ $document->document_content ? $document->document_content->purpose : '' }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Purpose' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="purpose_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="scope">Scope</label>

                                    <textarea name="scope" {{ Helpers::isRevised($document->stage) }}>{{ $document->document_content ? $document->document_content->scope : '' }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Scope' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="scope_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="responsibility" id="responsibility">
                                        Responsibility<button type="button" id="responsibilitybtnadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <div id="responsibilitydiv">
                                        @if ($document->document_content && !empty($document->document_content->responsibility))
                                            @foreach (unserialize($document->document_content->responsibility) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleResponsibilityBlock' : 'singleResponsibilityBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="responsibility[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea name="responsibility[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-dark subResponsibilityAdd">+</button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="singleResponsibilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibility[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subResponsibilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button
                                                            class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Responsibility' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="responsibility_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="accountability" id="accountability">
                                        Accountability<button type="button" id="accountabilitybtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                    </label>

                                    <div id="accountabilitydiv">

                                        @if ($document->document_content && !empty($document->document_content->accountability))
                                            @foreach (unserialize($document->document_content->accountability) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleAccountabilityBlock' : 'singleAccountabilityBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="accountability[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea name="accountability[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-dark subAccountabilityAdd">+</button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="references" id="references">
                                        References<button type="button" id="referencesbtadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>

                                    <div id="referencesdiv">
                                        @if ($document->document_content && !empty($document->document_content->references))
                                            @foreach (unserialize($document->document_content->references) as $key => $data)
                                                @if (!empty($data))
                                                    <div
                                                        class="{{ str_contains($key, 'sub') ? 'subSingleReferencesBlock' : 'singleReferencesBlock' }}">
                                                        @if (str_contains($key, 'sub'))
                                                            <div class="resrow row">
                                                                <div class="col-6">
                                                                    <textarea name="references[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                                </div>
                                                                <div class="col-1">
                                                                    <button
                                                                        class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <textarea name="references[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button
                                                                        class="btn btn-dark subReferencesAdd">+</button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button
                                                                        class="btn btn-danger removeAllBlocks">Remove</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="singleReferencesBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="references[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReferencesAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button
                                                            class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'References' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach




                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="references_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="abbreviation" id="abbreviation">
                                        Abbreviation<button type="button" id="abbreviationbtnadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>

                                    <div id="abbreviationdiv">
                                        @if ($document->document_content && !empty($document->document_content->abbreviation))
                                            @foreach (unserialize($document->document_content->abbreviation) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleAbbreviationBlock' : 'singleAbbreviationBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="abbreviation[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea name="abbreviation[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button class="btn btn-dark subAbbreviationAdd">+</button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Abbreviation' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="abbreviation_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="abbreviation" id="definition">
                                        Definition<button type="button" id="Definitionbtnadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>

                                    <div id="definitiondiv">
                                        @if ($document->document_content && !empty($document->document_content->defination))
                                            @foreach (unserialize($document->document_content->defination) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleDefinitionBlock' : 'singleDefinitionBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="defination[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea name="defination[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button class="btn btn-dark subDefinitionAdd">+</button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Definiton' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="defination_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="reporting" id="newreport">
                                        General Instructions<button type="button" id="materialsbtadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    @if ($document->document_content && !empty($document->document_content->materials_and_equipments))
                                        <div class="materialsBlock">
                                            @foreach (unserialize($document->document_content->materials_and_equipments) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleMaterialBlock' : 'singleMaterialBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="materials_and_equipments[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea name="materials_and_equipments[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <button type="button" class="subMaterialsAdd"
                                                                    name="button"
                                                                    {{ Helpers::isRevised($document->stage) }}>+</button>
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="singleMaterialBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="materials_and_equipments[]" class="myclassname"></textarea>
                                                </div>

                                                <div class="col-sm-1">
                                                    <button type="button" class="subMaterialsAdd" name="button"
                                                        {{ Helpers::isRevised($document->stage) }}>+</button>
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div id="materialsdiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Materials and Equipments' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text"
                                            name="materials_and_equipments_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif


                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="procedure">Procedure</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea name="procedure" id="summernote" class="summernote">{{ $document->document_content ? $document->document_content->procedure : '' }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Procedure' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="reporting" id="newreport">
                                        Cross References<button type="button" id="reportingbtadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>

                                    <div id="reportingdiv">
                                        @if ($document->document_content && !empty($document->document_content->reporting))
                                            @foreach (unserialize($document->document_content->reporting) as $key => $data)
                                                <div
                                                    class="{{ str_contains($key, 'sub') ? 'subSingleReportingBlock' : 'singleReportingBlock' }}">
                                                    @if (str_contains($key, 'sub'))
                                                        <div class="resrow row">
                                                            <div class="col-6">
                                                                <textarea name="reporting[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-1">
                                                                <button
                                                                    class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea type="text" name="reporting[]" class="" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button class="btn btn-dark subReportingAdd">+</button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button
                                                                    class="btn btn-danger removeAllBlocks">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="singleReportingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea type="text" name="reporting[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReportingAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button
                                                            class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Reporting' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="reporting_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif


                            {{-- <div class="col-md-12">   --Aditya
                                <div class="group-input">
                                    <label for="annexure">
                                        Annexure<button type="button" name="ann" id="annexurebtnadd">+</button>
                                    </label>
                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                    <table class="table-bordered table" id="annexure">
                                        <thead>

                                            <tr>
                                                <th class="sr-num">Sr. No.</th>
                                                <th class="annx-num">Annexure No.</th>
                                                <th class="annx-title">Title of Annexure</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if (!empty($annexure))
                                                @foreach (unserialize($annexure->sno) as $key => $data)
                                                    <tr>
                                                        <td><input type="text" name="serial_number[]"
                                                                value="{{ $data }}"></td>
                                    <td><input type="text" name="annexure_number[]" value="{{ unserialize($annexure->annexure_no)[$key] }}">
                                    </td>
                                    <td><input type="text" name="annexure_data[]" value="{{ unserialize($annexure->annexure_title)[$key] }}">
                                    </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <div id="annexurediv"></div>
                                    </tbody>
                                    </table>
                                    </div>
                                    </div> --}}
                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ann" id="ann">
                                        Annexure<button type="button" id="annbtadd" name="button"
                                            {{ Helpers::isRevised($document->stage) }}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>

                                    <div id="anndiv">
                                        @if ($document->document_content && !empty($document->document_content->ann))
                                            @foreach (unserialize($document->document_content->ann) as $key => $data)
                                                @if (!empty($data))
                                                    <div
                                                        class="{{ str_contains($key, 'sub') ? 'subSingleAnnexureBlock' : 'singleAnnexureBlock' }}">
                                                        @if (str_contains($key, 'sub'))
                                                            <div class="resrow row">
                                                                <div class="col-6">
                                                                    <textarea name="ann[{{ $key }}]" class="myclassname">{{ $data }}</textarea>
                                                                </div>
                                                                <div class="col-1">
                                                                    <button
                                                                        class="btn btn-danger abbreviationbtnRemove">Remove</button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <textarea name="ann[]" class="myclassname" {{ Helpers::isRevised($document->stage) }}>{{ $data }}</textarea>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button class="btn btn-dark subAnnexureAdd">+</button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button
                                                                        class="btn btn-danger removeAllBlocks">Remove</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="singleAnnexureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <input type="text" name="ann[]" class="myclassname">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAnnexureAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button
                                                            class="btn-btn-danger abbreviationbtnRemove">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'ann' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach




                                </div>
                            </div>

                            {{-- @if (Auth::user()->role != 3 && $document->stage < 8)
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                    {{ date('d-M-Y h:i:s') }}</p>

                                    <input class="input-field" type="text" name="ann_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                    </div>
                                    @endif --}}
                            {{-- <div class="col-md-12">
                                <div class="group-input">
                                    <label for="test">
                                        Revision History<button type="button" name="reporting2"
                                            onclick="addDocRow('revision')">+</button>
                                    </label>
                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                    <table class="table-bordered table" id="revision">
                                        <thead>
                                            <tr>
                                                <th class="sop-num">SOP Revision No.</th>
                                                <th class="dcrf-num">Change Control No./ DCRF No.</th>
                                                <th class="changes">Changes</th>
                                                //<th class="deleteRow">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment  --}} <div
                                    class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}
                                        </p>

                                        <input class="input-field" type="text" name="comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="group-input">
                                <label for="summary">Revision History</label>
                                <textarea name="revision_summary">{{ $document->revision_summary }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="input-fields">
                        <div class="group-input">
                            <label for="distribution-list" style="font-weight: bold;">
                                Distribution List
                            </label>
                            <div class="table-responsive retrieve-table">
                                <table class="table table-bordered" id="distribution-list">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th class="copy-name">Copy</th>
                                            <th class="copy-name">No. of Copies</th>
                                            <th class="copy-name">User Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td style="font-weight: bold;">Master Copy</td>
                                            <td><input type="text" id="copies-master"
                                                    name="master_copy_number"
                                                    value="{{ $document->master_copy_number }}" class="form-control">
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="group-input">
                                                        <input type="text" name="master_user_department" value="{{$document->master_user_department}}">
                                                        {{-- <select name="master_user_department"
                                                            id="master_user_department" class="form-control"
                                                            {{ Helpers::isRevised($document->stage) }}>
                                                            <option value="" disabled selected>Enter your Selection
                                                            </option>

                                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                                <option value="{{ $code }}"
                                                                    @if ($document->master_user_department == $code) selected @endif>
                                                                    {{ $department }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <select id="department-master" class="form-control"
                                                    placeholder="Select..." name="master_user_department">
                                                    <option value="">Select the departments</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}"
                                                            {{ $document->master_user_department == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td style="font-weight: bold;">Controlled Copy</td>
                                            <td><input type="text" id="copies-controlled"
                                                    name="controlled_copy_number"
                                                    value="{{ $document->controlled_copy_number }}"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="group-input">
                                                        <input type="text" name="controlled_user_department" value="{{$document->controlled_user_department}}">
                                                        {{-- <select name="controlled_user_department"
                                                            id="controlled_user_department" class="form-control"
                                                            {{ Helpers::isRevised($document->stage) }}>
                                                            <option value="" disabled selected>Enter your Selection
                                                            </option>

                                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                                <option value="{{ $code }}"
                                                                    @if ($document->controlled_user_department == $code) selected @endif>
                                                                    {{ $department }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <select id="department-controlled" class="form-control"
                                                    placeholder="Select..." name="controlled_user_department">
                                                    <option value="">Select the departments</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}"
                                                            {{ $document->controlled_user_department == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td style="font-weight: bold;">Display Copy</td>
                                            <td><input type="text" id="copies-display"
                                                    name="display_copy_number"
                                                    value="{{ $document->display_copy_number }}" class="form-control">
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="group-input">
                                                        <input type="text" name="display_user_department" value="{{$document->display_user_department}}">
                                                        {{-- <select name="display_user_department"
                                                            id="display_user_department" class="form-control"
                                                            {{ Helpers::isRevised($document->stage) }}>
                                                            <option value="" disabled selected>Enter your Selection
                                                            </option>

                                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                                <option value="{{ $code }}"
                                                                    @if ($document->display_user_department == $code) selected @endif>
                                                                    {{ $department }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <select id="department-display" class="form-control"
                                                    placeholder="Select..." name="display_user_department">
                                                    <option value="">Select the departments</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}"
                                                            {{ $document->display_user_department == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                {{-- HOD REMARKS TAB START --}}
                <div id="hod-remarks-tab" class="tabcontent">

                    <div class="input-fields">
                        <div class="group-input">
                            <label for="hod-remark">HOD Comments</label>
                            <textarea class="summernote {{ !Helpers::checkRoles(4) ? 'summernote-disabled' : '' }}" name="hod_comments">{{ $document->document_content ? $document->document_content->hod_comments : '' }}</textarea>
                        </div>
                    </div>

                    <div class="input-fields">
                        <label for="tran-attach">HOD Attachments</label>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="hod_attachments">
                                @if ($document->document_content && $document->document_content->hod_attachments)
                                    @foreach (json_decode($document->document_content->hod_attachments) as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <input type="hidden"
                                                name="existing_hod_attachments[{{ $file }}]">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file"
                                                data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark"
                                                    style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                    @endforeach
                                @endif
                            </div>
                            <div class="add-btn">
                                <div class="{{ !Helpers::checkRoles(4) ? 'btn-disabled' : 'add-hod-attachment-btn' }} ">
                                    Add</div>
                                <input type="file" id="myfile" name="hod_attachments[]"
                                    class="add-hod-attachment-file" oninput="addMultipleFiles(this, 'hod_attachments')"
                                    multiple>
                            </div>
                        </div>

                    </div>

                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>

                </div>
                {{-- HOD REMARKS TAB END --}}

                <div id="annexures" class="tabcontent">


                    <div class="d-flex justify-content-end">
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#annexure-modal" type="button"
                                class="btn btn-primary">Annexure Print</button>
                        </div>
                    </div>

                    <div class="input-fields">
                        @if ($document->document_content && !empty($document->document_content->annexuredata))
                            @foreach (unserialize($document->document_content->annexuredata) as $data)
                                <div class="group-input mb-3">
                                    <label>Annexure A-{{ $loop->index + 1 }}</label>
                                    <textarea class="summernote" name="annexuredata[]">{{ $data }}</textarea>
                                </div>
                            @endforeach
                        @else
                            @for ($i = 1; $i <= 20; $i++)
                                <div class="group-input mb-3">
                                    <label for="annexure-{{ $i }}">Annexure A-{{ $i }}</label>
                                    <textarea class="summernote" name="annexuredata[]" id="annexure-{{ $i }}"></textarea>
                                </div>
                            @endfor
                        @endif
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                <div id="distribution-retrieval" class="tabcontent">
                    <div class="orig-head">
                        Distribution & Retrieval
                    </div>
                    {{-- <div class="col-md-12 input-fields">
                        <div class="group-input">

                            <label for="distribution" id="distribution">
                                Distribution & Retrieval<button type="button" id="distributionbtnadd" name="button">+</button>
                            </label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                            @if (!empty($document->document_content->distribution))
                                @foreach (unserialize($document->document_content->distribution) as $data)
                                    <input type="text" name="distribution[]" class="myclassname"
                                        value="{{ $data }}">
                                            @endforeach
                                            @else
                                            <input type="text" name="distribution[]" class="myclassname">
                                            @endif

                                            <div id="distributiondiv"></div>
                                            @foreach ($history as $tempHistory)
                                            @if ($tempHistory->activity_type == 'distribution' && !empty($tempHistory->comment))
                                            @php
                                            $users_name = DB::table('users')
                                            ->where('id', $tempHistory->user_id)
                                            ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field" style="background: #ffff0061;
                            color: black;" type="text" value="{{ $tempHistory->comment }}" disabled>
                                            @endif
                                            @endforeach




                                        </div>
                                        </div>

                                        @if (Auth::user()->role != 3 && $document->stage < 8) {{-- Add Comment
                        <div class="comment">
                            <div>
                                <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="distribution_comment">
                                            </div>
                                            <div class="button">Add Comment</div>
                                            </div>
                                            @endif --}}
                    <div class="input-fields">
                        <div class="group-input">
                            <label for="distriution_retrieval">
                                Distribution & Retrieval
                                <button type="button" name="agenda"
                                    onclick="addDistributionRetrieval1('distribution-retrieval-grid')">+</button>
                            </label>
                            <div class="table-responsive retrieve-table">
                                <table class="table table-bordered" id="distribution-retrieval-grid">
                                    <thead>
                                        <tr>
                                            <th>Row </th>
                                            <th class="copy-name">Document Title</th>
                                            <th class="copy-name">Document Number</th>
                                            <th class="copy-name">Document Printed By</th>
                                            <th class="copy-name">Document Printed on</th>
                                            <th class="copy-num">Number of Print Copies</th>
                                            <th class="copy-name">Issuance Date</th>
                                            <th class="copy-name">Issued To </th>
                                            <th class="copy-long">Department/Location</th>
                                            <th class="copy-num">Number of Issued Copies</th>
                                            <th class="copy-long">Reason for Issuance</th>
                                            <th class="copy-name">Retrieval Date</th>
                                            <th class="copy-name">Retrieved By</th>
                                            <th class="copy-name">Retrieved Person Department</th>
                                            <th class="copy-num">Number of Retrieved Copies</th>
                                            <th class="copy-long">Reason for Retrieval</th>
                                            <th class="copy-long">Remarks</th>
                                            <th class="copy-long">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($document_distribution_grid as $grid)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                    {{-- <input type="text" value="{{ $loop->index }}" name="distribution[{{ $loop->index }}][serial_number]"> --}}
                                                </td>
                                                <td><input type="text"
                                                    name="distribution[{{ $loop->index }}][document_title]"
                                                    value="{{ $document->document_name }}" readonly>
                                                </td>
                                                <td><input type="text"
                                                        name="distribution[{{ $loop->index }}][document_number]"
                                                        value="{{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($document->id, 4, '0', STR_PAD_LEFT) }}/R{{ $document->major }}" readonly>
                                                </td>
                                                <td><input type="text" value="{{ $grid->document_printed_by }}"
                                                        name="distribution[{{ $loop->index }}][document_printed_by]">
                                                </td>
                                                <td><input type="text" value="{{ $grid->document_printed_on }}"
                                                        name="distribution[{{ $loop->index }}][document_printed_on]">
                                                </td>
                                                <td><input type="text" value="{{ $grid->document_printed_copies }}"
                                                        name="distribution[{{ $loop->index }}][document_printed_copies]">
                                                </td>
                                                <td>
                                                    <div
                                                        class="group-input new-date-document_distribution_grid-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"
                                                                    id="issuance_date' + serialNumber +'" readonly
                                                                    placeholder="DD-MMM-YYYY"
                                                                    value="{{ $grid->issuance_date }}" />
                                                                <input type="date"
                                                                    name="distribution[{{ $loop->index }}][issuance_date]"
                                                                    class="hide-input"
                                                                    style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                    oninput="handleDateInput(this, `issuance_date' + serialNumber +'`)"
                                                                    value="{{ $grid->issuance_date }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[{{ $loop->index }}][issuance_to]">
                                                        <option value='0'
                                                            {{ $grid->issuance_to == '0' ? 'selected' : '' }}>-- Select --
                                                        </option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ $grid->issuance_to == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[{{ $loop->index }}][location]">
                                                        <option value="0" {{ $grid->location == '0' ? 'selected' : '' }}>-- Select --</option>
                                                        @foreach (Helpers::getDmsDepartments() as $code => $department)
                                                            <option value="{{ $code }}" {{ $grid->location == $code ? 'selected' : '' }}>
                                                                {{ $department }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text"
                                                        name="distribution[{{ $loop->index }}][issued_copies]"
                                                        value="{{ $grid->issued_copies }}">
                                                </td>
                                                <td><input type="text"
                                                        name="distribution[{{ $loop->index }}][issued_reason]"
                                                        value="{{ $grid->issued_reason }}">
                                                </td>
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"
                                                                    id="retrieval_date' + serialNumber +'" readonly
                                                                    placeholder="DD-MMM-YYYY"
                                                                    value="{{ $grid->retrieval_date }}" />
                                                                <input type="date"
                                                                    name="distribution[{{ $loop->index }}][retrieval_date]"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, `retrieval_date' + serialNumber +'`)"
                                                                    value="{{ $grid->retrieval_date }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[{{ $loop->index }}][retrieval_by]">
                                                        <option value=""
                                                            {{ $grid->retrieval_by == '' ? 'selected' : '' }}>Select a
                                                            value</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ $grid->retrieval_by == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    {{-- <select id="select-state" placeholder="Select..."
                                                        name="distribution[{{ $loop->index }}][retrieved_department]">
                                                        <option value='0'
                                                            {{ $grid->retrieved_department == '0' ? 'selected' : '' }}>--
                                                            Select --</option>
                                                        @foreach ($departments as $department)
                                                            <option value='{{ $department->id }}'
                                                                {{ $grid->retrieved_department == $department->id ? 'selected' : '' }}>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select> --}}

                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[{{ $loop->index }}][retrieved_department]">
                                                        <option value='0' {{ $grid->retrieved_department == '0' ? 'selected' : '' }}>--Select --</option>
                                                        @foreach (Helpers::getDmsDepartments() as $code => $department)
                                                            <option value="{{ $code }}" {{ $grid->retrieved_department == $code ? 'selected' : '' }}>
                                                                {{ $department }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number"
                                                        name="distribution[{{ $loop->index }}][retrieved_copies]"
                                                        value="{{ $grid->retrieved_copies }}">
                                                </td>
                                                <td><input type="text"
                                                        name="distribution[{{ $loop->index }}][retrieved_reason]"
                                                        value="{{ $grid->retrieved_reason }}">
                                                </td>
                                                <td><input type="text"
                                                        name="distribution[{{ $loop->index }}][remark]"
                                                        value="{{ $grid->remark }}">
                                                </td>
                                                <td>
                                                    <button class='removeTrainRow'>Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <script>
                        function addDistributionRetrieval1(tableId) {
                            let table = document.getElementById(tableId);
                            let currentRowCount = table.rows.length;
                            let newRow = table.insertRow(currentRowCount);
                            let departmentsData = @json(Helpers::getDmsDepartments());
                            let savedLocation = rowData.location || "0";
                            let savedRetrival = rowData.retrieved_department || "0";

                            newRow.setAttribute("id", "row" + currentRowCount);

                            let sopTypeShort = "{{ $document->sop_type_short }}";
                            let departmentId = "{{ $document->department_id }}";
                            let documentId = "{{ str_pad($document->id, 4, '0', STR_PAD_LEFT) }}";
                            let major = "{{ $document->major }}";

                            let cell1 = newRow.insertCell(0);
                            cell1.innerHTML = currentRowCount;

                            let cell2 = newRow.insertCell(1);
                            cell2.innerHTML =`<textarea style="overflow: hidden;
                            border: none; width: 10rem;" name="distribution[${currentRowCount}][document_title]" readonly>{{ $document->document_name }}</textarea>`;

                            let cell3 = newRow.insertCell(2);
                            cell3.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem; "type="text" name="distribution[${currentRowCount}][document_number]" readonly>
                            ${sopTypeShort}/${departmentId}/${documentId}/R${major}</textarea>`;

                            let cell4 = newRow.insertCell(3);
                            cell4.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_by]"></textarea>`;

                            let cell5 = newRow.insertCell(4);
                            cell5.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_on]"> </textarea>`;

                            let cell6 = newRow.insertCell(5);
                            cell6.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_copies]"> </textarea>`;

                            let cell7 = newRow.insertCell(6);
                            cell7.innerHTML = '<div class="group-input new-date-data-field mb-0"> <div class="input-date "><div class="calenderauditee"><input style="width: 6rem;" type="text" id="issuance_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input style="width:4rem" type="date" name="distribution['+ currentRowCount +'][issuance_date]" class="hide-input" oninput="handleDateInput(this, `issuance_date' + currentRowCount +'`)" /></div></div></div>';

                            let cell8 = newRow.insertCell(7)
                            cell8.innerHTML = `<select style="
                            width: 6rem;" id="select-state" placeholder="Select..."
                                name="distribution[${currentRowCount}][issuance_to]">
                                <option value='0'>-- Select --</option>
                                ${users.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
                            </select>`


                            let cell9 = newRow.insertCell(8);
                            cell9.innerHTML = `
                                <select style="width: 6rem;" id="select-state" placeholder="Select..."
                                    name="distribution[${currentRowCount}][location]">
                                    <option value="0" ${savedLocation === "0" ? "selected" : ""}>-- Select --</option>
                                    ${Object.entries(departmentsData).map(([code, name]) =>
                                        `<option value="${code}" ${savedLocation === code ? "selected" : ""}>${name}</option>`
                                    ).join('')}
                                </select>
                            `;

                            let cell10 = newRow.insertCell(9);
                            cell10.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][issued_copies]"></textarea>`;

                            let cell11 = newRow.insertCell(10);
                            cell11.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][issued_reason]"></textarea>`;

                            let cell12 = newRow.insertCell(11);
                            cell12.innerHTML = '<div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input style=" width: 6rem;" type="text" id="retrieval_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input style=" width: 4rem;" type="date" name="distribution['+currentRowCount+'][retrieval_date]" class="hide-input" oninput="handleDateInput(this, `retrieval_date' + currentRowCount +'`)" /></div></div></div>';

                            let cell13 = newRow.insertCell(12)
                            cell13.innerHTML = `<select style="
                            width: 6rem;" id="select-state" placeholder="Select..."
                                name="distribution[${currentRowCount}][retrieval_by]">
                                <option value='0'>-- Select --</option>
                                ${users.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
                            </select>`

                            let cell14 = newRow.insertCell(13)
                            // cell14.innerHTML = `<select style="
                            // width: 6rem;" id="select-state" placeholder="Select..."
                            //     name="distribution[${currentRowCount}][retrieved_department]">
                            //     <option value='0'>-- Select --</option>
                            //     ${departments.map(department => `<option value="${department.id}">${department.name}</option>`).join(' ')}
                            // </select>`;
                            let cell14 = newRow.insertCell(13)
                            cell14.innerHTML = `
                                <select style="width: 6rem;" id="select-state" placeholder="Select..."
                                    name="distribution[${currentRowCount}][retrieved_department]">
                                    <option value="0" ${savedRetrival === "0" ? "selected" : ""}>-- Select --</option>
                                    ${Object.entries(departmentsData).map(([code, name]) =>
                                        `<option value="${code}" ${savedRetrival === code ? "selected" : ""}>${name}</option>`
                                    ).join('')}
                                </select>
                            `;

                            let cell15 = newRow.insertCell(14);
                            cell15.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][retrieved_copies]"></textarea>`;

                            let cell16 = newRow.insertCell(15);
                            cell16.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][retrieved_reason]"></textarea>`;

                            let cell17 = newRow.insertCell(16);
                            cell17.innerHTML = `<textarea style="overflow: hidden;
                            border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][remark]"></textarea>`;

                            var cell18 = newRow.insertCell(17);
                            cell18.innerHTML = "<button class='removeTrainRow'>Remove</button>";

                            cell18.appendChild(element18);

                            for (let i = 1; i < currentRowCount; i++) {
                                let row = table.rows[i];
                                row.cells[0].innerHTML = i;
                            }
                        }
                    </script>

                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                {{-- <div id="print-download" class="tabcontent">
                    <div class="orig-head">
                        Print Permissions
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="person-print">Person Print Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Person</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                Amit Patel
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                432
                                            </td>
                                            <td class="permission">
                                                123
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="group-print">Group Print Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Groupd</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                QA
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="orig-head">
                        Download Permissions
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="person-print">Person Download Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Groups</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                QA
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="group-print">Group Download Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Person</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                Amit Patel
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div> --}}

                <div id="sign" class="tabcontent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Originated By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Review')
                                        ->get();

                                @endphp
                                <div class="name">{{ $document->originator ? $document->originator->name : 'null' }}
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Originated On
                                </div>
                                <div class="name">{{ $document->created_at }}</div>
                            </div>

                        </div>

                        {{-- <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Originated On
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Approval')
                                        ->where('deleted_at', null)
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}
                                                </div>

                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-names">
                                                    <div class="orig-head">
                                                        Document Reuqest Approved On
                                                    </div>
                                                    <div class="name">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Document Writing Completed By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Approval')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>

                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-names">
                                                    <div class="orig-head">
                                                        Document Writing Completed On
                                                    </div>
                                                    <div class="name">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    HOD Review By
                                </div>
                                @php
                                    $inhodreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'HOD Review-Submit')
                                        ->where('deleted_at', null)
                                        ->get();

                                @endphp
                                @foreach ($inhodreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    HOD Reviewed On
                                </div>
                                @foreach ($inhodreview as $temp)
                                    <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Reviewd By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'Review-Submit')
                                        ->where('deleted_at', null)
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Reviewed On
                                </div>
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Approved By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'Approval-Submit')
                                        ->where('deleted_at', null)
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Approved On
                                </div>
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Training Completed By
                                </div>
                                <div class="name">Amit Patel</div>
                                <div class="name">Amit Patel</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Training Completed On
                                </div>
                                <div class="name">29-12-2023 11:12PM</div>
                                <div class="name">29-12-2023 11:12PM</div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>

                @if ($document->stage < 8) {{-- <div class="form-btn-bar">
                        <div class="container-fluid header-bottom bottom-pr-links">
                            <div class="container">
                                <div class="bottom-links">
                                    <div>
                                        <button type="submit" name="submit" value="save">Save</button>
                                    </div>
                                    <div>
                                        <a href="{{ route('documents.index') }}"> <button type="submit">Cancel</button></a>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div> --}}
                @endif

            </form>
        </div>
    </div>


    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-file');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fileName = this.getAttribute('data-file-name');
                    const fileContainer = this.closest('.file-container');

                    // Hide the file container
                    if (fileContainer) {
                        fileContainer.remove()
                    }
                });
            });
        });
    </script>

    <div class="modal fade" id="annexure-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Annexure Print</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('printPDFAnx', $document->id) }}" method="GET" target="_blank">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        @for ($i = 1; $i <= 20; $i++)
                            <a href='{{ route('document.print.annexure', ['document' => $document->id, 'annexure' => $i]) }}'
                                target="_blank">Print Annexure A-{{ $i }}</a> <br>
                        @endfor
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var editor = new FroalaEditor('.summernote', {
            key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
            imageUploadParam: 'image_param',
            imageUploadMethod: 'POST',
            imageMaxSize: 20 * 1024 * 1024,
            imageUploadURL: "{{ route('api.upload.file') }}",
            fileUploadParam: 'image_param',
            fileUploadURL: "{{ route('api.upload.file') }}",
            videoUploadParam: 'image_param',
            videoUploadURL: "{{ route('api.upload.file') }}",
            videoMaxSize: 500 * 1024 * 1024,
        });


        $(".summernote-disabled").FroalaEditor("edit.off");
    </script>
    <script>
        VirtualSelect.init({
            ele: '#reference_record,#parent_child, #notify_to'
        });

        // $('#summernote').summernote({
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear', 'italic']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video']],
        //         ['view', ['fullscreen', 'codeview', 'help']]
        //     ]
        // });

        // $('.summernote').summernote({
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear', 'italic']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video']],
        //         ['view', ['fullscreen', 'codeview', 'help']]
        //     ]
        // });
    </script>

    <script>
        $(document).ready(function() {
            $('#addButton').click(function() {
                var sourceValue = $('#sourceField').val()
                    .trim(); // Get the trimmed value from the source field
                if (!sourceValue) return; // Prevent adding empty values

                // Create a new list item with the source value and a close icon
                var newItem = $('<li>', {
                    class: 'd-flex justify-content-between align-items-center'
                }).text(sourceValue);
                var closeButton = $('<span>', {
                    text: '×',
                    class: 'close-icon ms-2' // Bootstrap class for margin-left spacing
                }).appendTo(newItem);

                // Append the new list item to the display field
                $('#displayField').append(newItem);

                // Create a corresponding option in the hidden select
                var newOption = $('<option>', {
                    value: sourceValue,
                    text: sourceValue,
                    selected: 'selected'
                }).appendTo('#keywords');

                // Clear the input field
                $('#sourceField').val('');

                // Add click event for the close icon
                closeButton.on('click', function() {
                    var thisValue = $(this).parent().text().slice(0, -
                        1); // Remove the '×' from the value
                    $(this).parent().remove(); // Remove the parent list item on click
                    $('#keywords option').filter(function() {
                        return $(this).val() === thisValue;
                    }).remove(); // Also remove the corresponding option from the select
                });
            });

            $(document).on('click', '.close-icon', function() {
                var thisValue = $(this).parent().text().trim().slice(0, -1)
                    .trim(); // Remove the '×' from the value
                $(this).closest('li').remove();
                $('#keywords option').filter(function() {
                    return $(this).text().trim() === thisValue;
                }).remove()
            })
        });
    </script>

    <script>
        function openData(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";

            // Find the index of the clicked tab button
            const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

            // Update the currentStep to the index of the clicked tab
            currentStep = index;
        }

        $('.add-hod-attachment-btn').click(function() {
            $('.add-hod-attachment-file').trigger('click');
        });

        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".tablinks");
        const steps = document.querySelectorAll(".tabcontent");
        let currentStep = 0;

        function nextStep() {
            // Check if there is a next step
            if (currentStep < steps.length - 1) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show next step
                steps[currentStep + 1].style.display = "block";

                // Add active class to next button
                stepButtons[currentStep + 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep++;
            }
        }

        function previousStep() {
            // Check if there is a previous step
            if (currentStep > 0) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show previous step
                steps[currentStep - 1].style.display = "block";

                // Add active class to previous button
                stepButtons[currentStep - 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep--;
            }
        }
    </script>
@endsection
