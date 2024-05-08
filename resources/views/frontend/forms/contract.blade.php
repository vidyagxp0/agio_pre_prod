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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')"> Contract</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')"> Contract Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Signatures</button>
            </div>

            <!--  Contract Tab content -->
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
                                <label for="Short Desc.">Short Desc.</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
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
                                <label for="Supplier List">Supplier List</label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Distribution List">Distribution List</label>
                                <select multiple name="distribution_list" placeholder="Select Persons" data-search="false"
                                    data-silent-initial-value-set="true" id="distribution_list">
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
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
                                <label for="Manufacturer">Manufacturer</label>
                                <select multiple name="manufacturer" placeholder="Select Manufacturer" data-search="false"
                                    data-silent-initial-value-set="true" id="manufacturer">
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
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
                                <label for="Type..">Type..</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Other</option>
                                    <option>Product</option>
                                    <option>Amendment Medical Device</option>
                                    <option>Cleaning Services</option>
                                    <option>Clinical Trial-Phase I</option>
                                    <option>Clinical Trial-Phase II</option>
                                    <option>Clinical Trial-Phase III</option>
                                    <option>Clinical Trial-Phase IV</option>
                                    <option>Lab Services</option>
                                    <option>Master Service Agreement</option>
                                    <option>Proffessional Services</option>
                                    <option>Raw Material</option>
                                    <option>Single Contract</option>
                                    <option>Work Order Under Existing MSA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Other Type">Other Type</label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Files">Attached Files</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contract Details content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <h3>Risk Analysis</h3>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Start Date">Actual Start Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual End Date">Actual End Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Supplier List">Supplier List</label>
                                <input type="text" name="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Negotiation Team">Negotiation Team</label>
                                <select multiple name="negotiation_team" placeholder="Select Negotiation Team"
                                    data-search="false" data-silent-initial-value-set="true" id="negotiation_team">
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Financial Transactions">
                                    Financial Transactions<button type="button" name="ann"
                                        onclick="add5Input('financial_transaction')">+</button>
                                </label>
                                <table class="table table-bordered" id="financial_transaction">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Transaction</th>
                                            <th>Transaction Type</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Currency Used</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Signed By">Signed By</label>
                                <div class="static">person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Signed On">Signed On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#distribution_list, #manufacturer, #negotiation_team'
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
