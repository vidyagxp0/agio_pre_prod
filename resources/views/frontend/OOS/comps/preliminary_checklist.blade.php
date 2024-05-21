@php
    $lab_inv_questions = array(
            "Aliquot and standard solutions preserved",
            "Visual examination (solid and solution) reveals normal or abnormal appearance",
            "The analyst is trained on the method.",
            "Correct test procedure followed e.g. Current Version of standard testing procedure has been used in testing.",
            "Current Validated analytical Method has been used and the data of analytical method validation has been reviewed and found satisfactory.",
            "Correct sample(s) tested.",
            "Sample Integrity maintained, correct container is used in testing.",
            "Assessment of the possibility that the sample contamination (sample left open to air or unattended) has occurred during the testing/ re-testing procedure",
            "All equipment used in the testing is within calibration due period.",
            "Equipment log book has been reviewed and no any failure or malfunction has been reviewed.",
            "Any malfunctioning and / or out of calibration analytical instruments (including glassware) is used.",
            "Whether reference standard / working standard is correct (in terms of appearance, purity, LOD/water content & its storage) and assay values are determined correctly.",
            "Whether test solution / volumetric solution used are properly prepared & standardized.",
            "Review RSD, resolution factor and other parameters required for the suitability of the test system. Check if any out of limit parameters is included in the chromatographic analysis, correctness of the column used previous use of the column.",
            "In the raw data, including chromatograms and spectra; any anomalous or suspect peaks or data has been observed.",
            "Any such type of observation has been observed previously (Assay, Dissolution etc.).",
            "Any unusual or unexpected response observed with standard or test preparations (e.g. whether contamination of equipment by previous sample observed).",
            "System suitability conditions met (those before analysis and during analysis).",
            "Correct and clean pipette / volumetric flasks volumes, glassware used as per recommendation.",
            "Other potentially interfering testing/activities occurring at the time of the test which might lead to OOS.",
            "Review of other data for other batches performed within the same analysis set and any nonconformance observed.",
            "Consideration of any other OOS results obtained on the batch of material under test and any non-conformance observed.",
            "Media/Reagents prepared according to procedure.",
            "All the materials are within the due period of expiry.",
            "Whether, analysis was performed by any other alternate validated procedure",
            "Whether environmental condition is suitable to perform the test.",
            "Interview with analyst to assess knowledge of the correct procedure"
        );
@endphp

<div id="CCForm18" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">CheckList - Preliminary Lab. Investigation </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION REPORT</label>
                </center>
                <div class="group-input">
                    <div class="why-why-chart mx-auto" style="width: 100%">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($checklist_lab_invs)
                                    @foreach ($lab_inv_questions as $index => $lab_inv_question)
                                        <tr>
                                            <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                            <td><input type="text" readonly name="question[]" value="{{ $lab_inv_question }}">
                                            </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_lab_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_lab_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'remark') }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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