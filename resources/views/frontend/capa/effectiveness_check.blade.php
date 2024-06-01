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
        QMS-North America / Capa Child / Effectivezvzsfcszness-Check
    </div>

</div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Effectiveness check Results</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Reference Info/Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Activity History</button>
            </div>

            <!-- General Information -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        General Information
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Date Opened</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to"><b>Assigned to</b></label>
                                <div class="static">Shaleen Mishra</div>
                                <textarea name="assign_id"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Due"><b>Date Due</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality Reviewer"><b>Quality Reviewer</b></label>
                                <textarea name="Quality_Reviewer"></textarea>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Original Date Due"><b>Original Date Due</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head">
                        Effectiveness Planning Information
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Effectiveness check Plan"><b>Effectiveness check Plan</b></label>
                                <input type="text" name="title">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Effectiveness check Results -->
                        <div class="col-12 sub-head">
                            Effectiveness Summary
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Effectiveness Summary">Effectiveness Summary</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Effectiveness Check Results
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Effectiveness Results">Effectiveness Results</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Effectiveness check Attachments"><b>Effectiveness check
                                        Attachment</b></label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Reopen
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Comments"><b>Addendum Comments</b></label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Attachments"><b>Addendum Attachment</b></label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Reference Info comments -->
                        <div class="col-12 sub-head">
                            Reference Info comments
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments"><b>Comments</b></label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attachments"><b>Attachment</b></label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Records"><b>Reference Records</b></label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Activity History -->
                        <div class="col-12 sub-head">
                            Data History
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Closure Date"><b>Actual Closure Date</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Original Date Due"><b>Original Date Due</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Record Signature
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit by"><b>Submit by</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit On"><b>Submit On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complete By"><b>Complete By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complete On"><b>Complete On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality Approal On"><b>Quality Approal On</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality Approal On"><b>Quality Approal On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Complete By"><b>Addendum Complete By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Complete On"><b>Addendum Complete On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel By"><b>Cancel By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel On"><b>Cancel On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Open For Addendum By"><b>Re Open For Addendum By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Open For Addendum On"><b>Re Open For Addendum On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancellation Approve By"><b>Cancellation Approve By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancellation Approve On"><b>Cancellation Approve On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Cancellation Details
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancellation Category"><b>Cancellation Category</b></label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Duplicate Entry</option>
                                    <option>Entered in Error</option>
                                    <option>No Longer Necessary</option>
                                    <option>Parent Record Closed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="TrackWise Record Type"><b>TrackWise Record Type</b></label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Effectiveness Check</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Cancellation Justification">Cancellation Justification</label>
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
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>
@endsection
