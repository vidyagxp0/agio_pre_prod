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
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        / OOT
    </div>
</div>



{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Under Preliminary Lab Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Investigation Conclusion</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Investigation Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QC Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOT Conclusion</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOT Conclusion Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOT CQ Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Re-Open</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signatures</button>
        </div>

        <form action="{{ route('actionItem.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->

                <!-- ============Tab-1 start============ -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Division Code<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>ABC-101</option>
                                        <option>ABC-102</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initiator <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Shaleen mishra </option>
                                        <option>Pankaj jat </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                                    <input type="date"/>
                                    <!-- <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="" name="due_date"> -->
                                    <!-- <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" />
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="group-input ">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <input type="date"/>

                                    <!-- <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" />
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Severity Level <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>20</option>
                                        <option>50 </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initiator Group <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Shaleen mishra </option>
                                        <option>Pankaj jat </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initiator Group Code <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>A1B2 </option>
                                        <option>A2B3 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Initiated Through</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description">If Others <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>ABC </option>
                                        <option>ABCd </option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Is Repeat?</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Repeat Nature</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="closure attachment">Nature Of Change </label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="closure_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="closure_attachment[]" oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label>Deviation Occured On</label>
                                    <input type="date" name="DeviationOccuredOn" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="closure attachment">Description </label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="closure_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="closure_attachment[]" oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Initial Attachment <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Pdf </option>
                                        <option>Document </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Source Document Type <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>PDF </option>
                                        <option>Document </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Reference Record</label>
                                    <select multiple id="reference_record" name="refrence_record[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Reference Document</label>
                                    <input />
                                </div>
                            </div>


                            <div class="sub-head">OOT Information</div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Product Material Name</label>
                                    <input name="ProductMaterialName" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Grade/Type Of Water</label>
                                    <input name="Grade/TypeOfWater" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Sample Location/Point</label>
                                    <input name="SampleLocation/Point" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Market</label>
                                    <input name="Market" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label>Customer</label>
                                    <input name="Customer" />
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Info On Product/Material
                                    <button type="button" name="audit-agenda-grid" id="infoadd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="info_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Item/Product Code</th>
                                                <th style="width: 16%"> Lot/Batch No</th>
                                                <th style="width: 15%">A.R.Number</th>
                                                <th style="width: 15%">Mfg Date</th>
                                                <th style="width: 15%">Expiry Date </th>
                                                <th style="width: 15%">Label Claim</th>




                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="Item/ProductCode[]"></td>
                                            <td><input type="text" name="Lot/BatchNo[]"></td>
                                            <td><input type="text" name="A.R.Number[]"></td>
                                            <td><input type="text" name="MfgDate[]"></td>
                                            <td><input type="text" name="ExpiryDate[]"></td>
                                            <td><input type="text" name="LabelClaim[]"></td>

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Analyst Name<span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Sample Type </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Others (Specify)<span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Stability For </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>



                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details Of Stability Study
                                    <button type="button" name="audit-agenda-grid" id="Details">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Details-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">AR Number</th>
                                                <th style="width: 16%"> Condition:Temprature &RH</th>
                                                <th style="width: 15%">Interval</th>
                                                <th style="width: 15%">Orientation</th>
                                                <th style="width: 15%">Pack Details (if any) </th>





                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="ARNumber[]"></td>
                                            <td><input type="text" name="Condition:Temprature&RH[]"></td>
                                            <td><input type="text" name="Interval[]"></td>
                                            <td><input type="text" name="Orientation[]"></td>
                                            <td><input type="text" name="PackDetails[]"></td>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Specification Procedure Number <span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Specification Limit<span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    OOT Results
                                    <button type="button" name="audit-agenda-grid" id="ootadd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="oot_table_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">A.R. Number</th>
                                                <th style="width: 16%">Test Name Of OOT</th>
                                                <th style="width: 15%">Result Obtained</th>
                                                <th style="width: 15%">Initial Interval Details</th>
                                                <th style="width: 15%">Previous Interval Details </th>
                                                <th style="width: 15%">% Difference Of Results</th>
                                                <th style="width: 15%">Trend Limit</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="ARNumber[]"></td>
                                            <td><input type="text" name="TestNameOfOOT[]"></td>
                                            <td><input type="text" name="ResultObtained[]"></td>
                                            <td><input type="text" name="InitialIntervalDetails[]"></td>
                                            <td><input type="text" name="previousIntervalDetails[]"></td>
                                            <td><input type="text" name="DifferenceOfResults[]"></td>
                                            <td><input type="text" name="TrendLimit[]"></td>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>

           
                <!-- ==============Tab-2 start=============== -->

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description"> Verification Analysis Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Verification Analysis Ref.</label>
                                    <select multiple id="reference_record" name="refrence_record[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description"> Analyst Interview Request<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Analyst Interview Ref.</label>
                                    <select multiple id="reference_record" name="refrence_record[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Justification If No Analyst Interview</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description">Phase-I Investigation Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Short Description"> Phase-I Investigation <span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Reference Recores"> Phase-I Investigation Ref.</label>
                                    <select multiple id="reference_record" name="refrence_record[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="File_Attachment[]" oninput="addMultipleFiles(this, 'File_Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-3 start=============== -->
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Summary Of Preliminary Investigation</label>
                                    <textarea class="summernote" name="SummaryOfPreliminaryInvestigation" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Root Cause Identified? <span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> OOT Category-Root Cause Identified<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">SOOT Category (Others)</label>
                                    <textarea class="summernote" name="SummaryOfPreliminaryInvestigation" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Root Cause Details</label>
                                    <textarea class="summernote" name="SummaryOfPreliminaryInvestigation" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Impact Of Root Cause</label>
                                    <textarea class="summernote" name="SummaryOfPreliminaryInvestigation" id="summernote-16"></textarea>
                                </div>
                            </div>





                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Recommended Action Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Recommended Action Refrence<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Refrence Number</label>
                                    <select multiple id="reference_record" name="PreliminaryLabInvestigationdoneBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Delay Justification</label>
                                    <textarea class="summernote" name="SummaryOfPreliminaryInvestigation" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Conclusion Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ConclusionAttachment[]" oninput="addMultipleFiles(this, 'ConclusionAttachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-4 start=============== -->
                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4">Review Comment</label>
                                    <textarea class="summernote" name="ReviewComment" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Summary Of Earlier OTT And CAPA
                                    <button type="button" name="audit-agenda-grid" id="summaryadd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="summary_table_details">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">OOT No.</th>
                                                <th style="width: 16%"> OOT Reported Date</th>
                                                <th style="width: 15%">Description Of OOT</th>
                                                <th style="width: 15%">Previous OOT Root Cause</th>
                                                <th style="width: 15%">CAPA </th>
                                                <th style="width: 15%">Closure Date Of CAPA</th>
                                                <!-- <th style="width: 15%">CAPA Required</th>
                                                <th style="width: 15%">CAPA Reference</th>
                                                <th style="width: 15%">Phase II Inves. Req</th>
                                                <th style="width: 15%">Supporting Attachment</th>
                                                <th style="width: 15%">Pre. Lab Invest. Review By</th>
                                                <th style="width: 15%">Pre. Lab Invest. Review On</th> -->


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="OOTNo[]"></td>
                                            <td><input type="text" name="OOTReportedDate[]"></td>
                                            <td><input type="text" name="DescriptionOfOOT[]"></td>
                                            <td><input type="text" name="previousIntervalDetails[]"></td>
                                            <td><input type="text" name="CAPA[]"></td>
                                            <td><input type="text" name="ClosureDateOfCAPA[]"></td>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Phase II Inves. Req<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">Supporting Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ConclusionAttachment[]" oninput="addMultipleFiles(this, 'ConclusionAttachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            



                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-5 start=============== -->
                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> QA Approver Report</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Manufacturing Investigation Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Manufacturing Investigation Type</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Manufacturing Investigation Refrence</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Re-Sampling Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Re-Sampling Refrence No</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Hypo/Exp Required <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Hypo/Exp Refrence</label>
                                    <select multiple id="reference_record" name="Manufacturing[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment"> Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-6 start=============== -->
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Summary Of Phase II Testing</div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of Exp./Hyp.</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of Manufacturing Investigation</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Root Cause Identified <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Category-Reason Identified <span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label>Others (OOT Category) <span class="text-danger"></span></label>
                                    <input />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Details Of Root Cause</label>
                                    <textarea class="summernote" name="Details" id="summernote-16"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Impact Assessment</label>
                                    <textarea class="summernote" name="ImpactAssessment" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Recommended Action Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Recommended Action Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIInvestigationProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Investigation Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Investigation Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIInvestigationProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Justify If No Investigation Required</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">QC Review Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        

                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-7 start=============== -->
                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Review Comment</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Additional Test Proposal<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Additional Test Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Any Other Actions Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Refrence</label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Additional Testing Attachment</label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-8 start=============== -->
                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Summary Of OOT Test Results</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details Of Stability Study
                                    <button type="button" name="audit-agenda-grid" id="sumarryOfOotAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="sumarryOfOotAddDetails-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Initial Analysis</th>
                                                <th style="width: 16%"> Result From Phase I Investigation</th>
                                                <th style="width: 15%">Retesting Results After Correction Of Assignable Cause</th>
                                                <th style="width: 15%">Hypothesis/Experimentation Results</th>
                                                <th style="width: 15%">Result Of additional Tessting </th>
                                                <th style="width: 15%">Hypothesis Experiment Refrence/Additional Testing Refrence No</th>
                                                <th style="width: 15%">Results </th>
                                                <th style="width: 15%">Analyst Name </th>
                                                <th style="width: 15%">Remarks </th>





                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="InitialAnalysis[]"></td>
                                            <td><input type="text" name="ResultFromPhaseIInvestigation[]"></td>
                                            <td><input type="text" name="RetestingResultsAfterCorrectionOfAssignableCause[]"></td>
                                            <td><input type="text" name="Hypothesis/ExperimentationResults[]"></td>
                                            <td><input type="text" name="ResultOfadditionalTessting[]"></td>
                                            <td><input type="text" name="HypothesisExperimentRefrence/AdditionalTestingRefrenceNo[]"></td>
                                            <td><input type="text" name="Results[]"></td>
                                            <td><input type="text" name="AnalystName[]"></td>
                                            <td><input type="text" name="Remarks[]"></td>


                                        </tbody>
                                    </table>
                                </div>
                            </div>






                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="">Trend Limit</label>
                                    <input />
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Stands<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Result To Be Reported<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="">Reporting Results</label>
                                    <input />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference No </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Action Plan Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Action Plan Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Justification For Delay</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Attachment If any</label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          



                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-9 start=============== -->
                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Conclusion Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Impacted Product/Material
                                    <button type="button" name="audit-agenda-grid" id="impactedAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="impacted-Table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Material/Product Name</th>
                                                <th style="width: 16%"> Batch No (s)/A.R.No (s)</th>
                                                <th style="width: 15%">Any Other Information </th>
                                                <th style="width: 15%">Action Taken On Affected Batch</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>

                                            <td><input type="text" name="Material/ProductName[]"></td>
                                            <td><input type="text" name="BatchNO[]"></td>
                                            <td><input type="text" name="AnyOtherInformation[]"></td>
                                            <td><input type="text" name="ActionTakenOnAffectedBatch[]"></td>



                                        </tbody>
                                    </table>
                                </div>
                            </div>









                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CAPA Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Required Action Plan<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Refrence Record Plan </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Action Task Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Risk Assessment Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Risk Assessment Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> CQ Approver </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            



                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <!-- ==============Tab-10 start=============== -->

                <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> CQ Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>CAPA Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Reference Of CAPA </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Action Plan Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores"> Refrence Action Plan </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">CQ Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                       

                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-11 start=============== -->

                <div id="CCForm11" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Disposition Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>OOT Category<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Others</label>
                                    <input />
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label> Material Batch Release<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Conclusion</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Justify For Delay In Activity</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">File Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>                       
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-12 start=============== -->

                <div id="CCForm12" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Reason For Reopen</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Reopen Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            


                            


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-13 start=============== -->

                <div id="CCForm13" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Approval Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>





                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Approval Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>  
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-14 start=============== -->

                <div id="CCForm14" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Execution Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label>Action Task Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Action Task Reference </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Add. Testing Required<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Add. Testing Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Investigation Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Investigation Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label> Hypothesis Experiment Requirement<span class="text-danger"></span></label>
                                    <select>
                                        <option>---select---</option>
                                        <option>Yes </option>
                                        <option>No </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reference Recores">Hypothesis Experiment Refrence </label>
                                    <select multiple id="reference_record" name="PhaseIIQCReviewProposedBy[]" id="">
                                        <option value="">--Select---</option>
                                        <option value="">Pankaj</option>
                                        <option value="">Gourav</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Any Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!-- ==============Tab-15 start=============== -->

                <div id="CCForm15" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Addendum Review Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>




                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Required Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                          


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>   
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-16 start=============== -->

                <div id="CCForm16" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments">Verification Comments</label>
                                    <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure attachment">Verification Attachment </label>
                                    <div><small class="text-primary">
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="File_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Attachment[]" oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           


                        </div>
                        <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <!-- ==============Tab-17 start=============== -->

                <div id="CCForm17" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted by">Submitted By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Submitted On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation done On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation Conclusion By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation Conclusion On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Preliminary Lab Investigation Review By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Preliminary Lab Investigation Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Phase II Investigation Proposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Phase II Investigation Proposed On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Phase II QC Review Proposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Phase II QC Review Proposed  On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Additional TestProposed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Additional TestProposed  On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">OOT Conclusion Complete By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">OOT Conclusion Complete On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">OOT Conclusion Review By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">OOT Conclusion Review On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by"> CQ Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on"> CQ Review  On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Disposition Decision Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Disposition Decision   On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Reopen Addendum Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Reopen Addendum   On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Approved Done By </label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Approved   On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Execution Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Execution   On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Addendum Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Addendum Review   On</label>
                                    <div class="Date"></div>
                                </div>
                            </div> 

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Reviewed by">Verification Review Done By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved on">Verification Review    On</label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

<style>
    #step-form>div {
        display: none
    }

    #step-form>div:nth-child(1) {
        display: block;
    }
</style>

<script>
    VirtualSelect.init({
        ele: '#related_records, #hod'
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

        // Find the index of the clicked tab button
        const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

        // Update the currentStep to the index of the clicked tab
        currentStep = index;
    }

    const saveButtons = document.querySelectorAll(".saveButton");
    const nextButtons = document.querySelectorAll(".nextButton");
    const form = document.getElementById("step-form");
    const stepButtons = document.querySelectorAll(".cctablinks");
    const steps = document.querySelectorAll(".cctabcontent");
    let currentStep = 0;

    function nextStep() {
        // Check if there is a next step
        if (currentStep < steps.length - 1) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show next step
            steps[currentStep + 1].style.display = "block";

            // Add active class to next button
            stepButtons[currentStep + 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep++;
        }
    }

    function previousStep() {
        // Check if there is a previous step
        if (currentStep > 0) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show previous step
            steps[currentStep - 1].style.display = "block";

            // Add active class to previous button
            stepButtons[currentStep - 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep--;
        }
    }
</script>


<script>
    VirtualSelect.init({
        ele: '#reference_record, #notify_to'
    });

    $('#summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    let referenceCount = 1;

    function addReference() {
        referenceCount++;
        let newReference = document.createElement('div');
        newReference.classList.add('row', 'reference-data-' + referenceCount);
        newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
        let referenceContainer = document.querySelector('.reference-data');
        referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
    }
</script>

<script>
    $(document).ready(function() {
        $('#summaryadd').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="OOTNo[]"></td>' +
                    '<td><input type="text" name="OOTReportedDate[]"></td>' +
                    '<td><input type="text" name="DescriptionOfOOT[]"></td>' +
                    '<td><input type="text" name="previousIntervalDetails[]"></td>' +
                    '<td><input type="text" name="CAPA[]"></td>' +
                    '<td><input type="text" name="ClosureDateOfCAPA[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#summary_table_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#infoadd').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="Item/ProductCode[]"></td>' +
                    '<td><input type="text" name="Lot/BatchNo[]"></td>' +
                    ' <td><input type="text" name="A.R.Number[]"></td>' +
                    '<td><input type="text" name="MfgDate[]"></td>' +
                    '<td><input type="text" name="ExpiryDate[]"></td>' +
                    '<td><input type="text" name="LabelClaim[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#info_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#Details').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="ARNumber[]"></td>' +
                    '<td><input type="text" name="Condition:Temprature&RH[]"></td>' +
                    '<td><input type="text" name="Interval[]"></td>' +
                    '<td><input type="text" name="Orientation[]"></td>' +
                    '<td><input type="text" name="PackDetails[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#Details-Table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#ootadd').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    ' <td><input type="text" name="ARNumber[]"></td>' +
                    '   <td><input type="text" name="TestNameOfOOT[]"></td>' +
                    '<td><input type="text" name="ResultObtained[]"></td>' +
                    '<td><input type="text" name="InitialIntervalDetails[]"></td>' +
                    '<td><input type="text" name="previousIntervalDetails[]"></td>' +
                    '<td><input type="text" name="DifferenceOfResults[]"></td>' +
                    '<td><input type="text" name="TrendLimit[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#oot_table_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#sumarryOfOotAdd').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="InitialAnalysis[]"></td>' +
                    '<td><input type="text" name="ResultFromPhaseIInvestigation[]"></td>' +
                    '<td><input type="text" name="RetestingResultsAfterCorrectionOfAssignableCause[]"></td>' +
                    '<td><input type="text" name="Hypothesis/ExperimentationResults[]"></td>' +
                    '<td><input type="text" name="ResultOfadditionalTessting[]"></td>' +
                    '<td><input type="text" name="HypothesisExperimentRefrence/AdditionalTestingRefrenceNo[]"></td>' +
                    '<td><input type="text" name="Results[]"></td>' +
                    '<td><input type="text" name="AnalystName[]"></td>' +
                    '<td><input type="text" name="Remarks[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#sumarryOfOotAddDetails-Table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#impactedAdd').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="Material/ProductName[]"></td>' +
                    '<td><input type="text" name="BatchNO[]"></td>' +
                    '<td><input type="text" name="AnyOtherInformation[]"></td>' +
                    '<td><input type="text" name="ActionTakenOnAffectedBatch[]"></td>' +
                    '</tr>';
                '</tr>';

                return html;
            }

            var tableBody = $('#impacted-Table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection