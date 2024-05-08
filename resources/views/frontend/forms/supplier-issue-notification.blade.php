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
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">
                    Supplier Issue Information
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">
                    Additional Information
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">
                    Signatures
                </button>
            </div>
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
                                <label for="Supplier">Supplier</label>
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
                                <label for="Referenced Supplier">Referenced Supplier</label>
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
                                <label for="Date Occurred">Date Occurred</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cause Category">Cause Category</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Cause Category 1</option>
                                    <option>Cause Category 2</option>
                                    <option>Cause Category 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cause Detail">Cause Detail</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Cause Detail 1</option>
                                    <option>Cause Detail 2</option>
                                    <option>Cause Detail 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cause Type">Cause Type</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Cause Type 1</option>
                                    <option>Cause Type 2</option>
                                    <option>Cause Type 3</option>
                                </select>
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
                                <label for="Immediate Actions">Immediate Actions</label>
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
                                <label for="Impact">Impact</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                    <option>none</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Impact Analysis">Impact Analysis</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Invest. Summary and Conclusion">Invest. Summary and Conclusion</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Material">
                                    Material<button type="button" name="ann"
                                        onclick="add3Input('Material')">+</button>
                                </label>
                                <table class="table table-bordered" id="Material">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Material</th>
                                            <th>Lot Number</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="zLot#">zLot#</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Material Disposition">Material Disposition</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Material Disposition 1</option>
                                    <option>Material Disposition 2</option>
                                    <option>Material Disposition 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="sub-head">
                            Product Information
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Information">
                                    Product Information<button type="button" name="ann"
                                        onclick="add2Input('product_information')">+</button>
                                </label>
                                <table class="table table-bordered" id="product_information">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Revision</th>
                                            <th>Work Order Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Quality Contact">Quality Contact</label>
                                <div class="static">Shaleen Mishra</div>
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
                                <label for="Approved By">Approved By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved On">Approved On</label>
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
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected By">Rejected By</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected On">Rejected On</label>
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
