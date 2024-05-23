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

<div id="CCForm19" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            CheckList - Phase II Investigation
        </div>
        <div class="row">
            <div class="col-12">
                <label for="Reference Recores">PHASE II OOS INVESTIGATION </label>
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
                                @if ($phase_two_invs)
                                    @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                        <tr>
                                            <td class="flex text-center">{{ $loop->index+1 }}</td>
                                            <td>{{ $phase_two_inv_question }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="phase_two_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea name="phase_two_inv[{{ $loop->index }}][remarks]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'remarks') }}</textarea>
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