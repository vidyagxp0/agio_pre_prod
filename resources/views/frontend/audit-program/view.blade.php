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

    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp



    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var maxLength = 255;
            var descriptionField = document.getElementById('short_description');
            var remainingChars = document.getElementById('rchars');

            // Function to update the character count
            function updateCharCount() {
                var currentLength = descriptionField.value.length;
                var charsLeft = maxLength - currentLength;
                remainingChars.textContent = charsLeft;
            }

            // Initialize the character count on page load
            updateCharCount();

            // Add an event listener to the description field to update the count as the user types
            descriptionField.addEventListener('input', updateCharCount);
        });
    </script>


    <!-- <script>
        $(document).ready(function() {
            $('#audit_program').click(function(e) {
                e.preventDefault();

                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><div class="group-input"><select name="audit_program[' + serialNumber +
                        '][Auditees]"><option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                        '<td><div class="new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input class="click_date" id="Due_Date_' + serialNumber +
                        '" type="text" name="audit_program[' + serialNumber +
                        '][Due_Date]" placeholder="DD-MMM-YYYY" readonly />' +
                        '<input type="date" name="audit_program[' + serialNumber +
                        '][Due_Date]" id="Due_Date_' + serialNumber +
                        '_input"min="' + new Date().toISOString().split('T')[0] +
                        '"  class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'Due_Date_' +
                        serialNumber + '\'); updateEndDateMin(\'Due_Date_' + serialNumber +
                        '_input\', \'End_date_' + serialNumber + '_input\')" />' +
                        '</div>' +
                        '</div>' +
                        '</div></td>' +
                        '<td><div class="new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input class="click_date" id="End_date_' + serialNumber +
                        '" type="text" name="audit_program[' + serialNumber +
                        '][End_date]" placeholder="DD-MMM-YYYY" readonly />' +
                        '<input type="date" name="audit_program[' + serialNumber +
                        '][End_date]" id="End_date_' + serialNumber +
                        '_input" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'End_date_' +
                        serialNumber + '\')" />' +
                        '</div>' +
                        '</div>' +
                        '</div></td>' +
                        '<td><div class="group-input"><select name="audit_program[' + serialNumber +
                        '][Lead_Investigator]"><option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                        '<td><input type="text" name="audit_program[' + serialNumber + '][Comment]"></td>' +
                        '<td><button type="button" class="removeBtnaid">remove</button></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#audit_program-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                // Reattach date picker event listeners for newly added rows
                reattachDatePickers();
            });

            // Attach date picker event listeners for the initial rows
            reattachDatePickers();

            function reattachDatePickers() {
                $('.click_date').off('click').on('click', function() {
                    $(this).siblings('.show_date').click();
                });
            }

            window.handleDateInput = function(input, displayId) {
                var dateValue = input.value;
                var displayInput = document.getElementById(displayId);
                if (displayInput) {
                    displayInput.value = new Date(dateValue).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }).replace(/ /g, '-');
                }
            };

            window.updateEndDateMin = function(startDateId, endDateId) {
                var startDateInput = document.getElementById(startDateId);
                var endDateInput = document.getElementById(endDateId);

                if (startDateInput && endDateInput) {
                    var startDate = new Date(startDateInput.value);
                    if (startDate) {
                        endDateInput.min = startDate.toISOString().split('T')[0];
                    }
                }
            };

            // Initialize the date constraints for existing rows
            $('input[id^="Due_Date_"]').each(function() {
                var startDateId = $(this).attr('id') + '_input';
                var endDateId = $(this).attr('id').replace('Due_Date_', 'End_date_') + '_input';
                updateEndDateMin(startDateId, endDateId);
            });
        });
    </script> -->

    <script>
    $(document).ready(function() {
        $('#audit_program').click(function(e) {
            e.preventDefault();

            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><div class="group-input"><select name="audit_program[' + serialNumber + '][Auditees]">' +
                    '<option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                    '<td><div class="new-date-data-field">' +
                    '<div class="group-input input-date">' +
                    '<div class="calenderauditee">' +
                    '<input class="click_date" id="Due_Date_' + serialNumber + '" type="text" name="audit_program[' + serialNumber + '][Due_Date]" placeholder="DD-MMM-YYYY" readonly />' +
                    '<input type="date" name="audit_program[' + serialNumber + '][Due_Date]" id="Due_Date_' + serialNumber + '_input" min="' + new Date().toISOString().split('T')[0] + '" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'Due_Date_' + serialNumber + '\'); validateDates(\'Due_Date_' + serialNumber + '_input\', \'End_date_' + serialNumber + '_input\')" />' +
                    '</div></div></div></td>' +
                    '<td><div class="new-date-data-field">' +
                    '<div class="group-input input-date">' +
                    '<div class="calenderauditee">' +
                    '<input class="click_date" id="End_date_' + serialNumber + '" type="text" name="audit_program[' + serialNumber + '][End_date]" placeholder="DD-MMM-YYYY" readonly />' +
                    '<input type="date" name="audit_program[' + serialNumber + '][End_date]" id="End_date_' + serialNumber + '_input" min="' + new Date().toISOString().split('T')[0] + '" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, \'End_date_' + serialNumber + '\'); validateDates(\'Due_Date_' + serialNumber + '_input\', \'End_date_' + serialNumber + '_input\')" />' +
                    '</div></div></div></td>' +
                    '<td><div class="group-input"><select name="audit_program[' + serialNumber + '][Lead_Investigator]">' +
                    '<option value="">Select a value</option>@foreach ($users as $value)<option value="{{ $value->name }}">{{ $value->name }}</option>@endforeach</select></div></td>' +
                    '<td><input type="text" name="audit_program[' + serialNumber + '][Comment]"></td>' +
                    '<td><button type="button" class="removeBtnaid">remove</button></td>' +
                    '</tr>';
                return html;
            }

            var tableBody = $('#audit_program-field-instruction-modal tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);

            reattachDatePickers();
        });

        reattachDatePickers();

        function reattachDatePickers() {
            $('.click_date').off('click').on('click', function() {
                $(this).siblings('.show_date').click();
            });

            // Attach input listeners to validate dates as they are being selected
            $('input[type="date"]').each(function() {
                $(this).on('input', function() {
                    var startDateId = $(this).closest('tr').find('input[id^="Due_Date_"]').attr('id') + '_input';
                    var endDateId = $(this).closest('tr').find('input[id^="End_date_"]').attr('id') + '_input';
                    validateDates(startDateId, endDateId);
                });
            });
        }

        window.handleDateInput = function(input, displayId) {
            var dateValue = input.value;
            var displayInput = document.getElementById(displayId);
            if (displayInput) {
                displayInput.value = new Date(dateValue).toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                }).replace(/ /g, '-');
            }
        };

        window.validateDates = function(startDateId, endDateId) {
            var startDateInput = document.getElementById(startDateId);
            var endDateInput = document.getElementById(endDateId);

            if (startDateInput && endDateInput) {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate && endDate) {
                    // Start Date validation
                    if (startDate > endDate) {
                        alert('Start Date cannot be greater than End Date');
                        startDateInput.value = '';
                    }

                    // End Date validation
                    if (endDate < startDate) {
                        alert('End Date cannot be less than Start Date');
                        endDateInput.value = '';
                    }

                    // Update minimum values dynamically
                    endDateInput.min = startDate.toISOString().split('T')[0];
                    startDateInput.max = endDate.toISOString().split('T')[0];
                }
            }
        };

        // Initialize the date constraints for existing rows
        $('input[id^="Due_Date_"]').each(function() {
            var startDateId = $(this).attr('id') + '_input';
            var endDateId = $(this).attr('id').replace('Due_Date_', 'End_date_') + '_input';
            validateDates(startDateId, endDateId);
        });
    });
</script>


    <script>
        $(document).on('click', '.removeBtnaid', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeRowBtncd', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).ready(function() {
            // Function to generate options for the Person Responsible dropdown
            function generateOptions(users) {
                var options = '<option value="">Select a value</option>';
                users.forEach(function(user) {
                    options += '<option value="' + user.id + '">' + user.name + '</option>';
                });
                return options;
            }

            // Function to generate a new row in the CAPA Details table
            function generateTableRow(serialNumber, users) {
                var options = generateOptions(users);
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="Self_Inspection[' + serialNumber +
                    '][serial_number]" value="' + serialNumber + '"></td>' +
                    '<td>' +
                    '<select name="Self_Inspection[' + serialNumber + '][department]" id="department_' +
                    serialNumber + '" ' +
                    '{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>' +
                    '<option selected disabled value="">--- select ---</option>' +
                    '@foreach (Helpers::getDepartments() as $code => $department)' +
                    '<option value="{{ $department }}" data-code="{{ $code }}" ' +
                    '@if ($data->department == $department) selected @endif>' +
                    '{{ $department }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="Months' + serialNumber + '" multiple placeholder="Select..." ' +
                    'data-search="false" data-silent-initial-value-set="true" ' +
                    'name="Self_Inspection[' + serialNumber + '][Months]">' +
                    // '<option value="">Select a month</option>' +
                    '<option value="Jan">January</option>' +
                    '<option value="Feb">February</option>' +
                    '<option value="March">March</option>' +
                    '<option value="April">April</option>' +
                    '<option value="May">May</option>' +
                    '<option value="June">June</option>' +
                    '<option value="July">July</option>' +
                    '<option value="Aug">August</option>' +
                    '<option value="Sept">September</option>' +
                    '<option value="Oct">October</option>' +
                    '<option value="Nov">November</option>' +
                    '<option value="Dec">December</option>' +
                    '</select>' +
                    '</td>' +
                    '<td><input type="text" name="Self_Inspection[' + serialNumber +
                    '][Remarked]"></td>' +
                    '<td><button type="button" class="removeBtn">Remove</button></td>' +
                    '</tr>';
                return html;
            }

            // Initial users data - Replace with your actual data
            var users = @json($users);

            // Event listener for adding new rows
            $('#Self_Inspection').click(function(e) {
                e.preventDefault();

                var tableBody = $('#Self_Inspection-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1, users);
                tableBody.append(newRow);

                // Initialize VirtualSelect after adding the new row
                VirtualSelect.init({
                    ele: '[id^=Months], #team_members, #training-require, #impacted_objects'
                });
            });

            // Event delegation for remove button
            $('#Self_Inspection-field-instruction-modal').on('click', '.removeBtn', function() {
                $(this).closest('tr').remove();
            });

            // Function to handle date input change
            window.handleDateInput = function(dateInput, displayInputId) {
                var date = new Date(dateInput.value);
                var options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                var formattedDate = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                $('#' + displayInputId).val(formattedDate);
            };
        });
    </script>

    <script>
        $(document).on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeBtns', function() {
            $(this).closest('tr').remove();
        })
    </script>

    <script>
        $(document).ready(function () {
            // Function to initialize VirtualSelect
            function initializeVirtualSelect() {
                VirtualSelect.init({
                    ele: ".analyst-dropdown",
                    multiple: true,
                    search: true,
                    placeholder: ""
                });
            }

            // Function to generate a new row in the table
            function generateTableRow(serialNumber) {
                var analystOptions = `@foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach`;

                var html =
                    `<tr>
                        <td>
                            <input disabled type="text" name="Self_Inspection_circular[${serialNumber}][serial_number]" value="${serialNumber}">
                        </td>

                        <td>
                            <select name="Self_Inspection_circular[${serialNumber}][departments]" id="departments_${serialNumber}" 
                            {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                <option selected disabled value="">--- select ---</option>
                                @foreach (Helpers::getDepartments() as $code => $departments)
                                <option value="{{ $departments }}" data-code="{{ $code }}" 
                                @if ($data->departments == $departments) selected @endif>
                                    {{ $departments }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <div class="new-date-data-field">
                                <div class="group-input input-date">
                                    <div class="calenderauditee">
                                        <input class="click_date" id="date_display_${serialNumber}" type="text" name="Self_Inspection_circular[${serialNumber}][info_mfg_date]" placeholder="DD-MMM-YYYY" readonly />
                                        <input type="date" name="Self_Inspection_circular[${serialNumber}][info_mfg_date]" id="date_input_${serialNumber}" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" onchange="handleDateInput(this, 'date_display_${serialNumber}')">
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="analyst-dropdown-container">
                                <select class="analyst-dropdown" name="Self_Inspection_circular[${serialNumber}][Auditor]" multiple>
                                    ${analystOptions}
                                </select>
                            </div>
                        </td>

                        <td>
                            <button type="button" class="removeBtn">Remove</button>
                        </td>
                    </tr>`;

                return html;
            }

            // Add new row event
            $('#Self_Inspection_circular').on('click', function (e) {
                e.preventDefault();
                var tableBody = $('#Self_Inspection_circular-field-instruction-modal tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);

                // Initialize VirtualSelect for new rows
                initializeVirtualSelect();
            });

            // Remove row event (Event Delegation)
            $('#Self_Inspection_circular-field-instruction-modal').on('click', '.removeBtn', function () {
                $(this).closest('tr').remove();
            });

            // Attach date picker event listeners using Event Delegation
            $('#Self_Inspection_circular-field-instruction-modal').on('click', '.click_date', function () {
                $(this).siblings('.show_date').click();
            });

            // Initialize VirtualSelect for existing rows on page load
            initializeVirtualSelect();
        });
    </script>









    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let country_arr = new Array("-- Select --", "AUSTRALIA", "INDIA", "NEW ZEALAND", "USA", "UAE",
                "MAURITIUS");

            $.each(country_arr, function(i, item) {
                $('#country').append($('<option>', {
                    value: i,
                    text: item,
                }, '</option>'));
            });

            let s_a = new Array();
            s_a[0] = "-- Select --";
            s_a[1] = "-- Select --|QUEENSLAND|VICTORIA";
            s_a[2] =
                "-- Select --|ANDHRAPRADESH|KARNATAKA|TAMILNADU|DELHI|GOA|WEST-BENGAL|GUJARAT|MADHYAPRADESH|MAHARASHTRA|RAJASTHAN";
            s_a[3] = "-- Select --|AUCKLAND";
            s_a[4] = "-- Select --|NEWJERSEY|ILLINOIS";
            s_a[5] = "-- Select --|DUBAI";
            s_a[6] = "-- Select --|MAURITIUS";

            let c_a = new Array();
            c_a['QUEENSLAND'] = "-- Select --|BRISBANE";
            c_a['VICTORIA'] = "-- Select --|MELBOURNE";
            c_a['ANDHRAPRADESH'] = "-- Select --|HYDERABAD";
            c_a['KARNATAKA'] = "-- Select --|BANGLORE";
            c_a['TAMILNADU'] = "-- Select --|CHENNAI";
            c_a['DELHI'] = "-- Select --|DELHI";
            c_a['GOA'] = "-- Select --|GOA";
            c_a['W-BENGAL'] = "-- Select --|KOLKATA";
            c_a['GUJARAT'] =
                "-- Select --|AHMEDABAD1|AHMEDABAD2|AHMEDABAD3|BARODA|BHAVNAGAR|MEHSANA|RAJKOT|SURAT|UNA";
            c_a['MADHYAPRADESH'] = "-- Select --|INDORE";
            c_a['MAHARASHTRA'] = "-- Select --|MUMBAI|PUNE";
            c_a['RAJASTHAN'] = "-- Select --|ABU";
            c_a['AUCKLAND'] = "-- Select --|AUCKLAND";
            c_a['NEWJERSEY'] = "-- Select --|EDISON";
            c_a['ILLINOIS'] = "-- Select --|CHICAGO";
            c_a['MAURITIUS'] = "-- Select --|MAURITIUS";
            c_a['DUBAI'] = "-- Select --|DUBAI";

            $('#country').change(function() {
                let c = $(this).val();
                let state_arr = s_a[c].split("|");
                $('#state').empty();
                $('#city').empty();
                if (c == 0) {
                    $('#state').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                } else {
                    $.each(state_arr, function(i, item_state) {
                        $('#state').append($('<option>', {
                            value: item_state,
                            text: item_state,
                        }, '</option>'));
                    });
                }
                $('#city').append($('<option>', {
                    value: '0',
                    text: '-- Select --',
                }, '</option>'));
            });

            $('#state').change(function() {
                let s = $(this).val();
                if (s == '-- Select --') {
                    $('#city').empty();
                    $('#city').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                }
                let city_arr = c_a[s].split("|");
                $('#city').empty();

                $.each(city_arr, function(j, item_city) {
                    $('#city').append($('<option>', {
                        value: item_city,
                        text: item_city,
                    }, '</option>'));
                });

            });
        });
    </script>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Audit Program
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>
                    @php
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('showAuditProgramTrial', $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1 && (Helpers::check_roles($data->division_id, 'Audit Program', 7) || Helpers::check_roles($data->division_id, 'Audit Program', 66)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 2 && Helpers::check_roles($data->division_id, 'Audit Program', 4))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Audit Program', 9) || Helpers::check_roles($data->division_id, 'Audit Program', 65)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Audit Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Pending Approval </div>
                            @else
                                <div class="">Pending Approval</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Pending Audit</div>
                            @else
                                <div class="">Pending Audit</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">

            @php
                $users = DB::table('users')->get();
            @endphp
            {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Self Inspection Circular</button>
                        <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">HOD/Designee Review</button> -->
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CQA/QA Head Approval</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CQA/QA Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Activity Log</button>

                    </div>

                    <form action="{{ route('AuditProgramUpdate', $data->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">General Information</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/AP/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text"
                                                    name="division_code"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator</b></label>
                                                {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                                <input disabled type="text" value="{{ $data->initiator_name }}">
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="due_date">Due Date</label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention
                                                        revision
                                                        reason in "Due Date Extension Justification" data field.</small>
                                                </div>
                                                <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY"
                                                    value="{{ \Carbon\Carbon::parse($due_date)->format('d-M-Y') }}" />
                                                <input type="hidden" name="due_date" id="due_date_input"
                                                    value="{{ $due_date }}" />
                                            </div>
                                        </div> -->

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Short Description">Initiator Department <span
                                                        class="text-danger"></span></label>
                                                <select name="Initiator_Group" id="Initiator_Group"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option selected disabled value="">---select---</option>
                                                    @foreach (Helpers::getInitiatorGroups() as $code => $Initiator_Group)
                                                        <option value="{{ $Initiator_Group }}"
                                                            data-code="{{ $code }}"
                                                            @if ($data->Initiator_Group == $Initiator_Group) selected @endif>
                                                            {{ $Initiator_Group }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator Department</b></label>
                                                <input readonly type="text" name="Initiator_Group" id="Initiator_Group" 
                                                    value="{{ $data->Initiator_Group }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiation Group Code">Initiator Department code</label>
                                                <input type="text" name="initiator_group_code"
                                                    value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                                    readonly>
                                                {{-- <div class="default-name"> <span
                                                id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                            </div>
                                        </div>




                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Department code</label>
                                                <input readonly type="text" name="initiator_group_code"
                                                    id="initiator_group_code"
                                                    value="{{ $data->initiator_group_code ?? '' }}"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">

                                                {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                </label>
                                                <select id="assign_to" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    {{ $data->stage == 1 ? 'required' : '' }}>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $key => $value)
                                                        @php
                                                            $departmentName = Helpers::getUsersDepartmentName($value->departmentid);
                                                        @endphp

                                                        <option value="{{ $value->name }}" data-department="{{ $departmentName }}"
                                                            @if ($data->assign_to == $value->name) selected @endif>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To Department<span class="text-danger"></span>
                                                </label>

                                                <input type="text" id="assign_to_department" name="assign_to_department" class="form-control" 
                                                    value="{{ old('assign_to_department', $data->assign_to_department ?? '') }}" readonly>

                                                @error('assign_to_department')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById('assign_to').addEventListener('change', function () {
                                                let selectedOption = this.options[this.selectedIndex];
                                                let department = selectedOption.getAttribute('data-department') || '';

                                                // Populate the input field
                                                document.getElementById('assign_to_department').value = department;
                                            });
                                        </script>

                                        {{-- <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Due Date <span class="text-danger"></span></label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                <input readonly type="text" --}}
                                        {{-- value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                    name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="short_description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                <span id="rchars">255</span> characters remaining
                                                <input type="text" name="short_description" id="short_description"
                                                  {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    value="{{ $data->short_description }}" maxlength="255" required>
                                            </div>
                                        </div>


                                        <script>
                                            document.getElementById('Initiator_Group').addEventListener('change', function() {
                                                var selectedOption = this.options[this.selectedIndex];
                                                var selectedCode = selectedOption.getAttribute('data-code');
                                                document.getElementById('initiator_group_code').value = selectedCode;
                                            });

                                            // Set the group code on page load if a value is already selected
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var initiatorGroupElement = document.getElementById('initiator_group');
                                                if (initiatorGroupElement.value) {
                                                    var selectedOption = initiatorGroupElement.options[initiatorGroupElement.selectedIndex];
                                                    var selectedCode = selectedOption.getAttribute('data-code');
                                                    document.getElementById('initiator_group_code_gi').value = selectedCode;
                                                }
                                            });
                                        </script>
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue
                                                    seriousness, guiding priority for corrective actions. Ranging from low
                                                    to high, they ensure quality standards and mitigate critical
                                                    risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    name="severity1_level">
                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->severity1_level == 'minor') selected @endif
                                                        value="minor">Minor</option>
                                                    <option @if ($data->severity1_level == 'major') selected @endif
                                                        value="major">Major</option>
                                                    <option @if ($data->severity1_level == 'critical') selected @endif
                                                        value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small>
                                                </div>
                                                <select name="initiated_through"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    onchange="toggleInitiatedThroughField(this)">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">Return</option>
                                                    <option @if ($data->initiated_through == 'deviation') selected @endif
                                                        value="deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'complaint') selected @endif
                                                        value="complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'regulatory') selected @endif
                                                        value="regulatory">Regulatory</option>
                                                    <option @if ($data->initiated_through == 'lab-incident') selected @endif
                                                        value="lab-incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'improvement') selected @endif
                                                        value="improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'others') selected @endif
                                                        value="others">Others</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6" id="initiated_through_req_container"
                                            style="display: none;">
                                            <div class="group-input">
                                                <label for="initiated_through">Others<span
                                                        class="text-danger">*</span></label>
                                                <textarea name="initiated_through_req" id="initiated_through_req_textarea"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div>

                                        <script>
                                            function toggleInitiatedThroughField(selectElement) {
                                                var initiatedThroughReqContainer = document.getElementById('initiated_through_req_container');
                                                var initiatedThroughReqTextarea = document.getElementById('initiated_through_req_textarea');
                                                if (selectElement.value === 'others') {
                                                    initiatedThroughReqContainer.style.display = 'block';
                                                    initiatedThroughReqTextarea.setAttribute('required', 'required');
                                                } else {
                                                    initiatedThroughReqContainer.style.display = 'none';
                                                    initiatedThroughReqTextarea.removeAttribute('required');
                                                }
                                            }

                                            // Call the function on page load to set the initial state
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var initiatedThroughSelect = document.querySelector('select[name="initiated_through"]');
                                                toggleInitiatedThroughField(initiatedThroughSelect);
                                            });
                                        </script>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Type">
                                                    Type <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                </label>
                                                <select name="type"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    {{ $data->stage == 1 ? 'required' : '' }}
                                                    onchange="toggleOtherField(this)">
                                                    <option value="">-- Select --</option>
                                                    <option value="Vendor/Supplier"
                                                        @if ($data->type == 'Vendor/Supplier') selected @endif>Vendor/Supplier
                                                    </option>
                                                    <option value="Self Inspection"
                                                        @if ($data->type == 'Self Inspection') selected @endif>Self Inspection
                                                    </option>
                                                    <option value="Internal Audit"
                                                        @if ($data->type == 'Internal Audit') selected @endif>Internal Audit
                                                    </option>
                                                    <option value="Other"
                                                        @if ($data->type == 'Other') selected @endif>Other
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6" id="through_req_container" style="display: none;">
                                            <div class="group-input">
                                                <label for="through_req">Type(Others)<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span></label>
                                                <textarea name="through_req" id="through_req_textarea"
                                                {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    {{ $data->stage == 1 ? 'required' : '' }} > {{ $data->through_req }}</textarea>
                                            </div>
                                        </div>

                                        <script>
                                            function toggleOtherField(selectElement) {
                                                var throughReqContainer = document.getElementById('through_req_container');
                                                var throughReqTextarea = document.getElementById('through_req_textarea');
                                                if (selectElement.value === 'Other') {
                                                    throughReqContainer.style.display = 'block';
                                                    throughReqTextarea.setAttribute('required', 'required');
                                                } else {
                                                    throughReqContainer.style.display = 'none';
                                                    throughReqTextarea.removeAttribute('required');
                                                }
                                            }

                                            // Call the function on page load to set the initial state
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var typeSelect = document.querySelector('select[name="type"]');
                                                toggleOtherField(typeSelect);
                                            });
                                        </script>



                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Year">
                                                    Initiated Through<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                 </label>
                                                <select name="year"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}{{ $data->stage == 1 ? 'required' : '' }} onchange="toggleTabField(this)">
                                                    <option value="">-- Select --</option>
                                                    <option value="Yearly Planner"
                                                        @if ($data->year == 'Yearly Planner') selected @endif>Yearly Planner</option>
                                                    <option value="Monthly Planner"
                                                        @if ($data->year == 'Monthly Planner') selected @endif>Monthly Planner</option>
                                                    <option value="Other"
                                                        @if ($data->year == 'Other') selected @endif>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="yearly_container" style="display: none;">
                                            <div class="group-input">
                                                <label for="yearly_other">Initiated Through(Others)<span
                                                        class="text-danger">*</span></label>
                                                <textarea name="yearly_other" id="yearly_container_data"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    {{ $data->stage == 1 ? 'required' : '' }}
                                                    >{{ $data->yearly_other }}</textarea>
                                            </div>
                                        </div>

                                        <script>
                                            function toggleTabField(selectElement) {
                                                var throughReqContainer = document.getElementById('yearly_container');
                                                var throughReqTextarea = document.getElementById('yearly_container_data');
                                                if (selectElement.value === 'Other') {
                                                    throughReqContainer.style.display = 'block';
                                                    throughReqTextarea.setAttribute('required', 'required');
                                                } else {
                                                    throughReqContainer.style.display = 'none';
                                                    throughReqTextarea.removeAttribute('required');
                                                }
                                            }

                                            // Call the function on page load to set the initial state
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var typeSelect = document.querySelector('select[name="year"]');
                                                toggleTabField(typeSelect);
                                            });
                                        </script>

                                        <!-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Months">Months</label>
                                                <select name="Months"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="January"
                                                        @if ($data->Months == 'January') selected @endif>January</option>
                                                    <option value="February"
                                                        @if ($data->Months == 'February') selected @endif>February
                                                    </option>
                                                    <option value="March"
                                                        @if ($data->Months == 'March') selected @endif>March</option>
                                                    <option value="April"
                                                        @if ($data->Months == 'April') selected @endif>April</option>
                                                    <option value="May"
                                                        @if ($data->Months == 'May') selected @endif>May</option>
                                                    <option value="June"
                                                        @if ($data->Months == 'June') selected @endif>June</option>
                                                    <option value="July"
                                                        @if ($data->Months == 'July') selected @endif>July</option>
                                                    <option value="August"
                                                        @if ($data->Months == 'August') selected @endif>August</option>
                                                    <option value="September"
                                                        @if ($data->Months == 'September') selected @endif>September
                                                    </option>
                                                    <option value="October"
                                                        @if ($data->Months == 'October') selected @endif>October</option>
                                                    <option value="November"
                                                        @if ($data->Months == 'November') selected @endif>November
                                                    </option>
                                                    <option value="December"
                                                        @if ($data->Months == 'December') selected @endif>December
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quarter">Quarter</label>
                                                <select name="Quarter"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="Q1"
                                                        @if ($data->Quarter == 'Q1') selected @endif>Q1
                                                    </option>
                                                    <option value="Q2"
                                                        @if ($data->Quarter == 'Q2') selected @endif>Q2
                                                    </option>
                                                    <option value="Q3"
                                                        @if ($data->Quarter == 'Q3') selected @endif>Q3
                                                    </option>
                                                    <option value="Q4"
                                                        @if ($data->Quarter == 'Q4') selected @endif>Q4
                                                    </option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <!-- ----------------------------------Audit program grid----------------------------------- -->

                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="audit-program-grid">
                                                    Audit Program<button type="button" name="ann"
                                                        onclick="addAuditProgram('audit-program-grid')"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="audit-program-grid">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%">Row #</th>
                                                            <th>Auditees</th>
                                                            <th>Date Start</th>
                                                            <th>Date End</th>
                                                            <th>Lead Investigator</th>
                                                            <th>Comment</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($AuditProgramGrid)
                                                            @foreach (unserialize($AuditProgramGrid->auditor) as $key => $temps)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="serial_number[]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                            value="{{ $key + 1 }}"></td>
                                                                    <td> <select id="select-state" placeholder="Select..."
                                                                            name="Auditees[]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                            <option value="">-Select-</option>
                                                                            @foreach ($users as $value)
                                                                                <option
                                                                                    {{ unserialize($AuditProgramGrid->auditor)[$key] ? (unserialize($AuditProgramGrid->auditor)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                                    value="{{ $value->id }}">
                                                                                    {{ $value->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select></td>


                                                                    <td>
                                                                        <div class="group-input new-date-data-field mb-0">
                                                                            <div class="input-date ">
                                                                                <div class="calenderauditee">
                                                                                    <input type="text"
                                                                                        id="start_date{{ $key }}"
                                                                                        readonly placeholder="DD-MMM-YYYY"
                                                                                        value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->start_date)[$key]) }}" />
                                                                                    <input class="hide-input"
                                                                                        type="date"
                                                                                        id="start_date{{ $key }}_checkdate"
                                                                                        value="{{ unserialize($AuditProgramGrid->start_date)[$key] }}"
                                                                                        name="start_date[]"
                                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->start_date)[$key]) }}
                                                                                   oninput="handleDateInput(this,
                                                                                        `start_date' + serialNumber +'`)" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="group-input new-date-data-field mb-0">
                                                                            <div class="input-date ">
                                                                                <div class="calenderauditee">
                                                                                    <input type="text"
                                                                                        id="end_date{{ $key }}"
                                                                                        readonly placeholder="DD-MMM-YYYY"
                                                                                        value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->end_date)[$key]) }}" />
                                                                                    <input class="hide-input"
                                                                                        type="date"
                                                                                        id="end_date{{ $key }}_checkdate"
                                                                                        value="{{ unserialize($AuditProgramGrid->end_date)[$key] }}"
                                                                                        name="end_date[]"
                                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->end_date)[$key]) }}
                                                                                        oninput="handleDateInput(this,
                                                                                        `end_date' + serialNumber +'`)" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <select id="select-state" placeholder="Select..."
                                                                            name="lead_investigator[]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                            <option value=""> --Select--</option>
                                                                            @foreach ($users as $value)
                                                                                <option
                                                                                    {{ unserialize($AuditProgramGrid->lead_investigator)[$key] ? (unserialize($AuditProgramGrid->lead_investigator)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                                    value="{{ $value->id }}">
                                                                                    {{ $value->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select></td>
                                                                    @php
                                                                        $comments = is_array(
                                                                            unserialize($AuditProgramGrid->comment),
                                                                        )
                                                                            ? unserialize($AuditProgramGrid->comment)
                                                                            : [];
                                                                    @endphp

                                                                    <td>
                                                                        <input type="text" name="comment[]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                            value="{{ isset($comments[$key]) ? $comments[$key] : '' }}">
                                                                    </td>


                                                                    <td>
                                                                        <button type="button"
                                                                            class="removeRowBtncd">remove</button>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> --}}

                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                Audit Program<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                <button type="button" name="audit-agenda-grid" id="audit_program"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    {{ $data->stage == 1 ? 'required' : '' }} >+</button>
                                               
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered"
                                                    id="audit_program-field-instruction-modal">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%">Sr. No.</th>
                                                            <th style="width: 12%">Auditees</th>
                                                            <th style="width: 15%">Date Start</th>
                                                            <th style="width: 15%">Date End</th>
                                                            <th style="width: 15%">Lead Auditor</th>
                                                            <th style="width: 15%">Comment</th>
                                                            <th style="width: 5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($grid_Data3 && is_array($grid_Data3->data))
                                                            @foreach ($grid_Data3->data as $grid)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="audit_program[{{ $loop->index }}][serial_number]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                            value="{{ $loop->index + 1 }}"></td>
                                                                    <td>
                                                                        <div class="col-lg-6">
                                                                            <div class="group-input">
                                                                                <select
                                                                                    name="audit_program[{{ $loop->index }}][Auditees]"
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                                    <option value="">
                                                                                        Select a value
                                                                                    </option>
                                                                                    @if ($users->isNotEmpty())
                                                                                        @foreach ($users as $value)
                                                                                            <option
                                                                                                value="{{ $value->name }}"
                                                                                                {{ isset($grid['Auditees']) && $grid['Auditees'] == $value->name ? 'selected' : '' }}>
                                                                                                {{ $value->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="new-date-data-field">
                                                                            <div class="group-input input-date">
                                                                                <div class="calenderauditee">
                                                                                    <input class="click_date"
                                                                                        id="Due_Date_{{ $loop->index }}"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        type="text"
                                                                                        name="audit_program[{{ $loop->index }}][Due_Date]"
                                                                                        value="{{ isset($grid['Due_Date']) ? \Carbon\Carbon::parse($grid['Due_Date'])->format('d-M-Y') : '' }}"
                                                                                        placeholder="DD-MMM-YYYY"
                                                                                        readonly />
                                                                                    <input type="date"
                                                                                        name="audit_program[{{ $loop->index }}][Due_Date]"
                                                                                        id="Due_Date_{{ $loop->index }}_input"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        value="{{ isset($grid['Due_Date']) ? $grid['Due_Date'] : '' }}"
                                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                        class="hide-input"
                                                                                        class="hide-input"
                                                                                        class="hide-input show_date"
                                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                                        onchange="handleDateInput(this, 'Due_Date_{{ $loop->index }}'); updateEndDateMin('Due_Date_{{ $loop->index }}_input', 'End_date_{{ $loop->index }}_input')" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="new-date-data-field">
                                                                            <div class="group-input input-date">
                                                                                <div class="calenderauditee">
                                                                                    <input class="click_date"
                                                                                        id="End_date_{{ $loop->index }}"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        type="text"
                                                                                        name="audit_program[{{ $loop->index }}][End_date]"
                                                                                        value="{{ isset($grid['End_date']) ? \Carbon\Carbon::parse($grid['End_date'])->format('d-M-Y') : '' }}"
                                                                                        placeholder="DD-MMM-YYYY"
                                                                                        readonly />
                                                                                    <input type="date"
                                                                                        name="audit_program[{{ $loop->index }}][End_date]"
                                                                                        id="End_date_{{ $loop->index }}_input"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                        value="{{ isset($grid['End_date']) ? $grid['End_date'] : '' }}"
                                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                        class="hide-input show_date"
                                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                                        onchange="handleDateInput(this, 'End_date_{{ $loop->index }}')" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-lg-12">
                                                                            <div class="group-input">
                                                                                <select
                                                                                    name="audit_program[{{ $loop->index }}][Lead_Investigator]"
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                                    <option value="">Select a value
                                                                                    </option>
                                                                                    @if ($users->isNotEmpty())
                                                                                        @foreach ($users as $value)
                                                                                            <option
                                                                                                value="{{ $value->name }}"
                                                                                                {{ isset($grid['Lead_Investigator']) && $grid['Lead_Investigator'] == $value->name ? 'selected' : '' }}>
                                                                                                {{ $value->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="audit_program[{{ $loop->index }}][Comment]"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                            value="{{ isset($grid['Comment']) ? $grid['Comment'] : '' }}">
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                            class="removeBtnaid">remove

                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        {{-- 
                                                <div class="group-input">
                                                    <label for="audit-agenda-grid">
                                                        Self Inspection Planner
                                                        <button type="button" name="audit-agenda-grid" id="Self_Inspection"
                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                
                                                    </label>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered"
                                                            id="Self_Inspection-field-instruction-modal">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 1%">Sr. No.</th>
                                                                    <th style="width: 12%">Department</th>
                                                                    <th style="width: 15%">Months</th>
                                                                    <th style="width: 16%">Remarks</th>
                                                                    <th style="width: 3%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($grid_Data4 && is_array($grid_Data4->data))
                                                                    @foreach ($grid_Data4->data as $grid4)
                                                                        <tr>
                                                                            <td><input disabled type="text"
                                                                                    name="Self_Inspection[{{ $loop->index }}][serial_number]"
                                                                                    value="{{ $loop->index + 1 }}"></td>
                                                                            <td>
                                                                                <div class="col-lg-6">
                                                                                    <div class="group-input">
                                                                                        @php
                                                                                            $selectedDepartment = isset($grid4['department']) ? $grid4['department'] : '';
                                                                                        @endphp
                                                                                        <select name="Self_Inspection[{{ $loop->index }}][department]"
                                                                                            id="department_{{ $loop->index }}"
                                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                                            <option selected disabled value="">---select---</option>
                                                                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                                                                <option value="{{ $department }}"
                                                                                                    data-code="{{ $code }}"
                                                                                                    @if ($selectedDepartment == $department) selected @endif>
                                                                                                    {{ $department }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <select name="Self_Inspection[{{ $loop->index }}][Months]"
                                                                                    placeholder="Select" data-search="false"
                                                                                    data-silent-initial-value-set="true"
                                                                                    id="Months" multiple
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                                    @php
                                                                                        $selectedMonths = isset($grid4['Months']) ? explode(',', $grid4['Months']) : [];
                                                                                    @endphp
                                                                                    <option value="Jan" {{ in_array('Jan', $selectedMonths) ? 'selected' : '' }}>January</option>
                                                                                    <option value="Feb" {{ in_array('Feb', $selectedMonths) ? 'selected' : '' }}>February</option>
                                                                                    <option value="March" {{ in_array('March', $selectedMonths) ? 'selected' : '' }}>March</option>
                                                                                    <option value="April" {{ in_array('April', $selectedMonths) ? 'selected' : '' }}>April</option>
                                                                                    <option value="May" {{ in_array('May', $selectedMonths) ? 'selected' : '' }}>May</option>
                                                                                    <option value="June" {{ in_array('June', $selectedMonths) ? 'selected' : '' }}>June</option>
                                                                                    <option value="July" {{ in_array('July', $selectedMonths) ? 'selected' : '' }}>July</option>
                                                                                    <option value="Aug" {{ in_array('Aug', $selectedMonths) ? 'selected' : '' }}>August</option>
                                                                                    <option value="Sept" {{ in_array('Sept', $selectedMonths) ? 'selected' : '' }}>September</option>
                                                                                    <option value="Oct" {{ in_array('Oct', $selectedMonths) ? 'selected' : '' }}>October</option>
                                                                                    <option value="Nov" {{ in_array('Nov', $selectedMonths) ? 'selected' : '' }}>November</option>
                                                                                    <option value="Dec" {{ in_array('Dec', $selectedMonths) ? 'selected' : '' }}>December</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text"
                                                                                    name="Self_Inspection[{{ $loop->index }}][Remarked]"
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                    value="{{ $grid4['Remarked'] ?? '' }}">
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="removeBtn"
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>remove</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> 
                                            --}}



                                        {{-- <script>
                                            $(document).ready(function() {
                                                $('#Months').change(function() {
                                                    var selectedOptions = $(this).val();
                                                    console.log('selectedOptions', selectedOptions);
                                                    document.querySelector('#Months2').setValue(selectedOptions);
                                                });
                                            });
                                        </script> --}}
                                        {{--
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span
                                                    id="rchars">255</span>
                                                characters remaining

                                                <textarea name="short_description" id="docname" type="text" maxlength="255" required
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div> --}}


                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <select name="repeat"
                                                    onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->repeat == 'yes') selected @endif
                                                        value="yes">Yes</option>
                                                    <option @if ($data->repeat == 'no') selected @endif
                                                        value="no">No</option>
                                                    <option @if ($data->repeat == 'na') selected @endif
                                                        value="na">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="repeat_nature">{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="comments">
                                                    Comments<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                </label>
                                                <textarea name="comments" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}{{ $data->stage == 1 ? 'required' : '' }}>{{ $data->comments }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="attachments">Attached Files</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="attachments">
                                                        @if ($data->attachments)
                                                            @foreach (json_decode($data->attachments) as $file)
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                            type="file" id="myfile" name="attachments[]"
                                                            oninput="addMultipleFiles(this, 'attachments')" multiple>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="related_url">Related URL</label>
                                                <input name="related_url"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    value="{{ $data->related_url }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="related_url">URl's description</label>
                                                <input {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                    type="text" value="{{ $data->url_description }}"
                                                    name="url_description" id="url_description" />
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="suggested_audit">Suggested Audits</label>
                                                <input type="text" name="suggested_audits"
                                                    value="{{ $data->suggested_audits }}"
                                                    {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>
                                            </div>
                                        </div> --}}


                                        <!-- <div class="col-12 sub-head">
                                            Extension Justification
                                        </div> -->
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date
                                                        is crossed</small></div>
                                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Self Inspection Circular
                                            </div>


                                            <div class="group-input">
                                                <label for="audit-agenda-grid">
                                                    Self Inspection Circular
                                                    <button type="button" name="audit-agenda-grid"
                                                        id="Self_Inspection_circular"
                                                        {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>+</button>
                                                 
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered"
                                                        id="Self_Inspection_circular-field-instruction-modal">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 2%">Sr. No.</th>
                                                                <th style="width: 12%">Department</th>
                                                                <th style="width: 15%">Audit Date</th>
                                                                <th style="width: 16%">Name of Auditors</th>
                                                                <th style="width: 3%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($grid_Data2 && is_array($grid_Data2->data))
                                                                @foreach ($grid_Data2->data as $grid2)
                                                                    <tr>
                                                                        <td><input disabled type="text"
                                                                                name="Self_Inspection_circular[{{ $loop->index }}][serial_number]"
                                                                                value="{{ $loop->index + 1 }}"></td>

                                                                        <td>
                                                                            <div class="col-lg-6">
                                                                                <div class="group-input">
                                                                                    @php
                                                                                        $selectedDepartment = isset(
                                                                                            $grid2['departments'],
                                                                                        )
                                                                                            ? $grid2['departments']
                                                                                            : '';
                                                                                    @endphp
                                                                                    <select
                                                                                        name="Self_Inspection_circular[{{ $loop->index }}][departments]"
                                                                                        id="departments_{{ $loop->index }}"
                                                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                                        <option selected disabled
                                                                                            value="">---select---
                                                                                        </option>
                                                                                        @foreach (Helpers::getDepartments() as $code => $departments)
                                                                                            <option
                                                                                                value="{{ $departments }}"
                                                                                                data-code="{{ $code }}"
                                                                                                @if ($selectedDepartment == $departments) selected @endif>
                                                                                                {{ $departments }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </td>



                                                                        <td>
                                                                            <div class="new-date-data-field">
                                                                                <div class="group-input input-date">
                                                                                    <div class="calenderauditee">
                                                                                        <input class="click_date"
                                                                                            id="date_data{{ $loop->index }}"
                                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                            type="text"
                                                                                            name="Self_Inspection_circular[{{ $loop->index }}][info_mfg_date]"
                                                                                            value="{{ isset($grid2['info_mfg_date']) ? \Carbon\Carbon::parse($grid2['info_mfg_date'])->format('d-M-Y') : '' }}"
                                                                                            placeholder="DD-MMM-YYYY"
                                                                                            readonly />
                                                                                        <input type="date"
                                                                                            name="Self_Inspection_circular[{{ $loop->index }}][info_mfg_date]"
                                                                                            {{-- min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" --}}
                                                                                            id="date_data{{ $loop->index }}"
                                                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                            value="{{ isset($grid2['info_mfg_date']) ? $grid2['info_mfg_date'] : '' }}"
                                                                                            class="hide-input show_date"
                                                                                            style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                                            onchange="handleDateInput(this, 'date_data{{ $loop->index }}')" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </td>


                                                                        <!-- <td>
                                                                            <select name="Self_Inspection_circular[{{ $loop->index }}][Auditor][]" 
                                                                                    id="auditor_{{ $loop->index }}" 
                                                                                    class="auditor-select" 
                                                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                                    multiple>
                                                                                    
                                                                                @php
                                                                                    // Ensure $grid2['Auditor'] is properly formatted as an array
                                                                                    $selectedAuditors = [];
                                                                                    if (!empty($grid2['Auditor'])) {
                                                                                        if (is_array($grid2['Auditor'])) {
                                                                                            $selectedAuditors = $grid2['Auditor'];
                                                                                        } elseif (is_string($grid2['Auditor'])) {
                                                                                            $selectedAuditors = explode(',', $grid2['Auditor']);
                                                                                        }
                                                                                    }
                                                                                @endphp

                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id }}" 
                                                                                        @if (in_array($user->id, $selectedAuditors)) selected @endif>
                                                                                        {{ $user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td> -->

                                                                        <td>
                                                                            <div class="analyst-dropdown-container">
                                                                                <select class="analyst-dropdown" name="Self_Inspection_circular[{{ $loop->index }}][Auditor]" multiple>
                                                                                    @foreach ($users as $user)
                                                                                        <option value="{{ $user->id }}"
                                                                                            {{ in_array($user->id, explode(',', $grid2['Auditor'] ?? '')) ? 'selected' : '' }}>
                                                                                            {{ $user->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </td>






                                                                        <td>
                                                                            <button type="button" class="removeBtn"
                                                                                {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>remove</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                            <script>
                                                $(document).ready(function() {
                                                    $('#Months').change(function() {
                                                        var selectedOptions = $(this).val();
                                                        console.log('selectedOptions', selectedOptions);
                                                        document.querySelector('#Months2').setValue(selectedOptions);
                                                    });
                                                });
                                            </script>
                                            <script>
                                                function handleDateInput(dateInput, displayId) {
                                                    var dateValue = new Date(dateInput.value);
                                                    var options = {
                                                        year: 'numeric',
                                                        month: 'short',
                                                        day: '2-digit'
                                                    };
                                                    var formattedDate = dateValue.toLocaleDateString('en-GB', options).replace(/ /g, '-');

                                                    document.getElementById(displayId).value = formattedDate;
                                                }
                                            </script>


                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="comment">
                                                        Comments<span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="comment" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}>{{ $data->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="Attached_File">Attached Files</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Attached_File">
                                                            @if ($data->Attached_File)
                                                                @foreach (json_decode($data->Attached_File) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                                type="file" id="myfile" name="Attached_File[]"
                                                                oninput="addMultipleFiles(this, 'Attached_File')" multiple>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="button-block">
                                                @if ($data->stage != 0)
                                                    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                                    <button type="button" class="backButton"
                                                        onclick="previousStep()">Back</button>
                                                @endif
                                                <button type="button" id="ChangeNextButton"
                                                    class="nextButton" onclick="nextStep()">Next</button>
                                                <button type="button"> <a class="text-white"
                                                        href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">HOD/Designee Review
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="comment">HOD Review Attached Files</label>
                                                    <textarea name="hod_comment" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->hod_comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="hod_attached_File">HOD Attached Files</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="hod_attached_File">
                                                            @if ($data->hod_attached_File)
                                                                @foreach (json_decode($data->hod_attached_File) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                type="file" id="myfile" name="hod_attached_File[]"
                                                                oninput="addMultipleFiles(this, 'hod_attached_File')" multiple>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="button-block">
                                                @if ($data->stage != 0)
                                                    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                                    <button type="button" class="backButton"
                                                        onclick="previousStep()">Back</button>
                                                @endif
                                                <button type="button" id="ChangeNextButton"
                                                    class="nextButton" onclick="nextStep()">Next</button>
                                                <button type="button"> <a class="text-white"
                                                        href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">CQA/QA Approval
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="comment">
                                                        CQA/QA Approval Comments<span class="text-danger">{{ $data->stage == 2 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="cqa_qa_comment" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}{{ $data->stage == 3 ? 'required' : '' }}>{{ $data->cqa_qa_comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="cqa_qa_Attached_File">CQA/QA Attached Files</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="cqa_qa_Attached_File">
                                                            @if ($data->cqa_qa_Attached_File)
                                                                @foreach (json_decode($data->cqa_qa_Attached_File) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input
                                                            {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 ? 'readonly' : '' }}
                                                                type="file" id="myfile" name="cqa_qa_Attached_File[]"
                                                                oninput="addMultipleFiles(this, 'cqa_qa_Attached_File')" multiple>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="button-block">
                                                @if ($data->stage != 0)
                                                    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                                    <button type="button" class="backButton"
                                                        onclick="previousStep()">Back</button>
                                                @endif
                                                <button type="button" id="ChangeNextButton"
                                                    class="nextButton" onclick="nextStep()">Next</button>
                                                <button type="button"> <a class="text-white"
                                                        href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm6" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">CQA/QA Review
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="comment">
                                                        CQA/QA Review Comment<span class="text-danger">{{ $data->stage == 3 ? '*' : '' }}</span>
                                                    </label>
                                                    <textarea name="cqa_qa_review_comment" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 ? 'readonly' : '' }}{{ $data->stage == 3 ? 'required' : '' }}>{{ $data->cqa_qa_review_comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="cqa_qa_review_Attached_File">CQA/QA Review Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="cqa_qa_review_Attached_File">
                                                            @if ($data->cqa_qa_review_Attached_File)
                                                                @foreach (json_decode($data->cqa_qa_review_Attached_File) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input
                                                            {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 ? 'readonly' : '' }}
                                                                type="file" id="myfile" name="cqa_qa_review_Attached_File[]"
                                                                oninput="addMultipleFiles(this, 'cqa_qa_review_Attached_File')" multiple>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="button-block">
                                                @if ($data->stage != 0)
                                                    <button type="submit" id="ChangesaveButton" class="saveButton"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                                    <button type="button" class="backButton"
                                                        onclick="previousStep()">Back</button>
                                                @endif
                                                <button type="button" id="ChangeNextButton"
                                                    class="nextButton" onclick="nextStep()">Next</button>
                                                <button type="button"> <a class="text-white"
                                                        href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                    <!-- <div class="col-12">
                                            <div class="sub-head">Submit</div>
                                        </div> -->
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted_By..">Submit By</label>
                                                <div class="static">{{ $data->submitted_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submit_On">Submit On</label>
                                                <div class="static">{{ $data->submitted_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submit_On">Submit Comment</label>
                                                <div class="static">{{ $data->Submitted_comment }}</div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                            <div class="sub-head">Approve</div>
                                        </div> -->
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved_By">Approve By</label>
                                                <div class="static">{{ $data->approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved_On">Approve On</label>
                                                <div class="static">{{ $data->approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted_On">Approve Comment</label>
                                                <div class="static">{{ $data->approved_comment }}</div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <div class="sub-head">More Info Required</div>
                                        </div> -->

                                        <!-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected_By">More Info Required By</label>
                                                <div class="static">{{ $data->rejected_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected_On">More Info Required On</label>
                                                <div class="static">{{ $data->rejected_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted_On">More Info Required Comment</label>
                                                <div class="static">{{ $data->reject_comment }}</div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-12">
                                            <div class="sub-head">Audit Completed</div>
                                        </div> -->

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Audit_Completed_By">Audit Completed By</label>
                                                <div class="static">{{ $data->Audit_Completed_By }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Audit_Completed_On">Audit Completed On</label>
                                                <div class="static">{{ $data->Audit_Completed_On }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted_On">Audit Completed Comment</label>
                                                <div class="static">{{ $data->Audit_Completed_comment }}</div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div> -->

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled_By">Cancel By</label>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled_On">Cancel On</label>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted_On">Cancel Comment</label>
                                                <div class="static">{{ $data->Cancelled_comment }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        {{-- <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button> --}}
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        {{-- <button type="submit"
                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Submit</button> --}}
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>



            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('StateChangeAuditProgram', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button>Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                            <div class="modal-footer">
                                <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancel-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('AuditProgramCancel', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button>Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                            <div class="modal-footer">
                                <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('AuditProgramStateRecject', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment<span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button>Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                            <div class="modal-footer">
                                <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('auditProgramChild', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">

                                    <label for="major">

                                    </label>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Internal_Audit">
                                        Internal Audit
                                    </label>
                                    <!-- <label for="minor">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <input type="radio" name="child_type" value="extension">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Extension
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </label> -->

                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('extension_child', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="Audit_program">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <!-- <input type="radio" name="child_type" value="extension">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Extension -->
                                    </label>

                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <style>
                #step-form>div {
                    display: none
                }

                #step-form>div:nth-child(1) {
                    display: block;
                }
            </style>

            <script>
                VirtualSelect.init({
                    ele: '#Months,#Months2, #team_members, #training-require, #impacted_objects'
                });
            </script>


            <script>
                VirtualSelect.init({
                    ele: '#investigators'
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

            {{-- <script>
                document.getElementById('Initiator_Group').addEventListener('change', function() {
                    var selectedValue = this.value;
                    document.getElementById('initiator_group_code').value = selectedValue;
                });
            </script> --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const removeButtons = document.querySelectorAll('.remove-file');

                    removeButtons.forEach(button => {
                        button.addEventListener('click', function() {
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
