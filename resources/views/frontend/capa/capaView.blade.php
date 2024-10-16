@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
         integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     @if (Session::has('swal'))
         <script>
             swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                 "{{ Session::get('swal')['type'] }}")
         </script>
     @endif
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

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
                            @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                            <a href="#child-modal1"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button></a>
                            @endif
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
                            @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                            <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>
                            @endif
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
                           @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                         <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                             data-bs-target="#child-modal1l">
                             Child
                         </button></a>
                         @endif
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
                                <div class="active">QA/CQA Approval</div>
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
                            <div class="active">QAH/CQA Approval </div>
                               @else
                            <div class="">QAH/CQA Approval </div>
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
                        <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button> -->
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm11')">HOD Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QA/CQA Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm15')">QA/CQA Approval</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm18')">Initiator CAPA update </button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Additional Information</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Group Comments</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm13')">HOD Final Review</button>
                         <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA/CQA Closure Review</button>
                         <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CAPA Closure</button>
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
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ $data->record}}">


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
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}">
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
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">
                                                {{-- @php
                                                    $formattedDate = \Carbon\Carbon::parse($data->intiation_date)->format('j-F-Y');
                                                @endphp
                                                <input disabled type="text" value="{{ $formattedDate }}" name="intiation_date_display">
                                                <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date"> --}}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : ''}} >
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
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Due Date</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                            reason in "Due Date Extension Justification" data field.</small></div>
                                         <div class="calenderauditee">
                                            <input type="text"  id="due_dateq"  readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}/>
                                            <input type="date" id="due_dateq" name="due_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage !=1 ? 'readonly' : '' }} value="{{ $data->due_date }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')"/>
                                        </div>
                                    </div>
                                </div>



                                <script>
                                    function handleDateInput(input, targetId) {
                                                    var dateInput = document.getElementById(targetId);
                                                    var originalValue = dateInput.getAttribute('data-original-value');

                                                    if (input.value !== originalValue) {
                                                        dateInput.value = input.value; // Update only if different from the original value
                                                    } else {
                                                        input.value = dateInput.value; // Preserve the existing value if no change
                                                    }
                                                }
                                </script>

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
                                                <label for="Initiator Group"> 	Initiator Department @if($data->stage == 1)<span class="text-danger">*</span>@endif  </label>
                                                <select name="initiator_Group" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                     <option value="">Select Department</option>
                                                                    <option value="CQA"  @if ($data->initiator_Group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                                <option value="QA" @if ($data->initiator_Group == 'QA') selected @endif >Quality Assurance</option>
                                                                <option value="QC"  @if ($data->initiator_Group == 'QC') selected @endif>Quality Control</option>
                                                                <option value="QM"  @if ($data->initiator_Group == 'QM') selected @endif>Quality Control (Microbiology department)</option>
                                                                <option value="PG"  @if ($data->initiator_Group == 'PG') selected @endif>Production General</option>
                                                                <option value="PL"  @if ($data->initiator_Group == 'PL') selected @endif>Production Liquid Orals</option>
                                                                <option value="PT"  @if ($data->initiator_Group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                                <option value="PE"  @if ($data->initiator_Group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                                    Liquid)</option>
                                                                <option value="PC"  @if ($data->initiator_Group == 'PC') selected @endif>Production Capsules</option>
                                                                <option value="PI"  @if ($data->initiator_Group == 'PI') selected @endif>Production Injectable</option>
                                                                <option value="EN"  @if ($data->initiator_Group == 'EN') selected @endif>Engineering</option>
                                                                <option value="HR"  @if ($data->initiator_Group == 'HR') selected @endif>Human Resource</option>
                                                                <option value="ST"  @if ($data->initiator_Group == 'ST') selected @endif>Store</option>
                                                                <option value="IT"  @if ($data->initiator_Group == 'IT') selected @endif>Electronic Data Processing</option>
                                                                <option value="FD"  @if ($data->initiator_Group == 'FD') selected @endif>Formulation Development</option>
                                                                <option value="AL"  @if ($data->initiator_Group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                                </option>
                                                                <option value="PD"  @if ($data->initiator_Group == 'PD') selected @endif>Packaging Development</option>
                                                                <option value="PU"  @if ($data->initiator_Group == 'PU') selected @endif>Purchase Department</option>
                                                                <option value="DC" @if ($data->initiator_Group == 'DC') selected @endif >Document Cell</option>
                                                                <option value="RA"  @if ($data->initiator_Group == 'RA') selected @endif>Regulatory Affairs</option>
                                                                <option value="PV"  @if ($data->initiator_Group == 'PV') selected @endif>Pharmacovigilance</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code"> Initiator Department  Code</label>
                                                <input readonly type="text" name="initiator_group_code"{{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
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

                                                <input name="short_description"   id="docname" type="text" value="{{ $data->short_description }}"    maxlength="255" required  {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? "readonly" : "" }} type="text">
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div>



                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select name="initiated_through"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
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
                                                <textarea name="initiated_through_req"{{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}> {{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
                                                <select name="repeat"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
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
                                                <textarea name="repeat_nature"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Problem Description">Problem Description</label>
                                                <textarea name="problem_description"{{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->problem_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Team">CAPA Team</label>
                                                <select {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
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
                                        {{-- <div class="col-lg-12">
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
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Parent Record Number</b></label>
                                                @if($data->parent_record_number)
                                                <input readonly type="text" name="parent_record_number"
                                                    value="{{ $data->parent_record_number }}">
                                                @else
                                                <input type="text" name="parent_record_number_edit"
                                                value="{{ $data->parent_record_number_edit }}">
                                                @endif
                                            </div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="related_records">Reference Records</label>

                                                <select multiple name="capa_related_record[]" placeholder="Select Reference Records"
                                                    data-silent-initial-value-set="true" id="capa_related_record"  {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9  ? 'disabled' : '' }}>

                                                     @if (!empty($relatedRecords))
                                                            @foreach ($relatedRecords as $records)
                                                                @php
                                                                    $recordValue =
                                                                        Helpers::getDivisionName(
                                                                            $records->division_id ||
                                                                                $records->division ||
                                                                                $records->division_code ||
                                                                                $records->site_location_code,
                                                                        ) .
                                                                        '/' .
                                                                        $records->process_name .
                                                                        '/' .
                                                                        date('Y') .
                                                                        '/' .
                                                                        Helpers::recordFormat($records->record);

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
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Initial Observation">Initial Observation</label>

                                                <textarea name="initial_observation" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->initial_observation }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Interim Containment</label>
                                                <select name="interim_containnment"
                                                    onchange="otherController(this.value, 'required', 'containment_comments')"
                                                    {{ $data->stage == 0|| $data->stage == 2 ||$data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}>
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
                                                <textarea name="containment_comments" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->containment_comments }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Attachments">CAPA Attachments</label>
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
                                                            {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
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
                                        Other Type Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Details">Investigation Summary</label>
                                                {{-- <input type="text" name="investigation" value="{{ $data->investigation }}"> --}}
                                                <textarea name="investigation" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->investigation }}</textarea>
                                            </div>
                                            <div class="group-input">
                                                <label for="Details">Root Cause</label>
                                                {{-- <input type="text" name="rcadetails" value="{{ $data->rcadetails }}"> --}}
                                                <textarea name="rcadetails" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9? 'readonly' : '' }}>{{ $data->rcadetails }}</textarea>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Product / Material Details
                                                    <button type="button" name="ann" id="material">+</button>
                                                </label>
                                                <table class="table table-bordered" id="productmaterial">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Row #</th>
                                                            <th>Product / Material Name</th>
                                                            <th>Product /Material Batch No./Lot No./AR No.</th>
                                                            <th>Product / Material Manufacturing Date</th>
                                                            <th>Product / Material Date of Expiry</th>
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
                                                                    <td><input disabled type="text"
                                                                            name="serial_number[]"
                                                                            value="{{ $key + 1 }}"></td>
                                                                    <td><input type="text" name="material_name[]"
                                                                            value="{{ $material_name }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_batch_no[]"
                                                                            value="{{ unserialize($data2->material_batch_no)[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_mfg_date[]"
                                                                            class="material_mfg_date"
                                                                            placeholder="DD-MMM-YYYY"
                                                                            value="{{ unserialize($data2->material_mfg_date)[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="material_expiry_date[]"
                                                                            class="material_expiry_date"
                                                                            placeholder="DD-MMM-YYYY"
                                                                            value="{{ unserialize($data2->material_expiry_date)[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="material_batch_desposition[]"
                                                                            value="{{ unserialize($data2->material_batch_desposition)[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_remark[]"
                                                                            value="{{ unserialize($data2->material_remark)[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <select name="material_batch_status[]"
                                                                            class="batch_status"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select value --
                                                                            </option>
                                                                            <option value="Hold"
                                                                                {{ unserialize($data2->material_batch_status)[$key] == 'Hold' ? 'selected' : '' }}>
                                                                                Hold</option>
                                                                            <option value="Release"
                                                                                {{ unserialize($data2->material_batch_status)[$key] == 'Release' ? 'selected' : '' }}>
                                                                                Release</option>
                                                                            <option value="quarantine"
                                                                                {{ unserialize($data2->material_batch_status)[$key] == 'quarantine' ? 'selected' : '' }}>
                                                                                Quarantine</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><button type="button" class="removeRowBtn"
                                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Remove</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <script>
                                            $(document).ready(function() {

                                                // Function to create a new row dynamically
                                                function createNewRow(serialNumber) {
                                                    return $('<tr>' +
                                                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><input type="text" name="material_name[]"></td>' +
                                                        '<td><input type="text" name="material_batch_no[]"></td>' +
                                                        '<td><input type="text" name="material_mfg_date[]" class="material_mfg_date" placeholder="DD-MMM-YYYY" /></td>' +
                                                        '<td><input type="text" name="material_expiry_date[]" class="material_expiry_date" placeholder="DD-MMM-YYYY" /></td>' +
                                                        '<td><input type="text" name="material_batch_desposition[]"></td>' +
                                                        '<td><input type="text" name="material_remark[]"></td>' +
                                                        '<td>' +
                                                        '<select name="material_batch_status[]" class="batch_status">' +
                                                        '<option value="">-- Select value --</option>' +
                                                        '<option value="Hold">Hold</option>' +
                                                        '<option value="Release">Release</option>' +
                                                        '<option value="Quarantine">Quarantine</option>' +
                                                        '</select>' +
                                                        '</td>' +
                                                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                        '</tr>');
                                                }

                                                // Function to initialize the jQuery datepicker on input fields
                                                function initializeDatepicker() {
                                                    $('.material_mfg_date, .material_expiry_date').datepicker({
                                                        dateFormat: 'dd-M-yy', // Desired format like '10 Oct 2024'
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        showButtonPanel: true,
                                                        onClose: function(dateText, inst) {
                                                            if (dateText) {
                                                                $(this).val($.datepicker.formatDate('dd-M-yy', new Date(dateText)));
                                                            } else {
                                                                $(this).attr('placeholder',
                                                                'DD-MMM-YYYY'); // Reset the placeholder if the date is cleared
                                                            }
                                                        }
                                                    });
                                                }

                                                // Add a new row when the + button is clicked
                                                $('#material').click(function(e) {
                                                    e.preventDefault();

                                                    // Count existing rows
                                                    var rowCount = $('#productmaterial tbody tr').length;
                                                    var newRow = createNewRow(rowCount + 1); // Create a new row with the next serial number

                                                    // Append the new row to the table
                                                    $('#productmaterial tbody').append(newRow);

                                                    // Reinitialize the datepicker for new date fields
                                                    initializeDatepicker();
                                                });

                                                // Remove a row when the Remove button is clicked
                                                $(document).on('click', '.removeRowBtn', function() {
                                                    $(this).closest('tr').remove();

                                                    // Update the serial numbers for remaining rows
                                                    $('#productmaterial tbody tr').each(function(index) {
                                                        $(this).find('input[name="serial_number[]"]').val(index + 1);
                                                    });
                                                });

                                                // Date validation to ensure Expiry Date is not earlier than Manufacturing Date
                                                $(document).on('change', '.material_mfg_date, .material_expiry_date', function() {
                                                    var row = $(this).closest('tr');
                                                    var mfgDateVal = row.find('.material_mfg_date').val();
                                                    var expiryDateVal = row.find('.material_expiry_date').val();

                                                    if (mfgDateVal && expiryDateVal) {
                                                        var mfgDate = new Date(mfgDateVal);
                                                        var expiryDate = new Date(expiryDateVal);

                                                        // Validate if the expiry date is before the manufacturing date
                                                        if (expiryDate <= mfgDate) {
                                                            alert('Expiry date must be greater than the manufacturing date.');

                                                            // Clear invalid expiry date and reset placeholder
                                                            row.find('.material_expiry_date').val('').attr('placeholder', 'DD-MMM-YYYY');
                                                        }
                                                    }
                                                });

                                                // Initialize the datepicker for existing rows on page load
                                                initializeDatepicker();
                                            });
                                        </script>



                                    










                                   





                                        <div class="col-12 sub-head">
                                            Equipment/Instruments Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Equipment/Instruments Details<button type="button" name="ann"
                                                    id="equipment_add"
                                                        >+</button>
                                                </label>
                                                <table class="table table-bordered" id="equi_details">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Row #</th>
                                                            <th>Equipment/Instruments Name</th>
                                                            <th>Equipment/Instrument ID</th>
                                                            <th>Equipment/Instruments Comments</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data3 && $data3->equipment)
                                                        @foreach (unserialize($data3->equipment) as $key => $temps)
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="serial_number[]" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
                                                                           value="{{ $key + 1 }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment[]" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
                                                                           value="{{ unserialize($data3->equipment)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_instruments[]"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
                                                                           value="{{ unserialize($data3->equipment_instruments)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_comments[]" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
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
                                            document.getElementById('equipment_add').addEventListener('click', function() {
                                                const tableBody = document.querySelector('#equi_details tbody');
                                                const newRow = document.createElement('tr');

                                                const rowCount = tableBody.rows.length + 1;

                                                newRow.innerHTML = `
                                                    <td><input disabled type="text" name="serial_number[]" value="${rowCount}"></td>
                                                    <td><input type="text" name="equipment[]"></td>
                                                    <td><input type="text" name="equipment_instruments[]"></td>
                                                    <td><input type="text" name="equipment_comments[]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                `;

                                                tableBody.appendChild(newRow);

                                                updateRemoveRowListeners();
                                            });

                                            function updateRemoveRowListeners() {
                                                document.querySelectorAll('.removeRowBtn').forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        this.closest('tr').remove();
                                                        updateRowNumbers();
                                                    });
                                                });
                                            }

                                            function updateRowNumbers() {
                                                document.querySelectorAll('#equipment_de tbody tr').forEach((row, index) => {
                                                    row.querySelector('input[name="serial_number[]"]').value = index + 1;
                                                });
                                            }

                                            // Initial call to set up the listeners for the existing row
                                            updateRemoveRowListeners();
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
                                                    <textarea name="details_new" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->details_new }}</textarea>

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

                            <!-- Capa Detais-->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="search">
                                            CAPA Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="capa_type"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}>
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
                                                <textarea name="corrective_action" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}>{{ $data->corrective_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Preventive Action">Preventive Action</label>
                                                <textarea name="preventive_action" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9? 'readonly' : '' }}>{{ $data->preventive_action }}</textarea>
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
                                                            oninput="addMultipleFiles(this, 'capafileattachement')" multiple {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}>
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
                    <label for="QA Review & Closure" >HOD Remark @if($data->stage == 2)<span class="text-danger">*</span>@endif</label>
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
                    <label for="Comments">CAPA QA/CQA Review Comment @if($data->stage == 3)<span class="text-danger">*</span>@endif</label>
                    <textarea name="capa_qa_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->capa_qa_comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">{{--CAPA--}} QA/CQA Attachment</label>
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
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Effectiveness check required</label>
                                                <select name="effectivness_check">
                                                    <option value="">-----Select---</option>
                                                    <option
                                                        {{ $data->effectivness_check == 'Yes' ? 'selected' : '' }}
                                                        value="Yes">Yes</option>
                                                    <option
                                                        {{ $data->effectivness_check == 'No' ? 'selected' : '' }}
                                                        value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                            <div class="group-input">
                                                <label for="QA Review & Closure">QA/CQA Head Closure Review Comment @if($data->stage == 8)<span class="text-danger">*</span>@endif</label>
                                                <textarea name="qa_review" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->qa_review }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">QA/CQA Head Closure Review Attachment</label>
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
                                        </div> -->
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
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
                    <label for="Comments"> HOD Final Review Comments @if($data->stage == 6)<span class="text-danger">*</span>@endif</label>
                    <textarea name="hod_final_review" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->hod_final_review }}</textarea>
                </div>
            </div>
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">HOD Final Attachment</label>
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
            </div> -->
            <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">HOD Final Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="closure_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="hod_final_attachment">
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
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="hod_final_attachment[]"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'hod_final_attachment')"
                                                            multiple>
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


 <div id="CCForm18" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> Initiator CAPA Update Comment @if($data->stage == 5)<span class="text-danger">*</span>@endif</label>
                    <textarea name="initiator_comment" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->initiator_comment }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">Initiator CAPA Update Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initiator_capa_attachment">

                            @if ($data->initiator_capa_attachment)
                            @foreach (json_decode($data->initiator_capa_attachment) as $file)
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
                            <input type="file" id="myfile" name="initiator_capa_attachment[]"
                                oninput="addMultipleFiles(this, 'initiator_capa_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
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
<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> QA/CQA Closure Review Comment @if($data->stage == 7)<span class="text-danger">*</span>@endif</label>
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
                        <div class="file-attachment-list" id="qa_closure_attachment">

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
                                oninput="addMultipleFiles(this, 'qa_closure_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
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
{{-- ==========================QAH/CQA Approval tab ================ --}}

<div id="CCForm15" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                
                    <label for="Comments"> QA/CQA Approval Comment @if($data->stage == 4)<span class="text-danger">*</span>@endif </label>
                    <textarea name="qah_cq_comments" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->qah_cq_comments }}</textarea>
                </div>
            </div>
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA/CQA Approval Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachment">

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

                        @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfilec" name="qah_cq_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachment')" multiple {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div> -->

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Attachments">QA/CQA Approval Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="capa_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> --}}
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="qah_cq_attachment">

                                                        {{-- @if (is_array($data->qah_cq_attachment)) --}}
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="qah_cq_attachment[]"
                                                            oninput="addMultipleFiles(this, 'qah_cq_attachment')" multiple>
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
                                                <label for="Plan Approved By">Propose Plan Comment</label>
                                                <input type="hidden" name="comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancel By</label>
                                                <input type="hidden" name="cancelled_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancel On</label>
                                                <input type="hidden" name="cancelled_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Cancel Comment</label>
                                                <input type="hidden" name="cancel_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancel_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">HOD Review Complete By</label>
                                                <input type="hidden" name="hod_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_by }}</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved On">HOD Review Complete On</label>
                                                <input type="hidden" name="hod_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">HOD Review Complete Comment</label>
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
                                                <label for="Completed By">QA/CQA Review Complete By</label>
                                                <input type="hidden" name="qa_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Completed On">QA/CQA Review Complete On</label>
                                                <input type="hidden" name="qa_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">QA/CQA Review Complete Comment</label>
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
                                                <label for="Plan Approved By">Approved Comment</label>
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
                                                <label for="Plan Approved By">Completed Comment</label>
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
                                        <label for="Plan Approved By">HOD Final Review Completed Comment</label>
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
                                    <label for="Plan Approved By">QA/CQA Closure Review Completed Comment</label>
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
                                    <label for="Rejected By">QAH/CQA Approval Completed By</label>
                                    <input type="hidden" name="qah_approval_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qah_approval_completed_by }}</div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected By">QAH/CQA Approval Completed On</label>
                                <input type="hidden" name="qah_approval_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_approval_completed_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Plan Approved By">QAH/CQA Approval Completed Comment</label>
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
                                @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                      </label>
                                </div>
                                @endif
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



