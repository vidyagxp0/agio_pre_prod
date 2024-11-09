   <!--Start Checklist - Investigation of Bacterial Endotoxin Test CCForm18 -->

        <div class="inner-block">
            <div class="content-table">

                <div class="block">
                    <div class="block-head"> Checklist for Analyst Training and Procedure : </div>
                        <div class="border-table">
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
                            <table>
                                <tr class="table_bg">
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>
                                @php
                                    $main_question_index = 2.0;
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
                                        <td>{{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) ?? '' }}</td>
                                        <td>{{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'remark', true, $index) ?? '' }}</td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                </div>

                <div class="block">
                    <div class="block-head">Sample receiving & verification in lab</div>
                    <div class="border-table">
                        @php
                        $check_sample_receiving_vars = [
                        [
                        'question' => "Was the sample container (Physical integrity) verified at the time of sample receipt?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was the correct quantity of the sample withdrawn ?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was there any discrepancy observed during sampling ?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was the sample container (Physical integrity) checked before testing ? ",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        ];

                   @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($check_sample_receiving_vars as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Method /procedure used during analysis</div>
                    <div class="border-table">
                        @php
                                $check_method_procedure_during_analysis = [
                                [
                                'question' => "Was correct applicable specification/Test procedure/MOA/ used for analysis ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Verified specification/Test procedure/MOA No.",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the test procedure followed as per method validation ?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the any change in the validated change method ?if yes, was test performed with the new validated method ?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was BET reagents (Lysate ,CSE,LRW and Buffer) procured from the approved vender ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was lysate and CSE stored at the recommended temp.and duration? Storage condition:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were all product /reagents contact parts of BET testing (Tips/Accessories /Sample Container) depayrogenated ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Assay tube /Batch No.",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Expiry date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Tipe lot /Batch No.",
                                'is_sub_question' => false,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Expiry date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Was the test done at correct MVD as per validated method ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were calculation of MVD/Test dilution done correctly?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were correct dilutions prepared ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was labeled claim lysate sensitivity checked before the use of the lot?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were all reagents (LRW/CSE and Lysate) used in the test with in the expiry?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "LRW expiry date?",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "CSE expiry date?",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Lysate expiry date?",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Buffer expiry date?",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Was рН of the test sample/dilution verified?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were appropriate рН strip /measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were proper incubation conditions followed ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],

                                [
                                'question' => "Was there any spillage that occurred during the vortexing of dilutions?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were the results of positive, negative and test controls found satisfactory?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Is the test incubator /heating block kept on a vibration –free surface ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                ]
                                @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($check_method_procedure_during_analysis as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Instrument/Equipment Details</div>
                    <div class="border-table">
                        @php
                        $check_Instrument_Equipment_Details = [
                            [
                            'question' => "Was the equipment used, calibrated/qualified and within the specified range? ",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Dry block /Heating block equipment ID:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Calibration date & Next due date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Pipettes ID:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Calibration date and Next due date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Refrigerator (2-8̊ C) ID:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Validation date and next due date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Dehydrogenation over ID:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Validation date and next due date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was the depyrogenation done as per the validated load pattern?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was assay tubes incubated in the dry block (time and temp).as specified in the procedure?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were any other samples tested along with this sample?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "If yes, whether those sample’s results found satisfactory?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were any other sample’s analyzed on the same time on the same instruments ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "If yes, what were the results of other Batches:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            ]
                            @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($check_Instrument_Equipment_Details as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Results and Calculation</div>
                    <div class="border-table">
                        @php
                        $Results_and_Calculation = [
                            [
                            'question' => "Were results taken properly ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Raw data checked By……………….",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was formula dilution factor used for calculating the results corrected?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            ];

                    @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($Results_and_Calculation as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Training records Analyst Involved in Testing</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of sample intactness before analysis ?</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Review of test methods & Procedures</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Review of Media, Buffer, Standards preparation & test accessories</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of Media, Buffer, Standards preparation & test accessories</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Disinfectant Details: </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of instrument/equipment </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Training records Analyst Involved in Testing </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of sampling and Transportation procedures </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Test Method & procedure:  </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($Checklist_Review_of_Test_Method_proceds as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Media preparation, RTU media and Test Accessories  </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $index => $review_item)
                            @php
                                if ($review_item['is_sub_question']) {
                                    $sub_question_index++;
                                } else {
                                    $sub_question_index = 0;
                                    $main_question_index += 0.1;
                                }
                            @endphp
                                {{--<tr>
                                    <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                    <td>{{$review_item['question']}}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>--}}
                                <tr>
                                    <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                    <td>{{ $review_item['question'] }}</td>

                                    @php
                                        $response = Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index);
                                        $remark = Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'remark', true, $index);
                                    @endphp

                                    <td>{{ is_array($response) ? json_encode($response) : ($response ?? '') }}</td>
                                    <td>{{ is_array($remark) ? json_encode($remark) : ($remark ?? '') }}</td>
                                </tr>

                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Environmental condition in the testing area : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($Checklist_Review_Environment_condition_in_tests as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of Instrument/Equipment:</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Disinfectant Details:</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($disinfectant_details_of_bioburden_and_water_tests as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of Training records Analyst Involved in Testing</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of sample intactness before analysis ?</div>
                    <div class="border-table">
                        @php
                        $sample_intactness_before_analysis2 = [
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($sample_intactness_before_analysis2 as $index => $review_item)
                            @php
                                if ($review_item['is_sub_question']) {
                                    $sub_question_index++;
                                } else {
                                    $sub_question_index = 0;
                                    $main_question_index += 0.1;
                                }
                            @endphp
                                {{-- <tr>
                                    <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                    <td>{{$review_item['question']}}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'remark', true, $index) ?? '' }}</td>
                                </tr> --}}
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of test methods & Procedures</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of Media, Buffer, Standards preparation & test accessories </div>
                    <div class="border-table">
                        @php
                                                $cr_of_media_buffe_rst_IMAs = [
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($cr_of_media_buffe_rst_IMAs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of Microbial cultures/Inoculation (Test organism)</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Review of Environmental conditions in the testing area</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Review of instrument/equipment</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Disinfectant Details :</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for review of Training records Analyst Involved in monitoring : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for sample details : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for comparison of results with other parameters: </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for details of media dehydrated media used:</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_media_dehydrated_CIEMs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for media preparation details and sterilization :</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for review of environmental conditions in the testing area : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for disinfectant Details : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for fogging details : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for review of Test Method & procedure: </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">  Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification) : </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for review of Instrument/Equipment:</div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for trend Analysis: </div>
                    <div class="border-table">
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Analyst training & Procedure </div>
                    <div class="border-table">
                        @php
                                    $checklist_for_analyst_training_CIMTs = [
                                    [
                                        'question' => "Is the analyst trained/qualified GPT test procedure?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
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
                                        'question' => "Analyst interview record.......",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Was an analyst persons suffering from any ailment such as cough/cold or open wound or skin infections?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ]
                                ];

                                @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_analyst_training_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">  Checklist for Comparison of results (With same & Previous Day Media GPT) :: </div>
                    <div class="border-table">
                        @php
                        $checklist_for_comp_results_CIMTs = [
                            [
                                'question' => "Which media GPT performed at previous day:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Were dehydrated and ready to use media used for GPT?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Lot No./Batch No:",
                                'is_sub_question' => false,
                                'input_type' => 'number'
                            ],
                            [
                                'question' => "Date /Time of Incubation:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                            ],
                            [
                                'question' => "Date/Time of Release:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                            ],
                            [
                                'question' => "Results of previous day GPT record?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Results of other plates released for GPT is within acceptance?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ]
                        ];

                        @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_comp_results_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Culture verification ?</div>
                    <div class="border-table">
                        @php
                        $checklist_for_Culture_verification_CIMTs = [
                            [
                                'question' => "Is culture COA checked?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Was the correct Inoculum used for GPT?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Was used culture within culture due date?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Date of culture dilution:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                            ],
                            [
                                'question' => "Due date of culture dilution:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                            ],
                            [
                                'question' => "Was the storage condition of culture appropriate?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Was culture strength used within acceptance range?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ]
                        ];
                    @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_Culture_verification_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Sterilize Accessories : </div>
                    <div class="border-table">
                        @php
                                $sterilize_accessories_CIMTs = [
                                    [
                                        'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Sterilization cycle No.:",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Whether disposable sterilized gloves used during testing were within the expiry date?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Results of other plates released for GPT is within acceptance?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ]
                                ];

                            @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($sterilize_accessories_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">Checklist for Instrument/Equipment Details: </div>
                    <div class="border-table">
                        @php
                                $checklist_for_intrument_equip_last_CIMTs = [
                                        [
                                            'question' => "Was the equipment used, calibrated/qualified and within the specified range?",
                                            'is_sub_question' => false,
                                            'input_type' => 'text'
                                        ],
                                        [
                                            'question' => "Biosafety equipment ID:",
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
                                            'question' => "Colony counter equipment ID:",
                                            'is_sub_question' => false,
                                            'input_type' => 'number'
                                        ],
                                        [
                                            'question' => "Calibration date:",
                                            'is_sub_question' => true,
                                            'input_type' => 'date'
                                        ],
                                        [
                                            'question' => "Was used pipettes within calibration?",
                                            'is_sub_question' => false,
                                            'input_type' => 'text'
                                        ],
                                        [
                                            'question' => "Pipettes ID:",
                                            'is_sub_question' => true,
                                            'input_type' => 'number'
                                        ],
                                        [
                                            'question' => "Calibration date",
                                            'is_sub_question' => true,
                                            'input_type' => 'date'
                                        ],
                                        [
                                            'question' => "Was the refrigerator used for storage of culture is validated?",
                                            'is_sub_question' => false,
                                            'input_type' => 'text'
                                        ],
                                        [
                                            'question' => "Refrigerator (2-8̊ C) ID:",
                                            'is_sub_question' => true,
                                            'input_type' => 'number'
                                        ],
                                        [
                                            'question' => "Validation date:",
                                            'is_sub_question' => true,
                                            'input_type' => 'date'
                                        ],
                                        [
                                            'question' => "Incubator ID:",
                                            'is_sub_question' => false,
                                            'input_type' => 'number'
                                        ],
                                        [
                                            'question' => "Validation date and next due date:",
                                            'is_sub_question' => true,
                                            'input_type' => 'date'
                                        ],
                                        [
                                            'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
                                            'is_sub_question' => false,
                                            'input_type' => 'text'
                                        ],
                                        [
                                            'question' => "Were any other media GPT tested along with this sample?",
                                            'is_sub_question' => false,
                                            'input_type' => 'text'
                                        ],
                                        [
                                            'question' => "If yes, whether those media GPT results found satisfactory?",
                                            'is_sub_question' => true,
                                            'input_type' => 'text'
                                        ]
                                    ];

                                @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_intrument_equip_last_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head"> Checklist for Disinfectant Details:</div>
                    <div class="border-table">
                        @php
                        $disinfectant_details_last_CIMTs = [
                                [
                                    'question' => "Name of the disinfectant used for area cleaning",
                                    'is_sub_question' => false,
                                    'input_type' => 'number'
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
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($disinfectant_details_last_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">  Checklist for Results and Calculation : </div>
                    <div class="border-table">
                        @php
                                $checklist_for_result_calculation_CIMTs = [
                                    [
                                        'question' => "Were results taken properly?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Raw data checked?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Was formula dilution factor used for calculating the results corrected?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ]
                                ];
                            @endphp
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @php
                                $main_question_index = 2.0;
                                $sub_question_index = 0;
                            @endphp
                            @foreach ($checklist_for_result_calculation_CIMTs as $index => $review_item)
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
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) ?? '' }}</td>
                                    <td>{{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'remark', true, $index) ?? '' }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

                        @php
                        $ph_meter_questions = array(
                                "Was instrument calibrated before start of analysis?",
                                "Was temperature sensor working efficiently?",
                                "Was pH electrode stored properly?",
                                "Was sampled prepared as per STP?",
                                "Was sufficient quantity of sample to ensure that the sensor is properly dipped?",
                                "Was electrode filling solution sufficient inside the electrode?",
                                "Were instrument properly connected at the time of analysis?",
                            );
                        @endphp
                        <div class="block">
                            <div class="block-head"> CheckList - pH-Viscometer-MP</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th style="width: 5%;">Sr.No.</th>
                                        <th style="width: 40%;">Question</th>
                                        <th style="width: 20%;">Response</th>
                                        <th>Remarks</th>
                                    </tr>
                                    @if ($ph_meters)
                                    @foreach ($ph_meter_questions as $ph_meter_question)
                                    <tr>
                                        <td class="w-15">{{ $loop->index+1 }}</td>
                                        <td class="w-15">{{ $ph_meter_question }}</td>
                                        <td>{{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'response') }} </td>
                                        <td class="w-15">{{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'remark') }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @php
                            $Viscometer_questions = array(
                                    "Was instrument calibrated before start of analysis?",
                                    "Was sampled prepared as per STP?",
                                    "Was correct spindle used for analysis?",
                                    "Was Sufficient quantity used to performed the analysis?",
                                );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - Viscometer</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>
                                @if ($Viscometers)
                                @foreach ($Viscometer_questions as $Viscometer_question)
                                <tr>
                                    <td class="w-15">{{ $loop->index+1 }}</td>
                                    <td class="w-15">{{ $Viscometer_question }}</td>
                                    <td>{{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'response') }} </td>
                                    <td class="w-15">{{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'remark') }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        </div>


                        @php
                        $Melting_Point_questions = array(
                            "Was instrument calibrated before start of analysis?",
                            "Was sampled prepared as per STP?",
                            "Was sampled properly filled inside the capillary tube?",
                            "Were instrument properly connected at the time of analysis?",
                            "Was temperature of the instrument as per STP?",
                            "Was temperature acquired during analysis?",
                        );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - Melting Point</div>
                        <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @if ($Melting_Points)
                            @foreach ($Melting_Point_questions as $Melting_Point_question)
                            <tr>
                                <td class="w-15">{{ $loop->index+1 }}</td>
                                <td class="w-15">{{ $Melting_Point_question }}</td>
                                <td>{{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'response') }} </td>
                                <td class="w-15">{{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'remark') }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr>
                            @endif
                        </table>
                        </div>
                        </div>
                        @php

                        $Dis_solution_questions = array(
                        "Was dissolution appartus in calibrated state?",
                        "Was the instrument parameter as per STP?",
                        "Was the bowl temperature at the start and end of analysis as per STP ?",
                        "Was dissolution appartus clean before analysis?",
                        "Were the pH of dissolution medium as per STP?",
                        "Was correct volume of dissolution medium used for analysis?",
                        "Was correct Appartus used as per STP ?",
                        "Was the water level of dissolution bath as per SOP/recommendation?",
                        "Was Tablet/capsule/suspention dropped manually or was placed on dispensing tablet?",
                        "Was sampling involve profilling dissolution?",
                        "Was sampling done manually or using auto sampler?",
                        "Was filtration done immediately after sampling?",
                        "Was there any dilution of sample after withdrawl of sample?",
                        "Was correct  filter used for dilution?",
                        "While performing profilling ,  Does sample withdrawl at specific timeline as per STP?",
                        "Was Glassware used as per STP?",
                        "Was bowl temperature found 37°C ± 0.5 before start of analysis?",
                        );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - Dissolution</div>
                        <div class="border-table">
                        <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($Dis_solutions)
                        @foreach ($Dis_solution_questions as $Dis_solution_question)
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $Dis_solution_question }}</td>
                            <td>{{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'response') }} </td>
                            <td class="w-15">{{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'remark') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                        </table>
                        </div>
                        </div>
                        @php
                        $HPLC_GC_questions = array(
                        "Was analyst used correct column as per mentioned in STP?",
                        "Was Chromatography Condition/Instrument Parameter like Retention time, wavelength,
                        flow rate, injection volume, column temperature and autos ampler temperature as per mentioned in STP?",
                        "Was inlet filter sonicated before start of analysis?",
                        "Was suction of port A,port B,port C,port D and rinse port are working correctly?",
                        "Was corrected rinse solution used for analysis as per SOP? ",
                        "Was Buffer prepared as per mentioned in STP?",
                        "Is mobile phase within validity periods?",
                        "Is seal wash performed properly?",
                        "Whether analyst used corrected solution for column wash/seal wash before start of
                        analysis as per SOP ?",
                        "Was buffer solution filtered before start of analysis?",
                        "Was mobile phase maintained in recommended storage condition as per SOP/STP?",
                        "Was mobile phase sonicated before start of analysis?",
                        "Was sonication performed with appropriate time line or as per mentioned in STP?",
                        "Was mobile phase ration maintained as per STP?",
                        "Was Mobile phase prepared as per mentioned in STP?",
                        "Was buffer/ mobile phase pH as per STP?",
                        "Was mobile phase degassed before start of analysis?",
                        "Whether analyst used correct water for mobile phase,diluent, sample and standard preparation?",
                        "Was purge valve was closed before start of analysis?",
                        "Was the vial position as per mentioned in printed sequence?",
                        "Was analyst used appropriate test tubes for analysis?",
                        "Was septa of vial/fitment of septa/ filament of cap proper?",
                        "were capping/crimping of GC vial/HPLC Vial done properly?",
                        "Was analyst used the Bonded septa for analysis?",
                        "Was analyst used cleaned septa for analysis?",
                        "Was vial labelled as per SOP?",
                        "Is there any bubble observed inside pump port?",
                        "Was vial filled 3/4th capacity ?",
                        "Is There any pressure fluctuation observed in sample and standard run ?",
                        "Is it correct placebo used during the analysis?",
                        "Was the Glassware's used for preparation of same manufacture's?",
                        "Was standard and sample weighed & prepared as per STP?",
                        "Was analyst used correct dilution solution and made as per mentioned in STP?",
                        "Was analyst used correct filtration technique for analysis of sample?",
                        "Were all solutions injected within Validity periods?",
                        "Is there any sign of unfiltered and non degassed mobile phase?",
                        "Is there any system back pressure/Leakage observed during analysis?",
                        "Is system suitability result as per acceptance criteria?",
                        "Is there any hump interfering to peak integration, spilt peak observed?",
                        "Is Instrument calibrated state ?  ",
                        "Was cylinder level good before start of analysis?",
                        "Was instrument connected to properly during analysis?(Communication failure)",
                        "Was glass liner cleaned before analysis?",
                        "Was glass wool maintained properly? (change in color white to brown or black)",
                        "Was auto sampler work efficiently?",
                        "Is there color changes observed in oxytrap before and after analysis?(Check silica color)",
                        "Was jet cleaned before analysis?",
                        "Is there any leakage in cylinder?",
                        "Was column fitted properly before  start of analysis?(Check Ferrules and nuts)",
                        "Was vial rack work efficiently?",
                        "Was elevator movement up and down efficiently?",
                        "was column conditioning  before start of analysis?",
                        "Is there any column breakage observed during analysis?",
                        "was there syringe blockage check before analysis?",
                        "Was vial over-fitted?",
                        "Was analyst change the rubber septa before start of analysis?",
                        "Was chemical used of GC Grade?",
                        "Was calibrated micropipettes used for analysis?",
                        "Was tips sterilized before used?",
                        );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - HPLC GC</div>
                        <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>
                            @if ($HPLC_GCs)
                            @foreach ($HPLC_GC_questions as $HPLC_GC_question)
                            <tr>
                                <td class="w-15">{{ $loop->index+1 }}</td>
                                <td class="w-15">{{ $HPLC_GC_question }}</td>
                                <td>{{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'response') }} </td>
                                <td class="w-15">{{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'remark') }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr>
                            @endif
                        </table>
                        </div>
                        </div>

                        @php
                        $General_Checklist_questions = array(
                        "Was solid/Liquid Chemical used as per STP?",
                        "Was chemical used within validity periods?",
                        "Was correct chemical grade used for analysis?",
                        "Was analyst weighed the chemical as per mentioned in STP?",
                        "Was analyst used correct Reagent/Volumentrick solution for analysis",
                        "Were analyst used Cleaned and  Dried Glassware like volumetrik flask,Pippete,separating funnel & Beaker ? ",
                        "Wheather analyst used corrected glassware's as per mentioned in STP?",
                        "Is correct formulae used for calculation?",
                        "Is correct response used for calculation?",
                        "Is there any unauthorized change made in the formulae for calculation in excel sheet used for calculation",
                        "Are correct weights, area count, dilution, factors transcribed in calculation sheet?",
                        "Is correct specification, standard analytical procedure and version number used for analysis?",
                        "Is analyst Qualified to performed the analysis? (Qualificaition number)",
                        "Did analyst identify any usual finding during analysis?(Eg :- sample preparation,standard preparation)",
                        "Was sample store as per storage condition?",
                        "Was correct sample used for analysis?",
                        "Was there any unusual obervation with respect to description of sample?",
                        "Was correct Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard used for analysis?",
                        "Was potency of Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard as per COA?",
                        "Was Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard stored as per storage conditons?",
                        "Wheather instrument parameter as per STP?",
                        "Was Balance used for weighing within weighing range?",
                        "Was Balance used withing validity periods?",
                        "Was standard/Sample weights as per STP?",
                        "Was there any spillage reported by analyst during weighing and transfer?",
                        "Was sample/Standard diluted as per STP?",
                        "Was solution stored as per storage requirements?",
                        "Were chemical/Reagets used of same grade as per STP?",
                        "Were chemical/Reagets used within validity/Expiry periods as per STP?",
                        "Was correct filters and filtration technque used as STP?",
                        "Was sonication time and temperature maintained as per STP?",
                        "Were volumetric solution stored as per recommeded storage conditon?",
                        "Were volumetric solution used within validity periods?",
                        "Was appearance of sample solution satisfactory?",
                        "Was validated analytical method used for analysis?",
                        "Was method of analysis is inline with pharmacopial methods?",
                        "Is instrument used for analysis in calibrated state?",
                        "Is there any instrument breckdown before start of analysis?",


                        );
                        @endphp

                        <div class="block">
                            <div class="block-head"> CheckList - General</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th style="width: 5%;">Sr.No.</th>
                                        <th style="width: 40%;">Question</th>
                                        <th style="width: 20%;">Response</th>
                                        <th>Remarks</th>
                                    </tr>
                                    @if ($General_Checklists)
                                    @foreach ($General_Checklist_questions as $General_Checklist_question)
                                    <tr>
                                        <td class="w-15">{{ $loop->index+1 }}</td>
                                        <td class="w-15">{{ $General_Checklist_question }}</td>
                                        <td>{{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'response') }} </td>
                                        <td class="w-15">{{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'remark') }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        @php
                        $kF_Potentionmeter_questions = array(
                        "Was Correct Reagent used for analysis?",
                        "Was dried methanol used for analysis?",
                        "Was bureate withn calibrated state?",
                        "Was kF reagent used within validity periods?",
                        "Was sample quantity transfer comppletely in titration vessel ?",
                        "Is there any sample spillage observed on side walls of titration vessel  or out side of titration vessel?",
                        "Was silica found in good condition ?",
                        "Was electrode was saturated before start of analysis?",
                        "Was there any drift observed during analysis?",
                        "Was correct electrode used for analysis?",
                        "was power plug connection secure through out analsis?",
                        "Was inlet tube found bubble free ?",
                        "Was sample weight taken as per STP?",
                        "Was standardization performed before start of analysis?",
                        "Was electrode condtioning before start of analysis?",
                        "Is RSD of KF within limit as per SOP/STP?",
                        "Was activated desiccant used?",
                        "Was tip of nozzle correctly attached with delivery tube of volumetric solution reservior?",

                        );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - kF Potentionmeter</div>
                        <div class="border-table">
                        <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($kF_Potentionmeters)
                        @foreach ($kF_Potentionmeter_questions as $kF_Potentionmeter_question)
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $kF_Potentionmeter_question }}</td>
                            <td>{{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'response') }} </td>
                            <td class="w-15">{{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'remark') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                        </table>
                        </div>
                        </div>
                        @php
                        $RM_PM_questions = array(
                        "Was analyst Varified the GRN as per received samples?",
                        "Was analyst used calibrated balanced for sampling ?",
                        "Was analyst performed the correct sampling procedure?",
                        "Was sampling performed by trained personal?",
                        "Was analyst used the cleaned sampling tools for analysis?",
                        "Was  analyst used correct container for sampling ?",
                        "Was sample handled as per SOP?",
                        "Was any deviation observed during the receipt of material?",
                        "Was the material shipped as per recommended Transportation storage condition?",
                        "Is the COA received with material complying with the specification and no discrepancy was observed?",
                        "Was analyst performed the sampling inside the LAF?",
                        "Was the prefilter pressure efficient before start of sampling?",
                        "Was material stored as per recommeded storage conditon?",

                        );
                        @endphp
                        <div class="block">
                        <div class="block-head"> CheckList - RM PM</div>
                        <div class="border-table">
                        <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($kF_Potentionmeters)
                        @foreach ($RM_PM_questions as $RM_PM_questions)
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $RM_PM_questions }}</td>
                            <td>{{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'response') }} </td>
                            <td class="w-15">{{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'remark') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                        </table>
                        </div>
                        </div>
