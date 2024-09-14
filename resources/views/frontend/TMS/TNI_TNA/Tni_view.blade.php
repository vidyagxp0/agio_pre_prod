@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(5) {
            border-radius: 0px 20px 20px 0px;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }
    </style>

    <script>
        $(document).ready(function() {
        let trainingPlanIndex = {{ isset($trainingPlanData) ? count($trainingPlanData) : 0 }}; // Start index for dynamic rows

        // Add a new row when "+" button is clicked
        $('#addTrainingPlan').click(function(e) {
            function generateTableRow(serialNumber) {
                var employeeOptionsHtml = '<option value="">Select a value</option>';
                var trainings = @json($trainings);
                var trainingOptionsHtml = '<option value="">-- Select --</option>';
                trainings.forEach(function(training) {
                    trainingOptionsHtml += '<option value="' + training.id + '">' + training.traning_plan_name + '</option>';
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

                trainingPlanIndex++; // Increment the index for the next row
                return html; // Return the generated HTML row
            }

            var tableBody = $('#addTrainingPlanTable tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1); // Generate new row
            tableBody.append(newRow); // Append the new row to the table

            // Add event handler for dynamically added training select dropdown
            tableBody.find('.training-select').last().change(function() {
                var trainingId = $(this).val();
                var row = $(this).closest('tr');

                if (trainingId) {
                    // Perform AJAX to fetch training details
                    $.ajax({
                        url: '/get-training-details/' + trainingId,
                        method: 'GET',
                        success: function(response) {
                            // Populate SOP Name and Scheduled Date fields
                            row.find('.sops').val(response.sop_numbers.join(', '));
                            row.find('.schedule-date').val(response.created_at);

                            // Populate the Employee dropdown
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

        // Event handler to remove rows dynamically
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove(); // Remove the row
        });
    });

    </script>
    <div class="form-field-head">
        <div class="pr-id">
            New Employee
        </div>
    </div>

    <div id="change-control-fields">

        <div class="cctab">

            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Employee</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">External Training</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>

        </div>
        <form action="{{ route('tni.update', $Tni->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab content -->
            <div id="step-form">

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="site_name">Name <span class="text-danger">*</span></label>
                                    <input type="text" id="site_division" name="site_division">
                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Joining Date">Joining Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="joining_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="joining_date"
                                            max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                            class="hide-input" oninput="handleDateInput(this, 'joining_date')" />
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                    Exit </a> </button>
                        </div>

                    </div>
                </div>
            </div>


            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    TNI Details
                                    <button type="button" name="audit-agenda-grid" id="addTrainingPlan">+</button>
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
                                        @if (isset($trainingPlanData) && is_array($trainingPlanData))
                                            @foreach ($trainingPlanData as $index => $data)
                                                <tr>
                                                    <td>
                                                        <input disabled type="text" name="trainingPlanData[{{ $index }}][serial]" value="{{ $index + 1 }}">
                                                    </td>
                                                    <td>
                                                        <!-- For the default row, add 'training-select-default' class -->
                                                        <select name="trainingPlanData[{{ $index }}][trainingPlan]" class="training-select-default">
                                                            <option value="">Select a value</option>
                                                            @foreach ($trainings as $training)
                                                                <option value="{{ $training->id }}" {{ $data['trainingPlan'] == $training->id ? 'selected' : '' }}>
                                                                    {{ $training->traning_plan_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <!-- SOP input field (for default row, no need for special class) -->
                                                        <input type="text" name="trainingPlanData[{{ $index }}][sopName]" class="sop-name" value="{{ $data['sopName'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <!-- Scheduled Date input field (for default row, no need for special class) -->
                                                        <input type="text" name="trainingPlanData[{{ $index }}][scheduleDate]" class="schedule-date" value="{{ $data['scheduleDate'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <!-- Employee dropdown for the default row -->
                                                        <select name="trainingPlanData[{{ $index }}][employeeName]" class="employee-select">
                                                            <option value="">Select a value</option>
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}" {{ $data['employeeName'] == $employee->id ? 'selected' : '' }}>
                                                                    {{ $employee->employee_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="trainingPlanData[{{ $index }}][trainingIdentification]">
                                                            <option value="">Select a value</option>
                                                            <option value="Yes" {{ $data['trainingIdentification'] == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $data['trainingIdentification'] == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="trainingPlanData[{{ $index }}][remarks]" value="{{ $data['remarks'] }}">
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
                        <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                Exit </a> </button>
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
            <!-- Activity Log content -->
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
            // Handle the change event for the default row's training select dropdown
            $('select.training-select-default').change(function() {
                var trainingId = $(this).val();
                var row = $(this).closest('tr');

                // Perform AJAX call to get the training details
                if (trainingId) {
                    $.ajax({
                        url: '/get-training-details/' + trainingId,  // Adjust the URL as per your route
                        method: 'GET',
                        success: function(response) {
                            // Populate SOP Name and Scheduled Date for the default row
                            row.find('.sops').val(response.sop_numbers.join(', '));
                            row.find('.schedule-date').val(response.created_at);

                            // Populate Employee dropdown
                            var employeeSelect = row.find('.employee-select');
                            employeeSelect.empty(); // Clear existing options
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
@endsection
