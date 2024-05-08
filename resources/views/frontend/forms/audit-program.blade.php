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
        $users = DB::table('users')
            ->select('id', 'name')
            ->get();

    @endphp


    <script>
        $(document).ready(function() {
            $('#audit_program').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                    '<tr>' +'<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +'<td><select name="Auditees[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        // '<td><input type="date" name="start_date[]"></td>'
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" id="start_date' + serialNumber +'"    name="start_date[]" class="hide-input" oninput="handleDateInput(this, `start_date' + serialNumber +'`)" /></div></div></div></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="start_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="start_date' + serialNumber +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `start_date' + serialNumber +'`);checkDate(`start_date' + serialNumber +'_checkdate`,`end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                        // '<td><input type="date" name="end_date[]"></td>' 
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="end_date' + serialNumber +'_checkdate" readonly placeholder="DD-MMM-YYYY" /><input type="date" id="end_date' + serialNumber +'"  name="end_date[]" class="hide-input" oninput="handleDateInput(this, `end_date' + serialNumber +'`)" /></div></div></div></td>'
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="end_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="end_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="end_date'+ serialNumber +'_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' + serialNumber +'`);checkDate(`start_date' + serialNumber +'_checkdate`,`end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' 

                        +
                        '<td><select name="lead_investigator[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    html += '</select></td>' +
                        '<td><input type="text" name="comment[]"></td>' +
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Signatures</button>
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
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Due</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        {{-- <input type="date"
                                            value="" name="due_date"> --}}
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b></label>
                                        <select name="Initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('Initiator_Group') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('Initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('Initiator_Group') == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG" @if (old('Initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('Initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('Initiator_Group') == 'CL') selected @endif>Central
                                                Laboratory</option>

                                            <option value="TT" @if (old('Initiator_Group') == 'TT') selected @endif>Tech
                                                Team</option>
                                            <option value="QA" @if (old('Initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('Initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('Initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('Initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('Initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('Initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('Initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description"><b>Short Description <span
                                                    class="text-danger">*</span></b></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
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
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="initiated_through">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_through_req"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="repeat">Repeat</label>
                                        <select name="repeat"
                                            onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Repeat Nature<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="repeat_nature"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Type</label>
                                        <select name="type">
                                            <option value="">-- Select --</option>
                                            <option value="other">Other</option>
                                            <option value="annual">Annual</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="type">Type(Others)<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_through_req"></textarea>
                                    </div>
                                </div>
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
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="audit-program-grid">
                                            Audit Program<button type="button" name="ann"
                                                id="audit_program">+</button>
                                        </label>
                                        <table class="table table-bordered" id="audit_program_body">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Auditees</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                    <th>Lead Investigator</th>
                                                    <th>Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1"></td>
                                                    <td> <select id="select-state" placeholder="Select..."
                                                            name="Auditees[]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>
                                                    {{-- <td><input type="date" name="start_date[]"></td> --}}
                                                    <td><div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date "><div class="calenderauditee">
                                                        <input type="text" id="start_date" readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" id="start_date_checkdate" name="start_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"   class="hide-input" 
                                                        oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" /></div></div></div></td>
                                                    {{-- <td><input type="date" name="end_date[]"></td> --}}
                                                    <td><div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date "><div
                                                         class="calenderauditee">
                                                        <input type="text" id="end_date" readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" id="end_date_checkdate"  name="end_date[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" /></div></div></div></td>
                                                    <td> <select id="select-state" placeholder="Select..."
                                                            name="lead_investigator[]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><input type="text" name="comment[]"></td>
                                                </tr>
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
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted_By..">Submitted By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted_On">Submitted On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved_By">Approved By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved_On">Approved On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit_Completed_By">Audit Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit_Completed_On">Audit Completed On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled_By">Cancelled By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled_On">Cancelled On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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

    <Script>
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
            cell3.innerHTML ='<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="start_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="start_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="start_date' + currentRowCount +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `start_date' + currentRowCount +'`);checkDate(`start_date' + currentRowCount +'_checkdate`,`end_date' + currentRowCount +'_checkdate`)" /></div></div></div></td>';

            var cell4 = newRow.insertCell(3);
            // cell4.innerHTML = "<input type='date' name='date_end[]'>";
            cell4.innerHTML ='<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="end_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="end_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date'+ currentRowCount +'_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' + currentRowCount +'`);checkDate(`start_date' + currentRowCount +'_checkdate`,`end_date' + currentRowCount +'_checkdate`)" /></div></div></div></td>';


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
    </Script>

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
            $('#rchars').text(textlen);});
    </script>


@endsection
