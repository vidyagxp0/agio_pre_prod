@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
        .remove-file  {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }
    </style>


    <script>
        function addMultipleFiles(input, block_id) {
            let block = document.getElementById(block_id);
            block.innerHTML = "";
            let files = input.files;
            for (let i = 0; i < files.length; i++) {
                let div = document.createElement('div');
                div.innerHTML += files[i].name;
                let viewLink = document.createElement("a");
                viewLink.href = URL.createObjectURL(files[i]);
                viewLink.textContent = "View";
                div.appendChild(viewLink);
                block.appendChild(div);
            }
        }
    </script>

    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }}/ CAPA
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        <?php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                       ?>
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                            {{-- <button class="button_theme1"> <a class="text-white" href="{{ url('CapaAuditTrial', $data->id) }}">
                                Audit Trail </a> </button> --}}
                            <a class="button_theme1 text-white" href="{{ url('CapaAuditTrial', $data->id) }}">
                                Audit Trail
                            </a>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Propose Plan
                            </button> </a>
                            
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                More Info Required
                            </button></a>
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button></a>
                            <a href="#child-modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button></a>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            {{-- <a href="#cancel-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button></a> --}}
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                              <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                               More Info Required
                            </button></a>
                           <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA/CQA Review Complete
                            </button></a>
                            <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                          <a href="#signature-modal">  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Approved
                            </button></a>
                            <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>
                            <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                 More Info Required
                              </button></a>

                        @elseif($data->stage == 5  && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                           <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                 Complete
                            </button></a>
                            {{-- <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                 More Info Required
                              </button></a> --}}
                            <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>
                            
                        @elseif($data->stage == 6 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Final Review Complete

                           </button></a>
                           <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                More Info Required
                             </button></a>
                             <a href="#child-modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button></a>
                             @elseif($data->stage == 7 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                             
                              <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Closure Review Complete
  
                             </button></a>
                             <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                  More Info Required
                               </button></a>
                               <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>
                            @elseif($data->stage == 8 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                             
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Approval  Complete

                           </button></a>
                           
                           <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                More Info Required
                           </button></a>
                           <a href="#child-modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                            Child
                        </button></a>
                           @elseif($data->stage == 9&& (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                           
                         <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                             data-bs-target="#child-modal1l">
                             Child
                         </button></a>

                        @endif
                         <a class="button_theme1 text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">HOD Review</div>
                            @else
                                <div class="">HOD Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">QA/CQA Review</div>
                            @else
                                <div class="">QA/CQA Review</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">QAH/CQA Approval</div>
                            @else
                                <div class="">QA/CQA Approval</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">CAPA In progress</div>
                            @else
                                <div class="">CAPA In progress</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">HOD Final Review</div>
                            @else
                                <div class="">HOD Final Review</div>
                            @endif
                            @if ($data->stage >= 7)
                            <div class="active">QA/CQA Closure Review</div>
                                @else
                            <div class="">QA/CQA Closure Review</div>
                            @endif
                            @if ($data->stage >= 8)
                            <div class="active">QAH/CQAH Approval </div>
                               @else
                            <div class="">QAH/CQAH Approval </div>
                              @endif
                              @if ($data->stage >= 9)
                              <div class="bg-danger">Closed - Done</div>
                          @else
                              <div class="">Closed - Done</div>
                          @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">

            {{-- ======================================
                    DATA FIELDS
            ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm11')">HOD Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QA Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CAPA Closure</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Additional Information</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Group Comments</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm13')">HOD Final Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA/CQA Closure Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm15')">QAH/CQAH Approval</button>

                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
                    </div>

                    <form action="{{ route('capaUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <!-- General information content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number">Record Number</label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number->record_number, 4, "0", STR_PAD_LEFT ) : '1' }}">
                                                {{-- <div class="static"></div> --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                {{-- <input disabled type="text" name="record"
                                                    value="{{ $data->record }}"> --}}
                                                    <input disabled type="text" name="record" id="record"
                                                    value="{{Helpers::getDivisionName(session()->get('division'))}}/CAPA/{{ date('Y') }}/{{ $data->record}}">
                                                    
            
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Site/Location Code</label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                              
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Site/Location Code</label>
                                                <input readonly type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                                <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator">Initiator</label>
                                                <input disabled type="text" name="initiator_id"
                                                    value="{{ $data->initiator_name }}">
                                                {{-- <div class="static"> </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                @php
                                                    $formattedDate = \Carbon\Carbon::parse($data->intiation_date)->format('j-F-Y');
                                                @endphp
                                                <input disabled type="text" value="{{ $formattedDate }}" name="intiation_date_display">
                                                <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} >
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->name ? 'selected' : '' }}
                                                            value="{{ $value->name }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                @if (!empty($revised_date))
                                                <input readonly type="text"
                                                value="{{ Helpers::getdateFormat($revised_date) }}">
                                                @else
                                                <input disabled type="text"
                                                value="{{ Helpers::getdateFormat($data->due_date) }}">
                                                @endif

                                            </div>
                                        </div> -->
                                        {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        {{-- <input type="text" value="{{ $data->due_date }}" name="due_date"> --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}

                                    {{-- </div>
                                </div> --}} 
                                
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                        <div class="calenderauditee">
                                            <!-- Format ki hui date dikhane ke liye readonly input -->
                                            <input  type="text" id="due_date_display" readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getDueDate123($data->intiation_date, true) }}" />
                                            <!-- Hidden input date format ke sath -->
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getDueDate123($data->intiation_date, true, 'Y-m-d') }}" class="hide-input" readonly />
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }
                                    
                                    // Call this function initially to ensure the correct format is shown on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        handleDateInput(dateInput, 'due_date_display');
                                    });
                                    </script>
                                    
                                    <style>
                                    .hide-input {
                                        display: none;
                                    }
                                    </style>
                                    
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Department Group </label>
                                                <select name="initiator_Group" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                     <option value="0">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->initiator_Group== 'CQA') selected @endif>Corporate
                                                        Quality Assurance</option>
                                                    <option value="QAB"
                                                        @if ($data->initiator_Group== 'QAB') selected @endif>Quality
                                                        Assurance Biopharma</option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_Group== 'CQC') selected @endif>Central
                                                        Quality Control</option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_Group== 'CQC') selected @endif>Manufacturing
                                                    </option>
                                                    <option value="PSG"
                                                        @if ($data->initiator_Group== 'PSG') selected @endif>Plasma
                                                        Sourcing Group</option>
                                                    <option value="CS"
                                                        @if ($data->initiator_Group== 'CS') selected @endif>Central
                                                        Stores</option>
                                                    <option value="ITG"
                                                        @if ($data->initiator_Group== 'ITG') selected @endif>Information
                                                        Technology Group</option>
                                                    <option value="MM"
                                                        @if ($data->initiator_Group== 'MM') selected @endif>Molecular
                                                        Medicine</option>
                                                    <option value="CL"
                                                        @if ($data->initiator_Group== 'CL') selected @endif>Central
                                                        Laboratory</option>
                                                    <option value="TT"
                                                        @if ($data->initiator_Group== 'TT') selected @endif>Tech
                                                        Team</option>
                                                    <option value="QA"
                                                        @if ($data->initiator_Group== 'QA') selected @endif>Quality
                                                        Assurance</option>
                                                    <option value="QM"
                                                        @if ($data->initiator_Group== 'QM') selected @endif>Quality
                                                        Management</option>
                                                    <option value="IA"
                                                        @if ($data->initiator_Group== 'IA') selected @endif>IT
                                                        Administration</option>
                                                    <option value="ACC"
                                                        @if ($data->initiator_Group== 'ACC') selected @endif>Accounting
                                                    </option>
                                                    <option value="LOG"
                                                        @if ($data->initiator_Group== 'LOG') selected @endif>Logistics
                                                    </option>
                                                    <option value="SM"
                                                        @if ($data->initiator_Group== 'SM') selected @endif>Senior
                                                        Management</option>
                                                    <option value="BA"
                                                        @if ($data->initiator_Group== 'BA') selected @endif>Business
                                                        Administration</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Department Group Code</label>
                                                <input readonly type="text" name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    value="{{ $data->initiator_Group}}" id="initiator_group_code"
                                                    readonly>
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                                <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining

                                                <input name="short_description"   id="docname" type="text" value="{{ $data->short_description }}"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} type="text">
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div>


                                       
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select name="initiated_through"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->initiated_through == 'internal_audit') selected @endif
                                                        value="internal_audit">Internal Audit</option>
                                                        <option @if ($data->initiated_through == 'external_audit') selected @endif
                                                        value="external_audit">External Audit</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">Return</option>
                                                    <option @if ($data->initiated_through == 'deviation') selected @endif
                                                        value="deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'complaint') selected @endif
                                                        value="complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'regulatory') selected @endif
                                                        value="regulatory">Regulatory</option>
                                                    <option @if ($data->initiated_through == 'lab-incident') selected @endif
                                                        value="lab-incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'improvement') selected @endif
                                                        value="improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'process_product') selected @endif
                                                        value="process_product">Process/Product</option>
                                                    <option @if ($data->initiated_through == 'supplier') selected @endif
                                                         value="supplier">Supplier</option>
                                                    <option @if ($data->initiated_through == 'gmp_invastigation') selected @endif
                                                    value="gmp_invastigation">GMP Investigation</option>
                                                    <option @if ($data->initiated_through == 'discreoancy_nc') selected @endif
                                                        value="discreoancy_nc">Discrepancy/NC</option>
                                                    <option @if ($data->initiated_through == 'change_control') selected @endif
                                                         value="change_control">Change Control</option>
                                                    <option @if ($data->initiated_through == 'utility_quipment_system') selected @endif
                                                            value="utility_quipment_system">Utility/Equipment/System</option>
                                                    <option @if ($data->initiated_through == 'oos') selected @endif
                                                             value="oos">OOS</option>
                                                        <option @if ($data->initiated_through == 'product_failure') selected @endif
                                                            value="product_failure">Product Failure</option>
                                                            <option @if ($data->initiated_through == 'apqr') selected @endif
                                                                value="apqr">APQR</option>
                                                    <option @if ($data->initiated_through == 'others') selected @endif
                                                        value="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="initiated_through">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="initiated_through_req"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> {{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
                                                <select name="repeat"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'Yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->repeat == 'Yes') selected @endif
                                                        value="Yes">Yes</option>
                                                    <option @if ($data->repeat == 'No') selected @endif
                                                        value="No">No</option>
                                                    <option @if ($data->repeat == 'NA') selected @endif
                                                        value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="repeat_nature"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Problem Description">Problem Description</label>
                                                <textarea name="problem_description"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->problem_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Team">CAPA Team</label>
                                                <select {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    multiple id="Audit" placeholder="Select..." name="capa_team[]">
                                                    @foreach ($users as $value)
                                                     {{-- <option {{ $data->capa_team == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option>  --}}
                                                        <option value="{{ $value->id }}"{{ in_array($value->id, explode(',', $data->capa_team)) ? 'selected' : '' }}>
                                                                   {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Records">Reference Records</label>
                                                <select {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    multiple id="capa_related_record" name="capa_related_record[]"
                                                    id="">
                                                    @if (!empty($old_record))
                                                    @foreach ($old_record as $new)
                                                    @php
                                                                $recordValue =
                                                                    Helpers::getDivisionName($new->division_id) .
                                                                    '/AI/' .
                                                                    date('Y') .
                                                                    '/' .
                                                                    Helpers::recordFormat($new->record);
                                                                $selected = in_array(
                                                                    $recordValue,
                                                                    explode(',', $data->capa_related_record),
                                                                )
                                                                    ? 'selected'
                                                                    : '';
                                                            @endphp
                                                       <option value="{{ $recordValue }}" {{ $selected }}>
                                                        {{ $recordValue }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                      
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Initial Observation">Initial Observation</label>

                                                <textarea name="initial_observation" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->initial_observation }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Interim Containnment</label>
                                                <select name="interim_containnment"
                                                    onchange="otherController(this.value, 'required', 'containment_comments')"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'required' ? 'selected' : '' }}
                                                        value="required">Required</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'not-required' ? 'selected' : '' }}
                                                        value="not-required">Not Required</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="containment_comments">
                                                <label for="Containment Comments">
                                                    Containment Comments <span class="text-danger d-none">*</span>
                                                </label>
                                                <textarea name="containment_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->containment_comments }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Attachments">CAPA Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="capa_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="capa_attachment">

                                                        {{-- @if (is_array($data->capa_attachment)) --}}
                                                        @if ($data->capa_attachment)
                                                            @foreach (json_decode($data->capa_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        {{-- @endif --}}
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="capa_attachment[]"
                                                            oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA QA Comments">CAPA QA Review</label>
                                                <textarea name="capa_qa_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->capa_qa_comments }}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="col-12 sub-head">
                                            Investigation & Root Cause Analysis Summary 
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Details">Investigation </label>
                                                {{-- <input type="text" name="investigation" value="{{ $data->investigation }}"> --}}
                                                <textarea name="investigation" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->investigation }}</textarea>
                                            </div>
                                            <div class="group-input">
                                                <label for="Details">Root Cause Analysis  </label>
                                                {{-- <input type="text" name="rcadetails" value="{{ $data->rcadetails }}"> --}}
                                                <textarea name="rcadetails" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->rcadetails }}</textarea>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="button-block">
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> Save</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Information content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        {{-- <div class="col-12 sub-head">
                                            Product Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Product Details">
                                                    Product Details<button type="button" name="ann"
                                                    id="product"
                                                        {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="product_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Product Name</th>
                                                            <th>Batch No./Lot No./AR No.</th>
                                                            <th>Manufacturing Date</th>
                                                            <th>Date Of Expiry</th>
                                                            <th>Batch Disposition Decision</th>
                                                            <th>Remark</th>
                                                            <th>Batch Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                        @if ($data1->product_name)
                                                        @foreach (unserialize($data1->product_name) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"
                                                                    value="{{ $key + 1 }}"></td>
                                                            <td><input type="text" name="product_name[]"
                                                                    value="{{ unserialize($data1->product_name)[$key] ? unserialize($data1->product_name)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_no[]"
                                                                    value="{{ unserialize($data1->batch_no)[$key] ? unserialize($data1->batch_no)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="mfg_date[]"
                                                                    value="{{ unserialize($data1->mfg_date)[$key] ? unserialize($data1->mfg_date)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="expiry_date[]"
                                                                    value="{{ unserialize($data1->expiry_date)[$key] ? unserialize($data1->expiry_date)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_desposition[]"
                                                                    value="{{ unserialize($data1->batch_desposition)[$key] ? unserialize($data1->batch_desposition)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="remark[]"
                                                                    value="{{ unserialize($data1->remark)[$key] ? unserialize($data1->remark)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="batch_status[]"
                                                                    value="{{ unserialize($data1->batch_status)[$key] ? unserialize($data1->batch_status)[$key] : '' }}">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> --}}
                                        



                                        {{-- new added product table --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }} name="severity_level_form">
                                                    <option  value="">-- Select --</option>
                                                    <option @if ($data->severity_level_form=='minor') selected @endif value="minor">Minor</option>
                                                    <option @if ($data->severity_level_form=='major') selected @endif value="major">Major</option>
                                                    <option @if ($data->severity_level_form=='critical') selected @endif value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Product Material Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Product Material Details
                                                    <button type="button" name="ann" id="material" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="productmaterial">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Row #</th>
                                                            <th>Product Material Name</th>
                                                            <th>Product Batch No./Lot No./AR No.</th>
                                                            <th>Product Manufacturing Date</th>
                                                            <th>Product Date Of Expiry</th>
                                                            <th>Product Batch Disposition Decision</th>
                                                            <th>Product Remark</th>
                                                            <th>Product Batch Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data2->material_name))
                                                                @foreach (unserialize($data2->material_name) as $key => $material_name)
                                                                    <tr>
                                                                        <td><input disabled type="text" name="serial_number[]" value="{{ $key + 1 }}"></td>
                                                                        <td><input type="text" name="material_name[]" value="{{ $material_name }}"></td>
                                                                        {{-- <td>
                                                                            <select name="material_name[]" class="material_name" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                                                <option value="" >-- Select value --</option>
                                                                                <option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/" {{ $material_name == 'PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/' ? 'selected' : '' }}>PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/</option>
                                                                                <option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION" {{ $material_name == 'BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION' ? 'selected' : '' }}>BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION</option>
                                                                                <option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML" {{ $material_name == 'CAFFEINECITRATEORALSOLUTION USP 60MG/3ML' ? 'selected' : '' }}>CAFFEINECITRATEORALSOLUTION USP 60MG/3ML</option>
                                                                                <option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)" {{ $material_name == 'BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)' ? 'selected' : '' }}>BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>
                                                                                <option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO" {{ $material_name == 'DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO' ? 'selected' : '' }}>DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO</option>
                                                                            </select>
                                                                        </td> --}}
                                                                        <td><input type="text" name="material_batch_no[]" value="{{ unserialize($data2->material_batch_no)[$key] ?? '' }}"></td>
                                                                        {{-- <td>
                                                                            <select name="material_batch_no[]" class="batch_no" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                                                <option value="">select value</option>
                                                                                <option value="DCAU0030" {{ unserialize($data2->material_batch_no)[$key] == 'DCAU0030' ? 'selected' : '' }}>DCAU0030</option>
                                                                                <option value="BDZH0007" {{ unserialize($data2->material_batch_no)[$key] == 'BDZH0007' ? 'selected' : '' }}>BDZH0007</option>
                                                                                <option value="BDZH0006" {{ unserialize($data2->material_batch_no)[$key] == 'BDZH0006' ? 'selected' : '' }}>BDZH0006</option>
                                                                                <option value="BJJH0004A" {{ unserialize($data2->material_batch_no)[$key] == 'BJJH0004A' ? 'selected' : '' }}>BJJH0004A</option>
                                                                                <option value="DCAU0036" {{ unserialize($data2->material_batch_no)[$key] == 'DCAU0036' ? 'selected' : '' }}>DCAU0036</option>
                                                                            </select>
                                                                        </td> --}}
                                                                        <td><input type="month" name="material_mfg_date[]" value="{{ unserialize($data2->material_mfg_date)[$key] ?? '' }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}></td>
                                                                        <td><input type="month" name="material_expiry_date[]" value="{{ unserialize($data2->material_expiry_date)[$key] ?? '' }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}></td>
                                                                        <td><input type="text" name="material_batch_desposition[]" value="{{ unserialize($data2->material_batch_desposition)[$key] ?? '' }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}></td>
                                                                        <td><input type="text" name="material_remark[]" value="{{ unserialize($data2->material_remark)[$key] ?? '' }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}></td>
                                                                        {{-- <td><input type="text" name="material_batch_status[]" value="{{ unserialize($data2->material_batch_status)[$key] ?? '' }}"></td> --}}
                                                                        <td>
                                                                            <select name="material_batch_status[]" class="batch_status" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                                                <option value="">-- Select value --</option>
                                                                                <option value="Hold" {{ unserialize($data2->material_batch_status)[$key] == 'Hold' ? 'selected' : '' }}>Hold</option>
                                                                                <option value="Release" {{ unserialize($data2->material_batch_status)[$key] == 'Release' ? 'selected' : '' }}>Release</option>
                                                                                <option value="quarantine" {{ unserialize($data2->material_batch_status)[$key] == 'quarantine' ? 'selected' : '' }}>Quarantine</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><button type="button" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Remove</button></td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#material').click(function (e) {
                                                    e.preventDefault();
                                                    
                                                    // Clone the first row
                                                    var newRow = $('#productmaterial tbody tr:first').clone();
                                                    
                                                    // Update the serial number
                                                    var lastSerialNumber = parseInt($('#productmaterial tbody tr:last input[name="serial_number[]"]').val());
                                                    newRow.find('input[name="serial_number[]"]').val(lastSerialNumber + 1);
                                                    
                                                    // Clear inputs in the new row
                                                    newRow.find('input[name="material_name[]"]').val('');
                                                    newRow.find('input[name="material_batch_no[]"]').val('');
                                                    newRow.find('input[name="material_mfg_date[]"]').val('');
                                                    newRow.find('input[name="material_expiry_date[]"]').val('');
                                                    newRow.find('input[name="material_batch_desposition[]"]').val('');
                                                    newRow.find('input[name="material_remark[]"]').val('');
                                                    newRow.find('input[name="material_batch_status[]"]').val('');
                                                    
                                                    // Clear selected options in the new row
                                                    newRow.find('select').prop('selectedIndex', 0);
                                                    
                                                    // Append the new row to the table body
                                                    $('#productmaterial tbody').append(newRow);
                                                });
                                                
                                                // Remove row functionality
                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();
                                                    
                                                    // Update serial numbers after removing a row
                                                    $('#productmaterial tbody tr').each(function(index) {
                                                        $(this).find('input[name="serial_number[]"]').val(index + 1);
                                                    });
                                                });
                                            });
                                        </script>
                                        
                                        
                                        {{-- new added product table --}}

                                    
                                        {{-- <script>
                                            $(document).ready(function() {
                                                $('#add-row-btn').click(function() {
                                                    addRow('root-cause-first-table');
                                                });
                                    
                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();
                                                    updateSerialNumbers();
                                                });
                                    
                                                updateSerialNumbers();
                                            });
                                    
                                            function addRow(tableId) {
                                                var table = document.getElementById(tableId);
                                                var tbody = table.getElementsByTagName('tbody')[0];
                                                var currentRowCount = tbody.rows.length;
                                    
                                                var newRow = tbody.insertRow(currentRowCount);
                                    
                                                var cell1 = newRow.insertCell(0);
                                                cell1.innerHTML = '<input disabled type="text" name="serial_number[]" value="' + (currentRowCount + 1) + '">';
                                    
                                                var cell2 = newRow.insertCell(1);
                                                cell2.innerHTML = '<input type="text" name="material_name[]">';
                                    
                                                var cell3 = newRow.insertCell(2);
                                                cell3.innerHTML = '<input type="text" name="material_batch_no[]">';
                                    
                                                var cell4 = newRow.insertCell(3);
                                                cell4.innerHTML = '<input type="text" name="material_mfg_date[]">';
                                    
                                                var cell5 = newRow.insertCell(4);
                                                cell5.innerHTML = '<input type="text" name="material_expiry_date[]">';
                                    
                                                var cell6 = newRow.insertCell(5);
                                                cell6.innerHTML = '<input type="text" name="material_batch_desposition[]">';
                                    
                                                var cell7 = newRow.insertCell(6);
                                                cell7.innerHTML = '<input type="text" name="material_remark[]">';
                                    
                                                var cell8 = newRow.insertCell(7);
                                                cell8.innerHTML = '<input type="text" name="material_batch_status[]">';
                                    
                                                var cell9 = newRow.insertCell(8);
                                                cell9.innerHTML = '<button type="button" class="removeRowBtn">Remove</button>';
                                    
                                                updateSerialNumbers();
                                            }
                                    
                                            function updateSerialNumbers() {
                                                var table = document.getElementById('root-cause-first-table').getElementsByTagName('tbody')[0];
                                                for (var i = 0; i < table.rows.length; i++) {
                                                    table.rows[i].cells[0].getElementsByTagName('input')[0].value = i + 1;
                                                }
                                            }
                                        </script> --}}
                                        
                                        
                                        
                                        
                                        
                                        <div class="col-12 sub-head">
                                            Equipment/Instruments Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Equipment/Instruments Details<button type="button" name="ann"
                                                    id="equipment_add"
                                                        {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="equi_details">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Row #</th>
                                                            <th>Equipment/Instruments Name</th>
                                                            <th>Equipment/Instruments ID</th>
                                                            <th>Equipment/Instruments Comments</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data3 && $data3->equipment)
                                                        @foreach (unserialize($data3->equipment) as $key => $temps)
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                                           value="{{ $key + 1 }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment[]" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                                           value="{{ unserialize($data3->equipment)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_instruments[]" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                                           value="{{ unserialize($data3->equipment_instruments)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_comments[]" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                                           value="{{ unserialize($data3->equipment_comments)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#equipment_add').click(function (e) {
                                                    e.preventDefault();
                                                    
                                                    // Clone the first row
                                                    var newRow = $('#equi_details tbody tr:first').clone();
                                                    
                                                    // Update the serial number
                                                    var lastSerialNumber = parseInt($('#equi_details tbody tr:last input[name="serial_number[]"]').val());
                                                    newRow.find('input[name="serial_number[]"]').val(lastSerialNumber + 1);
                                                    
                                                    // Clear inputs in the new row
                                                    newRow.find('input[name="equipment[]"]').val('');
                                                    newRow.find('input[name="equipment_instruments[]"]').val('');
                                                    newRow.find('input[name="equipment_comments[]"]').val('');
                                                    
                                                    // Append the new row to the table body
                                                    $('#equi_details tbody').append(newRow);
                                                });
                                                
                                                // Remove row functionality
                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();
                                                    
                                                    // Update serial numbers after removing a row
                                                    $('#equi_details tbody tr').each(function(index) {
                                                        $(this).find('input[name="serial_number[]"]').val(index + 1);
                                                    });
                                                });
                                            });
                                        </script>
                                        

                                        <div class="col-12 sub-head">
                                            Other type CAPA Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Details">Details</label>
                                                {{-- <input type="text" name="details_new"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    value="{{ $data->details_new }}"> --}}
                                                    <textarea name="details_new" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->details_new }}</textarea>

                                            </div>
                                        </div>
                                      
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments"> CAPA QA Review </label>
                                                <textarea name="capa_qa_comments2" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->capa_qa_comments2 }}</textarea>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Capa Detais-->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="search">
                                            CAPA Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="capa_type"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                            <option value="">Select a value</option>
                                            <option {{ $data->capa_type == "Corrective Action" ? 'selected' : '' }} value="Corrective Action">Corrective Action</option>
                                            <option {{ $data->capa_type == "Preventive Action" ? 'selected' : '' }} value="Preventive Action">Preventive Action</option>
                                            <option {{ $data->capa_type == "Corrective & Preventive Action"  ? 'selected' : '' }} value="Corrective & Preventive Action">Corrective & Preventive Action</option>

                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Corrective Action">Corrective Action</label>
                                                <textarea name="corrective_action" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->corrective_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Preventive Action">Preventive Action</label>
                                                <textarea name="preventive_action" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->preventive_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">File Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="capafileattachement">
                                                        @if ($data->capafileattachement)
                                                        @foreach (json_decode($data->capafileattachement) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    {{-- @endif --}}
                                                    @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="qafile" name="capafileattachement[]"
                                                            oninput="addMultipleFiles(this, 'capafileattachement')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                       



                            <!-- Project Study content -->
                          
                              




{{-- ===========================================HOd reviwe tab ============= tab --}}

<div id="CCForm11" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Review & Closure">HOD Remark</label>
                    <textarea name="hod_remarks" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->hod_remarks}}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">HOD Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small>
                        </div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="hod_attachment">
                            @if ($data->hod_attachment)
                            @foreach (json_decode($data->hod_attachment) as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><i class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file"
                                        data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark"
                                            style="color:red; font-size:20px;"></i></a>
                                </h6>
                            @endforeach
                        {{-- @endif --}}
                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="hod_attachment[]"
                                oninput="addMultipleFiles(this, 'hod_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 sub-head">
                Effectiveness Check Details
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Effectiveness Check Required">Effectiveness Check
                        Required?</label>
                    <select name="effect_check" onChange="setCurrentDate(this.value)">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                    {{-- <input type="date" name="effect_check_date"> --}}
                    <div class="calenderauditee">
                        <input type="text" name="effect_check_date" id="effect_check_date" readonly
                            placeholder="DD-MMM-YYYY" />
                        <input type="date" name="effect_check_date" class="hide-input"
                            oninput="handleDateInput(this, 'effect_check_date')" />
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="group-input">
                    <label for="Effectiveness_checker">Effectiveness Checker</label>
                    <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                        <option value="">Select a person</option>
                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="effective_check_plan">Effectiveness Check Plan</label>
                    <textarea name="effective_check_plan"></textarea>
                </div>
            </div> -->
           
          
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
           <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>



{{-- ==========================QA review tab ================ --}}

<div id="CCForm12" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> CAPA QA Review </label>
                    <textarea name="capa_qa_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->capa_qa_comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachment">

                            @if ($data->qa_attachment)
                            @foreach (json_decode($data->qa_attachment) as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><i class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file"
                                        data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark"
                                            style="color:red; font-size:20px;"></i></a>
                                </h6>
                            @endforeach
                        {{-- @endif --}}
                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="qa_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 sub-head">
                Effectiveness Check Details
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Effectiveness Check Required">Effectiveness Check
                        Required?</label>
                    <select name="effect_check" onChange="setCurrentDate(this.value)">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                    {{-- <input type="date" name="effect_check_date"> --}}
                    <div class="calenderauditee">
                        <input type="text" name="effect_check_date" id="effect_check_date" readonly
                            placeholder="DD-MMM-YYYY" />
                        <input type="date" name="effect_check_date" class="hide-input"
                            oninput="handleDateInput(this, 'effect_check_date')" />
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="group-input">
                    <label for="Effectiveness_checker">Effectiveness Checker</label>
                    <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                        <option value="">Select a person</option>
                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="effective_check_plan">Effectiveness Check Plan</label>
                    <textarea name="effective_check_plan"></textarea>
                </div>
            </div> -->
           
          
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
             <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>

                            <!-- CAPA Closure content -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="QA Review & Closure">QA Head Review & Closure</label>
                                                <textarea name="qa_review" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->qa_review }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">Closure Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="closure_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="closure_attachment1">
                                                        @if ($data->closure_attachment)
                                                            @foreach (json_decode($data->closure_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="closure_attachment[]"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'closure_attachment1')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- <div class="col-12 sub-head">
                                    Effectiveness Check Details -->
                                </div>
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Effectiveness Check required">Effectiveness Check
                                                    required</label>
                                                <select name="effect_check"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->effect_check == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->effect_check == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect.Check Creation Date">Effect.Check Creation
                                                    Date</label>
                                                <input type="date" name="effect_check_date"
                                                    value="{{ $data->effect_check_date }}">
                                                    <div class="calenderauditee">
                                                        <input type="text"  value="{{ $data->effect_check_date }}" id="effect_check_date"  readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="effect_check_date" value=""
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'effect_check_date')"/>
                                                    </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect Check Creation Date">Effectiveness Check Creation Date</label>
                                                {{-- <input type="date" name="effect_check_date"> --}}
                                                <div class="calenderauditee">
                                                    <input type="text"  id="effect_check_date" readonly
                                                        placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->effect_check_date) }}"/>
                                                    <input type="date" name="effect_check_date" value=""class="hide-input"
                                                        oninput="handleDateInput(this,'effect_check_date')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                <select name="Effectiveness_checker">{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                    <option value="">Enter Your Selection Here</option>
                                                    @foreach ($users as $value)
                                                        <option
                                                            {{ $data->Effectiveness_checker == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                <textarea name="effective_check_plan"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> {{ $data->effective_check_plan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div> -->
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                            {{-- ==========================HOD Final Review
 tab ================ --}}

<div id="CCForm13" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> HOD Final Review Comment</label>
                    <textarea name="hod_final_review" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->hod_final_review }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">HOD Final Review Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachment">

                            @if ($data->hod_final_attachment)
                            @foreach (json_decode($data->hod_final_attachment) as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><i class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file"
                                        data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark"
                                            style="color:red; font-size:20px;"></i></a>
                                </h6>
                            @endforeach
                        {{-- @endif --}}
                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="hod_final_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 sub-head">
                Effectiveness Check Details
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Effectiveness Check Required">Effectiveness Check
                        Required?</label>
                    <select name="effect_check" onChange="setCurrentDate(this.value)">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                    {{-- <input type="date" name="effect_check_date"> --}}
                    <div class="calenderauditee">
                        <input type="text" name="effect_check_date" id="effect_check_date" readonly
                            placeholder="DD-MMM-YYYY" />
                        <input type="date" name="effect_check_date" class="hide-input"
                            oninput="handleDateInput(this, 'effect_check_date')" />
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="group-input">
                    <label for="Effectiveness_checker">Effectiveness Checker</label>
                    <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                        <option value="">Select a person</option>
                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="effective_check_plan">Effectiveness Check Plan</label>
                    <textarea name="effective_check_plan"></textarea>
                </div>
            </div> -->
           
          
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
             <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
{{-- ==========================QA QA/CQA Closure Review
 tab ================ --}}

<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> QA/CQA Closure Review Comment</label>
                    <textarea name="qa_cqa_qa_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->qa_cqa_qa_comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA/CQA Closure Review Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachmentb">

                            @if ($data->qa_closure_attachment)
                            @foreach (json_decode($data->qa_closure_attachment) as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><i class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file"
                                        data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark"
                                            style="color:red; font-size:20px;"></i></a>
                                </h6>
                            @endforeach
                        {{-- @endif --}}
                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfileb" name="qa_closure_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachmentb')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 sub-head">
                Effectiveness Check Details
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Effectiveness Check Required">Effectiveness Check
                        Required?</label>
                    <select name="effect_check" onChange="setCurrentDate(this.value)">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                    {{-- <input type="date" name="effect_check_date"> --}}
                    <div class="calenderauditee">
                        <input type="text" name="effect_check_date" id="effect_check_date" readonly
                            placeholder="DD-MMM-YYYY" />
                        <input type="date" name="effect_check_date" class="hide-input"
                            oninput="handleDateInput(this, 'effect_check_date')" />
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="group-input">
                    <label for="Effectiveness_checker">Effectiveness Checker</label>
                    <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                        <option value="">Select a person</option>
                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="effective_check_plan">Effectiveness Check Plan</label>
                    <textarea name="effective_check_plan"></textarea>
                </div>
            </div> -->
           
          
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
             <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
{{-- ==========================QAH/CQAH Approval tab ================ --}}

<div id="CCForm15" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> QAH/CQAH Approval Comment </label>
                    <textarea name="qah_cq_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->qah_cq_comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QAH/CQAH Approval Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachmentc">

                            @if ($data->qah_cq_attachment)
                            @foreach (json_decode($data->qah_cq_attachment) as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><i class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file"
                                        data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark"
                                            style="color:red; font-size:20px;"></i></a>
                                </h6>
                            @endforeach
                        {{-- @endif --}}
                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfilec" name="qah_cq_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachmentc')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 sub-head">
                Effectiveness Check Details
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Effectiveness Check Required">Effectiveness Check
                        Required?</label>
                    <select name="effect_check" onChange="setCurrentDate(this.value)">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                    {{-- <input type="date" name="effect_check_date"> --}}
                    <div class="calenderauditee">
                        <input type="text" name="effect_check_date" id="effect_check_date" readonly
                            placeholder="DD-MMM-YYYY" />
                        <input type="date" name="effect_check_date" class="hide-input"
                            oninput="handleDateInput(this, 'effect_check_date')" />
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="group-input">
                    <label for="Effectiveness_checker">Effectiveness Checker</label>
                    <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                        <option value="">Select a person</option>
                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="effective_check_plan">Effectiveness Check Plan</label>
                    <textarea name="effective_check_plan"></textarea>
                </div>
            </div> -->
           
          
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
             <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>



                          


                            <!-- Activity Log content -->
                            <div id="CCForm6" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Proposed By">Propose Plan By</label>
                                                <input type="hidden" name="plan_proposed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Propose Plan  On">Propose Plan On</label>
                                                <input type="hidden" name="plan_proposed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                <input type="hidden" name="cancelled_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                <input type="hidden" name="cancelled_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="cancel_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancel_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">HOD Review Completed By</label>
                                                <input type="hidden" name="hod_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_by }}</div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved On">HOD Review Completed On</label>
                                                <input type="hidden" name="hod_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="hod_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_comment }}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required By"> More Info Required
                                                    By</label>
                                                <input type="hidden" name="more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_required_by }}</div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">More Info Required
                                                    On</label>
                                                <input type="hidden" name="more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_required_on }}</div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="hod_comment1"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_comment1 }}</div>
                                            </div>
                                        </div> --}}
                                        
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Completed By"> QA/CQA Review Completed By</label>
                                                <input type="hidden" name="qa_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Completed On"> QA/CQA Review Completed On</label>
                                                <input type="hidden" name="qa_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="qa_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_comment }}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required By"> More Info Required
                                                    By</label>
                                                <input type="hidden" name="qa_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required On"> More Info Required
                                                    On</label>
                                                <input type="hidden" name="qa_more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_on }}</div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="qa_commenta"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_commenta }}</div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved By">Approved By</label>
                                                <input type="hidden" name="approved_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>

                                                <div class="static">{{ $data->approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved On">Approved On</label>
                                                <input type="hidden" name="approved_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="approved_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_comment }}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required By"> More Info Required
                                                    By</label>
                                                <input type="hidden" name="app_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->app_more_info_required_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">More Info Required
                                                    On</label>
                                                <input type="hidden" name="app_more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->app_more_info_required_on }}</div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="app_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->app_comment }}</div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected By">Completed By</label>
                                                <input type="hidden" name="completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected On">Completed On</label>
                                                <input type="hidden" name="completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="com_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->com_comment }}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required By"> More Info Required
                                                    By</label>
                                                <input type="hidden" name="com_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->com_more_info_required_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">More Info Required
                                                    On</label>
                                                <input type="hidden" name="com_more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->com_more_info_required_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="com_comment1"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->com_comment1 }}</div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected By">HOD Final Review Completed By</label>
                                                <input type="hidden" name="hod_final_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_final_review_completed_by }}</div>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Rejected By">HOD Final Review Completed On</label>
                                            <input type="hidden" name="hod_final_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                            <div class="static">{{ $data->hod_final_review_completed_on }}</div>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved By">Comment</label>
                                        <input type="hidden" name="final_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->final_comment }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="QA More Info Required By"> More Info Required By</label>
                                        <input type="hidden" name="hod_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->hod_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="QA More Info Required On">More Info Required On</label>
                                        <input type="hidden" name="hod_more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->hod_more_info_required_on }}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved By">Comment</label>
                                        <input type="hidden" name="final_hod_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->hod_comment }}</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Rejected By">QA/CQA Closure Review Completed By</label>
                                        <input type="hidden" name="qa_closure_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->qa_closure_review_completed_by }}</div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">QA/CQA Closure Review Completed On</label>
                                    <input type="hidden" name="qa_closure_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qa_closure_review_completed_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Approved By">Comment</label>
                                    <input type="hidden" name="qa_closure_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qa_closure_comment }}</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="closure_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->closure_more_info_required_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On">More Info Required On</label>
                                    <input type="hidden" name="closure_qa_more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->closure_qa_more_info_required_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Approved By">Comment</label>
                                    <input type="hidden" name="closure_qa_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->closure_qa_comment }}</div>
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">QA/CQA Approval  Completed By</label>
                                    <input type="hidden" name="qah_approval_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qah_approval_completed_by }}</div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected By">QA/CQA Approval  Completed On</label>
                                <input type="hidden" name="qah_approval_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_approval_completed_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Plan Approved By">Comment</label>
                                <input type="hidden" name="qah_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_comment }}</div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="group-input">
                                <label for="QA More Info Required By"> More Info Required By</label>
                                <input type="hidden" name="qah_more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_more_info_required_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="QA More Info Required On">More Info Required On</label>
                                <input type="hidden" name="qah_more_info_required_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_more_info_required_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Plan Approved By">Comment</label>
                                <input type="hidden" name="qah_comment1"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_comment1 }}</div>
                            </div>
                        </div> --}}

                                    <div class="button-block">
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button"> <a class="text-white"href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    </form>

                </div>

            </div>

            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_child_changecontrol', $data->id) }}" method="POST">
                            @csrf
                           
                            <div class="modal-body">
                                <div class="group-input">
                                    
                                    <label for="major">
                                       <input type="radio" name="child_type" value="extension">
                                          Extension
                                    </label>
                            

                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_child_changecontrol', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            {{-- <div class="modal-body">
                                <div class="group-input">
                                    @if ($data->stage == 3)
                                        <label for="major">

                                        </label>
                                         {{-- <label for="major">
                                            <input type="radio" name="child_type" value="Change_control">
                                            Change Control
                                        </label> --}}
                                        {{-- <label for="major">
                                            <input type="radio" name="child_type" value="Action_Item">
                                            Action-Item
                                        </label>
                                        --}}
                                        {{-- <label for="major">
                                            <input type="radio" name="child_type" value="extension">
                                            Extension
                                        </label>
                                        <label for="major">
                                            <input type="radio" name="child_type" value="rca">
                                           RCA
                                        </label> 
                                    @endif
                                    @if ($data->stage == 4)
                                        <label for="major">
                                           <input type="radio" name="child_type" value="Action-item">
                                              Action-Item
                                        </label>
                                    @endif
                                    @if ($data->stage == 5)
                                    <label for="major">
                                       <input type="radio" name="child_type" value="Action-item">
                                          Action-Item
                                    </label>
                                @endif

                                    @if ($data->stage == 7)
                                        <label for="major">
                                            <input type="radio" name="child_type" value="effectiveness_check">
                                            Action-Item
                                        </label>
                                    @endif
                                </div>

                            </div>--}} 
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Action_Item">
                                        <input type="hidden" name="CAPA" value="{{Helpers::getDivisionName(session()->get('division'))}}/CAPA/{{ date('Y') }}/{{ $data->record}}">
                                        Action-Item
                                    </label>
                                </div>
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                      </label>
                                </div>

                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="child-modal1l">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_effectiveness_check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="effectiveness_check" id="major"
                                            value="Effectiveness_check">
                                        Effectiveness Check
                                    </label>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('capa_reject', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required >
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancel-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('capaCancel', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('capa_send_stage', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username<span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('capa_qa_more_info', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username<span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment<span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
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
                    ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record'
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
                    document.getElementById('initiator_group').addEventListener('change', function() {
                        var selectedValue = this.value;
                        document.getElementById('initiator_group_code').value = selectedValue;
                    });
                </script>
                 <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const removeButtons = document.querySelectorAll('.remove-file');

                        removeButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const fileName = this.getAttribute('data-file-name');
                                const fileContainer = this.closest('.file-container');

                                // Hide the file container
                                if (fileContainer) {
                                    fileContainer.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
                <script>
                    var maxLength = 255;
                    $('#docname').keyup(function() {
                        var textlen = maxLength - $(this).val().length;
                        $('#rchars').text(textlen);});
                </script>

        @endsection
