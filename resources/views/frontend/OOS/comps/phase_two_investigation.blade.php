@php
    $phase_two_inv_questions = array(
        "Is correct batch manufacturing record used?",
        "Correct quantities of correct ingredients were used in manufacturing?",
        "Balances used in dispensing / verification were calibrated using valid standard weights?",
        "Equipment used in the manufacturing is as per batch manufacturing record?",
        "Processing steps followed in correct sequence as per the BMR?",
        "Whether material used in the batch had any OOS result?",
        "All the processing parameters were within the range specified in BMR?",
        "Environmental conditions during manufacturing are as per BMR?",
        "Whether there was any deviation observed during manufacturing?",
        "The yields at different stages were within the acceptable range as per BMR?",
        "All the equipment’s used during manufacturing are calibrated?",
        "Whether there is malfunctioning or breakdown of equipment during manufacturing?",
        "Whether the processing equipment was maintained as per preventive maintenance schedule?",
        "All the in-process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
        "Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
        "Whether other batches/products impacted?",
        "Any Other"
    );

@endphp
@php
    $istab13 = $data->stage == 13 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18));
@endphp
<div id="CCForm5" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            CheckList - Phase II Investigation
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    @if($data->Form_type == 'OOT')
                    <label style="font-weight: bold;" for="Audit Attachments">PHASE II OOT INVESTIGATION</label>
                    @else
                    <label style="font-weight: bold;" for="Audit Attachments">PHASE II OOS INVESTIGATION</label>
                    @endif
               </center>
               <!-- <label for="Reference Recores"> </label> -->
               <div class="group-input">
                   <div class="why-why-chart">
                       <table class="table table-bordered">
                           <thead>
                               <tr>
                                   <th style="width: 5%;">Sr.No.</th>
                                   <th style="width: 40%;">Question</th>
                                   <th style="width: 20%;">Response</th>
                                   <th>Remarks</th>
                               </tr>
                           </thead>
                           <tbody>
                               @if ($phase_two_invss)
                                   @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                       <tr>
                                           <td class="flex text-center">{{ $loop->index+1 }}</td>
                                           <td>{{ $phase_two_inv_question }}</td>
                                           <td>
                                               <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                {{-- <select {{Helpers::isOOSChemical($data->stage)}} name="phase_two_inv1[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    <option value="">Select an Option</option>

                                                    @php
                                                        $dataItem = $phase_two_invss->data[$loop->index] ?? null;
                                                    @endphp

                                                    <option value="Yes" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                    <option value="N/A" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                </select> --}}

                                                @php
                                                    $dataItem = $phase_two_invss->data[$loop->index] ?? null;
                                                    $response = isset($dataItem) ? Helpers::getArrayKey($dataItem,'response') : null;
                                                @endphp

                                                <select {{Helpers::isOOSChemical($data->stage)}}
                                                name="phase_two_inv1[{{ $loop->index }}][response]"
                                                style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">

                                                <option value="Yes"
                                                {{ $response == 'Yes' ? 'selected' : '' }}>
                                                Yes
                                                </option>

                                                <option value="No"
                                                {{ $response == 'No' ? 'selected' : '' }}>
                                                No
                                                </option>

                                                <option value="N/A"
                                                {{ !$response || $response == 'N/A' ? 'selected' : '' }}>
                                                NA
                                                </option>

                                                </select>
                                               </div>
                                           </td>
                                           <td>
                                            @php
                                                $dataItem = $phase_two_invss->data[$loop->index] ?? null;
                                                $remarks = isset($dataItem) ? Helpers::getArrayKey($dataItem, 'remarks') : '';
                                            @endphp

                                            <textarea {{Helpers::isOOSChemical($data->stage)}} name="phase_two_inv1[{{ $loop->index }}][remarks]" style="border-radius: 7px; border: 1.5px solid black;">{{ $remarks }}</textarea>
                                        </td>
                                       </tr>
                                   @endforeach
                               @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
            <div class="col-lg-12 new-time-data-field">
                <div class="group-input input-time">

                    {!! quillEditor(
                        'checklist_outcome_iia',
                        $data->checklist_outcome_iia,

                        '
                        <label>
                            Checklist Outcome
                        </label>
                        ',

                        !$istab13
                    ) !!}

                </div>
            </div>
            <div class="sub-head">
                Phase II A Investigation
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Assigned To">Production Head Person</label>
                    <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                        name="production_head_person" placeholder="Select Production Head" {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? '' : 'disabled' }}>
                        <option value="">-- Select --</option>
                        @if (!empty(Helpers::getProductionHeadDropdown()))
                            @foreach (Helpers::getProductionHeadDropdown() as $listPersoneHead)
                                <option value="{{ $listPersoneHead['id'] }}"
                                    @if ($listPersoneHead['id'] == $data->production_head_person) selected @endif>
                                    {{ $listPersoneHead['name'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @if ($data->stage != 13)
                        <input type="hidden" value="{{$data->production_head_person}}" name="production_head_person">
                    @endif
                </div>
            </div>
            <div class="col-md-12 mb-4">
                {!! quillEditor(
                    'qa_approver_comments_piii',
                    $data->qa_approver_comments_piii ? $data->qa_approver_comments_piii : "",

                    '
                    <label for="Description Deviation">
                        Immediate Action Taken
                    </label>
                    ',

                    !$istab13
                ) !!}
            </div>

            <div class="col-md-12 mb-4">
                {!! quillEditor(
                    'reason_manufacturing_delay',
                    $data->reason_manufacturing_delay ? $data->reason_manufacturing_delay : "",

                    '
                    <label for="Description Deviation">
                        Delay Justification For Investigation
                    </label>
                    ',

                    !$istab13
                ) !!}
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Audit Attachments">Manufacturing Operater Interview Details</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachments_pII">
                        @if ($data->file_attachments_pII)
                            @foreach ($data->file_attachments_pII as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:4px;"></i></a>
                                 <a type="button"
                                    class="remove-file"
                                    data-field-name="file_attachments_pII"
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
                            <input type="file" id="myfile" name="file_attachments_pII[]"
                                oninput="addMultipleFiles(this, 'file_attachments_pII')" {{ $istab13 ? '' : 'disabled' }} multiple>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                {!! quillEditor(
                    'audit_comments_piii',
                    $data->audit_comments_piii ? $data->audit_comments_piii : "",

                    '
                    <label for="Audit Comments">
                        Any Other Cause/Suspected Cause
                    </label>
                    ',

                    $data->stage != 13
                ) !!}
            </div>

            <div class="col-lg-12">
                {!! quillEditor(
                    'hypo_exp_reference_piii',
                    $data->hypo_exp_reference_piii ? $data->hypo_exp_reference_piii : "",

                    '
                    <label for="Reference Recores">
                        Summary Investigation
                    </label>
                    ',

                    !$istab13
                ) !!}
            </div>
            <div class="col-lg-6">
                <div class="group-input">

                    @if ($data->Form_type == 'OOT')
                    <label for="Report Attachments">OOT Cause Identified II A</label>
                    @else
                    <label for="Report Attachments">OOS Cause Identified II A</label>
                    @endif
                    <select name="manufact_invest_required_piii" {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->manufact_invest_required_piii === 'Yes' ? 'selected' :
                                '' }}>Yes</option>
                        <option value="No" {{ $data->manufact_invest_required_piii === 'No' ? 'selected' : ''
                                }}>No</option>
                    </select>
                    @if ($data->stage != 13)
                        <input type="hidden" value="{{$data->manufact_invest_required_piii}}" name="manufact_invest_required_piii">
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    @if ($data->Form_type == 'OOT')
                    <label for="Audit Attachments">OOT Category II A</label>
                    @else
                    <label for="Audit Attachments">OOS Category II A</label>
                    @endif
                    <select name="hypo_exp_required_piii" {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Analyst Error"{{ $data->hypo_exp_required_piii ==
                            'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                        <option value="Instrument Error"{{ $data->hypo_exp_required_piii ==
                            'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                        <option value="Product/Material Related Error"{{ $data->hypo_exp_required_piii ==
                            'Product/Material Related Error' ? 'selected' : '' }}>Product/Material Related Error</option>
                        <option value="Human Error"{{ $data->hypo_exp_required_piii ==
                            'Human Error' ? 'selected' : '' }}>Human Error</option>
                        <option value="Operator Error"{{ $data->hypo_exp_required_piii ==
                            'Operator Error' ? 'selected' : '' }}>Operator Error</option>
                        <option value="Other Error"{{ $data->hypo_exp_required_piii ==
                            'Other Error' ? 'selected' : '' }}>Other Error</option>
                        <option value="NA"{{ $data->hypo_exp_required_piii ==
                            'NA' ? 'selected' : '' }}>NA</option>
                    </select>
                    @if ($data->stage != 13)
                        <input type="hidden" value="{{$data->hypo_exp_required_piii}}" name="hypo_exp_required_piii">
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    @if ($data->form_type == 'OOT')
                    <label for="Audit Preparation Completed On">OOT Category If Others</label>
                    @else
                    <label for="Audit Preparation Completed On">OOS Category If Others</label>
                    @endif
                    <input type="text" name="if_others_oos_category"
                        value="{{$data->if_others_oos_category}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required</label>
                    <select name="capa_required_iia"  {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? '' : 'disabled' }}>
                        <option value="" {{ $data->capa_required_iia == '0' ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="yes" {{ $data->capa_required_iia == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->capa_required_iia == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @if ($data->stage != 13)
                        <input type="hidden" value="{{$data->capa_required_iia}}" name="capa_required_iia">
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" value="{{$data->reference_capa_no_iia}}" name="reference_capa_no_iia" {{ $istab13 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    @if($data->Form_type == 'OOT')
                    <label for="Details of Obvious Error">OOT Review For Similar Nature II A</label>
                    @else
                    <label for="Details of Obvious Error">OOS Review For Similar Nature II A</label>
                    @endif
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="OOS_review_similar" value="{{ $data->OOS_review_similar }}" {{ $istab13 ? '' : 'readonly' }}>
                </div>
            </div>


            <div class="col-md-12 mb-4">
                {!! quillEditor(
                    'impact_assessment_IIA',
                    $data->impact_assessment_IIA ? $data->impact_assessment_IIA : "",

                    '
                    <label for="Description Deviation">
                       Impact Assessment.
                    </label>
                    ',

                    !$istab13
                ) !!}
            </div>
            <!-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Impact Assessment.</label>
                    <textarea class="summernote" name="impact_assessment_IIA" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                  {{$data->impact_assessment_IIA ? $data->impact_assessment_IIA : ""}}
                </textarea>
                </div>
            </div> -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase IIB Inv. Required? <span class="text-danger">*</span></label>
                    <select name="phase_iib_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $istab13 ? 'required' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_iib_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_iib_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                    @if ($data->stage != 13)
                        <input type="hidden" value="{{$data->phase_iib_inv_required_plir}}" name="phase_iib_inv_required_plir">
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Lead More Info Reqd On">II A Inv. Supporting Attachments</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="attachments_piiqcr">

                            @if ($data->attachments_piiqcr)
                            @foreach($data->attachments_piiqcr as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:4px;"></i></a>
                                <a type="button"
                                        class="remove-file"
                                        data-field-name="attachments_piiqcr"
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
                            <input type="file" id="myfile" name="attachments_piiqcr[]"
                                oninput="addMultipleFiles(this, 'attachments_piiqcr')" {{ $istab13 ? '' : 'disabled' }} multiple {{Helpers::isOOSChemical($data->stage)}}>
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
