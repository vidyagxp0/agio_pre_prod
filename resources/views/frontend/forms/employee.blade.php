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

    <div class="form-field-head">
        <div class="pr-id">
            New Document
        </div>
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            QMS-North America / CAPA
        </div>
        <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div>
    </div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Employee</button>
            </div>

            <!-- Tab content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned To">Assigned To</label>
                                <select name="assigend">
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
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
                                <label for="Employee ID">Employee ID</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Gender">Gender"</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Department">Department"</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Job Title">Job Title"</label>
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
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="City">City</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="State/Distict">State/Distict</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
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
                                <label for="Building.">Building.</label>
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
                                <label for="Floor...">Floor...</label>
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
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Picture">Picture</label>
                                <input type="file" id="myfile" name="myfile">
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
@endsection
