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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Classroom Training</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Class Room Registration</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Class Room Closure</button>
            </div>

            <!-- Tab content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            General Information
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class=" static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class=" static"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Desc.">Short Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to">Assigned to</label>
                                <select name="assigend">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush"> Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Due">Date Due</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Class Information
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Trainer">Trainer</label>
                                <select name="assigend">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Registration End Date">Registration End Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Training Requirement">Training Requirement</label>
                                <select name="assigend">
                                    <option>-- Select --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Scheduled Start Date">Scheduled Start Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Scheduled End Date">Scheduled End Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Training Presentation">Training Presentation</label>
                                <input type="file" id="myfile" name="myfile">
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
                                <label for="Action Plan">
                                    Agenda<button type="button" name="ann" onclick="add6Input('agenda')">+</button>
                                </label>
                                <table class="table table-bordered" id="agenda">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Date</th>
                                            <th>Topic</th>
                                            <th>Responsible</th>
                                            <th>Time Start</th>
                                            <th>End</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Room Registration content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            Participants Request
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Perticipants Request">Perticipants Request</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Attendees Participated">Attendees Participated</label>
                                <select multiple name="attendees" placeholder="Select Attendees" data-search="false"
                                    data-silent-initial-value-set="true" id="attendees">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Room Closure content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            Attendees - Participated
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Attendees Participated">Attendees Participated</label>
                                <div class=" static"></div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Class Room Closure
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    Attendees Scheduled<button type="button" name="ann"
                                        onclick="add4Input('attendees-scheduled')">+</button>
                                </label>
                                <table class="table table-bordered" id="attendees-scheduled">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Result</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    Surey<button type="button" name="ann" onclick="add4Input('survey')">+</button>
                                </label>
                                <table class="table table-bordered" id="survey">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Subject</th>
                                            <th>Topic</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Test">Attached Test</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Test Results">Test Results</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Feedback">Feedback</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#attendees'
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
