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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm18')">Other Then Stability Batches </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">Checklist - Preliminary Laboratory
                    Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Checklist - Part B: Applicable if
                    Laboratory error identified</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist -Part D: Communication of
                    Confirmed of OOT With Technical Committee </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Justification Of Delay</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure Conclusion</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Investigation Review</button>
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
            <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
            </div>

            <form action="{{ route('oot.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="Initiator Group">Type </label>
                                    <select id="dynamicSelectType" name="type">
                                        <option value="{{ route('oot.index');  }}">OOT</option>
                                        <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                                        <option value="{{ route('oos.index') }}">OOS Chemical</option>
                                    </select>
                                </div>
                            </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label disabled for="Short Description">Division Code</label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Short Description">Initiator <span class="text-danger"></span></label>
                                        <input disabled type="text" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="group-input ">
                                        <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="group-input ">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <input type="date" name="due_date">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Short Description">Severity Level <span
                                                class="text-danger"></span></label>

                                        <select name="severity_level" id="severity_level">
                                            <option>---select---</option>
                                            <option value="major">Major</option>
                                            <option value="minor">minor </option>
                                            <option value="critical">critical </option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Short Description">Initiator Group <span
                                                class="text-danger"></span></label>
                                        <select name="initiator_group">
                                            <option>---select---</option>
                                            @foreach (Helpers::getInitiatorGroups() as $code => $initiator_group)
                                                <option value="{{ $code }}" @if (old('initiator_group') == $code) selected @endif>{{ $initiator_group }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Short Description">Initiator Group Code <span
                                                class="text-danger"></span></label>
                                        <input type="text" name="initiator_group_code"  readonly>
                                    </div> 
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description">Initiated Through<span
                                                class="text-danger"></span></label>
                                        <select name="initiated_through" id="initiated_through">
                                            <option>---select---</option>
                                            <option value="oos_micro">OOS Micro </option>
                                            <option value="oos_chemical">OOS Chemical </option>
                                            <option value="lab_incident">Lab Incident</option>
                                            <option value="others">Others </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">If Others </label>
                                        <textarea class="summernote" name="if_others" id="summernote-16"></textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description">Is Repeat<span class="text-danger"></span></label>
                                        <select id="is_repeat" name="is_repeat">
                                            <option>---select---</option>
                                            <option value="yes">Yes </option>
                                            <option value="no">No </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Repeat Nature</label>
                                        <textarea class="summernote" name="repeat_nature" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description">Nature Of Change<span class="text-danger"></span></label>
                                        <select multiple id="natureOfChange" name="nature_of_change">
                                            <option>---select---</option>
                                            <option value="temporary">Temporary </option>
                                            <option value="permanent">Permanent </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>OOT Occured On</label>
                                        <input type="date" name="oot_occured_on">
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">OOT Details</label>
                                        <textarea class="summernote" name="oot_details" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Product History</label>
                                        <textarea class="summernote" name="producct_history" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Probable Cause</label>
                                        <textarea class="summernote" name="probble_cause" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Investigation Details</label>
                                        <textarea class="summernote" name="investigation_details" id="investigation_details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Comments</label>
                                        <textarea class="summernote" name="comments" id="comments"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reference Recored">Refrence Record<span
                                                class="text-danger"></span></label>
                                        <select id="reference" name="reference">
                                            <option>---select---</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="sub-head">OOT Information</div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Product Material Name</label>
                                        <input  type="text" name="productmaterialname" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Grade/Type Of Water</label>
                                        <input type="text" name="grade_typeofwater">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Sample Location/Point</label>
                                        <input type="text" name="sampleLocation_Point">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Market</label>
                                        <input type="text" name="market" id="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label>Customer</label>
                                        <input type="text" name="customer"/>
                                    </div>
                                </div>


                                <div class="group-input">
                                    <label for="audit-agenda-grid">  Product/Material  <button type="button" name="audit-agenda-grid" id="infoadd">+</button>
                                        <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;"> </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="info_details">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row No.</th>
                                                    <th style="width: 12%">Item/Product Code</th>
                                                    <th style="width: 16%">Lot/Batch No</th>
                                                    <th style="width: 15%">A.R.Number</th>
                                                    <th style="width: 15%">Mfg Date</th>
                                                    <th style="width: 15%">Expiry Date </th>
                                                    <th style="width: 15%">Label Claim</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="product_materiel[0][serial]" value="1"></td>
                                                <td><input type="text" name="product_materiel[0][item_product_code]"></td>
                                                <td><input type="text" name="product_materiel[0][lot_batch_no]"></td>
                                                <td><input type="text" name="product_materiel[0][a_r_number]">
                                                <td><input type="date" name="product_materiel[0][m_f_g_date]"></td>
                                                <td><input type="date" name="product_materiel[0][expiry_date]"></td>
                                                <td><input type="text" name="product_materiel[0][label_claim]"></td>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Analyst Name<span class="text-danger"></span></label>
                                        <input type="text" name="analyst_name" id="">
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reference Recores">Sample Type </label>
                                        <select multiple id="reference_record" name="reference_record[]" id="">
                                            <option>--Select---</option>
                                            <option value="pankaj" >Pankaj</option>
                                            <option value="gaurav">Gourav</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Others (Specify)<span class="text-danger"></span></label>
                                        <input type="text" name="others">
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reference Recores">Stability For </label>
                                        <select multiple id="stability_for" name="stability_for[]"
                                            id="">
                                            <option>--Select---</option>
                                            <option value="pankaj">Pankaj</option>
                                            <option value="pankaj">Gourav</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="group-input">
                                    <label for="audit-agenda-grid"> Details Of Stability Study
                                        <button type="button" name="audit-agenda-grid" id="Details">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-Table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row#</th>
                                                    <th style="width: 12%">AR Number</th>
                                                    <th style="width: 16%">Condition:Temprature &RH</th>
                                                    <th style="width: 15%">Interval</th>
                                                    <th style="width: 15%">Orientation</th>
                                                    <th style="width: 15%">Pack Details (if any) </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="details_of_stability[]" value="1"></td>

                                                <td><input type="text" name="details_of_stability[0][a_r_number]"></td>
                                                <td><input type="text" name="details_of_stability[0][temprature]"></td>
                                                <td><input type="text" name="details_of_stability[0][interval]"></td>
                                                <td><input type="text" name="details_of_stability[0][orientation]"></td>
                                                <td><input type="text" name="details_of_stability[0][pack_details]"></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Specification Procedure Number <span class="text-danger"></span></label>
                                        <input type="text" name="specification_procedure_number" id="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Specification Limit<span class="text-danger"></span></label>
                                        <input type="text" name="specification_limit">
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        OOT Results
                                        <button type="button" name="audit-agenda-grid" id="ootadd">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

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
                                                <td><input disabled type="text" name="oot_result[]" value="1"></td>
                                                <td><input type="text" name="oot_result[0][a_r_number]"></td>
                                                <td><input type="text" name="oot_result[0][test_name_of_oot]"></td>
                                                <td><input type="text" name="oot_result[0][result_obtained]"></td>
                                                <td><input type="text" name="oot_result[0][i_i_details]"></td>
                                                <td><input type="text" name="oot_result[0][p_i_details]"></td>
                                                <td><input type="text" name="oot_result[0][difference_of_result]"></td>
                                                <td><input type="text" name="oot_result[0][trend_limit]"></td>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <script>
                                    $(document).ready(function () {
                                        $(".add_training_attachment").click(function(){
                                            $("#myfile").trigger("click");
                                        });
                                    });
    
                                    function addAttachmentFiles(input, block_id) {
                                        console.log('test')
                                            let block = document.getElementById(block_id);
                                            let files = input.files;
                                            for (let i = 0; i < files.length; i++) {
                                                let div = document.createElement('div');
                                                div.className = 'attachment-item'; 
                                                div.innerHTML = files[i].name;
                                
                                                let viewLink = document.createElement("a");
                                                viewLink.href = URL.createObjectURL(files[i]);
                                                viewLink.textContent = "</View>";
                                                viewLink.addEventListener('click', function(e){
                                                    e.preventDefault();
                                                    window.open(viewLink.href,'_blank');
                                                });
                                
                                              
                                                let removeButton = document.createElement("a");
                                                removeButton.className = 'remove-button';
                                                removeButton.textContent = "</Remove>";
                                                removeButton.addEventListener('click', function() {
                                                    div.remove();
                                                    input.value = ''; 
                                                });
    
                                                console.log(removeButton)
                                
                                                div.appendChild(viewLink);
                                                div.appendChild(removeButton);
                                                block.appendChild(div);
                                            }
                                        }
                                        
                                </script>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">File Attachment </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Attachment"></div>
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

                    <di v id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Corrective Action</label>
                                        <textarea class="summernote" name="corrective_action" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Preventive Action</label>
                                        <textarea class="summernote" name="preventive_action" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Comments</label>
                                        <textarea class="summernote" name="inv_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">File Attachment </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="inv_file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="inv_file_attachment[]" oninput="addMultipleFiles(this, 'inv_file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Head QA/Designee <span class="text-danger"></span>
                                        </label>
                                        <select name="inv_head_designee" id="">
                                            <option value="">Person Name</option>
                                            <option value="test">test</option>

                                        </select>
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
                    </di>
                    <div id="CCForm18" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Reason for Stability</label>
                                        <textarea class="summernote" name="reason_for_stability" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Info On Product/Material
                                        <button type="button" name="audit-agenda-grid" id="productMaterialInfo">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">

                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="productMaterialInfo_details">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">Row No.</th>
                                                    <th style="width: 12%">Batch No.</th>
                                                    <th style="width: 16%"> Mfg. Date</th>
                                                    <th style="width: 15%">Exp. Date</th>
                                                    <th style="width: 15%">AR No.</th>
                                                    <th style="width: 15%">Pack Style </th>
                                                    <th style="width: 15%">Frequency</th>
                                                    <th style="width: 15%">Condition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial[]" value="1"></td>
                                                <td><input type="text" name="info_product[0][batch_no]"></td>
                                                <td><input type="date" name="info_product[0][mfg_date]"></td>
                                                <td><input type="date" name="info_product[0][exp_date]"></td>
                                                <td><input type="text" name="info_product[0][ar_number]"></td>
                                                <td><input type="text" name="info_product[0][pack_style]"></td>
                                                <td><input type="text" name="info_product[0][frequency]"></td>
                                                <td><input type="text" name="info_product[0][condition]"></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Brief Description of OOT
                                            Details</label>
                                        <textarea class="summernote" name="description_of_oot_details" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Product History</label>
                                        <textarea class="summernote" name="sta_bat_product_history" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Probable Cause</label>
                                        <textarea class="summernote" name="sta_bat_probable_cause" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search"> Analyst Name <span class="text-danger"></span> </label>
                                        <select name="sta_bat_analyst_name" id="">
                                            <option value="">Person Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search"> QC/QA Head/Designee <span class="text-danger"></span> </label>
                                        <select name="qa_head_designee" id="">
                                            <option value="">Person Name</option>
                                            <option value="test">test</option>
                                        </select>
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

                    <div id="CCForm19" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Preliminary Laboratory Investigation Required  ?<span class="text-danger"></span></label>
                                        <select name="p_l_irequired">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Table --}}
                                <div class="col-12">
                                    <center>
                                        <label style="font-weight: bold; for="Audit Attachments">Preliminary Laboratory Investigation</label>
                                    </center>
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 40%;">Question</th>
                                                        <th style="width: 20%;">Response</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="flex text-center">1</td>
                                                        <td>Were the equipment instrument used for analysis was in
                                                            calibrated state?</td>
                                                        <td>

                                                            <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_one" id="responce_one"  style="padding:   2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_one" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>



                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">2</td>
                                                        <td>Did all components/parts of equipment instrument function properly</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_two" id="responce_one"  style="padding:   2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_two" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">3</td>
                                                        <td>Was there any evidence that the sample is contaminated?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_three" id="response"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="when_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_three" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">4</td>
                                                        <td>Is the SOP adequate and operation performed as per sop</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_four" id="responce_four"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="coverage_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_four" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">5</td>
                                                        <td>Was the glassware used of Class A? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_five" id="responce_five"  style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_five" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">6</td>
                                                        <td>Was there any evidence that the glassware used .may be  contaminated?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_six" id="responce_six"  style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_six" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">7</td>
                                                        <td>Were the instrument problems such as noisy baseline, poor peak
                                                            resolution, poor injection reproducibility, unidentified peak or
                                                            contamination that affected peak integration, etc. noticed?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_seven" id="responce_seven" style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_seven" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">8</td>
                                                        <td>8 Any critical parts of equipment/instrument like detector, lamp etc. and needed replacement?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_eight" id="responce_eight" style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_eight" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">9</td>
                                                        <td>Was the correct testing procedure followed? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_nine" id="responce_nine"    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_nine" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">10</td>
                                                        <td>Was there change in instrument, column, method, integration
                                                            technique or standard? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_ten" id="response"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                    <option value="a/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_ten" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td class="flex text-center">11</td>
                                                        <td>Were the standards & reagents properly stored? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_eleven" id=""
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_eleven" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">12</td>
                                                        <td>Were standards, reagents properly labelled? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twele" id="responce_twele"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twele" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">13</td>
                                                        <td>Was there any evidence that the standards, reagents have
                                                            degraded? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thrteen" id="responce_thrteen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thrteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">14</td>
                                                        <td>Were the reagents/chemicals used of recommended grade? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_fourteen" id="responce_fourteen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_fourteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">15</td>
                                                        <td>Was the evidence that the reagents, standards or other materials
                                                            used for test were contaminated. </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_fifteen" id="response"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_fifteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">16</td>
                                                        <td>Whether correct working /reference standard were used? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_sixteen" id="responce_sixteen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_sixteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">17</td>
                                                        <td>Was the testing procedure adequate and followed properly? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_seventeen" id="responce_seventeen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_seventeen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">18</td>
                                                        <td>Was the glassware used properly washed?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_eighteen" id="responce_eighteen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_eighteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">19</td>
                                                        <td>Were standards, reagents used within their expiration dates?
                                                        </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_ninteen" id="responce_ninteen"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_ninteen" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">20</td>
                                                        <td>Were volumetric solutions standardized as per testing procedure?
                                                        </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty" id="responce_twenty"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">21</td>
                                                        <td>Were Working standards standardized as per testing procedure?
                                                        </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_one" id="responce_twenty_one"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_one" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">22</td>
                                                        <td>Were the dilutions made in sample /standard preparation as per
                                                            testing procedure?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_two" id="responce_twenty_two"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_two" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">23</td>
                                                        <td>Was the analyst trained / certified? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_three" id="responce_twenty_three"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_three" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">24</td>
                                                        <td>Analyst understood the testing procedure?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_four" id="responce_twenty_four"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_four" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">25</td>
                                                        <td>Analyst calculated the results correctly as mentioned in testing procedure</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_five" id="responce_twenty_five"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_five" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">26</td>
                                                        <td>Was there any similar occurrence with the same analyst earlier?
                                                        </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_six" id="responce_twenty_six"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_six" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">27</td>
                                                        <td>Was there any similar history with the product / material?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_seven" id="responce_twenty_seven"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_seven" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">28</td>
                                                        <td>Retention time of concerned peak is comparable with respect to
                                                            previous station (ln case of OOT in any individual and total
                                                            impurity)</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_eight" id="responce_twenty_eight"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_eight" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">29</td>
                                                        <td>Was the sample quantity is sufficient?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_twenty_nine" id="responce_twenty_nine"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_twenty_nine" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">30</td>
                                                        <td>Was Error in labelling details on the sample container?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thirty" id="responce_thirty"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thirty" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">31</td>
                                                        <td>Was the Specified storage condition of product sample     maintained? </td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thirty_one" id="responce_thirty_one"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thirty_one" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">32</td>
                                                        <td>Transient equipment /Instrument malfunction is suspected</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thirty_two" id="responce_thirty_two"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thirty_two" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">33</td>
                                                        <td>Where any change in the character of the sample observed?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thirty_three" id="responce_thirty_three"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thirty_three" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="flex text-center">34</td>
                                                        <td>Any other specific reason?</td>
                                                        <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="responce_thirty_four" id="responce_thirty_four"
                                                                    style="padding: 2px; width:90%; border: 1px solid rgb(125, 125, 125);  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                    <option value="n/a">N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                                                     <textarea class="Remarks" name="who_will_not_be"></textarea>
                                                                                 </td> --}} <td style="vertical-align: middle;">
                                                            <div
                                                                style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="remark_thirty_four" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Laboratory error Identified for OOT - Result(s)<span class="text-danger"></span></label>
                                        <select name="l_e_i_oot">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Elaborate The Reason(s) If Yes    :</label>
                                        <textarea class="summernote" name="elaborate_the_reson" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search">
                                            In-Charge <span class="text-danger"></span>   </label>
                                        <select name="in_charge" id="">
                                            <option value="">Select</option>
                                            <option value="test">test</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search"> QC Head/Designee <span class="text-danger"></span>  </label>
                                        <select name="pli_head_designee" id="">
                                            <option value="">Select</option>
                                            <option value="test">test</option>

                                        </select>
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

                    <div id="CCForm20" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Action Taken on OOT Result(s) :<span class="text-danger"></span></label>
                                        <select id="action_taken_result" name="action_taken_result">
                                            <option value="">---select---</option>
                                            <option value="yes">Yes </option>
                                            <option value="no">No </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Retraining to Analyst Required ? <span class="text-danger"></span></label>
                                        <select id="retraining_to_analyst_required" name="retraining_to_analyst_required">
                                            <option value="">---select---</option>
                                            <option value="yes">Yes </option>
                                            <option value="no">No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Remarks (If Yes)</label>
                                        <textarea class="summernote" name="cheklist_part_b_remarks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Correct the Error and Repeat the analysis on same sample<span
                                                class="text-danger"></span></label>
                                        <select id="analysis_on_same_sample" name="analysis_on_same_sample">
                                            <option value="">---select---</option>
                                            <option value="yes">Yes </option>
                                            <option value="no">No </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Any Other Actions Required</label>
                                        <textarea class="summernote" name="any_other_action" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Re-analysis Result</label>
                                        <textarea class="summernote" name="re_analysis_result" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>Is the Reanalysis results OOT <span class="text-danger"></span></label>
                                        <select id="reanalysis_result_oot" name="reanalysis_result_oot">
                                            <option value="">---select---</option>
                                            <option value="yes">Yes </option>
                                            <option value="no">No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Comments (If Yes)</label>
                                        <textarea class="summernote" name="part_b_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="closure attachment">Supporting Attachment </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="supporting_attechment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="supporting_attechment[]"  oninput="addMultipleFiles(this, 'supporting_attechment')" multiple>
                                            </div>
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
                    <div id="CCForm21" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div style=" background: #4274da; color: #ffffff;" class="sub-head">
                                    QA Head___ + R&D___ + ADL___ + Regulatory___ + Manufacturing___ + QA Head
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4">R&D (F) Comments</label>
                                        <textarea class="summernote" name="r_d_comments_part_b" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4">ADL Comments</label>
                                        <textarea class="summernote" name="a_d_l_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4">Regulatory Comments</label>
                                        <textarea class="summernote" name="regulatory_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4">Manufacturing Comments</label>
                                        <textarea class="summernote" name="manufacturing_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4">Comments</label>
                                        <textarea class="summernote" name="technical_commitee_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="closure attachment">Supporting Documents </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="supporting_documents[]"oninput="addMultipleFiles(this, 'supporting_documents')" multiple>
                                            </div>
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
                    <!-- ==============Tab-3 start=============== -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="group-input ">
                                        <label for="Last_due-date">Last Due Date <span   class="text-danger"></span></label>
                                        <input type="date" name="last_due_date">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Progress/Justification for Delay</label>
                                        <textarea class="summernote" name="progress_justification_delay" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="group-input ">
                                        <label for="tentative-date">Tentative Closure Date<span class="text-danger"></span></label>
                                        <input type="date" name="tentative_clousure_date">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Remarks by QA Department</label>
                                        <textarea class="summernote" name="remarks_by_qa_department" id="summernote-16"></textarea>
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
                                                <input type="file" id="myfile" name="conclusion_attechment[]" oninput="addMultipleFiles(this, 'conclusion_attechment')" multiple>
                                            </div>
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

                    <!------------------- Tab -8 Start ----------------- -->

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Closure Comments</label>
                                        <textarea class="summernote" name="closure_comments" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachment </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="doc_closure"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="doc_closure[]" oninput="addMultipleFiles(this, 'doc_closure')" multiple>
                                            </div>
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
                        </di>

                        {{-- </div>
                    
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
                </div> --}}

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
                                            <label for="Approved on">Phase II QC Review Proposed On</label>
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
                                            <label for="Approved on">Additional TestProposed On</label>
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
                                            <label for="Approved on"> CQ Review On</label>
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
                                            <label for="Approved on">Disposition Decision On</label>
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
                                            <label for="Approved on">Reopen Addendum On</label>
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
                                            <label for="Approved on">Addendum Approved On</label>
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
                                            <label for="Approved on">Addendum Execution On</label>
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
                                            <label for="Approved on">Addendum Review On</label>
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
                                            <label for="Approved on">Verification Review On</label>
                                            <div class="Date"></div>
                                        </div>
                                    </div>

                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton"
                                            onclick="previousStep()">Back</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}">Exit
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
            ele: '#related_records, #hod,#natureOfChange,#is_repeat'
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
            ele: '#reference_record, #notify_to, #stability_for'
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

        $('select[name=initiator_group]').change(function() {
            let initiator_code = $(this).val();
            $('input[name=initiator_group_code]').val(initiator_code);
        })

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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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
            let indexDetail = 1;
            $('#infoadd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="product_materiel['+ indexDetail +'][item_product_code]"></td>' +
                        '<td><input type="text" name="product_materiel['+ indexDetail +'][lot_batch_no]"></td>' +
                        ' <td><input type="text" name="product_materiel['+indexDetail +'][a_r_number]"></td>' +
                        '<td><input type="date" name="product_materiel['+ indexDetail +'][m_f_g_date]"></td>' +
                        '<td><input type="date" name="product_materiel['+indexDetail +'][expiry_date]"></td>' +
                        '<td><input type="text" name="product_materiel['+indexDetail+'][label_claim]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';
                    indexDetail++;
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

            let detailsIndex = 1;

            $('#Details').click(function(e) {
                function generateTableRow(serialNumber) {

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="details_of_stability['+ detailsIndex +'][a_r_number]"></td>' +
                        '<td><input type="text" name="details_of_stability['+ detailsIndex +'][temprature]"></td>' +
                        '<td><input type="text" name="details_of_stability['+ detailsIndex +'][interval]"></td>' +
                        '<td><input type="text" name="details_of_stability['+ detailsIndex +'][orientation]"></td>' +
                        '<td><input type="text" name="details_of_stability['+ detailsIndex +'][pack_details]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';

                    detailsIndex++;

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
            let ootIndex =1;
            $('#ootadd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        ' <td><input type="text" name="oot_result['+ootIndex+'][a_r_number]"></td>' +
                        ' <td><input type="text"name="oot_result['+ootIndex+'][test_name_of_oot]"></td>' +
                        '<td><input type="text" name="oot_result['+ootIndex+'][result_obtained]"></td>' +
                        '<td><input type="text" name="oot_result['+ootIndex+'][i_i_details]"></td>' +
                        '<td><input type="text" name="oot_result['+ootIndex+'][p_i_details]"></td>' +
                        '<td><input type="text" name="oot_result['+ootIndex+'][difference_of_result]"></td>' +
                        '<td><input type="text" name="oot_result['+ootIndex+'][trend_limit]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';
                    ootIndex++;
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
        let infoProduct = 1:
        $('#productMaterialInfo').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text"    name="info_product['+infoProduct+'][batch_no]"></td>' +
                    '<td><input type="date"   name="info_product['+infoProduct+'][mfg_date]"></td>' +
                    '<td><input type="date"   name="info_product['+infoProduct+'][exp_date]"></td>' +
                    '<td><input type="text"    name="info_product['+infoProduct+'][ar_number]"></td>' +
                    '<td><input type="text"    name="info_product['+infoProduct+'][pack_style]"></td>' +
                    '<td><input type="text"    name="info_product['+infoProduct+'][frequency]"></td>' +
                    '<td><input type="text"    name="info_product['+infoProduct+'][condition]"></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';
                '</tr>';
                infoProduct++;
                return html;
            }
            var tableBody = $('#productMaterialInfo_details tbody');
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
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
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
@endsection
