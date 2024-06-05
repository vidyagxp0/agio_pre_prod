@extends('frontend.layout.main')
@section('container')
@php
        $users = DB::table('users')->get();
@endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>
    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

/*        
        #change-control-fields > div > div.inner-block.state-block > div.status > div.progress-bars.d-flex > div:nth-child(16){
            border-radius: 0px 20px 20px 0px;

        } */
        #statusBlock > div.progress-bars.d-flex > div:nth-child(15){
            border-radius: 0px 20px 20px 0px;

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
            $('#Info_Product_Material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                    '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_product_code]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_batch_no]" value=""></td>'+
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="DD-MMM-YYYY" />' +
                        '<input type="date" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_mfg_date_' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="DD-MMM-YYYY" />' +
                        '<input type="date" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_expiry_date' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_label_claim]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_pack_size]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_analyst_name]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_others_specify]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_process_sample_stage]" value=""></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_packing_material_type]"><option value="Primary">Primary</option><option value="Secondary">Secondary</option><option value="Tertiary">Tertiary</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_stability_for]"><option vlaue="Submission">Submission</option><option vlaue="Commercial">Commercial</option><option vlaue="Pack Evaluation">Pack Evaluation</option><option vlaue="Not Applicable">Not Applicable</option></select></td>' +
                    '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }
                    // html += '</select></td>' + 
                    return html;
                }

                var tableBody = $('#Info_Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- --------------------------------grid-2--------------------------->
    <script>
        $(document).ready(function() {
            $('#Details_Stability').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="hidden" name="identifier_details_stability[]" value="Details_Stability"><input type="text" id="stability_study_arnumber" name="stability_study_arnumber[]"></td>'+
                        '<td><input type="text" name="stability_study_condition_temprature_rh[]"></td>'+
                        '<td><input type="text" name="stability_study_Interval[]"></td>'+
                        '<td><input type="text" name="stability_study_orientation[]"></td>'+
                        '<td><input type="text" name="stability_study_pack_details[]"></td>'+
                        '<td><input type="text" name="stability_study_specification_no[]"></td>'+
                        '<td><input type="text" name="stability_study_sample_description[]"></td>'+
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="hidden" id="identifier_oos_detail" name="identifier_oos_detail[]" value="OOS Details"><input type="text" id="oos_arnumber" name="oos_arnumber[]"></td>'+
                            '<td><input type="text" name="oos_test_name[]"></td>' +
                            '<td><input type="text" name="oos_results_obtained[]"></td>' +
                            '<td><input type="text" name="oos_specification_limit[]"></td>' +
                            '<td><input type="text" name="oos_details_obvious_error[]"></td>' +
                            '<td><input type="file" name="oos_file_attachment[]"></td>' +
                            '<td><input type="text" name="oos_submit_by[]"></td>' +
                            '<td><input type="date" name="oos_submit_on[]"></td>' +
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="hidden" id="identifier_oos_capa" name="identifier_oos_capa[]" value="OOS Capa"><input type="text" id="info_oos_number" name="info_oos_number[]" value=""></td>' +
                        '<td><input type="text" name="info_oos_reported_date[]" value=""></td>' +
                        '<td><input type="text" name="info_oos_description[]" value=""></td>' +
                        '<td><input type="text" name="info_oos_previous_root_cause[]"value=""></td>' +
                        '<td><input type="text" name="info_oos_capa[]" value=""></td>' +
                        '<td><input type="date" name="info_oos_closure_date[]" value=""></td><option value="yes">Yes</option><option value="No">No</option></select></td>' +
                        '<td><input type="text" name="info_oos_capa_reference_number[]" value=""></td>' +
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' + 
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="hidden" name="identifier_oos_conclusion[]" value="identifier_oos_conclusion"><input type="text" name="summary_results_analysis_detials[]"></td>' +
                        '<td><input type="text" name="summary_results_hypothesis_experimentation_test_pr_no[]"></td>' +
                        '<td><input type="text" name="summary_results[]"></td>' +
                        '<td><input type="text" name="summary_results_analyst_name[]"></td>' +
                        '<td><input type="text" name="summary_results_remarks[]"></td>' +
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="hidden" name="identifier_oos_conclusion_review[]" value="identifier_oos_conclusion_review"><input type="text" name="conclusion_review_product_name[]"></td>' +
                        '<td><input type="text" name="conclusion_review_batch_no[]"></td>' +
                        '<td><input type="text" name="conclusion_review_any_other_information[]"></td>' +
                        '<td><input type="text" name="conclusion_review_action_affecte_batch[]"></td>' +
                        '</tr>';
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
    <!-- ======GRID END  =============-->

    <div class="form-field-head">
        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :
            QMS-North America / OOS
        </div>
    </div>



    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">
        <div id="change-control-fields">
        <div class="container-fluid">

            @include('frontend.OOS.comps.stage')


            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm18')">CheckList - Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">CheckList - Phase II Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Re-Open</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">QA Head/Designee Approval</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signature</button>

            </div>
          <form action="{{ route('oos.oosupdate', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
            <!-- Tab content -->
            
            <!-- General Information -->
            <!-- Tab content -->

            <!-- General Information -->
            @include('frontend.OOS.comps.general_information')

            <!-- Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary')

            <!-- CheckList - Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary_checklist')

            <!-- Preliminary Lab Inv. Conclusion -->
            @include('frontend.OOS.comps.preliminary_lab_conclusion')

            <!-- Preliminary Lab Invst. Review--->
            @include('frontend.OOS.comps.preliminary_lab_investigation')

            <!--Phase II Investigation -->
            @include('frontend.OOS.comps.phase_two_investigation')

            <!--CheckList Phase II Investigation -->
            @include('frontend.OOS.comps.checklist_phase_two')

            <!-- Phase II QC Review -->
            @include('frontend.OOS.comps.phase_two_qc')    

            <!--Additional Testing Proposal  -->
            @include('frontend.OOS.comps.additional_testing')

            <!--OOS Conclusion  -->
            @include('frontend.OOS.comps.oos_conclusion')

            <!--OOS Conclusion Review -->
            @include('frontend.OOS.comps.oos_conclusion_review')

            <!--CQ Review Comments -->
            @include('frontend.OOS.comps.oos_cq_review')

            <!-- Batch Disposition -->
            @include('frontend.OOS.comps.batch_disposition')

            <!-- Re-Open -->
            @include('frontend.OOS.comps.oos_reopen')    

            <!-- Under Addendum Approval -->
            @include('frontend.OOS.comps.under_approval')    

            <!--Under Addendum Execution -->
            @include('frontend.OOS.comps.under_execution')

            <!-- Under Addendum Review-->
            @include('frontend.OOS.comps.under_review')

            <!-- Under Addendum Verification -->
            @include('frontend.OOS.comps.under_verification')    

            <!----- Signature ----->
            @include('frontend.OOS.comps.signature')

        </div>


    </div>
    </form>

    </div>
    </div>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
        
        function setCurrentDate(item){
            if(item == 'yes'){
                $('#effect_check_date').val('{{ date('d-M-Y')}}');
            }
            else{
                $('#effect_check_date').val('');
            }
        }
        
    </script>

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
@endsection
