@php
   $istab8 = $data->stage == 8 && (Helpers::check_roles($data->division_id, 'OOS/OOT', 39) || Helpers::check_roles($data->division_id, 'OOS/OOT', 43) || Helpers::check_roles($data->division_id, 'OOS/OOT', 42) || Helpers::check_roles($data->division_id, 'OOS/OOT', 9) || Helpers::check_roles($data->division_id, 'OOS/OOT', 65) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18));
@endphp  
<div id="CCForm8" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            OOS/OOT Conclusion
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion Comments @if($data->stage == 20 || $data->stage == 8) <span class="text-danger">*</span>@endif</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" data-stage="8" name="conclusion_comments_oosc" id="summernote-1"  >
                        {{ $data->conclusion_comments_oosc ?? '' }}
                        </textarea>
                </div>
            </div>


            <!-- ---------------------------grid-1 -------------------------------- -->
           
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments">Specification Limit </label>
                    <input type="text" value="{{$data->specification_limit_oosc}}" name="specification_limit_oosc" {{   $data->stage == 21 ? 'disabled' : '' }}>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">Results to be Reported</label>
                    <select name="results_to_be_reported_oosc" {{  $data->stage == 21 ? 'disabled' : '' }}>
                       <option value="">Enter Your Selection Here</option>
                        <option value="Initial" {{ $data->results_to_be_reported_oosc == 'Initial' ? 'selected' : ''
                            }}>Initial</option>
                            <option value="Retested result"{{ $data->results_to_be_reported_oosc == 'Retested result' ?
                                'selected' : '' }}>Retested Result</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Final Reportable Results</label>
                    <input type="text" name="final_reportable_results_oosc"
                        value="{{ $data->final_reportable_results_oosc ?? '' }}"  {{  $data->stage == 21 ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify for Averaging Results @if($data->stage == 20 ||$data->stage == 8) <span class="text-danger">*</span>@endif</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" data-stage="8" name="justifi_for_averaging_results_oosc" id="summernote-1">
                                {{ $data->justifi_for_averaging_results_oosc ?? '' }}
                            </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">OOS/OOT Stands </label>
                    <select name="oos_stands_oosc"  {{  $data->stage == 21 ? 'disabled' : ''}}>
                       <option value="">Enter Your Selection Here</option>
                        <option value="Valid" {{ $data->oos_stands_oosc == 'Valid' ? 'selected' : '' }}>Valid
                        </option>
                        <option value="Invalid" {{ $data->oos_stands_oosc == 'Invalid' ? 'selected' : '' }}>Invalid
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">CAPA Req.</label>
                    <select name="capa_req_oosc"  {{  $data->stage == 21 ? 'disabled' : '' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->capa_req_oosc == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->capa_req_oosc == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">CAPA Ref No.</label>
                    <select multiple id="reference_record" name="capa_ref_no_oosc[]" {{  $data->stage == 21 ? 'disabled' : '' }}


                        placeholder="Select Reference Records">

                        @if (!empty($capa_record))
                            @foreach ($capa_record as $new)
                                @php
                                    $recordValue =
                                        Helpers::getDivisionName($new->division_id) .
                                        '/CAPA/' .
                                        date('Y') .
                                        '/' .
                                        Helpers::recordFormat($new->record);

                                    // Ensure $data->capa_ref_no_oosc is properly fetched from the DB
                                    $selectedValues = is_string($data->capa_ref_no_oosc)
                                        ? explode(',', $data->capa_ref_no_oosc)
                                        : (is_array($data->capa_ref_no_oosc)
                                            ? $data->capa_ref_no_oosc
                                            : []);

                                    // Check if the recordValue exists in the selected values
                                    $selected = in_array($recordValue, $selectedValues) ? 'selected' : '';
                                @endphp
                                <option value="{{ $recordValue }}" {{ $selected }}>
                                    {{ $recordValue }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if CAPA not required</label>
                    <textarea class="summernote" data-stage="8" name="justify_if_capa_not_required_oosc" id="summernote-1" >
                                {{ $data->justify_if_capa_not_required_oosc ?? '' }}
                            </textarea>
                </div>
            </div>


            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Action On affected batches</label>
                    <textarea class="summernote" data-stage="8" name="action_on_affected_batch" id="summernote-1" >
                            {{ $data->action_on_affected_batch ? $data->action_on_affected_batch : '' }}
                        </textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Reference Recores">Conclusion Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="conclusion_attachment_ocr">

                            @if ($data->conclusion_attachment_ocr)
                            @foreach ($data->conclusion_attachment_ocr as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="conclusion_attachment_ocr[]"
                                oninput="addMultipleFiles(this, 'conclusion_attachment_ocr')" multiple
                                {{ in_array($data->stage, [12, 13, 16, 17, 21, 22, 26, 27]) ? 'disabled' : '' }} >
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
