@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>
    @php
        $users = DB::table('users')->select('id', 'name')->get();
    @endphp
    <script>
        $(document).ready(function() {
            $('#audit_program').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' + '<td><input disabled type="text" name="serial_number[]" value="' +
                        serialNumber + '"></td>' + '<td><select name="Auditees[]">' +
                        '<option value="">Select a value</option>';
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    html += '</select></td>' +
                        // '<td><input type="date" name="start_date[]"></td>'
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" id="start_date' + serialNumber +'"    name="start_date[]" class="hide-input" oninput="handleDateInput(this, `start_date' + serialNumber +'`)" /></div></div></div></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="start_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="start_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="start_date' +
                        serialNumber +
                        '_checkdate"  class="hide-input" oninput="handleDateInput(this, `start_date' +
                    serialNumber + '`);checkDate(`start_date' + serialNumber + '_checkdate`,`end_date' +
                    serialNumber + '_checkdate`)" /></div></div></div></td>' +
                        // '<td><input type="date" name="end_date[]"></td>' 
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="end_date' + serialNumber +'_checkdate" readonly placeholder="DD-MMM-YYYY" /><input type="date" id="end_date' + serialNumber +'"  name="end_date[]" class="hide-input" oninput="handleDateInput(this, `end_date' + serialNumber +'`)" /></div></div></div></td>'
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="end_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="end_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="end_date' +
                        serialNumber +
                        '_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' +
                    serialNumber + '`);checkDate(`start_date' + serialNumber + '_checkdate`,`end_date' +
                    serialNumber + '_checkdate`)" /></div></div></div></td>' +
                        '<td><select name="lead_investigator[]">' +
                        '<option value="">Select a value</option>';
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    html += '</select></td>' +
                        '<td><input type="text" id="comment" name="comment[]"></td>' +
                        '<td><button type="text" class="removeBtncd">remove</button></td>' +
                        '</tr>';
                    return html;
                }
                var tableBody = $('#audit_program_body tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let country_arr = new Array("-- Select --", "AUSTRALIA", "INDIA", "NEW ZEALAND", "USA", "UAE",
                "MAURITIUS");
            $.each(country_arr, function(i, item) {
                $('#country').append($('<option>', {
                    value: i,
                    text: item,
                }, '</option>'));
            });
            let s_a = new Array();
            s_a[0] = "-- Select --";
            s_a[1] = "-- Select --|QUEENSLAND|VICTORIA";
            s_a[2] =
                "-- Select --|ANDHRAPRADESH|KARNATAKA|TAMILNADU|DELHI|GOA|WEST-BENGAL|GUJARAT|MADHYAPRADESH|MAHARASHTRA|RAJASTHAN";
            s_a[3] = "-- Select --|AUCKLAND";
            s_a[4] = "-- Select --|NEWJERSEY|ILLINOIS";
            s_a[5] = "-- Select --|DUBAI";
            s_a[6] = "-- Select --|MAURITIUS";
            let c_a = new Array();
            c_a['QUEENSLAND'] = "-- Select --|BRISBANE";
            c_a['VICTORIA'] = "-- Select --|MELBOURNE";
            c_a['ANDHRAPRADESH'] = "-- Select --|HYDERABAD";
            c_a['KARNATAKA'] = "-- Select --|BANGLORE";
            c_a['TAMILNADU'] = "-- Select --|CHENNAI";
            c_a['DELHI'] = "-- Select --|DELHI";
            c_a['GOA'] = "-- Select --|GOA";
            c_a['W-BENGAL'] = "-- Select --|KOLKATA";
            c_a['GUJARAT'] =
                "-- Select --|AHMEDABAD1|AHMEDABAD2|AHMEDABAD3|BARODA|BHAVNAGAR|MEHSANA|RAJKOT|SURAT|UNA";
            c_a['MADHYAPRADESH'] = "-- Select --|INDORE";
            c_a['MAHARASHTRA'] = "-- Select --|MUMBAI|PUNE";
            c_a['RAJASTHAN'] = "-- Select --|ABU";
            c_a['AUCKLAND'] = "-- Select --|AUCKLAND";
            c_a['NEWJERSEY'] = "-- Select --|EDISON";
            c_a['ILLINOIS'] = "-- Select --|CHICAGO";
            c_a['MAURITIUS'] = "-- Select --|MAURITIUS";
            c_a['DUBAI'] = "-- Select --|DUBAI";
            $('#country').change(function() {
                let c = $(this).val();
                let state_arr = s_a[c].split("|");
                $('#state').empty();
                $('#city').empty();
                if (c == 0) {
                    $('#state').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                } else {
                    $.each(state_arr, function(i, item_state) {
                        $('#state').append($('<option>', {
                            value: item_state,
                            text: item_state,
                        }, '</option>'));
                    });
                }
                $('#city').append($('<option>', {
                    value: '0',
                    text: '-- Select --',
                }, '</option>'));
            });
            $('#state').change(function() {
                let s = $(this).val();
                if (s == '-- Select --') {
                    $('#city').empty();
                    $('#city').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                }
                let city_arr = c_a[s].split("|");
                $('#city').empty();
                $.each(city_arr, function(j, item_city) {
                    $('#city').append($('<option>', {
                        value: item_city,
                        text: item_city,
                    }, '</option>'));
                });
            });
        });
    </script>
    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>
    <div class="form-field-head">
        <div class="pr-id">
        </div>
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Audit Program
        </div>
    </div>
    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">
            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Audit Program</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Self Inspection Circular</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Signatures</button>
            </div>
            <form action="{{ route('createAuditProgram') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">General Information</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/AP/{{ date('Y') }}/{{ $record_number }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">

                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Due</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        {{-- <input type="date"
                                            value="" name="due_date"> --}}
                                {{-- <div class="calenderauditee">
                                    <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="due_date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'due_date')" />
                                </div>
                            </div>
                        </div> --}}
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date </label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small></div>
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY"
                                            value="{{ \Carbon\Carbon::parse($due_date)->format('d-M-Y') }}" />
                                        <input type="hidden" name="due_date" id="due_date_input"
                                            value="{{ $due_date }}" />

                                        {{-- <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <input disabled type="text" value="{{ Helpers::getdateFormat($due_date) }}"> --}}
                                        {{-- <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="" name="due_date"> --}}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Department</b></label>
                                        <select name="Initiator_Group" id="Initiator_Group">
                                            <option value="" data-code="">-- Select --</option>
                                            <option value="Corporate Quality Assurance" data-code="CQA"
                                                @if (old('Initiator_Group') == 'Corporate Quality Assurance') selected @endif>Corporate Quality
                                                Assurance</option>
                                            <option value="Quality Assurance Biopharma" data-code="QAB"
                                                @if (old('Initiator_Group') == 'Quality Assurance Biopharma') selected @endif>Quality Assurance
                                                Biopharma</option>
                                            <option value="Central Quality Control" data-code="CQC"
                                                @if (old('Initiator_Group') == 'Central Quality Control') selected @endif>Central Quality Control
                                            </option>
                                            <option value="Manufacturing" data-code="MANU"
                                                @if (old('Initiator_Group') == 'Manufacturing') selected @endif>Manufacturing</option>
                                            <option value="Plasma Sourcing Group" data-code="PSG"
                                                @if (old('Initiator_Group') == 'Plasma Sourcing Group') selected @endif>Plasma Sourcing Group
                                            </option>
                                            <option value="Central Stores" data-code="CS"
                                                @if (old('Initiator_Group') == 'Central Stores') selected @endif>Central Stores</option>
                                            <option value="Information Technology Group" data-code="ITG"
                                                @if (old('Initiator_Group') == 'Information Technology Group') selected @endif>Information Technology
                                                Group</option>
                                            <option value="Molecular Medicine" data-code="MM"
                                                @if (old('Initiator_Group') == 'Molecular Medicine') selected @endif>Molecular Medicine
                                            </option>
                                            <option value="Central Laboratory" data-code="CL"
                                                @if (old('Initiator_Group') == 'Central Laboratory') selected @endif>Central Laboratory
                                            </option>
                                            <option value="Tech team" data-code="TT"
                                                @if (old('Initiator_Group') == 'Tech team') selected @endif>Tech team</option>
                                            <option value="Quality Assurance" data-code="QA"
                                                @if (old('Initiator_Group') == 'Quality Assurance') selected @endif>Quality Assurance
                                            </option>
                                            <option value="Quality Management" data-code="QM"
                                                @if (old('Initiator_Group') == 'Quality Management') selected @endif>Quality Management
                                            </option>
                                            <option value="IT Administration" data-code="IA"
                                                @if (old('Initiator_Group') == 'IT Administration') selected @endif>IT Administration
                                            </option>
                                            <option value="Accounting" data-code="ACC"
                                                @if (old('Initiator_Group') == 'Accounting') selected @endif>Accounting</option>
                                            <option value="Logistics" data-code="LOG"
                                                @if (old('Initiator_Group') == 'Logistics') selected @endif>Logistics</option>
                                            <option value="Senior Management" data-code="SM"
                                                @if (old('Initiator_Group') == 'Senior Management') selected @endif>Senior Management
                                            </option>
                                            <option value="Business Administration" data-code="BA"
                                                @if (old('Initiator_Group') == 'Business Administration') selected @endif>Business Administration
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator_group_code">Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="{{ old('initiator_group_code') }}" readonly>
                                    </div>
                                </div>



                                <script>
                                    document.getElementById('Initiator_Group').addEventListener('change', function() {
                                        var selectedOption = this.options[this.selectedIndex];
                                        var selectedCode = selectedOption.getAttribute('data-code');
                                        document.getElementById('initiator_group_code').value = selectedCode;
                                    });
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var initiatorGroupElement = document.getElementById('Initiator_Group');
                                        if (initiatorGroupElement.value) {
                                            var selectedOption = initiatorGroupElement.options[initiatorGroupElement.selectedIndex];
                                            var selectedCode = selectedOption.getAttribute('data-code');
                                            document.getElementById('initiator_group_code').value = selectedCode;
                                        }
                                    });
                                </script>
                                <!-- <div class="col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label for="Short Description"><b>Short Description <span
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                class="text-danger">*</span></b></label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <textarea name="short_description"></textarea>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>                                                                                                                                                                                                                                                                                                                    </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness,
                                            guiding priority for corrective actions. Ranging from low to high, they ensure
                                            quality standards and mitigate critical risks.</span>
                                        <select name="severity1_level">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req" style="display: none;">
                                        <label for="initiated_through">Others<span class="text-danger">*</span></label>
                                        <textarea name="initiated_through_req" id="initiated_through_req_textarea"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Type</label>
                                        <select name="type" id="type">
                                            <option value="">-- Select --</option>
                                            <option value="other">Other</option>
                                            <option value="annual">Annual</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="through_req" style="display: none;">
                                        <label for="type">Type(Others)<span class="text-danger">*</span></label>
                                        <textarea name="through_req" id="through_req_textarea"></textarea>
                                    </div>
                                </div>

                                <script>
                                    function otherController(value, triggerValue, targetId) {
                                        var targetElement = document.getElementById(targetId);
                                        var textarea = targetElement.querySelector('textarea');
                                        if (value === triggerValue) {
                                            targetElement.style.display = 'block';
                                            textarea.setAttribute('required', 'required');
                                        } else {
                                            targetElement.style.display = 'none';
                                            textarea.removeAttribute('required');
                                        }
                                    }

                                    $(document).ready(function() {
                                        $('#type').change(function() {
                                            if ($(this).val() === 'other') {
                                                $('#through_req').show();
                                                $('#through_req_textarea').prop('required', true);
                                            } else {
                                                $('#through_req').hide();
                                                $('#through_req_textarea').prop('required', false);
                                            }
                                        });
                                    });
                                </script>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Year">Year</label>
                                        <select name="year">
                                            <option value="">-- Select --</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                            <option value="2037">2037</option>
                                            <option value="2038">2038</option>
                                            <option value="2039">2039</option>
                                            <option value="2040">2040</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Months">Months</label>
                                        <select name="Months">
                                            <option value="">-- Select --</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quarter">Quarter</label>
                                        <select name="Quarter">
                                            <option value="">-- Select --</option>
                                            <option value="Q1">Q1</option>
                                            <option value="Q2">Q2</option>
                                            <option value="Q3">Q3</option>
                                            <option value="Q4">Q4</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="audit-program-grid">
                                            Audit Program<button type="button" name="ann"
                                                id="audit_program">+</button>
                                        </label>
                                        <table class="table table-bordered" id="audit_program_body">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row #</th>
                                                    <th>Auditees</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                    <th>Lead Investigator</th>
                                                    <th>Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1">
                                                    </td>
                                                    <td> <select id="select-state" placeholder="Select..."
                                                            name="Auditees[]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>

                                                    <td>
                                                        <div class="group-input new-date-data-field mb-0">
                                                            <div class="input-date ">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="start_date" readonly
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" id="start_date_checkdate"
                                                                        name="start_date[]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        class="hide-input"
                                                                        oninput="handleDateInput(this, 'start_date');checkDate('c','end_date_checkdate')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="group-input new-date-data-field mb-0">
                                                            <div class="input-date ">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="end_date" readonly
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" id="end_date_checkdate"
                                                                        name="end_date[]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        class="hide-input"
                                                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> <select id="select-state" placeholder="Select..."
                                                            name="lead_investigator[]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>

                                                    <td><input type="text" id="comment" name="comment[]">
                                                    </td>
                                                    <td> <button type="button" class="removeBtncd">remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Audit program
                                        <button type="button" name="audit-agenda-grid" id="audit_program">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="audit_program-field-instruction-modal">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row#</th>
                                                    <th style="width: 12%">Auditees</th>
                                                    <th style="width: 15%">Date Start</th>
                                                    <th style="width: 15%"> Date End</th>
                                                    <th style="width: 15%"> Lead Investigator</th>
                                                    <th style="width: 15%">Comment</th>
                                                    <th style="width: 5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td>
                                                        <div class="group-input">
                                                            <select name="audit_program[0][Auditees]">
                                                                <option value="">Select a value</option>
                                                                @if ($users->isNotEmpty())
                                                                    @foreach ($users as $value)
                                                                        <option value='{{ $value->name }}'>
                                                                            {{ $value->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input class="click_date" id="Due_Date_0"
                                                                        type="text" name="audit_program[0][Due_Date]"
                                                                        placeholder="DD-MMM-YYYY" readonly />
                                                                    <input type="date"
                                                                        name="audit_program[0][Due_Date]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        class="hide-input" id="Due_Date_0_input"
                                                                        class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        onchange="handleDateInput(this, 'Due_Date_0'); checkDate('Due_Date_0_input', 'End_date_0_input')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input class="click_date" id="End_date_0"
                                                                        type="text" name="audit_program[0][End_date]"
                                                                        placeholder="DD-MMM-YYYY" readonly />
                                                                    <input type="date"
                                                                        name="audit_program[0][End_date]" min=""
                                                                        id="End_date_0_input" class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        onchange="handleDateInput(this, 'End_date_0'); checkDate('Due_Date_0_input', 'End_date_0_input')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="group-input">
                                                            <select name="audit_program[0][Lead_Investigator]">
                                                                <option value="">Select a value</option>
                                                                @if ($users->isNotEmpty())
                                                                    @foreach ($users as $value)
                                                                        <option value='{{ $value->name }}'>
                                                                            {{ $value->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="audit_program[0][Comment]"></td>
                                                    <td><button type="button" class="removeBtnaid">remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Self Inspection Planner
                                        <button type="button" name="audit-agenda-grid" id="Self_Inspection">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Self_Inspection-field-instruction-modal">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%">Row#</th>
                                                    <th style="width: 15%">Department</th>
                                                    <th style="width: 15%">Months</th>
                                                    <th style="width: 16%">Remarks</th>
                                                    <th style="width: 3%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial[]" value="1">
                                                </td>
                                                <td>

                                                    <select name="Self_Inspection[0][department]" id="department"
                                                        {{ isset($data->stage) && ($data->stage == 0 || $data->stage == 8) ? 'disabled' : '' }}>
                                                        <option selected disabled value="">---select---
                                                        </option>
                                                        @foreach (Helpers::getDepartments() as $department)
                                                            <option value="{{ $department }}"
                                                                @if (isset($data->department) && $data->department == $department) selected @endif>
                                                                {{ $department }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="Months" multiple placeholder="Select..."
                                                        data-search="false" data-silent-initial-value-set="true"
                                                        name="Self_Inspection[0][Months]">
                                                        {{-- <option value="">Select a months</option> --}}
                                                        <option value="Jan">January</option>
                                                        <option value="Feb">February</option>
                                                        <option value="March">March
                                                        </option>
                                                        <option value="April">April
                                                        </option>
                                                        <option value="May">May
                                                        </option>
                                                        <option value="June">June
                                                        </option>
                                                        <option value="July">July
                                                        </option>
                                                        <option value="Aug">August
                                                        </option>
                                                        <option value="Sept">September
                                                        </option>
                                                        <option value="Oct">October
                                                        </option>
                                                        <option value="Nov">November
                                                        </option>
                                                        <option value="Dec">December
                                                        </option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="Self_Inspection[0][Remarked]">
                                                </td>
                                                <td>
                                                    <button type="button" class="removeBtn">remove</button>
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="attachments">Attached Files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" name="attachments[]" multiple /> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attachments[]"
                                                    oninput="addMultipleFiles(this, 'attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_url">Related URL</label>
                                        <input name="related_url">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="related_url">URl's description</label>
                                        <input type="text" name="url_description" id="url_description" />
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="suggested_audit">Suggested Audits</label>
                                        <input type="text" name="suggested_audits" />
                                    </div>
                                </div> --}}
                                <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is
                                                crossed</small></div>
                                        <textarea name="due_date_extension"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Self Inspection Circular
                                    </div>
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            Self Inspection Circular
                                            <button type="button" name="audit-agenda-grid"
                                                id="Self_Inspection_circular">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered"
                                                id="Self_Inspection_circular-field-instruction-modal">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%">Row#</th>
                                                        <th style="width: 15%">Department</th>
                                                        <th style="width: 15%">Audit Date</th>
                                                        <th style="width: 16%">Name of Auditors</th>
                                                        <th style="width: 3%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td>
                                                        {{-- <select id="" placeholder="Select..."
                                                        name="Self_Inspection_circular[0][departments]">
                                                        <option value="">Select a department</option>
                                                        <option value="Corporate Quality Assurance">Corporate Quality
                                                            Assurance
                                                        </option>
                                                        <option value="Quality Assurance">Quality Assurance</option>
                                                        <option value="Quality Control">Quality Control
                                                        </option>
                                                        <option value="Quality Control (Microbiology department)'">Quality
                                                            Control (Microbiology department)'
                                                        </option>
                                                        <option value="Production General">Production General
                                                        </option>
                                                        <option value="Production Liquid Orals">Production Liquid Orals
                                                        </option>
                                                        <option value="Production Tablet and Powder">
                                                            Production Tablet and Powder
                                                        </option>
                                                        <option
                                                            value="Production External (Ointment, Gels, Creams and Liquid)">
                                                            Production External (Ointment, Gels, Creams and Liquid)
                                                        </option>
                                                        <option value="Quality Assurance">Quality Assurance
                                                        </option>
                                                        <option value="Analytical Development Laboratory">Analytical
                                                            Development Laboratory
                                                        </option>
                                                        <option value="Process Development Laboratory / Kilo lab">Process
                                                            Development Laboratory / Kilo lab
                                                        </option>
                                                        <option value="Production Capsules">Production Capsules
                                                        </option>
                                                        <option value="Production Injectable">Production Injectable
                                                        </option>
                                                        <option value="Engineering">Engineering
                                                        </option>
                                                        <option value="Human Resource">Human Resource
                                                        </option>
                                                        <option value="Store">Store
                                                        </option>
                                                        <option value="Electronic Data Processing">Electronic Data
                                                            Processing
                                                        </option>
                                                        <option value="Formulation Development">Formulation Development
                                                        </option>
                                                        <option value="Analytical research and Development Laboratory">
                                                            Analytical research and Development Laboratory
                                                        </option>
                                                        <option value="Packaging Development">Packaging Development
                                                        </option>
                                                        <option value="Purchase Department">Purchase Department
                                                        </option>
                                                        <option value="Document Cell">Document Cell
                                                        </option>
                                                        <option value="Regulatory Affairs">Regulatory Affairs
                                                        </option>
                                                        <option value="Pharmacovigilance">Pharmacovigilance
                                                        </option>
                                                    </select> --}}
                                                        <select name="Self_Inspection_circular[0][departments]"
                                                            id="departments"
                                                            {{ isset($data->stage) && ($data->stage == 0 || $data->stage == 8) ? 'disabled' : '' }}>
                                                            <option selected disabled value="">---select---
                                                            </option>
                                                            @foreach (Helpers::getDepartments() as $departments)
                                                                <option value="{{ $departments }}"
                                                                    @if (isset($data->departments) && $data->departments == $departments) selected @endif>
                                                                    {{ $departments }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input class="click_date" id="date_0_mfg_date"
                                                                        type="text"
                                                                        name="Self_Inspection_circular[0][info_mfg_date]"
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date"
                                                                        name="Self_Inspection_circular[0][info_mfg_date]"
                                                                        min="" id="date_0_mfg_date"
                                                                        class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        oninput="handleDateInput(this, 'date_0_mfg_date')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="Self_Inspection_circular[0][Auditor]">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="removeBtns">remove</button>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="comment">Comments</label>
                                            <textarea name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">File Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Attached_File"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="Attached_File[]"
                                                        oninput="addMultipleFiles(this, 'Attached_File')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                        <div id="CCForm3" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted_By..">Submitted By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted_On">Submitted On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted_By..">Submitted Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Approved_By">Approved By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Approved_On">Approved On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Approved_On">Approved Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit_Completed_By">Audit Completed By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit_Completed_On">Audit Completed On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit_Completed_On">Audit Completed Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Rejected_By">Rejected By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Rejected_On">Rejected On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Rejected_On">Rejected Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled_By">Cancelled By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled_On">Cancelled On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled_On">Cancelled Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    {{-- <button type="submit" class="saveButton">Save</button> --}}
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    {{-- <button type="submit">Submit</button> --}}
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            document.getElementById('related_url').addEventListener('change', function() {
                var typeOfAuditReqInput = document.getElementById('url_description');
                if (typeOfAuditReqInput) {
                    var selectedValue = this.value;
                    if (selectedValue = !'') {
                        typeOfAuditReqInput.setAttribute('required', 'required');
                    }
                } else {
                    console.error("Element with id 'url_description' not found");
                }
            });
        });
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Months, #team_members, #training-require, #impacted_objects'
        });
    </script>


    {{-- <Script>
        function addAuditProgram(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML =
                '<select name="auditees[]"><option value="">-- Select --</option>@foreach ($users as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select>'
            var cell3 = newRow.insertCell(2);
            // cell3.innerHTML = "<input type='date' name='date_start[]'>";
            cell3.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="start_date' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="start_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="start_date' +
                currentRowCount + '_checkdate"  class="hide-input" oninput="handleDateInput(this, `start_date' +
            currentRowCount + '`);checkDate(`start_date' + currentRowCount + '_checkdate`,`end_date' + currentRowCount +
            '_checkdate`)" /></div></div></div></td>';
            var cell4 = newRow.insertCell(3);
            // cell4.innerHTML = "<input type='date' name='date_end[]'>";
            cell4.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="end_date' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="end_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date' +
                currentRowCount + '_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' +
            currentRowCount + '`);checkDate(`start_date' + currentRowCount + '_checkdate`,`end_date' + currentRowCount +
            '_checkdate`)" /></div></div></div></td>';
            var cell5 = newRow.insertCell(4);
            // cell5.innerHTML = "<input type='text' name='lead_investigator'>";
            cell5.innerHTML =
                '<select name="lead_investigator[]"><option value="">-- Select --</option>@foreach ($users as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select>'
            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='text' name='comment[]'>";
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            var table = document.getElementById("tableId");
            var currentRowCount = table.rows.length;
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
    </Script> --}}
    <script>
        $(document).ready(function() {
            $('#audit_program').click(function(e) {
                e.preventDefault();

                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><div class="group-input"><select name="audit_program[' + serialNumber +
                        '][Auditees]"><option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                        '<td><div class="new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input class="click_date" id="Due_Date_' + serialNumber +
                        '" type="text" name="audit_program[' + serialNumber +
                        '][Due_Date]" placeholder="DD-MMM-YYYY" readonly />' +
                        '<input type="date" name="audit_program[' + serialNumber +
                        '][Due_Date]" id="Due_Date_' + serialNumber +
                        '_input"min="' + new Date().toISOString().split('T')[0] +
                        '"  class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'Due_Date_' +
                        serialNumber + '\'); checkDate(\'Due_Date_' + serialNumber +
                        '_input\', \'End_date_' +
                        serialNumber + '_input\')" />' +
                        '</div>' +
                        '</div>' +
                        '</div></td>' +
                        '<td><div class="new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input class="click_date" id="End_date_' + serialNumber +
                        '" type="text" name="audit_program[' + serialNumber +
                        '][End_date]" placeholder="DD-MMM-YYYY" readonly />' +
                        '<input type="date" name="audit_program[' + serialNumber +
                        '][End_date]" id="End_date_' + serialNumber +
                        '_input" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'End_date_' +
                        serialNumber + '\'); checkDate(\'Due_Date_' + serialNumber +
                        '_input\', \'End_date_' +
                        serialNumber + '_input\')" />' +
                        '</div>' +
                        '</div>' +
                        '</div></td>' +
                        '<td><div class="group-input"><select name="audit_program[' + serialNumber +
                        '][Lead_Investigator]"><option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                        '<td><input type="text" name="audit_program[' + serialNumber + '][Comment]"></td>' +
                        '<td><button type="button" class="removeBtnaid">remove</button></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#audit_program-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                // Reattach date picker event listeners for newly added rows
                reattachDatePickers();
            });

            // Attach date picker event listeners for the initial row
            reattachDatePickers();

            function reattachDatePickers() {
                $('.click_date').off('click').on('click', function() {
                    $(this).siblings('.show_date').click();
                });
            }

            window.handleDateInput = function(input, displayId) {
                var dateValue = input.value;
                var displayInput = document.getElementById(displayId);
                if (displayInput) {
                    displayInput.value = new Date(dateValue).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }).replace(/ /g, '-');
                }
            };

            window.checkDate = function(startDateId, endDateId) {
                var startDateInput = document.getElementById(startDateId);
                var endDateInput = document.getElementById(endDateId);

                if (startDateInput && endDateInput) {
                    var startDate = new Date(startDateInput.value);
                    if (startDate) {
                        endDateInput.min = startDate.toISOString().split('T')[0];
                    }
                }
            };

            // Initialize the date constraints for existing rows
            $('input[id^="Due_Date_"]').each(function() {
                var startDateId = $(this).attr('id') + '_input';
                var endDateId = $(this).attr('id').replace('Due_Date_', 'End_date_') + '_input';
                checkDate(startDateId, endDateId);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to generate a new row in the Self Inspection Planner table
            function generateTableRow(serialNumber) {
                var departments = @json(Helpers::getDepartments());
                var disabled = @json(isset($data->stage) && ($data->stage == 0 || $data->stage == 4));
                var selectedDepartment = @json(isset($data->department) ? $data->department : '');

                var departmentOptions = '<option selected disabled value="">---select---</option>';
                for (var key in departments) {
                    var selected = (departments[key] === selectedDepartment) ? 'selected' : '';
                    departmentOptions += '<option value="' + departments[key] + '" ' + selected + '>' + departments[
                        key] + '</option>';
                }

                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td>' +
                    '<select name="Self_Inspection[' + serialNumber + '][department]" id="department' +
                    serialNumber + '"' + (disabled ? ' disabled' : '') + '>' +
                    departmentOptions +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="Months' + serialNumber + '" multiple placeholder="Select..." ' +
                    'data-search="false" data-silent-initial-value-set="true" ' +
                    'name="Self_Inspection[' + serialNumber + '][Months]">' +
                    '<option value="Jan">January</option>' +
                    '<option value="Feb">February</option>' +
                    '<option value="Mar">March</option>' +
                    '<option value="Apr">April</option>' +
                    '<option value="May">May</option>' +
                    '<option value="Jun">June</option>' +
                    '<option value="Jul">July</option>' +
                    '<option value="Aug">August</option>' +
                    '<option value="Sep">September</option>' +
                    '<option value="Oct">October</option>' +
                    '<option value="Nov">November</option>' +
                    '<option value="Dec">December</option>' +
                    '</select>' +
                    '</td>' +
                    '<td><input type="text" name="Self_Inspection[' + serialNumber + '][Remarked]"></td>' +
                    '<td><button type="button" class="removeBtn">Remove</button></td>' +
                    '</tr>';
                return html;
            }

            // Event listener for adding new rows
            $('#Self_Inspection').click(function(e) {
                e.preventDefault();
                var tableBody = $('#Self_Inspection-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                // Initialize VirtualSelect after adding the new row
                VirtualSelect.init({
                    ele: '#Months' + (rowCount + 1) +
                        ', #team_members, #training-require, #impacted_objects'
                });
            });

            // Event delegation for remove button
            $('#Self_Inspection-field-instruction-modal').on('click', '.removeBtn', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>


    <script>
        $(document).on('click', '.removeBtnaid', function() {
            $(this).closest('tr').remove();
        })
    </script>


    <script>
        $(document).on('click', '.removeBtncd', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>

    <script>
        $(document).ready(function() {
            // Function to generate a new row in the Self Inspection Planner table
            function generateTableRow(serialNumber) {
                var departments = @json(Helpers::getDepartments());
                var disabled = @json(isset($data->stage) && ($data->stage == 0 || $data->stage == 8));
                var selectedDepartment = @json(isset($data->departments) ? $data->departments : '');

                var departmentOptions = '<option selected disabled value="">---select---</option>';
                for (var key in departments) {
                    var selected = (departments[key] === selectedDepartment) ? 'selected' : '';
                    departmentOptions += '<option value="' + departments[key] + '" ' + selected + '>' + departments[
                        key] + '</option>';
                }

                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td>' +
                    '<select name="Self_Inspection_circular[' + serialNumber + '][departments]" id="departments"' +
                    (
                        disabled ? ' disabled' : '') + '>' +
                    departmentOptions +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<div class="new-date-data-field">' +
                    '<div class="group-input input-date">' +
                    '<div class="calenderauditee">' +
                    '<input class="click_date" id="date_' + serialNumber +
                    '_mfg_date" type="text" name="Self_Inspection_circular[' + serialNumber +
                    '][info_mfg_date_display]" placeholder="DD-MMM-YYYY" readonly />' +
                    '<input type="date" name="Self_Inspection_circular[' + serialNumber +
                    '][info_mfg_date]" min="" id="closed_input_' +
                    serialNumber +
                    '" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'date_' +
                    serialNumber + '_mfg_date\')">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td><input type="text" name="Self_Inspection_circular[' + serialNumber + '][Auditor]"></td>' +
                    '<td><button type="button" class="removeBtns">Remove</button></td>' +
                    '</tr>';
                return html;
            }

            // Event listener for adding new rows
            $('#Self_Inspection_circular').click(function(e) {
                e.preventDefault();
                var tableBody = $('#Self_Inspection_circular-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                // Initialize VirtualSelect after adding the new row
                VirtualSelect.init({
                    ele: '#Months' + (rowCount + 1) +
                        ', #team_members, #training-require, #impacted_objects'
                });
            });

            // Event delegation for remove button
            $('#Self_Inspection_circular-field-instruction-modal').on('click', '.removeBtns', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>



    <script>
        $(document).on('click', '.removeBtns', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        VirtualSelect.init({
            ele: '#investigators'
        });

        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }



        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
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

        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".cctablinks");
        const steps = document.querySelectorAll(".cctabcontent");
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
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
