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
        $users = DB::table('users')->get();
    @endphp
    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }}
            / Out Of Calibration
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#Monitor_Information').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="date" name="date[]"></td>' +
                        ' <td><input type="text" name="Responsible[]"></td>' +
                        '<td><input type="text" name="ItemDescription[]"></td>' +
                        '<td><input type="date" name="SentDate[]"></td>' +
                        '<td><input type="date" name="ReturnDate[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Monitor_Information_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#Product_Material').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="ReBatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="text" name="Disposition[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#Equipment').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="BatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                        '<td><input type="text" name="Exist[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Equipment_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>




    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Head Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Phase IA Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase IA HOD Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase IA QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">P-IA QAH Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Phase IB Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Phase IB HOD Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Phase IB QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">P-IB QAH Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Activity Log</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">HOD Review</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Stage I</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Closure</button> -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Activity Log</button> --}}

            </div>

            <form action="{{ route('oocCreate') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div> <!-- RECORD NUMBER -->
                            <div class="row">
                                {{-- @foreach ($record_number as $record) --}}


                                {{-- @php
                                $division =  Helpers::getDivisionName(session()->get('division')) 
                            @endphp --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        {{-- <input disabled type="number" name="record_number" value="" > --}}
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/{{ date('y') }}/OOC/{{ $record_number }}">

                                    </div>
                                </div>
                                {{-- @endforeach --}}

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
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
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

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <p class="text-primary"> last date this record should be closed by</p>

                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>

                                    </div>
                                </div>


                                <!-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group"><b>Initiator Group</b></label>
                                            <select name="Initiator_Group" id="initiator_group">
                                                <option value="">-- Select --</option>
                                                <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>Quality Assurance Biopharma</option>
                                                <option value="CQC" @if (old('Initiator_Group') == 'CQA') selected @endif>Central Quality Control</option>
                                                <option value="CQC" @if (old('Initiator_Group') == 'MANU') selected @endif>Manufacturing</option>
                                                <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma Sourcing Group</option>
                                                <option value="CS"  @if (old('Initiator_Group') == 'CS') selected @endif>Central Stores</option>
                                                <option value="ITG" @if (old('Initiator_Group') == 'ITG') selected @endif>Information Technology Group</option>
                                                <option value="MM"  @if (old('Initiator_Group') == 'MM') selected @endif>Molecular Medicine</option>
                                                <option value="CL"  @if (old('Initiator_Group') == 'CL') selected @endif>Central Laboratory</option>

                                                <option value="TT"  @if (old('Initiator_Group') == 'TT') selected @endif>Tech team</option>
                                                <option value="QA"  @if (old('Initiator_Group') == 'QA') selected @endif> Quality Assurance</option>
                                                <option value="QM"  @if (old('Initiator_Group') == 'QM') selected @endif>Quality Management</option>
                                                <option value="IA"  @if (old('Initiator_Group') == 'IA') selected @endif>IT Administration</option>
                                                <option value="ACC"  @if (old('Initiator_Group') == 'ACC') selected @endif>Accounting</option>
                                                <option value="LOG"  @if (old('Initiator_Group') == 'LOG') selected @endif>Logistics</option>
                                                <option value="SM"  @if (old('Initiator_Group') == 'SM') selected @endif>Senior Management</option>
                                                <option value="BA"  @if (old('Initiator_Group') == 'BA') selected @endif>Business Administration</option>

                                            </select>
                                        </div>
                                    </div> -->

                              {{--                         
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiation Department <span
                                                class="text-danger">*</span></label>
                                        <select name="Initiator_Group" id="initiator_group">
                                            <option value="">Select Initiation Department</option>
                                            <option value="CQA">Corporate Quality Assurance</option>
                                            <option value="QA">Quality Assurance</option>
                                            <option value="QC">Quality Control</option>
                                            <option value="QM">Quality Control (Microbiology department)</option>
                                            <option value="PG">Production General</option>
                                            <option value="PL">Production Liquid Orals</option>
                                            <option value="PT">Production Tablet and Powder</option>
                                            <option value="PE">Production External (Ointment, Gels, Creams and Liquid)
                                            </option>
                                            <option value="PC">Production Capsules</option>
                                            <option value="PI">Production Injectable</option>
                                            <option value="EN">Engineering</option>
                                            <option value="HR">Human Resource</option>
                                            <option value="ST">Store</option>
                                            <option value="IT">Electronic Data Processing</option>
                                            <option value="FD">Formulation Development</option>
                                            <option value="AL">Analytical research and Development Laboratory</option>
                                            <option value="PD">Packaging Development</option>
                                            <option value="PU">Purchase Department</option>
                                            <option value="DC">Document Cell</option>
                                            <option value="RA">Regulatory Affairs</option>
                                            <option value="PV">Pharmacovigilance</option>
                                        </select>
                                        
                                    </div>
                                </div>



                                <!-- <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Initiator Group Code">Initiator Group Code</label>
                                            <input type="text" name="initiator_group_code" id="initiator_group_code" value="" readonly>
                                        </div>
                                    </div> -->

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiation Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            placeholder="Initiator Group Code" value="" readonly>
                                    </div>
                                </div>

                                <script>
                                    // JavaScript
                                    document.getElementById('initiator_group').addEventListener('change', function() {
                                        var selectedValue = this.value;
                                        document.getElementById('initiator_group_code').value = selectedValue;
                                    });
                                </script>


                                --}}


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiation Department</b></label>
                                        <input readonly type="text" name="Initiator_Group" id="initiator_group" 
                                            value="{{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}">
                                    </div>
                                </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            // Define department name to code mapping
                                            const departmentMapping = {
                                                "Calibration Lab": "CLB",
                                                "Engineering": "ENG",
                                                "Facilities": "FAC",
                                                "LAB": "LAB",
                                                "Labeling": "LABL",
                                                "Manufacturing": "MANU",
                                                "Quality Assurance": "QA",
                                                "Quality Control": "QC",
                                                "Ragulatory Affairs": "RA",
                                                "Security": "SCR",
                                                "Training": "TR",
                                                "IT": "IT",
                                                "Application Engineering": "AE",
                                                "Trading": "TRD",
                                                "Research": "RSCH",
                                                "Sales": "SAL",
                                                "Finance": "FIN",
                                                "Systems": "SYS",
                                                "Administrative": "ADM",
                                                "M&A": "M&A",
                                                "R&D": "R&D",
                                                "Human Resource": "HR",
                                                "Banking": "BNK",
                                                "Marketing": "MRKT",
                                                
                                            };

                                            // Get the Initiator Department input
                                            let initiatorGroupInput = document.getElementById("initiator_group");
                                            let initiatorGroupCodeInput = document.getElementById("initiator_group_code");

                                            // Get the department name from the input field
                                            let departmentName = initiatorGroupInput.value.trim();

                                            // Auto-generate the department code based on the mapping
                                            if (departmentName in departmentMapping) {
                                                initiatorGroupCodeInput.value = departmentMapping[departmentName];
                                            } else {
                                                initiatorGroupCodeInput.value = "N/A"; // Default if not found
                                            }
                                        });
                                    </script>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiation Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code" placeholder="Initiator Group Code"
                                            value="" readonly>
                                    </div>
                                </div>


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="last_calibration_date">Last Calibration Date</label>
                                        <div class="calenderauditee">
                                            <!-- This is the display field for the formatted date -->
                                            <input type="text" id="last_calibration_display" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ old('last_calibration_date') ? \Carbon\Carbon::parse(old('last_calibration_date'))->format('d-M-Y') : '' }}" />

                                            <!-- This is the actual date picker field -->
                                            <input type="date" name="last_calibration_date" id="last_calibration_date"
                                                class="hide-input" value="{{ old('last_calibration_date') ?? '' }}"
                                                onchange="updateDateDisplay(this)" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // Function to handle updating the display field when a date is selected
                                    function updateDateDisplay(dateInput) {
                                        var selectedDate = new Date(dateInput.value);
                                        if (!isNaN(selectedDate.getTime())) {
                                            var options = {
                                                day: '2-digit',
                                                month: 'short',
                                                year: 'numeric'
                                            };
                                            var formattedDate = selectedDate.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                            document.getElementById('last_calibration_display').value = formattedDate;
                                        } else {
                                            document.getElementById('last_calibration_display').value = ''; // Clear if date is invalid
                                        }
                                    }
                                </script>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description">Short Description <span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <p id="char-count"></p>
                                        <input type="text" name="description_ooc" id = "description_ooc">

                                    </div>
                                </div>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        var maxLength = 255;
                                        $('#description_ooc').on('input', function() {
                                            var inputLength = $(this).val().length;
                                            var remaining = maxLength - inputLength;
                                            $('#char-count').text(remaining + ' characters remaining');

                                            if (remaining < 0) {
                                                $(this).val($(this).val().substring(0, maxLength));
                                                $('#char-count').text('0 characters remaining');
                                            }
                                        });
                                    });
                                </script>







                                <script>
                                    document.getElementById('initiator_group').addEventListener('change', function() {
                                        var selectedValue = this.value;
                                        document.getElementById('initiator_group_code').value = selectedValue;
                                    });
                                </script>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Details of OOC">
                                    Details of OOC
                                    </label>
                                    <div>
                                        <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                    </div>
                                    <textarea class="summernote" name="details_of_ooc" id="details_of_ooc"></textarea>
                                </div>
                            </div>

                                {{-- 
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="Initiator_Group" id="initiator_group">
                                        <option value="">-- Select --</option>
                                        <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                        <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>Quality Assurance Biopharma</option>
                                        <option value="CQC" @if (old('Initiator_Group') == 'CQA') selected @endif>Central Quality Control</option>
                                        <option value="CQC" @if (old('Initiator_Group') == 'MANU') selected @endif>Manufacturing</option>
                                        <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma Sourcing Group</option>
                                        <option value="CS"  @if (old('Initiator_Group') == 'CS') selected @endif>Central Stores</option>
                                        <option value="ITG" @if (old('Initiator_Group') == 'ITG') selected @endif>Information Technology Group</option>
                                        <option value="MM"  @if (old('Initiator_Group') == 'MM') selected @endif>Molecular Medicine</option>
                                        <option value="CL"  @if (old('Initiator_Group') == 'CL') selected @endif>Central Laboratory</option>

                                        <option value="TT"  @if (old('Initiator_Group') == 'TT') selected @endif>Tech team</option>
                                        <option value="QA"  @if (old('Initiator_Group') == 'QA') selected @endif> Quality Assurance</option>
                                        <option value="QM"  @if (old('Initiator_Group') == 'QM') selected @endif>Quality Management</option>
                                        <option value="IA"  @if (old('Initiator_Group') == 'IA') selected @endif>IT Administration</option>
                                        <option value="ACC"  @if (old('Initiator_Group') == 'ACC') selected @endif>Accounting</option>
                                        <option value="LOG"  @if (old('Initiator_Group') == 'LOG') selected @endif>Logistics</option>
                                        <option value="SM"  @if (old('Initiator_Group') == 'SM') selected @endif>Senior Management</option>
                                        <option value="BA"  @if (old('Initiator_Group') == 'BA') selected @endif>Business Administration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="nitiator_group_code" value="" readonly>
                                    </div>
                                </div> --}}



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through" id="initiated_through" onchange="toggleOtherField()">
                                            <option value="0">-- select --</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3" id="if_other_field" style="display: none;">
                                    <div class="group-input">
                                        <label for="If Other">If Other <span id="required-star" class="text-danger" style="display: none;">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="initiated_if_other" id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <script>
                                    function toggleOtherField() {
                                        var select = document.getElementById("initiated_through");
                                        var otherField = document.getElementById("if_other_field");
                                        var requiredStar = document.getElementById("required-star");
                                        var textarea = document.getElementById("summernote-1");

                                        if (select.value === "others") {
                                            otherField.style.display = "block";
                                            requiredStar.style.display = "inline";
                                            textarea.setAttribute("required", "required");
                                        } else {
                                            otherField.style.display = "none";
                                            requiredStar.style.display = "none";
                                            textarea.removeAttribute("required");
                                        }
                                    }
                                </script>
                                {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="affected documents closed"><b>Affected Documents Closed</b></label>
                                    <select name="affected_document_closure" id="affected_document_closure">
                                        <option value="0">-- Select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="NA">NA</option>
                                      
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Is Repeat"><b>Is Repeat</b></label>
                                    <select name="is_repeat_ooc" id="is_repeat_ooc" onchange="toggleRepeatNature()">
                                        <option value="0">-- Select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3" id="repeat_nature_field" style="display: none;">
                                <div class="group-input">
                                    <label for="Repeat Nature">
                                        Repeat Nature <span id="repeat_required" style="color: red; display: none;">*</span>
                                    </label>
                                    <div>
                                        <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                    </div>
                                    <textarea class="summernote" name="Repeat_Nature" id="repeat_nature"></textarea>
                                </div>
                            </div>

                            <script>
                                function toggleRepeatNature() {
                                    var repeatSelect = document.getElementById("is_repeat_ooc");
                                    var repeatField = document.getElementById("repeat_nature_field");
                                    var repeatRequired = document.getElementById("repeat_required");
                                    var repeatTextarea = document.getElementById("repeat_nature");

                                    if (repeatSelect.value === "Yes") {
                                        repeatField.style.display = "block";
                                        repeatRequired.style.display = "inline";
                                        repeatTextarea.setAttribute("required", "required");
                                    } else {
                                        repeatField.style.display = "none";
                                        repeatRequired.style.display = "none";
                                        repeatTextarea.removeAttribute("required");
                                    }
                                }
                            </script>






                          


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_ooc"
                                                    name="initial_attachment_ooc[]"
                                                    oninput="addMultipleFiles(this, 'initial_attachment_ooc')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            HOD Person <span class="text-danger"></span>
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

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            QA Person <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="qa_assign_person">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('qa_assign_person')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            OOC Logged by <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="ooc_logged_by">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ooc_logged_by')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                        <!-- <input type="text" name ="ooc_logged_by" placeholder="Enter Your Text" /> -->

                                    </div>
                                </div>

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">OOC Logged On <span class="text-danger"></span></label>
                                         <div class="calenderauditee">
                                            <input type="text" id="ooc_due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="ooc_due_date" class="hide-input"
                                                oninput="handleDateInput(this, 'ooc_due_date')" />
                                        </div>

                                    </div>
                                </div>
                                {{-- grid added new --}}

                                <div class="col-12">
                                    <div class="group-input" id="IncidentRow">
                                        <label for="root_cause">
                                            Instrument Details
                                            <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                
                                            </span>
                                        </label>

                                        <table class="table table-bordered" id="onservation-incident-table">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Instrument Name</th>
                                                    <th>Instrument ID</th>
                                                    <th>Remarks</th>
                                                    <th>Calibration Parameter</th>
                                                    <th>Acceptance Criteria</th>
                                                    <th>Results</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serialNumber = 1;
                                                @endphp
                                                <tr>
                                                    <td disabled>{{ $serialNumber++ }}</td>
                                                    <td><input type="text"
                                                            name="instrumentdetails[0][instrument_name]"></td>
                                                    <td><input type="text" name="instrumentdetails[0][instrument_id]">
                                                    </td>
                                                    <td><input type="text" name="instrumentdetails[0][remarks]"></td>
                                                    <td><input type="text" name="instrumentdetails[0][calibration]">
                                                    </td>
                                                    <td><input type="text"
                                                            name="instrumentdetails[0][acceptancecriteria]"></td>
                                                    <td><input type="text" name="instrumentdetails[0][results]"></td>
                                                    <td><button class="removeRowBtn">Remove</button>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Facility_Equipment');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('facility-name');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        // Add elements with class 'id-number' to inputsToToggle
                                        var idNumberInputs = document.getElementsByClassName('id-number');
                                        for (var j = 0; j < idNumberInputs.length; j++) {
                                            inputsToToggle.push(idNumberInputs[j]);
                                        }

                                        // Add elements with class 'remarks' to inputsToToggle
                                        var remarksInputs = document.getElementsByClassName('remarks');
                                        for (var k = 0; k < remarksInputs.length; k++) {
                                            inputsToToggle.push(remarksInputs[k]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskInvi');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>


                                <script>
                                    $(document).ready(function() {
                                        let investdetails = 1;
                                        $('#IncidentAdd').click(function(e) {
                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" value="' + serialNumber + '"></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][instrument_name]" value=""></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][instrument_id]" value=""></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][remarks]" value=""></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][calibration]" value=""></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][acceptancecriteria]" value=""></td>' +
                                                    '<td><input type="text" name="instrumentdetails[' + investdetails +
                                                    '][results]" value=""></td>' +
                                                    '<td><button class="removeRowBtn">Remove</button>' +
                                                    '</tr>';
                                                investdetails++; // Increment the row number here
                                                return html;
                                            }

                                            var tableBody = $('#onservation-incident-table tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                        });
                                        $(document).on('click', '.removeRowBtn', function() {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                                </script>

                                {{-- grid added new --}}




                                <div class="sub-head"> Delay Justification for Reporting</div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Delay Justification for Reporting">Delay Justification for
                                            Reporting</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="Delay_Justification_for_Reporting" id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Immediate Action">Immediate Action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1"></textarea>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">HOD Primary Review</div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">HOD Primary Review Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-1" disabled></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">HOD Primary Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_hod_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_hod_ooc"
                                                    name="attachments_hod_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'attachments_hod_ooc')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Immediate Action">Immediate Action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Immediate_Action_ooc" id="summernote-1"></textarea>
                                    </div>
                                </div> -->

                                {{-- <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Preliminary_Investigation_ooc" id="summernote-1"></textarea>
                                </div>
                            </div> --}}






                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                QA Head Primary Review
                            </div>
                            <div class="row">


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">QA Head Primary Review Remarks </label>
                                        <textarea name="qaheadremarks" placholder="enter review" disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">QA Head Primary Review Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_capa_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_capa_ooc"
                                                    name="initial_attachment_capa_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'initial_attachment_capa_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>


                    @php
                        $oocevaluations = [
                            'Status of calibration for other instrument(s) used for performing calibration of the referred instrument',
                            'Verification of calibration standards used Primary Standard: Physical appearance, validity, certificate. Secondary standard: Physical appearance, validity',
                            'Verification of dilution, calculation, weighing, Titer values and readings',
                            'Verification of glassware used',
                            'Verification of chromatograms/spectrums/other instrument',
                            'Adequacy of system suitability checks',
                            'Instrument Malfunction',
                            'Check for adherence to the calibration method',
                            'Previous History of instrument',
                            'Others',
                        ];
                    @endphp
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Phase IA Investigation
                            </div>
                            <div class="row">
                                {{-- <div class="sub-head">Checklist</div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="checklist">Phase IA Investigation Checklist</label>
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Question</th>
                                                        <th>Response</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oocevaluations as $item)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            {{-- <td >Status of calibration for other instrument(s) used for performing calibration of the referred instrument</td>
                                                 --}}
                                                            <td style="background: #DCD8D8">{{ $item }}</td>
                                                            <td>
                                                                <textarea name="oocevoluation[{{ $loop->index }}][response]"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="oocevoluation[{{ $loop->index }}][remarks]"></textarea>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    {{-- @foreach ($oocevaluations as $item) --}}

                                                    {{-- <tr>
                                                <td></td>
                                                    <td style="background: #DCD8D8"></td>
                                                    <td>
                                                    <textarea name="where_will_be_qII"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="where_will_not_be_qII"></textarea>
                                                </td>

                                            </tr> --}}
                                                    {{-- @endforeach --}}

                                                    {{-- <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of dilution, calculation, weighing, Titer values and readings</td>
                                                <td>
                                                    <textarea name="when_will_be_qIII"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="when_will_not_be_qIII"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of glassware used</td>
                                                <td>
                                                    <textarea name="coverage_will_be_qIv"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="coverage_will_not_be_qIv"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of chromatograms/spectrums/other instrument</td>
                                                <td>
                                                    <textarea name="who_will_be_qv"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_qv"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Adequacy of system suitability checks</td>
                                                <td>
                                                    <textarea name="who_will_be_vi"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_vi"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Instrument Malfunction</td>
                                                <td>
                                                    <textarea name="who_will_be_vii"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_vii"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Check for adherence to the calibration method</td>
                                                <td>
                                                    <textarea name="who_will_be_viii"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_viii"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Previous History of instrument</td>
                                                <td>
                                                    <textarea name="who_will_be_ix"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_ix"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Others</td>
                                                <td>
                                                    <textarea name="who_will_be_x"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be_x"></textarea>
                                                </td>

                                            </tr> --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Analyst Remarks">Analyst Interview</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="analysis_remarks_stage_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">Evaluation Remarks</label>
                                        <textarea name="qa_comments_ooc" disabled ></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">Description of Cause for OOC Results (If
                                            Identified)</label>
                                        <textarea name="qa_comments_description_ooc" disabled></textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Root Cause identified</label>
                                        <select name="is_repeat_assingable_ooc" disabled id="assignableSelect"
                                            onchange="toggleRootCauseInput()">
                                            <option value=" ">Select</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="rootCauseGroup" style="display: none;">
                                    <div class="group-input">
                                        <label for="RootCause">Phase IA Investigation Comment</label>
                                        <textarea name="rootcausenewfield" disabled id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here"></textarea>
                                    </div>
                                </div>
                                <script>
                                    function toggleRootCauseInput() {
                                        var selectValue = document.getElementById("assignableSelect").value;
                                        var rootCauseGroup = document.getElementById("rootCauseGroup");

                                        if (selectValue === "YES") {
                                            rootCauseGroup.style.display = "block"; // Show the textarea if "YES" is selected
                                        } else {
                                            rootCauseGroup.style.display = "none"; // Hide the textarea if "NO" or "NA" is selected
                                        }
                                    }
                                </script>

                                <div class="col-12 sub-head">
                                    Hypothesis Study
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis
                                            Study</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="protocol_based_study_hypthesis_study_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>



                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Justification for Protocol study/ Hypothesis Study">Justification for
                                            Protocol study/ Hypothesis Study</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="justification_for_protocol_study_hypothesis_study_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/
                                            Hypothesis Study</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="plan_of_protocol_study_hypothesis_study" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Hypothesis Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_hypothesis_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_hypothesis_ooc"
                                                    name="attachments_hypothesis_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'attachments_hypothesis_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of
                                            Protocol based Study/Hypothesis Study</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="conclusion_of_protocol_based_study_hypothesis_study_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="inner-block-content">
                                    <div class="row">
                                        <!-- <div class="sub-head">Stage I</div> -->

                                        {{-- <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Analyst Remarks">Analyst Interview</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1"></textarea>
                            </div>
                        </div>  --}}


                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Calibration Results">Calibration Results</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote" name="calibration_results_stage_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Results Naturey</label>
                                <select name="is_repeat_result_naturey_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                            </div>
                        </div> --}}




                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Review of Calibration Results of Analyst">Review of Calibration
                                                    Results of Analyst</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Initial Attachments">Phase IA Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="attachments_stage_ooc"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="attachments_stage_ooc"
                                                            name="attachments_stage_ooc[]" disabled
                                                            oninput="addMultipleFiles(this, 'attachments_stage_ooc')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Results Criteria">Result Criteria</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote" name="results_criteria_stage_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Initiator Group">Result</label>
                                                <select name="is_repeat_stae_ooc" disabled>
                                                    <option value="">-- Select --</option>
                                                    <option value="Validated"
                                                        {{ old('is_repeat_stae_ooc') == 'Validated' ? 'selected' : '' }}>
                                                        Validated</option>
                                                    <option value="Invalidated"
                                                        {{ old('is_repeat_stae_ooc') == 'Invalidated' ? 'selected' : '' }}>
                                                        Invalidated</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Additinal Remarks (if any)">Additional Remarks (if any)</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote" name="additional_remarks_stage_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Corrective Action">Corrective Action</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea name="initiated_through_capas_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Preventive Action">Preventive Action</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea name="initiated_through_capa_prevent_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>
                                    {{--
                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Corrective & Preventive Action">Corrective and Preventive
                                                    Action</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea name="initiated_through_capa_corrective_ooc" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>
                                     --}}
                                        <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Cause for failure">Phase IA Summary</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote" name="phase_ia_investigation_summary" disabled id="summernote-1"></textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div> -->
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>


                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Phase IA HOD Primary Review</div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">Phase IA HOD Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="phase_IA_HODREMARKS" disabled></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Phase IA HOD Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_hodIAHODPRIMARYREVIEW_ooc">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_hodIAHODPRIMARYREVIEW_ooc"
                                                    name="attachments_hodIAHODPRIMARYREVIEW_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'attachments_hodIAHODPRIMARYREVIEW_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Phase IA QA Review
                            </div>
                            <div class="row">


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Phase IA QA Remarks</label>
                                        <textarea name="qaremarksnewfield" disabled placholder="enter review"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Phase IA QA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_capa_post_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_capa_post_ooc"
                                                    name="initial_attachment_capa_post_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'initial_attachment_capa_post_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>


                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                P-IA QAH Review
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Assignable cause identified</label>
                                        <select name="assignable_cause_identified" disabled onchange="">
                                            <option value="0">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">P-IA QAH Remarks</label>
                                        <textarea name="qaHremarksnewfield" disabled placholder="enter review"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">P-IA QAH Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_qah_post_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_qah_post_ooc"
                                                    name="initial_attachment_qah_post_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'initial_attachment_qah_post_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Phase IB Investigation
                            </div>
                            <div class="row">


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Rectification by Service Engineer required</label>
                                        <select name="is_repeat_stageii_ooc" disabled onchange="">
                                            <option value=" ">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Instrument is Out of Order</label>
                                        <select name="is_repeat_stage_instrument_ooc" disabled onchange="">
                                            <option value=" ">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                               {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Details of instrument out of order</label>
                                        <select name="details_of_instrument_out_of_order" onchange="">
                                            <option value=" ">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Initiator Group">Details of instrument out of order</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="details_of_instrument_out_of_order" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Proposed By</label>
                                        <!-- <select name="is_repeat_proposed_stage_ooc" id="proposedBySelect" onchange="toggleTextarea()">
                                            <option value="0">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select> -->

                                        <input type = "text" name = "is_repeat_proposed_stage_ooc" disabled
                                            id = "is_repeat_proposed_stage_ooc" />
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Details of Equipment Rectification
                                            Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_stageii_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_stageii_ooc"
                                                    name="initial_attachment_stageii_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'initial_attachment_stageii_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Compiled by</label>
                                        <!-- <select name="is_repeat_compiled_stageii_ooc" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select> -->

                                        <input type = "text" name = "is_repeat_compiled_stageii_ooc" disabled
                                            id = "is_repeat_compiled_stageii_ooc" />

                                    </div>
                                </div>

                                <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Release of Instrument for usage</label>
                                    <select name="is_repeat_realease_stageii_ooc" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>


                                    </select>
                                </div>
                            </div> -->

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment at Stage II">Impact Assessment </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="initiated_throug_stageii_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="initiated_through_stageii_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Details of Impact Evaluation">Justification for Recalibration</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="justification_for_recalibration" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Details of Impact Evaluation">Result of Recalibration</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="is_repeat_reanalysis_stageii_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>




                                {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Result of Reanalysis</label>
                                <!-- <select name="is_repeat_reanalysis_stageii_ooc" onchange="">
                                    <option value="0">-- select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    

                                </select> -->

                                <input type  =  "text" name ="is_repeat_reanalysis_stageii_ooc" placeholder = "Enter Text Here" />
                             </div>
                        </div> --}}

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Cause for failure">Cause for failure</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="initiated_through_stageii_cause_failure_ooc" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective action IB Investigation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="initiated_through_capas_ooc_IB" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive action IB Investigation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="initiated_through_capa_prevent_ooc_IB" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>
                                 

                            {{--  
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective & Preventive Action">Corrective and preventive action IB
                                        Investigation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="initiated_through_capa_corrective_ooc_IB" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>
                            --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Cause for failure">Phase IB Summary</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="phase_ib_investigation_summary" disabled id="summernote-1"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Phase IB Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_reanalysisi_ooc">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_reanalysisi_ooc"
                                                    name="initial_attachment_reanalysisi_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'initial_attachment_reanalysisi_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>


                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Phase IB HOD Primary Review</div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">Phase IB HOD Primary Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="phase_IB_HODREMARKS" disabled></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Phase IB HOD Primary Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list"
                                                id="attachments_hodIBBBHODPRIMARYREVIEW_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_hodIBBBHODPRIMARYREVIEW_ooc"
                                                    name="attachments_hodIBBBHODPRIMARYREVIEW_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'attachments_hodIBBBHODPRIMARYREVIEW_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Phase IB QA Review</div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">Phase IB QA Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="phase_IB_qareviewREMARKS" disabled></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Phase IB QA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_QAIBBBREVIEW_ooc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_QAIBBBREVIEW_ooc"
                                                    name="attachments_QAIBBBREVIEW_ooc[]" disabled
                                                    oninput="addMultipleFiles(this, 'attachments_QAIBBBREVIEW_ooc')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>


                    <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                P-IB QAH Review
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Release of Instrument for usage</label>
                                        <select name="is_repeat_realease_stageii_ooc" disabled onchange="">
                                            <option value="0">-- select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>


                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">P-IB QAH Remarks</label>
                                        <textarea name="qPIBaHremarksnewfield" disabled placholder="enter review"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">P-IB QAH Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Pib_attachements"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Pib_attachements" name="Pib_attachements[]" disabled
                                                    oninput="addMultipleFiles(this, 'Pib_attachements')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>




                </div>







                <!-- <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Stage I</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Analyst Remarks">Analyst Remarks</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="analysis_remarks_stage_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Calibration Results">Calibration Results</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="calibration_results_stage_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Results Naturey</label>
                                    <select name="is_repeat_result_naturey_ooc" onchange="">
                                        <option value="0">-- select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                            </div>




                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of Calibration Results of Analyst">Review of Calibration Results of Analyst</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="review_of_calibration_results_of_analyst_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachments">Stage I Attachement</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachments_stage_ooc"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="attachments_stage_ooc" name="attachments_stage_ooc[]"
                                                oninput="addMultipleFiles(this, 'attachments_stage_ooc')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Results Criteria">Results Criteria</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="results_criteria_stage_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>

                            


                            {{-- <div class="col-6">
                            <div class="group-input">
                                <label for="qa_comments">Additinal Remarks (if any)</label>
                                <textarea name="qa_comments_stage_ooc"></textarea>
                            </div>
                        </div> --}}

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="additional_remarks_stage_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div> -->


                <!-- <div id="CCForm12" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            HOD Review
                        </div>
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="HOD Remarks">HOD Remarks</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_through_hodreview_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initial Attachments">HOD Attachement</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_hodreview_ooc"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="initial_attachment_hodreview_ooc" name="initial_attachment_hodreview_ooc[]"
                                                oninput="addMultipleFiles(this, 'initial_attachment_hodreview_ooc')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Root Cause Analysis">Root Cause Analysis</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_through_rootcause_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Impact Assessment">Impact Assessment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_through_impact_closure_ooc" id="summernote-1"></textarea>
                                </div>
                            </div>




                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div> -->

                {{-- <div id="CCForm13" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Closure Comments
                                    <input id="docname" type="text" name="short_description_closure_ooc">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Summary
                                    <input id="docname" type="text" name="Summary_closure">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initial Attachments">Details of Equipment Rectification</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}

                {{-- <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="initial_attachment_closuress_ooc"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="initial_attachment_closuress_ooc" name="initial_attachment_closuress_ooc[]"
                                            oninput="addMultipleFiles(this, 'initial_attachment_closuress_ooc')" multiple>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                       

                        
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Document Code
                                    <input id="docname" type="text" name="document_code_closure_ooc">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Remarks
                                    <input id="docname" type="text" name="remarks_closure_ooc">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Immediate Corrective Action">Immediate Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through_closure_ooc" id="summernote-1"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div> --}}





                <div id="CCForm14" class="inner-block cctabcontent">
                    <div class="inner-block-content">

                        <div class="row">

                            <center>
                                <div class="sub-head">
                                    Activity Log
                                </div>
                            </center>


                            <div class="sub-head col-lg-12">
                                Submit
                            </div>
                            <div class="col-lg-4">

                                <div class="group-input">
                                    <label for="Initiator Group">Submit By : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>

                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Submit On: </label>
                                    <div class="date">Not Applicable</div>





                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="comment">Submit Comment : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>

                            <div class="sub-head col-lg-12">HOD Primary Review Complete</div>

                            <div class="col-lg-4">

                                <div class="group-input">
                                    <label for="Initiator Group">HOD Primary Review Complete By: </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>

                            <div class="col-lg-4 new-date-data-field">

                                <div class="group-input input-date">
                                    <label for="OOC Logged On">HOD Primary Review Complete On : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="hod_review_occ_comment">HOD Primary Review Complete Comment : </label>
                                    <div class="date">Not Applicable</div>





                                </div>
                            </div>

                            <div class="sub-head col-lg-12">
                                QA Head Primary Review Complete
                            </div>
                            <div class="col-lg-4">

                                <div class="group-input">

                                    <label for="Initiator Group">QA Head Primary Review Complete By :</label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>

                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">QA Head Primary Review Complete On : </label>
                                    <div class="date">Not Applicable</div>




                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="qa_intial_review_ooc_comment">QA Head Primary Review Complete Comment :
                                    </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>
                            <div class="sub-head col-lg-12">
                                Phase IA Investigation
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IA Investigation By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IA Investigation On : </label>
                                    <div class="date">Not Applicable</div>





                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IA Investigation Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>



                            <div class="sub-head col-lg-12">
                                Phase IA HOD Review Complete
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IA HOD Review Complete By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IA HOD Review Complete On : </label>
                                    <div class="date">Not Applicable</div>





                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IA HOD Review Complete Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>

                            <div class="sub-head col-lg-12">
                                Phase IA QA Review Complete
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IA QA Review Complete By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IA QA Review Complete On : </label>
                                    <div class="date">Not Applicable</div>





                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IA QA Review Complete Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>


                            <div class="sub-head col-lg-12">
                                Assignable Cause Found
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Assignable Cause Found By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Assignable Cause Found On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Assignable Cause Found Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>

                            <div class="sub-head col-lg-12">
                                Assignable Cause Not Found
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Assignable Cause Not Found By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Assignable Cause Not Found On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Assignable Cause Not Found Comment : </label>
                                    <div class="static">Not Applicable</div>

                                </div>
                            </div>
                            <div class="sub-head col-lg-12">
                                Phase IB Investigation</div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IB Investigation By : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IB Investigation On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IB Investigation Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>


                            <div class="sub-head col-lg-12">
                                Phase IB HOD Review Complete
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IB HOD Review Complete By : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IB HOD Review Complete On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IB HOD Review Complete Comment : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>

                            <div class="sub-head col-lg-12">
                                Phase IB QA Review Complete
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Phase IB QA Review Complete By : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Phase IB QA Review Complete On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Phase IB QA Review Complete Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>

                            <div class="sub-head col-lg-12">
                                Approved
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Initiator Group">Approved By : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>


                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Approved On : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="closure_ooc_comment">Approved Comment : </label>
                                    <div class="date">Not Applicable</div>

                                </div>
                            </div>
                            <div class="sub-head col-lg-12">
                                Cancel
                            </div>
                            <div class="col-lg-4">

                                <div class="group-input">
                                    <label for="Initiator Group">Cancel By : </label>
                                    <div class="date">Not Applicable</div>


                                </div>
                            </div>

                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Cancel On: </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="comment">Cancel Comment : </label>
                                    <div class="date">Not Applicable</div>
                                </div>
                            </div>







                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
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
        VirtualSelect.init({
            ele: '#related_records, #hod'
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
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
