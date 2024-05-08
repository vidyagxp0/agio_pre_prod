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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Deviation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Product Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Project Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Group Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Evauation & Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation & CAPA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Investigation Impact
                    Assesment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Conclusion & Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Activity Log</button>
            </div>


            <!-- General information content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="RLS Record Number">Record Number </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Division Code"> Division Code </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"> Initiator </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to"> Assigned to </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Due"> Date of Initiation </label>
                                <input type="date" name="Date Due">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Due Date"> Due Date </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"> Initiator Group </label>
                                <select name="initiator_group">
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code"> Initiator Group Code </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description"> Short Description </label>
                                <textarea name="short_desc"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Deviation Type"> Deviation Type </label>
                                <select name="deviation_type">
                                    <option>Enter Your Selection Here</option>
                                    <option>Planned</option>
                                    <option>Unplanned</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Date Occurance"> Date Occurance </label>
                                <input type="date" name="date_occurance" id="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Is Recurring"> Is Recurring </label>
                                <select name="is_recurring">
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Related Deviation No."> Related Deviation No. </label>
                                <select name="related_deviation">
                                    <option>-- Select --</option>
                                    <option value="01">#0001</option>
                                    <option value="02">#0002</option>
                                    <option value="03">#0003</option>
                                    <option value="04">#0004</option>
                                    <option value="05">#0005</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Other Ref.Doc.No"> Other Ref.Doc.No </label>
                                <input type="text" name="title">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deviation Details content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Current Procedure"> Current Procedure </label>
                                <textarea name="curr_procedure"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Deviation Description"> Deviation Description </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Nature of Deviation"> Nature of Deviation </label>
                                <select multiple name="deviation_nature" placeholder="Select Nature of Deviation"
                                    data-search="false" data-silent-initial-value-set="true" id="deviation_nature">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6"> --}}
                            <div class="group-input">
                                <label for="Deviation Attachments"> Deviation Attachment </label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Deviation Reason"> Deviation Reason </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Supervisor Comments"> Supervisor Comments </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Immediate Action"> Immediate Action </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Justification"> Justification </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            Product Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Details">
                                    Product Details<button type="button" name="ann"
                                        onclick="add7Input('prod_detail')">+</button>
                                </label>
                                <table class="table table-bordered" id="prod_detail">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Product Name</th>
                                            <th>Batch No.</th>
                                            <th>Manufacturing stage</th>
                                            <th>Stage Batch No.</th>
                                            <th>Date Of Manufacturing</th>
                                            <th>Date Of Expiry</th>
                                            <th>Market</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Material Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Material Details">
                                    Material Details<button type="button" name="ann"
                                        onclick="add5Input('material_detail')">+</button>
                                </label>
                                <table class="table table-bordered" id="material_detail">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Material Name</th>
                                            <th>Lot Number</th>
                                            <th>Date of Manufacturing</th>
                                            <th>Date Of Expiry/Retest</th>
                                            <th>A.R. Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Equipment/Instruments Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Material Details">
                                    Equipment/Instruments Details<button type="button" name="ann"
                                        onclick="add3Input('equipment_detail')">+</button>
                                </label>
                                <table class="table table-bordered" id="equipment_detail">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Equipment/Instruments Name</th>
                                            <th>Equipment/Instruments ID</th>
                                            <th>Equipment/Instruments Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Other type CAPA Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Details">Details</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments"> Comments </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Details content -->
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="col-12 sub-head">
                        Project Details
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Project Datails Application"> Project Datails Application </label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Protocol/Study Number"> Initiator Group </label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Site Number"> Site Number </label>
                                <input type="number" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Subject Number"> Subject Number </label>
                                <input type="number" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Subject Initials"> Subject Initials </label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type of Deviation"> Type of Deviation </label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Other"> Other </label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Sponsor"> Sponsor </label>
                                <input type="text" name="String">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- QA Review content -->
            <div id="CCForm5" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Impact On"> Impact On </label>
                                <select multiple name="impact_on" placeholder="Select Persons" data-search="false"
                                    data-silent-initial-value-set="true" id="impact_on">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="QA Head Attachments"> QA Head Attachment </label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="QA Review Comments"> QA Review Comments </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group Assessment content -->
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Concerned Groups
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="group_review">Is Group Review Required?</label>
                                <select name="goup_review">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Production">Production</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Production-Person">Production Person</label>
                                <select name="Production-Person">
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
                                <label for="Quality-Control">Quality Control</label>
                                <select name="Quality-Control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality-Control-Person">Quality Control Person</label>
                                <select name="Quality-Control-Person">
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
                                <label for="Microbiology">Microbiology</label>
                                <select name="Microbiology">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Microbiology-Person">Microbiology Person</label>
                                <select name="Microbiology-Person">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6"> --}}
                            <div class="group-input">
                                <label for="Warehouse">Warehouse</label>
                                <select name="Warehouse">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Warehouse-Person">Warehouse Person</label>
                                <select name="Warehouse-Person">
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
                                <label for="Engineering">Engineering</label>
                                <select name="Engineering">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Engineering-Person">Engineering Person</label>
                                <select name="Engineering-Person">
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
                                <label for="Instrumentation">Instrumentation</label>
                                <select name="Instrumentation">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Instrumentation-Person">Instrumentation Person</label>
                                <select name="Instrumentation-Person">
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
                                <label for="Validation">Validation</label>
                                <select name="Validation">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Validation-Person">Validation Person</label>
                                <select name="Validation-Person">
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
                                <label for="Research-Development">Research & Development</label>
                                <select name="Research-Development">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Research-Development-Person">Research & Development Person</label>
                                <select name="Research-Development-Person">
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
                                <label for="packaging_Development">Packaging Development</label>
                                <select name="packaging_Development">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="packaging_Development-Person">Packaging Development Person</label>
                                <select name="packaging_Development-Person">
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
                                <label for="bd_international">Business Development (Interntional)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_international-Person">Business Development (Interntional) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Business Development (Domestic)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Business Development (Domestic) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Health Safety Environment (Safety)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Health Safety Environment (Safety) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Health Safety Environment (Environment)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Health Safety Environment (Environment) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Health Safety Environment (Health)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Health Safety Environment (Health) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Customer Group</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Customer Group Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Regulatory Affairs (International)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Regulatory Affairs (International) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Regulatory Affairs (Domestic)</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Regulatory Affairs (Domestic) Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Qualified</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Qualified Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Information Technology</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Information Technology Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Procurement</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Procurement Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Clinical Pharmacology Unit</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Clinical Pharmacology Unit Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Project Management</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Project Management Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Clinical Operations</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Clinical Operations Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Bioanalytical Laboratory</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Bioanalytical Laboratory Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Pharmacovigilance</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Pharmacovigilance Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Medical Writing</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Medical Writing Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Statistics</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Statistics Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Data Management</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Data Management Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Logistics</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Logistics Person</label>
                                <select name="B-Person">
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
                                <label for="bd_domestic">Others</label>
                                <select name="Production">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="bd_domestic-Person">Others Person</label>
                                <select name="B-Person">
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

            <!-- Group Comments content -->
            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Production Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Quality Control Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Microbiology Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Warehouse Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Engineering Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Instrumentation Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Validation Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">R & D Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Packaging Development Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">BD (International) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">BD (Domestic) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">HSE (Safety) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">HSE (Environment) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">HSE (Health) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Customer Group</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">RA (International) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">RA (Domestic) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Qualified Person (QP) Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">IT Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Procurement Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">CP Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Project Management Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Clinical Operations Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">BL Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Pharmacovigilance Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Medical Writing Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Statistics Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Data Management Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Logistics Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="comments">Others Comments</label>
                                <textarea name="comments"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="group-attachments">Group Attachments</label>
                                <input type="file" name="group-attachments">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QA Evaluation & Approal content -->
            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="group-input">
                        <label for="Category"> Category </label>
                        <select>
                            <option>Enter Your Selection Here</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="QA Evaluation Comments"> QA Evaluation Comments </label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="group-input">
                        <label for="QA Head/Designee Comments"> QA Head/Designee Comments </label>
                        <textarea name="text"></textarea>
                    </div>
                </div>
            </div>

            <!-- Investigation & CAPA content -->
            <div id="CCForm9" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Root Cause Details
                    </div>
                    <div class="group-input">
                        <label for="Root Cause Details"> Root Cause Details </label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="group-input">
                        <label for="Action Taken"> Action Taken </label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="group-input">
                        <label for="Currective Action"> Currective Action </label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="group-input">
                        <label for="Preventive Action"> Preventive Action </label>
                        <textarea name="text"></textarea>
                    </div>
                </div>
            </div>

            <!-- Investigation Impact Assesment content -->
            <div id="CCForm10" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="group-input">
                        <label for="Impact On Product Quality"> Impact On Product Quality </label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="group-input">
                        <label for="Impact On Other Group"> Impact On Other Group </label>
                        <select multiple name="group-impact" placeholder="Select Imapact on other groups"
                            data-search="false" data-silent-initial-value-set="true" id="group-impact">
                            <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="Impact On Subject Safety"> Impact On Subject Safety </label>
                        <input type="text" name="title">
                    </div>
                    <div class="group-input">
                        <label for="Impact On Data"> Impact On Data </label>
                        <input type="text" name="title">
                    </div>
                    <div class="group-input">
                        <label for="QA Assessment Comments"> QA Assessment Comments </label>
                        <textarea name="text"></textarea>
                    </div>
                </div>
            </div>
            <!-- Conclusion & Closure content -->
            <div id="CCForm11" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Conclusion & Closure Details</div>
                    <div class="group-input">
                        <label for="test">Closure Comments</label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="group-input">
                        <label for=test>Closure Attachments</label>  
                        <input type="file" />
                    </div>
                </div>
            </div>

            <!--Activity Log -->
            <div id="CCForm12" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted By"> Submitted By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted On"> Submitted On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Review Completed  By"> Review Completed By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Review Completed On"> Review Completed On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA More Info Required By"> QA More Info Required By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA More Info Required On"> QA More Info Required On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA Review Completed By"> QA Review Completed By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA Review Completed On"> QA Review Completed On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancelled By"> Cancelled By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancelled On"> Cancelled On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Group Feedback By"> Group Feedback By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Group Feedback On"> Group Feedback On </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Evaluation Completed By"> Evaluation Completed By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Evaluation Completed On"> Evaluation Completed On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Additional Groups Requested By"> Additional Groups Requested By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Additional Groups Requested On"> Additional Groups Requested On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Additional Groups Selected  By"> Additional Groups Selected By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Additional Groups Selected On"> Additional Groups Selected On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Inv. Assessment Submitted By"> Inv. Assessment Submitted By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Inv. Assessment Submitted On"> Inv. Assessment Submitted on </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Impact Assessed By"> Impact Assessed By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Impact Assessed On"> Impact Assessed On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="CAPA Submitted By"> CAPA Submitted By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="CAPA Submitted On"> CAPA Submitted On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved By"> Approved By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved On"> Approved On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected By"> Rejected By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected On"> Rejected On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA Review Closed By"> QA Review Closed By </label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA Review Closed  On"> QA Review Closed On </label>
                                <div class="static"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <script>
                VirtualSelect.init({
                    ele: '#deviation_nature, #impact_on, #group-impact'
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
