@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp
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
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="observation_id[]"></td>' +


                        '</tr>';

                    return html;
                }

                var tableBody = $('#onservation-field-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <div class="form-field-head">
        <div class="pr-id">
            New Document
        </div>
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            Plant
        </div>
        {{-- <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div> --}}
    </div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">

                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Employee</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">External Training</button>
            </div>

            <!-- Tab content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned To">Assigned To</label>
                                <select name="assigend">
                                    <option value=""> -- Select --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Start Date">Actual Start Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Joining Date">Joining Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Employee ID">Employee ID</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Gender">Gender</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Department">Department</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Job Title">Job Title</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached CV">Attached CV</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Certification/Qualification">Certification/Qualification</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Employee Information
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Zone">Zone</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Asia</option>
                                    <option>Europe</option>
                                    <option>Africa</option>
                                    <option>Central America</option>
                                    <option>South America</option>
                                    <option>Oceania</option>
                                    <option>North America</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Country">Country</label>
                                <select class="form-select country" aria-label="Default select example"
                                    onchange="loadStates()">
                                    <option selected>Select Country</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="City">State</label>
                                <select class="form-select state" aria-label="Default select example"
                                    onchange="loadCities()">
                                    <option selected>Select State/District</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="State/District">City</label>
                                <select class="form-select city" aria-label="Default select example">
                                    <option selected>Select City</option>
                                </select>
                            </div>
                        </div>
                        <script>
                            var config = {
                                cUrl: 'https://api.countrystatecity.in/v1',
                                ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
                            };

                            var countrySelect = document.querySelector('.country'),
                                stateSelect = document.querySelector('.state'),
                                citySelect = document.querySelector('.city');

                            function loadCountries() {
                                let apiEndPoint = `${config.cUrl}/countries`;

                                $.ajax({
                                    url: apiEndPoint,
                                    headers: {
                                        "X-CSCAPI-KEY": config.ckey
                                    },
                                    success: function(data) {
                                        data.forEach(country => {
                                            const option = document.createElement('option');
                                            option.value = country.iso2;
                                            option.textContent = country.name;
                                            countrySelect.appendChild(option);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error loading countries:', error);
                                    }
                                });
                            }

                            function loadStates() {
                                stateSelect.disabled = false;
                                stateSelect.innerHTML = '<option value="">Select State</option>';

                                const selectedCountryCode = countrySelect.value;

                                $.ajax({
                                    url: `${config.cUrl}/countries/${selectedCountryCode}/states`,
                                    headers: {
                                        "X-CSCAPI-KEY": config.ckey
                                    },
                                    success: function(data) {
                                        data.forEach(state => {
                                            const option = document.createElement('option');
                                            option.value = state.iso2;
                                            option.textContent = state.name;
                                            stateSelect.appendChild(option);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error loading states:', error);
                                    }
                                });
                            }

                            function loadCities() {
                                citySelect.disabled = false;
                                citySelect.innerHTML = '<option value="">Select City</option>';

                                const selectedCountryCode = countrySelect.value;
                                const selectedStateCode = stateSelect.value;

                                $.ajax({
                                    url: `${config.cUrl}/countries/${selectedCountryCode}/states/${selectedStateCode}/cities`,
                                    headers: {
                                        "X-CSCAPI-KEY": config.ckey
                                    },
                                    success: function(data) {
                                        data.forEach(city => {
                                            const option = document.createElement('option');
                                            option.value = city.id;
                                            option.textContent = city.name;
                                            citySelect.appendChild(option);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error loading cities:', error);
                                    }
                                });
                            }
                            $(document).ready(function() {
                                loadCountries();
                            });
                        </script>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Site Name">Site Name</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>City MFR A</option>
                                    <option>City MFR B</option>
                                    <option>City MFR C</option>
                                    <option>Complex A</option>
                                    <option>Complex B</option>
                                    <option>Maerketing A</option>
                                    <option>Maerketing B</option>
                                    <option>Maerketing C</option>
                                    <option>Oceanside</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Building.">Building</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Floor...">Floor</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Room">Room</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Picture">Picture</label>
                                <input type="file" id="myfile" name="picture">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Picture">Speciman Signature </label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Job Responsibilities
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#observation-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="onservation-field-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr No.</th>
                                            <th>Job Responsibilities </th>

                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>
                                            <td><input type="text" name="job_responsiblities[]"></td>
                                            <td><input type="text" name="remarks[]"></td>


                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Facility Name">HOD </label>
                                <select multiple name="HOD[]" placeholder="Select Designee Name" data-search="false"
                                    data-silent-initial-value-set="true" id="hod">
                                    <option value="Plant 1">HOD 1</option>
                                    <option value="QA">HOD 2</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Facility Name">Designee </label>
                                <select multiple name="designee[]" placeholder="Select Designee Name" data-search="false"
                                    data-silent-initial-value-set="true" id="designee">
                                    <option value="Plant 1">QA Head</option>
                                    <option value="QA">QC Head</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments">Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="group-input" id="external-details-grid">
                            <label for="audit-agenda-grid">
                                External Training Details
                                <button type="button" name="audit-agenda-grid" id="details-grid">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#observation-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="onservation-field-table-details"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">Sr. No.</th>
                                            <th>Topic</th>

                                            <th style="width: 200px;">External Training Date</th>
                                            <th>External Trainer</th>

                                            <th>External Training Agency</th>
                                            <th style="width: 200px;">Certificate</th>
                                            <th style="width: 200px;">Supporting Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>
                                            <td><input type="text" name="topic[]"></td>
                                            <td><input type="date" name="external_training_date[]"></td>
                                            <td><input type="text" name="external_trainer[]"></td>
                                            <td><input type="text" name="external_agency[]"></td>
                                            <td><input type="file" name="certificate[]"></td>
                                            <td><input type="file" name="supproting_documents[]"></td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#details-grid').click(function(e) {
                                    function generateTableRow(serialNumber) {
                                        var users = @json($users);

                                        var html =
                                            '<tr>' +
                                            '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                            '"></td>' +
                                            '<td><input type="text" name="topic[]"></td>' +
                                            '<td><input type="date" name="external_training_date[]"></td>' +
                                            '<td><input type="text" name="external_trainer[]"></td>' +
                                            '<td><input type="text" name="external_agency[]"></td>' +
                                            '<td><input type="file" name="certificate[]"></td>' +
                                            '<td><input type="file" name="supproting_documents[]"></td>' +
                                            '</tr>';

                                        // for (var i = 0; i < users.length; i++) {
                                        //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                                        // }

                                        '</tr>';

                                        return html;
                                    }

                                    var tableBody = $('#onservation-field-table-details tbody');
                                    var rowCount = tableBody.children('tr').length;
                                    var newRow = generateTableRow(rowCount + 1);
                                    tableBody.append(newRow);
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>

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
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #designee, #hod'
        });
    </script>
@endsection
