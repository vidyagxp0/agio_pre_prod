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
            / ERRATA
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD Review</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">CFT</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA Head Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Signatures</button>
            </div>

            <form action="{{ route('errata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- -----------Tab-1------------ -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Parent Record Information</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Originator"><b>Record No</b></label>
                                        <input type="text" name="record_no" value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Site/Location Code <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="location_code">
                                            <option value="">Select a value</option>
                                            <option value="001">001</option>
                                            <option value="002">002</option>
                                            <option value="003">003</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>ERRATA Date </b></label>
                                        <input type="date" name="errata_date" value="">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            ERRATA Issued By <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="errata_issued_by">
                                            <option value="">Select a value</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Initiated By <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="initiated_by">
                                            <option value="">Select a value</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="Department">
                                            <option value="">Select a value</option>
                                            <option value="Pankaj Jat">Pankaj Jat</option>
                                            <option value="Gaurav">Gaurav</option>
                                            <option value="Manish">Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department Code<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="department_code">
                                            <option value="">Select a value</option>
                                            <option value="DC01">DC01</option>
                                            <option value="DC02">DC02</option>
                                            <option value="DC03">DC03</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Document Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="document_type">
                                            <option value="">Select a value</option>
                                            <option value="D01">D01</option>
                                            <option value="D02">D02</option>
                                            <option value="D03">D03</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Document Title</label>
                                        <textarea class="summernote" name="document_title" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="Reference Recores">Refrence Documents </label>
                                        <select multiple id="reference_record" name="reference_document[]"
                                            id="">
                                            <option value="">--Select---</option>
                                            <option value="RD01">RD01</option>
                                            <option value="RD02">RD02</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Error Observed on Page
                                            No.</label>
                                        <textarea class="summernote" name="Observation_on_Page_No" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Brief Description</label>
                                        <textarea class="summernote" name="brief_description" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="search">
                                            Type Of Error<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="type_of_error">
                                            <option value="">-- Select a value --</option>
                                            <option value="Typographical Error (TE)">Typographical Error (TE)</option>
                                            <option value="Calculation Error (CE)">Calculation Error (CE)</option>
                                            <option value="Grammatical Error (GE)">Grammatical Error (GE)</option>
                                            <option value="Missing Word Error (ME)">Missing Word Error (ME)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Details
                                        <button type="button" name="details" id="Details-add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Launch Deviation
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row#</th>
                                                    <th style="width: 12%">List Of Impacting Document (If Any)</th>
                                                    <th style="width: 16%"> Prepared By</th>
                                                    <th style="width: 15%">Checked By</th>
                                                    <th style="width: 15%">Approved By</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="details[0][serial]"
                                                        value="1"></td>
                                                <td><input type="text" name="details[0][ListOfImpactingDocument]"></td>
                                                <td><input type="text" name="details[0][PreparedBy]"></td>
                                                <td><input type="text" name="details[0][CheckedBy]"></td>
                                                <td><input type="text" name="details[0][ApprovedBy]"></td>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="dateandtime"><b>Date And Time of Correction </b></label>
                                        <input type="date" name="Date_and_time_of_correction" value="">

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
                    <!-- -----------Tab-2------------ -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">HOD Remarks</label>
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD attachment">HOD Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="HOD_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-3------------ -->
                    {{-- <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Production</div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Production Review Required </label>
                                        <select name="production_review_required">
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Production Person </label>
                                        <select name="">
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Production)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Production Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Production Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Production Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Production Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Warehouse</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Warehouse Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Warehouse Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Warehouse)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Warehouse Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Warehouse Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Warehouse Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Warehouse Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Quality Control</div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Quality Control Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Quality Control Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Quality
                                            Control)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Quality Control Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Quality Control Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Quality Control Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Quality Control Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Engineering </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Engineering Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Engineering Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Engineering)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Engineering Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Engineering Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Engineering Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Engineering Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Analytical Development Laboratry </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Analytical Development Laboratry Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Analytical Development Laboratry Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Analytical
                                            Development Laboratry)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Analytical Development Laboratry
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Analytical Development Laboratry Attachments
                                        </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Analytical Development Laboratry Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Analytical Development Laboratry Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>



                                <div class="sub-head">Process Development Laboratry </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Process Development Laboratry Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Process Development Laboratry Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Process
                                            Development Laboratry)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Process Development Laboratry
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Process Development Laboratry Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Process Development Laboratory / Kilo Lab Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Process Development Laboratory / Kilo Lab Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Technology Transfer Design </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Technology Transfer Design Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Technology Transfer Design Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Technology
                                            Transfer Design)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Technology Transfer Design
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Technology Transfer Design Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Technology Transfer / Design Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Technology Transfer / Design Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>




                                <div class="sub-head">Environment Health & Safety </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Environment Health & Safety Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Environment Health & Safety Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Environment
                                            Health & Safety)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Environment Health & Safety
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Environment Health & Safety Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Environment, Health & Safety Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Environment, Health & Safety Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head"> Human Resource & Administration </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by"> Human Resource & Administration Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by"> Human Resource & Administration Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Human Resource &
                                            Administration)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Human Resource & Administration
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment"> Human Resource & Administration Attachments
                                        </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Human Resource & Administration Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Human Resource & Administration Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Information Technology </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Information Technology Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Information Technology Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Information Technology Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Information Technology Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Information Technology Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Information Technology Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Project Management </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Project Management Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Project Management Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Project
                                            Management )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Project Management Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Project Management Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 1 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 1 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 1 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 1
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 1 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 1 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Project Management Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Project Management Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 2 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 2
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 2 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 2 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 3 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 2 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 3 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 3
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 3 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 3 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 3 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 3 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 4 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 4
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 4 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 4 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 4 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 4 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 5 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 5
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 5 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 5 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 5 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 5 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- -----------Tab-4------------ -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="QA Feedbacks">QA Feedbacks</label>
                                        <textarea class="summernote" name="QA_Feedbacks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Attachment">QA Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="QA_Attachments" name="QA_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-5------------ -->

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-6">
                                    <div class="group-input">
                                        <label class="" for="Audit Comments">Closure Comments</label>
                                        <input type="text" name="Closure_Comments" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            All Impacting Documents Corrected <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..."
                                            name="All_Impacting_Documents_Corrected">
                                            <option value="">Select a value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Remarks (If Any)</label>
                                        <textarea class="summernote" name="Remarks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Closure_Attachments"
                                                    name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- -----------Tab-6------------ -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted by">Submitted By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Submitted on">Submitted On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">QA Review Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">QA Review Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Correction Completed by">Correction Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Correction Completed on">Correction Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By on">HOD Review Complete By On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed by">QA Head Aproval Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed on">QA Head Aproval Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>




                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
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
        $(document).ready(function() {
            $('#Details-add').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html = '';
                    html += '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="details[' + serialNumber +
                        '][ListOfImpactingDocument]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][PreparedBy]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][CheckedBy]"></td>' +
                        '<td><input type="text" name="details[' + serialNumber + '][ApprovedBy]"></td>' +

                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#Details-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
