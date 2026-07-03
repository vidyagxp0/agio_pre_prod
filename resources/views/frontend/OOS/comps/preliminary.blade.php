@php
    $istab5 = $data->stage == 5 && (($data->initiator_id == Auth::user()->id) ||(Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)));
@endphp
<div id="CCForm2" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Phase IA Investigation </div>
        <div class="row">
            {{-- <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Workbench Evaluation<span class="text-danger">*</span></label>
                    <div class="col-md-12 4">
                        <div class="group-input">
                            <textarea class="summernote" data-stage="5" name="Comments_plidata" value=""
                                id="summernote-1" {{Helpers::isOOSChemical($data->stage)}} >{{ $data->Comments_plidata ? $data->Comments_plidata : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'Comments_plidata',
                    $data->Comments_plidata,

                    '
                    <label>
                        Workbench Evaluation <span class="text-danger">*</span>

                        <small class="text-primary d-block">
                            Please insert "NA" in the data field if it does not require completion
                        </small>
                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('Comments_plidata')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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

                    <select multiple id="checklists" class="abc" name="checklists[]" {{ $istab5 ? '' : 'disabled' }}>
                        <option value="Bacterial-Endotoxin-Test" @if (in_array('Bacterial-Endotoxin-Test', $selectedChecklist)) selected @endif>Checklist - Bacterial Endotoxin Test</option>
                        <option value="Sterility" @if (in_array('Sterility', $selectedChecklist)) selected @endif>Checklist - Sterility</option>
                        <option value="Water-Test" @if (in_array('Water-Test', $selectedChecklist)) selected @endif>Checklist - Microbial limit test/Bioburden and Water Test</option>
                        <option value="Microbial-assay" @if (in_array('Microbial-assay', $selectedChecklist)) selected @endif>Checklist - Microbial assay</option>
                        <option value="Environmental-Monitoring" @if (in_array('Environmental-Monitoring', $selectedChecklist)) selected @endif>Checklist - Environmental Monitoring</option>
                        <option value="Media-Suitability-Test" @if (in_array('Media-Suitability-Test', $selectedChecklist)) selected @endif>Checklist - Media Suitability Test</option>
                    </select>
                    @if($data->stage != 5)
                        @foreach($selectedChecklist as $value)
                            <input type="hidden" name="checklists[]" value="{{ $value }}">
                        @endforeach
                    @endif

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

                    <select multiple id="checklists" class="abc" name="checklists[]" {{ $istab5 ? '' : 'disabled' }}>
                        <option value="pH-Viscometer-MP" @if (in_array('pH-Viscometer-MP', $selectedChecklist)) selected @endif>CheckList - pH-Viscometer-MP</option>
                        <option value="Dissolution" @if (in_array('Dissolution', $selectedChecklist)) selected @endif>CheckList - Dissolution</option>
                        <option value="HPLC-GC" @if (in_array('HPLC-GC', $selectedChecklist)) selected @endif>CheckList - HPLC-GC</option>
                        <option value="General-checklist" @if (in_array('General-checklist', $selectedChecklist)) selected @endif>CheckList - General checklist</option>
                        <option value="KF-Potentiometer" @if (in_array('KF-Potentiometer', $selectedChecklist)) selected @endif>CheckList - KF-Potentiometer</option>
                        <option value="RM-PM Sampling" @if (in_array('RM-PM Sampling', $selectedChecklist)) selected @endif>CheckList - RM-PM Sampling</option>
                    </select>
                    @if($data->stage != 5)
                        @foreach($selectedChecklist as $value)
                            <input type="hidden" name="checklists[]" value="{{ $value }}">
                        @endforeach
                    @endif

                </div>
            </div>

            @endif

            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Checklist Outcome</label>
                    <textarea class="summernote" data-stage="5" name="justify_if_no_field_alert_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
              {{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : '' }} </textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'justify_if_no_field_alert_pli',
                    $data->justify_if_no_field_alert_pli,

                    '
                    <label>
                        Checklist Outcome <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('justify_if_no_field_alert_pli')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="RootCause">Immediate Action Taken <span class="text-danger">*</span></label>
                    <textarea name="root_comment" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here" {{ $data->stage == 5 ? '' : 'readonly' }}> {{ $data->root_comment }}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'root_comment',
                    $data->root_comment,

                    '
                    <label>
                        Immediate Action Taken <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('root_comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Delay Justification For Investigation</label>
                    <textarea class="summernote" data-stage="5" name="justify_if_no_analyst_int_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                  {{$data && $data->justify_if_no_analyst_int_pli ? $data->justify_if_no_analyst_int_pli : ''}}  </textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'justify_if_no_analyst_int_pli',
                    $data->justify_if_no_analyst_int_pli,

                    '
                    <label>
                        Delay Justification For Investigation <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('justify_if_no_analyst_int_pli')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Analyst Interview Details <span class="text-danger">*</span></label>
                    <textarea class="summernote" data-stage="5" name="analyst_interview_pli" value=""
                        id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                  {{$data && $data->analyst_interview_pli ? $data->analyst_interview_pli : ''}}  </textarea>

                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'analyst_interview_pli',
                    $data->analyst_interview_pli,

                    '
                    <label>
                        Analyst Interview Details <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('analyst_interview_pli')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
                                        style="font-size:20px; margin-right:4px;"></i></a>
                                <!-- <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a> -->

                                    <a type="button"
                                                class="remove-file"
                                                data-field-name="file_attachments_pli"
                                                data-file-name="{{ $file }}">
                                                    <i class="fa-solid fa-circle-xmark"
                                                    style="color:red; font-size:20px;"></i>
                                            </a>
                            </h6>
                            @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attachments_pli[]"
                            oninput="addMultipleFiles(this, 'file_attachments_pli')"
                            {{ $istab5 ? '' : 'disabled' }}   multiple {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Any Other Cause/Suspected Cause<span class="text-danger">*</span></label>
                    <textarea class="summernote" data-stage="5" id="summernote-1" name="Any_other_cause">{{ $data->Any_other_cause }}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'Any_other_cause',
                    $data->Any_other_cause,

                    '
                    <label>
                        Any Other Cause/Suspected Cause <span class="text-danger">*</span>
                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('Any_other_cause')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Any Other Batches Analyzed</label>
                    <textarea class="summernote" data-stage="5" id="summernote-1" name="Any_other_batches">{{ $data->Any_other_batches }}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'Any_other_batches',
                    $data->Any_other_batches,

                    '
                    <label>
                        Any Other Batches Analyzed <span class="text-danger">*</span>
                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('Any_other_batches')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Details Of Trend</label>
                    <textarea class="summernote" data-stage="5" id="summernote-1" name="details_of_trend">{{ $data->details_of_trend }}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'details_of_trend',
                    $data->details_of_trend,

                    '
                    <label>
                        Details Of Trend <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('details_of_trend')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time ">
                    <label for="deviation_time">Assignable Cause And Rational For Assignable Cause <span class="text-danger">*</span></label>
                    <textarea class="summernote" data-stage="5" id="summernote-1" name="rational_for_assingnable">{{ $data->rational_for_assingnable }}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'rational_for_assingnable',
                    $data->rational_for_assingnable,

                    '
                    <label>
                        Assignable Cause And Rational For Assignable Cause <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('rational_for_assingnable')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary Of Investigation <span class="text-danger">*</span></label>
                    <textarea class="summernote" data-stage="5" name="summary_of_prelim_investiga_plic"
                        id="summernote-1"  {{Helpers::isOOSChemical($data->stage)}} >
                    {{ $data->summary_of_prelim_investiga_plic ? $data->summary_of_prelim_investiga_plic : ''}}</textarea>
                </div>
            </div> --}}

            <div class="col-md-12">
                {!! quillEditor(
                    'summary_of_prelim_investiga_plic',
                    $data->summary_of_prelim_investiga_plic,

                    '
                    <label>
                        Summary Of Investigation <span class="text-danger">*</span>

                    </label>
                    ',

                    $data->stage != 5 || !$istab5
                ) !!}
                @error('summary_of_prelim_investiga_plic')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    @if ($data->Form_type == 'OOT')
                    <label for="Product/Material Name">OOT Cause Identified<span class="text-danger">*</span></label>
                    @else
                    <label for="Product/Material Name">OOS Cause Identified<span class="text-danger">*</span></label>
                    @endif
                    <select name="phase_i_investigation_pli" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes"{{ $data->phase_i_investigation_pli ==
                            'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No"{{ $data->phase_i_investigation_pli ==
                            'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                    @if ($data->stage != 5)
                        <input type="hidden" value="{{$data->phase_i_investigation_pli}}" name="phase_i_investigation_pli">
                    @endif            
            </div>

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
                    @if ($data->Form_type == 'OOT')
                    <label for="Audit Team">OOT Category<span class="text-danger">*</span></label>
                    @else
                    <label for="Audit Team"> OOS Category<span class="text-danger">*</span></label>
                    @endif
                    <select name="oos_category_root_cause_ident_plic"  {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
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
                    @if ($data->stage != 5)
                        <input type="hidden" value="{{$data->oos_category_root_cause_ident_plic}}" name="oos_category_root_cause_ident_plic">
                    @endif            
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    {{-- @if($data->Form_type == 'OOT')
                    <label for="Description Deviation">OOT Category(If Others)</label>
                    @else
                    <label for="Description Deviation">OOS Category(If Others)</label>
                    @endif
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion</small></div>
                    <textarea class="summernote" data-stage="5" name="oos_category_others_plic" id="summernote-1"
                        value=""  {{Helpers::isOOSChemical($data->stage)}} > {{ $data->oos_category_others_plic }}
                    </textarea> --}}

                    {!! quillEditor(
                        'oos_category_others_plic',
                        $data->oos_category_others_plic,

                        '
                        <label>
                            ' . ($data->Form_type == "OOT" ? "OOT Category(If Others)" : "OOS Category(If Others)") . '
                        </label>

                        <div>
                            <small class="text-primary">
                                Please insert "NA" in the data field if it does not require completion
                            </small>
                        </div>
                        ',

                        $data->stage != 5 || !$istab5
                    ) !!}

                    @error('oos_category_others_plic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required <span class="text-danger">*</span></label>
                    <select name="capa_required_plic"  {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="" {{ $data->capa_required_plic == '0' ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="yes" {{ $data->capa_required_plic == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->capa_required_plic == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
                    @if ($data->stage != 5)
                        <input type="hidden" value="{{$data->capa_required_plic}}" name="capa_required_plic">
                    @endif
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" value="{{$data->reference_capa_no_plic}}" name="reference_capa_no_plic" {{ $istab5 ? '' : 'readonly' }}>
                </div>
            </div>


            <div class="col-md-12 mb-4">
                <div class="group-input">

                    {!! quillEditor(
                        'review_comments_plir',
                        $data->review_comments_plir ? $data->review_comments_plir : '',

                        '
                        <label>
                            ' . ($data->Form_type == "OOT"
                                ? "OOT Review For Similar Nature"
                                : "OOS Review For Similar Nature") . '
                        </label>
                        ',

                        $data->stage != 5 || !$istab5
                    ) !!}

                </div>
            </div>

            {{-- <div class="sub-head">OOS Review for Similar Nature</div> --}}

            <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
            
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase IB Inv. Required? <span class="text-danger">*</span></label>
                    <select name="phase_ib_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_ib_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_ib_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
                @if ($data->stage != 5)
                    <input type="hidden" value="{{$data->phase_ib_inv_required_plir}}" name="phase_ib_inv_required_plir">
                @endif
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase II Inv. Required? <span class="text-danger">*</span></label>
                    <select name="phase_ii_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_ii_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_ii_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                        <option value="na" {{ $data && $data->phase_ii_inv_required_plir == 'na' ?
                            'selected' : '' }}>NA</option>
                    </select>
                </div>
                @if ($data->stage != 5)
                    <input type="hidden" value="{{$data->phase_ii_inv_required_plir}}" name="phase_ii_inv_required_plir">
                @endif
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Retest/Re-measurement Required <span class="text-danger">*</span></label>
                    <select name="root_cause_identified_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->root_cause_identified_pia == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->root_cause_identified_pia == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
                @if ($data->stage != 5)
                    <input type="hidden" value="{{$data->root_cause_identified_pia}}" name="root_cause_identified_pia">
                @endif
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Resampling Required <span class="text-danger">*</span></label>
                    <select name="is_repeat_assingable_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="YES" {{ $data && $data->is_repeat_assingable_pia == 'YES' ?
                            'selected' : '' }}>Yes</option>
                        <option value="NO" {{ $data && $data->is_repeat_assingable_pia == 'NO' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
                {{-- <input type="hidden" name="is_repeat_assingable_pia" value="{{ $data->is_repeat_assingable_pia }}"> --}}
                @if ($data->stage != 5)
                    <input type="hidden" value="{{$data->is_repeat_assingable_pia}}" name="is_repeat_assingable_pia">
                @endif
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Repeat Testing Required <span class="text-danger">*</span></label>
                    <select name="repeat_testing_pia" {{Helpers::isOOSChemical($data->stage)}} {{ $istab5 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="YES" {{ $data && $data->repeat_testing_pia == 'YES' ?
                            'selected' : '' }}>Yes</option>
                        <option value="NO" {{ $data && $data->repeat_testing_pia == 'NO' ?
                            'selected' : '' }}>No</option>
                        <option value="NA" {{ $data && $data->repeat_testing_pia == 'NA' ?
                            'selected' : '' }}>NA</option>    
                    </select>
                </div>
                {{-- <input type="hidden" name="repeat_testing_pia" value="{{ $data->repeat_testing_pia }}"> --}}
                @if ($data->stage != 5)
                    <input type="hidden" value="{{$data->repeat_testing_pia}}" name="repeat_testing_pia">
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">

                    {!! quillEditor(
                        'Description_Deviation',
                        $data->Description_Deviation ? $data->Description_Deviation : '',

                        '
                        <label>
                            Results Of Retest/Re-Measurement
                        </label>

                        <div>
                            <small class="text-primary">
                                Please insert "NA" in the data field if it does not require completion
                            </small>
                        </div>
                        ',

                        $data->stage != 5 || !$istab5
                    ) !!}

                </div>
            </div>


            <div class="col-md-12 mb-4">
                <div class="group-input">

                    {!! quillEditor(
                        'result_of_repeat',
                        $data->result_of_repeat ? $data->result_of_repeat : '',

                        '
                        <label>
                            Results Of Repeat Testing <span class="text-danger">*</span>
                        </label>

                        <div>
                            <small class="text-primary">
                                Please insert "NA" in the data field if it does not require completion
                            </small>
                        </div>
                        ',

                        $data->stage != 5 || !$istab5
                    ) !!}

                </div>
            </div>


            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time">

                    {!! quillEditor(
                        'impact_assesment_pia',
                        $data->impact_assesment_pia,

                        '
                        <label>
                            Impact Assessment <span class="text-danger">*</span>
                        </label>
                        ',

                        $data->stage != 5 || !$istab5
                    ) !!}

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
                                        style="font-size:20px; margin-right:4px;"></i></a>
                                <!-- <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a> -->

                                <a type="button"
                                            class="remove-file"
                                            data-field-name="supporting_attachments_plir"
                                            data-file-name="{{ $file }}">
                                                <i class="fa-solid fa-circle-xmark"
                                                style="color:red; font-size:20px;"></i>
                                        </a>
                            </h6>
                            @endforeach
                            @endif

                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                oninput="addMultipleFiles(this, 'supporting_attachments_plir')" {{ $istab5 ? '' : 'disabled' }} multiple {{Helpers::isOOSChemical($data->stage)}}>
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
