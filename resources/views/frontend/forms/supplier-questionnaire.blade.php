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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">
                    Supplier Questionnaire
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">
                    Audit Information
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">
                    Signature
                </button>
            </div>
            <!-- Supplier Questionnaire -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Short Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to">Assigned to</label>
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
                                <label for="Date Due">Date Due</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Files">Attached Files</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Investigation documents">Investigation documents</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Priority">Priority</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type">Type</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Description">Description</label>
                                <textarea name="text"></textarea>
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

            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Auditee">Auditee</label>
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
                                <label for="Main Contact">Main Contact</label>
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
                                <label for="Audit Schedule Date">Audit Schedule Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Title">Audit Title</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Signature -->
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Issued By">Issued By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Issued On">Issued On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Acknowledged By">Acknowledged By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Acknowledged On">Acknowledged On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Returned By">Returned By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Returned On">Returned On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Completed By">Completed By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Completed On">Completed On</label>
                                <div class="static">17-04-2023 11:12PM</div>
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
