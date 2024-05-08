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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')"> Requirement Template</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Signatures</button>
            </div>

            <!--  Requirement Template Tab content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <input disabled type="text" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class="static"></div>
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
                                    <option value="piyush">Amit Guru</option>
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
                        {{-- <div class="col-lg-6">
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
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Expiration Date">Expiration Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type..">Type..</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Other</option>
                                    <option>Acknowledgment</option>
                                    <option>Class</option>
                                    <option>Course</option>
                                    <option>On The Job</option>
                                    <option>Package</option>
                                    <option>Self Training</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Priority Level">Priority Level</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Launch CBT">Launch CBT</label>
                                <input type="url" name="url">
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
                                <label for="Attached Document(s)">Attached Document(s)</label>
                                <input type="file" id="myfile" name="myfile">
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
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    Test<button type="button" name="ann" onclick="add4Input('test')">+</button>
                                </label>
                                <table class="table table-bordered" id="test">
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

            <!-- Signature content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted By..">Submitted By..</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted On">Submitted On</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Closed By">Closed By</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Closed On">Closed On</label>
                                <div class="static"></div>
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
