<div id="CCForm18" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Analyst Training and Procedure
                </div>
@php
    $check_analyst_training_procedures = [
    [
        'question' => "Is the analyst trained/qualified BET test procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Reference procedure number :-",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Effective date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Were appropriate precaution taken by the analyst throughout the test?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Analyst interview record",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Analyst interview record",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

@endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($check_analyst_training_procedures as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="analyst_training_proce[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="analyst_training_proce[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="analyst_training_proce[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="analyst_training_proce[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'analyst_training_proce', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Sample receiving & verification in lab : </div>
                        @php
                           $sample_receiving_verifications = [
    [
        'question' => "Was the sample container (Physical integrity) verified at the time of sample receipt?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the correct quantity of the sample withdrawn?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any discrepancy observed during sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the sample container (Physical integrity) checked before testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];


                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($sample_receiving_verifications as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sample_receiving_verification_lab[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sample_receiving_verification_lab[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sample_receiving_verification_lab[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sample_receiving_verification_lab[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'sample_receiving_verification_lab', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Method/Procedure used during analysis: </div>
                     @php
                       $method_procedure_used_during_anas = [
    [
        'question' => "Was correct applicable specification/Test procedure/MOA used for analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Verified specification/Test procedure/MOA No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the test procedure followed as per method validation?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any change in the validated change method? If yes, was test performed with the new validated method?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was BET reagents (Lysate, CSE, LRW and Buffer) procured from the approved vendor?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was lysate and CSE stored at the recommended temperature and duration? Storage condition:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were all product/reagents contact parts of BET testing (Tips/Accessories/Sample Container) depyrogenated?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Assay tube/Batch No.",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Expiry date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Tip lot/Batch No.",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Expiry date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the test done at correct MVD as per validated method?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were calculations of MVD/Test dilution done correctly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were correct dilutions prepared?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was labeled claim lysate sensitivity checked before the use of the lot?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were all reagents (LRW/CSE and Lysate) used in the test within the expiry?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "LRW expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "CSE expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Lysate expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Buffer expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was рН of the test sample/dilution verified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were appropriate рН strip/measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were proper incubation conditions followed?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any spillage that occurred during the vortexing of dilutions?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the results of positive, negative, and test controls found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is the test incubator/heating block kept on a vibration-free surface?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                         @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($method_procedure_used_during_anas as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="method_procedure_used_during_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="method_procedure_used_during_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="method_procedure_used_during_analysis[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="method_procedure_used_during_analysis[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'method_procedure_used_during_analysis', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Instrument/Equipment Details:</div>
                            @php
                           $Instrument_Equipment_Details = [
    [
        'question' => "Was the equipment used, calibrated/qualified and within the specified range?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Dry block /Heating block equipment ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date & Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Pipettes ID:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Refrigerator (2-8̊ C) ID:",
        'is_sub_question' => false,
        'input_type' => ' number'
    ],
    [
        'question' => "Validation date and next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Dehydrogenation over ID:",
        'is_sub_question' => false,
        'input_type' => 'date'
    ],
    [
        'question' => "Validation date and next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the depyrogenation done as per the validated load pattern?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was assay tubes incubated in the dry block (time and temp) as specified in the procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were any other samples tested along with this sample?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "If yes, were those sample’s results found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were any other samples analyzed at the same time on the same instruments?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "If yes, what were the results of other Batches?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                            @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 4.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Instrument_Equipment_Details as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Instrument_Equipment_Det[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Instrument_Equipment_Det[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Instrument_Equipment_Det[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Instrument_Equipment_Det[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Instrument_Equipment_Det', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Results and Calculation : </div>
@php
    $Results_and_Calculations = [
    [
        'question' => "Were results taken properly?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Raw data checked By:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Was formula dilution factor used for calculating the results correct?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

@endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 5.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Results_and_Calculations as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Results_and_Calculat[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Results_and_Calculat[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Results_and_Calculat[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Results_and_Calculat[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Results_and_Calculat', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>

                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach">
                                @if ($micro_data->attachment_details_cibet)
                                @foreach ($micro_data->attachment_details_cibet as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><i class="fa fa-eye text-primary"
                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file"
                                            data-file-name="{{ $file }}"><i
                                                class="fa-solid fa-circle-xmark"
                                                style="color:red; font-size:20px;"></i></a>
                                    </h6>
                                @endforeach

                                @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cibet[]"
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

        <div id="CCForm19" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Review of Training records Analyst Involved in Testing
                </div>
                            @php
                               $Training_records_Analyst_Involveds = [
    [
        'question' => "Was analyst trained on testing procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of training:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the analyst qualified for testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Were the personnel in perfect health without any open injury or infection?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the entry and exit procedures to the respective production area followed as per SOP?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                            @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Training_records_Analyst_Involveds as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Training_records_Analyst_Involved[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Training_records_Analyst_Involved[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Training_records_Analyst_Involved[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Training_records_Analyst_Involved[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Training_records_Analyst_Involved', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Review of sample intactness before analysis ? </div>
                    @php
                      $sample_intactness_before_analysis = [
    [
        'question' => "Was intact samples/sample container received in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was it verified by sample receipt persons at the time of receipt in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the sample collected in desired container and transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any discrepancy observed during sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Any remark notified in sample request form?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were samples stored as per storage requirements specified in specification/SOP?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($sample_intactness_before_analysis as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sample_intactness_before_analysis[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Review of test methods & Procedures </div>
                                @php
                                   $test_methods_Procedures = [
    [
        'question' => "Was correct applicable specification and method of analysis used for analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "MOA & specification number?",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Were the results of the other samples analyzed on the same day/time satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the samples tested transferred and incubated at desired temperature as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the tested samples results observed within the valid time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                                @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($test_methods_Procedures as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="test_methods_Procedure[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="test_methods_Procedure[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="test_methods_Procedure[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="test_methods_Procedure[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'test_methods_Procedure', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Review of Media, Buffer, Standards preparation & test accessories </div>
                            @php
                               $Review_of_Media_Buffer_Standards_prepar = [
    [
        'question' => "Name of the media used in the analysis:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Did the COA of the media review and found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Date of media preparation:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Lot No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Use before date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the media sterilization and sanitization cycle found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Validated load pattern references documents No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was any contamination observed in test media/diluents?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was appropriate and cleaned and sterilized glassware used for testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Are the negative controls still confirming?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Is the growth promotion test for the media confirming?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                            @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 4.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Review_of_Media_Buffer_Standards_prepar as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Review_of_Media_Buffer_Standards_prep[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Review_of_Media_Buffer_Standards_prep[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Review_of_Media_Buffer_Standards_prep[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Review_of_Media_Buffer_Standards_prep[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Review_of_Media_Buffer_Standards_prep', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Review of Media, Buffer, Standards preparation & test accessories </div>
                                @php
                                   $Checklist_for_Revi_of_Media_Buffer_Stand_preps = [
    [
        'question' => "Were the environmental conditions during testing as per the conditions specified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the Temperature of the area within the limit?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Pressure differentials of the area within the limit?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the other types of monitoring results confirming?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Are the under test environmental monitoring samples confirming?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the entry and exit procedures to the clean room / controlled rooms followed as per SOP? (by all personnel)",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the HEPA filter integrity of the area found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                                @endphp
                 <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 5.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_for_Revi_of_Media_Buffer_Stand_preps as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Disinfectant Details: </div>
@php
    $check_for_disinfectant_details = [
    [
        'question' => "Was the area disinfection done as per schedule?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is the disinfectant used approved?",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Is the concentration in which disinfectant used certified for efficacy?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Name of the disinfectant used?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the disinfectant prepared correctly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was cleaning done during operations?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was area fumigation done as per schedule?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the concentration in which fumigant used correct?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Were there any spillages in the area?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

@endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($check_for_disinfectant_details as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="check_for_disinfectant_detail[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="check_for_disinfectant_detail[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="check_for_disinfectant_detail[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="check_for_disinfectant_detail[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_detail', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>







            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Review of instrument/equipment </div>
@php
    $Checklist_for_Review_of_instrument_equips = [
    [
        'question' => "Was there any malfunctioning of autoclave observed? Verify the qualification and requalification of steam sterilizer?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Autoclave ID No:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was there any power supply failure noted during analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was incubators used is qualified Incubators ID:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Any events associated with incubators, when the samples under incubation.",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause this failure?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

@endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 7.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_for_Review_of_instrument_equips as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Checklist_for_Review_of_instrument_equip[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_for_Review_of_instrument_equip[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_for_Review_of_instrument_equip[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_of_instrument_equip[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_instrument_equip', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>
                        {{-- <small class="text-primary">
                                    If Yes, attach details
                                </small> --}}
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach">
                                @if ($micro_data->attachment_details_cis)
                                @foreach ($micro_data->attachment_details_cis as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><i class="fa fa-eye text-primary"
                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file"
                                            data-file-name="{{ $file }}"><i
                                                class="fa-solid fa-circle-xmark"
                                                style="color:red; font-size:20px;"></i></a>
                                    </h6>
                                @endforeach

                                @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cis[]"
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


        <div id="CCForm20" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Training records Analyst Involved in Testing
                </div>
                    @php
                        $Checklist_for_Review_of_Training_records_Analysts = [
                        [
                            'question' => "Is the analyst trained on respective procedures?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "Was the analyst qualified for testing?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "Date of qualification:",
                            'is_sub_question' => true,
                            'input_type' => 'date'
                        ],
                        [
                            'question' => "Was the analyst trained on entry exit /procedure?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "SOP No.& Trained On",
                            'is_sub_question' => true,
                            'input_type' => 'number'
                        ],
                        [
                            'question' => "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "Was the analyst followed gowning procedure?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "Was analyst performed colony counting correctly?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ]
                    ];

                    @endphp
                <div class="row">



                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_for_Review_of_Training_records_Analysts as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Checklist_for_Review_of_Training_records_Analyst[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_for_Review_of_Training_records_Analyst[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_for_Review_of_Training_records_Analyst[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_of_Training_records_Analyst[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of sampling and Transportation procedures </div>
                    @php
                      $Checklist_for_Review_of_sampling_and_Transports = [
    [
        'question' => "Name of the sampler:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the sampling followed approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Reference procedure No. & Trained on",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Were clean and sterile sampling accessories used for sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Used before date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the sampling area cleaned on day of sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Name of the disinfectant used for cleaning?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "When was the last cleaning date from date of sampling?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the cleaning operator trained on the cleaning procedure?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the sample collected in desired container and transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any discrepancy observed during sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Did the samples transfer to the lab within time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were samples stored as per storage requirements specified in specifications/procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any maintenance work carried out before or during sampling in sampling area?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];
                @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_for_Review_of_sampling_and_Transports as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Checklist_for_Review_of_sampling_and_Transport[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_for_Review_of_sampling_and_Transport[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_for_Review_of_sampling_and_Transport[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_of_sampling_and_Transport[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                   </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Test Method & procedure: </div>
                    @php
                        $Checklist_Review_of_Test_Method_proceds = [
                        [
                            'question' => "Was correct applicable specification/Test procedure/MOA/SOP used for analysis?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                        ],
                        [
                            'question' => "Verified specification/Test procedure/MOA No/SOP No.",
                            'is_sub_question' => true,
                            'input_type' => 'number'

                        ],
                        [
                            'question' => "Was the test procedure mentioned in specification/analytical procedure validated w.r.t. product concentration?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Was method used during testing evaluated with respect to method validation and historical data and found satisfactory?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Was negative control of the test procedure found satisfactory?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Were the sample tested transferred and incubated at desired temp. as per approved procedure?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Were the test samples results observed within the valid time?",
                            'is_sub_question' => true,
                            'input_type' => 'number'

                        ],
                        [
                            'question' => "Were colonies counted correctly?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Was correct formula, dilution factor used for calculation of results?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ],
                        [
                            'question' => "Was the interpretation of test result done correct?",
                            'is_sub_question' => true,
                            'input_type' => 'text'

                        ]
                    ];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_Review_of_Test_Method_proceds as $index => $Checklist_Review_of_Test_Method_proced)
                                        @php
                                            if ($Checklist_Review_of_Test_Method_proced['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $Checklist_Review_of_Test_Method_proced['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$Checklist_Review_of_Test_Method_proced['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($Checklist_Review_of_Test_Method_proced['input_type'] == 'date')
                                                    <input type="date" name="Checklist_Review_of_Test_Method_proced[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($Checklist_Review_of_Test_Method_proced['input_type'] == 'number')
                                                    <input type="number" name="Checklist_Review_of_Test_Method_proced[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_Review_of_Test_Method_proced[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_Review_of_Test_Method_proced[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_of_Test_Method_proced', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of microbial isolates /Contamination </div>
                <div class="row">
                    <div class="col-12">
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
                                        <tr>
                                            <td class="flex text-center">4.1</td>
                                            <td>Were the contaminants/ isolates subculture?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="microbial_isolates_bioburden[0][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[0][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Attach the colony morphology details:
                                            </td>
                                            <td>

                                                <div class="group-input">

                                                    <div class="file-attachment-field">
                                                        <div style="width: 170px; height: 30px; border: 2px solid black; position: relative; top: 17px; left:27px; border-radius: 5px;"
                                                        id="file_attach "></div>
                                                        <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                            <div>Add</div>
                                                            <input type="file" id="myfile" name="microbial_isolates_bioburden[1][attachment]"
                                                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                        </div>
                                                    </div>

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[1][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.2</td>
                                            <td>Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="microbial_isolates_bioburden[2][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[2][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.3</td>
                                            <td>Gram nature of the organism (GP/GN)</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="microbial_isolates_bioburden[3][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[3][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.4</td>
                                            <td>(Attach the details, if more than single organism)</td>
                                            <td>

                                                <div class="group-input">

                                                    <div class="file-attachment-field">
                                                        <div style="width: 170px; height: 30px; border: 2px solid black; position: relative; top: 17px; left:27px; border-radius: 5px;"
                                                        id="file_attach "></div>
                                                        <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                            <div>Add</div>
                                                            <input type="file" id="myfile" name="microbial_isolates_bioburden[4][attachment]"
                                                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                        </div>
                                                    </div>

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[4][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2</td>
                                            <td>Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="microbial_isolates_bioburden[5][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="microbial_isolates_bioburden[5][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Media preparation, RTU media and Test Accessories </div>
                        @php
                                                                    $Checklist_for_Review_Media_prepara_RTU_medias = [
                                                [
                                                    'question' => "Name of the media used in the analysis:",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Review of the media COA",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Date of media preparation",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'date'
                                                ],
                                                [
                                                    'question' => "Lot No.",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Use before date",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'date'
                                                ],
                                                [
                                                    'question' => "Was GPT of the media complied for its acceptance criteria?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was valid culture use in GPT of media?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Any events noticed with the same media used in other tests?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Sterilization cycle No?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Whether gloves used during testing were within the expiry date?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Did the analyst use clean/sterilized garments during testing?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Rinsing fluid/diluents used for testing:",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Were rinsing fluid/diluents used for testing within the validity?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Date of preparation or manufacturing:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'date'
                                                ],
                                                [
                                                    'question' => "Were the diluting or rinsing fluids visually inspected for any contamination before testing?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Lot number of diluents:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Use before date:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'date'
                                                ],
                                                [
                                                    'question' => "Type of filter used in filter testing:",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Use before date of filter:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'date'
                                                ],
                                                [
                                                    'question' => "Lot number of filter:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Was sanitization filter assembly performed before execution of the testing?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Were the filtration assembly and filtration cups sterilized?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Whether sterilized petri plates used for testing?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Lot No./Batch No of petri plates:",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'number'
                                                ],
                                                [
                                                    'question' => "Was temp. of media while pouring monitored and found satisfactory?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was any microbial cultures handled in BSC/LAF prior to testing?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ]
                                            ];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 5.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $index => $Checklist_for_Review_Media_prepara_RTU_media)
                                        @php
                                            if ($Checklist_for_Review_Media_prepara_RTU_media['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $Checklist_for_Review_Media_prepara_RTU_media['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$Checklist_for_Review_Media_prepara_RTU_media['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($Checklist_for_Review_Media_prepara_RTU_media['input_type'] == 'date')
                                                    <input type="date" name="media_prepara_RTU[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($Checklist_for_Review_Media_prepara_RTU_media['input_type'] == 'number')
                                                    <input type="number" name="media_prepara_RTU[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="media_prepara_RTU[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_Media_prepara_RTU_medias[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'media_prepara_RTU', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Environmental condition in the testing area :</div>
                    @php
                       $Checklist_Review_Environment_condition_in_tests = [
                                                [
                                                    'question' => "Was temp. of testing area within limit during testing?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was differential pressure of the area within the limit?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Were Environmental monitoring (Microbial) results of the LAF/BSC and its surrounding area within the limit on the day of testing and prior to the testing?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was there any maintenance work performed in the testing area prior to the testing?",
                                                    'is_sub_question' => true,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Was recovered isolate reviewed for its occurrence in the past, source, frequency and control taken against the isolate?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ],
                                                [
                                                    'question' => "Were measures established and implemented to prevent contamination from personnel, material during testing reviewed and found satisfactory?",
                                                    'is_sub_question' => false,
                                                    'input_type' => 'text'
                                                ]
                                            ];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp
                                        @foreach ($Checklist_Review_Environment_condition_in_tests as $index => $Checklist_Review_Environment_condition_in_test)
                                        @php
                                            if ($Checklist_Review_Environment_condition_in_test['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $Checklist_Review_Environment_condition_in_test['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$Checklist_Review_Environment_condition_in_test['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($Checklist_Review_Environment_condition_in_test['input_type'] == 'date')
                                                    <input type="date" name="Checklist_Review_Environment_condition_in_test[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($Checklist_Review_Environment_condition_in_test['input_type'] == 'number')
                                                    <input type="number" name="Checklist_Review_Environment_condition_in_test[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_Review_Environment_condition_in_test[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_Review_Environment_condition_in_test[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Checklist_Review_Environment_condition_in_test', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Instrument/Equipment:</div>
                    @php
                        $review_of_instrument_bioburden_and_waters = [
    [
        'question' => "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Autoclave :ID No",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "BSC/LAF ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Incubator :ID No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was temp. of incubator with in the limit during incubation period?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the BSC/LAF cleaned prior to testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was HVAC system of testing area qualified ?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was there any power failure during analysis ?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Any events associated with incubators, when the samples under incubation?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Pipettes ID:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                    @endphp

                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 7.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($review_of_instrument_bioburden_and_waters as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="review_of_instrument_bioburden_and_waters[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="review_of_instrument_bioburden_and_waters[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="review_of_instrument_bioburden_and_waters[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="review_of_instrument_bioburden_and_waters[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'review_of_instrument_bioburden_and_waters', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                         </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Disinfectant Details:</div>
                    @php
                       $disinfectant_details_of_bioburden_and_water_tests = [
                    [
                        'question' => "Name of the disinfectant used for area cleaning",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                    ],
                    [
                        'question' => "Was the disinfectant used for cleaning and sanitization validated?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                    ],
                    [
                        'question' => "Concentration:",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                    ],
                    [
                        'question' => "Was the disinfectant prepared as per validated concentration?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                    ]
                ];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 8.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($disinfectant_details_of_bioburden_and_water_tests as $index => $disinfectant_detail)
                                        @php
                                            if ($disinfectant_detail['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $disinfectant_detail['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$disinfectant_detail['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($disinfectant_detail['input_type'] == 'date')
                                                    <input type="date" name="disinfectant_details_of_bioburden_and_water_test[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($disinfectant_detail['input_type'] == 'number')
                                                    <input type="number" name="disinfectant_details_of_bioburden_and_water_test[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="disinfectant_details_of_bioburden_and_water_test[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_of_bioburden_and_water_test[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_of_bioburden_and_water_test', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>
                        {{-- <small class="text-primary">
                                    If Yes, attach details
                                </small> --}}
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach">
                                @if ($micro_data->attachment_details_cimlbwt)
                                @foreach ($micro_data->attachment_details_cimlbwt as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><i class="fa fa-eye text-primary"
                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file"
                                            data-file-name="{{ $file }}"><i
                                                class="fa-solid fa-circle-xmark"
                                                style="color:red; font-size:20px;"></i></a>
                                    </h6>
                                @endforeach

                                @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cimlbwt[]"
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





<div id="CCForm21" class="inner-block cctabcontent">

            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Training records Analyst Involved in Testing

                </div>
                    @php
                      $training_records_analyst_involvedIn_testing_microbial_asssays = [
    [
        'question' => "Was analyst trained on testing procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst qualified for testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        <tbody>
                                            @php
                                                $main_question_index = 1.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($training_records_analyst_involvedIn_testing_microbial_asssays as $index => $review_item)
                                            @php
                                                if ($review_item['is_sub_question']) {
                                                    $sub_question_index++;
                                                } else {
                                                    $sub_question_index = 0;
                                                    $main_question_index += 0.1;
                                                }
                                            @endphp
                                            <tr>
                                                <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                <td>{{$review_item['question']}}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="training_records_analyst_involvedIn_testing_microbial_asssay[{{ $index }}][response]"
                                                            value="{{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) ?? '' }}"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="training_records_analyst_involvedIn_testing_microbial_asssay[{{ $index }}][response]"
                                                            value="{{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) ?? '' }}"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="training_records_analyst_involvedIn_testing_microbial_asssay[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="training_records_analyst_involvedIn_testing_microbial_asssay[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'remark', true, $index) ?? '' }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of sample intactness before analysis ? </div>
                    @php
                       $sample_intactness_before_analysis = [
    [
        'question' => "Was intact samples /sample container received in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was it verified by sample receipt persons at the time of receipt in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the sample collected in desired container and transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any discrepancy observed during sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were sample stored as per storage requirements specified in specification/SOP?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($sample_intactness_before_analysis as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sample_intactness_before_analysis[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sample_intactness_before_analysis[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'sample_intactness_before_analysis', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                    </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of test methods & Procedures</div>
                        @php
                       $checklist_for_review_of_test_method_IMAs = [
    [
        'question' => "Was correct applicable specification and method of analysis used for analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "MOA & specification number?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the results of the other samples analyzed on the same day/time satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the samples pipetted or loaded in appropriate quantity?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the samples tested transferred and incubated at desired temperature as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the tested samples results observed within the valid time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were zones /readings measured correctly? (Applicable for Antibiotics –Microbial Assay)",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was formula, dilution factors used for calculation of results corrected?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp

                    <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_review_of_test_method_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_review_of_test_method_IMA[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_review_of_test_method_IMA[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_review_of_test_method_IMA[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_review_of_test_method_IMA[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_review_of_test_method_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Media, Buffer, Standards preparation & test accessories </div>
                @php
  $cr_of_media_buffer_st_IMAs = [
    [
        'question' => "Name of the media used in the analysis:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Did the COA of the media review and found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of media preparation:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Lot No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Use before date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Did appropriate size wells prepare in the media plates? (Applicable for Antibiotics –Microbial Assay)",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the media sterilization and sanitization cycle found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Validated load pattern references documents No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was any contamination observed in test media /Buffers /Standard solution?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was appropriate and cleaned glasswares used for testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Whether the volumetric flask calibrated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "References standard lot No./Batch No?",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Reference standard expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Were the challenged samples stored in appropriate storage condition?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the standard weight accurately as mentioned in test procedure?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Any event observed with the references standard of the same batch?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the working standard prepared with appropriate dilutions?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of preparation:",
        'is_sub_question' => true,
        'input_type' => 'date',
    ],
    [
        'question' => "Use before date:",
        'is_sub_question' => true,
        'input_type' => 'date',
    ],
    [
        'question' => "Were sterilized petriplates used for testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Lot/Batch No. of petriplates",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Size of the petriplates",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Size of the petriplate",
        'is_sub_question' => true, // <- corrected
        'input_type' => 'text'
    ],
    [
        'question' => "Dilutor prepared on:",
        'is_sub_question' => false,
        'input_type' => 'date'
    ],
    [
        'question' => "Validity time of the dilutor:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Used on:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
];

   @endphp
                <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 4.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($cr_of_media_buffer_st_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="cr_of_media_buffer_st_IMA[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="cr_of_media_buffer_st_IMA[{{ $index }}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="cr_of_media_buffer_st_IMA[{{ $index }}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="cr_of_media_buffer_st_IMA[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'cr_of_media_buffer_st_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Microbial cultures/Inoculation (Test organism) </div>
                    @php
                       $CR_of_microbial_cultures_inoculation_IMAs = [
    [
        'question' => "Name of the test organism used:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Passage No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Whether the culture suspension was prepared from valid source (Slant/Cryo vails)?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the culture suspension used within the valid time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was appropriate quantity of the inoculum challenged in the product?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the stock/test culture dilution store as per recommended condition before used",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

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
                                    @php
                                        $main_question_index = 5.0;
                                        $sub_question_index = 0;
                                    @endphp

                                    @foreach ($CR_of_microbial_cultures_inoculation_IMAs as $index => $review_item)
                                    @php
                                        if ($review_item['is_sub_question']) {
                                            $sub_question_index++;
                                        } else {
                                            $sub_question_index = 0;
                                            $main_question_index += 0.1;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                        <td>{{$review_item['question']}}</td>
                                        <td>
                                            <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                @if ($review_item['input_type'] == 'date')
                                                <input type="date" name="CR_of_microbial_cultures_inoculation_IMA[{{ $index }}][response]"
                                                    value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) ?? '' }}"
                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                @elseif ($review_item['input_type'] == 'number')
                                                <input type="number" name="CR_of_microbial_cultures_inoculation_IMA[{{ $index }}][response]"
                                                    value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) ?? '' }}"
                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                @else
                                                <select name="CR_of_microbial_cultures_inoculation_IMA[{{ $index }}][response]"
                                                        id="response"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    <option value="">Select an Option</option>
                                                    <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                    <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                </select>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="CR_of_microbial_cultures_inoculation_IMA[{{ $index }}][remark]"
                                                          style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Environmental conditions in the testing area </div>
                    @php
                       $CR_of_Environmental_condition_in_testing_IMAs = [
    [
        'question' => "Was observed temp. of the area within limit",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was differential pressure of the area within limit:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was viable environmental monitoring results of LAF /BSC (used for testing) found within limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "LAF/BSC ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ]
];
                    @endphp

                <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_Environmental_condition_in_testing_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_Environmental_condition_in_testing_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_Environmental_condition_in_testing_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_Environmental_condition_in_testing_IMA[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_Environmental_condition_in_testing_IMA[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>





            </div>

            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of instrument/equipment </div>
                            @php
                               $CR_of_instru_equipment_IMAs = [
    [
        'question' => "Was there any malfunctioning of autoclave observed? verify the qualification and requalification of steam sterilizer?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Autoclave ID No:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was any Microbial cultures handled in BSC/LAF prior testing",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "BSC/ULAF ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Did the equipment cleaned prior to testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Incubators ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Any events associated with incubators, when the samples under incubation.",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any power supply failure noted during analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Pipette IDs",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date & Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                            @endphp

                <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 7.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_instru_equipment_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_instru_equipment_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_instru_equipment_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_instru_equipment_IMA[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_instru_equipment_IMA[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equipment_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>

            <div class="inner-block-content">

                <div class="sub-head">

                    Disinfectant Details: </div>
                    @php
                       $disinfectant_details_IMAs = [
    [
        'question' => "Name of the disinfectant used for cleaning of testing area:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the disinfectant prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Use before date of the disinfectant used for cleaning:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

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
                                        @php
                                            $main_question_index = 8.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($disinfectant_details_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="disinfectant_details_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="disinfectant_details_IMA[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="disinfectant_details_IMA[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_IMA[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_IMA', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="group-input">

                        <label for="Audit Attachments">If Yes, Provide attachment details</label>


                        <div class="file-attachment-field">

                            <div class="file-attachment-list" id="file_attach">
                                @if ($micro_data->attachment_details_cima)
                                @foreach ($micro_data->attachment_details_cima as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><i class="fa fa-eye text-primary"
                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file"
                                            data-file-name="{{ $file }}"><i
                                                class="fa-solid fa-circle-xmark"
                                                style="color:red; font-size:20px;"></i></a>
                                    </h6>
                                @endforeach

                                @endif
                            </div>

                            <div class="add-btn">

                                <div>Add</div>

                                <input type="file" id="myfile" name="attachment_details_cima[]"

                                    oninput="addMultipleFiles(this, 'file_attach')" multiple/>

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


        <div id="CCForm22" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for review of Training records Analyst Involved in monitoring
                </div>
                    @php
                        $CR_of_training_rec_anaylst_in_monitoring_CIEMs = [
    [
        'question' => "Is the analyst trained for Environmental monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst qualified for Personnel qualification?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the analyst trained on entry exit /procedure/In production area or any monitoring area?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "SOP No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst followed gowning procedure properly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was analyst performed colony counting correctly?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];
                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_training_rec_anaylst_in_monitoring_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for sample details:
                </div>
                    @php
                        $Check_for_Sample_details_CIEMs = [
    [
        'question' => "Was the plate verified at the time of monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the plate transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the correct location ID & Room Name mentioned on plate exposed?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "What is the grade of plate exposed area?",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Is area crossing Alert limit or action limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Check_for_Sample_details_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Check_for_Sample_details_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Check_for_Sample_details_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Check_for_Sample_details_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Check_for_Sample_details_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Check_for_Sample_details_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                   </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                    Checklist for comparison of results with other parameters:
                </div>
                        @php
                            $Check_for_comparision_of_results_CIEMs = [
    [
        'question' => "Was any Excursions in other settle plate exposure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in other active air plate sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in surface monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in personnel monitoring on same day?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is results of next day monitoring within the acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was negative control of the test procedure found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the plate transferred and incubated at desired temp.as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Check_for_comparision_of_results_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Check_for_comparision_of_results_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Check_for_comparision_of_results_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Check_for_comparision_of_results_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Check_for_comparision_of_results_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Check_for_comparision_of_results_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for details of media dehydrated media used:
                </div>
                        @php
                           $checklist_for_media_dehydrated_CIEMs = [
    [
        'question' => "Name of media used for in the analysis:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Did the COA of the media checked and found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Media Lot. No.",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Media Qualified date /Qualified By",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media expiry date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @foreach ($checklist_for_media_dehydrated_CIEMs as $index => $checklist_for_media_dehydrated_CIEM)
                                        @php
                                            $main_question_index = 4.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @php
                                            if ($checklist_for_media_dehydrated_CIEM['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $checklist_for_media_dehydrated_CIEM['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$checklist_for_media_dehydrated_CIEM['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($checklist_for_media_dehydrated_CIEM['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_media_dehydrated_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($checklist_for_media_dehydrated_CIEM['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_media_dehydrated_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_media_dehydrated_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_media_dehydrated_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_dehydrated_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for media preparation details and sterilization :
                </div>
                        @php
                           $checklist_for_media_prepara_sterilization_CIEMs = [
    [
        'question' => "Date of media preparation",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media Lot. No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Media prepared date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media expiry date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Preincubation of media",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Sterilization cycle No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Were cycle sterilization parameters found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 5.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_media_prepara_sterilization_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_media_prepara_sterilization_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_media_prepara_sterilization_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_media_prepara_sterilization_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_media_prepara_sterilization_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of environmental conditions in the testing area
                </div>
                    @php
                       $CR_of_En_condition_in_testing_CIEMs = [
    [
        'question' => "Is temperature of MLT testing area within the acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the differential pressure of the area within limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "While media plate preparation is LAF working satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_En_condition_in_testing_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_En_condition_in_testing_CIEMs[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_En_condition_in_testing_CIEMs[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_En_condition_in_testing_CIEMs[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_En_condition_in_testing_CIEMs[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_En_condition_in_testing_CIEMs', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for disinfectant Details:
                </div>
                    @php
                       $check_for_disinfectant_CIEMs = [
    [
        'question' => "Name of the disinfectant used for area cleaning",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the disinfectant used for cleaning and sanitization validated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Concentration:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the disinfectant prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 7.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($check_for_disinfectant_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="check_for_disinfectant_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="check_for_disinfectant_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="check_for_disinfectant_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="check_for_disinfectant_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'check_for_disinfectant_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for fogging details :
                </div>
                        @php
                          $checklist_for_fogging_CIEMs = [
    [
        'question' => "Name of the fogging agents used for area fogging",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the fogging agent used for fogging and validated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Concentration:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the fogging agent prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 8.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_fogging_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_fogging_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_fogging_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_fogging_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_fogging_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_fogging_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Test Method & procedure:
                </div>
                    @php
                      $CR_of_test_method_CIEMs = [
    [
        'question' => "Was the test method, monitoring SOP followed correctly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "SOP No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 9.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_test_method_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_test_method_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_test_method_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_test_method_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_test_method_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_test_method_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification)
                </div>
                        @php
                          $CR_microbial_isolates_contamination_CIEMs = [
    [
        'question' => "Were the contaminants/ isolates subculture?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Attach the colony morphology details:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Gram nature of the organism (GP/GN)",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "(Attach the details, if more than single organism)",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.",
        'is_sub_question' => false,
        'input_type' => 'number'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 10.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_microbial_isolates_contamination_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_microbial_isolates_contamination_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_microbial_isolates_contamination_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_microbial_isolates_contamination_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_microbial_isolates_contamination_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_microbial_isolates_contamination_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Instrument/Equipment:
                </div>
                    @php
                        $CR_of_instru_equip_CIEMs = [
    [
        'question' => "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is used incubators are qualified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Incubator :ID No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Is used Colony counter qualified?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Colony counter ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Is used Air sampler qualified?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Air sampler ID",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Validation date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was temp. of incubator with in the limit during incubation period?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was HVAC system of testing area qualified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
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
                                        @php
                                            $main_question_index = 11.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_instru_equip_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_instru_equip_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_instru_equip_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_instru_equip_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_instru_equip_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'CR_of_instru_equip_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for trend Analysis:
                </div>
                        @php
                          $Ch_Trend_analysis_CIEMs = [
    [
        'question' => "Is trend of current month within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is trend of previous month within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
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
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 12.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Ch_Trend_analysis_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Ch_Trend_analysis_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Ch_Trend_analysis_CIEM[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Ch_Trend_analysis_CIEM[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Ch_Trend_analysis_CIEM[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'Ch_Trend_analysis_CIEM', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>                    <div class="col-lg-12">

                        <div class="group-input">

                            <label for="Audit Attachments">If Yes, Provide attachment details</label>


                            <div class="file-attachment-field">

                                <div class="file-attachment-list" id="file_attach">
                                    @if ($micro_data->attachment_details_ciem)
                                    @foreach ($micro_data->attachment_details_ciem as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><i class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file"
                                                data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark"
                                                    style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                    @endforeach

                                    @endif
                                </div>

                                <div class="add-btn">

                                    <div>Add</div>

                                    <input type="file" id="myfile" name="attachment_details_ciem[]"

                                        oninput="addMultipleFiles(this, 'file_attach')" multiple/>

                                </div>

                            </div>



                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>
        </div>