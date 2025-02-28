<div id="CCForm2" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Phase IA Investigation </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Workbench Evaluation<span class="text-danger">*</span></label>
                    <div class="col-md-12 4">
                        <div class="group-input">
                            <textarea class="summernote" name="Comments_plidata" value=""
                                id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>{{ $data->Comments_plidata ? $data->Comments_plidata : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data->Form_type == 'OOS_Micro')
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="checklists">Checklists</label>
                    @php
                    $ChecklistData = $data->checklists;

                    if (is_array($ChecklistData) && array_key_exists('0', $ChecklistData) && is_string($ChecklistData[0]) && !empty($ChecklistData[0])) {
                        $selectedChecklist = explode(',', $ChecklistData[0]);
                    } else {
                        $selectedChecklist = is_array($ChecklistData) ? $ChecklistData : [];
                    }
                @endphp

                    <select multiple id="checklists" class="abc" name="checklists[]">
                        {{-- <option value="pH-Viscometer-MP" @if (in_array('pH-Viscometer-MP', $selectedChecklist)) selected @endif>CheckList - pH-Viscometer-MP</option>
                        <option value="Dissolution" @if (in_array('Dissolution', $selectedChecklist)) selected @endif>CheckList - Dissolution</option>
                        <option value="HPLC-GC" @if (in_array('HPLC-GC', $selectedChecklist)) selected @endif>CheckList - HPLC-GC</option>
                        <option value="General-checklist" @if (in_array('General-checklist', $selectedChecklist)) selected @endif>CheckList - General checklist</option>
                        <option value="KF-Potentiometer" @if (in_array('KF-Potentiometer', $selectedChecklist)) selected @endif>CheckList - KF-Potentiometer</option>
                        <option value="RM-PM" @if (in_array('RM-PM', $selectedChecklist)) selected @endif>CheckList - RM-PM Sampling</option> --}}
                        <option value="Bacterial-Endotoxin-Test" @if (in_array('Bacterial-Endotoxin-Test', $selectedChecklist)) selected @endif>Checklist - Bacterial Endotoxin Test</option>
                        <option value="Sterility" @if (in_array('Sterility', $selectedChecklist)) selected @endif>Checklist - Sterility</option>
                        <option value="Water-Test" @if (in_array('Water-Test', $selectedChecklist)) selected @endif>Checklist - Microbial limit test/Bioburden and Water Test</option>
                        <option value="Microbial-assay" @if (in_array('Microbial-assay', $selectedChecklist)) selected @endif>Checklist - Microbial assay</option>
                        <option value="Environmental-Monitoring" @if (in_array('Environmental-Monitoring', $selectedChecklist)) selected @endif>Checklist - Environmental Monitoring</option>
                        <option value="Media-Suitability-Test" @if (in_array('Media-Suitability-Test', $selectedChecklist)) selected @endif>Checklist - Media Suitability Test</option>
                    </select>
                </div>
            </div>
            @else
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="checklists">Checklists</label>
                    @php
                    $ChecklistData = $data->checklists;

                    if (is_array($ChecklistData) && array_key_exists('0', $ChecklistData) && is_string($ChecklistData[0]) && !empty($ChecklistData[0])) {
                        $selectedChecklist = explode(',', $ChecklistData[0]);
                    } else {
                        $selectedChecklist = is_array($ChecklistData) ? $ChecklistData : [];
                    }
                @endphp

                    <select multiple id="checklists" class="abc" name="checklists[]">
                        <option value="pH-Viscometer-MP" @if (in_array('pH-Viscometer-MP', $selectedChecklist)) selected @endif>CheckList - pH-Viscometer-MP</option>
                        <option value="Dissolution" @if (in_array('Dissolution', $selectedChecklist)) selected @endif>CheckList - Dissolution</option>
                        <option value="HPLC-GC" @if (in_array('HPLC-GC', $selectedChecklist)) selected @endif>CheckList - HPLC-GC</option>
                        <option value="General-checklist" @if (in_array('General-checklist', $selectedChecklist)) selected @endif>CheckList - General checklist</option>
                        <option value="KF-Potentiometer" @if (in_array('KF-Potentiometer', $selectedChecklist)) selected @endif>CheckList - KF-Potentiometer</option>
                        <option value="RM-PM" @if (in_array('RM-PM', $selectedChecklist)) selected @endif>CheckList - RM-PM Sampling</option>
                        {{-- <option value="Bacterial-Endotoxin-Test" @if (in_array('Bacterial-Endotoxin-Test', $selectedChecklist)) selected @endif>Checklist - Bacterial Endotoxin Test</option>
                        <option value="Sterility" @if (in_array('Sterility', $selectedChecklist)) selected @endif>Checklist - Sterility</option>
                        <option value="Water-Test" @if (in_array('Water-Test', $selectedChecklist)) selected @endif>Checklist - Microbial limit test/Bioburden and Water Test</option>
                        <option value="Microbial-assay" @if (in_array('Microbial-assay', $selectedChecklist)) selected @endif>Checklist - Microbial assay</option>
                        <option value="Environmental-Monitoring" @if (in_array('Environmental-Monitoring', $selectedChecklist)) selected @endif>Checklist - Environmental Monitoring</option>
                        <option value="Media-Suitability-Test" @if (in_array('Media-Suitability-Test', $selectedChecklist)) selected @endif>Checklist - Media Suitability Test</option> --}}
                    </select>
                </div>
            </div>
                
            @endif
            
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Checklist Outcome</label>
                    <textarea class="summernote" name="justify_if_no_field_alert_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
              {{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : '' }} </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="RootCause">Immediate Action Taken <span class="text-danger">*</span></label>
                    <textarea name="root_comment" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here" {{ $data->stage == 5 ? '' : 'readonly' }}> {{ $data->root_comment }}</textarea>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Delay Justification For Investigation</label>
                    <textarea class="summernote" name="justify_if_no_analyst_int_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                  {{$data && $data->justify_if_no_analyst_int_pli ? $data->justify_if_no_analyst_int_pli : ''}}  </textarea>

                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Analyst Interview Details <span class="text-danger">*</span></label>
                    <textarea class="summernote" name="analyst_interview_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? "required" : "readonly" }}>
                  {{$data && $data->analyst_interview_pli ? $data->analyst_interview_pli : ''}}  </textarea>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Analyst Interview Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachments_pli">
                            @if ($data->file_attachments_pli)
                            @foreach ($data->file_attachments_pli as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attachments_pli[]"
                            oninput="addMultipleFiles(this, 'file_attachments_pli')"
                            {{ $data->stage == 5 ? '' : 'readonly' }}   multiple {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Any Other Cause/Suspected Cause<span class="text-danger">*</span></label>
                    <textarea id="Any_other_cause" name="Any_other_cause" {{ $data->stage == 5 ? "" : "readonly" }}>{{ $data->Any_other_cause }}</textarea>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Any Other Batches Analyzed</label>
                    <textarea id="Any_other_batches" name="Any_other_batches">{{ $data->Any_other_batches }}</textarea>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Details Of Trend</label>
                    <textarea id="details_of_trend" name="details_of_trend">{{ $data->details_of_trend }}</textarea>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Assignable Cause And Rational For Assignable Cause <span class="text-danger">*</span></label>
                    <textarea id="rational_for_assingnable" {{ $data->stage == 5 ? "" : "readonly" }} name="rational_for_assingnable">{{ $data->rational_for_assingnable }}</textarea>
                </div>
            </div>
            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if no Field Alert</label>

                    <textarea class="summernote" name="justify_if_no_field_alert_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                    {{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : '' }} </textarea>
                </div>
            </div> --}}
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary Of Investigation <span class="text-danger">*</span></label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_of_prelim_investiga_plic" {{ $data->stage == 5 ? "" : "readonly" }}
                        id="summernote-1"  {{Helpers::isOOSChemical($data->stage)}} >
                    {{ $data->summary_of_prelim_investiga_plic ? $data->summary_of_prelim_investiga_plic : ''}}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">OOS/OOT Cause Identified<span class="text-danger">*</span></label>
                    <select name="phase_i_investigation_pli" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes"{{ $data->phase_i_investigation_pli ==
                            'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No"{{ $data->phase_i_investigation_pli ==
                            'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Lead Auditor">OOS category </label>
                    <select id="assignableSelect1" name="root_cause_identified_plic" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'disabled' }}>
                        <option value="" {{ $data->root_cause_identified_plic == '' ? 'selected' : '' }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->root_cause_identified_plic == 'yes' ? 'selected' : '' }}>Analyst</option>
                        <option value="no" {{ $data->root_cause_identified_plic == 'no' ? 'selected' : '' }}>Instrument</option>
                    </select>
                </div>
            </div> --}}

            <script>
            document.addEventListener("DOMContentLoaded", function() {
                toggleRootCauseInput(); // Call this on page load to ensure correct display

                function toggleRootCauseInput() {
                    var selectValue = document.getElementById("assignableSelect1").value.toLowerCase(); // Convert to lowercase for consistency
                    var rootCauseGroup1 = document.getElementById("rootCauseGroup1");
                    var rootCauseTextarea = document.getElementById("rootCauseTextarea");

                    if (selectValue === "yes") {
                        rootCauseGroup1.style.display = "block";  // Show the textarea if "yes" is selected
                        rootCauseTextarea.setAttribute('', '');  // Make textarea required
                    } else {
                        rootCauseGroup1.style.display = "none";   // Hide the textarea if "no" is selected
                        rootCauseTextarea.removeAttribute('');  // Remove required attribute
                    }
                }

                // Attach the event listener
                document.getElementById("assignableSelect1").addEventListener("change", toggleRootCauseInput);
            });
            </script>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Team"> OOS/OOT Category<span class="text-danger">*</span></label>
                    <select name="oos_category_root_cause_ident_plic"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Analyst Error"{{ $data->oos_category_root_cause_ident_plic ==
                            'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                        <option value="Instrument Error"{{ $data->oos_category_root_cause_ident_plic ==
                            'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                        <option value="Product/Material Related Error"{{ $data->oos_category_root_cause_ident_plic ==
                            'Product/Material Related Error' ? 'selected' : '' }}>Product/Material Related Error</option>
                        <option value="Other Error"{{ $data->oos_category_root_cause_ident_plic ==
                            'Other Error' ? 'selected' : '' }}>Other Error</option>
                        <option value="NA"{{ $data->oos_category_root_cause_ident_plic ==
                            'NA' ? 'selected' : '' }}>NA</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS/OOT Category(If Others)</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion</small></div>
                    <textarea class="summernote" name="oos_category_others_plic" id="summernote-1"
                        value=""  {{Helpers::isOOSChemical($data->stage)}} > {{ $data->oos_category_others_plic }}
                    </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required <span class="text-danger">*</span></label>
                    <select name="capa_required_plic"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="" {{ $data->capa_required_plic == '0' ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="yes" {{ $data->capa_required_plic == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->capa_required_plic == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" value="{{$data->reference_capa_no_plic}}" name="reference_capa_no_plic" {{ $data->stage == 5 ? '' : 'readonly' }}>
                </div>
            </div>
            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Root Cause Details</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="root_cause_details_plic" id="summernote-1"  {{Helpers::isOOSChemical($data->stage)}}>
                   {{ $data->root_cause_details_plic }}
                </textarea>
                </div>
            </div> --}}
            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Delay Justification for Preliminary Investigation</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="delay_justification_for_pi_plic"
                        id="summernote-1" value="" {{Helpers::isOOSChemical($data->stage)}}>
                     {{ $data->delay_justification_for_pi_plic ? $data->delay_justification_for_pi_plic : ''  }}

                </textarea>
                </div>
            </div> --}}

            {{-- <div class="col-12">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachment </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="supporting_attachment_plic">
                            @if ($data->supporting_attachment_plic)
                            @foreach ($data->supporting_attachment_plic as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif

                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="supporting_attachment_plic[]"
                                oninput="addMultipleFiles(this, 'supporting_attachment_plic')"
                                {{ $data->stage == 5 ? '' : 'disabled' }}  multiple  {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>



                </div>
            </div> --}}
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS/OOT Review For Similar Nature</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="review_comments_plir" id="summernote-1"
                        value="" {{Helpers::isOOSChemical($data->stage)}}>{{  $data->review_comments_plir ?  $data->review_comments_plir : '' }}
                    </textarea>
                </div>
            </div>

            {{-- <div class="sub-head">OOS Review for Similar Nature</div> --}}

            <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
            {{-- <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="oos_capa" {{ $data->stage == 5 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_capa_details" style="width: 100%;" >
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%">OOS Number</th>
                                <th style="width: 14%"> OOS Reported Date</th>
                                <th style="width: 12%">Description of OOS</th>
                                <th style="width: 12%">Previous OOS Root Cause</th>
                                <th style="width: 12%"> CAPA</th>
                                <th style="width: 14% pt-3">Closure Date of CAPA</th>
                                <th style="width: 12%">CAPA Requirement</th>
                                <th style="width: 10%">Reference CAPA Number</th>
                                <th style="widht: 4%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if ($oos_capas)
                               @foreach ($oos_capas->data as $oos_capa)
                                    <tr>
                                        <td><input disabled type="text" name="oos_capa[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" id="info_oos_number" name="oos_capa[{{ $loop->index }}][info_oos_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_number') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input disabled {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_capa[{{ $loop->index }}][info_oos_reported_date]" value="{{ Helpers::getdateFormat($oos_capa['info_oos_reported_date'] ?? '') }}"
                                                     id="info_oos_reported_date_{{ $loop->index }}" placeholder="DD-MM-YYYY" />
                                                    <input type="date" name="oos_capa[{{ $loop->index }}][info_oos_reported_date]" value="{{ $oos_capa['info_oos_reported_date'] ?? '' }}"
                                                    class="hide-input" oninput="handleDateInput(this, 'info_oos_reported_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_capa[{{ $loop->index }}][info_oos_description]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_description') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_capa[{{ $loop->index }}][info_oos_previous_root_cause]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_previous_root_cause') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input disabled  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_capa[{{ $loop->index }}][info_oos_closure_date]" value="{{ Helpers::getdateFormat($oos_capa['info_oos_closure_date'] ?? '') }}"
                                                       id="info_oos_closure_date_{{ $loop->index }}"  placeholder="DD-MM-YYYY" />
                                                    <input type="date" name="oos_capa[{{ $loop->index }}][info_oos_closure_date]" value="{{ $oos_capa['info_oos_closure_date'] ?? '' }}"
                                                    class="hide-input" oninput="handleDateInput(this, 'info_oos_closure_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                            <select name="oos_capa[{{ $loop->index }}][info_oos_capa_requirement]" {{Helpers::isOOSChemical($data->stage)}}>
                                                <option vlaue="">--select--</option>
                                                <option value="yes" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa_reference_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_reference_number') }}" {{Helpers::isOOSChemical($data->stage)}}></td>
                                        <td><button type="text" class="removeRowBtn" {{Helpers::isOOSChemical($data->stage)}}>Remove</button></td>
                                    </tr>
                               @endforeach
                           @endif
                        </tbody>
                    </table>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase IB Inv. Required? <span class="text-danger">*</span></label>
                    <select name="phase_ib_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_ib_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_ib_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase II Inv. Required? <span class="text-danger">*</span></label>
                    <select name="phase_ii_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_ii_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_ii_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Retest/Re-measurement Required <span class="text-danger">*</span></label>
                    <select name="root_cause_identified_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->root_cause_identified_pia == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->root_cause_identified_pia == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Resampling Required <span class="text-danger">*</span></label>
                    <select name="is_repeat_assingable_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="YES" {{ $data && $data->is_repeat_assingable_pia == 'YES' ?
                            'selected' : '' }}>Yes</option>
                        <option value="NO" {{ $data && $data->is_repeat_assingable_pia == 'NO' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Repeat Testing Required <span class="text-danger">*</span></label>
                    <select name="repeat_testing_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 5 ? '' : 'readonly' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="YES" {{ $data && $data->repeat_testing_pia == 'YES' ?
                            'selected' : '' }}>Yes</option>
                        <option value="NO" {{ $data && $data->repeat_testing_pia == 'NO' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Results Of Retest/Re-Measurement</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion </small></div>
                    <textarea class="summernote" name="Description_Deviation" id="summernote-1" {{ $data->stage == 5 ? '' : 'readonly' }}
                        value=""  {{Helpers::isOOSChemical($data->stage)}} >{{ $data->Description_Deviation ? $data->Description_Deviation : '' }}
                    </textarea>
                </div>
            </div>

            
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Results Of Repeat Testing <span class="text-danger">*</span></label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion </small></div>
                    <textarea class="summernote" name="result_of_repeat" id="summernote-1" {{ $data->stage == 5 ? '' : 'readonly' }}
                        value=""  {{Helpers::isOOSChemical($data->stage)}} >{{ $data->result_of_repeat ? $data->result_of_repeat : '' }}
                    </textarea>
                </div>
            </div>


            <!-- <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Results Of Repeat Testing</label>
                    <textarea id="result_of_repeat" name="result_of_repeat">{{ $data->result_of_repeat }}</textarea>
                </div>
            </div> -->
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Impact Assessment <span class="text-danger">*</span></label>
                    <textarea id="impact_assesment_pia"  name="impact_assesment_apia" {{ $data->stage == 5 ? '' : 'readonly' }}>{{ $data->impact_assesment_pia }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachments</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="supporting_attachments_plir">
                            @if ($data->supporting_attachments_plir)
                            @foreach ($data->supporting_attachments_plir as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif

                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                oninput="addMultipleFiles(this, 'supporting_attachments_plir')" {{ $data->stage == 5 ? '' : 'readonly' }} multiple {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>

                </div>
            </div>

            <div class="button-block">
                @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                @else
                <button type="submit" class="saveButton">Save</button>
                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                @endif
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
            </div>
        </div>
    </div>

</div>
