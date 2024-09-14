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

    <script>
        $(document).ready(function() {
            let trainingPlanIndex = 1;

            $('#addTrainingPlan').click(function(e) {
                function generateTableRow(serialNumber) {
                    var employeeOptionsHtml = '<option value="">Select a value</option>';

                    var trainings = @json($trainings); 
                    var trainingOptionsHtml = '<option value="">-- Select --</option>';
                    trainings.forEach(training => {
                        trainingOptionsHtml += `<option value="${training.id}">${training.traning_plan_name}</option>`;
                    });

                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                            '<td><select class="training-select" name="trainingPlanData[' + trainingPlanIndex + '][trainingPlan]">' +
                                trainingOptionsHtml + '</select></td>' + 
                            '<td><input type="text" class="sops" name="trainingPlanData[' + trainingPlanIndex + '][sopName]" readonly></td>' +
                            '<td><input type="text" class="schedule-date" name="trainingPlanData[' + trainingPlanIndex + '][scheduleDate]" readonly></td>' +
                            '<td><select class="employee-select" name="trainingPlanData[' + trainingPlanIndex + '][employeeName]">' +
                                employeeOptionsHtml + '</select></td>' +
                            '<td><select name="trainingPlanData[' + trainingPlanIndex + '][trainingIdentification]">' +
                                '<option value="">-- Select --</option>' +
                                '<option value="Yes">Yes</option>' +
                                '<option value="No">No</option>' +
                            '</select></td>' +
                            '<td><input type="text" name="trainingPlanData[' + trainingPlanIndex + '][remarks]"></td>' +
                            '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';

                    trainingPlanIndex++;
                    return html;
                }

                var tableBody = $('#addTrainingPlanTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                tableBody.find('.training-select').last().change(function() {
                    var trainingId = $(this).val();
                    var row = $(this).closest('tr');

                    if (trainingId) {
                        $.ajax({
                            url: '/get-training-details/' + trainingId,
                            method: 'GET',
                            success: function(response) {
                                row.find('.sops').val(response.sop_numbers.join(', '));

                                row.find('.schedule-date').val(response.created_at);

                                var employeeSelect = row.find('.employee-select');
                                employeeSelect.empty();
                                employeeSelect.append('<option value="">Select a value</option>');
                                $.each(response.users, function(index, user) {
                                    employeeSelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                                });
                            },
                            error: function() {
                                alert('Failed to fetch training details.');
                            }
                        });
                    }
                });
            });
        });


    </script>

    <div class="form-field-head">
        <div class="pr-id">
            TNI
        </div>

    </div>


    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">

                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">External Training</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>

            </div>
            <form action="{{ route('tni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tab content -->
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="site_name">Site / Location <span class="text-danger">*</span></label>
                                        <select name="division_id">
                                            <option value="">Select Division</option>
                                            @if (!empty($division))
                                                @foreach ($division as $div)
                                                    <option value="{{ $div->id }}">{{ $div->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="site_name">Initiator <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="site_name">Initiation Date <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ date('d-M-Y') }}" disabled>
                                        <input type="hidden" name="initiation_date" value="{{ date('d-M-Y') }}">
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="site_name">Department <span class="text-danger">*</span></label>
                                        <select name="departments" id="departments">
                                            <option value="">Select Initiation Department</option>
                                            <option value="CQA" >Corporate Quality Assurance</option>
                                            <option value="QA" >Quality Assurance</option>
                                            <option value="QC" >Quality Control</option>
                                            <option value="QM" >Quality Control (Microbiology department)</option>
                                            <option value="PG" >Production General</option>
                                            <option value="PL" >Production Liquid Orals</option>
                                            <option value="PT" >Production Tablet and Powder</option>
                                            <option value="PE" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                            <option value="PC" >Production Capsules</option>
                                            <option value="PI" >Production Injectable</option>
                                            <option value="EN" >Engineering</option>
                                            <option value="HR" >Human Resource</option>
                                            <option value="ST" >Store</option>
                                            <option value="IT" >Electronic Data Processing</option>
                                            <option value="FD" >Formulation  Development</option>
                                            <option value="AL" >Analytical research and Development Laboratory</option>
                                            <option value="PD">Packaging Development</option>
                                            <option value="PU">Purchase Department</option>
                                            <option value="DC">Document Cell</option>
                                            <option value="RA">Regulatory Affairs</option>
                                            <option value="PV">Pharmacovigilance</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button"> <a href="{{ url('TMS') }}" class="text-white"> Exit </a> </button>
                            </div>

                        </div>
                    </div>


                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            TNI Details<button type="button" name="audit-agenda-grid"
                                                id="addTrainingPlan">+</button>
                                        </label>
                                        <table class="table table-bordered" id="addTrainingPlanTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Row#</th>
                                                    <th>Training Plan</th>
                                                    <th>SOP</th>
                                                    <th style="width: 10%;">Scheduled Date</th>
                                                    <th style="width: 10%;">Employee</th>
                                                    <th style="width: 10%;">Training Identification</th>
                                                    <th>Remark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input disabled type="text" name="trainingPlanData[0][serial]" value="1">
                                                    </td>
                                                    <td>
                                                        <select name="trainingPlanData[0][trainingPlan]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($trainings as $training)
                                                                <option value="{{ $training->id }}">{{ $training->traning_plan_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="trainingPlanData[0][sopName]" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="trainingPlanData[0][scheduleDate]" readonly>
                                                    </td>
                                                    <!-- <td>
                                                        <select name="trainingPlanData[0][employeeName]">
                                                            <option value="">Select a value</option>
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->employee_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td> -->
                                                    <td>
                                                        <select name="trainingPlanData[0][employeeName]" class="employee-select">
                                                            <option value="">Select a value</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="trainingPlanData[0][trainingIdentification]">
                                                            <option value="">Select a value</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="trainingPlanData[0][remarks]">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button"> <a href="{{ url('TMS') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Activated By">Activated By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Activated On">Activated On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for=" Rejected By">Retired By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Rejected On">Retired On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
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
            </form>
        </div>
    </div>

    <script>
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

        const saveButtons = document.querySelectorAll('.saveButton1');
        const form = document.getElementById('step-form');
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #designee, #hod'
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="trainingPlanData[0][trainingPlan]"]').change(function() {
                var trainingId = $(this).val();
                var row = $(this).closest('tr');

                if (trainingId) {
                    $.ajax({
                        url: '/get-training-details/' + trainingId,
                        method: 'GET',
                        success: function(response) {
                            var sopField = row.find('input[name="trainingPlanData[0][sopName]"]');
                            sopField.val(response.sop_numbers.join(', '));

                            row.find('input[name="trainingPlanData[0][scheduleDate]"]').val(response.created_at);

                            var employeeSelect = row.find('select[name="trainingPlanData[0][employeeName]"]');
                            employeeSelect.empty();
                            employeeSelect.append('<option value="">Select a value</option>');
                            $.each(response.users, function(index, user) {
                                employeeSelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to fetch training details.');
                        }
                    });
                }
            });
        });

    </script>

    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
@endsection
