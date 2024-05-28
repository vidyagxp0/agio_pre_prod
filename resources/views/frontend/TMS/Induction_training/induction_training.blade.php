@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

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
    <!-- <script>
        $(document).ready(function() {
            $('#material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="material_name[]"></td>' +
                        '<td><input type="text" name="material_batch_no[]"></td>' +

                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_mfg_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_mfg_date[]" id="material_mfg_date' +
                        serialNumber +
                        '_checkdate"  class="hide-input" oninput="handleDateInput(this, `material_mfg_date' +
                    serialNumber + '`);checkDate(`material_mfg_date1' + serialNumber +
                    '_checkdate`,`material_expiry_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +


                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_expiry_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_expiry_date[]" id="material_expiry_date' +
                        serialNumber +
                        '_checkdate" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' +
                    serialNumber + '`);checkDate(`material_mfg_date' + serialNumber +
                    '_checkdate`,`material_expiry_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +

                        '<td><input type="text" name="material_batch_desposition[]"></td>' +
                        '<td><input type="text" name="material_remark[]"></td>' +
                        '<td><select name="material_batch_status[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +


                        '</tr>';

                    return html;
                }

                var tableBody = $('#material tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script> -->

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / CAPA
        </div>
    </div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}

    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Project/Study</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Additional Information</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Comments</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CAPA Closure</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Activity Log</button>
            </div>

            <form action="{{ route('capastore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Employee ID</label>
                                        <input  type="text" name="employee_id" 
                                            value="">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Name of Employee</label>
                                        <input  type="text" name="name_employee" id="name_employee"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Department & Location</label>
                                        <input readonly type="text" name="department_location"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                              
                                
                               
                                
                               
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Designation</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Qualification<span
                                                class="text-danger">
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>
                               
                                
                               
                               
                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Experience (if any)<span
                                                class="text-danger d-none">*</span></label>
                                       <input type="text" name="experience_if_any">
                                    </div>
                                </div>
                                
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Team">Date of Joining</label>
                                        <input type="date" name="date_joining" id="date_joining">
                                    </div>
                                </div>
                                
                                
                                
                                
                               

                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Name of Document</th>
                                                        <th>Document Number</th>
                                                        <th>Training Date</th>
                                                        <th>Trainee Sign/Date </th>
                                                        <th>HR Sign/Date</th>
                                                        <th>Remark</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td style="background: #DCD8D8">Introduction of Agio Plant</td>
                                                        
                                                        <td>
                                                            <textarea name="document-number"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="trainee_sign_date">
                                                         </td>
                                                         <td>
                                                            <input type="date" name="hr_sign_date">
                                                         </td>
                                                         <td>
                                                            <textarea name="remark"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td style="background: #DCD8D8">Personnel Hygiene</td>
                                                        <td>
                                                            <textarea name="document-number"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="trainee_sign_date">
                                                         </td>
                                                         <td>
                                                            <input type="date" name="hr_sign_date">
                                                         </td>
                                                         <td>
                                                            <textarea name="remark"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td style="background: #DCD8D8">Entry Exit Procedure in Factory premises</td>
                                                        <td>
                                                            <textarea name="document-number"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="trainee_sign_date">
                                                         </td>
                                                         <td>
                                                            <input type="date" name="hr_sign_date">
                                                         </td>
                                                         <td>
                                                            <textarea name="remark"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                        <td>
                                                            <textarea name="document-number"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="trainee_sign_date">
                                                         </td>
                                                         <td>
                                                            <input type="date" name="hr_sign_date">
                                                         </td>
                                                         <td>
                                                            <textarea name="remark"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td style="background: #DCD8D8">Data Integrity</td>
                                                        <td>
                                                            <textarea name="document-number"></textarea>
                                                        </td>
                                                        <td>
                                                           <input type="date" name="training_date">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="trainee_sign_date">
                                                         </td>
                                                         <td>
                                                            <input type="date" name="hr_sign_date">
                                                         </td>
                                                         <td>
                                                            <textarea name="remark"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td style="background: #77a5d1">Modules</td>
                                                        
        
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="background: #DCD8D8">a.	GMP</td>
                                                        <td>
                                                            <textarea name="who_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="background: #DCD8D8">Check for adherence to the calibration method</td>
                                                        <td>
                                                            <textarea name="who_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="background: #DCD8D8">Previous History of instrument</td>
                                                        <td>
                                                            <textarea name="who_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"></textarea>
                                                        </td>
        
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="background: #DCD8D8">Others</td>
                                                        <td>
                                                            <textarea name="who_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"></textarea>
                                                        </td>
        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <!-- Product Information content -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
              <div class="col-12 sub-head">
                                Material Details
                            </div>

                      
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Material Details">
                                        Material Details<button type="button" name="ann" id="material">+</button>
                                    </label>
                                    <table class="table table-bordered" id="material_details">
                                        <thead>
                                            <tr>
                                                <th>Row #</th>
                                                <th>Material Name</th>
                                                <th>Batch No./Lot No./AR No.</th>
                                                <th>Manufacturing Date</th>
                                                <th>Date Of Expiry</th>
                                                <th>Batch Disposition Decision</th>
                                                <th>Remark</th>
                                                <th>Batch Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        {{-- <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td> <select name="material_name[]" id="material_name">
                                                        <option value="">-- Select value --</option>
                                                        <option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">
                                                            PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/
                                                        </option>
                                                        <option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">
                                                            BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION
                                                        </option>
                                                        <option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">
                                                            CAFFEINECITRATEORALSOLUTION USP 60MG/3ML
                                                        </option>
                                                        <option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE
                                                            TART. OPH SOL 0.1%W/V (CB)
                                                        </option>
                                                        <option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">
                                                            DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO
                                                        </option>
                                                    </select></td>
                                                <td>
                                                    <select name="material_batch_no[]" id="batch_no">
                                                        <option value="">select value</option>
                                                        <option value="DCAU0030">DCAU0030</option>
                                                        <option value="BDZH0007">BDZH0007</option>
                                                        <option value="BDZH0006">BDZH0006</option>
                                                        <option value="BJJH0004A">BJJH0004A</option>
                                                        <option value="DCAU0036">DCAU0036</option>
                                                    </select>
                                                </td>
                                                <!-- <td><input type="date" name="material_mfg_date[]"></td>
                                                <td><input type="date" name="material_expiry_date[]"></td> -->
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"  class="test" id="material_mfg_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date"   id="material_mfg_date_checkdate" name="material_mfg_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"class="hide-input"
                                                                oninput="handleDateInput(this, `material_mfg_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div  class="calenderauditee">
                                                                <input type="text"  class="test" id="material_expiry_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date" id="material_expiry_date_checkdate"name="material_expiry_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                                 oninput="handleDateInput(this, `material_expiry_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td><input type="text" name="material_batch_desposition[]"></td>
                                                <td><input type="text" name="material_remark[]"></td>
                                                <td>
                                                    <select name="material_batch_status[]" id="batch_status">
                                                        <option value="">-- Select value --</option>
                                                        <option value="Hold">Hold</option>
                                                        <option value="Release">Release</option>
                                                        <option value="quarantine">Quarantine</option>
                                                    </select>
                                                </td>
                                            </tbody> --}}
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 sub-head">
                                Equipment/Instruments Details
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Material Details">
                                        Equipment/Instruments Details<button type="button" name="ann"
                                            id="equipment">+</button>
                                    </label>
                                    <table class="table table-bordered" id="equipment_details">
                                        <thead>
                                            <tr>
                                                <th>Row #</th>
                                                <th>Equipment/Instruments Name</th>
                                                <th>Equipment/Instruments ID</th>
                                                <th>Equipment/Instruments Comments</th>
                                            </tr>
                                        </thead>



                                        <tbody>
                                            <td><input disabled type="text" name="serial_number[]" value="1">
                                            </td>
                                            <td><input type="text" name="equipment[]"></td>
                                            <td><input type="text" name="equipment_instruments[]"></td>
                                            <td><input type="text" name="equipment_comments[]"></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 sub-head">
                                Other type CAPA Details
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Details">Details</label>
                                    <input type="text" name="details_new">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Comments"> CAPA QA Comments </label>
                                    <textarea name="capa_qa_comments2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            CFT Information
                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Microbiology">CFT Reviewer</label>
                                    <select name="Microbiology_new">
                                        <option value="0">-- Select --</option>
                                        <option value="yes" selected>Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Microbiology-Person">CFT Reviewer Person</label>
                                    <select name="Microbiology_Person[]" placeholder="Select CFT Reviewers"
                                        data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                        <option value="0">-- Select --</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="sub-head">
                            Concerned Information
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="group_review">Is Concerned Group Review Required?</label>
                                    <select name="goup_review">
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Production">Production</label>
                                    <select name="Production_new">
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Production-Person">Production Person</label>
                                    <select name="Production_Person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Quality-Approver">Quality Approver</label>
                                    <select name="Quality_Approver">
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Quality-Approver-Person">Quality Approver Person</label>
                                    <select name="Quality_Approver_Person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="bd_domestic">Others</label>
                                    <select name="bd_domestic">
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="bd_domestic-Person">Others Person</label>
                                    <select name="Bd_Person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Additional Attachments">Additional Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="additional_attachments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="additional_attachments[]"
                                                oninput="addMultipleFiles(this, 'additional_attachments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            CFT Feedback
                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="comments">CFT Comments</label>
                                    <textarea name="cft_comments_form"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="comments">CFT Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="cft_attchament_new"> </div>

                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="cft_attchament_new[]"
                                                oninput="addMultipleFiles(this, 'cft_attchament_new')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sub-head">
                                Concerned Group Feedback
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">QA Comments</label>
                                    <textarea name="qa_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">QA Head Designee Comments</label>
                                    <textarea name="designee_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Warehouse Comments</label>
                                    <textarea name="Warehouse_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Engineering Comments</label>
                                    <textarea name="Engineering_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Instrumentation Comments</label>
                                    <textarea name="Instrumentation_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Validation Comments</label>
                                    <textarea name="Validation_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Others Comments</label>
                                    <textarea name="Others_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Group Comments</label>
                                    <textarea name="Group_comments_new"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="group-attachments">Group Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="group_attachments_new"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="group_attachments_new[]"
                                                oninput="addMultipleFiles(this, 'group_attachments_new')" multiple>
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
               

                <!-- Activity Log content -->
                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Plan Proposed By">Plan Proposed By</label>
                                    <input type="hidden" name="plan_proposed_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Plan Proposed On">Plan Proposed On</label>
                                    <input type="hidden" name="plan_proposed_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Plan Approved By">Plan Approved By</label>
                                    <input type="hidden" name="Plan_approved_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Plan Approved On">Plan Approved On</label>
                                    <input type="hidden" name="Plan_approved_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA More Info Required By">QA More Info Required By</label>
                                    <input type="hidden" name="qa_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA More Info Required On">QA More Info Required On</label>
                                    <input type="hidden" name="qa_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Cancelled By">Cancelled By</label>
                                    <input type="hidden" name="cancelled_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Cancelled On">Cancelled On</label>
                                    <input type="hidden" name="cancelled_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Completed By">Completed By</label>
                                    <input type="hidden" name="completed_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Completed On">Completed On</label>
                                    <input type="hidden" name="completed_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved By">Approved By</label>
                                    <input type="hidden" name="approved_by">

                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved On">Approved On</label>
                                    <input type="hidden" name="approved_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Rejected By">Rejected By</label>
                                    <input type="hidden" name="rejected_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Rejected On">Rejected On</label>
                                    <input type="hidden" name="rejected_on">
                                    <div class="static"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <!-- <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                            <button type="submit">Submit</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"
                                    href="#"> Exit </a> </button>
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

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
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

        function setCurrentDate(item) {
            if (item == 'yes') {
                $('#effect_check_date').val('{{ date('d-M-Y') }}');
            } else {
                $('#effect_check_date').val('');
            }
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
