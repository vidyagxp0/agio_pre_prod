@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <!-- --------------------------------------button--------------------- -->

    <script>
        VirtualSelect.init({
            ele: '#related_records, #hod'
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

<!-- -----------------------------grid-1----------------------------script -->
    <script>
        $(document).ready(function() {
            $('#Product_Material').click(function(e) {
                let loopIndex= 0 ;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="info_of_product_material['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][item_product_code]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][batch_no]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][mfg_date]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][expiry_date]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][label_claim]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][pack_size]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][analyst_name]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][others_specify]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][in_process_sample_stage]"></td>'+
                        '<td><select name="info_of_product_material['+ loopIndex +'][packingMaterialType]"><option value="primary">Primary</option><option value="secondary">Secondary</option><option value="tertiary">Tertiary</option><option value="not_applicable">Not Applicable</option></select></td>'+
                        '<td><select name="info_of_product_material['+ loopIndex +'][stabilityfor]"><option value="submission">Submission</option><option value="commercial">Commercial</option><option value="pack_evaluation">Pack Evaluation</option><option value="not_applicable">Not Applicable</option></select></td>'+
                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

<!-- --------------------------------grid-2--------------------------script -->

    <script>
        $(document).ready(function() {
            $('#Details_Stability').click(function(e) {
                let loopIndex = 0 ;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +

                            '<td><input disabled type="text" name="stability_study['+ loopIndex +'][serial_no]" value="'+  serialNumber +'"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][ar_number]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][condition_temperature_rh]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][interval]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][orientation]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][pack_details]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][specification_no]"></td>'+
                            '<td><input type="text" name="stability_study['+ loopIndex +'][sample_description]"></td>'+

                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#Details_Stability_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- ------------------------------grid-3-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#OOS_Details').click(function(e) {
                let loopIndex = 0;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                       '<td><input disabled type="text" name="oos_details['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'+
                                        '<td><input type="text" name="oos_details['+ loopIndex +'][ar_number]"></td>'+
                                        '<td><input type="text" name="oos_details['+ loopIndex +'][test_name_of_oos]"></td>'+
                                        '<td><input type="text" name="oos_details['+ loopIndex +'][results_obtained]"></td>'+
                                        '<td><input type="text" name="oos_details['+ loopIndex +'][specification_limit]"></td>'+
                                        '<td><input type="text" name="oos_details['+ loopIndex +'][details_of_obvious_error]"></td>'+
                                        '<td><input type="file" name="oos_details['+ loopIndex +'][file_attachment_oos_details]"></td>'+


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#OOS_Details_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->

    <script>
        $(document).ready(function() {
            $('#oos_capa').click(function(e) {
                let loopIndex = 0

                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="info_product_oos_capa['+loopIndex+'][serial]" value="' + serialNumber +
                        '"></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][oos_number]"></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][oos_reported_date]"></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][description_of_oos]"></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][previous_oos_root_cause]"></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][capa]"></td>'+
                                        '<td><input type="text" name="info_product_oos_capa['+loopIndex+'][closure_date_of_capa]"></td>'+
                                        '<td><select name="info_product_oos_capa['+loopIndex+'][capa_Requirement]"><option  value="yes">Yes</option><option value="no">No</option></select></td>'+
                                       ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][reference_capa_number]"></td>'+
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';
                    return html;
                }

                var tableBody = $('#oos_capa_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <!-- -----------------------------grid-1----------OOS Conclusion ---------------- -->

    <script>
        $(document).ready(function() {
            $('#oos_conclusion').click(function(e) {
                let loopIndex = 0
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oos_conclusion['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'
                                    '<td><input type="text" name="oos_conclusion['+ loopIndex +'][analysis_details]"></td>'
                                    '<td><input type="text" name="oos_conclusion['+ loopIndex +'][hypo_exp_add_test_pr_no]"></td>'
                                    '<td><input type="text" name="oos_conclusion['+ loopIndex +'][results]"></td>'
                                   '<td><input type="text" name="oos_conclusion['+ loopIndex +'][analyst_name]"></td>'
                                   '<td><input type="text" name="oos_conclusion['+ loopIndex +'][Remarks]"></td>'
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';
                    return html;
                }
                var tableBody = $('#oos_conclusion_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <!-- -----------------------------grid-1----------OOSConclusion_Review ---------------- -->

    <script>
        $(document).ready(function() {
            $('#oosconclusion_review').click(function(e) {
                let loopIndex = 0;
                function generateTableRow(serialNumber) {
                    loopIndex++ ;

                    var html =
                        '<tr>' +
                      ' <td><input disabled type="text" name="oosConclusion_review['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][material_product_no]"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][batch_no_ar_no]"></td>'+
                                   ' <td><input type="text" name="oosConclusion_review['+ loopIndex +'][any_other_information]"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][action_taken_on_affecBatch]"></td>'+


                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#oosconclusion_review_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>



    <div class="form-field-head">

        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :
            QMS-North America / OOS_Micro
        </div>
    </div>



    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">
            <div id="change-control-fields">
                <div class="container-fluid">

                    @include('frontend.OOS_Micro.comps_micro.stage')

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm18')">Checklist - Investigation of Bacterial
                    Endotoxin Test</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">Checklist - Investigation of
                    Sterility</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Checklist - Investigation of Microbial
                    limit test/Bioburden and Water Test </button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist - Investigation of Microbial
                    assay</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Checklist - Investigation of Environmental
                    Monitoring</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm23')">Checklist - Investigation of MediaSuitability Test</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QC Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS CQ Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Re-Open</button>
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signature</button>--}}

            </div>

            <!-- General Information -->
            <form action="{{ route('oos_micro.update', $micro_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                 <!-- General Information -->
                @include('frontend.OOS_Micro.comps_micro.general_information')

        <!--2to 4  -->
        <!-- tap5to 22 -->
        <!-- Last Tap CCForm23 Checklist for Analyst training & Procedure -->
        <div id="CCForm23" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Analyst training & Procedure
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_analyst_training_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_analyst_training_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_analyst_training_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_analyst_training_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_analyst_training_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Comparison of results (With same & Previous Day Media GPT) :
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_comp_results_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_comp_results_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_comp_results_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_comp_results_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_comp_results_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Culture verification ?
                </div>
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
        'question' => "Was the storage condition of culture is appropriate?",
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_Culture_verification_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_Culture_verification_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_Culture_verification_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_Culture_verification_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_Culture_verification_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
            </div><div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Sterilize Accessories :
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sterilize_accessories_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sterilize_accessories_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sterilize_accessories_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sterilize_accessories_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'sterilize_accessories_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Instrument/Equipment Details:
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_intrument_equip_last_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_intrument_equip_last_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_intrument_equip_last_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_intrument_equip_last_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_intrument_equip_last_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Disinfectant Details:
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="disinfectant_details_last_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="disinfectant_details_last_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="disinfectant_details_last_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_last_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'disinfectant_details_last_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Results and Calculation :
                </div>
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
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_result_calculation_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_result_calculation_CIMT[{{$index}}][response]"
                                                        value="{{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'response', true, $index) ?? '' }}"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_result_calculation_CIMT[{{$index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_result_calculation_CIMT[{{$index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'checklist_for_result_calculation_CIMT', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="col-lg-12">

                                    <div class="group-input">

                                        <label for="Audit Attachments">If Yes, Provide attachment details</label>


                                        <div class="file-attachment-field">

                                            <div class="file-attachment-list" id="file_attach"></div>

                                            <div class="add-btn">

                                                <div>Add</div>

                                                <input type="file" id="myfile" name="attachment_details_cimst[]"

                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple/>

                                            </div>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                        onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit </a> </button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </form>
    </div>
</div>

<script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>
    <script>
        VirtualSelect.init({
            ele: '#facility_name, #group_name, #auditee, #audit_team'
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const removeButtons = document.querySelectorAll('.remove-file');

            removeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const fileName = this.getAttribute('data-file-name');
                    const fileContainer = this.closest('.file-container');

                    // Hide the file container
                    if (fileContainer) {
                        fileContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
