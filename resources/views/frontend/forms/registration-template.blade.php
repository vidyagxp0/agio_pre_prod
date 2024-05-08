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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Substance Information</button>
            </div>

            <!-- Tab content -->
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
                                <label for="originator">Date Opened</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Desc.">Short Desc.</label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type..">Type..</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Medical Device</option>
                                    <option>Medicinal+Medical Device</option>
                                    <option>Medicinal Product</option>
                                </select>
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
                                    <option>1</option>
                                    <option>3</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Renewal Rule">Renewal Rule</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>1</option>
                                    <option>3</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Member State">Member State</label>
                                <select multiple name="Member_State" placeholder="Select Member State" data-search="false"
                                    data-silent-initial-value-set="true" id="Member_State">
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="PSUR Cycle">PSUR Cycle</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>1</option>
                                    <option>3</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Files">Attached Files</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Description">Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Dossier Parts">Dossier Parts</label>
                                <select multiple name="Dossier_Parts" placeholder="Select Dossier Parts" data-search="false"
                                    data-silent-initial-value-set="true" id="Dossier_Parts">
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                    <option value="Piyush">Demo Member State</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Related Dossier Documents">Related Dossier Documents</label>
                                <input type="url" name="url">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Authority Type">Authority Type</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Authority">Authority</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                    <option>Test</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#Member_State, #Dossier_Parts'
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
