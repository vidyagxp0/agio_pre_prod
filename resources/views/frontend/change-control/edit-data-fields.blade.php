@extends('frontend.layout.main')
@section('container')

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            @php
                toastr()->error($error);
            @endphp
        @endforeach
    @endif

    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Group Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">QA Evaluation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Approval Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Change Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
            </div>
            <form id="myForm" action="{{ route('change-control.update', $openStage->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tab content -->
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="rls">Record Number</label>
                                        <div class="statis">Record- {{ $openStage->recordData }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="division">Division Code</label>
                                    <div class="static">CRS</div>
                                </div>
                            </div> --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="originator">Originator</label>
                                        <div class="static">{{ $openStage->initiator }}</div>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="originator">Date Opened</label>
                                        <div class="static">{{ $openStage->date }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Inititator Group</label>
                                        <select name="initiatorGroup">
                                            <option value="1">-- Select --</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-code">Initiator Group Code</label>
                                        <div class="status">PAT</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="short-desc">Title<span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $openStage->title }}"
                                            id="ChangeTitle">
                                    </div>
                                    <p id="ChangeTitleError" style="color:red"> **Title is required</p>
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="title_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description<span class="text-danger">*</span></label>
                                        <input type="text" id="Changeshort_description" name="short_description"
                                            value="{{ $openStage->short_description }}">
                                    </div>
                                    <p id="Changeshort_descriptionError" style="color:red"> **Short description is required
                                    </p>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="short_description_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="short-desc">Version</label>
                                        <input type="text" name="version" value="{{ $openStage->version }}">
                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="version_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">Batch</label>
                                        <input list="batches" name="batch" value="{{ $openStage->batch }}">
                                        <datalist id="batches">
                                            <option value="Document Identification">Document Identification</option>
                                            <option value="Change Request">Change Request</option>
                                            <option value="Review">Review</option>
                                            <option value="Approval">Approval</option>
                                            <option value="Implementation">Implementation</option>
                                            <option value="Testing">Testing</option>
                                            <option value="Verification">Verification</option>
                                        </datalist>
                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="batch_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date<span class="text-danger">*</span></label>
                                        <!-- <input type="date" name="due_date" id="Changedue_date"
                                            value="{{ $openStage->due_date }}"> -->
                                        <div class="calenderauditee">                                     
                                            <input type="text" value="{{ $openStage->due_date }}"  id="Changedue_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'Changedue_date')"/>
                                        </div>

                                        <p id="Changedue_dateError" style="color:red"> **Due Date is required</p>

                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="due_date_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="nature-change">Nature Of Change</label>
                                        <select name="nature-change">
                                            <option value="1">-- Select --</option>
                                            <option value="Temporary">Temporary</option>
                                            <option value="Permanent">Permanent</option>
                                        </select>
                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="nature_change_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="support-doc">Supporting Documents</label>
                                        <input type="file" name="support-doc">
                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="support_doc_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            HOD<span class="text-danger">*</span>
                                        </label>
                                        @php
                                            $user = DB::table('users')
                                                ->where('role', 4)
                                                ->get();
                                        @endphp
                                        <select name="assign_to" id="assign_to">
                                            <option value="1">-- Select --</option>
                                            @foreach ($user as $temp)
                                                <option value="{{ $temp->id }}" {{-- @if (old('assign_to') == $temp->id) selected @endif>
                                                    {{ $temp->name }} --}}
                                                    @if ($openStage->assign_to == $temp->id) selected @endif>{{ $temp->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="assign_to_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="cft">
                                            CFT Reviewers<span class="text-danger">*</span>
                                        </label>
                                        @php
                                            $user = DB::table('users')
                                                ->where('role', 5)
                                                ->get();
                                        @endphp

                                        <select multiple name="cft[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft">
                                            @foreach ($user as $temp)
                                                <option value="{{ $temp->id }}"
                                                    @if ($openStage->cft == $temp->id) selected @endif>{{ $temp->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p id="ChangecftError" style="color:red"> **CFT Reviewers is required</p>

                                    </div>
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at
                                                {{ date('d-M-Y h:i:s') }}</p>
                                            <input class="input-field" type="text" name="cft_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="cft">
                                            Document Required<span class="text-danger">*</span>
                                        </label>


                                        <select name="document_required" id="document_required">
                                            <option value="">-- Select --</option>
                                            <option {{ $openStage->document_required == 'no' ? 'selected' : '' }}
                                                value="no">No</option>
                                            <option {{ $openStage->document_required == 'yes' ? 'selected' : '' }}
                                                value="yes">Yes</option>
                                        </select>
                                        <p id="Changedocument_requiredError" style="color:red"> **This field is required
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="doc-detail">
                                            Document Details<button type="button" name="ann"
                                                onclick="addDocDetail('doc-detail')">+</button>
                                        </label>
                                        <table class="table-bordered table" id="doc-detail">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Current Document No.</th>
                                                    <th>Current Version No.</th>
                                                    <th>New Document No.</th>
                                                    <th>New Version No.</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Current Practice<button type="button" id="currentpracticeadd"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="currentpractice[]" class="myclassname">
                                        <div id="currentpracticediv"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Proposed Change<button type="button" id="proposedchangeadd"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="proposedchange[]" class="myclassname">
                                        <div id="proposedchangediv"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Reason for Change<button type="button" id="reasonchangeadd"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="reasonchange[]" class="myclassname">
                                        <div id="reasonchangediv"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Supervisor Comments<button type="button" id="super-com-add"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="super-com[]" class="myclassname">
                                        <div id="super-com-div"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Any Other Comments<button type="button" id="othercomadd"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="othercom[]" class="myclassname">
                                        <div id="othercomdiv"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Cancellation Remarks<button type="button" id="cancellationadd"
                                                name="button">+</button>
                                        </label>
                                        <input type="text" name="cancellation[]" class="myclassname">
                                        <div id="cancellationdiv"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Individual Risk Assessment
                            </div>
                            <div class="group-input">
                                <label for="risk-assessment">
                                    Risk Assessment<button type="button" name="ann"
                                        onclick="addIndividualRisk('individual-risk')">+</button>
                                </label>
                                <table class="table table-bordered" id="individual-risk">
                                    <thead>
                                        <th>Sr. No.</th>
                                        <th>Identification of Risk</th>
                                        <th>Exiting Control</th>
                                        <th>Surveys</th>
                                        <th>Occurance</th>
                                        <th>Detection</th>
                                        <th>RPNS(S*O*D)</th>
                                        <th>Evaluation Of Risk</th>
                                        <th>Migration Plan</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="sub-head">
                                Overall Risk Assessment
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-identification">Risk Identification</label>
                                        <textarea name="risk-identification"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="severity">Severity</label>
                                        <input type="text" name="severity">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurance">Occurance</label>
                                        <input type="text" name="Occurance">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <input type="text" name="Detection">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <input type="text" name="RPN">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-evaluation">Risk Evaluation</label>
                                        <textarea name="risk-evaluation"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="migration-action">Migration Action</label>
                                        <textarea name="migration-action"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_change">Type of Change</label>
                                        <select name="type_chnage">
                                            <option value="1">-- Select --</option>
                                            <option value="major">Major</option>
                                            <option value="minor">Minor</option>
                                            <option value="critical">Critical</option>
                                            <option value="like">Like for like</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="qa_comments">QA Review Comments</label>
                                        <textarea name="qa_comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>
                                        <input type="text" name="related_records">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="qa_head">QA Head Attachments</label>
                                        <input type="file" name="qa_head">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Concerned Groups
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group_review">Is Group Review Required?</label>
                                        <select name="goup_review">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production">Production</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production-Person">Production Person</label>
                                        <select name="Production-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Control">Quality Control</label>
                                        <select name="Quality-Control">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Control-Person">Quality Control Person</label>
                                        <select name="Quality-Control-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">Microbiology</label>
                                        <select name="Microbiology">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">Microbiology Person</label>
                                        <select name="Microbiology-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse">Warehouse</label>
                                        <select name="Warehouse">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse-Person">Warehouse Person</label>
                                        <select name="Warehouse-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering">Engineering</label>
                                        <select name="Engineering">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering-Person">Engineering Person</label>
                                        <select name="Engineering-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Instrumentation">Instrumentation</label>
                                        <select name="Instrumentation">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Instrumentation-Person">Instrumentation Person</label>
                                        <select name="Instrumentation-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Validation">Validation</label>
                                        <select name="Validation">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Validation-Person">Validation Person</label>
                                        <select name="Validation-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research-Development">Research & Development</label>
                                        <select name="Research-Development">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research-Development-Person">Research & Development Person</label>
                                        <select name="Research-Development-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="packaging_Development">Packaging Development</label>
                                        <select name="packaging_Development">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="packaging_Development-Person">Packaging Development Person</label>
                                        <select name="packaging_Development-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_international">Business Development (Interntional)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_international-Person">Business Development (Interntional)
                                            Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Business Development (Domestic)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Business Development (Domestic) Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Safety)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Safety) Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Environment)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Environment)
                                            Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Health)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Health) Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Customer Group</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Customer Group Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Regulatory Affairs (International)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Regulatory Affairs (International) Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Regulatory Affairs (Domestic)</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Regulatory Affairs (Domestic) Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Qualified</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Qualified Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Information Technology</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Information Technology Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Procurement</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Procurement Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Clinical Pharmacology Unit</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Clinical Pharmacology Unit Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Project Management</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Project Management Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Clinical Operations</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Clinical Operations Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Bioanalytical Laboratory</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Bioanalytical Laboratory Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Pharmacovigilance</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Pharmacovigilance Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Medical Writing</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Medical Writing Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Statistics</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Statistics Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Data Management</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Data Management Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Logistics</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Logistics Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Others</label>
                                        <select name="Production">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Others Person</label>
                                        <select name="B-Person">
                                            <option value="1">-- Select --</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm6" class="inner-block cctabcontent">
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
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="qa-eval-comments">QA Evaluation Comments</label>
                                <textarea name="qa-eval-comments"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                <input type="file" name="qa-eval-attach">
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="qa-appro-comments">QA Approval Comments</label>
                                <textarea name="qa-appro-comments"></textarea>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="risk-assessment">
                                    Affected Documents Grid<button type="button" name="ann"
                                        onclick="addAffectedDocuments('affected-documents')">+</button>
                                </label>
                                <table class="table table-bordered" id="affected-documents">
                                    <thead>
                                        <th>Sr. No.</th>
                                        <th>Affected Documents</th>
                                        <th>Document Name</th>
                                        <th>Document No.</th>
                                        <th>Version No.</th>
                                        <th>Implementation Date</th>
                                        <th>New Document No.</th>
                                        <th>New Version No.</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="qa-closure-comments">QA Closure Comments</label>
                                <textarea name="qa-closure-comments"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="attach-list">List Of Attachments</label>
                                        <input type="file" name="attach-list">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="effective-check">Effectivess Check Required?</label>
                                        <select name="effective-check">
                                            <option value="1">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="effective-check-date">Effectiveness Check Creation Date</label>
                                        <!-- <input type="date" name="effective-check-date"> -->

                                        <div class="calenderauditee">                                     
                                        <input type="text"  id="effective-check-date"  readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="effective-check-date" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'effective-check-date')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="notify">Notify To</label>
                                        <input type="text" name="notify">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Electronic Signatures
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Review Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Review Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change reviewed By (QA)</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change reviewed On (QA)</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Plan Requested By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Plan Requested On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Evaluated By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Evaluated On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Requested By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Requested On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Selected By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Selected On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Approved By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Approved On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QAH?Desig More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QAH?Desig More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Action Items Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Action Items Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Closed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Closed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-head">
                                Electronic Signatures - Group Assessment
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Production Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Production Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Quality Control Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Quality Control Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Microbiology Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Microbiology Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Warehouse Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Warehouse Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Engineering Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Engineering Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Instrumentation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Instrumentation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Validation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Validation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">R & D Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">R & D Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Packaging Dev Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Packaging Dev Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Safety) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Safety) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Environment) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Environment) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Health) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Health) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Customer Group Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Customer Group Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Qualified Person Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Qualified Person Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">IT Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">IT Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Procurement Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Procurement Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CP Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CP Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Project Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Project Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Clinical Ops Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Clinical Ops Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BL Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BL Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Pharmacovigiance Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Pharmacovigiance Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Medical Writing Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Medical Writing Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Statistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Statistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Data Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Data Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Logistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Logistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Others Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Others Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
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
            ele: '#cft'
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

@endsection
