<div id="CCForm4" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Preliminary Lab Invstigation Review</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Review Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="review_comments_plir" id="summernote-1"
                        value="">{{  $data->review_comments_plir ?  $data->review_comments_plir : '' }}
                    </textarea>
                </div>
            </div>

            <div class="sub-head">OOS Review for Similar Nature</div>

            <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="oos_capa">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_capa_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%">OOS Number</th>
                                <th style="width: 8%"> OOS Reported Date</th>
                                <th style="width: 12%">Description of OOS</th>
                                <th style="width: 16%">Previous OOS Root Cause</th>
                                <th style="width: 16%"> CAPA</th>
                                <th style="width: 16% pt-3">Closure Date of CAPA</th>
                                <th style="width: 16%">CAPA Requirement</th>
                                <th style="width: 16%">Reference CAPA Number</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if ($oos_capas)
                               @foreach ($oos_capas->data as $oos_capa)
                                    <tr>
                                        <td><input disabled type="text" name="oos_capa[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input type="text" id="info_oos_number" name="oos_capa[{{ $loop->index }}][info_oos_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_number') }}"></td>
                                        <td><input type="date" name="oos_capa[{{ $loop->index }}][info_oos_reported_date]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_reported_date') }}"></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_description]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_description') }}"></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_previous_root_cause]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_previous_root_cause') }}"></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa') }}"></td>
                                        <td><input type="date" name="oos_capa[{{ $loop->index }}][info_oos_closure_date]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_closure_date') }}"></td>
                                        <td><select name="oos_capa[{{ $loop->index }}][info_oos_capa_requirement]">
                                                <option value="yes" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'No' ? 'selected' : '' }}>No</option>
                                            </select></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa_reference_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_reference_number') }}"></td> 
                                    </tr>
                               @endforeach
                           @endif
                            

                            {{-- <td><input disabled type="text" name="serial[]" value="1"></td>
                            <td><input type="text" name="Number[]"></td>
                            <td><input type="text" name="Name[]"></td>
                            <td><input type="text" name="Remarks[]"></td>
                            <td><input type="text" name="Number[]"></td>
                            <td><input type="text" name="Name[]"></td>
                            <td><input type="text" name="Remarks[]"></td>
                            <td><select name="CAPARequirement[]">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select></td>
                            <td><input type="text" name="Name[]"></td> --}}


                        </tbody>

                    </table>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase II Inv. Required?</label>
                    <select name="phase_ii_inv_required_plir">
                        <option value="0" {{ $data && $data->phase_ii_inv_required_plir == '0' ?
                            'selected' : '' }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_ii_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_ii_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachments</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach">


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
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                        </div>
                    </div>

                </div>
            </div>

            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                <button type="button" id="ChangeNextButton" class="nextButton"
                    onclick="nextStep()">Next</button>
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                        Exit </a> </button>
            </div>
        </div>
    </div>
</div>